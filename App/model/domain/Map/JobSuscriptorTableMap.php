<?php

namespace Map;

use \JobSuscriptor;
use \JobSuscriptorQuery;
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
 * This class defines the structure of the 'job_suscriptor' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobSuscriptorTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobSuscriptorTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_suscriptor';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobSuscriptor';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobSuscriptor';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_suscriptor.ID';

    /**
     * the column name for the ID_TMP_AREA field
     */
    const COL_ID_TMP_AREA = 'job_suscriptor.ID_TMP_AREA';

    /**
     * the column name for the ID_TMP_FORMACION field
     */
    const COL_ID_TMP_FORMACION = 'job_suscriptor.ID_TMP_FORMACION';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'job_suscriptor.EMAIL';

    /**
     * the column name for the NOMBRE_SIMPLE field
     */
    const COL_NOMBRE_SIMPLE = 'job_suscriptor.NOMBRE_SIMPLE';

    /**
     * the column name for the NOMBRES field
     */
    const COL_NOMBRES = 'job_suscriptor.NOMBRES';

    /**
     * the column name for the APELLIDOS field
     */
    const COL_APELLIDOS = 'job_suscriptor.APELLIDOS';

    /**
     * the column name for the UBICACION field
     */
    const COL_UBICACION = 'job_suscriptor.UBICACION';

    /**
     * the column name for the IP field
     */
    const COL_IP = 'job_suscriptor.IP';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_suscriptor.STATUS';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_suscriptor.CREATION_DATE';

    /**
     * the column name for the CONFIRMATION field
     */
    const COL_CONFIRMATION = 'job_suscriptor.CONFIRMATION';

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
        self::TYPE_PHPNAME       => array('Id', 'IdTmpArea', 'IdTmpFormacion', 'Email', 'NombreSimple', 'Nombres', 'Apellidos', 'Ubicacion', 'Ip', 'Status', 'CreationDate', 'Confirmation', ),
        self::TYPE_CAMELNAME     => array('id', 'idTmpArea', 'idTmpFormacion', 'email', 'nombreSimple', 'nombres', 'apellidos', 'ubicacion', 'ip', 'status', 'creationDate', 'confirmation', ),
        self::TYPE_COLNAME       => array(JobSuscriptorTableMap::COL_ID, JobSuscriptorTableMap::COL_ID_TMP_AREA, JobSuscriptorTableMap::COL_ID_TMP_FORMACION, JobSuscriptorTableMap::COL_EMAIL, JobSuscriptorTableMap::COL_NOMBRE_SIMPLE, JobSuscriptorTableMap::COL_NOMBRES, JobSuscriptorTableMap::COL_APELLIDOS, JobSuscriptorTableMap::COL_UBICACION, JobSuscriptorTableMap::COL_IP, JobSuscriptorTableMap::COL_STATUS, JobSuscriptorTableMap::COL_CREATION_DATE, JobSuscriptorTableMap::COL_CONFIRMATION, ),
        self::TYPE_FIELDNAME     => array('ID', 'ID_TMP_AREA', 'ID_TMP_FORMACION', 'EMAIL', 'NOMBRE_SIMPLE', 'NOMBRES', 'APELLIDOS', 'UBICACION', 'IP', 'STATUS', 'CREATION_DATE', 'CONFIRMATION', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdTmpArea' => 1, 'IdTmpFormacion' => 2, 'Email' => 3, 'NombreSimple' => 4, 'Nombres' => 5, 'Apellidos' => 6, 'Ubicacion' => 7, 'Ip' => 8, 'Status' => 9, 'CreationDate' => 10, 'Confirmation' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idTmpArea' => 1, 'idTmpFormacion' => 2, 'email' => 3, 'nombreSimple' => 4, 'nombres' => 5, 'apellidos' => 6, 'ubicacion' => 7, 'ip' => 8, 'status' => 9, 'creationDate' => 10, 'confirmation' => 11, ),
        self::TYPE_COLNAME       => array(JobSuscriptorTableMap::COL_ID => 0, JobSuscriptorTableMap::COL_ID_TMP_AREA => 1, JobSuscriptorTableMap::COL_ID_TMP_FORMACION => 2, JobSuscriptorTableMap::COL_EMAIL => 3, JobSuscriptorTableMap::COL_NOMBRE_SIMPLE => 4, JobSuscriptorTableMap::COL_NOMBRES => 5, JobSuscriptorTableMap::COL_APELLIDOS => 6, JobSuscriptorTableMap::COL_UBICACION => 7, JobSuscriptorTableMap::COL_IP => 8, JobSuscriptorTableMap::COL_STATUS => 9, JobSuscriptorTableMap::COL_CREATION_DATE => 10, JobSuscriptorTableMap::COL_CONFIRMATION => 11, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ID_TMP_AREA' => 1, 'ID_TMP_FORMACION' => 2, 'EMAIL' => 3, 'NOMBRE_SIMPLE' => 4, 'NOMBRES' => 5, 'APELLIDOS' => 6, 'UBICACION' => 7, 'IP' => 8, 'STATUS' => 9, 'CREATION_DATE' => 10, 'CONFIRMATION' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('job_suscriptor');
        $this->setPhpName('JobSuscriptor');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobSuscriptor');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_TMP_AREA', 'IdTmpArea', 'INTEGER', 'tmp_area', 'id', false, null, null);
        $this->addForeignKey('ID_TMP_FORMACION', 'IdTmpFormacion', 'INTEGER', 'tmp_formacion', 'id', true, null, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 200, null);
        $this->addColumn('NOMBRE_SIMPLE', 'NombreSimple', 'VARCHAR', true, 100, null);
        $this->addColumn('NOMBRES', 'Nombres', 'VARCHAR', false, 50, null);
        $this->addColumn('APELLIDOS', 'Apellidos', 'VARCHAR', false, 50, null);
        $this->addColumn('UBICACION', 'Ubicacion', 'VARCHAR', false, 30, null);
        $this->addColumn('IP', 'Ip', 'VARCHAR', true, 50, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 30, 'INICIADO');
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('CONFIRMATION', 'Confirmation', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TmpArea', '\\TmpArea', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_TMP_AREA',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('TmpFormacion', '\\TmpFormacion', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_TMP_FORMACION',
    1 => ':id',
  ),
), null, null, null, false);
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

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return $withPrefix ? JobSuscriptorTableMap::CLASS_DEFAULT : JobSuscriptorTableMap::OM_CLASS;
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
     * @return array           (JobSuscriptor object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobSuscriptorTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobSuscriptorTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobSuscriptorTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobSuscriptorTableMap::OM_CLASS;
            /** @var JobSuscriptor $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobSuscriptorTableMap::addInstanceToPool($obj, $key);
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
            $key = JobSuscriptorTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobSuscriptorTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobSuscriptor $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobSuscriptorTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_ID);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_ID_TMP_AREA);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_ID_TMP_FORMACION);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_EMAIL);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_NOMBRE_SIMPLE);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_NOMBRES);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_APELLIDOS);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_UBICACION);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_IP);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobSuscriptorTableMap::COL_CONFIRMATION);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ID_TMP_AREA');
            $criteria->addSelectColumn($alias . '.ID_TMP_FORMACION');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.NOMBRE_SIMPLE');
            $criteria->addSelectColumn($alias . '.NOMBRES');
            $criteria->addSelectColumn($alias . '.APELLIDOS');
            $criteria->addSelectColumn($alias . '.UBICACION');
            $criteria->addSelectColumn($alias . '.IP');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.CREATION_DATE');
            $criteria->addSelectColumn($alias . '.CONFIRMATION');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobSuscriptorTableMap::DATABASE_NAME)->getTable(JobSuscriptorTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobSuscriptorTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobSuscriptorTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobSuscriptorTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobSuscriptor or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobSuscriptor object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobSuscriptorTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobSuscriptor) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobSuscriptorTableMap::DATABASE_NAME);
            $criteria->add(JobSuscriptorTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobSuscriptorQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobSuscriptorTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobSuscriptorTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_suscriptor table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobSuscriptorQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobSuscriptor or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobSuscriptor object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSuscriptorTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobSuscriptor object
        }

        if ($criteria->containsKey(JobSuscriptorTableMap::COL_ID) && $criteria->keyContainsValue(JobSuscriptorTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobSuscriptorTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobSuscriptorQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobSuscriptorTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobSuscriptorTableMap::buildTableMap();
