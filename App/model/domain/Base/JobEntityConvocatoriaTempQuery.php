<?php

namespace Base;

use \JobEntityConvocatoriaTemp as ChildJobEntityConvocatoriaTemp;
use \JobEntityConvocatoriaTempQuery as ChildJobEntityConvocatoriaTempQuery;
use \Exception;
use \PDO;
use Map\JobEntityConvocatoriaTempTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_entity_convocatoria_temp' table.
 *
 * 
 *
 * @method     ChildJobEntityConvocatoriaTempQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByCompanyId($order = Criteria::ASC) Order by the COMPANY_ID column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByAreaId($order = Criteria::ASC) Order by the AREA_ID column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByLocalizacionId($order = Criteria::ASC) Order by the LOCALIZACION_ID column
 * @method     ChildJobEntityConvocatoriaTempQuery orderBySalario($order = Criteria::ASC) Order by the SALARIO column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByCargo($order = Criteria::ASC) Order by the CARGO column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByDescripcion($order = Criteria::ASC) Order by the DESCRIPCION column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByFechaPublicacion($order = Criteria::ASC) Order by the FECHA_PUBLICACION column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByFechaVencimiento($order = Criteria::ASC) Order by the FECHA_VENCIMIENTO column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByEstado($order = Criteria::ASC) Order by the ESTADO column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByUser($order = Criteria::ASC) Order by the USER column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByFechaRegistro($order = Criteria::ASC) Order by the FECHA_REGISTRO column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByCorreoContacto($order = Criteria::ASC) Order by the CORREO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByTelefonoContacto($order = Criteria::ASC) Order by the TELEFONO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTempQuery orderByProfesion($order = Criteria::ASC) Order by the PROFESION column
 *
 * @method     ChildJobEntityConvocatoriaTempQuery groupById() Group by the ID column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByCompanyId() Group by the COMPANY_ID column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByAreaId() Group by the AREA_ID column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByLocalizacionId() Group by the LOCALIZACION_ID column
 * @method     ChildJobEntityConvocatoriaTempQuery groupBySalario() Group by the SALARIO column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByCargo() Group by the CARGO column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByDescripcion() Group by the DESCRIPCION column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByFechaPublicacion() Group by the FECHA_PUBLICACION column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByFechaVencimiento() Group by the FECHA_VENCIMIENTO column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByEstado() Group by the ESTADO column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByUser() Group by the USER column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByFechaRegistro() Group by the FECHA_REGISTRO column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByCorreoContacto() Group by the CORREO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByTelefonoContacto() Group by the TELEFONO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTempQuery groupByProfesion() Group by the PROFESION column
 *
 * @method     ChildJobEntityConvocatoriaTempQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobEntityConvocatoriaTempQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobEntityConvocatoriaTempQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobEntityConvocatoriaTemp findOne(ConnectionInterface $con = null) Return the first ChildJobEntityConvocatoriaTemp matching the query
 * @method     ChildJobEntityConvocatoriaTemp findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobEntityConvocatoriaTemp matching the query, or a new ChildJobEntityConvocatoriaTemp object populated from the query conditions when no match is found
 *
 * @method     ChildJobEntityConvocatoriaTemp findOneById(int $ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the ID column
 * @method     ChildJobEntityConvocatoriaTemp findOneByCompanyId(int $COMPANY_ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the COMPANY_ID column
 * @method     ChildJobEntityConvocatoriaTemp findOneByAreaId(int $AREA_ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the AREA_ID column
 * @method     ChildJobEntityConvocatoriaTemp findOneByLocalizacionId(int $LOCALIZACION_ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the LOCALIZACION_ID column
 * @method     ChildJobEntityConvocatoriaTemp findOneBySalario(string $SALARIO) Return the first ChildJobEntityConvocatoriaTemp filtered by the SALARIO column
 * @method     ChildJobEntityConvocatoriaTemp findOneByCargo(string $CARGO) Return the first ChildJobEntityConvocatoriaTemp filtered by the CARGO column
 * @method     ChildJobEntityConvocatoriaTemp findOneByDescripcion(string $DESCRIPCION) Return the first ChildJobEntityConvocatoriaTemp filtered by the DESCRIPCION column
 * @method     ChildJobEntityConvocatoriaTemp findOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobEntityConvocatoriaTemp filtered by the FECHA_PUBLICACION column
 * @method     ChildJobEntityConvocatoriaTemp findOneByFechaVencimiento(string $FECHA_VENCIMIENTO) Return the first ChildJobEntityConvocatoriaTemp filtered by the FECHA_VENCIMIENTO column
 * @method     ChildJobEntityConvocatoriaTemp findOneByEstado(string $ESTADO) Return the first ChildJobEntityConvocatoriaTemp filtered by the ESTADO column
 * @method     ChildJobEntityConvocatoriaTemp findOneByUser(string $USER) Return the first ChildJobEntityConvocatoriaTemp filtered by the USER column
 * @method     ChildJobEntityConvocatoriaTemp findOneByFechaRegistro(string $FECHA_REGISTRO) Return the first ChildJobEntityConvocatoriaTemp filtered by the FECHA_REGISTRO column
 * @method     ChildJobEntityConvocatoriaTemp findOneByCorreoContacto(string $CORREO_CONTACTO) Return the first ChildJobEntityConvocatoriaTemp filtered by the CORREO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTemp findOneByTelefonoContacto(int $TELEFONO_CONTACTO) Return the first ChildJobEntityConvocatoriaTemp filtered by the TELEFONO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTemp findOneByProfesion(string $PROFESION) Return the first ChildJobEntityConvocatoriaTemp filtered by the PROFESION column *

 * @method     ChildJobEntityConvocatoriaTemp requirePk($key, ConnectionInterface $con = null) Return the ChildJobEntityConvocatoriaTemp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOne(ConnectionInterface $con = null) Return the first ChildJobEntityConvocatoriaTemp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobEntityConvocatoriaTemp requireOneById(int $ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByCompanyId(int $COMPANY_ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the COMPANY_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByAreaId(int $AREA_ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the AREA_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByLocalizacionId(int $LOCALIZACION_ID) Return the first ChildJobEntityConvocatoriaTemp filtered by the LOCALIZACION_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneBySalario(string $SALARIO) Return the first ChildJobEntityConvocatoriaTemp filtered by the SALARIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByCargo(string $CARGO) Return the first ChildJobEntityConvocatoriaTemp filtered by the CARGO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByDescripcion(string $DESCRIPCION) Return the first ChildJobEntityConvocatoriaTemp filtered by the DESCRIPCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobEntityConvocatoriaTemp filtered by the FECHA_PUBLICACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByFechaVencimiento(string $FECHA_VENCIMIENTO) Return the first ChildJobEntityConvocatoriaTemp filtered by the FECHA_VENCIMIENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByEstado(string $ESTADO) Return the first ChildJobEntityConvocatoriaTemp filtered by the ESTADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByUser(string $USER) Return the first ChildJobEntityConvocatoriaTemp filtered by the USER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByFechaRegistro(string $FECHA_REGISTRO) Return the first ChildJobEntityConvocatoriaTemp filtered by the FECHA_REGISTRO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByCorreoContacto(string $CORREO_CONTACTO) Return the first ChildJobEntityConvocatoriaTemp filtered by the CORREO_CONTACTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByTelefonoContacto(int $TELEFONO_CONTACTO) Return the first ChildJobEntityConvocatoriaTemp filtered by the TELEFONO_CONTACTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEntityConvocatoriaTemp requireOneByProfesion(string $PROFESION) Return the first ChildJobEntityConvocatoriaTemp filtered by the PROFESION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobEntityConvocatoriaTemp objects based on current ModelCriteria
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findById(int $ID) Return ChildJobEntityConvocatoriaTemp objects filtered by the ID column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByCompanyId(int $COMPANY_ID) Return ChildJobEntityConvocatoriaTemp objects filtered by the COMPANY_ID column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByAreaId(int $AREA_ID) Return ChildJobEntityConvocatoriaTemp objects filtered by the AREA_ID column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByLocalizacionId(int $LOCALIZACION_ID) Return ChildJobEntityConvocatoriaTemp objects filtered by the LOCALIZACION_ID column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findBySalario(string $SALARIO) Return ChildJobEntityConvocatoriaTemp objects filtered by the SALARIO column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByCargo(string $CARGO) Return ChildJobEntityConvocatoriaTemp objects filtered by the CARGO column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByDescripcion(string $DESCRIPCION) Return ChildJobEntityConvocatoriaTemp objects filtered by the DESCRIPCION column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByFechaPublicacion(string $FECHA_PUBLICACION) Return ChildJobEntityConvocatoriaTemp objects filtered by the FECHA_PUBLICACION column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByFechaVencimiento(string $FECHA_VENCIMIENTO) Return ChildJobEntityConvocatoriaTemp objects filtered by the FECHA_VENCIMIENTO column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByEstado(string $ESTADO) Return ChildJobEntityConvocatoriaTemp objects filtered by the ESTADO column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByUser(string $USER) Return ChildJobEntityConvocatoriaTemp objects filtered by the USER column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByFechaRegistro(string $FECHA_REGISTRO) Return ChildJobEntityConvocatoriaTemp objects filtered by the FECHA_REGISTRO column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByCorreoContacto(string $CORREO_CONTACTO) Return ChildJobEntityConvocatoriaTemp objects filtered by the CORREO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByTelefonoContacto(int $TELEFONO_CONTACTO) Return ChildJobEntityConvocatoriaTemp objects filtered by the TELEFONO_CONTACTO column
 * @method     ChildJobEntityConvocatoriaTemp[]|ObjectCollection findByProfesion(string $PROFESION) Return ChildJobEntityConvocatoriaTemp objects filtered by the PROFESION column
 * @method     ChildJobEntityConvocatoriaTemp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobEntityConvocatoriaTempQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobEntityConvocatoriaTempQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobEntityConvocatoriaTemp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobEntityConvocatoriaTempQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobEntityConvocatoriaTempQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobEntityConvocatoriaTempQuery) {
            return $criteria;
        }
        $query = new ChildJobEntityConvocatoriaTempQuery();
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
     * @return ChildJobEntityConvocatoriaTemp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobEntityConvocatoriaTempTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
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
     * @return ChildJobEntityConvocatoriaTemp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, COMPANY_ID, AREA_ID, LOCALIZACION_ID, SALARIO, CARGO, DESCRIPCION, FECHA_PUBLICACION, FECHA_VENCIMIENTO, ESTADO, USER, FECHA_REGISTRO, CORREO_CONTACTO, TELEFONO_CONTACTO, PROFESION FROM job_entity_convocatoria_temp WHERE ID = :p0';
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
            /** @var ChildJobEntityConvocatoriaTemp $obj */
            $obj = new ChildJobEntityConvocatoriaTemp();
            $obj->hydrate($row);
            JobEntityConvocatoriaTempTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildJobEntityConvocatoriaTemp|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the COMPANY_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyId(1234); // WHERE COMPANY_ID = 1234
     * $query->filterByCompanyId(array(12, 34)); // WHERE COMPANY_ID IN (12, 34)
     * $query->filterByCompanyId(array('min' => 12)); // WHERE COMPANY_ID > 12
     * </code>
     *
     * @param     mixed $companyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByCompanyId($companyId = null, $comparison = null)
    {
        if (is_array($companyId)) {
            $useMinMax = false;
            if (isset($companyId['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID, $companyId, $comparison);
    }

    /**
     * Filter the query on the AREA_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByAreaId(1234); // WHERE AREA_ID = 1234
     * $query->filterByAreaId(array(12, 34)); // WHERE AREA_ID IN (12, 34)
     * $query->filterByAreaId(array('min' => 12)); // WHERE AREA_ID > 12
     * </code>
     *
     * @param     mixed $areaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByAreaId($areaId = null, $comparison = null)
    {
        if (is_array($areaId)) {
            $useMinMax = false;
            if (isset($areaId['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_AREA_ID, $areaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($areaId['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_AREA_ID, $areaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_AREA_ID, $areaId, $comparison);
    }

    /**
     * Filter the query on the LOCALIZACION_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLocalizacionId(1234); // WHERE LOCALIZACION_ID = 1234
     * $query->filterByLocalizacionId(array(12, 34)); // WHERE LOCALIZACION_ID IN (12, 34)
     * $query->filterByLocalizacionId(array('min' => 12)); // WHERE LOCALIZACION_ID > 12
     * </code>
     *
     * @param     mixed $localizacionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByLocalizacionId($localizacionId = null, $comparison = null)
    {
        if (is_array($localizacionId)) {
            $useMinMax = false;
            if (isset($localizacionId['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID, $localizacionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($localizacionId['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID, $localizacionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID, $localizacionId, $comparison);
    }

    /**
     * Filter the query on the SALARIO column
     *
     * Example usage:
     * <code>
     * $query->filterBySalario(1234); // WHERE SALARIO = 1234
     * $query->filterBySalario(array(12, 34)); // WHERE SALARIO IN (12, 34)
     * $query->filterBySalario(array('min' => 12)); // WHERE SALARIO > 12
     * </code>
     *
     * @param     mixed $salario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterBySalario($salario = null, $comparison = null)
    {
        if (is_array($salario)) {
            $useMinMax = false;
            if (isset($salario['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_SALARIO, $salario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salario['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_SALARIO, $salario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_SALARIO, $salario, $comparison);
    }

    /**
     * Filter the query on the CARGO column
     *
     * Example usage:
     * <code>
     * $query->filterByCargo('fooValue');   // WHERE CARGO = 'fooValue'
     * $query->filterByCargo('%fooValue%'); // WHERE CARGO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cargo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByCargo($cargo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cargo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cargo)) {
                $cargo = str_replace('*', '%', $cargo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_CARGO, $cargo, $comparison);
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
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the FECHA_PUBLICACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaPublicacion('2011-03-14'); // WHERE FECHA_PUBLICACION = '2011-03-14'
     * $query->filterByFechaPublicacion('now'); // WHERE FECHA_PUBLICACION = '2011-03-14'
     * $query->filterByFechaPublicacion(array('max' => 'yesterday')); // WHERE FECHA_PUBLICACION > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaPublicacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByFechaPublicacion($fechaPublicacion = null, $comparison = null)
    {
        if (is_array($fechaPublicacion)) {
            $useMinMax = false;
            if (isset($fechaPublicacion['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPublicacion['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion, $comparison);
    }

    /**
     * Filter the query on the FECHA_VENCIMIENTO column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaVencimiento('2011-03-14'); // WHERE FECHA_VENCIMIENTO = '2011-03-14'
     * $query->filterByFechaVencimiento('now'); // WHERE FECHA_VENCIMIENTO = '2011-03-14'
     * $query->filterByFechaVencimiento(array('max' => 'yesterday')); // WHERE FECHA_VENCIMIENTO > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaVencimiento The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByFechaVencimiento($fechaVencimiento = null, $comparison = null)
    {
        if (is_array($fechaVencimiento)) {
            $useMinMax = false;
            if (isset($fechaVencimiento['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO, $fechaVencimiento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaVencimiento['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO, $fechaVencimiento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO, $fechaVencimiento, $comparison);
    }

    /**
     * Filter the query on the ESTADO column
     *
     * Example usage:
     * <code>
     * $query->filterByEstado('fooValue');   // WHERE ESTADO = 'fooValue'
     * $query->filterByEstado('%fooValue%'); // WHERE ESTADO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estado The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estado)) {
                $estado = str_replace('*', '%', $estado);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query on the USER column
     *
     * Example usage:
     * <code>
     * $query->filterByUser('fooValue');   // WHERE USER = 'fooValue'
     * $query->filterByUser('%fooValue%'); // WHERE USER LIKE '%fooValue%'
     * </code>
     *
     * @param     string $user The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByUser($user = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($user)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $user)) {
                $user = str_replace('*', '%', $user);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_USER, $user, $comparison);
    }

    /**
     * Filter the query on the FECHA_REGISTRO column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaRegistro('2011-03-14'); // WHERE FECHA_REGISTRO = '2011-03-14'
     * $query->filterByFechaRegistro('now'); // WHERE FECHA_REGISTRO = '2011-03-14'
     * $query->filterByFechaRegistro(array('max' => 'yesterday')); // WHERE FECHA_REGISTRO > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaRegistro The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByFechaRegistro($fechaRegistro = null, $comparison = null)
    {
        if (is_array($fechaRegistro)) {
            $useMinMax = false;
            if (isset($fechaRegistro['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO, $fechaRegistro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaRegistro['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO, $fechaRegistro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO, $fechaRegistro, $comparison);
    }

    /**
     * Filter the query on the CORREO_CONTACTO column
     *
     * Example usage:
     * <code>
     * $query->filterByCorreoContacto('fooValue');   // WHERE CORREO_CONTACTO = 'fooValue'
     * $query->filterByCorreoContacto('%fooValue%'); // WHERE CORREO_CONTACTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $correoContacto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByCorreoContacto($correoContacto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($correoContacto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $correoContacto)) {
                $correoContacto = str_replace('*', '%', $correoContacto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO, $correoContacto, $comparison);
    }

    /**
     * Filter the query on the TELEFONO_CONTACTO column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonoContacto(1234); // WHERE TELEFONO_CONTACTO = 1234
     * $query->filterByTelefonoContacto(array(12, 34)); // WHERE TELEFONO_CONTACTO IN (12, 34)
     * $query->filterByTelefonoContacto(array('min' => 12)); // WHERE TELEFONO_CONTACTO > 12
     * </code>
     *
     * @param     mixed $telefonoContacto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByTelefonoContacto($telefonoContacto = null, $comparison = null)
    {
        if (is_array($telefonoContacto)) {
            $useMinMax = false;
            if (isset($telefonoContacto['min'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO, $telefonoContacto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($telefonoContacto['max'])) {
                $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO, $telefonoContacto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO, $telefonoContacto, $comparison);
    }

    /**
     * Filter the query on the PROFESION column
     *
     * Example usage:
     * <code>
     * $query->filterByProfesion('fooValue');   // WHERE PROFESION = 'fooValue'
     * $query->filterByProfesion('%fooValue%'); // WHERE PROFESION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $profesion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function filterByProfesion($profesion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($profesion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $profesion)) {
                $profesion = str_replace('*', '%', $profesion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_PROFESION, $profesion, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobEntityConvocatoriaTemp $jobEntityConvocatoriaTemp Object to remove from the list of results
     *
     * @return $this|ChildJobEntityConvocatoriaTempQuery The current query, for fluid interface
     */
    public function prune($jobEntityConvocatoriaTemp = null)
    {
        if ($jobEntityConvocatoriaTemp) {
            $this->addUsingAlias(JobEntityConvocatoriaTempTableMap::COL_ID, $jobEntityConvocatoriaTemp->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_entity_convocatoria_temp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobEntityConvocatoriaTempTableMap::clearInstancePool();
            JobEntityConvocatoriaTempTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            JobEntityConvocatoriaTempTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            JobEntityConvocatoriaTempTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobEntityConvocatoriaTempQuery
