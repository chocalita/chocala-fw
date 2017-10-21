<?php

namespace Base;

use \JobEntityConvocatoriaTempQuery as ChildJobEntityConvocatoriaTempQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobEntityConvocatoriaTempTableMap;
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
 * Base class that represents a row from the 'job_entity_convocatoria_temp' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class JobEntityConvocatoriaTemp implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobEntityConvocatoriaTempTableMap';


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
     * The value for the company_id field.
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the area_id field.
     * @var        int
     */
    protected $area_id;

    /**
     * The value for the localizacion_id field.
     * @var        int
     */
    protected $localizacion_id;

    /**
     * The value for the salario field.
     * @var        string
     */
    protected $salario;

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
     * The value for the estado field.
     * @var        string
     */
    protected $estado;

    /**
     * The value for the user field.
     * @var        string
     */
    protected $user;

    /**
     * The value for the fecha_registro field.
     * @var        \DateTime
     */
    protected $fecha_registro;

    /**
     * The value for the correo_contacto field.
     * @var        string
     */
    protected $correo_contacto;

    /**
     * The value for the telefono_contacto field.
     * @var        int
     */
    protected $telefono_contacto;

    /**
     * The value for the profesion field.
     * @var        string
     */
    protected $profesion;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\JobEntityConvocatoriaTemp object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>JobEntityConvocatoriaTemp</code> instance.  If
     * <code>obj</code> is an instance of <code>JobEntityConvocatoriaTemp</code>, delegates to
     * <code>equals(JobEntityConvocatoriaTemp)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobEntityConvocatoriaTemp The current object, for fluid interface
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
     * Get the [company_id] column value.
     * 
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
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
     * Get the [localizacion_id] column value.
     * 
     * @return int
     */
    public function getLocalizacionId()
    {
        return $this->localizacion_id;
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
     * Get the [estado] column value.
     * 
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get the [user] column value.
     * 
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_registro] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaRegistro($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_registro;
        } else {
            return $this->fecha_registro instanceof \DateTime ? $this->fecha_registro->format($format) : null;
        }
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
     * Get the [telefono_contacto] column value.
     * 
     * @return int
     */
    public function getTelefonoContacto()
    {
        return $this->telefono_contacto;
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
     * Set the value of [id] column.
     * 
     * @param int $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [company_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID] = true;
        }

        return $this;
    } // setCompanyId()

    /**
     * Set the value of [area_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setAreaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->area_id !== $v) {
            $this->area_id = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_AREA_ID] = true;
        }

        return $this;
    } // setAreaId()

    /**
     * Set the value of [localizacion_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setLocalizacionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->localizacion_id !== $v) {
            $this->localizacion_id = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID] = true;
        }

        return $this;
    } // setLocalizacionId()

    /**
     * Set the value of [salario] column.
     * 
     * @param string $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setSalario($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->salario !== $v) {
            $this->salario = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_SALARIO] = true;
        }

        return $this;
    } // setSalario()

    /**
     * Set the value of [cargo] column.
     * 
     * @param string $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setCargo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cargo !== $v) {
            $this->cargo = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_CARGO] = true;
        }

        return $this;
    } // setCargo()

    /**
     * Set the value of [descripcion] column.
     * 
     * @param string $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION] = true;
        }

        return $this;
    } // setDescripcion()

    /**
     * Sets the value of [fecha_publicacion] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setFechaPublicacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_publicacion !== null || $dt !== null) {
            if ($this->fecha_publicacion === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_publicacion->format("Y-m-d")) {
                $this->fecha_publicacion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaPublicacion()

    /**
     * Sets the value of [fecha_vencimiento] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setFechaVencimiento($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_vencimiento !== null || $dt !== null) {
            if ($this->fecha_vencimiento === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_vencimiento->format("Y-m-d")) {
                $this->fecha_vencimiento = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaVencimiento()

    /**
     * Set the value of [estado] column.
     * 
     * @param string $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setEstado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estado !== $v) {
            $this->estado = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_ESTADO] = true;
        }

        return $this;
    } // setEstado()

    /**
     * Set the value of [user] column.
     * 
     * @param string $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setUser($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user !== $v) {
            $this->user = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_USER] = true;
        }

        return $this;
    } // setUser()

    /**
     * Sets the value of [fecha_registro] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setFechaRegistro($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_registro !== null || $dt !== null) {
            if ($this->fecha_registro === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->fecha_registro->format("Y-m-d H:i:s")) {
                $this->fecha_registro = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaRegistro()

    /**
     * Set the value of [correo_contacto] column.
     * 
     * @param string $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setCorreoContacto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->correo_contacto !== $v) {
            $this->correo_contacto = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO] = true;
        }

        return $this;
    } // setCorreoContacto()

    /**
     * Set the value of [telefono_contacto] column.
     * 
     * @param int $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setTelefonoContacto($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->telefono_contacto !== $v) {
            $this->telefono_contacto = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO] = true;
        }

        return $this;
    } // setTelefonoContacto()

    /**
     * Set the value of [profesion] column.
     * 
     * @param string $v new value
     * @return $this|\JobEntityConvocatoriaTemp The current object (for fluent API support)
     */
    public function setProfesion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->profesion !== $v) {
            $this->profesion = $v;
            $this->modifiedColumns[JobEntityConvocatoriaTempTableMap::COL_PROFESION] = true;
        }

        return $this;
    } // setProfesion()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('AreaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->area_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('LocalizacionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->localizacion_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('Salario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salario = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('Cargo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cargo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('Descripcion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descripcion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('FechaPublicacion', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_publicacion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('FechaVencimiento', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_vencimiento = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('Estado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estado = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('User', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('FechaRegistro', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->fecha_registro = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('CorreoContacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->correo_contacto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('TelefonoContacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono_contacto = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : JobEntityConvocatoriaTempTableMap::translateFieldName('Profesion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->profesion = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = JobEntityConvocatoriaTempTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobEntityConvocatoriaTemp'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobEntityConvocatoriaTempQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobEntityConvocatoriaTemp::setDeleted()
     * @see JobEntityConvocatoriaTemp::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobEntityConvocatoriaTempQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);
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
                JobEntityConvocatoriaTempTableMap::addInstanceToPool($this);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'COMPANY_ID';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_AREA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'AREA_ID';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LOCALIZACION_ID';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_SALARIO)) {
            $modifiedColumns[':p' . $index++]  = 'SALARIO';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_CARGO)) {
            $modifiedColumns[':p' . $index++]  = 'CARGO';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPCION';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_PUBLICACION';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_VENCIMIENTO';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = 'ESTADO';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_USER)) {
            $modifiedColumns[':p' . $index++]  = 'USER';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_REGISTRO';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'CORREO_CONTACTO';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'TELEFONO_CONTACTO';
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_PROFESION)) {
            $modifiedColumns[':p' . $index++]  = 'PROFESION';
        }

        $sql = sprintf(
            'INSERT INTO job_entity_convocatoria_temp (%s) VALUES (%s)',
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
                    case 'COMPANY_ID':                        
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);
                        break;
                    case 'AREA_ID':                        
                        $stmt->bindValue($identifier, $this->area_id, PDO::PARAM_INT);
                        break;
                    case 'LOCALIZACION_ID':                        
                        $stmt->bindValue($identifier, $this->localizacion_id, PDO::PARAM_INT);
                        break;
                    case 'SALARIO':                        
                        $stmt->bindValue($identifier, $this->salario, PDO::PARAM_STR);
                        break;
                    case 'CARGO':                        
                        $stmt->bindValue($identifier, $this->cargo, PDO::PARAM_STR);
                        break;
                    case 'DESCRIPCION':                        
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case 'FECHA_PUBLICACION':                        
                        $stmt->bindValue($identifier, $this->fecha_publicacion ? $this->fecha_publicacion->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'FECHA_VENCIMIENTO':                        
                        $stmt->bindValue($identifier, $this->fecha_vencimiento ? $this->fecha_vencimiento->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'ESTADO':                        
                        $stmt->bindValue($identifier, $this->estado, PDO::PARAM_STR);
                        break;
                    case 'USER':                        
                        $stmt->bindValue($identifier, $this->user, PDO::PARAM_STR);
                        break;
                    case 'FECHA_REGISTRO':                        
                        $stmt->bindValue($identifier, $this->fecha_registro ? $this->fecha_registro->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'CORREO_CONTACTO':                        
                        $stmt->bindValue($identifier, $this->correo_contacto, PDO::PARAM_STR);
                        break;
                    case 'TELEFONO_CONTACTO':                        
                        $stmt->bindValue($identifier, $this->telefono_contacto, PDO::PARAM_INT);
                        break;
                    case 'PROFESION':                        
                        $stmt->bindValue($identifier, $this->profesion, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = JobEntityConvocatoriaTempTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCompanyId();
                break;
            case 2:
                return $this->getAreaId();
                break;
            case 3:
                return $this->getLocalizacionId();
                break;
            case 4:
                return $this->getSalario();
                break;
            case 5:
                return $this->getCargo();
                break;
            case 6:
                return $this->getDescripcion();
                break;
            case 7:
                return $this->getFechaPublicacion();
                break;
            case 8:
                return $this->getFechaVencimiento();
                break;
            case 9:
                return $this->getEstado();
                break;
            case 10:
                return $this->getUser();
                break;
            case 11:
                return $this->getFechaRegistro();
                break;
            case 12:
                return $this->getCorreoContacto();
                break;
            case 13:
                return $this->getTelefonoContacto();
                break;
            case 14:
                return $this->getProfesion();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['JobEntityConvocatoriaTemp'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobEntityConvocatoriaTemp'][$this->hashCode()] = true;
        $keys = JobEntityConvocatoriaTempTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getAreaId(),
            $keys[3] => $this->getLocalizacionId(),
            $keys[4] => $this->getSalario(),
            $keys[5] => $this->getCargo(),
            $keys[6] => $this->getDescripcion(),
            $keys[7] => $this->getFechaPublicacion(),
            $keys[8] => $this->getFechaVencimiento(),
            $keys[9] => $this->getEstado(),
            $keys[10] => $this->getUser(),
            $keys[11] => $this->getFechaRegistro(),
            $keys[12] => $this->getCorreoContacto(),
            $keys[13] => $this->getTelefonoContacto(),
            $keys[14] => $this->getProfesion(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[7]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[7]];
            $result[$keys[7]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[8]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[8]];
            $result[$keys[8]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[11]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[11]];
            $result[$keys[11]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
     * @return $this|\JobEntityConvocatoriaTemp
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobEntityConvocatoriaTempTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobEntityConvocatoriaTemp
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setAreaId($value);
                break;
            case 3:
                $this->setLocalizacionId($value);
                break;
            case 4:
                $this->setSalario($value);
                break;
            case 5:
                $this->setCargo($value);
                break;
            case 6:
                $this->setDescripcion($value);
                break;
            case 7:
                $this->setFechaPublicacion($value);
                break;
            case 8:
                $this->setFechaVencimiento($value);
                break;
            case 9:
                $this->setEstado($value);
                break;
            case 10:
                $this->setUser($value);
                break;
            case 11:
                $this->setFechaRegistro($value);
                break;
            case 12:
                $this->setCorreoContacto($value);
                break;
            case 13:
                $this->setTelefonoContacto($value);
                break;
            case 14:
                $this->setProfesion($value);
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
        $keys = JobEntityConvocatoriaTempTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAreaId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLocalizacionId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSalario($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCargo($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDescripcion($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setFechaPublicacion($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFechaVencimiento($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEstado($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUser($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFechaRegistro($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCorreoContacto($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTelefonoContacto($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setProfesion($arr[$keys[14]]);
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
     * @return $this|\JobEntityConvocatoriaTemp The current object, for fluid interface
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
        $criteria = new Criteria(JobEntityConvocatoriaTempTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_ID)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_AREA_ID)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_AREA_ID, $this->area_id);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_LOCALIZACION_ID, $this->localizacion_id);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_SALARIO)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_SALARIO, $this->salario);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_CARGO)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_CARGO, $this->cargo);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_DESCRIPCION, $this->descripcion);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_FECHA_PUBLICACION, $this->fecha_publicacion);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_FECHA_VENCIMIENTO, $this->fecha_vencimiento);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_ESTADO)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_ESTADO, $this->estado);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_USER)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_USER, $this->user);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_FECHA_REGISTRO, $this->fecha_registro);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_CORREO_CONTACTO, $this->correo_contacto);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_TELEFONO_CONTACTO, $this->telefono_contacto);
        }
        if ($this->isColumnModified(JobEntityConvocatoriaTempTableMap::COL_PROFESION)) {
            $criteria->add(JobEntityConvocatoriaTempTableMap::COL_PROFESION, $this->profesion);
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
        $criteria = ChildJobEntityConvocatoriaTempQuery::create();
        $criteria->add(JobEntityConvocatoriaTempTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobEntityConvocatoriaTemp (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setAreaId($this->getAreaId());
        $copyObj->setLocalizacionId($this->getLocalizacionId());
        $copyObj->setSalario($this->getSalario());
        $copyObj->setCargo($this->getCargo());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setFechaPublicacion($this->getFechaPublicacion());
        $copyObj->setFechaVencimiento($this->getFechaVencimiento());
        $copyObj->setEstado($this->getEstado());
        $copyObj->setUser($this->getUser());
        $copyObj->setFechaRegistro($this->getFechaRegistro());
        $copyObj->setCorreoContacto($this->getCorreoContacto());
        $copyObj->setTelefonoContacto($this->getTelefonoContacto());
        $copyObj->setProfesion($this->getProfesion());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \JobEntityConvocatoriaTemp Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->company_id = null;
        $this->area_id = null;
        $this->localizacion_id = null;
        $this->salario = null;
        $this->cargo = null;
        $this->descripcion = null;
        $this->fecha_publicacion = null;
        $this->fecha_vencimiento = null;
        $this->estado = null;
        $this->user = null;
        $this->fecha_registro = null;
        $this->correo_contacto = null;
        $this->telefono_contacto = null;
        $this->profesion = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobEntityConvocatoriaTempTableMap::DEFAULT_STRING_FORMAT);
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
