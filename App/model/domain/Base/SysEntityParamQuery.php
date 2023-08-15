<?php

namespace Base;

use \SysEntityParam as ChildSysEntityParam;
use \SysEntityParamQuery as ChildSysEntityParamQuery;
use \Exception;
use \PDO;
use Map\SysEntityParamTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_entity_param` table.
 *
 * @method     ChildSysEntityParamQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEntityParamQuery orderByEntityId($order = Criteria::ASC) Order by the ENTITY_ID column
 * @method     ChildSysEntityParamQuery orderByParamId($order = Criteria::ASC) Order by the PARAM_ID column
 * @method     ChildSysEntityParamQuery orderByValue($order = Criteria::ASC) Order by the VALUE column
 * @method     ChildSysEntityParamQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysEntityParamQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysEntityParamQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysEntityParamQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityParamQuery groupById() Group by the ID column
 * @method     ChildSysEntityParamQuery groupByEntityId() Group by the ENTITY_ID column
 * @method     ChildSysEntityParamQuery groupByParamId() Group by the PARAM_ID column
 * @method     ChildSysEntityParamQuery groupByValue() Group by the VALUE column
 * @method     ChildSysEntityParamQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysEntityParamQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysEntityParamQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysEntityParamQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityParamQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEntityParamQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEntityParamQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEntityParamQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEntityParamQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEntityParamQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEntityParamQuery leftJoinSysEntity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityParamQuery rightJoinSysEntity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityParamQuery innerJoinSysEntity($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntity relation
 *
 * @method     ChildSysEntityParamQuery joinWithSysEntity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysEntityParamQuery leftJoinWithSysEntity() Adds a LEFT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityParamQuery rightJoinWithSysEntity() Adds a RIGHT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityParamQuery innerJoinWithSysEntity() Adds a INNER JOIN clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysEntityParamQuery leftJoinSysParam($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysParam relation
 * @method     ChildSysEntityParamQuery rightJoinSysParam($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysParam relation
 * @method     ChildSysEntityParamQuery innerJoinSysParam($relationAlias = null) Adds a INNER JOIN clause to the query using the SysParam relation
 *
 * @method     ChildSysEntityParamQuery joinWithSysParam($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysParam relation
 *
 * @method     ChildSysEntityParamQuery leftJoinWithSysParam() Adds a LEFT JOIN clause and with to the query using the SysParam relation
 * @method     ChildSysEntityParamQuery rightJoinWithSysParam() Adds a RIGHT JOIN clause and with to the query using the SysParam relation
 * @method     ChildSysEntityParamQuery innerJoinWithSysParam() Adds a INNER JOIN clause and with to the query using the SysParam relation
 *
 * @method     \SysEntityQuery|\SysParamQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEntityParam|null findOne(?ConnectionInterface $con = null) Return the first ChildSysEntityParam matching the query
 * @method     ChildSysEntityParam findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysEntityParam matching the query, or a new ChildSysEntityParam object populated from the query conditions when no match is found
 *
 * @method     ChildSysEntityParam|null findOneById(int $ID) Return the first ChildSysEntityParam filtered by the ID column
 * @method     ChildSysEntityParam|null findOneByEntityId(int $ENTITY_ID) Return the first ChildSysEntityParam filtered by the ENTITY_ID column
 * @method     ChildSysEntityParam|null findOneByParamId(int $PARAM_ID) Return the first ChildSysEntityParam filtered by the PARAM_ID column
 * @method     ChildSysEntityParam|null findOneByValue(string $VALUE) Return the first ChildSysEntityParam filtered by the VALUE column
 * @method     ChildSysEntityParam|null findOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityParam filtered by the DESCRIPTION column
 * @method     ChildSysEntityParam|null findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntityParam filtered by the LAST_USER_ID column
 * @method     ChildSysEntityParam|null findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntityParam filtered by the CREATION_DATE column
 * @method     ChildSysEntityParam|null findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysEntityParam filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityParam requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysEntityParam by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOne(?ConnectionInterface $con = null) Return the first ChildSysEntityParam matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityParam requireOneById(int $ID) Return the first ChildSysEntityParam filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOneByEntityId(int $ENTITY_ID) Return the first ChildSysEntityParam filtered by the ENTITY_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOneByParamId(int $PARAM_ID) Return the first ChildSysEntityParam filtered by the PARAM_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOneByValue(string $VALUE) Return the first ChildSysEntityParam filtered by the VALUE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityParam filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntityParam filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntityParam filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityParam requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysEntityParam filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityParam[]|Collection find(?ConnectionInterface $con = null) Return ChildSysEntityParam objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> find(?ConnectionInterface $con = null) Return ChildSysEntityParam objects based on current ModelCriteria
 *
 * @method     ChildSysEntityParam[]|Collection findById(int|array<int> $ID) Return ChildSysEntityParam objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findById(int|array<int> $ID) Return ChildSysEntityParam objects filtered by the ID column
 * @method     ChildSysEntityParam[]|Collection findByEntityId(int|array<int> $ENTITY_ID) Return ChildSysEntityParam objects filtered by the ENTITY_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findByEntityId(int|array<int> $ENTITY_ID) Return ChildSysEntityParam objects filtered by the ENTITY_ID column
 * @method     ChildSysEntityParam[]|Collection findByParamId(int|array<int> $PARAM_ID) Return ChildSysEntityParam objects filtered by the PARAM_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findByParamId(int|array<int> $PARAM_ID) Return ChildSysEntityParam objects filtered by the PARAM_ID column
 * @method     ChildSysEntityParam[]|Collection findByValue(string|array<string> $VALUE) Return ChildSysEntityParam objects filtered by the VALUE column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findByValue(string|array<string> $VALUE) Return ChildSysEntityParam objects filtered by the VALUE column
 * @method     ChildSysEntityParam[]|Collection findByDescription(string|array<string> $DESCRIPTION) Return ChildSysEntityParam objects filtered by the DESCRIPTION column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findByDescription(string|array<string> $DESCRIPTION) Return ChildSysEntityParam objects filtered by the DESCRIPTION column
 * @method     ChildSysEntityParam[]|Collection findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysEntityParam objects filtered by the LAST_USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysEntityParam objects filtered by the LAST_USER_ID column
 * @method     ChildSysEntityParam[]|Collection findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysEntityParam objects filtered by the CREATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysEntityParam objects filtered by the CREATION_DATE column
 * @method     ChildSysEntityParam[]|Collection findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysEntityParam objects filtered by the MODIFICATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysEntityParam> findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysEntityParam objects filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysEntityParam[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysEntityParam> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysEntityParamQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEntityParamQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEntityParam', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEntityParamQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEntityParamQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysEntityParamQuery) {
            return $criteria;
        }
        $query = new ChildSysEntityParamQuery();
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
     * @return ChildSysEntityParam|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityParamTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEntityParamTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEntityParam A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ENTITY_ID, PARAM_ID, VALUE, DESCRIPTION, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_entity_param WHERE ID = :p0';
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
            /** @var ChildSysEntityParam $obj */
            $obj = new ChildSysEntityParam();
            $obj->hydrate($row);
            SysEntityParamTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEntityParam|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SysEntityParamTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysEntityParamTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SysEntityParamTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEntityParamTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityParamTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(SysEntityParamTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(SysEntityParamTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityParamTableMap::COL_ENTITY_ID, $entityId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PARAM_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByParamId(1234); // WHERE PARAM_ID = 1234
     * $query->filterByParamId(array(12, 34)); // WHERE PARAM_ID IN (12, 34)
     * $query->filterByParamId(array('min' => 12)); // WHERE PARAM_ID > 12
     * </code>
     *
     * @see       filterBySysParam()
     *
     * @param mixed $paramId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParamId($paramId = null, ?string $comparison = null)
    {
        if (is_array($paramId)) {
            $useMinMax = false;
            if (isset($paramId['min'])) {
                $this->addUsingAlias(SysEntityParamTableMap::COL_PARAM_ID, $paramId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paramId['max'])) {
                $this->addUsingAlias(SysEntityParamTableMap::COL_PARAM_ID, $paramId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityParamTableMap::COL_PARAM_ID, $paramId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the VALUE column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE VALUE = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE VALUE LIKE '%fooValue%'
     * $query->filterByValue(['foo', 'bar']); // WHERE VALUE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $value The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValue($value = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityParamTableMap::COL_VALUE, $value, $comparison);

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

        $this->addUsingAlias(SysEntityParamTableMap::COL_DESCRIPTION, $description, $comparison);

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
                $this->addUsingAlias(SysEntityParamTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysEntityParamTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityParamTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);

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
                $this->addUsingAlias(SysEntityParamTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysEntityParamTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityParamTableMap::COL_CREATION_DATE, $creationDate, $comparison);

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
                $this->addUsingAlias(SysEntityParamTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysEntityParamTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityParamTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);

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
                ->addUsingAlias(SysEntityParamTableMap::COL_ENTITY_ID, $sysEntity->getId(), $comparison);
        } elseif ($sysEntity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEntityParamTableMap::COL_ENTITY_ID, $sysEntity->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \SysParam object
     *
     * @param \SysParam|ObjectCollection $sysParam The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysParam($sysParam, ?string $comparison = null)
    {
        if ($sysParam instanceof \SysParam) {
            return $this
                ->addUsingAlias(SysEntityParamTableMap::COL_PARAM_ID, $sysParam->getId(), $comparison);
        } elseif ($sysParam instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEntityParamTableMap::COL_PARAM_ID, $sysParam->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysParam() only accepts arguments of type \SysParam or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysParam relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysParam(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysParam');

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
            $this->addJoinObject($join, 'SysParam');
        }

        return $this;
    }

    /**
     * Use the SysParam relation SysParam object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysParamQuery A secondary query class using the current class as primary query
     */
    public function useSysParamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysParam($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysParam', '\SysParamQuery');
    }

    /**
     * Use the SysParam relation SysParam object
     *
     * @param callable(\SysParamQuery):\SysParamQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysParamQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysParamQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysParam table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysParamQuery The inner query object of the EXISTS statement
     */
    public function useSysParamExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysParamQuery */
        $q = $this->useExistsQuery('SysParam', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysParam table for a NOT EXISTS query.
     *
     * @see useSysParamExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysParamQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysParamNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysParamQuery */
        $q = $this->useExistsQuery('SysParam', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysParam table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysParamQuery The inner query object of the IN statement
     */
    public function useInSysParamQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysParamQuery */
        $q = $this->useInQuery('SysParam', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysParam table for a NOT IN query.
     *
     * @see useSysParamInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysParamQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysParamQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysParamQuery */
        $q = $this->useInQuery('SysParam', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSysEntityParam $sysEntityParam Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysEntityParam = null)
    {
        if ($sysEntityParam) {
            $this->addUsingAlias(SysEntityParamTableMap::COL_ID, $sysEntityParam->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_entity_param table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityParamTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEntityParamTableMap::clearInstancePool();
            SysEntityParamTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityParamTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEntityParamTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEntityParamTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEntityParamTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
