<?php

namespace Base;

use \JobAviso as ChildJobAviso;
use \JobAvisoQuery as ChildJobAvisoQuery;
use \JobPostulante as ChildJobPostulante;
use \JobPostulanteAvisoQuery as ChildJobPostulanteAvisoQuery;
use \JobPostulanteQuery as ChildJobPostulanteQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobPostulanteAvisoTableMap;
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
 * Base class that represents a row from the 'job_postulante_aviso' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class JobPostulanteAviso implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobPostulanteAvisoTableMap';


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
     * The value for the id_aviso field.
     *
     * @var        int
     */
    protected $id_aviso;

    /**
     * The value for the id_postulante field.
     *
     * @var        int
     */
    protected $id_postulante;

    /**
     * The value for the estado field.
     *
     * @var        string
     */
    protected $estado;

    /**
     * The value for the pretension_salarial field.
     *
     * @var        int
     */
    protected $pretension_salarial;

    /**
     * The value for the carta_presentacion field.
     *
     * @var        string
     */
    protected $carta_presentacion;

    /**
     * The value for the cv_mime field.
     *
     * @var        string
     */
    protected $cv_mime;

    /**
     * The value for the cv_filename field.
     *
     * @var        string
     */
    protected $cv_filename;

    /**
     * The value for the fecha_postulacion field.
     *
     * @var        \DateTime
     */
    protected $fecha_postulacion;

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
     * @var        \DateTime
     */
    protected $creation_date;

    /**
     * The value for the modification_date field.
     *
     * @var        \DateTime
     */
    protected $modification_date;

    /**
     * @var        ChildJobAviso
     */
    protected $aJobAviso;

    /**
     * @var        ChildJobPostulante
     */
    protected $aJobPostulante;

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
        $this->last_user_id = 0;
    }

    /**
     * Initializes internal state of Base\JobPostulanteAviso object.
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
     * Compares this with another <code>JobPostulanteAviso</code> instance.  If
     * <code>obj</code> is an instance of <code>JobPostulanteAviso</code>, delegates to
     * <code>equals(JobPostulanteAviso)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobPostulanteAviso The current object, for fluid interface
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
     * Get the [id_aviso] column value.
     *
     * @return int
     */
    public function getIdAviso()
    {
        return $this->id_aviso;
    }

    /**
     * Get the [id_postulante] column value.
     *
     * @return int
     */
    public function getIdPostulante()
    {
        return $this->id_postulante;
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
     * Get the [pretension_salarial] column value.
     *
     * @return int
     */
    public function getPretensionSalarial()
    {
        return $this->pretension_salarial;
    }

    /**
     * Get the [carta_presentacion] column value.
     *
     * @return string
     */
    public function getCartaPresentacion()
    {
        return $this->carta_presentacion;
    }

    /**
     * Get the [cv_mime] column value.
     *
     * @return string
     */
    public function getCvMime()
    {
        return $this->cv_mime;
    }

    /**
     * Get the [cv_filename] column value.
     *
     * @return string
     */
    public function getCvFilename()
    {
        return $this->cv_filename;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_postulacion] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaPostulacion($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_postulacion;
        } else {
            return $this->fecha_postulacion instanceof \DateTime ? $this->fecha_postulacion->format($format) : null;
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
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_aviso] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setIdAviso($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_aviso !== $v) {
            $this->id_aviso = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_ID_AVISO] = true;
        }

        if ($this->aJobAviso !== null && $this->aJobAviso->getId() !== $v) {
            $this->aJobAviso = null;
        }

        return $this;
    } // setIdAviso()

    /**
     * Set the value of [id_postulante] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setIdPostulante($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_postulante !== $v) {
            $this->id_postulante = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_ID_POSTULANTE] = true;
        }

        if ($this->aJobPostulante !== null && $this->aJobPostulante->getId() !== $v) {
            $this->aJobPostulante = null;
        }

        return $this;
    } // setIdPostulante()

    /**
     * Set the value of [estado] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setEstado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estado !== $v) {
            $this->estado = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_ESTADO] = true;
        }

        return $this;
    } // setEstado()

    /**
     * Set the value of [pretension_salarial] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setPretensionSalarial($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pretension_salarial !== $v) {
            $this->pretension_salarial = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL] = true;
        }

        return $this;
    } // setPretensionSalarial()

    /**
     * Set the value of [carta_presentacion] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setCartaPresentacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->carta_presentacion !== $v) {
            $this->carta_presentacion = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION] = true;
        }

        return $this;
    } // setCartaPresentacion()

    /**
     * Set the value of [cv_mime] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setCvMime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cv_mime !== $v) {
            $this->cv_mime = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_CV_MIME] = true;
        }

        return $this;
    } // setCvMime()

    /**
     * Set the value of [cv_filename] column.
     *
     * @param string $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setCvFilename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cv_filename !== $v) {
            $this->cv_filename = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_CV_FILENAME] = true;
        }

        return $this;
    } // setCvFilename()

    /**
     * Sets the value of [fecha_postulacion] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setFechaPostulacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_postulacion !== null || $dt !== null) {
            if ($this->fecha_postulacion === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->fecha_postulacion->format("Y-m-d H:i:s")) {
                $this->fecha_postulacion = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaPostulacion()

    /**
     * Set the value of [last_user_id] column.
     *
     * @param int $v new value
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->modification_date->format("Y-m-d H:i:s")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE] = true;
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
            if ($this->last_user_id !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('IdAviso', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_aviso = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('IdPostulante', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_postulante = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('Estado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estado = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('PretensionSalarial', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pretension_salarial = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('CartaPresentacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->carta_presentacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('CvMime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cv_mime = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('CvFilename', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cv_filename = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('FechaPostulacion', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->fecha_postulacion = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobPostulanteAvisoTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = JobPostulanteAvisoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobPostulanteAviso'), 0, $e);
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
        if ($this->aJobAviso !== null && $this->id_aviso !== $this->aJobAviso->getId()) {
            $this->aJobAviso = null;
        }
        if ($this->aJobPostulante !== null && $this->id_postulante !== $this->aJobPostulante->getId()) {
            $this->aJobPostulante = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobPostulanteAvisoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aJobAviso = null;
            $this->aJobPostulante = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobPostulanteAviso::setDeleted()
     * @see JobPostulanteAviso::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobPostulanteAvisoQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobPostulanteAvisoTableMap::DATABASE_NAME);
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
                JobPostulanteAvisoTableMap::addInstanceToPool($this);
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

            if ($this->aJobAviso !== null) {
                if ($this->aJobAviso->isModified() || $this->aJobAviso->isNew()) {
                    $affectedRows += $this->aJobAviso->save($con);
                }
                $this->setJobAviso($this->aJobAviso);
            }

            if ($this->aJobPostulante !== null) {
                if ($this->aJobPostulante->isModified() || $this->aJobPostulante->isNew()) {
                    $affectedRows += $this->aJobPostulante->save($con);
                }
                $this->setJobPostulante($this->aJobPostulante);
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

        $this->modifiedColumns[JobPostulanteAvisoTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobPostulanteAvisoTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ID_AVISO)) {
            $modifiedColumns[':p' . $index++]  = 'ID_AVISO';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE)) {
            $modifiedColumns[':p' . $index++]  = 'ID_POSTULANTE';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = 'ESTADO';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL)) {
            $modifiedColumns[':p' . $index++]  = 'PRETENSION_SALARIAL';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION)) {
            $modifiedColumns[':p' . $index++]  = 'CARTA_PRESENTACION';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CV_MIME)) {
            $modifiedColumns[':p' . $index++]  = 'CV_MIME';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CV_FILENAME)) {
            $modifiedColumns[':p' . $index++]  = 'CV_FILENAME';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION)) {
            $modifiedColumns[':p' . $index++]  = 'FECHA_POSTULACION';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_postulante_aviso (%s) VALUES (%s)',
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
                    case 'ID_AVISO':
                        $stmt->bindValue($identifier, $this->id_aviso, PDO::PARAM_INT);
                        break;
                    case 'ID_POSTULANTE':
                        $stmt->bindValue($identifier, $this->id_postulante, PDO::PARAM_INT);
                        break;
                    case 'ESTADO':
                        $stmt->bindValue($identifier, $this->estado, PDO::PARAM_STR);
                        break;
                    case 'PRETENSION_SALARIAL':
                        $stmt->bindValue($identifier, $this->pretension_salarial, PDO::PARAM_INT);
                        break;
                    case 'CARTA_PRESENTACION':
                        $stmt->bindValue($identifier, $this->carta_presentacion, PDO::PARAM_STR);
                        break;
                    case 'CV_MIME':
                        $stmt->bindValue($identifier, $this->cv_mime, PDO::PARAM_STR);
                        break;
                    case 'CV_FILENAME':
                        $stmt->bindValue($identifier, $this->cv_filename, PDO::PARAM_STR);
                        break;
                    case 'FECHA_POSTULACION':
                        $stmt->bindValue($identifier, $this->fecha_postulacion ? $this->fecha_postulacion->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = JobPostulanteAvisoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdAviso();
                break;
            case 2:
                return $this->getIdPostulante();
                break;
            case 3:
                return $this->getEstado();
                break;
            case 4:
                return $this->getPretensionSalarial();
                break;
            case 5:
                return $this->getCartaPresentacion();
                break;
            case 6:
                return $this->getCvMime();
                break;
            case 7:
                return $this->getCvFilename();
                break;
            case 8:
                return $this->getFechaPostulacion();
                break;
            case 9:
                return $this->getLastUserId();
                break;
            case 10:
                return $this->getCreationDate();
                break;
            case 11:
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

        if (isset($alreadyDumpedObjects['JobPostulanteAviso'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobPostulanteAviso'][$this->hashCode()] = true;
        $keys = JobPostulanteAvisoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdAviso(),
            $keys[2] => $this->getIdPostulante(),
            $keys[3] => $this->getEstado(),
            $keys[4] => $this->getPretensionSalarial(),
            $keys[5] => $this->getCartaPresentacion(),
            $keys[6] => $this->getCvMime(),
            $keys[7] => $this->getCvFilename(),
            $keys[8] => $this->getFechaPostulacion(),
            $keys[9] => $this->getLastUserId(),
            $keys[10] => $this->getCreationDate(),
            $keys[11] => $this->getModificationDate(),
        );
        if ($result[$keys[8]] instanceof \DateTime) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTime) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        if ($result[$keys[11]] instanceof \DateTime) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aJobAviso) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobAviso';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_aviso';
                        break;
                    default:
                        $key = 'JobAviso';
                }

                $result[$key] = $this->aJobAviso->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aJobPostulante) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobPostulante';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_postulante';
                        break;
                    default:
                        $key = 'JobPostulante';
                }

                $result[$key] = $this->aJobPostulante->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\JobPostulanteAviso
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobPostulanteAvisoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobPostulanteAviso
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdAviso($value);
                break;
            case 2:
                $this->setIdPostulante($value);
                break;
            case 3:
                $this->setEstado($value);
                break;
            case 4:
                $this->setPretensionSalarial($value);
                break;
            case 5:
                $this->setCartaPresentacion($value);
                break;
            case 6:
                $this->setCvMime($value);
                break;
            case 7:
                $this->setCvFilename($value);
                break;
            case 8:
                $this->setFechaPostulacion($value);
                break;
            case 9:
                $this->setLastUserId($value);
                break;
            case 10:
                $this->setCreationDate($value);
                break;
            case 11:
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
        $keys = JobPostulanteAvisoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdAviso($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdPostulante($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEstado($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPretensionSalarial($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCartaPresentacion($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCvMime($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCvFilename($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFechaPostulacion($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLastUserId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreationDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setModificationDate($arr[$keys[11]]);
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
     * @return $this|\JobPostulanteAviso The current object, for fluid interface
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
        $criteria = new Criteria(JobPostulanteAvisoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ID)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ID_AVISO)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_ID_AVISO, $this->id_aviso);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_ID_POSTULANTE, $this->id_postulante);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_ESTADO)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_ESTADO, $this->estado);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_PRETENSION_SALARIAL, $this->pretension_salarial);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_CARTA_PRESENTACION, $this->carta_presentacion);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CV_MIME)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_CV_MIME, $this->cv_mime);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CV_FILENAME)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_CV_FILENAME, $this->cv_filename);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_FECHA_POSTULACION, $this->fecha_postulacion);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_LAST_USER_ID)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(JobPostulanteAvisoTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildJobPostulanteAvisoQuery::create();
        $criteria->add(JobPostulanteAvisoTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobPostulanteAviso (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdAviso($this->getIdAviso());
        $copyObj->setIdPostulante($this->getIdPostulante());
        $copyObj->setEstado($this->getEstado());
        $copyObj->setPretensionSalarial($this->getPretensionSalarial());
        $copyObj->setCartaPresentacion($this->getCartaPresentacion());
        $copyObj->setCvMime($this->getCvMime());
        $copyObj->setCvFilename($this->getCvFilename());
        $copyObj->setFechaPostulacion($this->getFechaPostulacion());
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
     * @return \JobPostulanteAviso Clone of current object.
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
     * Declares an association between this object and a ChildJobAviso object.
     *
     * @param  ChildJobAviso $v
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJobAviso(ChildJobAviso $v = null)
    {
        if ($v === null) {
            $this->setIdAviso(NULL);
        } else {
            $this->setIdAviso($v->getId());
        }

        $this->aJobAviso = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJobAviso object, it will not be re-added.
        if ($v !== null) {
            $v->addJobPostulanteAviso($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJobAviso object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJobAviso The associated ChildJobAviso object.
     * @throws PropelException
     */
    public function getJobAviso(ConnectionInterface $con = null)
    {
        if ($this->aJobAviso === null && ($this->id_aviso !== null)) {
            $this->aJobAviso = ChildJobAvisoQuery::create()->findPk($this->id_aviso, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJobAviso->addJobPostulanteAvisos($this);
             */
        }

        return $this->aJobAviso;
    }

    /**
     * Declares an association between this object and a ChildJobPostulante object.
     *
     * @param  ChildJobPostulante $v
     * @return $this|\JobPostulanteAviso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJobPostulante(ChildJobPostulante $v = null)
    {
        if ($v === null) {
            $this->setIdPostulante(NULL);
        } else {
            $this->setIdPostulante($v->getId());
        }

        $this->aJobPostulante = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJobPostulante object, it will not be re-added.
        if ($v !== null) {
            $v->addJobPostulanteAviso($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJobPostulante object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJobPostulante The associated ChildJobPostulante object.
     * @throws PropelException
     */
    public function getJobPostulante(ConnectionInterface $con = null)
    {
        if ($this->aJobPostulante === null && ($this->id_postulante !== null)) {
            $this->aJobPostulante = ChildJobPostulanteQuery::create()
                ->filterByJobPostulanteAviso($this) // here
                ->findOne($con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJobPostulante->addJobPostulanteAvisos($this);
             */
        }

        return $this->aJobPostulante;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aJobAviso) {
            $this->aJobAviso->removeJobPostulanteAviso($this);
        }
        if (null !== $this->aJobPostulante) {
            $this->aJobPostulante->removeJobPostulanteAviso($this);
        }
        $this->id = null;
        $this->id_aviso = null;
        $this->id_postulante = null;
        $this->estado = null;
        $this->pretension_salarial = null;
        $this->carta_presentacion = null;
        $this->cv_mime = null;
        $this->cv_filename = null;
        $this->fecha_postulacion = null;
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

        $this->aJobAviso = null;
        $this->aJobPostulante = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobPostulanteAvisoTableMap::DEFAULT_STRING_FORMAT);
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
