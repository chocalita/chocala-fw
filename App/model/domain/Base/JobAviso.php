<?php

namespace Base;

use \JobArea as ChildJobArea;
use \JobAreaQuery as ChildJobAreaQuery;
use \JobAreaTecnica as ChildJobAreaTecnica;
use \JobAreaTecnicaQuery as ChildJobAreaTecnicaQuery;
use \JobAvisoQuery as ChildJobAvisoQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobAvisoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'job_aviso' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class JobAviso implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobAvisoTableMap';


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
     * @var        int
     */
    protected $id;

    /**
     * The value for the area_id field.
     * @var        int
     */
    protected $area_id;

    /**
     * The value for the area_tecnica_id field.
     * @var        int
     */
    protected $area_tecnica_id;

    /**
     * The value for the localizacion field.
     * @var        string
     */
    protected $localizacion;

    /**
     * The value for the cargo field.
     * @var        string
     */
    protected $cargo;

    /**
     * The value for the descripcion field.
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the nombre_empresa field.
     * @var        string
     */
    protected $nombre_empresa;

    /**
     * The value for the direccion field.
     * @var        string
     */
    protected $direccion;

    /**
     * The value for the telefono_contacto field.
     * @var        int
     */
    protected $telefono_contacto;

    /**
     * The value for the correo_contacto field.
     * @var        string
     */
    protected $correo_contacto;

    /**
     * The value for the fecha_publicacion field.
     * @var        \DateTime
     */
    protected $fecha_publicacion;

    /**
     * The value for the fecha_vencimiento field.
     * @var        \DateTime
     */
    protected $fecha_vencimiento;

    /**
     * The value for the requisito field.
     * @var        string
     */
    protected $requisito;

    /**
     * The value for the anios_experiencia field.
     * @var        int
     */
    protected $anios_experiencia;

    /**
     * The value for the nivel_formacion field.
     * @var        string
     */
    protected $nivel_formacion;

    /**
     * The value for the salario field.
     * @var        string
     */
    protected $salario;

    /**
     * The value for the profesion field.
     * @var        string
     */
    protected $profesion;

    /**
     * The value for the fuente field.
     * @var        string
     */
    protected $fuente;

    /**
     * The value for the tiene_imagen field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $tiene_imagen;

    /**
     * The value for the mimetype field.
     * @var        string
     */
    protected $mimetype;

    /**
     * The value for the areas_referencia field.
     * @var        string
     */
    protected $areas_referencia;

    /**
     * The value for the formaciones_referencia field.
     * @var        string
     */
    protected $formaciones_referencia;

    /**
     * The value for the status field.
     * Note: this column has a database default value of: 'ACTIVE'
     * @var        string
     */
    protected $status;

    /**
     * The value for the last_user_id field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $last_user_id;

    /**
     * The value for the creation_date field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        \DateTime
     */
    protected $creation_date;

    /**
     * The value for the modification_date field.
     * @var        \DateTime
     */
    protected $modification_date;

    /**
     * @var        ChildJobAreaTecnica
     */
    protected $aJobAreaTecnica;

    /**
     * @var        ChildJobArea
     */
    protected $aJobArea;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->tiene_imagen = false;
        $this->status = 'ACTIVE';
        $this->last_user_id = '0';
    }

    /**
     * Initializes internal state of Base\JobAviso object.
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
     * Compares this with another <code>JobAviso</code> instance.  If
     * <code>obj</code> is an instance of <code>JobAviso</code>, delegates to
     * <code>equals(JobAviso)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobAviso The current object, for fluid interface
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

        return array_keys(get_object_vars($this));
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
     * Get the [area_id] column value.
     * 
     * @return int
     */
    public function getAreaId()
    {
        return $this->area_id;
    }

    /**
     * Get the [area_tecnica_id] column value.
     * 
     * @return int
     */
    public function getAreaTecnicaId()
    {
        return $this->area_tecnica_id;
    }

    /**
     * Get the [localizacion] column value.
     * 
     * @return string
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Get the [cargo] column value.
     * 
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Get the [descripcion] column value.
     * 
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the [nombre_empresa] column value.
     * 
     * @return string
     */
    public function getNombreEmpresa()
    {
        return $this->nombre_empresa;
    }

    /**
     * Get the [direccion] column value.
     * 
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Get the [telefono_contacto] column value.
     * 
     * @return int
     */
    public function getTelefonoContacto()
    {
        return $this->telefono_contacto;
    }

    /**
     * Get the [correo_contacto] column value.
     * 
     * @return string
     */
    public function getCorreoContacto()
    {
        return $this->correo_contacto;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_publicacion] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
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
            return $this->fecha_publicacion instanceof \DateTime ? $this->fecha_publicacion->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fecha_vencimiento] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaVencimiento($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_vencimiento;
        } else {
            return $this->fecha_vencimiento instanceof \DateTime ? $this->fecha_vencimiento->format($format) : null;
        }
    }

    /**
     * Get the [requisito] column value.
     * 
     * @return string
     */
    public function getRequisito()
    {
        return $this->requisito;
    }

    /**
     * Get the [anios_experiencia] column value.
     * 
     * @return int
     */
    public function getAniosExperiencia()
    {
        return $this->anios_experiencia;
    }

    /**
     * Get the [nivel_formacion] column value.
     * 
     * @return string
     */
    public function getNivelFormacion()
    {
        return $this->nivel_formacion;
    }

    /**
     * Get the [salario] column value.
     * 
     * @return string
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Get the [profesion] column value.
     * 
     * @return string
     */
    public function getProfesion()
    {
        return $this->profesion;
    }

    /**
     * Get the [fuente] column value.
     * 
     * @return string
     */
    public function getFuente()
    {
        return $this->fuente;
    }

    /**
     * Get the [tiene_imagen] column value.
     * 
     * @return boolean
     */
    public function getTieneImagen()
    {
        return $this->tiene_imagen;
    }

    /**
     * Get the [tiene_imagen] column value.
     * 
     * @return boolean
     */
    public function isTieneImagen()
    {
        return $this->getTieneImagen();
    }

    /**
     * Get the [mimetype] column value.
     * 
     * @return string
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Get the [areas_referencia] column value.
     * 
     * @return string
     */
    public function getAreasReferencia()
    {
        return $this->areas_referencia;
    }

    /**
     * Get the [formaciones_referencia] column value.
     * 
     * @return string
     */
    public function getFormacionesReferencia()
    {
        return $this->formaciones_referencia;
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
     * Get the [last_user_id] column value.
     * 
     * @return string
     */
    public function getLastUserId()
    {
        return $this->last_user_id;
    }

    /**
     * Get the [optionally formatted] temporal [creation_date] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
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
            return $this->creation_date instanceof \DateTime ? $this->creation_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [modification_date] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
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
            return $this->modification_date instanceof \DateTime ? $this->modification_date->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     * 
     * @param int $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [area_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setAreaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->area_id !== $v) {
            $this->area_id = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_AREA_ID] = true;
        }

        if ($this->aJobArea !== null && $this->aJobArea->getId() !== $v) {
            $this->aJobArea = null;
        }

        return $this;
    } // setAreaId()

    /**
     * Set the value of [area_tecnica_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setAreaTecnicaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->area_tecnica_id !== $v) {
            $this->area_tecnica_id = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_AREA_TECNICA_ID] = true;
        }

        if ($this->aJobAreaTecnica !== null && $this->aJobAreaTecnica->getId() !== $v) {
            $this->aJobAreaTecnica = null;
        }

        return $this;
    } // setAreaTecnicaId()

    /**
     * Set the value of [localizacion] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setLocalizacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->localizacion !== $v) {
            $this->localizacion = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_LOCALIZACION] = true;
        }

        return $this;
    } // setLocalizacion()

    /**
     * Set the value of [cargo] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setCargo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cargo !== $v) {
            $this->cargo = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_CARGO] = true;
        }

        return $this;
    } // setCargo()

    /**
     * Set the value of [descripcion] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_DESCRIPCION] = true;
        }

        return $this;
    } // setDescripcion()

    /**
     * Set the value of [nombre_empresa] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setNombreEmpresa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_empresa !== $v) {
            $this->nombre_empresa = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_NOMBRE_EMPRESA] = true;
        }

        return $this;
    } // setNombreEmpresa()

    /**
     * Set the value of [direccion] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->direccion !== $v) {
            $this->direccion = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_DIRECCION] = true;
        }

        return $this;
    } // setDireccion()

    /**
     * Set the value of [telefono_contacto] column.
     * 
     * @param int $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setTelefonoContacto($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->telefono_contacto !== $v) {
            $this->telefono_contacto = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_TELEFONO_CONTACTO] = true;
        }

        return $this;
    } // setTelefonoContacto()

    /**
     * Set the value of [correo_contacto] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setCorreoContacto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->correo_contacto !== $v) {
            $this->correo_contacto = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_CORREO_CONTACTO] = true;
        }

        return $this;
    } // setCorreoContacto()

    /**
     * Sets the value of [fecha_publicacion] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setFechaPublicacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_publicacion !== null || $dt !== null) {
            if ($this->fecha_publicacion === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_publicacion->format("Y-m-d")) {
                $this->fecha_publicacion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobAvisoTableMap::COL_FECHA_PUBLICACION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaPublicacion()

    /**
     * Sets the value of [fecha_vencimiento] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setFechaVencimiento($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_vencimiento !== null || $dt !== null) {
            if ($this->fecha_vencimiento === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_vencimiento->format("Y-m-d")) {
                $this->fecha_vencimiento = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobAvisoTableMap::COL_FECHA_VENCIMIENTO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaVencimiento()

    /**
     * Set the value of [requisito] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setRequisito($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requisito !== $v) {
            $this->requisito = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_REQUISITO] = true;
        }

        return $this;
    } // setRequisito()

    /**
     * Set the value of [anios_experiencia] column.
     * 
     * @param int $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setAniosExperiencia($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->anios_experiencia !== $v) {
            $this->anios_experiencia = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_ANIOS_EXPERIENCIA] = true;
        }

        return $this;
    } // setAniosExperiencia()

    /**
     * Set the value of [nivel_formacion] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setNivelFormacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nivel_formacion !== $v) {
            $this->nivel_formacion = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_NIVEL_FORMACION] = true;
        }

        return $this;
    } // setNivelFormacion()

    /**
     * Set the value of [salario] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setSalario($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->salario !== $v) {
            $this->salario = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_SALARIO] = true;
        }

        return $this;
    } // setSalario()

    /**
     * Set the value of [profesion] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setProfesion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->profesion !== $v) {
            $this->profesion = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_PROFESION] = true;
        }

        return $this;
    } // setProfesion()

    /**
     * Set the value of [fuente] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setFuente($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fuente !== $v) {
            $this->fuente = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_FUENTE] = true;
        }

        return $this;
    } // setFuente()

    /**
     * Sets the value of the [tiene_imagen] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setTieneImagen($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->tiene_imagen !== $v) {
            $this->tiene_imagen = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_TIENE_IMAGEN] = true;
        }

        return $this;
    } // setTieneImagen()

    /**
     * Set the value of [mimetype] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setMimetype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mimetype !== $v) {
            $this->mimetype = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_MIMETYPE] = true;
        }

        return $this;
    } // setMimetype()

    /**
     * Set the value of [areas_referencia] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setAreasReferencia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->areas_referencia !== $v) {
            $this->areas_referencia = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_AREAS_REFERENCIA] = true;
        }

        return $this;
    } // setAreasReferencia()

    /**
     * Set the value of [formaciones_referencia] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setFormacionesReferencia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->formaciones_referencia !== $v) {
            $this->formaciones_referencia = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_FORMACIONES_REFERENCIA] = true;
        }

        return $this;
    } // setFormacionesReferencia()

    /**
     * Set the value of [status] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [last_user_id] column.
     * 
     * @param string $v new value
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[JobAvisoTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobAvisoTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobAviso The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->modification_date->format("Y-m-d H:i:s")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobAvisoTableMap::COL_MODIFICATION_DATE] = true;
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
            if ($this->tiene_imagen !== false) {
                return false;
            }

            if ($this->status !== 'ACTIVE') {
                return false;
            }

            if ($this->last_user_id !== '0') {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobAvisoTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobAvisoTableMap::translateFieldName('AreaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->area_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobAvisoTableMap::translateFieldName('AreaTecnicaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->area_tecnica_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobAvisoTableMap::translateFieldName('Localizacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->localizacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobAvisoTableMap::translateFieldName('Cargo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cargo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobAvisoTableMap::translateFieldName('Descripcion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descripcion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobAvisoTableMap::translateFieldName('NombreEmpresa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_empresa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobAvisoTableMap::translateFieldName('Direccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->direccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobAvisoTableMap::translateFieldName('TelefonoContacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono_contacto = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobAvisoTableMap::translateFieldName('CorreoContacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->correo_contacto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobAvisoTableMap::translateFieldName('FechaPublicacion', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_publicacion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobAvisoTableMap::translateFieldName('FechaVencimiento', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_vencimiento = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JobAvisoTableMap::translateFieldName('Requisito', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requisito = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JobAvisoTableMap::translateFieldName('AniosExperiencia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->anios_experiencia = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : JobAvisoTableMap::translateFieldName('NivelFormacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nivel_formacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : JobAvisoTableMap::translateFieldName('Salario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salario = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : JobAvisoTableMap::translateFieldName('Profesion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->profesion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : JobAvisoTableMap::translateFieldName('Fuente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fuente = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : JobAvisoTableMap::translateFieldName('TieneImagen', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tiene_imagen = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : JobAvisoTableMap::translateFieldName('Mimetype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mimetype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : JobAvisoTableMap::translateFieldName('AreasReferencia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->areas_referencia = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : JobAvisoTableMap::translateFieldName('FormacionesReferencia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->formaciones_referencia = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : JobAvisoTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : JobAvisoTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : JobAvisoTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : JobAvisoTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 26; // 26 = JobAvisoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobAviso'), 0, $e);
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
        if ($this->aJobArea !== null && $this->area_id !== $this->aJobArea->getId()) {
            $this->aJobArea = null;
        }
        if ($this->aJobAreaTecnica !== null && $this->area_tecnica_id !== $this->aJobAreaTecnica->getId()) {
            $this->aJobAreaTecnica = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(JobAvisoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobAvisoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aJobAreaTecnica = null;
            $this->aJobArea = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobAviso::setDeleted()
     * @see JobAviso::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAvisoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobAvisoQuery::create()
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

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAvisoTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
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
                JobAvisoTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aJobAreaTecnica !== null) {
                if ($this->aJobAreaTecnica->isModified() || $this->aJobAreaTecnica->isNew()) {
                    $affectedRows += $this->aJobAreaTecnica->save($con);
                }
                $this->setJobAreaTecnica($this->aJobAreaTecnica);
            }

            if ($this->aJobArea !== null) {
                if ($this->aJobArea->isModified() || $this->aJobArea->isNew()) {
                    $affectedRows += $this->aJobArea->save($con);
                }
                $this->setJobArea($this->aJobArea);
            }

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

        $this->modifiedColumns[JobAvisoTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobAvisoTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobAvisoTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_AREA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'AREA_ID';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_AREA_TECNICA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'AREA_TECNICA_ID';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_LOCALIZACION)) {
            $modifiedColumns[':p' . $index++]  = 'LOCALIZACION';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_CARGO)) {
            $modifiedColumns[':p' . $index++]  = 'CARGO';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPCION';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_NOMBRE_EMPRESA)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE_EMPRESA';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = 'DIRECCION';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_TELEFONO_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'TELEFONO_CONTACTO';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_CORREO_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'CORREO_CONTACTO';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FECHA_PUBLICACION)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_PUBLICACION';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FECHA_VENCIMIENTO)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_VENCIMIENTO';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_REQUISITO)) {
            $modifiedColumns[':p' . $index++]  = 'REQUISITO';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_ANIOS_EXPERIENCIA)) {
            $modifiedColumns[':p' . $index++]  = 'ANIOS_EXPERIENCIA';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_NIVEL_FORMACION)) {
            $modifiedColumns[':p' . $index++]  = 'NIVEL_FORMACION';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_SALARIO)) {
            $modifiedColumns[':p' . $index++]  = 'SALARIO';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_PROFESION)) {
            $modifiedColumns[':p' . $index++]  = 'PROFESION';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FUENTE)) {
            $modifiedColumns[':p' . $index++]  = 'FUENTE';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_TIENE_IMAGEN)) {
            $modifiedColumns[':p' . $index++]  = 'TIENE_IMAGEN';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_MIMETYPE)) {
            $modifiedColumns[':p' . $index++]  = 'MIMETYPE';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_AREAS_REFERENCIA)) {
            $modifiedColumns[':p' . $index++]  = 'AREAS_REFERENCIA';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FORMACIONES_REFERENCIA)) {
            $modifiedColumns[':p' . $index++]  = 'FORMACIONES_REFERENCIA';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_aviso (%s) VALUES (%s)',
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
                    case 'AREA_ID':                        
                        $stmt->bindValue($identifier, $this->area_id, PDO::PARAM_INT);
                        break;
                    case 'AREA_TECNICA_ID':                        
                        $stmt->bindValue($identifier, $this->area_tecnica_id, PDO::PARAM_INT);
                        break;
                    case 'LOCALIZACION':                        
                        $stmt->bindValue($identifier, $this->localizacion, PDO::PARAM_STR);
                        break;
                    case 'CARGO':                        
                        $stmt->bindValue($identifier, $this->cargo, PDO::PARAM_STR);
                        break;
                    case 'DESCRIPCION':                        
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case 'NOMBRE_EMPRESA':                        
                        $stmt->bindValue($identifier, $this->nombre_empresa, PDO::PARAM_STR);
                        break;
                    case 'DIRECCION':                        
                        $stmt->bindValue($identifier, $this->direccion, PDO::PARAM_STR);
                        break;
                    case 'TELEFONO_CONTACTO':                        
                        $stmt->bindValue($identifier, $this->telefono_contacto, PDO::PARAM_INT);
                        break;
                    case 'CORREO_CONTACTO':                        
                        $stmt->bindValue($identifier, $this->correo_contacto, PDO::PARAM_STR);
                        break;
                    case 'FECHA_PUBLICACION':                        
                        $stmt->bindValue($identifier, $this->fecha_publicacion ? $this->fecha_publicacion->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'FECHA_VENCIMIENTO':                        
                        $stmt->bindValue($identifier, $this->fecha_vencimiento ? $this->fecha_vencimiento->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'REQUISITO':                        
                        $stmt->bindValue($identifier, $this->requisito, PDO::PARAM_STR);
                        break;
                    case 'ANIOS_EXPERIENCIA':                        
                        $stmt->bindValue($identifier, $this->anios_experiencia, PDO::PARAM_INT);
                        break;
                    case 'NIVEL_FORMACION':                        
                        $stmt->bindValue($identifier, $this->nivel_formacion, PDO::PARAM_STR);
                        break;
                    case 'SALARIO':                        
                        $stmt->bindValue($identifier, $this->salario, PDO::PARAM_STR);
                        break;
                    case 'PROFESION':                        
                        $stmt->bindValue($identifier, $this->profesion, PDO::PARAM_STR);
                        break;
                    case 'FUENTE':                        
                        $stmt->bindValue($identifier, $this->fuente, PDO::PARAM_STR);
                        break;
                    case 'TIENE_IMAGEN':
                        $stmt->bindValue($identifier, (int) $this->tiene_imagen, PDO::PARAM_INT);
                        break;
                    case 'MIMETYPE':                        
                        $stmt->bindValue($identifier, $this->mimetype, PDO::PARAM_STR);
                        break;
                    case 'AREAS_REFERENCIA':                        
                        $stmt->bindValue($identifier, $this->areas_referencia, PDO::PARAM_STR);
                        break;
                    case 'FORMACIONES_REFERENCIA':                        
                        $stmt->bindValue($identifier, $this->formaciones_referencia, PDO::PARAM_STR);
                        break;
                    case 'STATUS':                        
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'LAST_USER_ID':                        
                        $stmt->bindValue($identifier, $this->last_user_id, PDO::PARAM_STR);
                        break;
                    case 'CREATION_DATE':                        
                        $stmt->bindValue($identifier, $this->creation_date ? $this->creation_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'MODIFICATION_DATE':                        
                        $stmt->bindValue($identifier, $this->modification_date ? $this->modification_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = JobAvisoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAreaId();
                break;
            case 2:
                return $this->getAreaTecnicaId();
                break;
            case 3:
                return $this->getLocalizacion();
                break;
            case 4:
                return $this->getCargo();
                break;
            case 5:
                return $this->getDescripcion();
                break;
            case 6:
                return $this->getNombreEmpresa();
                break;
            case 7:
                return $this->getDireccion();
                break;
            case 8:
                return $this->getTelefonoContacto();
                break;
            case 9:
                return $this->getCorreoContacto();
                break;
            case 10:
                return $this->getFechaPublicacion();
                break;
            case 11:
                return $this->getFechaVencimiento();
                break;
            case 12:
                return $this->getRequisito();
                break;
            case 13:
                return $this->getAniosExperiencia();
                break;
            case 14:
                return $this->getNivelFormacion();
                break;
            case 15:
                return $this->getSalario();
                break;
            case 16:
                return $this->getProfesion();
                break;
            case 17:
                return $this->getFuente();
                break;
            case 18:
                return $this->getTieneImagen();
                break;
            case 19:
                return $this->getMimetype();
                break;
            case 20:
                return $this->getAreasReferencia();
                break;
            case 21:
                return $this->getFormacionesReferencia();
                break;
            case 22:
                return $this->getStatus();
                break;
            case 23:
                return $this->getLastUserId();
                break;
            case 24:
                return $this->getCreationDate();
                break;
            case 25:
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

        if (isset($alreadyDumpedObjects['JobAviso'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobAviso'][$this->hashCode()] = true;
        $keys = JobAvisoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAreaId(),
            $keys[2] => $this->getAreaTecnicaId(),
            $keys[3] => $this->getLocalizacion(),
            $keys[4] => $this->getCargo(),
            $keys[5] => $this->getDescripcion(),
            $keys[6] => $this->getNombreEmpresa(),
            $keys[7] => $this->getDireccion(),
            $keys[8] => $this->getTelefonoContacto(),
            $keys[9] => $this->getCorreoContacto(),
            $keys[10] => $this->getFechaPublicacion(),
            $keys[11] => $this->getFechaVencimiento(),
            $keys[12] => $this->getRequisito(),
            $keys[13] => $this->getAniosExperiencia(),
            $keys[14] => $this->getNivelFormacion(),
            $keys[15] => $this->getSalario(),
            $keys[16] => $this->getProfesion(),
            $keys[17] => $this->getFuente(),
            $keys[18] => $this->getTieneImagen(),
            $keys[19] => $this->getMimetype(),
            $keys[20] => $this->getAreasReferencia(),
            $keys[21] => $this->getFormacionesReferencia(),
            $keys[22] => $this->getStatus(),
            $keys[23] => $this->getLastUserId(),
            $keys[24] => $this->getCreationDate(),
            $keys[25] => $this->getModificationDate(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[10]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[10]];
            $result[$keys[10]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[11]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[11]];
            $result[$keys[11]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[24]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[24]];
            $result[$keys[24]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[25]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[25]];
            $result[$keys[25]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aJobAreaTecnica) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobAreaTecnica';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_area_tecnica';
                        break;
                    default:
                        $key = 'JobAreaTecnica';
                }
        
                $result[$key] = $this->aJobAreaTecnica->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aJobArea) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobArea';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_area';
                        break;
                    default:
                        $key = 'JobArea';
                }
        
                $result[$key] = $this->aJobArea->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\JobAviso
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobAvisoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobAviso
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setAreaId($value);
                break;
            case 2:
                $this->setAreaTecnicaId($value);
                break;
            case 3:
                $this->setLocalizacion($value);
                break;
            case 4:
                $this->setCargo($value);
                break;
            case 5:
                $this->setDescripcion($value);
                break;
            case 6:
                $this->setNombreEmpresa($value);
                break;
            case 7:
                $this->setDireccion($value);
                break;
            case 8:
                $this->setTelefonoContacto($value);
                break;
            case 9:
                $this->setCorreoContacto($value);
                break;
            case 10:
                $this->setFechaPublicacion($value);
                break;
            case 11:
                $this->setFechaVencimiento($value);
                break;
            case 12:
                $this->setRequisito($value);
                break;
            case 13:
                $this->setAniosExperiencia($value);
                break;
            case 14:
                $this->setNivelFormacion($value);
                break;
            case 15:
                $this->setSalario($value);
                break;
            case 16:
                $this->setProfesion($value);
                break;
            case 17:
                $this->setFuente($value);
                break;
            case 18:
                $this->setTieneImagen($value);
                break;
            case 19:
                $this->setMimetype($value);
                break;
            case 20:
                $this->setAreasReferencia($value);
                break;
            case 21:
                $this->setFormacionesReferencia($value);
                break;
            case 22:
                $this->setStatus($value);
                break;
            case 23:
                $this->setLastUserId($value);
                break;
            case 24:
                $this->setCreationDate($value);
                break;
            case 25:
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
        $keys = JobAvisoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAreaId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAreaTecnicaId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLocalizacion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCargo($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDescripcion($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNombreEmpresa($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDireccion($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTelefonoContacto($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCorreoContacto($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setFechaPublicacion($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFechaVencimiento($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setRequisito($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setAniosExperiencia($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setNivelFormacion($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setSalario($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setProfesion($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setFuente($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setTieneImagen($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setMimetype($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setAreasReferencia($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setFormacionesReferencia($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setStatus($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setLastUserId($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setCreationDate($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setModificationDate($arr[$keys[25]]);
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
     * @return $this|\JobAviso The current object, for fluid interface
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
        $criteria = new Criteria(JobAvisoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobAvisoTableMap::COL_ID)) {
            $criteria->add(JobAvisoTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_AREA_ID)) {
            $criteria->add(JobAvisoTableMap::COL_AREA_ID, $this->area_id);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_AREA_TECNICA_ID)) {
            $criteria->add(JobAvisoTableMap::COL_AREA_TECNICA_ID, $this->area_tecnica_id);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_LOCALIZACION)) {
            $criteria->add(JobAvisoTableMap::COL_LOCALIZACION, $this->localizacion);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_CARGO)) {
            $criteria->add(JobAvisoTableMap::COL_CARGO, $this->cargo);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_DESCRIPCION)) {
            $criteria->add(JobAvisoTableMap::COL_DESCRIPCION, $this->descripcion);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_NOMBRE_EMPRESA)) {
            $criteria->add(JobAvisoTableMap::COL_NOMBRE_EMPRESA, $this->nombre_empresa);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_DIRECCION)) {
            $criteria->add(JobAvisoTableMap::COL_DIRECCION, $this->direccion);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_TELEFONO_CONTACTO)) {
            $criteria->add(JobAvisoTableMap::COL_TELEFONO_CONTACTO, $this->telefono_contacto);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_CORREO_CONTACTO)) {
            $criteria->add(JobAvisoTableMap::COL_CORREO_CONTACTO, $this->correo_contacto);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FECHA_PUBLICACION)) {
            $criteria->add(JobAvisoTableMap::COL_FECHA_PUBLICACION, $this->fecha_publicacion);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FECHA_VENCIMIENTO)) {
            $criteria->add(JobAvisoTableMap::COL_FECHA_VENCIMIENTO, $this->fecha_vencimiento);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_REQUISITO)) {
            $criteria->add(JobAvisoTableMap::COL_REQUISITO, $this->requisito);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_ANIOS_EXPERIENCIA)) {
            $criteria->add(JobAvisoTableMap::COL_ANIOS_EXPERIENCIA, $this->anios_experiencia);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_NIVEL_FORMACION)) {
            $criteria->add(JobAvisoTableMap::COL_NIVEL_FORMACION, $this->nivel_formacion);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_SALARIO)) {
            $criteria->add(JobAvisoTableMap::COL_SALARIO, $this->salario);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_PROFESION)) {
            $criteria->add(JobAvisoTableMap::COL_PROFESION, $this->profesion);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FUENTE)) {
            $criteria->add(JobAvisoTableMap::COL_FUENTE, $this->fuente);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_TIENE_IMAGEN)) {
            $criteria->add(JobAvisoTableMap::COL_TIENE_IMAGEN, $this->tiene_imagen);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_MIMETYPE)) {
            $criteria->add(JobAvisoTableMap::COL_MIMETYPE, $this->mimetype);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_AREAS_REFERENCIA)) {
            $criteria->add(JobAvisoTableMap::COL_AREAS_REFERENCIA, $this->areas_referencia);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_FORMACIONES_REFERENCIA)) {
            $criteria->add(JobAvisoTableMap::COL_FORMACIONES_REFERENCIA, $this->formaciones_referencia);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_STATUS)) {
            $criteria->add(JobAvisoTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_LAST_USER_ID)) {
            $criteria->add(JobAvisoTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobAvisoTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobAvisoTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(JobAvisoTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildJobAvisoQuery::create();
        $criteria->add(JobAvisoTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobAviso (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAreaId($this->getAreaId());
        $copyObj->setAreaTecnicaId($this->getAreaTecnicaId());
        $copyObj->setLocalizacion($this->getLocalizacion());
        $copyObj->setCargo($this->getCargo());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setNombreEmpresa($this->getNombreEmpresa());
        $copyObj->setDireccion($this->getDireccion());
        $copyObj->setTelefonoContacto($this->getTelefonoContacto());
        $copyObj->setCorreoContacto($this->getCorreoContacto());
        $copyObj->setFechaPublicacion($this->getFechaPublicacion());
        $copyObj->setFechaVencimiento($this->getFechaVencimiento());
        $copyObj->setRequisito($this->getRequisito());
        $copyObj->setAniosExperiencia($this->getAniosExperiencia());
        $copyObj->setNivelFormacion($this->getNivelFormacion());
        $copyObj->setSalario($this->getSalario());
        $copyObj->setProfesion($this->getProfesion());
        $copyObj->setFuente($this->getFuente());
        $copyObj->setTieneImagen($this->getTieneImagen());
        $copyObj->setMimetype($this->getMimetype());
        $copyObj->setAreasReferencia($this->getAreasReferencia());
        $copyObj->setFormacionesReferencia($this->getFormacionesReferencia());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());
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
     * @return \JobAviso Clone of current object.
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
     * Declares an association between this object and a ChildJobAreaTecnica object.
     *
     * @param  ChildJobAreaTecnica $v
     * @return $this|\JobAviso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJobAreaTecnica(ChildJobAreaTecnica $v = null)
    {
        if ($v === null) {
            $this->setAreaTecnicaId(NULL);
        } else {
            $this->setAreaTecnicaId($v->getId());
        }

        $this->aJobAreaTecnica = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJobAreaTecnica object, it will not be re-added.
        if ($v !== null) {
            $v->addJobAviso($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJobAreaTecnica object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJobAreaTecnica The associated ChildJobAreaTecnica object.
     * @throws PropelException
     */
    public function getJobAreaTecnica(ConnectionInterface $con = null)
    {
        if ($this->aJobAreaTecnica === null && ($this->area_tecnica_id !== null)) {
            $this->aJobAreaTecnica = ChildJobAreaTecnicaQuery::create()->findPk($this->area_tecnica_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJobAreaTecnica->addJobAvisos($this);
             */
        }

        return $this->aJobAreaTecnica;
    }

    /**
     * Declares an association between this object and a ChildJobArea object.
     *
     * @param  ChildJobArea $v
     * @return $this|\JobAviso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJobArea(ChildJobArea $v = null)
    {
        if ($v === null) {
            $this->setAreaId(NULL);
        } else {
            $this->setAreaId($v->getId());
        }

        $this->aJobArea = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJobArea object, it will not be re-added.
        if ($v !== null) {
            $v->addJobAviso($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJobArea object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJobArea The associated ChildJobArea object.
     * @throws PropelException
     */
    public function getJobArea(ConnectionInterface $con = null)
    {
        if ($this->aJobArea === null && ($this->area_id !== null)) {
            $this->aJobArea = ChildJobAreaQuery::create()->findPk($this->area_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJobArea->addJobAvisos($this);
             */
        }

        return $this->aJobArea;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aJobAreaTecnica) {
            $this->aJobAreaTecnica->removeJobAviso($this);
        }
        if (null !== $this->aJobArea) {
            $this->aJobArea->removeJobAviso($this);
        }
        $this->id = null;
        $this->area_id = null;
        $this->area_tecnica_id = null;
        $this->localizacion = null;
        $this->cargo = null;
        $this->descripcion = null;
        $this->nombre_empresa = null;
        $this->direccion = null;
        $this->telefono_contacto = null;
        $this->correo_contacto = null;
        $this->fecha_publicacion = null;
        $this->fecha_vencimiento = null;
        $this->requisito = null;
        $this->anios_experiencia = null;
        $this->nivel_formacion = null;
        $this->salario = null;
        $this->profesion = null;
        $this->fuente = null;
        $this->tiene_imagen = null;
        $this->mimetype = null;
        $this->areas_referencia = null;
        $this->formaciones_referencia = null;
        $this->status = null;
        $this->last_user_id = null;
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
        } // if ($deep)

        $this->aJobAreaTecnica = null;
        $this->aJobArea = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobAvisoTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

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
