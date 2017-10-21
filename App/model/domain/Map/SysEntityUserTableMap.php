<?php

namespace Map;

use \SysEntityUser;
use \SysEntityUserQuery;
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
 * This class defines the structure of the 'sys_entity_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysEntityUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysEntityUserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_entity_user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysEntityUser';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysEntityUser';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'sys_entity_user.ID';

    /**
     * the column name for the ENTITY_ID field
     */
    const COL_ENTITY_ID = 'sys_entity_user.ENTITY_ID';

    /**
     * the column name for the USER_ID field
     */
    const COL_USER_ID = 'sys_entity_user.USER_ID';

    /**
     * the column name for the ROL_ID field
     */
    const COL_ROL_ID = 'sys_entity_user.ROL_ID';

    /**
     * the column name for the ACTIVE field
     */
    const COL_ACTIVE = 'sys_entity_user.ACTIVE';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'sys_entity_user.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'sys_entity_user.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'sys_entity_user.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'EntityId', 'UserId', 'RolId', 'Active', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'entityId', 'userId', 'rolId', 'active', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(SysEntityUserTableMap::COL_ID, SysEntityUserTableMap::COL_ENTITY_ID, SysEntityUserTableMap::COL_USER_ID, SysEntityUserTableMap::COL_ROL_ID, SysEntityUserTableMap::COL_ACTIVE, SysEntityUserTableMap::COL_LAST_USER_ID, SysEntityUserTableMap::COL_CREATION_DATE, SysEntityUserTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'ENTITY_ID', 'USER_ID', 'ROL_ID', 'ACTIVE', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'EntityId' => 1, 'UserId' => 2, 'RolId' => 3, 'Active' => 4, 'LastUserId' => 5, 'CreationDate' => 6, 'ModificationDate' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'entityId' => 1, 'userId' => 2, 'rolId' => 3, 'active' => 4, 'lastUserId' => 5, 'creationDate' => 6, 'modificationDate' => 7, ),
        self::TYPE_COLNAME       => array(SysEntityUserTableMap::COL_ID => 0, SysEntityUserTableMap::COL_ENTITY_ID => 1, SysEntityUserTableMap::COL_USER_ID => 2, SysEntityUserTableMap::COL_ROL_ID => 3, SysEntityUserTableMap::COL_ACTIVE => 4, SysEntityUserTableMap::COL_LAST_USER_ID => 5, SysEntityUserTableMap::COL_CREATION_DATE => 6, SysEntityUserTableMap::COL_MODIFICATION_DATE => 7, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ENTITY_ID' => 1, 'USER_ID' => 2, 'ROL_ID' => 3, 'ACTIVE' => 4, 'LAST_USER_ID' => 5, 'CREATION_DATE' => 6, 'MODIFICATION_DATE' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('sys_entity_user');
        $this->setPhpName('SysEntityUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysEntityUser');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ENTITY_ID', 'EntityId', 'INTEGER', 'sys_entity', 'ID', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addForeignKey('ROL_ID', 'RolId', 'INTEGER', 'sys_rol', 'ID', true, null, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, 1, true);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysEntity', '\\SysEntity', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ENTITY_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysRol', '\\SysRol', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ROL_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysUser', '\\SysUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
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
        return $withPrefix ? SysEntityUserTableMap::CLASS_DEFAULT : SysEntityUserTableMap::OM_CLASS;
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
     * @return array           (SysEntityUser object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysEntityUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysEntityUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysEntityUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysEntityUserTableMap::OM_CLASS;
            /** @var SysEntityUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysEntityUserTableMap::addInstanceToPool($obj, $key);
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
            $key = SysEntityUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysEntityUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysEntityUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysEntityUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_ID);
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_ENTITY_ID);
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_ROL_ID);
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysEntityUserTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ENTITY_ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.ROL_ID');
            $criteria->addSelectColumn($alias . '.ACTIVE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysEntityUserTableMap::DATABASE_NAME)->getTable(SysEntityUserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysEntityUserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysEntityUserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysEntityUserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysEntityUser or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysEntityUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysEntityUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysEntityUserTableMap::DATABASE_NAME);
            $criteria->add(SysEntityUserTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysEntityUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysEntityUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysEntityUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_entity_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysEntityUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysEntityUser or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysEntityUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysEntityUser object
        }

        if ($criteria->containsKey(SysEntityUserTableMap::COL_ID) && $criteria->keyContainsValue(SysEntityUserTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysEntityUserTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysEntityUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysEntityUserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysEntityUserTableMap::buildTableMap();
