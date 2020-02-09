<?php

namespace Map;

use \SysLocation;
use \SysLocationQuery;
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
 * This class defines the structure of the 'sys_location' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysLocationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysLocationTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_location';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysLocation';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysLocation';

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
    const COL_ID = 'sys_location.ID';

    /**
     * the column name for the MAIN_ID field
     */
    const COL_MAIN_ID = 'sys_location.MAIN_ID';

    /**
     * the column name for the CODE field
     */
    const COL_CODE = 'sys_location.CODE';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'sys_location.STATUS';

    /**
     * the column name for the NAME field
     */
    const COL_NAME = 'sys_location.NAME';

    /**
     * the column name for the TYPE field
     */
    const COL_TYPE = 'sys_location.TYPE';

    /**
     * the column name for the LEVEL field
     */
    const COL_LEVEL = 'sys_location.LEVEL';

    /**
     * the column name for the LFT field
     */
    const COL_LFT = 'sys_location.LFT';

    /**
     * the column name for the RGT field
     */
    const COL_RGT = 'sys_location.RGT';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'sys_location.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'sys_location.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'sys_location.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'MainId', 'Code', 'Status', 'Name', 'Type', 'Level', 'Lft', 'Rgt', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'mainId', 'code', 'status', 'name', 'type', 'level', 'lft', 'rgt', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(SysLocationTableMap::COL_ID, SysLocationTableMap::COL_MAIN_ID, SysLocationTableMap::COL_CODE, SysLocationTableMap::COL_STATUS, SysLocationTableMap::COL_NAME, SysLocationTableMap::COL_TYPE, SysLocationTableMap::COL_LEVEL, SysLocationTableMap::COL_LFT, SysLocationTableMap::COL_RGT, SysLocationTableMap::COL_LAST_USER_ID, SysLocationTableMap::COL_CREATION_DATE, SysLocationTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'MAIN_ID', 'CODE', 'STATUS', 'NAME', 'TYPE', 'LEVEL', 'LFT', 'RGT', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'MainId' => 1, 'Code' => 2, 'Status' => 3, 'Name' => 4, 'Type' => 5, 'Level' => 6, 'Lft' => 7, 'Rgt' => 8, 'LastUserId' => 9, 'CreationDate' => 10, 'ModificationDate' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'mainId' => 1, 'code' => 2, 'status' => 3, 'name' => 4, 'type' => 5, 'level' => 6, 'lft' => 7, 'rgt' => 8, 'lastUserId' => 9, 'creationDate' => 10, 'modificationDate' => 11, ),
        self::TYPE_COLNAME       => array(SysLocationTableMap::COL_ID => 0, SysLocationTableMap::COL_MAIN_ID => 1, SysLocationTableMap::COL_CODE => 2, SysLocationTableMap::COL_STATUS => 3, SysLocationTableMap::COL_NAME => 4, SysLocationTableMap::COL_TYPE => 5, SysLocationTableMap::COL_LEVEL => 6, SysLocationTableMap::COL_LFT => 7, SysLocationTableMap::COL_RGT => 8, SysLocationTableMap::COL_LAST_USER_ID => 9, SysLocationTableMap::COL_CREATION_DATE => 10, SysLocationTableMap::COL_MODIFICATION_DATE => 11, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'MAIN_ID' => 1, 'CODE' => 2, 'STATUS' => 3, 'NAME' => 4, 'TYPE' => 5, 'LEVEL' => 6, 'LFT' => 7, 'RGT' => 8, 'LAST_USER_ID' => 9, 'CREATION_DATE' => 10, 'MODIFICATION_DATE' => 11, ),
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
        $this->setName('sys_location');
        $this->setPhpName('SysLocation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysLocation');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('MAIN_ID', 'MainId', 'INTEGER', false, null, null);
        $this->addColumn('CODE', 'Code', 'VARCHAR', true, 30, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 30, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 200, null);
        $this->addColumn('TYPE', 'Type', 'VARCHAR', true, 30, null);
        $this->addColumn('LEVEL', 'Level', 'INTEGER', true, null, null);
        $this->addColumn('LFT', 'Lft', 'INTEGER', false, null, null);
        $this->addColumn('RGT', 'Rgt', 'INTEGER', false, null, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, null);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysEntity', '\\SysEntity', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':LOCATION_ID',
    1 => ':ID',
  ),
), null, null, 'SysEntities', false);
        $this->addRelation('SysEntityBranch', '\\SysEntityBranch', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':LOCATION_ID',
    1 => ':ID',
  ),
), null, null, 'SysEntityBranches', false);
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
        return $withPrefix ? SysLocationTableMap::CLASS_DEFAULT : SysLocationTableMap::OM_CLASS;
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
     * @return array           (SysLocation object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysLocationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysLocationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysLocationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysLocationTableMap::OM_CLASS;
            /** @var SysLocation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysLocationTableMap::addInstanceToPool($obj, $key);
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
            $key = SysLocationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysLocationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysLocation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysLocationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysLocationTableMap::COL_ID);
            $criteria->addSelectColumn(SysLocationTableMap::COL_MAIN_ID);
            $criteria->addSelectColumn(SysLocationTableMap::COL_CODE);
            $criteria->addSelectColumn(SysLocationTableMap::COL_STATUS);
            $criteria->addSelectColumn(SysLocationTableMap::COL_NAME);
            $criteria->addSelectColumn(SysLocationTableMap::COL_TYPE);
            $criteria->addSelectColumn(SysLocationTableMap::COL_LEVEL);
            $criteria->addSelectColumn(SysLocationTableMap::COL_LFT);
            $criteria->addSelectColumn(SysLocationTableMap::COL_RGT);
            $criteria->addSelectColumn(SysLocationTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysLocationTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysLocationTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.MAIN_ID');
            $criteria->addSelectColumn($alias . '.CODE');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.TYPE');
            $criteria->addSelectColumn($alias . '.LEVEL');
            $criteria->addSelectColumn($alias . '.LFT');
            $criteria->addSelectColumn($alias . '.RGT');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysLocationTableMap::DATABASE_NAME)->getTable(SysLocationTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysLocationTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysLocationTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysLocationTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysLocation or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysLocation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysLocationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysLocation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysLocationTableMap::DATABASE_NAME);
            $criteria->add(SysLocationTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysLocationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysLocationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysLocationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_location table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysLocationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysLocation or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysLocation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysLocationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysLocation object
        }

        if ($criteria->containsKey(SysLocationTableMap::COL_ID) && $criteria->keyContainsValue(SysLocationTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysLocationTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysLocationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysLocationTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysLocationTableMap::buildTableMap();
