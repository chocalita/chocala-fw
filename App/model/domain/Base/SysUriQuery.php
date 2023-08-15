<?php

namespace Base;

use \SysUri as ChildSysUri;
use \SysUriQuery as ChildSysUriQuery;
use \Exception;
use \PDO;
use Map\SysUriTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_uri` table.
 *
 * @method     ChildSysUriQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysUriQuery orderByModuleId($order = Criteria::ASC) Order by the MODULE_ID column
 * @method     ChildSysUriQuery orderByUri($order = Criteria::ASC) Order by the URI column
 * @method     ChildSysUriQuery orderByTitle($order = Criteria::ASC) Order by the TITLE column
 * @method     ChildSysUriQuery orderByAccess($order = Criteria::ASC) Order by the ACCESS column
 * @method     ChildSysUriQuery orderByType($order = Criteria::ASC) Order by the TYPE column
 * @method     ChildSysUriQuery orderByPosition($order = Criteria::ASC) Order by the POSITION column
 * @method     ChildSysUriQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysUriQuery orderByIcon($order = Criteria::ASC) Order by the ICON column
 * @method     ChildSysUriQuery orderByMark($order = Criteria::ASC) Order by the MARK column
 * @method     ChildSysUriQuery orderByAfterDivisor($order = Criteria::ASC) Order by the AFTER_DIVISOR column
 *
 * @method     ChildSysUriQuery groupById() Group by the ID column
 * @method     ChildSysUriQuery groupByModuleId() Group by the MODULE_ID column
 * @method     ChildSysUriQuery groupByUri() Group by the URI column
 * @method     ChildSysUriQuery groupByTitle() Group by the TITLE column
 * @method     ChildSysUriQuery groupByAccess() Group by the ACCESS column
 * @method     ChildSysUriQuery groupByType() Group by the TYPE column
 * @method     ChildSysUriQuery groupByPosition() Group by the POSITION column
 * @method     ChildSysUriQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysUriQuery groupByIcon() Group by the ICON column
 * @method     ChildSysUriQuery groupByMark() Group by the MARK column
 * @method     ChildSysUriQuery groupByAfterDivisor() Group by the AFTER_DIVISOR column
 *
 * @method     ChildSysUriQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysUriQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysUriQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysUriQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysUriQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysUriQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysUriQuery leftJoinSysModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysModule relation
 * @method     ChildSysUriQuery rightJoinSysModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysModule relation
 * @method     ChildSysUriQuery innerJoinSysModule($relationAlias = null) Adds a INNER JOIN clause to the query using the SysModule relation
 *
 * @method     ChildSysUriQuery joinWithSysModule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysModule relation
 *
 * @method     ChildSysUriQuery leftJoinWithSysModule() Adds a LEFT JOIN clause and with to the query using the SysModule relation
 * @method     ChildSysUriQuery rightJoinWithSysModule() Adds a RIGHT JOIN clause and with to the query using the SysModule relation
 * @method     ChildSysUriQuery innerJoinWithSysModule() Adds a INNER JOIN clause and with to the query using the SysModule relation
 *
 * @method     ChildSysUriQuery leftJoinSysRolXUri($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRolXUri relation
 * @method     ChildSysUriQuery rightJoinSysRolXUri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRolXUri relation
 * @method     ChildSysUriQuery innerJoinSysRolXUri($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRolXUri relation
 *
 * @method     ChildSysUriQuery joinWithSysRolXUri($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysRolXUri relation
 *
 * @method     ChildSysUriQuery leftJoinWithSysRolXUri() Adds a LEFT JOIN clause and with to the query using the SysRolXUri relation
 * @method     ChildSysUriQuery rightJoinWithSysRolXUri() Adds a RIGHT JOIN clause and with to the query using the SysRolXUri relation
 * @method     ChildSysUriQuery innerJoinWithSysRolXUri() Adds a INNER JOIN clause and with to the query using the SysRolXUri relation
 *
 * @method     \SysModuleQuery|\SysRolXUriQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysUri|null findOne(?ConnectionInterface $con = null) Return the first ChildSysUri matching the query
 * @method     ChildSysUri findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysUri matching the query, or a new ChildSysUri object populated from the query conditions when no match is found
 *
 * @method     ChildSysUri|null findOneById(int $ID) Return the first ChildSysUri filtered by the ID column
 * @method     ChildSysUri|null findOneByModuleId(int $MODULE_ID) Return the first ChildSysUri filtered by the MODULE_ID column
 * @method     ChildSysUri|null findOneByUri(string $URI) Return the first ChildSysUri filtered by the URI column
 * @method     ChildSysUri|null findOneByTitle(string $TITLE) Return the first ChildSysUri filtered by the TITLE column
 * @method     ChildSysUri|null findOneByAccess(string $ACCESS) Return the first ChildSysUri filtered by the ACCESS column
 * @method     ChildSysUri|null findOneByType(string $TYPE) Return the first ChildSysUri filtered by the TYPE column
 * @method     ChildSysUri|null findOneByPosition(int $POSITION) Return the first ChildSysUri filtered by the POSITION column
 * @method     ChildSysUri|null findOneByDescription(string $DESCRIPTION) Return the first ChildSysUri filtered by the DESCRIPTION column
 * @method     ChildSysUri|null findOneByIcon(string $ICON) Return the first ChildSysUri filtered by the ICON column
 * @method     ChildSysUri|null findOneByMark(string $MARK) Return the first ChildSysUri filtered by the MARK column
 * @method     ChildSysUri|null findOneByAfterDivisor(boolean $AFTER_DIVISOR) Return the first ChildSysUri filtered by the AFTER_DIVISOR column
 *
 * @method     ChildSysUri requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysUri by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOne(?ConnectionInterface $con = null) Return the first ChildSysUri matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUri requireOneById(int $ID) Return the first ChildSysUri filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByModuleId(int $MODULE_ID) Return the first ChildSysUri filtered by the MODULE_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByUri(string $URI) Return the first ChildSysUri filtered by the URI column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByTitle(string $TITLE) Return the first ChildSysUri filtered by the TITLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByAccess(string $ACCESS) Return the first ChildSysUri filtered by the ACCESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByType(string $TYPE) Return the first ChildSysUri filtered by the TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByPosition(int $POSITION) Return the first ChildSysUri filtered by the POSITION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByDescription(string $DESCRIPTION) Return the first ChildSysUri filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByIcon(string $ICON) Return the first ChildSysUri filtered by the ICON column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByMark(string $MARK) Return the first ChildSysUri filtered by the MARK column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByAfterDivisor(boolean $AFTER_DIVISOR) Return the first ChildSysUri filtered by the AFTER_DIVISOR column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUri[]|Collection find(?ConnectionInterface $con = null) Return ChildSysUri objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysUri> find(?ConnectionInterface $con = null) Return ChildSysUri objects based on current ModelCriteria
 *
 * @method     ChildSysUri[]|Collection findById(int|array<int> $ID) Return ChildSysUri objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysUri> findById(int|array<int> $ID) Return ChildSysUri objects filtered by the ID column
 * @method     ChildSysUri[]|Collection findByModuleId(int|array<int> $MODULE_ID) Return ChildSysUri objects filtered by the MODULE_ID column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByModuleId(int|array<int> $MODULE_ID) Return ChildSysUri objects filtered by the MODULE_ID column
 * @method     ChildSysUri[]|Collection findByUri(string|array<string> $URI) Return ChildSysUri objects filtered by the URI column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByUri(string|array<string> $URI) Return ChildSysUri objects filtered by the URI column
 * @method     ChildSysUri[]|Collection findByTitle(string|array<string> $TITLE) Return ChildSysUri objects filtered by the TITLE column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByTitle(string|array<string> $TITLE) Return ChildSysUri objects filtered by the TITLE column
 * @method     ChildSysUri[]|Collection findByAccess(string|array<string> $ACCESS) Return ChildSysUri objects filtered by the ACCESS column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByAccess(string|array<string> $ACCESS) Return ChildSysUri objects filtered by the ACCESS column
 * @method     ChildSysUri[]|Collection findByType(string|array<string> $TYPE) Return ChildSysUri objects filtered by the TYPE column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByType(string|array<string> $TYPE) Return ChildSysUri objects filtered by the TYPE column
 * @method     ChildSysUri[]|Collection findByPosition(int|array<int> $POSITION) Return ChildSysUri objects filtered by the POSITION column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByPosition(int|array<int> $POSITION) Return ChildSysUri objects filtered by the POSITION column
 * @method     ChildSysUri[]|Collection findByDescription(string|array<string> $DESCRIPTION) Return ChildSysUri objects filtered by the DESCRIPTION column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByDescription(string|array<string> $DESCRIPTION) Return ChildSysUri objects filtered by the DESCRIPTION column
 * @method     ChildSysUri[]|Collection findByIcon(string|array<string> $ICON) Return ChildSysUri objects filtered by the ICON column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByIcon(string|array<string> $ICON) Return ChildSysUri objects filtered by the ICON column
 * @method     ChildSysUri[]|Collection findByMark(string|array<string> $MARK) Return ChildSysUri objects filtered by the MARK column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByMark(string|array<string> $MARK) Return ChildSysUri objects filtered by the MARK column
 * @method     ChildSysUri[]|Collection findByAfterDivisor(boolean|array<boolean> $AFTER_DIVISOR) Return ChildSysUri objects filtered by the AFTER_DIVISOR column
 * @psalm-method Collection&\Traversable<ChildSysUri> findByAfterDivisor(boolean|array<boolean> $AFTER_DIVISOR) Return ChildSysUri objects filtered by the AFTER_DIVISOR column
 *
 * @method     ChildSysUri[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysUri> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysUriQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysUriQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysUri', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysUriQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysUriQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysUriQuery) {
            return $criteria;
        }
        $query = new ChildSysUriQuery();
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
     * @return ChildSysUri|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysUriTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysUriTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysUri A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, MODULE_ID, URI, TITLE, ACCESS, TYPE, POSITION, DESCRIPTION, ICON, MARK, AFTER_DIVISOR FROM sys_uri WHERE ID = :p0';
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
            /** @var ChildSysUri $obj */
            $obj = new ChildSysUri();
            $obj->hydrate($row);
            SysUriTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysUri|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SysUriTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysUriTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SysUriTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysUriTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUriTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the MODULE_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByModuleId(1234); // WHERE MODULE_ID = 1234
     * $query->filterByModuleId(array(12, 34)); // WHERE MODULE_ID IN (12, 34)
     * $query->filterByModuleId(array('min' => 12)); // WHERE MODULE_ID > 12
     * </code>
     *
     * @see       filterBySysModule()
     *
     * @param mixed $moduleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModuleId($moduleId = null, ?string $comparison = null)
    {
        if (is_array($moduleId)) {
            $useMinMax = false;
            if (isset($moduleId['min'])) {
                $this->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $moduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($moduleId['max'])) {
                $this->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $moduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $moduleId, $comparison);

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

        $this->addUsingAlias(SysUriTableMap::COL_URI, $uri, $comparison);

        return $this;
    }

    /**
     * Filter the query on the TITLE column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE TITLE = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE TITLE LIKE '%fooValue%'
     * $query->filterByTitle(['foo', 'bar']); // WHERE TITLE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $title The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTitle($title = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUriTableMap::COL_TITLE, $title, $comparison);

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

        $this->addUsingAlias(SysUriTableMap::COL_ACCESS, $access, $comparison);

        return $this;
    }

    /**
     * Filter the query on the TYPE column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE TYPE = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE TYPE LIKE '%fooValue%'
     * $query->filterByType(['foo', 'bar']); // WHERE TYPE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $type The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType($type = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUriTableMap::COL_TYPE, $type, $comparison);

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
                $this->addUsingAlias(SysUriTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(SysUriTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUriTableMap::COL_POSITION, $position, $comparison);

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

        $this->addUsingAlias(SysUriTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ICON column
     *
     * Example usage:
     * <code>
     * $query->filterByIcon('fooValue');   // WHERE ICON = 'fooValue'
     * $query->filterByIcon('%fooValue%', Criteria::LIKE); // WHERE ICON LIKE '%fooValue%'
     * $query->filterByIcon(['foo', 'bar']); // WHERE ICON IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $icon The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIcon($icon = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($icon)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUriTableMap::COL_ICON, $icon, $comparison);

        return $this;
    }

    /**
     * Filter the query on the MARK column
     *
     * Example usage:
     * <code>
     * $query->filterByMark('fooValue');   // WHERE MARK = 'fooValue'
     * $query->filterByMark('%fooValue%', Criteria::LIKE); // WHERE MARK LIKE '%fooValue%'
     * $query->filterByMark(['foo', 'bar']); // WHERE MARK IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMark($mark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUriTableMap::COL_MARK, $mark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the AFTER_DIVISOR column
     *
     * Example usage:
     * <code>
     * $query->filterByAfterDivisor(true); // WHERE AFTER_DIVISOR = true
     * $query->filterByAfterDivisor('yes'); // WHERE AFTER_DIVISOR = true
     * </code>
     *
     * @param bool|string $afterDivisor The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAfterDivisor($afterDivisor = null, ?string $comparison = null)
    {
        if (is_string($afterDivisor)) {
            $afterDivisor = in_array(strtolower($afterDivisor), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SysUriTableMap::COL_AFTER_DIVISOR, $afterDivisor, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysModule object
     *
     * @param \SysModule|ObjectCollection $sysModule The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysModule($sysModule, ?string $comparison = null)
    {
        if ($sysModule instanceof \SysModule) {
            return $this
                ->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $sysModule->getId(), $comparison);
        } elseif ($sysModule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $sysModule->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysModule() only accepts arguments of type \SysModule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysModule relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysModule(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysModule');

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
            $this->addJoinObject($join, 'SysModule');
        }

        return $this;
    }

    /**
     * Use the SysModule relation SysModule object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysModuleQuery A secondary query class using the current class as primary query
     */
    public function useSysModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysModule', '\SysModuleQuery');
    }

    /**
     * Use the SysModule relation SysModule object
     *
     * @param callable(\SysModuleQuery):\SysModuleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysModuleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysModuleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysModule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysModuleQuery The inner query object of the EXISTS statement
     */
    public function useSysModuleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysModuleQuery */
        $q = $this->useExistsQuery('SysModule', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysModule table for a NOT EXISTS query.
     *
     * @see useSysModuleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysModuleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysModuleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysModuleQuery */
        $q = $this->useExistsQuery('SysModule', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysModule table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysModuleQuery The inner query object of the IN statement
     */
    public function useInSysModuleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysModuleQuery */
        $q = $this->useInQuery('SysModule', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysModule table for a NOT IN query.
     *
     * @see useSysModuleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysModuleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysModuleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysModuleQuery */
        $q = $this->useInQuery('SysModule', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SysUriTableMap::COL_ID, $sysRolXUri->getUriId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildSysUri $sysUri Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysUri = null)
    {
        if ($sysUri) {
            $this->addUsingAlias(SysUriTableMap::COL_ID, $sysUri->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_uri table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysUriTableMap::clearInstancePool();
            SysUriTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysUriTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysUriTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysUriTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
