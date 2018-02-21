<?php

namespace Map;

use \SysParam;
use \SysParamQuery;
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
 * This class defines the structure of the 'sys_param' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysParamTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysParamTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_param';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysParam';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysParam';

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
    const COL_ID = 'sys_param.ID';

    /**
     * the column name for the VISIBILITY field
     */
    const COL_VISIBILITY = 'sys_param.VISIBILITY';

    /**
     * the column name for the CODE field
     */
    const COL_CODE = 'sys_param.CODE';

    /**
     * the column name for the NAME field
     */
    const COL_NAME = 'sys_param.NAME';

    /**
     * the column name for the TYPE field
     */
    const COL_TYPE = 'sys_param.TYPE';

    /**
     * the column name for the VALUE field
     */
    const COL_VALUE = 'sys_param.VALUE';

    /**
     * the column name for the OPTIONS field
     */
    const COL_OPTIONS = 'sys_param.OPTIONS';

    /**
     * the column name for the DESCRIPTION field
     */
    const COL_DESCRIPTION = 'sys_param.DESCRIPTION';

    /**
     * the column name for the CUSTOMIZABLE field
     */
    const COL_CUSTOMIZABLE = 'sys_param.CUSTOMIZABLE';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'sys_param.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'sys_param.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'sys_param.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'Visibility', 'Code', 'Name', 'Type', 'Value', 'Options', 'Description', 'Customizable', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'visibility', 'code', 'name', 'type', 'value', 'options', 'description', 'customizable', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(SysParamTableMap::COL_ID, SysParamTableMap::COL_VISIBILITY, SysParamTableMap::COL_CODE, SysParamTableMap::COL_NAME, SysParamTableMap::COL_TYPE, SysParamTableMap::COL_VALUE, SysParamTableMap::COL_OPTIONS, SysParamTableMap::COL_DESCRIPTION, SysParamTableMap::COL_CUSTOMIZABLE, SysParamTableMap::COL_LAST_USER_ID, SysParamTableMap::COL_CREATION_DATE, SysParamTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'VISIBILITY', 'CODE', 'NAME', 'TYPE', 'VALUE', 'OPTIONS', 'DESCRIPTION', 'CUSTOMIZABLE', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Visibility' => 1, 'Code' => 2, 'Name' => 3, 'Type' => 4, 'Value' => 5, 'Options' => 6, 'Description' => 7, 'Customizable' => 8, 'LastUserId' => 9, 'CreationDate' => 10, 'ModificationDate' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'visibility' => 1, 'code' => 2, 'name' => 3, 'type' => 4, 'value' => 5, 'options' => 6, 'description' => 7, 'customizable' => 8, 'lastUserId' => 9, 'creationDate' => 10, 'modificationDate' => 11, ),
        self::TYPE_COLNAME       => array(SysParamTableMap::COL_ID => 0, SysParamTableMap::COL_VISIBILITY => 1, SysParamTableMap::COL_CODE => 2, SysParamTableMap::COL_NAME => 3, SysParamTableMap::COL_TYPE => 4, SysParamTableMap::COL_VALUE => 5, SysParamTableMap::COL_OPTIONS => 6, SysParamTableMap::COL_DESCRIPTION => 7, SysParamTableMap::COL_CUSTOMIZABLE => 8, SysParamTableMap::COL_LAST_USER_ID => 9, SysParamTableMap::COL_CREATION_DATE => 10, SysParamTableMap::COL_MODIFICATION_DATE => 11, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'VISIBILITY' => 1, 'CODE' => 2, 'NAME' => 3, 'TYPE' => 4, 'VALUE' => 5, 'OPTIONS' => 6, 'DESCRIPTION' => 7, 'CUSTOMIZABLE' => 8, 'LAST_USER_ID' => 9, 'CREATION_DATE' => 10, 'MODIFICATION_DATE' => 11, ),
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
        $this->setName('sys_param');
        $this->setPhpName('SysParam');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysParam');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('VISIBILITY', 'Visibility', 'VARCHAR', true, 30, 'GLOBAL');
        $this->addColumn('CODE', 'Code', 'VARCHAR', true, 30, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('TYPE', 'Type', 'VARCHAR', true, 10, 'STRING');
        $this->addColumn('VALUE', 'Value', 'VARCHAR', true, 2000, null);
        $this->addColumn('OPTIONS', 'Options', 'VARCHAR', false, 2000, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('CUSTOMIZABLE', 'Customizable', 'BOOLEAN', true, 1, false);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysEntityParam', '\\SysEntityParam', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PARAM_ID',
    1 => ':ID',
  ),
), null, null, 'SysEntityParams', false);
        $this->addRelation('SysUserParam', '\\SysUserParam', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PARAM_ID',
    1 => ':ID',
  ),
), null, null, 'SysUserParams', false);
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
        return $withPrefix ? SysParamTableMap::CLASS_DEFAULT : SysParamTableMap::OM_CLASS;
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
     * @return array           (SysParam object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysParamTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysParamTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysParamTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysParamTableMap::OM_CLASS;
            /** @var SysParam $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysParamTableMap::addInstanceToPool($obj, $key);
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
            $key = SysParamTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysParamTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysParam $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysParamTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysParamTableMap::COL_ID);
            $criteria->addSelectColumn(SysParamTableMap::COL_VISIBILITY);
            $criteria->addSelectColumn(SysParamTableMap::COL_CODE);
            $criteria->addSelectColumn(SysParamTableMap::COL_NAME);
            $criteria->addSelectColumn(SysParamTableMap::COL_TYPE);
            $criteria->addSelectColumn(SysParamTableMap::COL_VALUE);
            $criteria->addSelectColumn(SysParamTableMap::COL_OPTIONS);
            $criteria->addSelectColumn(SysParamTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysParamTableMap::COL_CUSTOMIZABLE);
            $criteria->addSelectColumn(SysParamTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysParamTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysParamTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.VISIBILITY');
            $criteria->addSelectColumn($alias . '.CODE');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.TYPE');
            $criteria->addSelectColumn($alias . '.VALUE');
            $criteria->addSelectColumn($alias . '.OPTIONS');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.CUSTOMIZABLE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysParamTableMap::DATABASE_NAME)->getTable(SysParamTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysParamTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysParamTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysParamTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysParam or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysParam object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysParamTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysParam) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysParamTableMap::DATABASE_NAME);
            $criteria->add(SysParamTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysParamQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysParamTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysParamTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_param table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysParamQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysParam or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysParam object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysParamTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysParam object
        }

        if ($criteria->containsKey(SysParamTableMap::COL_ID) && $criteria->keyContainsValue(SysParamTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysParamTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysParamQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysParamTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysParamTableMap::buildTableMap();
