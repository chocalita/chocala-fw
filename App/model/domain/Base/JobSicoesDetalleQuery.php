<?php

namespace Base;

use \JobSicoesDetalle as ChildJobSicoesDetalle;
use \JobSicoesDetalleQuery as ChildJobSicoesDetalleQuery;
use \Exception;
use \PDO;
use Map\JobSicoesDetalleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_sicoes_detalle' table.
 *
 *
 *
 * @method     ChildJobSicoesDetalleQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobSicoesDetalleQuery orderByIdSicoesConvocatoria($order = Criteria::ASC) Order by the ID_SICOES_CONVOCATORIA column
 * @method     ChildJobSicoesDetalleQuery orderByNumero($order = Criteria::ASC) Order by the NUMERO column
 * @method     ChildJobSicoesDetalleQuery orderByDescripcion($order = Criteria::ASC) Order by the DESCRIPCION column
 * @method     ChildJobSicoesDetalleQuery orderByUnidadMedida($order = Criteria::ASC) Order by the UNIDAD_MEDIDA column
 * @method     ChildJobSicoesDetalleQuery orderByCantidad($order = Criteria::ASC) Order by the CANTIDAD column
 * @method     ChildJobSicoesDetalleQuery orderByPrecioUnidad($order = Criteria::ASC) Order by the PRECIO_UNIDAD column
 * @method     ChildJobSicoesDetalleQuery orderByCodigoCatalogo($order = Criteria::ASC) Order by the CODIGO_CATALOGO column
 * @method     ChildJobSicoesDetalleQuery orderByObjetoGasto($order = Criteria::ASC) Order by the OBJETO_GASTO column
 * @method     ChildJobSicoesDetalleQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobSicoesDetalleQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobSicoesDetalleQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobSicoesDetalleQuery groupById() Group by the ID column
 * @method     ChildJobSicoesDetalleQuery groupByIdSicoesConvocatoria() Group by the ID_SICOES_CONVOCATORIA column
 * @method     ChildJobSicoesDetalleQuery groupByNumero() Group by the NUMERO column
 * @method     ChildJobSicoesDetalleQuery groupByDescripcion() Group by the DESCRIPCION column
 * @method     ChildJobSicoesDetalleQuery groupByUnidadMedida() Group by the UNIDAD_MEDIDA column
 * @method     ChildJobSicoesDetalleQuery groupByCantidad() Group by the CANTIDAD column
 * @method     ChildJobSicoesDetalleQuery groupByPrecioUnidad() Group by the PRECIO_UNIDAD column
 * @method     ChildJobSicoesDetalleQuery groupByCodigoCatalogo() Group by the CODIGO_CATALOGO column
 * @method     ChildJobSicoesDetalleQuery groupByObjetoGasto() Group by the OBJETO_GASTO column
 * @method     ChildJobSicoesDetalleQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobSicoesDetalleQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobSicoesDetalleQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobSicoesDetalleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobSicoesDetalleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobSicoesDetalleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobSicoesDetalleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobSicoesDetalleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobSicoesDetalleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobSicoesDetalleQuery leftJoinJobSicoesConvocatoria($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobSicoesConvocatoria relation
 * @method     ChildJobSicoesDetalleQuery rightJoinJobSicoesConvocatoria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobSicoesConvocatoria relation
 * @method     ChildJobSicoesDetalleQuery innerJoinJobSicoesConvocatoria($relationAlias = null) Adds a INNER JOIN clause to the query using the JobSicoesConvocatoria relation
 *
 * @method     ChildJobSicoesDetalleQuery joinWithJobSicoesConvocatoria($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobSicoesConvocatoria relation
 *
 * @method     ChildJobSicoesDetalleQuery leftJoinWithJobSicoesConvocatoria() Adds a LEFT JOIN clause and with to the query using the JobSicoesConvocatoria relation
 * @method     ChildJobSicoesDetalleQuery rightJoinWithJobSicoesConvocatoria() Adds a RIGHT JOIN clause and with to the query using the JobSicoesConvocatoria relation
 * @method     ChildJobSicoesDetalleQuery innerJoinWithJobSicoesConvocatoria() Adds a INNER JOIN clause and with to the query using the JobSicoesConvocatoria relation
 *
 * @method     \JobSicoesConvocatoriaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobSicoesDetalle findOne(ConnectionInterface $con = null) Return the first ChildJobSicoesDetalle matching the query
 * @method     ChildJobSicoesDetalle findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobSicoesDetalle matching the query, or a new ChildJobSicoesDetalle object populated from the query conditions when no match is found
 *
 * @method     ChildJobSicoesDetalle findOneById(int $ID) Return the first ChildJobSicoesDetalle filtered by the ID column
 * @method     ChildJobSicoesDetalle findOneByIdSicoesConvocatoria(int $ID_SICOES_CONVOCATORIA) Return the first ChildJobSicoesDetalle filtered by the ID_SICOES_CONVOCATORIA column
 * @method     ChildJobSicoesDetalle findOneByNumero(int $NUMERO) Return the first ChildJobSicoesDetalle filtered by the NUMERO column
 * @method     ChildJobSicoesDetalle findOneByDescripcion(string $DESCRIPCION) Return the first ChildJobSicoesDetalle filtered by the DESCRIPCION column
 * @method     ChildJobSicoesDetalle findOneByUnidadMedida(string $UNIDAD_MEDIDA) Return the first ChildJobSicoesDetalle filtered by the UNIDAD_MEDIDA column
 * @method     ChildJobSicoesDetalle findOneByCantidad(int $CANTIDAD) Return the first ChildJobSicoesDetalle filtered by the CANTIDAD column
 * @method     ChildJobSicoesDetalle findOneByPrecioUnidad(double $PRECIO_UNIDAD) Return the first ChildJobSicoesDetalle filtered by the PRECIO_UNIDAD column
 * @method     ChildJobSicoesDetalle findOneByCodigoCatalogo(string $CODIGO_CATALOGO) Return the first ChildJobSicoesDetalle filtered by the CODIGO_CATALOGO column
 * @method     ChildJobSicoesDetalle findOneByObjetoGasto(string $OBJETO_GASTO) Return the first ChildJobSicoesDetalle filtered by the OBJETO_GASTO column
 * @method     ChildJobSicoesDetalle findOneByStatus(string $STATUS) Return the first ChildJobSicoesDetalle filtered by the STATUS column
 * @method     ChildJobSicoesDetalle findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSicoesDetalle filtered by the CREATION_DATE column
 * @method     ChildJobSicoesDetalle findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSicoesDetalle filtered by the MODIFICATION_DATE column *

 * @method     ChildJobSicoesDetalle requirePk($key, ConnectionInterface $con = null) Return the ChildJobSicoesDetalle by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOne(ConnectionInterface $con = null) Return the first ChildJobSicoesDetalle matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSicoesDetalle requireOneById(int $ID) Return the first ChildJobSicoesDetalle filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByIdSicoesConvocatoria(int $ID_SICOES_CONVOCATORIA) Return the first ChildJobSicoesDetalle filtered by the ID_SICOES_CONVOCATORIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByNumero(int $NUMERO) Return the first ChildJobSicoesDetalle filtered by the NUMERO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByDescripcion(string $DESCRIPCION) Return the first ChildJobSicoesDetalle filtered by the DESCRIPCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByUnidadMedida(string $UNIDAD_MEDIDA) Return the first ChildJobSicoesDetalle filtered by the UNIDAD_MEDIDA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByCantidad(int $CANTIDAD) Return the first ChildJobSicoesDetalle filtered by the CANTIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByPrecioUnidad(double $PRECIO_UNIDAD) Return the first ChildJobSicoesDetalle filtered by the PRECIO_UNIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByCodigoCatalogo(string $CODIGO_CATALOGO) Return the first ChildJobSicoesDetalle filtered by the CODIGO_CATALOGO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByObjetoGasto(string $OBJETO_GASTO) Return the first ChildJobSicoesDetalle filtered by the OBJETO_GASTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByStatus(string $STATUS) Return the first ChildJobSicoesDetalle filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSicoesDetalle filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesDetalle requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSicoesDetalle filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSicoesDetalle[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobSicoesDetalle objects based on current ModelCriteria
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findById(int $ID) Return ChildJobSicoesDetalle objects filtered by the ID column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByIdSicoesConvocatoria(int $ID_SICOES_CONVOCATORIA) Return ChildJobSicoesDetalle objects filtered by the ID_SICOES_CONVOCATORIA column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByNumero(int $NUMERO) Return ChildJobSicoesDetalle objects filtered by the NUMERO column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByDescripcion(string $DESCRIPCION) Return ChildJobSicoesDetalle objects filtered by the DESCRIPCION column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByUnidadMedida(string $UNIDAD_MEDIDA) Return ChildJobSicoesDetalle objects filtered by the UNIDAD_MEDIDA column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByCantidad(int $CANTIDAD) Return ChildJobSicoesDetalle objects filtered by the CANTIDAD column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByPrecioUnidad(double $PRECIO_UNIDAD) Return ChildJobSicoesDetalle objects filtered by the PRECIO_UNIDAD column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByCodigoCatalogo(string $CODIGO_CATALOGO) Return ChildJobSicoesDetalle objects filtered by the CODIGO_CATALOGO column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByObjetoGasto(string $OBJETO_GASTO) Return ChildJobSicoesDetalle objects filtered by the OBJETO_GASTO column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobSicoesDetalle objects filtered by the STATUS column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobSicoesDetalle objects filtered by the CREATION_DATE column
 * @method     ChildJobSicoesDetalle[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobSicoesDetalle objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobSicoesDetalle[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobSicoesDetalleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobSicoesDetalleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobSicoesDetalle', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobSicoesDetalleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobSicoesDetalleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobSicoesDetalleQuery) {
            return $criteria;
        }
        $query = new ChildJobSicoesDetalleQuery();
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
     * @return ChildJobSicoesDetalle|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobSicoesDetalleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobSicoesDetalleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJobSicoesDetalle A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_SICOES_CONVOCATORIA, NUMERO, DESCRIPCION, UNIDAD_MEDIDA, CANTIDAD, PRECIO_UNIDAD, CODIGO_CATALOGO, OBJETO_GASTO, STATUS, CREATION_DATE, MODIFICATION_DATE FROM job_sicoes_detalle WHERE ID = :p0';
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
            /** @var ChildJobSicoesDetalle $obj */
            $obj = new ChildJobSicoesDetalle();
            $obj->hydrate($row);
            JobSicoesDetalleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobSicoesDetalle|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_SICOES_CONVOCATORIA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSicoesConvocatoria(1234); // WHERE ID_SICOES_CONVOCATORIA = 1234
     * $query->filterByIdSicoesConvocatoria(array(12, 34)); // WHERE ID_SICOES_CONVOCATORIA IN (12, 34)
     * $query->filterByIdSicoesConvocatoria(array('min' => 12)); // WHERE ID_SICOES_CONVOCATORIA > 12
     * </code>
     *
     * @see       filterByJobSicoesConvocatoria()
     *
     * @param     mixed $idSicoesConvocatoria The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByIdSicoesConvocatoria($idSicoesConvocatoria = null, $comparison = null)
    {
        if (is_array($idSicoesConvocatoria)) {
            $useMinMax = false;
            if (isset($idSicoesConvocatoria['min'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA, $idSicoesConvocatoria['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSicoesConvocatoria['max'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA, $idSicoesConvocatoria['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA, $idSicoesConvocatoria, $comparison);
    }

    /**
     * Filter the query on the NUMERO column
     *
     * Example usage:
     * <code>
     * $query->filterByNumero(1234); // WHERE NUMERO = 1234
     * $query->filterByNumero(array(12, 34)); // WHERE NUMERO IN (12, 34)
     * $query->filterByNumero(array('min' => 12)); // WHERE NUMERO > 12
     * </code>
     *
     * @param     mixed $numero The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByNumero($numero = null, $comparison = null)
    {
        if (is_array($numero)) {
            $useMinMax = false;
            if (isset($numero['min'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_NUMERO, $numero['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numero['max'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_NUMERO, $numero['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_NUMERO, $numero, $comparison);
    }

    /**
     * Filter the query on the DESCRIPCION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE DESCRIPCION = 'fooValue'
     * $query->filterByDescripcion('%fooValue%', Criteria::LIKE); // WHERE DESCRIPCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the UNIDAD_MEDIDA column
     *
     * Example usage:
     * <code>
     * $query->filterByUnidadMedida('fooValue');   // WHERE UNIDAD_MEDIDA = 'fooValue'
     * $query->filterByUnidadMedida('%fooValue%', Criteria::LIKE); // WHERE UNIDAD_MEDIDA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $unidadMedida The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByUnidadMedida($unidadMedida = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unidadMedida)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_UNIDAD_MEDIDA, $unidadMedida, $comparison);
    }

    /**
     * Filter the query on the CANTIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByCantidad(1234); // WHERE CANTIDAD = 1234
     * $query->filterByCantidad(array(12, 34)); // WHERE CANTIDAD IN (12, 34)
     * $query->filterByCantidad(array('min' => 12)); // WHERE CANTIDAD > 12
     * </code>
     *
     * @param     mixed $cantidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByCantidad($cantidad = null, $comparison = null)
    {
        if (is_array($cantidad)) {
            $useMinMax = false;
            if (isset($cantidad['min'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_CANTIDAD, $cantidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidad['max'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_CANTIDAD, $cantidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_CANTIDAD, $cantidad, $comparison);
    }

    /**
     * Filter the query on the PRECIO_UNIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecioUnidad(1234); // WHERE PRECIO_UNIDAD = 1234
     * $query->filterByPrecioUnidad(array(12, 34)); // WHERE PRECIO_UNIDAD IN (12, 34)
     * $query->filterByPrecioUnidad(array('min' => 12)); // WHERE PRECIO_UNIDAD > 12
     * </code>
     *
     * @param     mixed $precioUnidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByPrecioUnidad($precioUnidad = null, $comparison = null)
    {
        if (is_array($precioUnidad)) {
            $useMinMax = false;
            if (isset($precioUnidad['min'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_PRECIO_UNIDAD, $precioUnidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precioUnidad['max'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_PRECIO_UNIDAD, $precioUnidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_PRECIO_UNIDAD, $precioUnidad, $comparison);
    }

    /**
     * Filter the query on the CODIGO_CATALOGO column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoCatalogo('fooValue');   // WHERE CODIGO_CATALOGO = 'fooValue'
     * $query->filterByCodigoCatalogo('%fooValue%', Criteria::LIKE); // WHERE CODIGO_CATALOGO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigoCatalogo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByCodigoCatalogo($codigoCatalogo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigoCatalogo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_CODIGO_CATALOGO, $codigoCatalogo, $comparison);
    }

    /**
     * Filter the query on the OBJETO_GASTO column
     *
     * Example usage:
     * <code>
     * $query->filterByObjetoGasto('fooValue');   // WHERE OBJETO_GASTO = 'fooValue'
     * $query->filterByObjetoGasto('%fooValue%', Criteria::LIKE); // WHERE OBJETO_GASTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $objetoGasto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByObjetoGasto($objetoGasto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($objetoGasto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_OBJETO_GASTO, $objetoGasto, $comparison);
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
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobSicoesDetalleTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesDetalleTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobSicoesConvocatoria object
     *
     * @param \JobSicoesConvocatoria|ObjectCollection $jobSicoesConvocatoria The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function filterByJobSicoesConvocatoria($jobSicoesConvocatoria, $comparison = null)
    {
        if ($jobSicoesConvocatoria instanceof \JobSicoesConvocatoria) {
            return $this
                ->addUsingAlias(JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA, $jobSicoesConvocatoria->getId(), $comparison);
        } elseif ($jobSicoesConvocatoria instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobSicoesDetalleTableMap::COL_ID_SICOES_CONVOCATORIA, $jobSicoesConvocatoria->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobSicoesConvocatoria() only accepts arguments of type \JobSicoesConvocatoria or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobSicoesConvocatoria relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function joinJobSicoesConvocatoria($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobSicoesConvocatoria');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'JobSicoesConvocatoria');
        }

        return $this;
    }

    /**
     * Use the JobSicoesConvocatoria relation JobSicoesConvocatoria object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobSicoesConvocatoriaQuery A secondary query class using the current class as primary query
     */
    public function useJobSicoesConvocatoriaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobSicoesConvocatoria($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobSicoesConvocatoria', '\JobSicoesConvocatoriaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobSicoesDetalle $jobSicoesDetalle Object to remove from the list of results
     *
     * @return $this|ChildJobSicoesDetalleQuery The current query, for fluid interface
     */
    public function prune($jobSicoesDetalle = null)
    {
        if ($jobSicoesDetalle) {
            $this->addUsingAlias(JobSicoesDetalleTableMap::COL_ID, $jobSicoesDetalle->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_sicoes_detalle table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesDetalleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobSicoesDetalleTableMap::clearInstancePool();
            JobSicoesDetalleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesDetalleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobSicoesDetalleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobSicoesDetalleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobSicoesDetalleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobSicoesDetalleQuery
