<?php

namespace Map;

use \SysEmail;
use \SysEmailQuery;
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
 * This class defines the structure of the 'sys_email' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysEmailTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysEmailTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_email';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysEmail';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysEmail';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'sys_email.ID';

    /**
     * the column name for the CODE field
     */
    const COL_CODE = 'sys_email.CODE';

    /**
     * the column name for the NAME field
     */
    const COL_NAME = 'sys_email.NAME';

    /**
     * the column name for the DESCRIPTION field
     */
    const COL_DESCRIPTION = 'sys_email.DESCRIPTION';

    /**
     * the column name for the FROM_EMAIL field
     */
    const COL_FROM_EMAIL = 'sys_email.FROM_EMAIL';

    /**
     * the column name for the FROM_NAME field
     */
    const COL_FROM_NAME = 'sys_email.FROM_NAME';

    /**
     * the column name for the CC field
     */
    const COL_CC = 'sys_email.CC';

    /**
     * the column name for the BCC field
     */
    const COL_BCC = 'sys_email.BCC';

    /**
     * the column name for the SUBJECT field
     */
    const COL_SUBJECT = 'sys_email.SUBJECT';

    /**
     * the column name for the BODY field
     */
    const COL_BODY = 'sys_email.BODY';

    /**
     * the column name for the ATTACHMENTS field
     */
    const COL_ATTACHMENTS = 'sys_email.ATTACHMENTS';

    /**
     * the column name for the TEMPLATE field
     */
    const COL_TEMPLATE = 'sys_email.TEMPLATE';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'sys_email.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'sys_email.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'sys_email.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'Code', 'Name', 'Description', 'FromEmail', 'FromName', 'Cc', 'Bcc', 'Subject', 'Body', 'Attachments', 'Template', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'code', 'name', 'description', 'fromEmail', 'fromName', 'cc', 'bcc', 'subject', 'body', 'attachments', 'template', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(SysEmailTableMap::COL_ID, SysEmailTableMap::COL_CODE, SysEmailTableMap::COL_NAME, SysEmailTableMap::COL_DESCRIPTION, SysEmailTableMap::COL_FROM_EMAIL, SysEmailTableMap::COL_FROM_NAME, SysEmailTableMap::COL_CC, SysEmailTableMap::COL_BCC, SysEmailTableMap::COL_SUBJECT, SysEmailTableMap::COL_BODY, SysEmailTableMap::COL_ATTACHMENTS, SysEmailTableMap::COL_TEMPLATE, SysEmailTableMap::COL_LAST_USER_ID, SysEmailTableMap::COL_CREATION_DATE, SysEmailTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'CODE', 'NAME', 'DESCRIPTION', 'FROM_EMAIL', 'FROM_NAME', 'CC', 'BCC', 'SUBJECT', 'BODY', 'ATTACHMENTS', 'TEMPLATE', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Code' => 1, 'Name' => 2, 'Description' => 3, 'FromEmail' => 4, 'FromName' => 5, 'Cc' => 6, 'Bcc' => 7, 'Subject' => 8, 'Body' => 9, 'Attachments' => 10, 'Template' => 11, 'LastUserId' => 12, 'CreationDate' => 13, 'ModificationDate' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'code' => 1, 'name' => 2, 'description' => 3, 'fromEmail' => 4, 'fromName' => 5, 'cc' => 6, 'bcc' => 7, 'subject' => 8, 'body' => 9, 'attachments' => 10, 'template' => 11, 'lastUserId' => 12, 'creationDate' => 13, 'modificationDate' => 14, ),
        self::TYPE_COLNAME       => array(SysEmailTableMap::COL_ID => 0, SysEmailTableMap::COL_CODE => 1, SysEmailTableMap::COL_NAME => 2, SysEmailTableMap::COL_DESCRIPTION => 3, SysEmailTableMap::COL_FROM_EMAIL => 4, SysEmailTableMap::COL_FROM_NAME => 5, SysEmailTableMap::COL_CC => 6, SysEmailTableMap::COL_BCC => 7, SysEmailTableMap::COL_SUBJECT => 8, SysEmailTableMap::COL_BODY => 9, SysEmailTableMap::COL_ATTACHMENTS => 10, SysEmailTableMap::COL_TEMPLATE => 11, SysEmailTableMap::COL_LAST_USER_ID => 12, SysEmailTableMap::COL_CREATION_DATE => 13, SysEmailTableMap::COL_MODIFICATION_DATE => 14, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'CODE' => 1, 'NAME' => 2, 'DESCRIPTION' => 3, 'FROM_EMAIL' => 4, 'FROM_NAME' => 5, 'CC' => 6, 'BCC' => 7, 'SUBJECT' => 8, 'BODY' => 9, 'ATTACHMENTS' => 10, 'TEMPLATE' => 11, 'LAST_USER_ID' => 12, 'CREATION_DATE' => 13, 'MODIFICATION_DATE' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
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
        $this->setName('sys_email');
        $this->setPhpName('SysEmail');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysEmail');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('CODE', 'Code', 'VARCHAR', true, 30, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('FROM_EMAIL', 'FromEmail', 'VARCHAR', true, 100, null);
        $this->addColumn('FROM_NAME', 'FromName', 'VARCHAR', true, 100, null);
        $this->addColumn('CC', 'Cc', 'VARCHAR', false, 2000, null);
        $this->addColumn('BCC', 'Bcc', 'VARCHAR', false, 500, null);
        $this->addColumn('SUBJECT', 'Subject', 'VARCHAR', true, 200, null);
        $this->addColumn('BODY', 'Body', 'LONGVARCHAR', true, null, null);
        $this->addColumn('ATTACHMENTS', 'Attachments', 'VARCHAR', false, 2000, null);
        $this->addColumn('TEMPLATE', 'Template', 'VARCHAR', false, 50, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysEmailSent', '\\SysEmailSent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':EMAIL_ID',
    1 => ':ID',
  ),
), null, null, 'SysEmailSents', false);
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
        return $withPrefix ? SysEmailTableMap::CLASS_DEFAULT : SysEmailTableMap::OM_CLASS;
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
     * @return array           (SysEmail object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysEmailTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysEmailTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysEmailTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysEmailTableMap::OM_CLASS;
            /** @var SysEmail $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysEmailTableMap::addInstanceToPool($obj, $key);
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
            $key = SysEmailTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysEmailTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysEmail $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysEmailTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysEmailTableMap::COL_ID);
            $criteria->addSelectColumn(SysEmailTableMap::COL_CODE);
            $criteria->addSelectColumn(SysEmailTableMap::COL_NAME);
            $criteria->addSelectColumn(SysEmailTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysEmailTableMap::COL_FROM_EMAIL);
            $criteria->addSelectColumn(SysEmailTableMap::COL_FROM_NAME);
            $criteria->addSelectColumn(SysEmailTableMap::COL_CC);
            $criteria->addSelectColumn(SysEmailTableMap::COL_BCC);
            $criteria->addSelectColumn(SysEmailTableMap::COL_SUBJECT);
            $criteria->addSelectColumn(SysEmailTableMap::COL_BODY);
            $criteria->addSelectColumn(SysEmailTableMap::COL_ATTACHMENTS);
            $criteria->addSelectColumn(SysEmailTableMap::COL_TEMPLATE);
            $criteria->addSelectColumn(SysEmailTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(SysEmailTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(SysEmailTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.CODE');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.FROM_EMAIL');
            $criteria->addSelectColumn($alias . '.FROM_NAME');
            $criteria->addSelectColumn($alias . '.CC');
            $criteria->addSelectColumn($alias . '.BCC');
            $criteria->addSelectColumn($alias . '.SUBJECT');
            $criteria->addSelectColumn($alias . '.BODY');
            $criteria->addSelectColumn($alias . '.ATTACHMENTS');
            $criteria->addSelectColumn($alias . '.TEMPLATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysEmailTableMap::DATABASE_NAME)->getTable(SysEmailTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysEmailTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysEmailTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysEmailTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysEmail or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysEmail object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysEmail) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysEmailTableMap::DATABASE_NAME);
            $criteria->add(SysEmailTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysEmailQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysEmailTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysEmailTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_email table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysEmailQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysEmail or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysEmail object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysEmail object
        }

        if ($criteria->containsKey(SysEmailTableMap::COL_ID) && $criteria->keyContainsValue(SysEmailTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysEmailTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysEmailQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysEmailTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysEmailTableMap::buildTableMap();
