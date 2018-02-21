<?php

namespace Base;

use \JobAreaTecnicaProfesion as ChildJobAreaTecnicaProfesion;
use \JobAreaTecnicaProfesionQuery as ChildJobAreaTecnicaProfesionQuery;
use \Exception;
use \PDO;
use Map\JobAreaTecnicaProfesionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_area_tecnica_profesion' table.
 *
 * 
 *
 * @method     ChildJobAreaTecnicaProfesionQuery orderByIdAreaTecnica($order = Criteria::ASC) Order by the ID_AREA_TECNICA column
 * @method     ChildJobAreaTecnicaProfesionQuery orderByIdProfesion($order = Criteria::ASC) Order by the ID_PROFESION column
 * @method     ChildJobAreaTecnicaProfesionQuery orderByNivel($order = Criteria::ASC) Order by the NIVEL column
 * @method     ChildJobAreaTecnicaProfesionQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobAreaTecnicaProfesionQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobAreaTecnicaProfesionQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobAreaTecnicaProfesionQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobAreaTecnicaProfesionQuery groupByIdAreaTecnica() Group by the ID_AREA_TECNICA column
 * @method     ChildJobAreaTecnicaProfesionQuery groupByIdProfesion() Group by the ID_PROFESION column
 * @method     ChildJobAreaTecnicaProfesionQuery groupByNivel() Group by the NIVEL column
 * @method     ChildJobAreaTecnicaProfesionQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobAreaTecnicaProfesionQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobAreaTecnicaProfesionQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobAreaTecnicaProfesionQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobAreaTecnicaProfesionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobAreaTecnicaProfesionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobAreaTecnicaProfesionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobAreaTecnicaProfesionQuery leftJoinJobAreaTecnica($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaTecnica relation
 * @method     ChildJobAreaTecnicaProfesionQuery rightJoinJobAreaTecnica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaTecnica relation
 * @method     ChildJobAreaTecnicaProfesionQuery innerJoinJobAreaTecnica($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaTecnica relation
 *
 * @method     ChildJobAreaTecnicaProfesionQuery leftJoinJobProfesion($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobProfesion relation
 * @method     ChildJobAreaTecnicaProfesionQuery rightJoinJobProfesion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobProfesion relation
 * @method     ChildJobAreaTecnicaProfesionQuery innerJoinJobProfesion($relationAlias = null) Adds a INNER JOIN clause to the query using the JobProfesion relation
 *
 * @method     \JobAreaTecnicaQuery|\JobProfesionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobAreaTecnicaProfesion findOne(ConnectionInterface $con = null) Return the first ChildJobAreaTecnicaProfesion matching the query
 * @method     ChildJobAreaTecnicaProfesion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobAreaTecnicaProfesion matching the query, or a new ChildJobAreaTecnicaProfesion object populated from the query conditions when no match is found
 *
 * @method     ChildJobAreaTecnicaProfesion findOneByIdAreaTecnica(int $ID_AREA_TECNICA) Return the first ChildJobAreaTecnicaProfesion filtered by the ID_AREA_TECNICA column
 * @method     ChildJobAreaTecnicaProfesion findOneByIdProfesion(int $ID_PROFESION) Return the first ChildJobAreaTecnicaProfesion filtered by the ID_PROFESION column
 * @method     ChildJobAreaTecnicaProfesion findOneByNivel(int $NIVEL) Return the first ChildJobAreaTecnicaProfesion filtered by the NIVEL column
 * @method     ChildJobAreaTecnicaProfesion findOneByStatus(string $STATUS) Return the first ChildJobAreaTecnicaProfesion filtered by the STATUS column
 * @method     ChildJobAreaTecnicaProfesion findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobAreaTecnicaProfesion filtered by the LAST_USER_ID column
 * @method     ChildJobAreaTecnicaProfesion findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAreaTecnicaProfesion filtered by the CREATION_DATE column
 * @method     ChildJobAreaTecnicaProfesion findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAreaTecnicaProfesion filtered by the MODIFICATION_DATE column *

 * @method     ChildJobAreaTecnicaProfesion requirePk($key, ConnectionInterface $con = null) Return the ChildJobAreaTecnicaProfesion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnicaProfesion requireOne(ConnectionInterface $con = null) Return the first ChildJobAreaTecnicaProfesion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAreaTecnicaProfesion requireOneByIdAreaTecnica(int $ID_AREA_TECNICA) Return the first ChildJobAreaTecnicaProfesion filtered by the ID_AREA_TECNICA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnicaProfesion requireOneByIdProfesion(int $ID_PROFESION) Return the first ChildJobAreaTecnicaProfesion filtered by the ID_PROFESION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnicaProfesion requireOneByNivel(int $NIVEL) Return the first ChildJobAreaTecnicaProfesion filtered by the NIVEL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnicaProfesion requireOneByStatus(string $STATUS) Return the first ChildJobAreaTecnicaProfesion filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnicaProfesion requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobAreaTecnicaProfesion filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnicaProfesion requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAreaTecnicaProfesion filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAreaTecnicaProfesion requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAreaTecnicaProfesion filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobAreaTecnicaProfesion objects based on current ModelCriteria
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection findByIdAreaTecnica(int $ID_AREA_TECNICA) Return ChildJobAreaTecnicaProfesion objects filtered by the ID_AREA_TECNICA column
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection findByIdProfesion(int $ID_PROFESION) Return ChildJobAreaTecnicaProfesion objects filtered by the ID_PROFESION column
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection findByNivel(int $NIVEL) Return ChildJobAreaTecnicaProfesion objects filtered by the NIVEL column
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobAreaTecnicaProfesion objects filtered by the STATUS column
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobAreaTecnicaProfesion objects filtered by the LAST_USER_ID column
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobAreaTecnicaProfesion objects filtered by the CREATION_DATE column
 * @method     ChildJobAreaTecnicaProfesion[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobAreaTecnicaProfesion objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobAreaTecnicaProfesion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobAreaTecnicaProfesionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobAreaTecnicaProfesionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobAreaTecnicaProfesion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobAreaTecnicaProfesionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobAreaTecnicaProfesionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobAreaTecnicaProfesionQuery) {
            return $criteria;
        }
        $query = new ChildJobAreaTecnicaProfesionQuery();
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
     * @param array[$ID_AREA_TECNICA, $ID_PROFESION] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildJobAreaTecnicaProfesion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobAreaTecnicaProfesionTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);
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
     * @return ChildJobAreaTecnicaProfesion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID_AREA_TECNICA, ID_PROFESION, NIVEL, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_area_tecnica_profesion WHERE ID_AREA_TECNICA = :p0 AND ID_PROFESION = :p1';
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
            /** @var ChildJobAreaTecnicaProfesion $obj */
            $obj = new ChildJobAreaTecnicaProfesion();
            $obj->hydrate($row);
            JobAreaTecnicaProfesionTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildJobAreaTecnicaProfesion|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the ID_AREA_TECNICA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAreaTecnica(1234); // WHERE ID_AREA_TECNICA = 1234
     * $query->filterByIdAreaTecnica(array(12, 34)); // WHERE ID_AREA_TECNICA IN (12, 34)
     * $query->filterByIdAreaTecnica(array('min' => 12)); // WHERE ID_AREA_TECNICA > 12
     * </code>
     *
     * @see       filterByJobAreaTecnica()
     *
     * @param     mixed $idAreaTecnica The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByIdAreaTecnica($idAreaTecnica = null, $comparison = null)
    {
        if (is_array($idAreaTecnica)) {
            $useMinMax = false;
            if (isset($idAreaTecnica['min'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $idAreaTecnica['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAreaTecnica['max'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $idAreaTecnica['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $idAreaTecnica, $comparison);
    }

    /**
     * Filter the query on the ID_PROFESION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProfesion(1234); // WHERE ID_PROFESION = 1234
     * $query->filterByIdProfesion(array(12, 34)); // WHERE ID_PROFESION IN (12, 34)
     * $query->filterByIdProfesion(array('min' => 12)); // WHERE ID_PROFESION > 12
     * </code>
     *
     * @see       filterByJobProfesion()
     *
     * @param     mixed $idProfesion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByIdProfesion($idProfesion = null, $comparison = null)
    {
        if (is_array($idProfesion)) {
            $useMinMax = false;
            if (isset($idProfesion['min'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $idProfesion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProfesion['max'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $idProfesion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $idProfesion, $comparison);
    }

    /**
     * Filter the query on the NIVEL column
     *
     * Example usage:
     * <code>
     * $query->filterByNivel(1234); // WHERE NIVEL = 1234
     * $query->filterByNivel(array(12, 34)); // WHERE NIVEL IN (12, 34)
     * $query->filterByNivel(array('min' => 12)); // WHERE NIVEL > 12
     * </code>
     *
     * @param     mixed $nivel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByNivel($nivel = null, $comparison = null)
    {
        if (is_array($nivel)) {
            $useMinMax = false;
            if (isset($nivel['min'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_NIVEL, $nivel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nivel['max'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_NIVEL, $nivel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_NIVEL, $nivel, $comparison);
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
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobAreaTecnica object
     *
     * @param \JobAreaTecnica|ObjectCollection $jobAreaTecnica The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByJobAreaTecnica($jobAreaTecnica, $comparison = null)
    {
        if ($jobAreaTecnica instanceof \JobAreaTecnica) {
            return $this
                ->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $jobAreaTecnica->getId(), $comparison);
        } elseif ($jobAreaTecnica instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA, $jobAreaTecnica->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobAreaTecnica() only accepts arguments of type \JobAreaTecnica or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobAreaTecnica relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function joinJobAreaTecnica($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobAreaTecnica');

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
            $this->addJoinObject($join, 'JobAreaTecnica');
        }

        return $this;
    }

    /**
     * Use the JobAreaTecnica relation JobAreaTecnica object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaTecnicaQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaTecnicaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobAreaTecnica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaTecnica', '\JobAreaTecnicaQuery');
    }

    /**
     * Filter the query by a related \JobProfesion object
     *
     * @param \JobProfesion|ObjectCollection $jobProfesion The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function filterByJobProfesion($jobProfesion, $comparison = null)
    {
        if ($jobProfesion instanceof \JobProfesion) {
            return $this
                ->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $jobProfesion->getId(), $comparison);
        } elseif ($jobProfesion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION, $jobProfesion->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
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
     * @param   ChildJobAreaTecnicaProfesion $jobAreaTecnicaProfesion Object to remove from the list of results
     *
     * @return $this|ChildJobAreaTecnicaProfesionQuery The current query, for fluid interface
     */
    public function prune($jobAreaTecnicaProfesion = null)
    {
        if ($jobAreaTecnicaProfesion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JobAreaTecnicaProfesionTableMap::COL_ID_AREA_TECNICA), $jobAreaTecnicaProfesion->getIdAreaTecnica(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JobAreaTecnicaProfesionTableMap::COL_ID_PROFESION), $jobAreaTecnicaProfesion->getIdProfesion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_area_tecnica_profesion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobAreaTecnicaProfesionTableMap::clearInstancePool();
            JobAreaTecnicaProfesionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobAreaTecnicaProfesionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            JobAreaTecnicaProfesionTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            JobAreaTecnicaProfesionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobAreaTecnicaProfesionQuery
