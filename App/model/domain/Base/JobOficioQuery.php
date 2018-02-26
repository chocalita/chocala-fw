<?php

namespace Base;

use \JobOficio as ChildJobOficio;
use \JobOficioQuery as ChildJobOficioQuery;
use \Exception;
use \PDO;
use Map\JobOficioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_oficio' table.
 *
 *
 *
 * @method     ChildJobOficioQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobOficioQuery orderByNombre($order = Criteria::ASC) Order by the NOMBRE column
 * @method     ChildJobOficioQuery orderByDescripcion($order = Criteria::ASC) Order by the DESCRIPCION column
 * @method     ChildJobOficioQuery orderByVerificado($order = Criteria::ASC) Order by the VERIFICADO column
 * @method     ChildJobOficioQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobOficioQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobOficioQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobOficioQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobOficioQuery groupById() Group by the ID column
 * @method     ChildJobOficioQuery groupByNombre() Group by the NOMBRE column
 * @method     ChildJobOficioQuery groupByDescripcion() Group by the DESCRIPCION column
 * @method     ChildJobOficioQuery groupByVerificado() Group by the VERIFICADO column
 * @method     ChildJobOficioQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobOficioQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobOficioQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobOficioQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobOficioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobOficioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobOficioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobOficioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobOficioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobOficioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobOficioQuery leftJoinJobOficioCurriculum($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobOficioCurriculum relation
 * @method     ChildJobOficioQuery rightJoinJobOficioCurriculum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobOficioCurriculum relation
 * @method     ChildJobOficioQuery innerJoinJobOficioCurriculum($relationAlias = null) Adds a INNER JOIN clause to the query using the JobOficioCurriculum relation
 *
 * @method     ChildJobOficioQuery joinWithJobOficioCurriculum($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobOficioCurriculum relation
 *
 * @method     ChildJobOficioQuery leftJoinWithJobOficioCurriculum() Adds a LEFT JOIN clause and with to the query using the JobOficioCurriculum relation
 * @method     ChildJobOficioQuery rightJoinWithJobOficioCurriculum() Adds a RIGHT JOIN clause and with to the query using the JobOficioCurriculum relation
 * @method     ChildJobOficioQuery innerJoinWithJobOficioCurriculum() Adds a INNER JOIN clause and with to the query using the JobOficioCurriculum relation
 *
 * @method     \JobOficioCurriculumQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobOficio findOne(ConnectionInterface $con = null) Return the first ChildJobOficio matching the query
 * @method     ChildJobOficio findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobOficio matching the query, or a new ChildJobOficio object populated from the query conditions when no match is found
 *
 * @method     ChildJobOficio findOneById(int $ID) Return the first ChildJobOficio filtered by the ID column
 * @method     ChildJobOficio findOneByNombre(string $NOMBRE) Return the first ChildJobOficio filtered by the NOMBRE column
 * @method     ChildJobOficio findOneByDescripcion(string $DESCRIPCION) Return the first ChildJobOficio filtered by the DESCRIPCION column
 * @method     ChildJobOficio findOneByVerificado(boolean $VERIFICADO) Return the first ChildJobOficio filtered by the VERIFICADO column
 * @method     ChildJobOficio findOneByStatus(string $STATUS) Return the first ChildJobOficio filtered by the STATUS column
 * @method     ChildJobOficio findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobOficio filtered by the LAST_USER_ID column
 * @method     ChildJobOficio findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobOficio filtered by the CREATION_DATE column
 * @method     ChildJobOficio findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobOficio filtered by the MODIFICATION_DATE column *

 * @method     ChildJobOficio requirePk($key, ConnectionInterface $con = null) Return the ChildJobOficio by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOne(ConnectionInterface $con = null) Return the first ChildJobOficio matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobOficio requireOneById(int $ID) Return the first ChildJobOficio filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOneByNombre(string $NOMBRE) Return the first ChildJobOficio filtered by the NOMBRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOneByDescripcion(string $DESCRIPCION) Return the first ChildJobOficio filtered by the DESCRIPCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOneByVerificado(boolean $VERIFICADO) Return the first ChildJobOficio filtered by the VERIFICADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOneByStatus(string $STATUS) Return the first ChildJobOficio filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobOficio filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobOficio filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobOficio requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobOficio filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobOficio[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobOficio objects based on current ModelCriteria
 * @method     ChildJobOficio[]|ObjectCollection findById(int $ID) Return ChildJobOficio objects filtered by the ID column
 * @method     ChildJobOficio[]|ObjectCollection findByNombre(string $NOMBRE) Return ChildJobOficio objects filtered by the NOMBRE column
 * @method     ChildJobOficio[]|ObjectCollection findByDescripcion(string $DESCRIPCION) Return ChildJobOficio objects filtered by the DESCRIPCION column
 * @method     ChildJobOficio[]|ObjectCollection findByVerificado(boolean $VERIFICADO) Return ChildJobOficio objects filtered by the VERIFICADO column
 * @method     ChildJobOficio[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobOficio objects filtered by the STATUS column
 * @method     ChildJobOficio[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobOficio objects filtered by the LAST_USER_ID column
 * @method     ChildJobOficio[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobOficio objects filtered by the CREATION_DATE column
 * @method     ChildJobOficio[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobOficio objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobOficio[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobOficioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobOficioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobOficio', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobOficioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobOficioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobOficioQuery) {
            return $criteria;
        }
        $query = new ChildJobOficioQuery();
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
     * @return ChildJobOficio|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobOficioTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobOficioTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJobOficio A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, NOMBRE, DESCRIPCION, VERIFICADO, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_oficio WHERE ID = :p0';
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
            /** @var ChildJobOficio $obj */
            $obj = new ChildJobOficio();
            $obj->hydrate($row);
            JobOficioTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobOficio|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobOficioTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobOficioTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_NOMBRE, $nombre, $comparison);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the VERIFICADO column
     *
     * Example usage:
     * <code>
     * $query->filterByVerificado(true); // WHERE VERIFICADO = true
     * $query->filterByVerificado('yes'); // WHERE VERIFICADO = true
     * </code>
     *
     * @param     boolean|string $verificado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByVerificado($verificado = null, $comparison = null)
    {
        if (is_string($verificado)) {
            $verificado = in_array(strtolower($verificado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_VERIFICADO, $verificado, $comparison);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobOficioTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobOficioTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobOficioCurriculum object
     *
     * @param \JobOficioCurriculum|ObjectCollection $jobOficioCurriculum the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobOficioQuery The current query, for fluid interface
     */
    public function filterByJobOficioCurriculum($jobOficioCurriculum, $comparison = null)
    {
        if ($jobOficioCurriculum instanceof \JobOficioCurriculum) {
            return $this
                ->addUsingAlias(JobOficioTableMap::COL_ID, $jobOficioCurriculum->getIdOficio(), $comparison);
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
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
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
     * @param   ChildJobOficio $jobOficio Object to remove from the list of results
     *
     * @return $this|ChildJobOficioQuery The current query, for fluid interface
     */
    public function prune($jobOficio = null)
    {
        if ($jobOficio) {
            $this->addUsingAlias(JobOficioTableMap::COL_ID, $jobOficio->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_oficio table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobOficioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobOficioTableMap::clearInstancePool();
            JobOficioTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobOficioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobOficioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobOficioTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobOficioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobOficioQuery
