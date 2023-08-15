<?php

namespace Base;

use \SysEntityType as ChildSysEntityType;
use \SysEntityTypeQuery as ChildSysEntityTypeQuery;
use \Exception;
use \PDO;
use Map\SysEntityTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_entity_type` table.
 *
 * @method     ChildSysEntityTypeQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEntityTypeQuery orderByGroupCode($order = Criteria::ASC) Order by the GROUP_CODE column
 * @method     ChildSysEntityTypeQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysEntityTypeQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysEntityTypeQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 *
 * @method     ChildSysEntityTypeQuery groupById() Group by the ID column
 * @method     ChildSysEntityTypeQuery groupByGroupCode() Group by the GROUP_CODE column
 * @method     ChildSysEntityTypeQuery groupByCode() Group by the CODE column
 * @method     ChildSysEntityTypeQuery groupByName() Group by the NAME column
 * @method     ChildSysEntityTypeQuery groupByDescription() Group by the DESCRIPTION column
 *
 * @method     ChildSysEntityTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEntityTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEntityTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEntityTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEntityTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEntityTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEntityTypeQuery leftJoinSysEntity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityTypeQuery rightJoinSysEntity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityTypeQuery innerJoinSysEntity($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntity relation
 *
 * @method     ChildSysEntityTypeQuery joinWithSysEntity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysEntityTypeQuery leftJoinWithSysEntity() Adds a LEFT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityTypeQuery rightJoinWithSysEntity() Adds a RIGHT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityTypeQuery innerJoinWithSysEntity() Adds a INNER JOIN clause and with to the query using the SysEntity relation
 *
 * @method     \SysEntityQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEntityType|null findOne(?ConnectionInterface $con = null) Return the first ChildSysEntityType matching the query
 * @method     ChildSysEntityType findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysEntityType matching the query, or a new ChildSysEntityType object populated from the query conditions when no match is found
 *
 * @method     ChildSysEntityType|null findOneById(int $ID) Return the first ChildSysEntityType filtered by the ID column
 * @method     ChildSysEntityType|null findOneByGroupCode(string $GROUP_CODE) Return the first ChildSysEntityType filtered by the GROUP_CODE column
 * @method     ChildSysEntityType|null findOneByCode(string $CODE) Return the first ChildSysEntityType filtered by the CODE column
 * @method     ChildSysEntityType|null findOneByName(string $NAME) Return the first ChildSysEntityType filtered by the NAME column
 * @method     ChildSysEntityType|null findOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityType filtered by the DESCRIPTION column
 *
 * @method     ChildSysEntityType requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysEntityType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOne(?ConnectionInterface $con = null) Return the first ChildSysEntityType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityType requireOneById(int $ID) Return the first ChildSysEntityType filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByGroupCode(string $GROUP_CODE) Return the first ChildSysEntityType filtered by the GROUP_CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByCode(string $CODE) Return the first ChildSysEntityType filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByName(string $NAME) Return the first ChildSysEntityType filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityType filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityType[]|Collection find(?ConnectionInterface $con = null) Return ChildSysEntityType objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysEntityType> find(?ConnectionInterface $con = null) Return ChildSysEntityType objects based on current ModelCriteria
 *
 * @method     ChildSysEntityType[]|Collection findById(int|array<int> $ID) Return ChildSysEntityType objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityType> findById(int|array<int> $ID) Return ChildSysEntityType objects filtered by the ID column
 * @method     ChildSysEntityType[]|Collection findByGroupCode(string|array<string> $GROUP_CODE) Return ChildSysEntityType objects filtered by the GROUP_CODE column
 * @psalm-method Collection&\Traversable<ChildSysEntityType> findByGroupCode(string|array<string> $GROUP_CODE) Return ChildSysEntityType objects filtered by the GROUP_CODE column
 * @method     ChildSysEntityType[]|Collection findByCode(string|array<string> $CODE) Return ChildSysEntityType objects filtered by the CODE column
 * @psalm-method Collection&\Traversable<ChildSysEntityType> findByCode(string|array<string> $CODE) Return ChildSysEntityType objects filtered by the CODE column
 * @method     ChildSysEntityType[]|Collection findByName(string|array<string> $NAME) Return ChildSysEntityType objects filtered by the NAME column
 * @psalm-method Collection&\Traversable<ChildSysEntityType> findByName(string|array<string> $NAME) Return ChildSysEntityType objects filtered by the NAME column
 * @method     ChildSysEntityType[]|Collection findByDescription(string|array<string> $DESCRIPTION) Return ChildSysEntityType objects filtered by the DESCRIPTION column
 * @psalm-method Collection&\Traversable<ChildSysEntityType> findByDescription(string|array<string> $DESCRIPTION) Return ChildSysEntityType objects filtered by the DESCRIPTION column
 *
 * @method     ChildSysEntityType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysEntityType> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysEntityTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEntityTypeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEntityType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEntityTypeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEntityTypeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysEntityTypeQuery) {
            return $criteria;
        }
        $query = new ChildSysEntityTypeQuery();
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
     * @return ChildSysEntityType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityTypeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEntityTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEntityType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, GROUP_CODE, CODE, NAME, DESCRIPTION FROM sys_entity_type WHERE ID = :p0';
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
            /** @var ChildSysEntityType $obj */
            $obj = new ChildSysEntityType();
            $obj->hydrate($row);
            SysEntityTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEntityType|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the GROUP_CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupCode('fooValue');   // WHERE GROUP_CODE = 'fooValue'
     * $query->filterByGroupCode('%fooValue%', Criteria::LIKE); // WHERE GROUP_CODE LIKE '%fooValue%'
     * $query->filterByGroupCode(['foo', 'bar']); // WHERE GROUP_CODE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $groupCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupCode($groupCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTypeTableMap::COL_GROUP_CODE, $groupCode, $comparison);

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

        $this->addUsingAlias(SysEntityTypeTableMap::COL_CODE, $code, $comparison);

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

        $this->addUsingAlias(SysEntityTypeTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(SysEntityTypeTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysEntity object
     *
     * @param \SysEntity|ObjectCollection $sysEntity the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEntity($sysEntity, ?string $comparison = null)
    {
        if ($sysEntity instanceof \SysEntity) {
            $this
                ->addUsingAlias(SysEntityTypeTableMap::COL_ID, $sysEntity->getEntityTypeId(), $comparison);

            return $this;
        } elseif ($sysEntity instanceof ObjectCollection) {
            $this
                ->useSysEntityQuery()
                ->filterByPrimaryKeys($sysEntity->getPrimaryKeys())
                ->endUse();

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
     * Exclude object from result
     *
     * @param ChildSysEntityType $sysEntityType Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysEntityType = null)
    {
        if ($sysEntityType) {
            $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $sysEntityType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_entity_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEntityTypeTableMap::clearInstancePool();
            SysEntityTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEntityTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEntityTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEntityTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
