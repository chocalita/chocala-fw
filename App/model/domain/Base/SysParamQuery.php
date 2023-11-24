<?php

namespace App\model\domain\Base;

use \Exception;
use \PDO;
use App\model\domain\SysParam as ChildSysParam;
use App\model\domain\SysParamQuery as ChildSysParamQuery;
use App\model\domain\Map\SysParamTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_param' table.
 *
 *
 *
 * @method     ChildSysParamQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysParamQuery orderByVisibility($order = Criteria::ASC) Order by the VISIBILITY column
 * @method     ChildSysParamQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysParamQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysParamQuery orderByType($order = Criteria::ASC) Order by the TYPE column
 * @method     ChildSysParamQuery orderByValue($order = Criteria::ASC) Order by the VALUE column
 * @method     ChildSysParamQuery orderByOptions($order = Criteria::ASC) Order by the OPTIONS column
 * @method     ChildSysParamQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysParamQuery orderByCustomizable($order = Criteria::ASC) Order by the CUSTOMIZABLE column
 * @method     ChildSysParamQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysParamQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysParamQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysParamQuery groupById() Group by the ID column
 * @method     ChildSysParamQuery groupByVisibility() Group by the VISIBILITY column
 * @method     ChildSysParamQuery groupByCode() Group by the CODE column
 * @method     ChildSysParamQuery groupByName() Group by the NAME column
 * @method     ChildSysParamQuery groupByType() Group by the TYPE column
 * @method     ChildSysParamQuery groupByValue() Group by the VALUE column
 * @method     ChildSysParamQuery groupByOptions() Group by the OPTIONS column
 * @method     ChildSysParamQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysParamQuery groupByCustomizable() Group by the CUSTOMIZABLE column
 * @method     ChildSysParamQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysParamQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysParamQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysParamQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysParamQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysParamQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysParamQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysParamQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysParamQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysParamQuery leftJoinSysEntityParam($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityParam relation
 * @method     ChildSysParamQuery rightJoinSysEntityParam($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityParam relation
 * @method     ChildSysParamQuery innerJoinSysEntityParam($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityParam relation
 *
 * @method     ChildSysParamQuery joinWithSysEntityParam($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityParam relation
 *
 * @method     ChildSysParamQuery leftJoinWithSysEntityParam() Adds a LEFT JOIN clause and with to the query using the SysEntityParam relation
 * @method     ChildSysParamQuery rightJoinWithSysEntityParam() Adds a RIGHT JOIN clause and with to the query using the SysEntityParam relation
 * @method     ChildSysParamQuery innerJoinWithSysEntityParam() Adds a INNER JOIN clause and with to the query using the SysEntityParam relation
 *
 * @method     ChildSysParamQuery leftJoinSysUserParam($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUserParam relation
 * @method     ChildSysParamQuery rightJoinSysUserParam($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUserParam relation
 * @method     ChildSysParamQuery innerJoinSysUserParam($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUserParam relation
 *
 * @method     ChildSysParamQuery joinWithSysUserParam($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUserParam relation
 *
 * @method     ChildSysParamQuery leftJoinWithSysUserParam() Adds a LEFT JOIN clause and with to the query using the SysUserParam relation
 * @method     ChildSysParamQuery rightJoinWithSysUserParam() Adds a RIGHT JOIN clause and with to the query using the SysUserParam relation
 * @method     ChildSysParamQuery innerJoinWithSysUserParam() Adds a INNER JOIN clause and with to the query using the SysUserParam relation
 *
 * @method     \App\model\domain\SysEntityParamQuery|\App\model\domain\SysUserParamQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysParam findOne(ConnectionInterface $con = null) Return the first ChildSysParam matching the query
 * @method     ChildSysParam findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysParam matching the query, or a new ChildSysParam object populated from the query conditions when no match is found
 *
 * @method     ChildSysParam findOneById(int $ID) Return the first ChildSysParam filtered by the ID column
 * @method     ChildSysParam findOneByVisibility(string $VISIBILITY) Return the first ChildSysParam filtered by the VISIBILITY column
 * @method     ChildSysParam findOneByCode(string $CODE) Return the first ChildSysParam filtered by the CODE column
 * @method     ChildSysParam findOneByName(string $NAME) Return the first ChildSysParam filtered by the NAME column
 * @method     ChildSysParam findOneByType(string $TYPE) Return the first ChildSysParam filtered by the TYPE column
 * @method     ChildSysParam findOneByValue(string $VALUE) Return the first ChildSysParam filtered by the VALUE column
 * @method     ChildSysParam findOneByOptions(string $OPTIONS) Return the first ChildSysParam filtered by the OPTIONS column
 * @method     ChildSysParam findOneByDescription(string $DESCRIPTION) Return the first ChildSysParam filtered by the DESCRIPTION column
 * @method     ChildSysParam findOneByCustomizable(boolean $CUSTOMIZABLE) Return the first ChildSysParam filtered by the CUSTOMIZABLE column
 * @method     ChildSysParam findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysParam filtered by the LAST_USER_ID column
 * @method     ChildSysParam findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysParam filtered by the CREATION_DATE column
 * @method     ChildSysParam findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysParam filtered by the MODIFICATION_DATE column *

 * @method     ChildSysParam requirePk($key, ConnectionInterface $con = null) Return the ChildSysParam by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOne(ConnectionInterface $con = null) Return the first ChildSysParam matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysParam requireOneById(int $ID) Return the first ChildSysParam filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByVisibility(string $VISIBILITY) Return the first ChildSysParam filtered by the VISIBILITY column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByCode(string $CODE) Return the first ChildSysParam filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByName(string $NAME) Return the first ChildSysParam filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByType(string $TYPE) Return the first ChildSysParam filtered by the TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByValue(string $VALUE) Return the first ChildSysParam filtered by the VALUE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByOptions(string $OPTIONS) Return the first ChildSysParam filtered by the OPTIONS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByDescription(string $DESCRIPTION) Return the first ChildSysParam filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByCustomizable(boolean $CUSTOMIZABLE) Return the first ChildSysParam filtered by the CUSTOMIZABLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysParam filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysParam filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysParam requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysParam filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysParam[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysParam objects based on current ModelCriteria
 * @method     ChildSysParam[]|ObjectCollection findById(int $ID) Return ChildSysParam objects filtered by the ID column
 * @method     ChildSysParam[]|ObjectCollection findByVisibility(string $VISIBILITY) Return ChildSysParam objects filtered by the VISIBILITY column
 * @method     ChildSysParam[]|ObjectCollection findByCode(string $CODE) Return ChildSysParam objects filtered by the CODE column
 * @method     ChildSysParam[]|ObjectCollection findByName(string $NAME) Return ChildSysParam objects filtered by the NAME column
 * @method     ChildSysParam[]|ObjectCollection findByType(string $TYPE) Return ChildSysParam objects filtered by the TYPE column
 * @method     ChildSysParam[]|ObjectCollection findByValue(string $VALUE) Return ChildSysParam objects filtered by the VALUE column
 * @method     ChildSysParam[]|ObjectCollection findByOptions(string $OPTIONS) Return ChildSysParam objects filtered by the OPTIONS column
 * @method     ChildSysParam[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysParam objects filtered by the DESCRIPTION column
 * @method     ChildSysParam[]|ObjectCollection findByCustomizable(boolean $CUSTOMIZABLE) Return ChildSysParam objects filtered by the CUSTOMIZABLE column
 * @method     ChildSysParam[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildSysParam objects filtered by the LAST_USER_ID column
 * @method     ChildSysParam[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildSysParam objects filtered by the CREATION_DATE column
 * @method     ChildSysParam[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildSysParam objects filtered by the MODIFICATION_DATE column
 * @method     ChildSysParam[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysParamQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\model\domain\Base\SysParamQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\model\\domain\\SysParam', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysParamQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysParamQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysParamQuery) {
            return $criteria;
        }
        $query = new ChildSysParamQuery();
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
     * @return ChildSysParam|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysParamTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysParamTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildSysParam A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, VISIBILITY, CODE, NAME, TYPE, VALUE, OPTIONS, DESCRIPTION, CUSTOMIZABLE, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_param WHERE ID = :p0';
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
            /** @var ChildSysParam $obj */
            $obj = new ChildSysParam();
            $obj->hydrate($row);
            SysParamTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysParam|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysParamTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysParamTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysParamTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysParamTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the VISIBILITY column
     *
     * Example usage:
     * <code>
     * $query->filterByVisibility('fooValue');   // WHERE VISIBILITY = 'fooValue'
     * $query->filterByVisibility('%fooValue%', Criteria::LIKE); // WHERE VISIBILITY LIKE '%fooValue%'
     * </code>
     *
     * @param     string $visibility The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByVisibility($visibility = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visibility)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_VISIBILITY, $visibility, $comparison);
    }

    /**
     * Filter the query on the CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE CODE = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE CODE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE NAME = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the TYPE column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE TYPE = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE TYPE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the VALUE column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE VALUE = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE VALUE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the OPTIONS column
     *
     * Example usage:
     * <code>
     * $query->filterByOptions('fooValue');   // WHERE OPTIONS = 'fooValue'
     * $query->filterByOptions('%fooValue%', Criteria::LIKE); // WHERE OPTIONS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $options The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByOptions($options = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($options)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_OPTIONS, $options, $comparison);
    }

    /**
     * Filter the query on the DESCRIPTION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE DESCRIPTION = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE DESCRIPTION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the CUSTOMIZABLE column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomizable(true); // WHERE CUSTOMIZABLE = true
     * $query->filterByCustomizable('yes'); // WHERE CUSTOMIZABLE = true
     * </code>
     *
     * @param     boolean|string $customizable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByCustomizable($customizable = null, $comparison = null)
    {
        if (is_string($customizable)) {
            $customizable = in_array(strtolower($customizable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SysParamTableMap::COL_CUSTOMIZABLE, $customizable, $comparison);
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
     * @param     mixed $lastUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysParamTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysParamTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @param     mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysParamTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysParamTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @param     mixed $modificationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(SysParamTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysParamTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysParamTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \App\model\domain\SysEntityParam object
     *
     * @param \App\model\domain\SysEntityParam|ObjectCollection $sysEntityParam the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysParamQuery The current query, for fluid interface
     */
    public function filterBySysEntityParam($sysEntityParam, $comparison = null)
    {
        if ($sysEntityParam instanceof \App\model\domain\SysEntityParam) {
            return $this
                ->addUsingAlias(SysParamTableMap::COL_ID, $sysEntityParam->getParamId(), $comparison);
        } elseif ($sysEntityParam instanceof ObjectCollection) {
            return $this
                ->useSysEntityParamQuery()
                ->filterByPrimaryKeys($sysEntityParam->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEntityParam() only accepts arguments of type \App\model\domain\SysEntityParam or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityParam relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function joinSysEntityParam($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityParam');

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
            $this->addJoinObject($join, 'SysEntityParam');
        }

        return $this;
    }

    /**
     * Use the SysEntityParam relation SysEntityParam object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysEntityParamQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityParamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityParam($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityParam', '\App\model\domain\SysEntityParamQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysUserParam object
     *
     * @param \App\model\domain\SysUserParam|ObjectCollection $sysUserParam the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysParamQuery The current query, for fluid interface
     */
    public function filterBySysUserParam($sysUserParam, $comparison = null)
    {
        if ($sysUserParam instanceof \App\model\domain\SysUserParam) {
            return $this
                ->addUsingAlias(SysParamTableMap::COL_ID, $sysUserParam->getParamId(), $comparison);
        } elseif ($sysUserParam instanceof ObjectCollection) {
            return $this
                ->useSysUserParamQuery()
                ->filterByPrimaryKeys($sysUserParam->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysUserParam() only accepts arguments of type \App\model\domain\SysUserParam or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUserParam relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function joinSysUserParam($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUserParam');

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
            $this->addJoinObject($join, 'SysUserParam');
        }

        return $this;
    }

    /**
     * Use the SysUserParam relation SysUserParam object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysUserParamQuery A secondary query class using the current class as primary query
     */
    public function useSysUserParamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUserParam($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUserParam', '\App\model\domain\SysUserParamQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysParam $sysParam Object to remove from the list of results
     *
     * @return $this|ChildSysParamQuery The current query, for fluid interface
     */
    public function prune($sysParam = null)
    {
        if ($sysParam) {
            $this->addUsingAlias(SysParamTableMap::COL_ID, $sysParam->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_param table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysParamTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysParamTableMap::clearInstancePool();
            SysParamTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysParamTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysParamTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysParamTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysParamTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysParamQuery
