<?php

namespace Map;

use \JobAreaTecnicaProfesion;
use \JobAreaTecnicaProfesionQuery;
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
 * This class defines the structure of the 'job_area_tecnica_profesion' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobAreaTecnicaProfesionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobAreaTecnicaProfesionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_area_tecnica_profesion';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobAreaTecnicaProfesion';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobAreaTecnicaProfesion';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the ID_AREA_TECNICA field
     */
    const COL_ID_AREA_TECNICA = 'job_area_tecnica_profesion.ID_AREA_TECNICA';

    /**
     * the column name for the ID_PROFESION field
     */
    const COL_ID_PROFESION = 'job_area_tecnica_profesion.ID_PROFESION';

    /**
     * the column name for the NIVEL field
     */
    const COL_NIVEL = 'job_area_tecnica_profesion.NIVEL';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_area_tecnica_profesion.STATUS';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_area_tecnica_profesion.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_area_tecnica_profesion.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_area_tecnica_profesion.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('IdAreaTecnica', 'IdProfesion', 'Nivel', 'Status', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('idAreaTecnica', 'idProfesion', 'nivel', 'status', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, JobAreaTecnicaProfesionTableMap::COL_NIVEL, JobAreaTecnicaProfesionTableMap::COL_STATUS, JobAreaTecnicaProfesionTableMap::COL_LAST_USER_ID, JobAreaTecnicaProfesionTableMap::COL_CREATION_DATE, JobAreaTecnicaProfesionTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID_AREA_TECNICA', 'ID_PROFESION', 'NIVEL', 'STATUS', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdAreaTecnica' => 0, 'IdProfesion' => 1, 'Nivel' => 2, 'Status' => 3, 'LastUserId' => 4, 'CreationDate' => 5, 'ModificationDate' => 6, ),
        self::TYPE_CAMELNAME     => array('idAreaTecnica' => 0, 'idProfesion' => 1, 'nivel' => 2, 'status' => 3, 'lastUserId' => 4, 'creationDate' => 5, 'modificationDate' => 6, ),
        self::TYPE_COLNAME       => array(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA => 0, JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION => 1, JobAreaTecnicaProfesionTableMap::COL_NIVEL => 2, JobAreaTecnicaProfesionTableMap::COL_STATUS => 3, JobAreaTecnicaProfesionTableMap::COL_LAST_USER_ID => 4, JobAreaTecnicaProfesionTableMap::COL_CREATION_DATE => 5, JobAreaTecnicaProfesionTableMap::COL_MODIFICATION_DATE => 6, ),
        self::TYPE_FIELDNAME     => array('ID_AREA_TECNICA' => 0, 'ID_PROFESION' => 1, 'NIVEL' => 2, 'STATUS' => 3, 'LAST_USER_ID' => 4, 'CREATION_DATE' => 5, 'MODIFICATION_DATE' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('job_area_tecnica_profesion');
        $this->setPhpName('JobAreaTecnicaProfesion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobAreaTecnicaProfesion');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('ID_AREA_TECNICA', 'IdAreaTecnica', 'INTEGER' , 'job_area_tecnica', 'ID', true, null, null);
        $this->addForeignPrimaryKey('ID_PROFESION', 'IdProfesion', 'INTEGER' , 'job_profesion', 'ID', true, null, null);
        $this->addColumn('NIVEL', 'Nivel', 'INTEGER', true, null, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 10, 'ACTIVE');
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobAreaTecnica', '\\JobAreaTecnica', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_AREA_TECNICA',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('JobProfesion', '\\JobProfesion', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_PROFESION',
    1 => ':ID',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \JobAreaTecnicaProfesion $obj A \JobAreaTecnicaProfesion object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getIdAreaTecnica() || is_scalar($obj->getIdAreaTecnica()) || is_callable([$obj->getIdAreaTecnica(), '__toString']) ? (string) $obj->getIdAreaTecnica() : $obj->getIdAreaTecnica()), (null === $obj->getIdProfesion() || is_scalar($obj->getIdProfesion()) || is_callable([$obj->getIdProfesion(), '__toString']) ? (string) $obj->getIdProfesion() : $obj->getIdProfesion())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \JobAreaTecnicaProfesion object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \JobAreaTecnicaProfesion) {
                $key = serialize([(null === $value->getIdAreaTecnica() || is_scalar($value->getIdAreaTecnica()) || is_callable([$value->getIdAreaTecnica(), '__toString']) ? (string) $value->getIdAreaTecnica() : $value->getIdAreaTecnica()), (null === $value->getIdProfesion() || is_scalar($value->getIdProfesion()) || is_callable([$value->getIdProfesion(), '__toString']) ? (string) $value->getIdProfesion() : $value->getIdProfesion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \JobAreaTecnicaProfesion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAreaTecnica', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAreaTecnica', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAreaTecnica', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAreaTecnica', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAreaTecnica', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAreaTecnica', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdAreaTecnica', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? JobAreaTecnicaProfesionTableMap::CLASS_DEFAULT : JobAreaTecnicaProfesionTableMap::OM_CLASS;
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
     * @return array           (JobAreaTecnicaProfesion object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobAreaTecnicaProfesionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobAreaTecnicaProfesionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobAreaTecnicaProfesionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobAreaTecnicaProfesionTableMap::OM_CLASS;
            /** @var JobAreaTecnicaProfesion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobAreaTecnicaProfesionTableMap::addInstanceToPool($obj, $key);
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
            $key = JobAreaTecnicaProfesionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobAreaTecnicaProfesionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobAreaTecnicaProfesion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobAreaTecnicaProfesionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA);
            $criteria->addSelectColumn(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION);
            $criteria->addSelectColumn(JobAreaTecnicaProfesionTableMap::COL_NIVEL);
            $criteria->addSelectColumn(JobAreaTecnicaProfesionTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobAreaTecnicaProfesionTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobAreaTecnicaProfesionTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobAreaTecnicaProfesionTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID_AREA_TECNICA');
            $criteria->addSelectColumn($alias . '.ID_PROFESION');
            $criteria->addSelectColumn($alias . '.NIVEL');
            $criteria->addSelectColumn($alias . '.STATUS');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobAreaTecnicaProfesionTableMap::DATABASE_NAME)->getTable(JobAreaTecnicaProfesionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobAreaTecnicaProfesionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobAreaTecnicaProfesionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobAreaTecnicaProfesion or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobAreaTecnicaProfesion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobAreaTecnicaProfesion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = JobAreaTecnicaProfesionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobAreaTecnicaProfesionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobAreaTecnicaProfesionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_area_tecnica_profesion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobAreaTecnicaProfesionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobAreaTecnicaProfesion or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobAreaTecnicaProfesion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobAreaTecnicaProfesion object
        }


        // Set the correct dbName
        $query = JobAreaTecnicaProfesionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobAreaTecnicaProfesionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobAreaTecnicaProfesionTableMap::buildTableMap();
