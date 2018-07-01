<?php

namespace Base;

use \JobPostulante as ChildJobPostulante;
use \JobPostulanteAviso as ChildJobPostulanteAviso;
use \JobPostulanteAvisoQuery as ChildJobPostulanteAvisoQuery;
use \JobPostulanteQuery as ChildJobPostulanteQuery;
use \JobSuscriptor as ChildJobSuscriptor;
use \JobSuscriptorQuery as ChildJobSuscriptorQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobPostulanteAvisoTableMap;
use Map\JobPostulanteTableMap;
use Map\JobSuscriptorTableMap;
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
 * Base class that represents a row from the 'job_postulante' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class JobPostulante implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobPostulanteTableMap';


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
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the location_id field.
     *
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the estado field.
     *
     * @var        string
     */
    protected $estado;

    /**
     * The value for the nombres field.
     *
     * @var        string
     */
    protected $nombres;

    /**
     * The value for the apellido1 field.
     *
     * @var        string
     */
    protected $apellido1;

    /**
     * The value for the apellido2 field.
     *
     * @var        string
     */
    protected $apellido2;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the ci field.
     *
     * @var        string
     */
    protected $ci;

    /**
     * The value for the ci_expedido field.
     *
     * @var        string
     */
    protected $ci_expedido;

    /**
     * The value for the sexo field.
     *
     * @var        string
     */
    protected $sexo;

    /**
     * The value for the fecha_nacimiento field.
     *
     * @var        DateTime
     */
    protected $fecha_nacimiento;

    /**
     * The value for the lugar_nacimiento field.
     *
     * @var        string
     */
    protected $lugar_nacimiento;

    /**
     * The value for the direccion field.
     *
     * @var        string
     */
    protected $direccion;

    /**
     * The value for the ciudad field.
     *
     * @var        string
     */
    protected $ciudad;

    /**
     * The value for the telefono_domicilio field.
     *
     * @var        string
     */
    protected $telefono_domicilio;

    /**
     * The value for the telefono_trabajo field.
     *
     * @var        string
     */
    protected $telefono_trabajo;

    /**
     * The value for the celular_1 field.
     *
     * @var        string
     */
    protected $celular_1;

    /**
     * The value for the celular_2 field.
     *
     * @var        string
     */
    protected $celular_2;

    /**
     * The value for the mime_foto field.
     *
     * @var        string
     */
    protected $mime_foto;

    /**
     * The value for the pretension_salarial field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $pretension_salarial;

    /**
     * The value for the fecha_ultima_postulacion field.
     *
     * Note: this column has a database default value of: NULL
     * @var        DateTime
     */
    protected $fecha_ultima_postulacion;

    /**
     * The value for the last_user_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $last_user_id;

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
     * Note: this column has a database default value of: NULL
     * @var        DateTime
     */
    protected $modification_date;

    /**
     * @var        ObjectCollection|ChildJobPostulanteAviso[] Collection to store aggregation of ChildJobPostulanteAviso objects.
     */
    protected $collJobPostulanteAvisos;
    protected $collJobPostulanteAvisosPartial;

    /**
     * @var        ObjectCollection|ChildJobSuscriptor[] Collection to store aggregation of ChildJobSuscriptor objects.
     */
    protected $collJobSuscriptors;
    protected $collJobSuscriptorsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobPostulanteAviso[]
     */
    protected $jobPostulanteAvisosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobSuscriptor[]
     */
    protected $jobSuscriptorsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->pretension_salarial = 0;
        $this->fecha_ultima_postulacion = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->last_user_id = 0;
        $this->modification_date = PropelDateTime::newInstance(NULL, null, 'DateTime');
    }

    /**
     * Initializes internal state of Base\JobPostulante object.
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
     * Compares this with another <code>JobPostulante</code> instance.  If
     * <code>obj</code> is an instance of <code>JobPostulante</code>, delegates to
     * <code>equals(JobPostulante)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobPostulante The current object, for fluid interface
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
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [location_id] column value.
     *
     * @return int
     */
    public function getLocationId()
    {
        return $this->location_id;
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
     * Get the [nombres] column value.
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Get the [apellido1] column value.
     *
     * @return string
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Get the [apellido2] column value.
     *
     * @return string
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [ci] column value.
     *
     * @return string
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Get the [ci_expedido] column value.
     *
     * @return string
     */
    public function getCiExpedido()
    {
        return $this->ci_expedido;
    }

    /**
     * Get the [sexo] column value.
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_nacimiento] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaNacimiento($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_nacimiento;
        } else {
            return $this->fecha_nacimiento instanceof \DateTimeInterface ? $this->fecha_nacimiento->format($format) : null;
        }
    }

    /**
     * Get the [lugar_nacimiento] column value.
     *
     * @return string
     */
    public function getLugarNacimiento()
    {
        return $this->lugar_nacimiento;
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
     * Get the [ciudad] column value.
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Get the [telefono_domicilio] column value.
     *
     * @return string
     */
    public function getTelefonoDomicilio()
    {
        return $this->telefono_domicilio;
    }

    /**
     * Get the [telefono_trabajo] column value.
     *
     * @return string
     */
    public function getTelefonoTrabajo()
    {
        return $this->telefono_trabajo;
    }

    /**
     * Get the [celular_1] column value.
     *
     * @return string
     */
    public function getCelular1()
    {
        return $this->celular_1;
    }

    /**
     * Get the [celular_2] column value.
     *
     * @return string
     */
    public function getCelular2()
    {
        return $this->celular_2;
    }

    /**
     * Get the [mime_foto] column value.
     *
     * @return string
     */
    public function getMimeFoto()
    {
        return $this->mime_foto;
    }

    /**
     * Get the [pretension_salarial] column value.
     *
     * @return int
     */
    public function getPretensionSalarial()
    {
        return $this->pretension_salarial;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_ultima_postulacion] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaUltimaPostulacion($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_ultima_postulacion;
        } else {
            return $this->fecha_ultima_postulacion instanceof \DateTimeInterface ? $this->fecha_ultima_postulacion->format($format) : null;
        }
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
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_USER_ID] = true;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_LOCATION_ID] = true;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [estado] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setEstado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estado !== $v) {
            $this->estado = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_ESTADO] = true;
        }

        return $this;
    } // setEstado()

    /**
     * Set the value of [nombres] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setNombres($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombres !== $v) {
            $this->nombres = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_NOMBRES] = true;
        }

        return $this;
    } // setNombres()

    /**
     * Set the value of [apellido1] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setApellido1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellido1 !== $v) {
            $this->apellido1 = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_APELLIDO1] = true;
        }

        return $this;
    } // setApellido1()

    /**
     * Set the value of [apellido2] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setApellido2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellido2 !== $v) {
            $this->apellido2 = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_APELLIDO2] = true;
        }

        return $this;
    } // setApellido2()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [ci] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setCi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ci !== $v) {
            $this->ci = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_CI] = true;
        }

        return $this;
    } // setCi()

    /**
     * Set the value of [ci_expedido] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setCiExpedido($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ci_expedido !== $v) {
            $this->ci_expedido = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_CI_EXPEDIDO] = true;
        }

        return $this;
    } // setCiExpedido()

    /**
     * Set the value of [sexo] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setSexo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sexo !== $v) {
            $this->sexo = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_SEXO] = true;
        }

        return $this;
    } // setSexo()

    /**
     * Sets the value of [fecha_nacimiento] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setFechaNacimiento($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_nacimiento !== null || $dt !== null) {
            if ($this->fecha_nacimiento === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_nacimiento->format("Y-m-d")) {
                $this->fecha_nacimiento = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobPostulanteTableMap::COL_FECHA_NACIMIENTO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaNacimiento()

    /**
     * Set the value of [lugar_nacimiento] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setLugarNacimiento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lugar_nacimiento !== $v) {
            $this->lugar_nacimiento = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_LUGAR_NACIMIENTO] = true;
        }

        return $this;
    } // setLugarNacimiento()

    /**
     * Set the value of [direccion] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->direccion !== $v) {
            $this->direccion = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_DIRECCION] = true;
        }

        return $this;
    } // setDireccion()

    /**
     * Set the value of [ciudad] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setCiudad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ciudad !== $v) {
            $this->ciudad = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_CIUDAD] = true;
        }

        return $this;
    } // setCiudad()

    /**
     * Set the value of [telefono_domicilio] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setTelefonoDomicilio($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefono_domicilio !== $v) {
            $this->telefono_domicilio = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_TELEFONO_DOMICILIO] = true;
        }

        return $this;
    } // setTelefonoDomicilio()

    /**
     * Set the value of [telefono_trabajo] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setTelefonoTrabajo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefono_trabajo !== $v) {
            $this->telefono_trabajo = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_TELEFONO_TRABAJO] = true;
        }

        return $this;
    } // setTelefonoTrabajo()

    /**
     * Set the value of [celular_1] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setCelular1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->celular_1 !== $v) {
            $this->celular_1 = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_CELULAR_1] = true;
        }

        return $this;
    } // setCelular1()

    /**
     * Set the value of [celular_2] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setCelular2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->celular_2 !== $v) {
            $this->celular_2 = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_CELULAR_2] = true;
        }

        return $this;
    } // setCelular2()

    /**
     * Set the value of [mime_foto] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setMimeFoto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mime_foto !== $v) {
            $this->mime_foto = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_MIME_FOTO] = true;
        }

        return $this;
    } // setMimeFoto()

    /**
     * Set the value of [pretension_salarial] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setPretensionSalarial($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pretension_salarial !== $v) {
            $this->pretension_salarial = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_PRETENSION_SALARIAL] = true;
        }

        return $this;
    } // setPretensionSalarial()

    /**
     * Sets the value of [fecha_ultima_postulacion] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setFechaUltimaPostulacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_ultima_postulacion !== null || $dt !== null) {
            if ( ($dt != $this->fecha_ultima_postulacion) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s.u') === NULL) // or the entered value matches the default
                 ) {
                $this->fecha_ultima_postulacion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaUltimaPostulacion()

    /**
     * Set the value of [last_user_id] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[JobPostulanteTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->creation_date->format("Y-m-d H:i:s.u")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobPostulanteTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ( ($dt != $this->modification_date) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s.u') === NULL) // or the entered value matches the default
                 ) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobPostulanteTableMap::COL_MODIFICATION_DATE] = true;
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
            if ($this->pretension_salarial !== 0) {
                return false;
            }

            if ($this->fecha_ultima_postulacion && $this->fecha_ultima_postulacion->format('Y-m-d H:i:s.u') !== NULL) {
                return false;
            }

            if ($this->last_user_id !== 0) {
                return false;
            }

            if ($this->modification_date && $this->modification_date->format('Y-m-d H:i:s.u') !== NULL) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobPostulanteTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobPostulanteTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobPostulanteTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobPostulanteTableMap::translateFieldName('Estado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estado = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobPostulanteTableMap::translateFieldName('Nombres', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombres = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobPostulanteTableMap::translateFieldName('Apellido1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellido1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobPostulanteTableMap::translateFieldName('Apellido2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellido2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobPostulanteTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobPostulanteTableMap::translateFieldName('Ci', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ci = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobPostulanteTableMap::translateFieldName('CiExpedido', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ci_expedido = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobPostulanteTableMap::translateFieldName('Sexo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sexo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobPostulanteTableMap::translateFieldName('FechaNacimiento', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_nacimiento = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JobPostulanteTableMap::translateFieldName('LugarNacimiento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lugar_nacimiento = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JobPostulanteTableMap::translateFieldName('Direccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->direccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : JobPostulanteTableMap::translateFieldName('Ciudad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ciudad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : JobPostulanteTableMap::translateFieldName('TelefonoDomicilio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono_domicilio = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : JobPostulanteTableMap::translateFieldName('TelefonoTrabajo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono_trabajo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : JobPostulanteTableMap::translateFieldName('Celular1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->celular_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : JobPostulanteTableMap::translateFieldName('Celular2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->celular_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : JobPostulanteTableMap::translateFieldName('MimeFoto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mime_foto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : JobPostulanteTableMap::translateFieldName('PretensionSalarial', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pretension_salarial = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : JobPostulanteTableMap::translateFieldName('FechaUltimaPostulacion', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->fecha_ultima_postulacion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : JobPostulanteTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : JobPostulanteTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : JobPostulanteTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 25; // 25 = JobPostulanteTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobPostulante'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(JobPostulanteTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobPostulanteQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJobPostulanteAvisos = null;

            $this->collJobSuscriptors = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobPostulante::setDeleted()
     * @see JobPostulante::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobPostulanteQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteTableMap::DATABASE_NAME);
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
                JobPostulanteTableMap::addInstanceToPool($this);
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

            if ($this->jobPostulanteAvisosScheduledForDeletion !== null) {
                if (!$this->jobPostulanteAvisosScheduledForDeletion->isEmpty()) {
                    \JobPostulanteAvisoQuery::create()
                        ->filterByPrimaryKeys($this->jobPostulanteAvisosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jobPostulanteAvisosScheduledForDeletion = null;
                }
            }

            if ($this->collJobPostulanteAvisos !== null) {
                foreach ($this->collJobPostulanteAvisos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jobSuscriptorsScheduledForDeletion !== null) {
                if (!$this->jobSuscriptorsScheduledForDeletion->isEmpty()) {
                    foreach ($this->jobSuscriptorsScheduledForDeletion as $jobSuscriptor) {
                        // need to save related object because we set the relation to null
                        $jobSuscriptor->save($con);
                    }
                    $this->jobSuscriptorsScheduledForDeletion = null;
                }
            }

            if ($this->collJobSuscriptors !== null) {
                foreach ($this->collJobSuscriptors as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobPostulanteTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'USER_ID';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LOCATION_ID';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = 'ESTADO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_NOMBRES)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRES';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_APELLIDO1)) {
            $modifiedColumns[':p' . $index++]  = 'APELLIDO1';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_APELLIDO2)) {
            $modifiedColumns[':p' . $index++]  = 'APELLIDO2';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CI)) {
            $modifiedColumns[':p' . $index++]  = 'CI';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CI_EXPEDIDO)) {
            $modifiedColumns[':p' . $index++]  = 'CI_EXPEDIDO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_SEXO)) {
            $modifiedColumns[':p' . $index++]  = 'SEXO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_FECHA_NACIMIENTO)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_NACIMIENTO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_LUGAR_NACIMIENTO)) {
            $modifiedColumns[':p' . $index++]  = 'LUGAR_NACIMIENTO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = 'DIRECCION';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CIUDAD)) {
            $modifiedColumns[':p' . $index++]  = 'CIUDAD';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_TELEFONO_DOMICILIO)) {
            $modifiedColumns[':p' . $index++]  = 'TELEFONO_DOMICILIO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_TELEFONO_TRABAJO)) {
            $modifiedColumns[':p' . $index++]  = 'TELEFONO_TRABAJO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CELULAR_1)) {
            $modifiedColumns[':p' . $index++]  = 'CELULAR_1';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CELULAR_2)) {
            $modifiedColumns[':p' . $index++]  = 'CELULAR_2';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_MIME_FOTO)) {
            $modifiedColumns[':p' . $index++]  = 'MIME_FOTO';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_PRETENSION_SALARIAL)) {
            $modifiedColumns[':p' . $index++]  = 'PRETENSION_SALARIAL';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_ULTIMA_POSTULACION';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_postulante (%s) VALUES (%s)',
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
                    case 'USER_ID':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'LOCATION_ID':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case 'ESTADO':
                        $stmt->bindValue($identifier, $this->estado, PDO::PARAM_STR);
                        break;
                    case 'NOMBRES':
                        $stmt->bindValue($identifier, $this->nombres, PDO::PARAM_STR);
                        break;
                    case 'APELLIDO1':
                        $stmt->bindValue($identifier, $this->apellido1, PDO::PARAM_STR);
                        break;
                    case 'APELLIDO2':
                        $stmt->bindValue($identifier, $this->apellido2, PDO::PARAM_STR);
                        break;
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'CI':
                        $stmt->bindValue($identifier, $this->ci, PDO::PARAM_STR);
                        break;
                    case 'CI_EXPEDIDO':
                        $stmt->bindValue($identifier, $this->ci_expedido, PDO::PARAM_STR);
                        break;
                    case 'SEXO':
                        $stmt->bindValue($identifier, $this->sexo, PDO::PARAM_STR);
                        break;
                    case 'FECHA_NACIMIENTO':
                        $stmt->bindValue($identifier, $this->fecha_nacimiento ? $this->fecha_nacimiento->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'LUGAR_NACIMIENTO':
                        $stmt->bindValue($identifier, $this->lugar_nacimiento, PDO::PARAM_STR);
                        break;
                    case 'DIRECCION':
                        $stmt->bindValue($identifier, $this->direccion, PDO::PARAM_STR);
                        break;
                    case 'CIUDAD':
                        $stmt->bindValue($identifier, $this->ciudad, PDO::PARAM_STR);
                        break;
                    case 'TELEFONO_DOMICILIO':
                        $stmt->bindValue($identifier, $this->telefono_domicilio, PDO::PARAM_STR);
                        break;
                    case 'TELEFONO_TRABAJO':
                        $stmt->bindValue($identifier, $this->telefono_trabajo, PDO::PARAM_STR);
                        break;
                    case 'CELULAR_1':
                        $stmt->bindValue($identifier, $this->celular_1, PDO::PARAM_STR);
                        break;
                    case 'CELULAR_2':
                        $stmt->bindValue($identifier, $this->celular_2, PDO::PARAM_STR);
                        break;
                    case 'MIME_FOTO':
                        $stmt->bindValue($identifier, $this->mime_foto, PDO::PARAM_STR);
                        break;
                    case 'PRETENSION_SALARIAL':
                        $stmt->bindValue($identifier, $this->pretension_salarial, PDO::PARAM_INT);
                        break;
                    case 'FECHA_ULTIMA_POSTULACION':
                        $stmt->bindValue($identifier, $this->fecha_ultima_postulacion ? $this->fecha_ultima_postulacion->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'LAST_USER_ID':
                        $stmt->bindValue($identifier, $this->last_user_id, PDO::PARAM_INT);
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
        $pos = JobPostulanteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUserId();
                break;
            case 2:
                return $this->getLocationId();
                break;
            case 3:
                return $this->getEstado();
                break;
            case 4:
                return $this->getNombres();
                break;
            case 5:
                return $this->getApellido1();
                break;
            case 6:
                return $this->getApellido2();
                break;
            case 7:
                return $this->getEmail();
                break;
            case 8:
                return $this->getCi();
                break;
            case 9:
                return $this->getCiExpedido();
                break;
            case 10:
                return $this->getSexo();
                break;
            case 11:
                return $this->getFechaNacimiento();
                break;
            case 12:
                return $this->getLugarNacimiento();
                break;
            case 13:
                return $this->getDireccion();
                break;
            case 14:
                return $this->getCiudad();
                break;
            case 15:
                return $this->getTelefonoDomicilio();
                break;
            case 16:
                return $this->getTelefonoTrabajo();
                break;
            case 17:
                return $this->getCelular1();
                break;
            case 18:
                return $this->getCelular2();
                break;
            case 19:
                return $this->getMimeFoto();
                break;
            case 20:
                return $this->getPretensionSalarial();
                break;
            case 21:
                return $this->getFechaUltimaPostulacion();
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

        if (isset($alreadyDumpedObjects['JobPostulante'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobPostulante'][$this->hashCode()] = true;
        $keys = JobPostulanteTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getLocationId(),
            $keys[3] => $this->getEstado(),
            $keys[4] => $this->getNombres(),
            $keys[5] => $this->getApellido1(),
            $keys[6] => $this->getApellido2(),
            $keys[7] => $this->getEmail(),
            $keys[8] => $this->getCi(),
            $keys[9] => $this->getCiExpedido(),
            $keys[10] => $this->getSexo(),
            $keys[11] => $this->getFechaNacimiento(),
            $keys[12] => $this->getLugarNacimiento(),
            $keys[13] => $this->getDireccion(),
            $keys[14] => $this->getCiudad(),
            $keys[15] => $this->getTelefonoDomicilio(),
            $keys[16] => $this->getTelefonoTrabajo(),
            $keys[17] => $this->getCelular1(),
            $keys[18] => $this->getCelular2(),
            $keys[19] => $this->getMimeFoto(),
            $keys[20] => $this->getPretensionSalarial(),
            $keys[21] => $this->getFechaUltimaPostulacion(),
            $keys[22] => $this->getLastUserId(),
            $keys[23] => $this->getCreationDate(),
            $keys[24] => $this->getModificationDate(),
        );
        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('c');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('c');
        }

        if ($result[$keys[24]] instanceof \DateTimeInterface) {
            $result[$keys[24]] = $result[$keys[24]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collJobPostulanteAvisos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobPostulanteAvisos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_postulante_avisos';
                        break;
                    default:
                        $key = 'JobPostulanteAvisos';
                }

                $result[$key] = $this->collJobPostulanteAvisos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJobSuscriptors) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobSuscriptors';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_suscriptors';
                        break;
                    default:
                        $key = 'JobSuscriptors';
                }

                $result[$key] = $this->collJobSuscriptors->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\JobPostulante
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobPostulanteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobPostulante
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUserId($value);
                break;
            case 2:
                $this->setLocationId($value);
                break;
            case 3:
                $this->setEstado($value);
                break;
            case 4:
                $this->setNombres($value);
                break;
            case 5:
                $this->setApellido1($value);
                break;
            case 6:
                $this->setApellido2($value);
                break;
            case 7:
                $this->setEmail($value);
                break;
            case 8:
                $this->setCi($value);
                break;
            case 9:
                $this->setCiExpedido($value);
                break;
            case 10:
                $this->setSexo($value);
                break;
            case 11:
                $this->setFechaNacimiento($value);
                break;
            case 12:
                $this->setLugarNacimiento($value);
                break;
            case 13:
                $this->setDireccion($value);
                break;
            case 14:
                $this->setCiudad($value);
                break;
            case 15:
                $this->setTelefonoDomicilio($value);
                break;
            case 16:
                $this->setTelefonoTrabajo($value);
                break;
            case 17:
                $this->setCelular1($value);
                break;
            case 18:
                $this->setCelular2($value);
                break;
            case 19:
                $this->setMimeFoto($value);
                break;
            case 20:
                $this->setPretensionSalarial($value);
                break;
            case 21:
                $this->setFechaUltimaPostulacion($value);
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
        $keys = JobPostulanteTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLocationId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEstado($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNombres($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setApellido1($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setApellido2($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCi($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCiExpedido($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setSexo($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFechaNacimiento($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setLugarNacimiento($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDireccion($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCiudad($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setTelefonoDomicilio($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setTelefonoTrabajo($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCelular1($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCelular2($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setMimeFoto($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setPretensionSalarial($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setFechaUltimaPostulacion($arr[$keys[21]]);
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
     * @return $this|\JobPostulante The current object, for fluid interface
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
        $criteria = new Criteria(JobPostulanteTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobPostulanteTableMap::COL_ID)) {
            $criteria->add(JobPostulanteTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_USER_ID)) {
            $criteria->add(JobPostulanteTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_LOCATION_ID)) {
            $criteria->add(JobPostulanteTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_ESTADO)) {
            $criteria->add(JobPostulanteTableMap::COL_ESTADO, $this->estado);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_NOMBRES)) {
            $criteria->add(JobPostulanteTableMap::COL_NOMBRES, $this->nombres);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_APELLIDO1)) {
            $criteria->add(JobPostulanteTableMap::COL_APELLIDO1, $this->apellido1);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_APELLIDO2)) {
            $criteria->add(JobPostulanteTableMap::COL_APELLIDO2, $this->apellido2);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_EMAIL)) {
            $criteria->add(JobPostulanteTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CI)) {
            $criteria->add(JobPostulanteTableMap::COL_CI, $this->ci);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CI_EXPEDIDO)) {
            $criteria->add(JobPostulanteTableMap::COL_CI_EXPEDIDO, $this->ci_expedido);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_SEXO)) {
            $criteria->add(JobPostulanteTableMap::COL_SEXO, $this->sexo);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_FECHA_NACIMIENTO)) {
            $criteria->add(JobPostulanteTableMap::COL_FECHA_NACIMIENTO, $this->fecha_nacimiento);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_LUGAR_NACIMIENTO)) {
            $criteria->add(JobPostulanteTableMap::COL_LUGAR_NACIMIENTO, $this->lugar_nacimiento);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_DIRECCION)) {
            $criteria->add(JobPostulanteTableMap::COL_DIRECCION, $this->direccion);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CIUDAD)) {
            $criteria->add(JobPostulanteTableMap::COL_CIUDAD, $this->ciudad);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_TELEFONO_DOMICILIO)) {
            $criteria->add(JobPostulanteTableMap::COL_TELEFONO_DOMICILIO, $this->telefono_domicilio);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_TELEFONO_TRABAJO)) {
            $criteria->add(JobPostulanteTableMap::COL_TELEFONO_TRABAJO, $this->telefono_trabajo);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CELULAR_1)) {
            $criteria->add(JobPostulanteTableMap::COL_CELULAR_1, $this->celular_1);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CELULAR_2)) {
            $criteria->add(JobPostulanteTableMap::COL_CELULAR_2, $this->celular_2);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_MIME_FOTO)) {
            $criteria->add(JobPostulanteTableMap::COL_MIME_FOTO, $this->mime_foto);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_PRETENSION_SALARIAL)) {
            $criteria->add(JobPostulanteTableMap::COL_PRETENSION_SALARIAL, $this->pretension_salarial);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION)) {
            $criteria->add(JobPostulanteTableMap::COL_FECHA_ULTIMA_POSTULACION, $this->fecha_ultima_postulacion);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_LAST_USER_ID)) {
            $criteria->add(JobPostulanteTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobPostulanteTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobPostulanteTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(JobPostulanteTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        throw new LogicException('The JobPostulante object has no primary key');

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
        $validPk = false;

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
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Dummy primary key setter.
     *
     * This function only exists to preserve backwards compatibility.  It is no longer
     * needed or required by the Persistent interface.  It will be removed in next BC-breaking
     * release of Propel.
     *
     * @deprecated
     */
    public function setPrimaryKey($pk)
    {
        // do nothing, because this object doesn't have any primary keys
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return ;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \JobPostulante (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setEstado($this->getEstado());
        $copyObj->setNombres($this->getNombres());
        $copyObj->setApellido1($this->getApellido1());
        $copyObj->setApellido2($this->getApellido2());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setCi($this->getCi());
        $copyObj->setCiExpedido($this->getCiExpedido());
        $copyObj->setSexo($this->getSexo());
        $copyObj->setFechaNacimiento($this->getFechaNacimiento());
        $copyObj->setLugarNacimiento($this->getLugarNacimiento());
        $copyObj->setDireccion($this->getDireccion());
        $copyObj->setCiudad($this->getCiudad());
        $copyObj->setTelefonoDomicilio($this->getTelefonoDomicilio());
        $copyObj->setTelefonoTrabajo($this->getTelefonoTrabajo());
        $copyObj->setCelular1($this->getCelular1());
        $copyObj->setCelular2($this->getCelular2());
        $copyObj->setMimeFoto($this->getMimeFoto());
        $copyObj->setPretensionSalarial($this->getPretensionSalarial());
        $copyObj->setFechaUltimaPostulacion($this->getFechaUltimaPostulacion());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getJobPostulanteAvisos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobPostulanteAviso($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJobSuscriptors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobSuscriptor($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \JobPostulante Clone of current object.
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
        if ('JobPostulanteAviso' == $relationName) {
            $this->initJobPostulanteAvisos();
            return;
        }
        if ('JobSuscriptor' == $relationName) {
            $this->initJobSuscriptors();
            return;
        }
    }

    /**
     * Clears out the collJobPostulanteAvisos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobPostulanteAvisos()
     */
    public function clearJobPostulanteAvisos()
    {
        $this->collJobPostulanteAvisos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobPostulanteAvisos collection loaded partially.
     */
    public function resetPartialJobPostulanteAvisos($v = true)
    {
        $this->collJobPostulanteAvisosPartial = $v;
    }

    /**
     * Initializes the collJobPostulanteAvisos collection.
     *
     * By default this just sets the collJobPostulanteAvisos collection to an empty array (like clearcollJobPostulanteAvisos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobPostulanteAvisos($overrideExisting = true)
    {
        if (null !== $this->collJobPostulanteAvisos && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobPostulanteAvisoTableMap::getTableMap()->getCollectionClassName();

        $this->collJobPostulanteAvisos = new $collectionClassName;
        $this->collJobPostulanteAvisos->setModel('\JobPostulanteAviso');
    }

    /**
     * Gets an array of ChildJobPostulanteAviso objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobPostulante is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobPostulanteAviso[] List of ChildJobPostulanteAviso objects
     * @throws PropelException
     */
    public function getJobPostulanteAvisos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobPostulanteAvisosPartial && !$this->isNew();
        if (null === $this->collJobPostulanteAvisos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobPostulanteAvisos) {
                // return empty collection
                $this->initJobPostulanteAvisos();
            } else {
                $collJobPostulanteAvisos = ChildJobPostulanteAvisoQuery::create(null, $criteria)
                    ->filterByJobPostulante($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobPostulanteAvisosPartial && count($collJobPostulanteAvisos)) {
                        $this->initJobPostulanteAvisos(false);

                        foreach ($collJobPostulanteAvisos as $obj) {
                            if (false == $this->collJobPostulanteAvisos->contains($obj)) {
                                $this->collJobPostulanteAvisos->append($obj);
                            }
                        }

                        $this->collJobPostulanteAvisosPartial = true;
                    }

                    return $collJobPostulanteAvisos;
                }

                if ($partial && $this->collJobPostulanteAvisos) {
                    foreach ($this->collJobPostulanteAvisos as $obj) {
                        if ($obj->isNew()) {
                            $collJobPostulanteAvisos[] = $obj;
                        }
                    }
                }

                $this->collJobPostulanteAvisos = $collJobPostulanteAvisos;
                $this->collJobPostulanteAvisosPartial = false;
            }
        }

        return $this->collJobPostulanteAvisos;
    }

    /**
     * Sets a collection of ChildJobPostulanteAviso objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobPostulanteAvisos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobPostulante The current object (for fluent API support)
     */
    public function setJobPostulanteAvisos(Collection $jobPostulanteAvisos, ConnectionInterface $con = null)
    {
        /** @var ChildJobPostulanteAviso[] $jobPostulanteAvisosToDelete */
        $jobPostulanteAvisosToDelete = $this->getJobPostulanteAvisos(new Criteria(), $con)->diff($jobPostulanteAvisos);


        $this->jobPostulanteAvisosScheduledForDeletion = $jobPostulanteAvisosToDelete;

        foreach ($jobPostulanteAvisosToDelete as $jobPostulanteAvisoRemoved) {
            $jobPostulanteAvisoRemoved->setJobPostulante(null);
        }

        $this->collJobPostulanteAvisos = null;
        foreach ($jobPostulanteAvisos as $jobPostulanteAviso) {
            $this->addJobPostulanteAviso($jobPostulanteAviso);
        }

        $this->collJobPostulanteAvisos = $jobPostulanteAvisos;
        $this->collJobPostulanteAvisosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobPostulanteAviso objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobPostulanteAviso objects.
     * @throws PropelException
     */
    public function countJobPostulanteAvisos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobPostulanteAvisosPartial && !$this->isNew();
        if (null === $this->collJobPostulanteAvisos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobPostulanteAvisos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobPostulanteAvisos());
            }

            $query = ChildJobPostulanteAvisoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobPostulante($this)
                ->count($con);
        }

        return count($this->collJobPostulanteAvisos);
    }

    /**
     * Method called to associate a ChildJobPostulanteAviso object to this object
     * through the ChildJobPostulanteAviso foreign key attribute.
     *
     * @param  ChildJobPostulanteAviso $l ChildJobPostulanteAviso
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function addJobPostulanteAviso(ChildJobPostulanteAviso $l)
    {
        if ($this->collJobPostulanteAvisos === null) {
            $this->initJobPostulanteAvisos();
            $this->collJobPostulanteAvisosPartial = true;
        }

        if (!$this->collJobPostulanteAvisos->contains($l)) {
            $this->doAddJobPostulanteAviso($l);

            if ($this->jobPostulanteAvisosScheduledForDeletion and $this->jobPostulanteAvisosScheduledForDeletion->contains($l)) {
                $this->jobPostulanteAvisosScheduledForDeletion->remove($this->jobPostulanteAvisosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobPostulanteAviso $jobPostulanteAviso The ChildJobPostulanteAviso object to add.
     */
    protected function doAddJobPostulanteAviso(ChildJobPostulanteAviso $jobPostulanteAviso)
    {
        $this->collJobPostulanteAvisos[]= $jobPostulanteAviso;
        $jobPostulanteAviso->setJobPostulante($this);
    }

    /**
     * @param  ChildJobPostulanteAviso $jobPostulanteAviso The ChildJobPostulanteAviso object to remove.
     * @return $this|ChildJobPostulante The current object (for fluent API support)
     */
    public function removeJobPostulanteAviso(ChildJobPostulanteAviso $jobPostulanteAviso)
    {
        if ($this->getJobPostulanteAvisos()->contains($jobPostulanteAviso)) {
            $pos = $this->collJobPostulanteAvisos->search($jobPostulanteAviso);
            $this->collJobPostulanteAvisos->remove($pos);
            if (null === $this->jobPostulanteAvisosScheduledForDeletion) {
                $this->jobPostulanteAvisosScheduledForDeletion = clone $this->collJobPostulanteAvisos;
                $this->jobPostulanteAvisosScheduledForDeletion->clear();
            }
            $this->jobPostulanteAvisosScheduledForDeletion[]= clone $jobPostulanteAviso;
            $jobPostulanteAviso->setJobPostulante(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobPostulante is new, it will return
     * an empty collection; or if this JobPostulante has previously
     * been saved, it will retrieve related JobPostulanteAvisos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobPostulante.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobPostulanteAviso[] List of ChildJobPostulanteAviso objects
     */
    public function getJobPostulanteAvisosJoinJobAviso(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobPostulanteAvisoQuery::create(null, $criteria);
        $query->joinWith('JobAviso', $joinBehavior);

        return $this->getJobPostulanteAvisos($query, $con);
    }

    /**
     * Clears out the collJobSuscriptors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobSuscriptors()
     */
    public function clearJobSuscriptors()
    {
        $this->collJobSuscriptors = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobSuscriptors collection loaded partially.
     */
    public function resetPartialJobSuscriptors($v = true)
    {
        $this->collJobSuscriptorsPartial = $v;
    }

    /**
     * Initializes the collJobSuscriptors collection.
     *
     * By default this just sets the collJobSuscriptors collection to an empty array (like clearcollJobSuscriptors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobSuscriptors($overrideExisting = true)
    {
        if (null !== $this->collJobSuscriptors && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobSuscriptorTableMap::getTableMap()->getCollectionClassName();

        $this->collJobSuscriptors = new $collectionClassName;
        $this->collJobSuscriptors->setModel('\JobSuscriptor');
    }

    /**
     * Gets an array of ChildJobSuscriptor objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobPostulante is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobSuscriptor[] List of ChildJobSuscriptor objects
     * @throws PropelException
     */
    public function getJobSuscriptors(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobSuscriptorsPartial && !$this->isNew();
        if (null === $this->collJobSuscriptors || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobSuscriptors) {
                // return empty collection
                $this->initJobSuscriptors();
            } else {
                $collJobSuscriptors = ChildJobSuscriptorQuery::create(null, $criteria)
                    ->filterByJobPostulante($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobSuscriptorsPartial && count($collJobSuscriptors)) {
                        $this->initJobSuscriptors(false);

                        foreach ($collJobSuscriptors as $obj) {
                            if (false == $this->collJobSuscriptors->contains($obj)) {
                                $this->collJobSuscriptors->append($obj);
                            }
                        }

                        $this->collJobSuscriptorsPartial = true;
                    }

                    return $collJobSuscriptors;
                }

                if ($partial && $this->collJobSuscriptors) {
                    foreach ($this->collJobSuscriptors as $obj) {
                        if ($obj->isNew()) {
                            $collJobSuscriptors[] = $obj;
                        }
                    }
                }

                $this->collJobSuscriptors = $collJobSuscriptors;
                $this->collJobSuscriptorsPartial = false;
            }
        }

        return $this->collJobSuscriptors;
    }

    /**
     * Sets a collection of ChildJobSuscriptor objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobSuscriptors A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobPostulante The current object (for fluent API support)
     */
    public function setJobSuscriptors(Collection $jobSuscriptors, ConnectionInterface $con = null)
    {
        /** @var ChildJobSuscriptor[] $jobSuscriptorsToDelete */
        $jobSuscriptorsToDelete = $this->getJobSuscriptors(new Criteria(), $con)->diff($jobSuscriptors);


        $this->jobSuscriptorsScheduledForDeletion = $jobSuscriptorsToDelete;

        foreach ($jobSuscriptorsToDelete as $jobSuscriptorRemoved) {
            $jobSuscriptorRemoved->setJobPostulante(null);
        }

        $this->collJobSuscriptors = null;
        foreach ($jobSuscriptors as $jobSuscriptor) {
            $this->addJobSuscriptor($jobSuscriptor);
        }

        $this->collJobSuscriptors = $jobSuscriptors;
        $this->collJobSuscriptorsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobSuscriptor objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobSuscriptor objects.
     * @throws PropelException
     */
    public function countJobSuscriptors(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobSuscriptorsPartial && !$this->isNew();
        if (null === $this->collJobSuscriptors || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobSuscriptors) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobSuscriptors());
            }

            $query = ChildJobSuscriptorQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobPostulante($this)
                ->count($con);
        }

        return count($this->collJobSuscriptors);
    }

    /**
     * Method called to associate a ChildJobSuscriptor object to this object
     * through the ChildJobSuscriptor foreign key attribute.
     *
     * @param  ChildJobSuscriptor $l ChildJobSuscriptor
     * @return $this|\JobPostulante The current object (for fluent API support)
     */
    public function addJobSuscriptor(ChildJobSuscriptor $l)
    {
        if ($this->collJobSuscriptors === null) {
            $this->initJobSuscriptors();
            $this->collJobSuscriptorsPartial = true;
        }

        if (!$this->collJobSuscriptors->contains($l)) {
            $this->doAddJobSuscriptor($l);

            if ($this->jobSuscriptorsScheduledForDeletion and $this->jobSuscriptorsScheduledForDeletion->contains($l)) {
                $this->jobSuscriptorsScheduledForDeletion->remove($this->jobSuscriptorsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobSuscriptor $jobSuscriptor The ChildJobSuscriptor object to add.
     */
    protected function doAddJobSuscriptor(ChildJobSuscriptor $jobSuscriptor)
    {
        $this->collJobSuscriptors[]= $jobSuscriptor;
        $jobSuscriptor->setJobPostulante($this);
    }

    /**
     * @param  ChildJobSuscriptor $jobSuscriptor The ChildJobSuscriptor object to remove.
     * @return $this|ChildJobPostulante The current object (for fluent API support)
     */
    public function removeJobSuscriptor(ChildJobSuscriptor $jobSuscriptor)
    {
        if ($this->getJobSuscriptors()->contains($jobSuscriptor)) {
            $pos = $this->collJobSuscriptors->search($jobSuscriptor);
            $this->collJobSuscriptors->remove($pos);
            if (null === $this->jobSuscriptorsScheduledForDeletion) {
                $this->jobSuscriptorsScheduledForDeletion = clone $this->collJobSuscriptors;
                $this->jobSuscriptorsScheduledForDeletion->clear();
            }
            $this->jobSuscriptorsScheduledForDeletion[]= $jobSuscriptor;
            $jobSuscriptor->setJobPostulante(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobPostulante is new, it will return
     * an empty collection; or if this JobPostulante has previously
     * been saved, it will retrieve related JobSuscriptors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobPostulante.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobSuscriptor[] List of ChildJobSuscriptor objects
     */
    public function getJobSuscriptorsJoinTmpArea(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobSuscriptorQuery::create(null, $criteria);
        $query->joinWith('TmpArea', $joinBehavior);

        return $this->getJobSuscriptors($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobPostulante is new, it will return
     * an empty collection; or if this JobPostulante has previously
     * been saved, it will retrieve related JobSuscriptors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobPostulante.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobSuscriptor[] List of ChildJobSuscriptor objects
     */
    public function getJobSuscriptorsJoinTmpFormacion(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobSuscriptorQuery::create(null, $criteria);
        $query->joinWith('TmpFormacion', $joinBehavior);

        return $this->getJobSuscriptors($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->user_id = null;
        $this->location_id = null;
        $this->estado = null;
        $this->nombres = null;
        $this->apellido1 = null;
        $this->apellido2 = null;
        $this->email = null;
        $this->ci = null;
        $this->ci_expedido = null;
        $this->sexo = null;
        $this->fecha_nacimiento = null;
        $this->lugar_nacimiento = null;
        $this->direccion = null;
        $this->ciudad = null;
        $this->telefono_domicilio = null;
        $this->telefono_trabajo = null;
        $this->celular_1 = null;
        $this->celular_2 = null;
        $this->mime_foto = null;
        $this->pretension_salarial = null;
        $this->fecha_ultima_postulacion = null;
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
            if ($this->collJobPostulanteAvisos) {
                foreach ($this->collJobPostulanteAvisos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJobSuscriptors) {
                foreach ($this->collJobSuscriptors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collJobPostulanteAvisos = null;
        $this->collJobSuscriptors = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobPostulanteTableMap::DEFAULT_STRING_FORMAT);
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
