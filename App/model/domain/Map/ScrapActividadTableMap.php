<?php

namespace Map;

use \ScrapActividad;
use \ScrapActividadQuery;
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
 * This class defines the structure of the 'scrap_actividad' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ScrapActividadTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ScrapActividadTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'scrap_actividad';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ScrapActividad';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ScrapActividad';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'scrap_actividad.ID';

    /**
     * the column name for the CODIGO field
     */
    const COL_CODIGO = 'scrap_actividad.CODIGO';

    /**
     * the column name for the CODIGO_PRINCIPAL field
     */
    const COL_CODIGO_PRINCIPAL = 'scrap_actividad.CODIGO_PRINCIPAL';

    /**
     * the column name for the NIVEL field
     */
    const COL_NIVEL = 'scrap_actividad.NIVEL';

    /**
     * the column name for the NOMBRE field
     */
    const COL_NOMBRE = 'scrap_actividad.NOMBRE';

    /**
     * the column name for the DESCRIPCION field
     */
    const COL_DESCRIPCION = 'scrap_actividad.DESCRIPCION';

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
        self::TYPE_PHPNAME       => array('Id', 'Codigo', 'CodigoPrincipal', 'Nivel', 'Nombre', 'Descripcion', ),
        self::TYPE_CAMELNAME     => array('id', 'codigo', 'codigoPrincipal', 'nivel', 'nombre', 'descripcion', ),
        self::TYPE_COLNAME       => array(ScrapActividadTableMap::COL_ID, ScrapActividadTableMap::COL_CODIGO, ScrapActividadTableMap::COL_CODIGO_PRINCIPAL, ScrapActividadTableMap::COL_NIVEL, ScrapActividadTableMap::COL_NOMBRE, ScrapActividadTableMap::COL_DESCRIPCION, ),
        self::TYPE_FIELDNAME     => array('ID', 'CODIGO', 'CODIGO_PRINCIPAL', 'NIVEL', 'NOMBRE', 'DESCRIPCION', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Codigo' => 1, 'CodigoPrincipal' => 2, 'Nivel' => 3, 'Nombre' => 4, 'Descripcion' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'codigo' => 1, 'codigoPrincipal' => 2, 'nivel' => 3, 'nombre' => 4, 'descripcion' => 5, ),
        self::TYPE_COLNAME       => array(ScrapActividadTableMap::COL_ID => 0, ScrapActividadTableMap::COL_CODIGO => 1, ScrapActividadTableMap::COL_CODIGO_PRINCIPAL => 2, ScrapActividadTableMap::COL_NIVEL => 3, ScrapActividadTableMap::COL_NOMBRE => 4, ScrapActividadTableMap::COL_DESCRIPCION => 5, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'CODIGO' => 1, 'CODIGO_PRINCIPAL' => 2, 'NIVEL' => 3, 'NOMBRE' => 4, 'DESCRIPCION' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('scrap_actividad');
        $this->setPhpName('ScrapActividad');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ScrapActividad');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('CODIGO', 'Codigo', 'VARCHAR', true, 20, null);
        $this->addColumn('CODIGO_PRINCIPAL', 'CodigoPrincipal', 'VARCHAR', false, 20, null);
        $this->addColumn('NIVEL', 'Nivel', 'INTEGER', true, null, null);
        $this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 500, null);
        $this->addColumn('DESCRIPCION', 'Descripcion', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ScrapEmpresa', '\\ScrapEmpresa', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_ACTIVIDAD',
    1 => ':ID',
  ),
), null, null, 'ScrapEmpresas', false);
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
        return $withPrefix ? ScrapActividadTableMap::CLASS_DEFAULT : ScrapActividadTableMap::OM_CLASS;
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
     * @return array           (ScrapActividad object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ScrapActividadTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ScrapActividadTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ScrapActividadTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ScrapActividadTableMap::OM_CLASS;
            /** @var ScrapActividad $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ScrapActividadTableMap::addInstanceToPool($obj, $key);
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
            $key = ScrapActividadTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ScrapActividadTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ScrapActividad $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ScrapActividadTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ScrapActividadTableMap::COL_ID);
            $criteria->addSelectColumn(ScrapActividadTableMap::COL_CODIGO);
            $criteria->addSelectColumn(ScrapActividadTableMap::COL_CODIGO_PRINCIPAL);
            $criteria->addSelectColumn(ScrapActividadTableMap::COL_NIVEL);
            $criteria->addSelectColumn(ScrapActividadTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(ScrapActividadTableMap::COL_DESCRIPCION);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.CODIGO');
            $criteria->addSelectColumn($alias . '.CODIGO_PRINCIPAL');
            $criteria->addSelectColumn($alias . '.NIVEL');
            $criteria->addSelectColumn($alias . '.NOMBRE');
            $criteria->addSelectColumn($alias . '.DESCRIPCION');
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
        return Propel::getServiceContainer()->getDatabaseMap(ScrapActividadTableMap::DATABASE_NAME)->getTable(ScrapActividadTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ScrapActividadTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ScrapActividadTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ScrapActividadTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ScrapActividad or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ScrapActividad object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapActividadTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ScrapActividad) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ScrapActividadTableMap::DATABASE_NAME);
            $criteria->add(ScrapActividadTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ScrapActividadQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ScrapActividadTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ScrapActividadTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the scrap_actividad table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ScrapActividadQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ScrapActividad or Criteria object.
     *
     * @param mixed               $criteria Criteria or ScrapActividad object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapActividadTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ScrapActividad object
        }

        if ($criteria->containsKey(ScrapActividadTableMap::COL_ID) && $criteria->keyContainsValue(ScrapActividadTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ScrapActividadTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ScrapActividadQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ScrapActividadTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ScrapActividadTableMap::buildTableMap();
