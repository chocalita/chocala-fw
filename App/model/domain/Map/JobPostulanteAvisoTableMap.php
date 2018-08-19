<?php

namespace Map;

use \JobPostulanteAviso;
use \JobPostulanteAvisoQuery;
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
 * This class defines the structure of the 'job_postulante_aviso' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobPostulanteAvisoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobPostulanteAvisoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_postulante_aviso';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobPostulanteAviso';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobPostulanteAviso';

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
    const COL_ID = 'job_postulante_aviso.ID';

    /**
     * the column name for the ID_AVISO field
     */
    const COL_ID_AVISO = 'job_postulante_aviso.ID_AVISO';

    /**
     * the column name for the ID_POSTULANTE field
     */
    const COL_ID_POSTULANTE = 'job_postulante_aviso.ID_POSTULANTE';

    /**
     * the column name for the ESTADO field
     */
    const COL_ESTADO = 'job_postulante_aviso.ESTADO';

    /**
     * the column name for the PRETENSION_SALARIAL field
     */
    const COL_PRETENSION_SALARIAL = 'job_postulante_aviso.PRETENSION_SALARIAL';

    /**
     * the column name for the CARTA_PRESENTACION field
     */
    const COL_CARTA_PRESENTACION = 'job_postulante_aviso.CARTA_PRESENTACION';

    /**
     * the column name for the CV_MIME field
     */
    const COL_CV_MIME = 'job_postulante_aviso.CV_MIME';

    /**
     * the column name for the CV_FILENAME field
     */
    const COL_CV_FILENAME = 'job_postulante_aviso.CV_FILENAME';

    /**
     * the column name for the FECHA_POSTULACION field
     */
    const COL_FECHA_POSTULACION = 'job_postulante_aviso.FECHA_POSTULACION';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_postulante_aviso.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_postulante_aviso.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_postulante_aviso.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'IdAviso', 'IdPostulante', 'Estado', 'PretensionSalarial', 'CartaPresentacion', 'CvMime', 'CvFilename', 'FechaPostulacion', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'idAviso', 'idPostulante', 'estado', 'pretensionSalarial', 'cartaPresentacion', 'cvMime', 'cvFilename', 'fechaPostulacion', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobPostulanteAvisoTableMap::COL_ID, JobPostulanteAvisoTableMap::COL_ID_AVISO, JobPostulanteAvisoTableMap::COL_ID_POSTULANTE, JobPostulanteAvisoTableMap::COL_ESTADO, JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL, JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION, JobPostulanteAvisoTableMap::COL_CV_MIME, JobPostulanteAvisoTableMap::COL_CV_FILENAME, JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION, JobPostulanteAvisoTableMap::COL_LAST_USER_ID, JobPostulanteAvisoTableMap::COL_CREATION_DATE, JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'ID_AVISO', 'ID_POSTULANTE', 'ESTADO', 'PRETENSION_SALARIAL', 'CARTA_PRESENTACION', 'CV_MIME', 'CV_FILENAME', 'FECHA_POSTULACION', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdAviso' => 1, 'IdPostulante' => 2, 'Estado' => 3, 'PretensionSalarial' => 4, 'CartaPresentacion' => 5, 'CvMime' => 6, 'CvFilename' => 7, 'FechaPostulacion' => 8, 'LastUserId' => 9, 'CreationDate' => 10, 'ModificationDate' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idAviso' => 1, 'idPostulante' => 2, 'estado' => 3, 'pretensionSalarial' => 4, 'cartaPresentacion' => 5, 'cvMime' => 6, 'cvFilename' => 7, 'fechaPostulacion' => 8, 'lastUserId' => 9, 'creationDate' => 10, 'modificationDate' => 11, ),
        self::TYPE_COLNAME       => array(JobPostulanteAvisoTableMap::COL_ID => 0, JobPostulanteAvisoTableMap::COL_ID_AVISO => 1, JobPostulanteAvisoTableMap::COL_ID_POSTULANTE => 2, JobPostulanteAvisoTableMap::COL_ESTADO => 3, JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL => 4, JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION => 5, JobPostulanteAvisoTableMap::COL_CV_MIME => 6, JobPostulanteAvisoTableMap::COL_CV_FILENAME => 7, JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION => 8, JobPostulanteAvisoTableMap::COL_LAST_USER_ID => 9, JobPostulanteAvisoTableMap::COL_CREATION_DATE => 10, JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE => 11, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ID_AVISO' => 1, 'ID_POSTULANTE' => 2, 'ESTADO' => 3, 'PRETENSION_SALARIAL' => 4, 'CARTA_PRESENTACION' => 5, 'CV_MIME' => 6, 'CV_FILENAME' => 7, 'FECHA_POSTULACION' => 8, 'LAST_USER_ID' => 9, 'CREATION_DATE' => 10, 'MODIFICATION_DATE' => 11, ),
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
        $this->setName('job_postulante_aviso');
        $this->setPhpName('JobPostulanteAviso');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobPostulanteAviso');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_AVISO', 'IdAviso', 'INTEGER', 'job_aviso', 'ID', true, null, null);
        $this->addForeignKey('ID_POSTULANTE', 'IdPostulante', 'INTEGER', 'job_postulante', 'ID', true, null, null);
        $this->addColumn('ESTADO', 'Estado', 'VARCHAR', true, 20, '');
        $this->addColumn('PRETENSION_SALARIAL', 'PretensionSalarial', 'INTEGER', false, null, null);
        $this->addColumn('CARTA_PRESENTACION', 'CartaPresentacion', 'VARCHAR', false, 20, null);
        $this->addColumn('CV_MIME', 'CvMime', 'VARCHAR', false, 30, null);
        $this->addColumn('CV_FILENAME', 'CvFilename', 'VARCHAR', false, 300, null);
        $this->addColumn('FECHA_POSTULACION', 'FechaPostulacion', 'TIMESTAMP', false, null, null);
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobPostulante', '\\JobPostulante', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_POSTULANTE',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('JobAviso', '\\JobAviso', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_AVISO',
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
        return $withPrefix ? JobPostulanteAvisoTableMap::CLASS_DEFAULT : JobPostulanteAvisoTableMap::OM_CLASS;
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
     * @return array           (JobPostulanteAviso object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobPostulanteAvisoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobPostulanteAvisoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobPostulanteAvisoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobPostulanteAvisoTableMap::OM_CLASS;
            /** @var JobPostulanteAviso $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobPostulanteAvisoTableMap::addInstanceToPool($obj, $key);
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
            $key = JobPostulanteAvisoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobPostulanteAvisoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobPostulanteAviso $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobPostulanteAvisoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_ID);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_ID_AVISO);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_ESTADO);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_CV_MIME);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_CV_FILENAME);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ID_AVISO');
            $criteria->addSelectColumn($alias . '.ID_POSTULANTE');
            $criteria->addSelectColumn($alias . '.ESTADO');
            $criteria->addSelectColumn($alias . '.PRETENSION_SALARIAL');
            $criteria->addSelectColumn($alias . '.CARTA_PRESENTACION');
            $criteria->addSelectColumn($alias . '.CV_MIME');
            $criteria->addSelectColumn($alias . '.CV_FILENAME');
            $criteria->addSelectColumn($alias . '.FECHA_POSTULACION');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobPostulanteAvisoTableMap::DATABASE_NAME)->getTable(JobPostulanteAvisoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobPostulanteAvisoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobPostulanteAvisoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobPostulanteAvisoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobPostulanteAviso or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobPostulanteAviso object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobPostulanteAviso) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobPostulanteAvisoTableMap::DATABASE_NAME);
            $criteria->add(JobPostulanteAvisoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobPostulanteAvisoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobPostulanteAvisoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobPostulanteAvisoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_postulante_aviso table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobPostulanteAvisoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobPostulanteAviso or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobPostulanteAviso object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobPostulanteAviso object
        }

        if ($criteria->containsKey(JobPostulanteAvisoTableMap::COL_ID) && $criteria->keyContainsValue(JobPostulanteAvisoTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobPostulanteAvisoTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobPostulanteAvisoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobPostulanteAvisoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobPostulanteAvisoTableMap::buildTableMap();
