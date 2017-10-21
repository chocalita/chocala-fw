<?php

namespace Map;

use \JobStudent;
use \JobStudentQuery;
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
 * This class defines the structure of the 'job_student' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobStudentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobStudentTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_student';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobStudent';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobStudent';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_student.ID';

    /**
     * the column name for the NAME field
     */
    const COL_NAME = 'job_student.NAME';

    /**
     * the column name for the LASTNAME field
     */
    const COL_LASTNAME = 'job_student.LASTNAME';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_student.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_student.MODIFICATION_DATE';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_student.STATUS';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Lastname', 'CreationDate', 'ModificationDate', 'Status', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'lastname', 'creationDate', 'modificationDate', 'status', ),
        self::TYPE_COLNAME       => array(JobStudentTableMap::COL_ID, JobStudentTableMap::COL_NAME, JobStudentTableMap::COL_LASTNAME, JobStudentTableMap::COL_CREATION_DATE, JobStudentTableMap::COL_MODIFICATION_DATE, JobStudentTableMap::COL_STATUS, ),
        self::TYPE_FIELDNAME     => array('ID', 'NAME', 'LASTNAME', 'CREATION_DATE', 'MODIFICATION_DATE', 'STATUS', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Lastname' => 2, 'CreationDate' => 3, 'ModificationDate' => 4, 'Status' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'lastname' => 2, 'creationDate' => 3, 'modificationDate' => 4, 'status' => 5, ),
        self::TYPE_COLNAME       => array(JobStudentTableMap::COL_ID => 0, JobStudentTableMap::COL_NAME => 1, JobStudentTableMap::COL_LASTNAME => 2, JobStudentTableMap::COL_CREATION_DATE => 3, JobStudentTableMap::COL_MODIFICATION_DATE => 4, JobStudentTableMap::COL_STATUS => 5, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'NAME' => 1, 'LASTNAME' => 2, 'CREATION_DATE' => 3, 'MODIFICATION_DATE' => 4, 'STATUS' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('job_student');
        $this->setPhpName('JobStudent');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobStudent');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', false, 20, null);
        $this->addColumn('LASTNAME', 'Lastname', 'VARCHAR', false, 20, null);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('STATUS', 'Status', 'VARCHAR', false, 20, null);
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
        return $withPrefix ? JobStudentTableMap::CLASS_DEFAULT : JobStudentTableMap::OM_CLASS;
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
     * @return array           (JobStudent object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobStudentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobStudentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobStudentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobStudentTableMap::OM_CLASS;
            /** @var JobStudent $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobStudentTableMap::addInstanceToPool($obj, $key);
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
            $key = JobStudentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobStudentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobStudent $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobStudentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobStudentTableMap::COL_ID);
            $criteria->addSelectColumn(JobStudentTableMap::COL_NAME);
            $criteria->addSelectColumn(JobStudentTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(JobStudentTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobStudentTableMap::COL_MODIFICATION_DATE);
            $criteria->addSelectColumn(JobStudentTableMap::COL_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.LASTNAME');
            $criteria->addSelectColumn($alias . '.CREATION_DATE');
            $criteria->addSelectColumn($alias . '.MODIFICATION_DATE');
            $criteria->addSelectColumn($alias . '.STATUS');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobStudentTableMap::DATABASE_NAME)->getTable(JobStudentTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobStudentTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobStudentTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobStudentTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobStudent or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobStudent object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobStudentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobStudent) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobStudentTableMap::DATABASE_NAME);
            $criteria->add(JobStudentTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobStudentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobStudentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobStudentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_student table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobStudentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobStudent or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobStudent object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobStudentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobStudent object
        }

        if ($criteria->containsKey(JobStudentTableMap::COL_ID) && $criteria->keyContainsValue(JobStudentTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobStudentTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobStudentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobStudentTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobStudentTableMap::buildTableMap();
