<?php

namespace Base;

use \SysEmailSent as ChildSysEmailSent;
use \SysEmailSentQuery as ChildSysEmailSentQuery;
use \Exception;
use \PDO;
use Map\SysEmailSentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_email_sent' table.
 *
 * 
 *
 * @method     ChildSysEmailSentQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEmailSentQuery orderByEmailId($order = Criteria::ASC) Order by the EMAIL_ID column
 * @method     ChildSysEmailSentQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysEmailSentQuery orderBySenderId($order = Criteria::ASC) Order by the SENDER_ID column
 * @method     ChildSysEmailSentQuery orderByHashString($order = Criteria::ASC) Order by the HASH_STRING column
 * @method     ChildSysEmailSentQuery orderByFromName($order = Criteria::ASC) Order by the FROM_NAME column
 * @method     ChildSysEmailSentQuery orderByFromEmail($order = Criteria::ASC) Order by the FROM_EMAIL column
 * @method     ChildSysEmailSentQuery orderByToEmail($order = Criteria::ASC) Order by the TO_EMAIL column
 * @method     ChildSysEmailSentQuery orderByCc($order = Criteria::ASC) Order by the CC column
 * @method     ChildSysEmailSentQuery orderByBcc($order = Criteria::ASC) Order by the BCC column
 * @method     ChildSysEmailSentQuery orderBySubject($order = Criteria::ASC) Order by the SUBJECT column
 * @method     ChildSysEmailSentQuery orderByContent($order = Criteria::ASC) Order by the CONTENT column
 * @method     ChildSysEmailSentQuery orderByIsSuccess($order = Criteria::ASC) Order by the IS_SUCCESS column
 * @method     ChildSysEmailSentQuery orderByShippingDate($order = Criteria::ASC) Order by the SHIPPING_DATE column
 * @method     ChildSysEmailSentQuery orderByOpeningDate($order = Criteria::ASC) Order by the OPENING_DATE column
 *
 * @method     ChildSysEmailSentQuery groupById() Group by the ID column
 * @method     ChildSysEmailSentQuery groupByEmailId() Group by the EMAIL_ID column
 * @method     ChildSysEmailSentQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysEmailSentQuery groupBySenderId() Group by the SENDER_ID column
 * @method     ChildSysEmailSentQuery groupByHashString() Group by the HASH_STRING column
 * @method     ChildSysEmailSentQuery groupByFromName() Group by the FROM_NAME column
 * @method     ChildSysEmailSentQuery groupByFromEmail() Group by the FROM_EMAIL column
 * @method     ChildSysEmailSentQuery groupByToEmail() Group by the TO_EMAIL column
 * @method     ChildSysEmailSentQuery groupByCc() Group by the CC column
 * @method     ChildSysEmailSentQuery groupByBcc() Group by the BCC column
 * @method     ChildSysEmailSentQuery groupBySubject() Group by the SUBJECT column
 * @method     ChildSysEmailSentQuery groupByContent() Group by the CONTENT column
 * @method     ChildSysEmailSentQuery groupByIsSuccess() Group by the IS_SUCCESS column
 * @method     ChildSysEmailSentQuery groupByShippingDate() Group by the SHIPPING_DATE column
 * @method     ChildSysEmailSentQuery groupByOpeningDate() Group by the OPENING_DATE column
 *
 * @method     ChildSysEmailSentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEmailSentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEmailSentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEmailSentQuery leftJoinSysEmail($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEmail relation
 * @method     ChildSysEmailSentQuery rightJoinSysEmail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEmail relation
 * @method     ChildSysEmailSentQuery innerJoinSysEmail($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEmail relation
 *
 * @method     ChildSysEmailSentQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysEmailSentQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysEmailSentQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     \SysEmailQuery|\SysUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEmailSent findOne(ConnectionInterface $con = null) Return the first ChildSysEmailSent matching the query
 * @method     ChildSysEmailSent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysEmailSent matching the query, or a new ChildSysEmailSent object populated from the query conditions when no match is found
 *
 * @method     ChildSysEmailSent findOneById(int $ID) Return the first ChildSysEmailSent filtered by the ID column
 * @method     ChildSysEmailSent findOneByEmailId(int $EMAIL_ID) Return the first ChildSysEmailSent filtered by the EMAIL_ID column
 * @method     ChildSysEmailSent findOneByUserId(int $USER_ID) Return the first ChildSysEmailSent filtered by the USER_ID column
 * @method     ChildSysEmailSent findOneBySenderId(int $SENDER_ID) Return the first ChildSysEmailSent filtered by the SENDER_ID column
 * @method     ChildSysEmailSent findOneByHashString(string $HASH_STRING) Return the first ChildSysEmailSent filtered by the HASH_STRING column
 * @method     ChildSysEmailSent findOneByFromName(string $FROM_NAME) Return the first ChildSysEmailSent filtered by the FROM_NAME column
 * @method     ChildSysEmailSent findOneByFromEmail(string $FROM_EMAIL) Return the first ChildSysEmailSent filtered by the FROM_EMAIL column
 * @method     ChildSysEmailSent findOneByToEmail(string $TO_EMAIL) Return the first ChildSysEmailSent filtered by the TO_EMAIL column
 * @method     ChildSysEmailSent findOneByCc(string $CC) Return the first ChildSysEmailSent filtered by the CC column
 * @method     ChildSysEmailSent findOneByBcc(string $BCC) Return the first ChildSysEmailSent filtered by the BCC column
 * @method     ChildSysEmailSent findOneBySubject(string $SUBJECT) Return the first ChildSysEmailSent filtered by the SUBJECT column
 * @method     ChildSysEmailSent findOneByContent(string $CONTENT) Return the first ChildSysEmailSent filtered by the CONTENT column
 * @method     ChildSysEmailSent findOneByIsSuccess(boolean $IS_SUCCESS) Return the first ChildSysEmailSent filtered by the IS_SUCCESS column
 * @method     ChildSysEmailSent findOneByShippingDate(string $SHIPPING_DATE) Return the first ChildSysEmailSent filtered by the SHIPPING_DATE column
 * @method     ChildSysEmailSent findOneByOpeningDate(string $OPENING_DATE) Return the first ChildSysEmailSent filtered by the OPENING_DATE column *

 * @method     ChildSysEmailSent requirePk($key, ConnectionInterface $con = null) Return the ChildSysEmailSent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOne(ConnectionInterface $con = null) Return the first ChildSysEmailSent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEmailSent requireOneById(int $ID) Return the first ChildSysEmailSent filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByEmailId(int $EMAIL_ID) Return the first ChildSysEmailSent filtered by the EMAIL_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByUserId(int $USER_ID) Return the first ChildSysEmailSent filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneBySenderId(int $SENDER_ID) Return the first ChildSysEmailSent filtered by the SENDER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByHashString(string $HASH_STRING) Return the first ChildSysEmailSent filtered by the HASH_STRING column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByFromName(string $FROM_NAME) Return the first ChildSysEmailSent filtered by the FROM_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByFromEmail(string $FROM_EMAIL) Return the first ChildSysEmailSent filtered by the FROM_EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByToEmail(string $TO_EMAIL) Return the first ChildSysEmailSent filtered by the TO_EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByCc(string $CC) Return the first ChildSysEmailSent filtered by the CC column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByBcc(string $BCC) Return the first ChildSysEmailSent filtered by the BCC column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneBySubject(string $SUBJECT) Return the first ChildSysEmailSent filtered by the SUBJECT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByContent(string $CONTENT) Return the first ChildSysEmailSent filtered by the CONTENT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByIsSuccess(boolean $IS_SUCCESS) Return the first ChildSysEmailSent filtered by the IS_SUCCESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByShippingDate(string $SHIPPING_DATE) Return the first ChildSysEmailSent filtered by the SHIPPING_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmailSent requireOneByOpeningDate(string $OPENING_DATE) Return the first ChildSysEmailSent filtered by the OPENING_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEmailSent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysEmailSent objects based on current ModelCriteria
 * @method     ChildSysEmailSent[]|ObjectCollection findById(int $ID) Return ChildSysEmailSent objects filtered by the ID column
 * @method     ChildSysEmailSent[]|ObjectCollection findByEmailId(int $EMAIL_ID) Return ChildSysEmailSent objects filtered by the EMAIL_ID column
 * @method     ChildSysEmailSent[]|ObjectCollection findByUserId(int $USER_ID) Return ChildSysEmailSent objects filtered by the USER_ID column
 * @method     ChildSysEmailSent[]|ObjectCollection findBySenderId(int $SENDER_ID) Return ChildSysEmailSent objects filtered by the SENDER_ID column
 * @method     ChildSysEmailSent[]|ObjectCollection findByHashString(string $HASH_STRING) Return ChildSysEmailSent objects filtered by the HASH_STRING column
 * @method     ChildSysEmailSent[]|ObjectCollection findByFromName(string $FROM_NAME) Return ChildSysEmailSent objects filtered by the FROM_NAME column
 * @method     ChildSysEmailSent[]|ObjectCollection findByFromEmail(string $FROM_EMAIL) Return ChildSysEmailSent objects filtered by the FROM_EMAIL column
 * @method     ChildSysEmailSent[]|ObjectCollection findByToEmail(string $TO_EMAIL) Return ChildSysEmailSent objects filtered by the TO_EMAIL column
 * @method     ChildSysEmailSent[]|ObjectCollection findByCc(string $CC) Return ChildSysEmailSent objects filtered by the CC column
 * @method     ChildSysEmailSent[]|ObjectCollection findByBcc(string $BCC) Return ChildSysEmailSent objects filtered by the BCC column
 * @method     ChildSysEmailSent[]|ObjectCollection findBySubject(string $SUBJECT) Return ChildSysEmailSent objects filtered by the SUBJECT column
 * @method     ChildSysEmailSent[]|ObjectCollection findByContent(string $CONTENT) Return ChildSysEmailSent objects filtered by the CONTENT column
 * @method     ChildSysEmailSent[]|ObjectCollection findByIsSuccess(boolean $IS_SUCCESS) Return ChildSysEmailSent objects filtered by the IS_SUCCESS column
 * @method     ChildSysEmailSent[]|ObjectCollection findByShippingDate(string $SHIPPING_DATE) Return ChildSysEmailSent objects filtered by the SHIPPING_DATE column
 * @method     ChildSysEmailSent[]|ObjectCollection findByOpeningDate(string $OPENING_DATE) Return ChildSysEmailSent objects filtered by the OPENING_DATE column
 * @method     ChildSysEmailSent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysEmailSentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEmailSentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEmailSent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEmailSentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEmailSentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysEmailSentQuery) {
            return $criteria;
        }
        $query = new ChildSysEmailSentQuery();
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
     * @return ChildSysEmailSent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SysEmailSentTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEmailSentTableMap::DATABASE_NAME);
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
     * @return ChildSysEmailSent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, EMAIL_ID, USER_ID, SENDER_ID, HASH_STRING, FROM_NAME, FROM_EMAIL, TO_EMAIL, CC, BCC, SUBJECT, CONTENT, IS_SUCCESS, SHIPPING_DATE, OPENING_DATE FROM sys_email_sent WHERE ID = :p0';
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
            /** @var ChildSysEmailSent $obj */
            $obj = new ChildSysEmailSent();
            $obj->hydrate($row);
            SysEmailSentTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildSysEmailSent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysEmailSentTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysEmailSentTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the EMAIL_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailId(1234); // WHERE EMAIL_ID = 1234
     * $query->filterByEmailId(array(12, 34)); // WHERE EMAIL_ID IN (12, 34)
     * $query->filterByEmailId(array('min' => 12)); // WHERE EMAIL_ID > 12
     * </code>
     *
     * @see       filterBySysEmail()
     *
     * @param     mixed $emailId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByEmailId($emailId = null, $comparison = null)
    {
        if (is_array($emailId)) {
            $useMinMax = false;
            if (isset($emailId['min'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_EMAIL_ID, $emailId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emailId['max'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_EMAIL_ID, $emailId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_EMAIL_ID, $emailId, $comparison);
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
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the SENDER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterBySenderId(1234); // WHERE SENDER_ID = 1234
     * $query->filterBySenderId(array(12, 34)); // WHERE SENDER_ID IN (12, 34)
     * $query->filterBySenderId(array('min' => 12)); // WHERE SENDER_ID > 12
     * </code>
     *
     * @param     mixed $senderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterBySenderId($senderId = null, $comparison = null)
    {
        if (is_array($senderId)) {
            $useMinMax = false;
            if (isset($senderId['min'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_SENDER_ID, $senderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($senderId['max'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_SENDER_ID, $senderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_SENDER_ID, $senderId, $comparison);
    }

    /**
     * Filter the query on the HASH_STRING column
     *
     * Example usage:
     * <code>
     * $query->filterByHashString('fooValue');   // WHERE HASH_STRING = 'fooValue'
     * $query->filterByHashString('%fooValue%'); // WHERE HASH_STRING LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hashString The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByHashString($hashString = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hashString)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $hashString)) {
                $hashString = str_replace('*', '%', $hashString);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_HASH_STRING, $hashString, $comparison);
    }

    /**
     * Filter the query on the FROM_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByFromName('fooValue');   // WHERE FROM_NAME = 'fooValue'
     * $query->filterByFromName('%fooValue%'); // WHERE FROM_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fromName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByFromName($fromName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fromName)) {
                $fromName = str_replace('*', '%', $fromName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_FROM_NAME, $fromName, $comparison);
    }

    /**
     * Filter the query on the FROM_EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByFromEmail('fooValue');   // WHERE FROM_EMAIL = 'fooValue'
     * $query->filterByFromEmail('%fooValue%'); // WHERE FROM_EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fromEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByFromEmail($fromEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fromEmail)) {
                $fromEmail = str_replace('*', '%', $fromEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_FROM_EMAIL, $fromEmail, $comparison);
    }

    /**
     * Filter the query on the TO_EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByToEmail('fooValue');   // WHERE TO_EMAIL = 'fooValue'
     * $query->filterByToEmail('%fooValue%'); // WHERE TO_EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $toEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByToEmail($toEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $toEmail)) {
                $toEmail = str_replace('*', '%', $toEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_TO_EMAIL, $toEmail, $comparison);
    }

    /**
     * Filter the query on the CC column
     *
     * Example usage:
     * <code>
     * $query->filterByCc('fooValue');   // WHERE CC = 'fooValue'
     * $query->filterByCc('%fooValue%'); // WHERE CC LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByCc($cc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cc)) {
                $cc = str_replace('*', '%', $cc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_CC, $cc, $comparison);
    }

    /**
     * Filter the query on the BCC column
     *
     * Example usage:
     * <code>
     * $query->filterByBcc('fooValue');   // WHERE BCC = 'fooValue'
     * $query->filterByBcc('%fooValue%'); // WHERE BCC LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bcc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByBcc($bcc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bcc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bcc)) {
                $bcc = str_replace('*', '%', $bcc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_BCC, $bcc, $comparison);
    }

    /**
     * Filter the query on the SUBJECT column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE SUBJECT = 'fooValue'
     * $query->filterBySubject('%fooValue%'); // WHERE SUBJECT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subject)) {
                $subject = str_replace('*', '%', $subject);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_SUBJECT, $subject, $comparison);
    }

    /**
     * Filter the query on the CONTENT column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE CONTENT = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE CONTENT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the IS_SUCCESS column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSuccess(true); // WHERE IS_SUCCESS = true
     * $query->filterByIsSuccess('yes'); // WHERE IS_SUCCESS = true
     * </code>
     *
     * @param     boolean|string $isSuccess The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByIsSuccess($isSuccess = null, $comparison = null)
    {
        if (is_string($isSuccess)) {
            $isSuccess = in_array(strtolower($isSuccess), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_IS_SUCCESS, $isSuccess, $comparison);
    }

    /**
     * Filter the query on the SHIPPING_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingDate('2011-03-14'); // WHERE SHIPPING_DATE = '2011-03-14'
     * $query->filterByShippingDate('now'); // WHERE SHIPPING_DATE = '2011-03-14'
     * $query->filterByShippingDate(array('max' => 'yesterday')); // WHERE SHIPPING_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $shippingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByShippingDate($shippingDate = null, $comparison = null)
    {
        if (is_array($shippingDate)) {
            $useMinMax = false;
            if (isset($shippingDate['min'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_SHIPPING_DATE, $shippingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shippingDate['max'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_SHIPPING_DATE, $shippingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_SHIPPING_DATE, $shippingDate, $comparison);
    }

    /**
     * Filter the query on the OPENING_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByOpeningDate('2011-03-14'); // WHERE OPENING_DATE = '2011-03-14'
     * $query->filterByOpeningDate('now'); // WHERE OPENING_DATE = '2011-03-14'
     * $query->filterByOpeningDate(array('max' => 'yesterday')); // WHERE OPENING_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $openingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterByOpeningDate($openingDate = null, $comparison = null)
    {
        if (is_array($openingDate)) {
            $useMinMax = false;
            if (isset($openingDate['min'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_OPENING_DATE, $openingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($openingDate['max'])) {
                $this->addUsingAlias(SysEmailSentTableMap::COL_OPENING_DATE, $openingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailSentTableMap::COL_OPENING_DATE, $openingDate, $comparison);
    }

    /**
     * Filter the query by a related \SysEmail object
     *
     * @param \SysEmail|ObjectCollection $sysEmail The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterBySysEmail($sysEmail, $comparison = null)
    {
        if ($sysEmail instanceof \SysEmail) {
            return $this
                ->addUsingAlias(SysEmailSentTableMap::COL_EMAIL_ID, $sysEmail->getId(), $comparison);
        } elseif ($sysEmail instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysEmailSentTableMap::COL_EMAIL_ID, $sysEmail->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysEmail() only accepts arguments of type \SysEmail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEmail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function joinSysEmail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEmail');

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
            $this->addJoinObject($join, 'SysEmail');
        }

        return $this;
    }

    /**
     * Use the SysEmail relation SysEmail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEmailQuery A secondary query class using the current class as primary query
     */
    public function useSysEmailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEmail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEmail', '\SysEmailQuery');
    }

    /**
     * Filter the query by a related \SysUser object
     *
     * @param \SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, $comparison = null)
    {
        if ($sysUser instanceof \SysUser) {
            return $this
                ->addUsingAlias(SysEmailSentTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysEmailSentTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function joinSysUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useSysUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUser', '\SysUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysEmailSent $sysEmailSent Object to remove from the list of results
     *
     * @return $this|ChildSysEmailSentQuery The current query, for fluid interface
     */
    public function prune($sysEmailSent = null)
    {
        if ($sysEmailSent) {
            $this->addUsingAlias(SysEmailSentTableMap::COL_ID, $sysEmailSent->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_email_sent table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailSentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEmailSentTableMap::clearInstancePool();
            SysEmailSentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailSentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEmailSentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            SysEmailSentTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            SysEmailSentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysEmailSentQuery
