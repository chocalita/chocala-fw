<?php

namespace Map;

use \ScrapEmpresa;
use \ScrapEmpresaQuery;
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
 * This class defines the structure of the 'scrap_empresa' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ScrapEmpresaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ScrapEmpresaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'scrap_empresa';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ScrapEmpresa';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ScrapEmpresa';

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
     * the column name for the ID field
     */
    const COL_ID = 'scrap_empresa.ID';

    /**
     * the column name for the ID_PAGINA field
     */
    const COL_ID_PAGINA = 'scrap_empresa.ID_PAGINA';

    /**
     * the column name for the ID_ACTIVIDAD field
     */
    const COL_ID_ACTIVIDAD = 'scrap_empresa.ID_ACTIVIDAD';

    /**
     * the column name for the ID_TIPO_EMPRESA field
     */
    const COL_ID_TIPO_EMPRESA = 'scrap_empresa.ID_TIPO_EMPRESA';

    /**
     * the column name for the ID_EMPRESA field
     */
    const COL_ID_EMPRESA = 'scrap_empresa.ID_EMPRESA';

    /**
     * the column name for the NIT field
     */
    const COL_NIT = 'scrap_empresa.NIT';

    /**
     * the column name for the NOMBRE field
     */
    const COL_NOMBRE = 'scrap_empresa.NOMBRE';

    /**
     * the column name for the EMAIL field
     */
    const COL_EMAIL = 'scrap_empresa.EMAIL';

    /**
     * the column name for the ACTIVIDAD field
     */
    const COL_ACTIVIDAD = 'scrap_empresa.ACTIVIDAD';

    /**
     * the column name for the LEIDO field
     */
    const COL_LEIDO = 'scrap_empresa.LEIDO';

    /**
     * the column name for the MATRICULA field
     */
    const COL_MATRICULA = 'scrap_empresa.MATRICULA';

    /**
     * the column name for the LICENCIA field
     */
    const COL_LICENCIA = 'scrap_empresa.LICENCIA';

    /**
     * the column name for the MUNICIPIO field
     */
    const COL_MUNICIPIO = 'scrap_empresa.MUNICIPIO';

    /**
     * the column name for the DIRECCION field
     */
    const COL_DIRECCION = 'scrap_empresa.DIRECCION';

    /**
     * the column name for the TELEFONO field
     */
    const COL_TELEFONO = 'scrap_empresa.TELEFONO';

    /**
     * the column name for the FAX field
     */
    const COL_FAX = 'scrap_empresa.FAX';

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
        self::TYPE_PHPNAME       => array('Id', 'IdPagina', 'IdActividad', 'IdTipoEmpresa', 'IdEmpresa', 'Nit', 'Nombre', 'Email', 'Actividad', 'Leido', 'Matricula', 'Licencia', 'Municipio', 'Direccion', 'Telefono', 'Fax', ),
        self::TYPE_CAMELNAME     => array('id', 'idPagina', 'idActividad', 'idTipoEmpresa', 'idEmpresa', 'nit', 'nombre', 'email', 'actividad', 'leido', 'matricula', 'licencia', 'municipio', 'direccion', 'telefono', 'fax', ),
        self::TYPE_COLNAME       => array(ScrapEmpresaTableMap::COL_ID, ScrapEmpresaTableMap::COL_ID_PAGINA, ScrapEmpresaTableMap::COL_ID_ACTIVIDAD, ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA, ScrapEmpresaTableMap::COL_ID_EMPRESA, ScrapEmpresaTableMap::COL_NIT, ScrapEmpresaTableMap::COL_NOMBRE, ScrapEmpresaTableMap::COL_EMAIL, ScrapEmpresaTableMap::COL_ACTIVIDAD, ScrapEmpresaTableMap::COL_LEIDO, ScrapEmpresaTableMap::COL_MATRICULA, ScrapEmpresaTableMap::COL_LICENCIA, ScrapEmpresaTableMap::COL_MUNICIPIO, ScrapEmpresaTableMap::COL_DIRECCION, ScrapEmpresaTableMap::COL_TELEFONO, ScrapEmpresaTableMap::COL_FAX, ),
        self::TYPE_FIELDNAME     => array('ID', 'ID_PAGINA', 'ID_ACTIVIDAD', 'ID_TIPO_EMPRESA', 'ID_EMPRESA', 'NIT', 'NOMBRE', 'EMAIL', 'ACTIVIDAD', 'LEIDO', 'MATRICULA', 'LICENCIA', 'MUNICIPIO', 'DIRECCION', 'TELEFONO', 'FAX', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdPagina' => 1, 'IdActividad' => 2, 'IdTipoEmpresa' => 3, 'IdEmpresa' => 4, 'Nit' => 5, 'Nombre' => 6, 'Email' => 7, 'Actividad' => 8, 'Leido' => 9, 'Matricula' => 10, 'Licencia' => 11, 'Municipio' => 12, 'Direccion' => 13, 'Telefono' => 14, 'Fax' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idPagina' => 1, 'idActividad' => 2, 'idTipoEmpresa' => 3, 'idEmpresa' => 4, 'nit' => 5, 'nombre' => 6, 'email' => 7, 'actividad' => 8, 'leido' => 9, 'matricula' => 10, 'licencia' => 11, 'municipio' => 12, 'direccion' => 13, 'telefono' => 14, 'fax' => 15, ),
        self::TYPE_COLNAME       => array(ScrapEmpresaTableMap::COL_ID => 0, ScrapEmpresaTableMap::COL_ID_PAGINA => 1, ScrapEmpresaTableMap::COL_ID_ACTIVIDAD => 2, ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA => 3, ScrapEmpresaTableMap::COL_ID_EMPRESA => 4, ScrapEmpresaTableMap::COL_NIT => 5, ScrapEmpresaTableMap::COL_NOMBRE => 6, ScrapEmpresaTableMap::COL_EMAIL => 7, ScrapEmpresaTableMap::COL_ACTIVIDAD => 8, ScrapEmpresaTableMap::COL_LEIDO => 9, ScrapEmpresaTableMap::COL_MATRICULA => 10, ScrapEmpresaTableMap::COL_LICENCIA => 11, ScrapEmpresaTableMap::COL_MUNICIPIO => 12, ScrapEmpresaTableMap::COL_DIRECCION => 13, ScrapEmpresaTableMap::COL_TELEFONO => 14, ScrapEmpresaTableMap::COL_FAX => 15, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ID_PAGINA' => 1, 'ID_ACTIVIDAD' => 2, 'ID_TIPO_EMPRESA' => 3, 'ID_EMPRESA' => 4, 'NIT' => 5, 'NOMBRE' => 6, 'EMAIL' => 7, 'ACTIVIDAD' => 8, 'LEIDO' => 9, 'MATRICULA' => 10, 'LICENCIA' => 11, 'MUNICIPIO' => 12, 'DIRECCION' => 13, 'TELEFONO' => 14, 'FAX' => 15, ),
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
        $this->setName('scrap_empresa');
        $this->setPhpName('ScrapEmpresa');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ScrapEmpresa');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_PAGINA', 'IdPagina', 'INTEGER', 'scrap_pagina', 'ID', true, null, null);
        $this->addForeignKey('ID_ACTIVIDAD', 'IdActividad', 'INTEGER', 'scrap_actividad', 'ID', false, null, null);
        $this->addForeignKey('ID_TIPO_EMPRESA', 'IdTipoEmpresa', 'INTEGER', 'scrap_tipo_empresa', 'ID', false, null, null);
        $this->addColumn('ID_EMPRESA', 'IdEmpresa', 'VARCHAR', true, 200, null);
        $this->addColumn('NIT', 'Nit', 'VARCHAR', false, 30, null);
        $this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 500, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 200, null);
        $this->addColumn('ACTIVIDAD', 'Actividad', 'LONGVARCHAR', false, null, null);
        $this->addColumn('LEIDO', 'Leido', 'BOOLEAN', true, 1, false);
        $this->addColumn('MATRICULA', 'Matricula', 'VARCHAR', false, 30, null);
        $this->addColumn('LICENCIA', 'Licencia', 'VARCHAR', false, 30, null);
        $this->addColumn('MUNICIPIO', 'Municipio', 'VARCHAR', false, 30, null);
        $this->addColumn('DIRECCION', 'Direccion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('TELEFONO', 'Telefono', 'VARCHAR', false, 50, null);
        $this->addColumn('FAX', 'Fax', 'VARCHAR', false, 50, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ScrapActividad', '\\ScrapActividad', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_ACTIVIDAD',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('ScrapTipoEmpresa', '\\ScrapTipoEmpresa', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_TIPO_EMPRESA',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('ScrapPagina', '\\ScrapPagina', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_PAGINA',
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
        return $withPrefix ? ScrapEmpresaTableMap::CLASS_DEFAULT : ScrapEmpresaTableMap::OM_CLASS;
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
     * @return array           (ScrapEmpresa object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ScrapEmpresaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ScrapEmpresaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ScrapEmpresaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ScrapEmpresaTableMap::OM_CLASS;
            /** @var ScrapEmpresa $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ScrapEmpresaTableMap::addInstanceToPool($obj, $key);
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
            $key = ScrapEmpresaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ScrapEmpresaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ScrapEmpresa $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ScrapEmpresaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_ID);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_ID_PAGINA);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_ID_EMPRESA);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_NIT);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_EMAIL);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_ACTIVIDAD);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_LEIDO);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_MATRICULA);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_LICENCIA);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_MUNICIPIO);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_TELEFONO);
            $criteria->addSelectColumn(ScrapEmpresaTableMap::COL_FAX);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ID_PAGINA');
            $criteria->addSelectColumn($alias . '.ID_ACTIVIDAD');
            $criteria->addSelectColumn($alias . '.ID_TIPO_EMPRESA');
            $criteria->addSelectColumn($alias . '.ID_EMPRESA');
            $criteria->addSelectColumn($alias . '.NIT');
            $criteria->addSelectColumn($alias . '.NOMBRE');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.ACTIVIDAD');
            $criteria->addSelectColumn($alias . '.LEIDO');
            $criteria->addSelectColumn($alias . '.MATRICULA');
            $criteria->addSelectColumn($alias . '.LICENCIA');
            $criteria->addSelectColumn($alias . '.MUNICIPIO');
            $criteria->addSelectColumn($alias . '.DIRECCION');
            $criteria->addSelectColumn($alias . '.TELEFONO');
            $criteria->addSelectColumn($alias . '.FAX');
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
        return Propel::getServiceContainer()->getDatabaseMap(ScrapEmpresaTableMap::DATABASE_NAME)->getTable(ScrapEmpresaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ScrapEmpresaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ScrapEmpresaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ScrapEmpresaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ScrapEmpresa or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ScrapEmpresa object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapEmpresaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ScrapEmpresa) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ScrapEmpresaTableMap::DATABASE_NAME);
            $criteria->add(ScrapEmpresaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ScrapEmpresaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ScrapEmpresaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ScrapEmpresaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the scrap_empresa table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ScrapEmpresaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ScrapEmpresa or Criteria object.
     *
     * @param mixed               $criteria Criteria or ScrapEmpresa object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapEmpresaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ScrapEmpresa object
        }

        if ($criteria->containsKey(ScrapEmpresaTableMap::COL_ID) && $criteria->keyContainsValue(ScrapEmpresaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ScrapEmpresaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ScrapEmpresaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ScrapEmpresaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ScrapEmpresaTableMap::buildTableMap();
