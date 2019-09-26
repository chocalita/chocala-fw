<?php

namespace Base;

use \JobAreaRelacionada as ChildJobAreaRelacionada;
use \JobAreaRelacionadaQuery as ChildJobAreaRelacionadaQuery;
use \Exception;
use \PDO;
use Map\JobAreaRelacionadaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_area_relacionada' table.
 *
 *
 *
 * @method     ChildJobAreaRelacionadaQuery orderByIdArea1($order = Criteria::ASC) Order by the ID_AREA_1 column
 * @method     ChildJobAreaRelacionadaQuery orderByIdArea2($order = Criteria::ASC) Order by the ID_AREA_2 column
 * @method     ChildJobAreaRelacionadaQuery orderByNivel($order = Criteria::ASC) Order by the NIVEL column
 * @method     ChildJobAreaRelacionadaQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobAreaRelacionadaQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobAreaRelacionadaQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobAreaRelacionadaQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobAreaRelacionadaQuery groupByIdArea1() Group by the ID_AREA_1 column
 * @method     ChildJobAreaRelacionadaQuery groupByIdArea2() Group by the ID_AREA_2 column
 * @method     ChildJobAreaRelacionadaQuery groupByNivel() Group by the NIVEL column
 * @method     ChildJobAreaRelacionadaQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobAreaRelacionadaQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobAreaRelacionadaQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobAreaRelacionadaQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobAreaRelacionadaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobAreaRelacionadaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobAreaRelacionadaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobAreaRelacionadaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobAreaRelacionadaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobAreaRelacionadaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobAreaRelacionadaQuery leftJoinJobAreaTecnicaRelatedByIdArea1($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea1 relation
 * @method     ChildJobAreaRelacionadaQuery rightJoinJobAreaTecnicaRelatedByIdArea1($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea1 relation
 * @method     ChildJobAreaRelacionadaQuery innerJoinJobAreaTecnicaRelatedByIdArea1($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea1 relation
 *
 * @method     ChildJobAreaRelacionadaQuery joinWithJobAreaTecnicaRelatedByIdArea1($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAreaTecnicaRelatedByIdArea1 relation
 *
 * @method     ChildJobAreaRelacionadaQuery leftJoinWithJobAreaTecnicaRelatedByIdArea1() Adds a LEFT JOIN clause and with to the query using the JobAreaTecnicaRelatedByIdArea1 relation
 * @method     ChildJobAreaRelacionadaQuery rightJoinWithJobAreaTecnicaRelatedByIdArea1() Adds a RIGHT JOIN clause and with to the query using the JobAreaTecnicaRelatedByIdArea1 relation
 * @method     ChildJobAreaRelacionadaQuery innerJoinWithJobAreaTecnicaRelatedByIdArea1() Adds a INNER JOIN clause and with to the query using the JobAreaTecnicaRelatedByIdArea1 relation
 *
 * @method     ChildJobAreaRelacionadaQuery leftJoinJobAreaTecnicaRelatedByIdArea2($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea2 relation
 * @method     ChildJobAreaRelacionadaQuery rightJoinJobAreaTecnicaRelatedByIdArea2($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea2 relation
 * @method     ChildJobAreaRelacionadaQuery innerJoinJobAreaTecnicaRelatedByIdArea2($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea2 relation
 *
 * @method     ChildJobAreaRelacionadaQuery joinWithJobAreaTecnicaRelatedByIdArea2($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAreaTecnicaRelatedByIdArea2 relation
 *
 * @method     ChildJobAreaRelacionadaQuery leftJoinWithJobAreaTecnicaRelatedByIdArea2() Adds a LEFT JOIN clause and with to the query using the JobAreaTecnicaRelatedByIdArea2 relation
 * @method     ChildJobAreaRelacionadaQuery rightJoinWithJobAreaTecnicaRelatedByIdArea2() Adds a RIGHT JOIN clause and with to the query using the JobAreaTecnicaRelatedByIdArea2 relation
 * @method     ChildJobAreaRelacionadaQuery innerJoinWithJobAreaTecnicaRelatedByIdArea2() Adds a INNER JOIN clause and with to the query using the JobAreaTecnicaRelatedByIdArea2 relation
 *
 * @method     \JobAreaTecnicaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobAreaRelacionada findOne(ConnectionInterface $con = null) Return the first ChildJobAreaRelacionada matching the query
 * @method     ChildJobAreaRelacionada findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobAreaRelacionada matching the query, or a new ChildJobAreaRelacionada object populated from the query conditions when no match is found
 *
 * @method     ChildJobAreaRelacionada findOneByIdArea1(int $ID_AREA_1) Return the first ChildJobAreaRelacionada filtered by the ID_AREA_1 column
 * @method     ChildJobAreaRelacionada findOneByIdArea2(int $ID_AREA_2) Return the first ChildJobAreaRelacionada filtered by the ID_AREA_2 column
 * @method     ChildJobAreaRelacionada findOneByNivel(int $NIVEL) Return the first ChildJobAreaRelacionada filtered by the NIVEL column
 * @method     ChildJobAreaRelacionada findOneByStatus(string $STATUS) Return the first ChildJobAreaRelacionada filtered by the STATUS column
 * @method     ChildJobAreaRelacionada findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobAreaRelacionada filtered by the LAST_USER_ID column
 * @method     ChildJobAreaRelacionada findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAreaRelacionada filtered by the CREATION_DATE column
 * @method     ChildJobAreaRelacionada findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAreaRelacionada filtered by the MODIFICATION_DATE column *

 * @method     ChildJobAreaRelacionada requirePk($key, ConnectionInterface $con = null) Return the ChildJobAreaRelacionada by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaRelacionada requireOne(ConnectionInterface $con = null) Return the first ChildJobAreaRelacionada matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAreaRelacionada requireOneByIdArea1(int $ID_AREA_1) Return the first ChildJobAreaRelacionada filtered by the ID_AREA_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaRelacionada requireOneByIdArea2(int $ID_AREA_2) Return the first ChildJobAreaRelacionada filtered by the ID_AREA_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaRelacionada requireOneByNivel(int $NIVEL) Return the first ChildJobAreaRelacionada filtered by the NIVEL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaRelacionada requireOneByStatus(string $STATUS) Return the first ChildJobAreaRelacionada filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaRelacionada requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobAreaRelacionada filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaRelacionada requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAreaRelacionada filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaRelacionada requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAreaRelacionada filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAreaRelacionada[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobAreaRelacionada objects based on current ModelCriteria
 * @method     ChildJobAreaRelacionada[]|ObjectCollection findByIdArea1(int $ID_AREA_1) Return ChildJobAreaRelacionada objects filtered by the ID_AREA_1 column
 * @method     ChildJobAreaRelacionada[]|ObjectCollection findByIdArea2(int $ID_AREA_2) Return ChildJobAreaRelacionada objects filtered by the ID_AREA_2 column
 * @method     ChildJobAreaRelacionada[]|ObjectCollection findByNivel(int $NIVEL) Return ChildJobAreaRelacionada objects filtered by the NIVEL column
 * @method     ChildJobAreaRelacionada[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobAreaRelacionada objects filtered by the STATUS column
 * @method     ChildJobAreaRelacionada[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobAreaRelacionada objects filtered by the LAST_USER_ID column
 * @method     ChildJobAreaRelacionada[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobAreaRelacionada objects filtered by the CREATION_DATE column
 * @method     ChildJobAreaRelacionada[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobAreaRelacionada objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobAreaRelacionada[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobAreaRelacionadaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobAreaRelacionadaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobAreaRelacionada', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobAreaRelacionadaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobAreaRelacionadaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobAreaRelacionadaQuery) {
            return $criteria;
        }
        $query = new ChildJobAreaRelacionadaQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$ID_AREA_1, $ID_AREA_2] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildJobAreaRelacionada|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobAreaRelacionadaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobAreaRelacionadaTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildJobAreaRelacionada A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_AREA_1, ID_AREA_2, NIVEL, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_area_relacionada WHERE ID_AREA_1 = :p0 AND ID_AREA_2 = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildJobAreaRelacionada $obj */
            $obj = new ChildJobAreaRelacionada();
            $obj->hydrate($row);
            JobAreaRelacionadaTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildJobAreaRelacionada|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_1, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_2, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JobAreaRelacionadaTableMap::COL_ID_AREA_1, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JobAreaRelacionadaTableMap::COL_ID_AREA_2, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the ID_AREA_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByIdArea1(1234); // WHERE ID_AREA_1 = 1234
     * $query->filterByIdArea1(array(12, 34)); // WHERE ID_AREA_1 IN (12, 34)
     * $query->filterByIdArea1(array('min' => 12)); // WHERE ID_AREA_1 > 12
     * </code>
     *
     * @see       filterByJobAreaTecnicaRelatedByIdArea1()
     *
     * @param     mixed $idArea1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByIdArea1($idArea1 = null, $comparison = null)
    {
        if (is_array($idArea1)) {
            $useMinMax = false;
            if (isset($idArea1['min'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_1, $idArea1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idArea1['max'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_1, $idArea1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_1, $idArea1, $comparison);
    }

    /**
     * Filter the query on the ID_AREA_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByIdArea2(1234); // WHERE ID_AREA_2 = 1234
     * $query->filterByIdArea2(array(12, 34)); // WHERE ID_AREA_2 IN (12, 34)
     * $query->filterByIdArea2(array('min' => 12)); // WHERE ID_AREA_2 > 12
     * </code>
     *
     * @see       filterByJobAreaTecnicaRelatedByIdArea2()
     *
     * @param     mixed $idArea2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByIdArea2($idArea2 = null, $comparison = null)
    {
        if (is_array($idArea2)) {
            $useMinMax = false;
            if (isset($idArea2['min'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_2, $idArea2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idArea2['max'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_2, $idArea2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_2, $idArea2, $comparison);
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
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByNivel($nivel = null, $comparison = null)
    {
        if (is_array($nivel)) {
            $useMinMax = false;
            if (isset($nivel['min'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_NIVEL, $nivel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nivel['max'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_NIVEL, $nivel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_NIVEL, $nivel, $comparison);
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
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaRelacionadaTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobAreaTecnica object
     *
     * @param \JobAreaTecnica|ObjectCollection $jobAreaTecnica The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByJobAreaTecnicaRelatedByIdArea1($jobAreaTecnica, $comparison = null)
    {
        if ($jobAreaTecnica instanceof \JobAreaTecnica) {
            return $this
                ->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_1, $jobAreaTecnica->getId(), $comparison);
        } elseif ($jobAreaTecnica instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_1, $jobAreaTecnica->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobAreaTecnicaRelatedByIdArea1() only accepts arguments of type \JobAreaTecnica or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea1 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function joinJobAreaTecnicaRelatedByIdArea1($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAreaTecnicaRelatedByIdArea1');

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
            $this->addJoinObject($join, 'JobAreaTecnicaRelatedByIdArea1');
        }

        return $this;
    }

    /**
     * Use the JobAreaTecnicaRelatedByIdArea1 relation JobAreaTecnica object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaTecnicaQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaTecnicaRelatedByIdArea1Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAreaTecnicaRelatedByIdArea1($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaTecnicaRelatedByIdArea1', '\JobAreaTecnicaQuery');
    }

    /**
     * Filter the query by a related \JobAreaTecnica object
     *
     * @param \JobAreaTecnica|ObjectCollection $jobAreaTecnica The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function filterByJobAreaTecnicaRelatedByIdArea2($jobAreaTecnica, $comparison = null)
    {
        if ($jobAreaTecnica instanceof \JobAreaTecnica) {
            return $this
                ->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_2, $jobAreaTecnica->getId(), $comparison);
        } elseif ($jobAreaTecnica instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobAreaRelacionadaTableMap::COL_ID_AREA_2, $jobAreaTecnica->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobAreaTecnicaRelatedByIdArea2() only accepts arguments of type \JobAreaTecnica or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAreaTecnicaRelatedByIdArea2 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function joinJobAreaTecnicaRelatedByIdArea2($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAreaTecnicaRelatedByIdArea2');

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
            $this->addJoinObject($join, 'JobAreaTecnicaRelatedByIdArea2');
        }

        return $this;
    }

    /**
     * Use the JobAreaTecnicaRelatedByIdArea2 relation JobAreaTecnica object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaTecnicaQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaTecnicaRelatedByIdArea2Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAreaTecnicaRelatedByIdArea2($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaTecnicaRelatedByIdArea2', '\JobAreaTecnicaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobAreaRelacionada $jobAreaRelacionada Object to remove from the list of results
     *
     * @return $this|ChildJobAreaRelacionadaQuery The current query, for fluid interface
     */
    public function prune($jobAreaRelacionada = null)
    {
        if ($jobAreaRelacionada) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JobAreaRelacionadaTableMap::COL_ID_AREA_1), $jobAreaRelacionada->getIdArea1(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JobAreaRelacionadaTableMap::COL_ID_AREA_2), $jobAreaRelacionada->getIdArea2(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_area_relacionada table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaRelacionadaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobAreaRelacionadaTableMap::clearInstancePool();
            JobAreaRelacionadaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaRelacionadaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobAreaRelacionadaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobAreaRelacionadaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobAreaRelacionadaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobAreaRelacionadaQuery
