<?php

namespace Base;

use \JobProfesion as ChildJobProfesion;
use \JobProfesionQuery as ChildJobProfesionQuery;
use \Exception;
use \PDO;
use Map\JobProfesionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_profesion' table.
 *
 *
 *
 * @method     ChildJobProfesionQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobProfesionQuery orderByIdTipoFormacion($order = Criteria::ASC) Order by the ID_TIPO_FORMACION column
 * @method     ChildJobProfesionQuery orderByNombre($order = Criteria::ASC) Order by the NOMBRE column
 * @method     ChildJobProfesionQuery orderByOtrosNombres($order = Criteria::ASC) Order by the OTROS_NOMBRES column
 * @method     ChildJobProfesionQuery orderByDescripcion($order = Criteria::ASC) Order by the DESCRIPCION column
 * @method     ChildJobProfesionQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobProfesionQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobProfesionQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobProfesionQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobProfesionQuery groupById() Group by the ID column
 * @method     ChildJobProfesionQuery groupByIdTipoFormacion() Group by the ID_TIPO_FORMACION column
 * @method     ChildJobProfesionQuery groupByNombre() Group by the NOMBRE column
 * @method     ChildJobProfesionQuery groupByOtrosNombres() Group by the OTROS_NOMBRES column
 * @method     ChildJobProfesionQuery groupByDescripcion() Group by the DESCRIPCION column
 * @method     ChildJobProfesionQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobProfesionQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobProfesionQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobProfesionQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobProfesionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobProfesionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobProfesionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobProfesionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobProfesionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobProfesionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobProfesionQuery leftJoinJobTipoFormacion($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobTipoFormacion relation
 * @method     ChildJobProfesionQuery rightJoinJobTipoFormacion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobTipoFormacion relation
 * @method     ChildJobProfesionQuery innerJoinJobTipoFormacion($relationAlias = null) Adds a INNER JOIN clause to the query using the JobTipoFormacion relation
 *
 * @method     ChildJobProfesionQuery joinWithJobTipoFormacion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobTipoFormacion relation
 *
 * @method     ChildJobProfesionQuery leftJoinWithJobTipoFormacion() Adds a LEFT JOIN clause and with to the query using the JobTipoFormacion relation
 * @method     ChildJobProfesionQuery rightJoinWithJobTipoFormacion() Adds a RIGHT JOIN clause and with to the query using the JobTipoFormacion relation
 * @method     ChildJobProfesionQuery innerJoinWithJobTipoFormacion() Adds a INNER JOIN clause and with to the query using the JobTipoFormacion relation
 *
 * @method     ChildJobProfesionQuery leftJoinJobAreaTecnicaProfesion($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobProfesionQuery rightJoinJobAreaTecnicaProfesion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobProfesionQuery innerJoinJobAreaTecnicaProfesion($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaTecnicaProfesion relation
 *
 * @method     ChildJobProfesionQuery joinWithJobAreaTecnicaProfesion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAreaTecnicaProfesion relation
 *
 * @method     ChildJobProfesionQuery leftJoinWithJobAreaTecnicaProfesion() Adds a LEFT JOIN clause and with to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobProfesionQuery rightJoinWithJobAreaTecnicaProfesion() Adds a RIGHT JOIN clause and with to the query using the JobAreaTecnicaProfesion relation
 * @method     ChildJobProfesionQuery innerJoinWithJobAreaTecnicaProfesion() Adds a INNER JOIN clause and with to the query using the JobAreaTecnicaProfesion relation
 *
 * @method     ChildJobProfesionQuery leftJoinJobFormacionAcademica($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobFormacionAcademica relation
 * @method     ChildJobProfesionQuery rightJoinJobFormacionAcademica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobFormacionAcademica relation
 * @method     ChildJobProfesionQuery innerJoinJobFormacionAcademica($relationAlias = null) Adds a INNER JOIN clause to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobProfesionQuery joinWithJobFormacionAcademica($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobFormacionAcademica relation
 *
 * @method     ChildJobProfesionQuery leftJoinWithJobFormacionAcademica() Adds a LEFT JOIN clause and with to the query using the JobFormacionAcademica relation
 * @method     ChildJobProfesionQuery rightJoinWithJobFormacionAcademica() Adds a RIGHT JOIN clause and with to the query using the JobFormacionAcademica relation
 * @method     ChildJobProfesionQuery innerJoinWithJobFormacionAcademica() Adds a INNER JOIN clause and with to the query using the JobFormacionAcademica relation
 *
 * @method     \JobTipoFormacionQuery|\JobAreaTecnicaProfesionQuery|\JobFormacionAcademicaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobProfesion findOne(ConnectionInterface $con = null) Return the first ChildJobProfesion matching the query
 * @method     ChildJobProfesion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobProfesion matching the query, or a new ChildJobProfesion object populated from the query conditions when no match is found
 *
 * @method     ChildJobProfesion findOneById(int $ID) Return the first ChildJobProfesion filtered by the ID column
 * @method     ChildJobProfesion findOneByIdTipoFormacion(int $ID_TIPO_FORMACION) Return the first ChildJobProfesion filtered by the ID_TIPO_FORMACION column
 * @method     ChildJobProfesion findOneByNombre(string $NOMBRE) Return the first ChildJobProfesion filtered by the NOMBRE column
 * @method     ChildJobProfesion findOneByOtrosNombres(string $OTROS_NOMBRES) Return the first ChildJobProfesion filtered by the OTROS_NOMBRES column
 * @method     ChildJobProfesion findOneByDescripcion(string $DESCRIPCION) Return the first ChildJobProfesion filtered by the DESCRIPCION column
 * @method     ChildJobProfesion findOneByStatus(string $STATUS) Return the first ChildJobProfesion filtered by the STATUS column
 * @method     ChildJobProfesion findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobProfesion filtered by the LAST_USER_ID column
 * @method     ChildJobProfesion findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobProfesion filtered by the CREATION_DATE column
 * @method     ChildJobProfesion findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobProfesion filtered by the MODIFICATION_DATE column *

 * @method     ChildJobProfesion requirePk($key, ConnectionInterface $con = null) Return the ChildJobProfesion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOne(ConnectionInterface $con = null) Return the first ChildJobProfesion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobProfesion requireOneById(int $ID) Return the first ChildJobProfesion filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByIdTipoFormacion(int $ID_TIPO_FORMACION) Return the first ChildJobProfesion filtered by the ID_TIPO_FORMACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByNombre(string $NOMBRE) Return the first ChildJobProfesion filtered by the NOMBRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByOtrosNombres(string $OTROS_NOMBRES) Return the first ChildJobProfesion filtered by the OTROS_NOMBRES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByDescripcion(string $DESCRIPCION) Return the first ChildJobProfesion filtered by the DESCRIPCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByStatus(string $STATUS) Return the first ChildJobProfesion filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobProfesion filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobProfesion filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobProfesion requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobProfesion filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobProfesion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobProfesion objects based on current ModelCriteria
 * @method     ChildJobProfesion[]|ObjectCollection findById(int $ID) Return ChildJobProfesion objects filtered by the ID column
 * @method     ChildJobProfesion[]|ObjectCollection findByIdTipoFormacion(int $ID_TIPO_FORMACION) Return ChildJobProfesion objects filtered by the ID_TIPO_FORMACION column
 * @method     ChildJobProfesion[]|ObjectCollection findByNombre(string $NOMBRE) Return ChildJobProfesion objects filtered by the NOMBRE column
 * @method     ChildJobProfesion[]|ObjectCollection findByOtrosNombres(string $OTROS_NOMBRES) Return ChildJobProfesion objects filtered by the OTROS_NOMBRES column
 * @method     ChildJobProfesion[]|ObjectCollection findByDescripcion(string $DESCRIPCION) Return ChildJobProfesion objects filtered by the DESCRIPCION column
 * @method     ChildJobProfesion[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobProfesion objects filtered by the STATUS column
 * @method     ChildJobProfesion[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobProfesion objects filtered by the LAST_USER_ID column
 * @method     ChildJobProfesion[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobProfesion objects filtered by the CREATION_DATE column
 * @method     ChildJobProfesion[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobProfesion objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobProfesion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobProfesionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobProfesionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobProfesion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobProfesionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobProfesionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobProfesionQuery) {
            return $criteria;
        }
        $query = new ChildJobProfesionQuery();
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
     * @return ChildJobProfesion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobProfesionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobProfesionTableMap::DATABASE_NAME);
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
     * @return ChildJobProfesion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_TIPO_FORMACION, NOMBRE, OTROS_NOMBRES, DESCRIPCION, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_profesion WHERE ID = :p0';
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
            /** @var ChildJobProfesion $obj */
            $obj = new ChildJobProfesion();
            $obj->hydrate($row);
            JobProfesionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobProfesion|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobProfesionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobProfesionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobProfesionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_TIPO_FORMACION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTipoFormacion(1234); // WHERE ID_TIPO_FORMACION = 1234
     * $query->filterByIdTipoFormacion(array(12, 34)); // WHERE ID_TIPO_FORMACION IN (12, 34)
     * $query->filterByIdTipoFormacion(array('min' => 12)); // WHERE ID_TIPO_FORMACION > 12
     * </code>
     *
     * @see       filterByJobTipoFormacion()
     *
     * @param     mixed $idTipoFormacion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByIdTipoFormacion($idTipoFormacion = null, $comparison = null)
    {
        if (is_array($idTipoFormacion)) {
            $useMinMax = false;
            if (isset($idTipoFormacion['min'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_ID_TIPO_FORMACION, $idTipoFormacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTipoFormacion['max'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_ID_TIPO_FORMACION, $idTipoFormacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobProfesionTableMap::COL_ID_TIPO_FORMACION, $idTipoFormacion, $comparison);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobProfesionTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the OTROS_NOMBRES column
     *
     * Example usage:
     * <code>
     * $query->filterByOtrosNombres('fooValue');   // WHERE OTROS_NOMBRES = 'fooValue'
     * $query->filterByOtrosNombres('%fooValue%'); // WHERE OTROS_NOMBRES LIKE '%fooValue%'
     * </code>
     *
     * @param     string $otrosNombres The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByOtrosNombres($otrosNombres = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($otrosNombres)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $otrosNombres)) {
                $otrosNombres = str_replace('*', '%', $otrosNombres);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobProfesionTableMap::COL_OTROS_NOMBRES, $otrosNombres, $comparison);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobProfesionTableMap::COL_DESCRIPCION, $descripcion, $comparison);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobProfesionTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobProfesionTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobProfesionTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobProfesionTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobProfesionTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobTipoFormacion object
     *
     * @param \JobTipoFormacion|ObjectCollection $jobTipoFormacion The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByJobTipoFormacion($jobTipoFormacion, $comparison = null)
    {
        if ($jobTipoFormacion instanceof \JobTipoFormacion) {
            return $this
                ->addUsingAlias(JobProfesionTableMap::COL_ID_TIPO_FORMACION, $jobTipoFormacion->getId(), $comparison);
        } elseif ($jobTipoFormacion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobProfesionTableMap::COL_ID_TIPO_FORMACION, $jobTipoFormacion->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobTipoFormacion() only accepts arguments of type \JobTipoFormacion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobTipoFormacion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function joinJobTipoFormacion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobTipoFormacion');

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
            $this->addJoinObject($join, 'JobTipoFormacion');
        }

        return $this;
    }

    /**
     * Use the JobTipoFormacion relation JobTipoFormacion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobTipoFormacionQuery A secondary query class using the current class as primary query
     */
    public function useJobTipoFormacionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobTipoFormacion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobTipoFormacion', '\JobTipoFormacionQuery');
    }

    /**
     * Filter the query by a related \JobAreaTecnicaProfesion object
     *
     * @param \JobAreaTecnicaProfesion|ObjectCollection $jobAreaTecnicaProfesion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByJobAreaTecnicaProfesion($jobAreaTecnicaProfesion, $comparison = null)
    {
        if ($jobAreaTecnicaProfesion instanceof \JobAreaTecnicaProfesion) {
            return $this
                ->addUsingAlias(JobProfesionTableMap::COL_ID, $jobAreaTecnicaProfesion->getIdProfesion(), $comparison);
        } elseif ($jobAreaTecnicaProfesion instanceof ObjectCollection) {
            return $this
                ->useJobAreaTecnicaProfesionQuery()
                ->filterByPrimaryKeys($jobAreaTecnicaProfesion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobAreaTecnicaProfesion() only accepts arguments of type \JobAreaTecnicaProfesion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAreaTecnicaProfesion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function joinJobAreaTecnicaProfesion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAreaTecnicaProfesion');

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
            $this->addJoinObject($join, 'JobAreaTecnicaProfesion');
        }

        return $this;
    }

    /**
     * Use the JobAreaTecnicaProfesion relation JobAreaTecnicaProfesion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaTecnicaProfesionQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaTecnicaProfesionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAreaTecnicaProfesion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaTecnicaProfesion', '\JobAreaTecnicaProfesionQuery');
    }

    /**
     * Filter the query by a related \JobFormacionAcademica object
     *
     * @param \JobFormacionAcademica|ObjectCollection $jobFormacionAcademica the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobProfesionQuery The current query, for fluid interface
     */
    public function filterByJobFormacionAcademica($jobFormacionAcademica, $comparison = null)
    {
        if ($jobFormacionAcademica instanceof \JobFormacionAcademica) {
            return $this
                ->addUsingAlias(JobProfesionTableMap::COL_ID, $jobFormacionAcademica->getIdProfesion(), $comparison);
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
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function joinJobFormacionAcademica($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useJobFormacionAcademicaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJobFormacionAcademica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobFormacionAcademica', '\JobFormacionAcademicaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobProfesion $jobProfesion Object to remove from the list of results
     *
     * @return $this|ChildJobProfesionQuery The current query, for fluid interface
     */
    public function prune($jobProfesion = null)
    {
        if ($jobProfesion) {
            $this->addUsingAlias(JobProfesionTableMap::COL_ID, $jobProfesion->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_profesion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobProfesionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobProfesionTableMap::clearInstancePool();
            JobProfesionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobProfesionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobProfesionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobProfesionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobProfesionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobProfesionQuery
