<?php

namespace Base;

use \SysModule as ChildSysModule;
use \SysModuleQuery as ChildSysModuleQuery;
use \Exception;
use \PDO;
use Map\SysModuleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_module` table.
 *
 * @method     ChildSysModuleQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysModuleQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysModuleQuery orderByUri($order = Criteria::ASC) Order by the URI column
 * @method     ChildSysModuleQuery orderByAccess($order = Criteria::ASC) Order by the ACCESS column
 * @method     ChildSysModuleQuery orderByPosition($order = Criteria::ASC) Order by the POSITION column
 * @method     ChildSysModuleQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysModuleQuery orderByIconClass($order = Criteria::ASC) Order by the ICON_CLASS column
 *
 * @method     ChildSysModuleQuery groupById() Group by the ID column
 * @method     ChildSysModuleQuery groupByName() Group by the NAME column
 * @method     ChildSysModuleQuery groupByUri() Group by the URI column
 * @method     ChildSysModuleQuery groupByAccess() Group by the ACCESS column
 * @method     ChildSysModuleQuery groupByPosition() Group by the POSITION column
 * @method     ChildSysModuleQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysModuleQuery groupByIconClass() Group by the ICON_CLASS column
 *
 * @method     ChildSysModuleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysModuleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysModuleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysModuleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysModuleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysModuleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysModuleQuery leftJoinSysUri($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUri relation
 * @method     ChildSysModuleQuery rightJoinSysUri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUri relation
 * @method     ChildSysModuleQuery innerJoinSysUri($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUri relation
 *
 * @method     ChildSysModuleQuery joinWithSysUri($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUri relation
 *
 * @method     ChildSysModuleQuery leftJoinWithSysUri() Adds a LEFT JOIN clause and with to the query using the SysUri relation
 * @method     ChildSysModuleQuery rightJoinWithSysUri() Adds a RIGHT JOIN clause and with to the query using the SysUri relation
 * @method     ChildSysModuleQuery innerJoinWithSysUri() Adds a INNER JOIN clause and with to the query using the SysUri relation
 *
 * @method     \SysUriQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysModule|null findOne(?ConnectionInterface $con = null) Return the first ChildSysModule matching the query
 * @method     ChildSysModule findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysModule matching the query, or a new ChildSysModule object populated from the query conditions when no match is found
 *
 * @method     ChildSysModule|null findOneById(int $ID) Return the first ChildSysModule filtered by the ID column
 * @method     ChildSysModule|null findOneByName(string $NAME) Return the first ChildSysModule filtered by the NAME column
 * @method     ChildSysModule|null findOneByUri(string $URI) Return the first ChildSysModule filtered by the URI column
 * @method     ChildSysModule|null findOneByAccess(string $ACCESS) Return the first ChildSysModule filtered by the ACCESS column
 * @method     ChildSysModule|null findOneByPosition(int $POSITION) Return the first ChildSysModule filtered by the POSITION column
 * @method     ChildSysModule|null findOneByDescription(string $DESCRIPTION) Return the first ChildSysModule filtered by the DESCRIPTION column
 * @method     ChildSysModule|null findOneByIconClass(string $ICON_CLASS) Return the first ChildSysModule filtered by the ICON_CLASS column
 *
 * @method     ChildSysModule requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysModule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOne(?ConnectionInterface $con = null) Return the first ChildSysModule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysModule requireOneById(int $ID) Return the first ChildSysModule filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByName(string $NAME) Return the first ChildSysModule filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByUri(string $URI) Return the first ChildSysModule filtered by the URI column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByAccess(string $ACCESS) Return the first ChildSysModule filtered by the ACCESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByPosition(int $POSITION) Return the first ChildSysModule filtered by the POSITION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByDescription(string $DESCRIPTION) Return the first ChildSysModule filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByIconClass(string $ICON_CLASS) Return the first ChildSysModule filtered by the ICON_CLASS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysModule[]|Collection find(?ConnectionInterface $con = null) Return ChildSysModule objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysModule> find(?ConnectionInterface $con = null) Return ChildSysModule objects based on current ModelCriteria
 *
 * @method     ChildSysModule[]|Collection findById(int|array<int> $ID) Return ChildSysModule objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysModule> findById(int|array<int> $ID) Return ChildSysModule objects filtered by the ID column
 * @method     ChildSysModule[]|Collection findByName(string|array<string> $NAME) Return ChildSysModule objects filtered by the NAME column
 * @psalm-method Collection&\Traversable<ChildSysModule> findByName(string|array<string> $NAME) Return ChildSysModule objects filtered by the NAME column
 * @method     ChildSysModule[]|Collection findByUri(string|array<string> $URI) Return ChildSysModule objects filtered by the URI column
 * @psalm-method Collection&\Traversable<ChildSysModule> findByUri(string|array<string> $URI) Return ChildSysModule objects filtered by the URI column
 * @method     ChildSysModule[]|Collection findByAccess(string|array<string> $ACCESS) Return ChildSysModule objects filtered by the ACCESS column
 * @psalm-method Collection&\Traversable<ChildSysModule> findByAccess(string|array<string> $ACCESS) Return ChildSysModule objects filtered by the ACCESS column
 * @method     ChildSysModule[]|Collection findByPosition(int|array<int> $POSITION) Return ChildSysModule objects filtered by the POSITION column
 * @psalm-method Collection&\Traversable<ChildSysModule> findByPosition(int|array<int> $POSITION) Return ChildSysModule objects filtered by the POSITION column
 * @method     ChildSysModule[]|Collection findByDescription(string|array<string> $DESCRIPTION) Return ChildSysModule objects filtered by the DESCRIPTION column
 * @psalm-method Collection&\Traversable<ChildSysModule> findByDescription(string|array<string> $DESCRIPTION) Return ChildSysModule objects filtered by the DESCRIPTION column
 * @method     ChildSysModule[]|Collection findByIconClass(string|array<string> $ICON_CLASS) Return ChildSysModule objects filtered by the ICON_CLASS column
 * @psalm-method Collection&\Traversable<ChildSysModule> findByIconClass(string|array<string> $ICON_CLASS) Return ChildSysModule objects filtered by the ICON_CLASS column
 *
 * @method     ChildSysModule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysModule> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysModuleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysModuleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysModule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysModuleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysModuleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysModuleQuery) {
            return $criteria;
        }
        $query = new ChildSysModuleQuery();
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
     * @return ChildSysModule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysModuleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysModuleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysModule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, NAME, URI, ACCESS, POSITION, DESCRIPTION, ICON_CLASS FROM sys_module WHERE ID = :p0';
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
            /** @var ChildSysModule $obj */
            $obj = new ChildSysModule();
            $obj->hydrate($row);
            SysModuleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysModule|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SysModuleTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysModuleTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SysModuleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysModuleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysModuleTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(SysModuleTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the URI column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE URI = 'fooValue'
     * $query->filterByUri('%fooValue%', Criteria::LIKE); // WHERE URI LIKE '%fooValue%'
     * $query->filterByUri(['foo', 'bar']); // WHERE URI IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uri The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUri($uri = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysModuleTableMap::COL_URI, $uri, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ACCESS column
     *
     * Example usage:
     * <code>
     * $query->filterByAccess('fooValue');   // WHERE ACCESS = 'fooValue'
     * $query->filterByAccess('%fooValue%', Criteria::LIKE); // WHERE ACCESS LIKE '%fooValue%'
     * $query->filterByAccess(['foo', 'bar']); // WHERE ACCESS IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $access The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccess($access = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($access)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysModuleTableMap::COL_ACCESS, $access, $comparison);

        return $this;
    }

    /**
     * Filter the query on the POSITION column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE POSITION = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE POSITION IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE POSITION > 12
     * </code>
     *
     * @param mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPosition($position = null, ?string $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(SysModuleTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(SysModuleTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysModuleTableMap::COL_POSITION, $position, $comparison);

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

        $this->addUsingAlias(SysModuleTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ICON_CLASS column
     *
     * Example usage:
     * <code>
     * $query->filterByIconClass('fooValue');   // WHERE ICON_CLASS = 'fooValue'
     * $query->filterByIconClass('%fooValue%', Criteria::LIKE); // WHERE ICON_CLASS LIKE '%fooValue%'
     * $query->filterByIconClass(['foo', 'bar']); // WHERE ICON_CLASS IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $iconClass The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIconClass($iconClass = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iconClass)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysModuleTableMap::COL_ICON_CLASS, $iconClass, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysUri object
     *
     * @param \SysUri|ObjectCollection $sysUri the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysUri($sysUri, ?string $comparison = null)
    {
        if ($sysUri instanceof \SysUri) {
            $this
                ->addUsingAlias(SysModuleTableMap::COL_ID, $sysUri->getModuleId(), $comparison);

            return $this;
        } elseif ($sysUri instanceof ObjectCollection) {
            $this
                ->useSysUriQuery()
                ->filterByPrimaryKeys($sysUri->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysUri() only accepts arguments of type \SysUri or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUri relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysUri(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUri');

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
            $this->addJoinObject($join, 'SysUri');
        }

        return $this;
    }

    /**
     * Use the SysUri relation SysUri object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysUriQuery A secondary query class using the current class as primary query
     */
    public function useSysUriQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUri($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUri', '\SysUriQuery');
    }

    /**
     * Use the SysUri relation SysUri object
     *
     * @param callable(\SysUriQuery):\SysUriQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysUriQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysUriQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysUri table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysUriQuery The inner query object of the EXISTS statement
     */
    public function useSysUriExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysUriQuery */
        $q = $this->useExistsQuery('SysUri', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysUri table for a NOT EXISTS query.
     *
     * @see useSysUriExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysUriQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysUriNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUriQuery */
        $q = $this->useExistsQuery('SysUri', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysUri table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysUriQuery The inner query object of the IN statement
     */
    public function useInSysUriQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysUriQuery */
        $q = $this->useInQuery('SysUri', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysUri table for a NOT IN query.
     *
     * @see useSysUriInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysUriQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysUriQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUriQuery */
        $q = $this->useInQuery('SysUri', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSysModule $sysModule Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysModule = null)
    {
        if ($sysModule) {
            $this->addUsingAlias(SysModuleTableMap::COL_ID, $sysModule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_module table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysModuleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysModuleTableMap::clearInstancePool();
            SysModuleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysModuleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysModuleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysModuleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysModuleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
