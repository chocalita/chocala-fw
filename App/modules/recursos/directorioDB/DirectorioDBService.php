<?php
Chocala::import('Model.utils.EmailDirectorioSender');
Chocala::import("Modules.system.email.EmailService");

/**
 * Description of AreaReferenciaService
 *
 * @author ypra
 */
class DirectorioDBService extends GenericService
{

    /**
     * @return PDO
     */
    public static function pdoConnection()
    {
        $host = 'localhost';
        $db = 'directorio';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;port=3307;dbname=$db;charset=$charset";

        $dsn = "mysql:host=mysql.empleos.click;port=3306;dbname=directorio_empresas;charset=$charset";
        $user = 'jobsterin';
        $pass = 'Jobsterin.2017.pasS';

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
        } catch(PDOException $e) {
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

    public function empresasNoInvitadas()
    {
        try {
            $ids = [0];
            $statement0 = "SELECT * FROM mail_sent WHERE 1=1" ;
            $resultsMailSent = $this->fetchAsObjects($statement0);
            if (sizeof($resultsMailSent) >= 200) {
                return [];
            }
            foreach ($resultsMailSent as $mailSent) {
                $ids[] = $mailSent->EMPRESA_DIRECTORIO_ID;
            }
            $notInIds = implode(",", $ids);

            $statement = "SELECT * FROM empresa_directorio " .
                " WHERE TPS='SOCIEDAD DE RESPONSABILIDAD LIMITADA' " .
                " AND (MUNICIPIO='LA PAZ' OR MUNICIPIO='EL ALTO') " .
                " AND ULT_RENOV > 2015 " .
                " AND ID NOT IN (0, $notInIds) " .
                " ORDER BY ID LIMIT 20;";
            $resultsEmpresaDirectorio = $this->fetchAsObjects($statement);
            return $resultsEmpresaDirectorio;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    const D_EMAIL_INVITATION_DIRECTORIO = 'D_EMAIL_INVITATION_DIRECTORIO';

    public function cleanRazon($razon)
    {
        return trim(
            str_replace("SOCIEDAD DE RESPONSABILIDAD LIMITADA", "", $razon)
        );
    }

    public function sendMailInvitacion($empresaDirectorio, $pdo)
    {
        $hash = SpecialStrings::generateHash(20);
        $email = SysEmailQuery::create()->findOneByCode(self::D_EMAIL_INVITATION_DIRECTORIO);
//        $email = EmailService::instance()->findByCode(self::D_EMAIL_INVITATION_DIRECTORIO);
        $data['email'] = $empresaDirectorio->MAIL;
//        $data['email'] = "yecid.pra@gmail.com";
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
        $pdo = self::pdoConnection();
        $empresasNoInvitadas = $this->empresasNoInvitadas();
        $results = "";
        ob_start();
        foreach ($empresasNoInvitadas as $empresasNoInvitada) {
            $success = $this->sendMailInvitacion($empresasNoInvitada, $pdo);
            echo "\n" . $empresasNoInvitada->RAZON . ' ['.$empresasNoInvitada->ID.'] -> ' . ($success? "SI": "NO");
        }
        $results = ob_get_contents();
        ob_clean();
        echo APP_DIR . "cron_results_".date("YMd-Hi").".txt";
        file_put_contents(APP_DIR . "cron_results_".date("Ymd-Hi").".txt", $results);
    }


}