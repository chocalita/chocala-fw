<?php

namespace Map;

use \JobFormacionAcademica;
use \JobFormacionAcademicaQuery;
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
 * This class defines the structure of the 'job_formacion_academica' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobFormacionAcademicaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobFormacionAcademicaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_formacion_academica';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobFormacionAcademica';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobFormacionAcademica';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 25;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 25;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_formacion_academica.ID';

    /**
     * the column name for the ID_CURRICULUM field
     */
    const COL_ID_CURRICULUM = 'job_formacion_academica.ID_CURRICULUM';

    /**
     * the column name for the ID_TIPO_FORMACION field
     */
    const COL_ID_TIPO_FORMACION = 'job_formacion_academica.ID_TIPO_FORMACION';

    /**
     * the column name for the ID_PROFESION field
     */
    const COL_ID_PROFESION = 'job_formacion_academica.ID_PROFESION';

    /**
     * the column name for the ID_INSTITUCION field
     */
    const COL_ID_INSTITUCION = 'job_formacion_academica.ID_INSTITUCION';

    /**
     * the column name for the NOMBRE_INSTITUCION field
     */
    const COL_NOMBRE_INSTITUCION = 'job_formacion_academica.NOMBRE_INSTITUCION';

    /**
     * the column name for the NOMBRE_ESTUDIOS field
     */
    const COL_NOMBRE_ESTUDIOS = 'job_formacion_academica.NOMBRE_ESTUDIOS';

    /**
     * the column name for the NOMBRE_TITULO field
     */
    const COL_NOMBRE_TITULO = 'job_formacion_academica.NOMBRE_TITULO';

    /**
     * the column name for the FECHA_INICIO field
     */
    const COL_FECHA_INICIO = 'job_formacion_academica.FECHA_INICIO';

    /**
     * the column name for the FECHA_FIN field
     */
    const COL_FECHA_FIN = 'job_formacion_academica.FECHA_FIN';

    /**
     * the column name for the ESTUDIANTE field
     */
    const COL_ESTUDIANTE = 'job_formacion_academica.ESTUDIANTE';

    /**
     * the column name for the EGRESADO field
     */
    const COL_EGRESADO = 'job_formacion_academica.EGRESADO';

    /**
     * the column name for the TITULADO_ACADEMICO field
     */
    const COL_TITULADO_ACADEMICO = 'job_formacion_academica.TITULADO_ACADEMICO';

    /**
     * the column name for the TITULADO_CONVALIDADO field
     */
    const COL_TITULADO_CONVALIDADO = 'job_formacion_academica.TITULADO_CONVALIDADO';

    /**
     * the column name for the ANIOS_CURSADOS field
     */
    const COL_ANIOS_CURSADOS = 'job_formacion_academica.ANIOS_CURSADOS';

    /**
     * the column name for the DOCUMENTO_EGRESO field
     */
    const COL_DOCUMENTO_EGRESO = 'job_formacion_academica.DOCUMENTO_EGRESO';

    /**
     * the column name for the DOCUMENTO_ACADEMICO field
     */
    const COL_DOCUMENTO_ACADEMICO = 'job_formacion_academica.DOCUMENTO_ACADEMICO';

    /**
     * the column name for the DOCUMENTO_CONVALIDADO field
     */
    const COL_DOCUMENTO_CONVALIDADO = 'job_formacion_academica.DOCUMENTO_CONVALIDADO';

    /**
     * the column name for the FECHA_EGRESO field
     */
    const COL_FECHA_EGRESO = 'job_formacion_academica.FECHA_EGRESO';

    /**
     * the column name for the FECHA_TITULACION field
     */
    const COL_FECHA_TITULACION = 'job_formacion_academica.FECHA_TITULACION';

    /**
     * the column name for the VERIFICACIONES field
     */
    const COL_VERIFICACIONES = 'job_formacion_academica.VERIFICACIONES';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_formacion_academica.STATUS';

    /**
     * the column name for the LAST_USER_ID field
     */
    const COL_LAST_USER_ID = 'job_formacion_academica.LAST_USER_ID';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_formacion_academica.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_formacion_academica.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'IdCurriculum', 'IdTipoFormacion', 'IdProfesion', 'IdInstitucion', 'NombreInstitucion', 'NombreEstudios', 'NombreTitulo', 'FechaInicio', 'FechaFin', 'Estudiante', 'Egresado', 'TituladoAcademico', 'TituladoConvalidado', 'AniosCursados', 'DocumentoEgreso', 'DocumentoAcademico', 'DocumentoConvalidado', 'FechaEgreso', 'FechaTitulacion', 'Verificaciones', 'Status', 'LastUserId', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'idCurriculum', 'idTipoFormacion', 'idProfesion', 'idInstitucion', 'nombreInstitucion', 'nombreEstudios', 'nombreTitulo', 'fechaInicio', 'fechaFin', 'estudiante', 'egresado', 'tituladoAcademico', 'tituladoConvalidado', 'aniosCursados', 'documentoEgreso', 'documentoAcademico', 'documentoConvalidado', 'fechaEgreso', 'fechaTitulacion', 'verificaciones', 'status', 'lastUserId', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobFormacionAcademicaTableMap::COL_ID, JobFormacionAcademicaTableMap::COL_ID_CURRICULUM, JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION, JobFormacionAcademicaTableMap::COL_ID_PROFESION, JobFormacionAcademicaTableMap::COL_ID_INSTITUCION, JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION, JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS, JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO, JobFormacionAcademicaTableMap::COL_FECHA_INICIO, JobFormacionAcademicaTableMap::COL_FECHA_FIN, JobFormacionAcademicaTableMap::COL_ESTUDIANTE, JobFormacionAcademicaTableMap::COL_EGRESADO, JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO, JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO, JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS, JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO, JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO, JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO, JobFormacionAcademicaTableMap::COL_FECHA_EGRESO, JobFormacionAcademicaTableMap::COL_FECHA_TITULACION, JobFormacionAcademicaTableMap::COL_VERIFICACIONES, JobFormacionAcademicaTableMap::COL_STATUS, JobFormacionAcademicaTableMap::COL_LAST_USER_ID, JobFormacionAcademicaTableMap::COL_CREATION_DATE, JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'ID_CURRICULUM', 'ID_TIPO_FORMACION', 'ID_PROFESION', 'ID_INSTITUCION', 'NOMBRE_INSTITUCION', 'NOMBRE_ESTUDIOS', 'NOMBRE_TITULO', 'FECHA_INICIO', 'FECHA_FIN', 'ESTUDIANTE', 'EGRESADO', 'TITULADO_ACADEMICO', 'TITULADO_CONVALIDADO', 'ANIOS_CURSADOS', 'DOCUMENTO_EGRESO', 'DOCUMENTO_ACADEMICO', 'DOCUMENTO_CONVALIDADO', 'FECHA_EGRESO', 'FECHA_TITULACION', 'VERIFICACIONES', 'STATUS', 'LAST_USER_ID', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdCurriculum' => 1, 'IdTipoFormacion' => 2, 'IdProfesion' => 3, 'IdInstitucion' => 4, 'NombreInstitucion' => 5, 'NombreEstudios' => 6, 'NombreTitulo' => 7, 'FechaInicio' => 8, 'FechaFin' => 9, 'Estudiante' => 10, 'Egresado' => 11, 'TituladoAcademico' => 12, 'TituladoConvalidado' => 13, 'AniosCursados' => 14, 'DocumentoEgreso' => 15, 'DocumentoAcademico' => 16, 'DocumentoConvalidado' => 17, 'FechaEgreso' => 18, 'FechaTitulacion' => 19, 'Verificaciones' => 20, 'Status' => 21, 'LastUserId' => 22, 'CreationDate' => 23, 'ModificationDate' => 24, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idCurriculum' => 1, 'idTipoFormacion' => 2, 'idProfesion' => 3, 'idInstitucion' => 4, 'nombreInstitucion' => 5, 'nombreEstudios' => 6, 'nombreTitulo' => 7, 'fechaInicio' => 8, 'fechaFin' => 9, 'estudiante' => 10, 'egresado' => 11, 'tituladoAcademico' => 12, 'tituladoConvalidado' => 13, 'aniosCursados' => 14, 'documentoEgreso' => 15, 'documentoAcademico' => 16, 'documentoConvalidado' => 17, 'fechaEgreso' => 18, 'fechaTitulacion' => 19, 'verificaciones' => 20, 'status' => 21, 'lastUserId' => 22, 'creationDate' => 23, 'modificationDate' => 24, ),
        self::TYPE_COLNAME       => array(JobFormacionAcademicaTableMap::COL_ID => 0, JobFormacionAcademicaTableMap::COL_ID_CURRICULUM => 1, JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION => 2, JobFormacionAcademicaTableMap::COL_ID_PROFESION => 3, JobFormacionAcademicaTableMap::COL_ID_INSTITUCION => 4, JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION => 5, JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS => 6, JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO => 7, JobFormacionAcademicaTableMap::COL_FECHA_INICIO => 8, JobFormacionAcademicaTableMap::COL_FECHA_FIN => 9, JobFormacionAcademicaTableMap::COL_ESTUDIANTE => 10, JobFormacionAcademicaTableMap::COL_EGRESADO => 11, JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO => 12, JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO => 13, JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS => 14, JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO => 15, JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO => 16, JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO => 17, JobFormacionAcademicaTableMap::COL_FECHA_EGRESO => 18, JobFormacionAcademicaTableMap::COL_FECHA_TITULACION => 19, JobFormacionAcademicaTableMap::COL_VERIFICACIONES => 20, JobFormacionAcademicaTableMap::COL_STATUS => 21, JobFormacionAcademicaTableMap::COL_LAST_USER_ID => 22, JobFormacionAcademicaTableMap::COL_CREATION_DATE => 23, JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE => 24, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'ID_CURRICULUM' => 1, 'ID_TIPO_FORMACION' => 2, 'ID_PROFESION' => 3, 'ID_INSTITUCION' => 4, 'NOMBRE_INSTITUCION' => 5, 'NOMBRE_ESTUDIOS' => 6, 'NOMBRE_TITULO' => 7, 'FECHA_INICIO' => 8, 'FECHA_FIN' => 9, 'ESTUDIANTE' => 10, 'EGRESADO' => 11, 'TITULADO_ACADEMICO' => 12, 'TITULADO_CONVALIDADO' => 13, 'ANIOS_CURSADOS' => 14, 'DOCUMENTO_EGRESO' => 15, 'DOCUMENTO_ACADEMICO' => 16, 'DOCUMENTO_CONVALIDADO' => 17, 'FECHA_EGRESO' => 18, 'FECHA_TITULACION' => 19, 'VERIFICACIONES' => 20, 'STATUS' => 21, 'LAST_USER_ID' => 22, 'CREATION_DATE' => 23, 'MODIFICATION_DATE' => 24, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
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
        $this->setName('job_formacion_academica');
        $this->setPhpName('JobFormacionAcademica');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobFormacionAcademica');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ID_CURRICULUM', 'IdCurriculum', 'INTEGER', 'job_curriculum', 'ID', true, null, null);
        $this->addForeignKey('ID_TIPO_FORMACION', 'IdTipoFormacion', 'INTEGER', 'job_tipo_formacion', 'ID', true, null, null);
        $this->addForeignKey('ID_PROFESION', 'IdProfesion', 'INTEGER', 'job_profesion', 'ID', false, null, null);
        $this->addColumn('ID_INSTITUCION', 'IdInstitucion', 'INTEGER', true, null, null);
        $this->addColumn('NOMBRE_INSTITUCION', 'NombreInstitucion', 'VARCHAR', true, 200, null);
        $this->addColumn('NOMBRE_ESTUDIOS', 'NombreEstudios', 'VARCHAR', true, 200, null);
        $this->addColumn('NOMBRE_TITULO', 'NombreTitulo', 'VARCHAR', false, 200, null);
        $this->addColumn('FECHA_INICIO', 'FechaInicio', 'DATE', true, null, null);
        $this->addColumn('FECHA_FIN', 'FechaFin', 'DATE', true, null, null);
        $this->addColumn('ESTUDIANTE', 'Estudiante', 'BOOLEAN', true, 1, false);
        $this->addColumn('EGRESADO', 'Egresado', 'BOOLEAN', true, 1, false);
        $this->addColumn('TITULADO_ACADEMICO', 'TituladoAcademico', 'BOOLEAN', true, 1, false);
        $this->addColumn('TITULADO_CONVALIDADO', 'TituladoConvalidado', 'BOOLEAN', true, 1, false);
        $this->addColumn('ANIOS_CURSADOS', 'AniosCursados', 'VARCHAR', false, 20, null);
        $this->addColumn('DOCUMENTO_EGRESO', 'DocumentoEgreso', 'VARCHAR', false, 30, null);
        $this->addColumn('DOCUMENTO_ACADEMICO', 'DocumentoAcademico', 'VARCHAR', false, 30, null);
        $this->addColumn('DOCUMENTO_CONVALIDADO', 'DocumentoConvalidado', 'VARCHAR', false, 30, null);
        $this->addColumn('FECHA_EGRESO', 'FechaEgreso', 'DATE', false, null, null);
        $this->addColumn('FECHA_TITULACION', 'FechaTitulacion', 'DATE', false, null, null);
        $this->addColumn('VERIFICACIONES', 'Verificaciones', 'INTEGER', true, null, 0);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 20, 'ACTIVE');
        $this->addColumn('LAST_USER_ID', 'LastUserId', 'INTEGER', true, null, 0);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JobTipoFormacion', '\\JobTipoFormacion', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_TIPO_FORMACION',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('JobProfesion', '\\JobProfesion', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_PROFESION',
    1 => ':ID',
  ),
), null, null, null, false);
        $this->addRelation('JobCurriculum', '\\JobCurriculum', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ID_CURRICULUM',
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
        return $withPrefix ? JobFormacionAcademicaTableMap::CLASS_DEFAULT : JobFormacionAcademicaTableMap::OM_CLASS;
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
     * @return array           (JobFormacionAcademica object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobFormacionAcademicaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobFormacionAcademicaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobFormacionAcademicaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobFormacionAcademicaTableMap::OM_CLASS;
            /** @var JobFormacionAcademica $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobFormacionAcademicaTableMap::addInstanceToPool($obj, $key);
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
            $key = JobFormacionAcademicaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobFormacionAcademicaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobFormacionAcademica $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobFormacionAcademicaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_ID);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_ID_PROFESION);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_ID_INSTITUCION);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_FECHA_INICIO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_FECHA_FIN);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_ESTUDIANTE);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_EGRESADO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_FECHA_EGRESO);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_FECHA_TITULACION);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_VERIFICACIONES);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_LAST_USER_ID);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ID_CURRICULUM');
            $criteria->addSelectColumn($alias . '.ID_TIPO_FORMACION');
            $criteria->addSelectColumn($alias . '.ID_PROFESION');
            $criteria->addSelectColumn($alias . '.ID_INSTITUCION');
            $criteria->addSelectColumn($alias . '.NOMBRE_INSTITUCION');
            $criteria->addSelectColumn($alias . '.NOMBRE_ESTUDIOS');
            $criteria->addSelectColumn($alias . '.NOMBRE_TITULO');
            $criteria->addSelectColumn($alias . '.FECHA_INICIO');
            $criteria->addSelectColumn($alias . '.FECHA_FIN');
            $criteria->addSelectColumn($alias . '.ESTUDIANTE');
            $criteria->addSelectColumn($alias . '.EGRESADO');
            $criteria->addSelectColumn($alias . '.TITULADO_ACADEMICO');
            $criteria->addSelectColumn($alias . '.TITULADO_CONVALIDADO');
            $criteria->addSelectColumn($alias . '.ANIOS_CURSADOS');
            $criteria->addSelectColumn($alias . '.DOCUMENTO_EGRESO');
            $criteria->addSelectColumn($alias . '.DOCUMENTO_ACADEMICO');
            $criteria->addSelectColumn($alias . '.DOCUMENTO_CONVALIDADO');
            $criteria->addSelectColumn($alias . '.FECHA_EGRESO');
            $criteria->addSelectColumn($alias . '.FECHA_TITULACION');
            $criteria->addSelectColumn($alias . '.VERIFICACIONES');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobFormacionAcademicaTableMap::DATABASE_NAME)->getTable(JobFormacionAcademicaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobFormacionAcademicaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobFormacionAcademicaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobFormacionAcademicaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobFormacionAcademica or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobFormacionAcademica object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobFormacionAcademica) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobFormacionAcademicaTableMap::DATABASE_NAME);
            $criteria->add(JobFormacionAcademicaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobFormacionAcademicaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobFormacionAcademicaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobFormacionAcademicaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_formacion_academica table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobFormacionAcademicaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobFormacionAcademica or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobFormacionAcademica object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobFormacionAcademica object
        }

        if ($criteria->containsKey(JobFormacionAcademicaTableMap::COL_ID) && $criteria->keyContainsValue(JobFormacionAcademicaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobFormacionAcademicaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobFormacionAcademicaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobFormacionAcademicaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobFormacionAcademicaTableMap::buildTableMap();
