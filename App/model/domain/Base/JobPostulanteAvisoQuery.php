<?php

namespace Base;

use \JobPostulanteAviso as ChildJobPostulanteAviso;
use \JobPostulanteAvisoQuery as ChildJobPostulanteAvisoQuery;
use \Exception;
use \PDO;
use Map\JobPostulanteAvisoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_postulante_aviso' table.
 *
 *
 *
 * @method     ChildJobPostulanteAvisoQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobPostulanteAvisoQuery orderByIdAviso($order = Criteria::ASC) Order by the ID_AVISO column
 * @method     ChildJobPostulanteAvisoQuery orderByIdPostulante($order = Criteria::ASC) Order by the ID_POSTULANTE column
 * @method     ChildJobPostulanteAvisoQuery orderByEstado($order = Criteria::ASC) Order by the ESTADO column
 * @method     ChildJobPostulanteAvisoQuery orderByPretensionSalarial($order = Criteria::ASC) Order by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulanteAvisoQuery orderByCartaPresentacion($order = Criteria::ASC) Order by the CARTA_PRESENTACION column
 * @method     ChildJobPostulanteAvisoQuery orderByCvMime($order = Criteria::ASC) Order by the CV_MIME column
 * @method     ChildJobPostulanteAvisoQuery orderByCvFilename($order = Criteria::ASC) Order by the CV_FILENAME column
 * @method     ChildJobPostulanteAvisoQuery orderByFechaPostulacion($order = Criteria::ASC) Order by the FECHA_POSTULACION column
 * @method     ChildJobPostulanteAvisoQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobPostulanteAvisoQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobPostulanteAvisoQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobPostulanteAvisoQuery groupById() Group by the ID column
 * @method     ChildJobPostulanteAvisoQuery groupByIdAviso() Group by the ID_AVISO column
 * @method     ChildJobPostulanteAvisoQuery groupByIdPostulante() Group by the ID_POSTULANTE column
 * @method     ChildJobPostulanteAvisoQuery groupByEstado() Group by the ESTADO column
 * @method     ChildJobPostulanteAvisoQuery groupByPretensionSalarial() Group by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulanteAvisoQuery groupByCartaPresentacion() Group by the CARTA_PRESENTACION column
 * @method     ChildJobPostulanteAvisoQuery groupByCvMime() Group by the CV_MIME column
 * @method     ChildJobPostulanteAvisoQuery groupByCvFilename() Group by the CV_FILENAME column
 * @method     ChildJobPostulanteAvisoQuery groupByFechaPostulacion() Group by the FECHA_POSTULACION column
 * @method     ChildJobPostulanteAvisoQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobPostulanteAvisoQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobPostulanteAvisoQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobPostulanteAvisoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobPostulanteAvisoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobPostulanteAvisoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobPostulanteAvisoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobPostulanteAvisoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobPostulanteAvisoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobPostulanteAvisoQuery leftJoinJobAviso($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAviso relation
 * @method     ChildJobPostulanteAvisoQuery rightJoinJobAviso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAviso relation
 * @method     ChildJobPostulanteAvisoQuery innerJoinJobAviso($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAviso relation
 *
 * @method     ChildJobPostulanteAvisoQuery joinWithJobAviso($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobAviso relation
 *
 * @method     ChildJobPostulanteAvisoQuery leftJoinWithJobAviso() Adds a LEFT JOIN clause and with to the query using the JobAviso relation
 * @method     ChildJobPostulanteAvisoQuery rightJoinWithJobAviso() Adds a RIGHT JOIN clause and with to the query using the JobAviso relation
 * @method     ChildJobPostulanteAvisoQuery innerJoinWithJobAviso() Adds a INNER JOIN clause and with to the query using the JobAviso relation
 *
 * @method     ChildJobPostulanteAvisoQuery leftJoinJobPostulante($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobPostulante relation
 * @method     ChildJobPostulanteAvisoQuery rightJoinJobPostulante($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobPostulante relation
 * @method     ChildJobPostulanteAvisoQuery innerJoinJobPostulante($relationAlias = null) Adds a INNER JOIN clause to the query using the JobPostulante relation
 *
 * @method     ChildJobPostulanteAvisoQuery joinWithJobPostulante($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobPostulante relation
 *
 * @method     ChildJobPostulanteAvisoQuery leftJoinWithJobPostulante() Adds a LEFT JOIN clause and with to the query using the JobPostulante relation
 * @method     ChildJobPostulanteAvisoQuery rightJoinWithJobPostulante() Adds a RIGHT JOIN clause and with to the query using the JobPostulante relation
 * @method     ChildJobPostulanteAvisoQuery innerJoinWithJobPostulante() Adds a INNER JOIN clause and with to the query using the JobPostulante relation
 *
 * @method     \JobAvisoQuery|\JobPostulanteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobPostulanteAviso findOne(ConnectionInterface $con = null) Return the first ChildJobPostulanteAviso matching the query
 * @method     ChildJobPostulanteAviso findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobPostulanteAviso matching the query, or a new ChildJobPostulanteAviso object populated from the query conditions when no match is found
 *
 * @method     ChildJobPostulanteAviso findOneById(int $ID) Return the first ChildJobPostulanteAviso filtered by the ID column
 * @method     ChildJobPostulanteAviso findOneByIdAviso(int $ID_AVISO) Return the first ChildJobPostulanteAviso filtered by the ID_AVISO column
 * @method     ChildJobPostulanteAviso findOneByIdPostulante(int $ID_POSTULANTE) Return the first ChildJobPostulanteAviso filtered by the ID_POSTULANTE column
 * @method     ChildJobPostulanteAviso findOneByEstado(string $ESTADO) Return the first ChildJobPostulanteAviso filtered by the ESTADO column
 * @method     ChildJobPostulanteAviso findOneByPretensionSalarial(int $PRETENSION_SALARIAL) Return the first ChildJobPostulanteAviso filtered by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulanteAviso findOneByCartaPresentacion(string $CARTA_PRESENTACION) Return the first ChildJobPostulanteAviso filtered by the CARTA_PRESENTACION column
 * @method     ChildJobPostulanteAviso findOneByCvMime(string $CV_MIME) Return the first ChildJobPostulanteAviso filtered by the CV_MIME column
 * @method     ChildJobPostulanteAviso findOneByCvFilename(string $CV_FILENAME) Return the first ChildJobPostulanteAviso filtered by the CV_FILENAME column
 * @method     ChildJobPostulanteAviso findOneByFechaPostulacion(string $FECHA_POSTULACION) Return the first ChildJobPostulanteAviso filtered by the FECHA_POSTULACION column
 * @method     ChildJobPostulanteAviso findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobPostulanteAviso filtered by the LAST_USER_ID column
 * @method     ChildJobPostulanteAviso findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobPostulanteAviso filtered by the CREATION_DATE column
 * @method     ChildJobPostulanteAviso findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobPostulanteAviso filtered by the MODIFICATION_DATE column *

 * @method     ChildJobPostulanteAviso requirePk($key, ConnectionInterface $con = null) Return the ChildJobPostulanteAviso by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOne(ConnectionInterface $con = null) Return the first ChildJobPostulanteAviso matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobPostulanteAviso requireOneById(int $ID) Return the first ChildJobPostulanteAviso filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByIdAviso(int $ID_AVISO) Return the first ChildJobPostulanteAviso filtered by the ID_AVISO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByIdPostulante(int $ID_POSTULANTE) Return the first ChildJobPostulanteAviso filtered by the ID_POSTULANTE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByEstado(string $ESTADO) Return the first ChildJobPostulanteAviso filtered by the ESTADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByPretensionSalarial(int $PRETENSION_SALARIAL) Return the first ChildJobPostulanteAviso filtered by the PRETENSION_SALARIAL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByCartaPresentacion(string $CARTA_PRESENTACION) Return the first ChildJobPostulanteAviso filtered by the CARTA_PRESENTACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByCvMime(string $CV_MIME) Return the first ChildJobPostulanteAviso filtered by the CV_MIME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByCvFilename(string $CV_FILENAME) Return the first ChildJobPostulanteAviso filtered by the CV_FILENAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByFechaPostulacion(string $FECHA_POSTULACION) Return the first ChildJobPostulanteAviso filtered by the FECHA_POSTULACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobPostulanteAviso filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobPostulanteAviso filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulanteAviso requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobPostulanteAviso filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobPostulanteAviso[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobPostulanteAviso objects based on current ModelCriteria
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findById(int $ID) Return ChildJobPostulanteAviso objects filtered by the ID column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByIdAviso(int $ID_AVISO) Return ChildJobPostulanteAviso objects filtered by the ID_AVISO column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByIdPostulante(int $ID_POSTULANTE) Return ChildJobPostulanteAviso objects filtered by the ID_POSTULANTE column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByEstado(string $ESTADO) Return ChildJobPostulanteAviso objects filtered by the ESTADO column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByPretensionSalarial(int $PRETENSION_SALARIAL) Return ChildJobPostulanteAviso objects filtered by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByCartaPresentacion(string $CARTA_PRESENTACION) Return ChildJobPostulanteAviso objects filtered by the CARTA_PRESENTACION column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByCvMime(string $CV_MIME) Return ChildJobPostulanteAviso objects filtered by the CV_MIME column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByCvFilename(string $CV_FILENAME) Return ChildJobPostulanteAviso objects filtered by the CV_FILENAME column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByFechaPostulacion(string $FECHA_POSTULACION) Return ChildJobPostulanteAviso objects filtered by the FECHA_POSTULACION column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobPostulanteAviso objects filtered by the LAST_USER_ID column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobPostulanteAviso objects filtered by the CREATION_DATE column
 * @method     ChildJobPostulanteAviso[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobPostulanteAviso objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobPostulanteAviso[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobPostulanteAvisoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobPostulanteAvisoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobPostulanteAviso', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobPostulanteAvisoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobPostulanteAvisoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobPostulanteAvisoQuery) {
            return $criteria;
        }
        $query = new ChildJobPostulanteAvisoQuery();
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
     * @return ChildJobPostulanteAviso|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobPostulanteAvisoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJobPostulanteAviso A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_AVISO, ID_POSTULANTE, ESTADO, PRETENSION_SALARIAL, CARTA_PRESENTACION, CV_MIME, CV_FILENAME, FECHA_POSTULACION, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_postulante_aviso WHERE ID = :p0';
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
            /** @var ChildJobPostulanteAviso $obj */
            $obj = new ChildJobPostulanteAviso();
            $obj->hydrate($row);
            JobPostulanteAvisoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobPostulanteAviso|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_AVISO column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAviso(1234); // WHERE ID_AVISO = 1234
     * $query->filterByIdAviso(array(12, 34)); // WHERE ID_AVISO IN (12, 34)
     * $query->filterByIdAviso(array('min' => 12)); // WHERE ID_AVISO > 12
     * </code>
     *
     * @see       filterByJobAviso()
     *
     * @param     mixed $idAviso The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByIdAviso($idAviso = null, $comparison = null)
    {
        if (is_array($idAviso)) {
            $useMinMax = false;
            if (isset($idAviso['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_AVISO, $idAviso['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAviso['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_AVISO, $idAviso['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_AVISO, $idAviso, $comparison);
    }

    /**
     * Filter the query on the ID_POSTULANTE column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPostulante(1234); // WHERE ID_POSTULANTE = 1234
     * $query->filterByIdPostulante(array(12, 34)); // WHERE ID_POSTULANTE IN (12, 34)
     * $query->filterByIdPostulante(array('min' => 12)); // WHERE ID_POSTULANTE > 12
     * </code>
     *
     * @see       filterByJobPostulante()
     *
     * @param     mixed $idPostulante The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByIdPostulante($idPostulante = null, $comparison = null)
    {
        if (is_array($idPostulante)) {
            $useMinMax = false;
            if (isset($idPostulante['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE, $idPostulante['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPostulante['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE, $idPostulante['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE, $idPostulante, $comparison);
    }

    /**
     * Filter the query on the ESTADO column
     *
     * Example usage:
     * <code>
     * $query->filterByEstado('fooValue');   // WHERE ESTADO = 'fooValue'
     * $query->filterByEstado('%fooValue%', Criteria::LIKE); // WHERE ESTADO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estado The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query on the PRETENSION_SALARIAL column
     *
     * Example usage:
     * <code>
     * $query->filterByPretensionSalarial(1234); // WHERE PRETENSION_SALARIAL = 1234
     * $query->filterByPretensionSalarial(array(12, 34)); // WHERE PRETENSION_SALARIAL IN (12, 34)
     * $query->filterByPretensionSalarial(array('min' => 12)); // WHERE PRETENSION_SALARIAL > 12
     * </code>
     *
     * @param     mixed $pretensionSalarial The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByPretensionSalarial($pretensionSalarial = null, $comparison = null)
    {
        if (is_array($pretensionSalarial)) {
            $useMinMax = false;
            if (isset($pretensionSalarial['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL, $pretensionSalarial['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pretensionSalarial['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL, $pretensionSalarial['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL, $pretensionSalarial, $comparison);
    }

    /**
     * Filter the query on the CARTA_PRESENTACION column
     *
     * Example usage:
     * <code>
     * $query->filterByCartaPresentacion('fooValue');   // WHERE CARTA_PRESENTACION = 'fooValue'
     * $query->filterByCartaPresentacion('%fooValue%', Criteria::LIKE); // WHERE CARTA_PRESENTACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cartaPresentacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByCartaPresentacion($cartaPresentacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cartaPresentacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION, $cartaPresentacion, $comparison);
    }

    /**
     * Filter the query on the CV_MIME column
     *
     * Example usage:
     * <code>
     * $query->filterByCvMime('fooValue');   // WHERE CV_MIME = 'fooValue'
     * $query->filterByCvMime('%fooValue%', Criteria::LIKE); // WHERE CV_MIME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cvMime The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByCvMime($cvMime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cvMime)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_CV_MIME, $cvMime, $comparison);
    }

    /**
     * Filter the query on the CV_FILENAME column
     *
     * Example usage:
     * <code>
     * $query->filterByCvFilename('fooValue');   // WHERE CV_FILENAME = 'fooValue'
     * $query->filterByCvFilename('%fooValue%', Criteria::LIKE); // WHERE CV_FILENAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cvFilename The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByCvFilename($cvFilename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cvFilename)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_CV_FILENAME, $cvFilename, $comparison);
    }

    /**
     * Filter the query on the FECHA_POSTULACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaPostulacion('2011-03-14'); // WHERE FECHA_POSTULACION = '2011-03-14'
     * $query->filterByFechaPostulacion('now'); // WHERE FECHA_POSTULACION = '2011-03-14'
     * $query->filterByFechaPostulacion(array('max' => 'yesterday')); // WHERE FECHA_POSTULACION > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaPostulacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByFechaPostulacion($fechaPostulacion = null, $comparison = null)
    {
        if (is_array($fechaPostulacion)) {
            $useMinMax = false;
            if (isset($fechaPostulacion['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION, $fechaPostulacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPostulacion['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION, $fechaPostulacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION, $fechaPostulacion, $comparison);
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
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobAviso object
     *
     * @param \JobAviso|ObjectCollection $jobAviso The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByJobAviso($jobAviso, $comparison = null)
    {
        if ($jobAviso instanceof \JobAviso) {
            return $this
                ->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_AVISO, $jobAviso->getId(), $comparison);
        } elseif ($jobAviso instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_AVISO, $jobAviso->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobAviso() only accepts arguments of type \JobAviso or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAviso relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function joinJobAviso($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAviso');

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
            $this->addJoinObject($join, 'JobAviso');
        }

        return $this;
    }

    /**
     * Use the JobAviso relation JobAviso object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAvisoQuery A secondary query class using the current class as primary query
     */
    public function useJobAvisoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAviso($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAviso', '\JobAvisoQuery');
    }

    /**
     * Filter the query by a related \JobPostulante object
     *
     * @param \JobPostulante|ObjectCollection $jobPostulante The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function filterByJobPostulante($jobPostulante, $comparison = null)
    {
        if ($jobPostulante instanceof \JobPostulante) {
            return $this
                ->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE, $jobPostulante->getId(), $comparison);
        } elseif ($jobPostulante instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE, $jobPostulante->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobPostulante() only accepts arguments of type \JobPostulante or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobPostulante relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function joinJobPostulante($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobPostulante');

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
            $this->addJoinObject($join, 'JobPostulante');
        }

        return $this;
    }

    /**
     * Use the JobPostulante relation JobPostulante object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobPostulanteQuery A secondary query class using the current class as primary query
     */
    public function useJobPostulanteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobPostulante($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobPostulante', '\JobPostulanteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobPostulanteAviso $jobPostulanteAviso Object to remove from the list of results
     *
     * @return $this|ChildJobPostulanteAvisoQuery The current query, for fluid interface
     */
    public function prune($jobPostulanteAviso = null)
    {
        if ($jobPostulanteAviso) {
            $this->addUsingAlias(JobPostulanteAvisoTableMap::COL_ID, $jobPostulanteAviso->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_postulante_aviso table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobPostulanteAvisoTableMap::clearInstancePool();
            JobPostulanteAvisoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobPostulanteAvisoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobPostulanteAvisoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobPostulanteAvisoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobPostulanteAvisoQuery
