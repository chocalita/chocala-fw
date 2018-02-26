<?php

namespace Map;

use \SysPasswordRequest;
use \SysPasswordRequestQuery;
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
 * This class defines the structure of the 'sys_password_request' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysPasswordRequestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysPasswordRequestTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_password_request';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysPasswordRequest';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysPasswordRequest';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'sys_password_request.ID';

    /**
     * the column name for the USER_ID field
     */
    const COL_USER_ID = 'sys_password_request.USER_ID';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'sys_password_request.EMAIL';

    /**
     * the column name for the HASH_STRING field
     */
    const COL_HASH_STRING = 'sys_password_request.HASH_STRING';

    /**
     * the column name for the ACTIVE field
     */
    const COL_ACTIVE = 'sys_password_request.ACTIVE';

    /**
     * the column name for the LIFE_TIME field
     */
    const COL_LIFE_TIME = 'sys_password_request.LIFE_TIME';

    /**
     * the column name for the REQUEST_IP field
     */
    const COL_REQUEST_IP = 'sys_password_request.REQUEST_IP';

    /**
     * the column name for the RESTORED_IP field
     */
    const COL_RESTORED_IP = 'sys_password_request.RESTORED_IP';

    /**
     * the column name for the ACCEDED_TIMES field
     */
    const COL_ACCEDED_TIMES = 'sys_password_request.ACCEDED_TIMES';

    /**
     * the column name for the REQUESTED_DATE field
     */
    const COL_REQUESTED_DATE = 'sys_password_request.REQUESTED_DATE';

    /**
     * the column name for the RESTORED_DATE field
     */
    const COL_RESTORED_DATE = 'sys_password_request.RESTORED_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'UserId', 'Email', 'HashString', 'Active', 'LifeTime', 'RequestIp', 'RestoredIp', 'AccededTimes', 'RequestedDate', 'RestoredDate', ),
        self::TYPE_CAMELNAME     => array('id', 'userId', 'email', 'hashString', 'active', 'lifeTime', 'requestIp', 'restoredIp', 'accededTimes', 'requestedDate', 'restoredDate', ),
        self::TYPE_COLNAME       => array(SysPasswordRequestTableMap::COL_ID, SysPasswordRequestTableMap::COL_USER_ID, SysPasswordRequestTableMap::COL_EMAIL, SysPasswordRequestTableMap::COL_HASH_STRING, SysPasswordRequestTableMap::COL_ACTIVE, SysPasswordRequestTableMap::COL_LIFE_TIME, SysPasswordRequestTableMap::COL_REQUEST_IP, SysPasswordRequestTableMap::COL_RESTORED_IP, SysPasswordRequestTableMap::COL_ACCEDED_TIMES, SysPasswordRequestTableMap::COL_REQUESTED_DATE, SysPasswordRequestTableMap::COL_RESTORED_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'USER_ID', 'EMAIL', 'HASH_STRING', 'ACTIVE', 'LIFE_TIME', 'REQUEST_IP', 'RESTORED_IP', 'ACCEDED_TIMES', 'REQUESTED_DATE', 'RESTORED_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserId' => 1, 'Email' => 2, 'HashString' => 3, 'Active' => 4, 'LifeTime' => 5, 'RequestIp' => 6, 'RestoredIp' => 7, 'AccededTimes' => 8, 'RequestedDate' => 9, 'RestoredDate' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userId' => 1, 'email' => 2, 'hashString' => 3, 'active' => 4, 'lifeTime' => 5, 'requestIp' => 6, 'restoredIp' => 7, 'accededTimes' => 8, 'requestedDate' => 9, 'restoredDate' => 10, ),
        self::TYPE_COLNAME       => array(SysPasswordRequestTableMap::COL_ID => 0, SysPasswordRequestTableMap::COL_USER_ID => 1, SysPasswordRequestTableMap::COL_EMAIL => 2, SysPasswordRequestTableMap::COL_HASH_STRING => 3, SysPasswordRequestTableMap::COL_ACTIVE => 4, SysPasswordRequestTableMap::COL_LIFE_TIME => 5, SysPasswordRequestTableMap::COL_REQUEST_IP => 6, SysPasswordRequestTableMap::COL_RESTORED_IP => 7, SysPasswordRequestTableMap::COL_ACCEDED_TIMES => 8, SysPasswordRequestTableMap::COL_REQUESTED_DATE => 9, SysPasswordRequestTableMap::COL_RESTORED_DATE => 10, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'USER_ID' => 1, 'EMAIL' => 2, 'HASH_STRING' => 3, 'ACTIVE' => 4, 'LIFE_TIME' => 5, 'REQUEST_IP' => 6, 'RESTORED_IP' => 7, 'ACCEDED_TIMES' => 8, 'REQUESTED_DATE' => 9, 'RESTORED_DATE' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('sys_password_request');
        $this->setPhpName('SysPasswordRequest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysPasswordRequest');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 200, null);
        $this->addColumn('HASH_STRING', 'HashString', 'VARCHAR', true, 500, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, 1, true);
        $this->addColumn('LIFE_TIME', 'LifeTime', 'INTEGER', true, null, null);
        $this->addColumn('REQUEST_IP', 'RequestIp', 'VARCHAR', true, 30, null);
        $this->addColumn('RESTORED_IP', 'RestoredIp', 'VARCHAR', false, 30, null);
        $this->addColumn('ACCEDED_TIMES', 'AccededTimes', 'INTEGER', true, null, 0);
        $this->addColumn('REQUESTED_DATE', 'RequestedDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('RESTORED_DATE', 'RestoredDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysUser', '\\SysUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysPassword', '\\SysPassword', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PASSWORD_REQUEST_ID',
    1 => ':ID',
  ),
), null, null, 'SysPasswords', false);
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
        return $withPrefix ? SysPasswordRequestTableMap::CLASS_DEFAULT : SysPasswordRequestTableMap::OM_CLASS;
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
     * @return array           (SysPasswordRequest object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysPasswordRequestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysPasswordRequestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysPasswordRequestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysPasswordRequestTableMap::OM_CLASS;
            /** @var SysPasswordRequest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysPasswordRequestTableMap::addInstanceToPool($obj, $key);
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
            $key = SysPasswordRequestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysPasswordRequestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysPasswordRequest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysPasswordRequestTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_ID);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_HASH_STRING);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_LIFE_TIME);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_REQUEST_IP);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_RESTORED_IP);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_ACCEDED_TIMES);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_REQUESTED_DATE);
            $criteria->addSelectColumn(SysPasswordRequestTableMap::COL_RESTORED_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.HASH_STRING');
            $criteria->addSelectColumn($alias . '.ACTIVE');
            $criteria->addSelectColumn($alias . '.LIFE_TIME');
            $criteria->addSelectColumn($alias . '.REQUEST_IP');
            $criteria->addSelectColumn($alias . '.RESTORED_IP');
            $criteria->addSelectColumn($alias . '.ACCEDED_TIMES');
            $criteria->addSelectColumn($alias . '.REQUESTED_DATE');
            $criteria->addSelectColumn($alias . '.RESTORED_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysPasswordRequestTableMap::DATABASE_NAME)->getTable(SysPasswordRequestTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysPasswordRequestTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysPasswordRequestTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysPasswordRequestTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysPasswordRequest or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysPasswordRequest object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordRequestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysPasswordRequest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysPasswordRequestTableMap::DATABASE_NAME);
            $criteria->add(SysPasswordRequestTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysPasswordRequestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysPasswordRequestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysPasswordRequestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_password_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysPasswordRequestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysPasswordRequest or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysPasswordRequest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordRequestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysPasswordRequest object
        }

        if ($criteria->containsKey(SysPasswordRequestTableMap::COL_ID) && $criteria->keyContainsValue(SysPasswordRequestTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysPasswordRequestTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysPasswordRequestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysPasswordRequestTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysPasswordRequestTableMap::buildTableMap();
