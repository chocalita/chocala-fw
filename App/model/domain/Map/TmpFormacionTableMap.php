<?php

namespace Map;

use \TmpFormacion;
use \TmpFormacionQuery;
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
 * This class defines the structure of the 'tmp_formacion' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class TmpFormacionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.TmpFormacionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tmp_formacion';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TmpFormacion';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TmpFormacion';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'tmp_formacion.id';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'tmp_formacion.nombre';

    /**
     * the column name for the keywords field
     */
    const COL_KEYWORDS = 'tmp_formacion.keywords';

    /**
     * the column name for the areas_referencia field
     */
    const COL_AREAS_REFERENCIA = 'tmp_formacion.areas_referencia';

    /**
     * the column name for the formaciones_referencia field
     */
    const COL_FORMACIONES_REFERENCIA = 'tmp_formacion.formaciones_referencia';

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
        self::TYPE_PHPNAME       => array('Id', 'Nombre', 'Keywords', 'AreasReferencia', 'FormacionesReferencia', ),
        self::TYPE_CAMELNAME     => array('id', 'nombre', 'keywords', 'areasReferencia', 'formacionesReferencia', ),
        self::TYPE_COLNAME       => array(TmpFormacionTableMap::COL_ID, TmpFormacionTableMap::COL_NOMBRE, TmpFormacionTableMap::COL_KEYWORDS, TmpFormacionTableMap::COL_AREAS_REFERENCIA, TmpFormacionTableMap::COL_FORMACIONES_REFERENCIA, ),
        self::TYPE_FIELDNAME     => array('id', 'nombre', 'keywords', 'areas_referencia', 'formaciones_referencia', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Nombre' => 1, 'Keywords' => 2, 'AreasReferencia' => 3, 'FormacionesReferencia' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'nombre' => 1, 'keywords' => 2, 'areasReferencia' => 3, 'formacionesReferencia' => 4, ),
        self::TYPE_COLNAME       => array(TmpFormacionTableMap::COL_ID => 0, TmpFormacionTableMap::COL_NOMBRE => 1, TmpFormacionTableMap::COL_KEYWORDS => 2, TmpFormacionTableMap::COL_AREAS_REFERENCIA => 3, TmpFormacionTableMap::COL_FORMACIONES_REFERENCIA => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'nombre' => 1, 'keywords' => 2, 'areas_referencia' => 3, 'formaciones_referencia' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('tmp_formacion');
        $this->setPhpName('TmpFormacion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TmpFormacion');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 200, null);
        $this->addColumn('keywords', 'Keywords', 'LONGVARCHAR', false, null, null);
        $this->addColumn('areas_referencia', 'AreasReferencia', 'VARCHAR', false, 2000, null);
        $this->addColumn('formaciones_referencia', 'FormacionesReferencia', 'VARCHAR', false, 2000, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobSuscriptor', '\\JobSuscriptor', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_TMP_FORMACION',
    1 => ':id',
  ),
), null, null, 'JobSuscriptors', false);
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
        return $withPrefix ? TmpFormacionTableMap::CLASS_DEFAULT : TmpFormacionTableMap::OM_CLASS;
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
     * @return array           (TmpFormacion object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = TmpFormacionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TmpFormacionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TmpFormacionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TmpFormacionTableMap::OM_CLASS;
            /** @var TmpFormacion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TmpFormacionTableMap::addInstanceToPool($obj, $key);
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
            $key = TmpFormacionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TmpFormacionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TmpFormacion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TmpFormacionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TmpFormacionTableMap::COL_ID);
            $criteria->addSelectColumn(TmpFormacionTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(TmpFormacionTableMap::COL_KEYWORDS);
            $criteria->addSelectColumn(TmpFormacionTableMap::COL_AREAS_REFERENCIA);
            $criteria->addSelectColumn(TmpFormacionTableMap::COL_FORMACIONES_REFERENCIA);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.keywords');
            $criteria->addSelectColumn($alias . '.areas_referencia');
            $criteria->addSelectColumn($alias . '.formaciones_referencia');
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
        return Propel::getServiceContainer()->getDatabaseMap(TmpFormacionTableMap::DATABASE_NAME)->getTable(TmpFormacionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(TmpFormacionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(TmpFormacionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new TmpFormacionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a TmpFormacion or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or TmpFormacion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TmpFormacionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TmpFormacion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TmpFormacionTableMap::DATABASE_NAME);
            $criteria->add(TmpFormacionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TmpFormacionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TmpFormacionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TmpFormacionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tmp_formacion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return TmpFormacionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TmpFormacion or Criteria object.
     *
     * @param mixed               $criteria Criteria or TmpFormacion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpFormacionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TmpFormacion object
        }


        // Set the correct dbName
        $query = TmpFormacionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // TmpFormacionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
TmpFormacionTableMap::buildTableMap();
