<?php

namespace Map;

use \SysUserParam;
use \SysUserParamQuery;
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
 * This class defines the structure of the 'sys_user_param' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SysUserParamTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysUserParamTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_user_param';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysUserParam';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysUserParam';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysUserParam';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the ID field
     */
    public const COL_ID = 'sys_user_param.ID';

    /**
     * the column name for the USER_ID field
     */
    public const COL_USER_ID = 'sys_user_param.USER_ID';

    /**
     * the column name for the PARAM_ID field
     */
    public const COL_PARAM_ID = 'sys_user_param.PARAM_ID';

    /**
     * the column name for the VALUE field
     */
    public const COL_VALUE = 'sys_user_param.VALUE';

    /**
     * the column name for the DESCRIPTION field
     */
    public const COL_DESCRIPTION = 'sys_user_param.DESCRIPTION';

    /**
     * the column name for the LAST_USER_ID field
     */
    public const COL_LAST_USER_ID = 'sys_user_param.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    public const COL_CREATION_DATE = 'sys_user_param.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    public const COL_MODIFICATION_DATE = 'sys_user_param.MODIFICATION_DATE';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'ParamId', 'Value', 'Description', 'LastUserId', 'CreationDate', 'ModificationDate', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'paramId', 'value', 'description', 'lastUserId', 'creationDate', 'modificationDate', ],
        self::TYPE_COLNAME       => [SysUserParamTableMap::COL_ID, SysUserParamTableMap::COL_USER_ID, SysUserParamTableMap::COL_PARAM_ID, SysUserParamTableMap::COL_VALUE, SysUserParamTableMap::COL_DESCRIPTION, SysUserParamTableMap::COL_LAST_USER_ID, SysUserParamTableMap::COL_CREATION_DATE, SysUserParamTableMap::COL_MODIFICATION_DATE, ],
        self::TYPE_FIELDNAME     => ['ID', 'USER_ID', 'PARAM_ID', 'VALUE', 'DESCRIPTION', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'ParamId' => 2, 'Value' => 3, 'Description' => 4, 'LastUserId' => 5, 'CreationDate' => 6, 'ModificationDate' => 7, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'paramId' => 2, 'value' => 3, 'description' => 4, 'lastUserId' => 5, 'creationDate' => 6, 'modificationDate' => 7, ],
        self::TYPE_COLNAME       => [SysUserParamTableMap::COL_ID => 0, SysUserParamTableMap::COL_USER_ID => 1, SysUserParamTableMap::COL_PARAM_ID => 2, SysUserParamTableMap::COL_VALUE => 3, SysUserParamTableMap::COL_DESCRIPTION => 4, SysUserParamTableMap::COL_LAST_USER_ID => 5, SysUserParamTableMap::COL_CREATION_DATE => 6, SysUserParamTableMap::COL_MODIFICATION_DATE => 7, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'USER_ID' => 1, 'PARAM_ID' => 2, 'VALUE' => 3, 'DESCRIPTION' => 4, 'LAST_USER_ID' => 5, 'CREATION_DATE' => 6, 'MODIFICATION_DATE' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysUserParam.Id' => 'ID',
        'id' => 'ID',
        'sysUserParam.id' => 'ID',
        'SysUserParamTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_user_param.ID' => 'ID',
        'UserId' => 'USER_ID',
        'SysUserParam.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'sysUserParam.userId' => 'USER_ID',
        'SysUserParamTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'USER_ID' => 'USER_ID',
        'sys_user_param.USER_ID' => 'USER_ID',
        'ParamId' => 'PARAM_ID',
        'SysUserParam.ParamId' => 'PARAM_ID',
        'paramId' => 'PARAM_ID',
        'sysUserParam.paramId' => 'PARAM_ID',
        'SysUserParamTableMap::COL_PARAM_ID' => 'PARAM_ID',
        'COL_PARAM_ID' => 'PARAM_ID',
        'PARAM_ID' => 'PARAM_ID',
        'sys_user_param.PARAM_ID' => 'PARAM_ID',
        'Value' => 'VALUE',
        'SysUserParam.Value' => 'VALUE',
        'value' => 'VALUE',
        'sysUserParam.value' => 'VALUE',
        'SysUserParamTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'VALUE' => 'VALUE',
        'sys_user_param.VALUE' => 'VALUE',
        'Description' => 'DESCRIPTION',
        'SysUserParam.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'sysUserParam.description' => 'DESCRIPTION',
        'SysUserParamTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'DESCRIPTION' => 'DESCRIPTION',
        'sys_user_param.DESCRIPTION' => 'DESCRIPTION',
        'LastUserId' => 'LAST_USER_ID',
        'SysUserParam.LastUserId' => 'LAST_USER_ID',
        'lastUserId' => 'LAST_USER_ID',
        'sysUserParam.lastUserId' => 'LAST_USER_ID',
        'SysUserParamTableMap::COL_LAST_USER_ID' => 'LAST_USER_ID',
        'COL_LAST_USER_ID' => 'LAST_USER_ID',
        'LAST_USER_ID' => 'LAST_USER_ID',
        'sys_user_param.LAST_USER_ID' => 'LAST_USER_ID',
        'CreationDate' => 'CREATION_DATE',
        'SysUserParam.CreationDate' => 'CREATION_DATE',
        'creationDate' => 'CREATION_DATE',
        'sysUserParam.creationDate' => 'CREATION_DATE',
        'SysUserParamTableMap::COL_CREATION_DATE' => 'CREATION_DATE',
        'COL_CREATION_DATE' => 'CREATION_DATE',
        'CREATION_DATE' => 'CREATION_DATE',
        'sys_user_param.CREATION_DATE' => 'CREATION_DATE',
        'ModificationDate' => 'MODIFICATION_DATE',
        'SysUserParam.ModificationDate' => 'MODIFICATION_DATE',
        'modificationDate' => 'MODIFICATION_DATE',
        'sysUserParam.modificationDate' => 'MODIFICATION_DATE',
        'SysUserParamTableMap::COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'sys_user_param.MODIFICATION_DATE' => 'MODIFICATION_DATE',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('sys_user_param');
        $this->setPhpName('SysUserParam');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysUserParam');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addForeignKey('PARAM_ID', 'ParamId', 'INTEGER', 'sys_param', 'ID', true, null, null);
        $this->addColumn('VALUE', 'Value', 'VARCHAR', true, 200, null);
        $this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 300, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, '0000-00-00 00:00:00');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SysParam', '\\SysParam', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':PARAM_ID',
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
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
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
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
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
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? SysUserParamTableMap::CLASS_DEFAULT : SysUserParamTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (SysUserParam object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SysUserParamTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysUserParamTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysUserParamTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysUserParamTableMap::OM_CLASS;
            /** @var SysUserParam $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysUserParamTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SysUserParamTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysUserParamTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysUserParam $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysUserParamTableMap::addInstanceToPool($obj, $key);
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
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SysUserParamTableMap::COL_ID);
            $criteria->addSelectColumn(SysUserParamTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysUserParamTableMap::COL_PARAM_ID);
            $criteria->addSelectColumn(SysUserParamTableMap::COL_VALUE);
            $criteria->addSelectColumn(SysUserParamTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysUserParamTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysUserParamTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysUserParamTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.PARAM_ID');
            $criteria->addSelectColumn($alias . '.VALUE');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.LAST_USER_ID');
            $criteria->addSelectColumn($alias . '.CREATION_DATE');
            $criteria->addSelectColumn($alias . '.MODIFICATION_DATE');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_ID);
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_PARAM_ID);
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_VALUE);
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_LAST_USER_ID);
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_CREATION_DATE);
            $criteria->removeSelectColumn(SysUserParamTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.USER_ID');
            $criteria->removeSelectColumn($alias . '.PARAM_ID');
            $criteria->removeSelectColumn($alias . '.VALUE');
            $criteria->removeSelectColumn($alias . '.DESCRIPTION');
            $criteria->removeSelectColumn($alias . '.LAST_USER_ID');
            $criteria->removeSelectColumn($alias . '.CREATION_DATE');
            $criteria->removeSelectColumn($alias . '.MODIFICATION_DATE');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(SysUserParamTableMap::DATABASE_NAME)->getTable(SysUserParamTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysUserParam or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysUserParam object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserParamTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysUserParam) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysUserParamTableMap::DATABASE_NAME);
            $criteria->add(SysUserParamTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysUserParamQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysUserParamTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysUserParamTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_user_param table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysUserParamQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysUserParam or Criteria object.
     *
     * @param mixed $criteria Criteria or SysUserParam object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserParamTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysUserParam object
        }

        if ($criteria->containsKey(SysUserParamTableMap::COL_ID) && $criteria->keyContainsValue(SysUserParamTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysUserParamTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysUserParamQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
