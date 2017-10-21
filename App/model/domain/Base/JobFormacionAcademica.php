<?php

namespace Base;

use \JobCurriculum as ChildJobCurriculum;
use \JobCurriculumQuery as ChildJobCurriculumQuery;
use \JobFormacionAcademicaQuery as ChildJobFormacionAcademicaQuery;
use \JobProfesion as ChildJobProfesion;
use \JobProfesionQuery as ChildJobProfesionQuery;
use \JobTipoFormacion as ChildJobTipoFormacion;
use \JobTipoFormacionQuery as ChildJobTipoFormacionQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobFormacionAcademicaTableMap;
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
 * Base class that represents a row from the 'job_formacion_academica' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class JobFormacionAcademica implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobFormacionAcademicaTableMap';


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
     * The value for the id_curriculum field.
     * @var        int
     */
    protected $id_curriculum;

    /**
     * The value for the id_tipo_formacion field.
     * @var        int
     */
    protected $id_tipo_formacion;

    /**
     * The value for the id_profesion field.
     * @var        int
     */
    protected $id_profesion;

    /**
     * The value for the id_institucion field.
     * @var        int
     */
    protected $id_institucion;

    /**
     * The value for the nombre_institucion field.
     * @var        string
     */
    protected $nombre_institucion;

    /**
     * The value for the nombre_estudios field.
     * @var        string
     */
    protected $nombre_estudios;

    /**
     * The value for the nombre_titulo field.
     * @var        string
     */
    protected $nombre_titulo;

    /**
     * The value for the fecha_inicio field.
     * @var        \DateTime
     */
    protected $fecha_inicio;

    /**
     * The value for the fecha_fin field.
     * @var        \DateTime
     */
    protected $fecha_fin;

    /**
     * The value for the estudiante field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $estudiante;

    /**
     * The value for the egresado field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $egresado;

    /**
     * The value for the titulado_academico field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $titulado_academico;

    /**
     * The value for the titulado_convalidado field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $titulado_convalidado;

    /**
     * The value for the anios_cursados field.
     * @var        string
     */
    protected $anios_cursados;

    /**
     * The value for the documento_egreso field.
     * @var        string
     */
    protected $documento_egreso;

    /**
     * The value for the documento_academico field.
     * @var        string
     */
    protected $documento_academico;

    /**
     * The value for the documento_convalidado field.
     * @var        string
     */
    protected $documento_convalidado;

    /**
     * The value for the fecha_egreso field.
     * @var        \DateTime
     */
    protected $fecha_egreso;

    /**
     * The value for the fecha_titulacion field.
     * @var        \DateTime
     */
    protected $fecha_titulacion;

    /**
     * The value for the verificaciones field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $verificaciones;

    /**
     * The value for the status field.
     * Note: this column has a database default value of: 'ACTIVE'
     * @var        string
     */
    protected $status;

    /**
     * The value for the last_user_id field.
     * Note: this column has a database default value of: 0
     * @var        int
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
     * Note: this column has a database default value of: NULL
     * @var        \DateTime
     */
    protected $modification_date;

    /**
     * @var        ChildJobTipoFormacion
     */
    protected $aJobTipoFormacion;

    /**
     * @var        ChildJobProfesion
     */
    protected $aJobProfesion;

    /**
     * @var        ChildJobCurriculum
     */
    protected $aJobCurriculum;

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
        $this->estudiante = false;
        $this->egresado = false;
        $this->titulado_academico = false;
        $this->titulado_convalidado = false;
        $this->verificaciones = 0;
        $this->status = 'ACTIVE';
        $this->last_user_id = 0;
        $this->modification_date = PropelDateTime::newInstance(NULL, null, 'DateTime');
    }

    /**
     * Initializes internal state of Base\JobFormacionAcademica object.
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
     * Compares this with another <code>JobFormacionAcademica</code> instance.  If
     * <code>obj</code> is an instance of <code>JobFormacionAcademica</code>, delegates to
     * <code>equals(JobFormacionAcademica)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobFormacionAcademica The current object, for fluid interface
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
     * Get the [id_curriculum] column value.
     * 
     * @return int
     */
    public function getIdCurriculum()
    {
        return $this->id_curriculum;
    }

    /**
     * Get the [id_tipo_formacion] column value.
     * 
     * @return int
     */
    public function getIdTipoFormacion()
    {
        return $this->id_tipo_formacion;
    }

    /**
     * Get the [id_profesion] column value.
     * 
     * @return int
     */
    public function getIdProfesion()
    {
        return $this->id_profesion;
    }

    /**
     * Get the [id_institucion] column value.
     * 
     * @return int
     */
    public function getIdInstitucion()
    {
        return $this->id_institucion;
    }

    /**
     * Get the [nombre_institucion] column value.
     * 
     * @return string
     */
    public function getNombreInstitucion()
    {
        return $this->nombre_institucion;
    }

    /**
     * Get the [nombre_estudios] column value.
     * 
     * @return string
     */
    public function getNombreEstudios()
    {
        return $this->nombre_estudios;
    }

    /**
     * Get the [nombre_titulo] column value.
     * 
     * @return string
     */
    public function getNombreTitulo()
    {
        return $this->nombre_titulo;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_inicio] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaInicio($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_inicio;
        } else {
            return $this->fecha_inicio instanceof \DateTime ? $this->fecha_inicio->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fecha_fin] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaFin($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_fin;
        } else {
            return $this->fecha_fin instanceof \DateTime ? $this->fecha_fin->format($format) : null;
        }
    }

    /**
     * Get the [estudiante] column value.
     * 
     * @return boolean
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Get the [estudiante] column value.
     * 
     * @return boolean
     */
    public function isEstudiante()
    {
        return $this->getEstudiante();
    }

    /**
     * Get the [egresado] column value.
     * 
     * @return boolean
     */
    public function getEgresado()
    {
        return $this->egresado;
    }

    /**
     * Get the [egresado] column value.
     * 
     * @return boolean
     */
    public function isEgresado()
    {
        return $this->getEgresado();
    }

    /**
     * Get the [titulado_academico] column value.
     * 
     * @return boolean
     */
    public function getTituladoAcademico()
    {
        return $this->titulado_academico;
    }

    /**
     * Get the [titulado_academico] column value.
     * 
     * @return boolean
     */
    public function isTituladoAcademico()
    {
        return $this->getTituladoAcademico();
    }

    /**
     * Get the [titulado_convalidado] column value.
     * 
     * @return boolean
     */
    public function getTituladoConvalidado()
    {
        return $this->titulado_convalidado;
    }

    /**
     * Get the [titulado_convalidado] column value.
     * 
     * @return boolean
     */
    public function isTituladoConvalidado()
    {
        return $this->getTituladoConvalidado();
    }

    /**
     * Get the [anios_cursados] column value.
     * 
     * @return string
     */
    public function getAniosCursados()
    {
        return $this->anios_cursados;
    }

    /**
     * Get the [documento_egreso] column value.
     * 
     * @return string
     */
    public function getDocumentoEgreso()
    {
        return $this->documento_egreso;
    }

    /**
     * Get the [documento_academico] column value.
     * 
     * @return string
     */
    public function getDocumentoAcademico()
    {
        return $this->documento_academico;
    }

    /**
     * Get the [documento_convalidado] column value.
     * 
     * @return string
     */
    public function getDocumentoConvalidado()
    {
        return $this->documento_convalidado;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_egreso] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaEgreso($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_egreso;
        } else {
            return $this->fecha_egreso instanceof \DateTime ? $this->fecha_egreso->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fecha_titulacion] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaTitulacion($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_titulacion;
        } else {
            return $this->fecha_titulacion instanceof \DateTime ? $this->fecha_titulacion->format($format) : null;
        }
    }

    /**
     * Get the [verificaciones] column value.
     * 
     * @return int
     */
    public function getVerificaciones()
    {
        return $this->verificaciones;
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
     * @return int
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
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_curriculum] column.
     * 
     * @param int $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setIdCurriculum($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_curriculum !== $v) {
            $this->id_curriculum = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ID_CURRICULUM] = true;
        }

        if ($this->aJobCurriculum !== null && $this->aJobCurriculum->getId() !== $v) {
            $this->aJobCurriculum = null;
        }

        return $this;
    } // setIdCurriculum()

    /**
     * Set the value of [id_tipo_formacion] column.
     * 
     * @param int $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setIdTipoFormacion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_tipo_formacion !== $v) {
            $this->id_tipo_formacion = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION] = true;
        }

        if ($this->aJobTipoFormacion !== null && $this->aJobTipoFormacion->getId() !== $v) {
            $this->aJobTipoFormacion = null;
        }

        return $this;
    } // setIdTipoFormacion()

    /**
     * Set the value of [id_profesion] column.
     * 
     * @param int $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setIdProfesion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_profesion !== $v) {
            $this->id_profesion = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ID_PROFESION] = true;
        }

        if ($this->aJobProfesion !== null && $this->aJobProfesion->getId() !== $v) {
            $this->aJobProfesion = null;
        }

        return $this;
    } // setIdProfesion()

    /**
     * Set the value of [id_institucion] column.
     * 
     * @param int $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setIdInstitucion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_institucion !== $v) {
            $this->id_institucion = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ID_INSTITUCION] = true;
        }

        return $this;
    } // setIdInstitucion()

    /**
     * Set the value of [nombre_institucion] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setNombreInstitucion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_institucion !== $v) {
            $this->nombre_institucion = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION] = true;
        }

        return $this;
    } // setNombreInstitucion()

    /**
     * Set the value of [nombre_estudios] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setNombreEstudios($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_estudios !== $v) {
            $this->nombre_estudios = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS] = true;
        }

        return $this;
    } // setNombreEstudios()

    /**
     * Set the value of [nombre_titulo] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setNombreTitulo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_titulo !== $v) {
            $this->nombre_titulo = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO] = true;
        }

        return $this;
    } // setNombreTitulo()

    /**
     * Sets the value of [fecha_inicio] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setFechaInicio($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_inicio !== null || $dt !== null) {
            if ($this->fecha_inicio === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_inicio->format("Y-m-d")) {
                $this->fecha_inicio = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_FECHA_INICIO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaInicio()

    /**
     * Sets the value of [fecha_fin] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setFechaFin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_fin !== null || $dt !== null) {
            if ($this->fecha_fin === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_fin->format("Y-m-d")) {
                $this->fecha_fin = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_FECHA_FIN] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaFin()

    /**
     * Sets the value of the [estudiante] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setEstudiante($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->estudiante !== $v) {
            $this->estudiante = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ESTUDIANTE] = true;
        }

        return $this;
    } // setEstudiante()

    /**
     * Sets the value of the [egresado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setEgresado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->egresado !== $v) {
            $this->egresado = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_EGRESADO] = true;
        }

        return $this;
    } // setEgresado()

    /**
     * Sets the value of the [titulado_academico] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setTituladoAcademico($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->titulado_academico !== $v) {
            $this->titulado_academico = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO] = true;
        }

        return $this;
    } // setTituladoAcademico()

    /**
     * Sets the value of the [titulado_convalidado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setTituladoConvalidado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->titulado_convalidado !== $v) {
            $this->titulado_convalidado = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO] = true;
        }

        return $this;
    } // setTituladoConvalidado()

    /**
     * Set the value of [anios_cursados] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setAniosCursados($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->anios_cursados !== $v) {
            $this->anios_cursados = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS] = true;
        }

        return $this;
    } // setAniosCursados()

    /**
     * Set the value of [documento_egreso] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setDocumentoEgreso($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->documento_egreso !== $v) {
            $this->documento_egreso = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO] = true;
        }

        return $this;
    } // setDocumentoEgreso()

    /**
     * Set the value of [documento_academico] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setDocumentoAcademico($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->documento_academico !== $v) {
            $this->documento_academico = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO] = true;
        }

        return $this;
    } // setDocumentoAcademico()

    /**
     * Set the value of [documento_convalidado] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setDocumentoConvalidado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->documento_convalidado !== $v) {
            $this->documento_convalidado = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO] = true;
        }

        return $this;
    } // setDocumentoConvalidado()

    /**
     * Sets the value of [fecha_egreso] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setFechaEgreso($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_egreso !== null || $dt !== null) {
            if ($this->fecha_egreso === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_egreso->format("Y-m-d")) {
                $this->fecha_egreso = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_FECHA_EGRESO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaEgreso()

    /**
     * Sets the value of [fecha_titulacion] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setFechaTitulacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_titulacion !== null || $dt !== null) {
            if ($this->fecha_titulacion === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_titulacion->format("Y-m-d")) {
                $this->fecha_titulacion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_FECHA_TITULACION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaTitulacion()

    /**
     * Set the value of [verificaciones] column.
     * 
     * @param int $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setVerificaciones($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->verificaciones !== $v) {
            $this->verificaciones = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_VERIFICACIONES] = true;
        }

        return $this;
    } // setVerificaciones()

    /**
     * Set the value of [status] column.
     * 
     * @param string $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [last_user_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ( ($dt != $this->modification_date) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE] = true;
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
            if ($this->estudiante !== false) {
                return false;
            }

            if ($this->egresado !== false) {
                return false;
            }

            if ($this->titulado_academico !== false) {
                return false;
            }

            if ($this->titulado_convalidado !== false) {
                return false;
            }

            if ($this->verificaciones !== 0) {
                return false;
            }

            if ($this->status !== 'ACTIVE') {
                return false;
            }

            if ($this->last_user_id !== 0) {
                return false;
            }

            if ($this->modification_date && $this->modification_date->format('Y-m-d H:i:s') !== NULL) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('IdCurriculum', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_curriculum = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('IdTipoFormacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_tipo_formacion = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('IdProfesion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_profesion = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('IdInstitucion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_institucion = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('NombreInstitucion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_institucion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('NombreEstudios', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_estudios = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('NombreTitulo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_titulo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('FechaInicio', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_inicio = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('FechaFin', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_fin = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('Estudiante', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estudiante = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('Egresado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->egresado = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('TituladoAcademico', TableMap::TYPE_PHPNAME, $indexType)];
            $this->titulado_academico = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('TituladoConvalidado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->titulado_convalidado = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('AniosCursados', TableMap::TYPE_PHPNAME, $indexType)];
            $this->anios_cursados = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('DocumentoEgreso', TableMap::TYPE_PHPNAME, $indexType)];
            $this->documento_egreso = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('DocumentoAcademico', TableMap::TYPE_PHPNAME, $indexType)];
            $this->documento_academico = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('DocumentoConvalidado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->documento_convalidado = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('FechaEgreso', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_egreso = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('FechaTitulacion', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_titulacion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('Verificaciones', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verificaciones = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : JobFormacionAcademicaTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 25; // 25 = JobFormacionAcademicaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobFormacionAcademica'), 0, $e);
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
        if ($this->aJobCurriculum !== null && $this->id_curriculum !== $this->aJobCurriculum->getId()) {
            $this->aJobCurriculum = null;
        }
        if ($this->aJobTipoFormacion !== null && $this->id_tipo_formacion !== $this->aJobTipoFormacion->getId()) {
            $this->aJobTipoFormacion = null;
        }
        if ($this->aJobProfesion !== null && $this->id_profesion !== $this->aJobProfesion->getId()) {
            $this->aJobProfesion = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobFormacionAcademicaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aJobTipoFormacion = null;
            $this->aJobProfesion = null;
            $this->aJobCurriculum = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobFormacionAcademica::setDeleted()
     * @see JobFormacionAcademica::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobFormacionAcademicaQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
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
                JobFormacionAcademicaTableMap::addInstanceToPool($this);
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

            if ($this->aJobTipoFormacion !== null) {
                if ($this->aJobTipoFormacion->isModified() || $this->aJobTipoFormacion->isNew()) {
                    $affectedRows += $this->aJobTipoFormacion->save($con);
                }
                $this->setJobTipoFormacion($this->aJobTipoFormacion);
            }

            if ($this->aJobProfesion !== null) {
                if ($this->aJobProfesion->isModified() || $this->aJobProfesion->isNew()) {
                    $affectedRows += $this->aJobProfesion->save($con);
                }
                $this->setJobProfesion($this->aJobProfesion);
            }

            if ($this->aJobCurriculum !== null) {
                if ($this->aJobCurriculum->isModified() || $this->aJobCurriculum->isNew()) {
                    $affectedRows += $this->aJobCurriculum->save($con);
                }
                $this->setJobCurriculum($this->aJobCurriculum);
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

        $this->modifiedColumns[JobFormacionAcademicaTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobFormacionAcademicaTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM)) {
            $modifiedColumns[':p' . $index++]  = 'ID_CURRICULUM';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION)) {
            $modifiedColumns[':p' . $index++]  = 'ID_TIPO_FORMACION';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_PROFESION)) {
            $modifiedColumns[':p' . $index++]  = 'ID_PROFESION';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_INSTITUCION)) {
            $modifiedColumns[':p' . $index++]  = 'ID_INSTITUCION';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE_INSTITUCION';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE_ESTUDIOS';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE_TITULO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_INICIO)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_INICIO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_FIN)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_FIN';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ESTUDIANTE)) {
            $modifiedColumns[':p' . $index++]  = 'ESTUDIANTE';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_EGRESADO)) {
            $modifiedColumns[':p' . $index++]  = 'EGRESADO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO)) {
            $modifiedColumns[':p' . $index++]  = 'TITULADO_ACADEMICO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO)) {
            $modifiedColumns[':p' . $index++]  = 'TITULADO_CONVALIDADO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS)) {
            $modifiedColumns[':p' . $index++]  = 'ANIOS_CURSADOS';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO)) {
            $modifiedColumns[':p' . $index++]  = 'DOCUMENTO_EGRESO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO)) {
            $modifiedColumns[':p' . $index++]  = 'DOCUMENTO_ACADEMICO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO)) {
            $modifiedColumns[':p' . $index++]  = 'DOCUMENTO_CONVALIDADO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_EGRESO)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_EGRESO';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_TITULACION)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_TITULACION';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_VERIFICACIONES)) {
            $modifiedColumns[':p' . $index++]  = 'VERIFICACIONES';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_formacion_academica (%s) VALUES (%s)',
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
                    case 'ID_CURRICULUM':                        
                        $stmt->bindValue($identifier, $this->id_curriculum, PDO::PARAM_INT);
                        break;
                    case 'ID_TIPO_FORMACION':                        
                        $stmt->bindValue($identifier, $this->id_tipo_formacion, PDO::PARAM_INT);
                        break;
                    case 'ID_PROFESION':                        
                        $stmt->bindValue($identifier, $this->id_profesion, PDO::PARAM_INT);
                        break;
                    case 'ID_INSTITUCION':                        
                        $stmt->bindValue($identifier, $this->id_institucion, PDO::PARAM_INT);
                        break;
                    case 'NOMBRE_INSTITUCION':                        
                        $stmt->bindValue($identifier, $this->nombre_institucion, PDO::PARAM_STR);
                        break;
                    case 'NOMBRE_ESTUDIOS':                        
                        $stmt->bindValue($identifier, $this->nombre_estudios, PDO::PARAM_STR);
                        break;
                    case 'NOMBRE_TITULO':                        
                        $stmt->bindValue($identifier, $this->nombre_titulo, PDO::PARAM_STR);
                        break;
                    case 'FECHA_INICIO':                        
                        $stmt->bindValue($identifier, $this->fecha_inicio ? $this->fecha_inicio->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'FECHA_FIN':                        
                        $stmt->bindValue($identifier, $this->fecha_fin ? $this->fecha_fin->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'ESTUDIANTE':
                        $stmt->bindValue($identifier, (int) $this->estudiante, PDO::PARAM_INT);
                        break;
                    case 'EGRESADO':
                        $stmt->bindValue($identifier, (int) $this->egresado, PDO::PARAM_INT);
                        break;
                    case 'TITULADO_ACADEMICO':
                        $stmt->bindValue($identifier, (int) $this->titulado_academico, PDO::PARAM_INT);
                        break;
                    case 'TITULADO_CONVALIDADO':
                        $stmt->bindValue($identifier, (int) $this->titulado_convalidado, PDO::PARAM_INT);
                        break;
                    case 'ANIOS_CURSADOS':                        
                        $stmt->bindValue($identifier, $this->anios_cursados, PDO::PARAM_STR);
                        break;
                    case 'DOCUMENTO_EGRESO':                        
                        $stmt->bindValue($identifier, $this->documento_egreso, PDO::PARAM_STR);
                        break;
                    case 'DOCUMENTO_ACADEMICO':                        
                        $stmt->bindValue($identifier, $this->documento_academico, PDO::PARAM_STR);
                        break;
                    case 'DOCUMENTO_CONVALIDADO':                        
                        $stmt->bindValue($identifier, $this->documento_convalidado, PDO::PARAM_STR);
                        break;
                    case 'FECHA_EGRESO':                        
                        $stmt->bindValue($identifier, $this->fecha_egreso ? $this->fecha_egreso->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'FECHA_TITULACION':                        
                        $stmt->bindValue($identifier, $this->fecha_titulacion ? $this->fecha_titulacion->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'VERIFICACIONES':                        
                        $stmt->bindValue($identifier, $this->verificaciones, PDO::PARAM_INT);
                        break;
                    case 'STATUS':                        
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'LAST_USER_ID':                        
                        $stmt->bindValue($identifier, $this->last_user_id, PDO::PARAM_INT);
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
        $pos = JobFormacionAcademicaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCurriculum();
                break;
            case 2:
                return $this->getIdTipoFormacion();
                break;
            case 3:
                return $this->getIdProfesion();
                break;
            case 4:
                return $this->getIdInstitucion();
                break;
            case 5:
                return $this->getNombreInstitucion();
                break;
            case 6:
                return $this->getNombreEstudios();
                break;
            case 7:
                return $this->getNombreTitulo();
                break;
            case 8:
                return $this->getFechaInicio();
                break;
            case 9:
                return $this->getFechaFin();
                break;
            case 10:
                return $this->getEstudiante();
                break;
            case 11:
                return $this->getEgresado();
                break;
            case 12:
                return $this->getTituladoAcademico();
                break;
            case 13:
                return $this->getTituladoConvalidado();
                break;
            case 14:
                return $this->getAniosCursados();
                break;
            case 15:
                return $this->getDocumentoEgreso();
                break;
            case 16:
                return $this->getDocumentoAcademico();
                break;
            case 17:
                return $this->getDocumentoConvalidado();
                break;
            case 18:
                return $this->getFechaEgreso();
                break;
            case 19:
                return $this->getFechaTitulacion();
                break;
            case 20:
                return $this->getVerificaciones();
                break;
            case 21:
                return $this->getStatus();
                break;
            case 22:
                return $this->getLastUserId();
                break;
            case 23:
                return $this->getCreationDate();
                break;
            case 24:
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

        if (isset($alreadyDumpedObjects['JobFormacionAcademica'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobFormacionAcademica'][$this->hashCode()] = true;
        $keys = JobFormacionAcademicaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdCurriculum(),
            $keys[2] => $this->getIdTipoFormacion(),
            $keys[3] => $this->getIdProfesion(),
            $keys[4] => $this->getIdInstitucion(),
            $keys[5] => $this->getNombreInstitucion(),
            $keys[6] => $this->getNombreEstudios(),
            $keys[7] => $this->getNombreTitulo(),
            $keys[8] => $this->getFechaInicio(),
            $keys[9] => $this->getFechaFin(),
            $keys[10] => $this->getEstudiante(),
            $keys[11] => $this->getEgresado(),
            $keys[12] => $this->getTituladoAcademico(),
            $keys[13] => $this->getTituladoConvalidado(),
            $keys[14] => $this->getAniosCursados(),
            $keys[15] => $this->getDocumentoEgreso(),
            $keys[16] => $this->getDocumentoAcademico(),
            $keys[17] => $this->getDocumentoConvalidado(),
            $keys[18] => $this->getFechaEgreso(),
            $keys[19] => $this->getFechaTitulacion(),
            $keys[20] => $this->getVerificaciones(),
            $keys[21] => $this->getStatus(),
            $keys[22] => $this->getLastUserId(),
            $keys[23] => $this->getCreationDate(),
            $keys[24] => $this->getModificationDate(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[8]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[8]];
            $result[$keys[8]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[9]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[9]];
            $result[$keys[9]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[18]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[18]];
            $result[$keys[18]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[19]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[19]];
            $result[$keys[19]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[23]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[23]];
            $result[$keys[23]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[24]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[24]];
            $result[$keys[24]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aJobTipoFormacion) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobTipoFormacion';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_tipo_formacion';
                        break;
                    default:
                        $key = 'JobTipoFormacion';
                }
        
                $result[$key] = $this->aJobTipoFormacion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aJobProfesion) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobProfesion';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_profesion';
                        break;
                    default:
                        $key = 'JobProfesion';
                }
        
                $result[$key] = $this->aJobProfesion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aJobCurriculum) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobCurriculum';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_curriculum';
                        break;
                    default:
                        $key = 'JobCurriculum';
                }
        
                $result[$key] = $this->aJobCurriculum->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\JobFormacionAcademica
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobFormacionAcademicaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobFormacionAcademica
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdCurriculum($value);
                break;
            case 2:
                $this->setIdTipoFormacion($value);
                break;
            case 3:
                $this->setIdProfesion($value);
                break;
            case 4:
                $this->setIdInstitucion($value);
                break;
            case 5:
                $this->setNombreInstitucion($value);
                break;
            case 6:
                $this->setNombreEstudios($value);
                break;
            case 7:
                $this->setNombreTitulo($value);
                break;
            case 8:
                $this->setFechaInicio($value);
                break;
            case 9:
                $this->setFechaFin($value);
                break;
            case 10:
                $this->setEstudiante($value);
                break;
            case 11:
                $this->setEgresado($value);
                break;
            case 12:
                $this->setTituladoAcademico($value);
                break;
            case 13:
                $this->setTituladoConvalidado($value);
                break;
            case 14:
                $this->setAniosCursados($value);
                break;
            case 15:
                $this->setDocumentoEgreso($value);
                break;
            case 16:
                $this->setDocumentoAcademico($value);
                break;
            case 17:
                $this->setDocumentoConvalidado($value);
                break;
            case 18:
                $this->setFechaEgreso($value);
                break;
            case 19:
                $this->setFechaTitulacion($value);
                break;
            case 20:
                $this->setVerificaciones($value);
                break;
            case 21:
                $this->setStatus($value);
                break;
            case 22:
                $this->setLastUserId($value);
                break;
            case 23:
                $this->setCreationDate($value);
                break;
            case 24:
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
        $keys = JobFormacionAcademicaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdCurriculum($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdTipoFormacion($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIdProfesion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIdInstitucion($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNombreInstitucion($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNombreEstudios($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNombreTitulo($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFechaInicio($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFechaFin($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEstudiante($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setEgresado($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTituladoAcademico($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTituladoConvalidado($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setAniosCursados($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setDocumentoEgreso($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDocumentoAcademico($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setDocumentoConvalidado($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setFechaEgreso($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setFechaTitulacion($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setVerificaciones($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setStatus($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setLastUserId($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setCreationDate($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setModificationDate($arr[$keys[24]]);
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
     * @return $this|\JobFormacionAcademica The current object, for fluid interface
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
        $criteria = new Criteria(JobFormacionAcademicaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM, $this->id_curriculum);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION, $this->id_tipo_formacion);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_PROFESION)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_ID_PROFESION, $this->id_profesion);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ID_INSTITUCION)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_ID_INSTITUCION, $this->id_institucion);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION, $this->nombre_institucion);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS, $this->nombre_estudios);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO, $this->nombre_titulo);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_INICIO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_FECHA_INICIO, $this->fecha_inicio);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_FIN)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_FECHA_FIN, $this->fecha_fin);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ESTUDIANTE)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_ESTUDIANTE, $this->estudiante);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_EGRESADO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_EGRESADO, $this->egresado);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO, $this->titulado_academico);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO, $this->titulado_convalidado);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS, $this->anios_cursados);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO, $this->documento_egreso);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO, $this->documento_academico);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO, $this->documento_convalidado);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_EGRESO)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_FECHA_EGRESO, $this->fecha_egreso);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_FECHA_TITULACION)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_FECHA_TITULACION, $this->fecha_titulacion);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_VERIFICACIONES)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_VERIFICACIONES, $this->verificaciones);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_STATUS)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_LAST_USER_ID)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildJobFormacionAcademicaQuery::create();
        $criteria->add(JobFormacionAcademicaTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobFormacionAcademica (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdCurriculum($this->getIdCurriculum());
        $copyObj->setIdTipoFormacion($this->getIdTipoFormacion());
        $copyObj->setIdProfesion($this->getIdProfesion());
        $copyObj->setIdInstitucion($this->getIdInstitucion());
        $copyObj->setNombreInstitucion($this->getNombreInstitucion());
        $copyObj->setNombreEstudios($this->getNombreEstudios());
        $copyObj->setNombreTitulo($this->getNombreTitulo());
        $copyObj->setFechaInicio($this->getFechaInicio());
        $copyObj->setFechaFin($this->getFechaFin());
        $copyObj->setEstudiante($this->getEstudiante());
        $copyObj->setEgresado($this->getEgresado());
        $copyObj->setTituladoAcademico($this->getTituladoAcademico());
        $copyObj->setTituladoConvalidado($this->getTituladoConvalidado());
        $copyObj->setAniosCursados($this->getAniosCursados());
        $copyObj->setDocumentoEgreso($this->getDocumentoEgreso());
        $copyObj->setDocumentoAcademico($this->getDocumentoAcademico());
        $copyObj->setDocumentoConvalidado($this->getDocumentoConvalidado());
        $copyObj->setFechaEgreso($this->getFechaEgreso());
        $copyObj->setFechaTitulacion($this->getFechaTitulacion());
        $copyObj->setVerificaciones($this->getVerificaciones());
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
     * @return \JobFormacionAcademica Clone of current object.
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
     * Declares an association between this object and a ChildJobTipoFormacion object.
     *
     * @param  ChildJobTipoFormacion $v
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJobTipoFormacion(ChildJobTipoFormacion $v = null)
    {
        if ($v === null) {
            $this->setIdTipoFormacion(NULL);
        } else {
            $this->setIdTipoFormacion($v->getId());
        }

        $this->aJobTipoFormacion = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJobTipoFormacion object, it will not be re-added.
        if ($v !== null) {
            $v->addJobFormacionAcademica($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJobTipoFormacion object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJobTipoFormacion The associated ChildJobTipoFormacion object.
     * @throws PropelException
     */
    public function getJobTipoFormacion(ConnectionInterface $con = null)
    {
        if ($this->aJobTipoFormacion === null && ($this->id_tipo_formacion !== null)) {
            $this->aJobTipoFormacion = ChildJobTipoFormacionQuery::create()->findPk($this->id_tipo_formacion, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJobTipoFormacion->addJobFormacionAcademicas($this);
             */
        }

        return $this->aJobTipoFormacion;
    }

    /**
     * Declares an association between this object and a ChildJobProfesion object.
     *
     * @param  ChildJobProfesion $v
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJobProfesion(ChildJobProfesion $v = null)
    {
        if ($v === null) {
            $this->setIdProfesion(NULL);
        } else {
            $this->setIdProfesion($v->getId());
        }

        $this->aJobProfesion = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJobProfesion object, it will not be re-added.
        if ($v !== null) {
            $v->addJobFormacionAcademica($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJobProfesion object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJobProfesion The associated ChildJobProfesion object.
     * @throws PropelException
     */
    public function getJobProfesion(ConnectionInterface $con = null)
    {
        if ($this->aJobProfesion === null && ($this->id_profesion !== null)) {
            $this->aJobProfesion = ChildJobProfesionQuery::create()->findPk($this->id_profesion, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJobProfesion->addJobFormacionAcademicas($this);
             */
        }

        return $this->aJobProfesion;
    }

    /**
     * Declares an association between this object and a ChildJobCurriculum object.
     *
     * @param  ChildJobCurriculum $v
     * @return $this|\JobFormacionAcademica The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJobCurriculum(ChildJobCurriculum $v = null)
    {
        if ($v === null) {
            $this->setIdCurriculum(NULL);
        } else {
            $this->setIdCurriculum($v->getId());
        }

        $this->aJobCurriculum = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJobCurriculum object, it will not be re-added.
        if ($v !== null) {
            $v->addJobFormacionAcademica($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJobCurriculum object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJobCurriculum The associated ChildJobCurriculum object.
     * @throws PropelException
     */
    public function getJobCurriculum(ConnectionInterface $con = null)
    {
        if ($this->aJobCurriculum === null && ($this->id_curriculum !== null)) {
            $this->aJobCurriculum = ChildJobCurriculumQuery::create()->findPk($this->id_curriculum, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJobCurriculum->addJobFormacionAcademicas($this);
             */
        }

        return $this->aJobCurriculum;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aJobTipoFormacion) {
            $this->aJobTipoFormacion->removeJobFormacionAcademica($this);
        }
        if (null !== $this->aJobProfesion) {
            $this->aJobProfesion->removeJobFormacionAcademica($this);
        }
        if (null !== $this->aJobCurriculum) {
            $this->aJobCurriculum->removeJobFormacionAcademica($this);
        }
        $this->id = null;
        $this->id_curriculum = null;
        $this->id_tipo_formacion = null;
        $this->id_profesion = null;
        $this->id_institucion = null;
        $this->nombre_institucion = null;
        $this->nombre_estudios = null;
        $this->nombre_titulo = null;
        $this->fecha_inicio = null;
        $this->fecha_fin = null;
        $this->estudiante = null;
        $this->egresado = null;
        $this->titulado_academico = null;
        $this->titulado_convalidado = null;
        $this->anios_cursados = null;
        $this->documento_egreso = null;
        $this->documento_academico = null;
        $this->documento_convalidado = null;
        $this->fecha_egreso = null;
        $this->fecha_titulacion = null;
        $this->verificaciones = null;
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

        $this->aJobTipoFormacion = null;
        $this->aJobProfesion = null;
        $this->aJobCurriculum = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobFormacionAcademicaTableMap::DEFAULT_STRING_FORMAT);
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
