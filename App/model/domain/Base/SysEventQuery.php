<?php

namespace Base;

use \SysEvent as ChildSysEvent;
use \SysEventQuery as ChildSysEventQuery;
use \Exception;
use \PDO;
use Map\SysEventTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_event' table.
 *
 *
 *
 * @method     ChildSysEventQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEventQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysEventQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysEventQuery orderByType($order = Criteria::ASC) Order by the TYPE column
 * @method     ChildSysEventQuery orderByLevel($order = Criteria::ASC) Order by the LEVEL column
 * @method     ChildSysEventQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 *
 * @method     ChildSysEventQuery groupById() Group by the ID column
 * @method     ChildSysEventQuery groupByCode() Group by the CODE column
 * @method     ChildSysEventQuery groupByName() Group by the NAME column
 * @method     ChildSysEventQuery groupByType() Group by the TYPE column
 * @method     ChildSysEventQuery groupByLevel() Group by the LEVEL column
 * @method     ChildSysEventQuery groupByDescription() Group by the DESCRIPTION column
 *
 * @method     ChildSysEventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEventQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEventQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEventQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEventQuery leftJoinSysEventUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEventUser relation
 * @method     ChildSysEventQuery rightJoinSysEventUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEventUser relation
 * @method     ChildSysEventQuery innerJoinSysEventUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEventUser relation
 *
 * @method     ChildSysEventQuery joinWithSysEventUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEventUser relation
 *
 * @method     ChildSysEventQuery leftJoinWithSysEventUser() Adds a LEFT JOIN clause and with to the query using the SysEventUser relation
 * @method     ChildSysEventQuery rightJoinWithSysEventUser() Adds a RIGHT JOIN clause and with to the query using the SysEventUser relation
 * @method     ChildSysEventQuery innerJoinWithSysEventUser() Adds a INNER JOIN clause and with to the query using the SysEventUser relation
 *
 * @method     \SysEventUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEvent findOne(ConnectionInterface $con = null) Return the first ChildSysEvent matching the query
 * @method     ChildSysEvent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysEvent matching the query, or a new ChildSysEvent object populated from the query conditions when no match is found
 *
 * @method     ChildSysEvent findOneById(int $ID) Return the first ChildSysEvent filtered by the ID column
 * @method     ChildSysEvent findOneByCode(string $CODE) Return the first ChildSysEvent filtered by the CODE column
 * @method     ChildSysEvent findOneByName(string $NAME) Return the first ChildSysEvent filtered by the NAME column
 * @method     ChildSysEvent findOneByType(string $TYPE) Return the first ChildSysEvent filtered by the TYPE column
 * @method     ChildSysEvent findOneByLevel(string $LEVEL) Return the first ChildSysEvent filtered by the LEVEL column
 * @method     ChildSysEvent findOneByDescription(string $DESCRIPTION) Return the first ChildSysEvent filtered by the DESCRIPTION column *

 * @method     ChildSysEvent requirePk($key, ConnectionInterface $con = null) Return the ChildSysEvent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEvent requireOne(ConnectionInterface $con = null) Return the first ChildSysEvent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEvent requireOneById(int $ID) Return the first ChildSysEvent filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEvent requireOneByCode(string $CODE) Return the first ChildSysEvent filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEvent requireOneByName(string $NAME) Return the first ChildSysEvent filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEvent requireOneByType(string $TYPE) Return the first ChildSysEvent filtered by the TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEvent requireOneByLevel(string $LEVEL) Return the first ChildSysEvent filtered by the LEVEL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEvent requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEvent filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEvent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysEvent objects based on current ModelCriteria
 * @method     ChildSysEvent[]|ObjectCollection findById(int $ID) Return ChildSysEvent objects filtered by the ID column
 * @method     ChildSysEvent[]|ObjectCollection findByCode(string $CODE) Return ChildSysEvent objects filtered by the CODE column
 * @method     ChildSysEvent[]|ObjectCollection findByName(string $NAME) Return ChildSysEvent objects filtered by the NAME column
 * @method     ChildSysEvent[]|ObjectCollection findByType(string $TYPE) Return ChildSysEvent objects filtered by the TYPE column
 * @method     ChildSysEvent[]|ObjectCollection findByLevel(string $LEVEL) Return ChildSysEvent objects filtered by the LEVEL column
 * @method     ChildSysEvent[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysEvent objects filtered by the DESCRIPTION column
 * @method     ChildSysEvent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysEventQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEventQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEvent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEventQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEventQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysEventQuery) {
            return $criteria;
        }
        $query = new ChildSysEventQuery();
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
     * @return ChildSysEvent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEventTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEventTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEvent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, CODE, NAME, TYPE, LEVEL, DESCRIPTION FROM sys_event WHERE ID = :p0';
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
            /** @var ChildSysEvent $obj */
            $obj = new ChildSysEvent();
            $obj->hydrate($row);
            SysEventTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEvent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysEventTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysEventTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysEventTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEventTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEventTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEventTableMap::COL_CODE, $code, $comparison);
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
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEventTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEventTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the LEVEL column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel('fooValue');   // WHERE LEVEL = 'fooValue'
     * $query->filterByLevel('%fooValue%', Criteria::LIKE); // WHERE LEVEL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $level The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterByLevel($level = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($level)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEventTableMap::COL_LEVEL, $level, $comparison);
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
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEventTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \SysEventUser object
     *
     * @param \SysEventUser|ObjectCollection $sysEventUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysEventQuery The current query, for fluid interface
     */
    public function filterBySysEventUser($sysEventUser, $comparison = null)
    {
        if ($sysEventUser instanceof \SysEventUser) {
            return $this
                ->addUsingAlias(SysEventTableMap::COL_ID, $sysEventUser->getEventId(), $comparison);
        } elseif ($sysEventUser instanceof ObjectCollection) {
            return $this
                ->useSysEventUserQuery()
                ->filterByPrimaryKeys($sysEventUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEventUser() only accepts arguments of type \SysEventUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEventUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function joinSysEventUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEventUser');

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
            $this->addJoinObject($join, 'SysEventUser');
        }

        return $this;
    }

    /**
     * Use the SysEventUser relation SysEventUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEventUserQuery A secondary query class using the current class as primary query
     */
    public function useSysEventUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEventUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEventUser', '\SysEventUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysEvent $sysEvent Object to remove from the list of results
     *
     * @return $this|ChildSysEventQuery The current query, for fluid interface
     */
    public function prune($sysEvent = null)
    {
        if ($sysEvent) {
            $this->addUsingAlias(SysEventTableMap::COL_ID, $sysEvent->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_event table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEventTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEventTableMap::clearInstancePool();
            SysEventTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEventTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEventTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEventTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEventTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysEventQuery
