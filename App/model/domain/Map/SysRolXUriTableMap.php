<?php

namespace Map;

use \SysRolXUri;
use \SysRolXUriQuery;
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
 * This class defines the structure of the 'sys_rol_x_uri' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysRolXUriTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysRolXUriTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_rol_x_uri';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysRolXUri';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysRolXUri';

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
     * the column name for the ROL_ID field
     */
    const COL_ROL_ID = 'sys_rol_x_uri.ROL_ID';

    /**
     * the column name for the URI_ID field
     */
    const COL_URI_ID = 'sys_rol_x_uri.URI_ID';

    /**
     * the column name for the AUT_READ field
     */
    const COL_AUT_READ = 'sys_rol_x_uri.AUT_READ';

    /**
     * the column name for the AUT_CREATE field
     */
    const COL_AUT_CREATE = 'sys_rol_x_uri.AUT_CREATE';

    /**
     * the column name for the AUT_UPDATE field
     */
    const COL_AUT_UPDATE = 'sys_rol_x_uri.AUT_UPDATE';

    /**
     * the column name for the AUT_DELETE field
     */
    const COL_AUT_DELETE = 'sys_rol_x_uri.AUT_DELETE';

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
        self::TYPE_PHPNAME       => array('RolId', 'UriId', 'AutRead', 'AutCreate', 'AutUpdate', 'AutDelete', ),
        self::TYPE_CAMELNAME     => array('rolId', 'uriId', 'autRead', 'autCreate', 'autUpdate', 'autDelete', ),
        self::TYPE_COLNAME       => array(SysRolXUriTableMap::COL_ROL_ID, SysRolXUriTableMap::COL_URI_ID, SysRolXUriTableMap::COL_AUT_READ, SysRolXUriTableMap::COL_AUT_CREATE, SysRolXUriTableMap::COL_AUT_UPDATE, SysRolXUriTableMap::COL_AUT_DELETE, ),
        self::TYPE_FIELDNAME     => array('ROL_ID', 'URI_ID', 'AUT_READ', 'AUT_CREATE', 'AUT_UPDATE', 'AUT_DELETE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('RolId' => 0, 'UriId' => 1, 'AutRead' => 2, 'AutCreate' => 3, 'AutUpdate' => 4, 'AutDelete' => 5, ),
        self::TYPE_CAMELNAME     => array('rolId' => 0, 'uriId' => 1, 'autRead' => 2, 'autCreate' => 3, 'autUpdate' => 4, 'autDelete' => 5, ),
        self::TYPE_COLNAME       => array(SysRolXUriTableMap::COL_ROL_ID => 0, SysRolXUriTableMap::COL_URI_ID => 1, SysRolXUriTableMap::COL_AUT_READ => 2, SysRolXUriTableMap::COL_AUT_CREATE => 3, SysRolXUriTableMap::COL_AUT_UPDATE => 4, SysRolXUriTableMap::COL_AUT_DELETE => 5, ),
        self::TYPE_FIELDNAME     => array('ROL_ID' => 0, 'URI_ID' => 1, 'AUT_READ' => 2, 'AUT_CREATE' => 3, 'AUT_UPDATE' => 4, 'AUT_DELETE' => 5, ),
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
        $this->setName('sys_rol_x_uri');
        $this->setPhpName('SysRolXUri');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysRolXUri');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('ROL_ID', 'RolId', 'INTEGER' , 'sys_rol', 'ID', true, null, null);
        $this->addForeignPrimaryKey('URI_ID', 'UriId', 'INTEGER' , 'sys_uri', 'ID', true, null, null);
        $this->addColumn('AUT_READ', 'AutRead', 'BOOLEAN', true, 1, true);
        $this->addColumn('AUT_CREATE', 'AutCreate', 'BOOLEAN', true, 1, false);
        $this->addColumn('AUT_UPDATE', 'AutUpdate', 'BOOLEAN', true, 1, false);
        $this->addColumn('AUT_DELETE', 'AutDelete', 'BOOLEAN', true, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysRol', '\\SysRol', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ROL_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysUri', '\\SysUri', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':URI_ID',
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
     * @param \SysRolXUri $obj A \SysRolXUri object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getRolId() || is_scalar($obj->getRolId()) || is_callable([$obj->getRolId(), '__toString']) ? (string) $obj->getRolId() : $obj->getRolId()), (null === $obj->getUriId() || is_scalar($obj->getUriId()) || is_callable([$obj->getUriId(), '__toString']) ? (string) $obj->getUriId() : $obj->getUriId())]);
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
     * @param mixed $value A \SysRolXUri object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \SysRolXUri) {
                $key = serialize([(null === $value->getRolId() || is_scalar($value->getRolId()) || is_callable([$value->getRolId(), '__toString']) ? (string) $value->getRolId() : $value->getRolId()), (null === $value->getUriId() || is_scalar($value->getUriId()) || is_callable([$value->getUriId(), '__toString']) ? (string) $value->getUriId() : $value->getUriId())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \SysRolXUri object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RolId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('UriId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RolId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RolId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RolId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RolId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RolId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('UriId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('UriId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('UriId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('UriId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('UriId', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                : self::translateFieldName('RolId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('UriId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SysRolXUriTableMap::CLASS_DEFAULT : SysRolXUriTableMap::OM_CLASS;
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
     * @return array           (SysRolXUri object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysRolXUriTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysRolXUriTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysRolXUriTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysRolXUriTableMap::OM_CLASS;
            /** @var SysRolXUri $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysRolXUriTableMap::addInstanceToPool($obj, $key);
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
            $key = SysRolXUriTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysRolXUriTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysRolXUri $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysRolXUriTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysRolXUriTableMap::COL_ROL_ID);
            $criteria->addSelectColumn(SysRolXUriTableMap::COL_URI_ID);
            $criteria->addSelectColumn(SysRolXUriTableMap::COL_AUT_READ);
            $criteria->addSelectColumn(SysRolXUriTableMap::COL_AUT_CREATE);
            $criteria->addSelectColumn(SysRolXUriTableMap::COL_AUT_UPDATE);
            $criteria->addSelectColumn(SysRolXUriTableMap::COL_AUT_DELETE);
        } else {
            $criteria->addSelectColumn($alias . '.ROL_ID');
            $criteria->addSelectColumn($alias . '.URI_ID');
            $criteria->addSelectColumn($alias . '.AUT_READ');
            $criteria->addSelectColumn($alias . '.AUT_CREATE');
            $criteria->addSelectColumn($alias . '.AUT_UPDATE');
            $criteria->addSelectColumn($alias . '.AUT_DELETE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysRolXUriTableMap::DATABASE_NAME)->getTable(SysRolXUriTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysRolXUriTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysRolXUriTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysRolXUriTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysRolXUri or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysRolXUri object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolXUriTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysRolXUri) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysRolXUriTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SysRolXUriTableMap::COL_ROL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SysRolXUriTableMap::COL_URI_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = SysRolXUriQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysRolXUriTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysRolXUriTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_rol_x_uri table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysRolXUriQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysRolXUri or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysRolXUri object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolXUriTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysRolXUri object
        }


        // Set the correct dbName
        $query = SysRolXUriQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysRolXUriTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysRolXUriTableMap::buildTableMap();
