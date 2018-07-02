<?php

namespace Base;

use \JobUserEmpresaSuscrita as ChildJobUserEmpresaSuscrita;
use \JobUserEmpresaSuscritaQuery as ChildJobUserEmpresaSuscritaQuery;
use \Exception;
use \PDO;
use Map\JobUserEmpresaSuscritaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_user_empresa_suscrita' table.
 *
 *
 *
 * @method     ChildJobUserEmpresaSuscritaQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobUserEmpresaSuscritaQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery orderByEmpresaSuscritaId($order = Criteria::ASC) Order by the EMPRESA_SUSCRITA_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery orderByRolId($order = Criteria::ASC) Order by the ROL_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery orderByActive($order = Criteria::ASC) Order by the ACTIVE column
 * @method     ChildJobUserEmpresaSuscritaQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobUserEmpresaSuscritaQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobUserEmpresaSuscritaQuery groupById() Group by the ID column
 * @method     ChildJobUserEmpresaSuscritaQuery groupByUserId() Group by the USER_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery groupByEmpresaSuscritaId() Group by the EMPRESA_SUSCRITA_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery groupByRolId() Group by the ROL_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery groupByActive() Group by the ACTIVE column
 * @method     ChildJobUserEmpresaSuscritaQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobUserEmpresaSuscritaQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobUserEmpresaSuscritaQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoinJobEmpresaSuscrita($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobEmpresaSuscrita relation
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoinJobEmpresaSuscrita($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobEmpresaSuscrita relation
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoinJobEmpresaSuscrita($relationAlias = null) Adds a INNER JOIN clause to the query using the JobEmpresaSuscrita relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery joinWithJobEmpresaSuscrita($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobEmpresaSuscrita relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoinWithJobEmpresaSuscrita() Adds a LEFT JOIN clause and with to the query using the JobEmpresaSuscrita relation
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoinWithJobEmpresaSuscrita() Adds a RIGHT JOIN clause and with to the query using the JobEmpresaSuscrita relation
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoinWithJobEmpresaSuscrita() Adds a INNER JOIN clause and with to the query using the JobEmpresaSuscrita relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoinSysRol($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRol relation
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoinSysRol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRol relation
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoinSysRol($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRol relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery joinWithSysRol($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysRol relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoinWithSysRol() Adds a LEFT JOIN clause and with to the query using the SysRol relation
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoinWithSysRol() Adds a RIGHT JOIN clause and with to the query using the SysRol relation
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoinWithSysRol() Adds a INNER JOIN clause and with to the query using the SysRol relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery joinWithSysUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUser relation
 *
 * @method     ChildJobUserEmpresaSuscritaQuery leftJoinWithSysUser() Adds a LEFT JOIN clause and with to the query using the SysUser relation
 * @method     ChildJobUserEmpresaSuscritaQuery rightJoinWithSysUser() Adds a RIGHT JOIN clause and with to the query using the SysUser relation
 * @method     ChildJobUserEmpresaSuscritaQuery innerJoinWithSysUser() Adds a INNER JOIN clause and with to the query using the SysUser relation
 *
 * @method     \JobEmpresaSuscritaQuery|\SysRolQuery|\SysUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobUserEmpresaSuscrita findOne(ConnectionInterface $con = null) Return the first ChildJobUserEmpresaSuscrita matching the query
 * @method     ChildJobUserEmpresaSuscrita findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobUserEmpresaSuscrita matching the query, or a new ChildJobUserEmpresaSuscrita object populated from the query conditions when no match is found
 *
 * @method     ChildJobUserEmpresaSuscrita findOneById(int $ID) Return the first ChildJobUserEmpresaSuscrita filtered by the ID column
 * @method     ChildJobUserEmpresaSuscrita findOneByUserId(int $USER_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the USER_ID column
 * @method     ChildJobUserEmpresaSuscrita findOneByEmpresaSuscritaId(int $EMPRESA_SUSCRITA_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the EMPRESA_SUSCRITA_ID column
 * @method     ChildJobUserEmpresaSuscrita findOneByRolId(int $ROL_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the ROL_ID column
 * @method     ChildJobUserEmpresaSuscrita findOneByActive(boolean $ACTIVE) Return the first ChildJobUserEmpresaSuscrita filtered by the ACTIVE column
 * @method     ChildJobUserEmpresaSuscrita findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the LAST_USER_ID column
 * @method     ChildJobUserEmpresaSuscrita findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobUserEmpresaSuscrita filtered by the CREATION_DATE column
 * @method     ChildJobUserEmpresaSuscrita findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobUserEmpresaSuscrita filtered by the MODIFICATION_DATE column *

 * @method     ChildJobUserEmpresaSuscrita requirePk($key, ConnectionInterface $con = null) Return the ChildJobUserEmpresaSuscrita by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOne(ConnectionInterface $con = null) Return the first ChildJobUserEmpresaSuscrita matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobUserEmpresaSuscrita requireOneById(int $ID) Return the first ChildJobUserEmpresaSuscrita filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOneByUserId(int $USER_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOneByEmpresaSuscritaId(int $EMPRESA_SUSCRITA_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the EMPRESA_SUSCRITA_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOneByRolId(int $ROL_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the ROL_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOneByActive(boolean $ACTIVE) Return the first ChildJobUserEmpresaSuscrita filtered by the ACTIVE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobUserEmpresaSuscrita filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobUserEmpresaSuscrita filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobUserEmpresaSuscrita requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobUserEmpresaSuscrita filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobUserEmpresaSuscrita objects based on current ModelCriteria
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findById(int $ID) Return ChildJobUserEmpresaSuscrita objects filtered by the ID column
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findByUserId(int $USER_ID) Return ChildJobUserEmpresaSuscrita objects filtered by the USER_ID column
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findByEmpresaSuscritaId(int $EMPRESA_SUSCRITA_ID) Return ChildJobUserEmpresaSuscrita objects filtered by the EMPRESA_SUSCRITA_ID column
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findByRolId(int $ROL_ID) Return ChildJobUserEmpresaSuscrita objects filtered by the ROL_ID column
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findByActive(boolean $ACTIVE) Return ChildJobUserEmpresaSuscrita objects filtered by the ACTIVE column
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobUserEmpresaSuscrita objects filtered by the LAST_USER_ID column
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobUserEmpresaSuscrita objects filtered by the CREATION_DATE column
 * @method     ChildJobUserEmpresaSuscrita[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobUserEmpresaSuscrita objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobUserEmpresaSuscrita[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobUserEmpresaSuscritaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobUserEmpresaSuscritaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobUserEmpresaSuscrita', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobUserEmpresaSuscritaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobUserEmpresaSuscritaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobUserEmpresaSuscritaQuery) {
            return $criteria;
        }
        $query = new ChildJobUserEmpresaSuscritaQuery();
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
     * @return ChildJobUserEmpresaSuscrita|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobUserEmpresaSuscritaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobUserEmpresaSuscritaTableMap::DATABASE_NAME);
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
     * @return ChildJobUserEmpresaSuscrita A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, USER_ID, EMPRESA_SUSCRITA_ID, ROL_ID, ACTIVE, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_user_empresa_suscrita WHERE ID = :p0';
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
            /** @var ChildJobUserEmpresaSuscrita $obj */
            $obj = new ChildJobUserEmpresaSuscrita();
            $obj->hydrate($row);
            JobUserEmpresaSuscritaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobUserEmpresaSuscrita|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the USER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE USER_ID = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE USER_ID IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE USER_ID > 12
     * </code>
     *
     * @see       filterBySysUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the EMPRESA_SUSCRITA_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpresaSuscritaId(1234); // WHERE EMPRESA_SUSCRITA_ID = 1234
     * $query->filterByEmpresaSuscritaId(array(12, 34)); // WHERE EMPRESA_SUSCRITA_ID IN (12, 34)
     * $query->filterByEmpresaSuscritaId(array('min' => 12)); // WHERE EMPRESA_SUSCRITA_ID > 12
     * </code>
     *
     * @see       filterByJobEmpresaSuscrita()
     *
     * @param     mixed $empresaSuscritaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByEmpresaSuscritaId($empresaSuscritaId = null, $comparison = null)
    {
        if (is_array($empresaSuscritaId)) {
            $useMinMax = false;
            if (isset($empresaSuscritaId['min'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_EMPRESA_SUSCRITA_ID, $empresaSuscritaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empresaSuscritaId['max'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_EMPRESA_SUSCRITA_ID, $empresaSuscritaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_EMPRESA_SUSCRITA_ID, $empresaSuscritaId, $comparison);
    }

    /**
     * Filter the query on the ROL_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByRolId(1234); // WHERE ROL_ID = 1234
     * $query->filterByRolId(array(12, 34)); // WHERE ROL_ID IN (12, 34)
     * $query->filterByRolId(array('min' => 12)); // WHERE ROL_ID > 12
     * </code>
     *
     * @see       filterBySysRol()
     *
     * @param     mixed $rolId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByRolId($rolId = null, $comparison = null)
    {
        if (is_array($rolId)) {
            $useMinMax = false;
            if (isset($rolId['min'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ROL_ID, $rolId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolId['max'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ROL_ID, $rolId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ROL_ID, $rolId, $comparison);
    }

    /**
     * Filter the query on the ACTIVE column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE ACTIVE = true
     * $query->filterByActive('yes'); // WHERE ACTIVE = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobEmpresaSuscrita object
     *
     * @param \JobEmpresaSuscrita|ObjectCollection $jobEmpresaSuscrita The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterByJobEmpresaSuscrita($jobEmpresaSuscrita, $comparison = null)
    {
        if ($jobEmpresaSuscrita instanceof \JobEmpresaSuscrita) {
            return $this
                ->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_EMPRESA_SUSCRITA_ID, $jobEmpresaSuscrita->getId(), $comparison);
        } elseif ($jobEmpresaSuscrita instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_EMPRESA_SUSCRITA_ID, $jobEmpresaSuscrita->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobEmpresaSuscrita() only accepts arguments of type \JobEmpresaSuscrita or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobEmpresaSuscrita relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function joinJobEmpresaSuscrita($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobEmpresaSuscrita');

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
            $this->addJoinObject($join, 'JobEmpresaSuscrita');
        }

        return $this;
    }

    /**
     * Use the JobEmpresaSuscrita relation JobEmpresaSuscrita object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobEmpresaSuscritaQuery A secondary query class using the current class as primary query
     */
    public function useJobEmpresaSuscritaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobEmpresaSuscrita($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobEmpresaSuscrita', '\JobEmpresaSuscritaQuery');
    }

    /**
     * Filter the query by a related \SysRol object
     *
     * @param \SysRol|ObjectCollection $sysRol The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterBySysRol($sysRol, $comparison = null)
    {
        if ($sysRol instanceof \SysRol) {
            return $this
                ->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ROL_ID, $sysRol->getId(), $comparison);
        } elseif ($sysRol instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ROL_ID, $sysRol->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysRol() only accepts arguments of type \SysRol or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysRol relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function joinSysRol($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysRol');

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
            $this->addJoinObject($join, 'SysRol');
        }

        return $this;
    }

    /**
     * Use the SysRol relation SysRol object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysRolQuery A secondary query class using the current class as primary query
     */
    public function useSysRolQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysRol($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysRol', '\SysRolQuery');
    }

    /**
     * Filter the query by a related \SysUser object
     *
     * @param \SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, $comparison = null)
    {
        if ($sysUser instanceof \SysUser) {
            return $this
                ->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysUser() only accepts arguments of type \SysUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function joinSysUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUser');

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
            $this->addJoinObject($join, 'SysUser');
        }

        return $this;
    }

    /**
     * Use the SysUser relation SysUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysUserQuery A secondary query class using the current class as primary query
     */
    public function useSysUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUser', '\SysUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobUserEmpresaSuscrita $jobUserEmpresaSuscrita Object to remove from the list of results
     *
     * @return $this|ChildJobUserEmpresaSuscritaQuery The current query, for fluid interface
     */
    public function prune($jobUserEmpresaSuscrita = null)
    {
        if ($jobUserEmpresaSuscrita) {
            $this->addUsingAlias(JobUserEmpresaSuscritaTableMap::COL_ID, $jobUserEmpresaSuscrita->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_user_empresa_suscrita table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobUserEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobUserEmpresaSuscritaTableMap::clearInstancePool();
            JobUserEmpresaSuscritaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobUserEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobUserEmpresaSuscritaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobUserEmpresaSuscritaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobUserEmpresaSuscritaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobUserEmpresaSuscritaQuery
