<?php

namespace Base;

use \JobTipoFormacion as ChildJobTipoFormacion;
use \JobTipoFormacionQuery as ChildJobTipoFormacionQuery;
use \Exception;
use \PDO;
use Map\JobTipoFormacionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_tipo_formacion' table.
 *
 *
 *
 * @method     ChildJobTipoFormacionQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobTipoFormacionQuery orderByCodigo($order = Criteria::ASC) Order by the CODIGO column
 * @method     ChildJobTipoFormacionQuery orderByNivel($order = Criteria::ASC) Order by the NIVEL column
 * @method     ChildJobTipoFormacionQuery orderByNombre($order = Criteria::ASC) Order by the NOMBRE column
 * @method     ChildJobTipoFormacionQuery orderByDescripcion($order = Criteria::ASC) Order by the DESCRIPCION column
 *
 * @method     ChildJobTipoFormacionQuery groupById() Group by the ID column
 * @method     ChildJobTipoFormacionQuery groupByCodigo() Group by the CODIGO column
 * @method     ChildJobTipoFormacionQuery groupByNivel() Group by the NIVEL column
 * @method     ChildJobTipoFormacionQuery groupByNombre() Group by the NOMBRE column
 * @method     ChildJobTipoFormacionQuery groupByDescripcion() Group by the DESCRIPCION column
 *
 * @method     ChildJobTipoFormacionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobTipoFormacionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobTipoFormacionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobTipoFormacionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobTipoFormacionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobTipoFormacionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobTipoFormacionQuery leftJoinJobFormacionAcademica($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobFormacionAcademica relation
 * @method     ChildJobTipoFormacionQuery rightJoinJobFormacionAcademica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobFormacionAcademica relation
 * @method     ChildJobTipoFormacionQuery innerJoinJobFormacionAcademica($relationAlias = null) Adds a INNER JOIN clause to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobTipoFormacionQuery joinWithJobFormacionAcademica($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobTipoFormacionQuery leftJoinWithJobFormacionAcademica() Adds a LEFT JOIN clause and with to the query using the JobFormacionAcademica relation
 * @method     ChildJobTipoFormacionQuery rightJoinWithJobFormacionAcademica() Adds a RIGHT JOIN clause and with to the query using the JobFormacionAcademica relation
 * @method     ChildJobTipoFormacionQuery innerJoinWithJobFormacionAcademica() Adds a INNER JOIN clause and with to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobTipoFormacionQuery leftJoinJobProfesion($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobProfesion relation
 * @method     ChildJobTipoFormacionQuery rightJoinJobProfesion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobProfesion relation
 * @method     ChildJobTipoFormacionQuery innerJoinJobProfesion($relationAlias = null) Adds a INNER JOIN clause to the query using the JobProfesion relation
 *
 * @method     ChildJobTipoFormacionQuery joinWithJobProfesion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobProfesion relation
 *
 * @method     ChildJobTipoFormacionQuery leftJoinWithJobProfesion() Adds a LEFT JOIN clause and with to the query using the JobProfesion relation
 * @method     ChildJobTipoFormacionQuery rightJoinWithJobProfesion() Adds a RIGHT JOIN clause and with to the query using the JobProfesion relation
 * @method     ChildJobTipoFormacionQuery innerJoinWithJobProfesion() Adds a INNER JOIN clause and with to the query using the JobProfesion relation
 *
 * @method     \JobFormacionAcademicaQuery|\JobProfesionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobTipoFormacion findOne(ConnectionInterface $con = null) Return the first ChildJobTipoFormacion matching the query
 * @method     ChildJobTipoFormacion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobTipoFormacion matching the query, or a new ChildJobTipoFormacion object populated from the query conditions when no match is found
 *
 * @method     ChildJobTipoFormacion findOneById(int $ID) Return the first ChildJobTipoFormacion filtered by the ID column
 * @method     ChildJobTipoFormacion findOneByCodigo(string $CODIGO) Return the first ChildJobTipoFormacion filtered by the CODIGO column
 * @method     ChildJobTipoFormacion findOneByNivel(string $NIVEL) Return the first ChildJobTipoFormacion filtered by the NIVEL column
 * @method     ChildJobTipoFormacion findOneByNombre(string $NOMBRE) Return the first ChildJobTipoFormacion filtered by the NOMBRE column
 * @method     ChildJobTipoFormacion findOneByDescripcion(string $DESCRIPCION) Return the first ChildJobTipoFormacion filtered by the DESCRIPCION column *

 * @method     ChildJobTipoFormacion requirePk($key, ConnectionInterface $con = null) Return the ChildJobTipoFormacion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobTipoFormacion requireOne(ConnectionInterface $con = null) Return the first ChildJobTipoFormacion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobTipoFormacion requireOneById(int $ID) Return the first ChildJobTipoFormacion filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobTipoFormacion requireOneByCodigo(string $CODIGO) Return the first ChildJobTipoFormacion filtered by the CODIGO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobTipoFormacion requireOneByNivel(string $NIVEL) Return the first ChildJobTipoFormacion filtered by the NIVEL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobTipoFormacion requireOneByNombre(string $NOMBRE) Return the first ChildJobTipoFormacion filtered by the NOMBRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobTipoFormacion requireOneByDescripcion(string $DESCRIPCION) Return the first ChildJobTipoFormacion filtered by the DESCRIPCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobTipoFormacion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobTipoFormacion objects based on current ModelCriteria
 * @method     ChildJobTipoFormacion[]|ObjectCollection findById(int $ID) Return ChildJobTipoFormacion objects filtered by the ID column
 * @method     ChildJobTipoFormacion[]|ObjectCollection findByCodigo(string $CODIGO) Return ChildJobTipoFormacion objects filtered by the CODIGO column
 * @method     ChildJobTipoFormacion[]|ObjectCollection findByNivel(string $NIVEL) Return ChildJobTipoFormacion objects filtered by the NIVEL column
 * @method     ChildJobTipoFormacion[]|ObjectCollection findByNombre(string $NOMBRE) Return ChildJobTipoFormacion objects filtered by the NOMBRE column
 * @method     ChildJobTipoFormacion[]|ObjectCollection findByDescripcion(string $DESCRIPCION) Return ChildJobTipoFormacion objects filtered by the DESCRIPCION column
 * @method     ChildJobTipoFormacion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobTipoFormacionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobTipoFormacionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobTipoFormacion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobTipoFormacionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobTipoFormacionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobTipoFormacionQuery) {
            return $criteria;
        }
        $query = new ChildJobTipoFormacionQuery();
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
     * @return ChildJobTipoFormacion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobTipoFormacionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobTipoFormacionTableMap::DATABASE_NAME);
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
     * @return ChildJobTipoFormacion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, CODIGO, NIVEL, NOMBRE, DESCRIPCION FROM job_tipo_formacion WHERE ID = :p0';
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
            /** @var ChildJobTipoFormacion $obj */
            $obj = new ChildJobTipoFormacion();
            $obj->hydrate($row);
            JobTipoFormacionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobTipoFormacion|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the CODIGO column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigo('fooValue');   // WHERE CODIGO = 'fooValue'
     * $query->filterByCodigo('%fooValue%'); // WHERE CODIGO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $codigo)) {
                $codigo = str_replace('*', '%', $codigo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobTipoFormacionTableMap::COL_CODIGO, $codigo, $comparison);
    }

    /**
     * Filter the query on the NIVEL column
     *
     * Example usage:
     * <code>
     * $query->filterByNivel('fooValue');   // WHERE NIVEL = 'fooValue'
     * $query->filterByNivel('%fooValue%'); // WHERE NIVEL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nivel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByNivel($nivel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nivel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nivel)) {
                $nivel = str_replace('*', '%', $nivel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobTipoFormacionTableMap::COL_NIVEL, $nivel, $comparison);
    }

    /**
     * Filter the query on the NOMBRE column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE NOMBRE = 'fooValue'
     * $query->filterByNombre('%fooValue%'); // WHERE NOMBRE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombre)) {
                $nombre = str_replace('*', '%', $nombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobTipoFormacionTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the DESCRIPCION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE DESCRIPCION = 'fooValue'
     * $query->filterByDescripcion('%fooValue%'); // WHERE DESCRIPCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descripcion)) {
                $descripcion = str_replace('*', '%', $descripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobTipoFormacionTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query by a related \JobFormacionAcademica object
     *
     * @param \JobFormacionAcademica|ObjectCollection $jobFormacionAcademica the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByJobFormacionAcademica($jobFormacionAcademica, $comparison = null)
    {
        if ($jobFormacionAcademica instanceof \JobFormacionAcademica) {
            return $this
                ->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $jobFormacionAcademica->getIdTipoFormacion(), $comparison);
        } elseif ($jobFormacionAcademica instanceof ObjectCollection) {
            return $this
                ->useJobFormacionAcademicaQuery()
                ->filterByPrimaryKeys($jobFormacionAcademica->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobFormacionAcademica() only accepts arguments of type \JobFormacionAcademica or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobFormacionAcademica relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function joinJobFormacionAcademica($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobFormacionAcademica');

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
            $this->addJoinObject($join, 'JobFormacionAcademica');
        }

        return $this;
    }

    /**
     * Use the JobFormacionAcademica relation JobFormacionAcademica object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobFormacionAcademicaQuery A secondary query class using the current class as primary query
     */
    public function useJobFormacionAcademicaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobFormacionAcademica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobFormacionAcademica', '\JobFormacionAcademicaQuery');
    }

    /**
     * Filter the query by a related \JobProfesion object
     *
     * @param \JobProfesion|ObjectCollection $jobProfesion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function filterByJobProfesion($jobProfesion, $comparison = null)
    {
        if ($jobProfesion instanceof \JobProfesion) {
            return $this
                ->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $jobProfesion->getIdTipoFormacion(), $comparison);
        } elseif ($jobProfesion instanceof ObjectCollection) {
            return $this
                ->useJobProfesionQuery()
                ->filterByPrimaryKeys($jobProfesion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobProfesion() only accepts arguments of type \JobProfesion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobProfesion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function joinJobProfesion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobProfesion');

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
            $this->addJoinObject($join, 'JobProfesion');
        }

        return $this;
    }

    /**
     * Use the JobProfesion relation JobProfesion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobProfesionQuery A secondary query class using the current class as primary query
     */
    public function useJobProfesionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobProfesion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobProfesion', '\JobProfesionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobTipoFormacion $jobTipoFormacion Object to remove from the list of results
     *
     * @return $this|ChildJobTipoFormacionQuery The current query, for fluid interface
     */
    public function prune($jobTipoFormacion = null)
    {
        if ($jobTipoFormacion) {
            $this->addUsingAlias(JobTipoFormacionTableMap::COL_ID, $jobTipoFormacion->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_tipo_formacion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobTipoFormacionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobTipoFormacionTableMap::clearInstancePool();
            JobTipoFormacionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobTipoFormacionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobTipoFormacionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobTipoFormacionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobTipoFormacionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobTipoFormacionQuery
