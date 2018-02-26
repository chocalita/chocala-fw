<?php

namespace Base;

use \SysEntity as ChildSysEntity;
use \SysEntityQuery as ChildSysEntityQuery;
use \Exception;
use \PDO;
use Map\SysEntityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_entity' table.
 *
 *
 *
 * @method     ChildSysEntityQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEntityQuery orderByEntityTypeId($order = Criteria::ASC) Order by the ENTITY_TYPE_ID column
 * @method     ChildSysEntityQuery orderByLocationId($order = Criteria::ASC) Order by the LOCATION_ID column
 * @method     ChildSysEntityQuery orderByMainBranchId($order = Criteria::ASC) Order by the MAIN_BRANCH_ID column
 * @method     ChildSysEntityQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysEntityQuery orderByComercialName($order = Criteria::ASC) Order by the COMERCIAL_NAME column
 * @method     ChildSysEntityQuery orderByFormalName($order = Criteria::ASC) Order by the FORMAL_NAME column
 * @method     ChildSysEntityQuery orderByNit($order = Criteria::ASC) Order by the NIT column
 * @method     ChildSysEntityQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildSysEntityQuery orderByAddress($order = Criteria::ASC) Order by the ADDRESS column
 * @method     ChildSysEntityQuery orderByPhone($order = Criteria::ASC) Order by the PHONE column
 * @method     ChildSysEntityQuery orderByCellphone($order = Criteria::ASC) Order by the CELLPHONE column
 * @method     ChildSysEntityQuery orderByActivities($order = Criteria::ASC) Order by the ACTIVITIES column
 * @method     ChildSysEntityQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysEntityQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysEntityQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysEntityQuery orderByModificacionDate($order = Criteria::ASC) Order by the MODIFICACION_DATE column
 *
 * @method     ChildSysEntityQuery groupById() Group by the ID column
 * @method     ChildSysEntityQuery groupByEntityTypeId() Group by the ENTITY_TYPE_ID column
 * @method     ChildSysEntityQuery groupByLocationId() Group by the LOCATION_ID column
 * @method     ChildSysEntityQuery groupByMainBranchId() Group by the MAIN_BRANCH_ID column
 * @method     ChildSysEntityQuery groupByCode() Group by the CODE column
 * @method     ChildSysEntityQuery groupByComercialName() Group by the COMERCIAL_NAME column
 * @method     ChildSysEntityQuery groupByFormalName() Group by the FORMAL_NAME column
 * @method     ChildSysEntityQuery groupByNit() Group by the NIT column
 * @method     ChildSysEntityQuery groupByEmail() Group by the EMAIL column
 * @method     ChildSysEntityQuery groupByAddress() Group by the ADDRESS column
 * @method     ChildSysEntityQuery groupByPhone() Group by the PHONE column
 * @method     ChildSysEntityQuery groupByCellphone() Group by the CELLPHONE column
 * @method     ChildSysEntityQuery groupByActivities() Group by the ACTIVITIES column
 * @method     ChildSysEntityQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysEntityQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysEntityQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysEntityQuery groupByModificacionDate() Group by the MODIFICACION_DATE column
 *
 * @method     ChildSysEntityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEntityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEntityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEntityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEntityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEntityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery rightJoinSysEntityType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery innerJoinSysEntityType($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityType relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityType relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityType() Adds a LEFT JOIN clause and with to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityType() Adds a RIGHT JOIN clause and with to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityType() Adds a INNER JOIN clause and with to the query using the SysEntityType relation
 *
 * @method     ChildSysEntityQuery leftJoinSysLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysLocation relation
 * @method     ChildSysEntityQuery rightJoinSysLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysLocation relation
 * @method     ChildSysEntityQuery innerJoinSysLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the SysLocation relation
 *
 * @method     ChildSysEntityQuery joinWithSysLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysLocation relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysLocation() Adds a LEFT JOIN clause and with to the query using the SysLocation relation
 * @method     ChildSysEntityQuery rightJoinWithSysLocation() Adds a RIGHT JOIN clause and with to the query using the SysLocation relation
 * @method     ChildSysEntityQuery innerJoinWithSysLocation() Adds a INNER JOIN clause and with to the query using the SysLocation relation
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery rightJoinSysEntityBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery innerJoinSysEntityBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityBranch relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityBranch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityBranch relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityBranch() Adds a LEFT JOIN clause and with to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityBranch() Adds a RIGHT JOIN clause and with to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityBranch() Adds a INNER JOIN clause and with to the query using the SysEntityBranch relation
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityParam($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery rightJoinSysEntityParam($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery innerJoinSysEntityParam($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityParam relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityParam($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityParam relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityParam() Adds a LEFT JOIN clause and with to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityParam() Adds a RIGHT JOIN clause and with to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityParam() Adds a INNER JOIN clause and with to the query using the SysEntityParam relation
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery rightJoinSysEntityUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery innerJoinSysEntityUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityUser relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityUser relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityUser() Adds a LEFT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityUser() Adds a RIGHT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityUser() Adds a INNER JOIN clause and with to the query using the SysEntityUser relation
 *
 * @method     \SysEntityTypeQuery|\SysLocationQuery|\SysEntityBranchQuery|\SysEntityParamQuery|\SysEntityUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEntity findOne(ConnectionInterface $con = null) Return the first ChildSysEntity matching the query
 * @method     ChildSysEntity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysEntity matching the query, or a new ChildSysEntity object populated from the query conditions when no match is found
 *
 * @method     ChildSysEntity findOneById(int $ID) Return the first ChildSysEntity filtered by the ID column
 * @method     ChildSysEntity findOneByEntityTypeId(int $ENTITY_TYPE_ID) Return the first ChildSysEntity filtered by the ENTITY_TYPE_ID column
 * @method     ChildSysEntity findOneByLocationId(int $LOCATION_ID) Return the first ChildSysEntity filtered by the LOCATION_ID column
 * @method     ChildSysEntity findOneByMainBranchId(int $MAIN_BRANCH_ID) Return the first ChildSysEntity filtered by the MAIN_BRANCH_ID column
 * @method     ChildSysEntity findOneByCode(string $CODE) Return the first ChildSysEntity filtered by the CODE column
 * @method     ChildSysEntity findOneByComercialName(string $COMERCIAL_NAME) Return the first ChildSysEntity filtered by the COMERCIAL_NAME column
 * @method     ChildSysEntity findOneByFormalName(string $FORMAL_NAME) Return the first ChildSysEntity filtered by the FORMAL_NAME column
 * @method     ChildSysEntity findOneByNit(string $NIT) Return the first ChildSysEntity filtered by the NIT column
 * @method     ChildSysEntity findOneByEmail(string $EMAIL) Return the first ChildSysEntity filtered by the EMAIL column
 * @method     ChildSysEntity findOneByAddress(string $ADDRESS) Return the first ChildSysEntity filtered by the ADDRESS column
 * @method     ChildSysEntity findOneByPhone(string $PHONE) Return the first ChildSysEntity filtered by the PHONE column
 * @method     ChildSysEntity findOneByCellphone(string $CELLPHONE) Return the first ChildSysEntity filtered by the CELLPHONE column
 * @method     ChildSysEntity findOneByActivities(string $ACTIVITIES) Return the first ChildSysEntity filtered by the ACTIVITIES column
 * @method     ChildSysEntity findOneByDescription(string $DESCRIPTION) Return the first ChildSysEntity filtered by the DESCRIPTION column
 * @method     ChildSysEntity findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntity filtered by the LAST_USER_ID column
 * @method     ChildSysEntity findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntity filtered by the CREATION_DATE column
 * @method     ChildSysEntity findOneByModificacionDate(string $MODIFICACION_DATE) Return the first ChildSysEntity filtered by the MODIFICACION_DATE column *

 * @method     ChildSysEntity requirePk($key, ConnectionInterface $con = null) Return the ChildSysEntity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOne(ConnectionInterface $con = null) Return the first ChildSysEntity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntity requireOneById(int $ID) Return the first ChildSysEntity filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByEntityTypeId(int $ENTITY_TYPE_ID) Return the first ChildSysEntity filtered by the ENTITY_TYPE_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByLocationId(int $LOCATION_ID) Return the first ChildSysEntity filtered by the LOCATION_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByMainBranchId(int $MAIN_BRANCH_ID) Return the first ChildSysEntity filtered by the MAIN_BRANCH_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByCode(string $CODE) Return the first ChildSysEntity filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByComercialName(string $COMERCIAL_NAME) Return the first ChildSysEntity filtered by the COMERCIAL_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByFormalName(string $FORMAL_NAME) Return the first ChildSysEntity filtered by the FORMAL_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByNit(string $NIT) Return the first ChildSysEntity filtered by the NIT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByEmail(string $EMAIL) Return the first ChildSysEntity filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByAddress(string $ADDRESS) Return the first ChildSysEntity filtered by the ADDRESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByPhone(string $PHONE) Return the first ChildSysEntity filtered by the PHONE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByCellphone(string $CELLPHONE) Return the first ChildSysEntity filtered by the CELLPHONE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByActivities(string $ACTIVITIES) Return the first ChildSysEntity filtered by the ACTIVITIES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEntity filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntity filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntity filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByModificacionDate(string $MODIFICACION_DATE) Return the first ChildSysEntity filtered by the MODIFICACION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysEntity objects based on current ModelCriteria
 * @method     ChildSysEntity[]|ObjectCollection findById(int $ID) Return ChildSysEntity objects filtered by the ID column
 * @method     ChildSysEntity[]|ObjectCollection findByEntityTypeId(int $ENTITY_TYPE_ID) Return ChildSysEntity objects filtered by the ENTITY_TYPE_ID column
 * @method     ChildSysEntity[]|ObjectCollection findByLocationId(int $LOCATION_ID) Return ChildSysEntity objects filtered by the LOCATION_ID column
 * @method     ChildSysEntity[]|ObjectCollection findByMainBranchId(int $MAIN_BRANCH_ID) Return ChildSysEntity objects filtered by the MAIN_BRANCH_ID column
 * @method     ChildSysEntity[]|ObjectCollection findByCode(string $CODE) Return ChildSysEntity objects filtered by the CODE column
 * @method     ChildSysEntity[]|ObjectCollection findByComercialName(string $COMERCIAL_NAME) Return ChildSysEntity objects filtered by the COMERCIAL_NAME column
 * @method     ChildSysEntity[]|ObjectCollection findByFormalName(string $FORMAL_NAME) Return ChildSysEntity objects filtered by the FORMAL_NAME column
 * @method     ChildSysEntity[]|ObjectCollection findByNit(string $NIT) Return ChildSysEntity objects filtered by the NIT column
 * @method     ChildSysEntity[]|ObjectCollection findByEmail(string $EMAIL) Return ChildSysEntity objects filtered by the EMAIL column
 * @method     ChildSysEntity[]|ObjectCollection findByAddress(string $ADDRESS) Return ChildSysEntity objects filtered by the ADDRESS column
 * @method     ChildSysEntity[]|ObjectCollection findByPhone(string $PHONE) Return ChildSysEntity objects filtered by the PHONE column
 * @method     ChildSysEntity[]|ObjectCollection findByCellphone(string $CELLPHONE) Return ChildSysEntity objects filtered by the CELLPHONE column
 * @method     ChildSysEntity[]|ObjectCollection findByActivities(string $ACTIVITIES) Return ChildSysEntity objects filtered by the ACTIVITIES column
 * @method     ChildSysEntity[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysEntity objects filtered by the DESCRIPTION column
 * @method     ChildSysEntity[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildSysEntity objects filtered by the LAST_USER_ID column
 * @method     ChildSysEntity[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildSysEntity objects filtered by the CREATION_DATE column
 * @method     ChildSysEntity[]|ObjectCollection findByModificacionDate(string $MODIFICACION_DATE) Return ChildSysEntity objects filtered by the MODIFICACION_DATE column
 * @method     ChildSysEntity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysEntityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEntityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEntity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEntityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEntityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysEntityQuery) {
            return $criteria;
        }
        $query = new ChildSysEntityQuery();
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
     * @return ChildSysEntity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEntityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEntity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ENTITY_TYPE_ID, LOCATION_ID, MAIN_BRANCH_ID, CODE, COMERCIAL_NAME, FORMAL_NAME, NIT, EMAIL, ADDRESS, PHONE, CELLPHONE, ACTIVITIES, DESCRIPTION, LAST_USER_ID, CREATION_DATE, MODIFICACION_DATE FROM sys_entity WHERE ID = :p0';
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
            /** @var ChildSysEntity $obj */
            $obj = new ChildSysEntity();
            $obj->hydrate($row);
            SysEntityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEntity|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysEntityTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysEntityTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ENTITY_TYPE_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityTypeId(1234); // WHERE ENTITY_TYPE_ID = 1234
     * $query->filterByEntityTypeId(array(12, 34)); // WHERE ENTITY_TYPE_ID IN (12, 34)
     * $query->filterByEntityTypeId(array('min' => 12)); // WHERE ENTITY_TYPE_ID > 12
     * </code>
     *
     * @see       filterBySysEntityType()
     *
     * @param     mixed $entityTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByEntityTypeId($entityTypeId = null, $comparison = null)
    {
        if (is_array($entityTypeId)) {
            $useMinMax = false;
            if (isset($entityTypeId['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $entityTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityTypeId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $entityTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $entityTypeId, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the MAIN_BRANCH_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByMainBranchId(1234); // WHERE MAIN_BRANCH_ID = 1234
     * $query->filterByMainBranchId(array(12, 34)); // WHERE MAIN_BRANCH_ID IN (12, 34)
     * $query->filterByMainBranchId(array('min' => 12)); // WHERE MAIN_BRANCH_ID > 12
     * </code>
     *
     * @param     mixed $mainBranchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByMainBranchId($mainBranchId = null, $comparison = null)
    {
        if (is_array($mainBranchId)) {
            $useMinMax = false;
            if (isset($mainBranchId['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MAIN_BRANCH_ID, $mainBranchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mainBranchId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MAIN_BRANCH_ID, $mainBranchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_MAIN_BRANCH_ID, $mainBranchId, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the COMERCIAL_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByComercialName('fooValue');   // WHERE COMERCIAL_NAME = 'fooValue'
     * $query->filterByComercialName('%fooValue%', Criteria::LIKE); // WHERE COMERCIAL_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comercialName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByComercialName($comercialName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comercialName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_COMERCIAL_NAME, $comercialName, $comparison);
    }

    /**
     * Filter the query on the FORMAL_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByFormalName('fooValue');   // WHERE FORMAL_NAME = 'fooValue'
     * $query->filterByFormalName('%fooValue%', Criteria::LIKE); // WHERE FORMAL_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formalName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByFormalName($formalName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formalName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_FORMAL_NAME, $formalName, $comparison);
    }

    /**
     * Filter the query on the NIT column
     *
     * Example usage:
     * <code>
     * $query->filterByNit('fooValue');   // WHERE NIT = 'fooValue'
     * $query->filterByNit('%fooValue%', Criteria::LIKE); // WHERE NIT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nit The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByNit($nit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nit)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_NIT, $nit, $comparison);
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_ADDRESS, $address, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_PHONE, $phone, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByCellphone($cellphone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cellphone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_CELLPHONE, $cellphone, $comparison);
    }

    /**
     * Filter the query on the ACTIVITIES column
     *
     * Example usage:
     * <code>
     * $query->filterByActivities('fooValue');   // WHERE ACTIVITIES = 'fooValue'
     * $query->filterByActivities('%fooValue%', Criteria::LIKE); // WHERE ACTIVITIES LIKE '%fooValue%'
     * </code>
     *
     * @param     string $activities The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByActivities($activities = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($activities)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_ACTIVITIES, $activities, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the MODIFICACION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByModificacionDate('2011-03-14'); // WHERE MODIFICACION_DATE = '2011-03-14'
     * $query->filterByModificacionDate('now'); // WHERE MODIFICACION_DATE = '2011-03-14'
     * $query->filterByModificacionDate(array('max' => 'yesterday')); // WHERE MODIFICACION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $modificacionDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterByModificacionDate($modificacionDate = null, $comparison = null)
    {
        if (is_array($modificacionDate)) {
            $useMinMax = false;
            if (isset($modificacionDate['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MODIFICACION_DATE, $modificacionDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificacionDate['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MODIFICACION_DATE, $modificacionDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTableMap::COL_MODIFICACION_DATE, $modificacionDate, $comparison);
    }

    /**
     * Filter the query by a related \SysEntityType object
     *
     * @param \SysEntityType|ObjectCollection $sysEntityType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterBySysEntityType($sysEntityType, $comparison = null)
    {
        if ($sysEntityType instanceof \SysEntityType) {
            return $this
                ->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $sysEntityType->getId(), $comparison);
        } elseif ($sysEntityType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $sysEntityType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysEntityType() only accepts arguments of type \SysEntityType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function joinSysEntityType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityType');

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
            $this->addJoinObject($join, 'SysEntityType');
        }

        return $this;
    }

    /**
     * Use the SysEntityType relation SysEntityType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityTypeQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityType', '\SysEntityTypeQuery');
    }

    /**
     * Filter the query by a related \SysLocation object
     *
     * @param \SysLocation|ObjectCollection $sysLocation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterBySysLocation($sysLocation, $comparison = null)
    {
        if ($sysLocation instanceof \SysLocation) {
            return $this
                ->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $sysLocation->getId(), $comparison);
        } elseif ($sysLocation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $sysLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysLocation() only accepts arguments of type \SysLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function joinSysLocation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
     * @return \SysLocationQuery A secondary query class using the current class as primary query
     */
    public function useSysLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysLocation', '\SysLocationQuery');
    }

    /**
     * Filter the query by a related \SysEntityBranch object
     *
     * @param \SysEntityBranch|ObjectCollection $sysEntityBranch the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterBySysEntityBranch($sysEntityBranch, $comparison = null)
    {
        if ($sysEntityBranch instanceof \SysEntityBranch) {
            return $this
                ->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntityBranch->getEntityId(), $comparison);
        } elseif ($sysEntityBranch instanceof ObjectCollection) {
            return $this
                ->useSysEntityBranchQuery()
                ->filterByPrimaryKeys($sysEntityBranch->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEntityBranch() only accepts arguments of type \SysEntityBranch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityBranch relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function joinSysEntityBranch($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityBranch');

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
            $this->addJoinObject($join, 'SysEntityBranch');
        }

        return $this;
    }

    /**
     * Use the SysEntityBranch relation SysEntityBranch object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityBranchQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityBranchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityBranch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityBranch', '\SysEntityBranchQuery');
    }

    /**
     * Filter the query by a related \SysEntityParam object
     *
     * @param \SysEntityParam|ObjectCollection $sysEntityParam the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterBySysEntityParam($sysEntityParam, $comparison = null)
    {
        if ($sysEntityParam instanceof \SysEntityParam) {
            return $this
                ->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntityParam->getEntityId(), $comparison);
        } elseif ($sysEntityParam instanceof ObjectCollection) {
            return $this
                ->useSysEntityParamQuery()
                ->filterByPrimaryKeys($sysEntityParam->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEntityParam() only accepts arguments of type \SysEntityParam or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityParam relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
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
     * @return \SysEntityParamQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityParamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityParam($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityParam', '\SysEntityParamQuery');
    }

    /**
     * Filter the query by a related \SysEntityUser object
     *
     * @param \SysEntityUser|ObjectCollection $sysEntityUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysEntityQuery The current query, for fluid interface
     */
    public function filterBySysEntityUser($sysEntityUser, $comparison = null)
    {
        if ($sysEntityUser instanceof \SysEntityUser) {
            return $this
                ->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntityUser->getEntityId(), $comparison);
        } elseif ($sysEntityUser instanceof ObjectCollection) {
            return $this
                ->useSysEntityUserQuery()
                ->filterByPrimaryKeys($sysEntityUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEntityUser() only accepts arguments of type \SysEntityUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function joinSysEntityUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
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
     * Exclude object from result
     *
     * @param   ChildSysEntity $sysEntity Object to remove from the list of results
     *
     * @return $this|ChildSysEntityQuery The current query, for fluid interface
     */
    public function prune($sysEntity = null)
    {
        if ($sysEntity) {
            $this->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntity->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_entity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEntityTableMap::clearInstancePool();
            SysEntityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEntityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEntityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEntityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysEntityQuery
