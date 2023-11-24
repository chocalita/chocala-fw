<?php

namespace App\model\domain\Map;

use App\model\domain\SysUri;
use App\model\domain\SysUriQuery;
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
 * This class defines the structure of the 'sys_uri' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysUriTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.model.domain.Map.SysUriTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_uri';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\model\\domain\\SysUri';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.model.domain.SysUri';

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
    const COL_ID = 'sys_uri.ID';

    /**
     * the column name for the MODULE_ID field
     */
    const COL_MODULE_ID = 'sys_uri.MODULE_ID';

    /**
     * the column name for the URI field
     */
    const COL_URI = 'sys_uri.URI';

    /**
     * the column name for the TITLE field
     */
    const COL_TITLE = 'sys_uri.TITLE';

    /**
     * the column name for the ACCESS field
     */
    const COL_ACCESS = 'sys_uri.ACCESS';

    /**
     * the column name for the TYPE field
     */
    const COL_TYPE = 'sys_uri.TYPE';

    /**
     * the column name for the POSITION field
     */
    const COL_POSITION = 'sys_uri.POSITION';

    /**
     * the column name for the DESCRIPTION field
     */
    const COL_DESCRIPTION = 'sys_uri.DESCRIPTION';

    /**
     * the column name for the ICON field
     */
    const COL_ICON = 'sys_uri.ICON';

    /**
     * the column name for the MARK field
     */
    const COL_MARK = 'sys_uri.MARK';

    /**
     * the column name for the AFTER_DIVISOR field
     */
    const COL_AFTER_DIVISOR = 'sys_uri.AFTER_DIVISOR';

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
        self::TYPE_PHPNAME       => array('Id', 'ModuleId', 'Uri', 'Title', 'Access', 'Type', 'Position', 'Description', 'Icon', 'Mark', 'AfterDivisor', ),
        self::TYPE_CAMELNAME     => array('id', 'moduleId', 'uri', 'title', 'access', 'type', 'position', 'description', 'icon', 'mark', 'afterDivisor', ),
        self::TYPE_COLNAME       => array(SysUriTableMap::COL_ID, SysUriTableMap::COL_MODULE_ID, SysUriTableMap::COL_URI, SysUriTableMap::COL_TITLE, SysUriTableMap::COL_ACCESS, SysUriTableMap::COL_TYPE, SysUriTableMap::COL_POSITION, SysUriTableMap::COL_DESCRIPTION, SysUriTableMap::COL_ICON, SysUriTableMap::COL_MARK, SysUriTableMap::COL_AFTER_DIVISOR, ),
        self::TYPE_FIELDNAME     => array('ID', 'MODULE_ID', 'URI', 'TITLE', 'ACCESS', 'TYPE', 'POSITION', 'DESCRIPTION', 'ICON', 'MARK', 'AFTER_DIVISOR', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ModuleId' => 1, 'Uri' => 2, 'Title' => 3, 'Access' => 4, 'Type' => 5, 'Position' => 6, 'Description' => 7, 'Icon' => 8, 'Mark' => 9, 'AfterDivisor' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'moduleId' => 1, 'uri' => 2, 'title' => 3, 'access' => 4, 'type' => 5, 'position' => 6, 'description' => 7, 'icon' => 8, 'mark' => 9, 'afterDivisor' => 10, ),
        self::TYPE_COLNAME       => array(SysUriTableMap::COL_ID => 0, SysUriTableMap::COL_MODULE_ID => 1, SysUriTableMap::COL_URI => 2, SysUriTableMap::COL_TITLE => 3, SysUriTableMap::COL_ACCESS => 4, SysUriTableMap::COL_TYPE => 5, SysUriTableMap::COL_POSITION => 6, SysUriTableMap::COL_DESCRIPTION => 7, SysUriTableMap::COL_ICON => 8, SysUriTableMap::COL_MARK => 9, SysUriTableMap::COL_AFTER_DIVISOR => 10, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'MODULE_ID' => 1, 'URI' => 2, 'TITLE' => 3, 'ACCESS' => 4, 'TYPE' => 5, 'POSITION' => 6, 'DESCRIPTION' => 7, 'ICON' => 8, 'MARK' => 9, 'AFTER_DIVISOR' => 10, ),
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
        $this->setName('sys_uri');
        $this->setPhpName('SysUri');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\model\\domain\\SysUri');
        $this->setPackage('App.model.domain');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('MODULE_ID', 'ModuleId', 'INTEGER', 'sys_module', 'ID', true, null, null);
        $this->addColumn('URI', 'Uri', 'VARCHAR', true, 200, null);
        $this->addColumn('TITLE', 'Title', 'VARCHAR', true, 50, null);
        $this->addColumn('ACCESS', 'Access', 'VARCHAR', true, 20, null);
        $this->addColumn('TYPE', 'Type', 'VARCHAR', true, 20, null);
        $this->addColumn('POSITION', 'Position', 'INTEGER', true, null, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('ICON', 'Icon', 'VARCHAR', false, 30, null);
        $this->addColumn('MARK', 'Mark', 'VARCHAR', false, 200, null);
        $this->addColumn('AFTER_DIVISOR', 'AfterDivisor', 'BOOLEAN', true, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysModule', '\\App\\model\\domain\\SysModule', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':MODULE_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysRolXUri', '\\App\\model\\domain\\SysRolXUri', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':URI_ID',
    1 => ':ID',
  ),
), null, null, 'SysRolXUris', false);
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
        return $withPrefix ? SysUriTableMap::CLASS_DEFAULT : SysUriTableMap::OM_CLASS;
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
     * @return array           (SysUri object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysUriTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysUriTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysUriTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysUriTableMap::OM_CLASS;
            /** @var SysUri $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysUriTableMap::addInstanceToPool($obj, $key);
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
            $key = SysUriTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysUriTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysUri $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysUriTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysUriTableMap::COL_ID);
            $criteria->addSelectColumn(SysUriTableMap::COL_MODULE_ID);
            $criteria->addSelectColumn(SysUriTableMap::COL_URI);
            $criteria->addSelectColumn(SysUriTableMap::COL_TITLE);
            $criteria->addSelectColumn(SysUriTableMap::COL_ACCESS);
            $criteria->addSelectColumn(SysUriTableMap::COL_TYPE);
            $criteria->addSelectColumn(SysUriTableMap::COL_POSITION);
            $criteria->addSelectColumn(SysUriTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysUriTableMap::COL_ICON);
            $criteria->addSelectColumn(SysUriTableMap::COL_MARK);
            $criteria->addSelectColumn(SysUriTableMap::COL_AFTER_DIVISOR);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.MODULE_ID');
            $criteria->addSelectColumn($alias . '.URI');
            $criteria->addSelectColumn($alias . '.TITLE');
            $criteria->addSelectColumn($alias . '.ACCESS');
            $criteria->addSelectColumn($alias . '.TYPE');
            $criteria->addSelectColumn($alias . '.POSITION');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.ICON');
            $criteria->addSelectColumn($alias . '.MARK');
            $criteria->addSelectColumn($alias . '.AFTER_DIVISOR');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysUriTableMap::DATABASE_NAME)->getTable(SysUriTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysUriTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysUriTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysUriTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysUri or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysUri object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\model\domain\SysUri) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysUriTableMap::DATABASE_NAME);
            $criteria->add(SysUriTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysUriQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysUriTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysUriTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_uri table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysUriQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysUri or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysUri object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysUri object
        }

        if ($criteria->containsKey(SysUriTableMap::COL_ID) && $criteria->keyContainsValue(SysUriTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysUriTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysUriQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysUriTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysUriTableMap::buildTableMap();
