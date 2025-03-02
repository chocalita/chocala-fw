<?php

namespace Map;

use \SysModule;
use \SysModuleQuery;
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
 * This class defines the structure of the 'sys_module' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SysModuleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysModuleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_module';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysModule';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysModule';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysModule';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the ID field
     */
    public const COL_ID = 'sys_module.ID';

    /**
     * the column name for the NAME field
     */
    public const COL_NAME = 'sys_module.NAME';

    /**
     * the column name for the URI field
     */
    public const COL_URI = 'sys_module.URI';

    /**
     * the column name for the ACCESS field
     */
    public const COL_ACCESS = 'sys_module.ACCESS';

    /**
     * the column name for the POSITION field
     */
    public const COL_POSITION = 'sys_module.POSITION';

    /**
     * the column name for the DESCRIPTION field
     */
    public const COL_DESCRIPTION = 'sys_module.DESCRIPTION';

    /**
     * the column name for the ICON_CLASS field
     */
    public const COL_ICON_CLASS = 'sys_module.ICON_CLASS';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Uri', 'Access', 'Position', 'Description', 'IconClass', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'uri', 'access', 'position', 'description', 'iconClass', ],
        self::TYPE_COLNAME       => [SysModuleTableMap::COL_ID, SysModuleTableMap::COL_NAME, SysModuleTableMap::COL_URI, SysModuleTableMap::COL_ACCESS, SysModuleTableMap::COL_POSITION, SysModuleTableMap::COL_DESCRIPTION, SysModuleTableMap::COL_ICON_CLASS, ],
        self::TYPE_FIELDNAME     => ['ID', 'NAME', 'URI', 'ACCESS', 'POSITION', 'DESCRIPTION', 'ICON_CLASS', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Uri' => 2, 'Access' => 3, 'Position' => 4, 'Description' => 5, 'IconClass' => 6, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'uri' => 2, 'access' => 3, 'position' => 4, 'description' => 5, 'iconClass' => 6, ],
        self::TYPE_COLNAME       => [SysModuleTableMap::COL_ID => 0, SysModuleTableMap::COL_NAME => 1, SysModuleTableMap::COL_URI => 2, SysModuleTableMap::COL_ACCESS => 3, SysModuleTableMap::COL_POSITION => 4, SysModuleTableMap::COL_DESCRIPTION => 5, SysModuleTableMap::COL_ICON_CLASS => 6, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'NAME' => 1, 'URI' => 2, 'ACCESS' => 3, 'POSITION' => 4, 'DESCRIPTION' => 5, 'ICON_CLASS' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysModule.Id' => 'ID',
        'id' => 'ID',
        'sysModule.id' => 'ID',
        'SysModuleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_module.ID' => 'ID',
        'Name' => 'NAME',
        'SysModule.Name' => 'NAME',
        'name' => 'NAME',
        'sysModule.name' => 'NAME',
        'SysModuleTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'NAME' => 'NAME',
        'sys_module.NAME' => 'NAME',
        'Uri' => 'URI',
        'SysModule.Uri' => 'URI',
        'uri' => 'URI',
        'sysModule.uri' => 'URI',
        'SysModuleTableMap::COL_URI' => 'URI',
        'COL_URI' => 'URI',
        'URI' => 'URI',
        'sys_module.URI' => 'URI',
        'Access' => 'ACCESS',
        'SysModule.Access' => 'ACCESS',
        'access' => 'ACCESS',
        'sysModule.access' => 'ACCESS',
        'SysModuleTableMap::COL_ACCESS' => 'ACCESS',
        'COL_ACCESS' => 'ACCESS',
        'ACCESS' => 'ACCESS',
        'sys_module.ACCESS' => 'ACCESS',
        'Position' => 'POSITION',
        'SysModule.Position' => 'POSITION',
        'position' => 'POSITION',
        'sysModule.position' => 'POSITION',
        'SysModuleTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'POSITION' => 'POSITION',
        'sys_module.POSITION' => 'POSITION',
        'Description' => 'DESCRIPTION',
        'SysModule.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'sysModule.description' => 'DESCRIPTION',
        'SysModuleTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'DESCRIPTION' => 'DESCRIPTION',
        'sys_module.DESCRIPTION' => 'DESCRIPTION',
        'IconClass' => 'ICON_CLASS',
        'SysModule.IconClass' => 'ICON_CLASS',
        'iconClass' => 'ICON_CLASS',
        'sysModule.iconClass' => 'ICON_CLASS',
        'SysModuleTableMap::COL_ICON_CLASS' => 'ICON_CLASS',
        'COL_ICON_CLASS' => 'ICON_CLASS',
        'ICON_CLASS' => 'ICON_CLASS',
        'sys_module.ICON_CLASS' => 'ICON_CLASS',
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
        $this->setName('sys_module');
        $this->setPhpName('SysModule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysModule');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 30, null);
        $this->addColumn('URI', 'Uri', 'VARCHAR', true, 30, null);
        $this->addColumn('ACCESS', 'Access', 'VARCHAR', true, 20, null);
        $this->addColumn('POSITION', 'Position', 'INTEGER', true, null, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('ICON_CLASS', 'IconClass', 'VARCHAR', false, 100, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SysUri', '\\SysUri', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':MODULE_ID',
    1 => ':ID',
  ),
), null, null, 'SysUris', false);
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
        return $withPrefix ? SysModuleTableMap::CLASS_DEFAULT : SysModuleTableMap::OM_CLASS;
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
     * @return array (SysModule object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SysModuleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysModuleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysModuleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysModuleTableMap::OM_CLASS;
            /** @var SysModule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysModuleTableMap::addInstanceToPool($obj, $key);
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
            $key = SysModuleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysModuleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysModule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysModuleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysModuleTableMap::COL_ID);
            $criteria->addSelectColumn(SysModuleTableMap::COL_NAME);
            $criteria->addSelectColumn(SysModuleTableMap::COL_URI);
            $criteria->addSelectColumn(SysModuleTableMap::COL_ACCESS);
            $criteria->addSelectColumn(SysModuleTableMap::COL_POSITION);
            $criteria->addSelectColumn(SysModuleTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysModuleTableMap::COL_ICON_CLASS);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.URI');
            $criteria->addSelectColumn($alias . '.ACCESS');
            $criteria->addSelectColumn($alias . '.POSITION');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.ICON_CLASS');
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
            $criteria->removeSelectColumn(SysModuleTableMap::COL_ID);
            $criteria->removeSelectColumn(SysModuleTableMap::COL_NAME);
            $criteria->removeSelectColumn(SysModuleTableMap::COL_URI);
            $criteria->removeSelectColumn(SysModuleTableMap::COL_ACCESS);
            $criteria->removeSelectColumn(SysModuleTableMap::COL_POSITION);
            $criteria->removeSelectColumn(SysModuleTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SysModuleTableMap::COL_ICON_CLASS);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.NAME');
            $criteria->removeSelectColumn($alias . '.URI');
            $criteria->removeSelectColumn($alias . '.ACCESS');
            $criteria->removeSelectColumn($alias . '.POSITION');
            $criteria->removeSelectColumn($alias . '.DESCRIPTION');
            $criteria->removeSelectColumn($alias . '.ICON_CLASS');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysModuleTableMap::DATABASE_NAME)->getTable(SysModuleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysModule or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysModule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysModuleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysModule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysModuleTableMap::DATABASE_NAME);
            $criteria->add(SysModuleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysModuleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysModuleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysModuleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_module table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysModuleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysModule or Criteria object.
     *
     * @param mixed $criteria Criteria or SysModule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysModuleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysModule object
        }

        if ($criteria->containsKey(SysModuleTableMap::COL_ID) && $criteria->keyContainsValue(SysModuleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysModuleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysModuleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
