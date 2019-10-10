<?php

namespace Map;

use \JobPersona;
use \JobPersonaQuery;
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
 * This class defines the structure of the 'job_persona' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobPersonaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobPersonaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_persona';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobPersona';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobPersona';

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
    const COL_ID = 'job_persona.ID';

    /**
     * the column name for the USER_ID field
     */
    const COL_USER_ID = 'job_persona.USER_ID';

    /**
     * the column name for the LOCATION_ID field
     */
    const COL_LOCATION_ID = 'job_persona.LOCATION_ID';

    /**
     * the column name for the FIRST_NAME field
     */
    const COL_FIRST_NAME = 'job_persona.FIRST_NAME';

    /**
     * the column name for the MIDDLE_NAME field
     */
    const COL_MIDDLE_NAME = 'job_persona.MIDDLE_NAME';

    /**
     * the column name for the LAST_NAME field
     */
    const COL_LAST_NAME = 'job_persona.LAST_NAME';

    /**
     * the column name for the SECOND_LAST_NAME field
     */
    const COL_SECOND_LAST_NAME = 'job_persona.SECOND_LAST_NAME';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'job_persona.EMAIL';

    /**
     * the column name for the ID_NUMBER field
     */
    const COL_ID_NUMBER = 'job_persona.ID_NUMBER';

    /**
     * the column name for the ID_EXTENSION field
     */
    const COL_ID_EXTENSION = 'job_persona.ID_EXTENSION';

    /**
     * the column name for the GENDER field
     */
    const COL_GENDER = 'job_persona.GENDER';

    /**
     * the column name for the DATE_OF_BIRTH field
     */
    const COL_DATE_OF_BIRTH = 'job_persona.DATE_OF_BIRTH';

    /**
     * the column name for the PLACE_OF_BIRTH field
     */
    const COL_PLACE_OF_BIRTH = 'job_persona.PLACE_OF_BIRTH';

    /**
     * the column name for the ADDRESS field
     */
    const COL_ADDRESS = 'job_persona.ADDRESS';

    /**
     * the column name for the CITY field
     */
    const COL_CITY = 'job_persona.CITY';

    /**
     * the column name for the POB field
     */
    const COL_POB = 'job_persona.POB';

    /**
     * the column name for the PHONE_HOME field
     */
    const COL_PHONE_HOME = 'job_persona.PHONE_HOME';

    /**
     * the column name for the PHONE_WORK field
     */
    const COL_PHONE_WORK = 'job_persona.PHONE_WORK';

    /**
     * the column name for the CELLPHONE_1 field
     */
    const COL_CELLPHONE_1 = 'job_persona.CELLPHONE_1';

    /**
     * the column name for the CELLPHONE_2 field
     */
    const COL_CELLPHONE_2 = 'job_persona.CELLPHONE_2';

    /**
     * the column name for the PHOTO_MIME field
     */
    const COL_PHOTO_MIME = 'job_persona.PHOTO_MIME';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_persona.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_persona.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_persona.MODIFICATION_DATE';

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
        self::TYPE_COLNAME       => array(JobPersonaTableMap::COL_ID, JobPersonaTableMap::COL_USER_ID, JobPersonaTableMap::COL_LOCATION_ID, JobPersonaTableMap::COL_FIRST_NAME, JobPersonaTableMap::COL_MIDDLE_NAME, JobPersonaTableMap::COL_LAST_NAME, JobPersonaTableMap::COL_SECOND_LAST_NAME, JobPersonaTableMap::COL_EMAIL, JobPersonaTableMap::COL_ID_NUMBER, JobPersonaTableMap::COL_ID_EXTENSION, JobPersonaTableMap::COL_GENDER, JobPersonaTableMap::COL_DATE_OF_BIRTH, JobPersonaTableMap::COL_PLACE_OF_BIRTH, JobPersonaTableMap::COL_ADDRESS, JobPersonaTableMap::COL_CITY, JobPersonaTableMap::COL_POB, JobPersonaTableMap::COL_PHONE_HOME, JobPersonaTableMap::COL_PHONE_WORK, JobPersonaTableMap::COL_CELLPHONE_1, JobPersonaTableMap::COL_CELLPHONE_2, JobPersonaTableMap::COL_PHOTO_MIME, JobPersonaTableMap::COL_LAST_USER_ID, JobPersonaTableMap::COL_CREATION_DATE, JobPersonaTableMap::COL_MODIFICATION_DATE, ),
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
        self::TYPE_COLNAME       => array(JobPersonaTableMap::COL_ID => 0, JobPersonaTableMap::COL_USER_ID => 1, JobPersonaTableMap::COL_LOCATION_ID => 2, JobPersonaTableMap::COL_FIRST_NAME => 3, JobPersonaTableMap::COL_MIDDLE_NAME => 4, JobPersonaTableMap::COL_LAST_NAME => 5, JobPersonaTableMap::COL_SECOND_LAST_NAME => 6, JobPersonaTableMap::COL_EMAIL => 7, JobPersonaTableMap::COL_ID_NUMBER => 8, JobPersonaTableMap::COL_ID_EXTENSION => 9, JobPersonaTableMap::COL_GENDER => 10, JobPersonaTableMap::COL_DATE_OF_BIRTH => 11, JobPersonaTableMap::COL_PLACE_OF_BIRTH => 12, JobPersonaTableMap::COL_ADDRESS => 13, JobPersonaTableMap::COL_CITY => 14, JobPersonaTableMap::COL_POB => 15, JobPersonaTableMap::COL_PHONE_HOME => 16, JobPersonaTableMap::COL_PHONE_WORK => 17, JobPersonaTableMap::COL_CELLPHONE_1 => 18, JobPersonaTableMap::COL_CELLPHONE_2 => 19, JobPersonaTableMap::COL_PHOTO_MIME => 20, JobPersonaTableMap::COL_LAST_USER_ID => 21, JobPersonaTableMap::COL_CREATION_DATE => 22, JobPersonaTableMap::COL_MODIFICATION_DATE => 23, ),
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
        $this->setName('job_persona');
        $this->setPhpName('JobPersona');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobPersona');
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
        return $withPrefix ? JobPersonaTableMap::CLASS_DEFAULT : JobPersonaTableMap::OM_CLASS;
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
     * @return array           (JobPersona object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobPersonaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobPersonaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobPersonaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobPersonaTableMap::OM_CLASS;
            /** @var JobPersona $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobPersonaTableMap::addInstanceToPool($obj, $key);
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
            $key = JobPersonaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobPersonaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobPersona $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobPersonaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobPersonaTableMap::COL_ID);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_USER_ID);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_MIDDLE_NAME);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_SECOND_LAST_NAME);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_EMAIL);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_ID_NUMBER);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_ID_EXTENSION);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_GENDER);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_DATE_OF_BIRTH);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_PLACE_OF_BIRTH);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_CITY);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_POB);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_PHONE_HOME);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_PHONE_WORK);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_CELLPHONE_1);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_CELLPHONE_2);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_PHOTO_MIME);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobPersonaTableMap::COL_MODIFICATION_DATE);
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
        return Propel::getServiceContainer()->getDatabaseMap(JobPersonaTableMap::DATABASE_NAME)->getTable(JobPersonaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobPersonaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobPersonaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobPersonaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobPersona or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobPersona object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobPersonaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobPersona) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobPersonaTableMap::DATABASE_NAME);
            $criteria->add(JobPersonaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobPersonaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobPersonaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobPersonaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_persona table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobPersonaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobPersona or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobPersona object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobPersonaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobPersona object
        }

        if ($criteria->containsKey(JobPersonaTableMap::COL_ID) && $criteria->keyContainsValue(JobPersonaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobPersonaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobPersonaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobPersonaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobPersonaTableMap::buildTableMap();
