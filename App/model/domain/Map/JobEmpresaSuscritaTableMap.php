<?php

namespace Map;

use \JobEmpresaSuscrita;
use \JobEmpresaSuscritaQuery;
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
 * This class defines the structure of the 'job_empresa_suscrita' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobEmpresaSuscritaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobEmpresaSuscritaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_empresa_suscrita';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobEmpresaSuscrita';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobEmpresaSuscrita';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_empresa_suscrita.ID';

    /**
     * the column name for the ENTITY_TYPE_ID field
     */
    const COL_ENTITY_TYPE_ID = 'job_empresa_suscrita.ENTITY_TYPE_ID';

    /**
     * the column name for the LOCATION_ID field
     */
    const COL_LOCATION_ID = 'job_empresa_suscrita.LOCATION_ID';

    /**
     * the column name for the SCRAP_EMPRESA_ID field
     */
    const COL_SCRAP_EMPRESA_ID = 'job_empresa_suscrita.SCRAP_EMPRESA_ID';

    /**
     * the column name for the HASH_CODE field
     */
    const COL_HASH_CODE = 'job_empresa_suscrita.HASH_CODE';

    /**
     * the column name for the NOMBRE field
     */
    const COL_NOMBRE = 'job_empresa_suscrita.NOMBRE';

    /**
     * the column name for the NIT field
     */
    const COL_NIT = 'job_empresa_suscrita.NIT';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'job_empresa_suscrita.EMAIL';

    /**
     * the column name for the DIRECCION field
     */
    const COL_DIRECCION = 'job_empresa_suscrita.DIRECCION';

    /**
     * the column name for the REPRESENTANTE field
     */
    const COL_REPRESENTANTE = 'job_empresa_suscrita.REPRESENTANTE';

    /**
     * the column name for the TELEFONO field
     */
    const COL_TELEFONO = 'job_empresa_suscrita.TELEFONO';

    /**
     * the column name for the CELULAR field
     */
    const COL_CELULAR = 'job_empresa_suscrita.CELULAR';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_empresa_suscrita.STATUS';

    /**
     * the column name for the MIMETYPE field
     */
    const COL_MIMETYPE = 'job_empresa_suscrita.MIMETYPE';

    /**
     * the column name for the TIENE_LOGO field
     */
    const COL_TIENE_LOGO = 'job_empresa_suscrita.TIENE_LOGO';

    /**
     * the column name for the IP_CREACION field
     */
    const COL_IP_CREACION = 'job_empresa_suscrita.IP_CREACION';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_empresa_suscrita.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_empresa_suscrita.CREATION_DATE';

    /**
     * the column name for the MODIFICACION_DATE field
     */
    const COL_MODIFICACION_DATE = 'job_empresa_suscrita.MODIFICACION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'EntityTypeId', 'LocationId', 'ScrapEmpresaId', 'HashCode', 'Nombre', 'Nit', 'Email', 'Direccion', 'Representante', 'Telefono', 'Celular', 'Status', 'Mimetype', 'TieneLogo', 'IpCreacion', 'LastUserId', 'CreationDate', 'ModificacionDate', ),
        self::TYPE_CAMELNAME     => array('id', 'entityTypeId', 'locationId', 'scrapEmpresaId', 'hashCode', 'nombre', 'nit', 'email', 'direccion', 'representante', 'telefono', 'celular', 'status', 'mimetype', 'tieneLogo', 'ipCreacion', 'lastUserId', 'creationDate', 'modificacionDate', ),
        self::TYPE_COLNAME       => array(JobEmpresaSuscritaTableMap::COL_ID, JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID, JobEmpresaSuscritaTableMap::COL_LOCATION_ID, JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID, JobEmpresaSuscritaTableMap::COL_HASH_CODE, JobEmpresaSuscritaTableMap::COL_NOMBRE, JobEmpresaSuscritaTableMap::COL_NIT, JobEmpresaSuscritaTableMap::COL_EMAIL, JobEmpresaSuscritaTableMap::COL_DIRECCION, JobEmpresaSuscritaTableMap::COL_REPRESENTANTE, JobEmpresaSuscritaTableMap::COL_TELEFONO, JobEmpresaSuscritaTableMap::COL_CELULAR, JobEmpresaSuscritaTableMap::COL_STATUS, JobEmpresaSuscritaTableMap::COL_MIMETYPE, JobEmpresaSuscritaTableMap::COL_TIENE_LOGO, JobEmpresaSuscritaTableMap::COL_IP_CREACION, JobEmpresaSuscritaTableMap::COL_LAST_USER_ID, JobEmpresaSuscritaTableMap::COL_CREATION_DATE, JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'ENTITY_TYPE_ID', 'LOCATION_ID', 'SCRAP_EMPRESA_ID', 'HASH_CODE', 'NOMBRE', 'NIT', 'EMAIL', 'DIRECCION', 'REPRESENTANTE', 'TELEFONO', 'CELULAR', 'STATUS', 'MIMETYPE', 'TIENE_LOGO', 'IP_CREACION', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICACION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'EntityTypeId' => 1, 'LocationId' => 2, 'ScrapEmpresaId' => 3, 'HashCode' => 4, 'Nombre' => 5, 'Nit' => 6, 'Email' => 7, 'Direccion' => 8, 'Representante' => 9, 'Telefono' => 10, 'Celular' => 11, 'Status' => 12, 'Mimetype' => 13, 'TieneLogo' => 14, 'IpCreacion' => 15, 'LastUserId' => 16, 'CreationDate' => 17, 'ModificacionDate' => 18, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'entityTypeId' => 1, 'locationId' => 2, 'scrapEmpresaId' => 3, 'hashCode' => 4, 'nombre' => 5, 'nit' => 6, 'email' => 7, 'direccion' => 8, 'representante' => 9, 'telefono' => 10, 'celular' => 11, 'status' => 12, 'mimetype' => 13, 'tieneLogo' => 14, 'ipCreacion' => 15, 'lastUserId' => 16, 'creationDate' => 17, 'modificacionDate' => 18, ),
        self::TYPE_COLNAME       => array(JobEmpresaSuscritaTableMap::COL_ID => 0, JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID => 1, JobEmpresaSuscritaTableMap::COL_LOCATION_ID => 2, JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID => 3, JobEmpresaSuscritaTableMap::COL_HASH_CODE => 4, JobEmpresaSuscritaTableMap::COL_NOMBRE => 5, JobEmpresaSuscritaTableMap::COL_NIT => 6, JobEmpresaSuscritaTableMap::COL_EMAIL => 7, JobEmpresaSuscritaTableMap::COL_DIRECCION => 8, JobEmpresaSuscritaTableMap::COL_REPRESENTANTE => 9, JobEmpresaSuscritaTableMap::COL_TELEFONO => 10, JobEmpresaSuscritaTableMap::COL_CELULAR => 11, JobEmpresaSuscritaTableMap::COL_STATUS => 12, JobEmpresaSuscritaTableMap::COL_MIMETYPE => 13, JobEmpresaSuscritaTableMap::COL_TIENE_LOGO => 14, JobEmpresaSuscritaTableMap::COL_IP_CREACION => 15, JobEmpresaSuscritaTableMap::COL_LAST_USER_ID => 16, JobEmpresaSuscritaTableMap::COL_CREATION_DATE => 17, JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE => 18, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ENTITY_TYPE_ID' => 1, 'LOCATION_ID' => 2, 'SCRAP_EMPRESA_ID' => 3, 'HASH_CODE' => 4, 'NOMBRE' => 5, 'NIT' => 6, 'EMAIL' => 7, 'DIRECCION' => 8, 'REPRESENTANTE' => 9, 'TELEFONO' => 10, 'CELULAR' => 11, 'STATUS' => 12, 'MIMETYPE' => 13, 'TIENE_LOGO' => 14, 'IP_CREACION' => 15, 'LAST_USER_ID' => 16, 'CREATION_DATE' => 17, 'MODIFICACION_DATE' => 18, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
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
        $this->setName('job_empresa_suscrita');
        $this->setPhpName('JobEmpresaSuscrita');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobEmpresaSuscrita');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ENTITY_TYPE_ID', 'EntityTypeId', 'INTEGER', 'sys_entity_type', 'ID', true, null, null);
        $this->addForeignKey('LOCATION_ID', 'LocationId', 'INTEGER', 'sys_location', 'ID', false, null, null);
        $this->addColumn('SCRAP_EMPRESA_ID', 'ScrapEmpresaId', 'INTEGER', false, null, null);
        $this->addColumn('HASH_CODE', 'HashCode', 'VARCHAR', false, 50, null);
        $this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 500, null);
        $this->addColumn('NIT', 'Nit', 'VARCHAR', false, 50, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 200, null);
        $this->addColumn('DIRECCION', 'Direccion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('REPRESENTANTE', 'Representante', 'VARCHAR', true, 200, null);
        $this->addColumn('TELEFONO', 'Telefono', 'VARCHAR', false, 30, null);
        $this->addColumn('CELULAR', 'Celular', 'VARCHAR', false, 30, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 30, 'INITIAL');
        $this->addColumn('MIMETYPE', 'Mimetype', 'VARCHAR', false, 20, null);
        $this->addColumn('TIENE_LOGO', 'TieneLogo', 'BOOLEAN', true, 1, false);
        $this->addColumn('IP_CREACION', 'IpCreacion', 'VARCHAR', true, 20, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICACION_DATE', 'ModificacionDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysEntityType', '\\SysEntityType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ENTITY_TYPE_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysLocation', '\\SysLocation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':LOCATION_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('JobAviso', '\\JobAviso', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':EMPRESA_SUSCRITA_ID',
    1 => ':ID',
  ),
), null, null, 'JobAvisos', false);
        $this->addRelation('JobUserEmpresaSuscrita', '\\JobUserEmpresaSuscrita', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':EMPRESA_SUSCRITA_ID',
    1 => ':ID',
  ),
), null, null, 'JobUserEmpresaSuscritas', false);
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
        return $withPrefix ? JobEmpresaSuscritaTableMap::CLASS_DEFAULT : JobEmpresaSuscritaTableMap::OM_CLASS;
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
     * @return array           (JobEmpresaSuscrita object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobEmpresaSuscritaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobEmpresaSuscritaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobEmpresaSuscritaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobEmpresaSuscritaTableMap::OM_CLASS;
            /** @var JobEmpresaSuscrita $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobEmpresaSuscritaTableMap::addInstanceToPool($obj, $key);
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
            $key = JobEmpresaSuscritaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobEmpresaSuscritaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobEmpresaSuscrita $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobEmpresaSuscritaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_ID);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_HASH_CODE);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_NIT);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_EMAIL);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_REPRESENTANTE);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_TELEFONO);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_CELULAR);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_MIMETYPE);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_TIENE_LOGO);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_IP_CREACION);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ENTITY_TYPE_ID');
            $criteria->addSelectColumn($alias . '.LOCATION_ID');
            $criteria->addSelectColumn($alias . '.SCRAP_EMPRESA_ID');
            $criteria->addSelectColumn($alias . '.HASH_CODE');
            $criteria->addSelectColumn($alias . '.NOMBRE');
            $criteria->addSelectColumn($alias . '.NIT');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.DIRECCION');
            $criteria->addSelectColumn($alias . '.REPRESENTANTE');
            $criteria->addSelectColumn($alias . '.TELEFONO');
            $criteria->addSelectColumn($alias . '.CELULAR');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.MIMETYPE');
            $criteria->addSelectColumn($alias . '.TIENE_LOGO');
            $criteria->addSelectColumn($alias . '.IP_CREACION');
            $criteria->addSelectColumn($alias . '.LAST_USER_ID');
            $criteria->addSelectColumn($alias . '.CREATION_DATE');
            $criteria->addSelectColumn($alias . '.MODIFICACION_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobEmpresaSuscritaTableMap::DATABASE_NAME)->getTable(JobEmpresaSuscritaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobEmpresaSuscritaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobEmpresaSuscritaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobEmpresaSuscritaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobEmpresaSuscrita or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobEmpresaSuscrita object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobEmpresaSuscrita) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobEmpresaSuscritaTableMap::DATABASE_NAME);
            $criteria->add(JobEmpresaSuscritaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobEmpresaSuscritaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobEmpresaSuscritaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobEmpresaSuscritaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_empresa_suscrita table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobEmpresaSuscritaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobEmpresaSuscrita or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobEmpresaSuscrita object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobEmpresaSuscrita object
        }

        if ($criteria->containsKey(JobEmpresaSuscritaTableMap::COL_ID) && $criteria->keyContainsValue(JobEmpresaSuscritaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobEmpresaSuscritaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobEmpresaSuscritaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobEmpresaSuscritaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobEmpresaSuscritaTableMap::buildTableMap();
