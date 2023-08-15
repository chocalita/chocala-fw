<?php

namespace Base;

use \SysRol as ChildSysRol;
use \SysRolQuery as ChildSysRolQuery;
use \Exception;
use \PDO;
use Map\SysRolTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_rol` table.
 *
 * @method     ChildSysRolQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysRolQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysRolQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysRolQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 *
 * @method     ChildSysRolQuery groupById() Group by the ID column
 * @method     ChildSysRolQuery groupByCode() Group by the CODE column
 * @method     ChildSysRolQuery groupByName() Group by the NAME column
 * @method     ChildSysRolQuery groupByDescription() Group by the DESCRIPTION column
 *
 * @method     ChildSysRolQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysRolQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysRolQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysRolQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysRolQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysRolQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysRolQuery leftJoinSysEntityUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysRolQuery rightJoinSysEntityUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysRolQuery innerJoinSysEntityUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityUser relation
 *
 * @method     ChildSysRolQuery joinWithSysEntityUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityUser relation
 *
 * @method     ChildSysRolQuery leftJoinWithSysEntityUser() Adds a LEFT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysRolQuery rightJoinWithSysEntityUser() Adds a RIGHT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysRolQuery innerJoinWithSysEntityUser() Adds a INNER JOIN clause and with to the query using the SysEntityUser relation
 *
 * @method     ChildSysRolQuery leftJoinSysRolXUri($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRolXUri relation
 * @method     ChildSysRolQuery rightJoinSysRolXUri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRolXUri relation
 * @method     ChildSysRolQuery innerJoinSysRolXUri($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRolXUri relation
 *
 * @method     ChildSysRolQuery joinWithSysRolXUri($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysRolXUri relation
 *
 * @method     ChildSysRolQuery leftJoinWithSysRolXUri() Adds a LEFT JOIN clause and with to the query using the SysRolXUri relation
 * @method     ChildSysRolQuery rightJoinWithSysRolXUri() Adds a RIGHT JOIN clause and with to the query using the SysRolXUri relation
 * @method     ChildSysRolQuery innerJoinWithSysRolXUri() Adds a INNER JOIN clause and with to the query using the SysRolXUri relation
 *
 * @method     ChildSysRolQuery leftJoinSysUserXRol($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUserXRol relation
 * @method     ChildSysRolQuery rightJoinSysUserXRol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUserXRol relation
 * @method     ChildSysRolQuery innerJoinSysUserXRol($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUserXRol relation
 *
 * @method     ChildSysRolQuery joinWithSysUserXRol($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUserXRol relation
 *
 * @method     ChildSysRolQuery leftJoinWithSysUserXRol() Adds a LEFT JOIN clause and with to the query using the SysUserXRol relation
 * @method     ChildSysRolQuery rightJoinWithSysUserXRol() Adds a RIGHT JOIN clause and with to the query using the SysUserXRol relation
 * @method     ChildSysRolQuery innerJoinWithSysUserXRol() Adds a INNER JOIN clause and with to the query using the SysUserXRol relation
 *
 * @method     \SysEntityUserQuery|\SysRolXUriQuery|\SysUserXRolQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysRol|null findOne(?ConnectionInterface $con = null) Return the first ChildSysRol matching the query
 * @method     ChildSysRol findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysRol matching the query, or a new ChildSysRol object populated from the query conditions when no match is found
 *
 * @method     ChildSysRol|null findOneById(int $ID) Return the first ChildSysRol filtered by the ID column
 * @method     ChildSysRol|null findOneByCode(string $CODE) Return the first ChildSysRol filtered by the CODE column
 * @method     ChildSysRol|null findOneByName(string $NAME) Return the first ChildSysRol filtered by the NAME column
 * @method     ChildSysRol|null findOneByDescription(string $DESCRIPTION) Return the first ChildSysRol filtered by the DESCRIPTION column
 *
 * @method     ChildSysRol requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysRol by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRol requireOne(?ConnectionInterface $con = null) Return the first ChildSysRol matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysRol requireOneById(int $ID) Return the first ChildSysRol filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRol requireOneByCode(string $CODE) Return the first ChildSysRol filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRol requireOneByName(string $NAME) Return the first ChildSysRol filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRol requireOneByDescription(string $DESCRIPTION) Return the first ChildSysRol filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysRol[]|Collection find(?ConnectionInterface $con = null) Return ChildSysRol objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysRol> find(?ConnectionInterface $con = null) Return ChildSysRol objects based on current ModelCriteria
 *
 * @method     ChildSysRol[]|Collection findById(int|array<int> $ID) Return ChildSysRol objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysRol> findById(int|array<int> $ID) Return ChildSysRol objects filtered by the ID column
 * @method     ChildSysRol[]|Collection findByCode(string|array<string> $CODE) Return ChildSysRol objects filtered by the CODE column
 * @psalm-method Collection&\Traversable<ChildSysRol> findByCode(string|array<string> $CODE) Return ChildSysRol objects filtered by the CODE column
 * @method     ChildSysRol[]|Collection findByName(string|array<string> $NAME) Return ChildSysRol objects filtered by the NAME column
 * @psalm-method Collection&\Traversable<ChildSysRol> findByName(string|array<string> $NAME) Return ChildSysRol objects filtered by the NAME column
 * @method     ChildSysRol[]|Collection findByDescription(string|array<string> $DESCRIPTION) Return ChildSysRol objects filtered by the DESCRIPTION column
 * @psalm-method Collection&\Traversable<ChildSysRol> findByDescription(string|array<string> $DESCRIPTION) Return ChildSysRol objects filtered by the DESCRIPTION column
 *
 * @method     ChildSysRol[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysRol> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysRolQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysRolQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysRol', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysRolQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysRolQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysRolQuery) {
            return $criteria;
        }
        $query = new ChildSysRolQuery();
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
     * @return ChildSysRol|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysRolTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysRolTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysRol A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, CODE, NAME, DESCRIPTION FROM sys_rol WHERE ID = :p0';
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
            /** @var ChildSysRol $obj */
            $obj = new ChildSysRol();
            $obj->hydrate($row);
            SysRolTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysRol|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SysRolTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysRolTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SysRolTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysRolTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysRolTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE CODE = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE CODE LIKE '%fooValue%'
     * $query->filterByCode(['foo', 'bar']); // WHERE CODE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $code The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode($code = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysRolTableMap::COL_CODE, $code, $comparison);

        return $this;
    }

    /**
     * Filter the query on the NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE NAME = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE NAME LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE NAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysRolTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the DESCRIPTION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE DESCRIPTION = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE DESCRIPTION LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE DESCRIPTION IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysRolTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysEntityUser object
     *
     * @param \SysEntityUser|ObjectCollection $sysEntityUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEntityUser($sysEntityUser, ?string $comparison = null)
    {
        if ($sysEntityUser instanceof \SysEntityUser) {
            $this
                ->addUsingAlias(SysRolTableMap::COL_ID, $sysEntityUser->getRolId(), $comparison);

            return $this;
        } elseif ($sysEntityUser instanceof ObjectCollection) {
            $this
                ->useSysEntityUserQuery()
                ->filterByPrimaryKeys($sysEntityUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysEntityUser() only accepts arguments of type \SysEntityUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEntityUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityUser');

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
            $this->addJoinObject($join, 'SysEntityUser');
        }

        return $this;
    }

    /**
     * Use the SysEntityUser relation SysEntityUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityUserQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityUser', '\SysEntityUserQuery');
    }

    /**
     * Use the SysEntityUser relation SysEntityUser object
     *
     * @param callable(\SysEntityUserQuery):\SysEntityUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEntityUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEntityUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEntityUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEntityUserQuery The inner query object of the EXISTS statement
     */
    public function useSysEntityUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useExistsQuery('SysEntityUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEntityUser table for a NOT EXISTS query.
     *
     * @see useSysEntityUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEntityUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEntityUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useExistsQuery('SysEntityUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEntityUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEntityUserQuery The inner query object of the IN statement
     */
    public function useInSysEntityUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useInQuery('SysEntityUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEntityUser table for a NOT IN query.
     *
     * @see useSysEntityUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEntityUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEntityUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useInQuery('SysEntityUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysRolXUri object
     *
     * @param \SysRolXUri|ObjectCollection $sysRolXUri the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysRolXUri($sysRolXUri, ?string $comparison = null)
    {
        if ($sysRolXUri instanceof \SysRolXUri) {
            $this
                ->addUsingAlias(SysRolTableMap::COL_ID, $sysRolXUri->getRolId(), $comparison);

            return $this;
        } elseif ($sysRolXUri instanceof ObjectCollection) {
            $this
                ->useSysRolXUriQuery()
                ->filterByPrimaryKeys($sysRolXUri->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysRolXUri() only accepts arguments of type \SysRolXUri or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysRolXUri relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysRolXUri(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysRolXUri');

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
            $this->addJoinObject($join, 'SysRolXUri');
        }

        return $this;
    }

    /**
     * Use the SysRolXUri relation SysRolXUri object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysRolXUriQuery A secondary query class using the current class as primary query
     */
    public function useSysRolXUriQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysRolXUri($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysRolXUri', '\SysRolXUriQuery');
    }

    /**
     * Use the SysRolXUri relation SysRolXUri object
     *
     * @param callable(\SysRolXUriQuery):\SysRolXUriQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysRolXUriQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysRolXUriQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysRolXUri table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysRolXUriQuery The inner query object of the EXISTS statement
     */
    public function useSysRolXUriExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysRolXUriQuery */
        $q = $this->useExistsQuery('SysRolXUri', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysRolXUri table for a NOT EXISTS query.
     *
     * @see useSysRolXUriExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysRolXUriQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysRolXUriNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysRolXUriQuery */
        $q = $this->useExistsQuery('SysRolXUri', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysRolXUri table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysRolXUriQuery The inner query object of the IN statement
     */
    public function useInSysRolXUriQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysRolXUriQuery */
        $q = $this->useInQuery('SysRolXUri', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysRolXUri table for a NOT IN query.
     *
     * @see useSysRolXUriInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysRolXUriQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysRolXUriQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysRolXUriQuery */
        $q = $this->useInQuery('SysRolXUri', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysUserXRol object
     *
     * @param \SysUserXRol|ObjectCollection $sysUserXRol the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysUserXRol($sysUserXRol, ?string $comparison = null)
    {
        if ($sysUserXRol instanceof \SysUserXRol) {
            $this
                ->addUsingAlias(SysRolTableMap::COL_ID, $sysUserXRol->getRolId(), $comparison);

            return $this;
        } elseif ($sysUserXRol instanceof ObjectCollection) {
            $this
                ->useSysUserXRolQuery()
                ->filterByPrimaryKeys($sysUserXRol->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysUserXRol() only accepts arguments of type \SysUserXRol or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUserXRol relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysUserXRol(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUserXRol');

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
            $this->addJoinObject($join, 'SysUserXRol');
        }

        return $this;
    }

    /**
     * Use the SysUserXRol relation SysUserXRol object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysUserXRolQuery A secondary query class using the current class as primary query
     */
    public function useSysUserXRolQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUserXRol($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUserXRol', '\SysUserXRolQuery');
    }

    /**
     * Use the SysUserXRol relation SysUserXRol object
     *
     * @param callable(\SysUserXRolQuery):\SysUserXRolQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysUserXRolQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysUserXRolQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysUserXRol table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysUserXRolQuery The inner query object of the EXISTS statement
     */
    public function useSysUserXRolExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useExistsQuery('SysUserXRol', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysUserXRol table for a NOT EXISTS query.
     *
     * @see useSysUserXRolExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysUserXRolQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysUserXRolNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useExistsQuery('SysUserXRol', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysUserXRol table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysUserXRolQuery The inner query object of the IN statement
     */
    public function useInSysUserXRolQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useInQuery('SysUserXRol', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysUserXRol table for a NOT IN query.
     *
     * @see useSysUserXRolInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysUserXRolQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysUserXRolQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useInQuery('SysUserXRol', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSysRol $sysRol Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysRol = null)
    {
        if ($sysRol) {
            $this->addUsingAlias(SysRolTableMap::COL_ID, $sysRol->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_rol table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysRolTableMap::clearInstancePool();
            SysRolTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysRolTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysRolTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysRolTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
