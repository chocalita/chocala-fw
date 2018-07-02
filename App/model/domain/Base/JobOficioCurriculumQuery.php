<?php

namespace Base;

use \JobOficioCurriculum as ChildJobOficioCurriculum;
use \JobOficioCurriculumQuery as ChildJobOficioCurriculumQuery;
use \Exception;
use \PDO;
use Map\JobOficioCurriculumTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_oficio_curriculum' table.
 *
 *
 *
 * @method     ChildJobOficioCurriculumQuery orderByIdOficio($order = Criteria::ASC) Order by the ID_OFICIO column
 * @method     ChildJobOficioCurriculumQuery orderByIdCurriculum($order = Criteria::ASC) Order by the ID_CURRICULUM column
 * @method     ChildJobOficioCurriculumQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobOficioCurriculumQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobOficioCurriculumQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobOficioCurriculumQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobOficioCurriculumQuery groupByIdOficio() Group by the ID_OFICIO column
 * @method     ChildJobOficioCurriculumQuery groupByIdCurriculum() Group by the ID_CURRICULUM column
 * @method     ChildJobOficioCurriculumQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobOficioCurriculumQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobOficioCurriculumQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobOficioCurriculumQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobOficioCurriculumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobOficioCurriculumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobOficioCurriculumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobOficioCurriculumQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobOficioCurriculumQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobOficioCurriculumQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobOficioCurriculumQuery leftJoinJobCurriculum($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobCurriculum relation
 * @method     ChildJobOficioCurriculumQuery rightJoinJobCurriculum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobCurriculum relation
 * @method     ChildJobOficioCurriculumQuery innerJoinJobCurriculum($relationAlias = null) Adds a INNER JOIN clause to the query using the JobCurriculum relation
 *
 * @method     ChildJobOficioCurriculumQuery joinWithJobCurriculum($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobCurriculum relation
 *
 * @method     ChildJobOficioCurriculumQuery leftJoinWithJobCurriculum() Adds a LEFT JOIN clause and with to the query using the JobCurriculum relation
 * @method     ChildJobOficioCurriculumQuery rightJoinWithJobCurriculum() Adds a RIGHT JOIN clause and with to the query using the JobCurriculum relation
 * @method     ChildJobOficioCurriculumQuery innerJoinWithJobCurriculum() Adds a INNER JOIN clause and with to the query using the JobCurriculum relation
 *
 * @method     ChildJobOficioCurriculumQuery leftJoinJobOficio($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobOficio relation
 * @method     ChildJobOficioCurriculumQuery rightJoinJobOficio($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobOficio relation
 * @method     ChildJobOficioCurriculumQuery innerJoinJobOficio($relationAlias = null) Adds a INNER JOIN clause to the query using the JobOficio relation
 *
 * @method     ChildJobOficioCurriculumQuery joinWithJobOficio($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobOficio relation
 *
 * @method     ChildJobOficioCurriculumQuery leftJoinWithJobOficio() Adds a LEFT JOIN clause and with to the query using the JobOficio relation
 * @method     ChildJobOficioCurriculumQuery rightJoinWithJobOficio() Adds a RIGHT JOIN clause and with to the query using the JobOficio relation
 * @method     ChildJobOficioCurriculumQuery innerJoinWithJobOficio() Adds a INNER JOIN clause and with to the query using the JobOficio relation
 *
 * @method     \JobCurriculumQuery|\JobOficioQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobOficioCurriculum findOne(ConnectionInterface $con = null) Return the first ChildJobOficioCurriculum matching the query
 * @method     ChildJobOficioCurriculum findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobOficioCurriculum matching the query, or a new ChildJobOficioCurriculum object populated from the query conditions when no match is found
 *
 * @method     ChildJobOficioCurriculum findOneByIdOficio(int $ID_OFICIO) Return the first ChildJobOficioCurriculum filtered by the ID_OFICIO column
 * @method     ChildJobOficioCurriculum findOneByIdCurriculum(int $ID_CURRICULUM) Return the first ChildJobOficioCurriculum filtered by the ID_CURRICULUM column
 * @method     ChildJobOficioCurriculum findOneByStatus(string $STATUS) Return the first ChildJobOficioCurriculum filtered by the STATUS column
 * @method     ChildJobOficioCurriculum findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobOficioCurriculum filtered by the LAST_USER_ID column
 * @method     ChildJobOficioCurriculum findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobOficioCurriculum filtered by the CREATION_DATE column
 * @method     ChildJobOficioCurriculum findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobOficioCurriculum filtered by the MODIFICATION_DATE column *

 * @method     ChildJobOficioCurriculum requirePk($key, ConnectionInterface $con = null) Return the ChildJobOficioCurriculum by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficioCurriculum requireOne(ConnectionInterface $con = null) Return the first ChildJobOficioCurriculum matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobOficioCurriculum requireOneByIdOficio(int $ID_OFICIO) Return the first ChildJobOficioCurriculum filtered by the ID_OFICIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficioCurriculum requireOneByIdCurriculum(int $ID_CURRICULUM) Return the first ChildJobOficioCurriculum filtered by the ID_CURRICULUM column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficioCurriculum requireOneByStatus(string $STATUS) Return the first ChildJobOficioCurriculum filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficioCurriculum requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobOficioCurriculum filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficioCurriculum requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobOficioCurriculum filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficioCurriculum requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobOficioCurriculum filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobOficioCurriculum[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobOficioCurriculum objects based on current ModelCriteria
 * @method     ChildJobOficioCurriculum[]|ObjectCollection findByIdOficio(int $ID_OFICIO) Return ChildJobOficioCurriculum objects filtered by the ID_OFICIO column
 * @method     ChildJobOficioCurriculum[]|ObjectCollection findByIdCurriculum(int $ID_CURRICULUM) Return ChildJobOficioCurriculum objects filtered by the ID_CURRICULUM column
 * @method     ChildJobOficioCurriculum[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobOficioCurriculum objects filtered by the STATUS column
 * @method     ChildJobOficioCurriculum[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobOficioCurriculum objects filtered by the LAST_USER_ID column
 * @method     ChildJobOficioCurriculum[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobOficioCurriculum objects filtered by the CREATION_DATE column
 * @method     ChildJobOficioCurriculum[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobOficioCurriculum objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobOficioCurriculum[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobOficioCurriculumQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobOficioCurriculumQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobOficioCurriculum', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobOficioCurriculumQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobOficioCurriculumQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobOficioCurriculumQuery) {
            return $criteria;
        }
        $query = new ChildJobOficioCurriculumQuery();
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
     * @param array[$ID_OFICIO, $ID_CURRICULUM] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildJobOficioCurriculum|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobOficioCurriculumTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobOficioCurriculumTableMap::DATABASE_NAME);
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
     * @return ChildJobOficioCurriculum A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_OFICIO, ID_CURRICULUM, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_oficio_curriculum WHERE ID_OFICIO = :p0 AND ID_CURRICULUM = :p1';
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
            /** @var ChildJobOficioCurriculum $obj */
            $obj = new ChildJobOficioCurriculum();
            $obj->hydrate($row);
            JobOficioCurriculumTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildJobOficioCurriculum|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_OFICIO, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_CURRICULUM, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JobOficioCurriculumTableMap::COL_ID_OFICIO, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JobOficioCurriculumTableMap::COL_ID_CURRICULUM, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the ID_OFICIO column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOficio(1234); // WHERE ID_OFICIO = 1234
     * $query->filterByIdOficio(array(12, 34)); // WHERE ID_OFICIO IN (12, 34)
     * $query->filterByIdOficio(array('min' => 12)); // WHERE ID_OFICIO > 12
     * </code>
     *
     * @see       filterByJobOficio()
     *
     * @param     mixed $idOficio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByIdOficio($idOficio = null, $comparison = null)
    {
        if (is_array($idOficio)) {
            $useMinMax = false;
            if (isset($idOficio['min'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_OFICIO, $idOficio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOficio['max'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_OFICIO, $idOficio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_OFICIO, $idOficio, $comparison);
    }

    /**
     * Filter the query on the ID_CURRICULUM column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCurriculum(1234); // WHERE ID_CURRICULUM = 1234
     * $query->filterByIdCurriculum(array(12, 34)); // WHERE ID_CURRICULUM IN (12, 34)
     * $query->filterByIdCurriculum(array('min' => 12)); // WHERE ID_CURRICULUM > 12
     * </code>
     *
     * @see       filterByJobCurriculum()
     *
     * @param     mixed $idCurriculum The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByIdCurriculum($idCurriculum = null, $comparison = null)
    {
        if (is_array($idCurriculum)) {
            $useMinMax = false;
            if (isset($idCurriculum['min'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_CURRICULUM, $idCurriculum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCurriculum['max'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_CURRICULUM, $idCurriculum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_CURRICULUM, $idCurriculum, $comparison);
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE STATUS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobOficioCurriculumTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioCurriculumTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioCurriculumTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobOficioCurriculumTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioCurriculumTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobCurriculum object
     *
     * @param \JobCurriculum|ObjectCollection $jobCurriculum The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByJobCurriculum($jobCurriculum, $comparison = null)
    {
        if ($jobCurriculum instanceof \JobCurriculum) {
            return $this
                ->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_CURRICULUM, $jobCurriculum->getId(), $comparison);
        } elseif ($jobCurriculum instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_CURRICULUM, $jobCurriculum->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobCurriculum() only accepts arguments of type \JobCurriculum or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobCurriculum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function joinJobCurriculum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobCurriculum');

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
            $this->addJoinObject($join, 'JobCurriculum');
        }

        return $this;
    }

    /**
     * Use the JobCurriculum relation JobCurriculum object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobCurriculumQuery A secondary query class using the current class as primary query
     */
    public function useJobCurriculumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobCurriculum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobCurriculum', '\JobCurriculumQuery');
    }

    /**
     * Filter the query by a related \JobOficio object
     *
     * @param \JobOficio|ObjectCollection $jobOficio The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function filterByJobOficio($jobOficio, $comparison = null)
    {
        if ($jobOficio instanceof \JobOficio) {
            return $this
                ->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_OFICIO, $jobOficio->getId(), $comparison);
        } elseif ($jobOficio instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobOficioCurriculumTableMap::COL_ID_OFICIO, $jobOficio->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobOficio() only accepts arguments of type \JobOficio or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobOficio relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function joinJobOficio($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobOficio');

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
            $this->addJoinObject($join, 'JobOficio');
        }

        return $this;
    }

    /**
     * Use the JobOficio relation JobOficio object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobOficioQuery A secondary query class using the current class as primary query
     */
    public function useJobOficioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobOficio($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobOficio', '\JobOficioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobOficioCurriculum $jobOficioCurriculum Object to remove from the list of results
     *
     * @return $this|ChildJobOficioCurriculumQuery The current query, for fluid interface
     */
    public function prune($jobOficioCurriculum = null)
    {
        if ($jobOficioCurriculum) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JobOficioCurriculumTableMap::COL_ID_OFICIO), $jobOficioCurriculum->getIdOficio(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JobOficioCurriculumTableMap::COL_ID_CURRICULUM), $jobOficioCurriculum->getIdCurriculum(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_oficio_curriculum table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobOficioCurriculumTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobOficioCurriculumTableMap::clearInstancePool();
            JobOficioCurriculumTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobOficioCurriculumTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobOficioCurriculumTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobOficioCurriculumTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobOficioCurriculumTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobOficioCurriculumQuery
