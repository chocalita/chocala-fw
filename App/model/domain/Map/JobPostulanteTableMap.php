<?php

namespace Map;

use \JobPostulante;
use \JobPostulanteQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'job_postulante' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobPostulanteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobPostulanteTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_postulante';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobPostulante';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobPostulante';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 25;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 25;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_postulante.ID';

    /**
     * the column name for the USER_ID field
     */
    const COL_USER_ID = 'job_postulante.USER_ID';

    /**
     * the column name for the LOCATION_ID field
     */
    const COL_LOCATION_ID = 'job_postulante.LOCATION_ID';

    /**
     * the column name for the ESTADO field
     */
    const COL_ESTADO = 'job_postulante.ESTADO';

    /**
     * the column name for the NOMBRES field
     */
    const COL_NOMBRES = 'job_postulante.NOMBRES';

    /**
     * the column name for the APELLIDO1 field
     */
    const COL_APELLIDO1 = 'job_postulante.APELLIDO1';

    /**
     * the column name for the APELLIDO2 field
     */
    const COL_APELLIDO2 = 'job_postulante.APELLIDO2';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'job_postulante.EMAIL';

    /**
     * the column name for the CI field
     */
    const COL_CI = 'job_postulante.CI';

    /**
     * the column name for the CI_EXPEDIDO field
     */
    const COL_CI_EXPEDIDO = 'job_postulante.CI_EXPEDIDO';

    /**
     * the column name for the SEXO field
     */
    const COL_SEXO = 'job_postulante.SEXO';

    /**
     * the column name for the FECHA_NACIMIENTO field
     */
    const COL_FECHA_NACIMIENTO = 'job_postulante.FECHA_NACIMIENTO';

    /**
     * the column name for the LUGAR_NACIMIENTO field
     */
    const COL_LUGAR_NACIMIENTO = 'job_postulante.LUGAR_NACIMIENTO';

    /**
     * the column name for the DIRECCION field
     */
    const COL_DIRECCION = 'job_postulante.DIRECCION';

    /**
     * the column name for the CIUDAD field
     */
    const COL_CIUDAD = 'job_postulante.CIUDAD';

    /**
     * the column name for the TELEFONO_DOMICILIO field
     */
    const COL_TELEFONO_DOMICILIO = 'job_postulante.TELEFONO_DOMICILIO';

    /**
     * the column name for the TELEFONO_TRABAJO field
     */
    const COL_TELEFONO_TRABAJO = 'job_postulante.TELEFONO_TRABAJO';

    /**
     * the column name for the CELULAR_1 field
     */
    const COL_CELULAR_1 = 'job_postulante.CELULAR_1';

    /**
     * the column name for the CELULAR_2 field
     */
    const COL_CELULAR_2 = 'job_postulante.CELULAR_2';

    /**
     * the column name for the MIME_FOTO field
     */
    const COL_MIME_FOTO = 'job_postulante.MIME_FOTO';

    /**
     * the column name for the PRETENSION_SALARIAL field
     */
    const COL_PRETENSION_SALARIAL = 'job_postulante.PRETENSION_SALARIAL';

    /**
     * the column name for the FECHA_ULTIMA_POSTULACION field
     */
    const COL_FECHA_ULTIMA_POSTULACION = 'job_postulante.FECHA_ULTIMA_POSTULACION';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_postulante.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_postulante.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_postulante.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'UserId', 'LocationId', 'Estado', 'Nombres', 'Apellido1', 'Apellido2', 'Email', 'Ci', 'CiExpedido', 'Sexo', 'FechaNacimiento', 'LugarNacimiento', 'Direccion', 'Ciudad', 'TelefonoDomicilio', 'TelefonoTrabajo', 'Celular1', 'Celular2', 'MimeFoto', 'PretensionSalarial', 'FechaUltimaPostulacion', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'userId', 'locationId', 'estado', 'nombres', 'apellido1', 'apellido2', 'email', 'ci', 'ciExpedido', 'sexo', 'fechaNacimiento', 'lugarNacimiento', 'direccion', 'ciudad', 'telefonoDomicilio', 'telefonoTrabajo', 'celular1', 'celular2', 'mimeFoto', 'pretensionSalarial', 'fechaUltimaPostulacion', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobPostulanteTableMap::COL_ID, JobPostulanteTableMap::COL_USER_ID, JobPostulanteTableMap::COL_LOCATION_ID, JobPostulanteTableMap::COL_ESTADO, JobPostulanteTableMap::COL_NOMBRES, JobPostulanteTableMap::COL_APELLIDO1, JobPostulanteTableMap::COL_APELLIDO2, JobPostulanteTableMap::COL_EMAIL, JobPostulanteTableMap::COL_CI, JobPostulanteTableMap::COL_CI_EXPEDIDO, JobPostulanteTableMap::COL_SEXO, JobPostulanteTableMap::COL_FECHA_NACIMIENTO, JobPostulanteTableMap::COL_LUGAR_NACIMIENTO, JobPostulanteTableMap::COL_DIRECCION, JobPostulanteTableMap::COL_CIUDAD, JobPostulanteTableMap::COL_TELEFONO_DOMICILIO, JobPostulanteTableMap::COL_TELEFONO_TRABAJO, JobPostulanteTableMap::COL_CELULAR_1, JobPostulanteTableMap::COL_CELULAR_2, JobPostulanteTableMap::COL_MIME_FOTO, JobPostulanteTableMap::COL_PRETENSION_SALARIAL, JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION, JobPostulanteTableMap::COL_LAST_USER_ID, JobPostulanteTableMap::COL_CREATION_DATE, JobPostulanteTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'USER_ID', 'LOCATION_ID', 'ESTADO', 'NOMBRES', 'APELLIDO1', 'APELLIDO2', 'EMAIL', 'CI', 'CI_EXPEDIDO', 'SEXO', 'FECHA_NACIMIENTO', 'LUGAR_NACIMIENTO', 'DIRECCION', 'CIUDAD', 'TELEFONO_DOMICILIO', 'TELEFONO_TRABAJO', 'CELULAR_1', 'CELULAR_2', 'MIME_FOTO', 'PRETENSION_SALARIAL', 'FECHA_ULTIMA_POSTULACION', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserId' => 1, 'LocationId' => 2, 'Estado' => 3, 'Nombres' => 4, 'Apellido1' => 5, 'Apellido2' => 6, 'Email' => 7, 'Ci' => 8, 'CiExpedido' => 9, 'Sexo' => 10, 'FechaNacimiento' => 11, 'LugarNacimiento' => 12, 'Direccion' => 13, 'Ciudad' => 14, 'TelefonoDomicilio' => 15, 'TelefonoTrabajo' => 16, 'Celular1' => 17, 'Celular2' => 18, 'MimeFoto' => 19, 'PretensionSalarial' => 20, 'FechaUltimaPostulacion' => 21, 'LastUserId' => 22, 'CreationDate' => 23, 'ModificationDate' => 24, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userId' => 1, 'locationId' => 2, 'estado' => 3, 'nombres' => 4, 'apellido1' => 5, 'apellido2' => 6, 'email' => 7, 'ci' => 8, 'ciExpedido' => 9, 'sexo' => 10, 'fechaNacimiento' => 11, 'lugarNacimiento' => 12, 'direccion' => 13, 'ciudad' => 14, 'telefonoDomicilio' => 15, 'telefonoTrabajo' => 16, 'celular1' => 17, 'celular2' => 18, 'mimeFoto' => 19, 'pretensionSalarial' => 20, 'fechaUltimaPostulacion' => 21, 'lastUserId' => 22, 'creationDate' => 23, 'modificationDate' => 24, ),
        self::TYPE_COLNAME       => array(JobPostulanteTableMap::COL_ID => 0, JobPostulanteTableMap::COL_USER_ID => 1, JobPostulanteTableMap::COL_LOCATION_ID => 2, JobPostulanteTableMap::COL_ESTADO => 3, JobPostulanteTableMap::COL_NOMBRES => 4, JobPostulanteTableMap::COL_APELLIDO1 => 5, JobPostulanteTableMap::COL_APELLIDO2 => 6, JobPostulanteTableMap::COL_EMAIL => 7, JobPostulanteTableMap::COL_CI => 8, JobPostulanteTableMap::COL_CI_EXPEDIDO => 9, JobPostulanteTableMap::COL_SEXO => 10, JobPostulanteTableMap::COL_FECHA_NACIMIENTO => 11, JobPostulanteTableMap::COL_LUGAR_NACIMIENTO => 12, JobPostulanteTableMap::COL_DIRECCION => 13, JobPostulanteTableMap::COL_CIUDAD => 14, JobPostulanteTableMap::COL_TELEFONO_DOMICILIO => 15, JobPostulanteTableMap::COL_TELEFONO_TRABAJO => 16, JobPostulanteTableMap::COL_CELULAR_1 => 17, JobPostulanteTableMap::COL_CELULAR_2 => 18, JobPostulanteTableMap::COL_MIME_FOTO => 19, JobPostulanteTableMap::COL_PRETENSION_SALARIAL => 20, JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION => 21, JobPostulanteTableMap::COL_LAST_USER_ID => 22, JobPostulanteTableMap::COL_CREATION_DATE => 23, JobPostulanteTableMap::COL_MODIFICATION_DATE => 24, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'USER_ID' => 1, 'LOCATION_ID' => 2, 'ESTADO' => 3, 'NOMBRES' => 4, 'APELLIDO1' => 5, 'APELLIDO2' => 6, 'EMAIL' => 7, 'CI' => 8, 'CI_EXPEDIDO' => 9, 'SEXO' => 10, 'FECHA_NACIMIENTO' => 11, 'LUGAR_NACIMIENTO' => 12, 'DIRECCION' => 13, 'CIUDAD' => 14, 'TELEFONO_DOMICILIO' => 15, 'TELEFONO_TRABAJO' => 16, 'CELULAR_1' => 17, 'CELULAR_2' => 18, 'MIME_FOTO' => 19, 'PRETENSION_SALARIAL' => 20, 'FECHA_ULTIMA_POSTULACION' => 21, 'LAST_USER_ID' => 22, 'CREATION_DATE' => 23, 'MODIFICATION_DATE' => 24, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
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
        $this->setName('job_postulante');
        $this->setPhpName('JobPostulante');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobPostulante');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('USER_ID', 'UserId', 'INTEGER', true, null, null);
        $this->addColumn('LOCATION_ID', 'LocationId', 'INTEGER', false, null, null);
        $this->addColumn('ESTADO', 'Estado', 'VARCHAR', true, 30, null);
        $this->addColumn('NOMBRES', 'Nombres', 'VARCHAR', true, 100, null);
        $this->addColumn('APELLIDO1', 'Apellido1', 'VARCHAR', true, 50, null);
        $this->addColumn('APELLIDO2', 'Apellido2', 'VARCHAR', false, 50, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 200, null);
        $this->addColumn('CI', 'Ci', 'VARCHAR', true, 20, null);
        $this->addColumn('CI_EXPEDIDO', 'CiExpedido', 'VARCHAR', true, 10, null);
        $this->addColumn('SEXO', 'Sexo', 'VARCHAR', true, 10, null);
        $this->addColumn('FECHA_NACIMIENTO', 'FechaNacimiento', 'DATE', true, null, null);
        $this->addColumn('LUGAR_NACIMIENTO', 'LugarNacimiento', 'VARCHAR', false, 100, null);
        $this->addColumn('DIRECCION', 'Direccion', 'VARCHAR', true, 200, null);
        $this->addColumn('CIUDAD', 'Ciudad', 'VARCHAR', true, 50, null);
        $this->addColumn('TELEFONO_DOMICILIO', 'TelefonoDomicilio', 'VARCHAR', false, 30, null);
        $this->addColumn('TELEFONO_TRABAJO', 'TelefonoTrabajo', 'VARCHAR', false, 30, null);
        $this->addColumn('CELULAR_1', 'Celular1', 'VARCHAR', true, 30, null);
        $this->addColumn('CELULAR_2', 'Celular2', 'VARCHAR', false, 30, null);
        $this->addColumn('MIME_FOTO', 'MimeFoto', 'VARCHAR', false, 20, null);
        $this->addColumn('PRETENSION_SALARIAL', 'PretensionSalarial', 'INTEGER', false, null, 0);
        $this->addColumn('FECHA_ULTIMA_POSTULACION', 'FechaUltimaPostulacion', 'TIMESTAMP', false, null, '0000-00-00 00:00:00');
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, '0000-00-00 00:00:00');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobPostulanteAviso', '\\JobPostulanteAviso', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_POSTULANTE',
    1 => ':ID',
  ),
), null, null, 'JobPostulanteAvisos', false);
        $this->addRelation('JobSuscriptor', '\\JobSuscriptor', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_POSTULANTE',
    1 => ':ID',
  ),
), null, null, 'JobSuscriptors', false);
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
        return null;
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
        return '';
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
        return $withPrefix ? JobPostulanteTableMap::CLASS_DEFAULT : JobPostulanteTableMap::OM_CLASS;
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
     * @return array           (JobPostulante object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobPostulanteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobPostulanteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobPostulanteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobPostulanteTableMap::OM_CLASS;
            /** @var JobPostulante $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobPostulanteTableMap::addInstanceToPool($obj, $key);
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
            $key = JobPostulanteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobPostulanteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobPostulante $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobPostulanteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_ID);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_USER_ID);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_ESTADO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_NOMBRES);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_APELLIDO1);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_APELLIDO2);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_EMAIL);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_CI);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_CI_EXPEDIDO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_SEXO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_FECHA_NACIMIENTO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_LUGAR_NACIMIENTO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_CIUDAD);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_TELEFONO_DOMICILIO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_TELEFONO_TRABAJO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_CELULAR_1);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_CELULAR_2);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_MIME_FOTO);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_PRETENSION_SALARIAL);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobPostulanteTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.LOCATION_ID');
            $criteria->addSelectColumn($alias . '.ESTADO');
            $criteria->addSelectColumn($alias . '.NOMBRES');
            $criteria->addSelectColumn($alias . '.APELLIDO1');
            $criteria->addSelectColumn($alias . '.APELLIDO2');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.CI');
            $criteria->addSelectColumn($alias . '.CI_EXPEDIDO');
            $criteria->addSelectColumn($alias . '.SEXO');
            $criteria->addSelectColumn($alias . '.FECHA_NACIMIENTO');
            $criteria->addSelectColumn($alias . '.LUGAR_NACIMIENTO');
            $criteria->addSelectColumn($alias . '.DIRECCION');
            $criteria->addSelectColumn($alias . '.CIUDAD');
            $criteria->addSelectColumn($alias . '.TELEFONO_DOMICILIO');
            $criteria->addSelectColumn($alias . '.TELEFONO_TRABAJO');
            $criteria->addSelectColumn($alias . '.CELULAR_1');
            $criteria->addSelectColumn($alias . '.CELULAR_2');
            $criteria->addSelectColumn($alias . '.MIME_FOTO');
            $criteria->addSelectColumn($alias . '.PRETENSION_SALARIAL');
            $criteria->addSelectColumn($alias . '.FECHA_ULTIMA_POSTULACION');
            $criteria->addSelectColumn($alias . '.LAST_USER_ID');
            $criteria->addSelectColumn($alias . '.CREATION_DATE');
            $criteria->addSelectColumn($alias . '.MODIFICATION_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobPostulanteTableMap::DATABASE_NAME)->getTable(JobPostulanteTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobPostulanteTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobPostulanteTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobPostulanteTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobPostulante or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobPostulante object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobPostulante) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The JobPostulante object has no primary key');
        }

        $query = JobPostulanteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobPostulanteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobPostulanteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_postulante table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobPostulanteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobPostulante or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobPostulante object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobPostulante object
        }


        // Set the correct dbName
        $query = JobPostulanteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobPostulanteTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobPostulanteTableMap::buildTableMap();
