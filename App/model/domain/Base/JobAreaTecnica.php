<?php

namespace Base;

use \JobAreaRelacionada as ChildJobAreaRelacionada;
use \JobAreaRelacionadaQuery as ChildJobAreaRelacionadaQuery;
use \JobAreaTecnica as ChildJobAreaTecnica;
use \JobAreaTecnicaProfesion as ChildJobAreaTecnicaProfesion;
use \JobAreaTecnicaProfesionQuery as ChildJobAreaTecnicaProfesionQuery;
use \JobAreaTecnicaQuery as ChildJobAreaTecnicaQuery;
use \JobAviso as ChildJobAviso;
use \JobAvisoQuery as ChildJobAvisoQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobAreaRelacionadaTableMap;
use Map\JobAreaTecnicaProfesionTableMap;
use Map\JobAreaTecnicaTableMap;
use Map\JobAvisoTableMap;
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
 * Base class that represents a row from the 'job_area_tecnica' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class JobAreaTecnica implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobAreaTecnicaTableMap';


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
     * The value for the id_area_principal field.
     *
     * @var        int
     */
    protected $id_area_principal;

    /**
     * The value for the nivel field.
     *
     * @var        int
     */
    protected $nivel;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the keywords field.
     *
     * @var        string
     */
    protected $keywords;

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
     * @var        ObjectCollection|ChildJobAreaRelacionada[] Collection to store aggregation of ChildJobAreaRelacionada objects.
     */
    protected $collJobAreaRelacionadasRelatedByIdArea1;
    protected $collJobAreaRelacionadasRelatedByIdArea1Partial;

    /**
     * @var        ObjectCollection|ChildJobAreaRelacionada[] Collection to store aggregation of ChildJobAreaRelacionada objects.
     */
    protected $collJobAreaRelacionadasRelatedByIdArea2;
    protected $collJobAreaRelacionadasRelatedByIdArea2Partial;

    /**
     * @var        ObjectCollection|ChildJobAreaTecnicaProfesion[] Collection to store aggregation of ChildJobAreaTecnicaProfesion objects.
     */
    protected $collJobAreaTecnicaProfesions;
    protected $collJobAreaTecnicaProfesionsPartial;

    /**
     * @var        ObjectCollection|ChildJobAviso[] Collection to store aggregation of ChildJobAviso objects.
     */
    protected $collJobAvisos;
    protected $collJobAvisosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobAreaRelacionada[]
     */
    protected $jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobAreaRelacionada[]
     */
    protected $jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobAreaTecnicaProfesion[]
     */
    protected $jobAreaTecnicaProfesionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobAviso[]
     */
    protected $jobAvisosScheduledForDeletion = null;

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
     * Initializes internal state of Base\JobAreaTecnica object.
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
     * Compares this with another <code>JobAreaTecnica</code> instance.  If
     * <code>obj</code> is an instance of <code>JobAreaTecnica</code>, delegates to
     * <code>equals(JobAreaTecnica)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobAreaTecnica The current object, for fluid interface
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
     * Get the [id_area_principal] column value.
     *
     * @return int
     */
    public function getIdAreaPrincipal()
    {
        return $this->id_area_principal;
    }

    /**
     * Get the [nivel] column value.
     *
     * @return int
     */
    public function getNivel()
    {
        return $this->nivel;
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
     * Get the [keywords] column value.
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
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
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_area_principal] column.
     *
     * @param int $v new value
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setIdAreaPrincipal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_area_principal !== $v) {
            $this->id_area_principal = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL] = true;
        }

        return $this;
    } // setIdAreaPrincipal()

    /**
     * Set the value of [nivel] column.
     *
     * @param int $v new value
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setNivel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nivel !== $v) {
            $this->nivel = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_NIVEL] = true;
        }

        return $this;
    } // setNivel()

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v new value
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [keywords] column.
     *
     * @param string $v new value
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setKeywords($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->keywords !== $v) {
            $this->keywords = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_KEYWORDS] = true;
        }

        return $this;
    } // setKeywords()

    /**
     * Set the value of [descripcion] column.
     *
     * @param string $v new value
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_DESCRIPCION] = true;
        }

        return $this;
    } // setDescripcion()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [last_user_id] column.
     *
     * @param int $v new value
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[JobAreaTecnicaTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobAreaTecnicaTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->modification_date->format("Y-m-d H:i:s")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobAreaTecnicaTableMap::COL_MODIFICATION_DATE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobAreaTecnicaTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobAreaTecnicaTableMap::translateFieldName('IdAreaPrincipal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_area_principal = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobAreaTecnicaTableMap::translateFieldName('Nivel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nivel = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobAreaTecnicaTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobAreaTecnicaTableMap::translateFieldName('Keywords', TableMap::TYPE_PHPNAME, $indexType)];
            $this->keywords = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobAreaTecnicaTableMap::translateFieldName('Descripcion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descripcion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobAreaTecnicaTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobAreaTecnicaTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobAreaTecnicaTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobAreaTecnicaTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = JobAreaTecnicaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobAreaTecnica'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobAreaTecnicaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJobAreaRelacionadasRelatedByIdArea1 = null;

            $this->collJobAreaRelacionadasRelatedByIdArea2 = null;

            $this->collJobAreaTecnicaProfesions = null;

            $this->collJobAvisos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobAreaTecnica::setDeleted()
     * @see JobAreaTecnica::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobAreaTecnicaQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobAreaTecnicaTableMap::DATABASE_NAME);
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
                JobAreaTecnicaTableMap::addInstanceToPool($this);
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

            if ($this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion !== null) {
                if (!$this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion->isEmpty()) {
                    \JobAreaRelacionadaQuery::create()
                        ->filterByPrimaryKeys($this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion = null;
                }
            }

            if ($this->collJobAreaRelacionadasRelatedByIdArea1 !== null) {
                foreach ($this->collJobAreaRelacionadasRelatedByIdArea1 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion !== null) {
                if (!$this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion->isEmpty()) {
                    \JobAreaRelacionadaQuery::create()
                        ->filterByPrimaryKeys($this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion = null;
                }
            }

            if ($this->collJobAreaRelacionadasRelatedByIdArea2 !== null) {
                foreach ($this->collJobAreaRelacionadasRelatedByIdArea2 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->jobAvisosScheduledForDeletion !== null) {
                if (!$this->jobAvisosScheduledForDeletion->isEmpty()) {
                    foreach ($this->jobAvisosScheduledForDeletion as $jobAviso) {
                        // need to save related object because we set the relation to null
                        $jobAviso->save($con);
                    }
                    $this->jobAvisosScheduledForDeletion = null;
                }
            }

            if ($this->collJobAvisos !== null) {
                foreach ($this->collJobAvisos as $referrerFK) {
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

        $this->modifiedColumns[JobAreaTecnicaTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobAreaTecnicaTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL)) {
            $modifiedColumns[':p' . $index++]  = 'ID_AREA_PRINCIPAL';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_NIVEL)) {
            $modifiedColumns[':p' . $index++]  = 'NIVEL';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_KEYWORDS)) {
            $modifiedColumns[':p' . $index++]  = 'KEYWORDS';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPCION';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_area_tecnica (%s) VALUES (%s)',
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
                    case 'ID_AREA_PRINCIPAL':
                        $stmt->bindValue($identifier, $this->id_area_principal, PDO::PARAM_INT);
                        break;
                    case 'NIVEL':
                        $stmt->bindValue($identifier, $this->nivel, PDO::PARAM_INT);
                        break;
                    case 'NOMBRE':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'KEYWORDS':
                        $stmt->bindValue($identifier, $this->keywords, PDO::PARAM_STR);
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
        $pos = JobAreaTecnicaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdAreaPrincipal();
                break;
            case 2:
                return $this->getNivel();
                break;
            case 3:
                return $this->getNombre();
                break;
            case 4:
                return $this->getKeywords();
                break;
            case 5:
                return $this->getDescripcion();
                break;
            case 6:
                return $this->getStatus();
                break;
            case 7:
                return $this->getLastUserId();
                break;
            case 8:
                return $this->getCreationDate();
                break;
            case 9:
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

        if (isset($alreadyDumpedObjects['JobAreaTecnica'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobAreaTecnica'][$this->hashCode()] = true;
        $keys = JobAreaTecnicaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdAreaPrincipal(),
            $keys[2] => $this->getNivel(),
            $keys[3] => $this->getNombre(),
            $keys[4] => $this->getKeywords(),
            $keys[5] => $this->getDescripcion(),
            $keys[6] => $this->getStatus(),
            $keys[7] => $this->getLastUserId(),
            $keys[8] => $this->getCreationDate(),
            $keys[9] => $this->getModificationDate(),
        );
        if ($result[$keys[8]] instanceof \DateTime) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[9]] instanceof \DateTime) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collJobAreaRelacionadasRelatedByIdArea1) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobAreaRelacionadas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_area_relacionadas';
                        break;
                    default:
                        $key = 'JobAreaRelacionadas';
                }

                $result[$key] = $this->collJobAreaRelacionadasRelatedByIdArea1->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJobAreaRelacionadasRelatedByIdArea2) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobAreaRelacionadas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_area_relacionadas';
                        break;
                    default:
                        $key = 'JobAreaRelacionadas';
                }

                $result[$key] = $this->collJobAreaRelacionadasRelatedByIdArea2->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collJobAvisos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobAvisos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_avisos';
                        break;
                    default:
                        $key = 'JobAvisos';
                }

                $result[$key] = $this->collJobAvisos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\JobAreaTecnica
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobAreaTecnicaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobAreaTecnica
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdAreaPrincipal($value);
                break;
            case 2:
                $this->setNivel($value);
                break;
            case 3:
                $this->setNombre($value);
                break;
            case 4:
                $this->setKeywords($value);
                break;
            case 5:
                $this->setDescripcion($value);
                break;
            case 6:
                $this->setStatus($value);
                break;
            case 7:
                $this->setLastUserId($value);
                break;
            case 8:
                $this->setCreationDate($value);
                break;
            case 9:
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
        $keys = JobAreaTecnicaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdAreaPrincipal($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNivel($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setNombre($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setKeywords($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDescripcion($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStatus($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLastUserId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreationDate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setModificationDate($arr[$keys[9]]);
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
     * @return $this|\JobAreaTecnica The current object, for fluid interface
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
        $criteria = new Criteria(JobAreaTecnicaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_ID)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_ID_AREA_PRINCIPAL, $this->id_area_principal);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_NIVEL)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_NIVEL, $this->nivel);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_NOMBRE)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_KEYWORDS)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_KEYWORDS, $this->keywords);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_DESCRIPCION)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_DESCRIPCION, $this->descripcion);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_STATUS)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_LAST_USER_ID)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobAreaTecnicaTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(JobAreaTecnicaTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildJobAreaTecnicaQuery::create();
        $criteria->add(JobAreaTecnicaTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobAreaTecnica (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdAreaPrincipal($this->getIdAreaPrincipal());
        $copyObj->setNivel($this->getNivel());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setKeywords($this->getKeywords());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getJobAreaRelacionadasRelatedByIdArea1() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobAreaRelacionadaRelatedByIdArea1($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJobAreaRelacionadasRelatedByIdArea2() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobAreaRelacionadaRelatedByIdArea2($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJobAreaTecnicaProfesions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobAreaTecnicaProfesion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJobAvisos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobAviso($relObj->copy($deepCopy));
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
     * @return \JobAreaTecnica Clone of current object.
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
        if ('JobAreaRelacionadaRelatedByIdArea1' == $relationName) {
            return $this->initJobAreaRelacionadasRelatedByIdArea1();
        }
        if ('JobAreaRelacionadaRelatedByIdArea2' == $relationName) {
            return $this->initJobAreaRelacionadasRelatedByIdArea2();
        }
        if ('JobAreaTecnicaProfesion' == $relationName) {
            return $this->initJobAreaTecnicaProfesions();
        }
        if ('JobAviso' == $relationName) {
            return $this->initJobAvisos();
        }
    }

    /**
     * Clears out the collJobAreaRelacionadasRelatedByIdArea1 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobAreaRelacionadasRelatedByIdArea1()
     */
    public function clearJobAreaRelacionadasRelatedByIdArea1()
    {
        $this->collJobAreaRelacionadasRelatedByIdArea1 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobAreaRelacionadasRelatedByIdArea1 collection loaded partially.
     */
    public function resetPartialJobAreaRelacionadasRelatedByIdArea1($v = true)
    {
        $this->collJobAreaRelacionadasRelatedByIdArea1Partial = $v;
    }

    /**
     * Initializes the collJobAreaRelacionadasRelatedByIdArea1 collection.
     *
     * By default this just sets the collJobAreaRelacionadasRelatedByIdArea1 collection to an empty array (like clearcollJobAreaRelacionadasRelatedByIdArea1());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobAreaRelacionadasRelatedByIdArea1($overrideExisting = true)
    {
        if (null !== $this->collJobAreaRelacionadasRelatedByIdArea1 && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobAreaRelacionadaTableMap::getTableMap()->getCollectionClassName();

        $this->collJobAreaRelacionadasRelatedByIdArea1 = new $collectionClassName;
        $this->collJobAreaRelacionadasRelatedByIdArea1->setModel('\JobAreaRelacionada');
    }

    /**
     * Gets an array of ChildJobAreaRelacionada objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobAreaTecnica is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobAreaRelacionada[] List of ChildJobAreaRelacionada objects
     * @throws PropelException
     */
    public function getJobAreaRelacionadasRelatedByIdArea1(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAreaRelacionadasRelatedByIdArea1Partial && !$this->isNew();
        if (null === $this->collJobAreaRelacionadasRelatedByIdArea1 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobAreaRelacionadasRelatedByIdArea1) {
                // return empty collection
                $this->initJobAreaRelacionadasRelatedByIdArea1();
            } else {
                $collJobAreaRelacionadasRelatedByIdArea1 = ChildJobAreaRelacionadaQuery::create(null, $criteria)
                    ->filterByJobAreaTecnicaRelatedByIdArea1($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobAreaRelacionadasRelatedByIdArea1Partial && count($collJobAreaRelacionadasRelatedByIdArea1)) {
                        $this->initJobAreaRelacionadasRelatedByIdArea1(false);

                        foreach ($collJobAreaRelacionadasRelatedByIdArea1 as $obj) {
                            if (false == $this->collJobAreaRelacionadasRelatedByIdArea1->contains($obj)) {
                                $this->collJobAreaRelacionadasRelatedByIdArea1->append($obj);
                            }
                        }

                        $this->collJobAreaRelacionadasRelatedByIdArea1Partial = true;
                    }

                    return $collJobAreaRelacionadasRelatedByIdArea1;
                }

                if ($partial && $this->collJobAreaRelacionadasRelatedByIdArea1) {
                    foreach ($this->collJobAreaRelacionadasRelatedByIdArea1 as $obj) {
                        if ($obj->isNew()) {
                            $collJobAreaRelacionadasRelatedByIdArea1[] = $obj;
                        }
                    }
                }

                $this->collJobAreaRelacionadasRelatedByIdArea1 = $collJobAreaRelacionadasRelatedByIdArea1;
                $this->collJobAreaRelacionadasRelatedByIdArea1Partial = false;
            }
        }

        return $this->collJobAreaRelacionadasRelatedByIdArea1;
    }

    /**
     * Sets a collection of ChildJobAreaRelacionada objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobAreaRelacionadasRelatedByIdArea1 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
     */
    public function setJobAreaRelacionadasRelatedByIdArea1(Collection $jobAreaRelacionadasRelatedByIdArea1, ConnectionInterface $con = null)
    {
        /** @var ChildJobAreaRelacionada[] $jobAreaRelacionadasRelatedByIdArea1ToDelete */
        $jobAreaRelacionadasRelatedByIdArea1ToDelete = $this->getJobAreaRelacionadasRelatedByIdArea1(new Criteria(), $con)->diff($jobAreaRelacionadasRelatedByIdArea1);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion = clone $jobAreaRelacionadasRelatedByIdArea1ToDelete;

        foreach ($jobAreaRelacionadasRelatedByIdArea1ToDelete as $jobAreaRelacionadaRelatedByIdArea1Removed) {
            $jobAreaRelacionadaRelatedByIdArea1Removed->setJobAreaTecnicaRelatedByIdArea1(null);
        }

        $this->collJobAreaRelacionadasRelatedByIdArea1 = null;
        foreach ($jobAreaRelacionadasRelatedByIdArea1 as $jobAreaRelacionadaRelatedByIdArea1) {
            $this->addJobAreaRelacionadaRelatedByIdArea1($jobAreaRelacionadaRelatedByIdArea1);
        }

        $this->collJobAreaRelacionadasRelatedByIdArea1 = $jobAreaRelacionadasRelatedByIdArea1;
        $this->collJobAreaRelacionadasRelatedByIdArea1Partial = false;

        return $this;
    }

    /**
     * Returns the number of related JobAreaRelacionada objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobAreaRelacionada objects.
     * @throws PropelException
     */
    public function countJobAreaRelacionadasRelatedByIdArea1(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAreaRelacionadasRelatedByIdArea1Partial && !$this->isNew();
        if (null === $this->collJobAreaRelacionadasRelatedByIdArea1 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobAreaRelacionadasRelatedByIdArea1) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobAreaRelacionadasRelatedByIdArea1());
            }

            $query = ChildJobAreaRelacionadaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobAreaTecnicaRelatedByIdArea1($this)
                ->count($con);
        }

        return count($this->collJobAreaRelacionadasRelatedByIdArea1);
    }

    /**
     * Method called to associate a ChildJobAreaRelacionada object to this object
     * through the ChildJobAreaRelacionada foreign key attribute.
     *
     * @param  ChildJobAreaRelacionada $l ChildJobAreaRelacionada
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function addJobAreaRelacionadaRelatedByIdArea1(ChildJobAreaRelacionada $l)
    {
        if ($this->collJobAreaRelacionadasRelatedByIdArea1 === null) {
            $this->initJobAreaRelacionadasRelatedByIdArea1();
            $this->collJobAreaRelacionadasRelatedByIdArea1Partial = true;
        }

        if (!$this->collJobAreaRelacionadasRelatedByIdArea1->contains($l)) {
            $this->doAddJobAreaRelacionadaRelatedByIdArea1($l);

            if ($this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion and $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion->contains($l)) {
                $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion->remove($this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea1 The ChildJobAreaRelacionada object to add.
     */
    protected function doAddJobAreaRelacionadaRelatedByIdArea1(ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea1)
    {
        $this->collJobAreaRelacionadasRelatedByIdArea1[]= $jobAreaRelacionadaRelatedByIdArea1;
        $jobAreaRelacionadaRelatedByIdArea1->setJobAreaTecnicaRelatedByIdArea1($this);
    }

    /**
     * @param  ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea1 The ChildJobAreaRelacionada object to remove.
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
     */
    public function removeJobAreaRelacionadaRelatedByIdArea1(ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea1)
    {
        if ($this->getJobAreaRelacionadasRelatedByIdArea1()->contains($jobAreaRelacionadaRelatedByIdArea1)) {
            $pos = $this->collJobAreaRelacionadasRelatedByIdArea1->search($jobAreaRelacionadaRelatedByIdArea1);
            $this->collJobAreaRelacionadasRelatedByIdArea1->remove($pos);
            if (null === $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion) {
                $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion = clone $this->collJobAreaRelacionadasRelatedByIdArea1;
                $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion->clear();
            }
            $this->jobAreaRelacionadasRelatedByIdArea1ScheduledForDeletion[]= clone $jobAreaRelacionadaRelatedByIdArea1;
            $jobAreaRelacionadaRelatedByIdArea1->setJobAreaTecnicaRelatedByIdArea1(null);
        }

        return $this;
    }

    /**
     * Clears out the collJobAreaRelacionadasRelatedByIdArea2 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobAreaRelacionadasRelatedByIdArea2()
     */
    public function clearJobAreaRelacionadasRelatedByIdArea2()
    {
        $this->collJobAreaRelacionadasRelatedByIdArea2 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobAreaRelacionadasRelatedByIdArea2 collection loaded partially.
     */
    public function resetPartialJobAreaRelacionadasRelatedByIdArea2($v = true)
    {
        $this->collJobAreaRelacionadasRelatedByIdArea2Partial = $v;
    }

    /**
     * Initializes the collJobAreaRelacionadasRelatedByIdArea2 collection.
     *
     * By default this just sets the collJobAreaRelacionadasRelatedByIdArea2 collection to an empty array (like clearcollJobAreaRelacionadasRelatedByIdArea2());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobAreaRelacionadasRelatedByIdArea2($overrideExisting = true)
    {
        if (null !== $this->collJobAreaRelacionadasRelatedByIdArea2 && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobAreaRelacionadaTableMap::getTableMap()->getCollectionClassName();

        $this->collJobAreaRelacionadasRelatedByIdArea2 = new $collectionClassName;
        $this->collJobAreaRelacionadasRelatedByIdArea2->setModel('\JobAreaRelacionada');
    }

    /**
     * Gets an array of ChildJobAreaRelacionada objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobAreaTecnica is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobAreaRelacionada[] List of ChildJobAreaRelacionada objects
     * @throws PropelException
     */
    public function getJobAreaRelacionadasRelatedByIdArea2(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAreaRelacionadasRelatedByIdArea2Partial && !$this->isNew();
        if (null === $this->collJobAreaRelacionadasRelatedByIdArea2 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobAreaRelacionadasRelatedByIdArea2) {
                // return empty collection
                $this->initJobAreaRelacionadasRelatedByIdArea2();
            } else {
                $collJobAreaRelacionadasRelatedByIdArea2 = ChildJobAreaRelacionadaQuery::create(null, $criteria)
                    ->filterByJobAreaTecnicaRelatedByIdArea2($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobAreaRelacionadasRelatedByIdArea2Partial && count($collJobAreaRelacionadasRelatedByIdArea2)) {
                        $this->initJobAreaRelacionadasRelatedByIdArea2(false);

                        foreach ($collJobAreaRelacionadasRelatedByIdArea2 as $obj) {
                            if (false == $this->collJobAreaRelacionadasRelatedByIdArea2->contains($obj)) {
                                $this->collJobAreaRelacionadasRelatedByIdArea2->append($obj);
                            }
                        }

                        $this->collJobAreaRelacionadasRelatedByIdArea2Partial = true;
                    }

                    return $collJobAreaRelacionadasRelatedByIdArea2;
                }

                if ($partial && $this->collJobAreaRelacionadasRelatedByIdArea2) {
                    foreach ($this->collJobAreaRelacionadasRelatedByIdArea2 as $obj) {
                        if ($obj->isNew()) {
                            $collJobAreaRelacionadasRelatedByIdArea2[] = $obj;
                        }
                    }
                }

                $this->collJobAreaRelacionadasRelatedByIdArea2 = $collJobAreaRelacionadasRelatedByIdArea2;
                $this->collJobAreaRelacionadasRelatedByIdArea2Partial = false;
            }
        }

        return $this->collJobAreaRelacionadasRelatedByIdArea2;
    }

    /**
     * Sets a collection of ChildJobAreaRelacionada objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobAreaRelacionadasRelatedByIdArea2 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
     */
    public function setJobAreaRelacionadasRelatedByIdArea2(Collection $jobAreaRelacionadasRelatedByIdArea2, ConnectionInterface $con = null)
    {
        /** @var ChildJobAreaRelacionada[] $jobAreaRelacionadasRelatedByIdArea2ToDelete */
        $jobAreaRelacionadasRelatedByIdArea2ToDelete = $this->getJobAreaRelacionadasRelatedByIdArea2(new Criteria(), $con)->diff($jobAreaRelacionadasRelatedByIdArea2);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion = clone $jobAreaRelacionadasRelatedByIdArea2ToDelete;

        foreach ($jobAreaRelacionadasRelatedByIdArea2ToDelete as $jobAreaRelacionadaRelatedByIdArea2Removed) {
            $jobAreaRelacionadaRelatedByIdArea2Removed->setJobAreaTecnicaRelatedByIdArea2(null);
        }

        $this->collJobAreaRelacionadasRelatedByIdArea2 = null;
        foreach ($jobAreaRelacionadasRelatedByIdArea2 as $jobAreaRelacionadaRelatedByIdArea2) {
            $this->addJobAreaRelacionadaRelatedByIdArea2($jobAreaRelacionadaRelatedByIdArea2);
        }

        $this->collJobAreaRelacionadasRelatedByIdArea2 = $jobAreaRelacionadasRelatedByIdArea2;
        $this->collJobAreaRelacionadasRelatedByIdArea2Partial = false;

        return $this;
    }

    /**
     * Returns the number of related JobAreaRelacionada objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobAreaRelacionada objects.
     * @throws PropelException
     */
    public function countJobAreaRelacionadasRelatedByIdArea2(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAreaRelacionadasRelatedByIdArea2Partial && !$this->isNew();
        if (null === $this->collJobAreaRelacionadasRelatedByIdArea2 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobAreaRelacionadasRelatedByIdArea2) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobAreaRelacionadasRelatedByIdArea2());
            }

            $query = ChildJobAreaRelacionadaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobAreaTecnicaRelatedByIdArea2($this)
                ->count($con);
        }

        return count($this->collJobAreaRelacionadasRelatedByIdArea2);
    }

    /**
     * Method called to associate a ChildJobAreaRelacionada object to this object
     * through the ChildJobAreaRelacionada foreign key attribute.
     *
     * @param  ChildJobAreaRelacionada $l ChildJobAreaRelacionada
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function addJobAreaRelacionadaRelatedByIdArea2(ChildJobAreaRelacionada $l)
    {
        if ($this->collJobAreaRelacionadasRelatedByIdArea2 === null) {
            $this->initJobAreaRelacionadasRelatedByIdArea2();
            $this->collJobAreaRelacionadasRelatedByIdArea2Partial = true;
        }

        if (!$this->collJobAreaRelacionadasRelatedByIdArea2->contains($l)) {
            $this->doAddJobAreaRelacionadaRelatedByIdArea2($l);

            if ($this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion and $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion->contains($l)) {
                $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion->remove($this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea2 The ChildJobAreaRelacionada object to add.
     */
    protected function doAddJobAreaRelacionadaRelatedByIdArea2(ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea2)
    {
        $this->collJobAreaRelacionadasRelatedByIdArea2[]= $jobAreaRelacionadaRelatedByIdArea2;
        $jobAreaRelacionadaRelatedByIdArea2->setJobAreaTecnicaRelatedByIdArea2($this);
    }

    /**
     * @param  ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea2 The ChildJobAreaRelacionada object to remove.
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
     */
    public function removeJobAreaRelacionadaRelatedByIdArea2(ChildJobAreaRelacionada $jobAreaRelacionadaRelatedByIdArea2)
    {
        if ($this->getJobAreaRelacionadasRelatedByIdArea2()->contains($jobAreaRelacionadaRelatedByIdArea2)) {
            $pos = $this->collJobAreaRelacionadasRelatedByIdArea2->search($jobAreaRelacionadaRelatedByIdArea2);
            $this->collJobAreaRelacionadasRelatedByIdArea2->remove($pos);
            if (null === $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion) {
                $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion = clone $this->collJobAreaRelacionadasRelatedByIdArea2;
                $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion->clear();
            }
            $this->jobAreaRelacionadasRelatedByIdArea2ScheduledForDeletion[]= clone $jobAreaRelacionadaRelatedByIdArea2;
            $jobAreaRelacionadaRelatedByIdArea2->setJobAreaTecnicaRelatedByIdArea2(null);
        }

        return $this;
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
     * If this ChildJobAreaTecnica is new, it will return
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
                    ->filterByJobAreaTecnica($this)
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
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
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
            $jobAreaTecnicaProfesionRemoved->setJobAreaTecnica(null);
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
                ->filterByJobAreaTecnica($this)
                ->count($con);
        }

        return count($this->collJobAreaTecnicaProfesions);
    }

    /**
     * Method called to associate a ChildJobAreaTecnicaProfesion object to this object
     * through the ChildJobAreaTecnicaProfesion foreign key attribute.
     *
     * @param  ChildJobAreaTecnicaProfesion $l ChildJobAreaTecnicaProfesion
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
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
        $jobAreaTecnicaProfesion->setJobAreaTecnica($this);
    }

    /**
     * @param  ChildJobAreaTecnicaProfesion $jobAreaTecnicaProfesion The ChildJobAreaTecnicaProfesion object to remove.
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
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
            $jobAreaTecnicaProfesion->setJobAreaTecnica(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobAreaTecnica is new, it will return
     * an empty collection; or if this JobAreaTecnica has previously
     * been saved, it will retrieve related JobAreaTecnicaProfesions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobAreaTecnica.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobAreaTecnicaProfesion[] List of ChildJobAreaTecnicaProfesion objects
     */
    public function getJobAreaTecnicaProfesionsJoinJobProfesion(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobAreaTecnicaProfesionQuery::create(null, $criteria);
        $query->joinWith('JobProfesion', $joinBehavior);

        return $this->getJobAreaTecnicaProfesions($query, $con);
    }

    /**
     * Clears out the collJobAvisos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobAvisos()
     */
    public function clearJobAvisos()
    {
        $this->collJobAvisos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobAvisos collection loaded partially.
     */
    public function resetPartialJobAvisos($v = true)
    {
        $this->collJobAvisosPartial = $v;
    }

    /**
     * Initializes the collJobAvisos collection.
     *
     * By default this just sets the collJobAvisos collection to an empty array (like clearcollJobAvisos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobAvisos($overrideExisting = true)
    {
        if (null !== $this->collJobAvisos && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobAvisoTableMap::getTableMap()->getCollectionClassName();

        $this->collJobAvisos = new $collectionClassName;
        $this->collJobAvisos->setModel('\JobAviso');
    }

    /**
     * Gets an array of ChildJobAviso objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildJobAreaTecnica is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobAviso[] List of ChildJobAviso objects
     * @throws PropelException
     */
    public function getJobAvisos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAvisosPartial && !$this->isNew();
        if (null === $this->collJobAvisos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobAvisos) {
                // return empty collection
                $this->initJobAvisos();
            } else {
                $collJobAvisos = ChildJobAvisoQuery::create(null, $criteria)
                    ->filterByJobAreaTecnica($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobAvisosPartial && count($collJobAvisos)) {
                        $this->initJobAvisos(false);

                        foreach ($collJobAvisos as $obj) {
                            if (false == $this->collJobAvisos->contains($obj)) {
                                $this->collJobAvisos->append($obj);
                            }
                        }

                        $this->collJobAvisosPartial = true;
                    }

                    return $collJobAvisos;
                }

                if ($partial && $this->collJobAvisos) {
                    foreach ($this->collJobAvisos as $obj) {
                        if ($obj->isNew()) {
                            $collJobAvisos[] = $obj;
                        }
                    }
                }

                $this->collJobAvisos = $collJobAvisos;
                $this->collJobAvisosPartial = false;
            }
        }

        return $this->collJobAvisos;
    }

    /**
     * Sets a collection of ChildJobAviso objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobAvisos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
     */
    public function setJobAvisos(Collection $jobAvisos, ConnectionInterface $con = null)
    {
        /** @var ChildJobAviso[] $jobAvisosToDelete */
        $jobAvisosToDelete = $this->getJobAvisos(new Criteria(), $con)->diff($jobAvisos);


        $this->jobAvisosScheduledForDeletion = $jobAvisosToDelete;

        foreach ($jobAvisosToDelete as $jobAvisoRemoved) {
            $jobAvisoRemoved->setJobAreaTecnica(null);
        }

        $this->collJobAvisos = null;
        foreach ($jobAvisos as $jobAviso) {
            $this->addJobAviso($jobAviso);
        }

        $this->collJobAvisos = $jobAvisos;
        $this->collJobAvisosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobAviso objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobAviso objects.
     * @throws PropelException
     */
    public function countJobAvisos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobAvisosPartial && !$this->isNew();
        if (null === $this->collJobAvisos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobAvisos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobAvisos());
            }

            $query = ChildJobAvisoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByJobAreaTecnica($this)
                ->count($con);
        }

        return count($this->collJobAvisos);
    }

    /**
     * Method called to associate a ChildJobAviso object to this object
     * through the ChildJobAviso foreign key attribute.
     *
     * @param  ChildJobAviso $l ChildJobAviso
     * @return $this|\JobAreaTecnica The current object (for fluent API support)
     */
    public function addJobAviso(ChildJobAviso $l)
    {
        if ($this->collJobAvisos === null) {
            $this->initJobAvisos();
            $this->collJobAvisosPartial = true;
        }

        if (!$this->collJobAvisos->contains($l)) {
            $this->doAddJobAviso($l);

            if ($this->jobAvisosScheduledForDeletion and $this->jobAvisosScheduledForDeletion->contains($l)) {
                $this->jobAvisosScheduledForDeletion->remove($this->jobAvisosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobAviso $jobAviso The ChildJobAviso object to add.
     */
    protected function doAddJobAviso(ChildJobAviso $jobAviso)
    {
        $this->collJobAvisos[]= $jobAviso;
        $jobAviso->setJobAreaTecnica($this);
    }

    /**
     * @param  ChildJobAviso $jobAviso The ChildJobAviso object to remove.
     * @return $this|ChildJobAreaTecnica The current object (for fluent API support)
     */
    public function removeJobAviso(ChildJobAviso $jobAviso)
    {
        if ($this->getJobAvisos()->contains($jobAviso)) {
            $pos = $this->collJobAvisos->search($jobAviso);
            $this->collJobAvisos->remove($pos);
            if (null === $this->jobAvisosScheduledForDeletion) {
                $this->jobAvisosScheduledForDeletion = clone $this->collJobAvisos;
                $this->jobAvisosScheduledForDeletion->clear();
            }
            $this->jobAvisosScheduledForDeletion[]= $jobAviso;
            $jobAviso->setJobAreaTecnica(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this JobAreaTecnica is new, it will return
     * an empty collection; or if this JobAreaTecnica has previously
     * been saved, it will retrieve related JobAvisos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in JobAreaTecnica.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobAviso[] List of ChildJobAviso objects
     */
    public function getJobAvisosJoinJobArea(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobAvisoQuery::create(null, $criteria);
        $query->joinWith('JobArea', $joinBehavior);

        return $this->getJobAvisos($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->id_area_principal = null;
        $this->nivel = null;
        $this->nombre = null;
        $this->keywords = null;
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
            if ($this->collJobAreaRelacionadasRelatedByIdArea1) {
                foreach ($this->collJobAreaRelacionadasRelatedByIdArea1 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJobAreaRelacionadasRelatedByIdArea2) {
                foreach ($this->collJobAreaRelacionadasRelatedByIdArea2 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJobAreaTecnicaProfesions) {
                foreach ($this->collJobAreaTecnicaProfesions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJobAvisos) {
                foreach ($this->collJobAvisos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collJobAreaRelacionadasRelatedByIdArea1 = null;
        $this->collJobAreaRelacionadasRelatedByIdArea2 = null;
        $this->collJobAreaTecnicaProfesions = null;
        $this->collJobAvisos = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JobAreaTecnicaTableMap::DEFAULT_STRING_FORMAT);
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
