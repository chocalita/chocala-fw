<?php

namespace Map;

use \JobSicoes;
use \JobSicoesQuery;
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
 * This class defines the structure of the 'job_sicoes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobSicoesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobSicoesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'job_sicoes';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\JobSicoes';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'JobSicoes';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 24;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 24;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'job_sicoes.ID';

    /**
     * the column name for the CUCE field
     */
    const COL_CUCE = 'job_sicoes.CUCE';

    /**
     * the column name for the CODIGO_SISIN field
     */
    const COL_CODIGO_SISIN = 'job_sicoes.CODIGO_SISIN';

    /**
     * the column name for the OBJETO_LICITACION field
     */
    const COL_OBJETO_LICITACION = 'job_sicoes.OBJETO_LICITACION';

    /**
     * the column name for the NOMBRE_ENTIDAD field
     */
    const COL_NOMBRE_ENTIDAD = 'job_sicoes.NOMBRE_ENTIDAD';

    /**
     * the column name for the CODIGO_ENTIDAD field
     */
    const COL_CODIGO_ENTIDAD = 'job_sicoes.CODIGO_ENTIDAD';

    /**
     * the column name for the TELEFONO_ENTIDAD field
     */
    const COL_TELEFONO_ENTIDAD = 'job_sicoes.TELEFONO_ENTIDAD';

    /**
     * the column name for the FECHA_PUBLICACION field
     */
    const COL_FECHA_PUBLICACION = 'job_sicoes.FECHA_PUBLICACION';

    /**
     * the column name for the FECHA_LIMITE field
     */
    const COL_FECHA_LIMITE = 'job_sicoes.FECHA_LIMITE';

    /**
     * the column name for the ESTADO field
     */
    const COL_ESTADO = 'job_sicoes.ESTADO';

    /**
     * the column name for the MODALIDAD field
     */
    const COL_MODALIDAD = 'job_sicoes.MODALIDAD';

    /**
     * the column name for the TIPO_CONSULTORIA field
     */
    const COL_TIPO_CONSULTORIA = 'job_sicoes.TIPO_CONSULTORIA';

    /**
     * the column name for the FORMA_ADJUDICACION field
     */
    const COL_FORMA_ADJUDICACION = 'job_sicoes.FORMA_ADJUDICACION';

    /**
     * the column name for the TIPO_CONTRATACION field
     */
    const COL_TIPO_CONTRATACION = 'job_sicoes.TIPO_CONTRATACION';

    /**
     * the column name for the GARANTIAS_SOLICITADAS field
     */
    const COL_GARANTIAS_SOLICITADAS = 'job_sicoes.GARANTIAS_SOLICITADAS';

    /**
     * the column name for the TIPO_REQUERIMIENTO field
     */
    const COL_TIPO_REQUERIMIENTO = 'job_sicoes.TIPO_REQUERIMIENTO';

    /**
     * the column name for the NUMERO_CONSULTORES field
     */
    const COL_NUMERO_CONSULTORES = 'job_sicoes.NUMERO_CONSULTORES';

    /**
     * the column name for the PRECIO_UNITARIO field
     */
    const COL_PRECIO_UNITARIO = 'job_sicoes.PRECIO_UNITARIO';

    /**
     * the column name for the ENLACE field
     */
    const COL_ENLACE = 'job_sicoes.ENLACE';

    /**
     * the column name for the DEPARTAMENTO field
     */
    const COL_DEPARTAMENTO = 'job_sicoes.DEPARTAMENTO';

    /**
     * the column name for the CONTACTO field
     */
    const COL_CONTACTO = 'job_sicoes.CONTACTO';

    /**
     * the column name for the STATUS field
     */
    const COL_STATUS = 'job_sicoes.STATUS';

    /**
     * the column name for the CREATION_DATE field
     */
    const COL_CREATION_DATE = 'job_sicoes.CREATION_DATE';

    /**
     * the column name for the MODIFICATION_DATE field
     */
    const COL_MODIFICATION_DATE = 'job_sicoes.MODIFICATION_DATE';

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
        self::TYPE_PHPNAME       => array('Id', 'Cuce', 'CodigoSisin', 'ObjetoLicitacion', 'NombreEntidad', 'CodigoEntidad', 'TelefonoEntidad', 'FechaPublicacion', 'FechaLimite', 'Estado', 'Modalidad', 'TipoConsultoria', 'FormaAdjudicacion', 'TipoContratacion', 'GarantiasSolicitadas', 'TipoRequerimiento', 'NumeroConsultores', 'PrecioUnitario', 'Enlace', 'Departamento', 'Contacto', 'Status', 'CreationDate', 'ModificationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'cuce', 'codigoSisin', 'objetoLicitacion', 'nombreEntidad', 'codigoEntidad', 'telefonoEntidad', 'fechaPublicacion', 'fechaLimite', 'estado', 'modalidad', 'tipoConsultoria', 'formaAdjudicacion', 'tipoContratacion', 'garantiasSolicitadas', 'tipoRequerimiento', 'numeroConsultores', 'precioUnitario', 'enlace', 'departamento', 'contacto', 'status', 'creationDate', 'modificationDate', ),
        self::TYPE_COLNAME       => array(JobSicoesTableMap::COL_ID, JobSicoesTableMap::COL_CUCE, JobSicoesTableMap::COL_CODIGO_SISIN, JobSicoesTableMap::COL_OBJETO_LICITACION, JobSicoesTableMap::COL_NOMBRE_ENTIDAD, JobSicoesTableMap::COL_CODIGO_ENTIDAD, JobSicoesTableMap::COL_TELEFONO_ENTIDAD, JobSicoesTableMap::COL_FECHA_PUBLICACION, JobSicoesTableMap::COL_FECHA_LIMITE, JobSicoesTableMap::COL_ESTADO, JobSicoesTableMap::COL_MODALIDAD, JobSicoesTableMap::COL_TIPO_CONSULTORIA, JobSicoesTableMap::COL_FORMA_ADJUDICACION, JobSicoesTableMap::COL_TIPO_CONTRATACION, JobSicoesTableMap::COL_GARANTIAS_SOLICITADAS, JobSicoesTableMap::COL_TIPO_REQUERIMIENTO, JobSicoesTableMap::COL_NUMERO_CONSULTORES, JobSicoesTableMap::COL_PRECIO_UNITARIO, JobSicoesTableMap::COL_ENLACE, JobSicoesTableMap::COL_DEPARTAMENTO, JobSicoesTableMap::COL_CONTACTO, JobSicoesTableMap::COL_STATUS, JobSicoesTableMap::COL_CREATION_DATE, JobSicoesTableMap::COL_MODIFICATION_DATE, ),
        self::TYPE_FIELDNAME     => array('ID', 'CUCE', 'CODIGO_SISIN', 'OBJETO_LICITACION', 'NOMBRE_ENTIDAD', 'CODIGO_ENTIDAD', 'TELEFONO_ENTIDAD', 'FECHA_PUBLICACION', 'FECHA_LIMITE', 'ESTADO', 'MODALIDAD', 'TIPO_CONSULTORIA', 'FORMA_ADJUDICACION', 'TIPO_CONTRATACION', 'GARANTIAS_SOLICITADAS', 'TIPO_REQUERIMIENTO', 'NUMERO_CONSULTORES', 'PRECIO_UNITARIO', 'ENLACE', 'DEPARTAMENTO', 'CONTACTO', 'STATUS', 'CREATION_DATE', 'MODIFICATION_DATE', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Cuce' => 1, 'CodigoSisin' => 2, 'ObjetoLicitacion' => 3, 'NombreEntidad' => 4, 'CodigoEntidad' => 5, 'TelefonoEntidad' => 6, 'FechaPublicacion' => 7, 'FechaLimite' => 8, 'Estado' => 9, 'Modalidad' => 10, 'TipoConsultoria' => 11, 'FormaAdjudicacion' => 12, 'TipoContratacion' => 13, 'GarantiasSolicitadas' => 14, 'TipoRequerimiento' => 15, 'NumeroConsultores' => 16, 'PrecioUnitario' => 17, 'Enlace' => 18, 'Departamento' => 19, 'Contacto' => 20, 'Status' => 21, 'CreationDate' => 22, 'ModificationDate' => 23, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'cuce' => 1, 'codigoSisin' => 2, 'objetoLicitacion' => 3, 'nombreEntidad' => 4, 'codigoEntidad' => 5, 'telefonoEntidad' => 6, 'fechaPublicacion' => 7, 'fechaLimite' => 8, 'estado' => 9, 'modalidad' => 10, 'tipoConsultoria' => 11, 'formaAdjudicacion' => 12, 'tipoContratacion' => 13, 'garantiasSolicitadas' => 14, 'tipoRequerimiento' => 15, 'numeroConsultores' => 16, 'precioUnitario' => 17, 'enlace' => 18, 'departamento' => 19, 'contacto' => 20, 'status' => 21, 'creationDate' => 22, 'modificationDate' => 23, ),
        self::TYPE_COLNAME       => array(JobSicoesTableMap::COL_ID => 0, JobSicoesTableMap::COL_CUCE => 1, JobSicoesTableMap::COL_CODIGO_SISIN => 2, JobSicoesTableMap::COL_OBJETO_LICITACION => 3, JobSicoesTableMap::COL_NOMBRE_ENTIDAD => 4, JobSicoesTableMap::COL_CODIGO_ENTIDAD => 5, JobSicoesTableMap::COL_TELEFONO_ENTIDAD => 6, JobSicoesTableMap::COL_FECHA_PUBLICACION => 7, JobSicoesTableMap::COL_FECHA_LIMITE => 8, JobSicoesTableMap::COL_ESTADO => 9, JobSicoesTableMap::COL_MODALIDAD => 10, JobSicoesTableMap::COL_TIPO_CONSULTORIA => 11, JobSicoesTableMap::COL_FORMA_ADJUDICACION => 12, JobSicoesTableMap::COL_TIPO_CONTRATACION => 13, JobSicoesTableMap::COL_GARANTIAS_SOLICITADAS => 14, JobSicoesTableMap::COL_TIPO_REQUERIMIENTO => 15, JobSicoesTableMap::COL_NUMERO_CONSULTORES => 16, JobSicoesTableMap::COL_PRECIO_UNITARIO => 17, JobSicoesTableMap::COL_ENLACE => 18, JobSicoesTableMap::COL_DEPARTAMENTO => 19, JobSicoesTableMap::COL_CONTACTO => 20, JobSicoesTableMap::COL_STATUS => 21, JobSicoesTableMap::COL_CREATION_DATE => 22, JobSicoesTableMap::COL_MODIFICATION_DATE => 23, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'CUCE' => 1, 'CODIGO_SISIN' => 2, 'OBJETO_LICITACION' => 3, 'NOMBRE_ENTIDAD' => 4, 'CODIGO_ENTIDAD' => 5, 'TELEFONO_ENTIDAD' => 6, 'FECHA_PUBLICACION' => 7, 'FECHA_LIMITE' => 8, 'ESTADO' => 9, 'MODALIDAD' => 10, 'TIPO_CONSULTORIA' => 11, 'FORMA_ADJUDICACION' => 12, 'TIPO_CONTRATACION' => 13, 'GARANTIAS_SOLICITADAS' => 14, 'TIPO_REQUERIMIENTO' => 15, 'NUMERO_CONSULTORES' => 16, 'PRECIO_UNITARIO' => 17, 'ENLACE' => 18, 'DEPARTAMENTO' => 19, 'CONTACTO' => 20, 'STATUS' => 21, 'CREATION_DATE' => 22, 'MODIFICATION_DATE' => 23, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
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
        $this->setName('job_sicoes');
        $this->setPhpName('JobSicoes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\JobSicoes');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('CUCE', 'Cuce', 'VARCHAR', true, 100, null);
        $this->addColumn('CODIGO_SISIN', 'CodigoSisin', 'VARCHAR', false, 100, null);
        $this->addColumn('OBJETO_LICITACION', 'ObjetoLicitacion', 'VARCHAR', true, 5000, null);
        $this->addColumn('NOMBRE_ENTIDAD', 'NombreEntidad', 'VARCHAR', true, 2000, null);
        $this->addColumn('CODIGO_ENTIDAD', 'CodigoEntidad', 'INTEGER', true, 100, null);
        $this->addColumn('TELEFONO_ENTIDAD', 'TelefonoEntidad', 'VARCHAR', true, 100, null);
        $this->addColumn('FECHA_PUBLICACION', 'FechaPublicacion', 'DATE', true, null, null);
        $this->addColumn('FECHA_LIMITE', 'FechaLimite', 'DATE', true, null, null);
        $this->addColumn('ESTADO', 'Estado', 'VARCHAR', true, 10, null);
        $this->addColumn('MODALIDAD', 'Modalidad', 'VARCHAR', true, 200, null);
        $this->addColumn('TIPO_CONSULTORIA', 'TipoConsultoria', 'VARCHAR', true, 200, null);
        $this->addColumn('FORMA_ADJUDICACION', 'FormaAdjudicacion', 'VARCHAR', true, 200, null);
        $this->addColumn('TIPO_CONTRATACION', 'TipoContratacion', 'VARCHAR', true, 200, null);
        $this->addColumn('GARANTIAS_SOLICITADAS', 'GarantiasSolicitadas', 'VARCHAR', true, 2000, null);
        $this->addColumn('TIPO_REQUERIMIENTO', 'TipoRequerimiento', 'VARCHAR', true, 200, null);
        $this->addColumn('NUMERO_CONSULTORES', 'NumeroConsultores', 'INTEGER', true, null, null);
        $this->addColumn('PRECIO_UNITARIO', 'PrecioUnitario', 'FLOAT', true, 9, null);
        $this->addColumn('ENLACE', 'Enlace', 'VARCHAR', true, 5000, null);
        $this->addColumn('DEPARTAMENTO', 'Departamento', 'VARCHAR', true, 50, null);
        $this->addColumn('CONTACTO', 'Contacto', 'VARCHAR', true, 500, null);
        $this->addColumn('STATUS', 'Status', 'VARCHAR', true, 30, null);
        $this->addColumn('CREATION_DATE', 'CreationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('MODIFICATION_DATE', 'ModificationDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
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
        return $withPrefix ? JobSicoesTableMap::CLASS_DEFAULT : JobSicoesTableMap::OM_CLASS;
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
     * @return array           (JobSicoes object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobSicoesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobSicoesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobSicoesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobSicoesTableMap::OM_CLASS;
            /** @var JobSicoes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobSicoesTableMap::addInstanceToPool($obj, $key);
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
            $key = JobSicoesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobSicoesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var JobSicoes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobSicoesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobSicoesTableMap::COL_ID);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_CUCE);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_CODIGO_SISIN);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_OBJETO_LICITACION);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_NOMBRE_ENTIDAD);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_CODIGO_ENTIDAD);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_TELEFONO_ENTIDAD);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_FECHA_PUBLICACION);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_FECHA_LIMITE);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_ESTADO);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_MODALIDAD);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_TIPO_CONSULTORIA);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_FORMA_ADJUDICACION);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_TIPO_CONTRATACION);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_GARANTIAS_SOLICITADAS);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_TIPO_REQUERIMIENTO);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_NUMERO_CONSULTORES);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_PRECIO_UNITARIO);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_ENLACE);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_DEPARTAMENTO);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_CONTACTO);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_STATUS);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(JobSicoesTableMap::COL_MODIFICATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.CUCE');
            $criteria->addSelectColumn($alias . '.CODIGO_SISIN');
            $criteria->addSelectColumn($alias . '.OBJETO_LICITACION');
            $criteria->addSelectColumn($alias . '.NOMBRE_ENTIDAD');
            $criteria->addSelectColumn($alias . '.CODIGO_ENTIDAD');
            $criteria->addSelectColumn($alias . '.TELEFONO_ENTIDAD');
            $criteria->addSelectColumn($alias . '.FECHA_PUBLICACION');
            $criteria->addSelectColumn($alias . '.FECHA_LIMITE');
            $criteria->addSelectColumn($alias . '.ESTADO');
            $criteria->addSelectColumn($alias . '.MODALIDAD');
            $criteria->addSelectColumn($alias . '.TIPO_CONSULTORIA');
            $criteria->addSelectColumn($alias . '.FORMA_ADJUDICACION');
            $criteria->addSelectColumn($alias . '.TIPO_CONTRATACION');
            $criteria->addSelectColumn($alias . '.GARANTIAS_SOLICITADAS');
            $criteria->addSelectColumn($alias . '.TIPO_REQUERIMIENTO');
            $criteria->addSelectColumn($alias . '.NUMERO_CONSULTORES');
            $criteria->addSelectColumn($alias . '.PRECIO_UNITARIO');
            $criteria->addSelectColumn($alias . '.ENLACE');
            $criteria->addSelectColumn($alias . '.DEPARTAMENTO');
            $criteria->addSelectColumn($alias . '.CONTACTO');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobSicoesTableMap::DATABASE_NAME)->getTable(JobSicoesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobSicoesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobSicoesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobSicoesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a JobSicoes or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or JobSicoes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \JobSicoes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobSicoesTableMap::DATABASE_NAME);
            $criteria->add(JobSicoesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobSicoesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobSicoesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobSicoesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the job_sicoes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobSicoesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a JobSicoes or Criteria object.
     *
     * @param mixed               $criteria Criteria or JobSicoes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from JobSicoes object
        }

        if ($criteria->containsKey(JobSicoesTableMap::COL_ID) && $criteria->keyContainsValue(JobSicoesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobSicoesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobSicoesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobSicoesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobSicoesTableMap::buildTableMap();
