<?php
/**
 * Description of AreaReferenciaService
 *
 * @author ypra
 */
class DirectorioDBService extends GenericService
{

    public function resumeByField($field)
    {
        try {
            $statement = "select $field, count($field) as TOTAL from empresa_directorio group by $field;";
            $pdo = $this->pdoConnection();
            $stmt = $pdo->prepare($statement);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
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

}