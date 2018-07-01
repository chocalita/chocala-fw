<?php

namespace Base;

use \TmpFormacion as ChildTmpFormacion;
use \TmpFormacionQuery as ChildTmpFormacionQuery;
use \Exception;
use \PDO;
use Map\TmpFormacionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tmp_formacion' table.
 *
 *
 *
 * @method     ChildTmpFormacionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTmpFormacionQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildTmpFormacionQuery orderByKeywords($order = Criteria::ASC) Order by the keywords column
 * @method     ChildTmpFormacionQuery orderByAreasReferencia($order = Criteria::ASC) Order by the areas_referencia column
 * @method     ChildTmpFormacionQuery orderByFormacionesReferencia($order = Criteria::ASC) Order by the formaciones_referencia column
 * @method     ChildTmpFormacionQuery orderByActivo($order = Criteria::ASC) Order by the activo column
 *
 * @method     ChildTmpFormacionQuery groupById() Group by the id column
 * @method     ChildTmpFormacionQuery groupByNombre() Group by the nombre column
 * @method     ChildTmpFormacionQuery groupByKeywords() Group by the keywords column
 * @method     ChildTmpFormacionQuery groupByAreasReferencia() Group by the areas_referencia column
 * @method     ChildTmpFormacionQuery groupByFormacionesReferencia() Group by the formaciones_referencia column
 * @method     ChildTmpFormacionQuery groupByActivo() Group by the activo column
 *
 * @method     ChildTmpFormacionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTmpFormacionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTmpFormacionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTmpFormacionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTmpFormacionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTmpFormacionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTmpFormacionQuery leftJoinJobSuscriptor($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobSuscriptor relation
 * @method     ChildTmpFormacionQuery rightJoinJobSuscriptor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobSuscriptor relation
 * @method     ChildTmpFormacionQuery innerJoinJobSuscriptor($relationAlias = null) Adds a INNER JOIN clause to the query using the JobSuscriptor relation
 *
 * @method     ChildTmpFormacionQuery joinWithJobSuscriptor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobSuscriptor relation
 *
 * @method     ChildTmpFormacionQuery leftJoinWithJobSuscriptor() Adds a LEFT JOIN clause and with to the query using the JobSuscriptor relation
 * @method     ChildTmpFormacionQuery rightJoinWithJobSuscriptor() Adds a RIGHT JOIN clause and with to the query using the JobSuscriptor relation
 * @method     ChildTmpFormacionQuery innerJoinWithJobSuscriptor() Adds a INNER JOIN clause and with to the query using the JobSuscriptor relation
 *
 * @method     \JobSuscriptorQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTmpFormacion findOne(ConnectionInterface $con = null) Return the first ChildTmpFormacion matching the query
 * @method     ChildTmpFormacion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTmpFormacion matching the query, or a new ChildTmpFormacion object populated from the query conditions when no match is found
 *
 * @method     ChildTmpFormacion findOneById(int $id) Return the first ChildTmpFormacion filtered by the id column
 * @method     ChildTmpFormacion findOneByNombre(string $nombre) Return the first ChildTmpFormacion filtered by the nombre column
 * @method     ChildTmpFormacion findOneByKeywords(string $keywords) Return the first ChildTmpFormacion filtered by the keywords column
 * @method     ChildTmpFormacion findOneByAreasReferencia(string $areas_referencia) Return the first ChildTmpFormacion filtered by the areas_referencia column
 * @method     ChildTmpFormacion findOneByFormacionesReferencia(string $formaciones_referencia) Return the first ChildTmpFormacion filtered by the formaciones_referencia column
 * @method     ChildTmpFormacion findOneByActivo(boolean $activo) Return the first ChildTmpFormacion filtered by the activo column *

 * @method     ChildTmpFormacion requirePk($key, ConnectionInterface $con = null) Return the ChildTmpFormacion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpFormacion requireOne(ConnectionInterface $con = null) Return the first ChildTmpFormacion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTmpFormacion requireOneById(int $id) Return the first ChildTmpFormacion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpFormacion requireOneByNombre(string $nombre) Return the first ChildTmpFormacion filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpFormacion requireOneByKeywords(string $keywords) Return the first ChildTmpFormacion filtered by the keywords column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpFormacion requireOneByAreasReferencia(string $areas_referencia) Return the first ChildTmpFormacion filtered by the areas_referencia column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpFormacion requireOneByFormacionesReferencia(string $formaciones_referencia) Return the first ChildTmpFormacion filtered by the formaciones_referencia column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpFormacion requireOneByActivo(boolean $activo) Return the first ChildTmpFormacion filtered by the activo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTmpFormacion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTmpFormacion objects based on current ModelCriteria
 * @method     ChildTmpFormacion[]|ObjectCollection findById(int $id) Return ChildTmpFormacion objects filtered by the id column
 * @method     ChildTmpFormacion[]|ObjectCollection findByNombre(string $nombre) Return ChildTmpFormacion objects filtered by the nombre column
 * @method     ChildTmpFormacion[]|ObjectCollection findByKeywords(string $keywords) Return ChildTmpFormacion objects filtered by the keywords column
 * @method     ChildTmpFormacion[]|ObjectCollection findByAreasReferencia(string $areas_referencia) Return ChildTmpFormacion objects filtered by the areas_referencia column
 * @method     ChildTmpFormacion[]|ObjectCollection findByFormacionesReferencia(string $formaciones_referencia) Return ChildTmpFormacion objects filtered by the formaciones_referencia column
 * @method     ChildTmpFormacion[]|ObjectCollection findByActivo(boolean $activo) Return ChildTmpFormacion objects filtered by the activo column
 * @method     ChildTmpFormacion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TmpFormacionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TmpFormacionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TmpFormacion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTmpFormacionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTmpFormacionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTmpFormacionQuery) {
            return $criteria;
        }
        $query = new ChildTmpFormacionQuery();
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
     * @return ChildTmpFormacion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TmpFormacionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TmpFormacionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTmpFormacion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nombre, keywords, areas_referencia, formaciones_referencia, activo FROM tmp_formacion WHERE id = :p0';
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
            /** @var ChildTmpFormacion $obj */
            $obj = new ChildTmpFormacion();
            $obj->hydrate($row);
            TmpFormacionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTmpFormacion|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TmpFormacionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TmpFormacionTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TmpFormacionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TmpFormacionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpFormacionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpFormacionTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the keywords column
     *
     * Example usage:
     * <code>
     * $query->filterByKeywords('fooValue');   // WHERE keywords = 'fooValue'
     * $query->filterByKeywords('%fooValue%', Criteria::LIKE); // WHERE keywords LIKE '%fooValue%'
     * </code>
     *
     * @param     string $keywords The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByKeywords($keywords = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($keywords)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpFormacionTableMap::COL_KEYWORDS, $keywords, $comparison);
    }

    /**
     * Filter the query on the areas_referencia column
     *
     * Example usage:
     * <code>
     * $query->filterByAreasReferencia('fooValue');   // WHERE areas_referencia = 'fooValue'
     * $query->filterByAreasReferencia('%fooValue%', Criteria::LIKE); // WHERE areas_referencia LIKE '%fooValue%'
     * </code>
     *
     * @param     string $areasReferencia The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByAreasReferencia($areasReferencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($areasReferencia)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpFormacionTableMap::COL_AREAS_REFERENCIA, $areasReferencia, $comparison);
    }

    /**
     * Filter the query on the formaciones_referencia column
     *
     * Example usage:
     * <code>
     * $query->filterByFormacionesReferencia('fooValue');   // WHERE formaciones_referencia = 'fooValue'
     * $query->filterByFormacionesReferencia('%fooValue%', Criteria::LIKE); // WHERE formaciones_referencia LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formacionesReferencia The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByFormacionesReferencia($formacionesReferencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formacionesReferencia)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpFormacionTableMap::COL_FORMACIONES_REFERENCIA, $formacionesReferencia, $comparison);
    }

    /**
     * Filter the query on the activo column
     *
     * Example usage:
     * <code>
     * $query->filterByActivo(true); // WHERE activo = true
     * $query->filterByActivo('yes'); // WHERE activo = true
     * </code>
     *
     * @param     boolean|string $activo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByActivo($activo = null, $comparison = null)
    {
        if (is_string($activo)) {
            $activo = in_array(strtolower($activo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TmpFormacionTableMap::COL_ACTIVO, $activo, $comparison);
    }

    /**
     * Filter the query by a related \JobSuscriptor object
     *
     * @param \JobSuscriptor|ObjectCollection $jobSuscriptor the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function filterByJobSuscriptor($jobSuscriptor, $comparison = null)
    {
        if ($jobSuscriptor instanceof \JobSuscriptor) {
            return $this
                ->addUsingAlias(TmpFormacionTableMap::COL_ID, $jobSuscriptor->getIdTmpFormacion(), $comparison);
        } elseif ($jobSuscriptor instanceof ObjectCollection) {
            return $this
                ->useJobSuscriptorQuery()
                ->filterByPrimaryKeys($jobSuscriptor->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobSuscriptor() only accepts arguments of type \JobSuscriptor or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobSuscriptor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function joinJobSuscriptor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobSuscriptor');

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
            $this->addJoinObject($join, 'JobSuscriptor');
        }

        return $this;
    }

    /**
     * Use the JobSuscriptor relation JobSuscriptor object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobSuscriptorQuery A secondary query class using the current class as primary query
     */
    public function useJobSuscriptorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobSuscriptor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobSuscriptor', '\JobSuscriptorQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTmpFormacion $tmpFormacion Object to remove from the list of results
     *
     * @return $this|ChildTmpFormacionQuery The current query, for fluid interface
     */
    public function prune($tmpFormacion = null)
    {
        if ($tmpFormacion) {
            $this->addUsingAlias(TmpFormacionTableMap::COL_ID, $tmpFormacion->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tmp_formacion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpFormacionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TmpFormacionTableMap::clearInstancePool();
            TmpFormacionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TmpFormacionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TmpFormacionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TmpFormacionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TmpFormacionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TmpFormacionQuery
