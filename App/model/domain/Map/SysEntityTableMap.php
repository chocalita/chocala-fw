<?php

namespace Map;

use \SysEntity;
use \SysEntityQuery;
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
 * This class defines the structure of the 'sys_entity' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysEntityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysEntityTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_entity';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysEntity';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysEntity';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'sys_entity.ID';

    /**
     * the column name for the ENTITY_TYPE_ID field
     */
    const COL_ENTITY_TYPE_ID = 'sys_entity.ENTITY_TYPE_ID';

    /**
     * the column name for the LOCATION_ID field
     */
    const COL_LOCATION_ID = 'sys_entity.LOCATION_ID';

    /**
     * the column name for the MAIN_BRANCH_ID field
     */
    const COL_MAIN_BRANCH_ID = 'sys_entity.MAIN_BRANCH_ID';

    /**
     * the column name for the CODE field
     */
    const COL_CODE = 'sys_entity.CODE';

    /**
     * the column name for the COMERCIAL_NAME field
     */
    const COL_COMERCIAL_NAME = 'sys_entity.COMERCIAL_NAME';

    /**
     * the column name for the FORMAL_NAME field
     */
    const COL_FORMAL_NAME = 'sys_entity.FORMAL_NAME';

    /**
     * the column name for the NIT field
     */
    const COL_NIT = 'sys_entity.NIT';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'sys_entity.EMAIL';

    /**
     * the column name for the ADDRESS field
     */
    const COL_ADDRESS = 'sys_entity.ADDRESS';

    /**
     * the column name for the PHONE field
     */
    const COL_PHONE = 'sys_entity.PHONE';

    /**
     * the column name for the CELLPHONE field
     */
    const COL_CELLPHONE = 'sys_entity.CELLPHONE';

    /**
     * the column name for the ACTIVITIES field
     */
    const COL_ACTIVITIES = 'sys_entity.ACTIVITIES';

    /**
     * the column name for the DESCRIPTION field
     */
    const COL_DESCRIPTION = 'sys_entity.DESCRIPTION';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'sys_entity.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'sys_entity.CREATION_DATE';

    /**
     * the column name for the MODIFICACION_DATE field
     */
    const COL_MODIFICACION_DATE = 'sys_entity.MODIFICACION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'EntityTypeId', 'LocationId', 'MainBranchId', 'Code', 'ComercialName', 'FormalName', 'Nit', 'Email', 'Address', 'Phone', 'Cellphone', 'Activities', 'Description', 'LastUserId', 'CreationDate', 'ModificacionDate', ),
        self::TYPE_CAMELNAME     => array('id', 'entityTypeId', 'locationId', 'mainBranchId', 'code', 'comercialName', 'formalName', 'nit', 'email', 'address', 'phone', 'cellphone', 'activities', 'description', 'lastUserId', 'creationDate', 'modificacionDate', ),
        self::TYPE_COLNAME       => array(SysEntityTableMap::COL_ID, SysEntityTableMap::COL_ENTITY_TYPE_ID, SysEntityTableMap::COL_LOCATION_ID, SysEntityTableMap::COL_MAIN_BRANCH_ID, SysEntityTableMap::COL_CODE, SysEntityTableMap::COL_COMERCIAL_NAME, SysEntityTableMap::COL_FORMAL_NAME, SysEntityTableMap::COL_NIT, SysEntityTableMap::COL_EMAIL, SysEntityTableMap::COL_ADDRESS, SysEntityTableMap::COL_PHONE, SysEntityTableMap::COL_CELLPHONE, SysEntityTableMap::COL_ACTIVITIES, SysEntityTableMap::COL_DESCRIPTION, SysEntityTableMap::COL_LAST_USER_ID, SysEntityTableMap::COL_CREATION_DATE, SysEntityTableMap::COL_MODIFICACION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'ENTITY_TYPE_ID', 'LOCATION_ID', 'MAIN_BRANCH_ID', 'CODE', 'COMERCIAL_NAME', 'FORMAL_NAME', 'NIT', 'EMAIL', 'ADDRESS', 'PHONE', 'CELLPHONE', 'ACTIVITIES', 'DESCRIPTION', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICACION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'EntityTypeId' => 1, 'LocationId' => 2, 'MainBranchId' => 3, 'Code' => 4, 'ComercialName' => 5, 'FormalName' => 6, 'Nit' => 7, 'Email' => 8, 'Address' => 9, 'Phone' => 10, 'Cellphone' => 11, 'Activities' => 12, 'Description' => 13, 'LastUserId' => 14, 'CreationDate' => 15, 'ModificacionDate' => 16, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'entityTypeId' => 1, 'locationId' => 2, 'mainBranchId' => 3, 'code' => 4, 'comercialName' => 5, 'formalName' => 6, 'nit' => 7, 'email' => 8, 'address' => 9, 'phone' => 10, 'cellphone' => 11, 'activities' => 12, 'description' => 13, 'lastUserId' => 14, 'creationDate' => 15, 'modificacionDate' => 16, ),
        self::TYPE_COLNAME       => array(SysEntityTableMap::COL_ID => 0, SysEntityTableMap::COL_ENTITY_TYPE_ID => 1, SysEntityTableMap::COL_LOCATION_ID => 2, SysEntityTableMap::COL_MAIN_BRANCH_ID => 3, SysEntityTableMap::COL_CODE => 4, SysEntityTableMap::COL_COMERCIAL_NAME => 5, SysEntityTableMap::COL_FORMAL_NAME => 6, SysEntityTableMap::COL_NIT => 7, SysEntityTableMap::COL_EMAIL => 8, SysEntityTableMap::COL_ADDRESS => 9, SysEntityTableMap::COL_PHONE => 10, SysEntityTableMap::COL_CELLPHONE => 11, SysEntityTableMap::COL_ACTIVITIES => 12, SysEntityTableMap::COL_DESCRIPTION => 13, SysEntityTableMap::COL_LAST_USER_ID => 14, SysEntityTableMap::COL_CREATION_DATE => 15, SysEntityTableMap::COL_MODIFICACION_DATE => 16, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ENTITY_TYPE_ID' => 1, 'LOCATION_ID' => 2, 'MAIN_BRANCH_ID' => 3, 'CODE' => 4, 'COMERCIAL_NAME' => 5, 'FORMAL_NAME' => 6, 'NIT' => 7, 'EMAIL' => 8, 'ADDRESS' => 9, 'PHONE' => 10, 'CELLPHONE' => 11, 'ACTIVITIES' => 12, 'DESCRIPTION' => 13, 'LAST_USER_ID' => 14, 'CREATION_DATE' => 15, 'MODIFICACION_DATE' => 16, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
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
        $this->setName('sys_entity');
        $this->setPhpName('SysEntity');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysEntity');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ENTITY_TYPE_ID', 'EntityTypeId', 'INTEGER', 'sys_entity_type', 'ID', true, null, null);
        $this->addForeignKey('LOCATION_ID', 'LocationId', 'INTEGER', 'sys_location', 'ID', false, null, null);
        $this->addColumn('MAIN_BRANCH_ID', 'MainBranchId', 'INTEGER', true, null, null);
        $this->addColumn('CODE', 'Code', 'VARCHAR', true, 50, null);
        $this->addColumn('COMERCIAL_NAME', 'ComercialName', 'VARCHAR', true, 500, null);
        $this->addColumn('FORMAL_NAME', 'FormalName', 'VARCHAR', true, 500, null);
        $this->addColumn('NIT', 'Nit', 'VARCHAR', true, 50, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 200, null);
        $this->addColumn('ADDRESS', 'Address', 'LONGVARCHAR', true, null, null);
        $this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 30, null);
        $this->addColumn('CELLPHONE', 'Cellphone', 'VARCHAR', false, 30, null);
        $this->addColumn('ACTIVITIES', 'Activities', 'LONGVARCHAR', false, null, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, null);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICACION_DATE', 'ModificacionDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysEntityType', '\\SysEntityType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ENTITY_TYPE_ID',
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
        $this->addRelation('SysEntityBranch', '\\SysEntityBranch', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ENTITY_ID',
    1 => ':ID',
  ),
), null, null, 'SysEntityBranches', false);
        $this->addRelation('SysEntityParam', '\\SysEntityParam', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ENTITY_ID',
    1 => ':ID',
  ),
), null, null, 'SysEntityParams', false);
        $this->addRelation('SysEntityUser', '\\SysEntityUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ENTITY_ID',
    1 => ':ID',
  ),
), null, null, 'SysEntityUsers', false);
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
        return $withPrefix ? SysEntityTableMap::CLASS_DEFAULT : SysEntityTableMap::OM_CLASS;
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
     * @return array           (SysEntity object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysEntityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysEntityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysEntityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysEntityTableMap::OM_CLASS;
            /** @var SysEntity $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysEntityTableMap::addInstanceToPool($obj, $key);
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
            $key = SysEntityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysEntityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysEntity $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysEntityTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysEntityTableMap::COL_ID);
            $criteria->addSelectColumn(SysEntityTableMap::COL_ENTITY_TYPE_ID);
            $criteria->addSelectColumn(SysEntityTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(SysEntityTableMap::COL_MAIN_BRANCH_ID);
            $criteria->addSelectColumn(SysEntityTableMap::COL_CODE);
            $criteria->addSelectColumn(SysEntityTableMap::COL_COMERCIAL_NAME);
            $criteria->addSelectColumn(SysEntityTableMap::COL_FORMAL_NAME);
            $criteria->addSelectColumn(SysEntityTableMap::COL_NIT);
            $criteria->addSelectColumn(SysEntityTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SysEntityTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(SysEntityTableMap::COL_PHONE);
            $criteria->addSelectColumn(SysEntityTableMap::COL_CELLPHONE);
            $criteria->addSelectColumn(SysEntityTableMap::COL_ACTIVITIES);
            $criteria->addSelectColumn(SysEntityTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysEntityTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysEntityTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysEntityTableMap::COL_MODIFICACION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ENTITY_TYPE_ID');
            $criteria->addSelectColumn($alias . '.LOCATION_ID');
            $criteria->addSelectColumn($alias . '.MAIN_BRANCH_ID');
            $criteria->addSelectColumn($alias . '.CODE');
            $criteria->addSelectColumn($alias . '.COMERCIAL_NAME');
            $criteria->addSelectColumn($alias . '.FORMAL_NAME');
            $criteria->addSelectColumn($alias . '.NIT');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.ADDRESS');
            $criteria->addSelectColumn($alias . '.PHONE');
            $criteria->addSelectColumn($alias . '.CELLPHONE');
            $criteria->addSelectColumn($alias . '.ACTIVITIES');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.LAST_USER_ID');
            $criteria->addSelectColumn($alias . '.CREATION_DATE');
            $criteria->addSelectColumn($alias . '.MODIFICACION_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysEntityTableMap::DATABASE_NAME)->getTable(SysEntityTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysEntityTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysEntityTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysEntityTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysEntity or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysEntity object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysEntity) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysEntityTableMap::DATABASE_NAME);
            $criteria->add(SysEntityTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysEntityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysEntityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysEntityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_entity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysEntityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysEntity or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysEntity object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysEntity object
        }

        if ($criteria->containsKey(SysEntityTableMap::COL_ID) && $criteria->keyContainsValue(SysEntityTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysEntityTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysEntityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysEntityTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysEntityTableMap::buildTableMap();
