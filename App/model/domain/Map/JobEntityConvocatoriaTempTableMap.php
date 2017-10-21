<?php

namespace Map;

use \JobEntityConvocatoriaTemp;
use \JobEntityConvocatoriaTempQuery;
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
 * This class defines the structure of the 'job_entity_convocatoria_temp' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobEntityConvocatoriaTempTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobEntityConvocatoriaTempTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_entity_convocatoria_temp';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobEntityConvocatoriaTemp';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobEntityConvocatoriaTemp';

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
    const COL_ID = 'job_entity_convocatoria_temp.ID';

    /**
     * the column name for the COMPANY_ID field
     */
    const COL_COMPANY_ID = 'job_entity_convocatoria_temp.COMPANY_ID';

    /**
     * the column name for the AREA_ID field
     */
    const COL_AREA_ID = 'job_entity_convocatoria_temp.AREA_ID';

    /**
     * the column name for the LOCALIZACION_ID field
     */
    const COL_LOCALIZACION_ID = 'job_entity_convocatoria_temp.LOCALIZACION_ID';

    /**
     * the column name for the SALARIO field
     */
    const COL_SALARIO = 'job_entity_convocatoria_temp.SALARIO';

    /**
     * the column name for the CARGO field
     */
    const COL_CARGO = 'job_entity_convocatoria_temp.CARGO';

    /**
     * the column name for the DESCRIPCION field
     */
    const COL_DESCRIPCION = 'job_entity_convocatoria_temp.DESCRIPCION';

    /**
     * the column name for the FECHA_PUBLICACION field
     */
    const COL_FECHA_PUBLICACION = 'job_entity_convocatoria_temp.FECHA_PUBLICACION';

    /**
     * the column name for the FECHA_VENCIMIENTO field
     */
    const COL_FECHA_VENCIMIENTO = 'job_entity_convocatoria_temp.FECHA_VENCIMIENTO';

    /**
     * the column name for the ESTADO field
     */
    const COL_ESTADO = 'job_entity_convocatoria_temp.ESTADO';

    /**
     * the column name for the USER field
     */
    const COL_USER = 'job_entity_convocatoria_temp.USER';

    /**
     * the column name for the FECHA_REGISTRO field
     */
    const COL_FECHA_REGISTRO = 'job_entity_convocatoria_temp.FECHA_REGISTRO';

    /**
     * the column name for the CORREO_CONTACTO field
     */
    const COL_CORREO_CONTACTO = 'job_entity_convocatoria_temp.CORREO_CONTACTO';

    /**
     * the column name for the TELEFONO_CONTACTO field
     */
    const COL_TELEFONO_CONTACTO = 'job_entity_convocatoria_temp.TELEFONO_CONTACTO';

    /**
     * the column name for the PROFESION field
     */
    const COL_PROFESION = 'job_entity_convocatoria_temp.PROFESION';

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
        self::TYPE_PHPNAME       => array('Id', 'CompanyId', 'AreaId', 'LocalizacionId', 'Salario', 'Cargo', 'Descripcion', 'FechaPublicacion', 'FechaVencimiento', 'Estado', 'User', 'FechaRegistro', 'CorreoContacto', 'TelefonoContacto', 'Profesion', ),
        self::TYPE_CAMELNAME     => array('id', 'companyId', 'areaId', 'localizacionId', 'salario', 'cargo', 'descripcion', 'fechaPublicacion', 'fechaVencimiento', 'estado', 'user', 'fechaRegistro', 'correoContacto', 'telefonoContacto', 'profesion', ),
        self::TYPE_COLNAME       => array(JobEntityConvocatoriaTempTableMap::COL_ID, JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID, JobEntityConvocatoriaTempTableMap::COL_AREA_ID, JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID, JobEntityConvocatoriaTempTableMap::COL_SALARIO, JobEntityConvocatoriaTempTableMap::COL_CARGO, JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION, JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION, JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO, JobEntityConvocatoriaTempTableMap::COL_ESTADO, JobEntityConvocatoriaTempTableMap::COL_USER, JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO, JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO, JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO, JobEntityConvocatoriaTempTableMap::COL_PROFESION, ),
        self::TYPE_FIELDNAME     => array('ID', 'COMPANY_ID', 'AREA_ID', 'LOCALIZACION_ID', 'SALARIO', 'CARGO', 'DESCRIPCION', 'FECHA_PUBLICACION', 'FECHA_VENCIMIENTO', 'ESTADO', 'USER', 'FECHA_REGISTRO', 'CORREO_CONTACTO', 'TELEFONO_CONTACTO', 'PROFESION', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'CompanyId' => 1, 'AreaId' => 2, 'LocalizacionId' => 3, 'Salario' => 4, 'Cargo' => 5, 'Descripcion' => 6, 'FechaPublicacion' => 7, 'FechaVencimiento' => 8, 'Estado' => 9, 'User' => 10, 'FechaRegistro' => 11, 'CorreoContacto' => 12, 'TelefonoContacto' => 13, 'Profesion' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'companyId' => 1, 'areaId' => 2, 'localizacionId' => 3, 'salario' => 4, 'cargo' => 5, 'descripcion' => 6, 'fechaPublicacion' => 7, 'fechaVencimiento' => 8, 'estado' => 9, 'user' => 10, 'fechaRegistro' => 11, 'correoContacto' => 12, 'telefonoContacto' => 13, 'profesion' => 14, ),
        self::TYPE_COLNAME       => array(JobEntityConvocatoriaTempTableMap::COL_ID => 0, JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID => 1, JobEntityConvocatoriaTempTableMap::COL_AREA_ID => 2, JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID => 3, JobEntityConvocatoriaTempTableMap::COL_SALARIO => 4, JobEntityConvocatoriaTempTableMap::COL_CARGO => 5, JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION => 6, JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION => 7, JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO => 8, JobEntityConvocatoriaTempTableMap::COL_ESTADO => 9, JobEntityConvocatoriaTempTableMap::COL_USER => 10, JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO => 11, JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO => 12, JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO => 13, JobEntityConvocatoriaTempTableMap::COL_PROFESION => 14, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'COMPANY_ID' => 1, 'AREA_ID' => 2, 'LOCALIZACION_ID' => 3, 'SALARIO' => 4, 'CARGO' => 5, 'DESCRIPCION' => 6, 'FECHA_PUBLICACION' => 7, 'FECHA_VENCIMIENTO' => 8, 'ESTADO' => 9, 'USER' => 10, 'FECHA_REGISTRO' => 11, 'CORREO_CONTACTO' => 12, 'TELEFONO_CONTACTO' => 13, 'PROFESION' => 14, ),
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
        $this->setName('job_entity_convocatoria_temp');
        $this->setPhpName('JobEntityConvocatoriaTemp');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobEntityConvocatoriaTemp');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('COMPANY_ID', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('AREA_ID', 'AreaId', 'INTEGER', false, null, null);
        $this->addColumn('LOCALIZACION_ID', 'LocalizacionId', 'INTEGER', false, null, null);
        $this->addColumn('SALARIO', 'Salario', 'DECIMAL', false, 11, null);
        $this->addColumn('CARGO', 'Cargo', 'VARCHAR', false, 50, null);
        $this->addColumn('DESCRIPCION', 'Descripcion', 'VARCHAR', false, 1000, null);
        $this->addColumn('FECHA_PUBLICACION', 'FechaPublicacion', 'DATE', false, null, null);
        $this->addColumn('FECHA_VENCIMIENTO', 'FechaVencimiento', 'DATE', false, null, null);
        $this->addColumn('ESTADO', 'Estado', 'VARCHAR', false, 20, null);
        $this->addColumn('USER', 'User', 'VARCHAR', false, 20, null);
        $this->addColumn('FECHA_REGISTRO', 'FechaRegistro', 'TIMESTAMP', false, null, null);
        $this->addColumn('CORREO_CONTACTO', 'CorreoContacto', 'VARCHAR', false, 20, null);
        $this->addColumn('TELEFONO_CONTACTO', 'TelefonoContacto', 'INTEGER', false, null, null);
        $this->addColumn('PROFESION', 'Profesion', 'VARCHAR', false, 200, null);
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
        return $withPrefix ? JobEntityConvocatoriaTempTableMap::CLASS_DEFAULT : JobEntityConvocatoriaTempTableMap::OM_CLASS;
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
     * @return array           (JobEntityConvocatoriaTemp object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobEntityConvocatoriaTempTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobEntityConvocatoriaTempTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobEntityConvocatoriaTempTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobEntityConvocatoriaTempTableMap::OM_CLASS;
            /** @var JobEntityConvocatoriaTemp $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobEntityConvocatoriaTempTableMap::addInstanceToPool($obj, $key);
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
            $key = JobEntityConvocatoriaTempTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobEntityConvocatoriaTempTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobEntityConvocatoriaTemp $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobEntityConvocatoriaTempTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_ID);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_AREA_ID);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_SALARIO);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_CARGO);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_ESTADO);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_USER);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO);
            $criteria->addSelectColumn(JobEntityConvocatoriaTempTableMap::COL_PROFESION);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.COMPANY_ID');
            $criteria->addSelectColumn($alias . '.AREA_ID');
            $criteria->addSelectColumn($alias . '.LOCALIZACION_ID');
            $criteria->addSelectColumn($alias . '.SALARIO');
            $criteria->addSelectColumn($alias . '.CARGO');
            $criteria->addSelectColumn($alias . '.DESCRIPCION');
            $criteria->addSelectColumn($alias . '.FECHA_PUBLICACION');
            $criteria->addSelectColumn($alias . '.FECHA_VENCIMIENTO');
            $criteria->addSelectColumn($alias . '.ESTADO');
            $criteria->addSelectColumn($alias . '.USER');
            $criteria->addSelectColumn($alias . '.FECHA_REGISTRO');
            $criteria->addSelectColumn($alias . '.CORREO_CONTACTO');
            $criteria->addSelectColumn($alias . '.TELEFONO_CONTACTO');
            $criteria->addSelectColumn($alias . '.PROFESION');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobEntityConvocatoriaTempTableMap::DATABASE_NAME)->getTable(JobEntityConvocatoriaTempTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobEntityConvocatoriaTempTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobEntityConvocatoriaTempTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobEntityConvocatoriaTemp or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobEntityConvocatoriaTemp object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobEntityConvocatoriaTemp) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobEntityConvocatoriaTempQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobEntityConvocatoriaTempTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobEntityConvocatoriaTempTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_entity_convocatoria_temp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobEntityConvocatoriaTempQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobEntityConvocatoriaTemp or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobEntityConvocatoriaTemp object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobEntityConvocatoriaTemp object
        }


        // Set the correct dbName
        $query = JobEntityConvocatoriaTempQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobEntityConvocatoriaTempTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobEntityConvocatoriaTempTableMap::buildTableMap();
