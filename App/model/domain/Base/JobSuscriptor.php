<?php

namespace Base;

use \JobSuscriptorQuery as ChildJobSuscriptorQuery;
use \TmpArea as ChildTmpArea;
use \TmpAreaQuery as ChildTmpAreaQuery;
use \TmpFormacion as ChildTmpFormacion;
use \TmpFormacionQuery as ChildTmpFormacionQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobSuscriptorTableMap;
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
 * Base class that represents a row from the 'job_suscriptor' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class JobSuscriptor implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobSuscriptorTableMap';


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
     * The value for the id_tmp_area field.
     * @var        int
     */
    protected $id_tmp_area;

    /**
     * The value for the id_tmp_formacion field.
     * @var        int
     */
    protected $id_tmp_formacion;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the nombre_simple field.
     * @var        string
     */
    protected $nombre_simple;

    /**
     * The value for the nombres field.
     * @var        string
     */
    protected $nombres;

    /**
     * The value for the apellidos field.
     * @var        string
     */
    protected $apellidos;

    /**
     * The value for the ubicacion field.
     * @var        string
     */
    protected $ubicacion;

    /**
     * The value for the ip field.
     * @var        string
     */
    protected $ip;

    /**
     * The value for the status field.
     * Note: this column has a database default value of: 'INICIADO'
     * @var        string
     */
    protected $status;

    /**
     * The value for the creation_date field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        \DateTime
     */
    protected $creation_date;

    /**
     * The value for the confirmation field.
     * @var        \DateTime
     */
    protected $confirmation;

    /**
     * @var        ChildTmpArea
     */
    protected $aTmpArea;

    /**
     * @var        ChildTmpFormacion
     */
    protected $aTmpFormacion;

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
        $this->status = 'INICIADO';
    }

    /**
     * Initializes internal state of Base\JobSuscriptor object.
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
     * Compares this with another <code>JobSuscriptor</code> instance.  If
     * <code>obj</code> is an instance of <code>JobSuscriptor</code>, delegates to
     * <code>equals(JobSuscriptor)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobSuscriptor The current object, for fluid interface
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
     * Get the [id_tmp_area] column value.
     * 
     * @return int
     */
    public function getIdTmpArea()
    {
        return $this->id_tmp_area;
    }

    /**
     * Get the [id_tmp_formacion] column value.
     * 
     * @return int
     */
    public function getIdTmpFormacion()
    {
        return $this->id_tmp_formacion;
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
     * Get the [nombre_simple] column value.
     * 
     * @return string
     */
    public function getNombreSimple()
    {
        return $this->nombre_simple;
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
     * Get the [apellidos] column value.
     * 
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Get the [ubicacion] column value.
     * 
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Get the [ip] column value.
     * 
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
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
     * Get the [optionally formatted] temporal [confirmation] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getConfirmation($format = NULL)
    {
        if ($format === null) {
            return $this->confirmation;
        } else {
            return $this->confirmation instanceof \DateTime ? $this->confirmation->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     * 
     * @param int $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_tmp_area] column.
     * 
     * @param int $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setIdTmpArea($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_tmp_area !== $v) {
            $this->id_tmp_area = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_ID_TMP_AREA] = true;
        }

        if ($this->aTmpArea !== null && $this->aTmpArea->getId() !== $v) {
            $this->aTmpArea = null;
        }

        return $this;
    } // setIdTmpArea()

    /**
     * Set the value of [id_tmp_formacion] column.
     * 
     * @param int $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setIdTmpFormacion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_tmp_formacion !== $v) {
            $this->id_tmp_formacion = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_ID_TMP_FORMACION] = true;
        }

        if ($this->aTmpFormacion !== null && $this->aTmpFormacion->getId() !== $v) {
            $this->aTmpFormacion = null;
        }

        return $this;
    } // setIdTmpFormacion()

    /**
     * Set the value of [email] column.
     * 
     * @param string $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [nombre_simple] column.
     * 
     * @param string $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setNombreSimple($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_simple !== $v) {
            $this->nombre_simple = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_NOMBRE_SIMPLE] = true;
        }

        return $this;
    } // setNombreSimple()

    /**
     * Set the value of [nombres] column.
     * 
     * @param string $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setNombres($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombres !== $v) {
            $this->nombres = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_NOMBRES] = true;
        }

        return $this;
    } // setNombres()

    /**
     * Set the value of [apellidos] column.
     * 
     * @param string $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setApellidos($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellidos !== $v) {
            $this->apellidos = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_APELLIDOS] = true;
        }

        return $this;
    } // setApellidos()

    /**
     * Set the value of [ubicacion] column.
     * 
     * @param string $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setUbicacion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ubicacion !== $v) {
            $this->ubicacion = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_UBICACION] = true;
        }

        return $this;
    } // setUbicacion()

    /**
     * Set the value of [ip] column.
     * 
     * @param string $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip !== $v) {
            $this->ip = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_IP] = true;
        }

        return $this;
    } // setIp()

    /**
     * Set the value of [status] column.
     * 
     * @param string $v new value
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[JobSuscriptorTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobSuscriptorTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [confirmation] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     */
    public function setConfirmation($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->confirmation !== null || $dt !== null) {
            if ($this->confirmation === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->confirmation->format("Y-m-d H:i:s")) {
                $this->confirmation = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobSuscriptorTableMap::COL_CONFIRMATION] = true;
            }
        } // if either are not null

        return $this;
    } // setConfirmation()

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
            if ($this->status !== 'INICIADO') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobSuscriptorTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobSuscriptorTableMap::translateFieldName('IdTmpArea', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_tmp_area = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobSuscriptorTableMap::translateFieldName('IdTmpFormacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_tmp_formacion = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobSuscriptorTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobSuscriptorTableMap::translateFieldName('NombreSimple', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_simple = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobSuscriptorTableMap::translateFieldName('Nombres', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombres = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobSuscriptorTableMap::translateFieldName('Apellidos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellidos = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobSuscriptorTableMap::translateFieldName('Ubicacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ubicacion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobSuscriptorTableMap::translateFieldName('Ip', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ip = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobSuscriptorTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobSuscriptorTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobSuscriptorTableMap::translateFieldName('Confirmation', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->confirmation = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = JobSuscriptorTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobSuscriptor'), 0, $e);
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
        if ($this->aTmpArea !== null && $this->id_tmp_area !== $this->aTmpArea->getId()) {
            $this->aTmpArea = null;
        }
        if ($this->aTmpFormacion !== null && $this->id_tmp_formacion !== $this->aTmpFormacion->getId()) {
            $this->aTmpFormacion = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(JobSuscriptorTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobSuscriptorQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTmpArea = null;
            $this->aTmpFormacion = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobSuscriptor::setDeleted()
     * @see JobSuscriptor::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobSuscriptorTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobSuscriptorQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobSuscriptorTableMap::DATABASE_NAME);
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
                JobSuscriptorTableMap::addInstanceToPool($this);
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

            if ($this->aTmpArea !== null) {
                if ($this->aTmpArea->isModified() || $this->aTmpArea->isNew()) {
                    $affectedRows += $this->aTmpArea->save($con);
                }
                $this->setTmpArea($this->aTmpArea);
            }

            if ($this->aTmpFormacion !== null) {
                if ($this->aTmpFormacion->isModified() || $this->aTmpFormacion->isNew()) {
                    $affectedRows += $this->aTmpFormacion->save($con);
                }
                $this->setTmpFormacion($this->aTmpFormacion);
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

        $this->modifiedColumns[JobSuscriptorTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobSuscriptorTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_ID_TMP_AREA)) {
            $modifiedColumns[':p' . $index++]  = 'ID_TMP_AREA';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_ID_TMP_FORMACION)) {
            $modifiedColumns[':p' . $index++]  = 'ID_TMP_FORMACION';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_NOMBRE_SIMPLE)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE_SIMPLE';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_NOMBRES)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRES';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_APELLIDOS)) {
            $modifiedColumns[':p' . $index++]  = 'APELLIDOS';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_UBICACION)) {
            $modifiedColumns[':p' . $index++]  = 'UBICACION';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_IP)) {
            $modifiedColumns[':p' . $index++]  = 'IP';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_CONFIRMATION)) {
            $modifiedColumns[':p' . $index++]  = 'CONFIRMATION';
        }

        $sql = sprintf(
            'INSERT INTO job_suscriptor (%s) VALUES (%s)',
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
                    case 'ID_TMP_AREA':                        
                        $stmt->bindValue($identifier, $this->id_tmp_area, PDO::PARAM_INT);
                        break;
                    case 'ID_TMP_FORMACION':                        
                        $stmt->bindValue($identifier, $this->id_tmp_formacion, PDO::PARAM_INT);
                        break;
                    case 'EMAIL':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'NOMBRE_SIMPLE':                        
                        $stmt->bindValue($identifier, $this->nombre_simple, PDO::PARAM_STR);
                        break;
                    case 'NOMBRES':                        
                        $stmt->bindValue($identifier, $this->nombres, PDO::PARAM_STR);
                        break;
                    case 'APELLIDOS':                        
                        $stmt->bindValue($identifier, $this->apellidos, PDO::PARAM_STR);
                        break;
                    case 'UBICACION':                        
                        $stmt->bindValue($identifier, $this->ubicacion, PDO::PARAM_STR);
                        break;
                    case 'IP':                        
                        $stmt->bindValue($identifier, $this->ip, PDO::PARAM_STR);
                        break;
                    case 'STATUS':                        
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'CREATION_DATE':                        
                        $stmt->bindValue($identifier, $this->creation_date ? $this->creation_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'CONFIRMATION':                        
                        $stmt->bindValue($identifier, $this->confirmation ? $this->confirmation->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = JobSuscriptorTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdTmpArea();
                break;
            case 2:
                return $this->getIdTmpFormacion();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getNombreSimple();
                break;
            case 5:
                return $this->getNombres();
                break;
            case 6:
                return $this->getApellidos();
                break;
            case 7:
                return $this->getUbicacion();
                break;
            case 8:
                return $this->getIp();
                break;
            case 9:
                return $this->getStatus();
                break;
            case 10:
                return $this->getCreationDate();
                break;
            case 11:
                return $this->getConfirmation();
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

        if (isset($alreadyDumpedObjects['JobSuscriptor'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobSuscriptor'][$this->hashCode()] = true;
        $keys = JobSuscriptorTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdTmpArea(),
            $keys[2] => $this->getIdTmpFormacion(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getNombreSimple(),
            $keys[5] => $this->getNombres(),
            $keys[6] => $this->getApellidos(),
            $keys[7] => $this->getUbicacion(),
            $keys[8] => $this->getIp(),
            $keys[9] => $this->getStatus(),
            $keys[10] => $this->getCreationDate(),
            $keys[11] => $this->getConfirmation(),
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
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aTmpArea) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tmpArea';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tmp_area';
                        break;
                    default:
                        $key = 'TmpArea';
                }
        
                $result[$key] = $this->aTmpArea->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTmpFormacion) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tmpFormacion';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tmp_formacion';
                        break;
                    default:
                        $key = 'TmpFormacion';
                }
        
                $result[$key] = $this->aTmpFormacion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\JobSuscriptor
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobSuscriptorTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobSuscriptor
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdTmpArea($value);
                break;
            case 2:
                $this->setIdTmpFormacion($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setNombreSimple($value);
                break;
            case 5:
                $this->setNombres($value);
                break;
            case 6:
                $this->setApellidos($value);
                break;
            case 7:
                $this->setUbicacion($value);
                break;
            case 8:
                $this->setIp($value);
                break;
            case 9:
                $this->setStatus($value);
                break;
            case 10:
                $this->setCreationDate($value);
                break;
            case 11:
                $this->setConfirmation($value);
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
        $keys = JobSuscriptorTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdTmpArea($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdTmpFormacion($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNombreSimple($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNombres($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setApellidos($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUbicacion($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIp($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStatus($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreationDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setConfirmation($arr[$keys[11]]);
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
     * @return $this|\JobSuscriptor The current object, for fluid interface
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
        $criteria = new Criteria(JobSuscriptorTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobSuscriptorTableMap::COL_ID)) {
            $criteria->add(JobSuscriptorTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_ID_TMP_AREA)) {
            $criteria->add(JobSuscriptorTableMap::COL_ID_TMP_AREA, $this->id_tmp_area);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_ID_TMP_FORMACION)) {
            $criteria->add(JobSuscriptorTableMap::COL_ID_TMP_FORMACION, $this->id_tmp_formacion);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_EMAIL)) {
            $criteria->add(JobSuscriptorTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_NOMBRE_SIMPLE)) {
            $criteria->add(JobSuscriptorTableMap::COL_NOMBRE_SIMPLE, $this->nombre_simple);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_NOMBRES)) {
            $criteria->add(JobSuscriptorTableMap::COL_NOMBRES, $this->nombres);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_APELLIDOS)) {
            $criteria->add(JobSuscriptorTableMap::COL_APELLIDOS, $this->apellidos);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_UBICACION)) {
            $criteria->add(JobSuscriptorTableMap::COL_UBICACION, $this->ubicacion);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_IP)) {
            $criteria->add(JobSuscriptorTableMap::COL_IP, $this->ip);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_STATUS)) {
            $criteria->add(JobSuscriptorTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobSuscriptorTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobSuscriptorTableMap::COL_CONFIRMATION)) {
            $criteria->add(JobSuscriptorTableMap::COL_CONFIRMATION, $this->confirmation);
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
        $criteria = ChildJobSuscriptorQuery::create();
        $criteria->add(JobSuscriptorTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobSuscriptor (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdTmpArea($this->getIdTmpArea());
        $copyObj->setIdTmpFormacion($this->getIdTmpFormacion());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setNombreSimple($this->getNombreSimple());
        $copyObj->setNombres($this->getNombres());
        $copyObj->setApellidos($this->getApellidos());
        $copyObj->setUbicacion($this->getUbicacion());
        $copyObj->setIp($this->getIp());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setConfirmation($this->getConfirmation());
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
     * @return \JobSuscriptor Clone of current object.
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
     * Declares an association between this object and a ChildTmpArea object.
     *
     * @param  ChildTmpArea $v
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTmpArea(ChildTmpArea $v = null)
    {
        if ($v === null) {
            $this->setIdTmpArea(NULL);
        } else {
            $this->setIdTmpArea($v->getId());
        }

        $this->aTmpArea = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTmpArea object, it will not be re-added.
        if ($v !== null) {
            $v->addJobSuscriptor($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTmpArea object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildTmpArea The associated ChildTmpArea object.
     * @throws PropelException
     */
    public function getTmpArea(ConnectionInterface $con = null)
    {
        if ($this->aTmpArea === null && ($this->id_tmp_area !== null)) {
            $this->aTmpArea = ChildTmpAreaQuery::create()->findPk($this->id_tmp_area, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTmpArea->addJobSuscriptors($this);
             */
        }

        return $this->aTmpArea;
    }

    /**
     * Declares an association between this object and a ChildTmpFormacion object.
     *
     * @param  ChildTmpFormacion $v
     * @return $this|\JobSuscriptor The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTmpFormacion(ChildTmpFormacion $v = null)
    {
        if ($v === null) {
            $this->setIdTmpFormacion(NULL);
        } else {
            $this->setIdTmpFormacion($v->getId());
        }

        $this->aTmpFormacion = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTmpFormacion object, it will not be re-added.
        if ($v !== null) {
            $v->addJobSuscriptor($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTmpFormacion object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildTmpFormacion The associated ChildTmpFormacion object.
     * @throws PropelException
     */
    public function getTmpFormacion(ConnectionInterface $con = null)
    {
        if ($this->aTmpFormacion === null && ($this->id_tmp_formacion !== null)) {
            $this->aTmpFormacion = ChildTmpFormacionQuery::create()->findPk($this->id_tmp_formacion, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTmpFormacion->addJobSuscriptors($this);
             */
        }

        return $this->aTmpFormacion;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aTmpArea) {
            $this->aTmpArea->removeJobSuscriptor($this);
        }
        if (null !== $this->aTmpFormacion) {
            $this->aTmpFormacion->removeJobSuscriptor($this);
        }
        $this->id = null;
        $this->id_tmp_area = null;
        $this->id_tmp_formacion = null;
        $this->email = null;
        $this->nombre_simple = null;
        $this->nombres = null;
        $this->apellidos = null;
        $this->ubicacion = null;
        $this->ip = null;
        $this->status = null;
        $this->creation_date = null;
        $this->confirmation = null;
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

        $this->aTmpArea = null;
        $this->aTmpFormacion = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobSuscriptorTableMap::DEFAULT_STRING_FORMAT);
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
