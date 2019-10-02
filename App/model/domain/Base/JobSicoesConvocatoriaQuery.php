<?php

namespace Base;

use \JobSicoesConvocatoria as ChildJobSicoesConvocatoria;
use \JobSicoesConvocatoriaQuery as ChildJobSicoesConvocatoriaQuery;
use \Exception;
use \PDO;
use Map\JobSicoesConvocatoriaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_sicoes_convocatoria' table.
 *
 *
 *
 * @method     ChildJobSicoesConvocatoriaQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobSicoesConvocatoriaQuery orderByCuce($order = Criteria::ASC) Order by the CUCE column
 * @method     ChildJobSicoesConvocatoriaQuery orderByCodigoSisin($order = Criteria::ASC) Order by the CODIGO_SISIN column
 * @method     ChildJobSicoesConvocatoriaQuery orderByObjetoLicitacion($order = Criteria::ASC) Order by the OBJETO_LICITACION column
 * @method     ChildJobSicoesConvocatoriaQuery orderByNombreEntidad($order = Criteria::ASC) Order by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery orderByCodigoEntidad($order = Criteria::ASC) Order by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery orderByTelefonoEntidad($order = Criteria::ASC) Order by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery orderByFechaPublicacion($order = Criteria::ASC) Order by the FECHA_PUBLICACION column
 * @method     ChildJobSicoesConvocatoriaQuery orderByFechaLimite($order = Criteria::ASC) Order by the FECHA_LIMITE column
 * @method     ChildJobSicoesConvocatoriaQuery orderByEstado($order = Criteria::ASC) Order by the ESTADO column
 * @method     ChildJobSicoesConvocatoriaQuery orderByModalidad($order = Criteria::ASC) Order by the MODALIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery orderByTipoConvocatoria($order = Criteria::ASC) Order by the TIPO_CONVOCATORIA column
 * @method     ChildJobSicoesConvocatoriaQuery orderByTipoConsultoria($order = Criteria::ASC) Order by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoesConvocatoriaQuery orderByFormaAdjudicacion($order = Criteria::ASC) Order by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoesConvocatoriaQuery orderByTipoContratacion($order = Criteria::ASC) Order by the TIPO_CONTRATACION column
 * @method     ChildJobSicoesConvocatoriaQuery orderByGarantiasSolicitadas($order = Criteria::ASC) Order by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoesConvocatoriaQuery orderByNumeroConsultores($order = Criteria::ASC) Order by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoesConvocatoriaQuery orderByPrecioUnitario($order = Criteria::ASC) Order by the PRECIO_UNITARIO column
 * @method     ChildJobSicoesConvocatoriaQuery orderByEnlace($order = Criteria::ASC) Order by the ENLACE column
 * @method     ChildJobSicoesConvocatoriaQuery orderByDepartamento($order = Criteria::ASC) Order by the DEPARTAMENTO column
 * @method     ChildJobSicoesConvocatoriaQuery orderByContacto($order = Criteria::ASC) Order by the CONTACTO column
 * @method     ChildJobSicoesConvocatoriaQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobSicoesConvocatoriaQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobSicoesConvocatoriaQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobSicoesConvocatoriaQuery groupById() Group by the ID column
 * @method     ChildJobSicoesConvocatoriaQuery groupByCuce() Group by the CUCE column
 * @method     ChildJobSicoesConvocatoriaQuery groupByCodigoSisin() Group by the CODIGO_SISIN column
 * @method     ChildJobSicoesConvocatoriaQuery groupByObjetoLicitacion() Group by the OBJETO_LICITACION column
 * @method     ChildJobSicoesConvocatoriaQuery groupByNombreEntidad() Group by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery groupByCodigoEntidad() Group by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery groupByTelefonoEntidad() Group by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery groupByFechaPublicacion() Group by the FECHA_PUBLICACION column
 * @method     ChildJobSicoesConvocatoriaQuery groupByFechaLimite() Group by the FECHA_LIMITE column
 * @method     ChildJobSicoesConvocatoriaQuery groupByEstado() Group by the ESTADO column
 * @method     ChildJobSicoesConvocatoriaQuery groupByModalidad() Group by the MODALIDAD column
 * @method     ChildJobSicoesConvocatoriaQuery groupByTipoConvocatoria() Group by the TIPO_CONVOCATORIA column
 * @method     ChildJobSicoesConvocatoriaQuery groupByTipoConsultoria() Group by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoesConvocatoriaQuery groupByFormaAdjudicacion() Group by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoesConvocatoriaQuery groupByTipoContratacion() Group by the TIPO_CONTRATACION column
 * @method     ChildJobSicoesConvocatoriaQuery groupByGarantiasSolicitadas() Group by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoesConvocatoriaQuery groupByNumeroConsultores() Group by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoesConvocatoriaQuery groupByPrecioUnitario() Group by the PRECIO_UNITARIO column
 * @method     ChildJobSicoesConvocatoriaQuery groupByEnlace() Group by the ENLACE column
 * @method     ChildJobSicoesConvocatoriaQuery groupByDepartamento() Group by the DEPARTAMENTO column
 * @method     ChildJobSicoesConvocatoriaQuery groupByContacto() Group by the CONTACTO column
 * @method     ChildJobSicoesConvocatoriaQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobSicoesConvocatoriaQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobSicoesConvocatoriaQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobSicoesConvocatoriaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobSicoesConvocatoriaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobSicoesConvocatoriaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobSicoesConvocatoriaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobSicoesConvocatoriaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobSicoesConvocatoriaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobSicoesConvocatoriaQuery leftJoinJobSicoesDetalle($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobSicoesDetalle relation
 * @method     ChildJobSicoesConvocatoriaQuery rightJoinJobSicoesDetalle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobSicoesDetalle relation
 * @method     ChildJobSicoesConvocatoriaQuery innerJoinJobSicoesDetalle($relationAlias = null) Adds a INNER JOIN clause to the query using the JobSicoesDetalle relation
 *
 * @method     ChildJobSicoesConvocatoriaQuery joinWithJobSicoesDetalle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobSicoesDetalle relation
 *
 * @method     ChildJobSicoesConvocatoriaQuery leftJoinWithJobSicoesDetalle() Adds a LEFT JOIN clause and with to the query using the JobSicoesDetalle relation
 * @method     ChildJobSicoesConvocatoriaQuery rightJoinWithJobSicoesDetalle() Adds a RIGHT JOIN clause and with to the query using the JobSicoesDetalle relation
 * @method     ChildJobSicoesConvocatoriaQuery innerJoinWithJobSicoesDetalle() Adds a INNER JOIN clause and with to the query using the JobSicoesDetalle relation
 *
 * @method     \JobSicoesDetalleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobSicoesConvocatoria findOne(ConnectionInterface $con = null) Return the first ChildJobSicoesConvocatoria matching the query
 * @method     ChildJobSicoesConvocatoria findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobSicoesConvocatoria matching the query, or a new ChildJobSicoesConvocatoria object populated from the query conditions when no match is found
 *
 * @method     ChildJobSicoesConvocatoria findOneById(int $ID) Return the first ChildJobSicoesConvocatoria filtered by the ID column
 * @method     ChildJobSicoesConvocatoria findOneByCuce(string $CUCE) Return the first ChildJobSicoesConvocatoria filtered by the CUCE column
 * @method     ChildJobSicoesConvocatoria findOneByCodigoSisin(string $CODIGO_SISIN) Return the first ChildJobSicoesConvocatoria filtered by the CODIGO_SISIN column
 * @method     ChildJobSicoesConvocatoria findOneByObjetoLicitacion(string $OBJETO_LICITACION) Return the first ChildJobSicoesConvocatoria filtered by the OBJETO_LICITACION column
 * @method     ChildJobSicoesConvocatoria findOneByNombreEntidad(string $NOMBRE_ENTIDAD) Return the first ChildJobSicoesConvocatoria filtered by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoesConvocatoria findOneByCodigoEntidad(int $CODIGO_ENTIDAD) Return the first ChildJobSicoesConvocatoria filtered by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoria findOneByTelefonoEntidad(string $TELEFONO_ENTIDAD) Return the first ChildJobSicoesConvocatoria filtered by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoria findOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobSicoesConvocatoria filtered by the FECHA_PUBLICACION column
 * @method     ChildJobSicoesConvocatoria findOneByFechaLimite(string $FECHA_LIMITE) Return the first ChildJobSicoesConvocatoria filtered by the FECHA_LIMITE column
 * @method     ChildJobSicoesConvocatoria findOneByEstado(string $ESTADO) Return the first ChildJobSicoesConvocatoria filtered by the ESTADO column
 * @method     ChildJobSicoesConvocatoria findOneByModalidad(string $MODALIDAD) Return the first ChildJobSicoesConvocatoria filtered by the MODALIDAD column
 * @method     ChildJobSicoesConvocatoria findOneByTipoConvocatoria(string $TIPO_CONVOCATORIA) Return the first ChildJobSicoesConvocatoria filtered by the TIPO_CONVOCATORIA column
 * @method     ChildJobSicoesConvocatoria findOneByTipoConsultoria(string $TIPO_CONSULTORIA) Return the first ChildJobSicoesConvocatoria filtered by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoesConvocatoria findOneByFormaAdjudicacion(string $FORMA_ADJUDICACION) Return the first ChildJobSicoesConvocatoria filtered by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoesConvocatoria findOneByTipoContratacion(string $TIPO_CONTRATACION) Return the first ChildJobSicoesConvocatoria filtered by the TIPO_CONTRATACION column
 * @method     ChildJobSicoesConvocatoria findOneByGarantiasSolicitadas(string $GARANTIAS_SOLICITADAS) Return the first ChildJobSicoesConvocatoria filtered by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoesConvocatoria findOneByNumeroConsultores(int $NUMERO_CONSULTORES) Return the first ChildJobSicoesConvocatoria filtered by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoesConvocatoria findOneByPrecioUnitario(double $PRECIO_UNITARIO) Return the first ChildJobSicoesConvocatoria filtered by the PRECIO_UNITARIO column
 * @method     ChildJobSicoesConvocatoria findOneByEnlace(string $ENLACE) Return the first ChildJobSicoesConvocatoria filtered by the ENLACE column
 * @method     ChildJobSicoesConvocatoria findOneByDepartamento(string $DEPARTAMENTO) Return the first ChildJobSicoesConvocatoria filtered by the DEPARTAMENTO column
 * @method     ChildJobSicoesConvocatoria findOneByContacto(string $CONTACTO) Return the first ChildJobSicoesConvocatoria filtered by the CONTACTO column
 * @method     ChildJobSicoesConvocatoria findOneByStatus(string $STATUS) Return the first ChildJobSicoesConvocatoria filtered by the STATUS column
 * @method     ChildJobSicoesConvocatoria findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSicoesConvocatoria filtered by the CREATION_DATE column
 * @method     ChildJobSicoesConvocatoria findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSicoesConvocatoria filtered by the MODIFICATION_DATE column *

 * @method     ChildJobSicoesConvocatoria requirePk($key, ConnectionInterface $con = null) Return the ChildJobSicoesConvocatoria by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOne(ConnectionInterface $con = null) Return the first ChildJobSicoesConvocatoria matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSicoesConvocatoria requireOneById(int $ID) Return the first ChildJobSicoesConvocatoria filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByCuce(string $CUCE) Return the first ChildJobSicoesConvocatoria filtered by the CUCE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByCodigoSisin(string $CODIGO_SISIN) Return the first ChildJobSicoesConvocatoria filtered by the CODIGO_SISIN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByObjetoLicitacion(string $OBJETO_LICITACION) Return the first ChildJobSicoesConvocatoria filtered by the OBJETO_LICITACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByNombreEntidad(string $NOMBRE_ENTIDAD) Return the first ChildJobSicoesConvocatoria filtered by the NOMBRE_ENTIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByCodigoEntidad(int $CODIGO_ENTIDAD) Return the first ChildJobSicoesConvocatoria filtered by the CODIGO_ENTIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByTelefonoEntidad(string $TELEFONO_ENTIDAD) Return the first ChildJobSicoesConvocatoria filtered by the TELEFONO_ENTIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByFechaPublicacion(string $FECHA_PUBLICACION) Return the first ChildJobSicoesConvocatoria filtered by the FECHA_PUBLICACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByFechaLimite(string $FECHA_LIMITE) Return the first ChildJobSicoesConvocatoria filtered by the FECHA_LIMITE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByEstado(string $ESTADO) Return the first ChildJobSicoesConvocatoria filtered by the ESTADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByModalidad(string $MODALIDAD) Return the first ChildJobSicoesConvocatoria filtered by the MODALIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByTipoConvocatoria(string $TIPO_CONVOCATORIA) Return the first ChildJobSicoesConvocatoria filtered by the TIPO_CONVOCATORIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByTipoConsultoria(string $TIPO_CONSULTORIA) Return the first ChildJobSicoesConvocatoria filtered by the TIPO_CONSULTORIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByFormaAdjudicacion(string $FORMA_ADJUDICACION) Return the first ChildJobSicoesConvocatoria filtered by the FORMA_ADJUDICACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByTipoContratacion(string $TIPO_CONTRATACION) Return the first ChildJobSicoesConvocatoria filtered by the TIPO_CONTRATACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByGarantiasSolicitadas(string $GARANTIAS_SOLICITADAS) Return the first ChildJobSicoesConvocatoria filtered by the GARANTIAS_SOLICITADAS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByNumeroConsultores(int $NUMERO_CONSULTORES) Return the first ChildJobSicoesConvocatoria filtered by the NUMERO_CONSULTORES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByPrecioUnitario(double $PRECIO_UNITARIO) Return the first ChildJobSicoesConvocatoria filtered by the PRECIO_UNITARIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByEnlace(string $ENLACE) Return the first ChildJobSicoesConvocatoria filtered by the ENLACE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByDepartamento(string $DEPARTAMENTO) Return the first ChildJobSicoesConvocatoria filtered by the DEPARTAMENTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByContacto(string $CONTACTO) Return the first ChildJobSicoesConvocatoria filtered by the CONTACTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByStatus(string $STATUS) Return the first ChildJobSicoesConvocatoria filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobSicoesConvocatoria filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobSicoesConvocatoria requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobSicoesConvocatoria filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobSicoesConvocatoria objects based on current ModelCriteria
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findById(int $ID) Return ChildJobSicoesConvocatoria objects filtered by the ID column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByCuce(string $CUCE) Return ChildJobSicoesConvocatoria objects filtered by the CUCE column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByCodigoSisin(string $CODIGO_SISIN) Return ChildJobSicoesConvocatoria objects filtered by the CODIGO_SISIN column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByObjetoLicitacion(string $OBJETO_LICITACION) Return ChildJobSicoesConvocatoria objects filtered by the OBJETO_LICITACION column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByNombreEntidad(string $NOMBRE_ENTIDAD) Return ChildJobSicoesConvocatoria objects filtered by the NOMBRE_ENTIDAD column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByCodigoEntidad(int $CODIGO_ENTIDAD) Return ChildJobSicoesConvocatoria objects filtered by the CODIGO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByTelefonoEntidad(string $TELEFONO_ENTIDAD) Return ChildJobSicoesConvocatoria objects filtered by the TELEFONO_ENTIDAD column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByFechaPublicacion(string $FECHA_PUBLICACION) Return ChildJobSicoesConvocatoria objects filtered by the FECHA_PUBLICACION column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByFechaLimite(string $FECHA_LIMITE) Return ChildJobSicoesConvocatoria objects filtered by the FECHA_LIMITE column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByEstado(string $ESTADO) Return ChildJobSicoesConvocatoria objects filtered by the ESTADO column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByModalidad(string $MODALIDAD) Return ChildJobSicoesConvocatoria objects filtered by the MODALIDAD column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByTipoConvocatoria(string $TIPO_CONVOCATORIA) Return ChildJobSicoesConvocatoria objects filtered by the TIPO_CONVOCATORIA column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByTipoConsultoria(string $TIPO_CONSULTORIA) Return ChildJobSicoesConvocatoria objects filtered by the TIPO_CONSULTORIA column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByFormaAdjudicacion(string $FORMA_ADJUDICACION) Return ChildJobSicoesConvocatoria objects filtered by the FORMA_ADJUDICACION column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByTipoContratacion(string $TIPO_CONTRATACION) Return ChildJobSicoesConvocatoria objects filtered by the TIPO_CONTRATACION column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByGarantiasSolicitadas(string $GARANTIAS_SOLICITADAS) Return ChildJobSicoesConvocatoria objects filtered by the GARANTIAS_SOLICITADAS column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByNumeroConsultores(int $NUMERO_CONSULTORES) Return ChildJobSicoesConvocatoria objects filtered by the NUMERO_CONSULTORES column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByPrecioUnitario(double $PRECIO_UNITARIO) Return ChildJobSicoesConvocatoria objects filtered by the PRECIO_UNITARIO column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByEnlace(string $ENLACE) Return ChildJobSicoesConvocatoria objects filtered by the ENLACE column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByDepartamento(string $DEPARTAMENTO) Return ChildJobSicoesConvocatoria objects filtered by the DEPARTAMENTO column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByContacto(string $CONTACTO) Return ChildJobSicoesConvocatoria objects filtered by the CONTACTO column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobSicoesConvocatoria objects filtered by the STATUS column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobSicoesConvocatoria objects filtered by the CREATION_DATE column
 * @method     ChildJobSicoesConvocatoria[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobSicoesConvocatoria objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobSicoesConvocatoria[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobSicoesConvocatoriaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobSicoesConvocatoriaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobSicoesConvocatoria', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobSicoesConvocatoriaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobSicoesConvocatoriaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobSicoesConvocatoriaQuery) {
            return $criteria;
        }
        $query = new ChildJobSicoesConvocatoriaQuery();
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
     * @return ChildJobSicoesConvocatoria|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobSicoesConvocatoriaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobSicoesConvocatoriaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJobSicoesConvocatoria A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, CUCE, CODIGO_SISIN, OBJETO_LICITACION, NOMBRE_ENTIDAD, CODIGO_ENTIDAD, TELEFONO_ENTIDAD, FECHA_PUBLICACION, FECHA_LIMITE, ESTADO, MODALIDAD, TIPO_CONVOCATORIA, TIPO_CONSULTORIA, FORMA_ADJUDICACION, TIPO_CONTRATACION, GARANTIAS_SOLICITADAS, NUMERO_CONSULTORES, PRECIO_UNITARIO, ENLACE, DEPARTAMENTO, CONTACTO, STATUS, CREATION_DATE, MODIFICATION_DATE FROM job_sicoes_convocatoria WHERE ID = :p0';
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
            /** @var ChildJobSicoesConvocatoria $obj */
            $obj = new ChildJobSicoesConvocatoria();
            $obj->hydrate($row);
            JobSicoesConvocatoriaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobSicoesConvocatoria|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the CUCE column
     *
     * Example usage:
     * <code>
     * $query->filterByCuce('fooValue');   // WHERE CUCE = 'fooValue'
     * $query->filterByCuce('%fooValue%', Criteria::LIKE); // WHERE CUCE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuce The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByCuce($cuce = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuce)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CUCE, $cuce, $comparison);
    }

    /**
     * Filter the query on the CODIGO_SISIN column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoSisin('fooValue');   // WHERE CODIGO_SISIN = 'fooValue'
     * $query->filterByCodigoSisin('%fooValue%', Criteria::LIKE); // WHERE CODIGO_SISIN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigoSisin The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByCodigoSisin($codigoSisin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigoSisin)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CODIGO_SISIN, $codigoSisin, $comparison);
    }

    /**
     * Filter the query on the OBJETO_LICITACION column
     *
     * Example usage:
     * <code>
     * $query->filterByObjetoLicitacion('fooValue');   // WHERE OBJETO_LICITACION = 'fooValue'
     * $query->filterByObjetoLicitacion('%fooValue%', Criteria::LIKE); // WHERE OBJETO_LICITACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $objetoLicitacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByObjetoLicitacion($objetoLicitacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($objetoLicitacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_OBJETO_LICITACION, $objetoLicitacion, $comparison);
    }

    /**
     * Filter the query on the NOMBRE_ENTIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreEntidad('fooValue');   // WHERE NOMBRE_ENTIDAD = 'fooValue'
     * $query->filterByNombreEntidad('%fooValue%', Criteria::LIKE); // WHERE NOMBRE_ENTIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreEntidad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByNombreEntidad($nombreEntidad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreEntidad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_NOMBRE_ENTIDAD, $nombreEntidad, $comparison);
    }

    /**
     * Filter the query on the CODIGO_ENTIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoEntidad(1234); // WHERE CODIGO_ENTIDAD = 1234
     * $query->filterByCodigoEntidad(array(12, 34)); // WHERE CODIGO_ENTIDAD IN (12, 34)
     * $query->filterByCodigoEntidad(array('min' => 12)); // WHERE CODIGO_ENTIDAD > 12
     * </code>
     *
     * @param     mixed $codigoEntidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByCodigoEntidad($codigoEntidad = null, $comparison = null)
    {
        if (is_array($codigoEntidad)) {
            $useMinMax = false;
            if (isset($codigoEntidad['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CODIGO_ENTIDAD, $codigoEntidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoEntidad['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CODIGO_ENTIDAD, $codigoEntidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CODIGO_ENTIDAD, $codigoEntidad, $comparison);
    }

    /**
     * Filter the query on the TELEFONO_ENTIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonoEntidad('fooValue');   // WHERE TELEFONO_ENTIDAD = 'fooValue'
     * $query->filterByTelefonoEntidad('%fooValue%', Criteria::LIKE); // WHERE TELEFONO_ENTIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefonoEntidad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByTelefonoEntidad($telefonoEntidad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefonoEntidad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_TELEFONO_ENTIDAD, $telefonoEntidad, $comparison);
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
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByFechaPublicacion($fechaPublicacion = null, $comparison = null)
    {
        if (is_array($fechaPublicacion)) {
            $useMinMax = false;
            if (isset($fechaPublicacion['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPublicacion['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_FECHA_PUBLICACION, $fechaPublicacion, $comparison);
    }

    /**
     * Filter the query on the FECHA_LIMITE column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaLimite('2011-03-14'); // WHERE FECHA_LIMITE = '2011-03-14'
     * $query->filterByFechaLimite('now'); // WHERE FECHA_LIMITE = '2011-03-14'
     * $query->filterByFechaLimite(array('max' => 'yesterday')); // WHERE FECHA_LIMITE > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaLimite The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByFechaLimite($fechaLimite = null, $comparison = null)
    {
        if (is_array($fechaLimite)) {
            $useMinMax = false;
            if (isset($fechaLimite['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_FECHA_LIMITE, $fechaLimite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaLimite['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_FECHA_LIMITE, $fechaLimite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_FECHA_LIMITE, $fechaLimite, $comparison);
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
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query on the MODALIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByModalidad('fooValue');   // WHERE MODALIDAD = 'fooValue'
     * $query->filterByModalidad('%fooValue%', Criteria::LIKE); // WHERE MODALIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modalidad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByModalidad($modalidad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modalidad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_MODALIDAD, $modalidad, $comparison);
    }

    /**
     * Filter the query on the TIPO_CONVOCATORIA column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoConvocatoria('fooValue');   // WHERE TIPO_CONVOCATORIA = 'fooValue'
     * $query->filterByTipoConvocatoria('%fooValue%', Criteria::LIKE); // WHERE TIPO_CONVOCATORIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoConvocatoria The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByTipoConvocatoria($tipoConvocatoria = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoConvocatoria)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_TIPO_CONVOCATORIA, $tipoConvocatoria, $comparison);
    }

    /**
     * Filter the query on the TIPO_CONSULTORIA column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoConsultoria('fooValue');   // WHERE TIPO_CONSULTORIA = 'fooValue'
     * $query->filterByTipoConsultoria('%fooValue%', Criteria::LIKE); // WHERE TIPO_CONSULTORIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoConsultoria The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByTipoConsultoria($tipoConsultoria = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoConsultoria)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_TIPO_CONSULTORIA, $tipoConsultoria, $comparison);
    }

    /**
     * Filter the query on the FORMA_ADJUDICACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFormaAdjudicacion('fooValue');   // WHERE FORMA_ADJUDICACION = 'fooValue'
     * $query->filterByFormaAdjudicacion('%fooValue%', Criteria::LIKE); // WHERE FORMA_ADJUDICACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formaAdjudicacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByFormaAdjudicacion($formaAdjudicacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formaAdjudicacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_FORMA_ADJUDICACION, $formaAdjudicacion, $comparison);
    }

    /**
     * Filter the query on the TIPO_CONTRATACION column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoContratacion('fooValue');   // WHERE TIPO_CONTRATACION = 'fooValue'
     * $query->filterByTipoContratacion('%fooValue%', Criteria::LIKE); // WHERE TIPO_CONTRATACION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoContratacion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByTipoContratacion($tipoContratacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoContratacion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_TIPO_CONTRATACION, $tipoContratacion, $comparison);
    }

    /**
     * Filter the query on the GARANTIAS_SOLICITADAS column
     *
     * Example usage:
     * <code>
     * $query->filterByGarantiasSolicitadas('fooValue');   // WHERE GARANTIAS_SOLICITADAS = 'fooValue'
     * $query->filterByGarantiasSolicitadas('%fooValue%', Criteria::LIKE); // WHERE GARANTIAS_SOLICITADAS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $garantiasSolicitadas The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByGarantiasSolicitadas($garantiasSolicitadas = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($garantiasSolicitadas)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_GARANTIAS_SOLICITADAS, $garantiasSolicitadas, $comparison);
    }

    /**
     * Filter the query on the NUMERO_CONSULTORES column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroConsultores(1234); // WHERE NUMERO_CONSULTORES = 1234
     * $query->filterByNumeroConsultores(array(12, 34)); // WHERE NUMERO_CONSULTORES IN (12, 34)
     * $query->filterByNumeroConsultores(array('min' => 12)); // WHERE NUMERO_CONSULTORES > 12
     * </code>
     *
     * @param     mixed $numeroConsultores The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByNumeroConsultores($numeroConsultores = null, $comparison = null)
    {
        if (is_array($numeroConsultores)) {
            $useMinMax = false;
            if (isset($numeroConsultores['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_NUMERO_CONSULTORES, $numeroConsultores['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numeroConsultores['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_NUMERO_CONSULTORES, $numeroConsultores['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_NUMERO_CONSULTORES, $numeroConsultores, $comparison);
    }

    /**
     * Filter the query on the PRECIO_UNITARIO column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecioUnitario(1234); // WHERE PRECIO_UNITARIO = 1234
     * $query->filterByPrecioUnitario(array(12, 34)); // WHERE PRECIO_UNITARIO IN (12, 34)
     * $query->filterByPrecioUnitario(array('min' => 12)); // WHERE PRECIO_UNITARIO > 12
     * </code>
     *
     * @param     mixed $precioUnitario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByPrecioUnitario($precioUnitario = null, $comparison = null)
    {
        if (is_array($precioUnitario)) {
            $useMinMax = false;
            if (isset($precioUnitario['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_PRECIO_UNITARIO, $precioUnitario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precioUnitario['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_PRECIO_UNITARIO, $precioUnitario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_PRECIO_UNITARIO, $precioUnitario, $comparison);
    }

    /**
     * Filter the query on the ENLACE column
     *
     * Example usage:
     * <code>
     * $query->filterByEnlace('fooValue');   // WHERE ENLACE = 'fooValue'
     * $query->filterByEnlace('%fooValue%', Criteria::LIKE); // WHERE ENLACE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $enlace The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByEnlace($enlace = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($enlace)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ENLACE, $enlace, $comparison);
    }

    /**
     * Filter the query on the DEPARTAMENTO column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartamento('fooValue');   // WHERE DEPARTAMENTO = 'fooValue'
     * $query->filterByDepartamento('%fooValue%', Criteria::LIKE); // WHERE DEPARTAMENTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $departamento The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByDepartamento($departamento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($departamento)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_DEPARTAMENTO, $departamento, $comparison);
    }

    /**
     * Filter the query on the CONTACTO column
     *
     * Example usage:
     * <code>
     * $query->filterByContacto('fooValue');   // WHERE CONTACTO = 'fooValue'
     * $query->filterByContacto('%fooValue%', Criteria::LIKE); // WHERE CONTACTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contacto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByContacto($contacto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contacto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CONTACTO, $contacto, $comparison);
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE STATUS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobSicoesDetalle object
     *
     * @param \JobSicoesDetalle|ObjectCollection $jobSicoesDetalle the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function filterByJobSicoesDetalle($jobSicoesDetalle, $comparison = null)
    {
        if ($jobSicoesDetalle instanceof \JobSicoesDetalle) {
            return $this
                ->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ID, $jobSicoesDetalle->getIdSicoesConvocatoria(), $comparison);
        } elseif ($jobSicoesDetalle instanceof ObjectCollection) {
            return $this
                ->useJobSicoesDetalleQuery()
                ->filterByPrimaryKeys($jobSicoesDetalle->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobSicoesDetalle() only accepts arguments of type \JobSicoesDetalle or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobSicoesDetalle relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function joinJobSicoesDetalle($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobSicoesDetalle');

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
            $this->addJoinObject($join, 'JobSicoesDetalle');
        }

        return $this;
    }

    /**
     * Use the JobSicoesDetalle relation JobSicoesDetalle object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobSicoesDetalleQuery A secondary query class using the current class as primary query
     */
    public function useJobSicoesDetalleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobSicoesDetalle($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobSicoesDetalle', '\JobSicoesDetalleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobSicoesConvocatoria $jobSicoesConvocatoria Object to remove from the list of results
     *
     * @return $this|ChildJobSicoesConvocatoriaQuery The current query, for fluid interface
     */
    public function prune($jobSicoesConvocatoria = null)
    {
        if ($jobSicoesConvocatoria) {
            $this->addUsingAlias(JobSicoesConvocatoriaTableMap::COL_ID, $jobSicoesConvocatoria->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_sicoes_convocatoria table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesConvocatoriaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobSicoesConvocatoriaTableMap::clearInstancePool();
            JobSicoesConvocatoriaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesConvocatoriaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobSicoesConvocatoriaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobSicoesConvocatoriaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobSicoesConvocatoriaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobSicoesConvocatoriaQuery
