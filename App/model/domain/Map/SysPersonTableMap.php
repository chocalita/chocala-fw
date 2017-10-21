<?php

namespace Map;

use \SysPerson;
use \SysPersonQuery;
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
 * This class defines the structure of the 'sys_person' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysPersonTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysPersonTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_person';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysPerson';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysPerson';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 24;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 24;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'sys_person.ID';

    /**
     * the column name for the USER_ID field
     */
    const COL_USER_ID = 'sys_person.USER_ID';

    /**
     * the column name for the LOCATION_ID field
     */
    const COL_LOCATION_ID = 'sys_person.LOCATION_ID';

    /**
     * the column name for the FIRST_NAME field
     */
    const COL_FIRST_NAME = 'sys_person.FIRST_NAME';

    /**
     * the column name for the MIDDLE_NAME field
     */
    const COL_MIDDLE_NAME = 'sys_person.MIDDLE_NAME';

    /**
     * the column name for the LAST_NAME field
     */
    const COL_LAST_NAME = 'sys_person.LAST_NAME';

    /**
     * the column name for the SECOND_LAST_NAME field
     */
    const COL_SECOND_LAST_NAME = 'sys_person.SECOND_LAST_NAME';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'sys_person.EMAIL';

    /**
     * the column name for the ID_NUMBER field
     */
    const COL_ID_NUMBER = 'sys_person.ID_NUMBER';

    /**
     * the column name for the ID_EXTENSION field
     */
    const COL_ID_EXTENSION = 'sys_person.ID_EXTENSION';

    /**
     * the column name for the GENDER field
     */
    const COL_GENDER = 'sys_person.GENDER';

    /**
     * the column name for the DATE_OF_BIRTH field
     */
    const COL_DATE_OF_BIRTH = 'sys_person.DATE_OF_BIRTH';

    /**
     * the column name for the PLACE_OF_BIRTH field
     */
    const COL_PLACE_OF_BIRTH = 'sys_person.PLACE_OF_BIRTH';

    /**
     * the column name for the ADDRESS field
     */
    const COL_ADDRESS = 'sys_person.ADDRESS';

    /**
     * the column name for the CITY field
     */
    const COL_CITY = 'sys_person.CITY';

    /**
     * the column name for the POB field
     */
    const COL_POB = 'sys_person.POB';

    /**
     * the column name for the PHONE_HOME field
     */
    const COL_PHONE_HOME = 'sys_person.PHONE_HOME';

    /**
     * the column name for the PHONE_WORK field
     */
    const COL_PHONE_WORK = 'sys_person.PHONE_WORK';

    /**
     * the column name for the CELLPHONE_1 field
     */
    const COL_CELLPHONE_1 = 'sys_person.CELLPHONE_1';

    /**
     * the column name for the CELLPHONE_2 field
     */
    const COL_CELLPHONE_2 = 'sys_person.CELLPHONE_2';

    /**
     * the column name for the PHOTO_MIME field
     */
    const COL_PHOTO_MIME = 'sys_person.PHOTO_MIME';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'sys_person.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'sys_person.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'sys_person.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'UserId', 'LocationId', 'FirstName', 'MiddleName', 'LastName', 'SecondLastName', 'Email', 'IdNumber', 'IdExtension', 'Gender', 'DateOfBirth', 'PlaceOfBirth', 'Address', 'City', 'Pob', 'PhoneHome', 'PhoneWork', 'Cellphone1', 'Cellphone2', 'PhotoMime', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'userId', 'locationId', 'firstName', 'middleName', 'lastName', 'secondLastName', 'email', 'idNumber', 'idExtension', 'gender', 'dateOfBirth', 'placeOfBirth', 'address', 'city', 'pob', 'phoneHome', 'phoneWork', 'cellphone1', 'cellphone2', 'photoMime', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(SysPersonTableMap::COL_ID, SysPersonTableMap::COL_USER_ID, SysPersonTableMap::COL_LOCATION_ID, SysPersonTableMap::COL_FIRST_NAME, SysPersonTableMap::COL_MIDDLE_NAME, SysPersonTableMap::COL_LAST_NAME, SysPersonTableMap::COL_SECOND_LAST_NAME, SysPersonTableMap::COL_EMAIL, SysPersonTableMap::COL_ID_NUMBER, SysPersonTableMap::COL_ID_EXTENSION, SysPersonTableMap::COL_GENDER, SysPersonTableMap::COL_DATE_OF_BIRTH, SysPersonTableMap::COL_PLACE_OF_BIRTH, SysPersonTableMap::COL_ADDRESS, SysPersonTableMap::COL_CITY, SysPersonTableMap::COL_POB, SysPersonTableMap::COL_PHONE_HOME, SysPersonTableMap::COL_PHONE_WORK, SysPersonTableMap::COL_CELLPHONE_1, SysPersonTableMap::COL_CELLPHONE_2, SysPersonTableMap::COL_PHOTO_MIME, SysPersonTableMap::COL_LAST_USER_ID, SysPersonTableMap::COL_CREATION_DATE, SysPersonTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'USER_ID', 'LOCATION_ID', 'FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME', 'SECOND_LAST_NAME', 'EMAIL', 'ID_NUMBER', 'ID_EXTENSION', 'GENDER', 'DATE_OF_BIRTH', 'PLACE_OF_BIRTH', 'ADDRESS', 'CITY', 'POB', 'PHONE_HOME', 'PHONE_WORK', 'CELLPHONE_1', 'CELLPHONE_2', 'PHOTO_MIME', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserId' => 1, 'LocationId' => 2, 'FirstName' => 3, 'MiddleName' => 4, 'LastName' => 5, 'SecondLastName' => 6, 'Email' => 7, 'IdNumber' => 8, 'IdExtension' => 9, 'Gender' => 10, 'DateOfBirth' => 11, 'PlaceOfBirth' => 12, 'Address' => 13, 'City' => 14, 'Pob' => 15, 'PhoneHome' => 16, 'PhoneWork' => 17, 'Cellphone1' => 18, 'Cellphone2' => 19, 'PhotoMime' => 20, 'LastUserId' => 21, 'CreationDate' => 22, 'ModificationDate' => 23, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userId' => 1, 'locationId' => 2, 'firstName' => 3, 'middleName' => 4, 'lastName' => 5, 'secondLastName' => 6, 'email' => 7, 'idNumber' => 8, 'idExtension' => 9, 'gender' => 10, 'dateOfBirth' => 11, 'placeOfBirth' => 12, 'address' => 13, 'city' => 14, 'pob' => 15, 'phoneHome' => 16, 'phoneWork' => 17, 'cellphone1' => 18, 'cellphone2' => 19, 'photoMime' => 20, 'lastUserId' => 21, 'creationDate' => 22, 'modificationDate' => 23, ),
        self::TYPE_COLNAME       => array(SysPersonTableMap::COL_ID => 0, SysPersonTableMap::COL_USER_ID => 1, SysPersonTableMap::COL_LOCATION_ID => 2, SysPersonTableMap::COL_FIRST_NAME => 3, SysPersonTableMap::COL_MIDDLE_NAME => 4, SysPersonTableMap::COL_LAST_NAME => 5, SysPersonTableMap::COL_SECOND_LAST_NAME => 6, SysPersonTableMap::COL_EMAIL => 7, SysPersonTableMap::COL_ID_NUMBER => 8, SysPersonTableMap::COL_ID_EXTENSION => 9, SysPersonTableMap::COL_GENDER => 10, SysPersonTableMap::COL_DATE_OF_BIRTH => 11, SysPersonTableMap::COL_PLACE_OF_BIRTH => 12, SysPersonTableMap::COL_ADDRESS => 13, SysPersonTableMap::COL_CITY => 14, SysPersonTableMap::COL_POB => 15, SysPersonTableMap::COL_PHONE_HOME => 16, SysPersonTableMap::COL_PHONE_WORK => 17, SysPersonTableMap::COL_CELLPHONE_1 => 18, SysPersonTableMap::COL_CELLPHONE_2 => 19, SysPersonTableMap::COL_PHOTO_MIME => 20, SysPersonTableMap::COL_LAST_USER_ID => 21, SysPersonTableMap::COL_CREATION_DATE => 22, SysPersonTableMap::COL_MODIFICATION_DATE => 23, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'USER_ID' => 1, 'LOCATION_ID' => 2, 'FIRST_NAME' => 3, 'MIDDLE_NAME' => 4, 'LAST_NAME' => 5, 'SECOND_LAST_NAME' => 6, 'EMAIL' => 7, 'ID_NUMBER' => 8, 'ID_EXTENSION' => 9, 'GENDER' => 10, 'DATE_OF_BIRTH' => 11, 'PLACE_OF_BIRTH' => 12, 'ADDRESS' => 13, 'CITY' => 14, 'POB' => 15, 'PHONE_HOME' => 16, 'PHONE_WORK' => 17, 'CELLPHONE_1' => 18, 'CELLPHONE_2' => 19, 'PHOTO_MIME' => 20, 'LAST_USER_ID' => 21, 'CREATION_DATE' => 22, 'MODIFICATION_DATE' => 23, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
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
        $this->setName('sys_person');
        $this->setPhpName('SysPerson');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysPerson');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', true, null, null);
        $this->addColumn('LOCATION_ID', 'LocationId', 'INTEGER', false, null, null);
        $this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', true, 50, null);
        $this->addColumn('MIDDLE_NAME', 'MiddleName', 'VARCHAR', false, 50, null);
        $this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', true, 50, null);
        $this->addColumn('SECOND_LAST_NAME', 'SecondLastName', 'VARCHAR', false, 50, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 20, null);
        $this->addColumn('ID_NUMBER', 'IdNumber', 'VARCHAR', false, 20, null);
        $this->addColumn('ID_EXTENSION', 'IdExtension', 'VARCHAR', false, 10, null);
        $this->addColumn('GENDER', 'Gender', 'VARCHAR', false, 10, null);
        $this->addColumn('DATE_OF_BIRTH', 'DateOfBirth', 'DATE', false, null, null);
        $this->addColumn('PLACE_OF_BIRTH', 'PlaceOfBirth', 'VARCHAR', false, 100, null);
        $this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 200, null);
        $this->addColumn('CITY', 'City', 'VARCHAR', false, 50, null);
        $this->addColumn('POB', 'Pob', 'VARCHAR', false, 20, null);
        $this->addColumn('PHONE_HOME', 'PhoneHome', 'VARCHAR', false, 30, null);
        $this->addColumn('PHONE_WORK', 'PhoneWork', 'VARCHAR', false, 30, null);
        $this->addColumn('CELLPHONE_1', 'Cellphone1', 'VARCHAR', false, 30, null);
        $this->addColumn('CELLPHONE_2', 'Cellphone2', 'VARCHAR', false, 30, null);
        $this->addColumn('PHOTO_MIME', 'PhotoMime', 'VARCHAR', false, 20, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, '0000-00-00 00:00:00');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysUser', '\\SysUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':USER_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('JobCurriculum', '\\JobCurriculum', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_PERSONA',
    1 => ':ID',
  ),
), null, null, 'JobCurriculums', false);
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

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return $withPrefix ? SysPersonTableMap::CLASS_DEFAULT : SysPersonTableMap::OM_CLASS;
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
     * @return array           (SysPerson object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysPersonTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysPersonTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysPersonTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysPersonTableMap::OM_CLASS;
            /** @var SysPerson $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysPersonTableMap::addInstanceToPool($obj, $key);
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
            $key = SysPersonTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysPersonTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysPerson $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysPersonTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysPersonTableMap::COL_ID);
            $criteria->addSelectColumn(SysPersonTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysPersonTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(SysPersonTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(SysPersonTableMap::COL_MIDDLE_NAME);
            $criteria->addSelectColumn(SysPersonTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(SysPersonTableMap::COL_SECOND_LAST_NAME);
            $criteria->addSelectColumn(SysPersonTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SysPersonTableMap::COL_ID_NUMBER);
            $criteria->addSelectColumn(SysPersonTableMap::COL_ID_EXTENSION);
            $criteria->addSelectColumn(SysPersonTableMap::COL_GENDER);
            $criteria->addSelectColumn(SysPersonTableMap::COL_DATE_OF_BIRTH);
            $criteria->addSelectColumn(SysPersonTableMap::COL_PLACE_OF_BIRTH);
            $criteria->addSelectColumn(SysPersonTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(SysPersonTableMap::COL_CITY);
            $criteria->addSelectColumn(SysPersonTableMap::COL_POB);
            $criteria->addSelectColumn(SysPersonTableMap::COL_PHONE_HOME);
            $criteria->addSelectColumn(SysPersonTableMap::COL_PHONE_WORK);
            $criteria->addSelectColumn(SysPersonTableMap::COL_CELLPHONE_1);
            $criteria->addSelectColumn(SysPersonTableMap::COL_CELLPHONE_2);
            $criteria->addSelectColumn(SysPersonTableMap::COL_PHOTO_MIME);
            $criteria->addSelectColumn(SysPersonTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysPersonTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysPersonTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.LOCATION_ID');
            $criteria->addSelectColumn($alias . '.FIRST_NAME');
            $criteria->addSelectColumn($alias . '.MIDDLE_NAME');
            $criteria->addSelectColumn($alias . '.LAST_NAME');
            $criteria->addSelectColumn($alias . '.SECOND_LAST_NAME');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.ID_NUMBER');
            $criteria->addSelectColumn($alias . '.ID_EXTENSION');
            $criteria->addSelectColumn($alias . '.GENDER');
            $criteria->addSelectColumn($alias . '.DATE_OF_BIRTH');
            $criteria->addSelectColumn($alias . '.PLACE_OF_BIRTH');
            $criteria->addSelectColumn($alias . '.ADDRESS');
            $criteria->addSelectColumn($alias . '.CITY');
            $criteria->addSelectColumn($alias . '.POB');
            $criteria->addSelectColumn($alias . '.PHONE_HOME');
            $criteria->addSelectColumn($alias . '.PHONE_WORK');
            $criteria->addSelectColumn($alias . '.CELLPHONE_1');
            $criteria->addSelectColumn($alias . '.CELLPHONE_2');
            $criteria->addSelectColumn($alias . '.PHOTO_MIME');
            $criteria->addSelectColumn($alias . '.LAST_USER_ID');
            $criteria->addSelectColumn($alias . '.CREATION_DATE');
            $criteria->addSelectColumn($alias . '.MODIFICATION_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysPersonTableMap::DATABASE_NAME)->getTable(SysPersonTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysPersonTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysPersonTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysPersonTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysPerson or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysPerson object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysPersonTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysPerson) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysPersonTableMap::DATABASE_NAME);
            $criteria->add(SysPersonTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysPersonQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysPersonTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysPersonTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_person table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysPersonQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysPerson or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysPerson object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPersonTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysPerson object
        }

        if ($criteria->containsKey(SysPersonTableMap::COL_ID) && $criteria->keyContainsValue(SysPersonTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysPersonTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysPersonQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysPersonTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysPersonTableMap::buildTableMap();
