<?php

namespace Base;

use \JobEmpresaSuscrita as ChildJobEmpresaSuscrita;
use \JobEmpresaSuscritaQuery as ChildJobEmpresaSuscritaQuery;
use \Exception;
use \PDO;
use Map\JobEmpresaSuscritaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_empresa_suscrita' table.
 *
 * 
 *
 * @method     ChildJobEmpresaSuscritaQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobEmpresaSuscritaQuery orderByEntityTypeId($order = Criteria::ASC) Order by the ENTITY_TYPE_ID column
 * @method     ChildJobEmpresaSuscritaQuery orderByLocationId($order = Criteria::ASC) Order by the LOCATION_ID column
 * @method     ChildJobEmpresaSuscritaQuery orderByScrapEmpresaId($order = Criteria::ASC) Order by the SCRAP_EMPRESA_ID column
 * @method     ChildJobEmpresaSuscritaQuery orderByHashCode($order = Criteria::ASC) Order by the HASH_CODE column
 * @method     ChildJobEmpresaSuscritaQuery orderByNombre($order = Criteria::ASC) Order by the NOMBRE column
 * @method     ChildJobEmpresaSuscritaQuery orderByNit($order = Criteria::ASC) Order by the NIT column
 * @method     ChildJobEmpresaSuscritaQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildJobEmpresaSuscritaQuery orderByDireccion($order = Criteria::ASC) Order by the DIRECCION column
 * @method     ChildJobEmpresaSuscritaQuery orderByRepresentante($order = Criteria::ASC) Order by the REPRESENTANTE column
 * @method     ChildJobEmpresaSuscritaQuery orderByTelefono($order = Criteria::ASC) Order by the TELEFONO column
 * @method     ChildJobEmpresaSuscritaQuery orderByCelular($order = Criteria::ASC) Order by the CELULAR column
 * @method     ChildJobEmpresaSuscritaQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobEmpresaSuscritaQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobEmpresaSuscritaQuery orderByModificacionDate($order = Criteria::ASC) Order by the MODIFICACION_DATE column
 *
 * @method     ChildJobEmpresaSuscritaQuery groupById() Group by the ID column
 * @method     ChildJobEmpresaSuscritaQuery groupByEntityTypeId() Group by the ENTITY_TYPE_ID column
 * @method     ChildJobEmpresaSuscritaQuery groupByLocationId() Group by the LOCATION_ID column
 * @method     ChildJobEmpresaSuscritaQuery groupByScrapEmpresaId() Group by the SCRAP_EMPRESA_ID column
 * @method     ChildJobEmpresaSuscritaQuery groupByHashCode() Group by the HASH_CODE column
 * @method     ChildJobEmpresaSuscritaQuery groupByNombre() Group by the NOMBRE column
 * @method     ChildJobEmpresaSuscritaQuery groupByNit() Group by the NIT column
 * @method     ChildJobEmpresaSuscritaQuery groupByEmail() Group by the EMAIL column
 * @method     ChildJobEmpresaSuscritaQuery groupByDireccion() Group by the DIRECCION column
 * @method     ChildJobEmpresaSuscritaQuery groupByRepresentante() Group by the REPRESENTANTE column
 * @method     ChildJobEmpresaSuscritaQuery groupByTelefono() Group by the TELEFONO column
 * @method     ChildJobEmpresaSuscritaQuery groupByCelular() Group by the CELULAR column
 * @method     ChildJobEmpresaSuscritaQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobEmpresaSuscritaQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobEmpresaSuscritaQuery groupByModificacionDate() Group by the MODIFICACION_DATE column
 *
 * @method     ChildJobEmpresaSuscritaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobEmpresaSuscritaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobEmpresaSuscritaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobEmpresaSuscritaQuery leftJoinSysEntityType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityType relation
 * @method     ChildJobEmpresaSuscritaQuery rightJoinSysEntityType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityType relation
 * @method     ChildJobEmpresaSuscritaQuery innerJoinSysEntityType($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityType relation
 *
 * @method     ChildJobEmpresaSuscritaQuery leftJoinSysLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysLocation relation
 * @method     ChildJobEmpresaSuscritaQuery rightJoinSysLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysLocation relation
 * @method     ChildJobEmpresaSuscritaQuery innerJoinSysLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the SysLocation relation
 *
 * @method     \SysEntityTypeQuery|\SysLocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobEmpresaSuscrita findOne(ConnectionInterface $con = null) Return the first ChildJobEmpresaSuscrita matching the query
 * @method     ChildJobEmpresaSuscrita findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobEmpresaSuscrita matching the query, or a new ChildJobEmpresaSuscrita object populated from the query conditions when no match is found
 *
 * @method     ChildJobEmpresaSuscrita findOneById(int $ID) Return the first ChildJobEmpresaSuscrita filtered by the ID column
 * @method     ChildJobEmpresaSuscrita findOneByEntityTypeId(int $ENTITY_TYPE_ID) Return the first ChildJobEmpresaSuscrita filtered by the ENTITY_TYPE_ID column
 * @method     ChildJobEmpresaSuscrita findOneByLocationId(int $LOCATION_ID) Return the first ChildJobEmpresaSuscrita filtered by the LOCATION_ID column
 * @method     ChildJobEmpresaSuscrita findOneByScrapEmpresaId(int $SCRAP_EMPRESA_ID) Return the first ChildJobEmpresaSuscrita filtered by the SCRAP_EMPRESA_ID column
 * @method     ChildJobEmpresaSuscrita findOneByHashCode(string $HASH_CODE) Return the first ChildJobEmpresaSuscrita filtered by the HASH_CODE column
 * @method     ChildJobEmpresaSuscrita findOneByNombre(string $NOMBRE) Return the first ChildJobEmpresaSuscrita filtered by the NOMBRE column
 * @method     ChildJobEmpresaSuscrita findOneByNit(string $NIT) Return the first ChildJobEmpresaSuscrita filtered by the NIT column
 * @method     ChildJobEmpresaSuscrita findOneByEmail(string $EMAIL) Return the first ChildJobEmpresaSuscrita filtered by the EMAIL column
 * @method     ChildJobEmpresaSuscrita findOneByDireccion(string $DIRECCION) Return the first ChildJobEmpresaSuscrita filtered by the DIRECCION column
 * @method     ChildJobEmpresaSuscrita findOneByRepresentante(string $REPRESENTANTE) Return the first ChildJobEmpresaSuscrita filtered by the REPRESENTANTE column
 * @method     ChildJobEmpresaSuscrita findOneByTelefono(string $TELEFONO) Return the first ChildJobEmpresaSuscrita filtered by the TELEFONO column
 * @method     ChildJobEmpresaSuscrita findOneByCelular(string $CELULAR) Return the first ChildJobEmpresaSuscrita filtered by the CELULAR column
 * @method     ChildJobEmpresaSuscrita findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobEmpresaSuscrita filtered by the LAST_USER_ID column
 * @method     ChildJobEmpresaSuscrita findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobEmpresaSuscrita filtered by the CREATION_DATE column
 * @method     ChildJobEmpresaSuscrita findOneByModificacionDate(string $MODIFICACION_DATE) Return the first ChildJobEmpresaSuscrita filtered by the MODIFICACION_DATE column *

 * @method     ChildJobEmpresaSuscrita requirePk($key, ConnectionInterface $con = null) Return the ChildJobEmpresaSuscrita by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOne(ConnectionInterface $con = null) Return the first ChildJobEmpresaSuscrita matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobEmpresaSuscrita requireOneById(int $ID) Return the first ChildJobEmpresaSuscrita filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByEntityTypeId(int $ENTITY_TYPE_ID) Return the first ChildJobEmpresaSuscrita filtered by the ENTITY_TYPE_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByLocationId(int $LOCATION_ID) Return the first ChildJobEmpresaSuscrita filtered by the LOCATION_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByScrapEmpresaId(int $SCRAP_EMPRESA_ID) Return the first ChildJobEmpresaSuscrita filtered by the SCRAP_EMPRESA_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByHashCode(string $HASH_CODE) Return the first ChildJobEmpresaSuscrita filtered by the HASH_CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByNombre(string $NOMBRE) Return the first ChildJobEmpresaSuscrita filtered by the NOMBRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByNit(string $NIT) Return the first ChildJobEmpresaSuscrita filtered by the NIT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByEmail(string $EMAIL) Return the first ChildJobEmpresaSuscrita filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByDireccion(string $DIRECCION) Return the first ChildJobEmpresaSuscrita filtered by the DIRECCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByRepresentante(string $REPRESENTANTE) Return the first ChildJobEmpresaSuscrita filtered by the REPRESENTANTE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByTelefono(string $TELEFONO) Return the first ChildJobEmpresaSuscrita filtered by the TELEFONO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByCelular(string $CELULAR) Return the first ChildJobEmpresaSuscrita filtered by the CELULAR column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobEmpresaSuscrita filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobEmpresaSuscrita filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaSuscrita requireOneByModificacionDate(string $MODIFICACION_DATE) Return the first ChildJobEmpresaSuscrita filtered by the MODIFICACION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobEmpresaSuscrita objects based on current ModelCriteria
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findById(int $ID) Return ChildJobEmpresaSuscrita objects filtered by the ID column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByEntityTypeId(int $ENTITY_TYPE_ID) Return ChildJobEmpresaSuscrita objects filtered by the ENTITY_TYPE_ID column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByLocationId(int $LOCATION_ID) Return ChildJobEmpresaSuscrita objects filtered by the LOCATION_ID column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByScrapEmpresaId(int $SCRAP_EMPRESA_ID) Return ChildJobEmpresaSuscrita objects filtered by the SCRAP_EMPRESA_ID column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByHashCode(string $HASH_CODE) Return ChildJobEmpresaSuscrita objects filtered by the HASH_CODE column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByNombre(string $NOMBRE) Return ChildJobEmpresaSuscrita objects filtered by the NOMBRE column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByNit(string $NIT) Return ChildJobEmpresaSuscrita objects filtered by the NIT column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByEmail(string $EMAIL) Return ChildJobEmpresaSuscrita objects filtered by the EMAIL column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByDireccion(string $DIRECCION) Return ChildJobEmpresaSuscrita objects filtered by the DIRECCION column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByRepresentante(string $REPRESENTANTE) Return ChildJobEmpresaSuscrita objects filtered by the REPRESENTANTE column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByTelefono(string $TELEFONO) Return ChildJobEmpresaSuscrita objects filtered by the TELEFONO column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByCelular(string $CELULAR) Return ChildJobEmpresaSuscrita objects filtered by the CELULAR column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobEmpresaSuscrita objects filtered by the LAST_USER_ID column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobEmpresaSuscrita objects filtered by the CREATION_DATE column
 * @method     ChildJobEmpresaSuscrita[]|ObjectCollection findByModificacionDate(string $MODIFICACION_DATE) Return ChildJobEmpresaSuscrita objects filtered by the MODIFICACION_DATE column
 * @method     ChildJobEmpresaSuscrita[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobEmpresaSuscritaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobEmpresaSuscritaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobEmpresaSuscrita', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobEmpresaSuscritaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobEmpresaSuscritaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobEmpresaSuscritaQuery) {
            return $criteria;
        }
        $query = new ChildJobEmpresaSuscritaQuery();
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
     * @return ChildJobEmpresaSuscrita|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobEmpresaSuscritaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
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
     * @return ChildJobEmpresaSuscrita A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ENTITY_TYPE_ID, LOCATION_ID, SCRAP_EMPRESA_ID, HASH_CODE, NOMBRE, NIT, EMAIL, DIRECCION, REPRESENTANTE, TELEFONO, CELULAR, LAST_USER_ID, CREATION_DATE, MODIFICACION_DATE FROM job_empresa_suscrita WHERE ID = :p0';
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
            /** @var ChildJobEmpresaSuscrita $obj */
            $obj = new ChildJobEmpresaSuscrita();
            $obj->hydrate($row);
            JobEmpresaSuscritaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildJobEmpresaSuscrita|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ENTITY_TYPE_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityTypeId(1234); // WHERE ENTITY_TYPE_ID = 1234
     * $query->filterByEntityTypeId(array(12, 34)); // WHERE ENTITY_TYPE_ID IN (12, 34)
     * $query->filterByEntityTypeId(array('min' => 12)); // WHERE ENTITY_TYPE_ID > 12
     * </code>
     *
     * @see       filterBySysEntityType()
     *
     * @param     mixed $entityTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByEntityTypeId($entityTypeId = null, $comparison = null)
    {
        if (is_array($entityTypeId)) {
            $useMinMax = false;
            if (isset($entityTypeId['min'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID, $entityTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityTypeId['max'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID, $entityTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID, $entityTypeId, $comparison);
    }

    /**
     * Filter the query on the LOCATION_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationId(1234); // WHERE LOCATION_ID = 1234
     * $query->filterByLocationId(array(12, 34)); // WHERE LOCATION_ID IN (12, 34)
     * $query->filterByLocationId(array('min' => 12)); // WHERE LOCATION_ID > 12
     * </code>
     *
     * @see       filterBySysLocation()
     *
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the SCRAP_EMPRESA_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByScrapEmpresaId(1234); // WHERE SCRAP_EMPRESA_ID = 1234
     * $query->filterByScrapEmpresaId(array(12, 34)); // WHERE SCRAP_EMPRESA_ID IN (12, 34)
     * $query->filterByScrapEmpresaId(array('min' => 12)); // WHERE SCRAP_EMPRESA_ID > 12
     * </code>
     *
     * @param     mixed $scrapEmpresaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByScrapEmpresaId($scrapEmpresaId = null, $comparison = null)
    {
        if (is_array($scrapEmpresaId)) {
            $useMinMax = false;
            if (isset($scrapEmpresaId['min'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID, $scrapEmpresaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scrapEmpresaId['max'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID, $scrapEmpresaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID, $scrapEmpresaId, $comparison);
    }

    /**
     * Filter the query on the HASH_CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByHashCode('fooValue');   // WHERE HASH_CODE = 'fooValue'
     * $query->filterByHashCode('%fooValue%'); // WHERE HASH_CODE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hashCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByHashCode($hashCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hashCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $hashCode)) {
                $hashCode = str_replace('*', '%', $hashCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_HASH_CODE, $hashCode, $comparison);
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_NOMBRE, $nombre, $comparison);
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_NIT, $nit, $comparison);
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the REPRESENTANTE column
     *
     * Example usage:
     * <code>
     * $query->filterByRepresentante('fooValue');   // WHERE REPRESENTANTE = 'fooValue'
     * $query->filterByRepresentante('%fooValue%'); // WHERE REPRESENTANTE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $representante The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByRepresentante($representante = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($representante)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $representante)) {
                $representante = str_replace('*', '%', $representante);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_REPRESENTANTE, $representante, $comparison);
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_TELEFONO, $telefono, $comparison);
    }

    /**
     * Filter the query on the CELULAR column
     *
     * Example usage:
     * <code>
     * $query->filterByCelular('fooValue');   // WHERE CELULAR = 'fooValue'
     * $query->filterByCelular('%fooValue%'); // WHERE CELULAR LIKE '%fooValue%'
     * </code>
     *
     * @param     string $celular The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByCelular($celular = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($celular)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $celular)) {
                $celular = str_replace('*', '%', $celular);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_CELULAR, $celular, $comparison);
    }

    /**
     * Filter the query on the LAST_USER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUserId(1234); // WHERE LAST_USER_ID = 1234
     * $query->filterByLastUserId(array(12, 34)); // WHERE LAST_USER_ID IN (12, 34)
     * $query->filterByLastUserId(array('min' => 12)); // WHERE LAST_USER_ID > 12
     * </code>
     *
     * @param     mixed $lastUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the MODIFICACION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByModificacionDate('2011-03-14'); // WHERE MODIFICACION_DATE = '2011-03-14'
     * $query->filterByModificacionDate('now'); // WHERE MODIFICACION_DATE = '2011-03-14'
     * $query->filterByModificacionDate(array('max' => 'yesterday')); // WHERE MODIFICACION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $modificacionDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByModificacionDate($modificacionDate = null, $comparison = null)
    {
        if (is_array($modificacionDate)) {
            $useMinMax = false;
            if (isset($modificacionDate['min'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE, $modificacionDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificacionDate['max'])) {
                $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE, $modificacionDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE, $modificacionDate, $comparison);
    }

    /**
     * Filter the query by a related \SysEntityType object
     *
     * @param \SysEntityType|ObjectCollection $sysEntityType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterBySysEntityType($sysEntityType, $comparison = null)
    {
        if ($sysEntityType instanceof \SysEntityType) {
            return $this
                ->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID, $sysEntityType->getId(), $comparison);
        } elseif ($sysEntityType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID, $sysEntityType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysEntityType() only accepts arguments of type \SysEntityType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function joinSysEntityType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityType');

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
            $this->addJoinObject($join, 'SysEntityType');
        }

        return $this;
    }

    /**
     * Use the SysEntityType relation SysEntityType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityTypeQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityType', '\SysEntityTypeQuery');
    }

    /**
     * Filter the query by a related \SysLocation object
     *
     * @param \SysLocation|ObjectCollection $sysLocation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterBySysLocation($sysLocation, $comparison = null)
    {
        if ($sysLocation instanceof \SysLocation) {
            return $this
                ->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LOCATION_ID, $sysLocation->getId(), $comparison);
        } elseif ($sysLocation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobEmpresaSuscritaTableMap::COL_LOCATION_ID, $sysLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysLocation() only accepts arguments of type \SysLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function joinSysLocation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysLocation');

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
            $this->addJoinObject($join, 'SysLocation');
        }

        return $this;
    }

    /**
     * Use the SysLocation relation SysLocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysLocationQuery A secondary query class using the current class as primary query
     */
    public function useSysLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysLocation', '\SysLocationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobEmpresaSuscrita $jobEmpresaSuscrita Object to remove from the list of results
     *
     * @return $this|ChildJobEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function prune($jobEmpresaSuscrita = null)
    {
        if ($jobEmpresaSuscrita) {
            $this->addUsingAlias(JobEmpresaSuscritaTableMap::COL_ID, $jobEmpresaSuscrita->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_empresa_suscrita table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobEmpresaSuscritaTableMap::clearInstancePool();
            JobEmpresaSuscritaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobEmpresaSuscritaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            JobEmpresaSuscritaTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            JobEmpresaSuscritaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobEmpresaSuscritaQuery
