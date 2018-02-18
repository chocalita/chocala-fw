<?php

namespace Map;

use \SysEmailSent;
use \SysEmailSentQuery;
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
 * This class defines the structure of the 'sys_email_sent' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysEmailSentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysEmailSentTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_email_sent';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysEmailSent';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysEmailSent';

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
    const COL_ID = 'sys_email_sent.ID';

    /**
     * the column name for the EMAIL_ID field
     */
    const COL_EMAIL_ID = 'sys_email_sent.EMAIL_ID';

    /**
     * the column name for the USER_ID field
     */
    const COL_USER_ID = 'sys_email_sent.USER_ID';

    /**
     * the column name for the SENDER_ID field
     */
    const COL_SENDER_ID = 'sys_email_sent.SENDER_ID';

    /**
     * the column name for the HASH_STRING field
     */
    const COL_HASH_STRING = 'sys_email_sent.HASH_STRING';

    /**
     * the column name for the FROM_NAME field
     */
    const COL_FROM_NAME = 'sys_email_sent.FROM_NAME';

    /**
     * the column name for the FROM_EMAIL field
     */
    const COL_FROM_EMAIL = 'sys_email_sent.FROM_EMAIL';

    /**
     * the column name for the TO_EMAIL field
     */
    const COL_TO_EMAIL = 'sys_email_sent.TO_EMAIL';

    /**
     * the column name for the CC field
     */
    const COL_CC = 'sys_email_sent.CC';

    /**
     * the column name for the BCC field
     */
    const COL_BCC = 'sys_email_sent.BCC';

    /**
     * the column name for the SUBJECT field
     */
    const COL_SUBJECT = 'sys_email_sent.SUBJECT';

    /**
     * the column name for the CONTENT field
     */
    const COL_CONTENT = 'sys_email_sent.CONTENT';

    /**
     * the column name for the IS_SUCCESS field
     */
    const COL_IS_SUCCESS = 'sys_email_sent.IS_SUCCESS';

    /**
     * the column name for the SHIPPING_DATE field
     */
    const COL_SHIPPING_DATE = 'sys_email_sent.SHIPPING_DATE';

    /**
     * the column name for the OPENING_DATE field
     */
    const COL_OPENING_DATE = 'sys_email_sent.OPENING_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'EmailId', 'UserId', 'SenderId', 'HashString', 'FromName', 'FromEmail', 'ToEmail', 'Cc', 'Bcc', 'Subject', 'Content', 'IsSuccess', 'ShippingDate', 'OpeningDate', ),
        self::TYPE_CAMELNAME     => array('id', 'emailId', 'userId', 'senderId', 'hashString', 'fromName', 'fromEmail', 'toEmail', 'cc', 'bcc', 'subject', 'content', 'isSuccess', 'shippingDate', 'openingDate', ),
        self::TYPE_COLNAME       => array(SysEmailSentTableMap::COL_ID, SysEmailSentTableMap::COL_EMAIL_ID, SysEmailSentTableMap::COL_USER_ID, SysEmailSentTableMap::COL_SENDER_ID, SysEmailSentTableMap::COL_HASH_STRING, SysEmailSentTableMap::COL_FROM_NAME, SysEmailSentTableMap::COL_FROM_EMAIL, SysEmailSentTableMap::COL_TO_EMAIL, SysEmailSentTableMap::COL_CC, SysEmailSentTableMap::COL_BCC, SysEmailSentTableMap::COL_SUBJECT, SysEmailSentTableMap::COL_CONTENT, SysEmailSentTableMap::COL_IS_SUCCESS, SysEmailSentTableMap::COL_SHIPPING_DATE, SysEmailSentTableMap::COL_OPENING_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'EMAIL_ID', 'USER_ID', 'SENDER_ID', 'HASH_STRING', 'FROM_NAME', 'FROM_EMAIL', 'TO_EMAIL', 'CC', 'BCC', 'SUBJECT', 'CONTENT', 'IS_SUCCESS', 'SHIPPING_DATE', 'OPENING_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'EmailId' => 1, 'UserId' => 2, 'SenderId' => 3, 'HashString' => 4, 'FromName' => 5, 'FromEmail' => 6, 'ToEmail' => 7, 'Cc' => 8, 'Bcc' => 9, 'Subject' => 10, 'Content' => 11, 'IsSuccess' => 12, 'ShippingDate' => 13, 'OpeningDate' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'emailId' => 1, 'userId' => 2, 'senderId' => 3, 'hashString' => 4, 'fromName' => 5, 'fromEmail' => 6, 'toEmail' => 7, 'cc' => 8, 'bcc' => 9, 'subject' => 10, 'content' => 11, 'isSuccess' => 12, 'shippingDate' => 13, 'openingDate' => 14, ),
        self::TYPE_COLNAME       => array(SysEmailSentTableMap::COL_ID => 0, SysEmailSentTableMap::COL_EMAIL_ID => 1, SysEmailSentTableMap::COL_USER_ID => 2, SysEmailSentTableMap::COL_SENDER_ID => 3, SysEmailSentTableMap::COL_HASH_STRING => 4, SysEmailSentTableMap::COL_FROM_NAME => 5, SysEmailSentTableMap::COL_FROM_EMAIL => 6, SysEmailSentTableMap::COL_TO_EMAIL => 7, SysEmailSentTableMap::COL_CC => 8, SysEmailSentTableMap::COL_BCC => 9, SysEmailSentTableMap::COL_SUBJECT => 10, SysEmailSentTableMap::COL_CONTENT => 11, SysEmailSentTableMap::COL_IS_SUCCESS => 12, SysEmailSentTableMap::COL_SHIPPING_DATE => 13, SysEmailSentTableMap::COL_OPENING_DATE => 14, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'EMAIL_ID' => 1, 'USER_ID' => 2, 'SENDER_ID' => 3, 'HASH_STRING' => 4, 'FROM_NAME' => 5, 'FROM_EMAIL' => 6, 'TO_EMAIL' => 7, 'CC' => 8, 'BCC' => 9, 'SUBJECT' => 10, 'CONTENT' => 11, 'IS_SUCCESS' => 12, 'SHIPPING_DATE' => 13, 'OPENING_DATE' => 14, ),
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
        $this->setName('sys_email_sent');
        $this->setPhpName('SysEmailSent');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysEmailSent');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('EMAIL_ID', 'EmailId', 'INTEGER', 'sys_email', 'ID', true, null, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sys_user', 'ID', false, null, null);
        $this->addColumn('SENDER_ID', 'SenderId', 'INTEGER', true, null, 0);
        $this->addColumn('HASH_STRING', 'HashString', 'VARCHAR', true, 500, null);
        $this->addColumn('FROM_NAME', 'FromName', 'VARCHAR', true, 100, null);
        $this->addColumn('FROM_EMAIL', 'FromEmail', 'VARCHAR', true, 100, null);
        $this->addColumn('TO_EMAIL', 'ToEmail', 'LONGVARCHAR', true, null, null);
        $this->addColumn('CC', 'Cc', 'LONGVARCHAR', false, null, null);
        $this->addColumn('BCC', 'Bcc', 'LONGVARCHAR', false, null, null);
        $this->addColumn('SUBJECT', 'Subject', 'VARCHAR', true, 500, null);
        $this->addColumn('CONTENT', 'Content', 'LONGVARCHAR', true, null, null);
        $this->addColumn('IS_SUCCESS', 'IsSuccess', 'BOOLEAN', true, 1, null);
        $this->addColumn('SHIPPING_DATE', 'ShippingDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('OPENING_DATE', 'OpeningDate', 'TIMESTAMP', false, null, '0000-00-00 00:00:00');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SysEmail', '\\SysEmail', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':EMAIL_ID',
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
        return $withPrefix ? SysEmailSentTableMap::CLASS_DEFAULT : SysEmailSentTableMap::OM_CLASS;
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
     * @return array           (SysEmailSent object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysEmailSentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysEmailSentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysEmailSentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysEmailSentTableMap::OM_CLASS;
            /** @var SysEmailSent $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysEmailSentTableMap::addInstanceToPool($obj, $key);
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
            $key = SysEmailSentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysEmailSentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysEmailSent $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysEmailSentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_ID);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_EMAIL_ID);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_USER_ID);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_SENDER_ID);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_HASH_STRING);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_FROM_NAME);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_FROM_EMAIL);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_TO_EMAIL);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_CC);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_BCC);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_SUBJECT);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_CONTENT);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_IS_SUCCESS);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_SHIPPING_DATE);
            $criteria->addSelectColumn(SysEmailSentTableMap::COL_OPENING_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.EMAIL_ID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.SENDER_ID');
            $criteria->addSelectColumn($alias . '.HASH_STRING');
            $criteria->addSelectColumn($alias . '.FROM_NAME');
            $criteria->addSelectColumn($alias . '.FROM_EMAIL');
            $criteria->addSelectColumn($alias . '.TO_EMAIL');
            $criteria->addSelectColumn($alias . '.CC');
            $criteria->addSelectColumn($alias . '.BCC');
            $criteria->addSelectColumn($alias . '.SUBJECT');
            $criteria->addSelectColumn($alias . '.CONTENT');
            $criteria->addSelectColumn($alias . '.IS_SUCCESS');
            $criteria->addSelectColumn($alias . '.SHIPPING_DATE');
            $criteria->addSelectColumn($alias . '.OPENING_DATE');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysEmailSentTableMap::DATABASE_NAME)->getTable(SysEmailSentTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysEmailSentTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysEmailSentTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysEmailSentTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysEmailSent or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysEmailSent object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailSentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysEmailSent) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysEmailSentTableMap::DATABASE_NAME);
            $criteria->add(SysEmailSentTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysEmailSentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysEmailSentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysEmailSentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_email_sent table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysEmailSentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysEmailSent or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysEmailSent object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailSentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysEmailSent object
        }

        if ($criteria->containsKey(SysEmailSentTableMap::COL_ID) && $criteria->keyContainsValue(SysEmailSentTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysEmailSentTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysEmailSentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysEmailSentTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysEmailSentTableMap::buildTableMap();
