<?php

namespace Base;

use \JobCurriculum as ChildJobCurriculum;
use \JobCurriculumQuery as ChildJobCurriculumQuery;
use \Exception;
use \PDO;
use Map\JobCurriculumTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_curriculum' table.
 *
 *
 *
 * @method     ChildJobCurriculumQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobCurriculumQuery orderByIdPersona($order = Criteria::ASC) Order by the ID_PERSONA column
 * @method     ChildJobCurriculumQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobCurriculumQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobCurriculumQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobCurriculumQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobCurriculumQuery groupById() Group by the ID column
 * @method     ChildJobCurriculumQuery groupByIdPersona() Group by the ID_PERSONA column
 * @method     ChildJobCurriculumQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobCurriculumQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobCurriculumQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobCurriculumQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobCurriculumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobCurriculumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobCurriculumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobCurriculumQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobCurriculumQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobCurriculumQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobCurriculumQuery leftJoinSysPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysPerson relation
 * @method     ChildJobCurriculumQuery rightJoinSysPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysPerson relation
 * @method     ChildJobCurriculumQuery innerJoinSysPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the SysPerson relation
 *
 * @method     ChildJobCurriculumQuery joinWithSysPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysPerson relation
 *
 * @method     ChildJobCurriculumQuery leftJoinWithSysPerson() Adds a LEFT JOIN clause and with to the query using the SysPerson relation
 * @method     ChildJobCurriculumQuery rightJoinWithSysPerson() Adds a RIGHT JOIN clause and with to the query using the SysPerson relation
 * @method     ChildJobCurriculumQuery innerJoinWithSysPerson() Adds a INNER JOIN clause and with to the query using the SysPerson relation
 *
 * @method     ChildJobCurriculumQuery leftJoinJobFormacionAcademica($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobFormacionAcademica relation
 * @method     ChildJobCurriculumQuery rightJoinJobFormacionAcademica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobFormacionAcademica relation
 * @method     ChildJobCurriculumQuery innerJoinJobFormacionAcademica($relationAlias = null) Adds a INNER JOIN clause to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobCurriculumQuery joinWithJobFormacionAcademica($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobCurriculumQuery leftJoinWithJobFormacionAcademica() Adds a LEFT JOIN clause and with to the query using the JobFormacionAcademica relation
 * @method     ChildJobCurriculumQuery rightJoinWithJobFormacionAcademica() Adds a RIGHT JOIN clause and with to the query using the JobFormacionAcademica relation
 * @method     ChildJobCurriculumQuery innerJoinWithJobFormacionAcademica() Adds a INNER JOIN clause and with to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobCurriculumQuery leftJoinJobOficioCurriculum($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobOficioCurriculum relation
 * @method     ChildJobCurriculumQuery rightJoinJobOficioCurriculum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobOficioCurriculum relation
 * @method     ChildJobCurriculumQuery innerJoinJobOficioCurriculum($relationAlias = null) Adds a INNER JOIN clause to the query using the JobOficioCurriculum relation
 *
 * @method     ChildJobCurriculumQuery joinWithJobOficioCurriculum($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobOficioCurriculum relation
 *
 * @method     ChildJobCurriculumQuery leftJoinWithJobOficioCurriculum() Adds a LEFT JOIN clause and with to the query using the JobOficioCurriculum relation
 * @method     ChildJobCurriculumQuery rightJoinWithJobOficioCurriculum() Adds a RIGHT JOIN clause and with to the query using the JobOficioCurriculum relation
 * @method     ChildJobCurriculumQuery innerJoinWithJobOficioCurriculum() Adds a INNER JOIN clause and with to the query using the JobOficioCurriculum relation
 *
 * @method     \SysPersonQuery|\JobFormacionAcademicaQuery|\JobOficioCurriculumQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobCurriculum findOne(ConnectionInterface $con = null) Return the first ChildJobCurriculum matching the query
 * @method     ChildJobCurriculum findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobCurriculum matching the query, or a new ChildJobCurriculum object populated from the query conditions when no match is found
 *
 * @method     ChildJobCurriculum findOneById(int $ID) Return the first ChildJobCurriculum filtered by the ID column
 * @method     ChildJobCurriculum findOneByIdPersona(int $ID_PERSONA) Return the first ChildJobCurriculum filtered by the ID_PERSONA column
 * @method     ChildJobCurriculum findOneByStatus(string $STATUS) Return the first ChildJobCurriculum filtered by the STATUS column
 * @method     ChildJobCurriculum findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobCurriculum filtered by the LAST_USER_ID column
 * @method     ChildJobCurriculum findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobCurriculum filtered by the CREATION_DATE column
 * @method     ChildJobCurriculum findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobCurriculum filtered by the MODIFICATION_DATE column *

 * @method     ChildJobCurriculum requirePk($key, ConnectionInterface $con = null) Return the ChildJobCurriculum by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobCurriculum requireOne(ConnectionInterface $con = null) Return the first ChildJobCurriculum matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobCurriculum requireOneById(int $ID) Return the first ChildJobCurriculum filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobCurriculum requireOneByIdPersona(int $ID_PERSONA) Return the first ChildJobCurriculum filtered by the ID_PERSONA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobCurriculum requireOneByStatus(string $STATUS) Return the first ChildJobCurriculum filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobCurriculum requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobCurriculum filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobCurriculum requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobCurriculum filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobCurriculum requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobCurriculum filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobCurriculum[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobCurriculum objects based on current ModelCriteria
 * @method     ChildJobCurriculum[]|ObjectCollection findById(int $ID) Return ChildJobCurriculum objects filtered by the ID column
 * @method     ChildJobCurriculum[]|ObjectCollection findByIdPersona(int $ID_PERSONA) Return ChildJobCurriculum objects filtered by the ID_PERSONA column
 * @method     ChildJobCurriculum[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobCurriculum objects filtered by the STATUS column
 * @method     ChildJobCurriculum[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobCurriculum objects filtered by the LAST_USER_ID column
 * @method     ChildJobCurriculum[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobCurriculum objects filtered by the CREATION_DATE column
 * @method     ChildJobCurriculum[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobCurriculum objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobCurriculum[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobCurriculumQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobCurriculumQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobCurriculum', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobCurriculumQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobCurriculumQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobCurriculumQuery) {
            return $criteria;
        }
        $query = new ChildJobCurriculumQuery();
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
     * @return ChildJobCurriculum|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobCurriculumTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobCurriculumTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJobCurriculum A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_PERSONA, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_curriculum WHERE ID = :p0';
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
            /** @var ChildJobCurriculum $obj */
            $obj = new ChildJobCurriculum();
            $obj->hydrate($row);
            JobCurriculumTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobCurriculum|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobCurriculumTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobCurriculumTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobCurriculumTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_PERSONA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPersona(1234); // WHERE ID_PERSONA = 1234
     * $query->filterByIdPersona(array(12, 34)); // WHERE ID_PERSONA IN (12, 34)
     * $query->filterByIdPersona(array('min' => 12)); // WHERE ID_PERSONA > 12
     * </code>
     *
     * @see       filterBySysPerson()
     *
     * @param     mixed $idPersona The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByIdPersona($idPersona = null, $comparison = null)
    {
        if (is_array($idPersona)) {
            $useMinMax = false;
            if (isset($idPersona['min'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_ID_PERSONA, $idPersona['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPersona['max'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_ID_PERSONA, $idPersona['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobCurriculumTableMap::COL_ID_PERSONA, $idPersona, $comparison);
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
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobCurriculumTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobCurriculumTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobCurriculumTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobCurriculumTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobCurriculumTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \SysPerson object
     *
     * @param \SysPerson|ObjectCollection $sysPerson The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterBySysPerson($sysPerson, $comparison = null)
    {
        if ($sysPerson instanceof \SysPerson) {
            return $this
                ->addUsingAlias(JobCurriculumTableMap::COL_ID_PERSONA, $sysPerson->getId(), $comparison);
        } elseif ($sysPerson instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobCurriculumTableMap::COL_ID_PERSONA, $sysPerson->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysPerson() only accepts arguments of type \SysPerson or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPerson relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function joinSysPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysPerson');

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
            $this->addJoinObject($join, 'SysPerson');
        }

        return $this;
    }

    /**
     * Use the SysPerson relation SysPerson object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysPersonQuery A secondary query class using the current class as primary query
     */
    public function useSysPersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPerson', '\SysPersonQuery');
    }

    /**
     * Filter the query by a related \JobFormacionAcademica object
     *
     * @param \JobFormacionAcademica|ObjectCollection $jobFormacionAcademica the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByJobFormacionAcademica($jobFormacionAcademica, $comparison = null)
    {
        if ($jobFormacionAcademica instanceof \JobFormacionAcademica) {
            return $this
                ->addUsingAlias(JobCurriculumTableMap::COL_ID, $jobFormacionAcademica->getIdCurriculum(), $comparison);
        } elseif ($jobFormacionAcademica instanceof ObjectCollection) {
            return $this
                ->useJobFormacionAcademicaQuery()
                ->filterByPrimaryKeys($jobFormacionAcademica->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobFormacionAcademica() only accepts arguments of type \JobFormacionAcademica or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobFormacionAcademica relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function joinJobFormacionAcademica($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobFormacionAcademica');

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
            $this->addJoinObject($join, 'JobFormacionAcademica');
        }

        return $this;
    }

    /**
     * Use the JobFormacionAcademica relation JobFormacionAcademica object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobFormacionAcademicaQuery A secondary query class using the current class as primary query
     */
    public function useJobFormacionAcademicaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobFormacionAcademica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobFormacionAcademica', '\JobFormacionAcademicaQuery');
    }

    /**
     * Filter the query by a related \JobOficioCurriculum object
     *
     * @param \JobOficioCurriculum|ObjectCollection $jobOficioCurriculum the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function filterByJobOficioCurriculum($jobOficioCurriculum, $comparison = null)
    {
        if ($jobOficioCurriculum instanceof \JobOficioCurriculum) {
            return $this
                ->addUsingAlias(JobCurriculumTableMap::COL_ID, $jobOficioCurriculum->getIdCurriculum(), $comparison);
        } elseif ($jobOficioCurriculum instanceof ObjectCollection) {
            return $this
                ->useJobOficioCurriculumQuery()
                ->filterByPrimaryKeys($jobOficioCurriculum->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobOficioCurriculum() only accepts arguments of type \JobOficioCurriculum or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobOficioCurriculum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function joinJobOficioCurriculum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobOficioCurriculum');

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
            $this->addJoinObject($join, 'JobOficioCurriculum');
        }

        return $this;
    }

    /**
     * Use the JobOficioCurriculum relation JobOficioCurriculum object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobOficioCurriculumQuery A secondary query class using the current class as primary query
     */
    public function useJobOficioCurriculumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobOficioCurriculum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobOficioCurriculum', '\JobOficioCurriculumQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobCurriculum $jobCurriculum Object to remove from the list of results
     *
     * @return $this|ChildJobCurriculumQuery The current query, for fluid interface
     */
    public function prune($jobCurriculum = null)
    {
        if ($jobCurriculum) {
            $this->addUsingAlias(JobCurriculumTableMap::COL_ID, $jobCurriculum->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_curriculum table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobCurriculumTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobCurriculumTableMap::clearInstancePool();
            JobCurriculumTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobCurriculumTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobCurriculumTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobCurriculumTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobCurriculumTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobCurriculumQuery
