<?php

namespace Base;

use \JobAviso as ChildJobAviso;
use \JobAvisoQuery as ChildJobAvisoQuery;
use \Exception;
use \PDO;
use Map\JobAvisoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_aviso' table.
 *
 * 
 *
 * @method     ChildJobAvisoQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobAvisoQuery orderByAreaId($order = Criteria::ASC) Order by the AREA_ID column
 * @method     ChildJobAvisoQuery orderByAreaTecnicaId($order = Criteria::ASC) Order by the AREA_TECNICA_ID column
 * @method     ChildJobAvisoQuery orderByLocalizacion($order = Criteria::ASC) Order by the LOCALIZACION column
 * @method     ChildJobAvisoQuery orderByCargo($order = Criteria::ASC) Order by the CARGO column
 * @method     ChildJobAvisoQuery orderByDescripcion($order = Criteria::ASC) Order by the DESCRIPCION column
 * @method     ChildJobAvisoQuery orderByNombreEmpresa($order = Criteria::ASC) Order by the NOMBRE_EMPRESA column
 * @method     ChildJobAvisoQuery orderByDireccion($order = Criteria::ASC) Order by the DIRECCION column
 * @method     ChildJobAvisoQuery orderByTelefonoContacto($order = Criteria::ASC) Order by the TELEFONO_CONTACTO column
 * @method     ChildJobAvisoQuery orderByCorreoContacto($order = Criteria::ASC) Order by the CORREO_CONTACTO column
 * @method     ChildJobAvisoQuery orderByFechaPublicacion($order = Criteria::ASC) Order by the FECHA_PUBLICACION column
 * @method     ChildJobAvisoQuery orderByFechaVencimiento($order = Criteria::ASC) Order by the FECHA_VENCIMIENTO column
 * @method     ChildJobAvisoQuery orderByRequisito($order = Criteria::ASC) Order by the REQUISITO column
 * @method     ChildJobAvisoQuery orderByAniosExperiencia($order = Criteria::ASC) Order by the ANIOS_EXPERIENCIA column
 * @method     ChildJobAvisoQuery orderByNivelFormacion($order = Criteria::ASC) Order by the NIVEL_FORMACION column
 * @method     ChildJobAvisoQuery orderBySalario($order = Criteria::ASC) Order by the SALARIO column
 * @method     ChildJobAvisoQuery orderByProfesion($order = Criteria::ASC) Order by the PROFESION column
 * @method     ChildJobAvisoQuery orderByFuente($order = Criteria::ASC) Order by the FUENTE column
 * @method     ChildJobAvisoQuery orderByTieneImagen($order = Criteria::ASC) Order by the TIENE_IMAGEN column
 * @method     ChildJobAvisoQuery orderByMimetype($order = Criteria::ASC) Order by the MIMETYPE column
 * @method     ChildJobAvisoQuery orderByAreasReferencia($order = Criteria::ASC) Order by the AREAS_REFERENCIA column
 * @method     ChildJobAvisoQuery orderByFormacionesReferencia($order = Criteria::ASC) Order by the FORMACIONES_REFERENCIA column
 * @method     ChildJobAvisoQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobAvisoQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobAvisoQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobAvisoQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobAvisoQuery groupById() Group by the ID column
 * @method     ChildJobAvisoQuery groupByAreaId() Group by the AREA_ID column
 * @method     ChildJobAvisoQuery groupByAreaTecnicaId() Group by the AREA_TECNICA_ID column
 * @method     ChildJobAvisoQuery groupByLocalizacion() Group by the LOCALIZACION column
 * @method     ChildJobAvisoQuery groupByCargo() Group by the CARGO column
 * @method     ChildJobAvisoQuery groupByDescripcion() Group by the DESCRIPCION column
 * @method     ChildJobAvisoQuery groupByNombreEmpresa() Group by the NOMBRE_EMPRESA column
 * @method     ChildJobAvisoQuery groupByDireccion() Group by the DIRECCION column
 * @method     ChildJobAvisoQuery groupByTelefonoContacto() Group by the TELEFONO_CONTACTO column
 * @method     ChildJobAvisoQuery groupByCorreoContacto() Group by the CORREO_CONTACTO column
 * @method     ChildJobAvisoQuery groupByFechaPublicacion() Group by the FECHA_PUBLICACION column
 * @method     ChildJobAvisoQuery groupByFechaVencimiento() Group by the FECHA_VENCIMIENTO column
 * @method     ChildJobAvisoQuery groupByRequisito() Group by the REQUISITO column
 * @method     ChildJobAvisoQuery groupByAniosExperiencia() Group by the ANIOS_EXPERIENCIA column
 * @method     ChildJobAvisoQuery groupByNivelFormacion() Group by the NIVEL_FORMACION column
 * @method     ChildJobAvisoQuery groupBySalario() Group by the SALARIO column
 * @method     ChildJobAvisoQuery groupByProfesion() Group by the PROFESION column
 * @method     ChildJobAvisoQuery groupByFuente() Group by the FUENTE column
 * @method     ChildJobAvisoQuery groupByTieneImagen() Group by the TIENE_IMAGEN column
 * @method     ChildJobAvisoQuery groupByMimetype() Group by the MIMETYPE column
 * @method     ChildJobAvisoQuery groupByAreasReferencia() Group by the AREAS_REFERENCIA column
 * @method     ChildJobAvisoQuery groupByFormacionesReferencia() Group by the FORMACIONES_REFERENCIA column
 * @method     ChildJobAvisoQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobAvisoQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobAvisoQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobAvisoQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobAvisoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobAvisoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobAvisoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobAvisoQuery leftJoinJobAreaTecnica($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobAreaTecnica relation
 * @method     ChildJobAvisoQuery rightJoinJobAreaTecnica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobAreaTecnica relation
 * @method     ChildJobAvisoQuery innerJoinJobAreaTecnica($relationAlias = null) Adds a INNER JOIN clause to the query using the JobAreaTecnica relation
 *
 * @method     ChildJobAvisoQuery leftJoinJobArea($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobArea relation
 * @method     ChildJobAvisoQuery rightJoinJobArea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobArea relation
 * @method     ChildJobAvisoQuery innerJoinJobArea($relationAlias = null) Adds a INNER JOIN clause to the query using the JobArea relation
 *
 * @method     \JobAreaTecnicaQuery|\JobAreaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobAviso findOne(ConnectionInterface $con = null) Return the first ChildJobAviso matching the query
 * @method     ChildJobAviso findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobAviso matching the query, or a new ChildJobAviso object populated from the query conditions when no match is found
 *
 * @method     ChildJobAviso findOneById(int $ID) Return the first ChildJobAviso filtered by the ID column
 * @method     ChildJobAviso findOneByAreaId(int $AREA_ID) Return the first ChildJobAviso filtered by the AREA_ID column
 * @method     ChildJobAviso findOneByAreaTecnicaId(int $AREA_TECNICA_ID) Return the first ChildJobAviso filtered by the AREA_TECNICA_ID column
 * @method     ChildJobAviso findOneByLocalizacion(string $LOCALIZACION) Return the first ChildJobAviso filtered by the LOCALIZACION column
 * @method     ChildJobAviso findOneByCargo(string $CARGO) Return the first ChildJobAviso filtered by the CARGO column
 * @method     ChildJobAviso findOneByDescripcion(string $DESCRIPCION) Return the first ChildJobAviso filtered by the DESCRIPCION column
 * @method     ChildJobAviso findOneByNombreEmpresa(string $NOMBRE_EMPRESA) Return the first ChildJobAviso filtered by the NOMBRE_EMPRESA column
 * @method     ChildJobAviso findOneByDireccion(string $DIRECCION) Return the first ChildJobAviso filtered by the DIRECCION column
 * @method     ChildJobAviso findOneByTelefonoContacto(int $TELEFONO_CONTACTO) Return the first ChildJobAviso filtered by the TELEFONO_CONTACTO column
 * @method     ChildJobAviso findOneByCorreoContacto(string $CORREO_CONTACTO) Return the first ChildJobAviso filtered by the CORREO_CONTACTO column
 * @method     ChildJobAviso findOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobAviso filtered by the FECHA_PUBLICACION column
 * @method     ChildJobAviso findOneByFechaVencimiento(string $FECHA_VENCIMIENTO) Return the first ChildJobAviso filtered by the FECHA_VENCIMIENTO column
 * @method     ChildJobAviso findOneByRequisito(string $REQUISITO) Return the first ChildJobAviso filtered by the REQUISITO column
 * @method     ChildJobAviso findOneByAniosExperiencia(int $ANIOS_EXPERIENCIA) Return the first ChildJobAviso filtered by the ANIOS_EXPERIENCIA column
 * @method     ChildJobAviso findOneByNivelFormacion(string $NIVEL_FORMACION) Return the first ChildJobAviso filtered by the NIVEL_FORMACION column
 * @method     ChildJobAviso findOneBySalario(string $SALARIO) Return the first ChildJobAviso filtered by the SALARIO column
 * @method     ChildJobAviso findOneByProfesion(string $PROFESION) Return the first ChildJobAviso filtered by the PROFESION column
 * @method     ChildJobAviso findOneByFuente(string $FUENTE) Return the first ChildJobAviso filtered by the FUENTE column
 * @method     ChildJobAviso findOneByTieneImagen(boolean $TIENE_IMAGEN) Return the first ChildJobAviso filtered by the TIENE_IMAGEN column
 * @method     ChildJobAviso findOneByMimetype(string $MIMETYPE) Return the first ChildJobAviso filtered by the MIMETYPE column
 * @method     ChildJobAviso findOneByAreasReferencia(string $AREAS_REFERENCIA) Return the first ChildJobAviso filtered by the AREAS_REFERENCIA column
 * @method     ChildJobAviso findOneByFormacionesReferencia(string $FORMACIONES_REFERENCIA) Return the first ChildJobAviso filtered by the FORMACIONES_REFERENCIA column
 * @method     ChildJobAviso findOneByStatus(string $STATUS) Return the first ChildJobAviso filtered by the STATUS column
 * @method     ChildJobAviso findOneByLastUserId(string $LAST_USER_ID) Return the first ChildJobAviso filtered by the LAST_USER_ID column
 * @method     ChildJobAviso findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAviso filtered by the CREATION_DATE column
 * @method     ChildJobAviso findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAviso filtered by the MODIFICATION_DATE column *

 * @method     ChildJobAviso requirePk($key, ConnectionInterface $con = null) Return the ChildJobAviso by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOne(ConnectionInterface $con = null) Return the first ChildJobAviso matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAviso requireOneById(int $ID) Return the first ChildJobAviso filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByAreaId(int $AREA_ID) Return the first ChildJobAviso filtered by the AREA_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByAreaTecnicaId(int $AREA_TECNICA_ID) Return the first ChildJobAviso filtered by the AREA_TECNICA_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByLocalizacion(string $LOCALIZACION) Return the first ChildJobAviso filtered by the LOCALIZACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByCargo(string $CARGO) Return the first ChildJobAviso filtered by the CARGO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByDescripcion(string $DESCRIPCION) Return the first ChildJobAviso filtered by the DESCRIPCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByNombreEmpresa(string $NOMBRE_EMPRESA) Return the first ChildJobAviso filtered by the NOMBRE_EMPRESA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByDireccion(string $DIRECCION) Return the first ChildJobAviso filtered by the DIRECCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByTelefonoContacto(int $TELEFONO_CONTACTO) Return the first ChildJobAviso filtered by the TELEFONO_CONTACTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByCorreoContacto(string $CORREO_CONTACTO) Return the first ChildJobAviso filtered by the CORREO_CONTACTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobAviso filtered by the FECHA_PUBLICACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByFechaVencimiento(string $FECHA_VENCIMIENTO) Return the first ChildJobAviso filtered by the FECHA_VENCIMIENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByRequisito(string $REQUISITO) Return the first ChildJobAviso filtered by the REQUISITO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByAniosExperiencia(int $ANIOS_EXPERIENCIA) Return the first ChildJobAviso filtered by the ANIOS_EXPERIENCIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByNivelFormacion(string $NIVEL_FORMACION) Return the first ChildJobAviso filtered by the NIVEL_FORMACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneBySalario(string $SALARIO) Return the first ChildJobAviso filtered by the SALARIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByProfesion(string $PROFESION) Return the first ChildJobAviso filtered by the PROFESION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByFuente(string $FUENTE) Return the first ChildJobAviso filtered by the FUENTE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByTieneImagen(boolean $TIENE_IMAGEN) Return the first ChildJobAviso filtered by the TIENE_IMAGEN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByMimetype(string $MIMETYPE) Return the first ChildJobAviso filtered by the MIMETYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByAreasReferencia(string $AREAS_REFERENCIA) Return the first ChildJobAviso filtered by the AREAS_REFERENCIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByFormacionesReferencia(string $FORMACIONES_REFERENCIA) Return the first ChildJobAviso filtered by the FORMACIONES_REFERENCIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByStatus(string $STATUS) Return the first ChildJobAviso filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByLastUserId(string $LAST_USER_ID) Return the first ChildJobAviso filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobAviso filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobAviso requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobAviso filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobAviso[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobAviso objects based on current ModelCriteria
 * @method     ChildJobAviso[]|ObjectCollection findById(int $ID) Return ChildJobAviso objects filtered by the ID column
 * @method     ChildJobAviso[]|ObjectCollection findByAreaId(int $AREA_ID) Return ChildJobAviso objects filtered by the AREA_ID column
 * @method     ChildJobAviso[]|ObjectCollection findByAreaTecnicaId(int $AREA_TECNICA_ID) Return ChildJobAviso objects filtered by the AREA_TECNICA_ID column
 * @method     ChildJobAviso[]|ObjectCollection findByLocalizacion(string $LOCALIZACION) Return ChildJobAviso objects filtered by the LOCALIZACION column
 * @method     ChildJobAviso[]|ObjectCollection findByCargo(string $CARGO) Return ChildJobAviso objects filtered by the CARGO column
 * @method     ChildJobAviso[]|ObjectCollection findByDescripcion(string $DESCRIPCION) Return ChildJobAviso objects filtered by the DESCRIPCION column
 * @method     ChildJobAviso[]|ObjectCollection findByNombreEmpresa(string $NOMBRE_EMPRESA) Return ChildJobAviso objects filtered by the NOMBRE_EMPRESA column
 * @method     ChildJobAviso[]|ObjectCollection findByDireccion(string $DIRECCION) Return ChildJobAviso objects filtered by the DIRECCION column
 * @method     ChildJobAviso[]|ObjectCollection findByTelefonoContacto(int $TELEFONO_CONTACTO) Return ChildJobAviso objects filtered by the TELEFONO_CONTACTO column
 * @method     ChildJobAviso[]|ObjectCollection findByCorreoContacto(string $CORREO_CONTACTO) Return ChildJobAviso objects filtered by the CORREO_CONTACTO column
 * @method     ChildJobAviso[]|ObjectCollection findByFechaPublicacion(string $FECHA_PUBLICACION) Return ChildJobAviso objects filtered by the FECHA_PUBLICACION column
 * @method     ChildJobAviso[]|ObjectCollection findByFechaVencimiento(string $FECHA_VENCIMIENTO) Return ChildJobAviso objects filtered by the FECHA_VENCIMIENTO column
 * @method     ChildJobAviso[]|ObjectCollection findByRequisito(string $REQUISITO) Return ChildJobAviso objects filtered by the REQUISITO column
 * @method     ChildJobAviso[]|ObjectCollection findByAniosExperiencia(int $ANIOS_EXPERIENCIA) Return ChildJobAviso objects filtered by the ANIOS_EXPERIENCIA column
 * @method     ChildJobAviso[]|ObjectCollection findByNivelFormacion(string $NIVEL_FORMACION) Return ChildJobAviso objects filtered by the NIVEL_FORMACION column
 * @method     ChildJobAviso[]|ObjectCollection findBySalario(string $SALARIO) Return ChildJobAviso objects filtered by the SALARIO column
 * @method     ChildJobAviso[]|ObjectCollection findByProfesion(string $PROFESION) Return ChildJobAviso objects filtered by the PROFESION column
 * @method     ChildJobAviso[]|ObjectCollection findByFuente(string $FUENTE) Return ChildJobAviso objects filtered by the FUENTE column
 * @method     ChildJobAviso[]|ObjectCollection findByTieneImagen(boolean $TIENE_IMAGEN) Return ChildJobAviso objects filtered by the TIENE_IMAGEN column
 * @method     ChildJobAviso[]|ObjectCollection findByMimetype(string $MIMETYPE) Return ChildJobAviso objects filtered by the MIMETYPE column
 * @method     ChildJobAviso[]|ObjectCollection findByAreasReferencia(string $AREAS_REFERENCIA) Return ChildJobAviso objects filtered by the AREAS_REFERENCIA column
 * @method     ChildJobAviso[]|ObjectCollection findByFormacionesReferencia(string $FORMACIONES_REFERENCIA) Return ChildJobAviso objects filtered by the FORMACIONES_REFERENCIA column
 * @method     ChildJobAviso[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobAviso objects filtered by the STATUS column
 * @method     ChildJobAviso[]|ObjectCollection findByLastUserId(string $LAST_USER_ID) Return ChildJobAviso objects filtered by the LAST_USER_ID column
 * @method     ChildJobAviso[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobAviso objects filtered by the CREATION_DATE column
 * @method     ChildJobAviso[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobAviso objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobAviso[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobAvisoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobAvisoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobAviso', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobAvisoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobAvisoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobAvisoQuery) {
            return $criteria;
        }
        $query = new ChildJobAvisoQuery();
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
     * @return ChildJobAviso|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobAvisoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobAvisoTableMap::DATABASE_NAME);
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
     * @return ChildJobAviso A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, AREA_ID, AREA_TECNICA_ID, LOCALIZACION, CARGO, DESCRIPCION, NOMBRE_EMPRESA, DIRECCION, TELEFONO_CONTACTO, CORREO_CONTACTO, FECHA_PUBLICACION, FECHA_VENCIMIENTO, REQUISITO, ANIOS_EXPERIENCIA, NIVEL_FORMACION, SALARIO, PROFESION, FUENTE, TIENE_IMAGEN, MIMETYPE, AREAS_REFERENCIA, FORMACIONES_REFERENCIA, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_aviso WHERE ID = :p0';
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
            /** @var ChildJobAviso $obj */
            $obj = new ChildJobAviso();
            $obj->hydrate($row);
            JobAvisoTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildJobAviso|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobAvisoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobAvisoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_ID, $id, $comparison);
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
     * @see       filterByJobArea()
     *
     * @param     mixed $areaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByAreaId($areaId = null, $comparison = null)
    {
        if (is_array($areaId)) {
            $useMinMax = false;
            if (isset($areaId['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_AREA_ID, $areaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($areaId['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_AREA_ID, $areaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_AREA_ID, $areaId, $comparison);
    }

    /**
     * Filter the query on the AREA_TECNICA_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByAreaTecnicaId(1234); // WHERE AREA_TECNICA_ID = 1234
     * $query->filterByAreaTecnicaId(array(12, 34)); // WHERE AREA_TECNICA_ID IN (12, 34)
     * $query->filterByAreaTecnicaId(array('min' => 12)); // WHERE AREA_TECNICA_ID > 12
     * </code>
     *
     * @see       filterByJobAreaTecnica()
     *
     * @param     mixed $areaTecnicaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByAreaTecnicaId($areaTecnicaId = null, $comparison = null)
    {
        if (is_array($areaTecnicaId)) {
            $useMinMax = false;
            if (isset($areaTecnicaId['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_AREA_TECNICA_ID, $areaTecnicaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($areaTecnicaId['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_AREA_TECNICA_ID, $areaTecnicaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_AREA_TECNICA_ID, $areaTecnicaId, $comparison);
    }

    /**
     * Filter the query on the LOCALIZACION column
     *
     * Example usage:
     * <code>
     * $query->filterByLocalizacion('fooValue');   // WHERE LOCALIZACION = 'fooValue'
     * $query->filterByLocalizacion('%fooValue%'); // WHERE LOCALIZACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $localizacion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByLocalizacion($localizacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($localizacion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $localizacion)) {
                $localizacion = str_replace('*', '%', $localizacion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_LOCALIZACION, $localizacion, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobAvisoTableMap::COL_CARGO, $cargo, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobAvisoTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the NOMBRE_EMPRESA column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreEmpresa('fooValue');   // WHERE NOMBRE_EMPRESA = 'fooValue'
     * $query->filterByNombreEmpresa('%fooValue%'); // WHERE NOMBRE_EMPRESA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreEmpresa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByNombreEmpresa($nombreEmpresa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreEmpresa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreEmpresa)) {
                $nombreEmpresa = str_replace('*', '%', $nombreEmpresa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_NOMBRE_EMPRESA, $nombreEmpresa, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobAvisoTableMap::COL_DIRECCION, $direccion, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByTelefonoContacto($telefonoContacto = null, $comparison = null)
    {
        if (is_array($telefonoContacto)) {
            $useMinMax = false;
            if (isset($telefonoContacto['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_TELEFONO_CONTACTO, $telefonoContacto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($telefonoContacto['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_TELEFONO_CONTACTO, $telefonoContacto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_TELEFONO_CONTACTO, $telefonoContacto, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobAvisoTableMap::COL_CORREO_CONTACTO, $correoContacto, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByFechaPublicacion($fechaPublicacion = null, $comparison = null)
    {
        if (is_array($fechaPublicacion)) {
            $useMinMax = false;
            if (isset($fechaPublicacion['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPublicacion['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByFechaVencimiento($fechaVencimiento = null, $comparison = null)
    {
        if (is_array($fechaVencimiento)) {
            $useMinMax = false;
            if (isset($fechaVencimiento['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_FECHA_VENCIMIENTO, $fechaVencimiento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaVencimiento['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_FECHA_VENCIMIENTO, $fechaVencimiento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_FECHA_VENCIMIENTO, $fechaVencimiento, $comparison);
    }

    /**
     * Filter the query on the REQUISITO column
     *
     * Example usage:
     * <code>
     * $query->filterByRequisito('fooValue');   // WHERE REQUISITO = 'fooValue'
     * $query->filterByRequisito('%fooValue%'); // WHERE REQUISITO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $requisito The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByRequisito($requisito = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($requisito)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $requisito)) {
                $requisito = str_replace('*', '%', $requisito);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_REQUISITO, $requisito, $comparison);
    }

    /**
     * Filter the query on the ANIOS_EXPERIENCIA column
     *
     * Example usage:
     * <code>
     * $query->filterByAniosExperiencia(1234); // WHERE ANIOS_EXPERIENCIA = 1234
     * $query->filterByAniosExperiencia(array(12, 34)); // WHERE ANIOS_EXPERIENCIA IN (12, 34)
     * $query->filterByAniosExperiencia(array('min' => 12)); // WHERE ANIOS_EXPERIENCIA > 12
     * </code>
     *
     * @param     mixed $aniosExperiencia The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByAniosExperiencia($aniosExperiencia = null, $comparison = null)
    {
        if (is_array($aniosExperiencia)) {
            $useMinMax = false;
            if (isset($aniosExperiencia['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_ANIOS_EXPERIENCIA, $aniosExperiencia['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($aniosExperiencia['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_ANIOS_EXPERIENCIA, $aniosExperiencia['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_ANIOS_EXPERIENCIA, $aniosExperiencia, $comparison);
    }

    /**
     * Filter the query on the NIVEL_FORMACION column
     *
     * Example usage:
     * <code>
     * $query->filterByNivelFormacion('fooValue');   // WHERE NIVEL_FORMACION = 'fooValue'
     * $query->filterByNivelFormacion('%fooValue%'); // WHERE NIVEL_FORMACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nivelFormacion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByNivelFormacion($nivelFormacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nivelFormacion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nivelFormacion)) {
                $nivelFormacion = str_replace('*', '%', $nivelFormacion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_NIVEL_FORMACION, $nivelFormacion, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterBySalario($salario = null, $comparison = null)
    {
        if (is_array($salario)) {
            $useMinMax = false;
            if (isset($salario['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_SALARIO, $salario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salario['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_SALARIO, $salario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_SALARIO, $salario, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobAvisoTableMap::COL_PROFESION, $profesion, $comparison);
    }

    /**
     * Filter the query on the FUENTE column
     *
     * Example usage:
     * <code>
     * $query->filterByFuente('fooValue');   // WHERE FUENTE = 'fooValue'
     * $query->filterByFuente('%fooValue%'); // WHERE FUENTE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fuente The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByFuente($fuente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fuente)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fuente)) {
                $fuente = str_replace('*', '%', $fuente);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_FUENTE, $fuente, $comparison);
    }

    /**
     * Filter the query on the TIENE_IMAGEN column
     *
     * Example usage:
     * <code>
     * $query->filterByTieneImagen(true); // WHERE TIENE_IMAGEN = true
     * $query->filterByTieneImagen('yes'); // WHERE TIENE_IMAGEN = true
     * </code>
     *
     * @param     boolean|string $tieneImagen The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByTieneImagen($tieneImagen = null, $comparison = null)
    {
        if (is_string($tieneImagen)) {
            $tieneImagen = in_array(strtolower($tieneImagen), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_TIENE_IMAGEN, $tieneImagen, $comparison);
    }

    /**
     * Filter the query on the MIMETYPE column
     *
     * Example usage:
     * <code>
     * $query->filterByMimetype('fooValue');   // WHERE MIMETYPE = 'fooValue'
     * $query->filterByMimetype('%fooValue%'); // WHERE MIMETYPE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mimetype The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByMimetype($mimetype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mimetype)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mimetype)) {
                $mimetype = str_replace('*', '%', $mimetype);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_MIMETYPE, $mimetype, $comparison);
    }

    /**
     * Filter the query on the AREAS_REFERENCIA column
     *
     * Example usage:
     * <code>
     * $query->filterByAreasReferencia('fooValue');   // WHERE AREAS_REFERENCIA = 'fooValue'
     * $query->filterByAreasReferencia('%fooValue%'); // WHERE AREAS_REFERENCIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $areasReferencia The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByAreasReferencia($areasReferencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($areasReferencia)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $areasReferencia)) {
                $areasReferencia = str_replace('*', '%', $areasReferencia);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_AREAS_REFERENCIA, $areasReferencia, $comparison);
    }

    /**
     * Filter the query on the FORMACIONES_REFERENCIA column
     *
     * Example usage:
     * <code>
     * $query->filterByFormacionesReferencia('fooValue');   // WHERE FORMACIONES_REFERENCIA = 'fooValue'
     * $query->filterByFormacionesReferencia('%fooValue%'); // WHERE FORMACIONES_REFERENCIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formacionesReferencia The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByFormacionesReferencia($formacionesReferencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formacionesReferencia)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $formacionesReferencia)) {
                $formacionesReferencia = str_replace('*', '%', $formacionesReferencia);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_FORMACIONES_REFERENCIA, $formacionesReferencia, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobAvisoTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the LAST_USER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUserId('fooValue');   // WHERE LAST_USER_ID = 'fooValue'
     * $query->filterByLastUserId('%fooValue%'); // WHERE LAST_USER_ID LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastUserId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastUserId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastUserId)) {
                $lastUserId = str_replace('*', '%', $lastUserId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobAvisoTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobAvisoTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobAreaTecnica object
     *
     * @param \JobAreaTecnica|ObjectCollection $jobAreaTecnica The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByJobAreaTecnica($jobAreaTecnica, $comparison = null)
    {
        if ($jobAreaTecnica instanceof \JobAreaTecnica) {
            return $this
                ->addUsingAlias(JobAvisoTableMap::COL_AREA_TECNICA_ID, $jobAreaTecnica->getId(), $comparison);
        } elseif ($jobAreaTecnica instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobAvisoTableMap::COL_AREA_TECNICA_ID, $jobAreaTecnica->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function joinJobAreaTecnica($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useJobAreaTecnicaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJobAreaTecnica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobAreaTecnica', '\JobAreaTecnicaQuery');
    }

    /**
     * Filter the query by a related \JobArea object
     *
     * @param \JobArea|ObjectCollection $jobArea The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobAvisoQuery The current query, for fluid interface
     */
    public function filterByJobArea($jobArea, $comparison = null)
    {
        if ($jobArea instanceof \JobArea) {
            return $this
                ->addUsingAlias(JobAvisoTableMap::COL_AREA_ID, $jobArea->getId(), $comparison);
        } elseif ($jobArea instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobAvisoTableMap::COL_AREA_ID, $jobArea->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobArea() only accepts arguments of type \JobArea or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobArea relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function joinJobArea($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobArea');

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
            $this->addJoinObject($join, 'JobArea');
        }

        return $this;
    }

    /**
     * Use the JobArea relation JobArea object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobAreaQuery A secondary query class using the current class as primary query
     */
    public function useJobAreaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJobArea($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobArea', '\JobAreaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobAviso $jobAviso Object to remove from the list of results
     *
     * @return $this|ChildJobAvisoQuery The current query, for fluid interface
     */
    public function prune($jobAviso = null)
    {
        if ($jobAviso) {
            $this->addUsingAlias(JobAvisoTableMap::COL_ID, $jobAviso->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_aviso table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAvisoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobAvisoTableMap::clearInstancePool();
            JobAvisoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAvisoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobAvisoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            JobAvisoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            JobAvisoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobAvisoQuery
