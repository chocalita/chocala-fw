<?php
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
    public function pdoConnection()
    {
        $host = 'localhost';
        $db = 'directorio';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;port=3307;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
//            PDO::ATTR_CASE => PDO::CASE_UPPER
        ];
        return new PDO($dsn, $user, $pass, $opt);
    }

    public function fetchAsObjects($statement)
    {
        $pdo = $this->pdoConnection();
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
            $statement = "SELECT * FROM empresa_directorio " .
                " WHERE TPS='SOCIEDAD DE RESPONSABILIDAD LIMITADA' " .
                " AND (MUNICIPIO='LA PAZ' OR MUNICIPIO='EL ALTO') " .
                " AND ULT_RENOV > 2015 " .
                " AND ID NOT IN (0,-1) " .
                " ORDER BY ID LIMIT 100;";
            $results = $this->fetchAsObjects($statement);
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function werwer($empresaDirectorio)
    {

        $email = EmailService::instance()->findByCode(JobSuscriptor::J_EMAIL_NOTIFICATION_DISELO);

        $hash = SpecialStrings::generateHash(20);
        $email = EmailService::instance()->findByCode(JobSuscriptor::J_EMAIL_NOTIFICATION_DISELO);
        $data['email'] = $empresaDirectorio->MAIL;
        $data['nombre_empresa'] = $this->cleanRazon($empresaDirectorio->RAZON);
        $emailMap = [
            'TrackingHash' => $hash,
            'To' => [
                ['Email' => $data['email'], 'Name' => $data['nombre_empresa']],
            ],
        ];
        $emailVars = [
            '~REMITENTE~' => ucwords($data['remitente']),
            '~NOMBRE~' => ucwords($data['nombre']),
            '~CARGO~' => htmlspecialchars($aviso->getCargo()),
            '~NOMBRE_EMPRESA~' => htmlspecialchars($aviso->getNombreEmpresa()),
            '~LINK_AVISO~' => $linkAviso,
        ];

        $emailSent = EmailSender::instanceFrom($email)->sendMail($emailMap, $emailVars);


    }

    public function cleanRazon($razon)
    {
        return trim(
            str_replace("SOCIEDAD DE RESPONSABILIDAD LIMITADA", "", $razon)
        );
    }

}