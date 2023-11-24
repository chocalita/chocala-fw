<?php

namespace App\model\domain\Base;

use \Exception;
use \PDO;
use App\model\domain\SysModule as ChildSysModule;
use App\model\domain\SysModuleQuery as ChildSysModuleQuery;
use App\model\domain\Map\SysModuleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_module' table.
 *
 *
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
 * @method     \App\model\domain\SysUriQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysModule findOne(ConnectionInterface $con = null) Return the first ChildSysModule matching the query
 * @method     ChildSysModule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysModule matching the query, or a new ChildSysModule object populated from the query conditions when no match is found
 *
 * @method     ChildSysModule findOneById(int $ID) Return the first ChildSysModule filtered by the ID column
 * @method     ChildSysModule findOneByName(string $NAME) Return the first ChildSysModule filtered by the NAME column
 * @method     ChildSysModule findOneByUri(string $URI) Return the first ChildSysModule filtered by the URI column
 * @method     ChildSysModule findOneByAccess(string $ACCESS) Return the first ChildSysModule filtered by the ACCESS column
 * @method     ChildSysModule findOneByPosition(int $POSITION) Return the first ChildSysModule filtered by the POSITION column
 * @method     ChildSysModule findOneByDescription(string $DESCRIPTION) Return the first ChildSysModule filtered by the DESCRIPTION column
 * @method     ChildSysModule findOneByIconClass(string $ICON_CLASS) Return the first ChildSysModule filtered by the ICON_CLASS column *

 * @method     ChildSysModule requirePk($key, ConnectionInterface $con = null) Return the ChildSysModule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOne(ConnectionInterface $con = null) Return the first ChildSysModule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysModule requireOneById(int $ID) Return the first ChildSysModule filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByName(string $NAME) Return the first ChildSysModule filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByUri(string $URI) Return the first ChildSysModule filtered by the URI column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByAccess(string $ACCESS) Return the first ChildSysModule filtered by the ACCESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByPosition(int $POSITION) Return the first ChildSysModule filtered by the POSITION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByDescription(string $DESCRIPTION) Return the first ChildSysModule filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysModule requireOneByIconClass(string $ICON_CLASS) Return the first ChildSysModule filtered by the ICON_CLASS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysModule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysModule objects based on current ModelCriteria
 * @method     ChildSysModule[]|ObjectCollection findById(int $ID) Return ChildSysModule objects filtered by the ID column
 * @method     ChildSysModule[]|ObjectCollection findByName(string $NAME) Return ChildSysModule objects filtered by the NAME column
 * @method     ChildSysModule[]|ObjectCollection findByUri(string $URI) Return ChildSysModule objects filtered by the URI column
 * @method     ChildSysModule[]|ObjectCollection findByAccess(string $ACCESS) Return ChildSysModule objects filtered by the ACCESS column
 * @method     ChildSysModule[]|ObjectCollection findByPosition(int $POSITION) Return ChildSysModule objects filtered by the POSITION column
 * @method     ChildSysModule[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysModule objects filtered by the DESCRIPTION column
 * @method     ChildSysModule[]|ObjectCollection findByIconClass(string $ICON_CLASS) Return ChildSysModule objects filtered by the ICON_CLASS column
 * @method     ChildSysModule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysModuleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\model\domain\Base\SysModuleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\model\\domain\\SysModule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysModuleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysModuleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
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
    public function findPk($key, ConnectionInterface $con = null)
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
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
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
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
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
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysModuleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysModuleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
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

        return $this->addUsingAlias(SysModuleTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysModuleTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the URI column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE URI = 'fooValue'
     * $query->filterByUri('%fooValue%', Criteria::LIKE); // WHERE URI LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uri The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysModuleTableMap::COL_URI, $uri, $comparison);
    }

    /**
     * Filter the query on the ACCESS column
     *
     * Example usage:
     * <code>
     * $query->filterByAccess('fooValue');   // WHERE ACCESS = 'fooValue'
     * $query->filterByAccess('%fooValue%', Criteria::LIKE); // WHERE ACCESS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $access The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByAccess($access = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($access)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysModuleTableMap::COL_ACCESS, $access, $comparison);
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
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
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

        return $this->addUsingAlias(SysModuleTableMap::COL_POSITION, $position, $comparison);
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
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysModuleTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the ICON_CLASS column
     *
     * Example usage:
     * <code>
     * $query->filterByIconClass('fooValue');   // WHERE ICON_CLASS = 'fooValue'
     * $query->filterByIconClass('%fooValue%', Criteria::LIKE); // WHERE ICON_CLASS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iconClass The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterByIconClass($iconClass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iconClass)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysModuleTableMap::COL_ICON_CLASS, $iconClass, $comparison);
    }

    /**
     * Filter the query by a related \App\model\domain\SysUri object
     *
     * @param \App\model\domain\SysUri|ObjectCollection $sysUri the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysModuleQuery The current query, for fluid interface
     */
    public function filterBySysUri($sysUri, $comparison = null)
    {
        if ($sysUri instanceof \App\model\domain\SysUri) {
            return $this
                ->addUsingAlias(SysModuleTableMap::COL_ID, $sysUri->getModuleId(), $comparison);
        } elseif ($sysUri instanceof ObjectCollection) {
            return $this
                ->useSysUriQuery()
                ->filterByPrimaryKeys($sysUri->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysUri() only accepts arguments of type \App\model\domain\SysUri or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUri relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
     */
    public function joinSysUri($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysUriQuery A secondary query class using the current class as primary query
     */
    public function useSysUriQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUri($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUri', '\App\model\domain\SysUriQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysModule $sysModule Object to remove from the list of results
     *
     * @return $this|ChildSysModuleQuery The current query, for fluid interface
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
    public function doDeleteAll(ConnectionInterface $con = null)
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
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
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

} // SysModuleQuery
