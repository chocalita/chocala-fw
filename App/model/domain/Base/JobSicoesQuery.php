<?php

namespace Base;

use \JobSicoes as ChildJobSicoes;
use \JobSicoesQuery as ChildJobSicoesQuery;
use \Exception;
use \PDO;
use Map\JobSicoesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_sicoes' table.
 *
 *
 *
 * @method     ChildJobSicoesQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobSicoesQuery orderByCuce($order = Criteria::ASC) Order by the CUCE column
 * @method     ChildJobSicoesQuery orderByCodigoSisin($order = Criteria::ASC) Order by the CODIGO_SISIN column
 * @method     ChildJobSicoesQuery orderByObjetoLicitacion($order = Criteria::ASC) Order by the OBJETO_LICITACION column
 * @method     ChildJobSicoesQuery orderByNombreEntidad($order = Criteria::ASC) Order by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoesQuery orderByCodigoEntidad($order = Criteria::ASC) Order by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoesQuery orderByTelefonoEntidad($order = Criteria::ASC) Order by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoesQuery orderByFechaPublicacion($order = Criteria::ASC) Order by the FECHA_PUBLICACION column
 * @method     ChildJobSicoesQuery orderByFechaLimite($order = Criteria::ASC) Order by the FECHA_LIMITE column
 * @method     ChildJobSicoesQuery orderByEstado($order = Criteria::ASC) Order by the ESTADO column
 * @method     ChildJobSicoesQuery orderByModalidad($order = Criteria::ASC) Order by the MODALIDAD column
 * @method     ChildJobSicoesQuery orderByTipoConsultoria($order = Criteria::ASC) Order by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoesQuery orderByFormaAdjudicacion($order = Criteria::ASC) Order by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoesQuery orderByTipoContratacion($order = Criteria::ASC) Order by the TIPO_CONTRATACION column
 * @method     ChildJobSicoesQuery orderByGarantiasSolicitadas($order = Criteria::ASC) Order by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoesQuery orderByTipoRequerimiento($order = Criteria::ASC) Order by the TIPO_REQUERIMIENTO column
 * @method     ChildJobSicoesQuery orderByNumeroConsultores($order = Criteria::ASC) Order by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoesQuery orderByPrecioUnitario($order = Criteria::ASC) Order by the PRECIO_UNITARIO column
 * @method     ChildJobSicoesQuery orderByEnlace($order = Criteria::ASC) Order by the ENLACE column
 * @method     ChildJobSicoesQuery orderByDepartamento($order = Criteria::ASC) Order by the DEPARTAMENTO column
 * @method     ChildJobSicoesQuery orderByContacto($order = Criteria::ASC) Order by the CONTACTO column
 * @method     ChildJobSicoesQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobSicoesQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobSicoesQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobSicoesQuery groupById() Group by the ID column
 * @method     ChildJobSicoesQuery groupByCuce() Group by the CUCE column
 * @method     ChildJobSicoesQuery groupByCodigoSisin() Group by the CODIGO_SISIN column
 * @method     ChildJobSicoesQuery groupByObjetoLicitacion() Group by the OBJETO_LICITACION column
 * @method     ChildJobSicoesQuery groupByNombreEntidad() Group by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoesQuery groupByCodigoEntidad() Group by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoesQuery groupByTelefonoEntidad() Group by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoesQuery groupByFechaPublicacion() Group by the FECHA_PUBLICACION column
 * @method     ChildJobSicoesQuery groupByFechaLimite() Group by the FECHA_LIMITE column
 * @method     ChildJobSicoesQuery groupByEstado() Group by the ESTADO column
 * @method     ChildJobSicoesQuery groupByModalidad() Group by the MODALIDAD column
 * @method     ChildJobSicoesQuery groupByTipoConsultoria() Group by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoesQuery groupByFormaAdjudicacion() Group by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoesQuery groupByTipoContratacion() Group by the TIPO_CONTRATACION column
 * @method     ChildJobSicoesQuery groupByGarantiasSolicitadas() Group by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoesQuery groupByTipoRequerimiento() Group by the TIPO_REQUERIMIENTO column
 * @method     ChildJobSicoesQuery groupByNumeroConsultores() Group by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoesQuery groupByPrecioUnitario() Group by the PRECIO_UNITARIO column
 * @method     ChildJobSicoesQuery groupByEnlace() Group by the ENLACE column
 * @method     ChildJobSicoesQuery groupByDepartamento() Group by the DEPARTAMENTO column
 * @method     ChildJobSicoesQuery groupByContacto() Group by the CONTACTO column
 * @method     ChildJobSicoesQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobSicoesQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobSicoesQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobSicoesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobSicoesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobSicoesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobSicoesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobSicoesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobSicoesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobSicoes findOne(ConnectionInterface $con = null) Return the first ChildJobSicoes matching the query
 * @method     ChildJobSicoes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobSicoes matching the query, or a new ChildJobSicoes object populated from the query conditions when no match is found
 *
 * @method     ChildJobSicoes findOneById(int $ID) Return the first ChildJobSicoes filtered by the ID column
 * @method     ChildJobSicoes findOneByCuce(string $CUCE) Return the first ChildJobSicoes filtered by the CUCE column
 * @method     ChildJobSicoes findOneByCodigoSisin(string $CODIGO_SISIN) Return the first ChildJobSicoes filtered by the CODIGO_SISIN column
 * @method     ChildJobSicoes findOneByObjetoLicitacion(string $OBJETO_LICITACION) Return the first ChildJobSicoes filtered by the OBJETO_LICITACION column
 * @method     ChildJobSicoes findOneByNombreEntidad(string $NOMBRE_ENTIDAD) Return the first ChildJobSicoes filtered by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoes findOneByCodigoEntidad(int $CODIGO_ENTIDAD) Return the first ChildJobSicoes filtered by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoes findOneByTelefonoEntidad(string $TELEFONO_ENTIDAD) Return the first ChildJobSicoes filtered by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoes findOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobSicoes filtered by the FECHA_PUBLICACION column
 * @method     ChildJobSicoes findOneByFechaLimite(string $FECHA_LIMITE) Return the first ChildJobSicoes filtered by the FECHA_LIMITE column
 * @method     ChildJobSicoes findOneByEstado(string $ESTADO) Return the first ChildJobSicoes filtered by the ESTADO column
 * @method     ChildJobSicoes findOneByModalidad(string $MODALIDAD) Return the first ChildJobSicoes filtered by the MODALIDAD column
 * @method     ChildJobSicoes findOneByTipoConsultoria(string $TIPO_CONSULTORIA) Return the first ChildJobSicoes filtered by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoes findOneByFormaAdjudicacion(string $FORMA_ADJUDICACION) Return the first ChildJobSicoes filtered by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoes findOneByTipoContratacion(string $TIPO_CONTRATACION) Return the first ChildJobSicoes filtered by the TIPO_CONTRATACION column
 * @method     ChildJobSicoes findOneByGarantiasSolicitadas(string $GARANTIAS_SOLICITADAS) Return the first ChildJobSicoes filtered by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoes findOneByTipoRequerimiento(string $TIPO_REQUERIMIENTO) Return the first ChildJobSicoes filtered by the TIPO_REQUERIMIENTO column
 * @method     ChildJobSicoes findOneByNumeroConsultores(int $NUMERO_CONSULTORES) Return the first ChildJobSicoes filtered by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoes findOneByPrecioUnitario(double $PRECIO_UNITARIO) Return the first ChildJobSicoes filtered by the PRECIO_UNITARIO column
 * @method     ChildJobSicoes findOneByEnlace(string $ENLACE) Return the first ChildJobSicoes filtered by the ENLACE column
 * @method     ChildJobSicoes findOneByDepartamento(string $DEPARTAMENTO) Return the first ChildJobSicoes filtered by the DEPARTAMENTO column
 * @method     ChildJobSicoes findOneByContacto(string $CONTACTO) Return the first ChildJobSicoes filtered by the CONTACTO column
 * @method     ChildJobSicoes findOneByStatus(string $STATUS) Return the first ChildJobSicoes filtered by the STATUS column
 * @method     ChildJobSicoes findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSicoes filtered by the CREATION_DATE column
 * @method     ChildJobSicoes findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSicoes filtered by the MODIFICATION_DATE column *

 * @method     ChildJobSicoes requirePk($key, ConnectionInterface $con = null) Return the ChildJobSicoes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOne(ConnectionInterface $con = null) Return the first ChildJobSicoes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSicoes requireOneById(int $ID) Return the first ChildJobSicoes filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByCuce(string $CUCE) Return the first ChildJobSicoes filtered by the CUCE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByCodigoSisin(string $CODIGO_SISIN) Return the first ChildJobSicoes filtered by the CODIGO_SISIN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByObjetoLicitacion(string $OBJETO_LICITACION) Return the first ChildJobSicoes filtered by the OBJETO_LICITACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByNombreEntidad(string $NOMBRE_ENTIDAD) Return the first ChildJobSicoes filtered by the NOMBRE_ENTIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByCodigoEntidad(int $CODIGO_ENTIDAD) Return the first ChildJobSicoes filtered by the CODIGO_ENTIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByTelefonoEntidad(string $TELEFONO_ENTIDAD) Return the first ChildJobSicoes filtered by the TELEFONO_ENTIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobSicoes filtered by the FECHA_PUBLICACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByFechaLimite(string $FECHA_LIMITE) Return the first ChildJobSicoes filtered by the FECHA_LIMITE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByEstado(string $ESTADO) Return the first ChildJobSicoes filtered by the ESTADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByModalidad(string $MODALIDAD) Return the first ChildJobSicoes filtered by the MODALIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByTipoConsultoria(string $TIPO_CONSULTORIA) Return the first ChildJobSicoes filtered by the TIPO_CONSULTORIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByFormaAdjudicacion(string $FORMA_ADJUDICACION) Return the first ChildJobSicoes filtered by the FORMA_ADJUDICACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByTipoContratacion(string $TIPO_CONTRATACION) Return the first ChildJobSicoes filtered by the TIPO_CONTRATACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByGarantiasSolicitadas(string $GARANTIAS_SOLICITADAS) Return the first ChildJobSicoes filtered by the GARANTIAS_SOLICITADAS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByTipoRequerimiento(string $TIPO_REQUERIMIENTO) Return the first ChildJobSicoes filtered by the TIPO_REQUERIMIENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByNumeroConsultores(int $NUMERO_CONSULTORES) Return the first ChildJobSicoes filtered by the NUMERO_CONSULTORES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByPrecioUnitario(double $PRECIO_UNITARIO) Return the first ChildJobSicoes filtered by the PRECIO_UNITARIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByEnlace(string $ENLACE) Return the first ChildJobSicoes filtered by the ENLACE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByDepartamento(string $DEPARTAMENTO) Return the first ChildJobSicoes filtered by the DEPARTAMENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByContacto(string $CONTACTO) Return the first ChildJobSicoes filtered by the CONTACTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByStatus(string $STATUS) Return the first ChildJobSicoes filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSicoes filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoes requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSicoes filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSicoes[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobSicoes objects based on current ModelCriteria
 * @method     ChildJobSicoes[]|ObjectCollection findById(int $ID) Return ChildJobSicoes objects filtered by the ID column
 * @method     ChildJobSicoes[]|ObjectCollection findByCuce(string $CUCE) Return ChildJobSicoes objects filtered by the CUCE column
 * @method     ChildJobSicoes[]|ObjectCollection findByCodigoSisin(string $CODIGO_SISIN) Return ChildJobSicoes objects filtered by the CODIGO_SISIN column
 * @method     ChildJobSicoes[]|ObjectCollection findByObjetoLicitacion(string $OBJETO_LICITACION) Return ChildJobSicoes objects filtered by the OBJETO_LICITACION column
 * @method     ChildJobSicoes[]|ObjectCollection findByNombreEntidad(string $NOMBRE_ENTIDAD) Return ChildJobSicoes objects filtered by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoes[]|ObjectCollection findByCodigoEntidad(int $CODIGO_ENTIDAD) Return ChildJobSicoes objects filtered by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoes[]|ObjectCollection findByTelefonoEntidad(string $TELEFONO_ENTIDAD) Return ChildJobSicoes objects filtered by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoes[]|ObjectCollection findByFechaPublicacion(string $FECHA_PUBLICACION) Return ChildJobSicoes objects filtered by the FECHA_PUBLICACION column
 * @method     ChildJobSicoes[]|ObjectCollection findByFechaLimite(string $FECHA_LIMITE) Return ChildJobSicoes objects filtered by the FECHA_LIMITE column
 * @method     ChildJobSicoes[]|ObjectCollection findByEstado(string $ESTADO) Return ChildJobSicoes objects filtered by the ESTADO column
 * @method     ChildJobSicoes[]|ObjectCollection findByModalidad(string $MODALIDAD) Return ChildJobSicoes objects filtered by the MODALIDAD column
 * @method     ChildJobSicoes[]|ObjectCollection findByTipoConsultoria(string $TIPO_CONSULTORIA) Return ChildJobSicoes objects filtered by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoes[]|ObjectCollection findByFormaAdjudicacion(string $FORMA_ADJUDICACION) Return ChildJobSicoes objects filtered by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoes[]|ObjectCollection findByTipoContratacion(string $TIPO_CONTRATACION) Return ChildJobSicoes objects filtered by the TIPO_CONTRATACION column
 * @method     ChildJobSicoes[]|ObjectCollection findByGarantiasSolicitadas(string $GARANTIAS_SOLICITADAS) Return ChildJobSicoes objects filtered by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoes[]|ObjectCollection findByTipoRequerimiento(string $TIPO_REQUERIMIENTO) Return ChildJobSicoes objects filtered by the TIPO_REQUERIMIENTO column
 * @method     ChildJobSicoes[]|ObjectCollection findByNumeroConsultores(int $NUMERO_CONSULTORES) Return ChildJobSicoes objects filtered by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoes[]|ObjectCollection findByPrecioUnitario(double $PRECIO_UNITARIO) Return ChildJobSicoes objects filtered by the PRECIO_UNITARIO column
 * @method     ChildJobSicoes[]|ObjectCollection findByEnlace(string $ENLACE) Return ChildJobSicoes objects filtered by the ENLACE column
 * @method     ChildJobSicoes[]|ObjectCollection findByDepartamento(string $DEPARTAMENTO) Return ChildJobSicoes objects filtered by the DEPARTAMENTO column
 * @method     ChildJobSicoes[]|ObjectCollection findByContacto(string $CONTACTO) Return ChildJobSicoes objects filtered by the CONTACTO column
 * @method     ChildJobSicoes[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobSicoes objects filtered by the STATUS column
 * @method     ChildJobSicoes[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobSicoes objects filtered by the CREATION_DATE column
 * @method     ChildJobSicoes[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobSicoes objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobSicoes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobSicoesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobSicoesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobSicoes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobSicoesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobSicoesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobSicoesQuery) {
            return $criteria;
        }
        $query = new ChildJobSicoesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildJobSicoes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobSicoesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobSicoesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobSicoes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, CUCE, CODIGO_SISIN, OBJETO_LICITACION, NOMBRE_ENTIDAD, CODIGO_ENTIDAD, TELEFONO_ENTIDAD, FECHA_PUBLICACION, FECHA_LIMITE, ESTADO, MODALIDAD, TIPO_CONSULTORIA, FORMA_ADJUDICACION, TIPO_CONTRATACION, GARANTIAS_SOLICITADAS, TIPO_REQUERIMIENTO, NUMERO_CONSULTORES, PRECIO_UNITARIO, ENLACE, DEPARTAMENTO, CONTACTO, STATUS, CREATION_DATE, MODIFICATION_DATE FROM job_sicoes WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildJobSicoes $obj */
            $obj = new ChildJobSicoes();
            $obj->hydrate($row);
            JobSicoesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildJobSicoes|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobSicoesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobSicoesTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the CUCE column
     *
     * Example usage:
     * <code>
     * $query->filterByCuce('fooValue');   // WHERE CUCE = 'fooValue'
     * $query->filterByCuce('%fooValue%', Criteria::LIKE); // WHERE CUCE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuce The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByCuce($cuce = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuce)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_CUCE, $cuce, $comparison);
    }

    /**
     * Filter the query on the CODIGO_SISIN column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoSisin('fooValue');   // WHERE CODIGO_SISIN = 'fooValue'
     * $query->filterByCodigoSisin('%fooValue%', Criteria::LIKE); // WHERE CODIGO_SISIN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigoSisin The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByCodigoSisin($codigoSisin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigoSisin)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_CODIGO_SISIN, $codigoSisin, $comparison);
    }

    /**
     * Filter the query on the OBJETO_LICITACION column
     *
     * Example usage:
     * <code>
     * $query->filterByObjetoLicitacion('fooValue');   // WHERE OBJETO_LICITACION = 'fooValue'
     * $query->filterByObjetoLicitacion('%fooValue%', Criteria::LIKE); // WHERE OBJETO_LICITACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $objetoLicitacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByObjetoLicitacion($objetoLicitacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($objetoLicitacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_OBJETO_LICITACION, $objetoLicitacion, $comparison);
    }

    /**
     * Filter the query on the NOMBRE_ENTIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreEntidad('fooValue');   // WHERE NOMBRE_ENTIDAD = 'fooValue'
     * $query->filterByNombreEntidad('%fooValue%', Criteria::LIKE); // WHERE NOMBRE_ENTIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreEntidad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByNombreEntidad($nombreEntidad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreEntidad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_NOMBRE_ENTIDAD, $nombreEntidad, $comparison);
    }

    /**
     * Filter the query on the CODIGO_ENTIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoEntidad(1234); // WHERE CODIGO_ENTIDAD = 1234
     * $query->filterByCodigoEntidad(array(12, 34)); // WHERE CODIGO_ENTIDAD IN (12, 34)
     * $query->filterByCodigoEntidad(array('min' => 12)); // WHERE CODIGO_ENTIDAD > 12
     * </code>
     *
     * @param     mixed $codigoEntidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByCodigoEntidad($codigoEntidad = null, $comparison = null)
    {
        if (is_array($codigoEntidad)) {
            $useMinMax = false;
            if (isset($codigoEntidad['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_CODIGO_ENTIDAD, $codigoEntidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoEntidad['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_CODIGO_ENTIDAD, $codigoEntidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_CODIGO_ENTIDAD, $codigoEntidad, $comparison);
    }

    /**
     * Filter the query on the TELEFONO_ENTIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonoEntidad('fooValue');   // WHERE TELEFONO_ENTIDAD = 'fooValue'
     * $query->filterByTelefonoEntidad('%fooValue%', Criteria::LIKE); // WHERE TELEFONO_ENTIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefonoEntidad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByTelefonoEntidad($telefonoEntidad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefonoEntidad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_TELEFONO_ENTIDAD, $telefonoEntidad, $comparison);
    }

    /**
     * Filter the query on the FECHA_PUBLICACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaPublicacion('2011-03-14'); // WHERE FECHA_PUBLICACION = '2011-03-14'
     * $query->filterByFechaPublicacion('now'); // WHERE FECHA_PUBLICACION = '2011-03-14'
     * $query->filterByFechaPublicacion(array('max' => 'yesterday')); // WHERE FECHA_PUBLICACION > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaPublicacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByFechaPublicacion($fechaPublicacion = null, $comparison = null)
    {
        if (is_array($fechaPublicacion)) {
            $useMinMax = false;
            if (isset($fechaPublicacion['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPublicacion['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion, $comparison);
    }

    /**
     * Filter the query on the FECHA_LIMITE column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaLimite('2011-03-14'); // WHERE FECHA_LIMITE = '2011-03-14'
     * $query->filterByFechaLimite('now'); // WHERE FECHA_LIMITE = '2011-03-14'
     * $query->filterByFechaLimite(array('max' => 'yesterday')); // WHERE FECHA_LIMITE > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaLimite The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByFechaLimite($fechaLimite = null, $comparison = null)
    {
        if (is_array($fechaLimite)) {
            $useMinMax = false;
            if (isset($fechaLimite['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_FECHA_LIMITE, $fechaLimite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaLimite['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_FECHA_LIMITE, $fechaLimite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_FECHA_LIMITE, $fechaLimite, $comparison);
    }

    /**
     * Filter the query on the ESTADO column
     *
     * Example usage:
     * <code>
     * $query->filterByEstado('fooValue');   // WHERE ESTADO = 'fooValue'
     * $query->filterByEstado('%fooValue%', Criteria::LIKE); // WHERE ESTADO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estado The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query on the MODALIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByModalidad('fooValue');   // WHERE MODALIDAD = 'fooValue'
     * $query->filterByModalidad('%fooValue%', Criteria::LIKE); // WHERE MODALIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modalidad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByModalidad($modalidad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modalidad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_MODALIDAD, $modalidad, $comparison);
    }

    /**
     * Filter the query on the TIPO_CONSULTORIA column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoConsultoria('fooValue');   // WHERE TIPO_CONSULTORIA = 'fooValue'
     * $query->filterByTipoConsultoria('%fooValue%', Criteria::LIKE); // WHERE TIPO_CONSULTORIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoConsultoria The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByTipoConsultoria($tipoConsultoria = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoConsultoria)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_TIPO_CONSULTORIA, $tipoConsultoria, $comparison);
    }

    /**
     * Filter the query on the FORMA_ADJUDICACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFormaAdjudicacion('fooValue');   // WHERE FORMA_ADJUDICACION = 'fooValue'
     * $query->filterByFormaAdjudicacion('%fooValue%', Criteria::LIKE); // WHERE FORMA_ADJUDICACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formaAdjudicacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByFormaAdjudicacion($formaAdjudicacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formaAdjudicacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_FORMA_ADJUDICACION, $formaAdjudicacion, $comparison);
    }

    /**
     * Filter the query on the TIPO_CONTRATACION column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoContratacion('fooValue');   // WHERE TIPO_CONTRATACION = 'fooValue'
     * $query->filterByTipoContratacion('%fooValue%', Criteria::LIKE); // WHERE TIPO_CONTRATACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoContratacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByTipoContratacion($tipoContratacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoContratacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_TIPO_CONTRATACION, $tipoContratacion, $comparison);
    }

    /**
     * Filter the query on the GARANTIAS_SOLICITADAS column
     *
     * Example usage:
     * <code>
     * $query->filterByGarantiasSolicitadas('fooValue');   // WHERE GARANTIAS_SOLICITADAS = 'fooValue'
     * $query->filterByGarantiasSolicitadas('%fooValue%', Criteria::LIKE); // WHERE GARANTIAS_SOLICITADAS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $garantiasSolicitadas The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByGarantiasSolicitadas($garantiasSolicitadas = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($garantiasSolicitadas)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_GARANTIAS_SOLICITADAS, $garantiasSolicitadas, $comparison);
    }

    /**
     * Filter the query on the TIPO_REQUERIMIENTO column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoRequerimiento('fooValue');   // WHERE TIPO_REQUERIMIENTO = 'fooValue'
     * $query->filterByTipoRequerimiento('%fooValue%', Criteria::LIKE); // WHERE TIPO_REQUERIMIENTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoRequerimiento The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByTipoRequerimiento($tipoRequerimiento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoRequerimiento)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_TIPO_REQUERIMIENTO, $tipoRequerimiento, $comparison);
    }

    /**
     * Filter the query on the NUMERO_CONSULTORES column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroConsultores(1234); // WHERE NUMERO_CONSULTORES = 1234
     * $query->filterByNumeroConsultores(array(12, 34)); // WHERE NUMERO_CONSULTORES IN (12, 34)
     * $query->filterByNumeroConsultores(array('min' => 12)); // WHERE NUMERO_CONSULTORES > 12
     * </code>
     *
     * @param     mixed $numeroConsultores The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByNumeroConsultores($numeroConsultores = null, $comparison = null)
    {
        if (is_array($numeroConsultores)) {
            $useMinMax = false;
            if (isset($numeroConsultores['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_NUMERO_CONSULTORES, $numeroConsultores['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numeroConsultores['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_NUMERO_CONSULTORES, $numeroConsultores['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_NUMERO_CONSULTORES, $numeroConsultores, $comparison);
    }

    /**
     * Filter the query on the PRECIO_UNITARIO column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecioUnitario(1234); // WHERE PRECIO_UNITARIO = 1234
     * $query->filterByPrecioUnitario(array(12, 34)); // WHERE PRECIO_UNITARIO IN (12, 34)
     * $query->filterByPrecioUnitario(array('min' => 12)); // WHERE PRECIO_UNITARIO > 12
     * </code>
     *
     * @param     mixed $precioUnitario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByPrecioUnitario($precioUnitario = null, $comparison = null)
    {
        if (is_array($precioUnitario)) {
            $useMinMax = false;
            if (isset($precioUnitario['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_PRECIO_UNITARIO, $precioUnitario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precioUnitario['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_PRECIO_UNITARIO, $precioUnitario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_PRECIO_UNITARIO, $precioUnitario, $comparison);
    }

    /**
     * Filter the query on the ENLACE column
     *
     * Example usage:
     * <code>
     * $query->filterByEnlace('fooValue');   // WHERE ENLACE = 'fooValue'
     * $query->filterByEnlace('%fooValue%', Criteria::LIKE); // WHERE ENLACE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $enlace The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByEnlace($enlace = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($enlace)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_ENLACE, $enlace, $comparison);
    }

    /**
     * Filter the query on the DEPARTAMENTO column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartamento('fooValue');   // WHERE DEPARTAMENTO = 'fooValue'
     * $query->filterByDepartamento('%fooValue%', Criteria::LIKE); // WHERE DEPARTAMENTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $departamento The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByDepartamento($departamento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($departamento)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_DEPARTAMENTO, $departamento, $comparison);
    }

    /**
     * Filter the query on the CONTACTO column
     *
     * Example usage:
     * <code>
     * $query->filterByContacto('fooValue');   // WHERE CONTACTO = 'fooValue'
     * $query->filterByContacto('%fooValue%', Criteria::LIKE); // WHERE CONTACTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contacto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByContacto($contacto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contacto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_CONTACTO, $contacto, $comparison);
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE STATUS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the CREATION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationDate('2011-03-14'); // WHERE CREATION_DATE = '2011-03-14'
     * $query->filterByCreationDate('now'); // WHERE CREATION_DATE = '2011-03-14'
     * $query->filterByCreationDate(array('max' => 'yesterday')); // WHERE CREATION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the MODIFICATION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByModificationDate('2011-03-14'); // WHERE MODIFICATION_DATE = '2011-03-14'
     * $query->filterByModificationDate('now'); // WHERE MODIFICATION_DATE = '2011-03-14'
     * $query->filterByModificationDate(array('max' => 'yesterday')); // WHERE MODIFICATION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $modificationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobSicoesTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobSicoes $jobSicoes Object to remove from the list of results
     *
     * @return $this|ChildJobSicoesQuery The current query, for fluid interface
     */
    public function prune($jobSicoes = null)
    {
        if ($jobSicoes) {
            $this->addUsingAlias(JobSicoesTableMap::COL_ID, $jobSicoes->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_sicoes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobSicoesTableMap::clearInstancePool();
            JobSicoesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobSicoesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobSicoesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobSicoesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobSicoesQuery
