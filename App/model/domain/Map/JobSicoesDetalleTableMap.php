<?php

namespace Map;

use \JobSicoesDetalle;
use \JobSicoesDetalleQuery;
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
 * This class defines the structure of the 'job_sicoes_detalle' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobSicoesDetalleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobSicoesDetalleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_sicoes_detalle';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobSicoesDetalle';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobSicoesDetalle';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_sicoes_detalle.ID';

    /**
     * the column name for the ID_SICOES_CONVOCATORIA field
     */
    const COL_ID_SICOES_CONVOCATORIA = 'job_sicoes_detalle.ID_SICOES_CONVOCATORIA';

    /**
     * the column name for the NUMERO field
     */
    const COL_NUMERO = 'job_sicoes_detalle.NUMERO';

    /**
     * the column name for the DESCRIPCION field
     */
    const COL_DESCRIPCION = 'job_sicoes_detalle.DESCRIPCION';

    /**
     * the column name for the UNIDAD_MEDIDA field
     */
    const COL_UNIDAD_MEDIDA = 'job_sicoes_detalle.UNIDAD_MEDIDA';

    /**
     * the column name for the CANTIDAD field
     */
    const COL_CANTIDAD = 'job_sicoes_detalle.CANTIDAD';

    /**
     * the column name for the PRECIO_UNIDAD field
     */
    const COL_PRECIO_UNIDAD = 'job_sicoes_detalle.PRECIO_UNIDAD';

    /**
     * the column name for the CODIGO_CATALOGO field
     */
    const COL_CODIGO_CATALOGO = 'job_sicoes_detalle.CODIGO_CATALOGO';

    /**
     * the column name for the OBJETO_GASTO field
     */
    const COL_OBJETO_GASTO = 'job_sicoes_detalle.OBJETO_GASTO';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_sicoes_detalle.STATUS';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_sicoes_detalle.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_sicoes_detalle.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'IdSicoesConvocatoria', 'Numero', 'Descripcion', 'UnidadMedida', 'Cantidad', 'PrecioUnidad', 'CodigoCatalogo', 'ObjetoGasto', 'Status', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'idSicoesConvocatoria', 'numero', 'descripcion', 'unidadMedida', 'cantidad', 'precioUnidad', 'codigoCatalogo', 'objetoGasto', 'status', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobSicoesDetalleTableMap::COL_ID, JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA, JobSicoesDetalleTableMap::COL_NUMERO, JobSicoesDetalleTableMap::COL_DESCRIPCION, JobSicoesDetalleTableMap::COL_UNIDAD_MEDIDA, JobSicoesDetalleTableMap::COL_CANTIDAD, JobSicoesDetalleTableMap::COL_PRECIO_UNIDAD, JobSicoesDetalleTableMap::COL_CODIGO_CATALOGO, JobSicoesDetalleTableMap::COL_OBJETO_GASTO, JobSicoesDetalleTableMap::COL_STATUS, JobSicoesDetalleTableMap::COL_CREATION_DATE, JobSicoesDetalleTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'ID_SICOES_CONVOCATORIA', 'NUMERO', 'DESCRIPCION', 'UNIDAD_MEDIDA', 'CANTIDAD', 'PRECIO_UNIDAD', 'CODIGO_CATALOGO', 'OBJETO_GASTO', 'STATUS', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdSicoesConvocatoria' => 1, 'Numero' => 2, 'Descripcion' => 3, 'UnidadMedida' => 4, 'Cantidad' => 5, 'PrecioUnidad' => 6, 'CodigoCatalogo' => 7, 'ObjetoGasto' => 8, 'Status' => 9, 'CreationDate' => 10, 'ModificationDate' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idSicoesConvocatoria' => 1, 'numero' => 2, 'descripcion' => 3, 'unidadMedida' => 4, 'cantidad' => 5, 'precioUnidad' => 6, 'codigoCatalogo' => 7, 'objetoGasto' => 8, 'status' => 9, 'creationDate' => 10, 'modificationDate' => 11, ),
        self::TYPE_COLNAME       => array(JobSicoesDetalleTableMap::COL_ID => 0, JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA => 1, JobSicoesDetalleTableMap::COL_NUMERO => 2, JobSicoesDetalleTableMap::COL_DESCRIPCION => 3, JobSicoesDetalleTableMap::COL_UNIDAD_MEDIDA => 4, JobSicoesDetalleTableMap::COL_CANTIDAD => 5, JobSicoesDetalleTableMap::COL_PRECIO_UNIDAD => 6, JobSicoesDetalleTableMap::COL_CODIGO_CATALOGO => 7, JobSicoesDetalleTableMap::COL_OBJETO_GASTO => 8, JobSicoesDetalleTableMap::COL_STATUS => 9, JobSicoesDetalleTableMap::COL_CREATION_DATE => 10, JobSicoesDetalleTableMap::COL_MODIFICATION_DATE => 11, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ID_SICOES_CONVOCATORIA' => 1, 'NUMERO' => 2, 'DESCRIPCION' => 3, 'UNIDAD_MEDIDA' => 4, 'CANTIDAD' => 5, 'PRECIO_UNIDAD' => 6, 'CODIGO_CATALOGO' => 7, 'OBJETO_GASTO' => 8, 'STATUS' => 9, 'CREATION_DATE' => 10, 'MODIFICATION_DATE' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('job_sicoes_detalle');
        $this->setPhpName('JobSicoesDetalle');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobSicoesDetalle');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_SICOES_CONVOCATORIA', 'IdSicoesConvocatoria', 'INTEGER', 'job_sicoes_convocatoria', 'ID', true, null, null);
        $this->addColumn('NUMERO', 'Numero', 'INTEGER', true, null, null);
        $this->addColumn('DESCRIPCION', 'Descripcion', 'VARCHAR', true, 5000, null);
        $this->addColumn('UNIDAD_MEDIDA', 'UnidadMedida', 'VARCHAR', true, 100, null);
        $this->addColumn('CANTIDAD', 'Cantidad', 'INTEGER', true, null, null);
        $this->addColumn('PRECIO_UNIDAD', 'PrecioUnidad', 'FLOAT', true, 9, null);
        $this->addColumn('CODIGO_CATALOGO', 'CodigoCatalogo', 'VARCHAR', false, 30, null);
        $this->addColumn('OBJETO_GASTO', 'ObjetoGasto', 'VARCHAR', false, 30, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 30, null);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobSicoesConvocatoria', '\\JobSicoesConvocatoria', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_SICOES_CONVOCATORIA',
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
        return $withPrefix ? JobSicoesDetalleTableMap::CLASS_DEFAULT : JobSicoesDetalleTableMap::OM_CLASS;
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
     * @return array           (JobSicoesDetalle object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobSicoesDetalleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobSicoesDetalleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobSicoesDetalleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobSicoesDetalleTableMap::OM_CLASS;
            /** @var JobSicoesDetalle $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobSicoesDetalleTableMap::addInstanceToPool($obj, $key);
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
            $key = JobSicoesDetalleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobSicoesDetalleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobSicoesDetalle $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobSicoesDetalleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_ID);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_NUMERO);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_UNIDAD_MEDIDA);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_CANTIDAD);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_PRECIO_UNIDAD);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_CODIGO_CATALOGO);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_OBJETO_GASTO);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobSicoesDetalleTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ID_SICOES_CONVOCATORIA');
            $criteria->addSelectColumn($alias . '.NUMERO');
            $criteria->addSelectColumn($alias . '.DESCRIPCION');
            $criteria->addSelectColumn($alias . '.UNIDAD_MEDIDA');
            $criteria->addSelectColumn($alias . '.CANTIDAD');
            $criteria->addSelectColumn($alias . '.PRECIO_UNIDAD');
            $criteria->addSelectColumn($alias . '.CODIGO_CATALOGO');
            $criteria->addSelectColumn($alias . '.OBJETO_GASTO');
            $criteria->addSelectColumn($alias . '.STATUS');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobSicoesDetalleTableMap::DATABASE_NAME)->getTable(JobSicoesDetalleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobSicoesDetalleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobSicoesDetalleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobSicoesDetalleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobSicoesDetalle or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobSicoesDetalle object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesDetalleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobSicoesDetalle) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobSicoesDetalleTableMap::DATABASE_NAME);
            $criteria->add(JobSicoesDetalleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobSicoesDetalleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobSicoesDetalleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobSicoesDetalleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_sicoes_detalle table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobSicoesDetalleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobSicoesDetalle or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobSicoesDetalle object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesDetalleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobSicoesDetalle object
        }


        // Set the correct dbName
        $query = JobSicoesDetalleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobSicoesDetalleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobSicoesDetalleTableMap::buildTableMap();
