<?php

namespace Map;

use \SysPassword;
use \SysPasswordQuery;
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
 * This class defines the structure of the 'sys_password' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SysPasswordTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysPasswordTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_password';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysPassword';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysPassword';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysPassword';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the ID field
     */
    public const COL_ID = 'sys_password.ID';

    /**
     * the column name for the USER_ID field
     */
    public const COL_USER_ID = 'sys_password.USER_ID';

    /**
     * the column name for the PASSWORD_REQUEST_ID field
     */
    public const COL_PASSWORD_REQUEST_ID = 'sys_password.PASSWORD_REQUEST_ID';

    /**
     * the column name for the VALUE field
     */
    public const COL_VALUE = 'sys_password.VALUE';

    /**
     * the column name for the TYPE field
     */
    public const COL_TYPE = 'sys_password.TYPE';

    /**
     * the column name for the START_DATE field
     */
    public const COL_START_DATE = 'sys_password.START_DATE';

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
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'PasswordRequestId', 'Value', 'Type', 'StartDate', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'passwordRequestId', 'value', 'type', 'startDate', ],
        self::TYPE_COLNAME       => [SysPasswordTableMap::COL_ID, SysPasswordTableMap::COL_USER_ID, SysPasswordTableMap::COL_PASSWORD_REQUEST_ID, SysPasswordTableMap::COL_VALUE, SysPasswordTableMap::COL_TYPE, SysPasswordTableMap::COL_START_DATE, ],
        self::TYPE_FIELDNAME     => ['ID', 'USER_ID', 'PASSWORD_REQUEST_ID', 'VALUE', 'TYPE', 'START_DATE', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'PasswordRequestId' => 2, 'Value' => 3, 'Type' => 4, 'StartDate' => 5, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'passwordRequestId' => 2, 'value' => 3, 'type' => 4, 'startDate' => 5, ],
        self::TYPE_COLNAME       => [SysPasswordTableMap::COL_ID => 0, SysPasswordTableMap::COL_USER_ID => 1, SysPasswordTableMap::COL_PASSWORD_REQUEST_ID => 2, SysPasswordTableMap::COL_VALUE => 3, SysPasswordTableMap::COL_TYPE => 4, SysPasswordTableMap::COL_START_DATE => 5, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'USER_ID' => 1, 'PASSWORD_REQUEST_ID' => 2, 'VALUE' => 3, 'TYPE' => 4, 'START_DATE' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysPassword.Id' => 'ID',
        'id' => 'ID',
        'sysPassword.id' => 'ID',
        'SysPasswordTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_password.ID' => 'ID',
        'UserId' => 'USER_ID',
        'SysPassword.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'sysPassword.userId' => 'USER_ID',
        'SysPasswordTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'USER_ID' => 'USER_ID',
        'sys_password.USER_ID' => 'USER_ID',
        'PasswordRequestId' => 'PASSWORD_REQUEST_ID',
        'SysPassword.PasswordRequestId' => 'PASSWORD_REQUEST_ID',
        'passwordRequestId' => 'PASSWORD_REQUEST_ID',
        'sysPassword.passwordRequestId' => 'PASSWORD_REQUEST_ID',
        'SysPasswordTableMap::COL_PASSWORD_REQUEST_ID' => 'PASSWORD_REQUEST_ID',
        'COL_PASSWORD_REQUEST_ID' => 'PASSWORD_REQUEST_ID',
        'PASSWORD_REQUEST_ID' => 'PASSWORD_REQUEST_ID',
        'sys_password.PASSWORD_REQUEST_ID' => 'PASSWORD_REQUEST_ID',
        'Value' => 'VALUE',
        'SysPassword.Value' => 'VALUE',
        'value' => 'VALUE',
        'sysPassword.value' => 'VALUE',
        'SysPasswordTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'VALUE' => 'VALUE',
        'sys_password.VALUE' => 'VALUE',
        'Type' => 'TYPE',
        'SysPassword.Type' => 'TYPE',
        'type' => 'TYPE',
        'sysPassword.type' => 'TYPE',
        'SysPasswordTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'TYPE' => 'TYPE',
        'sys_password.TYPE' => 'TYPE',
        'StartDate' => 'START_DATE',
        'SysPassword.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'sysPassword.startDate' => 'START_DATE',
        'SysPasswordTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'START_DATE' => 'START_DATE',
        'sys_password.START_DATE' => 'START_DATE',
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
        $this->setName('sys_password');
        $this->setPhpName('SysPassword');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysPassword');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addForeignKey('PASSWORD_REQUEST_ID', 'PasswordRequestId', 'INTEGER', 'sys_password_request', 'ID', false, null, null);
        $this->addColumn('VALUE', 'Value', 'VARCHAR', true, 500, null);
        $this->addColumn('TYPE', 'Type', 'VARCHAR', true, 20, null);
        $this->addColumn('START_DATE', 'StartDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SysUser', '\\SysUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysPasswordRequest', '\\SysPasswordRequest', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':PASSWORD_REQUEST_ID',
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
        return $withPrefix ? SysPasswordTableMap::CLASS_DEFAULT : SysPasswordTableMap::OM_CLASS;
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
     * @return array (SysPassword object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SysPasswordTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysPasswordTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysPasswordTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysPasswordTableMap::OM_CLASS;
            /** @var SysPassword $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysPasswordTableMap::addInstanceToPool($obj, $key);
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
            $key = SysPasswordTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysPasswordTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysPassword $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysPasswordTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysPasswordTableMap::COL_ID);
            $criteria->addSelectColumn(SysPasswordTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysPasswordTableMap::COL_PASSWORD_REQUEST_ID);
            $criteria->addSelectColumn(SysPasswordTableMap::COL_VALUE);
            $criteria->addSelectColumn(SysPasswordTableMap::COL_TYPE);
            $criteria->addSelectColumn(SysPasswordTableMap::COL_START_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.PASSWORD_REQUEST_ID');
            $criteria->addSelectColumn($alias . '.VALUE');
            $criteria->addSelectColumn($alias . '.TYPE');
            $criteria->addSelectColumn($alias . '.START_DATE');
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
            $criteria->removeSelectColumn(SysPasswordTableMap::COL_ID);
            $criteria->removeSelectColumn(SysPasswordTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(SysPasswordTableMap::COL_PASSWORD_REQUEST_ID);
            $criteria->removeSelectColumn(SysPasswordTableMap::COL_VALUE);
            $criteria->removeSelectColumn(SysPasswordTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SysPasswordTableMap::COL_START_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.USER_ID');
            $criteria->removeSelectColumn($alias . '.PASSWORD_REQUEST_ID');
            $criteria->removeSelectColumn($alias . '.VALUE');
            $criteria->removeSelectColumn($alias . '.TYPE');
            $criteria->removeSelectColumn($alias . '.START_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysPasswordTableMap::DATABASE_NAME)->getTable(SysPasswordTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysPassword or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysPassword object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysPassword) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysPasswordTableMap::DATABASE_NAME);
            $criteria->add(SysPasswordTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysPasswordQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysPasswordTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysPasswordTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_password table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysPasswordQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysPassword or Criteria object.
     *
     * @param mixed $criteria Criteria or SysPassword object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysPassword object
        }

        if ($criteria->containsKey(SysPasswordTableMap::COL_ID) && $criteria->keyContainsValue(SysPasswordTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysPasswordTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysPasswordQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
