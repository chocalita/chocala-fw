<?php

namespace Map;

use \SysUser;
use \SysUserQuery;
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
 * This class defines the structure of the 'sys_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysUserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysUser';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysUser';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'sys_user.ID';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'sys_user.EMAIL';

    /**
     * the column name for the USERNAME field
     */
    const COL_USERNAME = 'sys_user.USERNAME';

    /**
     * the column name for the PASSWORD field
     */
    const COL_PASSWORD = 'sys_user.PASSWORD';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'sys_user.STATUS';

    /**
     * the column name for the LOCATION field
     */
    const COL_LOCATION = 'sys_user.LOCATION';

    /**
     * the column name for the ADDRESS field
     */
    const COL_ADDRESS = 'sys_user.ADDRESS';

    /**
     * the column name for the IMAGE_MIME field
     */
    const COL_IMAGE_MIME = 'sys_user.IMAGE_MIME';

    /**
     * the column name for the ACTUAL_ACCESS field
     */
    const COL_ACTUAL_ACCESS = 'sys_user.ACTUAL_ACCESS';

    /**
     * the column name for the LAST_ACCESS field
     */
    const COL_LAST_ACCESS = 'sys_user.LAST_ACCESS';

    /**
     * the column name for the ACCESS_FAILURES field
     */
    const COL_ACCESS_FAILURES = 'sys_user.ACCESS_FAILURES';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'sys_user.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'sys_user.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'sys_user.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'Email', 'Username', 'Password', 'Status', 'Location', 'Address', 'ImageMime', 'ActualAccess', 'LastAccess', 'AccessFailures', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'email', 'username', 'password', 'status', 'location', 'address', 'imageMime', 'actualAccess', 'lastAccess', 'accessFailures', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(SysUserTableMap::COL_ID, SysUserTableMap::COL_EMAIL, SysUserTableMap::COL_USERNAME, SysUserTableMap::COL_PASSWORD, SysUserTableMap::COL_STATUS, SysUserTableMap::COL_LOCATION, SysUserTableMap::COL_ADDRESS, SysUserTableMap::COL_IMAGE_MIME, SysUserTableMap::COL_ACTUAL_ACCESS, SysUserTableMap::COL_LAST_ACCESS, SysUserTableMap::COL_ACCESS_FAILURES, SysUserTableMap::COL_LAST_USER_ID, SysUserTableMap::COL_CREATION_DATE, SysUserTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'EMAIL', 'USERNAME', 'PASSWORD', 'STATUS', 'LOCATION', 'ADDRESS', 'IMAGE_MIME', 'ACTUAL_ACCESS', 'LAST_ACCESS', 'ACCESS_FAILURES', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Email' => 1, 'Username' => 2, 'Password' => 3, 'Status' => 4, 'Location' => 5, 'Address' => 6, 'ImageMime' => 7, 'ActualAccess' => 8, 'LastAccess' => 9, 'AccessFailures' => 10, 'LastUserId' => 11, 'CreationDate' => 12, 'ModificationDate' => 13, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'email' => 1, 'username' => 2, 'password' => 3, 'status' => 4, 'location' => 5, 'address' => 6, 'imageMime' => 7, 'actualAccess' => 8, 'lastAccess' => 9, 'accessFailures' => 10, 'lastUserId' => 11, 'creationDate' => 12, 'modificationDate' => 13, ),
        self::TYPE_COLNAME       => array(SysUserTableMap::COL_ID => 0, SysUserTableMap::COL_EMAIL => 1, SysUserTableMap::COL_USERNAME => 2, SysUserTableMap::COL_PASSWORD => 3, SysUserTableMap::COL_STATUS => 4, SysUserTableMap::COL_LOCATION => 5, SysUserTableMap::COL_ADDRESS => 6, SysUserTableMap::COL_IMAGE_MIME => 7, SysUserTableMap::COL_ACTUAL_ACCESS => 8, SysUserTableMap::COL_LAST_ACCESS => 9, SysUserTableMap::COL_ACCESS_FAILURES => 10, SysUserTableMap::COL_LAST_USER_ID => 11, SysUserTableMap::COL_CREATION_DATE => 12, SysUserTableMap::COL_MODIFICATION_DATE => 13, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'EMAIL' => 1, 'USERNAME' => 2, 'PASSWORD' => 3, 'STATUS' => 4, 'LOCATION' => 5, 'ADDRESS' => 6, 'IMAGE_MIME' => 7, 'ACTUAL_ACCESS' => 8, 'LAST_ACCESS' => 9, 'ACCESS_FAILURES' => 10, 'LAST_USER_ID' => 11, 'CREATION_DATE' => 12, 'MODIFICATION_DATE' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
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
        $this->setName('sys_user');
        $this->setPhpName('SysUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysUser');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 80, null);
        $this->addColumn('USERNAME', 'Username', 'VARCHAR', true, 50, null);
        $this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 500, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 20, 'CREATED');
        $this->addColumn('LOCATION', 'Location', 'VARCHAR', false, 100, null);
        $this->addColumn('ADDRESS', 'Address', 'LONGVARCHAR', false, null, null);
        $this->addColumn('IMAGE_MIME', 'ImageMime', 'VARCHAR', false, 20, null);
        $this->addColumn('ACTUAL_ACCESS', 'ActualAccess', 'TIMESTAMP', false, null, null);
        $this->addColumn('LAST_ACCESS', 'LastAccess', 'TIMESTAMP', false, null, null);
        $this->addColumn('ACCESS_FAILURES', 'AccessFailures', 'INTEGER', true, null, 0);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysAuth', '\\SysAuth', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysAuths', false);
        $this->addRelation('SysEmailSent', '\\SysEmailSent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysEmailSents', false);
        $this->addRelation('SysEntityUser', '\\SysEntityUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysEntityUsers', false);
        $this->addRelation('SysEventUser', '\\SysEventUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysEventUsers', false);
        $this->addRelation('SysImage', '\\SysImage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysImages', false);
        $this->addRelation('SysPassword', '\\SysPassword', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysPasswords', false);
        $this->addRelation('SysPasswordRequest', '\\SysPasswordRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysPasswordRequests', false);
        $this->addRelation('SysPerson', '\\SysPerson', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'Syspeople', false);
        $this->addRelation('SysUserParam', '\\SysUserParam', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysUserParams', false);
        $this->addRelation('SysUserXRol', '\\SysUserXRol', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, 'SysUserXRols', false);
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
        return $withPrefix ? SysUserTableMap::CLASS_DEFAULT : SysUserTableMap::OM_CLASS;
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
     * @return array           (SysUser object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysUserTableMap::OM_CLASS;
            /** @var SysUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysUserTableMap::addInstanceToPool($obj, $key);
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
            $key = SysUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysUserTableMap::COL_ID);
            $criteria->addSelectColumn(SysUserTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SysUserTableMap::COL_USERNAME);
            $criteria->addSelectColumn(SysUserTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(SysUserTableMap::COL_STATUS);
            $criteria->addSelectColumn(SysUserTableMap::COL_LOCATION);
            $criteria->addSelectColumn(SysUserTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(SysUserTableMap::COL_IMAGE_MIME);
            $criteria->addSelectColumn(SysUserTableMap::COL_ACTUAL_ACCESS);
            $criteria->addSelectColumn(SysUserTableMap::COL_LAST_ACCESS);
            $criteria->addSelectColumn(SysUserTableMap::COL_ACCESS_FAILURES);
            $criteria->addSelectColumn(SysUserTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysUserTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysUserTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.USERNAME');
            $criteria->addSelectColumn($alias . '.PASSWORD');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.LOCATION');
            $criteria->addSelectColumn($alias . '.ADDRESS');
            $criteria->addSelectColumn($alias . '.IMAGE_MIME');
            $criteria->addSelectColumn($alias . '.ACTUAL_ACCESS');
            $criteria->addSelectColumn($alias . '.LAST_ACCESS');
            $criteria->addSelectColumn($alias . '.ACCESS_FAILURES');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysUserTableMap::DATABASE_NAME)->getTable(SysUserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysUserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysUserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysUserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysUser or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysUserTableMap::DATABASE_NAME);
            $criteria->add(SysUserTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysUser or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysUser object
        }

        if ($criteria->containsKey(SysUserTableMap::COL_ID) && $criteria->keyContainsValue(SysUserTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysUserTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysUserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysUserTableMap::buildTableMap();
