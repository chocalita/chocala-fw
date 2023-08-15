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
 */
class SysParamTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysParamTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_param';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysParam';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysParam';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysParam';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the ID field
     */
    public const COL_ID = 'sys_param.ID';

    /**
     * the column name for the VISIBILITY field
     */
    public const COL_VISIBILITY = 'sys_param.VISIBILITY';

    /**
     * the column name for the CODE field
     */
    public const COL_CODE = 'sys_param.CODE';

    /**
     * the column name for the NAME field
     */
    public const COL_NAME = 'sys_param.NAME';

    /**
     * the column name for the TYPE field
     */
    public const COL_TYPE = 'sys_param.TYPE';

    /**
     * the column name for the VALUE field
     */
    public const COL_VALUE = 'sys_param.VALUE';

    /**
     * the column name for the OPTIONS field
     */
    public const COL_OPTIONS = 'sys_param.OPTIONS';

    /**
     * the column name for the DESCRIPTION field
     */
    public const COL_DESCRIPTION = 'sys_param.DESCRIPTION';

    /**
     * the column name for the CUSTOMIZABLE field
     */
    public const COL_CUSTOMIZABLE = 'sys_param.CUSTOMIZABLE';

    /**
     * the column name for the LAST_USER_ID field
     */
    public const COL_LAST_USER_ID = 'sys_param.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    public const COL_CREATION_DATE = 'sys_param.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    public const COL_MODIFICATION_DATE = 'sys_param.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => ['Id', 'Visibility', 'Code', 'Name', 'Type', 'Value', 'Options', 'Description', 'Customizable', 'LastUserId', 'CreationDate', 'ModificationDate', ],
        self::TYPE_CAMELNAME     => ['id', 'visibility', 'code', 'name', 'type', 'value', 'options', 'description', 'customizable', 'lastUserId', 'creationDate', 'modificationDate', ],
        self::TYPE_COLNAME       => [SysParamTableMap::COL_ID, SysParamTableMap::COL_VISIBILITY, SysParamTableMap::COL_CODE, SysParamTableMap::COL_NAME, SysParamTableMap::COL_TYPE, SysParamTableMap::COL_VALUE, SysParamTableMap::COL_OPTIONS, SysParamTableMap::COL_DESCRIPTION, SysParamTableMap::COL_CUSTOMIZABLE, SysParamTableMap::COL_LAST_USER_ID, SysParamTableMap::COL_CREATION_DATE, SysParamTableMap::COL_MODIFICATION_DATE, ],
        self::TYPE_FIELDNAME     => ['ID', 'VISIBILITY', 'CODE', 'NAME', 'TYPE', 'VALUE', 'OPTIONS', 'DESCRIPTION', 'CUSTOMIZABLE', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Visibility' => 1, 'Code' => 2, 'Name' => 3, 'Type' => 4, 'Value' => 5, 'Options' => 6, 'Description' => 7, 'Customizable' => 8, 'LastUserId' => 9, 'CreationDate' => 10, 'ModificationDate' => 11, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'visibility' => 1, 'code' => 2, 'name' => 3, 'type' => 4, 'value' => 5, 'options' => 6, 'description' => 7, 'customizable' => 8, 'lastUserId' => 9, 'creationDate' => 10, 'modificationDate' => 11, ],
        self::TYPE_COLNAME       => [SysParamTableMap::COL_ID => 0, SysParamTableMap::COL_VISIBILITY => 1, SysParamTableMap::COL_CODE => 2, SysParamTableMap::COL_NAME => 3, SysParamTableMap::COL_TYPE => 4, SysParamTableMap::COL_VALUE => 5, SysParamTableMap::COL_OPTIONS => 6, SysParamTableMap::COL_DESCRIPTION => 7, SysParamTableMap::COL_CUSTOMIZABLE => 8, SysParamTableMap::COL_LAST_USER_ID => 9, SysParamTableMap::COL_CREATION_DATE => 10, SysParamTableMap::COL_MODIFICATION_DATE => 11, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'VISIBILITY' => 1, 'CODE' => 2, 'NAME' => 3, 'TYPE' => 4, 'VALUE' => 5, 'OPTIONS' => 6, 'DESCRIPTION' => 7, 'CUSTOMIZABLE' => 8, 'LAST_USER_ID' => 9, 'CREATION_DATE' => 10, 'MODIFICATION_DATE' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysParam.Id' => 'ID',
        'id' => 'ID',
        'sysParam.id' => 'ID',
        'SysParamTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_param.ID' => 'ID',
        'Visibility' => 'VISIBILITY',
        'SysParam.Visibility' => 'VISIBILITY',
        'visibility' => 'VISIBILITY',
        'sysParam.visibility' => 'VISIBILITY',
        'SysParamTableMap::COL_VISIBILITY' => 'VISIBILITY',
        'COL_VISIBILITY' => 'VISIBILITY',
        'VISIBILITY' => 'VISIBILITY',
        'sys_param.VISIBILITY' => 'VISIBILITY',
        'Code' => 'CODE',
        'SysParam.Code' => 'CODE',
        'code' => 'CODE',
        'sysParam.code' => 'CODE',
        'SysParamTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'CODE' => 'CODE',
        'sys_param.CODE' => 'CODE',
        'Name' => 'NAME',
        'SysParam.Name' => 'NAME',
        'name' => 'NAME',
        'sysParam.name' => 'NAME',
        'SysParamTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'NAME' => 'NAME',
        'sys_param.NAME' => 'NAME',
        'Type' => 'TYPE',
        'SysParam.Type' => 'TYPE',
        'type' => 'TYPE',
        'sysParam.type' => 'TYPE',
        'SysParamTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'TYPE' => 'TYPE',
        'sys_param.TYPE' => 'TYPE',
        'Value' => 'VALUE',
        'SysParam.Value' => 'VALUE',
        'value' => 'VALUE',
        'sysParam.value' => 'VALUE',
        'SysParamTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'VALUE' => 'VALUE',
        'sys_param.VALUE' => 'VALUE',
        'Options' => 'OPTIONS',
        'SysParam.Options' => 'OPTIONS',
        'options' => 'OPTIONS',
        'sysParam.options' => 'OPTIONS',
        'SysParamTableMap::COL_OPTIONS' => 'OPTIONS',
        'COL_OPTIONS' => 'OPTIONS',
        'OPTIONS' => 'OPTIONS',
        'sys_param.OPTIONS' => 'OPTIONS',
        'Description' => 'DESCRIPTION',
        'SysParam.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'sysParam.description' => 'DESCRIPTION',
        'SysParamTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'DESCRIPTION' => 'DESCRIPTION',
        'sys_param.DESCRIPTION' => 'DESCRIPTION',
        'Customizable' => 'CUSTOMIZABLE',
        'SysParam.Customizable' => 'CUSTOMIZABLE',
        'customizable' => 'CUSTOMIZABLE',
        'sysParam.customizable' => 'CUSTOMIZABLE',
        'SysParamTableMap::COL_CUSTOMIZABLE' => 'CUSTOMIZABLE',
        'COL_CUSTOMIZABLE' => 'CUSTOMIZABLE',
        'CUSTOMIZABLE' => 'CUSTOMIZABLE',
        'sys_param.CUSTOMIZABLE' => 'CUSTOMIZABLE',
        'LastUserId' => 'LAST_USER_ID',
        'SysParam.LastUserId' => 'LAST_USER_ID',
        'lastUserId' => 'LAST_USER_ID',
        'sysParam.lastUserId' => 'LAST_USER_ID',
        'SysParamTableMap::COL_LAST_USER_ID' => 'LAST_USER_ID',
        'COL_LAST_USER_ID' => 'LAST_USER_ID',
        'LAST_USER_ID' => 'LAST_USER_ID',
        'sys_param.LAST_USER_ID' => 'LAST_USER_ID',
        'CreationDate' => 'CREATION_DATE',
        'SysParam.CreationDate' => 'CREATION_DATE',
        'creationDate' => 'CREATION_DATE',
        'sysParam.creationDate' => 'CREATION_DATE',
        'SysParamTableMap::COL_CREATION_DATE' => 'CREATION_DATE',
        'COL_CREATION_DATE' => 'CREATION_DATE',
        'CREATION_DATE' => 'CREATION_DATE',
        'sys_param.CREATION_DATE' => 'CREATION_DATE',
        'ModificationDate' => 'MODIFICATION_DATE',
        'SysParam.ModificationDate' => 'MODIFICATION_DATE',
        'modificationDate' => 'MODIFICATION_DATE',
        'sysParam.modificationDate' => 'MODIFICATION_DATE',
        'SysParamTableMap::COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'sys_param.MODIFICATION_DATE' => 'MODIFICATION_DATE',
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
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
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
        return $withPrefix ? SysParamTableMap::CLASS_DEFAULT : SysParamTableMap::OM_CLASS;
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
     * @return array (SysParam object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
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
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
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
            $criteria->removeSelectColumn(SysParamTableMap::COL_ID);
            $criteria->removeSelectColumn(SysParamTableMap::COL_VISIBILITY);
            $criteria->removeSelectColumn(SysParamTableMap::COL_CODE);
            $criteria->removeSelectColumn(SysParamTableMap::COL_NAME);
            $criteria->removeSelectColumn(SysParamTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SysParamTableMap::COL_VALUE);
            $criteria->removeSelectColumn(SysParamTableMap::COL_OPTIONS);
            $criteria->removeSelectColumn(SysParamTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SysParamTableMap::COL_CUSTOMIZABLE);
            $criteria->removeSelectColumn(SysParamTableMap::COL_LAST_USER_ID);
            $criteria->removeSelectColumn(SysParamTableMap::COL_CREATION_DATE);
            $criteria->removeSelectColumn(SysParamTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.VISIBILITY');
            $criteria->removeSelectColumn($alias . '.CODE');
            $criteria->removeSelectColumn($alias . '.NAME');
            $criteria->removeSelectColumn($alias . '.TYPE');
            $criteria->removeSelectColumn($alias . '.VALUE');
            $criteria->removeSelectColumn($alias . '.OPTIONS');
            $criteria->removeSelectColumn($alias . '.DESCRIPTION');
            $criteria->removeSelectColumn($alias . '.CUSTOMIZABLE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysParamTableMap::DATABASE_NAME)->getTable(SysParamTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysParam or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysParam object or primary key or array of primary keys
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
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysParamQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysParam or Criteria object.
     *
     * @param mixed $criteria Criteria or SysParam object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
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

}
