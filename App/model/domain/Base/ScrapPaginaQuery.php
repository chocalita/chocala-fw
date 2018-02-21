<?php

namespace Base;

use \ScrapPagina as ChildScrapPagina;
use \ScrapPaginaQuery as ChildScrapPaginaQuery;
use \Exception;
use \PDO;
use Map\ScrapPaginaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'scrap_pagina' table.
 *
 * 
 *
 * @method     ChildScrapPaginaQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildScrapPaginaQuery orderByDepartamento($order = Criteria::ASC) Order by the DEPARTAMENTO column
 * @method     ChildScrapPaginaQuery orderByNumero($order = Criteria::ASC) Order by the NUMERO column
 * @method     ChildScrapPaginaQuery orderByLeido($order = Criteria::ASC) Order by the LEIDO column
 *
 * @method     ChildScrapPaginaQuery groupById() Group by the ID column
 * @method     ChildScrapPaginaQuery groupByDepartamento() Group by the DEPARTAMENTO column
 * @method     ChildScrapPaginaQuery groupByNumero() Group by the NUMERO column
 * @method     ChildScrapPaginaQuery groupByLeido() Group by the LEIDO column
 *
 * @method     ChildScrapPaginaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildScrapPaginaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildScrapPaginaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildScrapPaginaQuery leftJoinScrapEmpresa($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScrapEmpresa relation
 * @method     ChildScrapPaginaQuery rightJoinScrapEmpresa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScrapEmpresa relation
 * @method     ChildScrapPaginaQuery innerJoinScrapEmpresa($relationAlias = null) Adds a INNER JOIN clause to the query using the ScrapEmpresa relation
 *
 * @method     \ScrapEmpresaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildScrapPagina findOne(ConnectionInterface $con = null) Return the first ChildScrapPagina matching the query
 * @method     ChildScrapPagina findOneOrCreate(ConnectionInterface $con = null) Return the first ChildScrapPagina matching the query, or a new ChildScrapPagina object populated from the query conditions when no match is found
 *
 * @method     ChildScrapPagina findOneById(int $ID) Return the first ChildScrapPagina filtered by the ID column
 * @method     ChildScrapPagina findOneByDepartamento(string $DEPARTAMENTO) Return the first ChildScrapPagina filtered by the DEPARTAMENTO column
 * @method     ChildScrapPagina findOneByNumero(int $NUMERO) Return the first ChildScrapPagina filtered by the NUMERO column
 * @method     ChildScrapPagina findOneByLeido(boolean $LEIDO) Return the first ChildScrapPagina filtered by the LEIDO column *

 * @method     ChildScrapPagina requirePk($key, ConnectionInterface $con = null) Return the ChildScrapPagina by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapPagina requireOne(ConnectionInterface $con = null) Return the first ChildScrapPagina matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildScrapPagina requireOneById(int $ID) Return the first ChildScrapPagina filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapPagina requireOneByDepartamento(string $DEPARTAMENTO) Return the first ChildScrapPagina filtered by the DEPARTAMENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapPagina requireOneByNumero(int $NUMERO) Return the first ChildScrapPagina filtered by the NUMERO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildScrapPagina requireOneByLeido(boolean $LEIDO) Return the first ChildScrapPagina filtered by the LEIDO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildScrapPagina[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildScrapPagina objects based on current ModelCriteria
 * @method     ChildScrapPagina[]|ObjectCollection findById(int $ID) Return ChildScrapPagina objects filtered by the ID column
 * @method     ChildScrapPagina[]|ObjectCollection findByDepartamento(string $DEPARTAMENTO) Return ChildScrapPagina objects filtered by the DEPARTAMENTO column
 * @method     ChildScrapPagina[]|ObjectCollection findByNumero(int $NUMERO) Return ChildScrapPagina objects filtered by the NUMERO column
 * @method     ChildScrapPagina[]|ObjectCollection findByLeido(boolean $LEIDO) Return ChildScrapPagina objects filtered by the LEIDO column
 * @method     ChildScrapPagina[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ScrapPaginaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ScrapPaginaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ScrapPagina', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildScrapPaginaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildScrapPaginaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildScrapPaginaQuery) {
            return $criteria;
        }
        $query = new ChildScrapPaginaQuery();
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
     * @return ChildScrapPagina|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ScrapPaginaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ScrapPaginaTableMap::DATABASE_NAME);
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
     * @return ChildScrapPagina A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, DEPARTAMENTO, NUMERO, LEIDO FROM scrap_pagina WHERE ID = :p0';
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
            /** @var ChildScrapPagina $obj */
            $obj = new ChildScrapPagina();
            $obj->hydrate($row);
            ScrapPaginaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildScrapPagina|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ScrapPaginaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ScrapPaginaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ScrapPaginaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ScrapPaginaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScrapPaginaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the DEPARTAMENTO column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartamento('fooValue');   // WHERE DEPARTAMENTO = 'fooValue'
     * $query->filterByDepartamento('%fooValue%'); // WHERE DEPARTAMENTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $departamento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function filterByDepartamento($departamento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($departamento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $departamento)) {
                $departamento = str_replace('*', '%', $departamento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScrapPaginaTableMap::COL_DEPARTAMENTO, $departamento, $comparison);
    }

    /**
     * Filter the query on the NUMERO column
     *
     * Example usage:
     * <code>
     * $query->filterByNumero(1234); // WHERE NUMERO = 1234
     * $query->filterByNumero(array(12, 34)); // WHERE NUMERO IN (12, 34)
     * $query->filterByNumero(array('min' => 12)); // WHERE NUMERO > 12
     * </code>
     *
     * @param     mixed $numero The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function filterByNumero($numero = null, $comparison = null)
    {
        if (is_array($numero)) {
            $useMinMax = false;
            if (isset($numero['min'])) {
                $this->addUsingAlias(ScrapPaginaTableMap::COL_NUMERO, $numero['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numero['max'])) {
                $this->addUsingAlias(ScrapPaginaTableMap::COL_NUMERO, $numero['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScrapPaginaTableMap::COL_NUMERO, $numero, $comparison);
    }

    /**
     * Filter the query on the LEIDO column
     *
     * Example usage:
     * <code>
     * $query->filterByLeido(true); // WHERE LEIDO = true
     * $query->filterByLeido('yes'); // WHERE LEIDO = true
     * </code>
     *
     * @param     boolean|string $leido The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function filterByLeido($leido = null, $comparison = null)
    {
        if (is_string($leido)) {
            $leido = in_array(strtolower($leido), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ScrapPaginaTableMap::COL_LEIDO, $leido, $comparison);
    }

    /**
     * Filter the query by a related \ScrapEmpresa object
     *
     * @param \ScrapEmpresa|ObjectCollection $scrapEmpresa the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function filterByScrapEmpresa($scrapEmpresa, $comparison = null)
    {
        if ($scrapEmpresa instanceof \ScrapEmpresa) {
            return $this
                ->addUsingAlias(ScrapPaginaTableMap::COL_ID, $scrapEmpresa->getIdPagina(), $comparison);
        } elseif ($scrapEmpresa instanceof ObjectCollection) {
            return $this
                ->useScrapEmpresaQuery()
                ->filterByPrimaryKeys($scrapEmpresa->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByScrapEmpresa() only accepts arguments of type \ScrapEmpresa or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ScrapEmpresa relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function joinScrapEmpresa($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ScrapEmpresa');

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
            $this->addJoinObject($join, 'ScrapEmpresa');
        }

        return $this;
    }

    /**
     * Use the ScrapEmpresa relation ScrapEmpresa object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ScrapEmpresaQuery A secondary query class using the current class as primary query
     */
    public function useScrapEmpresaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinScrapEmpresa($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScrapEmpresa', '\ScrapEmpresaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildScrapPagina $scrapPagina Object to remove from the list of results
     *
     * @return $this|ChildScrapPaginaQuery The current query, for fluid interface
     */
    public function prune($scrapPagina = null)
    {
        if ($scrapPagina) {
            $this->addUsingAlias(ScrapPaginaTableMap::COL_ID, $scrapPagina->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the scrap_pagina table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapPaginaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ScrapPaginaTableMap::clearInstancePool();
            ScrapPaginaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapPaginaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ScrapPaginaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ScrapPaginaTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ScrapPaginaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ScrapPaginaQuery
