<?php
Chocala::import('Model.utils.EmailDirectorioSender');
Chocala::import("Modules.system.email.EmailService");

/**
 * Description of DirectorioDBService
 *
 * @author ypra
 */
class DirectorioDBService extends GenericService
{

    const D_EMAIL_INVITATION_DIRECTORIO = 'D_EMAIL_INVITATION_DIRECTORIO';

    const LIMITE_DIARIO = 400;

    const CANTIDAD_BLOQUE = 20;

    /**
     * @return PDO
     */
    public static function pdoConnection()
    {
        $env = Configs::value('app.run.environment');
        $dbEnvConfigs = DBConfig::envConfigs($env);

        $db = (strtoupper($env) != 'DEVELOPMENT') ? 'directorio_empresas' : 'directorio';
        $host = $dbEnvConfigs['host'];
        $port = $dbEnvConfigs['port'];
        $user = $dbEnvConfigs['user'];
        $pass = $dbEnvConfigs['password'];
        $charset = $dbEnvConfigs['charset'];
        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => true,
//            PDO::ATTR_CASE => PDO::CASE_UPPER
        ];
        return new PDO($dsn, $user, $pass, $opt);
    }

    public function fetchAsObjects($statement)
    {
        $pdo = self::pdoConnection();
        $stmt = $pdo->prepare($statement);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function resumeByField($field)
    {
        try {
            $statement = "select $field, count($field) as TOTAL from empresa_directorio group by $field;";
            $results = $this->fetchAsObjects($statement);
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function resumeTPS()
    {
        return $this->resumeByField('TPS');
    }

    public function resumeDpto()
    {
        return $this->resumeByField('DPTO');
    }

    public function resumeMunicipio()
    {
        return $this->resumeByField('MUNICIPIO');
    }

    public function alcanzadoLimiteDiario(SysEmail $email, $limit)
    {
        try {
            $today = (new DateUtil())->format('Y-m-d');
            $statement0 = "SELECT count(*) as TOTAL FROM mail_sent " .
                " WHERE EMAIL_ID = {$email->getId()} AND  SHIPPING_DATE >= '$today 00:00:00' AND SHIPPING_DATE <= '$today 23:59:59'";
            $resultsMailCount = $this->fetchAsObjects($statement0);
            return ($resultsMailCount[0]->TOTAL * 1) >= $limit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function empresasNoInvitadas(SysEmail $email)
    {
        try {
            if ($this->alcanzadoLimiteDiario($email, self::LIMITE_DIARIO)) {
                return [];
            }
            $ids = [0];
            $statement0 = "SELECT * FROM mail_sent WHERE EMAIL_ID={$email->getId()}";
            $resultsMailSent = $this->fetchAsObjects($statement0);
            foreach ($resultsMailSent as $mailSent) {
                $ids[] = $mailSent->EMPRESA_DIRECTORIO_ID;
            }
            $notInIds = implode(",", $ids);

            $statement = "SELECT * FROM empresa_directorio " .
                " WHERE TPS='SOCIEDAD DE RESPONSABILIDAD LIMITADA' " .
                " AND (MUNICIPIO='LA PAZ' OR MUNICIPIO='EL ALTO') " .
                " AND ULT_RENOV > 2015 " .
                " AND ID NOT IN ($notInIds) " .
                " ORDER BY ID LIMIT 20;";
            $resultsEmpresaDirectorio = $this->fetchAsObjects($statement);
            return $resultsEmpresaDirectorio;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return [];
    }

    public function cleanRazon($razon)
    {
        return trim(
            str_replace("SOCIEDAD DE RESPONSABILIDAD LIMITADA", "", $razon)
        );
    }

    public function sendMailInvitacion(SysEmail $email, $empresaDirectorio, $pdo = null)
    {
        if ($pdo == null) {
            $pdo = self::pdoConnection();
        }
        $hash = SpecialStrings::generateHash(20);
        $data['email'] = $empresaDirectorio->MAIL;
        $data['email'] = "yecid.pra@gmail.com";
        $data['nombre_empresa'] = $this->cleanRazon($empresaDirectorio->RAZON);
        $emailMap = [
            'TrackingHash' => $hash,
            'To' => [
                ['Email' => $data['email'], 'Name' => $data['nombre_empresa']],
            ],
        ];
        $linkAviso = "https://www.empleos.click/bolsa/suscripciones/empresa/";
        $linkInterno = $linkAviso . $hash;
        $emailVars = [
            '~NOMBRE_EMPRESA~' => $data['nombre_empresa'],
            '~LINK_INTERNO~' => $linkInterno,
            '~LINK_AVISO~' => $linkAviso,
        ];
        $emailSuccess = EmailDirectorioSender::instanceFrom($email, $empresaDirectorio->ID)
            ->sendMail($emailMap, $emailVars, $pdo);
        return $emailSuccess;
    }

    public function mailing()
    {
        $email = SysEmailQuery::create()->findOneByCode(self::D_EMAIL_INVITATION_DIRECTORIO);
        $pdo = self::pdoConnection();
        $empresasNoInvitadas = $this->empresasNoInvitadas($email);
//        print_r($empresasNoInvitadas);
//        exit();
        $results = "";
        ob_start();
        foreach ($empresasNoInvitadas as $empresasNoInvitada) {
            $success = $this->sendMailInvitacion($email, $empresasNoInvitada, $pdo);
            echo "\n" . $empresasNoInvitada->RAZON . ' [' . $empresasNoInvitada->ID . '] -> ' . ($success ? "SI" : "NO");
        }
        $results = ob_get_contents();
        ob_clean();
        echo APP_DIR . "cron_results_" . date("YMd-Hi") . ".txt";
        file_put_contents(APP_DIR . "cron_results_" . date("Ymd-Hi") . ".txt", $results);
    }

    /**
     * @param $hashString
     * @return bool
     */
    public function hashTracking($hashString)
    {
        $statement0 = "SELECT * FROM mail_sent WHERE HASH_STRING = '$hashString'";
        $resultsMailCount = $this->fetchAsObjects($statement0);
        if (sizeof($resultsMailCount) > 0) {
            if ($resultsMailCount[0]->OPENING_DATE != null) {
                return false;
            }
            $idMailSent = $resultsMailCount[0]->ID * 1;
            $openingDate = (new DateUtil())->format('Y-m-d H:i:s');
            $sql = "UPDATE mail_sent SET OPENING_DATE='$openingDate' WHERE ID=$idMailSent";
            $pdo = self::pdoConnection();
            $selectQueryResult = $pdo->prepare($sql);
            return $selectQueryResult->execute();
        }
        return false;
//        $emailSent = $this->findByHashString($hashString);
//        if (is_object($emailSent)) {
//            if (!$emailSent->getOpeningDate()) {
//                $emailSent->setOpeningDate(new DateTime());
//                $emailSent->save();
//                return true;
//            }
//        }
//        return false;
    }

}