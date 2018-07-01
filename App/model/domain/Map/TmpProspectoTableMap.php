<?php

namespace Map;

use \TmpProspecto;
use \TmpProspectoQuery;
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
 * This class defines the structure of the 'tmp_prospecto' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class TmpProspectoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.TmpProspectoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tmp_prospecto';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TmpProspecto';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TmpProspecto';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    const COL_ID = 'tmp_prospecto.id';

    /**
     * the column name for the primer_apellido field
     */
    const COL_PRIMER_APELLIDO = 'tmp_prospecto.primer_apellido';

    /**
     * the column name for the segundo_apellido field
     */
    const COL_SEGUNDO_APELLIDO = 'tmp_prospecto.segundo_apellido';

    /**
     * the column name for the nombres field
     */
    const COL_NOMBRES = 'tmp_prospecto.nombres';

    /**
     * the column name for the fecha_nacimiento field
     */
    const COL_FECHA_NACIMIENTO = 'tmp_prospecto.fecha_nacimiento';

    /**
     * the column name for the ci field
     */
    const COL_CI = 'tmp_prospecto.ci';

    /**
     * the column name for the extension_ci field
     */
    const COL_EXTENSION_CI = 'tmp_prospecto.extension_ci';

    /**
     * the column name for the sexo field
     */
    const COL_SEXO = 'tmp_prospecto.sexo';

    /**
     * the column name for the pais field
     */
    const COL_PAIS = 'tmp_prospecto.pais';

    /**
     * the column name for the residencia field
     */
    const COL_RESIDENCIA = 'tmp_prospecto.residencia';

    /**
     * the column name for the direccion field
     */
    const COL_DIRECCION = 'tmp_prospecto.direccion';

    /**
     * the column name for the celular field
     */
    const COL_CELULAR = 'tmp_prospecto.celular';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'tmp_prospecto.email';

    /**
     * the column name for the salario field
     */
    const COL_SALARIO = 'tmp_prospecto.salario';

    /**
     * the column name for the areas field
     */
    const COL_AREAS = 'tmp_prospecto.areas';

    /**
     * the column name for the formaciones field
     */
    const COL_FORMACIONES = 'tmp_prospecto.formaciones';

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
        self::TYPE_PHPNAME       => array('Id', 'PrimerApellido', 'SegundoApellido', 'Nombres', 'FechaNacimiento', 'Ci', 'ExtensionCi', 'Sexo', 'Pais', 'Residencia', 'Direccion', 'Celular', 'Email', 'Salario', 'Areas', 'Formaciones', ),
        self::TYPE_CAMELNAME     => array('id', 'primerApellido', 'segundoApellido', 'nombres', 'fechaNacimiento', 'ci', 'extensionCi', 'sexo', 'pais', 'residencia', 'direccion', 'celular', 'email', 'salario', 'areas', 'formaciones', ),
        self::TYPE_COLNAME       => array(TmpProspectoTableMap::COL_ID, TmpProspectoTableMap::COL_PRIMER_APELLIDO, TmpProspectoTableMap::COL_SEGUNDO_APELLIDO, TmpProspectoTableMap::COL_NOMBRES, TmpProspectoTableMap::COL_FECHA_NACIMIENTO, TmpProspectoTableMap::COL_CI, TmpProspectoTableMap::COL_EXTENSION_CI, TmpProspectoTableMap::COL_SEXO, TmpProspectoTableMap::COL_PAIS, TmpProspectoTableMap::COL_RESIDENCIA, TmpProspectoTableMap::COL_DIRECCION, TmpProspectoTableMap::COL_CELULAR, TmpProspectoTableMap::COL_EMAIL, TmpProspectoTableMap::COL_SALARIO, TmpProspectoTableMap::COL_AREAS, TmpProspectoTableMap::COL_FORMACIONES, ),
        self::TYPE_FIELDNAME     => array('id', 'primer_apellido', 'segundo_apellido', 'nombres', 'fecha_nacimiento', 'ci', 'extension_ci', 'sexo', 'pais', 'residencia', 'direccion', 'celular', 'email', 'salario', 'areas', 'formaciones', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'PrimerApellido' => 1, 'SegundoApellido' => 2, 'Nombres' => 3, 'FechaNacimiento' => 4, 'Ci' => 5, 'ExtensionCi' => 6, 'Sexo' => 7, 'Pais' => 8, 'Residencia' => 9, 'Direccion' => 10, 'Celular' => 11, 'Email' => 12, 'Salario' => 13, 'Areas' => 14, 'Formaciones' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'primerApellido' => 1, 'segundoApellido' => 2, 'nombres' => 3, 'fechaNacimiento' => 4, 'ci' => 5, 'extensionCi' => 6, 'sexo' => 7, 'pais' => 8, 'residencia' => 9, 'direccion' => 10, 'celular' => 11, 'email' => 12, 'salario' => 13, 'areas' => 14, 'formaciones' => 15, ),
        self::TYPE_COLNAME       => array(TmpProspectoTableMap::COL_ID => 0, TmpProspectoTableMap::COL_PRIMER_APELLIDO => 1, TmpProspectoTableMap::COL_SEGUNDO_APELLIDO => 2, TmpProspectoTableMap::COL_NOMBRES => 3, TmpProspectoTableMap::COL_FECHA_NACIMIENTO => 4, TmpProspectoTableMap::COL_CI => 5, TmpProspectoTableMap::COL_EXTENSION_CI => 6, TmpProspectoTableMap::COL_SEXO => 7, TmpProspectoTableMap::COL_PAIS => 8, TmpProspectoTableMap::COL_RESIDENCIA => 9, TmpProspectoTableMap::COL_DIRECCION => 10, TmpProspectoTableMap::COL_CELULAR => 11, TmpProspectoTableMap::COL_EMAIL => 12, TmpProspectoTableMap::COL_SALARIO => 13, TmpProspectoTableMap::COL_AREAS => 14, TmpProspectoTableMap::COL_FORMACIONES => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'primer_apellido' => 1, 'segundo_apellido' => 2, 'nombres' => 3, 'fecha_nacimiento' => 4, 'ci' => 5, 'extension_ci' => 6, 'sexo' => 7, 'pais' => 8, 'residencia' => 9, 'direccion' => 10, 'celular' => 11, 'email' => 12, 'salario' => 13, 'areas' => 14, 'formaciones' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('tmp_prospecto');
        $this->setPhpName('TmpProspecto');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TmpProspecto');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('primer_apellido', 'PrimerApellido', 'VARCHAR', true, 30, null);
        $this->addColumn('segundo_apellido', 'SegundoApellido', 'VARCHAR', true, 30, null);
        $this->addColumn('nombres', 'Nombres', 'VARCHAR', true, 50, null);
        $this->addColumn('fecha_nacimiento', 'FechaNacimiento', 'DATE', true, null, null);
        $this->addColumn('ci', 'Ci', 'VARCHAR', true, 20, null);
        $this->addColumn('extension_ci', 'ExtensionCi', 'VARCHAR', true, 3, null);
        $this->addColumn('sexo', 'Sexo', 'VARCHAR', true, 10, null);
        $this->addColumn('pais', 'Pais', 'VARCHAR', true, 50, null);
        $this->addColumn('residencia', 'Residencia', 'VARCHAR', true, 50, null);
        $this->addColumn('direccion', 'Direccion', 'VARCHAR', true, 500, null);
        $this->addColumn('celular', 'Celular', 'VARCHAR', true, 50, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 200, null);
        $this->addColumn('salario', 'Salario', 'INTEGER', true, null, null);
        $this->addColumn('areas', 'Areas', 'VARCHAR', true, 2000, null);
        $this->addColumn('formaciones', 'Formaciones', 'VARCHAR', true, 2000, null);
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
        return $withPrefix ? TmpProspectoTableMap::CLASS_DEFAULT : TmpProspectoTableMap::OM_CLASS;
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
     * @return array           (TmpProspecto object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = TmpProspectoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TmpProspectoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TmpProspectoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TmpProspectoTableMap::OM_CLASS;
            /** @var TmpProspecto $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TmpProspectoTableMap::addInstanceToPool($obj, $key);
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
            $key = TmpProspectoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TmpProspectoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TmpProspecto $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TmpProspectoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_ID);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_PRIMER_APELLIDO);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_SEGUNDO_APELLIDO);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_NOMBRES);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_FECHA_NACIMIENTO);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_CI);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_EXTENSION_CI);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_SEXO);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_PAIS);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_RESIDENCIA);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_CELULAR);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_EMAIL);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_SALARIO);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_AREAS);
            $criteria->addSelectColumn(TmpProspectoTableMap::COL_FORMACIONES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.primer_apellido');
            $criteria->addSelectColumn($alias . '.segundo_apellido');
            $criteria->addSelectColumn($alias . '.nombres');
            $criteria->addSelectColumn($alias . '.fecha_nacimiento');
            $criteria->addSelectColumn($alias . '.ci');
            $criteria->addSelectColumn($alias . '.extension_ci');
            $criteria->addSelectColumn($alias . '.sexo');
            $criteria->addSelectColumn($alias . '.pais');
            $criteria->addSelectColumn($alias . '.residencia');
            $criteria->addSelectColumn($alias . '.direccion');
            $criteria->addSelectColumn($alias . '.celular');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.salario');
            $criteria->addSelectColumn($alias . '.areas');
            $criteria->addSelectColumn($alias . '.formaciones');
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
        return Propel::getServiceContainer()->getDatabaseMap(TmpProspectoTableMap::DATABASE_NAME)->getTable(TmpProspectoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(TmpProspectoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(TmpProspectoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new TmpProspectoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a TmpProspecto or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or TmpProspecto object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TmpProspectoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TmpProspecto) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TmpProspectoTableMap::DATABASE_NAME);
            $criteria->add(TmpProspectoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TmpProspectoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TmpProspectoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TmpProspectoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tmp_prospecto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return TmpProspectoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TmpProspecto or Criteria object.
     *
     * @param mixed               $criteria Criteria or TmpProspecto object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpProspectoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TmpProspecto object
        }


        // Set the correct dbName
        $query = TmpProspectoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // TmpProspectoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
TmpProspectoTableMap::buildTableMap();
