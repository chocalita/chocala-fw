<?php

namespace Base;

use \JobEmpresaDirectorioQuery as ChildJobEmpresaDirectorioQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobEmpresaDirectorioTableMap;
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
 * Base class that represents a row from the 'job_empresa_directorio' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class JobEmpresaDirectorio implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobEmpresaDirectorioTableMap';


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
     * The value for the id_matricula field.
     *
     * @var        int
     */
    protected $id_matricula;

    /**
     * The value for the matricula field.
     *
     * @var        string
     */
    protected $matricula;

    /**
     * The value for the info field.
     *
     * @var        string
     */
    protected $info;

    /**
     * The value for the razon field.
     *
     * @var        string
     */
    protected $razon;

    /**
     * The value for the tps field.
     *
     * @var        string
     */
    protected $tps;

    /**
     * The value for the dpto field.
     *
     * @var        string
     */
    protected $dpto;

    /**
     * The value for the municipio field.
     *
     * @var        string
     */
    protected $municipio;

    /**
     * The value for the direccion field.
     *
     * @var        string
     */
    protected $direccion;

    /**
     * The value for the fono field.
     *
     * @var        string
     */
    protected $fono;

    /**
     * The value for the fono2 field.
     *
     * @var        string
     */
    protected $fono2;

    /**
     * The value for the fecha_matricula field.
     *
     * @var        DateTime
     */
    protected $fecha_matricula;

    /**
     * The value for the fecha_renovacion field.
     *
     * @var        DateTime
     */
    protected $fecha_renovacion;

    /**
     * The value for the ult_renov field.
     *
     * @var        int
     */
    protected $ult_renov;

    /**
     * The value for the est_mat field.
     *
     * @var        string
     */
    protected $est_mat;

    /**
     * The value for the cierre field.
     *
     * @var        int
     */
    protected $cierre;

    /**
     * The value for the id_clase field.
     *
     * @var        string
     */
    protected $id_clase;

    /**
     * The value for the num_id field.
     *
     * @var        string
     */
    protected $num_id;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the ctr_act field.
     *
     * @var        string
     */
    protected $ctr_act;

    /**
     * The value for the id_reg field.
     *
     * @var        string
     */
    protected $id_reg;

    /**
     * The value for the visible field.
     *
     * @var        string
     */
    protected $visible;

    /**
     * The value for the fax field.
     *
     * @var        string
     */
    protected $fax;

    /**
     * The value for the mail field.
     *
     * @var        string
     */
    protected $mail;

    /**
     * The value for the actividad field.
     *
     * @var        string
     */
    protected $actividad;

    /**
     * The value for the licencia field.
     *
     * @var        string
     */
    protected $licencia;

    /**
     * The value for the contacto field.
     *
     * @var        string
     */
    protected $contacto;

    /**
     * The value for the seccion field.
     *
     * @var        string
     */
    protected $seccion;

    /**
     * The value for the division field.
     *
     * @var        int
     */
    protected $division;

    /**
     * The value for the clase field.
     *
     * @var        int
     */
    protected $clase;

    /**
     * The value for the grupo field.
     *
     * @var        int
     */
    protected $grupo;

    /**
     * The value for the des1 field.
     *
     * @var        string
     */
    protected $des1;

    /**
     * The value for the des2 field.
     *
     * @var        string
     */
    protected $des2;

    /**
     * The value for the des3 field.
     *
     * @var        string
     */
    protected $des3;

    /**
     * The value for the des4 field.
     *
     * @var        string
     */
    protected $des4;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\JobEmpresaDirectorio object.
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
     * Compares this with another <code>JobEmpresaDirectorio</code> instance.  If
     * <code>obj</code> is an instance of <code>JobEmpresaDirectorio</code>, delegates to
     * <code>equals(JobEmpresaDirectorio)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobEmpresaDirectorio The current object, for fluid interface
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
     * Get the [id_matricula] column value.
     *
     * @return int
     */
    public function getIdMatricula()
    {
        return $this->id_matricula;
    }

    /**
     * Get the [matricula] column value.
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Get the [info] column value.
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Get the [razon] column value.
     *
     * @return string
     */
    public function getRazon()
    {
        return $this->razon;
    }

    /**
     * Get the [tps] column value.
     *
     * @return string
     */
    public function getTps()
    {
        return $this->tps;
    }

    /**
     * Get the [dpto] column value.
     *
     * @return string
     */
    public function getDpto()
    {
        return $this->dpto;
    }

    /**
     * Get the [municipio] column value.
     *
     * @return string
     */
    public function getMunicipio()
    {
        return $this->municipio;
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
     * Get the [fono] column value.
     *
     * @return string
     */
    public function getFono()
    {
        return $this->fono;
    }

    /**
     * Get the [fono2] column value.
     *
     * @return string
     */
    public function getFono2()
    {
        return $this->fono2;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_matricula] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaMatricula($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_matricula;
        } else {
            return $this->fecha_matricula instanceof \DateTimeInterface ? $this->fecha_matricula->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fecha_renovacion] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaRenovacion($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_renovacion;
        } else {
            return $this->fecha_renovacion instanceof \DateTimeInterface ? $this->fecha_renovacion->format($format) : null;
        }
    }

    /**
     * Get the [ult_renov] column value.
     *
     * @return int
     */
    public function getUltRenov()
    {
        return $this->ult_renov;
    }

    /**
     * Get the [est_mat] column value.
     *
     * @return string
     */
    public function getEstMat()
    {
        return $this->est_mat;
    }

    /**
     * Get the [cierre] column value.
     *
     * @return int
     */
    public function getCierre()
    {
        return $this->cierre;
    }

    /**
     * Get the [id_clase] column value.
     *
     * @return string
     */
    public function getIdClase()
    {
        return $this->id_clase;
    }

    /**
     * Get the [num_id] column value.
     *
     * @return string
     */
    public function getNumId()
    {
        return $this->num_id;
    }

    /**
     * Get the [nombre] column value.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the [ctr_act] column value.
     *
     * @return string
     */
    public function getCtrAct()
    {
        return $this->ctr_act;
    }

    /**
     * Get the [id_reg] column value.
     *
     * @return string
     */
    public function getIdReg()
    {
        return $this->id_reg;
    }

    /**
     * Get the [visible] column value.
     *
     * @return string
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Get the [fax] column value.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Get the [mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the [actividad] column value.
     *
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Get the [licencia] column value.
     *
     * @return string
     */
    public function getLicencia()
    {
        return $this->licencia;
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
     * Get the [seccion] column value.
     *
     * @return string
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Get the [division] column value.
     *
     * @return int
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Get the [clase] column value.
     *
     * @return int
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Get the [grupo] column value.
     *
     * @return int
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Get the [des1] column value.
     *
     * @return string
     */
    public function getDes1()
    {
        return $this->des1;
    }

    /**
     * Get the [des2] column value.
     *
     * @return string
     */
    public function getDes2()
    {
        return $this->des2;
    }

    /**
     * Get the [des3] column value.
     *
     * @return string
     */
    public function getDes3()
    {
        return $this->des3;
    }

    /**
     * Get the [des4] column value.
     *
     * @return string
     */
    public function getDes4()
    {
        return $this->des4;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_matricula] column.
     *
     * @param int $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setIdMatricula($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_matricula !== $v) {
            $this->id_matricula = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_ID_MATRICULA] = true;
        }

        return $this;
    } // setIdMatricula()

    /**
     * Set the value of [matricula] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setMatricula($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->matricula !== $v) {
            $this->matricula = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_MATRICULA] = true;
        }

        return $this;
    } // setMatricula()

    /**
     * Set the value of [info] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setInfo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->info !== $v) {
            $this->info = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_INFO] = true;
        }

        return $this;
    } // setInfo()

    /**
     * Set the value of [razon] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setRazon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->razon !== $v) {
            $this->razon = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_RAZON] = true;
        }

        return $this;
    } // setRazon()

    /**
     * Set the value of [tps] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setTps($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tps !== $v) {
            $this->tps = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_TPS] = true;
        }

        return $this;
    } // setTps()

    /**
     * Set the value of [dpto] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setDpto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dpto !== $v) {
            $this->dpto = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_DPTO] = true;
        }

        return $this;
    } // setDpto()

    /**
     * Set the value of [municipio] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setMunicipio($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->municipio !== $v) {
            $this->municipio = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_MUNICIPIO] = true;
        }

        return $this;
    } // setMunicipio()

    /**
     * Set the value of [direccion] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->direccion !== $v) {
            $this->direccion = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_DIRECCION] = true;
        }

        return $this;
    } // setDireccion()

    /**
     * Set the value of [fono] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setFono($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fono !== $v) {
            $this->fono = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_FONO] = true;
        }

        return $this;
    } // setFono()

    /**
     * Set the value of [fono2] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setFono2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fono2 !== $v) {
            $this->fono2 = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_FONO2] = true;
        }

        return $this;
    } // setFono2()

    /**
     * Sets the value of [fecha_matricula] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setFechaMatricula($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_matricula !== null || $dt !== null) {
            if ($this->fecha_matricula === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_matricula->format("Y-m-d")) {
                $this->fecha_matricula = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaMatricula()

    /**
     * Sets the value of [fecha_renovacion] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setFechaRenovacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_renovacion !== null || $dt !== null) {
            if ($this->fecha_renovacion === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_renovacion->format("Y-m-d")) {
                $this->fecha_renovacion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaRenovacion()

    /**
     * Set the value of [ult_renov] column.
     *
     * @param int $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setUltRenov($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ult_renov !== $v) {
            $this->ult_renov = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_ULT_RENOV] = true;
        }

        return $this;
    } // setUltRenov()

    /**
     * Set the value of [est_mat] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setEstMat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->est_mat !== $v) {
            $this->est_mat = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_EST_MAT] = true;
        }

        return $this;
    } // setEstMat()

    /**
     * Set the value of [cierre] column.
     *
     * @param int $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setCierre($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cierre !== $v) {
            $this->cierre = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_CIERRE] = true;
        }

        return $this;
    } // setCierre()

    /**
     * Set the value of [id_clase] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setIdClase($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id_clase !== $v) {
            $this->id_clase = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_ID_CLASE] = true;
        }

        return $this;
    } // setIdClase()

    /**
     * Set the value of [num_id] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setNumId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->num_id !== $v) {
            $this->num_id = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_NUM_ID] = true;
        }

        return $this;
    } // setNumId()

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [ctr_act] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setCtrAct($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ctr_act !== $v) {
            $this->ctr_act = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_CTR_ACT] = true;
        }

        return $this;
    } // setCtrAct()

    /**
     * Set the value of [id_reg] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setIdReg($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id_reg !== $v) {
            $this->id_reg = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_ID_REG] = true;
        }

        return $this;
    } // setIdReg()

    /**
     * Set the value of [visible] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setVisible($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visible !== $v) {
            $this->visible = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_VISIBLE] = true;
        }

        return $this;
    } // setVisible()

    /**
     * Set the value of [fax] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_FAX] = true;
        }

        return $this;
    } // setFax()

    /**
     * Set the value of [mail] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mail !== $v) {
            $this->mail = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_MAIL] = true;
        }

        return $this;
    } // setMail()

    /**
     * Set the value of [actividad] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setActividad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->actividad !== $v) {
            $this->actividad = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_ACTIVIDAD] = true;
        }

        return $this;
    } // setActividad()

    /**
     * Set the value of [licencia] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setLicencia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->licencia !== $v) {
            $this->licencia = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_LICENCIA] = true;
        }

        return $this;
    } // setLicencia()

    /**
     * Set the value of [contacto] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setContacto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contacto !== $v) {
            $this->contacto = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_CONTACTO] = true;
        }

        return $this;
    } // setContacto()

    /**
     * Set the value of [seccion] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setSeccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seccion !== $v) {
            $this->seccion = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_SECCION] = true;
        }

        return $this;
    } // setSeccion()

    /**
     * Set the value of [division] column.
     *
     * @param int $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setDivision($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->division !== $v) {
            $this->division = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_DIVISION] = true;
        }

        return $this;
    } // setDivision()

    /**
     * Set the value of [clase] column.
     *
     * @param int $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setClase($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->clase !== $v) {
            $this->clase = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_CLASE] = true;
        }

        return $this;
    } // setClase()

    /**
     * Set the value of [grupo] column.
     *
     * @param int $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setGrupo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->grupo !== $v) {
            $this->grupo = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_GRUPO] = true;
        }

        return $this;
    } // setGrupo()

    /**
     * Set the value of [des1] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setDes1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->des1 !== $v) {
            $this->des1 = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_DES1] = true;
        }

        return $this;
    } // setDes1()

    /**
     * Set the value of [des2] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setDes2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->des2 !== $v) {
            $this->des2 = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_DES2] = true;
        }

        return $this;
    } // setDes2()

    /**
     * Set the value of [des3] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setDes3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->des3 !== $v) {
            $this->des3 = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_DES3] = true;
        }

        return $this;
    } // setDes3()

    /**
     * Set the value of [des4] column.
     *
     * @param string $v new value
     * @return $this|\JobEmpresaDirectorio The current object (for fluent API support)
     */
    public function setDes4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->des4 !== $v) {
            $this->des4 = $v;
            $this->modifiedColumns[JobEmpresaDirectorioTableMap::COL_DES4] = true;
        }

        return $this;
    } // setDes4()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('IdMatricula', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_matricula = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Matricula', TableMap::TYPE_PHPNAME, $indexType)];
            $this->matricula = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Info', TableMap::TYPE_PHPNAME, $indexType)];
            $this->info = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Razon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->razon = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Tps', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tps = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Dpto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dpto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Municipio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->municipio = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Direccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->direccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Fono', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fono = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Fono2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fono2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('FechaMatricula', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_matricula = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('FechaRenovacion', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_renovacion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('UltRenov', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ult_renov = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('EstMat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->est_mat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Cierre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cierre = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('IdClase', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_clase = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('NumId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->num_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('CtrAct', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ctr_act = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('IdReg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_reg = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Visible', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visible = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Fax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Mail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mail = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Actividad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->actividad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Licencia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->licencia = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Contacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contacto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Seccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->seccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Division', TableMap::TYPE_PHPNAME, $indexType)];
            $this->division = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Clase', TableMap::TYPE_PHPNAME, $indexType)];
            $this->clase = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Grupo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->grupo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Des1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->des1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Des2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->des2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Des3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->des3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : JobEmpresaDirectorioTableMap::translateFieldName('Des4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->des4 = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 35; // 35 = JobEmpresaDirectorioTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobEmpresaDirectorio'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobEmpresaDirectorioQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see JobEmpresaDirectorio::setDeleted()
     * @see JobEmpresaDirectorio::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobEmpresaDirectorioQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
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
                JobEmpresaDirectorioTableMap::addInstanceToPool($this);
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
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID_MATRICULA)) {
            $modifiedColumns[':p' . $index++]  = 'ID_MATRICULA';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_MATRICULA)) {
            $modifiedColumns[':p' . $index++]  = 'MATRICULA';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_INFO)) {
            $modifiedColumns[':p' . $index++]  = 'INFO';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_RAZON)) {
            $modifiedColumns[':p' . $index++]  = 'RAZON';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_TPS)) {
            $modifiedColumns[':p' . $index++]  = 'TPS';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DPTO)) {
            $modifiedColumns[':p' . $index++]  = 'DPTO';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_MUNICIPIO)) {
            $modifiedColumns[':p' . $index++]  = 'MUNICIPIO';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = 'DIRECCION';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FONO)) {
            $modifiedColumns[':p' . $index++]  = 'FONO';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FONO2)) {
            $modifiedColumns[':p' . $index++]  = 'FONO2';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_MATRICULA';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_RENOVACION';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ULT_RENOV)) {
            $modifiedColumns[':p' . $index++]  = 'ULT_RENOV';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_EST_MAT)) {
            $modifiedColumns[':p' . $index++]  = 'EST_MAT';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CIERRE)) {
            $modifiedColumns[':p' . $index++]  = 'CIERRE';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID_CLASE)) {
            $modifiedColumns[':p' . $index++]  = 'ID_CLASE';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_NUM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'NUM_ID';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CTR_ACT)) {
            $modifiedColumns[':p' . $index++]  = 'CTR_ACT';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID_REG)) {
            $modifiedColumns[':p' . $index++]  = 'ID_REG';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_VISIBLE)) {
            $modifiedColumns[':p' . $index++]  = 'VISIBLE';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FAX)) {
            $modifiedColumns[':p' . $index++]  = 'FAX';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_MAIL)) {
            $modifiedColumns[':p' . $index++]  = 'MAIL';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ACTIVIDAD)) {
            $modifiedColumns[':p' . $index++]  = 'ACTIVIDAD';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_LICENCIA)) {
            $modifiedColumns[':p' . $index++]  = 'LICENCIA';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'CONTACTO';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_SECCION)) {
            $modifiedColumns[':p' . $index++]  = 'SECCION';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DIVISION)) {
            $modifiedColumns[':p' . $index++]  = 'DIVISION';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CLASE)) {
            $modifiedColumns[':p' . $index++]  = 'CLASE';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_GRUPO)) {
            $modifiedColumns[':p' . $index++]  = 'GRUPO';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES1)) {
            $modifiedColumns[':p' . $index++]  = 'DES1';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES2)) {
            $modifiedColumns[':p' . $index++]  = 'DES2';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES3)) {
            $modifiedColumns[':p' . $index++]  = 'DES3';
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES4)) {
            $modifiedColumns[':p' . $index++]  = 'DES4';
        }

        $sql = sprintf(
            'INSERT INTO job_empresa_directorio (%s) VALUES (%s)',
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
                    case 'ID_MATRICULA':
                        $stmt->bindValue($identifier, $this->id_matricula, PDO::PARAM_INT);
                        break;
                    case 'MATRICULA':
                        $stmt->bindValue($identifier, $this->matricula, PDO::PARAM_STR);
                        break;
                    case 'INFO':
                        $stmt->bindValue($identifier, $this->info, PDO::PARAM_STR);
                        break;
                    case 'RAZON':
                        $stmt->bindValue($identifier, $this->razon, PDO::PARAM_STR);
                        break;
                    case 'TPS':
                        $stmt->bindValue($identifier, $this->tps, PDO::PARAM_STR);
                        break;
                    case 'DPTO':
                        $stmt->bindValue($identifier, $this->dpto, PDO::PARAM_STR);
                        break;
                    case 'MUNICIPIO':
                        $stmt->bindValue($identifier, $this->municipio, PDO::PARAM_STR);
                        break;
                    case 'DIRECCION':
                        $stmt->bindValue($identifier, $this->direccion, PDO::PARAM_STR);
                        break;
                    case 'FONO':
                        $stmt->bindValue($identifier, $this->fono, PDO::PARAM_STR);
                        break;
                    case 'FONO2':
                        $stmt->bindValue($identifier, $this->fono2, PDO::PARAM_STR);
                        break;
                    case 'FECHA_MATRICULA':
                        $stmt->bindValue($identifier, $this->fecha_matricula ? $this->fecha_matricula->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'FECHA_RENOVACION':
                        $stmt->bindValue($identifier, $this->fecha_renovacion ? $this->fecha_renovacion->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ULT_RENOV':
                        $stmt->bindValue($identifier, $this->ult_renov, PDO::PARAM_INT);
                        break;
                    case 'EST_MAT':
                        $stmt->bindValue($identifier, $this->est_mat, PDO::PARAM_STR);
                        break;
                    case 'CIERRE':
                        $stmt->bindValue($identifier, $this->cierre, PDO::PARAM_INT);
                        break;
                    case 'ID_CLASE':
                        $stmt->bindValue($identifier, $this->id_clase, PDO::PARAM_STR);
                        break;
                    case 'NUM_ID':
                        $stmt->bindValue($identifier, $this->num_id, PDO::PARAM_STR);
                        break;
                    case 'NOMBRE':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'CTR_ACT':
                        $stmt->bindValue($identifier, $this->ctr_act, PDO::PARAM_STR);
                        break;
                    case 'ID_REG':
                        $stmt->bindValue($identifier, $this->id_reg, PDO::PARAM_STR);
                        break;
                    case 'VISIBLE':
                        $stmt->bindValue($identifier, $this->visible, PDO::PARAM_STR);
                        break;
                    case 'FAX':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_STR);
                        break;
                    case 'MAIL':
                        $stmt->bindValue($identifier, $this->mail, PDO::PARAM_STR);
                        break;
                    case 'ACTIVIDAD':
                        $stmt->bindValue($identifier, $this->actividad, PDO::PARAM_STR);
                        break;
                    case 'LICENCIA':
                        $stmt->bindValue($identifier, $this->licencia, PDO::PARAM_STR);
                        break;
                    case 'CONTACTO':
                        $stmt->bindValue($identifier, $this->contacto, PDO::PARAM_STR);
                        break;
                    case 'SECCION':
                        $stmt->bindValue($identifier, $this->seccion, PDO::PARAM_STR);
                        break;
                    case 'DIVISION':
                        $stmt->bindValue($identifier, $this->division, PDO::PARAM_INT);
                        break;
                    case 'CLASE':
                        $stmt->bindValue($identifier, $this->clase, PDO::PARAM_INT);
                        break;
                    case 'GRUPO':
                        $stmt->bindValue($identifier, $this->grupo, PDO::PARAM_INT);
                        break;
                    case 'DES1':
                        $stmt->bindValue($identifier, $this->des1, PDO::PARAM_STR);
                        break;
                    case 'DES2':
                        $stmt->bindValue($identifier, $this->des2, PDO::PARAM_STR);
                        break;
                    case 'DES3':
                        $stmt->bindValue($identifier, $this->des3, PDO::PARAM_STR);
                        break;
                    case 'DES4':
                        $stmt->bindValue($identifier, $this->des4, PDO::PARAM_STR);
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
        $pos = JobEmpresaDirectorioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMatricula();
                break;
            case 2:
                return $this->getMatricula();
                break;
            case 3:
                return $this->getInfo();
                break;
            case 4:
                return $this->getRazon();
                break;
            case 5:
                return $this->getTps();
                break;
            case 6:
                return $this->getDpto();
                break;
            case 7:
                return $this->getMunicipio();
                break;
            case 8:
                return $this->getDireccion();
                break;
            case 9:
                return $this->getFono();
                break;
            case 10:
                return $this->getFono2();
                break;
            case 11:
                return $this->getFechaMatricula();
                break;
            case 12:
                return $this->getFechaRenovacion();
                break;
            case 13:
                return $this->getUltRenov();
                break;
            case 14:
                return $this->getEstMat();
                break;
            case 15:
                return $this->getCierre();
                break;
            case 16:
                return $this->getIdClase();
                break;
            case 17:
                return $this->getNumId();
                break;
            case 18:
                return $this->getNombre();
                break;
            case 19:
                return $this->getCtrAct();
                break;
            case 20:
                return $this->getIdReg();
                break;
            case 21:
                return $this->getVisible();
                break;
            case 22:
                return $this->getFax();
                break;
            case 23:
                return $this->getMail();
                break;
            case 24:
                return $this->getActividad();
                break;
            case 25:
                return $this->getLicencia();
                break;
            case 26:
                return $this->getContacto();
                break;
            case 27:
                return $this->getSeccion();
                break;
            case 28:
                return $this->getDivision();
                break;
            case 29:
                return $this->getClase();
                break;
            case 30:
                return $this->getGrupo();
                break;
            case 31:
                return $this->getDes1();
                break;
            case 32:
                return $this->getDes2();
                break;
            case 33:
                return $this->getDes3();
                break;
            case 34:
                return $this->getDes4();
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

        if (isset($alreadyDumpedObjects['JobEmpresaDirectorio'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobEmpresaDirectorio'][$this->hashCode()] = true;
        $keys = JobEmpresaDirectorioTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdMatricula(),
            $keys[2] => $this->getMatricula(),
            $keys[3] => $this->getInfo(),
            $keys[4] => $this->getRazon(),
            $keys[5] => $this->getTps(),
            $keys[6] => $this->getDpto(),
            $keys[7] => $this->getMunicipio(),
            $keys[8] => $this->getDireccion(),
            $keys[9] => $this->getFono(),
            $keys[10] => $this->getFono2(),
            $keys[11] => $this->getFechaMatricula(),
            $keys[12] => $this->getFechaRenovacion(),
            $keys[13] => $this->getUltRenov(),
            $keys[14] => $this->getEstMat(),
            $keys[15] => $this->getCierre(),
            $keys[16] => $this->getIdClase(),
            $keys[17] => $this->getNumId(),
            $keys[18] => $this->getNombre(),
            $keys[19] => $this->getCtrAct(),
            $keys[20] => $this->getIdReg(),
            $keys[21] => $this->getVisible(),
            $keys[22] => $this->getFax(),
            $keys[23] => $this->getMail(),
            $keys[24] => $this->getActividad(),
            $keys[25] => $this->getLicencia(),
            $keys[26] => $this->getContacto(),
            $keys[27] => $this->getSeccion(),
            $keys[28] => $this->getDivision(),
            $keys[29] => $this->getClase(),
            $keys[30] => $this->getGrupo(),
            $keys[31] => $this->getDes1(),
            $keys[32] => $this->getDes2(),
            $keys[33] => $this->getDes3(),
            $keys[34] => $this->getDes4(),
        );
        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('c');
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
     * @return $this|\JobEmpresaDirectorio
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobEmpresaDirectorioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobEmpresaDirectorio
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdMatricula($value);
                break;
            case 2:
                $this->setMatricula($value);
                break;
            case 3:
                $this->setInfo($value);
                break;
            case 4:
                $this->setRazon($value);
                break;
            case 5:
                $this->setTps($value);
                break;
            case 6:
                $this->setDpto($value);
                break;
            case 7:
                $this->setMunicipio($value);
                break;
            case 8:
                $this->setDireccion($value);
                break;
            case 9:
                $this->setFono($value);
                break;
            case 10:
                $this->setFono2($value);
                break;
            case 11:
                $this->setFechaMatricula($value);
                break;
            case 12:
                $this->setFechaRenovacion($value);
                break;
            case 13:
                $this->setUltRenov($value);
                break;
            case 14:
                $this->setEstMat($value);
                break;
            case 15:
                $this->setCierre($value);
                break;
            case 16:
                $this->setIdClase($value);
                break;
            case 17:
                $this->setNumId($value);
                break;
            case 18:
                $this->setNombre($value);
                break;
            case 19:
                $this->setCtrAct($value);
                break;
            case 20:
                $this->setIdReg($value);
                break;
            case 21:
                $this->setVisible($value);
                break;
            case 22:
                $this->setFax($value);
                break;
            case 23:
                $this->setMail($value);
                break;
            case 24:
                $this->setActividad($value);
                break;
            case 25:
                $this->setLicencia($value);
                break;
            case 26:
                $this->setContacto($value);
                break;
            case 27:
                $this->setSeccion($value);
                break;
            case 28:
                $this->setDivision($value);
                break;
            case 29:
                $this->setClase($value);
                break;
            case 30:
                $this->setGrupo($value);
                break;
            case 31:
                $this->setDes1($value);
                break;
            case 32:
                $this->setDes2($value);
                break;
            case 33:
                $this->setDes3($value);
                break;
            case 34:
                $this->setDes4($value);
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
        $keys = JobEmpresaDirectorioTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdMatricula($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setMatricula($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setInfo($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRazon($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTps($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDpto($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMunicipio($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDireccion($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFono($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setFono2($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFechaMatricula($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setFechaRenovacion($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setUltRenov($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setEstMat($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCierre($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setIdClase($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setNumId($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setNombre($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCtrAct($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setIdReg($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setVisible($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setFax($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setMail($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setActividad($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setLicencia($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setContacto($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setSeccion($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setDivision($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setClase($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setGrupo($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setDes1($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setDes2($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setDes3($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setDes4($arr[$keys[34]]);
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
     * @return $this|\JobEmpresaDirectorio The current object, for fluid interface
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
        $criteria = new Criteria(JobEmpresaDirectorioTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID_MATRICULA)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_ID_MATRICULA, $this->id_matricula);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_MATRICULA)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_MATRICULA, $this->matricula);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_INFO)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_INFO, $this->info);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_RAZON)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_RAZON, $this->razon);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_TPS)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_TPS, $this->tps);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DPTO)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_DPTO, $this->dpto);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_MUNICIPIO)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_MUNICIPIO, $this->municipio);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DIRECCION)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_DIRECCION, $this->direccion);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FONO)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_FONO, $this->fono);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FONO2)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_FONO2, $this->fono2);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA, $this->fecha_matricula);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION, $this->fecha_renovacion);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ULT_RENOV)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_ULT_RENOV, $this->ult_renov);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_EST_MAT)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_EST_MAT, $this->est_mat);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CIERRE)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_CIERRE, $this->cierre);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID_CLASE)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_ID_CLASE, $this->id_clase);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_NUM_ID)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_NUM_ID, $this->num_id);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_NOMBRE)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CTR_ACT)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_CTR_ACT, $this->ctr_act);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ID_REG)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_ID_REG, $this->id_reg);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_VISIBLE)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_VISIBLE, $this->visible);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_FAX)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_FAX, $this->fax);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_MAIL)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_MAIL, $this->mail);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_ACTIVIDAD)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_ACTIVIDAD, $this->actividad);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_LICENCIA)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_LICENCIA, $this->licencia);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CONTACTO)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_CONTACTO, $this->contacto);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_SECCION)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_SECCION, $this->seccion);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DIVISION)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_DIVISION, $this->division);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_CLASE)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_CLASE, $this->clase);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_GRUPO)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_GRUPO, $this->grupo);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES1)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_DES1, $this->des1);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES2)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_DES2, $this->des2);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES3)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_DES3, $this->des3);
        }
        if ($this->isColumnModified(JobEmpresaDirectorioTableMap::COL_DES4)) {
            $criteria->add(JobEmpresaDirectorioTableMap::COL_DES4, $this->des4);
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
        $criteria = ChildJobEmpresaDirectorioQuery::create();
        $criteria->add(JobEmpresaDirectorioTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobEmpresaDirectorio (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setIdMatricula($this->getIdMatricula());
        $copyObj->setMatricula($this->getMatricula());
        $copyObj->setInfo($this->getInfo());
        $copyObj->setRazon($this->getRazon());
        $copyObj->setTps($this->getTps());
        $copyObj->setDpto($this->getDpto());
        $copyObj->setMunicipio($this->getMunicipio());
        $copyObj->setDireccion($this->getDireccion());
        $copyObj->setFono($this->getFono());
        $copyObj->setFono2($this->getFono2());
        $copyObj->setFechaMatricula($this->getFechaMatricula());
        $copyObj->setFechaRenovacion($this->getFechaRenovacion());
        $copyObj->setUltRenov($this->getUltRenov());
        $copyObj->setEstMat($this->getEstMat());
        $copyObj->setCierre($this->getCierre());
        $copyObj->setIdClase($this->getIdClase());
        $copyObj->setNumId($this->getNumId());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setCtrAct($this->getCtrAct());
        $copyObj->setIdReg($this->getIdReg());
        $copyObj->setVisible($this->getVisible());
        $copyObj->setFax($this->getFax());
        $copyObj->setMail($this->getMail());
        $copyObj->setActividad($this->getActividad());
        $copyObj->setLicencia($this->getLicencia());
        $copyObj->setContacto($this->getContacto());
        $copyObj->setSeccion($this->getSeccion());
        $copyObj->setDivision($this->getDivision());
        $copyObj->setClase($this->getClase());
        $copyObj->setGrupo($this->getGrupo());
        $copyObj->setDes1($this->getDes1());
        $copyObj->setDes2($this->getDes2());
        $copyObj->setDes3($this->getDes3());
        $copyObj->setDes4($this->getDes4());
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
     * @return \JobEmpresaDirectorio Clone of current object.
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
        $this->id_matricula = null;
        $this->matricula = null;
        $this->info = null;
        $this->razon = null;
        $this->tps = null;
        $this->dpto = null;
        $this->municipio = null;
        $this->direccion = null;
        $this->fono = null;
        $this->fono2 = null;
        $this->fecha_matricula = null;
        $this->fecha_renovacion = null;
        $this->ult_renov = null;
        $this->est_mat = null;
        $this->cierre = null;
        $this->id_clase = null;
        $this->num_id = null;
        $this->nombre = null;
        $this->ctr_act = null;
        $this->id_reg = null;
        $this->visible = null;
        $this->fax = null;
        $this->mail = null;
        $this->actividad = null;
        $this->licencia = null;
        $this->contacto = null;
        $this->seccion = null;
        $this->division = null;
        $this->clase = null;
        $this->grupo = null;
        $this->des1 = null;
        $this->des2 = null;
        $this->des3 = null;
        $this->des4 = null;
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
        return (string) $this->exportTo(JobEmpresaDirectorioTableMap::DEFAULT_STRING_FORMAT);
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
