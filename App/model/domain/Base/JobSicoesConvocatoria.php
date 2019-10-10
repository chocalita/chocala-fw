<?php

namespace Base;

use \JobSicoesConvocatoria as ChildJobSicoesConvocatoria;
use \JobSicoesConvocatoriaQuery as ChildJobSicoesConvocatoriaQuery;
use \JobSicoesDetalle as ChildJobSicoesDetalle;
use \JobSicoesDetalleQuery as ChildJobSicoesDetalleQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobSicoesConvocatoriaTableMap;
use Map\JobSicoesDetalleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'job_sicoes_convocatoria' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class JobSicoesConvocatoria implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobSicoesConvocatoriaTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the cuce field.
     *
     * @var        string
     */
    protected $cuce;

    /**
     * The value for the codigo_sisin field.
     *
     * @var        string
     */
    protected $codigo_sisin;

    /**
     * The value for the objeto_licitacion field.
     *
     * @var        string
     */
    protected $objeto_licitacion;

    /**
     * The value for the nombre_entidad field.
     *
     * @var        string
     */
    protected $nombre_entidad;

    /**
     * The value for the codigo_entidad field.
     *
     * @var        string
     */
    protected $codigo_entidad;

    /**
     * The value for the telefono_entidad field.
     *
     * @var        string
     */
    protected $telefono_entidad;

    /**
     * The value for the fecha_publicacion field.
     *
     * @var        DateTime
     */
    protected $fecha_publicacion;

    /**
     * The value for the fecha_limite field.
     *
     * @var        DateTime
     */
    protected $fecha_limite;

    /**
     * The value for the estado field.
     *
     * @var        string
     */
    protected $estado;

    /**
     * The value for the modalidad field.
     *
     * @var        string
     */
    protected $modalidad;

    /**
     * The value for the tipo_convocatoria field.
     *
     * @var        string
     */
    protected $tipo_convocatoria;

    /**
     * The value for the tipo_consultoria field.
     *
     * @var        string
     */
    protected $tipo_consultoria;

    /**
     * The value for the forma_adjudicacion field.
     *
     * @var        string
     */
    protected $forma_adjudicacion;

    /**
     * The value for the tipo_contratacion field.
     *
     * @var        string
     */
    protected $tipo_contratacion;

    /**
     * The value for the garantias_solicitadas field.
     *
     * @var        string
     */
    protected $garantias_solicitadas;

    /**
     * The value for the enlace field.
     *
     * @var        string
     */
    protected $enlace;

    /**
     * The value for the departamento field.
     *
     * @var        string
     */
    protected $departamento;

    /**
     * The value for the contacto field.
     *
     * @var        string
     */
    protected $contacto;

    /**
     * The value for the status field.
     *
     * @var        string
     */
    protected $status;

    /**
     * The value for the creation_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $creation_date;

    /**
     * The value for the modification_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $modification_date;

    /**
     * @var        ObjectCollection|ChildJobSicoesDetalle[] Collection to store aggregation of ChildJobSicoesDetalle objects.
     */
    protected $collJobSicoesDetalles;
    protected $collJobSicoesDetallesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobSicoesDetalle[]
     */
    protected $jobSicoesDetallesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of Base\JobSicoesConvocatoria object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>JobSicoesConvocatoria</code> instance.  If
     * <code>obj</code> is an instance of <code>JobSicoesConvocatoria</code>, delegates to
     * <code>equals(JobSicoesConvocatoria)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|JobSicoesConvocatoria The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [cuce] column value.
     *
     * @return string
     */
    public function getCuce()
    {
        return $this->cuce;
    }

    /**
     * Get the [codigo_sisin] column value.
     *
     * @return string
     */
    public function getCodigoSisin()
    {
        return $this->codigo_sisin;
    }

    /**
     * Get the [objeto_licitacion] column value.
     *
     * @return string
     */
    public function getObjetoLicitacion()
    {
        return $this->objeto_licitacion;
    }

    /**
     * Get the [nombre_entidad] column value.
     *
     * @return string
     */
    public function getNombreEntidad()
    {
        return $this->nombre_entidad;
    }

    /**
     * Get the [codigo_entidad] column value.
     *
     * @return string
     */
    public function getCodigoEntidad()
    {
        return $this->codigo_entidad;
    }

    /**
     * Get the [telefono_entidad] column value.
     *
     * @return string
     */
    public function getTelefonoEntidad()
    {
        return $this->telefono_entidad;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_publicacion] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaPublicacion($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_publicacion;
        } else {
            return $this->fecha_publicacion instanceof \DateTimeInterface ? $this->fecha_publicacion->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fecha_limite] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaLimite($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_limite;
        } else {
            return $this->fecha_limite instanceof \DateTimeInterface ? $this->fecha_limite->format($format) : null;
        }
    }

    /**
     * Get the [estado] column value.
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get the [modalidad] column value.
     *
     * @return string
     */
    public function getModalidad()
    {
        return $this->modalidad;
    }

    /**
     * Get the [tipo_convocatoria] column value.
     *
     * @return string
     */
    public function getTipoConvocatoria()
    {
        return $this->tipo_convocatoria;
    }

    /**
     * Get the [tipo_consultoria] column value.
     *
     * @return string
     */
    public function getTipoConsultoria()
    {
        return $this->tipo_consultoria;
    }

    /**
     * Get the [forma_adjudicacion] column value.
     *
     * @return string
     */
    public function getFormaAdjudicacion()
    {
        return $this->forma_adjudicacion;
    }

    /**
     * Get the [tipo_contratacion] column value.
     *
     * @return string
     */
    public function getTipoContratacion()
    {
        return $this->tipo_contratacion;
    }

    /**
     * Get the [garantias_solicitadas] column value.
     *
     * @return string
     */
    public function getGarantiasSolicitadas()
    {
        return $this->garantias_solicitadas;
    }

    /**
     * Get the [enlace] column value.
     *
     * @return string
     */
    public function getEnlace()
    {
        return $this->enlace;
    }

    /**
     * Get the [departamento] column value.
     *
     * @return string
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Get the [contacto] column value.
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [optionally formatted] temporal [creation_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreationDate($format = NULL)
    {
        if ($format === null) {
            return $this->creation_date;
        } else {
            return $this->creation_date instanceof \DateTimeInterface ? $this->creation_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [modification_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getModificationDate($format = NULL)
    {
        if ($format === null) {
            return $this->modification_date;
        } else {
            return $this->modification_date instanceof \DateTimeInterface ? $this->modification_date->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [cuce] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setCuce($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cuce !== $v) {
            $this->cuce = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_CUCE] = true;
        }

        return $this;
    } // setCuce()

    /**
     * Set the value of [codigo_sisin] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setCodigoSisin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codigo_sisin !== $v) {
            $this->codigo_sisin = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_CODIGO_SISIN] = true;
        }

        return $this;
    } // setCodigoSisin()

    /**
     * Set the value of [objeto_licitacion] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setObjetoLicitacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->objeto_licitacion !== $v) {
            $this->objeto_licitacion = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_OBJETO_LICITACION] = true;
        }

        return $this;
    } // setObjetoLicitacion()

    /**
     * Set the value of [nombre_entidad] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setNombreEntidad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_entidad !== $v) {
            $this->nombre_entidad = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_NOMBRE_ENTIDAD] = true;
        }

        return $this;
    } // setNombreEntidad()

    /**
     * Set the value of [codigo_entidad] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setCodigoEntidad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codigo_entidad !== $v) {
            $this->codigo_entidad = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_CODIGO_ENTIDAD] = true;
        }

        return $this;
    } // setCodigoEntidad()

    /**
     * Set the value of [telefono_entidad] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setTelefonoEntidad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefono_entidad !== $v) {
            $this->telefono_entidad = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_TELEFONO_ENTIDAD] = true;
        }

        return $this;
    } // setTelefonoEntidad()

    /**
     * Sets the value of [fecha_publicacion] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setFechaPublicacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_publicacion !== null || $dt !== null) {
            if ($this->fecha_publicacion === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_publicacion->format("Y-m-d")) {
                $this->fecha_publicacion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_FECHA_PUBLICACION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaPublicacion()

    /**
     * Sets the value of [fecha_limite] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setFechaLimite($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_limite !== null || $dt !== null) {
            if ($this->fecha_limite === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_limite->format("Y-m-d")) {
                $this->fecha_limite = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_FECHA_LIMITE] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaLimite()

    /**
     * Set the value of [estado] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setEstado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estado !== $v) {
            $this->estado = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_ESTADO] = true;
        }

        return $this;
    } // setEstado()

    /**
     * Set the value of [modalidad] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setModalidad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->modalidad !== $v) {
            $this->modalidad = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_MODALIDAD] = true;
        }

        return $this;
    } // setModalidad()

    /**
     * Set the value of [tipo_convocatoria] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setTipoConvocatoria($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_convocatoria !== $v) {
            $this->tipo_convocatoria = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_TIPO_CONVOCATORIA] = true;
        }

        return $this;
    } // setTipoConvocatoria()

    /**
     * Set the value of [tipo_consultoria] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setTipoConsultoria($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_consultoria !== $v) {
            $this->tipo_consultoria = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_TIPO_CONSULTORIA] = true;
        }

        return $this;
    } // setTipoConsultoria()

    /**
     * Set the value of [forma_adjudicacion] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setFormaAdjudicacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->forma_adjudicacion !== $v) {
            $this->forma_adjudicacion = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_FORMA_ADJUDICACION] = true;
        }

        return $this;
    } // setFormaAdjudicacion()

    /**
     * Set the value of [tipo_contratacion] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setTipoContratacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_contratacion !== $v) {
            $this->tipo_contratacion = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_TIPO_CONTRATACION] = true;
        }

        return $this;
    } // setTipoContratacion()

    /**
     * Set the value of [garantias_solicitadas] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setGarantiasSolicitadas($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->garantias_solicitadas !== $v) {
            $this->garantias_solicitadas = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_GARANTIAS_SOLICITADAS] = true;
        }

        return $this;
    } // setGarantiasSolicitadas()

    /**
     * Set the value of [enlace] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setEnlace($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->enlace !== $v) {
            $this->enlace = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_ENLACE] = true;
        }

        return $this;
    } // setEnlace()

    /**
     * Set the value of [departamento] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setDepartamento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->departamento !== $v) {
            $this->departamento = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_DEPARTAMENTO] = true;
        }

        return $this;
    } // setDepartamento()

    /**
     * Set the value of [contacto] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setContacto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contacto !== $v) {
            $this->contacto = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_CONTACTO] = true;
        }

        return $this;
    } // setContacto()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->creation_date->format("Y-m-d H:i:s.u")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->modification_date->format("Y-m-d H:i:s.u")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_MODIFICATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setModificationDate()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Cuce', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cuce = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('CodigoSisin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_sisin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('ObjetoLicitacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->objeto_licitacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('NombreEntidad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_entidad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('CodigoEntidad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_entidad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('TelefonoEntidad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono_entidad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('FechaPublicacion', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_publicacion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('FechaLimite', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_limite = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Estado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estado = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Modalidad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->modalidad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('TipoConvocatoria', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_convocatoria = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('TipoConsultoria', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_consultoria = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('FormaAdjudicacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->forma_adjudicacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('TipoContratacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_contratacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('GarantiasSolicitadas', TableMap::TYPE_PHPNAME, $indexType)];
            $this->garantias_solicitadas = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Enlace', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enlace = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Departamento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->departamento = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Contacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contacto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : JobSicoesConvocatoriaTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 22; // 22 = JobSicoesConvocatoriaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobSicoesConvocatoria'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobSicoesConvocatoriaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobSicoesConvocatoriaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJobSicoesDetalles = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobSicoesConvocatoria::setDeleted()
     * @see JobSicoesConvocatoria::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesConvocatoriaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobSicoesConvocatoriaQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSicoesConvocatoriaTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                JobSicoesConvocatoriaTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->jobSicoesDetallesScheduledForDeletion !== null) {
                if (!$this->jobSicoesDetallesScheduledForDeletion->isEmpty()) {
                    \JobSicoesDetalleQuery::create()
                        ->filterByPrimaryKeys($this->jobSicoesDetallesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jobSicoesDetallesScheduledForDeletion = null;
                }
            }

            if ($this->collJobSicoesDetalles !== null) {
                foreach ($this->collJobSicoesDetalles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[JobSicoesConvocatoriaTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobSicoesConvocatoriaTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CUCE)) {
            $modifiedColumns[':p' . $index++]  = 'CUCE';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CODIGO_SISIN)) {
            $modifiedColumns[':p' . $index++]  = 'CODIGO_SISIN';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_OBJETO_LICITACION)) {
            $modifiedColumns[':p' . $index++]  = 'OBJETO_LICITACION';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_NOMBRE_ENTIDAD)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE_ENTIDAD';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CODIGO_ENTIDAD)) {
            $modifiedColumns[':p' . $index++]  = 'CODIGO_ENTIDAD';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TELEFONO_ENTIDAD)) {
            $modifiedColumns[':p' . $index++]  = 'TELEFONO_ENTIDAD';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_FECHA_PUBLICACION)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_PUBLICACION';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_FECHA_LIMITE)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_LIMITE';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = 'ESTADO';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_MODALIDAD)) {
            $modifiedColumns[':p' . $index++]  = 'MODALIDAD';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TIPO_CONVOCATORIA)) {
            $modifiedColumns[':p' . $index++]  = 'TIPO_CONVOCATORIA';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TIPO_CONSULTORIA)) {
            $modifiedColumns[':p' . $index++]  = 'TIPO_CONSULTORIA';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_FORMA_ADJUDICACION)) {
            $modifiedColumns[':p' . $index++]  = 'FORMA_ADJUDICACION';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TIPO_CONTRATACION)) {
            $modifiedColumns[':p' . $index++]  = 'TIPO_CONTRATACION';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_GARANTIAS_SOLICITADAS)) {
            $modifiedColumns[':p' . $index++]  = 'GARANTIAS_SOLICITADAS';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_ENLACE)) {
            $modifiedColumns[':p' . $index++]  = 'ENLACE';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_DEPARTAMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'DEPARTAMENTO';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'CONTACTO';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_sicoes_convocatoria (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'CUCE':
                        $stmt->bindValue($identifier, $this->cuce, PDO::PARAM_STR);
                        break;
                    case 'CODIGO_SISIN':
                        $stmt->bindValue($identifier, $this->codigo_sisin, PDO::PARAM_STR);
                        break;
                    case 'OBJETO_LICITACION':
                        $stmt->bindValue($identifier, $this->objeto_licitacion, PDO::PARAM_STR);
                        break;
                    case 'NOMBRE_ENTIDAD':
                        $stmt->bindValue($identifier, $this->nombre_entidad, PDO::PARAM_STR);
                        break;
                    case 'CODIGO_ENTIDAD':
                        $stmt->bindValue($identifier, $this->codigo_entidad, PDO::PARAM_STR);
                        break;
                    case 'TELEFONO_ENTIDAD':
                        $stmt->bindValue($identifier, $this->telefono_entidad, PDO::PARAM_STR);
                        break;
                    case 'FECHA_PUBLICACION':
                        $stmt->bindValue($identifier, $this->fecha_publicacion ? $this->fecha_publicacion->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'FECHA_LIMITE':
                        $stmt->bindValue($identifier, $this->fecha_limite ? $this->fecha_limite->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ESTADO':
                        $stmt->bindValue($identifier, $this->estado, PDO::PARAM_STR);
                        break;
                    case 'MODALIDAD':
                        $stmt->bindValue($identifier, $this->modalidad, PDO::PARAM_STR);
                        break;
                    case 'TIPO_CONVOCATORIA':
                        $stmt->bindValue($identifier, $this->tipo_convocatoria, PDO::PARAM_STR);
                        break;
                    case 'TIPO_CONSULTORIA':
                        $stmt->bindValue($identifier, $this->tipo_consultoria, PDO::PARAM_STR);
                        break;
                    case 'FORMA_ADJUDICACION':
                        $stmt->bindValue($identifier, $this->forma_adjudicacion, PDO::PARAM_STR);
                        break;
                    case 'TIPO_CONTRATACION':
                        $stmt->bindValue($identifier, $this->tipo_contratacion, PDO::PARAM_STR);
                        break;
                    case 'GARANTIAS_SOLICITADAS':
                        $stmt->bindValue($identifier, $this->garantias_solicitadas, PDO::PARAM_STR);
                        break;
                    case 'ENLACE':
                        $stmt->bindValue($identifier, $this->enlace, PDO::PARAM_STR);
                        break;
                    case 'DEPARTAMENTO':
                        $stmt->bindValue($identifier, $this->departamento, PDO::PARAM_STR);
                        break;
                    case 'CONTACTO':
                        $stmt->bindValue($identifier, $this->contacto, PDO::PARAM_STR);
                        break;
                    case 'STATUS':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'CREATION_DATE':
                        $stmt->bindValue($identifier, $this->creation_date ? $this->creation_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'MODIFICATION_DATE':
                        $stmt->bindValue($identifier, $this->modification_date ? $this->modification_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobSicoesConvocatoriaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCuce();
                break;
            case 2:
                return $this->getCodigoSisin();
                break;
            case 3:
                return $this->getObjetoLicitacion();
                break;
            case 4:
                return $this->getNombreEntidad();
                break;
            case 5:
                return $this->getCodigoEntidad();
                break;
            case 6:
                return $this->getTelefonoEntidad();
                break;
            case 7:
                return $this->getFechaPublicacion();
                break;
            case 8:
                return $this->getFechaLimite();
                break;
            case 9:
                return $this->getEstado();
                break;
            case 10:
                return $this->getModalidad();
                break;
            case 11:
                return $this->getTipoConvocatoria();
                break;
            case 12:
                return $this->getTipoConsultoria();
                break;
            case 13:
                return $this->getFormaAdjudicacion();
                break;
            case 14:
                return $this->getTipoContratacion();
                break;
            case 15:
                return $this->getGarantiasSolicitadas();
                break;
            case 16:
                return $this->getEnlace();
                break;
            case 17:
                return $this->getDepartamento();
                break;
            case 18:
                return $this->getContacto();
                break;
            case 19:
                return $this->getStatus();
                break;
            case 20:
                return $this->getCreationDate();
                break;
            case 21:
                return $this->getModificationDate();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['JobSicoesConvocatoria'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobSicoesConvocatoria'][$this->hashCode()] = true;
        $keys = JobSicoesConvocatoriaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCuce(),
            $keys[2] => $this->getCodigoSisin(),
            $keys[3] => $this->getObjetoLicitacion(),
            $keys[4] => $this->getNombreEntidad(),
            $keys[5] => $this->getCodigoEntidad(),
            $keys[6] => $this->getTelefonoEntidad(),
            $keys[7] => $this->getFechaPublicacion(),
            $keys[8] => $this->getFechaLimite(),
            $keys[9] => $this->getEstado(),
            $keys[10] => $this->getModalidad(),
            $keys[11] => $this->getTipoConvocatoria(),
            $keys[12] => $this->getTipoConsultoria(),
            $keys[13] => $this->getFormaAdjudicacion(),
            $keys[14] => $this->getTipoContratacion(),
            $keys[15] => $this->getGarantiasSolicitadas(),
            $keys[16] => $this->getEnlace(),
            $keys[17] => $this->getDepartamento(),
            $keys[18] => $this->getContacto(),
            $keys[19] => $this->getStatus(),
            $keys[20] => $this->getCreationDate(),
            $keys[21] => $this->getModificationDate(),
        );
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('c');
        }

        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collJobSicoesDetalles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobSicoesDetalles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_sicoes_detalles';
                        break;
                    default:
                        $key = 'JobSicoesDetalles';
                }

                $result[$key] = $this->collJobSicoesDetalles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\JobSicoesConvocatoria
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobSicoesConvocatoriaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobSicoesConvocatoria
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCuce($value);
                break;
            case 2:
                $this->setCodigoSisin($value);
                break;
            case 3:
                $this->setObjetoLicitacion($value);
                break;
            case 4:
                $this->setNombreEntidad($value);
                break;
            case 5:
                $this->setCodigoEntidad($value);
                break;
            case 6:
                $this->setTelefonoEntidad($value);
                break;
            case 7:
                $this->setFechaPublicacion($value);
                break;
            case 8:
                $this->setFechaLimite($value);
                break;
            case 9:
                $this->setEstado($value);
                break;
            case 10:
                $this->setModalidad($value);
                break;
            case 11:
                $this->setTipoConvocatoria($value);
                break;
            case 12:
                $this->setTipoConsultoria($value);
                break;
            case 13:
                $this->setFormaAdjudicacion($value);
                break;
            case 14:
                $this->setTipoContratacion($value);
                break;
            case 15:
                $this->setGarantiasSolicitadas($value);
                break;
            case 16:
                $this->setEnlace($value);
                break;
            case 17:
                $this->setDepartamento($value);
                break;
            case 18:
                $this->setContacto($value);
                break;
            case 19:
                $this->setStatus($value);
                break;
            case 20:
                $this->setCreationDate($value);
                break;
            case 21:
                $this->setModificationDate($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = JobSicoesConvocatoriaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCuce($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCodigoSisin($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setObjetoLicitacion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNombreEntidad($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCodigoEntidad($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTelefonoEntidad($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setFechaPublicacion($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFechaLimite($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEstado($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setModalidad($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTipoConvocatoria($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTipoConsultoria($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setFormaAdjudicacion($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setTipoContratacion($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setGarantiasSolicitadas($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setEnlace($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setDepartamento($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setContacto($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setStatus($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setCreationDate($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setModificationDate($arr[$keys[21]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\JobSicoesConvocatoria The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(JobSicoesConvocatoriaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_ID)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CUCE)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_CUCE, $this->cuce);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CODIGO_SISIN)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_CODIGO_SISIN, $this->codigo_sisin);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_OBJETO_LICITACION)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_OBJETO_LICITACION, $this->objeto_licitacion);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_NOMBRE_ENTIDAD)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_NOMBRE_ENTIDAD, $this->nombre_entidad);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CODIGO_ENTIDAD)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_CODIGO_ENTIDAD, $this->codigo_entidad);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TELEFONO_ENTIDAD)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_TELEFONO_ENTIDAD, $this->telefono_entidad);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_FECHA_PUBLICACION)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_FECHA_PUBLICACION, $this->fecha_publicacion);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_FECHA_LIMITE)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_FECHA_LIMITE, $this->fecha_limite);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_ESTADO)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_ESTADO, $this->estado);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_MODALIDAD)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_MODALIDAD, $this->modalidad);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TIPO_CONVOCATORIA)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_TIPO_CONVOCATORIA, $this->tipo_convocatoria);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TIPO_CONSULTORIA)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_TIPO_CONSULTORIA, $this->tipo_consultoria);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_FORMA_ADJUDICACION)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_FORMA_ADJUDICACION, $this->forma_adjudicacion);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_TIPO_CONTRATACION)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_TIPO_CONTRATACION, $this->tipo_contratacion);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_GARANTIAS_SOLICITADAS)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_GARANTIAS_SOLICITADAS, $this->garantias_solicitadas);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_ENLACE)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_ENLACE, $this->enlace);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_DEPARTAMENTO)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_DEPARTAMENTO, $this->departamento);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CONTACTO)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_CONTACTO, $this->contacto);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_STATUS)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobSicoesConvocatoriaTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(JobSicoesConvocatoriaTableMap::COL_MODIFICATION_DATE, $this->modification_date);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildJobSicoesConvocatoriaQuery::create();
        $criteria->add(JobSicoesConvocatoriaTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \JobSicoesConvocatoria (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCuce($this->getCuce());
        $copyObj->setCodigoSisin($this->getCodigoSisin());
        $copyObj->setObjetoLicitacion($this->getObjetoLicitacion());
        $copyObj->setNombreEntidad($this->getNombreEntidad());
        $copyObj->setCodigoEntidad($this->getCodigoEntidad());
        $copyObj->setTelefonoEntidad($this->getTelefonoEntidad());
        $copyObj->setFechaPublicacion($this->getFechaPublicacion());
        $copyObj->setFechaLimite($this->getFechaLimite());
        $copyObj->setEstado($this->getEstado());
        $copyObj->setModalidad($this->getModalidad());
        $copyObj->setTipoConvocatoria($this->getTipoConvocatoria());
        $copyObj->setTipoConsultoria($this->getTipoConsultoria());
        $copyObj->setFormaAdjudicacion($this->getFormaAdjudicacion());
        $copyObj->setTipoContratacion($this->getTipoContratacion());
        $copyObj->setGarantiasSolicitadas($this->getGarantiasSolicitadas());
        $copyObj->setEnlace($this->getEnlace());
        $copyObj->setDepartamento($this->getDepartamento());
        $copyObj->setContacto($this->getContacto());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getJobSicoesDetalles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobSicoesDetalle($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \JobSicoesConvocatoria Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('JobSicoesDetalle' == $relationName) {
            $this->initJobSicoesDetalles();
            return;
        }
    }

    /**
     * Clears out the collJobSicoesDetalles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobSicoesDetalles()
     */
    public function clearJobSicoesDetalles()
    {
        $this->collJobSicoesDetalles = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobSicoesDetalles collection loaded partially.
     */
    public function resetPartialJobSicoesDetalles($v = true)
    {
        $this->collJobSicoesDetallesPartial = $v;
    }

    /**
     * Initializes the collJobSicoesDetalles collection.
     *
     * By default this just sets the collJobSicoesDetalles collection to an empty array (like clearcollJobSicoesDetalles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobSicoesDetalles($overrideExisting = true)
    {
        if (null !== $this->collJobSicoesDetalles && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobSicoesDetalleTableMap::getTableMap()->getCollectionClassName();

        $this->collJobSicoesDetalles = new $collectionClassName;
        $this->collJobSicoesDetalles->setModel('\JobSicoesDetalle');
    }

    /**
     * Gets an array of ChildJobSicoesDetalle objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobSicoesConvocatoria is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobSicoesDetalle[] List of ChildJobSicoesDetalle objects
     * @throws PropelException
     */
    public function getJobSicoesDetalles(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobSicoesDetallesPartial && !$this->isNew();
        if (null === $this->collJobSicoesDetalles || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobSicoesDetalles) {
                // return empty collection
                $this->initJobSicoesDetalles();
            } else {
                $collJobSicoesDetalles = ChildJobSicoesDetalleQuery::create(null, $criteria)
                    ->filterByJobSicoesConvocatoria($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobSicoesDetallesPartial && count($collJobSicoesDetalles)) {
                        $this->initJobSicoesDetalles(false);

                        foreach ($collJobSicoesDetalles as $obj) {
                            if (false == $this->collJobSicoesDetalles->contains($obj)) {
                                $this->collJobSicoesDetalles->append($obj);
                            }
                        }

                        $this->collJobSicoesDetallesPartial = true;
                    }

                    return $collJobSicoesDetalles;
                }

                if ($partial && $this->collJobSicoesDetalles) {
                    foreach ($this->collJobSicoesDetalles as $obj) {
                        if ($obj->isNew()) {
                            $collJobSicoesDetalles[] = $obj;
                        }
                    }
                }

                $this->collJobSicoesDetalles = $collJobSicoesDetalles;
                $this->collJobSicoesDetallesPartial = false;
            }
        }

        return $this->collJobSicoesDetalles;
    }

    /**
     * Sets a collection of ChildJobSicoesDetalle objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobSicoesDetalles A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobSicoesConvocatoria The current object (for fluent API support)
     */
    public function setJobSicoesDetalles(Collection $jobSicoesDetalles, ConnectionInterface $con = null)
    {
        /** @var ChildJobSicoesDetalle[] $jobSicoesDetallesToDelete */
        $jobSicoesDetallesToDelete = $this->getJobSicoesDetalles(new Criteria(), $con)->diff($jobSicoesDetalles);


        $this->jobSicoesDetallesScheduledForDeletion = $jobSicoesDetallesToDelete;

        foreach ($jobSicoesDetallesToDelete as $jobSicoesDetalleRemoved) {
            $jobSicoesDetalleRemoved->setJobSicoesConvocatoria(null);
        }

        $this->collJobSicoesDetalles = null;
        foreach ($jobSicoesDetalles as $jobSicoesDetalle) {
            $this->addJobSicoesDetalle($jobSicoesDetalle);
        }

        $this->collJobSicoesDetalles = $jobSicoesDetalles;
        $this->collJobSicoesDetallesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobSicoesDetalle objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobSicoesDetalle objects.
     * @throws PropelException
     */
    public function countJobSicoesDetalles(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobSicoesDetallesPartial && !$this->isNew();
        if (null === $this->collJobSicoesDetalles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobSicoesDetalles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobSicoesDetalles());
            }

            $query = ChildJobSicoesDetalleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobSicoesConvocatoria($this)
                ->count($con);
        }

        return count($this->collJobSicoesDetalles);
    }

    /**
     * Method called to associate a ChildJobSicoesDetalle object to this object
     * through the ChildJobSicoesDetalle foreign key attribute.
     *
     * @param  ChildJobSicoesDetalle $l ChildJobSicoesDetalle
     * @return $this|\JobSicoesConvocatoria The current object (for fluent API support)
     */
    public function addJobSicoesDetalle(ChildJobSicoesDetalle $l)
    {
        if ($this->collJobSicoesDetalles === null) {
            $this->initJobSicoesDetalles();
            $this->collJobSicoesDetallesPartial = true;
        }

        if (!$this->collJobSicoesDetalles->contains($l)) {
            $this->doAddJobSicoesDetalle($l);

            if ($this->jobSicoesDetallesScheduledForDeletion and $this->jobSicoesDetallesScheduledForDeletion->contains($l)) {
                $this->jobSicoesDetallesScheduledForDeletion->remove($this->jobSicoesDetallesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobSicoesDetalle $jobSicoesDetalle The ChildJobSicoesDetalle object to add.
     */
    protected function doAddJobSicoesDetalle(ChildJobSicoesDetalle $jobSicoesDetalle)
    {
        $this->collJobSicoesDetalles[]= $jobSicoesDetalle;
        $jobSicoesDetalle->setJobSicoesConvocatoria($this);
    }

    /**
     * @param  ChildJobSicoesDetalle $jobSicoesDetalle The ChildJobSicoesDetalle object to remove.
     * @return $this|ChildJobSicoesConvocatoria The current object (for fluent API support)
     */
    public function removeJobSicoesDetalle(ChildJobSicoesDetalle $jobSicoesDetalle)
    {
        if ($this->getJobSicoesDetalles()->contains($jobSicoesDetalle)) {
            $pos = $this->collJobSicoesDetalles->search($jobSicoesDetalle);
            $this->collJobSicoesDetalles->remove($pos);
            if (null === $this->jobSicoesDetallesScheduledForDeletion) {
                $this->jobSicoesDetallesScheduledForDeletion = clone $this->collJobSicoesDetalles;
                $this->jobSicoesDetallesScheduledForDeletion->clear();
            }
            $this->jobSicoesDetallesScheduledForDeletion[]= clone $jobSicoesDetalle;
            $jobSicoesDetalle->setJobSicoesConvocatoria(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->cuce = null;
        $this->codigo_sisin = null;
        $this->objeto_licitacion = null;
        $this->nombre_entidad = null;
        $this->codigo_entidad = null;
        $this->telefono_entidad = null;
        $this->fecha_publicacion = null;
        $this->fecha_limite = null;
        $this->estado = null;
        $this->modalidad = null;
        $this->tipo_convocatoria = null;
        $this->tipo_consultoria = null;
        $this->forma_adjudicacion = null;
        $this->tipo_contratacion = null;
        $this->garantias_solicitadas = null;
        $this->enlace = null;
        $this->departamento = null;
        $this->contacto = null;
        $this->status = null;
        $this->creation_date = null;
        $this->modification_date = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collJobSicoesDetalles) {
                foreach ($this->collJobSicoesDetalles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collJobSicoesDetalles = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobSicoesConvocatoriaTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
