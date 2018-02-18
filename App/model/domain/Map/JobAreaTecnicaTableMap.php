<?php

namespace Map;

use \JobAreaTecnica;
use \JobAreaTecnicaQuery;
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
 * This class defines the structure of the 'job_area_tecnica' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobAreaTecnicaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobAreaTecnicaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_area_tecnica';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobAreaTecnica';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobAreaTecnica';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_area_tecnica.ID';

    /**
     * the column name for the ID_AREA_PRINCIPAL field
     */
    const COL_ID_AREA_PRINCIPAL = 'job_area_tecnica.ID_AREA_PRINCIPAL';

    /**
     * the column name for the NIVEL field
     */
    const COL_NIVEL = 'job_area_tecnica.NIVEL';

    /**
     * the column name for the NOMBRE field
     */
    const COL_NOMBRE = 'job_area_tecnica.NOMBRE';

    /**
     * the column name for the KEYWORDS field
     */
    const COL_KEYWORDS = 'job_area_tecnica.KEYWORDS';

    /**
     * the column name for the DESCRIPCION field
     */
    const COL_DESCRIPCION = 'job_area_tecnica.DESCRIPCION';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_area_tecnica.STATUS';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_area_tecnica.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_area_tecnica.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_area_tecnica.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'IdAreaPrincipal', 'Nivel', 'Nombre', 'Keywords', 'Descripcion', 'Status', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'idAreaPrincipal', 'nivel', 'nombre', 'keywords', 'descripcion', 'status', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobAreaTecnicaTableMap::COL_ID, JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL, JobAreaTecnicaTableMap::COL_NIVEL, JobAreaTecnicaTableMap::COL_NOMBRE, JobAreaTecnicaTableMap::COL_KEYWORDS, JobAreaTecnicaTableMap::COL_DESCRIPCION, JobAreaTecnicaTableMap::COL_STATUS, JobAreaTecnicaTableMap::COL_LAST_USER_ID, JobAreaTecnicaTableMap::COL_CREATION_DATE, JobAreaTecnicaTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'ID_AREA_PRINCIPAL', 'NIVEL', 'NOMBRE', 'KEYWORDS', 'DESCRIPCION', 'STATUS', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdAreaPrincipal' => 1, 'Nivel' => 2, 'Nombre' => 3, 'Keywords' => 4, 'Descripcion' => 5, 'Status' => 6, 'LastUserId' => 7, 'CreationDate' => 8, 'ModificationDate' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idAreaPrincipal' => 1, 'nivel' => 2, 'nombre' => 3, 'keywords' => 4, 'descripcion' => 5, 'status' => 6, 'lastUserId' => 7, 'creationDate' => 8, 'modificationDate' => 9, ),
        self::TYPE_COLNAME       => array(JobAreaTecnicaTableMap::COL_ID => 0, JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL => 1, JobAreaTecnicaTableMap::COL_NIVEL => 2, JobAreaTecnicaTableMap::COL_NOMBRE => 3, JobAreaTecnicaTableMap::COL_KEYWORDS => 4, JobAreaTecnicaTableMap::COL_DESCRIPCION => 5, JobAreaTecnicaTableMap::COL_STATUS => 6, JobAreaTecnicaTableMap::COL_LAST_USER_ID => 7, JobAreaTecnicaTableMap::COL_CREATION_DATE => 8, JobAreaTecnicaTableMap::COL_MODIFICATION_DATE => 9, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ID_AREA_PRINCIPAL' => 1, 'NIVEL' => 2, 'NOMBRE' => 3, 'KEYWORDS' => 4, 'DESCRIPCION' => 5, 'STATUS' => 6, 'LAST_USER_ID' => 7, 'CREATION_DATE' => 8, 'MODIFICATION_DATE' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('job_area_tecnica');
        $this->setPhpName('JobAreaTecnica');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobAreaTecnica');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ID_AREA_PRINCIPAL', 'IdAreaPrincipal', 'INTEGER', false, null, null);
        $this->addColumn('NIVEL', 'Nivel', 'INTEGER', false, null, null);
        $this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 100, null);
        $this->addColumn('KEYWORDS', 'Keywords', 'VARCHAR', false, 500, null);
        $this->addColumn('DESCRIPCION', 'Descripcion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 10, 'ACTIVE');
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobAreaRelacionadaRelatedByIdArea1', '\\JobAreaRelacionada', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_AREA_1',
    1 => ':ID',
  ),
), null, null, 'JobAreaRelacionadasRelatedByIdArea1', false);
        $this->addRelation('JobAreaRelacionadaRelatedByIdArea2', '\\JobAreaRelacionada', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_AREA_2',
    1 => ':ID',
  ),
), null, null, 'JobAreaRelacionadasRelatedByIdArea2', false);
        $this->addRelation('JobAreaTecnicaProfesion', '\\JobAreaTecnicaProfesion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ID_AREA_TECNICA',
    1 => ':ID',
  ),
), null, null, 'JobAreaTecnicaProfesions', false);
        $this->addRelation('JobAviso', '\\JobAviso', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':AREA_TECNICA_ID',
    1 => ':ID',
  ),
), null, null, 'JobAvisos', false);
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
        return $withPrefix ? JobAreaTecnicaTableMap::CLASS_DEFAULT : JobAreaTecnicaTableMap::OM_CLASS;
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
     * @return array           (JobAreaTecnica object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobAreaTecnicaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobAreaTecnicaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobAreaTecnicaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobAreaTecnicaTableMap::OM_CLASS;
            /** @var JobAreaTecnica $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobAreaTecnicaTableMap::addInstanceToPool($obj, $key);
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
            $key = JobAreaTecnicaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobAreaTecnicaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobAreaTecnica $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobAreaTecnicaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_ID);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_NIVEL);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_KEYWORDS);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobAreaTecnicaTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ID_AREA_PRINCIPAL');
            $criteria->addSelectColumn($alias . '.NIVEL');
            $criteria->addSelectColumn($alias . '.NOMBRE');
            $criteria->addSelectColumn($alias . '.KEYWORDS');
            $criteria->addSelectColumn($alias . '.DESCRIPCION');
            $criteria->addSelectColumn($alias . '.STATUS');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobAreaTecnicaTableMap::DATABASE_NAME)->getTable(JobAreaTecnicaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobAreaTecnicaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobAreaTecnicaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobAreaTecnicaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobAreaTecnica or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobAreaTecnica object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobAreaTecnica) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobAreaTecnicaTableMap::DATABASE_NAME);
            $criteria->add(JobAreaTecnicaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobAreaTecnicaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobAreaTecnicaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobAreaTecnicaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_area_tecnica table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobAreaTecnicaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobAreaTecnica or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobAreaTecnica object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobAreaTecnica object
        }

        if ($criteria->containsKey(JobAreaTecnicaTableMap::COL_ID) && $criteria->keyContainsValue(JobAreaTecnicaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobAreaTecnicaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobAreaTecnicaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobAreaTecnicaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobAreaTecnicaTableMap::buildTableMap();
