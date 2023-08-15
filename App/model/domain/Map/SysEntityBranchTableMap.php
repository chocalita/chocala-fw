<?php

namespace Map;

use \SysEntityBranch;
use \SysEntityBranchQuery;
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
 * This class defines the structure of the 'sys_entity_branch' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SysEntityBranchTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysEntityBranchTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_entity_branch';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysEntityBranch';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysEntityBranch';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysEntityBranch';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the ID field
     */
    public const COL_ID = 'sys_entity_branch.ID';

    /**
     * the column name for the ENTITY_ID field
     */
    public const COL_ENTITY_ID = 'sys_entity_branch.ENTITY_ID';

    /**
     * the column name for the LOCATION_ID field
     */
    public const COL_LOCATION_ID = 'sys_entity_branch.LOCATION_ID';

    /**
     * the column name for the STATUS field
     */
    public const COL_STATUS = 'sys_entity_branch.STATUS';

    /**
     * the column name for the NAME field
     */
    public const COL_NAME = 'sys_entity_branch.NAME';

    /**
     * the column name for the ADDRESS field
     */
    public const COL_ADDRESS = 'sys_entity_branch.ADDRESS';

    /**
     * the column name for the PHONE field
     */
    public const COL_PHONE = 'sys_entity_branch.PHONE';

    /**
     * the column name for the CELLPHONE field
     */
    public const COL_CELLPHONE = 'sys_entity_branch.CELLPHONE';

    /**
     * the column name for the FAX field
     */
    public const COL_FAX = 'sys_entity_branch.FAX';

    /**
     * the column name for the DESCRIPTION field
     */
    public const COL_DESCRIPTION = 'sys_entity_branch.DESCRIPTION';

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
        self::TYPE_PHPNAME       => ['Id', 'EntityId', 'LocationId', 'Status', 'Name', 'Address', 'Phone', 'Cellphone', 'Fax', 'Description', ],
        self::TYPE_CAMELNAME     => ['id', 'entityId', 'locationId', 'status', 'name', 'address', 'phone', 'cellphone', 'fax', 'description', ],
        self::TYPE_COLNAME       => [SysEntityBranchTableMap::COL_ID, SysEntityBranchTableMap::COL_ENTITY_ID, SysEntityBranchTableMap::COL_LOCATION_ID, SysEntityBranchTableMap::COL_STATUS, SysEntityBranchTableMap::COL_NAME, SysEntityBranchTableMap::COL_ADDRESS, SysEntityBranchTableMap::COL_PHONE, SysEntityBranchTableMap::COL_CELLPHONE, SysEntityBranchTableMap::COL_FAX, SysEntityBranchTableMap::COL_DESCRIPTION, ],
        self::TYPE_FIELDNAME     => ['ID', 'ENTITY_ID', 'LOCATION_ID', 'STATUS', 'NAME', 'ADDRESS', 'PHONE', 'CELLPHONE', 'FAX', 'DESCRIPTION', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'EntityId' => 1, 'LocationId' => 2, 'Status' => 3, 'Name' => 4, 'Address' => 5, 'Phone' => 6, 'Cellphone' => 7, 'Fax' => 8, 'Description' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'entityId' => 1, 'locationId' => 2, 'status' => 3, 'name' => 4, 'address' => 5, 'phone' => 6, 'cellphone' => 7, 'fax' => 8, 'description' => 9, ],
        self::TYPE_COLNAME       => [SysEntityBranchTableMap::COL_ID => 0, SysEntityBranchTableMap::COL_ENTITY_ID => 1, SysEntityBranchTableMap::COL_LOCATION_ID => 2, SysEntityBranchTableMap::COL_STATUS => 3, SysEntityBranchTableMap::COL_NAME => 4, SysEntityBranchTableMap::COL_ADDRESS => 5, SysEntityBranchTableMap::COL_PHONE => 6, SysEntityBranchTableMap::COL_CELLPHONE => 7, SysEntityBranchTableMap::COL_FAX => 8, SysEntityBranchTableMap::COL_DESCRIPTION => 9, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'ENTITY_ID' => 1, 'LOCATION_ID' => 2, 'STATUS' => 3, 'NAME' => 4, 'ADDRESS' => 5, 'PHONE' => 6, 'CELLPHONE' => 7, 'FAX' => 8, 'DESCRIPTION' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysEntityBranch.Id' => 'ID',
        'id' => 'ID',
        'sysEntityBranch.id' => 'ID',
        'SysEntityBranchTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_entity_branch.ID' => 'ID',
        'EntityId' => 'ENTITY_ID',
        'SysEntityBranch.EntityId' => 'ENTITY_ID',
        'entityId' => 'ENTITY_ID',
        'sysEntityBranch.entityId' => 'ENTITY_ID',
        'SysEntityBranchTableMap::COL_ENTITY_ID' => 'ENTITY_ID',
        'COL_ENTITY_ID' => 'ENTITY_ID',
        'ENTITY_ID' => 'ENTITY_ID',
        'sys_entity_branch.ENTITY_ID' => 'ENTITY_ID',
        'LocationId' => 'LOCATION_ID',
        'SysEntityBranch.LocationId' => 'LOCATION_ID',
        'locationId' => 'LOCATION_ID',
        'sysEntityBranch.locationId' => 'LOCATION_ID',
        'SysEntityBranchTableMap::COL_LOCATION_ID' => 'LOCATION_ID',
        'COL_LOCATION_ID' => 'LOCATION_ID',
        'LOCATION_ID' => 'LOCATION_ID',
        'sys_entity_branch.LOCATION_ID' => 'LOCATION_ID',
        'Status' => 'STATUS',
        'SysEntityBranch.Status' => 'STATUS',
        'status' => 'STATUS',
        'sysEntityBranch.status' => 'STATUS',
        'SysEntityBranchTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'STATUS' => 'STATUS',
        'sys_entity_branch.STATUS' => 'STATUS',
        'Name' => 'NAME',
        'SysEntityBranch.Name' => 'NAME',
        'name' => 'NAME',
        'sysEntityBranch.name' => 'NAME',
        'SysEntityBranchTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'NAME' => 'NAME',
        'sys_entity_branch.NAME' => 'NAME',
        'Address' => 'ADDRESS',
        'SysEntityBranch.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'sysEntityBranch.address' => 'ADDRESS',
        'SysEntityBranchTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'ADDRESS' => 'ADDRESS',
        'sys_entity_branch.ADDRESS' => 'ADDRESS',
        'Phone' => 'PHONE',
        'SysEntityBranch.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'sysEntityBranch.phone' => 'PHONE',
        'SysEntityBranchTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'PHONE' => 'PHONE',
        'sys_entity_branch.PHONE' => 'PHONE',
        'Cellphone' => 'CELLPHONE',
        'SysEntityBranch.Cellphone' => 'CELLPHONE',
        'cellphone' => 'CELLPHONE',
        'sysEntityBranch.cellphone' => 'CELLPHONE',
        'SysEntityBranchTableMap::COL_CELLPHONE' => 'CELLPHONE',
        'COL_CELLPHONE' => 'CELLPHONE',
        'CELLPHONE' => 'CELLPHONE',
        'sys_entity_branch.CELLPHONE' => 'CELLPHONE',
        'Fax' => 'FAX',
        'SysEntityBranch.Fax' => 'FAX',
        'fax' => 'FAX',
        'sysEntityBranch.fax' => 'FAX',
        'SysEntityBranchTableMap::COL_FAX' => 'FAX',
        'COL_FAX' => 'FAX',
        'FAX' => 'FAX',
        'sys_entity_branch.FAX' => 'FAX',
        'Description' => 'DESCRIPTION',
        'SysEntityBranch.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'sysEntityBranch.description' => 'DESCRIPTION',
        'SysEntityBranchTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'DESCRIPTION' => 'DESCRIPTION',
        'sys_entity_branch.DESCRIPTION' => 'DESCRIPTION',
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
        $this->setName('sys_entity_branch');
        $this->setPhpName('SysEntityBranch');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysEntityBranch');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ENTITY_ID', 'EntityId', 'INTEGER', 'sys_entity', 'ID', true, null, null);
        $this->addForeignKey('LOCATION_ID', 'LocationId', 'INTEGER', 'sys_location', 'ID', true, null, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 10, 'ACTIVE');
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('ADDRESS', 'Address', 'VARCHAR', true, 20, null);
        $this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 30, null);
        $this->addColumn('CELLPHONE', 'Cellphone', 'VARCHAR', false, 30, null);
        $this->addColumn('FAX', 'Fax', 'VARCHAR', false, 30, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SysEntity', '\\SysEntity', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ENTITY_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('SysLocation', '\\SysLocation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':LOCATION_ID',
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
        return $withPrefix ? SysEntityBranchTableMap::CLASS_DEFAULT : SysEntityBranchTableMap::OM_CLASS;
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
     * @return array (SysEntityBranch object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SysEntityBranchTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysEntityBranchTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysEntityBranchTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysEntityBranchTableMap::OM_CLASS;
            /** @var SysEntityBranch $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysEntityBranchTableMap::addInstanceToPool($obj, $key);
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
            $key = SysEntityBranchTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysEntityBranchTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysEntityBranch $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysEntityBranchTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_ID);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_ENTITY_ID);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_STATUS);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_NAME);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_PHONE);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_CELLPHONE);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_FAX);
            $criteria->addSelectColumn(SysEntityBranchTableMap::COL_DESCRIPTION);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ENTITY_ID');
            $criteria->addSelectColumn($alias . '.LOCATION_ID');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.ADDRESS');
            $criteria->addSelectColumn($alias . '.PHONE');
            $criteria->addSelectColumn($alias . '.CELLPHONE');
            $criteria->addSelectColumn($alias . '.FAX');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
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
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_ID);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_ENTITY_ID);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_LOCATION_ID);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_NAME);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_PHONE);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_CELLPHONE);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_FAX);
            $criteria->removeSelectColumn(SysEntityBranchTableMap::COL_DESCRIPTION);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.ENTITY_ID');
            $criteria->removeSelectColumn($alias . '.LOCATION_ID');
            $criteria->removeSelectColumn($alias . '.STATUS');
            $criteria->removeSelectColumn($alias . '.NAME');
            $criteria->removeSelectColumn($alias . '.ADDRESS');
            $criteria->removeSelectColumn($alias . '.PHONE');
            $criteria->removeSelectColumn($alias . '.CELLPHONE');
            $criteria->removeSelectColumn($alias . '.FAX');
            $criteria->removeSelectColumn($alias . '.DESCRIPTION');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysEntityBranchTableMap::DATABASE_NAME)->getTable(SysEntityBranchTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysEntityBranch or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysEntityBranch object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityBranchTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysEntityBranch) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysEntityBranchTableMap::DATABASE_NAME);
            $criteria->add(SysEntityBranchTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysEntityBranchQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysEntityBranchTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysEntityBranchTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_entity_branch table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysEntityBranchQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysEntityBranch or Criteria object.
     *
     * @param mixed $criteria Criteria or SysEntityBranch object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityBranchTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysEntityBranch object
        }

        if ($criteria->containsKey(SysEntityBranchTableMap::COL_ID) && $criteria->keyContainsValue(SysEntityBranchTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysEntityBranchTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysEntityBranchQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
