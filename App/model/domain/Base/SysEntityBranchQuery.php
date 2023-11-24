<?php

namespace App\model\domain\Base;

use \Exception;
use \PDO;
use App\model\domain\SysEntityBranch as ChildSysEntityBranch;
use App\model\domain\SysEntityBranchQuery as ChildSysEntityBranchQuery;
use App\model\domain\Map\SysEntityBranchTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_entity_branch' table.
 *
 *
 *
 * @method     ChildSysEntityBranchQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEntityBranchQuery orderByEntityId($order = Criteria::ASC) Order by the ENTITY_ID column
 * @method     ChildSysEntityBranchQuery orderByLocationId($order = Criteria::ASC) Order by the LOCATION_ID column
 * @method     ChildSysEntityBranchQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildSysEntityBranchQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysEntityBranchQuery orderByAddress($order = Criteria::ASC) Order by the ADDRESS column
 * @method     ChildSysEntityBranchQuery orderByPhone($order = Criteria::ASC) Order by the PHONE column
 * @method     ChildSysEntityBranchQuery orderByCellphone($order = Criteria::ASC) Order by the CELLPHONE column
 * @method     ChildSysEntityBranchQuery orderByFax($order = Criteria::ASC) Order by the FAX column
 * @method     ChildSysEntityBranchQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 *
 * @method     ChildSysEntityBranchQuery groupById() Group by the ID column
 * @method     ChildSysEntityBranchQuery groupByEntityId() Group by the ENTITY_ID column
 * @method     ChildSysEntityBranchQuery groupByLocationId() Group by the LOCATION_ID column
 * @method     ChildSysEntityBranchQuery groupByStatus() Group by the STATUS column
 * @method     ChildSysEntityBranchQuery groupByName() Group by the NAME column
 * @method     ChildSysEntityBranchQuery groupByAddress() Group by the ADDRESS column
 * @method     ChildSysEntityBranchQuery groupByPhone() Group by the PHONE column
 * @method     ChildSysEntityBranchQuery groupByCellphone() Group by the CELLPHONE column
 * @method     ChildSysEntityBranchQuery groupByFax() Group by the FAX column
 * @method     ChildSysEntityBranchQuery groupByDescription() Group by the DESCRIPTION column
 *
 * @method     ChildSysEntityBranchQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEntityBranchQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEntityBranchQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEntityBranchQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEntityBranchQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEntityBranchQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEntityBranchQuery leftJoinSysEntity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityBranchQuery rightJoinSysEntity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityBranchQuery innerJoinSysEntity($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntity relation
 *
 * @method     ChildSysEntityBranchQuery joinWithSysEntity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysEntityBranchQuery leftJoinWithSysEntity() Adds a LEFT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityBranchQuery rightJoinWithSysEntity() Adds a RIGHT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysEntityBranchQuery innerJoinWithSysEntity() Adds a INNER JOIN clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysEntityBranchQuery leftJoinSysLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysLocation relation
 * @method     ChildSysEntityBranchQuery rightJoinSysLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysLocation relation
 * @method     ChildSysEntityBranchQuery innerJoinSysLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the SysLocation relation
 *
 * @method     ChildSysEntityBranchQuery joinWithSysLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysLocation relation
 *
 * @method     ChildSysEntityBranchQuery leftJoinWithSysLocation() Adds a LEFT JOIN clause and with to the query using the SysLocation relation
 * @method     ChildSysEntityBranchQuery rightJoinWithSysLocation() Adds a RIGHT JOIN clause and with to the query using the SysLocation relation
 * @method     ChildSysEntityBranchQuery innerJoinWithSysLocation() Adds a INNER JOIN clause and with to the query using the SysLocation relation
 *
 * @method     \App\model\domain\SysEntityQuery|\App\model\domain\SysLocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEntityBranch findOne(ConnectionInterface $con = null) Return the first ChildSysEntityBranch matching the query
 * @method     ChildSysEntityBranch findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysEntityBranch matching the query, or a new ChildSysEntityBranch object populated from the query conditions when no match is found
 *
 * @method     ChildSysEntityBranch findOneById(int $ID) Return the first ChildSysEntityBranch filtered by the ID column
 * @method     ChildSysEntityBranch findOneByEntityId(int $ENTITY_ID) Return the first ChildSysEntityBranch filtered by the ENTITY_ID column
 * @method     ChildSysEntityBranch findOneByLocationId(int $LOCATION_ID) Return the first ChildSysEntityBranch filtered by the LOCATION_ID column
 * @method     ChildSysEntityBranch findOneByStatus(string $STATUS) Return the first ChildSysEntityBranch filtered by the STATUS column
 * @method     ChildSysEntityBranch findOneByName(string $NAME) Return the first ChildSysEntityBranch filtered by the NAME column
 * @method     ChildSysEntityBranch findOneByAddress(string $ADDRESS) Return the first ChildSysEntityBranch filtered by the ADDRESS column
 * @method     ChildSysEntityBranch findOneByPhone(string $PHONE) Return the first ChildSysEntityBranch filtered by the PHONE column
 * @method     ChildSysEntityBranch findOneByCellphone(string $CELLPHONE) Return the first ChildSysEntityBranch filtered by the CELLPHONE column
 * @method     ChildSysEntityBranch findOneByFax(string $FAX) Return the first ChildSysEntityBranch filtered by the FAX column
 * @method     ChildSysEntityBranch findOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityBranch filtered by the DESCRIPTION column *

 * @method     ChildSysEntityBranch requirePk($key, ConnectionInterface $con = null) Return the ChildSysEntityBranch by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOne(ConnectionInterface $con = null) Return the first ChildSysEntityBranch matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityBranch requireOneById(int $ID) Return the first ChildSysEntityBranch filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByEntityId(int $ENTITY_ID) Return the first ChildSysEntityBranch filtered by the ENTITY_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByLocationId(int $LOCATION_ID) Return the first ChildSysEntityBranch filtered by the LOCATION_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByStatus(string $STATUS) Return the first ChildSysEntityBranch filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByName(string $NAME) Return the first ChildSysEntityBranch filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByAddress(string $ADDRESS) Return the first ChildSysEntityBranch filtered by the ADDRESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByPhone(string $PHONE) Return the first ChildSysEntityBranch filtered by the PHONE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByCellphone(string $CELLPHONE) Return the first ChildSysEntityBranch filtered by the CELLPHONE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByFax(string $FAX) Return the first ChildSysEntityBranch filtered by the FAX column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityBranch requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityBranch filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityBranch[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysEntityBranch objects based on current ModelCriteria
 * @method     ChildSysEntityBranch[]|ObjectCollection findById(int $ID) Return ChildSysEntityBranch objects filtered by the ID column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByEntityId(int $ENTITY_ID) Return ChildSysEntityBranch objects filtered by the ENTITY_ID column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByLocationId(int $LOCATION_ID) Return ChildSysEntityBranch objects filtered by the LOCATION_ID column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByStatus(string $STATUS) Return ChildSysEntityBranch objects filtered by the STATUS column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByName(string $NAME) Return ChildSysEntityBranch objects filtered by the NAME column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByAddress(string $ADDRESS) Return ChildSysEntityBranch objects filtered by the ADDRESS column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByPhone(string $PHONE) Return ChildSysEntityBranch objects filtered by the PHONE column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByCellphone(string $CELLPHONE) Return ChildSysEntityBranch objects filtered by the CELLPHONE column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByFax(string $FAX) Return ChildSysEntityBranch objects filtered by the FAX column
 * @method     ChildSysEntityBranch[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysEntityBranch objects filtered by the DESCRIPTION column
 * @method     ChildSysEntityBranch[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysEntityBranchQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\model\domain\Base\SysEntityBranchQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\model\\domain\\SysEntityBranch', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEntityBranchQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEntityBranchQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysEntityBranchQuery) {
            return $criteria;
        }
        $query = new ChildSysEntityBranchQuery();
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
     * @return ChildSysEntityBranch|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityBranchTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEntityBranchTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEntityBranch A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ENTITY_ID, LOCATION_ID, STATUS, NAME, ADDRESS, PHONE, CELLPHONE, FAX, DESCRIPTION FROM sys_entity_branch WHERE ID = :p0';
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
            /** @var ChildSysEntityBranch $obj */
            $obj = new ChildSysEntityBranch();
            $obj->hydrate($row);
            SysEntityBranchTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEntityBranch|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysEntityBranchTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEntityBranchTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_ID, $id, $comparison);
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
     * @param     mixed $entityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(SysEntityBranchTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(SysEntityBranchTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_ENTITY_ID, $entityId, $comparison);
    }

    /**
     * Filter the query on the LOCATION_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationId(1234); // WHERE LOCATION_ID = 1234
     * $query->filterByLocationId(array(12, 34)); // WHERE LOCATION_ID IN (12, 34)
     * $query->filterByLocationId(array('min' => 12)); // WHERE LOCATION_ID > 12
     * </code>
     *
     * @see       filterBySysLocation()
     *
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(SysEntityBranchTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(SysEntityBranchTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE STATUS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the ADDRESS column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE ADDRESS = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE ADDRESS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the PHONE column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE PHONE = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE PHONE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the CELLPHONE column
     *
     * Example usage:
     * <code>
     * $query->filterByCellphone('fooValue');   // WHERE CELLPHONE = 'fooValue'
     * $query->filterByCellphone('%fooValue%', Criteria::LIKE); // WHERE CELLPHONE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cellphone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByCellphone($cellphone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cellphone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_CELLPHONE, $cellphone, $comparison);
    }

    /**
     * Filter the query on the FAX column
     *
     * Example usage:
     * <code>
     * $query->filterByFax('fooValue');   // WHERE FAX = 'fooValue'
     * $query->filterByFax('%fooValue%', Criteria::LIKE); // WHERE FAX LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fax The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fax)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_FAX, $fax, $comparison);
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
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityBranchTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \App\model\domain\SysEntity object
     *
     * @param \App\model\domain\SysEntity|ObjectCollection $sysEntity The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterBySysEntity($sysEntity, $comparison = null)
    {
        if ($sysEntity instanceof \App\model\domain\SysEntity) {
            return $this
                ->addUsingAlias(SysEntityBranchTableMap::COL_ENTITY_ID, $sysEntity->getId(), $comparison);
        } elseif ($sysEntity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysEntityBranchTableMap::COL_ENTITY_ID, $sysEntity->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysEntity() only accepts arguments of type \App\model\domain\SysEntity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function joinSysEntity($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysEntityQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntity', '\App\model\domain\SysEntityQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysLocation object
     *
     * @param \App\model\domain\SysLocation|ObjectCollection $sysLocation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function filterBySysLocation($sysLocation, $comparison = null)
    {
        if ($sysLocation instanceof \App\model\domain\SysLocation) {
            return $this
                ->addUsingAlias(SysEntityBranchTableMap::COL_LOCATION_ID, $sysLocation->getId(), $comparison);
        } elseif ($sysLocation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysEntityBranchTableMap::COL_LOCATION_ID, $sysLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysLocation() only accepts arguments of type \App\model\domain\SysLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function joinSysLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysLocation');

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
            $this->addJoinObject($join, 'SysLocation');
        }

        return $this;
    }

    /**
     * Use the SysLocation relation SysLocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysLocationQuery A secondary query class using the current class as primary query
     */
    public function useSysLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysLocation', '\App\model\domain\SysLocationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysEntityBranch $sysEntityBranch Object to remove from the list of results
     *
     * @return $this|ChildSysEntityBranchQuery The current query, for fluid interface
     */
    public function prune($sysEntityBranch = null)
    {
        if ($sysEntityBranch) {
            $this->addUsingAlias(SysEntityBranchTableMap::COL_ID, $sysEntityBranch->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_entity_branch table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityBranchTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEntityBranchTableMap::clearInstancePool();
            SysEntityBranchTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityBranchTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEntityBranchTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEntityBranchTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEntityBranchTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysEntityBranchQuery
