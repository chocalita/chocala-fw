<?php

namespace Base;

use \JobAreaTecnica as ChildJobAreaTecnica;
use \JobAreaTecnicaQuery as ChildJobAreaTecnicaQuery;
use \Exception;
use \PDO;
use Map\JobAreaTecnicaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_area_tecnica' table.
 *
 *
 *
 * @method     ChildJobAreaTecnicaQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobAreaTecnicaQuery orderByIdAreaPrincipal($order = Criteria::ASC) Order by the ID_AREA_PRINCIPAL column
 * @method     ChildJobAreaTecnicaQuery orderByNivel($order = Criteria::ASC) Order by the NIVEL column
 * @method     ChildJobAreaTecnicaQuery orderByNombre($order = Criteria::ASC) Order by the NOMBRE column
 * @method     ChildJobAreaTecnicaQuery orderByKeywords($order = Criteria::ASC) Order by the KEYWORDS column
 * @method     ChildJobAreaTecnicaQuery orderByDescripcion($order = Criteria::ASC) Order by the DESCRIPCION column
 * @method     ChildJobAreaTecnicaQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobAreaTecnicaQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobAreaTecnicaQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobAreaTecnicaQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobAreaTecnicaQuery groupById() Group by the ID column
 * @method     ChildJobAreaTecnicaQuery groupByIdAreaPrincipal() Group by the ID_AREA_PRINCIPAL column
 * @method     ChildJobAreaTecnicaQuery groupByNivel() Group by the NIVEL column
 * @method     ChildJobAreaTecnicaQuery groupByNombre() Group by the NOMBRE column
 * @method     ChildJobAreaTecnicaQuery groupByKeywords() Group by the KEYWORDS column
 * @method     ChildJobAreaTecnicaQuery groupByDescripcion() Group by the DESCRIPCION column
 * @method     ChildJobAreaTecnicaQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobAreaTecnicaQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobAreaTecnicaQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobAreaTecnicaQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobAreaTecnicaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobAreaTecnicaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobAreaTecnicaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobAreaTecnicaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobAreaTecnicaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinJobAreaRelacionadaRelatedByIdArea1($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
 * @method     ChildJobAreaTecnicaQuery rightJoinJobAreaRelacionadaRelatedByIdArea1($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
 * @method     ChildJobAreaTecnicaQuery innerJoinJobAreaRelacionadaRelatedByIdArea1($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
 *
 * @method     ChildJobAreaTecnicaQuery joinWithJobAreaRelacionadaRelatedByIdArea1($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinWithJobAreaRelacionadaRelatedByIdArea1() Adds a LEFT JOIN clause and with to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
 * @method     ChildJobAreaTecnicaQuery rightJoinWithJobAreaRelacionadaRelatedByIdArea1() Adds a RIGHT JOIN clause and with to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
 * @method     ChildJobAreaTecnicaQuery innerJoinWithJobAreaRelacionadaRelatedByIdArea1() Adds a INNER JOIN clause and with to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinJobAreaRelacionadaRelatedByIdArea2($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
 * @method     ChildJobAreaTecnicaQuery rightJoinJobAreaRelacionadaRelatedByIdArea2($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
 * @method     ChildJobAreaTecnicaQuery innerJoinJobAreaRelacionadaRelatedByIdArea2($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
 *
 * @method     ChildJobAreaTecnicaQuery joinWithJobAreaRelacionadaRelatedByIdArea2($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinWithJobAreaRelacionadaRelatedByIdArea2() Adds a LEFT JOIN clause and with to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
 * @method     ChildJobAreaTecnicaQuery rightJoinWithJobAreaRelacionadaRelatedByIdArea2() Adds a RIGHT JOIN clause and with to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
 * @method     ChildJobAreaTecnicaQuery innerJoinWithJobAreaRelacionadaRelatedByIdArea2() Adds a INNER JOIN clause and with to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinJobAreaTecnicaProfesion($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobAreaTecnicaQuery rightJoinJobAreaTecnicaProfesion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobAreaTecnicaQuery innerJoinJobAreaTecnicaProfesion($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaTecnicaProfesion relation
 *
 * @method     ChildJobAreaTecnicaQuery joinWithJobAreaTecnicaProfesion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAreaTecnicaProfesion relation
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinWithJobAreaTecnicaProfesion() Adds a LEFT JOIN clause and with to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobAreaTecnicaQuery rightJoinWithJobAreaTecnicaProfesion() Adds a RIGHT JOIN clause and with to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobAreaTecnicaQuery innerJoinWithJobAreaTecnicaProfesion() Adds a INNER JOIN clause and with to the query using the JobAreaTecnicaProfesion relation
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinJobAviso($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAviso relation
 * @method     ChildJobAreaTecnicaQuery rightJoinJobAviso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAviso relation
 * @method     ChildJobAreaTecnicaQuery innerJoinJobAviso($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAviso relation
 *
 * @method     ChildJobAreaTecnicaQuery joinWithJobAviso($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAviso relation
 *
 * @method     ChildJobAreaTecnicaQuery leftJoinWithJobAviso() Adds a LEFT JOIN clause and with to the query using the JobAviso relation
 * @method     ChildJobAreaTecnicaQuery rightJoinWithJobAviso() Adds a RIGHT JOIN clause and with to the query using the JobAviso relation
 * @method     ChildJobAreaTecnicaQuery innerJoinWithJobAviso() Adds a INNER JOIN clause and with to the query using the JobAviso relation
 *
 * @method     \JobAreaRelacionadaQuery|\JobAreaTecnicaProfesionQuery|\JobAvisoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobAreaTecnica findOne(ConnectionInterface $con = null) Return the first ChildJobAreaTecnica matching the query
 * @method     ChildJobAreaTecnica findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobAreaTecnica matching the query, or a new ChildJobAreaTecnica object populated from the query conditions when no match is found
 *
 * @method     ChildJobAreaTecnica findOneById(int $ID) Return the first ChildJobAreaTecnica filtered by the ID column
 * @method     ChildJobAreaTecnica findOneByIdAreaPrincipal(int $ID_AREA_PRINCIPAL) Return the first ChildJobAreaTecnica filtered by the ID_AREA_PRINCIPAL column
 * @method     ChildJobAreaTecnica findOneByNivel(int $NIVEL) Return the first ChildJobAreaTecnica filtered by the NIVEL column
 * @method     ChildJobAreaTecnica findOneByNombre(string $NOMBRE) Return the first ChildJobAreaTecnica filtered by the NOMBRE column
 * @method     ChildJobAreaTecnica findOneByKeywords(string $KEYWORDS) Return the first ChildJobAreaTecnica filtered by the KEYWORDS column
 * @method     ChildJobAreaTecnica findOneByDescripcion(string $DESCRIPCION) Return the first ChildJobAreaTecnica filtered by the DESCRIPCION column
 * @method     ChildJobAreaTecnica findOneByStatus(string $STATUS) Return the first ChildJobAreaTecnica filtered by the STATUS column
 * @method     ChildJobAreaTecnica findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobAreaTecnica filtered by the LAST_USER_ID column
 * @method     ChildJobAreaTecnica findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAreaTecnica filtered by the CREATION_DATE column
 * @method     ChildJobAreaTecnica findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAreaTecnica filtered by the MODIFICATION_DATE column *

 * @method     ChildJobAreaTecnica requirePk($key, ConnectionInterface $con = null) Return the ChildJobAreaTecnica by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOne(ConnectionInterface $con = null) Return the first ChildJobAreaTecnica matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAreaTecnica requireOneById(int $ID) Return the first ChildJobAreaTecnica filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByIdAreaPrincipal(int $ID_AREA_PRINCIPAL) Return the first ChildJobAreaTecnica filtered by the ID_AREA_PRINCIPAL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByNivel(int $NIVEL) Return the first ChildJobAreaTecnica filtered by the NIVEL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByNombre(string $NOMBRE) Return the first ChildJobAreaTecnica filtered by the NOMBRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByKeywords(string $KEYWORDS) Return the first ChildJobAreaTecnica filtered by the KEYWORDS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByDescripcion(string $DESCRIPCION) Return the first ChildJobAreaTecnica filtered by the DESCRIPCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByStatus(string $STATUS) Return the first ChildJobAreaTecnica filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobAreaTecnica filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAreaTecnica filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnica requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAreaTecnica filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAreaTecnica[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobAreaTecnica objects based on current ModelCriteria
 * @method     ChildJobAreaTecnica[]|ObjectCollection findById(int $ID) Return ChildJobAreaTecnica objects filtered by the ID column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByIdAreaPrincipal(int $ID_AREA_PRINCIPAL) Return ChildJobAreaTecnica objects filtered by the ID_AREA_PRINCIPAL column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByNivel(int $NIVEL) Return ChildJobAreaTecnica objects filtered by the NIVEL column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByNombre(string $NOMBRE) Return ChildJobAreaTecnica objects filtered by the NOMBRE column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByKeywords(string $KEYWORDS) Return ChildJobAreaTecnica objects filtered by the KEYWORDS column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByDescripcion(string $DESCRIPCION) Return ChildJobAreaTecnica objects filtered by the DESCRIPCION column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobAreaTecnica objects filtered by the STATUS column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobAreaTecnica objects filtered by the LAST_USER_ID column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobAreaTecnica objects filtered by the CREATION_DATE column
 * @method     ChildJobAreaTecnica[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobAreaTecnica objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobAreaTecnica[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobAreaTecnicaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobAreaTecnicaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobAreaTecnica', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobAreaTecnicaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobAreaTecnicaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobAreaTecnicaQuery) {
            return $criteria;
        }
        $query = new ChildJobAreaTecnicaQuery();
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
     * @return ChildJobAreaTecnica|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobAreaTecnicaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJobAreaTecnica A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_AREA_PRINCIPAL, NIVEL, NOMBRE, KEYWORDS, DESCRIPCION, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_area_tecnica WHERE ID = :p0';
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
            /** @var ChildJobAreaTecnica $obj */
            $obj = new ChildJobAreaTecnica();
            $obj->hydrate($row);
            JobAreaTecnicaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobAreaTecnica|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_AREA_PRINCIPAL column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAreaPrincipal(1234); // WHERE ID_AREA_PRINCIPAL = 1234
     * $query->filterByIdAreaPrincipal(array(12, 34)); // WHERE ID_AREA_PRINCIPAL IN (12, 34)
     * $query->filterByIdAreaPrincipal(array('min' => 12)); // WHERE ID_AREA_PRINCIPAL > 12
     * </code>
     *
     * @param     mixed $idAreaPrincipal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByIdAreaPrincipal($idAreaPrincipal = null, $comparison = null)
    {
        if (is_array($idAreaPrincipal)) {
            $useMinMax = false;
            if (isset($idAreaPrincipal['min'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL, $idAreaPrincipal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAreaPrincipal['max'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL, $idAreaPrincipal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL, $idAreaPrincipal, $comparison);
    }

    /**
     * Filter the query on the NIVEL column
     *
     * Example usage:
     * <code>
     * $query->filterByNivel(1234); // WHERE NIVEL = 1234
     * $query->filterByNivel(array(12, 34)); // WHERE NIVEL IN (12, 34)
     * $query->filterByNivel(array('min' => 12)); // WHERE NIVEL > 12
     * </code>
     *
     * @param     mixed $nivel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByNivel($nivel = null, $comparison = null)
    {
        if (is_array($nivel)) {
            $useMinMax = false;
            if (isset($nivel['min'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_NIVEL, $nivel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nivel['max'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_NIVEL, $nivel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_NIVEL, $nivel, $comparison);
    }

    /**
     * Filter the query on the NOMBRE column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE NOMBRE = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE NOMBRE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the KEYWORDS column
     *
     * Example usage:
     * <code>
     * $query->filterByKeywords('fooValue');   // WHERE KEYWORDS = 'fooValue'
     * $query->filterByKeywords('%fooValue%', Criteria::LIKE); // WHERE KEYWORDS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $keywords The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByKeywords($keywords = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($keywords)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_KEYWORDS, $keywords, $comparison);
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
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_DESCRIPCION, $descripcion, $comparison);
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
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobAreaTecnicaTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobAreaRelacionada object
     *
     * @param \JobAreaRelacionada|ObjectCollection $jobAreaRelacionada the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByJobAreaRelacionadaRelatedByIdArea1($jobAreaRelacionada, $comparison = null)
    {
        if ($jobAreaRelacionada instanceof \JobAreaRelacionada) {
            return $this
                ->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $jobAreaRelacionada->getIdArea1(), $comparison);
        } elseif ($jobAreaRelacionada instanceof ObjectCollection) {
            return $this
                ->useJobAreaRelacionadaRelatedByIdArea1Query()
                ->filterByPrimaryKeys($jobAreaRelacionada->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobAreaRelacionadaRelatedByIdArea1() only accepts arguments of type \JobAreaRelacionada or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea1 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function joinJobAreaRelacionadaRelatedByIdArea1($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAreaRelacionadaRelatedByIdArea1');

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
            $this->addJoinObject($join, 'JobAreaRelacionadaRelatedByIdArea1');
        }

        return $this;
    }

    /**
     * Use the JobAreaRelacionadaRelatedByIdArea1 relation JobAreaRelacionada object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaRelacionadaQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaRelacionadaRelatedByIdArea1Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAreaRelacionadaRelatedByIdArea1($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaRelacionadaRelatedByIdArea1', '\JobAreaRelacionadaQuery');
    }

    /**
     * Filter the query by a related \JobAreaRelacionada object
     *
     * @param \JobAreaRelacionada|ObjectCollection $jobAreaRelacionada the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByJobAreaRelacionadaRelatedByIdArea2($jobAreaRelacionada, $comparison = null)
    {
        if ($jobAreaRelacionada instanceof \JobAreaRelacionada) {
            return $this
                ->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $jobAreaRelacionada->getIdArea2(), $comparison);
        } elseif ($jobAreaRelacionada instanceof ObjectCollection) {
            return $this
                ->useJobAreaRelacionadaRelatedByIdArea2Query()
                ->filterByPrimaryKeys($jobAreaRelacionada->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobAreaRelacionadaRelatedByIdArea2() only accepts arguments of type \JobAreaRelacionada or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAreaRelacionadaRelatedByIdArea2 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function joinJobAreaRelacionadaRelatedByIdArea2($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAreaRelacionadaRelatedByIdArea2');

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
            $this->addJoinObject($join, 'JobAreaRelacionadaRelatedByIdArea2');
        }

        return $this;
    }

    /**
     * Use the JobAreaRelacionadaRelatedByIdArea2 relation JobAreaRelacionada object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaRelacionadaQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaRelacionadaRelatedByIdArea2Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAreaRelacionadaRelatedByIdArea2($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaRelacionadaRelatedByIdArea2', '\JobAreaRelacionadaQuery');
    }

    /**
     * Filter the query by a related \JobAreaTecnicaProfesion object
     *
     * @param \JobAreaTecnicaProfesion|ObjectCollection $jobAreaTecnicaProfesion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByJobAreaTecnicaProfesion($jobAreaTecnicaProfesion, $comparison = null)
    {
        if ($jobAreaTecnicaProfesion instanceof \JobAreaTecnicaProfesion) {
            return $this
                ->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $jobAreaTecnicaProfesion->getIdAreaTecnica(), $comparison);
        } elseif ($jobAreaTecnicaProfesion instanceof ObjectCollection) {
            return $this
                ->useJobAreaTecnicaProfesionQuery()
                ->filterByPrimaryKeys($jobAreaTecnicaProfesion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobAreaTecnicaProfesion() only accepts arguments of type \JobAreaTecnicaProfesion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAreaTecnicaProfesion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function joinJobAreaTecnicaProfesion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAreaTecnicaProfesion');

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
            $this->addJoinObject($join, 'JobAreaTecnicaProfesion');
        }

        return $this;
    }

    /**
     * Use the JobAreaTecnicaProfesion relation JobAreaTecnicaProfesion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaTecnicaProfesionQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaTecnicaProfesionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAreaTecnicaProfesion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaTecnicaProfesion', '\JobAreaTecnicaProfesionQuery');
    }

    /**
     * Filter the query by a related \JobAviso object
     *
     * @param \JobAviso|ObjectCollection $jobAviso the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function filterByJobAviso($jobAviso, $comparison = null)
    {
        if ($jobAviso instanceof \JobAviso) {
            return $this
                ->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $jobAviso->getAreaTecnicaId(), $comparison);
        } elseif ($jobAviso instanceof ObjectCollection) {
            return $this
                ->useJobAvisoQuery()
                ->filterByPrimaryKeys($jobAviso->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobAviso() only accepts arguments of type \JobAviso or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAviso relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function joinJobAviso($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAviso');

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
            $this->addJoinObject($join, 'JobAviso');
        }

        return $this;
    }

    /**
     * Use the JobAviso relation JobAviso object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAvisoQuery A secondary query class using the current class as primary query
     */
    public function useJobAvisoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJobAviso($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAviso', '\JobAvisoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobAreaTecnica $jobAreaTecnica Object to remove from the list of results
     *
     * @return $this|ChildJobAreaTecnicaQuery The current query, for fluid interface
     */
    public function prune($jobAreaTecnica = null)
    {
        if ($jobAreaTecnica) {
            $this->addUsingAlias(JobAreaTecnicaTableMap::COL_ID, $jobAreaTecnica->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_area_tecnica table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobAreaTecnicaTableMap::clearInstancePool();
            JobAreaTecnicaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobAreaTecnicaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobAreaTecnicaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobAreaTecnicaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobAreaTecnicaQuery
