<?php

namespace Base;

use \JobPostulante as ChildJobPostulante;
use \JobPostulanteQuery as ChildJobPostulanteQuery;
use \Exception;
use \PDO;
use Map\JobPostulanteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_postulante' table.
 *
 *
 *
 * @method     ChildJobPostulanteQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobPostulanteQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildJobPostulanteQuery orderByLocationId($order = Criteria::ASC) Order by the LOCATION_ID column
 * @method     ChildJobPostulanteQuery orderByEstado($order = Criteria::ASC) Order by the ESTADO column
 * @method     ChildJobPostulanteQuery orderByNombres($order = Criteria::ASC) Order by the NOMBRES column
 * @method     ChildJobPostulanteQuery orderByApellido1($order = Criteria::ASC) Order by the APELLIDO1 column
 * @method     ChildJobPostulanteQuery orderByApellido2($order = Criteria::ASC) Order by the APELLIDO2 column
 * @method     ChildJobPostulanteQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildJobPostulanteQuery orderByCi($order = Criteria::ASC) Order by the CI column
 * @method     ChildJobPostulanteQuery orderByCiExpedido($order = Criteria::ASC) Order by the CI_EXPEDIDO column
 * @method     ChildJobPostulanteQuery orderBySexo($order = Criteria::ASC) Order by the SEXO column
 * @method     ChildJobPostulanteQuery orderByFechaNacimiento($order = Criteria::ASC) Order by the FECHA_NACIMIENTO column
 * @method     ChildJobPostulanteQuery orderByLugarNacimiento($order = Criteria::ASC) Order by the LUGAR_NACIMIENTO column
 * @method     ChildJobPostulanteQuery orderByDireccion($order = Criteria::ASC) Order by the DIRECCION column
 * @method     ChildJobPostulanteQuery orderByCiudad($order = Criteria::ASC) Order by the CIUDAD column
 * @method     ChildJobPostulanteQuery orderByTelefonoDomicilio($order = Criteria::ASC) Order by the TELEFONO_DOMICILIO column
 * @method     ChildJobPostulanteQuery orderByTelefonoTrabajo($order = Criteria::ASC) Order by the TELEFONO_TRABAJO column
 * @method     ChildJobPostulanteQuery orderByCelular1($order = Criteria::ASC) Order by the CELULAR_1 column
 * @method     ChildJobPostulanteQuery orderByCelular2($order = Criteria::ASC) Order by the CELULAR_2 column
 * @method     ChildJobPostulanteQuery orderByMimeFoto($order = Criteria::ASC) Order by the MIME_FOTO column
 * @method     ChildJobPostulanteQuery orderByPretensionSalarial($order = Criteria::ASC) Order by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulanteQuery orderByFechaUltimaPostulacion($order = Criteria::ASC) Order by the FECHA_ULTIMA_POSTULACION column
 * @method     ChildJobPostulanteQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobPostulanteQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobPostulanteQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobPostulanteQuery groupById() Group by the ID column
 * @method     ChildJobPostulanteQuery groupByUserId() Group by the USER_ID column
 * @method     ChildJobPostulanteQuery groupByLocationId() Group by the LOCATION_ID column
 * @method     ChildJobPostulanteQuery groupByEstado() Group by the ESTADO column
 * @method     ChildJobPostulanteQuery groupByNombres() Group by the NOMBRES column
 * @method     ChildJobPostulanteQuery groupByApellido1() Group by the APELLIDO1 column
 * @method     ChildJobPostulanteQuery groupByApellido2() Group by the APELLIDO2 column
 * @method     ChildJobPostulanteQuery groupByEmail() Group by the EMAIL column
 * @method     ChildJobPostulanteQuery groupByCi() Group by the CI column
 * @method     ChildJobPostulanteQuery groupByCiExpedido() Group by the CI_EXPEDIDO column
 * @method     ChildJobPostulanteQuery groupBySexo() Group by the SEXO column
 * @method     ChildJobPostulanteQuery groupByFechaNacimiento() Group by the FECHA_NACIMIENTO column
 * @method     ChildJobPostulanteQuery groupByLugarNacimiento() Group by the LUGAR_NACIMIENTO column
 * @method     ChildJobPostulanteQuery groupByDireccion() Group by the DIRECCION column
 * @method     ChildJobPostulanteQuery groupByCiudad() Group by the CIUDAD column
 * @method     ChildJobPostulanteQuery groupByTelefonoDomicilio() Group by the TELEFONO_DOMICILIO column
 * @method     ChildJobPostulanteQuery groupByTelefonoTrabajo() Group by the TELEFONO_TRABAJO column
 * @method     ChildJobPostulanteQuery groupByCelular1() Group by the CELULAR_1 column
 * @method     ChildJobPostulanteQuery groupByCelular2() Group by the CELULAR_2 column
 * @method     ChildJobPostulanteQuery groupByMimeFoto() Group by the MIME_FOTO column
 * @method     ChildJobPostulanteQuery groupByPretensionSalarial() Group by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulanteQuery groupByFechaUltimaPostulacion() Group by the FECHA_ULTIMA_POSTULACION column
 * @method     ChildJobPostulanteQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobPostulanteQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobPostulanteQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobPostulanteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobPostulanteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobPostulanteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobPostulanteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobPostulanteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobPostulanteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobPostulanteQuery leftJoinJobPostulanteAviso($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobPostulanteAviso relation
 * @method     ChildJobPostulanteQuery rightJoinJobPostulanteAviso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobPostulanteAviso relation
 * @method     ChildJobPostulanteQuery innerJoinJobPostulanteAviso($relationAlias = null) Adds a INNER JOIN clause to the query using the JobPostulanteAviso relation
 *
 * @method     ChildJobPostulanteQuery joinWithJobPostulanteAviso($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobPostulanteAviso relation
 *
 * @method     ChildJobPostulanteQuery leftJoinWithJobPostulanteAviso() Adds a LEFT JOIN clause and with to the query using the JobPostulanteAviso relation
 * @method     ChildJobPostulanteQuery rightJoinWithJobPostulanteAviso() Adds a RIGHT JOIN clause and with to the query using the JobPostulanteAviso relation
 * @method     ChildJobPostulanteQuery innerJoinWithJobPostulanteAviso() Adds a INNER JOIN clause and with to the query using the JobPostulanteAviso relation
 *
 * @method     ChildJobPostulanteQuery leftJoinJobSuscriptor($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobSuscriptor relation
 * @method     ChildJobPostulanteQuery rightJoinJobSuscriptor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobSuscriptor relation
 * @method     ChildJobPostulanteQuery innerJoinJobSuscriptor($relationAlias = null) Adds a INNER JOIN clause to the query using the JobSuscriptor relation
 *
 * @method     ChildJobPostulanteQuery joinWithJobSuscriptor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobSuscriptor relation
 *
 * @method     ChildJobPostulanteQuery leftJoinWithJobSuscriptor() Adds a LEFT JOIN clause and with to the query using the JobSuscriptor relation
 * @method     ChildJobPostulanteQuery rightJoinWithJobSuscriptor() Adds a RIGHT JOIN clause and with to the query using the JobSuscriptor relation
 * @method     ChildJobPostulanteQuery innerJoinWithJobSuscriptor() Adds a INNER JOIN clause and with to the query using the JobSuscriptor relation
 *
 * @method     \JobPostulanteAvisoQuery|\JobSuscriptorQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobPostulante findOne(ConnectionInterface $con = null) Return the first ChildJobPostulante matching the query
 * @method     ChildJobPostulante findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobPostulante matching the query, or a new ChildJobPostulante object populated from the query conditions when no match is found
 *
 * @method     ChildJobPostulante findOneById(int $ID) Return the first ChildJobPostulante filtered by the ID column
 * @method     ChildJobPostulante findOneByUserId(int $USER_ID) Return the first ChildJobPostulante filtered by the USER_ID column
 * @method     ChildJobPostulante findOneByLocationId(int $LOCATION_ID) Return the first ChildJobPostulante filtered by the LOCATION_ID column
 * @method     ChildJobPostulante findOneByEstado(string $ESTADO) Return the first ChildJobPostulante filtered by the ESTADO column
 * @method     ChildJobPostulante findOneByNombres(string $NOMBRES) Return the first ChildJobPostulante filtered by the NOMBRES column
 * @method     ChildJobPostulante findOneByApellido1(string $APELLIDO1) Return the first ChildJobPostulante filtered by the APELLIDO1 column
 * @method     ChildJobPostulante findOneByApellido2(string $APELLIDO2) Return the first ChildJobPostulante filtered by the APELLIDO2 column
 * @method     ChildJobPostulante findOneByEmail(string $EMAIL) Return the first ChildJobPostulante filtered by the EMAIL column
 * @method     ChildJobPostulante findOneByCi(string $CI) Return the first ChildJobPostulante filtered by the CI column
 * @method     ChildJobPostulante findOneByCiExpedido(string $CI_EXPEDIDO) Return the first ChildJobPostulante filtered by the CI_EXPEDIDO column
 * @method     ChildJobPostulante findOneBySexo(string $SEXO) Return the first ChildJobPostulante filtered by the SEXO column
 * @method     ChildJobPostulante findOneByFechaNacimiento(string $FECHA_NACIMIENTO) Return the first ChildJobPostulante filtered by the FECHA_NACIMIENTO column
 * @method     ChildJobPostulante findOneByLugarNacimiento(string $LUGAR_NACIMIENTO) Return the first ChildJobPostulante filtered by the LUGAR_NACIMIENTO column
 * @method     ChildJobPostulante findOneByDireccion(string $DIRECCION) Return the first ChildJobPostulante filtered by the DIRECCION column
 * @method     ChildJobPostulante findOneByCiudad(string $CIUDAD) Return the first ChildJobPostulante filtered by the CIUDAD column
 * @method     ChildJobPostulante findOneByTelefonoDomicilio(string $TELEFONO_DOMICILIO) Return the first ChildJobPostulante filtered by the TELEFONO_DOMICILIO column
 * @method     ChildJobPostulante findOneByTelefonoTrabajo(string $TELEFONO_TRABAJO) Return the first ChildJobPostulante filtered by the TELEFONO_TRABAJO column
 * @method     ChildJobPostulante findOneByCelular1(string $CELULAR_1) Return the first ChildJobPostulante filtered by the CELULAR_1 column
 * @method     ChildJobPostulante findOneByCelular2(string $CELULAR_2) Return the first ChildJobPostulante filtered by the CELULAR_2 column
 * @method     ChildJobPostulante findOneByMimeFoto(string $MIME_FOTO) Return the first ChildJobPostulante filtered by the MIME_FOTO column
 * @method     ChildJobPostulante findOneByPretensionSalarial(int $PRETENSION_SALARIAL) Return the first ChildJobPostulante filtered by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulante findOneByFechaUltimaPostulacion(string $FECHA_ULTIMA_POSTULACION) Return the first ChildJobPostulante filtered by the FECHA_ULTIMA_POSTULACION column
 * @method     ChildJobPostulante findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobPostulante filtered by the LAST_USER_ID column
 * @method     ChildJobPostulante findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobPostulante filtered by the CREATION_DATE column
 * @method     ChildJobPostulante findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobPostulante filtered by the MODIFICATION_DATE column *

 * @method     ChildJobPostulante requirePk($key, ConnectionInterface $con = null) Return the ChildJobPostulante by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOne(ConnectionInterface $con = null) Return the first ChildJobPostulante matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobPostulante requireOneById(int $ID) Return the first ChildJobPostulante filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByUserId(int $USER_ID) Return the first ChildJobPostulante filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByLocationId(int $LOCATION_ID) Return the first ChildJobPostulante filtered by the LOCATION_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByEstado(string $ESTADO) Return the first ChildJobPostulante filtered by the ESTADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByNombres(string $NOMBRES) Return the first ChildJobPostulante filtered by the NOMBRES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByApellido1(string $APELLIDO1) Return the first ChildJobPostulante filtered by the APELLIDO1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByApellido2(string $APELLIDO2) Return the first ChildJobPostulante filtered by the APELLIDO2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByEmail(string $EMAIL) Return the first ChildJobPostulante filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByCi(string $CI) Return the first ChildJobPostulante filtered by the CI column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByCiExpedido(string $CI_EXPEDIDO) Return the first ChildJobPostulante filtered by the CI_EXPEDIDO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneBySexo(string $SEXO) Return the first ChildJobPostulante filtered by the SEXO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByFechaNacimiento(string $FECHA_NACIMIENTO) Return the first ChildJobPostulante filtered by the FECHA_NACIMIENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByLugarNacimiento(string $LUGAR_NACIMIENTO) Return the first ChildJobPostulante filtered by the LUGAR_NACIMIENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByDireccion(string $DIRECCION) Return the first ChildJobPostulante filtered by the DIRECCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByCiudad(string $CIUDAD) Return the first ChildJobPostulante filtered by the CIUDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByTelefonoDomicilio(string $TELEFONO_DOMICILIO) Return the first ChildJobPostulante filtered by the TELEFONO_DOMICILIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByTelefonoTrabajo(string $TELEFONO_TRABAJO) Return the first ChildJobPostulante filtered by the TELEFONO_TRABAJO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByCelular1(string $CELULAR_1) Return the first ChildJobPostulante filtered by the CELULAR_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByCelular2(string $CELULAR_2) Return the first ChildJobPostulante filtered by the CELULAR_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByMimeFoto(string $MIME_FOTO) Return the first ChildJobPostulante filtered by the MIME_FOTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByPretensionSalarial(int $PRETENSION_SALARIAL) Return the first ChildJobPostulante filtered by the PRETENSION_SALARIAL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByFechaUltimaPostulacion(string $FECHA_ULTIMA_POSTULACION) Return the first ChildJobPostulante filtered by the FECHA_ULTIMA_POSTULACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobPostulante filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobPostulante filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobPostulante requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobPostulante filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobPostulante[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobPostulante objects based on current ModelCriteria
 * @method     ChildJobPostulante[]|ObjectCollection findById(int $ID) Return ChildJobPostulante objects filtered by the ID column
 * @method     ChildJobPostulante[]|ObjectCollection findByUserId(int $USER_ID) Return ChildJobPostulante objects filtered by the USER_ID column
 * @method     ChildJobPostulante[]|ObjectCollection findByLocationId(int $LOCATION_ID) Return ChildJobPostulante objects filtered by the LOCATION_ID column
 * @method     ChildJobPostulante[]|ObjectCollection findByEstado(string $ESTADO) Return ChildJobPostulante objects filtered by the ESTADO column
 * @method     ChildJobPostulante[]|ObjectCollection findByNombres(string $NOMBRES) Return ChildJobPostulante objects filtered by the NOMBRES column
 * @method     ChildJobPostulante[]|ObjectCollection findByApellido1(string $APELLIDO1) Return ChildJobPostulante objects filtered by the APELLIDO1 column
 * @method     ChildJobPostulante[]|ObjectCollection findByApellido2(string $APELLIDO2) Return ChildJobPostulante objects filtered by the APELLIDO2 column
 * @method     ChildJobPostulante[]|ObjectCollection findByEmail(string $EMAIL) Return ChildJobPostulante objects filtered by the EMAIL column
 * @method     ChildJobPostulante[]|ObjectCollection findByCi(string $CI) Return ChildJobPostulante objects filtered by the CI column
 * @method     ChildJobPostulante[]|ObjectCollection findByCiExpedido(string $CI_EXPEDIDO) Return ChildJobPostulante objects filtered by the CI_EXPEDIDO column
 * @method     ChildJobPostulante[]|ObjectCollection findBySexo(string $SEXO) Return ChildJobPostulante objects filtered by the SEXO column
 * @method     ChildJobPostulante[]|ObjectCollection findByFechaNacimiento(string $FECHA_NACIMIENTO) Return ChildJobPostulante objects filtered by the FECHA_NACIMIENTO column
 * @method     ChildJobPostulante[]|ObjectCollection findByLugarNacimiento(string $LUGAR_NACIMIENTO) Return ChildJobPostulante objects filtered by the LUGAR_NACIMIENTO column
 * @method     ChildJobPostulante[]|ObjectCollection findByDireccion(string $DIRECCION) Return ChildJobPostulante objects filtered by the DIRECCION column
 * @method     ChildJobPostulante[]|ObjectCollection findByCiudad(string $CIUDAD) Return ChildJobPostulante objects filtered by the CIUDAD column
 * @method     ChildJobPostulante[]|ObjectCollection findByTelefonoDomicilio(string $TELEFONO_DOMICILIO) Return ChildJobPostulante objects filtered by the TELEFONO_DOMICILIO column
 * @method     ChildJobPostulante[]|ObjectCollection findByTelefonoTrabajo(string $TELEFONO_TRABAJO) Return ChildJobPostulante objects filtered by the TELEFONO_TRABAJO column
 * @method     ChildJobPostulante[]|ObjectCollection findByCelular1(string $CELULAR_1) Return ChildJobPostulante objects filtered by the CELULAR_1 column
 * @method     ChildJobPostulante[]|ObjectCollection findByCelular2(string $CELULAR_2) Return ChildJobPostulante objects filtered by the CELULAR_2 column
 * @method     ChildJobPostulante[]|ObjectCollection findByMimeFoto(string $MIME_FOTO) Return ChildJobPostulante objects filtered by the MIME_FOTO column
 * @method     ChildJobPostulante[]|ObjectCollection findByPretensionSalarial(int $PRETENSION_SALARIAL) Return ChildJobPostulante objects filtered by the PRETENSION_SALARIAL column
 * @method     ChildJobPostulante[]|ObjectCollection findByFechaUltimaPostulacion(string $FECHA_ULTIMA_POSTULACION) Return ChildJobPostulante objects filtered by the FECHA_ULTIMA_POSTULACION column
 * @method     ChildJobPostulante[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobPostulante objects filtered by the LAST_USER_ID column
 * @method     ChildJobPostulante[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobPostulante objects filtered by the CREATION_DATE column
 * @method     ChildJobPostulante[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobPostulante objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobPostulante[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobPostulanteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobPostulanteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobPostulante', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobPostulanteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobPostulanteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobPostulanteQuery) {
            return $criteria;
        }
        $query = new ChildJobPostulanteQuery();
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
     * @return ChildJobPostulante|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobPostulanteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobPostulanteTableMap::DATABASE_NAME);
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
     * @return ChildJobPostulante A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, USER_ID, LOCATION_ID, ESTADO, NOMBRES, APELLIDO1, APELLIDO2, EMAIL, CI, CI_EXPEDIDO, SEXO, FECHA_NACIMIENTO, LUGAR_NACIMIENTO, DIRECCION, CIUDAD, TELEFONO_DOMICILIO, TELEFONO_TRABAJO, CELULAR_1, CELULAR_2, MIME_FOTO, PRETENSION_SALARIAL, FECHA_ULTIMA_POSTULACION, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_postulante WHERE ID = :p0';
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
            /** @var ChildJobPostulante $obj */
            $obj = new ChildJobPostulante();
            $obj->hydrate($row);
            JobPostulanteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobPostulante|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobPostulanteTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobPostulanteTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_ID, $id, $comparison);
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
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the LOCATION_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationId(1234); // WHERE LOCATION_ID = 1234
     * $query->filterByLocationId(array(12, 34)); // WHERE LOCATION_ID IN (12, 34)
     * $query->filterByLocationId(array('min' => 12)); // WHERE LOCATION_ID > 12
     * </code>
     *
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_LOCATION_ID, $locationId, $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobPostulanteTableMap::COL_ESTADO, $estado, $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobPostulanteTableMap::COL_NOMBRES, $nombres, $comparison);
    }

    /**
     * Filter the query on the APELLIDO1 column
     *
     * Example usage:
     * <code>
     * $query->filterByApellido1('fooValue');   // WHERE APELLIDO1 = 'fooValue'
     * $query->filterByApellido1('%fooValue%'); // WHERE APELLIDO1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apellido1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByApellido1($apellido1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellido1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $apellido1)) {
                $apellido1 = str_replace('*', '%', $apellido1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_APELLIDO1, $apellido1, $comparison);
    }

    /**
     * Filter the query on the APELLIDO2 column
     *
     * Example usage:
     * <code>
     * $query->filterByApellido2('fooValue');   // WHERE APELLIDO2 = 'fooValue'
     * $query->filterByApellido2('%fooValue%'); // WHERE APELLIDO2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apellido2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByApellido2($apellido2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellido2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $apellido2)) {
                $apellido2 = str_replace('*', '%', $apellido2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_APELLIDO2, $apellido2, $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobPostulanteTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the CI column
     *
     * Example usage:
     * <code>
     * $query->filterByCi('fooValue');   // WHERE CI = 'fooValue'
     * $query->filterByCi('%fooValue%'); // WHERE CI LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ci The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByCi($ci = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ci)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ci)) {
                $ci = str_replace('*', '%', $ci);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_CI, $ci, $comparison);
    }

    /**
     * Filter the query on the CI_EXPEDIDO column
     *
     * Example usage:
     * <code>
     * $query->filterByCiExpedido('fooValue');   // WHERE CI_EXPEDIDO = 'fooValue'
     * $query->filterByCiExpedido('%fooValue%'); // WHERE CI_EXPEDIDO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciExpedido The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByCiExpedido($ciExpedido = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciExpedido)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciExpedido)) {
                $ciExpedido = str_replace('*', '%', $ciExpedido);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_CI_EXPEDIDO, $ciExpedido, $comparison);
    }

    /**
     * Filter the query on the SEXO column
     *
     * Example usage:
     * <code>
     * $query->filterBySexo('fooValue');   // WHERE SEXO = 'fooValue'
     * $query->filterBySexo('%fooValue%'); // WHERE SEXO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sexo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterBySexo($sexo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sexo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sexo)) {
                $sexo = str_replace('*', '%', $sexo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_SEXO, $sexo, $comparison);
    }

    /**
     * Filter the query on the FECHA_NACIMIENTO column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaNacimiento('2011-03-14'); // WHERE FECHA_NACIMIENTO = '2011-03-14'
     * $query->filterByFechaNacimiento('now'); // WHERE FECHA_NACIMIENTO = '2011-03-14'
     * $query->filterByFechaNacimiento(array('max' => 'yesterday')); // WHERE FECHA_NACIMIENTO > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaNacimiento The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByFechaNacimiento($fechaNacimiento = null, $comparison = null)
    {
        if (is_array($fechaNacimiento)) {
            $useMinMax = false;
            if (isset($fechaNacimiento['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_FECHA_NACIMIENTO, $fechaNacimiento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaNacimiento['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_FECHA_NACIMIENTO, $fechaNacimiento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_FECHA_NACIMIENTO, $fechaNacimiento, $comparison);
    }

    /**
     * Filter the query on the LUGAR_NACIMIENTO column
     *
     * Example usage:
     * <code>
     * $query->filterByLugarNacimiento('fooValue');   // WHERE LUGAR_NACIMIENTO = 'fooValue'
     * $query->filterByLugarNacimiento('%fooValue%'); // WHERE LUGAR_NACIMIENTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lugarNacimiento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByLugarNacimiento($lugarNacimiento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lugarNacimiento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lugarNacimiento)) {
                $lugarNacimiento = str_replace('*', '%', $lugarNacimiento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_LUGAR_NACIMIENTO, $lugarNacimiento, $comparison);
    }

    /**
     * Filter the query on the DIRECCION column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccion('fooValue');   // WHERE DIRECCION = 'fooValue'
     * $query->filterByDireccion('%fooValue%'); // WHERE DIRECCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByDireccion($direccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $direccion)) {
                $direccion = str_replace('*', '%', $direccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the CIUDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudad('fooValue');   // WHERE CIUDAD = 'fooValue'
     * $query->filterByCiudad('%fooValue%'); // WHERE CIUDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudad The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByCiudad($ciudad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudad)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudad)) {
                $ciudad = str_replace('*', '%', $ciudad);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_CIUDAD, $ciudad, $comparison);
    }

    /**
     * Filter the query on the TELEFONO_DOMICILIO column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonoDomicilio('fooValue');   // WHERE TELEFONO_DOMICILIO = 'fooValue'
     * $query->filterByTelefonoDomicilio('%fooValue%'); // WHERE TELEFONO_DOMICILIO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefonoDomicilio The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByTelefonoDomicilio($telefonoDomicilio = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefonoDomicilio)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefonoDomicilio)) {
                $telefonoDomicilio = str_replace('*', '%', $telefonoDomicilio);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_TELEFONO_DOMICILIO, $telefonoDomicilio, $comparison);
    }

    /**
     * Filter the query on the TELEFONO_TRABAJO column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonoTrabajo('fooValue');   // WHERE TELEFONO_TRABAJO = 'fooValue'
     * $query->filterByTelefonoTrabajo('%fooValue%'); // WHERE TELEFONO_TRABAJO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefonoTrabajo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByTelefonoTrabajo($telefonoTrabajo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefonoTrabajo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefonoTrabajo)) {
                $telefonoTrabajo = str_replace('*', '%', $telefonoTrabajo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_TELEFONO_TRABAJO, $telefonoTrabajo, $comparison);
    }

    /**
     * Filter the query on the CELULAR_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCelular1('fooValue');   // WHERE CELULAR_1 = 'fooValue'
     * $query->filterByCelular1('%fooValue%'); // WHERE CELULAR_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $celular1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByCelular1($celular1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($celular1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $celular1)) {
                $celular1 = str_replace('*', '%', $celular1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_CELULAR_1, $celular1, $comparison);
    }

    /**
     * Filter the query on the CELULAR_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCelular2('fooValue');   // WHERE CELULAR_2 = 'fooValue'
     * $query->filterByCelular2('%fooValue%'); // WHERE CELULAR_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $celular2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByCelular2($celular2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($celular2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $celular2)) {
                $celular2 = str_replace('*', '%', $celular2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_CELULAR_2, $celular2, $comparison);
    }

    /**
     * Filter the query on the MIME_FOTO column
     *
     * Example usage:
     * <code>
     * $query->filterByMimeFoto('fooValue');   // WHERE MIME_FOTO = 'fooValue'
     * $query->filterByMimeFoto('%fooValue%'); // WHERE MIME_FOTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mimeFoto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByMimeFoto($mimeFoto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mimeFoto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mimeFoto)) {
                $mimeFoto = str_replace('*', '%', $mimeFoto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_MIME_FOTO, $mimeFoto, $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByPretensionSalarial($pretensionSalarial = null, $comparison = null)
    {
        if (is_array($pretensionSalarial)) {
            $useMinMax = false;
            if (isset($pretensionSalarial['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_PRETENSION_SALARIAL, $pretensionSalarial['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pretensionSalarial['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_PRETENSION_SALARIAL, $pretensionSalarial['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_PRETENSION_SALARIAL, $pretensionSalarial, $comparison);
    }

    /**
     * Filter the query on the FECHA_ULTIMA_POSTULACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaUltimaPostulacion('2011-03-14'); // WHERE FECHA_ULTIMA_POSTULACION = '2011-03-14'
     * $query->filterByFechaUltimaPostulacion('now'); // WHERE FECHA_ULTIMA_POSTULACION = '2011-03-14'
     * $query->filterByFechaUltimaPostulacion(array('max' => 'yesterday')); // WHERE FECHA_ULTIMA_POSTULACION > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaUltimaPostulacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByFechaUltimaPostulacion($fechaUltimaPostulacion = null, $comparison = null)
    {
        if (is_array($fechaUltimaPostulacion)) {
            $useMinMax = false;
            if (isset($fechaUltimaPostulacion['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION, $fechaUltimaPostulacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaUltimaPostulacion['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION, $fechaUltimaPostulacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION, $fechaUltimaPostulacion, $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobPostulanteTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobPostulanteTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobPostulanteAviso object
     *
     * @param \JobPostulanteAviso|ObjectCollection $jobPostulanteAviso the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByJobPostulanteAviso($jobPostulanteAviso, $comparison = null)
    {
        if ($jobPostulanteAviso instanceof \JobPostulanteAviso) {
            return $this
                ->addUsingAlias(JobPostulanteTableMap::COL_ID, $jobPostulanteAviso->getIdPostulante(), $comparison);
        } elseif ($jobPostulanteAviso instanceof ObjectCollection) {
            return $this
                ->useJobPostulanteAvisoQuery()
                ->filterByPrimaryKeys($jobPostulanteAviso->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobPostulanteAviso() only accepts arguments of type \JobPostulanteAviso or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobPostulanteAviso relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function joinJobPostulanteAviso($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobPostulanteAviso');

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
            $this->addJoinObject($join, 'JobPostulanteAviso');
        }

        return $this;
    }

    /**
     * Use the JobPostulanteAviso relation JobPostulanteAviso object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobPostulanteAvisoQuery A secondary query class using the current class as primary query
     */
    public function useJobPostulanteAvisoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobPostulanteAviso($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobPostulanteAviso', '\JobPostulanteAvisoQuery');
    }

    /**
     * Filter the query by a related \JobSuscriptor object
     *
     * @param \JobSuscriptor|ObjectCollection $jobSuscriptor the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function filterByJobSuscriptor($jobSuscriptor, $comparison = null)
    {
        if ($jobSuscriptor instanceof \JobSuscriptor) {
            return $this
                ->addUsingAlias(JobPostulanteTableMap::COL_ID, $jobSuscriptor->getIdPostulante(), $comparison);
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
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function joinJobSuscriptor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useJobSuscriptorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJobSuscriptor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobSuscriptor', '\JobSuscriptorQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobPostulante $jobPostulante Object to remove from the list of results
     *
     * @return $this|ChildJobPostulanteQuery The current query, for fluid interface
     */
    public function prune($jobPostulante = null)
    {
        if ($jobPostulante) {
            $this->addUsingAlias(JobPostulanteTableMap::COL_ID, $jobPostulante->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_postulante table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobPostulanteTableMap::clearInstancePool();
            JobPostulanteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobPostulanteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobPostulanteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobPostulanteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobPostulanteQuery
