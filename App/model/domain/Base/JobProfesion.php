<?php

namespace Base;

use \JobAreaTecnicaProfesion as ChildJobAreaTecnicaProfesion;
use \JobAreaTecnicaProfesionQuery as ChildJobAreaTecnicaProfesionQuery;
use \JobFormacionAcademica as ChildJobFormacionAcademica;
use \JobFormacionAcademicaQuery as ChildJobFormacionAcademicaQuery;
use \JobProfesion as ChildJobProfesion;
use \JobProfesionQuery as ChildJobProfesionQuery;
use \JobTipoFormacion as ChildJobTipoFormacion;
use \JobTipoFormacionQuery as ChildJobTipoFormacionQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobAreaTecnicaProfesionTableMap;
use Map\JobFormacionAcademicaTableMap;
use Map\JobProfesionTableMap;
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
 * Base class that represents a row from the 'job_profesion' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class JobProfesion implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobProfesionTableMap';


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
     * The value for the id_tipo_formacion field.
     *
     * @var        int
     */
    protected $id_tipo_formacion;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the otros_nombres field.
     *
     * @var        string
     */
    protected $otros_nombres;

    /**
     * The value for the descripcion field.
     *
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 'ACTIVE'
     * @var        string
     */
    protected $status;

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
     * @var        ChildJobTipoFormacion
     */
    protected $aJobTipoFormacion;

    /**
     * @var        ObjectCollection|ChildJobAreaTecnicaProfesion[] Collection to store aggregation of ChildJobAreaTecnicaProfesion objects.
     */
    protected $collJobAreaTecnicaProfesions;
    protected $collJobAreaTecnicaProfesionsPartial;

    /**
     * @var        ObjectCollection|ChildJobFormacionAcademica[] Collection to store aggregation of ChildJobFormacionAcademica objects.
     */
    protected $collJobFormacionAcademicas;
    protected $collJobFormacionAcademicasPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobAreaTecnicaProfesion[]
     */
    protected $jobAreaTecnicaProfesionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobFormacionAcademica[]
     */
    protected $jobFormacionAcademicasScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->status = 'ACTIVE';
        $this->last_user_id = 0;
    }

    /**
     * Initializes internal state of Base\JobProfesion object.
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
     * Compares this with another <code>JobProfesion</code> instance.  If
     * <code>obj</code> is an instance of <code>JobProfesion</code>, delegates to
     * <code>equals(JobProfesion)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobProfesion The current object, for fluid interface
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
     * Get the [id_tipo_formacion] column value.
     *
     * @return int
     */
    public function getIdTipoFormacion()
    {
        return $this->id_tipo_formacion;
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
     * Get the [otros_nombres] column value.
     *
     * @return string
     */
    public function getOtrosNombres()
    {
        return $this->otros_nombres;
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
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobProfesionTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_tipo_formacion] column.
     *
     * @param int $v new value
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setIdTipoFormacion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_tipo_formacion !== $v) {
            $this->id_tipo_formacion = $v;
            $this->modifiedColumns[JobProfesionTableMap::COL_ID_TIPO_FORMACION] = true;
        }

        if ($this->aJobTipoFormacion !== null && $this->aJobTipoFormacion->getId() !== $v) {
            $this->aJobTipoFormacion = null;
        }

        return $this;
    } // setIdTipoFormacion()

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v new value
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[JobProfesionTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [otros_nombres] column.
     *
     * @param string $v new value
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setOtrosNombres($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->otros_nombres !== $v) {
            $this->otros_nombres = $v;
            $this->modifiedColumns[JobProfesionTableMap::COL_OTROS_NOMBRES] = true;
        }

        return $this;
    } // setOtrosNombres()

    /**
     * Set the value of [descripcion] column.
     *
     * @param string $v new value
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[JobProfesionTableMap::COL_DESCRIPCION] = true;
        }

        return $this;
    } // setDescripcion()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[JobProfesionTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [last_user_id] column.
     *
     * @param int $v new value
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[JobProfesionTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobProfesionTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->modification_date->format("Y-m-d H:i:s")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobProfesionTableMap::COL_MODIFICATION_DATE] = true;
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
            if ($this->status !== 'ACTIVE') {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobProfesionTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobProfesionTableMap::translateFieldName('IdTipoFormacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_tipo_formacion = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobProfesionTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobProfesionTableMap::translateFieldName('OtrosNombres', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otros_nombres = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobProfesionTableMap::translateFieldName('Descripcion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descripcion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobProfesionTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobProfesionTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobProfesionTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobProfesionTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = JobProfesionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobProfesion'), 0, $e);
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
        if ($this->aJobTipoFormacion !== null && $this->id_tipo_formacion !== $this->aJobTipoFormacion->getId()) {
            $this->aJobTipoFormacion = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(JobProfesionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobProfesionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aJobTipoFormacion = null;
            $this->collJobAreaTecnicaProfesions = null;

            $this->collJobFormacionAcademicas = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobProfesion::setDeleted()
     * @see JobProfesion::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobProfesionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobProfesionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobProfesionTableMap::DATABASE_NAME);
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
                JobProfesionTableMap::addInstanceToPool($this);
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

            if ($this->jobAreaTecnicaProfesionsScheduledForDeletion !== null) {
                if (!$this->jobAreaTecnicaProfesionsScheduledForDeletion->isEmpty()) {
                    \JobAreaTecnicaProfesionQuery::create()
                        ->filterByPrimaryKeys($this->jobAreaTecnicaProfesionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jobAreaTecnicaProfesionsScheduledForDeletion = null;
                }
            }

            if ($this->collJobAreaTecnicaProfesions !== null) {
                foreach ($this->collJobAreaTecnicaProfesions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jobFormacionAcademicasScheduledForDeletion !== null) {
                if (!$this->jobFormacionAcademicasScheduledForDeletion->isEmpty()) {
                    foreach ($this->jobFormacionAcademicasScheduledForDeletion as $jobFormacionAcademica) {
                        // need to save related object because we set the relation to null
                        $jobFormacionAcademica->save($con);
                    }
                    $this->jobFormacionAcademicasScheduledForDeletion = null;
                }
            }

            if ($this->collJobFormacionAcademicas !== null) {
                foreach ($this->collJobFormacionAcademicas as $referrerFK) {
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

        $this->modifiedColumns[JobProfesionTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobProfesionTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobProfesionTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_ID_TIPO_FORMACION)) {
            $modifiedColumns[':p' . $index++]  = 'ID_TIPO_FORMACION';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_OTROS_NOMBRES)) {
            $modifiedColumns[':p' . $index++]  = 'OTROS_NOMBRES';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPCION';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_profesion (%s) VALUES (%s)',
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
                    case 'ID_TIPO_FORMACION':
                        $stmt->bindValue($identifier, $this->id_tipo_formacion, PDO::PARAM_INT);
                        break;
                    case 'NOMBRE':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'OTROS_NOMBRES':
                        $stmt->bindValue($identifier, $this->otros_nombres, PDO::PARAM_STR);
                        break;
                    case 'DESCRIPCION':
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
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
        $pos = JobProfesionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdTipoFormacion();
                break;
            case 2:
                return $this->getNombre();
                break;
            case 3:
                return $this->getOtrosNombres();
                break;
            case 4:
                return $this->getDescripcion();
                break;
            case 5:
                return $this->getStatus();
                break;
            case 6:
                return $this->getLastUserId();
                break;
            case 7:
                return $this->getCreationDate();
                break;
            case 8:
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

        if (isset($alreadyDumpedObjects['JobProfesion'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobProfesion'][$this->hashCode()] = true;
        $keys = JobProfesionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdTipoFormacion(),
            $keys[2] => $this->getNombre(),
            $keys[3] => $this->getOtrosNombres(),
            $keys[4] => $this->getDescripcion(),
            $keys[5] => $this->getStatus(),
            $keys[6] => $this->getLastUserId(),
            $keys[7] => $this->getCreationDate(),
            $keys[8] => $this->getModificationDate(),
        );
        if ($result[$keys[7]] instanceof \DateTime) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTime) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
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
            if (null !== $this->collJobAreaTecnicaProfesions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobAreaTecnicaProfesions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_area_tecnica_profesions';
                        break;
                    default:
                        $key = 'JobAreaTecnicaProfesions';
                }

                $result[$key] = $this->collJobAreaTecnicaProfesions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJobFormacionAcademicas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobFormacionAcademicas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_formacion_academicas';
                        break;
                    default:
                        $key = 'JobFormacionAcademicas';
                }

                $result[$key] = $this->collJobFormacionAcademicas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\JobProfesion
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobProfesionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobProfesion
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdTipoFormacion($value);
                break;
            case 2:
                $this->setNombre($value);
                break;
            case 3:
                $this->setOtrosNombres($value);
                break;
            case 4:
                $this->setDescripcion($value);
                break;
            case 5:
                $this->setStatus($value);
                break;
            case 6:
                $this->setLastUserId($value);
                break;
            case 7:
                $this->setCreationDate($value);
                break;
            case 8:
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
        $keys = JobProfesionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdTipoFormacion($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNombre($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setOtrosNombres($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescripcion($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStatus($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLastUserId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreationDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setModificationDate($arr[$keys[8]]);
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
     * @return $this|\JobProfesion The current object, for fluid interface
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
        $criteria = new Criteria(JobProfesionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobProfesionTableMap::COL_ID)) {
            $criteria->add(JobProfesionTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_ID_TIPO_FORMACION)) {
            $criteria->add(JobProfesionTableMap::COL_ID_TIPO_FORMACION, $this->id_tipo_formacion);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_NOMBRE)) {
            $criteria->add(JobProfesionTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_OTROS_NOMBRES)) {
            $criteria->add(JobProfesionTableMap::COL_OTROS_NOMBRES, $this->otros_nombres);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_DESCRIPCION)) {
            $criteria->add(JobProfesionTableMap::COL_DESCRIPCION, $this->descripcion);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_STATUS)) {
            $criteria->add(JobProfesionTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_LAST_USER_ID)) {
            $criteria->add(JobProfesionTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobProfesionTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobProfesionTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(JobProfesionTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildJobProfesionQuery::create();
        $criteria->add(JobProfesionTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobProfesion (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdTipoFormacion($this->getIdTipoFormacion());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setOtrosNombres($this->getOtrosNombres());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getJobAreaTecnicaProfesions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobAreaTecnicaProfesion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJobFormacionAcademicas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobFormacionAcademica($relObj->copy($deepCopy));
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
     * @return \JobProfesion Clone of current object.
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
     * @return $this|\JobProfesion The current object (for fluent API support)
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
            $v->addJobProfesion($this);
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
                $this->aJobTipoFormacion->addJobProfesions($this);
             */
        }

        return $this->aJobTipoFormacion;
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
        if ('JobAreaTecnicaProfesion' == $relationName) {
            return $this->initJobAreaTecnicaProfesions();
        }
        if ('JobFormacionAcademica' == $relationName) {
            return $this->initJobFormacionAcademicas();
        }
    }

    /**
     * Clears out the collJobAreaTecnicaProfesions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobAreaTecnicaProfesions()
     */
    public function clearJobAreaTecnicaProfesions()
    {
        $this->collJobAreaTecnicaProfesions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobAreaTecnicaProfesions collection loaded partially.
     */
    public function resetPartialJobAreaTecnicaProfesions($v = true)
    {
        $this->collJobAreaTecnicaProfesionsPartial = $v;
    }

    /**
     * Initializes the collJobAreaTecnicaProfesions collection.
     *
     * By default this just sets the collJobAreaTecnicaProfesions collection to an empty array (like clearcollJobAreaTecnicaProfesions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobAreaTecnicaProfesions($overrideExisting = true)
    {
        if (null !== $this->collJobAreaTecnicaProfesions && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobAreaTecnicaProfesionTableMap::getTableMap()->getCollectionClassName();

        $this->collJobAreaTecnicaProfesions = new $collectionClassName;
        $this->collJobAreaTecnicaProfesions->setModel('\JobAreaTecnicaProfesion');
    }

    /**
     * Gets an array of ChildJobAreaTecnicaProfesion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobProfesion is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobAreaTecnicaProfesion[] List of ChildJobAreaTecnicaProfesion objects
     * @throws PropelException
     */
    public function getJobAreaTecnicaProfesions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAreaTecnicaProfesionsPartial && !$this->isNew();
        if (null === $this->collJobAreaTecnicaProfesions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobAreaTecnicaProfesions) {
                // return empty collection
                $this->initJobAreaTecnicaProfesions();
            } else {
                $collJobAreaTecnicaProfesions = ChildJobAreaTecnicaProfesionQuery::create(null, $criteria)
                    ->filterByJobProfesion($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobAreaTecnicaProfesionsPartial && count($collJobAreaTecnicaProfesions)) {
                        $this->initJobAreaTecnicaProfesions(false);

                        foreach ($collJobAreaTecnicaProfesions as $obj) {
                            if (false == $this->collJobAreaTecnicaProfesions->contains($obj)) {
                                $this->collJobAreaTecnicaProfesions->append($obj);
                            }
                        }

                        $this->collJobAreaTecnicaProfesionsPartial = true;
                    }

                    return $collJobAreaTecnicaProfesions;
                }

                if ($partial && $this->collJobAreaTecnicaProfesions) {
                    foreach ($this->collJobAreaTecnicaProfesions as $obj) {
                        if ($obj->isNew()) {
                            $collJobAreaTecnicaProfesions[] = $obj;
                        }
                    }
                }

                $this->collJobAreaTecnicaProfesions = $collJobAreaTecnicaProfesions;
                $this->collJobAreaTecnicaProfesionsPartial = false;
            }
        }

        return $this->collJobAreaTecnicaProfesions;
    }

    /**
     * Sets a collection of ChildJobAreaTecnicaProfesion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobAreaTecnicaProfesions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobProfesion The current object (for fluent API support)
     */
    public function setJobAreaTecnicaProfesions(Collection $jobAreaTecnicaProfesions, ConnectionInterface $con = null)
    {
        /** @var ChildJobAreaTecnicaProfesion[] $jobAreaTecnicaProfesionsToDelete */
        $jobAreaTecnicaProfesionsToDelete = $this->getJobAreaTecnicaProfesions(new Criteria(), $con)->diff($jobAreaTecnicaProfesions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->jobAreaTecnicaProfesionsScheduledForDeletion = clone $jobAreaTecnicaProfesionsToDelete;

        foreach ($jobAreaTecnicaProfesionsToDelete as $jobAreaTecnicaProfesionRemoved) {
            $jobAreaTecnicaProfesionRemoved->setJobProfesion(null);
        }

        $this->collJobAreaTecnicaProfesions = null;
        foreach ($jobAreaTecnicaProfesions as $jobAreaTecnicaProfesion) {
            $this->addJobAreaTecnicaProfesion($jobAreaTecnicaProfesion);
        }

        $this->collJobAreaTecnicaProfesions = $jobAreaTecnicaProfesions;
        $this->collJobAreaTecnicaProfesionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobAreaTecnicaProfesion objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobAreaTecnicaProfesion objects.
     * @throws PropelException
     */
    public function countJobAreaTecnicaProfesions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAreaTecnicaProfesionsPartial && !$this->isNew();
        if (null === $this->collJobAreaTecnicaProfesions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobAreaTecnicaProfesions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobAreaTecnicaProfesions());
            }

            $query = ChildJobAreaTecnicaProfesionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobProfesion($this)
                ->count($con);
        }

        return count($this->collJobAreaTecnicaProfesions);
    }

    /**
     * Method called to associate a ChildJobAreaTecnicaProfesion object to this object
     * through the ChildJobAreaTecnicaProfesion foreign key attribute.
     *
     * @param  ChildJobAreaTecnicaProfesion $l ChildJobAreaTecnicaProfesion
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function addJobAreaTecnicaProfesion(ChildJobAreaTecnicaProfesion $l)
    {
        if ($this->collJobAreaTecnicaProfesions === null) {
            $this->initJobAreaTecnicaProfesions();
            $this->collJobAreaTecnicaProfesionsPartial = true;
        }

        if (!$this->collJobAreaTecnicaProfesions->contains($l)) {
            $this->doAddJobAreaTecnicaProfesion($l);

            if ($this->jobAreaTecnicaProfesionsScheduledForDeletion and $this->jobAreaTecnicaProfesionsScheduledForDeletion->contains($l)) {
                $this->jobAreaTecnicaProfesionsScheduledForDeletion->remove($this->jobAreaTecnicaProfesionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobAreaTecnicaProfesion $jobAreaTecnicaProfesion The ChildJobAreaTecnicaProfesion object to add.
     */
    protected function doAddJobAreaTecnicaProfesion(ChildJobAreaTecnicaProfesion $jobAreaTecnicaProfesion)
    {
        $this->collJobAreaTecnicaProfesions[]= $jobAreaTecnicaProfesion;
        $jobAreaTecnicaProfesion->setJobProfesion($this);
    }

    /**
     * @param  ChildJobAreaTecnicaProfesion $jobAreaTecnicaProfesion The ChildJobAreaTecnicaProfesion object to remove.
     * @return $this|ChildJobProfesion The current object (for fluent API support)
     */
    public function removeJobAreaTecnicaProfesion(ChildJobAreaTecnicaProfesion $jobAreaTecnicaProfesion)
    {
        if ($this->getJobAreaTecnicaProfesions()->contains($jobAreaTecnicaProfesion)) {
            $pos = $this->collJobAreaTecnicaProfesions->search($jobAreaTecnicaProfesion);
            $this->collJobAreaTecnicaProfesions->remove($pos);
            if (null === $this->jobAreaTecnicaProfesionsScheduledForDeletion) {
                $this->jobAreaTecnicaProfesionsScheduledForDeletion = clone $this->collJobAreaTecnicaProfesions;
                $this->jobAreaTecnicaProfesionsScheduledForDeletion->clear();
            }
            $this->jobAreaTecnicaProfesionsScheduledForDeletion[]= clone $jobAreaTecnicaProfesion;
            $jobAreaTecnicaProfesion->setJobProfesion(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobProfesion is new, it will return
     * an empty collection; or if this JobProfesion has previously
     * been saved, it will retrieve related JobAreaTecnicaProfesions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobProfesion.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobAreaTecnicaProfesion[] List of ChildJobAreaTecnicaProfesion objects
     */
    public function getJobAreaTecnicaProfesionsJoinJobAreaTecnica(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobAreaTecnicaProfesionQuery::create(null, $criteria);
        $query->joinWith('JobAreaTecnica', $joinBehavior);

        return $this->getJobAreaTecnicaProfesions($query, $con);
    }

    /**
     * Clears out the collJobFormacionAcademicas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobFormacionAcademicas()
     */
    public function clearJobFormacionAcademicas()
    {
        $this->collJobFormacionAcademicas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobFormacionAcademicas collection loaded partially.
     */
    public function resetPartialJobFormacionAcademicas($v = true)
    {
        $this->collJobFormacionAcademicasPartial = $v;
    }

    /**
     * Initializes the collJobFormacionAcademicas collection.
     *
     * By default this just sets the collJobFormacionAcademicas collection to an empty array (like clearcollJobFormacionAcademicas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobFormacionAcademicas($overrideExisting = true)
    {
        if (null !== $this->collJobFormacionAcademicas && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobFormacionAcademicaTableMap::getTableMap()->getCollectionClassName();

        $this->collJobFormacionAcademicas = new $collectionClassName;
        $this->collJobFormacionAcademicas->setModel('\JobFormacionAcademica');
    }

    /**
     * Gets an array of ChildJobFormacionAcademica objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobProfesion is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobFormacionAcademica[] List of ChildJobFormacionAcademica objects
     * @throws PropelException
     */
    public function getJobFormacionAcademicas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobFormacionAcademicasPartial && !$this->isNew();
        if (null === $this->collJobFormacionAcademicas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobFormacionAcademicas) {
                // return empty collection
                $this->initJobFormacionAcademicas();
            } else {
                $collJobFormacionAcademicas = ChildJobFormacionAcademicaQuery::create(null, $criteria)
                    ->filterByJobProfesion($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobFormacionAcademicasPartial && count($collJobFormacionAcademicas)) {
                        $this->initJobFormacionAcademicas(false);

                        foreach ($collJobFormacionAcademicas as $obj) {
                            if (false == $this->collJobFormacionAcademicas->contains($obj)) {
                                $this->collJobFormacionAcademicas->append($obj);
                            }
                        }

                        $this->collJobFormacionAcademicasPartial = true;
                    }

                    return $collJobFormacionAcademicas;
                }

                if ($partial && $this->collJobFormacionAcademicas) {
                    foreach ($this->collJobFormacionAcademicas as $obj) {
                        if ($obj->isNew()) {
                            $collJobFormacionAcademicas[] = $obj;
                        }
                    }
                }

                $this->collJobFormacionAcademicas = $collJobFormacionAcademicas;
                $this->collJobFormacionAcademicasPartial = false;
            }
        }

        return $this->collJobFormacionAcademicas;
    }

    /**
     * Sets a collection of ChildJobFormacionAcademica objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobFormacionAcademicas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobProfesion The current object (for fluent API support)
     */
    public function setJobFormacionAcademicas(Collection $jobFormacionAcademicas, ConnectionInterface $con = null)
    {
        /** @var ChildJobFormacionAcademica[] $jobFormacionAcademicasToDelete */
        $jobFormacionAcademicasToDelete = $this->getJobFormacionAcademicas(new Criteria(), $con)->diff($jobFormacionAcademicas);


        $this->jobFormacionAcademicasScheduledForDeletion = $jobFormacionAcademicasToDelete;

        foreach ($jobFormacionAcademicasToDelete as $jobFormacionAcademicaRemoved) {
            $jobFormacionAcademicaRemoved->setJobProfesion(null);
        }

        $this->collJobFormacionAcademicas = null;
        foreach ($jobFormacionAcademicas as $jobFormacionAcademica) {
            $this->addJobFormacionAcademica($jobFormacionAcademica);
        }

        $this->collJobFormacionAcademicas = $jobFormacionAcademicas;
        $this->collJobFormacionAcademicasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobFormacionAcademica objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobFormacionAcademica objects.
     * @throws PropelException
     */
    public function countJobFormacionAcademicas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobFormacionAcademicasPartial && !$this->isNew();
        if (null === $this->collJobFormacionAcademicas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobFormacionAcademicas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobFormacionAcademicas());
            }

            $query = ChildJobFormacionAcademicaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobProfesion($this)
                ->count($con);
        }

        return count($this->collJobFormacionAcademicas);
    }

    /**
     * Method called to associate a ChildJobFormacionAcademica object to this object
     * through the ChildJobFormacionAcademica foreign key attribute.
     *
     * @param  ChildJobFormacionAcademica $l ChildJobFormacionAcademica
     * @return $this|\JobProfesion The current object (for fluent API support)
     */
    public function addJobFormacionAcademica(ChildJobFormacionAcademica $l)
    {
        if ($this->collJobFormacionAcademicas === null) {
            $this->initJobFormacionAcademicas();
            $this->collJobFormacionAcademicasPartial = true;
        }

        if (!$this->collJobFormacionAcademicas->contains($l)) {
            $this->doAddJobFormacionAcademica($l);

            if ($this->jobFormacionAcademicasScheduledForDeletion and $this->jobFormacionAcademicasScheduledForDeletion->contains($l)) {
                $this->jobFormacionAcademicasScheduledForDeletion->remove($this->jobFormacionAcademicasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobFormacionAcademica $jobFormacionAcademica The ChildJobFormacionAcademica object to add.
     */
    protected function doAddJobFormacionAcademica(ChildJobFormacionAcademica $jobFormacionAcademica)
    {
        $this->collJobFormacionAcademicas[]= $jobFormacionAcademica;
        $jobFormacionAcademica->setJobProfesion($this);
    }

    /**
     * @param  ChildJobFormacionAcademica $jobFormacionAcademica The ChildJobFormacionAcademica object to remove.
     * @return $this|ChildJobProfesion The current object (for fluent API support)
     */
    public function removeJobFormacionAcademica(ChildJobFormacionAcademica $jobFormacionAcademica)
    {
        if ($this->getJobFormacionAcademicas()->contains($jobFormacionAcademica)) {
            $pos = $this->collJobFormacionAcademicas->search($jobFormacionAcademica);
            $this->collJobFormacionAcademicas->remove($pos);
            if (null === $this->jobFormacionAcademicasScheduledForDeletion) {
                $this->jobFormacionAcademicasScheduledForDeletion = clone $this->collJobFormacionAcademicas;
                $this->jobFormacionAcademicasScheduledForDeletion->clear();
            }
            $this->jobFormacionAcademicasScheduledForDeletion[]= $jobFormacionAcademica;
            $jobFormacionAcademica->setJobProfesion(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobProfesion is new, it will return
     * an empty collection; or if this JobProfesion has previously
     * been saved, it will retrieve related JobFormacionAcademicas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobProfesion.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobFormacionAcademica[] List of ChildJobFormacionAcademica objects
     */
    public function getJobFormacionAcademicasJoinJobTipoFormacion(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobFormacionAcademicaQuery::create(null, $criteria);
        $query->joinWith('JobTipoFormacion', $joinBehavior);

        return $this->getJobFormacionAcademicas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobProfesion is new, it will return
     * an empty collection; or if this JobProfesion has previously
     * been saved, it will retrieve related JobFormacionAcademicas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobProfesion.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobFormacionAcademica[] List of ChildJobFormacionAcademica objects
     */
    public function getJobFormacionAcademicasJoinJobCurriculum(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobFormacionAcademicaQuery::create(null, $criteria);
        $query->joinWith('JobCurriculum', $joinBehavior);

        return $this->getJobFormacionAcademicas($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aJobTipoFormacion) {
            $this->aJobTipoFormacion->removeJobProfesion($this);
        }
        $this->id = null;
        $this->id_tipo_formacion = null;
        $this->nombre = null;
        $this->otros_nombres = null;
        $this->descripcion = null;
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
            if ($this->collJobAreaTecnicaProfesions) {
                foreach ($this->collJobAreaTecnicaProfesions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJobFormacionAcademicas) {
                foreach ($this->collJobFormacionAcademicas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collJobAreaTecnicaProfesions = null;
        $this->collJobFormacionAcademicas = null;
        $this->aJobTipoFormacion = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobProfesionTableMap::DEFAULT_STRING_FORMAT);
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
