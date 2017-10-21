<?php

namespace Map;

use \TmpMailing;
use \TmpMailingQuery;
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
 * This class defines the structure of the 'tmp_mailing' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class TmpMailingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.TmpMailingTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tmp_mailing';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TmpMailing';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TmpMailing';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'tmp_mailing.id';

    /**
     * the column name for the id_prospecto field
     */
    const COL_ID_PROSPECTO = 'tmp_mailing.id_prospecto';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'tmp_mailing.email';

    /**
     * the column name for the avisos field
     */
    const COL_AVISOS = 'tmp_mailing.avisos';

    /**
     * the column name for the fecha_interes field
     */
    const COL_FECHA_INTERES = 'tmp_mailing.fecha_interes';

    /**
     * the column name for the fecha_hora_envio field
     */
    const COL_FECHA_HORA_ENVIO = 'tmp_mailing.fecha_hora_envio';

    /**
     * the column name for the enviado field
     */
    const COL_ENVIADO = 'tmp_mailing.enviado';

    /**
     * the column name for the abierto field
     */
    const COL_ABIERTO = 'tmp_mailing.abierto';

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
        self::TYPE_PHPNAME       => array('Id', 'IdProspecto', 'Email', 'Avisos', 'FechaInteres', 'FechaHoraEnvio', 'Enviado', 'Abierto', ),
        self::TYPE_CAMELNAME     => array('id', 'idProspecto', 'email', 'avisos', 'fechaInteres', 'fechaHoraEnvio', 'enviado', 'abierto', ),
        self::TYPE_COLNAME       => array(TmpMailingTableMap::COL_ID, TmpMailingTableMap::COL_ID_PROSPECTO, TmpMailingTableMap::COL_EMAIL, TmpMailingTableMap::COL_AVISOS, TmpMailingTableMap::COL_FECHA_INTERES, TmpMailingTableMap::COL_FECHA_HORA_ENVIO, TmpMailingTableMap::COL_ENVIADO, TmpMailingTableMap::COL_ABIERTO, ),
        self::TYPE_FIELDNAME     => array('id', 'id_prospecto', 'email', 'avisos', 'fecha_interes', 'fecha_hora_envio', 'enviado', 'abierto', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdProspecto' => 1, 'Email' => 2, 'Avisos' => 3, 'FechaInteres' => 4, 'FechaHoraEnvio' => 5, 'Enviado' => 6, 'Abierto' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idProspecto' => 1, 'email' => 2, 'avisos' => 3, 'fechaInteres' => 4, 'fechaHoraEnvio' => 5, 'enviado' => 6, 'abierto' => 7, ),
        self::TYPE_COLNAME       => array(TmpMailingTableMap::COL_ID => 0, TmpMailingTableMap::COL_ID_PROSPECTO => 1, TmpMailingTableMap::COL_EMAIL => 2, TmpMailingTableMap::COL_AVISOS => 3, TmpMailingTableMap::COL_FECHA_INTERES => 4, TmpMailingTableMap::COL_FECHA_HORA_ENVIO => 5, TmpMailingTableMap::COL_ENVIADO => 6, TmpMailingTableMap::COL_ABIERTO => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_prospecto' => 1, 'email' => 2, 'avisos' => 3, 'fecha_interes' => 4, 'fecha_hora_envio' => 5, 'enviado' => 6, 'abierto' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('tmp_mailing');
        $this->setPhpName('TmpMailing');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TmpMailing');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_prospecto', 'IdProspecto', 'INTEGER', true, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 200, null);
        $this->addColumn('avisos', 'Avisos', 'VARCHAR', true, 500, null);
        $this->addColumn('fecha_interes', 'FechaInteres', 'DATE', true, null, null);
        $this->addColumn('fecha_hora_envio', 'FechaHoraEnvio', 'TIMESTAMP', false, null, null);
        $this->addColumn('enviado', 'Enviado', 'BOOLEAN', false, 1, null);
        $this->addColumn('abierto', 'Abierto', 'BOOLEAN', false, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        return $withPrefix ? TmpMailingTableMap::CLASS_DEFAULT : TmpMailingTableMap::OM_CLASS;
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
     * @return array           (TmpMailing object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = TmpMailingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TmpMailingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TmpMailingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TmpMailingTableMap::OM_CLASS;
            /** @var TmpMailing $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TmpMailingTableMap::addInstanceToPool($obj, $key);
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
            $key = TmpMailingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TmpMailingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TmpMailing $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TmpMailingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TmpMailingTableMap::COL_ID);
            $criteria->addSelectColumn(TmpMailingTableMap::COL_ID_PROSPECTO);
            $criteria->addSelectColumn(TmpMailingTableMap::COL_EMAIL);
            $criteria->addSelectColumn(TmpMailingTableMap::COL_AVISOS);
            $criteria->addSelectColumn(TmpMailingTableMap::COL_FECHA_INTERES);
            $criteria->addSelectColumn(TmpMailingTableMap::COL_FECHA_HORA_ENVIO);
            $criteria->addSelectColumn(TmpMailingTableMap::COL_ENVIADO);
            $criteria->addSelectColumn(TmpMailingTableMap::COL_ABIERTO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_prospecto');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.avisos');
            $criteria->addSelectColumn($alias . '.fecha_interes');
            $criteria->addSelectColumn($alias . '.fecha_hora_envio');
            $criteria->addSelectColumn($alias . '.enviado');
            $criteria->addSelectColumn($alias . '.abierto');
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
        return Propel::getServiceContainer()->getDatabaseMap(TmpMailingTableMap::DATABASE_NAME)->getTable(TmpMailingTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(TmpMailingTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(TmpMailingTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new TmpMailingTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a TmpMailing or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or TmpMailing object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TmpMailingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TmpMailing) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TmpMailingTableMap::DATABASE_NAME);
            $criteria->add(TmpMailingTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TmpMailingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TmpMailingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TmpMailingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tmp_mailing table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return TmpMailingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TmpMailing or Criteria object.
     *
     * @param mixed               $criteria Criteria or TmpMailing object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpMailingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TmpMailing object
        }

        if ($criteria->containsKey(TmpMailingTableMap::COL_ID) && $criteria->keyContainsValue(TmpMailingTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TmpMailingTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = TmpMailingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // TmpMailingTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
TmpMailingTableMap::buildTableMap();
