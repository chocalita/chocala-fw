<?php

namespace Base;

use \SysRolXUri as ChildSysRolXUri;
use \SysRolXUriQuery as ChildSysRolXUriQuery;
use \Exception;
use \PDO;
use Map\SysRolXUriTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_rol_x_uri` table.
 *
 * @method     ChildSysRolXUriQuery orderByRolId($order = Criteria::ASC) Order by the ROL_ID column
 * @method     ChildSysRolXUriQuery orderByUriId($order = Criteria::ASC) Order by the URI_ID column
 * @method     ChildSysRolXUriQuery orderByAutRead($order = Criteria::ASC) Order by the AUT_READ column
 * @method     ChildSysRolXUriQuery orderByAutCreate($order = Criteria::ASC) Order by the AUT_CREATE column
 * @method     ChildSysRolXUriQuery orderByAutUpdate($order = Criteria::ASC) Order by the AUT_UPDATE column
 * @method     ChildSysRolXUriQuery orderByAutDelete($order = Criteria::ASC) Order by the AUT_DELETE column
 *
 * @method     ChildSysRolXUriQuery groupByRolId() Group by the ROL_ID column
 * @method     ChildSysRolXUriQuery groupByUriId() Group by the URI_ID column
 * @method     ChildSysRolXUriQuery groupByAutRead() Group by the AUT_READ column
 * @method     ChildSysRolXUriQuery groupByAutCreate() Group by the AUT_CREATE column
 * @method     ChildSysRolXUriQuery groupByAutUpdate() Group by the AUT_UPDATE column
 * @method     ChildSysRolXUriQuery groupByAutDelete() Group by the AUT_DELETE column
 *
 * @method     ChildSysRolXUriQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysRolXUriQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysRolXUriQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysRolXUriQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysRolXUriQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysRolXUriQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysRolXUriQuery leftJoinSysRol($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRol relation
 * @method     ChildSysRolXUriQuery rightJoinSysRol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRol relation
 * @method     ChildSysRolXUriQuery innerJoinSysRol($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRol relation
 *
 * @method     ChildSysRolXUriQuery joinWithSysRol($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysRol relation
 *
 * @method     ChildSysRolXUriQuery leftJoinWithSysRol() Adds a LEFT JOIN clause and with to the query using the SysRol relation
 * @method     ChildSysRolXUriQuery rightJoinWithSysRol() Adds a RIGHT JOIN clause and with to the query using the SysRol relation
 * @method     ChildSysRolXUriQuery innerJoinWithSysRol() Adds a INNER JOIN clause and with to the query using the SysRol relation
 *
 * @method     ChildSysRolXUriQuery leftJoinSysUri($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUri relation
 * @method     ChildSysRolXUriQuery rightJoinSysUri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUri relation
 * @method     ChildSysRolXUriQuery innerJoinSysUri($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUri relation
 *
 * @method     ChildSysRolXUriQuery joinWithSysUri($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUri relation
 *
 * @method     ChildSysRolXUriQuery leftJoinWithSysUri() Adds a LEFT JOIN clause and with to the query using the SysUri relation
 * @method     ChildSysRolXUriQuery rightJoinWithSysUri() Adds a RIGHT JOIN clause and with to the query using the SysUri relation
 * @method     ChildSysRolXUriQuery innerJoinWithSysUri() Adds a INNER JOIN clause and with to the query using the SysUri relation
 *
 * @method     \SysRolQuery|\SysUriQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysRolXUri|null findOne(?ConnectionInterface $con = null) Return the first ChildSysRolXUri matching the query
 * @method     ChildSysRolXUri findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysRolXUri matching the query, or a new ChildSysRolXUri object populated from the query conditions when no match is found
 *
 * @method     ChildSysRolXUri|null findOneByRolId(int $ROL_ID) Return the first ChildSysRolXUri filtered by the ROL_ID column
 * @method     ChildSysRolXUri|null findOneByUriId(int $URI_ID) Return the first ChildSysRolXUri filtered by the URI_ID column
 * @method     ChildSysRolXUri|null findOneByAutRead(boolean $AUT_READ) Return the first ChildSysRolXUri filtered by the AUT_READ column
 * @method     ChildSysRolXUri|null findOneByAutCreate(boolean $AUT_CREATE) Return the first ChildSysRolXUri filtered by the AUT_CREATE column
 * @method     ChildSysRolXUri|null findOneByAutUpdate(boolean $AUT_UPDATE) Return the first ChildSysRolXUri filtered by the AUT_UPDATE column
 * @method     ChildSysRolXUri|null findOneByAutDelete(boolean $AUT_DELETE) Return the first ChildSysRolXUri filtered by the AUT_DELETE column
 *
 * @method     ChildSysRolXUri requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysRolXUri by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRolXUri requireOne(?ConnectionInterface $con = null) Return the first ChildSysRolXUri matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysRolXUri requireOneByRolId(int $ROL_ID) Return the first ChildSysRolXUri filtered by the ROL_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRolXUri requireOneByUriId(int $URI_ID) Return the first ChildSysRolXUri filtered by the URI_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRolXUri requireOneByAutRead(boolean $AUT_READ) Return the first ChildSysRolXUri filtered by the AUT_READ column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRolXUri requireOneByAutCreate(boolean $AUT_CREATE) Return the first ChildSysRolXUri filtered by the AUT_CREATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRolXUri requireOneByAutUpdate(boolean $AUT_UPDATE) Return the first ChildSysRolXUri filtered by the AUT_UPDATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysRolXUri requireOneByAutDelete(boolean $AUT_DELETE) Return the first ChildSysRolXUri filtered by the AUT_DELETE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysRolXUri[]|Collection find(?ConnectionInterface $con = null) Return ChildSysRolXUri objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysRolXUri> find(?ConnectionInterface $con = null) Return ChildSysRolXUri objects based on current ModelCriteria
 *
 * @method     ChildSysRolXUri[]|Collection findByRolId(int|array<int> $ROL_ID) Return ChildSysRolXUri objects filtered by the ROL_ID column
 * @psalm-method Collection&\Traversable<ChildSysRolXUri> findByRolId(int|array<int> $ROL_ID) Return ChildSysRolXUri objects filtered by the ROL_ID column
 * @method     ChildSysRolXUri[]|Collection findByUriId(int|array<int> $URI_ID) Return ChildSysRolXUri objects filtered by the URI_ID column
 * @psalm-method Collection&\Traversable<ChildSysRolXUri> findByUriId(int|array<int> $URI_ID) Return ChildSysRolXUri objects filtered by the URI_ID column
 * @method     ChildSysRolXUri[]|Collection findByAutRead(boolean|array<boolean> $AUT_READ) Return ChildSysRolXUri objects filtered by the AUT_READ column
 * @psalm-method Collection&\Traversable<ChildSysRolXUri> findByAutRead(boolean|array<boolean> $AUT_READ) Return ChildSysRolXUri objects filtered by the AUT_READ column
 * @method     ChildSysRolXUri[]|Collection findByAutCreate(boolean|array<boolean> $AUT_CREATE) Return ChildSysRolXUri objects filtered by the AUT_CREATE column
 * @psalm-method Collection&\Traversable<ChildSysRolXUri> findByAutCreate(boolean|array<boolean> $AUT_CREATE) Return ChildSysRolXUri objects filtered by the AUT_CREATE column
 * @method     ChildSysRolXUri[]|Collection findByAutUpdate(boolean|array<boolean> $AUT_UPDATE) Return ChildSysRolXUri objects filtered by the AUT_UPDATE column
 * @psalm-method Collection&\Traversable<ChildSysRolXUri> findByAutUpdate(boolean|array<boolean> $AUT_UPDATE) Return ChildSysRolXUri objects filtered by the AUT_UPDATE column
 * @method     ChildSysRolXUri[]|Collection findByAutDelete(boolean|array<boolean> $AUT_DELETE) Return ChildSysRolXUri objects filtered by the AUT_DELETE column
 * @psalm-method Collection&\Traversable<ChildSysRolXUri> findByAutDelete(boolean|array<boolean> $AUT_DELETE) Return ChildSysRolXUri objects filtered by the AUT_DELETE column
 *
 * @method     ChildSysRolXUri[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysRolXUri> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysRolXUriQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysRolXUriQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysRolXUri', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysRolXUriQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysRolXUriQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysRolXUriQuery) {
            return $criteria;
        }
        $query = new ChildSysRolXUriQuery();
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
     * @param array[$ROL_ID, $URI_ID] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSysRolXUri|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysRolXUriTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysRolXUriTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildSysRolXUri A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ROL_ID, URI_ID, AUT_READ, AUT_CREATE, AUT_UPDATE, AUT_DELETE FROM sys_rol_x_uri WHERE ROL_ID = :p0 AND URI_ID = :p1';
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
            /** @var ChildSysRolXUri $obj */
            $obj = new ChildSysRolXUri();
            $obj->hydrate($row);
            SysRolXUriTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildSysRolXUri|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(SysRolXUriTableMap::COL_ROL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SysRolXUriTableMap::COL_URI_ID, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(SysRolXUriTableMap::COL_ROL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SysRolXUriTableMap::COL_URI_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

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
                $this->addUsingAlias(SysRolXUriTableMap::COL_ROL_ID, $rolId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolId['max'])) {
                $this->addUsingAlias(SysRolXUriTableMap::COL_ROL_ID, $rolId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysRolXUriTableMap::COL_ROL_ID, $rolId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the URI_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByUriId(1234); // WHERE URI_ID = 1234
     * $query->filterByUriId(array(12, 34)); // WHERE URI_ID IN (12, 34)
     * $query->filterByUriId(array('min' => 12)); // WHERE URI_ID > 12
     * </code>
     *
     * @see       filterBySysUri()
     *
     * @param mixed $uriId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUriId($uriId = null, ?string $comparison = null)
    {
        if (is_array($uriId)) {
            $useMinMax = false;
            if (isset($uriId['min'])) {
                $this->addUsingAlias(SysRolXUriTableMap::COL_URI_ID, $uriId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uriId['max'])) {
                $this->addUsingAlias(SysRolXUriTableMap::COL_URI_ID, $uriId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysRolXUriTableMap::COL_URI_ID, $uriId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the AUT_READ column
     *
     * Example usage:
     * <code>
     * $query->filterByAutRead(true); // WHERE AUT_READ = true
     * $query->filterByAutRead('yes'); // WHERE AUT_READ = true
     * </code>
     *
     * @param bool|string $autRead The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAutRead($autRead = null, ?string $comparison = null)
    {
        if (is_string($autRead)) {
            $autRead = in_array(strtolower($autRead), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SysRolXUriTableMap::COL_AUT_READ, $autRead, $comparison);

        return $this;
    }

    /**
     * Filter the query on the AUT_CREATE column
     *
     * Example usage:
     * <code>
     * $query->filterByAutCreate(true); // WHERE AUT_CREATE = true
     * $query->filterByAutCreate('yes'); // WHERE AUT_CREATE = true
     * </code>
     *
     * @param bool|string $autCreate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAutCreate($autCreate = null, ?string $comparison = null)
    {
        if (is_string($autCreate)) {
            $autCreate = in_array(strtolower($autCreate), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SysRolXUriTableMap::COL_AUT_CREATE, $autCreate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the AUT_UPDATE column
     *
     * Example usage:
     * <code>
     * $query->filterByAutUpdate(true); // WHERE AUT_UPDATE = true
     * $query->filterByAutUpdate('yes'); // WHERE AUT_UPDATE = true
     * </code>
     *
     * @param bool|string $autUpdate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAutUpdate($autUpdate = null, ?string $comparison = null)
    {
        if (is_string($autUpdate)) {
            $autUpdate = in_array(strtolower($autUpdate), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SysRolXUriTableMap::COL_AUT_UPDATE, $autUpdate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the AUT_DELETE column
     *
     * Example usage:
     * <code>
     * $query->filterByAutDelete(true); // WHERE AUT_DELETE = true
     * $query->filterByAutDelete('yes'); // WHERE AUT_DELETE = true
     * </code>
     *
     * @param bool|string $autDelete The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAutDelete($autDelete = null, ?string $comparison = null)
    {
        if (is_string($autDelete)) {
            $autDelete = in_array(strtolower($autDelete), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SysRolXUriTableMap::COL_AUT_DELETE, $autDelete, $comparison);

        return $this;
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
                ->addUsingAlias(SysRolXUriTableMap::COL_ROL_ID, $sysRol->getId(), $comparison);
        } elseif ($sysRol instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysRolXUriTableMap::COL_ROL_ID, $sysRol->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \SysUri object
     *
     * @param \SysUri|ObjectCollection $sysUri The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysUri($sysUri, ?string $comparison = null)
    {
        if ($sysUri instanceof \SysUri) {
            return $this
                ->addUsingAlias(SysRolXUriTableMap::COL_URI_ID, $sysUri->getId(), $comparison);
        } elseif ($sysUri instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysRolXUriTableMap::COL_URI_ID, $sysUri->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * @param ChildSysRolXUri $sysRolXUri Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysRolXUri = null)
    {
        if ($sysRolXUri) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SysRolXUriTableMap::COL_ROL_ID), $sysRolXUri->getRolId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SysRolXUriTableMap::COL_URI_ID), $sysRolXUri->getUriId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_rol_x_uri table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolXUriTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysRolXUriTableMap::clearInstancePool();
            SysRolXUriTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolXUriTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysRolXUriTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysRolXUriTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysRolXUriTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
