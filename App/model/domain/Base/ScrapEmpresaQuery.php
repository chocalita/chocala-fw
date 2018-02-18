<?php

namespace Base;

use \ScrapEmpresa as ChildScrapEmpresa;
use \ScrapEmpresaQuery as ChildScrapEmpresaQuery;
use \Exception;
use \PDO;
use Map\ScrapEmpresaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'scrap_empresa' table.
 *
 *
 *
 * @method     ChildScrapEmpresaQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildScrapEmpresaQuery orderByIdPagina($order = Criteria::ASC) Order by the ID_PAGINA column
 * @method     ChildScrapEmpresaQuery orderByIdActividad($order = Criteria::ASC) Order by the ID_ACTIVIDAD column
 * @method     ChildScrapEmpresaQuery orderByIdTipoEmpresa($order = Criteria::ASC) Order by the ID_TIPO_EMPRESA column
 * @method     ChildScrapEmpresaQuery orderByIdEmpresa($order = Criteria::ASC) Order by the ID_EMPRESA column
 * @method     ChildScrapEmpresaQuery orderByNit($order = Criteria::ASC) Order by the NIT column
 * @method     ChildScrapEmpresaQuery orderByNombre($order = Criteria::ASC) Order by the NOMBRE column
 * @method     ChildScrapEmpresaQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildScrapEmpresaQuery orderByActividad($order = Criteria::ASC) Order by the ACTIVIDAD column
 * @method     ChildScrapEmpresaQuery orderByLeido($order = Criteria::ASC) Order by the LEIDO column
 * @method     ChildScrapEmpresaQuery orderByMatricula($order = Criteria::ASC) Order by the MATRICULA column
 * @method     ChildScrapEmpresaQuery orderByLicencia($order = Criteria::ASC) Order by the LICENCIA column
 * @method     ChildScrapEmpresaQuery orderByMunicipio($order = Criteria::ASC) Order by the MUNICIPIO column
 * @method     ChildScrapEmpresaQuery orderByDireccion($order = Criteria::ASC) Order by the DIRECCION column
 * @method     ChildScrapEmpresaQuery orderByTelefono($order = Criteria::ASC) Order by the TELEFONO column
 * @method     ChildScrapEmpresaQuery orderByFax($order = Criteria::ASC) Order by the FAX column
 *
 * @method     ChildScrapEmpresaQuery groupById() Group by the ID column
 * @method     ChildScrapEmpresaQuery groupByIdPagina() Group by the ID_PAGINA column
 * @method     ChildScrapEmpresaQuery groupByIdActividad() Group by the ID_ACTIVIDAD column
 * @method     ChildScrapEmpresaQuery groupByIdTipoEmpresa() Group by the ID_TIPO_EMPRESA column
 * @method     ChildScrapEmpresaQuery groupByIdEmpresa() Group by the ID_EMPRESA column
 * @method     ChildScrapEmpresaQuery groupByNit() Group by the NIT column
 * @method     ChildScrapEmpresaQuery groupByNombre() Group by the NOMBRE column
 * @method     ChildScrapEmpresaQuery groupByEmail() Group by the EMAIL column
 * @method     ChildScrapEmpresaQuery groupByActividad() Group by the ACTIVIDAD column
 * @method     ChildScrapEmpresaQuery groupByLeido() Group by the LEIDO column
 * @method     ChildScrapEmpresaQuery groupByMatricula() Group by the MATRICULA column
 * @method     ChildScrapEmpresaQuery groupByLicencia() Group by the LICENCIA column
 * @method     ChildScrapEmpresaQuery groupByMunicipio() Group by the MUNICIPIO column
 * @method     ChildScrapEmpresaQuery groupByDireccion() Group by the DIRECCION column
 * @method     ChildScrapEmpresaQuery groupByTelefono() Group by the TELEFONO column
 * @method     ChildScrapEmpresaQuery groupByFax() Group by the FAX column
 *
 * @method     ChildScrapEmpresaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildScrapEmpresaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildScrapEmpresaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildScrapEmpresaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildScrapEmpresaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildScrapEmpresaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildScrapEmpresaQuery leftJoinScrapActividad($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScrapActividad relation
 * @method     ChildScrapEmpresaQuery rightJoinScrapActividad($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScrapActividad relation
 * @method     ChildScrapEmpresaQuery innerJoinScrapActividad($relationAlias = null) Adds a INNER JOIN clause to the query using the ScrapActividad relation
 *
 * @method     ChildScrapEmpresaQuery joinWithScrapActividad($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ScrapActividad relation
 *
 * @method     ChildScrapEmpresaQuery leftJoinWithScrapActividad() Adds a LEFT JOIN clause and with to the query using the ScrapActividad relation
 * @method     ChildScrapEmpresaQuery rightJoinWithScrapActividad() Adds a RIGHT JOIN clause and with to the query using the ScrapActividad relation
 * @method     ChildScrapEmpresaQuery innerJoinWithScrapActividad() Adds a INNER JOIN clause and with to the query using the ScrapActividad relation
 *
 * @method     ChildScrapEmpresaQuery leftJoinScrapTipoEmpresa($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScrapTipoEmpresa relation
 * @method     ChildScrapEmpresaQuery rightJoinScrapTipoEmpresa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScrapTipoEmpresa relation
 * @method     ChildScrapEmpresaQuery innerJoinScrapTipoEmpresa($relationAlias = null) Adds a INNER JOIN clause to the query using the ScrapTipoEmpresa relation
 *
 * @method     ChildScrapEmpresaQuery joinWithScrapTipoEmpresa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ScrapTipoEmpresa relation
 *
 * @method     ChildScrapEmpresaQuery leftJoinWithScrapTipoEmpresa() Adds a LEFT JOIN clause and with to the query using the ScrapTipoEmpresa relation
 * @method     ChildScrapEmpresaQuery rightJoinWithScrapTipoEmpresa() Adds a RIGHT JOIN clause and with to the query using the ScrapTipoEmpresa relation
 * @method     ChildScrapEmpresaQuery innerJoinWithScrapTipoEmpresa() Adds a INNER JOIN clause and with to the query using the ScrapTipoEmpresa relation
 *
 * @method     ChildScrapEmpresaQuery leftJoinScrapPagina($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScrapPagina relation
 * @method     ChildScrapEmpresaQuery rightJoinScrapPagina($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScrapPagina relation
 * @method     ChildScrapEmpresaQuery innerJoinScrapPagina($relationAlias = null) Adds a INNER JOIN clause to the query using the ScrapPagina relation
 *
 * @method     ChildScrapEmpresaQuery joinWithScrapPagina($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ScrapPagina relation
 *
 * @method     ChildScrapEmpresaQuery leftJoinWithScrapPagina() Adds a LEFT JOIN clause and with to the query using the ScrapPagina relation
 * @method     ChildScrapEmpresaQuery rightJoinWithScrapPagina() Adds a RIGHT JOIN clause and with to the query using the ScrapPagina relation
 * @method     ChildScrapEmpresaQuery innerJoinWithScrapPagina() Adds a INNER JOIN clause and with to the query using the ScrapPagina relation
 *
 * @method     \ScrapActividadQuery|\ScrapTipoEmpresaQuery|\ScrapPaginaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildScrapEmpresa findOne(ConnectionInterface $con = null) Return the first ChildScrapEmpresa matching the query
 * @method     ChildScrapEmpresa findOneOrCreate(ConnectionInterface $con = null) Return the first ChildScrapEmpresa matching the query, or a new ChildScrapEmpresa object populated from the query conditions when no match is found
 *
 * @method     ChildScrapEmpresa findOneById(int $ID) Return the first ChildScrapEmpresa filtered by the ID column
 * @method     ChildScrapEmpresa findOneByIdPagina(int $ID_PAGINA) Return the first ChildScrapEmpresa filtered by the ID_PAGINA column
 * @method     ChildScrapEmpresa findOneByIdActividad(int $ID_ACTIVIDAD) Return the first ChildScrapEmpresa filtered by the ID_ACTIVIDAD column
 * @method     ChildScrapEmpresa findOneByIdTipoEmpresa(int $ID_TIPO_EMPRESA) Return the first ChildScrapEmpresa filtered by the ID_TIPO_EMPRESA column
 * @method     ChildScrapEmpresa findOneByIdEmpresa(string $ID_EMPRESA) Return the first ChildScrapEmpresa filtered by the ID_EMPRESA column
 * @method     ChildScrapEmpresa findOneByNit(string $NIT) Return the first ChildScrapEmpresa filtered by the NIT column
 * @method     ChildScrapEmpresa findOneByNombre(string $NOMBRE) Return the first ChildScrapEmpresa filtered by the NOMBRE column
 * @method     ChildScrapEmpresa findOneByEmail(string $EMAIL) Return the first ChildScrapEmpresa filtered by the EMAIL column
 * @method     ChildScrapEmpresa findOneByActividad(string $ACTIVIDAD) Return the first ChildScrapEmpresa filtered by the ACTIVIDAD column
 * @method     ChildScrapEmpresa findOneByLeido(boolean $LEIDO) Return the first ChildScrapEmpresa filtered by the LEIDO column
 * @method     ChildScrapEmpresa findOneByMatricula(string $MATRICULA) Return the first ChildScrapEmpresa filtered by the MATRICULA column
 * @method     ChildScrapEmpresa findOneByLicencia(string $LICENCIA) Return the first ChildScrapEmpresa filtered by the LICENCIA column
 * @method     ChildScrapEmpresa findOneByMunicipio(string $MUNICIPIO) Return the first ChildScrapEmpresa filtered by the MUNICIPIO column
 * @method     ChildScrapEmpresa findOneByDireccion(string $DIRECCION) Return the first ChildScrapEmpresa filtered by the DIRECCION column
 * @method     ChildScrapEmpresa findOneByTelefono(string $TELEFONO) Return the first ChildScrapEmpresa filtered by the TELEFONO column
 * @method     ChildScrapEmpresa findOneByFax(string $FAX) Return the first ChildScrapEmpresa filtered by the FAX column *

 * @method     ChildScrapEmpresa requirePk($key, ConnectionInterface $con = null) Return the ChildScrapEmpresa by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOne(ConnectionInterface $con = null) Return the first ChildScrapEmpresa matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildScrapEmpresa requireOneById(int $ID) Return the first ChildScrapEmpresa filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByIdPagina(int $ID_PAGINA) Return the first ChildScrapEmpresa filtered by the ID_PAGINA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByIdActividad(int $ID_ACTIVIDAD) Return the first ChildScrapEmpresa filtered by the ID_ACTIVIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByIdTipoEmpresa(int $ID_TIPO_EMPRESA) Return the first ChildScrapEmpresa filtered by the ID_TIPO_EMPRESA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByIdEmpresa(string $ID_EMPRESA) Return the first ChildScrapEmpresa filtered by the ID_EMPRESA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByNit(string $NIT) Return the first ChildScrapEmpresa filtered by the NIT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByNombre(string $NOMBRE) Return the first ChildScrapEmpresa filtered by the NOMBRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByEmail(string $EMAIL) Return the first ChildScrapEmpresa filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByActividad(string $ACTIVIDAD) Return the first ChildScrapEmpresa filtered by the ACTIVIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByLeido(boolean $LEIDO) Return the first ChildScrapEmpresa filtered by the LEIDO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByMatricula(string $MATRICULA) Return the first ChildScrapEmpresa filtered by the MATRICULA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByLicencia(string $LICENCIA) Return the first ChildScrapEmpresa filtered by the LICENCIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByMunicipio(string $MUNICIPIO) Return the first ChildScrapEmpresa filtered by the MUNICIPIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByDireccion(string $DIRECCION) Return the first ChildScrapEmpresa filtered by the DIRECCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByTelefono(string $TELEFONO) Return the first ChildScrapEmpresa filtered by the TELEFONO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapEmpresa requireOneByFax(string $FAX) Return the first ChildScrapEmpresa filtered by the FAX column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildScrapEmpresa[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildScrapEmpresa objects based on current ModelCriteria
 * @method     ChildScrapEmpresa[]|ObjectCollection findById(int $ID) Return ChildScrapEmpresa objects filtered by the ID column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByIdPagina(int $ID_PAGINA) Return ChildScrapEmpresa objects filtered by the ID_PAGINA column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByIdActividad(int $ID_ACTIVIDAD) Return ChildScrapEmpresa objects filtered by the ID_ACTIVIDAD column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByIdTipoEmpresa(int $ID_TIPO_EMPRESA) Return ChildScrapEmpresa objects filtered by the ID_TIPO_EMPRESA column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByIdEmpresa(string $ID_EMPRESA) Return ChildScrapEmpresa objects filtered by the ID_EMPRESA column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByNit(string $NIT) Return ChildScrapEmpresa objects filtered by the NIT column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByNombre(string $NOMBRE) Return ChildScrapEmpresa objects filtered by the NOMBRE column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByEmail(string $EMAIL) Return ChildScrapEmpresa objects filtered by the EMAIL column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByActividad(string $ACTIVIDAD) Return ChildScrapEmpresa objects filtered by the ACTIVIDAD column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByLeido(boolean $LEIDO) Return ChildScrapEmpresa objects filtered by the LEIDO column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByMatricula(string $MATRICULA) Return ChildScrapEmpresa objects filtered by the MATRICULA column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByLicencia(string $LICENCIA) Return ChildScrapEmpresa objects filtered by the LICENCIA column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByMunicipio(string $MUNICIPIO) Return ChildScrapEmpresa objects filtered by the MUNICIPIO column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByDireccion(string $DIRECCION) Return ChildScrapEmpresa objects filtered by the DIRECCION column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByTelefono(string $TELEFONO) Return ChildScrapEmpresa objects filtered by the TELEFONO column
 * @method     ChildScrapEmpresa[]|ObjectCollection findByFax(string $FAX) Return ChildScrapEmpresa objects filtered by the FAX column
 * @method     ChildScrapEmpresa[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ScrapEmpresaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ScrapEmpresaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ScrapEmpresa', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildScrapEmpresaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildScrapEmpresaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildScrapEmpresaQuery) {
            return $criteria;
        }
        $query = new ChildScrapEmpresaQuery();
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
     * @return ChildScrapEmpresa|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ScrapEmpresaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ScrapEmpresaTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
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
     * @return ChildScrapEmpresa A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_PAGINA, ID_ACTIVIDAD, ID_TIPO_EMPRESA, ID_EMPRESA, NIT, NOMBRE, EMAIL, ACTIVIDAD, LEIDO, MATRICULA, LICENCIA, MUNICIPIO, DIRECCION, TELEFONO, FAX FROM scrap_empresa WHERE ID = :p0';
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
            /** @var ChildScrapEmpresa $obj */
            $obj = new ChildScrapEmpresa();
            $obj->hydrate($row);
            ScrapEmpresaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildScrapEmpresa|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_PAGINA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPagina(1234); // WHERE ID_PAGINA = 1234
     * $query->filterByIdPagina(array(12, 34)); // WHERE ID_PAGINA IN (12, 34)
     * $query->filterByIdPagina(array('min' => 12)); // WHERE ID_PAGINA > 12
     * </code>
     *
     * @see       filterByScrapPagina()
     *
     * @param     mixed $idPagina The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByIdPagina($idPagina = null, $comparison = null)
    {
        if (is_array($idPagina)) {
            $useMinMax = false;
            if (isset($idPagina['min'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_PAGINA, $idPagina['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPagina['max'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_PAGINA, $idPagina['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_PAGINA, $idPagina, $comparison);
    }

    /**
     * Filter the query on the ID_ACTIVIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByIdActividad(1234); // WHERE ID_ACTIVIDAD = 1234
     * $query->filterByIdActividad(array(12, 34)); // WHERE ID_ACTIVIDAD IN (12, 34)
     * $query->filterByIdActividad(array('min' => 12)); // WHERE ID_ACTIVIDAD > 12
     * </code>
     *
     * @see       filterByScrapActividad()
     *
     * @param     mixed $idActividad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByIdActividad($idActividad = null, $comparison = null)
    {
        if (is_array($idActividad)) {
            $useMinMax = false;
            if (isset($idActividad['min'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD, $idActividad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idActividad['max'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD, $idActividad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD, $idActividad, $comparison);
    }

    /**
     * Filter the query on the ID_TIPO_EMPRESA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTipoEmpresa(1234); // WHERE ID_TIPO_EMPRESA = 1234
     * $query->filterByIdTipoEmpresa(array(12, 34)); // WHERE ID_TIPO_EMPRESA IN (12, 34)
     * $query->filterByIdTipoEmpresa(array('min' => 12)); // WHERE ID_TIPO_EMPRESA > 12
     * </code>
     *
     * @see       filterByScrapTipoEmpresa()
     *
     * @param     mixed $idTipoEmpresa The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByIdTipoEmpresa($idTipoEmpresa = null, $comparison = null)
    {
        if (is_array($idTipoEmpresa)) {
            $useMinMax = false;
            if (isset($idTipoEmpresa['min'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA, $idTipoEmpresa['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTipoEmpresa['max'])) {
                $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA, $idTipoEmpresa['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA, $idTipoEmpresa, $comparison);
    }

    /**
     * Filter the query on the ID_EMPRESA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdEmpresa('fooValue');   // WHERE ID_EMPRESA = 'fooValue'
     * $query->filterByIdEmpresa('%fooValue%'); // WHERE ID_EMPRESA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idEmpresa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByIdEmpresa($idEmpresa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idEmpresa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $idEmpresa)) {
                $idEmpresa = str_replace('*', '%', $idEmpresa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID_EMPRESA, $idEmpresa, $comparison);
    }

    /**
     * Filter the query on the NIT column
     *
     * Example usage:
     * <code>
     * $query->filterByNit('fooValue');   // WHERE NIT = 'fooValue'
     * $query->filterByNit('%fooValue%'); // WHERE NIT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByNit($nit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nit)) {
                $nit = str_replace('*', '%', $nit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_NIT, $nit, $comparison);
    }

    /**
     * Filter the query on the NOMBRE column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE NOMBRE = 'fooValue'
     * $query->filterByNombre('%fooValue%'); // WHERE NOMBRE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombre)) {
                $nombre = str_replace('*', '%', $nombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the ACTIVIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByActividad('fooValue');   // WHERE ACTIVIDAD = 'fooValue'
     * $query->filterByActividad('%fooValue%'); // WHERE ACTIVIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $actividad The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByActividad($actividad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($actividad)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $actividad)) {
                $actividad = str_replace('*', '%', $actividad);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_ACTIVIDAD, $actividad, $comparison);
    }

    /**
     * Filter the query on the LEIDO column
     *
     * Example usage:
     * <code>
     * $query->filterByLeido(true); // WHERE LEIDO = true
     * $query->filterByLeido('yes'); // WHERE LEIDO = true
     * </code>
     *
     * @param     boolean|string $leido The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByLeido($leido = null, $comparison = null)
    {
        if (is_string($leido)) {
            $leido = in_array(strtolower($leido), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_LEIDO, $leido, $comparison);
    }

    /**
     * Filter the query on the MATRICULA column
     *
     * Example usage:
     * <code>
     * $query->filterByMatricula('fooValue');   // WHERE MATRICULA = 'fooValue'
     * $query->filterByMatricula('%fooValue%'); // WHERE MATRICULA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $matricula The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByMatricula($matricula = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($matricula)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $matricula)) {
                $matricula = str_replace('*', '%', $matricula);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_MATRICULA, $matricula, $comparison);
    }

    /**
     * Filter the query on the LICENCIA column
     *
     * Example usage:
     * <code>
     * $query->filterByLicencia('fooValue');   // WHERE LICENCIA = 'fooValue'
     * $query->filterByLicencia('%fooValue%'); // WHERE LICENCIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $licencia The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByLicencia($licencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($licencia)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $licencia)) {
                $licencia = str_replace('*', '%', $licencia);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_LICENCIA, $licencia, $comparison);
    }

    /**
     * Filter the query on the MUNICIPIO column
     *
     * Example usage:
     * <code>
     * $query->filterByMunicipio('fooValue');   // WHERE MUNICIPIO = 'fooValue'
     * $query->filterByMunicipio('%fooValue%'); // WHERE MUNICIPIO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $municipio The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByMunicipio($municipio = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($municipio)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $municipio)) {
                $municipio = str_replace('*', '%', $municipio);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_MUNICIPIO, $municipio, $comparison);
    }

    /**
     * Filter the query on the DIRECCION column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccion('fooValue');   // WHERE DIRECCION = 'fooValue'
     * $query->filterByDireccion('%fooValue%'); // WHERE DIRECCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByDireccion($direccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $direccion)) {
                $direccion = str_replace('*', '%', $direccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the TELEFONO column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefono('fooValue');   // WHERE TELEFONO = 'fooValue'
     * $query->filterByTelefono('%fooValue%'); // WHERE TELEFONO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefono The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByTelefono($telefono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefono)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefono)) {
                $telefono = str_replace('*', '%', $telefono);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_TELEFONO, $telefono, $comparison);
    }

    /**
     * Filter the query on the FAX column
     *
     * Example usage:
     * <code>
     * $query->filterByFax('fooValue');   // WHERE FAX = 'fooValue'
     * $query->filterByFax('%fooValue%'); // WHERE FAX LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fax The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fax)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fax)) {
                $fax = str_replace('*', '%', $fax);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapEmpresaTableMap::COL_FAX, $fax, $comparison);
    }

    /**
     * Filter the query by a related \ScrapActividad object
     *
     * @param \ScrapActividad|ObjectCollection $scrapActividad The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByScrapActividad($scrapActividad, $comparison = null)
    {
        if ($scrapActividad instanceof \ScrapActividad) {
            return $this
                ->addUsingAlias(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD, $scrapActividad->getId(), $comparison);
        } elseif ($scrapActividad instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD, $scrapActividad->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByScrapActividad() only accepts arguments of type \ScrapActividad or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ScrapActividad relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function joinScrapActividad($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ScrapActividad');

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
            $this->addJoinObject($join, 'ScrapActividad');
        }

        return $this;
    }

    /**
     * Use the ScrapActividad relation ScrapActividad object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ScrapActividadQuery A secondary query class using the current class as primary query
     */
    public function useScrapActividadQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinScrapActividad($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScrapActividad', '\ScrapActividadQuery');
    }

    /**
     * Filter the query by a related \ScrapTipoEmpresa object
     *
     * @param \ScrapTipoEmpresa|ObjectCollection $scrapTipoEmpresa The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByScrapTipoEmpresa($scrapTipoEmpresa, $comparison = null)
    {
        if ($scrapTipoEmpresa instanceof \ScrapTipoEmpresa) {
            return $this
                ->addUsingAlias(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA, $scrapTipoEmpresa->getId(), $comparison);
        } elseif ($scrapTipoEmpresa instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA, $scrapTipoEmpresa->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByScrapTipoEmpresa() only accepts arguments of type \ScrapTipoEmpresa or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ScrapTipoEmpresa relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function joinScrapTipoEmpresa($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ScrapTipoEmpresa');

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
            $this->addJoinObject($join, 'ScrapTipoEmpresa');
        }

        return $this;
    }

    /**
     * Use the ScrapTipoEmpresa relation ScrapTipoEmpresa object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ScrapTipoEmpresaQuery A secondary query class using the current class as primary query
     */
    public function useScrapTipoEmpresaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinScrapTipoEmpresa($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScrapTipoEmpresa', '\ScrapTipoEmpresaQuery');
    }

    /**
     * Filter the query by a related \ScrapPagina object
     *
     * @param \ScrapPagina|ObjectCollection $scrapPagina The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function filterByScrapPagina($scrapPagina, $comparison = null)
    {
        if ($scrapPagina instanceof \ScrapPagina) {
            return $this
                ->addUsingAlias(ScrapEmpresaTableMap::COL_ID_PAGINA, $scrapPagina->getId(), $comparison);
        } elseif ($scrapPagina instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScrapEmpresaTableMap::COL_ID_PAGINA, $scrapPagina->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByScrapPagina() only accepts arguments of type \ScrapPagina or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ScrapPagina relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function joinScrapPagina($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ScrapPagina');

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
            $this->addJoinObject($join, 'ScrapPagina');
        }

        return $this;
    }

    /**
     * Use the ScrapPagina relation ScrapPagina object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ScrapPaginaQuery A secondary query class using the current class as primary query
     */
    public function useScrapPaginaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinScrapPagina($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScrapPagina', '\ScrapPaginaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildScrapEmpresa $scrapEmpresa Object to remove from the list of results
     *
     * @return $this|ChildScrapEmpresaQuery The current query, for fluid interface
     */
    public function prune($scrapEmpresa = null)
    {
        if ($scrapEmpresa) {
            $this->addUsingAlias(ScrapEmpresaTableMap::COL_ID, $scrapEmpresa->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the scrap_empresa table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapEmpresaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ScrapEmpresaTableMap::clearInstancePool();
            ScrapEmpresaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapEmpresaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ScrapEmpresaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ScrapEmpresaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ScrapEmpresaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ScrapEmpresaQuery
