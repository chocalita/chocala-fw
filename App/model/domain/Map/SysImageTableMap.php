<?php

namespace Map;

use \SysImage;
use \SysImageQuery;
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
 * This class defines the structure of the 'sys_image' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SysImageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.SysImageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sys_image';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SysImage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\SysImage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'SysImage';

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
    public const COL_ID = 'sys_image.ID';

    /**
     * the column name for the USER_ID field
     */
    public const COL_USER_ID = 'sys_image.USER_ID';

    /**
     * the column name for the TITLE field
     */
    public const COL_TITLE = 'sys_image.TITLE';

    /**
     * the column name for the DESCRIPTION field
     */
    public const COL_DESCRIPTION = 'sys_image.DESCRIPTION';

    /**
     * the column name for the IMG_NAME field
     */
    public const COL_IMG_NAME = 'sys_image.IMG_NAME';

    /**
     * the column name for the IMG_TYPE field
     */
    public const COL_IMG_TYPE = 'sys_image.IMG_TYPE';

    /**
     * the column name for the IMG_SIZE field
     */
    public const COL_IMG_SIZE = 'sys_image.IMG_SIZE';

    /**
     * the column name for the LAST_USER_ID field
     */
    public const COL_LAST_USER_ID = 'sys_image.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    public const COL_CREATION_DATE = 'sys_image.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    public const COL_MODIFICATION_DATE = 'sys_image.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => ['Id', 'UserId', 'Title', 'Description', 'ImgName', 'ImgType', 'ImgSize', 'LastUserId', 'CreationDate', 'ModificationDate', ],
        self::TYPE_CAMELNAME     => ['id', 'userId', 'title', 'description', 'imgName', 'imgType', 'imgSize', 'lastUserId', 'creationDate', 'modificationDate', ],
        self::TYPE_COLNAME       => [SysImageTableMap::COL_ID, SysImageTableMap::COL_USER_ID, SysImageTableMap::COL_TITLE, SysImageTableMap::COL_DESCRIPTION, SysImageTableMap::COL_IMG_NAME, SysImageTableMap::COL_IMG_TYPE, SysImageTableMap::COL_IMG_SIZE, SysImageTableMap::COL_LAST_USER_ID, SysImageTableMap::COL_CREATION_DATE, SysImageTableMap::COL_MODIFICATION_DATE, ],
        self::TYPE_FIELDNAME     => ['ID', 'USER_ID', 'TITLE', 'DESCRIPTION', 'IMG_NAME', 'IMG_TYPE', 'IMG_SIZE', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'UserId' => 1, 'Title' => 2, 'Description' => 3, 'ImgName' => 4, 'ImgType' => 5, 'ImgSize' => 6, 'LastUserId' => 7, 'CreationDate' => 8, 'ModificationDate' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'userId' => 1, 'title' => 2, 'description' => 3, 'imgName' => 4, 'imgType' => 5, 'imgSize' => 6, 'lastUserId' => 7, 'creationDate' => 8, 'modificationDate' => 9, ],
        self::TYPE_COLNAME       => [SysImageTableMap::COL_ID => 0, SysImageTableMap::COL_USER_ID => 1, SysImageTableMap::COL_TITLE => 2, SysImageTableMap::COL_DESCRIPTION => 3, SysImageTableMap::COL_IMG_NAME => 4, SysImageTableMap::COL_IMG_TYPE => 5, SysImageTableMap::COL_IMG_SIZE => 6, SysImageTableMap::COL_LAST_USER_ID => 7, SysImageTableMap::COL_CREATION_DATE => 8, SysImageTableMap::COL_MODIFICATION_DATE => 9, ],
        self::TYPE_FIELDNAME     => ['ID' => 0, 'USER_ID' => 1, 'TITLE' => 2, 'DESCRIPTION' => 3, 'IMG_NAME' => 4, 'IMG_TYPE' => 5, 'IMG_SIZE' => 6, 'LAST_USER_ID' => 7, 'CREATION_DATE' => 8, 'MODIFICATION_DATE' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'SysImage.Id' => 'ID',
        'id' => 'ID',
        'sysImage.id' => 'ID',
        'SysImageTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ID' => 'ID',
        'sys_image.ID' => 'ID',
        'UserId' => 'USER_ID',
        'SysImage.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'sysImage.userId' => 'USER_ID',
        'SysImageTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'USER_ID' => 'USER_ID',
        'sys_image.USER_ID' => 'USER_ID',
        'Title' => 'TITLE',
        'SysImage.Title' => 'TITLE',
        'title' => 'TITLE',
        'sysImage.title' => 'TITLE',
        'SysImageTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'TITLE' => 'TITLE',
        'sys_image.TITLE' => 'TITLE',
        'Description' => 'DESCRIPTION',
        'SysImage.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'sysImage.description' => 'DESCRIPTION',
        'SysImageTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'DESCRIPTION' => 'DESCRIPTION',
        'sys_image.DESCRIPTION' => 'DESCRIPTION',
        'ImgName' => 'IMG_NAME',
        'SysImage.ImgName' => 'IMG_NAME',
        'imgName' => 'IMG_NAME',
        'sysImage.imgName' => 'IMG_NAME',
        'SysImageTableMap::COL_IMG_NAME' => 'IMG_NAME',
        'COL_IMG_NAME' => 'IMG_NAME',
        'IMG_NAME' => 'IMG_NAME',
        'sys_image.IMG_NAME' => 'IMG_NAME',
        'ImgType' => 'IMG_TYPE',
        'SysImage.ImgType' => 'IMG_TYPE',
        'imgType' => 'IMG_TYPE',
        'sysImage.imgType' => 'IMG_TYPE',
        'SysImageTableMap::COL_IMG_TYPE' => 'IMG_TYPE',
        'COL_IMG_TYPE' => 'IMG_TYPE',
        'IMG_TYPE' => 'IMG_TYPE',
        'sys_image.IMG_TYPE' => 'IMG_TYPE',
        'ImgSize' => 'IMG_SIZE',
        'SysImage.ImgSize' => 'IMG_SIZE',
        'imgSize' => 'IMG_SIZE',
        'sysImage.imgSize' => 'IMG_SIZE',
        'SysImageTableMap::COL_IMG_SIZE' => 'IMG_SIZE',
        'COL_IMG_SIZE' => 'IMG_SIZE',
        'IMG_SIZE' => 'IMG_SIZE',
        'sys_image.IMG_SIZE' => 'IMG_SIZE',
        'LastUserId' => 'LAST_USER_ID',
        'SysImage.LastUserId' => 'LAST_USER_ID',
        'lastUserId' => 'LAST_USER_ID',
        'sysImage.lastUserId' => 'LAST_USER_ID',
        'SysImageTableMap::COL_LAST_USER_ID' => 'LAST_USER_ID',
        'COL_LAST_USER_ID' => 'LAST_USER_ID',
        'LAST_USER_ID' => 'LAST_USER_ID',
        'sys_image.LAST_USER_ID' => 'LAST_USER_ID',
        'CreationDate' => 'CREATION_DATE',
        'SysImage.CreationDate' => 'CREATION_DATE',
        'creationDate' => 'CREATION_DATE',
        'sysImage.creationDate' => 'CREATION_DATE',
        'SysImageTableMap::COL_CREATION_DATE' => 'CREATION_DATE',
        'COL_CREATION_DATE' => 'CREATION_DATE',
        'CREATION_DATE' => 'CREATION_DATE',
        'sys_image.CREATION_DATE' => 'CREATION_DATE',
        'ModificationDate' => 'MODIFICATION_DATE',
        'SysImage.ModificationDate' => 'MODIFICATION_DATE',
        'modificationDate' => 'MODIFICATION_DATE',
        'sysImage.modificationDate' => 'MODIFICATION_DATE',
        'SysImageTableMap::COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'COL_MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'MODIFICATION_DATE' => 'MODIFICATION_DATE',
        'sys_image.MODIFICATION_DATE' => 'MODIFICATION_DATE',
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
        $this->setName('sys_image');
        $this->setPhpName('SysImage');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysImage');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addColumn('TITLE', 'Title', 'VARCHAR', true, 500, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('IMG_NAME', 'ImgName', 'VARCHAR', true, 500, null);
        $this->addColumn('IMG_TYPE', 'ImgType', 'VARCHAR', true, 30, null);
        $this->addColumn('IMG_SIZE', 'ImgSize', 'INTEGER', true, null, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, null);
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
        return $withPrefix ? SysImageTableMap::CLASS_DEFAULT : SysImageTableMap::OM_CLASS;
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
     * @return array (SysImage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SysImageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysImageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysImageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysImageTableMap::OM_CLASS;
            /** @var SysImage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysImageTableMap::addInstanceToPool($obj, $key);
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
            $key = SysImageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysImageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysImage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysImageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysImageTableMap::COL_ID);
            $criteria->addSelectColumn(SysImageTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysImageTableMap::COL_TITLE);
            $criteria->addSelectColumn(SysImageTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysImageTableMap::COL_IMG_NAME);
            $criteria->addSelectColumn(SysImageTableMap::COL_IMG_TYPE);
            $criteria->addSelectColumn(SysImageTableMap::COL_IMG_SIZE);
            $criteria->addSelectColumn(SysImageTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysImageTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysImageTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.TITLE');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.IMG_NAME');
            $criteria->addSelectColumn($alias . '.IMG_TYPE');
            $criteria->addSelectColumn($alias . '.IMG_SIZE');
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
            $criteria->removeSelectColumn(SysImageTableMap::COL_ID);
            $criteria->removeSelectColumn(SysImageTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(SysImageTableMap::COL_TITLE);
            $criteria->removeSelectColumn(SysImageTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SysImageTableMap::COL_IMG_NAME);
            $criteria->removeSelectColumn(SysImageTableMap::COL_IMG_TYPE);
            $criteria->removeSelectColumn(SysImageTableMap::COL_IMG_SIZE);
            $criteria->removeSelectColumn(SysImageTableMap::COL_LAST_USER_ID);
            $criteria->removeSelectColumn(SysImageTableMap::COL_CREATION_DATE);
            $criteria->removeSelectColumn(SysImageTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.ID');
            $criteria->removeSelectColumn($alias . '.USER_ID');
            $criteria->removeSelectColumn($alias . '.TITLE');
            $criteria->removeSelectColumn($alias . '.DESCRIPTION');
            $criteria->removeSelectColumn($alias . '.IMG_NAME');
            $criteria->removeSelectColumn($alias . '.IMG_TYPE');
            $criteria->removeSelectColumn($alias . '.IMG_SIZE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysImageTableMap::DATABASE_NAME)->getTable(SysImageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SysImage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SysImage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysImageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysImage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysImageTableMap::DATABASE_NAME);
            $criteria->add(SysImageTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysImageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysImageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysImageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SysImageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysImage or Criteria object.
     *
     * @param mixed $criteria Criteria or SysImage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysImageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysImage object
        }

        if ($criteria->containsKey(SysImageTableMap::COL_ID) && $criteria->keyContainsValue(SysImageTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysImageTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysImageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
