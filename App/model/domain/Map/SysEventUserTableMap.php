<?php

namespace Map;

use \SysEventUser;
use \SysEventUserQuery;
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
 * This class defines the structure of the 'sys_event_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SysEventUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysEventUserTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_event_user';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysEventUser';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysEventUser';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysEventUser';

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
    public const COL_ID = 'sys_event_user.ID';

    /**
     * the column name for the EVENT_ID field
     */
    public const COL_EVENT_ID = 'sys_event_user.EVENT_ID';

    /**
     * the column name for the USER_ID field
     */
    public const COL_USER_ID = 'sys_event_user.USER_ID';

    /**
     * the column name for the DATE field
     */
    public const COL_DATE = 'sys_event_user.DATE';

    /**
     * the column name for the MESSAGE field
     */
    public const COL_MESSAGE = 'sys_event_user.MESSAGE';

    /**
     * the column name for the DETAILS field
     */
    public const COL_DETAILS = 'sys_event_user.DETAILS';

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
        self::TYPE_PHPNAME       => ['Id', 'EventId', 'UserId', 'Date', 'Message', 'Details', ],
        self::TYPE_CAMELNAME     => ['id', 'eventId', 'userId', 'date', 'message', 'details', ],
        self::TYPE_COLNAME       => [SysEventUserTableMap::COL_ID, SysEventUserTableMap::COL_EVENT_ID, SysEventUserTableMap::COL_USER_ID, SysEventUserTableMap::COL_DATE, SysEventUserTableMap::COL_MESSAGE, SysEventUserTableMap::COL_DETAILS, ],
        self::TYPE_FIELDNAME     => ['ID', 'EVENT_ID', 'USER_ID', 'DATE', 'MESSAGE', 'DETAILS', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'EventId' => 1, 'UserId' => 2, 'Date' => 3, 'Message' => 4, 'Details' => 5, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'eventId' => 1, 'userId' => 2, 'date' => 3, 'message' => 4, 'details' => 5, ],
        self::TYPE_COLNAME       => [SysEventUserTableMap::COL_ID => 0, SysEventUserTableMap::COL_EVENT_ID => 1, SysEventUserTableMap::COL_USER_ID => 2, SysEventUserTableMap::COL_DATE => 3, SysEventUserTableMap::COL_MESSAGE => 4, SysEventUserTableMap::COL_DETAILS => 5, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'EVENT_ID' => 1, 'USER_ID' => 2, 'DATE' => 3, 'MESSAGE' => 4, 'DETAILS' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysEventUser.Id' => 'ID',
        'id' => 'ID',
        'sysEventUser.id' => 'ID',
        'SysEventUserTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_event_user.ID' => 'ID',
        'EventId' => 'EVENT_ID',
        'SysEventUser.EventId' => 'EVENT_ID',
        'eventId' => 'EVENT_ID',
        'sysEventUser.eventId' => 'EVENT_ID',
        'SysEventUserTableMap::COL_EVENT_ID' => 'EVENT_ID',
        'COL_EVENT_ID' => 'EVENT_ID',
        'EVENT_ID' => 'EVENT_ID',
        'sys_event_user.EVENT_ID' => 'EVENT_ID',
        'UserId' => 'USER_ID',
        'SysEventUser.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'sysEventUser.userId' => 'USER_ID',
        'SysEventUserTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'USER_ID' => 'USER_ID',
        'sys_event_user.USER_ID' => 'USER_ID',
        'Date' => 'DATE',
        'SysEventUser.Date' => 'DATE',
        'date' => 'DATE',
        'sysEventUser.date' => 'DATE',
        'SysEventUserTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'DATE' => 'DATE',
        'sys_event_user.DATE' => 'DATE',
        'Message' => 'MESSAGE',
        'SysEventUser.Message' => 'MESSAGE',
        'message' => 'MESSAGE',
        'sysEventUser.message' => 'MESSAGE',
        'SysEventUserTableMap::COL_MESSAGE' => 'MESSAGE',
        'COL_MESSAGE' => 'MESSAGE',
        'MESSAGE' => 'MESSAGE',
        'sys_event_user.MESSAGE' => 'MESSAGE',
        'Details' => 'DETAILS',
        'SysEventUser.Details' => 'DETAILS',
        'details' => 'DETAILS',
        'sysEventUser.details' => 'DETAILS',
        'SysEventUserTableMap::COL_DETAILS' => 'DETAILS',
        'COL_DETAILS' => 'DETAILS',
        'DETAILS' => 'DETAILS',
        'sys_event_user.DETAILS' => 'DETAILS',
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
        $this->setName('sys_event_user');
        $this->setPhpName('SysEventUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysEventUser');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('EVENT_ID', 'EventId', 'INTEGER', 'sys_event', 'ID', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addColumn('DATE', 'Date', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MESSAGE', 'Message', 'VARCHAR', true, 1000, null);
        $this->addColumn('DETAILS', 'Details', 'LONGVARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SysEvent', '\\SysEvent', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':EVENT_ID',
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
        return $withPrefix ? SysEventUserTableMap::CLASS_DEFAULT : SysEventUserTableMap::OM_CLASS;
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
     * @return array (SysEventUser object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SysEventUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysEventUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysEventUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysEventUserTableMap::OM_CLASS;
            /** @var SysEventUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysEventUserTableMap::addInstanceToPool($obj, $key);
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
            $key = SysEventUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysEventUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysEventUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysEventUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysEventUserTableMap::COL_ID);
            $criteria->addSelectColumn(SysEventUserTableMap::COL_EVENT_ID);
            $criteria->addSelectColumn(SysEventUserTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysEventUserTableMap::COL_DATE);
            $criteria->addSelectColumn(SysEventUserTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(SysEventUserTableMap::COL_DETAILS);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.EVENT_ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.DATE');
            $criteria->addSelectColumn($alias . '.MESSAGE');
            $criteria->addSelectColumn($alias . '.DETAILS');
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
            $criteria->removeSelectColumn(SysEventUserTableMap::COL_ID);
            $criteria->removeSelectColumn(SysEventUserTableMap::COL_EVENT_ID);
            $criteria->removeSelectColumn(SysEventUserTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(SysEventUserTableMap::COL_DATE);
            $criteria->removeSelectColumn(SysEventUserTableMap::COL_MESSAGE);
            $criteria->removeSelectColumn(SysEventUserTableMap::COL_DETAILS);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.EVENT_ID');
            $criteria->removeSelectColumn($alias . '.USER_ID');
            $criteria->removeSelectColumn($alias . '.DATE');
            $criteria->removeSelectColumn($alias . '.MESSAGE');
            $criteria->removeSelectColumn($alias . '.DETAILS');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysEventUserTableMap::DATABASE_NAME)->getTable(SysEventUserTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysEventUser or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysEventUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEventUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysEventUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysEventUserTableMap::DATABASE_NAME);
            $criteria->add(SysEventUserTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysEventUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysEventUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysEventUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_event_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysEventUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysEventUser or Criteria object.
     *
     * @param mixed $criteria Criteria or SysEventUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEventUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysEventUser object
        }

        if ($criteria->containsKey(SysEventUserTableMap::COL_ID) && $criteria->keyContainsValue(SysEventUserTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysEventUserTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysEventUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
