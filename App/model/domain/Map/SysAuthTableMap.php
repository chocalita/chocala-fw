<?php

namespace Map;

use \SysAuth;
use \SysAuthQuery;
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
 * This class defines the structure of the 'sys_auth' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SysAuthTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysAuthTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_auth';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysAuth';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysAuth';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysAuth';

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
    public const COL_ID = 'sys_auth.ID';

    /**
     * the column name for the USER_ID field
     */
    public const COL_USER_ID = 'sys_auth.USER_ID';

    /**
     * the column name for the TYPE field
     */
    public const COL_TYPE = 'sys_auth.TYPE';

    /**
     * the column name for the ACCESS_TOKEN field
     */
    public const COL_ACCESS_TOKEN = 'sys_auth.ACCESS_TOKEN';

    /**
     * the column name for the JSON field
     */
    public const COL_JSON = 'sys_auth.JSON';

    /**
     * the column name for the STATUS field
     */
    public const COL_STATUS = 'sys_auth.STATUS';

    /**
     * the column name for the CREATION_DATE field
     */
    public const COL_CREATION_DATE = 'sys_auth.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    public const COL_MODIFICATION_DATE = 'sys_auth.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'Type', 'AccessToken', 'Json', 'Status', 'CreationDate', 'ModificationDate', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'type', 'accessToken', 'json', 'status', 'creationDate', 'modificationDate', ],
        self::TYPE_COLNAME       => [SysAuthTableMap::COL_ID, SysAuthTableMap::COL_USER_ID, SysAuthTableMap::COL_TYPE, SysAuthTableMap::COL_ACCESS_TOKEN, SysAuthTableMap::COL_JSON, SysAuthTableMap::COL_STATUS, SysAuthTableMap::COL_CREATION_DATE, SysAuthTableMap::COL_MODIFICATION_DATE, ],
        self::TYPE_FIELDNAME     => ['ID', 'USER_ID', 'TYPE', 'ACCESS_TOKEN', 'JSON', 'STATUS', 'CREATION_DATE', 'MODIFICATION_DATE', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'Type' => 2, 'AccessToken' => 3, 'Json' => 4, 'Status' => 5, 'CreationDate' => 6, 'ModificationDate' => 7, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'type' => 2, 'accessToken' => 3, 'json' => 4, 'status' => 5, 'creationDate' => 6, 'modificationDate' => 7, ],
        self::TYPE_COLNAME       => [SysAuthTableMap::COL_ID => 0, SysAuthTableMap::COL_USER_ID => 1, SysAuthTableMap::COL_TYPE => 2, SysAuthTableMap::COL_ACCESS_TOKEN => 3, SysAuthTableMap::COL_JSON => 4, SysAuthTableMap::COL_STATUS => 5, SysAuthTableMap::COL_CREATION_DATE => 6, SysAuthTableMap::COL_MODIFICATION_DATE => 7, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'USER_ID' => 1, 'TYPE' => 2, 'ACCESS_TOKEN' => 3, 'JSON' => 4, 'STATUS' => 5, 'CREATION_DATE' => 6, 'MODIFICATION_DATE' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysAuth.Id' => 'ID',
        'id' => 'ID',
        'sysAuth.id' => 'ID',
        'SysAuthTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_auth.ID' => 'ID',
        'UserId' => 'USER_ID',
        'SysAuth.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'sysAuth.userId' => 'USER_ID',
        'SysAuthTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'USER_ID' => 'USER_ID',
        'sys_auth.USER_ID' => 'USER_ID',
        'Type' => 'TYPE',
        'SysAuth.Type' => 'TYPE',
        'type' => 'TYPE',
        'sysAuth.type' => 'TYPE',
        'SysAuthTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'TYPE' => 'TYPE',
        'sys_auth.TYPE' => 'TYPE',
        'AccessToken' => 'ACCESS_TOKEN',
        'SysAuth.AccessToken' => 'ACCESS_TOKEN',
        'accessToken' => 'ACCESS_TOKEN',
        'sysAuth.accessToken' => 'ACCESS_TOKEN',
        'SysAuthTableMap::COL_ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'COL_ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'sys_auth.ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'Json' => 'JSON',
        'SysAuth.Json' => 'JSON',
        'json' => 'JSON',
        'sysAuth.json' => 'JSON',
        'SysAuthTableMap::COL_JSON' => 'JSON',
        'COL_JSON' => 'JSON',
        'JSON' => 'JSON',
        'sys_auth.JSON' => 'JSON',
        'Status' => 'STATUS',
        'SysAuth.Status' => 'STATUS',
        'status' => 'STATUS',
        'sysAuth.status' => 'STATUS',
        'SysAuthTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'STATUS' => 'STATUS',
        'sys_auth.STATUS' => 'STATUS',
        'CreationDate' => 'CREATION_DATE',
        'SysAuth.CreationDate' => 'CREATION_DATE',
        'creationDate' => 'CREATION_DATE',
        'sysAuth.creationDate' => 'CREATION_DATE',
        'SysAuthTableMap::COL_CREATION_DATE' => 'CREATION_DATE',
        'COL_CREATION_DATE' => 'CREATION_DATE',
        'CREATION_DATE' => 'CREATION_DATE',
        'sys_auth.CREATION_DATE' => 'CREATION_DATE',
        'ModificationDate' => 'MODIFICATION_DATE',
        'SysAuth.ModificationDate' => 'MODIFICATION_DATE',
        'modificationDate' => 'MODIFICATION_DATE',
        'sysAuth.modificationDate' => 'MODIFICATION_DATE',
        'SysAuthTableMap::COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'sys_auth.MODIFICATION_DATE' => 'MODIFICATION_DATE',
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
        $this->setName('sys_auth');
        $this->setPhpName('SysAuth');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysAuth');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addColumn('TYPE', 'Type', 'VARCHAR', true, 50, '');
        $this->addColumn('ACCESS_TOKEN', 'AccessToken', 'VARCHAR', true, 50, '');
        $this->addColumn('JSON', 'Json', 'LONGVARCHAR', false, null, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 20, 'CREATED');
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
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
        return $withPrefix ? SysAuthTableMap::CLASS_DEFAULT : SysAuthTableMap::OM_CLASS;
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
     * @return array (SysAuth object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SysAuthTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysAuthTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysAuthTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysAuthTableMap::OM_CLASS;
            /** @var SysAuth $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysAuthTableMap::addInstanceToPool($obj, $key);
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
            $key = SysAuthTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysAuthTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysAuth $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysAuthTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysAuthTableMap::COL_ID);
            $criteria->addSelectColumn(SysAuthTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysAuthTableMap::COL_TYPE);
            $criteria->addSelectColumn(SysAuthTableMap::COL_ACCESS_TOKEN);
            $criteria->addSelectColumn(SysAuthTableMap::COL_JSON);
            $criteria->addSelectColumn(SysAuthTableMap::COL_STATUS);
            $criteria->addSelectColumn(SysAuthTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysAuthTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.TYPE');
            $criteria->addSelectColumn($alias . '.ACCESS_TOKEN');
            $criteria->addSelectColumn($alias . '.JSON');
            $criteria->addSelectColumn($alias . '.STATUS');
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
            $criteria->removeSelectColumn(SysAuthTableMap::COL_ID);
            $criteria->removeSelectColumn(SysAuthTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(SysAuthTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SysAuthTableMap::COL_ACCESS_TOKEN);
            $criteria->removeSelectColumn(SysAuthTableMap::COL_JSON);
            $criteria->removeSelectColumn(SysAuthTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SysAuthTableMap::COL_CREATION_DATE);
            $criteria->removeSelectColumn(SysAuthTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.USER_ID');
            $criteria->removeSelectColumn($alias . '.TYPE');
            $criteria->removeSelectColumn($alias . '.ACCESS_TOKEN');
            $criteria->removeSelectColumn($alias . '.JSON');
            $criteria->removeSelectColumn($alias . '.STATUS');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysAuthTableMap::DATABASE_NAME)->getTable(SysAuthTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysAuth or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysAuth object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysAuthTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysAuth) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysAuthTableMap::DATABASE_NAME);
            $criteria->add(SysAuthTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysAuthQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysAuthTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysAuthTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_auth table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysAuthQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysAuth or Criteria object.
     *
     * @param mixed $criteria Criteria or SysAuth object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysAuthTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysAuth object
        }

        if ($criteria->containsKey(SysAuthTableMap::COL_ID) && $criteria->keyContainsValue(SysAuthTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysAuthTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysAuthQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
