<?php

namespace Base;

use \SysEventUser as ChildSysEventUser;
use \SysEventUserQuery as ChildSysEventUserQuery;
use \Exception;
use \PDO;
use Map\SysEventUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_event_user` table.
 *
 * @method     ChildSysEventUserQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEventUserQuery orderByEventId($order = Criteria::ASC) Order by the EVENT_ID column
 * @method     ChildSysEventUserQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysEventUserQuery orderByDate($order = Criteria::ASC) Order by the DATE column
 * @method     ChildSysEventUserQuery orderByMessage($order = Criteria::ASC) Order by the MESSAGE column
 * @method     ChildSysEventUserQuery orderByDetails($order = Criteria::ASC) Order by the DETAILS column
 *
 * @method     ChildSysEventUserQuery groupById() Group by the ID column
 * @method     ChildSysEventUserQuery groupByEventId() Group by the EVENT_ID column
 * @method     ChildSysEventUserQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysEventUserQuery groupByDate() Group by the DATE column
 * @method     ChildSysEventUserQuery groupByMessage() Group by the MESSAGE column
 * @method     ChildSysEventUserQuery groupByDetails() Group by the DETAILS column
 *
 * @method     ChildSysEventUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEventUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEventUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEventUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEventUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEventUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEventUserQuery leftJoinSysEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEvent relation
 * @method     ChildSysEventUserQuery rightJoinSysEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEvent relation
 * @method     ChildSysEventUserQuery innerJoinSysEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEvent relation
 *
 * @method     ChildSysEventUserQuery joinWithSysEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEvent relation
 *
 * @method     ChildSysEventUserQuery leftJoinWithSysEvent() Adds a LEFT JOIN clause and with to the query using the SysEvent relation
 * @method     ChildSysEventUserQuery rightJoinWithSysEvent() Adds a RIGHT JOIN clause and with to the query using the SysEvent relation
 * @method     ChildSysEventUserQuery innerJoinWithSysEvent() Adds a INNER JOIN clause and with to the query using the SysEvent relation
 *
 * @method     ChildSysEventUserQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysEventUserQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysEventUserQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildSysEventUserQuery joinWithSysUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUser relation
 *
 * @method     ChildSysEventUserQuery leftJoinWithSysUser() Adds a LEFT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysEventUserQuery rightJoinWithSysUser() Adds a RIGHT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysEventUserQuery innerJoinWithSysUser() Adds a INNER JOIN clause and with to the query using the SysUser relation
 *
 * @method     \SysEventQuery|\SysUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEventUser|null findOne(?ConnectionInterface $con = null) Return the first ChildSysEventUser matching the query
 * @method     ChildSysEventUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysEventUser matching the query, or a new ChildSysEventUser object populated from the query conditions when no match is found
 *
 * @method     ChildSysEventUser|null findOneById(int $ID) Return the first ChildSysEventUser filtered by the ID column
 * @method     ChildSysEventUser|null findOneByEventId(int $EVENT_ID) Return the first ChildSysEventUser filtered by the EVENT_ID column
 * @method     ChildSysEventUser|null findOneByUserId(int $USER_ID) Return the first ChildSysEventUser filtered by the USER_ID column
 * @method     ChildSysEventUser|null findOneByDate(string $DATE) Return the first ChildSysEventUser filtered by the DATE column
 * @method     ChildSysEventUser|null findOneByMessage(string $MESSAGE) Return the first ChildSysEventUser filtered by the MESSAGE column
 * @method     ChildSysEventUser|null findOneByDetails(string $DETAILS) Return the first ChildSysEventUser filtered by the DETAILS column
 *
 * @method     ChildSysEventUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysEventUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEventUser requireOne(?ConnectionInterface $con = null) Return the first ChildSysEventUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEventUser requireOneById(int $ID) Return the first ChildSysEventUser filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEventUser requireOneByEventId(int $EVENT_ID) Return the first ChildSysEventUser filtered by the EVENT_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEventUser requireOneByUserId(int $USER_ID) Return the first ChildSysEventUser filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEventUser requireOneByDate(string $DATE) Return the first ChildSysEventUser filtered by the DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEventUser requireOneByMessage(string $MESSAGE) Return the first ChildSysEventUser filtered by the MESSAGE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEventUser requireOneByDetails(string $DETAILS) Return the first ChildSysEventUser filtered by the DETAILS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEventUser[]|Collection find(?ConnectionInterface $con = null) Return ChildSysEventUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysEventUser> find(?ConnectionInterface $con = null) Return ChildSysEventUser objects based on current ModelCriteria
 *
 * @method     ChildSysEventUser[]|Collection findById(int|array<int> $ID) Return ChildSysEventUser objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysEventUser> findById(int|array<int> $ID) Return ChildSysEventUser objects filtered by the ID column
 * @method     ChildSysEventUser[]|Collection findByEventId(int|array<int> $EVENT_ID) Return ChildSysEventUser objects filtered by the EVENT_ID column
 * @psalm-method Collection&\Traversable<ChildSysEventUser> findByEventId(int|array<int> $EVENT_ID) Return ChildSysEventUser objects filtered by the EVENT_ID column
 * @method     ChildSysEventUser[]|Collection findByUserId(int|array<int> $USER_ID) Return ChildSysEventUser objects filtered by the USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysEventUser> findByUserId(int|array<int> $USER_ID) Return ChildSysEventUser objects filtered by the USER_ID column
 * @method     ChildSysEventUser[]|Collection findByDate(string|array<string> $DATE) Return ChildSysEventUser objects filtered by the DATE column
 * @psalm-method Collection&\Traversable<ChildSysEventUser> findByDate(string|array<string> $DATE) Return ChildSysEventUser objects filtered by the DATE column
 * @method     ChildSysEventUser[]|Collection findByMessage(string|array<string> $MESSAGE) Return ChildSysEventUser objects filtered by the MESSAGE column
 * @psalm-method Collection&\Traversable<ChildSysEventUser> findByMessage(string|array<string> $MESSAGE) Return ChildSysEventUser objects filtered by the MESSAGE column
 * @method     ChildSysEventUser[]|Collection findByDetails(string|array<string> $DETAILS) Return ChildSysEventUser objects filtered by the DETAILS column
 * @psalm-method Collection&\Traversable<ChildSysEventUser> findByDetails(string|array<string> $DETAILS) Return ChildSysEventUser objects filtered by the DETAILS column
 *
 * @method     ChildSysEventUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysEventUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysEventUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEventUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEventUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEventUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEventUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysEventUserQuery) {
            return $criteria;
        }
        $query = new ChildSysEventUserQuery();
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
     * @return ChildSysEventUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEventUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEventUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysEventUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, EVENT_ID, USER_ID, DATE, MESSAGE, DETAILS FROM sys_event_user WHERE ID = :p0';
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
            /** @var ChildSysEventUser $obj */
            $obj = new ChildSysEventUser();
            $obj->hydrate($row);
            SysEventUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildSysEventUser|array|mixed the result, formatted by the current formatter
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
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
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
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SysEventUserTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SysEventUserTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
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
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEventUserTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the EVENT_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByEventId(1234); // WHERE EVENT_ID = 1234
     * $query->filterByEventId(array(12, 34)); // WHERE EVENT_ID IN (12, 34)
     * $query->filterByEventId(array('min' => 12)); // WHERE EVENT_ID > 12
     * </code>
     *
     * @see       filterBySysEvent()
     *
     * @param mixed $eventId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventId($eventId = null, ?string $comparison = null)
    {
        if (is_array($eventId)) {
            $useMinMax = false;
            if (isset($eventId['min'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventId['max'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEventUserTableMap::COL_EVENT_ID, $eventId, $comparison);

        return $this;
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
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEventUserTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE DATE = '2011-03-14'
     * $query->filterByDate('now'); // WHERE DATE = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE DATE > '2011-03-13'
     * </code>
     *
     * @param mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDate($date = null, ?string $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(SysEventUserTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEventUserTableMap::COL_DATE, $date, $comparison);

        return $this;
    }

    /**
     * Filter the query on the MESSAGE column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE MESSAGE = 'fooValue'
     * $query->filterByMessage('%fooValue%', Criteria::LIKE); // WHERE MESSAGE LIKE '%fooValue%'
     * $query->filterByMessage(['foo', 'bar']); // WHERE MESSAGE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $message The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMessage($message = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEventUserTableMap::COL_MESSAGE, $message, $comparison);

        return $this;
    }

    /**
     * Filter the query on the DETAILS column
     *
     * Example usage:
     * <code>
     * $query->filterByDetails('fooValue');   // WHERE DETAILS = 'fooValue'
     * $query->filterByDetails('%fooValue%', Criteria::LIKE); // WHERE DETAILS LIKE '%fooValue%'
     * $query->filterByDetails(['foo', 'bar']); // WHERE DETAILS IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $details The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDetails($details = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($details)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEventUserTableMap::COL_DETAILS, $details, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysEvent object
     *
     * @param \SysEvent|ObjectCollection $sysEvent The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEvent($sysEvent, ?string $comparison = null)
    {
        if ($sysEvent instanceof \SysEvent) {
            return $this
                ->addUsingAlias(SysEventUserTableMap::COL_EVENT_ID, $sysEvent->getId(), $comparison);
        } elseif ($sysEvent instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEventUserTableMap::COL_EVENT_ID, $sysEvent->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysEvent() only accepts arguments of type \SysEvent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEvent relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEvent(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEvent');

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
            $this->addJoinObject($join, 'SysEvent');
        }

        return $this;
    }

    /**
     * Use the SysEvent relation SysEvent object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEventQuery A secondary query class using the current class as primary query
     */
    public function useSysEventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEvent', '\SysEventQuery');
    }

    /**
     * Use the SysEvent relation SysEvent object
     *
     * @param callable(\SysEventQuery):\SysEventQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEventQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEventQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEvent table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEventQuery The inner query object of the EXISTS statement
     */
    public function useSysEventExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEventQuery */
        $q = $this->useExistsQuery('SysEvent', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEvent table for a NOT EXISTS query.
     *
     * @see useSysEventExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEventQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEventNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEventQuery */
        $q = $this->useExistsQuery('SysEvent', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEvent table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEventQuery The inner query object of the IN statement
     */
    public function useInSysEventQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEventQuery */
        $q = $this->useInQuery('SysEvent', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEvent table for a NOT IN query.
     *
     * @see useSysEventInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEventQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEventQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEventQuery */
        $q = $this->useInQuery('SysEvent', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysUser object
     *
     * @param \SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, ?string $comparison = null)
    {
        if ($sysUser instanceof \SysUser) {
            return $this
                ->addUsingAlias(SysEventUserTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEventUserTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysUser() only accepts arguments of type \SysUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
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
     * Use the SysUser relation SysUser object
     *
     * @param callable(\SysUserQuery):\SysUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysUserQuery The inner query object of the EXISTS statement
     */
    public function useSysUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysUserQuery */
        $q = $this->useExistsQuery('SysUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysUser table for a NOT EXISTS query.
     *
     * @see useSysUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserQuery */
        $q = $this->useExistsQuery('SysUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysUserQuery The inner query object of the IN statement
     */
    public function useInSysUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysUserQuery */
        $q = $this->useInQuery('SysUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysUser table for a NOT IN query.
     *
     * @see useSysUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserQuery */
        $q = $this->useInQuery('SysUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSysEventUser $sysEventUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysEventUser = null)
    {
        if ($sysEventUser) {
            $this->addUsingAlias(SysEventUserTableMap::COL_ID, $sysEventUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_event_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEventUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEventUserTableMap::clearInstancePool();
            SysEventUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEventUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEventUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEventUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEventUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
