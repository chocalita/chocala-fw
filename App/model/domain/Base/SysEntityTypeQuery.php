<?php

namespace Base;

use \SysEntityType as ChildSysEntityType;
use \SysEntityTypeQuery as ChildSysEntityTypeQuery;
use \Exception;
use \PDO;
use Map\SysEntityTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_entity_type' table.
 *
 * 
 *
 * @method     ChildSysEntityTypeQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEntityTypeQuery orderByGroupCode($order = Criteria::ASC) Order by the GROUP_CODE column
 * @method     ChildSysEntityTypeQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysEntityTypeQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysEntityTypeQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 *
 * @method     ChildSysEntityTypeQuery groupById() Group by the ID column
 * @method     ChildSysEntityTypeQuery groupByGroupCode() Group by the GROUP_CODE column
 * @method     ChildSysEntityTypeQuery groupByCode() Group by the CODE column
 * @method     ChildSysEntityTypeQuery groupByName() Group by the NAME column
 * @method     ChildSysEntityTypeQuery groupByDescription() Group by the DESCRIPTION column
 *
 * @method     ChildSysEntityTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEntityTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEntityTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEntityTypeQuery leftJoinJobEmpresaSuscrita($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobEmpresaSuscrita relation
 * @method     ChildSysEntityTypeQuery rightJoinJobEmpresaSuscrita($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobEmpresaSuscrita relation
 * @method     ChildSysEntityTypeQuery innerJoinJobEmpresaSuscrita($relationAlias = null) Adds a INNER JOIN clause to the query using the JobEmpresaSuscrita relation
 *
 * @method     ChildSysEntityTypeQuery leftJoinSysEntity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityTypeQuery rightJoinSysEntity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntity relation
 * @method     ChildSysEntityTypeQuery innerJoinSysEntity($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntity relation
 *
 * @method     \JobEmpresaSuscritaQuery|\SysEntityQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEntityType findOne(ConnectionInterface $con = null) Return the first ChildSysEntityType matching the query
 * @method     ChildSysEntityType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysEntityType matching the query, or a new ChildSysEntityType object populated from the query conditions when no match is found
 *
 * @method     ChildSysEntityType findOneById(int $ID) Return the first ChildSysEntityType filtered by the ID column
 * @method     ChildSysEntityType findOneByGroupCode(string $GROUP_CODE) Return the first ChildSysEntityType filtered by the GROUP_CODE column
 * @method     ChildSysEntityType findOneByCode(string $CODE) Return the first ChildSysEntityType filtered by the CODE column
 * @method     ChildSysEntityType findOneByName(string $NAME) Return the first ChildSysEntityType filtered by the NAME column
 * @method     ChildSysEntityType findOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityType filtered by the DESCRIPTION column *

 * @method     ChildSysEntityType requirePk($key, ConnectionInterface $con = null) Return the ChildSysEntityType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOne(ConnectionInterface $con = null) Return the first ChildSysEntityType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityType requireOneById(int $ID) Return the first ChildSysEntityType filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByGroupCode(string $GROUP_CODE) Return the first ChildSysEntityType filtered by the GROUP_CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByCode(string $CODE) Return the first ChildSysEntityType filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByName(string $NAME) Return the first ChildSysEntityType filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntityType requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEntityType filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntityType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysEntityType objects based on current ModelCriteria
 * @method     ChildSysEntityType[]|ObjectCollection findById(int $ID) Return ChildSysEntityType objects filtered by the ID column
 * @method     ChildSysEntityType[]|ObjectCollection findByGroupCode(string $GROUP_CODE) Return ChildSysEntityType objects filtered by the GROUP_CODE column
 * @method     ChildSysEntityType[]|ObjectCollection findByCode(string $CODE) Return ChildSysEntityType objects filtered by the CODE column
 * @method     ChildSysEntityType[]|ObjectCollection findByName(string $NAME) Return ChildSysEntityType objects filtered by the NAME column
 * @method     ChildSysEntityType[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysEntityType objects filtered by the DESCRIPTION column
 * @method     ChildSysEntityType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysEntityTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEntityTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEntityType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEntityTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEntityTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysEntityTypeQuery) {
            return $criteria;
        }
        $query = new ChildSysEntityTypeQuery();
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
     * @return ChildSysEntityType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SysEntityTypeTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityTypeTableMap::DATABASE_NAME);
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
     * @return ChildSysEntityType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, GROUP_CODE, CODE, NAME, DESCRIPTION FROM sys_entity_type WHERE ID = :p0';
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
            /** @var ChildSysEntityType $obj */
            $obj = new ChildSysEntityType();
            $obj->hydrate($row);
            SysEntityTypeTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildSysEntityType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the GROUP_CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupCode('fooValue');   // WHERE GROUP_CODE = 'fooValue'
     * $query->filterByGroupCode('%fooValue%'); // WHERE GROUP_CODE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function filterByGroupCode($groupCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $groupCode)) {
                $groupCode = str_replace('*', '%', $groupCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEntityTypeTableMap::COL_GROUP_CODE, $groupCode, $comparison);
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
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SysEntityTypeTableMap::COL_CODE, $code, $comparison);
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
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SysEntityTypeTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the DESCRIPTION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE DESCRIPTION = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE DESCRIPTION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysEntityTypeTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \JobEmpresaSuscrita object
     *
     * @param \JobEmpresaSuscrita|ObjectCollection $jobEmpresaSuscrita the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function filterByJobEmpresaSuscrita($jobEmpresaSuscrita, $comparison = null)
    {
        if ($jobEmpresaSuscrita instanceof \JobEmpresaSuscrita) {
            return $this
                ->addUsingAlias(SysEntityTypeTableMap::COL_ID, $jobEmpresaSuscrita->getEntityTypeId(), $comparison);
        } elseif ($jobEmpresaSuscrita instanceof ObjectCollection) {
            return $this
                ->useJobEmpresaSuscritaQuery()
                ->filterByPrimaryKeys($jobEmpresaSuscrita->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobEmpresaSuscrita() only accepts arguments of type \JobEmpresaSuscrita or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobEmpresaSuscrita relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function joinJobEmpresaSuscrita($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobEmpresaSuscrita');

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
            $this->addJoinObject($join, 'JobEmpresaSuscrita');
        }

        return $this;
    }

    /**
     * Use the JobEmpresaSuscrita relation JobEmpresaSuscrita object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobEmpresaSuscritaQuery A secondary query class using the current class as primary query
     */
    public function useJobEmpresaSuscritaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobEmpresaSuscrita($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobEmpresaSuscrita', '\JobEmpresaSuscritaQuery');
    }

    /**
     * Filter the query by a related \SysEntity object
     *
     * @param \SysEntity|ObjectCollection $sysEntity the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function filterBySysEntity($sysEntity, $comparison = null)
    {
        if ($sysEntity instanceof \SysEntity) {
            return $this
                ->addUsingAlias(SysEntityTypeTableMap::COL_ID, $sysEntity->getEntityTypeId(), $comparison);
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
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
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
     * @return \SysEntityQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntity', '\SysEntityQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysEntityType $sysEntityType Object to remove from the list of results
     *
     * @return $this|ChildSysEntityTypeQuery The current query, for fluid interface
     */
    public function prune($sysEntityType = null)
    {
        if ($sysEntityType) {
            $this->addUsingAlias(SysEntityTypeTableMap::COL_ID, $sysEntityType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_entity_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEntityTypeTableMap::clearInstancePool();
            SysEntityTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEntityTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            SysEntityTypeTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            SysEntityTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysEntityTypeQuery
