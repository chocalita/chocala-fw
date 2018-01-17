<?php

namespace Base;

use \JobSuscriptor as ChildJobSuscriptor;
use \JobSuscriptorQuery as ChildJobSuscriptorQuery;
use \Exception;
use \PDO;
use Map\JobSuscriptorTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_suscriptor' table.
 *
 * 
 *
 * @method     ChildJobSuscriptorQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobSuscriptorQuery orderByIdTmpArea($order = Criteria::ASC) Order by the ID_TMP_AREA column
 * @method     ChildJobSuscriptorQuery orderByIdTmpFormacion($order = Criteria::ASC) Order by the ID_TMP_FORMACION column
 * @method     ChildJobSuscriptorQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildJobSuscriptorQuery orderByNombreSimple($order = Criteria::ASC) Order by the NOMBRE_SIMPLE column
 * @method     ChildJobSuscriptorQuery orderByNombres($order = Criteria::ASC) Order by the NOMBRES column
 * @method     ChildJobSuscriptorQuery orderByApellidos($order = Criteria::ASC) Order by the APELLIDOS column
 * @method     ChildJobSuscriptorQuery orderByUbicacion($order = Criteria::ASC) Order by the UBICACION column
 * @method     ChildJobSuscriptorQuery orderByIp($order = Criteria::ASC) Order by the IP column
 * @method     ChildJobSuscriptorQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobSuscriptorQuery orderByConfirmation($order = Criteria::ASC) Order by the CONFIRMATION column
 * @method     ChildJobSuscriptorQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobSuscriptorQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobSuscriptorQuery groupById() Group by the ID column
 * @method     ChildJobSuscriptorQuery groupByIdTmpArea() Group by the ID_TMP_AREA column
 * @method     ChildJobSuscriptorQuery groupByIdTmpFormacion() Group by the ID_TMP_FORMACION column
 * @method     ChildJobSuscriptorQuery groupByEmail() Group by the EMAIL column
 * @method     ChildJobSuscriptorQuery groupByNombreSimple() Group by the NOMBRE_SIMPLE column
 * @method     ChildJobSuscriptorQuery groupByNombres() Group by the NOMBRES column
 * @method     ChildJobSuscriptorQuery groupByApellidos() Group by the APELLIDOS column
 * @method     ChildJobSuscriptorQuery groupByUbicacion() Group by the UBICACION column
 * @method     ChildJobSuscriptorQuery groupByIp() Group by the IP column
 * @method     ChildJobSuscriptorQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobSuscriptorQuery groupByConfirmation() Group by the CONFIRMATION column
 * @method     ChildJobSuscriptorQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobSuscriptorQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobSuscriptorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobSuscriptorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobSuscriptorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobSuscriptorQuery leftJoinTmpArea($relationAlias = null) Adds a LEFT JOIN clause to the query using the TmpArea relation
 * @method     ChildJobSuscriptorQuery rightJoinTmpArea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TmpArea relation
 * @method     ChildJobSuscriptorQuery innerJoinTmpArea($relationAlias = null) Adds a INNER JOIN clause to the query using the TmpArea relation
 *
 * @method     ChildJobSuscriptorQuery leftJoinTmpFormacion($relationAlias = null) Adds a LEFT JOIN clause to the query using the TmpFormacion relation
 * @method     ChildJobSuscriptorQuery rightJoinTmpFormacion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TmpFormacion relation
 * @method     ChildJobSuscriptorQuery innerJoinTmpFormacion($relationAlias = null) Adds a INNER JOIN clause to the query using the TmpFormacion relation
 *
 * @method     \TmpAreaQuery|\TmpFormacionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobSuscriptor findOne(ConnectionInterface $con = null) Return the first ChildJobSuscriptor matching the query
 * @method     ChildJobSuscriptor findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobSuscriptor matching the query, or a new ChildJobSuscriptor object populated from the query conditions when no match is found
 *
 * @method     ChildJobSuscriptor findOneById(int $ID) Return the first ChildJobSuscriptor filtered by the ID column
 * @method     ChildJobSuscriptor findOneByIdTmpArea(int $ID_TMP_AREA) Return the first ChildJobSuscriptor filtered by the ID_TMP_AREA column
 * @method     ChildJobSuscriptor findOneByIdTmpFormacion(int $ID_TMP_FORMACION) Return the first ChildJobSuscriptor filtered by the ID_TMP_FORMACION column
 * @method     ChildJobSuscriptor findOneByEmail(string $EMAIL) Return the first ChildJobSuscriptor filtered by the EMAIL column
 * @method     ChildJobSuscriptor findOneByNombreSimple(string $NOMBRE_SIMPLE) Return the first ChildJobSuscriptor filtered by the NOMBRE_SIMPLE column
 * @method     ChildJobSuscriptor findOneByNombres(string $NOMBRES) Return the first ChildJobSuscriptor filtered by the NOMBRES column
 * @method     ChildJobSuscriptor findOneByApellidos(string $APELLIDOS) Return the first ChildJobSuscriptor filtered by the APELLIDOS column
 * @method     ChildJobSuscriptor findOneByUbicacion(string $UBICACION) Return the first ChildJobSuscriptor filtered by the UBICACION column
 * @method     ChildJobSuscriptor findOneByIp(string $IP) Return the first ChildJobSuscriptor filtered by the IP column
 * @method     ChildJobSuscriptor findOneByStatus(string $STATUS) Return the first ChildJobSuscriptor filtered by the STATUS column
 * @method     ChildJobSuscriptor findOneByConfirmation(string $CONFIRMATION) Return the first ChildJobSuscriptor filtered by the CONFIRMATION column
 * @method     ChildJobSuscriptor findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSuscriptor filtered by the CREATION_DATE column
 * @method     ChildJobSuscriptor findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSuscriptor filtered by the MODIFICATION_DATE column *

 * @method     ChildJobSuscriptor requirePk($key, ConnectionInterface $con = null) Return the ChildJobSuscriptor by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOne(ConnectionInterface $con = null) Return the first ChildJobSuscriptor matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSuscriptor requireOneById(int $ID) Return the first ChildJobSuscriptor filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByIdTmpArea(int $ID_TMP_AREA) Return the first ChildJobSuscriptor filtered by the ID_TMP_AREA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByIdTmpFormacion(int $ID_TMP_FORMACION) Return the first ChildJobSuscriptor filtered by the ID_TMP_FORMACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByEmail(string $EMAIL) Return the first ChildJobSuscriptor filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByNombreSimple(string $NOMBRE_SIMPLE) Return the first ChildJobSuscriptor filtered by the NOMBRE_SIMPLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByNombres(string $NOMBRES) Return the first ChildJobSuscriptor filtered by the NOMBRES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByApellidos(string $APELLIDOS) Return the first ChildJobSuscriptor filtered by the APELLIDOS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByUbicacion(string $UBICACION) Return the first ChildJobSuscriptor filtered by the UBICACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByIp(string $IP) Return the first ChildJobSuscriptor filtered by the IP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByStatus(string $STATUS) Return the first ChildJobSuscriptor filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByConfirmation(string $CONFIRMATION) Return the first ChildJobSuscriptor filtered by the CONFIRMATION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSuscriptor filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSuscriptor requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSuscriptor filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSuscriptor[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobSuscriptor objects based on current ModelCriteria
 * @method     ChildJobSuscriptor[]|ObjectCollection findById(int $ID) Return ChildJobSuscriptor objects filtered by the ID column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByIdTmpArea(int $ID_TMP_AREA) Return ChildJobSuscriptor objects filtered by the ID_TMP_AREA column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByIdTmpFormacion(int $ID_TMP_FORMACION) Return ChildJobSuscriptor objects filtered by the ID_TMP_FORMACION column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByEmail(string $EMAIL) Return ChildJobSuscriptor objects filtered by the EMAIL column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByNombreSimple(string $NOMBRE_SIMPLE) Return ChildJobSuscriptor objects filtered by the NOMBRE_SIMPLE column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByNombres(string $NOMBRES) Return ChildJobSuscriptor objects filtered by the NOMBRES column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByApellidos(string $APELLIDOS) Return ChildJobSuscriptor objects filtered by the APELLIDOS column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByUbicacion(string $UBICACION) Return ChildJobSuscriptor objects filtered by the UBICACION column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByIp(string $IP) Return ChildJobSuscriptor objects filtered by the IP column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobSuscriptor objects filtered by the STATUS column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByConfirmation(string $CONFIRMATION) Return ChildJobSuscriptor objects filtered by the CONFIRMATION column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobSuscriptor objects filtered by the CREATION_DATE column
 * @method     ChildJobSuscriptor[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobSuscriptor objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobSuscriptor[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobSuscriptorQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobSuscriptorQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobSuscriptor', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobSuscriptorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobSuscriptorQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobSuscriptorQuery) {
            return $criteria;
        }
        $query = new ChildJobSuscriptorQuery();
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
     * @return ChildJobSuscriptor|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobSuscriptorTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobSuscriptorTableMap::DATABASE_NAME);
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
     * @return ChildJobSuscriptor A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_TMP_AREA, ID_TMP_FORMACION, EMAIL, NOMBRE_SIMPLE, NOMBRES, APELLIDOS, UBICACION, IP, STATUS, CONFIRMATION, CREATION_DATE, MODIFICATION_DATE FROM job_suscriptor WHERE ID = :p0';
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
            /** @var ChildJobSuscriptor $obj */
            $obj = new ChildJobSuscriptor();
            $obj->hydrate($row);
            JobSuscriptorTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildJobSuscriptor|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_TMP_AREA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTmpArea(1234); // WHERE ID_TMP_AREA = 1234
     * $query->filterByIdTmpArea(array(12, 34)); // WHERE ID_TMP_AREA IN (12, 34)
     * $query->filterByIdTmpArea(array('min' => 12)); // WHERE ID_TMP_AREA > 12
     * </code>
     *
     * @see       filterByTmpArea()
     *
     * @param     mixed $idTmpArea The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByIdTmpArea($idTmpArea = null, $comparison = null)
    {
        if (is_array($idTmpArea)) {
            $useMinMax = false;
            if (isset($idTmpArea['min'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_AREA, $idTmpArea['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTmpArea['max'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_AREA, $idTmpArea['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_AREA, $idTmpArea, $comparison);
    }

    /**
     * Filter the query on the ID_TMP_FORMACION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTmpFormacion(1234); // WHERE ID_TMP_FORMACION = 1234
     * $query->filterByIdTmpFormacion(array(12, 34)); // WHERE ID_TMP_FORMACION IN (12, 34)
     * $query->filterByIdTmpFormacion(array('min' => 12)); // WHERE ID_TMP_FORMACION > 12
     * </code>
     *
     * @see       filterByTmpFormacion()
     *
     * @param     mixed $idTmpFormacion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByIdTmpFormacion($idTmpFormacion = null, $comparison = null)
    {
        if (is_array($idTmpFormacion)) {
            $useMinMax = false;
            if (isset($idTmpFormacion['min'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_FORMACION, $idTmpFormacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTmpFormacion['max'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_FORMACION, $idTmpFormacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_FORMACION, $idTmpFormacion, $comparison);
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the NOMBRE_SIMPLE column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreSimple('fooValue');   // WHERE NOMBRE_SIMPLE = 'fooValue'
     * $query->filterByNombreSimple('%fooValue%'); // WHERE NOMBRE_SIMPLE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreSimple The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByNombreSimple($nombreSimple = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreSimple)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreSimple)) {
                $nombreSimple = str_replace('*', '%', $nombreSimple);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_NOMBRE_SIMPLE, $nombreSimple, $comparison);
    }

    /**
     * Filter the query on the NOMBRES column
     *
     * Example usage:
     * <code>
     * $query->filterByNombres('fooValue');   // WHERE NOMBRES = 'fooValue'
     * $query->filterByNombres('%fooValue%'); // WHERE NOMBRES LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombres The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByNombres($nombres = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombres)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombres)) {
                $nombres = str_replace('*', '%', $nombres);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_NOMBRES, $nombres, $comparison);
    }

    /**
     * Filter the query on the APELLIDOS column
     *
     * Example usage:
     * <code>
     * $query->filterByApellidos('fooValue');   // WHERE APELLIDOS = 'fooValue'
     * $query->filterByApellidos('%fooValue%'); // WHERE APELLIDOS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apellidos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByApellidos($apellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellidos)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $apellidos)) {
                $apellidos = str_replace('*', '%', $apellidos);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_APELLIDOS, $apellidos, $comparison);
    }

    /**
     * Filter the query on the UBICACION column
     *
     * Example usage:
     * <code>
     * $query->filterByUbicacion('fooValue');   // WHERE UBICACION = 'fooValue'
     * $query->filterByUbicacion('%fooValue%'); // WHERE UBICACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ubicacion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByUbicacion($ubicacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ubicacion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ubicacion)) {
                $ubicacion = str_replace('*', '%', $ubicacion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_UBICACION, $ubicacion, $comparison);
    }

    /**
     * Filter the query on the IP column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE IP = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE IP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_IP, $ip, $comparison);
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
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the CONFIRMATION column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmation('2011-03-14'); // WHERE CONFIRMATION = '2011-03-14'
     * $query->filterByConfirmation('now'); // WHERE CONFIRMATION = '2011-03-14'
     * $query->filterByConfirmation(array('max' => 'yesterday')); // WHERE CONFIRMATION > '2011-03-13'
     * </code>
     *
     * @param     mixed $confirmation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByConfirmation($confirmation = null, $comparison = null)
    {
        if (is_array($confirmation)) {
            $useMinMax = false;
            if (isset($confirmation['min'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_CONFIRMATION, $confirmation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($confirmation['max'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_CONFIRMATION, $confirmation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_CONFIRMATION, $confirmation, $comparison);
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
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobSuscriptorTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSuscriptorTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \TmpArea object
     *
     * @param \TmpArea|ObjectCollection $tmpArea The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByTmpArea($tmpArea, $comparison = null)
    {
        if ($tmpArea instanceof \TmpArea) {
            return $this
                ->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_AREA, $tmpArea->getId(), $comparison);
        } elseif ($tmpArea instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_AREA, $tmpArea->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTmpArea() only accepts arguments of type \TmpArea or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TmpArea relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function joinTmpArea($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TmpArea');

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
            $this->addJoinObject($join, 'TmpArea');
        }

        return $this;
    }

    /**
     * Use the TmpArea relation TmpArea object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TmpAreaQuery A secondary query class using the current class as primary query
     */
    public function useTmpAreaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTmpArea($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TmpArea', '\TmpAreaQuery');
    }

    /**
     * Filter the query by a related \TmpFormacion object
     *
     * @param \TmpFormacion|ObjectCollection $tmpFormacion The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function filterByTmpFormacion($tmpFormacion, $comparison = null)
    {
        if ($tmpFormacion instanceof \TmpFormacion) {
            return $this
                ->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_FORMACION, $tmpFormacion->getId(), $comparison);
        } elseif ($tmpFormacion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobSuscriptorTableMap::COL_ID_TMP_FORMACION, $tmpFormacion->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTmpFormacion() only accepts arguments of type \TmpFormacion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TmpFormacion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function joinTmpFormacion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TmpFormacion');

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
            $this->addJoinObject($join, 'TmpFormacion');
        }

        return $this;
    }

    /**
     * Use the TmpFormacion relation TmpFormacion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TmpFormacionQuery A secondary query class using the current class as primary query
     */
    public function useTmpFormacionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTmpFormacion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TmpFormacion', '\TmpFormacionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobSuscriptor $jobSuscriptor Object to remove from the list of results
     *
     * @return $this|ChildJobSuscriptorQuery The current query, for fluid interface
     */
    public function prune($jobSuscriptor = null)
    {
        if ($jobSuscriptor) {
            $this->addUsingAlias(JobSuscriptorTableMap::COL_ID, $jobSuscriptor->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_suscriptor table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSuscriptorTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobSuscriptorTableMap::clearInstancePool();
            JobSuscriptorTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobSuscriptorTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobSuscriptorTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            JobSuscriptorTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            JobSuscriptorTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobSuscriptorQuery
