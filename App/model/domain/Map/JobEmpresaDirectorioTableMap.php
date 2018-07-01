<?php

namespace Map;

use \JobEmpresaDirectorio;
use \JobEmpresaDirectorioQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'job_empresa_directorio' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobEmpresaDirectorioTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobEmpresaDirectorioTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_empresa_directorio';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobEmpresaDirectorio';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobEmpresaDirectorio';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 35;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 35;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_empresa_directorio.ID';

    /**
     * the column name for the ID_MATRICULA field
     */
    const COL_ID_MATRICULA = 'job_empresa_directorio.ID_MATRICULA';

    /**
     * the column name for the MATRICULA field
     */
    const COL_MATRICULA = 'job_empresa_directorio.MATRICULA';

    /**
     * the column name for the INFO field
     */
    const COL_INFO = 'job_empresa_directorio.INFO';

    /**
     * the column name for the RAZON field
     */
    const COL_RAZON = 'job_empresa_directorio.RAZON';

    /**
     * the column name for the TPS field
     */
    const COL_TPS = 'job_empresa_directorio.TPS';

    /**
     * the column name for the DPTO field
     */
    const COL_DPTO = 'job_empresa_directorio.DPTO';

    /**
     * the column name for the MUNICIPIO field
     */
    const COL_MUNICIPIO = 'job_empresa_directorio.MUNICIPIO';

    /**
     * the column name for the DIRECCION field
     */
    const COL_DIRECCION = 'job_empresa_directorio.DIRECCION';

    /**
     * the column name for the FONO field
     */
    const COL_FONO = 'job_empresa_directorio.FONO';

    /**
     * the column name for the FONO2 field
     */
    const COL_FONO2 = 'job_empresa_directorio.FONO2';

    /**
     * the column name for the FECHA_MATRICULA field
     */
    const COL_FECHA_MATRICULA = 'job_empresa_directorio.FECHA_MATRICULA';

    /**
     * the column name for the FECHA_RENOVACION field
     */
    const COL_FECHA_RENOVACION = 'job_empresa_directorio.FECHA_RENOVACION';

    /**
     * the column name for the ULT_RENOV field
     */
    const COL_ULT_RENOV = 'job_empresa_directorio.ULT_RENOV';

    /**
     * the column name for the EST_MAT field
     */
    const COL_EST_MAT = 'job_empresa_directorio.EST_MAT';

    /**
     * the column name for the CIERRE field
     */
    const COL_CIERRE = 'job_empresa_directorio.CIERRE';

    /**
     * the column name for the ID_CLASE field
     */
    const COL_ID_CLASE = 'job_empresa_directorio.ID_CLASE';

    /**
     * the column name for the NUM_ID field
     */
    const COL_NUM_ID = 'job_empresa_directorio.NUM_ID';

    /**
     * the column name for the NOMBRE field
     */
    const COL_NOMBRE = 'job_empresa_directorio.NOMBRE';

    /**
     * the column name for the CTR_ACT field
     */
    const COL_CTR_ACT = 'job_empresa_directorio.CTR_ACT';

    /**
     * the column name for the ID_REG field
     */
    const COL_ID_REG = 'job_empresa_directorio.ID_REG';

    /**
     * the column name for the VISIBLE field
     */
    const COL_VISIBLE = 'job_empresa_directorio.VISIBLE';

    /**
     * the column name for the FAX field
     */
    const COL_FAX = 'job_empresa_directorio.FAX';

    /**
     * the column name for the MAIL field
     */
    const COL_MAIL = 'job_empresa_directorio.MAIL';

    /**
     * the column name for the ACTIVIDAD field
     */
    const COL_ACTIVIDAD = 'job_empresa_directorio.ACTIVIDAD';

    /**
     * the column name for the LICENCIA field
     */
    const COL_LICENCIA = 'job_empresa_directorio.LICENCIA';

    /**
     * the column name for the CONTACTO field
     */
    const COL_CONTACTO = 'job_empresa_directorio.CONTACTO';

    /**
     * the column name for the SECCION field
     */
    const COL_SECCION = 'job_empresa_directorio.SECCION';

    /**
     * the column name for the DIVISION field
     */
    const COL_DIVISION = 'job_empresa_directorio.DIVISION';

    /**
     * the column name for the CLASE field
     */
    const COL_CLASE = 'job_empresa_directorio.CLASE';

    /**
     * the column name for the GRUPO field
     */
    const COL_GRUPO = 'job_empresa_directorio.GRUPO';

    /**
     * the column name for the DES1 field
     */
    const COL_DES1 = 'job_empresa_directorio.DES1';

    /**
     * the column name for the DES2 field
     */
    const COL_DES2 = 'job_empresa_directorio.DES2';

    /**
     * the column name for the DES3 field
     */
    const COL_DES3 = 'job_empresa_directorio.DES3';

    /**
     * the column name for the DES4 field
     */
    const COL_DES4 = 'job_empresa_directorio.DES4';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'IdMatricula', 'Matricula', 'Info', 'Razon', 'Tps', 'Dpto', 'Municipio', 'Direccion', 'Fono', 'Fono2', 'FechaMatricula', 'FechaRenovacion', 'UltRenov', 'EstMat', 'Cierre', 'IdClase', 'NumId', 'Nombre', 'CtrAct', 'IdReg', 'Visible', 'Fax', 'Mail', 'Actividad', 'Licencia', 'Contacto', 'Seccion', 'Division', 'Clase', 'Grupo', 'Des1', 'Des2', 'Des3', 'Des4', ),
        self::TYPE_CAMELNAME     => array('id', 'idMatricula', 'matricula', 'info', 'razon', 'tps', 'dpto', 'municipio', 'direccion', 'fono', 'fono2', 'fechaMatricula', 'fechaRenovacion', 'ultRenov', 'estMat', 'cierre', 'idClase', 'numId', 'nombre', 'ctrAct', 'idReg', 'visible', 'fax', 'mail', 'actividad', 'licencia', 'contacto', 'seccion', 'division', 'clase', 'grupo', 'des1', 'des2', 'des3', 'des4', ),
        self::TYPE_COLNAME       => array(JobEmpresaDirectorioTableMap::COL_ID, JobEmpresaDirectorioTableMap::COL_ID_MATRICULA, JobEmpresaDirectorioTableMap::COL_MATRICULA, JobEmpresaDirectorioTableMap::COL_INFO, JobEmpresaDirectorioTableMap::COL_RAZON, JobEmpresaDirectorioTableMap::COL_TPS, JobEmpresaDirectorioTableMap::COL_DPTO, JobEmpresaDirectorioTableMap::COL_MUNICIPIO, JobEmpresaDirectorioTableMap::COL_DIRECCION, JobEmpresaDirectorioTableMap::COL_FONO, JobEmpresaDirectorioTableMap::COL_FONO2, JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA, JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION, JobEmpresaDirectorioTableMap::COL_ULT_RENOV, JobEmpresaDirectorioTableMap::COL_EST_MAT, JobEmpresaDirectorioTableMap::COL_CIERRE, JobEmpresaDirectorioTableMap::COL_ID_CLASE, JobEmpresaDirectorioTableMap::COL_NUM_ID, JobEmpresaDirectorioTableMap::COL_NOMBRE, JobEmpresaDirectorioTableMap::COL_CTR_ACT, JobEmpresaDirectorioTableMap::COL_ID_REG, JobEmpresaDirectorioTableMap::COL_VISIBLE, JobEmpresaDirectorioTableMap::COL_FAX, JobEmpresaDirectorioTableMap::COL_MAIL, JobEmpresaDirectorioTableMap::COL_ACTIVIDAD, JobEmpresaDirectorioTableMap::COL_LICENCIA, JobEmpresaDirectorioTableMap::COL_CONTACTO, JobEmpresaDirectorioTableMap::COL_SECCION, JobEmpresaDirectorioTableMap::COL_DIVISION, JobEmpresaDirectorioTableMap::COL_CLASE, JobEmpresaDirectorioTableMap::COL_GRUPO, JobEmpresaDirectorioTableMap::COL_DES1, JobEmpresaDirectorioTableMap::COL_DES2, JobEmpresaDirectorioTableMap::COL_DES3, JobEmpresaDirectorioTableMap::COL_DES4, ),
        self::TYPE_FIELDNAME     => array('ID', 'ID_MATRICULA', 'MATRICULA', 'INFO', 'RAZON', 'TPS', 'DPTO', 'MUNICIPIO', 'DIRECCION', 'FONO', 'FONO2', 'FECHA_MATRICULA', 'FECHA_RENOVACION', 'ULT_RENOV', 'EST_MAT', 'CIERRE', 'ID_CLASE', 'NUM_ID', 'NOMBRE', 'CTR_ACT', 'ID_REG', 'VISIBLE', 'FAX', 'MAIL', 'ACTIVIDAD', 'LICENCIA', 'CONTACTO', 'SECCION', 'DIVISION', 'CLASE', 'GRUPO', 'DES1', 'DES2', 'DES3', 'DES4', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdMatricula' => 1, 'Matricula' => 2, 'Info' => 3, 'Razon' => 4, 'Tps' => 5, 'Dpto' => 6, 'Municipio' => 7, 'Direccion' => 8, 'Fono' => 9, 'Fono2' => 10, 'FechaMatricula' => 11, 'FechaRenovacion' => 12, 'UltRenov' => 13, 'EstMat' => 14, 'Cierre' => 15, 'IdClase' => 16, 'NumId' => 17, 'Nombre' => 18, 'CtrAct' => 19, 'IdReg' => 20, 'Visible' => 21, 'Fax' => 22, 'Mail' => 23, 'Actividad' => 24, 'Licencia' => 25, 'Contacto' => 26, 'Seccion' => 27, 'Division' => 28, 'Clase' => 29, 'Grupo' => 30, 'Des1' => 31, 'Des2' => 32, 'Des3' => 33, 'Des4' => 34, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idMatricula' => 1, 'matricula' => 2, 'info' => 3, 'razon' => 4, 'tps' => 5, 'dpto' => 6, 'municipio' => 7, 'direccion' => 8, 'fono' => 9, 'fono2' => 10, 'fechaMatricula' => 11, 'fechaRenovacion' => 12, 'ultRenov' => 13, 'estMat' => 14, 'cierre' => 15, 'idClase' => 16, 'numId' => 17, 'nombre' => 18, 'ctrAct' => 19, 'idReg' => 20, 'visible' => 21, 'fax' => 22, 'mail' => 23, 'actividad' => 24, 'licencia' => 25, 'contacto' => 26, 'seccion' => 27, 'division' => 28, 'clase' => 29, 'grupo' => 30, 'des1' => 31, 'des2' => 32, 'des3' => 33, 'des4' => 34, ),
        self::TYPE_COLNAME       => array(JobEmpresaDirectorioTableMap::COL_ID => 0, JobEmpresaDirectorioTableMap::COL_ID_MATRICULA => 1, JobEmpresaDirectorioTableMap::COL_MATRICULA => 2, JobEmpresaDirectorioTableMap::COL_INFO => 3, JobEmpresaDirectorioTableMap::COL_RAZON => 4, JobEmpresaDirectorioTableMap::COL_TPS => 5, JobEmpresaDirectorioTableMap::COL_DPTO => 6, JobEmpresaDirectorioTableMap::COL_MUNICIPIO => 7, JobEmpresaDirectorioTableMap::COL_DIRECCION => 8, JobEmpresaDirectorioTableMap::COL_FONO => 9, JobEmpresaDirectorioTableMap::COL_FONO2 => 10, JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA => 11, JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION => 12, JobEmpresaDirectorioTableMap::COL_ULT_RENOV => 13, JobEmpresaDirectorioTableMap::COL_EST_MAT => 14, JobEmpresaDirectorioTableMap::COL_CIERRE => 15, JobEmpresaDirectorioTableMap::COL_ID_CLASE => 16, JobEmpresaDirectorioTableMap::COL_NUM_ID => 17, JobEmpresaDirectorioTableMap::COL_NOMBRE => 18, JobEmpresaDirectorioTableMap::COL_CTR_ACT => 19, JobEmpresaDirectorioTableMap::COL_ID_REG => 20, JobEmpresaDirectorioTableMap::COL_VISIBLE => 21, JobEmpresaDirectorioTableMap::COL_FAX => 22, JobEmpresaDirectorioTableMap::COL_MAIL => 23, JobEmpresaDirectorioTableMap::COL_ACTIVIDAD => 24, JobEmpresaDirectorioTableMap::COL_LICENCIA => 25, JobEmpresaDirectorioTableMap::COL_CONTACTO => 26, JobEmpresaDirectorioTableMap::COL_SECCION => 27, JobEmpresaDirectorioTableMap::COL_DIVISION => 28, JobEmpresaDirectorioTableMap::COL_CLASE => 29, JobEmpresaDirectorioTableMap::COL_GRUPO => 30, JobEmpresaDirectorioTableMap::COL_DES1 => 31, JobEmpresaDirectorioTableMap::COL_DES2 => 32, JobEmpresaDirectorioTableMap::COL_DES3 => 33, JobEmpresaDirectorioTableMap::COL_DES4 => 34, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ID_MATRICULA' => 1, 'MATRICULA' => 2, 'INFO' => 3, 'RAZON' => 4, 'TPS' => 5, 'DPTO' => 6, 'MUNICIPIO' => 7, 'DIRECCION' => 8, 'FONO' => 9, 'FONO2' => 10, 'FECHA_MATRICULA' => 11, 'FECHA_RENOVACION' => 12, 'ULT_RENOV' => 13, 'EST_MAT' => 14, 'CIERRE' => 15, 'ID_CLASE' => 16, 'NUM_ID' => 17, 'NOMBRE' => 18, 'CTR_ACT' => 19, 'ID_REG' => 20, 'VISIBLE' => 21, 'FAX' => 22, 'MAIL' => 23, 'ACTIVIDAD' => 24, 'LICENCIA' => 25, 'CONTACTO' => 26, 'SECCION' => 27, 'DIVISION' => 28, 'CLASE' => 29, 'GRUPO' => 30, 'DES1' => 31, 'DES2' => 32, 'DES3' => 33, 'DES4' => 34, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('job_empresa_directorio');
        $this->setPhpName('JobEmpresaDirectorio');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobEmpresaDirectorio');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ID_MATRICULA', 'IdMatricula', 'INTEGER', true, null, null);
        $this->addColumn('MATRICULA', 'Matricula', 'VARCHAR', true, 30, null);
        $this->addColumn('INFO', 'Info', 'LONGVARCHAR', true, null, null);
        $this->addColumn('RAZON', 'Razon', 'VARCHAR', true, 500, null);
        $this->addColumn('TPS', 'Tps', 'VARCHAR', false, 200, null);
        $this->addColumn('DPTO', 'Dpto', 'VARCHAR', false, 200, null);
        $this->addColumn('MUNICIPIO', 'Municipio', 'VARCHAR', false, 200, null);
        $this->addColumn('DIRECCION', 'Direccion', 'VARCHAR', false, 500, null);
        $this->addColumn('FONO', 'Fono', 'VARCHAR', false, 100, null);
        $this->addColumn('FONO2', 'Fono2', 'VARCHAR', false, 100, null);
        $this->addColumn('FECHA_MATRICULA', 'FechaMatricula', 'DATE', false, null, null);
        $this->addColumn('FECHA_RENOVACION', 'FechaRenovacion', 'DATE', false, null, null);
        $this->addColumn('ULT_RENOV', 'UltRenov', 'INTEGER', false, null, null);
        $this->addColumn('EST_MAT', 'EstMat', 'VARCHAR', false, 100, null);
        $this->addColumn('CIERRE', 'Cierre', 'INTEGER', false, null, null);
        $this->addColumn('ID_CLASE', 'IdClase', 'VARCHAR', false, 20, null);
        $this->addColumn('NUM_ID', 'NumId', 'VARCHAR', false, 20, null);
        $this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', false, 200, null);
        $this->addColumn('CTR_ACT', 'CtrAct', 'VARCHAR', false, 50, null);
        $this->addColumn('ID_REG', 'IdReg', 'VARCHAR', false, 20, null);
        $this->addColumn('VISIBLE', 'Visible', 'VARCHAR', false, 30, null);
        $this->addColumn('FAX', 'Fax', 'VARCHAR', false, 50, null);
        $this->addColumn('MAIL', 'Mail', 'VARCHAR', false, 20, null);
        $this->addColumn('ACTIVIDAD', 'Actividad', 'VARCHAR', false, 500, null);
        $this->addColumn('LICENCIA', 'Licencia', 'VARCHAR', false, 30, null);
        $this->addColumn('CONTACTO', 'Contacto', 'VARCHAR', false, 100, null);
        $this->addColumn('SECCION', 'Seccion', 'VARCHAR', true, 30, null);
        $this->addColumn('DIVISION', 'Division', 'INTEGER', false, null, null);
        $this->addColumn('CLASE', 'Clase', 'INTEGER', false, null, null);
        $this->addColumn('GRUPO', 'Grupo', 'INTEGER', false, null, null);
        $this->addColumn('DES1', 'Des1', 'VARCHAR', false, 500, null);
        $this->addColumn('DES2', 'Des2', 'VARCHAR', false, 2000, null);
        $this->addColumn('DES3', 'Des3', 'LONGVARCHAR', false, null, null);
        $this->addColumn('DES4', 'Des4', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? JobEmpresaDirectorioTableMap::CLASS_DEFAULT : JobEmpresaDirectorioTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (JobEmpresaDirectorio object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobEmpresaDirectorioTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobEmpresaDirectorioTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobEmpresaDirectorioTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobEmpresaDirectorioTableMap::OM_CLASS;
            /** @var JobEmpresaDirectorio $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobEmpresaDirectorioTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = JobEmpresaDirectorioTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobEmpresaDirectorioTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobEmpresaDirectorio $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobEmpresaDirectorioTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_ID);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_ID_MATRICULA);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_MATRICULA);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_INFO);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_RAZON);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_TPS);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_DPTO);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_MUNICIPIO);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_FONO);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_FONO2);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_ULT_RENOV);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_EST_MAT);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_CIERRE);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_ID_CLASE);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_NUM_ID);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_CTR_ACT);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_ID_REG);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_VISIBLE);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_FAX);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_MAIL);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_ACTIVIDAD);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_LICENCIA);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_CONTACTO);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_SECCION);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_DIVISION);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_CLASE);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_GRUPO);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_DES1);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_DES2);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_DES3);
            $criteria->addSelectColumn(JobEmpresaDirectorioTableMap::COL_DES4);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ID_MATRICULA');
            $criteria->addSelectColumn($alias . '.MATRICULA');
            $criteria->addSelectColumn($alias . '.INFO');
            $criteria->addSelectColumn($alias . '.RAZON');
            $criteria->addSelectColumn($alias . '.TPS');
            $criteria->addSelectColumn($alias . '.DPTO');
            $criteria->addSelectColumn($alias . '.MUNICIPIO');
            $criteria->addSelectColumn($alias . '.DIRECCION');
            $criteria->addSelectColumn($alias . '.FONO');
            $criteria->addSelectColumn($alias . '.FONO2');
            $criteria->addSelectColumn($alias . '.FECHA_MATRICULA');
            $criteria->addSelectColumn($alias . '.FECHA_RENOVACION');
            $criteria->addSelectColumn($alias . '.ULT_RENOV');
            $criteria->addSelectColumn($alias . '.EST_MAT');
            $criteria->addSelectColumn($alias . '.CIERRE');
            $criteria->addSelectColumn($alias . '.ID_CLASE');
            $criteria->addSelectColumn($alias . '.NUM_ID');
            $criteria->addSelectColumn($alias . '.NOMBRE');
            $criteria->addSelectColumn($alias . '.CTR_ACT');
            $criteria->addSelectColumn($alias . '.ID_REG');
            $criteria->addSelectColumn($alias . '.VISIBLE');
            $criteria->addSelectColumn($alias . '.FAX');
            $criteria->addSelectColumn($alias . '.MAIL');
            $criteria->addSelectColumn($alias . '.ACTIVIDAD');
            $criteria->addSelectColumn($alias . '.LICENCIA');
            $criteria->addSelectColumn($alias . '.CONTACTO');
            $criteria->addSelectColumn($alias . '.SECCION');
            $criteria->addSelectColumn($alias . '.DIVISION');
            $criteria->addSelectColumn($alias . '.CLASE');
            $criteria->addSelectColumn($alias . '.GRUPO');
            $criteria->addSelectColumn($alias . '.DES1');
            $criteria->addSelectColumn($alias . '.DES2');
            $criteria->addSelectColumn($alias . '.DES3');
            $criteria->addSelectColumn($alias . '.DES4');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(JobEmpresaDirectorioTableMap::DATABASE_NAME)->getTable(JobEmpresaDirectorioTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobEmpresaDirectorioTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobEmpresaDirectorioTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobEmpresaDirectorio or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobEmpresaDirectorio object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobEmpresaDirectorio) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobEmpresaDirectorioTableMap::DATABASE_NAME);
            $criteria->add(JobEmpresaDirectorioTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobEmpresaDirectorioQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobEmpresaDirectorioTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobEmpresaDirectorioTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_empresa_directorio table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobEmpresaDirectorioQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobEmpresaDirectorio or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobEmpresaDirectorio object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobEmpresaDirectorio object
        }


        // Set the correct dbName
        $query = JobEmpresaDirectorioQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobEmpresaDirectorioTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobEmpresaDirectorioTableMap::buildTableMap();
