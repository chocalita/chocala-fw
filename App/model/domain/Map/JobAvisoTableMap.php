<?php

namespace Map;

use \JobAviso;
use \JobAvisoQuery;
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
 * This class defines the structure of the 'job_aviso' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobAvisoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobAvisoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_aviso';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobAviso';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobAviso';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 26;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 26;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_aviso.ID';

    /**
     * the column name for the AREA_ID field
     */
    const COL_AREA_ID = 'job_aviso.AREA_ID';

    /**
     * the column name for the AREA_TECNICA_ID field
     */
    const COL_AREA_TECNICA_ID = 'job_aviso.AREA_TECNICA_ID';

    /**
     * the column name for the LOCALIZACION field
     */
    const COL_LOCALIZACION = 'job_aviso.LOCALIZACION';

    /**
     * the column name for the CARGO field
     */
    const COL_CARGO = 'job_aviso.CARGO';

    /**
     * the column name for the DESCRIPCION field
     */
    const COL_DESCRIPCION = 'job_aviso.DESCRIPCION';

    /**
     * the column name for the NOMBRE_EMPRESA field
     */
    const COL_NOMBRE_EMPRESA = 'job_aviso.NOMBRE_EMPRESA';

    /**
     * the column name for the DIRECCION field
     */
    const COL_DIRECCION = 'job_aviso.DIRECCION';

    /**
     * the column name for the TELEFONO_CONTACTO field
     */
    const COL_TELEFONO_CONTACTO = 'job_aviso.TELEFONO_CONTACTO';

    /**
     * the column name for the CORREO_CONTACTO field
     */
    const COL_CORREO_CONTACTO = 'job_aviso.CORREO_CONTACTO';

    /**
     * the column name for the FECHA_PUBLICACION field
     */
    const COL_FECHA_PUBLICACION = 'job_aviso.FECHA_PUBLICACION';

    /**
     * the column name for the FECHA_VENCIMIENTO field
     */
    const COL_FECHA_VENCIMIENTO = 'job_aviso.FECHA_VENCIMIENTO';

    /**
     * the column name for the REQUISITO field
     */
    const COL_REQUISITO = 'job_aviso.REQUISITO';

    /**
     * the column name for the ANIOS_EXPERIENCIA field
     */
    const COL_ANIOS_EXPERIENCIA = 'job_aviso.ANIOS_EXPERIENCIA';

    /**
     * the column name for the NIVEL_FORMACION field
     */
    const COL_NIVEL_FORMACION = 'job_aviso.NIVEL_FORMACION';

    /**
     * the column name for the SALARIO field
     */
    const COL_SALARIO = 'job_aviso.SALARIO';

    /**
     * the column name for the PROFESION field
     */
    const COL_PROFESION = 'job_aviso.PROFESION';

    /**
     * the column name for the FUENTE field
     */
    const COL_FUENTE = 'job_aviso.FUENTE';

    /**
     * the column name for the TIENE_IMAGEN field
     */
    const COL_TIENE_IMAGEN = 'job_aviso.TIENE_IMAGEN';

    /**
     * the column name for the MIMETYPE field
     */
    const COL_MIMETYPE = 'job_aviso.MIMETYPE';

    /**
     * the column name for the AREAS_REFERENCIA field
     */
    const COL_AREAS_REFERENCIA = 'job_aviso.AREAS_REFERENCIA';

    /**
     * the column name for the FORMACIONES_REFERENCIA field
     */
    const COL_FORMACIONES_REFERENCIA = 'job_aviso.FORMACIONES_REFERENCIA';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_aviso.STATUS';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_aviso.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_aviso.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_aviso.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'AreaId', 'AreaTecnicaId', 'Localizacion', 'Cargo', 'Descripcion', 'NombreEmpresa', 'Direccion', 'TelefonoContacto', 'CorreoContacto', 'FechaPublicacion', 'FechaVencimiento', 'Requisito', 'AniosExperiencia', 'NivelFormacion', 'Salario', 'Profesion', 'Fuente', 'TieneImagen', 'Mimetype', 'AreasReferencia', 'FormacionesReferencia', 'Status', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'areaId', 'areaTecnicaId', 'localizacion', 'cargo', 'descripcion', 'nombreEmpresa', 'direccion', 'telefonoContacto', 'correoContacto', 'fechaPublicacion', 'fechaVencimiento', 'requisito', 'aniosExperiencia', 'nivelFormacion', 'salario', 'profesion', 'fuente', 'tieneImagen', 'mimetype', 'areasReferencia', 'formacionesReferencia', 'status', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobAvisoTableMap::COL_ID, JobAvisoTableMap::COL_AREA_ID, JobAvisoTableMap::COL_AREA_TECNICA_ID, JobAvisoTableMap::COL_LOCALIZACION, JobAvisoTableMap::COL_CARGO, JobAvisoTableMap::COL_DESCRIPCION, JobAvisoTableMap::COL_NOMBRE_EMPRESA, JobAvisoTableMap::COL_DIRECCION, JobAvisoTableMap::COL_TELEFONO_CONTACTO, JobAvisoTableMap::COL_CORREO_CONTACTO, JobAvisoTableMap::COL_FECHA_PUBLICACION, JobAvisoTableMap::COL_FECHA_VENCIMIENTO, JobAvisoTableMap::COL_REQUISITO, JobAvisoTableMap::COL_ANIOS_EXPERIENCIA, JobAvisoTableMap::COL_NIVEL_FORMACION, JobAvisoTableMap::COL_SALARIO, JobAvisoTableMap::COL_PROFESION, JobAvisoTableMap::COL_FUENTE, JobAvisoTableMap::COL_TIENE_IMAGEN, JobAvisoTableMap::COL_MIMETYPE, JobAvisoTableMap::COL_AREAS_REFERENCIA, JobAvisoTableMap::COL_FORMACIONES_REFERENCIA, JobAvisoTableMap::COL_STATUS, JobAvisoTableMap::COL_LAST_USER_ID, JobAvisoTableMap::COL_CREATION_DATE, JobAvisoTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'AREA_ID', 'AREA_TECNICA_ID', 'LOCALIZACION', 'CARGO', 'DESCRIPCION', 'NOMBRE_EMPRESA', 'DIRECCION', 'TELEFONO_CONTACTO', 'CORREO_CONTACTO', 'FECHA_PUBLICACION', 'FECHA_VENCIMIENTO', 'REQUISITO', 'ANIOS_EXPERIENCIA', 'NIVEL_FORMACION', 'SALARIO', 'PROFESION', 'FUENTE', 'TIENE_IMAGEN', 'MIMETYPE', 'AREAS_REFERENCIA', 'FORMACIONES_REFERENCIA', 'STATUS', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AreaId' => 1, 'AreaTecnicaId' => 2, 'Localizacion' => 3, 'Cargo' => 4, 'Descripcion' => 5, 'NombreEmpresa' => 6, 'Direccion' => 7, 'TelefonoContacto' => 8, 'CorreoContacto' => 9, 'FechaPublicacion' => 10, 'FechaVencimiento' => 11, 'Requisito' => 12, 'AniosExperiencia' => 13, 'NivelFormacion' => 14, 'Salario' => 15, 'Profesion' => 16, 'Fuente' => 17, 'TieneImagen' => 18, 'Mimetype' => 19, 'AreasReferencia' => 20, 'FormacionesReferencia' => 21, 'Status' => 22, 'LastUserId' => 23, 'CreationDate' => 24, 'ModificationDate' => 25, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'areaId' => 1, 'areaTecnicaId' => 2, 'localizacion' => 3, 'cargo' => 4, 'descripcion' => 5, 'nombreEmpresa' => 6, 'direccion' => 7, 'telefonoContacto' => 8, 'correoContacto' => 9, 'fechaPublicacion' => 10, 'fechaVencimiento' => 11, 'requisito' => 12, 'aniosExperiencia' => 13, 'nivelFormacion' => 14, 'salario' => 15, 'profesion' => 16, 'fuente' => 17, 'tieneImagen' => 18, 'mimetype' => 19, 'areasReferencia' => 20, 'formacionesReferencia' => 21, 'status' => 22, 'lastUserId' => 23, 'creationDate' => 24, 'modificationDate' => 25, ),
        self::TYPE_COLNAME       => array(JobAvisoTableMap::COL_ID => 0, JobAvisoTableMap::COL_AREA_ID => 1, JobAvisoTableMap::COL_AREA_TECNICA_ID => 2, JobAvisoTableMap::COL_LOCALIZACION => 3, JobAvisoTableMap::COL_CARGO => 4, JobAvisoTableMap::COL_DESCRIPCION => 5, JobAvisoTableMap::COL_NOMBRE_EMPRESA => 6, JobAvisoTableMap::COL_DIRECCION => 7, JobAvisoTableMap::COL_TELEFONO_CONTACTO => 8, JobAvisoTableMap::COL_CORREO_CONTACTO => 9, JobAvisoTableMap::COL_FECHA_PUBLICACION => 10, JobAvisoTableMap::COL_FECHA_VENCIMIENTO => 11, JobAvisoTableMap::COL_REQUISITO => 12, JobAvisoTableMap::COL_ANIOS_EXPERIENCIA => 13, JobAvisoTableMap::COL_NIVEL_FORMACION => 14, JobAvisoTableMap::COL_SALARIO => 15, JobAvisoTableMap::COL_PROFESION => 16, JobAvisoTableMap::COL_FUENTE => 17, JobAvisoTableMap::COL_TIENE_IMAGEN => 18, JobAvisoTableMap::COL_MIMETYPE => 19, JobAvisoTableMap::COL_AREAS_REFERENCIA => 20, JobAvisoTableMap::COL_FORMACIONES_REFERENCIA => 21, JobAvisoTableMap::COL_STATUS => 22, JobAvisoTableMap::COL_LAST_USER_ID => 23, JobAvisoTableMap::COL_CREATION_DATE => 24, JobAvisoTableMap::COL_MODIFICATION_DATE => 25, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'AREA_ID' => 1, 'AREA_TECNICA_ID' => 2, 'LOCALIZACION' => 3, 'CARGO' => 4, 'DESCRIPCION' => 5, 'NOMBRE_EMPRESA' => 6, 'DIRECCION' => 7, 'TELEFONO_CONTACTO' => 8, 'CORREO_CONTACTO' => 9, 'FECHA_PUBLICACION' => 10, 'FECHA_VENCIMIENTO' => 11, 'REQUISITO' => 12, 'ANIOS_EXPERIENCIA' => 13, 'NIVEL_FORMACION' => 14, 'SALARIO' => 15, 'PROFESION' => 16, 'FUENTE' => 17, 'TIENE_IMAGEN' => 18, 'MIMETYPE' => 19, 'AREAS_REFERENCIA' => 20, 'FORMACIONES_REFERENCIA' => 21, 'STATUS' => 22, 'LAST_USER_ID' => 23, 'CREATION_DATE' => 24, 'MODIFICATION_DATE' => 25, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
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
        $this->setName('job_aviso');
        $this->setPhpName('JobAviso');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobAviso');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('AREA_ID', 'AreaId', 'INTEGER', 'job_area', 'ID', false, null, null);
        $this->addForeignKey('AREA_TECNICA_ID', 'AreaTecnicaId', 'INTEGER', 'job_area_tecnica', 'ID', false, null, null);
        $this->addColumn('LOCALIZACION', 'Localizacion', 'VARCHAR', false, 50, null);
        $this->addColumn('CARGO', 'Cargo', 'VARCHAR', false, 200, null);
        $this->addColumn('DESCRIPCION', 'Descripcion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('NOMBRE_EMPRESA', 'NombreEmpresa', 'VARCHAR', false, 500, null);
        $this->addColumn('DIRECCION', 'Direccion', 'VARCHAR', false, 200, null);
        $this->addColumn('TELEFONO_CONTACTO', 'TelefonoContacto', 'INTEGER', false, null, null);
        $this->addColumn('CORREO_CONTACTO', 'CorreoContacto', 'VARCHAR', false, 100, null);
        $this->addColumn('FECHA_PUBLICACION', 'FechaPublicacion', 'DATE', false, null, null);
        $this->addColumn('FECHA_VENCIMIENTO', 'FechaVencimiento', 'DATE', false, null, null);
        $this->addColumn('REQUISITO', 'Requisito', 'VARCHAR', false, 2000, null);
        $this->addColumn('ANIOS_EXPERIENCIA', 'AniosExperiencia', 'INTEGER', false, null, null);
        $this->addColumn('NIVEL_FORMACION', 'NivelFormacion', 'VARCHAR', false, 200, null);
        $this->addColumn('SALARIO', 'Salario', 'DECIMAL', false, 11, null);
        $this->addColumn('PROFESION', 'Profesion', 'VARCHAR', false, 200, null);
        $this->addColumn('FUENTE', 'Fuente', 'VARCHAR', false, 500, null);
        $this->addColumn('TIENE_IMAGEN', 'TieneImagen', 'BOOLEAN', true, 1, false);
        $this->addColumn('MIMETYPE', 'Mimetype', 'VARCHAR', false, 30, null);
        $this->addColumn('AREAS_REFERENCIA', 'AreasReferencia', 'VARCHAR', false, 500, null);
        $this->addColumn('FORMACIONES_REFERENCIA', 'FormacionesReferencia', 'VARCHAR', false, 2000, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 10, 'ACTIVE');
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'VARCHAR', true, 20, '0');
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobAreaTecnica', '\\JobAreaTecnica', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':AREA_TECNICA_ID',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('JobArea', '\\JobArea', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':AREA_ID',
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
        return $withPrefix ? JobAvisoTableMap::CLASS_DEFAULT : JobAvisoTableMap::OM_CLASS;
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
     * @return array           (JobAviso object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobAvisoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobAvisoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobAvisoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobAvisoTableMap::OM_CLASS;
            /** @var JobAviso $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobAvisoTableMap::addInstanceToPool($obj, $key);
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
            $key = JobAvisoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobAvisoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobAviso $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobAvisoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobAvisoTableMap::COL_ID);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_AREA_ID);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_AREA_TECNICA_ID);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_LOCALIZACION);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_CARGO);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_NOMBRE_EMPRESA);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_TELEFONO_CONTACTO);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_CORREO_CONTACTO);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_FECHA_PUBLICACION);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_FECHA_VENCIMIENTO);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_REQUISITO);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_ANIOS_EXPERIENCIA);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_NIVEL_FORMACION);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_SALARIO);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_PROFESION);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_FUENTE);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_TIENE_IMAGEN);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_MIMETYPE);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_AREAS_REFERENCIA);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_FORMACIONES_REFERENCIA);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobAvisoTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.AREA_ID');
            $criteria->addSelectColumn($alias . '.AREA_TECNICA_ID');
            $criteria->addSelectColumn($alias . '.LOCALIZACION');
            $criteria->addSelectColumn($alias . '.CARGO');
            $criteria->addSelectColumn($alias . '.DESCRIPCION');
            $criteria->addSelectColumn($alias . '.NOMBRE_EMPRESA');
            $criteria->addSelectColumn($alias . '.DIRECCION');
            $criteria->addSelectColumn($alias . '.TELEFONO_CONTACTO');
            $criteria->addSelectColumn($alias . '.CORREO_CONTACTO');
            $criteria->addSelectColumn($alias . '.FECHA_PUBLICACION');
            $criteria->addSelectColumn($alias . '.FECHA_VENCIMIENTO');
            $criteria->addSelectColumn($alias . '.REQUISITO');
            $criteria->addSelectColumn($alias . '.ANIOS_EXPERIENCIA');
            $criteria->addSelectColumn($alias . '.NIVEL_FORMACION');
            $criteria->addSelectColumn($alias . '.SALARIO');
            $criteria->addSelectColumn($alias . '.PROFESION');
            $criteria->addSelectColumn($alias . '.FUENTE');
            $criteria->addSelectColumn($alias . '.TIENE_IMAGEN');
            $criteria->addSelectColumn($alias . '.MIMETYPE');
            $criteria->addSelectColumn($alias . '.AREAS_REFERENCIA');
            $criteria->addSelectColumn($alias . '.FORMACIONES_REFERENCIA');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobAvisoTableMap::DATABASE_NAME)->getTable(JobAvisoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobAvisoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobAvisoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobAvisoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobAviso or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobAviso object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAvisoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobAviso) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobAvisoTableMap::DATABASE_NAME);
            $criteria->add(JobAvisoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobAvisoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobAvisoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobAvisoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_aviso table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobAvisoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobAviso or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobAviso object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAvisoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobAviso object
        }

        if ($criteria->containsKey(JobAvisoTableMap::COL_ID) && $criteria->keyContainsValue(JobAvisoTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobAvisoTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobAvisoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobAvisoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobAvisoTableMap::buildTableMap();
