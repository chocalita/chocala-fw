<?php

namespace Base;

use \SysEntityUser as ChildSysEntityUser;
use \SysEntityUserQuery as ChildSysEntityUserQuery;
use \Exception;
use \PDO;
use Map\SysEntityUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_entity_user` table.
 *
 * @method     ChildSysEntityUserQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEntityUserQuery orderByEntityId($order = Criteria::ASC) Order by the ENTITY_ID column
 * @method     ChildSysEntityUserQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysEntityUserQuery orderByRolId($order = Criteria::ASC) Order by the ROL_ID column
 * @method     ChildSysEntityUserQuery orderByActive($order = Criteria::ASC) Order by the ACTIVE column
 * @method     ChildSysEntityUserQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysEntityUserQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysEntityUserQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityUserQuery groupById() Group by the ID column
 * @method     ChildSysEntityUserQuery groupByEntityId() Group by the ENTITY_ID column
 * @method     ChildSysEntityUserQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysEntityUserQuery groupByRolId() Group by the ROL_ID column
 * @method     ChildSysEntityUserQuery groupByActive() Group by the ACTIVE column
 * @method     ChildSysEntityUserQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysEntityUserQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysEntityUserQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEntityUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEntityUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEntityUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEntityUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEntityUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEntityUserQuery leftJoinSysEntity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityUserQuery rightJoinSysEntity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityUserQuery innerJoinSysEntity($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntity relation
 *
 * @method     ChildSysEntityUserQuery joinWithSysEntity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysEntityUserQuery leftJoinWithSysEntity() Adds a LEFT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityUserQuery rightJoinWithSysEntity() Adds a RIGHT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityUserQuery innerJoinWithSysEntity() Adds a INNER JOIN clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysEntityUserQuery leftJoinSysRol($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRol relation
 * @method     ChildSysEntityUserQuery rightJoinSysRol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRol relation
 * @method     ChildSysEntityUserQuery innerJoinSysRol($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRol relation
 *
 * @method     ChildSysEntityUserQuery joinWithSysRol($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysRol relation
 *
 * @method     ChildSysEntityUserQuery leftJoinWithSysRol() Adds a LEFT JOIN clause and with to the query using the SysRol relation
 * @method     ChildSysEntityUserQuery rightJoinWithSysRol() Adds a RIGHT JOIN clause and with to the query using the SysRol relation
 * @method     ChildSysEntityUserQuery innerJoinWithSysRol() Adds a INNER JOIN clause and with to the query using the SysRol relation
 *
 * @method     ChildSysEntityUserQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysEntityUserQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysEntityUserQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildSysEntityUserQuery joinWithSysUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUser relation
 *
 * @method     ChildSysEntityUserQuery leftJoinWithSysUser() Adds a LEFT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysEntityUserQuery rightJoinWithSysUser() Adds a RIGHT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysEntityUserQuery innerJoinWithSysUser() Adds a INNER JOIN clause and with to the query using the SysUser relation
 *
 * @method     \SysEntityQuery|\SysRolQuery|\SysUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEntityUser|null findOne(?ConnectionInterface $con = null) Return the first ChildSysEntityUser matching the query
 * @method     ChildSysEntityUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysEntityUser matching the query, or a new ChildSysEntityUser object populated from the query conditions when no match is found
 *
 * @method     ChildSysEntityUser|null findOneById(int $ID) Return the first ChildSysEntityUser filtered by the ID column
 * @method     ChildSysEntityUser|null findOneByEntityId(int $ENTITY_ID) Return the first ChildSysEntityUser filtered by the ENTITY_ID column
 * @method     ChildSysEntityUser|null findOneByUserId(int $USER_ID) Return the first ChildSysEntityUser filtered by the USER_ID column
 * @method     ChildSysEntityUser|null findOneByRolId(int $ROL_ID) Return the first ChildSysEntityUser filtered by the ROL_ID column
 * @method     ChildSysEntityUser|null findOneByActive(boolean $ACTIVE) Return the first ChildSysEntityUser filtered by the ACTIVE column
 * @method     ChildSysEntityUser|null findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntityUser filtered by the LAST_USER_ID column
 * @method     ChildSysEntityUser|null findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntityUser filtered by the CREATION_DATE column
 * @method     ChildSysEntityUser|null findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysEntityUser filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysEntityUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOne(?ConnectionInterface $con = null) Return the first ChildSysEntityUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityUser requireOneById(int $ID) Return the first ChildSysEntityUser filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOneByEntityId(int $ENTITY_ID) Return the first ChildSysEntityUser filtered by the ENTITY_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOneByUserId(int $USER_ID) Return the first ChildSysEntityUser filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOneByRolId(int $ROL_ID) Return the first ChildSysEntityUser filtered by the ROL_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOneByActive(boolean $ACTIVE) Return the first ChildSysEntityUser filtered by the ACTIVE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntityUser filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntityUser filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityUser requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysEntityUser filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityUser[]|Collection find(?ConnectionInterface $con = null) Return ChildSysEntityUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> find(?ConnectionInterface $con = null) Return ChildSysEntityUser objects based on current ModelCriteria
 *
 * @method     ChildSysEntityUser[]|Collection findById(int|array<int> $ID) Return ChildSysEntityUser objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findById(int|array<int> $ID) Return ChildSysEntityUser objects filtered by the ID column
 * @method     ChildSysEntityUser[]|Collection findByEntityId(int|array<int> $ENTITY_ID) Return ChildSysEntityUser objects filtered by the ENTITY_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findByEntityId(int|array<int> $ENTITY_ID) Return ChildSysEntityUser objects filtered by the ENTITY_ID column
 * @method     ChildSysEntityUser[]|Collection findByUserId(int|array<int> $USER_ID) Return ChildSysEntityUser objects filtered by the USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findByUserId(int|array<int> $USER_ID) Return ChildSysEntityUser objects filtered by the USER_ID column
 * @method     ChildSysEntityUser[]|Collection findByRolId(int|array<int> $ROL_ID) Return ChildSysEntityUser objects filtered by the ROL_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findByRolId(int|array<int> $ROL_ID) Return ChildSysEntityUser objects filtered by the ROL_ID column
 * @method     ChildSysEntityUser[]|Collection findByActive(boolean|array<boolean> $ACTIVE) Return ChildSysEntityUser objects filtered by the ACTIVE column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findByActive(boolean|array<boolean> $ACTIVE) Return ChildSysEntityUser objects filtered by the ACTIVE column
 * @method     ChildSysEntityUser[]|Collection findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysEntityUser objects filtered by the LAST_USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysEntityUser objects filtered by the LAST_USER_ID column
 * @method     ChildSysEntityUser[]|Collection findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysEntityUser objects filtered by the CREATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysEntityUser objects filtered by the CREATION_DATE column
 * @method     ChildSysEntityUser[]|Collection findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysEntityUser objects filtered by the MODIFICATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysEntityUser> findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysEntityUser objects filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysEntityUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysEntityUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEntityUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEntityUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEntityUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEntityUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysEntityUserQuery) {
            return $criteria;
        }
        $query = new ChildSysEntityUserQuery();
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
     * @return ChildSysEntityUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEntityUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEntityUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ENTITY_ID, USER_ID, ROL_ID, ACTIVE, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_entity_user WHERE ID = :p0';
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
            /** @var ChildSysEntityUser $obj */
            $obj = new ChildSysEntityUser();
            $obj->hydrate($row);
            SysEntityUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEntityUser|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SysEntityUserTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysEntityUserTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SysEntityUserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ENTITY_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityId(1234); // WHERE ENTITY_ID = 1234
     * $query->filterByEntityId(array(12, 34)); // WHERE ENTITY_ID IN (12, 34)
     * $query->filterByEntityId(array('min' => 12)); // WHERE ENTITY_ID > 12
     * </code>
     *
     * @see       filterBySysEntity()
     *
     * @param mixed $entityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, ?string $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_ENTITY_ID, $entityId, $comparison);

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
                $this->addUsingAlias(SysEntityUserTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
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
     * @param mixed $rolId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRolId($rolId = null, ?string $comparison = null)
    {
        if (is_array($rolId)) {
            $useMinMax = false;
            if (isset($rolId['min'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_ROL_ID, $rolId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolId['max'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_ROL_ID, $rolId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_ROL_ID, $rolId, $comparison);

        return $this;
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
     * @param bool|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActive($active = null, ?string $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_ACTIVE, $active, $comparison);

        return $this;
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
     * @param mixed $lastUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, ?string $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);

        return $this;
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
     * @param mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, ?string $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_CREATION_DATE, $creationDate, $comparison);

        return $this;
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
     * @param mixed $modificationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, ?string $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysEntityUserTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityUserTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysEntity object
     *
     * @param \SysEntity|ObjectCollection $sysEntity The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEntity($sysEntity, ?string $comparison = null)
    {
        if ($sysEntity instanceof \SysEntity) {
            return $this
                ->addUsingAlias(SysEntityUserTableMap::COL_ENTITY_ID, $sysEntity->getId(), $comparison);
        } elseif ($sysEntity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEntityUserTableMap::COL_ENTITY_ID, $sysEntity->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysEntity() only accepts arguments of type \SysEntity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntity relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEntity(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntity');

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
            $this->addJoinObject($join, 'SysEntity');
        }

        return $this;
    }

    /**
     * Use the SysEntity relation SysEntity object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntity', '\SysEntityQuery');
    }

    /**
     * Use the SysEntity relation SysEntity object
     *
     * @param callable(\SysEntityQuery):\SysEntityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEntityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEntityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEntity table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEntityQuery The inner query object of the EXISTS statement
     */
    public function useSysEntityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEntityQuery */
        $q = $this->useExistsQuery('SysEntity', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEntity table for a NOT EXISTS query.
     *
     * @see useSysEntityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEntityQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEntityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityQuery */
        $q = $this->useExistsQuery('SysEntity', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEntity table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEntityQuery The inner query object of the IN statement
     */
    public function useInSysEntityQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEntityQuery */
        $q = $this->useInQuery('SysEntity', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEntity table for a NOT IN query.
     *
     * @see useSysEntityInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEntityQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEntityQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityQuery */
        $q = $this->useInQuery('SysEntity', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysRol object
     *
     * @param \SysRol|ObjectCollection $sysRol The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysRol($sysRol, ?string $comparison = null)
    {
        if ($sysRol instanceof \SysRol) {
            return $this
                ->addUsingAlias(SysEntityUserTableMap::COL_ROL_ID, $sysRol->getId(), $comparison);
        } elseif ($sysRol instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEntityUserTableMap::COL_ROL_ID, $sysRol->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysRol() only accepts arguments of type \SysRol or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysRol relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysRol(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
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
     * Use the SysRol relation SysRol object
     *
     * @param callable(\SysRolQuery):\SysRolQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysRolQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysRolQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysRol table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysRolQuery The inner query object of the EXISTS statement
     */
    public function useSysRolExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysRolQuery */
        $q = $this->useExistsQuery('SysRol', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysRol table for a NOT EXISTS query.
     *
     * @see useSysRolExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysRolQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysRolNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysRolQuery */
        $q = $this->useExistsQuery('SysRol', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysRol table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysRolQuery The inner query object of the IN statement
     */
    public function useInSysRolQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysRolQuery */
        $q = $this->useInQuery('SysRol', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysRol table for a NOT IN query.
     *
     * @see useSysRolInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysRolQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysRolQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysRolQuery */
        $q = $this->useInQuery('SysRol', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SysEntityUserTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEntityUserTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * @param ChildSysEntityUser $sysEntityUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysEntityUser = null)
    {
        if ($sysEntityUser) {
            $this->addUsingAlias(SysEntityUserTableMap::COL_ID, $sysEntityUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_entity_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEntityUserTableMap::clearInstancePool();
            SysEntityUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEntityUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEntityUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEntityUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
