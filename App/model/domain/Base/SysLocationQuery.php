<?php

namespace Base;

use \SysLocation as ChildSysLocation;
use \SysLocationQuery as ChildSysLocationQuery;
use \Exception;
use \PDO;
use Map\SysLocationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_location' table.
 *
 *
 *
 * @method     ChildSysLocationQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysLocationQuery orderByMainId($order = Criteria::ASC) Order by the MAIN_ID column
 * @method     ChildSysLocationQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysLocationQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildSysLocationQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysLocationQuery orderByType($order = Criteria::ASC) Order by the TYPE column
 * @method     ChildSysLocationQuery orderByLevel($order = Criteria::ASC) Order by the LEVEL column
 * @method     ChildSysLocationQuery orderByLft($order = Criteria::ASC) Order by the LFT column
 * @method     ChildSysLocationQuery orderByRgt($order = Criteria::ASC) Order by the RGT column
 * @method     ChildSysLocationQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysLocationQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysLocationQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysLocationQuery groupById() Group by the ID column
 * @method     ChildSysLocationQuery groupByMainId() Group by the MAIN_ID column
 * @method     ChildSysLocationQuery groupByCode() Group by the CODE column
 * @method     ChildSysLocationQuery groupByStatus() Group by the STATUS column
 * @method     ChildSysLocationQuery groupByName() Group by the NAME column
 * @method     ChildSysLocationQuery groupByType() Group by the TYPE column
 * @method     ChildSysLocationQuery groupByLevel() Group by the LEVEL column
 * @method     ChildSysLocationQuery groupByLft() Group by the LFT column
 * @method     ChildSysLocationQuery groupByRgt() Group by the RGT column
 * @method     ChildSysLocationQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysLocationQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysLocationQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysLocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysLocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysLocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysLocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysLocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysLocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysLocationQuery leftJoinSysEntity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysLocationQuery rightJoinSysEntity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysLocationQuery innerJoinSysEntity($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntity relation
 *
 * @method     ChildSysLocationQuery joinWithSysEntity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysLocationQuery leftJoinWithSysEntity() Adds a LEFT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysLocationQuery rightJoinWithSysEntity() Adds a RIGHT JOIN clause and with to the query using the SysEntity relation
 * @method     ChildSysLocationQuery innerJoinWithSysEntity() Adds a INNER JOIN clause and with to the query using the SysEntity relation
 *
 * @method     ChildSysLocationQuery leftJoinSysEntityBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityBranch relation
 * @method     ChildSysLocationQuery rightJoinSysEntityBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityBranch relation
 * @method     ChildSysLocationQuery innerJoinSysEntityBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityBranch relation
 *
 * @method     ChildSysLocationQuery joinWithSysEntityBranch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityBranch relation
 *
 * @method     ChildSysLocationQuery leftJoinWithSysEntityBranch() Adds a LEFT JOIN clause and with to the query using the SysEntityBranch relation
 * @method     ChildSysLocationQuery rightJoinWithSysEntityBranch() Adds a RIGHT JOIN clause and with to the query using the SysEntityBranch relation
 * @method     ChildSysLocationQuery innerJoinWithSysEntityBranch() Adds a INNER JOIN clause and with to the query using the SysEntityBranch relation
 *
 * @method     \SysEntityQuery|\SysEntityBranchQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysLocation findOne(ConnectionInterface $con = null) Return the first ChildSysLocation matching the query
 * @method     ChildSysLocation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysLocation matching the query, or a new ChildSysLocation object populated from the query conditions when no match is found
 *
 * @method     ChildSysLocation findOneById(int $ID) Return the first ChildSysLocation filtered by the ID column
 * @method     ChildSysLocation findOneByMainId(int $MAIN_ID) Return the first ChildSysLocation filtered by the MAIN_ID column
 * @method     ChildSysLocation findOneByCode(string $CODE) Return the first ChildSysLocation filtered by the CODE column
 * @method     ChildSysLocation findOneByStatus(string $STATUS) Return the first ChildSysLocation filtered by the STATUS column
 * @method     ChildSysLocation findOneByName(string $NAME) Return the first ChildSysLocation filtered by the NAME column
 * @method     ChildSysLocation findOneByType(string $TYPE) Return the first ChildSysLocation filtered by the TYPE column
 * @method     ChildSysLocation findOneByLevel(int $LEVEL) Return the first ChildSysLocation filtered by the LEVEL column
 * @method     ChildSysLocation findOneByLft(int $LFT) Return the first ChildSysLocation filtered by the LFT column
 * @method     ChildSysLocation findOneByRgt(int $RGT) Return the first ChildSysLocation filtered by the RGT column
 * @method     ChildSysLocation findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysLocation filtered by the LAST_USER_ID column
 * @method     ChildSysLocation findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysLocation filtered by the CREATION_DATE column
 * @method     ChildSysLocation findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysLocation filtered by the MODIFICATION_DATE column *

 * @method     ChildSysLocation requirePk($key, ConnectionInterface $con = null) Return the ChildSysLocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOne(ConnectionInterface $con = null) Return the first ChildSysLocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysLocation requireOneById(int $ID) Return the first ChildSysLocation filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByMainId(int $MAIN_ID) Return the first ChildSysLocation filtered by the MAIN_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByCode(string $CODE) Return the first ChildSysLocation filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByStatus(string $STATUS) Return the first ChildSysLocation filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByName(string $NAME) Return the first ChildSysLocation filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByType(string $TYPE) Return the first ChildSysLocation filtered by the TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByLevel(int $LEVEL) Return the first ChildSysLocation filtered by the LEVEL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByLft(int $LFT) Return the first ChildSysLocation filtered by the LFT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByRgt(int $RGT) Return the first ChildSysLocation filtered by the RGT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysLocation filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysLocation filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysLocation requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysLocation filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysLocation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysLocation objects based on current ModelCriteria
 * @method     ChildSysLocation[]|ObjectCollection findById(int $ID) Return ChildSysLocation objects filtered by the ID column
 * @method     ChildSysLocation[]|ObjectCollection findByMainId(int $MAIN_ID) Return ChildSysLocation objects filtered by the MAIN_ID column
 * @method     ChildSysLocation[]|ObjectCollection findByCode(string $CODE) Return ChildSysLocation objects filtered by the CODE column
 * @method     ChildSysLocation[]|ObjectCollection findByStatus(string $STATUS) Return ChildSysLocation objects filtered by the STATUS column
 * @method     ChildSysLocation[]|ObjectCollection findByName(string $NAME) Return ChildSysLocation objects filtered by the NAME column
 * @method     ChildSysLocation[]|ObjectCollection findByType(string $TYPE) Return ChildSysLocation objects filtered by the TYPE column
 * @method     ChildSysLocation[]|ObjectCollection findByLevel(int $LEVEL) Return ChildSysLocation objects filtered by the LEVEL column
 * @method     ChildSysLocation[]|ObjectCollection findByLft(int $LFT) Return ChildSysLocation objects filtered by the LFT column
 * @method     ChildSysLocation[]|ObjectCollection findByRgt(int $RGT) Return ChildSysLocation objects filtered by the RGT column
 * @method     ChildSysLocation[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildSysLocation objects filtered by the LAST_USER_ID column
 * @method     ChildSysLocation[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildSysLocation objects filtered by the CREATION_DATE column
 * @method     ChildSysLocation[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildSysLocation objects filtered by the MODIFICATION_DATE column
 * @method     ChildSysLocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysLocationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysLocationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysLocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysLocationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysLocationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysLocationQuery) {
            return $criteria;
        }
        $query = new ChildSysLocationQuery();
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
     * @return ChildSysLocation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SysLocationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysLocationTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
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
     * @return ChildSysLocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, MAIN_ID, CODE, STATUS, NAME, TYPE, LEVEL, LFT, RGT, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_location WHERE ID = :p0';
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
            /** @var ChildSysLocation $obj */
            $obj = new ChildSysLocation();
            $obj->hydrate($row);
            SysLocationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysLocation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysLocationTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysLocationTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the MAIN_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByMainId(1234); // WHERE MAIN_ID = 1234
     * $query->filterByMainId(array(12, 34)); // WHERE MAIN_ID IN (12, 34)
     * $query->filterByMainId(array('min' => 12)); // WHERE MAIN_ID > 12
     * </code>
     *
     * @param     mixed $mainId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByMainId($mainId = null, $comparison = null)
    {
        if (is_array($mainId)) {
            $useMinMax = false;
            if (isset($mainId['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_MAIN_ID, $mainId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mainId['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_MAIN_ID, $mainId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_MAIN_ID, $mainId, $comparison);
    }

    /**
     * Filter the query on the CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE CODE = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE CODE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE STATUS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE NAME = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the TYPE column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE TYPE = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE TYPE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the LEVEL column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel(1234); // WHERE LEVEL = 1234
     * $query->filterByLevel(array(12, 34)); // WHERE LEVEL IN (12, 34)
     * $query->filterByLevel(array('min' => 12)); // WHERE LEVEL > 12
     * </code>
     *
     * @param     mixed $level The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByLevel($level = null, $comparison = null)
    {
        if (is_array($level)) {
            $useMinMax = false;
            if (isset($level['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_LEVEL, $level['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($level['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_LEVEL, $level['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_LEVEL, $level, $comparison);
    }

    /**
     * Filter the query on the LFT column
     *
     * Example usage:
     * <code>
     * $query->filterByLft(1234); // WHERE LFT = 1234
     * $query->filterByLft(array(12, 34)); // WHERE LFT IN (12, 34)
     * $query->filterByLft(array('min' => 12)); // WHERE LFT > 12
     * </code>
     *
     * @param     mixed $lft The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByLft($lft = null, $comparison = null)
    {
        if (is_array($lft)) {
            $useMinMax = false;
            if (isset($lft['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_LFT, $lft['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lft['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_LFT, $lft['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_LFT, $lft, $comparison);
    }

    /**
     * Filter the query on the RGT column
     *
     * Example usage:
     * <code>
     * $query->filterByRgt(1234); // WHERE RGT = 1234
     * $query->filterByRgt(array(12, 34)); // WHERE RGT IN (12, 34)
     * $query->filterByRgt(array('min' => 12)); // WHERE RGT > 12
     * </code>
     *
     * @param     mixed $rgt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByRgt($rgt = null, $comparison = null)
    {
        if (is_array($rgt)) {
            $useMinMax = false;
            if (isset($rgt['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_RGT, $rgt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rgt['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_RGT, $rgt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_RGT, $rgt, $comparison);
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
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysLocationTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysLocationTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \SysEntity object
     *
     * @param \SysEntity|ObjectCollection $sysEntity the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterBySysEntity($sysEntity, $comparison = null)
    {
        if ($sysEntity instanceof \SysEntity) {
            return $this
                ->addUsingAlias(SysLocationTableMap::COL_ID, $sysEntity->getLocationId(), $comparison);
        } elseif ($sysEntity instanceof ObjectCollection) {
            return $this
                ->useSysEntityQuery()
                ->filterByPrimaryKeys($sysEntity->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEntity() only accepts arguments of type \SysEntity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function joinSysEntity($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
     * @return \SysEntityQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysEntity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntity', '\SysEntityQuery');
    }

    /**
     * Filter the query by a related \SysEntityBranch object
     *
     * @param \SysEntityBranch|ObjectCollection $sysEntityBranch the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysLocationQuery The current query, for fluid interface
     */
    public function filterBySysEntityBranch($sysEntityBranch, $comparison = null)
    {
        if ($sysEntityBranch instanceof \SysEntityBranch) {
            return $this
                ->addUsingAlias(SysLocationTableMap::COL_ID, $sysEntityBranch->getLocationId(), $comparison);
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
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildSysLocation $sysLocation Object to remove from the list of results
     *
     * @return $this|ChildSysLocationQuery The current query, for fluid interface
     */
    public function prune($sysLocation = null)
    {
        if ($sysLocation) {
            $this->addUsingAlias(SysLocationTableMap::COL_ID, $sysLocation->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_location table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysLocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysLocationTableMap::clearInstancePool();
            SysLocationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysLocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysLocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysLocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysLocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysLocationQuery
