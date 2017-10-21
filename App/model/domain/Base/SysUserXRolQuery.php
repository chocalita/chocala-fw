<?php

namespace Base;

use \SysUserXRol as ChildSysUserXRol;
use \SysUserXRolQuery as ChildSysUserXRolQuery;
use \Exception;
use \PDO;
use Map\SysUserXRolTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_user_x_rol' table.
 *
 * 
 *
 * @method     ChildSysUserXRolQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysUserXRolQuery orderByRolId($order = Criteria::ASC) Order by the ROL_ID column
 *
 * @method     ChildSysUserXRolQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysUserXRolQuery groupByRolId() Group by the ROL_ID column
 *
 * @method     ChildSysUserXRolQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysUserXRolQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysUserXRolQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysUserXRolQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysUserXRolQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysUserXRolQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildSysUserXRolQuery leftJoinSysRol($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRol relation
 * @method     ChildSysUserXRolQuery rightJoinSysRol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRol relation
 * @method     ChildSysUserXRolQuery innerJoinSysRol($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRol relation
 *
 * @method     \SysUserQuery|\SysRolQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysUserXRol findOne(ConnectionInterface $con = null) Return the first ChildSysUserXRol matching the query
 * @method     ChildSysUserXRol findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysUserXRol matching the query, or a new ChildSysUserXRol object populated from the query conditions when no match is found
 *
 * @method     ChildSysUserXRol findOneByUserId(int $USER_ID) Return the first ChildSysUserXRol filtered by the USER_ID column
 * @method     ChildSysUserXRol findOneByRolId(int $ROL_ID) Return the first ChildSysUserXRol filtered by the ROL_ID column *

 * @method     ChildSysUserXRol requirePk($key, ConnectionInterface $con = null) Return the ChildSysUserXRol by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUserXRol requireOne(ConnectionInterface $con = null) Return the first ChildSysUserXRol matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUserXRol requireOneByUserId(int $USER_ID) Return the first ChildSysUserXRol filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUserXRol requireOneByRolId(int $ROL_ID) Return the first ChildSysUserXRol filtered by the ROL_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUserXRol[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysUserXRol objects based on current ModelCriteria
 * @method     ChildSysUserXRol[]|ObjectCollection findByUserId(int $USER_ID) Return ChildSysUserXRol objects filtered by the USER_ID column
 * @method     ChildSysUserXRol[]|ObjectCollection findByRolId(int $ROL_ID) Return ChildSysUserXRol objects filtered by the ROL_ID column
 * @method     ChildSysUserXRol[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysUserXRolQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysUserXRolQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysUserXRol', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysUserXRolQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysUserXRolQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysUserXRolQuery) {
            return $criteria;
        }
        $query = new ChildSysUserXRolQuery();
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
     * @param array[$USER_ID, $ROL_ID] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSysUserXRol|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SysUserXRolTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysUserXRolTableMap::DATABASE_NAME);
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
     * @return ChildSysUserXRol A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT USER_ID, ROL_ID FROM sys_user_x_rol WHERE USER_ID = :p0 AND ROL_ID = :p1';
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
            /** @var ChildSysUserXRol $obj */
            $obj = new ChildSysUserXRol();
            $obj->hydrate($row);
            SysUserXRolTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildSysUserXRol|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SysUserXRolTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SysUserXRolTableMap::COL_ROL_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the USER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE USER_ID = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE USER_ID IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE USER_ID > 12
     * </code>
     *
     * @see       filterBySysUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $userId, $comparison);
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
     * @param     mixed $rolId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function filterByRolId($rolId = null, $comparison = null)
    {
        if (is_array($rolId)) {
            $useMinMax = false;
            if (isset($rolId['min'])) {
                $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $rolId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolId['max'])) {
                $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $rolId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $rolId, $comparison);
    }

    /**
     * Filter the query by a related \SysUser object
     *
     * @param \SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, $comparison = null)
    {
        if ($sysUser instanceof \SysUser) {
            return $this
                ->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysUserXRolTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysUser() only accepts arguments of type \SysUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function joinSysUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUser');

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
            $this->addJoinObject($join, 'SysUser');
        }

        return $this;
    }

    /**
     * Use the SysUser relation SysUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysUserQuery A secondary query class using the current class as primary query
     */
    public function useSysUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUser', '\SysUserQuery');
    }

    /**
     * Filter the query by a related \SysRol object
     *
     * @param \SysRol|ObjectCollection $sysRol The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function filterBySysRol($sysRol, $comparison = null)
    {
        if ($sysRol instanceof \SysRol) {
            return $this
                ->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $sysRol->getId(), $comparison);
        } elseif ($sysRol instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysUserXRolTableMap::COL_ROL_ID, $sysRol->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysRol() only accepts arguments of type \SysRol or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysRol relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function joinSysRol($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
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
     * Exclude object from result
     *
     * @param   ChildSysUserXRol $sysUserXRol Object to remove from the list of results
     *
     * @return $this|ChildSysUserXRolQuery The current query, for fluid interface
     */
    public function prune($sysUserXRol = null)
    {
        if ($sysUserXRol) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SysUserXRolTableMap::COL_USER_ID), $sysUserXRol->getUserId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SysUserXRolTableMap::COL_ROL_ID), $sysUserXRol->getRolId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_user_x_rol table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserXRolTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysUserXRolTableMap::clearInstancePool();
            SysUserXRolTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserXRolTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysUserXRolTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            SysUserXRolTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            SysUserXRolTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysUserXRolQuery
