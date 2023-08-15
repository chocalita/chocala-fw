<?php

namespace Base;

use \SysUserXRol as ChildSysUserXRol;
use \SysUserXRolQuery as ChildSysUserXRolQuery;
use \Exception;
use \PDO;
use Map\SysUserXRolTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_user_x_rol` table.
 *
 * @method     ChildSysUserXRolQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysUserXRolQuery orderByRolId($order = Criteria::ASC) Order by the ROL_ID column
 *
 * @method     ChildSysUserXRolQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysUserXRolQuery groupByRolId() Group by the ROL_ID column
 *
 * @method     ChildSysUserXRolQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysUserXRolQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysUserXRolQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysUserXRolQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysUserXRolQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysUserXRolQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysUserXRolQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysUserXRolQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysUserXRolQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildSysUserXRolQuery joinWithSysUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUser relation
 *
 * @method     ChildSysUserXRolQuery leftJoinWithSysUser() Adds a LEFT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysUserXRolQuery rightJoinWithSysUser() Adds a RIGHT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysUserXRolQuery innerJoinWithSysUser() Adds a INNER JOIN clause and with to the query using the SysUser relation
 *
 * @method     ChildSysUserXRolQuery leftJoinSysRol($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRol relation
 * @method     ChildSysUserXRolQuery rightJoinSysRol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRol relation
 * @method     ChildSysUserXRolQuery innerJoinSysRol($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRol relation
 *
 * @method     ChildSysUserXRolQuery joinWithSysRol($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysRol relation
 *
 * @method     ChildSysUserXRolQuery leftJoinWithSysRol() Adds a LEFT JOIN clause and with to the query using the SysRol relation
 * @method     ChildSysUserXRolQuery rightJoinWithSysRol() Adds a RIGHT JOIN clause and with to the query using the SysRol relation
 * @method     ChildSysUserXRolQuery innerJoinWithSysRol() Adds a INNER JOIN clause and with to the query using the SysRol relation
 *
 * @method     \SysUserQuery|\SysRolQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysUserXRol|null findOne(?ConnectionInterface $con = null) Return the first ChildSysUserXRol matching the query
 * @method     ChildSysUserXRol findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysUserXRol matching the query, or a new ChildSysUserXRol object populated from the query conditions when no match is found
 *
 * @method     ChildSysUserXRol|null findOneByUserId(int $USER_ID) Return the first ChildSysUserXRol filtered by the USER_ID column
 * @method     ChildSysUserXRol|null findOneByRolId(int $ROL_ID) Return the first ChildSysUserXRol filtered by the ROL_ID column
 *
 * @method     ChildSysUserXRol requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysUserXRol by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUserXRol requireOne(?ConnectionInterface $con = null) Return the first ChildSysUserXRol matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUserXRol requireOneByUserId(int $USER_ID) Return the first ChildSysUserXRol filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUserXRol requireOneByRolId(int $ROL_ID) Return the first ChildSysUserXRol filtered by the ROL_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUserXRol[]|Collection find(?ConnectionInterface $con = null) Return ChildSysUserXRol objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysUserXRol> find(?ConnectionInterface $con = null) Return ChildSysUserXRol objects based on current ModelCriteria
 *
 * @method     ChildSysUserXRol[]|Collection findByUserId(int|array<int> $USER_ID) Return ChildSysUserXRol objects filtered by the USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysUserXRol> findByUserId(int|array<int> $USER_ID) Return ChildSysUserXRol objects filtered by the USER_ID column
 * @method     ChildSysUserXRol[]|Collection findByRolId(int|array<int> $ROL_ID) Return ChildSysUserXRol objects filtered by the ROL_ID column
 * @psalm-method Collection&\Traversable<ChildSysUserXRol> findByRolId(int|array<int> $ROL_ID) Return ChildSysUserXRol objects filtered by the ROL_ID column
 *
 * @method     ChildSysUserXRol[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysUserXRol> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysUserXRolQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysUserXRolQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysUserXRol', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysUserXRolQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysUserXRolQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysUserXRolQuery) {
            return $criteria;
        }
        $query = new ChildSysUserXRolQuery();
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
     * @param array[$USER_ID, $ROL_ID] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSysUserXRol|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysUserXRolTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysUserXRolTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildSysUserXRol A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT USER_ID, ROL_ID FROM sys_user_x_rol WHERE USER_ID = :p0 AND ROL_ID = :p1';
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
            /** @var ChildSysUserXRol $obj */
            $obj = new ChildSysUserXRol();
            $obj->hydrate($row);
            SysUserXRolTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildSysUserXRol|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $key[1], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SysUserXRolTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SysUserXRolTableMap::COL_ROL_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

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
                $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $userId, $comparison);

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
                $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $rolId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolId['max'])) {
                $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $rolId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $rolId, $comparison);

        return $this;
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
                ->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $sysRol->getId(), $comparison);
        } elseif ($sysRol instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $sysRol->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildSysUserXRol $sysUserXRol Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysUserXRol = null)
    {
        if ($sysUserXRol) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SysUserXRolTableMap::COL_USER_ID), $sysUserXRol->getUserId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SysUserXRolTableMap::COL_ROL_ID), $sysUserXRol->getRolId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_user_x_rol table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserXRolTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysUserXRolTableMap::clearInstancePool();
            SysUserXRolTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserXRolTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysUserXRolTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysUserXRolTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysUserXRolTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
