<?php

namespace App\model\domain\Base;

use \Exception;
use \PDO;
use App\model\domain\SysPasswordRequest as ChildSysPasswordRequest;
use App\model\domain\SysPasswordRequestQuery as ChildSysPasswordRequestQuery;
use App\model\domain\Map\SysPasswordRequestTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_password_request' table.
 *
 *
 *
 * @method     ChildSysPasswordRequestQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysPasswordRequestQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysPasswordRequestQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildSysPasswordRequestQuery orderByHashString($order = Criteria::ASC) Order by the HASH_STRING column
 * @method     ChildSysPasswordRequestQuery orderByActive($order = Criteria::ASC) Order by the ACTIVE column
 * @method     ChildSysPasswordRequestQuery orderByLifeTime($order = Criteria::ASC) Order by the LIFE_TIME column
 * @method     ChildSysPasswordRequestQuery orderByRequestIp($order = Criteria::ASC) Order by the REQUEST_IP column
 * @method     ChildSysPasswordRequestQuery orderByRestoredIp($order = Criteria::ASC) Order by the RESTORED_IP column
 * @method     ChildSysPasswordRequestQuery orderByAccededTimes($order = Criteria::ASC) Order by the ACCEDED_TIMES column
 * @method     ChildSysPasswordRequestQuery orderByRequestedDate($order = Criteria::ASC) Order by the REQUESTED_DATE column
 * @method     ChildSysPasswordRequestQuery orderByRestoredDate($order = Criteria::ASC) Order by the RESTORED_DATE column
 *
 * @method     ChildSysPasswordRequestQuery groupById() Group by the ID column
 * @method     ChildSysPasswordRequestQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysPasswordRequestQuery groupByEmail() Group by the EMAIL column
 * @method     ChildSysPasswordRequestQuery groupByHashString() Group by the HASH_STRING column
 * @method     ChildSysPasswordRequestQuery groupByActive() Group by the ACTIVE column
 * @method     ChildSysPasswordRequestQuery groupByLifeTime() Group by the LIFE_TIME column
 * @method     ChildSysPasswordRequestQuery groupByRequestIp() Group by the REQUEST_IP column
 * @method     ChildSysPasswordRequestQuery groupByRestoredIp() Group by the RESTORED_IP column
 * @method     ChildSysPasswordRequestQuery groupByAccededTimes() Group by the ACCEDED_TIMES column
 * @method     ChildSysPasswordRequestQuery groupByRequestedDate() Group by the REQUESTED_DATE column
 * @method     ChildSysPasswordRequestQuery groupByRestoredDate() Group by the RESTORED_DATE column
 *
 * @method     ChildSysPasswordRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysPasswordRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysPasswordRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysPasswordRequestQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysPasswordRequestQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysPasswordRequestQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysPasswordRequestQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysPasswordRequestQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysPasswordRequestQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildSysPasswordRequestQuery joinWithSysUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUser relation
 *
 * @method     ChildSysPasswordRequestQuery leftJoinWithSysUser() Adds a LEFT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysPasswordRequestQuery rightJoinWithSysUser() Adds a RIGHT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysPasswordRequestQuery innerJoinWithSysUser() Adds a INNER JOIN clause and with to the query using the SysUser relation
 *
 * @method     ChildSysPasswordRequestQuery leftJoinSysPassword($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysPassword relation
 * @method     ChildSysPasswordRequestQuery rightJoinSysPassword($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysPassword relation
 * @method     ChildSysPasswordRequestQuery innerJoinSysPassword($relationAlias = null) Adds a INNER JOIN clause to the query using the SysPassword relation
 *
 * @method     ChildSysPasswordRequestQuery joinWithSysPassword($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysPassword relation
 *
 * @method     ChildSysPasswordRequestQuery leftJoinWithSysPassword() Adds a LEFT JOIN clause and with to the query using the SysPassword relation
 * @method     ChildSysPasswordRequestQuery rightJoinWithSysPassword() Adds a RIGHT JOIN clause and with to the query using the SysPassword relation
 * @method     ChildSysPasswordRequestQuery innerJoinWithSysPassword() Adds a INNER JOIN clause and with to the query using the SysPassword relation
 *
 * @method     \App\model\domain\SysUserQuery|\App\model\domain\SysPasswordQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysPasswordRequest findOne(ConnectionInterface $con = null) Return the first ChildSysPasswordRequest matching the query
 * @method     ChildSysPasswordRequest findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysPasswordRequest matching the query, or a new ChildSysPasswordRequest object populated from the query conditions when no match is found
 *
 * @method     ChildSysPasswordRequest findOneById(int $ID) Return the first ChildSysPasswordRequest filtered by the ID column
 * @method     ChildSysPasswordRequest findOneByUserId(int $USER_ID) Return the first ChildSysPasswordRequest filtered by the USER_ID column
 * @method     ChildSysPasswordRequest findOneByEmail(string $EMAIL) Return the first ChildSysPasswordRequest filtered by the EMAIL column
 * @method     ChildSysPasswordRequest findOneByHashString(string $HASH_STRING) Return the first ChildSysPasswordRequest filtered by the HASH_STRING column
 * @method     ChildSysPasswordRequest findOneByActive(boolean $ACTIVE) Return the first ChildSysPasswordRequest filtered by the ACTIVE column
 * @method     ChildSysPasswordRequest findOneByLifeTime(int $LIFE_TIME) Return the first ChildSysPasswordRequest filtered by the LIFE_TIME column
 * @method     ChildSysPasswordRequest findOneByRequestIp(string $REQUEST_IP) Return the first ChildSysPasswordRequest filtered by the REQUEST_IP column
 * @method     ChildSysPasswordRequest findOneByRestoredIp(string $RESTORED_IP) Return the first ChildSysPasswordRequest filtered by the RESTORED_IP column
 * @method     ChildSysPasswordRequest findOneByAccededTimes(int $ACCEDED_TIMES) Return the first ChildSysPasswordRequest filtered by the ACCEDED_TIMES column
 * @method     ChildSysPasswordRequest findOneByRequestedDate(string $REQUESTED_DATE) Return the first ChildSysPasswordRequest filtered by the REQUESTED_DATE column
 * @method     ChildSysPasswordRequest findOneByRestoredDate(string $RESTORED_DATE) Return the first ChildSysPasswordRequest filtered by the RESTORED_DATE column *

 * @method     ChildSysPasswordRequest requirePk($key, ConnectionInterface $con = null) Return the ChildSysPasswordRequest by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOne(ConnectionInterface $con = null) Return the first ChildSysPasswordRequest matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysPasswordRequest requireOneById(int $ID) Return the first ChildSysPasswordRequest filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByUserId(int $USER_ID) Return the first ChildSysPasswordRequest filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByEmail(string $EMAIL) Return the first ChildSysPasswordRequest filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByHashString(string $HASH_STRING) Return the first ChildSysPasswordRequest filtered by the HASH_STRING column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByActive(boolean $ACTIVE) Return the first ChildSysPasswordRequest filtered by the ACTIVE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByLifeTime(int $LIFE_TIME) Return the first ChildSysPasswordRequest filtered by the LIFE_TIME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByRequestIp(string $REQUEST_IP) Return the first ChildSysPasswordRequest filtered by the REQUEST_IP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByRestoredIp(string $RESTORED_IP) Return the first ChildSysPasswordRequest filtered by the RESTORED_IP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByAccededTimes(int $ACCEDED_TIMES) Return the first ChildSysPasswordRequest filtered by the ACCEDED_TIMES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByRequestedDate(string $REQUESTED_DATE) Return the first ChildSysPasswordRequest filtered by the REQUESTED_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPasswordRequest requireOneByRestoredDate(string $RESTORED_DATE) Return the first ChildSysPasswordRequest filtered by the RESTORED_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysPasswordRequest[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysPasswordRequest objects based on current ModelCriteria
 * @method     ChildSysPasswordRequest[]|ObjectCollection findById(int $ID) Return ChildSysPasswordRequest objects filtered by the ID column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByUserId(int $USER_ID) Return ChildSysPasswordRequest objects filtered by the USER_ID column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByEmail(string $EMAIL) Return ChildSysPasswordRequest objects filtered by the EMAIL column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByHashString(string $HASH_STRING) Return ChildSysPasswordRequest objects filtered by the HASH_STRING column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByActive(boolean $ACTIVE) Return ChildSysPasswordRequest objects filtered by the ACTIVE column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByLifeTime(int $LIFE_TIME) Return ChildSysPasswordRequest objects filtered by the LIFE_TIME column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByRequestIp(string $REQUEST_IP) Return ChildSysPasswordRequest objects filtered by the REQUEST_IP column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByRestoredIp(string $RESTORED_IP) Return ChildSysPasswordRequest objects filtered by the RESTORED_IP column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByAccededTimes(int $ACCEDED_TIMES) Return ChildSysPasswordRequest objects filtered by the ACCEDED_TIMES column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByRequestedDate(string $REQUESTED_DATE) Return ChildSysPasswordRequest objects filtered by the REQUESTED_DATE column
 * @method     ChildSysPasswordRequest[]|ObjectCollection findByRestoredDate(string $RESTORED_DATE) Return ChildSysPasswordRequest objects filtered by the RESTORED_DATE column
 * @method     ChildSysPasswordRequest[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysPasswordRequestQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\model\domain\Base\SysPasswordRequestQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\model\\domain\\SysPasswordRequest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysPasswordRequestQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysPasswordRequestQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysPasswordRequestQuery) {
            return $criteria;
        }
        $query = new ChildSysPasswordRequestQuery();
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
     * @return ChildSysPasswordRequest|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysPasswordRequestTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysPasswordRequestTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysPasswordRequest A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, USER_ID, EMAIL, HASH_STRING, ACTIVE, LIFE_TIME, REQUEST_IP, RESTORED_IP, ACCEDED_TIMES, REQUESTED_DATE, RESTORED_DATE FROM sys_password_request WHERE ID = :p0';
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
            /** @var ChildSysPasswordRequest $obj */
            $obj = new ChildSysPasswordRequest();
            $obj->hydrate($row);
            SysPasswordRequestTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysPasswordRequest|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the HASH_STRING column
     *
     * Example usage:
     * <code>
     * $query->filterByHashString('fooValue');   // WHERE HASH_STRING = 'fooValue'
     * $query->filterByHashString('%fooValue%', Criteria::LIKE); // WHERE HASH_STRING LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hashString The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByHashString($hashString = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hashString)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_HASH_STRING, $hashString, $comparison);
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
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the LIFE_TIME column
     *
     * Example usage:
     * <code>
     * $query->filterByLifeTime(1234); // WHERE LIFE_TIME = 1234
     * $query->filterByLifeTime(array(12, 34)); // WHERE LIFE_TIME IN (12, 34)
     * $query->filterByLifeTime(array('min' => 12)); // WHERE LIFE_TIME > 12
     * </code>
     *
     * @param     mixed $lifeTime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByLifeTime($lifeTime = null, $comparison = null)
    {
        if (is_array($lifeTime)) {
            $useMinMax = false;
            if (isset($lifeTime['min'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_LIFE_TIME, $lifeTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lifeTime['max'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_LIFE_TIME, $lifeTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_LIFE_TIME, $lifeTime, $comparison);
    }

    /**
     * Filter the query on the REQUEST_IP column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestIp('fooValue');   // WHERE REQUEST_IP = 'fooValue'
     * $query->filterByRequestIp('%fooValue%', Criteria::LIKE); // WHERE REQUEST_IP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $requestIp The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByRequestIp($requestIp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($requestIp)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_REQUEST_IP, $requestIp, $comparison);
    }

    /**
     * Filter the query on the RESTORED_IP column
     *
     * Example usage:
     * <code>
     * $query->filterByRestoredIp('fooValue');   // WHERE RESTORED_IP = 'fooValue'
     * $query->filterByRestoredIp('%fooValue%', Criteria::LIKE); // WHERE RESTORED_IP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $restoredIp The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByRestoredIp($restoredIp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($restoredIp)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_RESTORED_IP, $restoredIp, $comparison);
    }

    /**
     * Filter the query on the ACCEDED_TIMES column
     *
     * Example usage:
     * <code>
     * $query->filterByAccededTimes(1234); // WHERE ACCEDED_TIMES = 1234
     * $query->filterByAccededTimes(array(12, 34)); // WHERE ACCEDED_TIMES IN (12, 34)
     * $query->filterByAccededTimes(array('min' => 12)); // WHERE ACCEDED_TIMES > 12
     * </code>
     *
     * @param     mixed $accededTimes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByAccededTimes($accededTimes = null, $comparison = null)
    {
        if (is_array($accededTimes)) {
            $useMinMax = false;
            if (isset($accededTimes['min'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_ACCEDED_TIMES, $accededTimes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accededTimes['max'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_ACCEDED_TIMES, $accededTimes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_ACCEDED_TIMES, $accededTimes, $comparison);
    }

    /**
     * Filter the query on the REQUESTED_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedDate('2011-03-14'); // WHERE REQUESTED_DATE = '2011-03-14'
     * $query->filterByRequestedDate('now'); // WHERE REQUESTED_DATE = '2011-03-14'
     * $query->filterByRequestedDate(array('max' => 'yesterday')); // WHERE REQUESTED_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $requestedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByRequestedDate($requestedDate = null, $comparison = null)
    {
        if (is_array($requestedDate)) {
            $useMinMax = false;
            if (isset($requestedDate['min'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_REQUESTED_DATE, $requestedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedDate['max'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_REQUESTED_DATE, $requestedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_REQUESTED_DATE, $requestedDate, $comparison);
    }

    /**
     * Filter the query on the RESTORED_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByRestoredDate('2011-03-14'); // WHERE RESTORED_DATE = '2011-03-14'
     * $query->filterByRestoredDate('now'); // WHERE RESTORED_DATE = '2011-03-14'
     * $query->filterByRestoredDate(array('max' => 'yesterday')); // WHERE RESTORED_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $restoredDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterByRestoredDate($restoredDate = null, $comparison = null)
    {
        if (is_array($restoredDate)) {
            $useMinMax = false;
            if (isset($restoredDate['min'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_RESTORED_DATE, $restoredDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($restoredDate['max'])) {
                $this->addUsingAlias(SysPasswordRequestTableMap::COL_RESTORED_DATE, $restoredDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPasswordRequestTableMap::COL_RESTORED_DATE, $restoredDate, $comparison);
    }

    /**
     * Filter the query by a related \App\model\domain\SysUser object
     *
     * @param \App\model\domain\SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, $comparison = null)
    {
        if ($sysUser instanceof \App\model\domain\SysUser) {
            return $this
                ->addUsingAlias(SysPasswordRequestTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysPasswordRequestTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysUser() only accepts arguments of type \App\model\domain\SysUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
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
     * @return \App\model\domain\SysUserQuery A secondary query class using the current class as primary query
     */
    public function useSysUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUser', '\App\model\domain\SysUserQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysPassword object
     *
     * @param \App\model\domain\SysPassword|ObjectCollection $sysPassword the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function filterBySysPassword($sysPassword, $comparison = null)
    {
        if ($sysPassword instanceof \App\model\domain\SysPassword) {
            return $this
                ->addUsingAlias(SysPasswordRequestTableMap::COL_ID, $sysPassword->getPasswordRequestId(), $comparison);
        } elseif ($sysPassword instanceof ObjectCollection) {
            return $this
                ->useSysPasswordQuery()
                ->filterByPrimaryKeys($sysPassword->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysPassword() only accepts arguments of type \App\model\domain\SysPassword or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPassword relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function joinSysPassword($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysPassword');

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
            $this->addJoinObject($join, 'SysPassword');
        }

        return $this;
    }

    /**
     * Use the SysPassword relation SysPassword object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysPasswordQuery A secondary query class using the current class as primary query
     */
    public function useSysPasswordQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysPassword($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPassword', '\App\model\domain\SysPasswordQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysPasswordRequest $sysPasswordRequest Object to remove from the list of results
     *
     * @return $this|ChildSysPasswordRequestQuery The current query, for fluid interface
     */
    public function prune($sysPasswordRequest = null)
    {
        if ($sysPasswordRequest) {
            $this->addUsingAlias(SysPasswordRequestTableMap::COL_ID, $sysPasswordRequest->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_password_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordRequestTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysPasswordRequestTableMap::clearInstancePool();
            SysPasswordRequestTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordRequestTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysPasswordRequestTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysPasswordRequestTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysPasswordRequestTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysPasswordRequestQuery
