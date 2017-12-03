<?php

namespace Base;

use \JobEmpresaSuscrita as ChildJobEmpresaSuscrita;
use \JobEmpresaSuscritaQuery as ChildJobEmpresaSuscritaQuery;
use \SysEntity as ChildSysEntity;
use \SysEntityBranch as ChildSysEntityBranch;
use \SysEntityBranchQuery as ChildSysEntityBranchQuery;
use \SysEntityQuery as ChildSysEntityQuery;
use \SysLocation as ChildSysLocation;
use \SysLocationQuery as ChildSysLocationQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\SysLocationTableMap;
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
 * Base class that represents a row from the 'sys_location' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class SysLocation implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SysLocationTableMap';


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
     * The value for the main_id field.
     * @var        int
     */
    protected $main_id;

    /**
     * The value for the code field.
     * @var        string
     */
    protected $code;

    /**
     * The value for the status field.
     * @var        string
     */
    protected $status;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the type field.
     * @var        string
     */
    protected $type;

    /**
     * The value for the level field.
     * @var        int
     */
    protected $level;

    /**
     * The value for the lft field.
     * @var        int
     */
    protected $lft;

    /**
     * The value for the rgt field.
     * @var        int
     */
    protected $rgt;

    /**
     * The value for the last_user_id field.
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
     * @var        ObjectCollection|ChildJobEmpresaSuscrita[] Collection to store aggregation of ChildJobEmpresaSuscrita objects.
     */
    protected $collJobEmpresaSuscritas;
    protected $collJobEmpresaSuscritasPartial;

    /**
     * @var        ObjectCollection|ChildSysEntity[] Collection to store aggregation of ChildSysEntity objects.
     */
    protected $collSysEntities;
    protected $collSysEntitiesPartial;

    /**
     * @var        ObjectCollection|ChildSysEntityBranch[] Collection to store aggregation of ChildSysEntityBranch objects.
     */
    protected $collSysEntityBranches;
    protected $collSysEntityBranchesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobEmpresaSuscrita[]
     */
    protected $jobEmpresaSuscritasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEntity[]
     */
    protected $sysEntitiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEntityBranch[]
     */
    protected $sysEntityBranchesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->modification_date = PropelDateTime::newInstance(NULL, null, 'DateTime');
    }

    /**
     * Initializes internal state of Base\SysLocation object.
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
     * Compares this with another <code>SysLocation</code> instance.  If
     * <code>obj</code> is an instance of <code>SysLocation</code>, delegates to
     * <code>equals(SysLocation)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SysLocation The current object, for fluid interface
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
     * Get the [main_id] column value.
     * 
     * @return int
     */
    public function getMainId()
    {
        return $this->main_id;
    }

    /**
     * Get the [code] column value.
     * 
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
     * Get the [name] column value.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [type] column value.
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [level] column value.
     * 
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Get the [lft] column value.
     * 
     * @return int
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Get the [rgt] column value.
     * 
     * @return int
     */
    public function getRgt()
    {
        return $this->rgt;
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
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [main_id] column.
     * 
     * @param int $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setMainId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->main_id !== $v) {
            $this->main_id = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_MAIN_ID] = true;
        }

        return $this;
    } // setMainId()

    /**
     * Set the value of [code] column.
     * 
     * @param string $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_CODE] = true;
        }

        return $this;
    } // setCode()

    /**
     * Set the value of [status] column.
     * 
     * @param string $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [name] column.
     * 
     * @param string $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [type] column.
     * 
     * @param string $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [level] column.
     * 
     * @param int $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setLevel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->level !== $v) {
            $this->level = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_LEVEL] = true;
        }

        return $this;
    } // setLevel()

    /**
     * Set the value of [lft] column.
     * 
     * @param int $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setLft($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->lft !== $v) {
            $this->lft = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_LFT] = true;
        }

        return $this;
    } // setLft()

    /**
     * Set the value of [rgt] column.
     * 
     * @param int $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setRgt($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rgt !== $v) {
            $this->rgt = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_RGT] = true;
        }

        return $this;
    } // setRgt()

    /**
     * Set the value of [last_user_id] column.
     * 
     * @param int $v new value
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[SysLocationTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysLocationTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ( ($dt != $this->modification_date) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysLocationTableMap::COL_MODIFICATION_DATE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysLocationTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysLocationTableMap::translateFieldName('MainId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->main_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysLocationTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysLocationTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysLocationTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysLocationTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysLocationTableMap::translateFieldName('Level', TableMap::TYPE_PHPNAME, $indexType)];
            $this->level = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysLocationTableMap::translateFieldName('Lft', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lft = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysLocationTableMap::translateFieldName('Rgt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rgt = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysLocationTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysLocationTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SysLocationTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = SysLocationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysLocation'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SysLocationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysLocationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJobEmpresaSuscritas = null;

            $this->collSysEntities = null;

            $this->collSysEntityBranches = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SysLocation::setDeleted()
     * @see SysLocation::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysLocationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysLocationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysLocationTableMap::DATABASE_NAME);
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
                SysLocationTableMap::addInstanceToPool($this);
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

            if ($this->jobEmpresaSuscritasScheduledForDeletion !== null) {
                if (!$this->jobEmpresaSuscritasScheduledForDeletion->isEmpty()) {
                    foreach ($this->jobEmpresaSuscritasScheduledForDeletion as $jobEmpresaSuscrita) {
                        // need to save related object because we set the relation to null
                        $jobEmpresaSuscrita->save($con);
                    }
                    $this->jobEmpresaSuscritasScheduledForDeletion = null;
                }
            }

            if ($this->collJobEmpresaSuscritas !== null) {
                foreach ($this->collJobEmpresaSuscritas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysEntitiesScheduledForDeletion !== null) {
                if (!$this->sysEntitiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->sysEntitiesScheduledForDeletion as $sysEntity) {
                        // need to save related object because we set the relation to null
                        $sysEntity->save($con);
                    }
                    $this->sysEntitiesScheduledForDeletion = null;
                }
            }

            if ($this->collSysEntities !== null) {
                foreach ($this->collSysEntities as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysEntityBranchesScheduledForDeletion !== null) {
                if (!$this->sysEntityBranchesScheduledForDeletion->isEmpty()) {
                    \SysEntityBranchQuery::create()
                        ->filterByPrimaryKeys($this->sysEntityBranchesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysEntityBranchesScheduledForDeletion = null;
                }
            }

            if ($this->collSysEntityBranches !== null) {
                foreach ($this->collSysEntityBranches as $referrerFK) {
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

        $this->modifiedColumns[SysLocationTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysLocationTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysLocationTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_MAIN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'MAIN_ID';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'CODE';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'NAME';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'TYPE';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'LEVEL';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_LFT)) {
            $modifiedColumns[':p' . $index++]  = 'LFT';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_RGT)) {
            $modifiedColumns[':p' . $index++]  = 'RGT';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO sys_location (%s) VALUES (%s)',
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
                    case 'MAIN_ID':                        
                        $stmt->bindValue($identifier, $this->main_id, PDO::PARAM_INT);
                        break;
                    case 'CODE':                        
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
                        break;
                    case 'STATUS':                        
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'NAME':                        
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'TYPE':                        
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'LEVEL':                        
                        $stmt->bindValue($identifier, $this->level, PDO::PARAM_INT);
                        break;
                    case 'LFT':                        
                        $stmt->bindValue($identifier, $this->lft, PDO::PARAM_INT);
                        break;
                    case 'RGT':                        
                        $stmt->bindValue($identifier, $this->rgt, PDO::PARAM_INT);
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
        $pos = SysLocationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMainId();
                break;
            case 2:
                return $this->getCode();
                break;
            case 3:
                return $this->getStatus();
                break;
            case 4:
                return $this->getName();
                break;
            case 5:
                return $this->getType();
                break;
            case 6:
                return $this->getLevel();
                break;
            case 7:
                return $this->getLft();
                break;
            case 8:
                return $this->getRgt();
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

        if (isset($alreadyDumpedObjects['SysLocation'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SysLocation'][$this->hashCode()] = true;
        $keys = SysLocationTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getMainId(),
            $keys[2] => $this->getCode(),
            $keys[3] => $this->getStatus(),
            $keys[4] => $this->getName(),
            $keys[5] => $this->getType(),
            $keys[6] => $this->getLevel(),
            $keys[7] => $this->getLft(),
            $keys[8] => $this->getRgt(),
            $keys[9] => $this->getLastUserId(),
            $keys[10] => $this->getCreationDate(),
            $keys[11] => $this->getModificationDate(),
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
            if (null !== $this->collJobEmpresaSuscritas) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobEmpresaSuscritas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_empresa_suscritas';
                        break;
                    default:
                        $key = 'JobEmpresaSuscritas';
                }
        
                $result[$key] = $this->collJobEmpresaSuscritas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysEntities) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysEntities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_entities';
                        break;
                    default:
                        $key = 'SysEntities';
                }
        
                $result[$key] = $this->collSysEntities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysEntityBranches) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysEntityBranches';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_entity_branches';
                        break;
                    default:
                        $key = 'SysEntityBranches';
                }
        
                $result[$key] = $this->collSysEntityBranches->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\SysLocation
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysLocationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SysLocation
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setMainId($value);
                break;
            case 2:
                $this->setCode($value);
                break;
            case 3:
                $this->setStatus($value);
                break;
            case 4:
                $this->setName($value);
                break;
            case 5:
                $this->setType($value);
                break;
            case 6:
                $this->setLevel($value);
                break;
            case 7:
                $this->setLft($value);
                break;
            case 8:
                $this->setRgt($value);
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
        $keys = SysLocationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setMainId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCode($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStatus($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setType($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLevel($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLft($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setRgt($arr[$keys[8]]);
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
     * @return $this|\SysLocation The current object, for fluid interface
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
        $criteria = new Criteria(SysLocationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysLocationTableMap::COL_ID)) {
            $criteria->add(SysLocationTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_MAIN_ID)) {
            $criteria->add(SysLocationTableMap::COL_MAIN_ID, $this->main_id);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_CODE)) {
            $criteria->add(SysLocationTableMap::COL_CODE, $this->code);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_STATUS)) {
            $criteria->add(SysLocationTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_NAME)) {
            $criteria->add(SysLocationTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_TYPE)) {
            $criteria->add(SysLocationTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_LEVEL)) {
            $criteria->add(SysLocationTableMap::COL_LEVEL, $this->level);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_LFT)) {
            $criteria->add(SysLocationTableMap::COL_LFT, $this->lft);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_RGT)) {
            $criteria->add(SysLocationTableMap::COL_RGT, $this->rgt);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_LAST_USER_ID)) {
            $criteria->add(SysLocationTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_CREATION_DATE)) {
            $criteria->add(SysLocationTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(SysLocationTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(SysLocationTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildSysLocationQuery::create();
        $criteria->add(SysLocationTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \SysLocation (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setMainId($this->getMainId());
        $copyObj->setCode($this->getCode());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setName($this->getName());
        $copyObj->setType($this->getType());
        $copyObj->setLevel($this->getLevel());
        $copyObj->setLft($this->getLft());
        $copyObj->setRgt($this->getRgt());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getJobEmpresaSuscritas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobEmpresaSuscrita($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysEntities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEntity($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysEntityBranches() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEntityBranch($relObj->copy($deepCopy));
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
     * @return \SysLocation Clone of current object.
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
        if ('JobEmpresaSuscrita' == $relationName) {
            return $this->initJobEmpresaSuscritas();
        }
        if ('SysEntity' == $relationName) {
            return $this->initSysEntities();
        }
        if ('SysEntityBranch' == $relationName) {
            return $this->initSysEntityBranches();
        }
    }

    /**
     * Clears out the collJobEmpresaSuscritas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobEmpresaSuscritas()
     */
    public function clearJobEmpresaSuscritas()
    {
        $this->collJobEmpresaSuscritas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobEmpresaSuscritas collection loaded partially.
     */
    public function resetPartialJobEmpresaSuscritas($v = true)
    {
        $this->collJobEmpresaSuscritasPartial = $v;
    }

    /**
     * Initializes the collJobEmpresaSuscritas collection.
     *
     * By default this just sets the collJobEmpresaSuscritas collection to an empty array (like clearcollJobEmpresaSuscritas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobEmpresaSuscritas($overrideExisting = true)
    {
        if (null !== $this->collJobEmpresaSuscritas && !$overrideExisting) {
            return;
        }
        $this->collJobEmpresaSuscritas = new ObjectCollection();
        $this->collJobEmpresaSuscritas->setModel('\JobEmpresaSuscrita');
    }

    /**
     * Gets an array of ChildJobEmpresaSuscrita objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysLocation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobEmpresaSuscrita[] List of ChildJobEmpresaSuscrita objects
     * @throws PropelException
     */
    public function getJobEmpresaSuscritas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobEmpresaSuscritasPartial && !$this->isNew();
        if (null === $this->collJobEmpresaSuscritas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobEmpresaSuscritas) {
                // return empty collection
                $this->initJobEmpresaSuscritas();
            } else {
                $collJobEmpresaSuscritas = ChildJobEmpresaSuscritaQuery::create(null, $criteria)
                    ->filterBySysLocation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobEmpresaSuscritasPartial && count($collJobEmpresaSuscritas)) {
                        $this->initJobEmpresaSuscritas(false);

                        foreach ($collJobEmpresaSuscritas as $obj) {
                            if (false == $this->collJobEmpresaSuscritas->contains($obj)) {
                                $this->collJobEmpresaSuscritas->append($obj);
                            }
                        }

                        $this->collJobEmpresaSuscritasPartial = true;
                    }

                    return $collJobEmpresaSuscritas;
                }

                if ($partial && $this->collJobEmpresaSuscritas) {
                    foreach ($this->collJobEmpresaSuscritas as $obj) {
                        if ($obj->isNew()) {
                            $collJobEmpresaSuscritas[] = $obj;
                        }
                    }
                }

                $this->collJobEmpresaSuscritas = $collJobEmpresaSuscritas;
                $this->collJobEmpresaSuscritasPartial = false;
            }
        }

        return $this->collJobEmpresaSuscritas;
    }

    /**
     * Sets a collection of ChildJobEmpresaSuscrita objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobEmpresaSuscritas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysLocation The current object (for fluent API support)
     */
    public function setJobEmpresaSuscritas(Collection $jobEmpresaSuscritas, ConnectionInterface $con = null)
    {
        /** @var ChildJobEmpresaSuscrita[] $jobEmpresaSuscritasToDelete */
        $jobEmpresaSuscritasToDelete = $this->getJobEmpresaSuscritas(new Criteria(), $con)->diff($jobEmpresaSuscritas);

        
        $this->jobEmpresaSuscritasScheduledForDeletion = $jobEmpresaSuscritasToDelete;

        foreach ($jobEmpresaSuscritasToDelete as $jobEmpresaSuscritaRemoved) {
            $jobEmpresaSuscritaRemoved->setSysLocation(null);
        }

        $this->collJobEmpresaSuscritas = null;
        foreach ($jobEmpresaSuscritas as $jobEmpresaSuscrita) {
            $this->addJobEmpresaSuscrita($jobEmpresaSuscrita);
        }

        $this->collJobEmpresaSuscritas = $jobEmpresaSuscritas;
        $this->collJobEmpresaSuscritasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobEmpresaSuscrita objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobEmpresaSuscrita objects.
     * @throws PropelException
     */
    public function countJobEmpresaSuscritas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobEmpresaSuscritasPartial && !$this->isNew();
        if (null === $this->collJobEmpresaSuscritas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobEmpresaSuscritas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobEmpresaSuscritas());
            }

            $query = ChildJobEmpresaSuscritaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysLocation($this)
                ->count($con);
        }

        return count($this->collJobEmpresaSuscritas);
    }

    /**
     * Method called to associate a ChildJobEmpresaSuscrita object to this object
     * through the ChildJobEmpresaSuscrita foreign key attribute.
     *
     * @param  ChildJobEmpresaSuscrita $l ChildJobEmpresaSuscrita
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function addJobEmpresaSuscrita(ChildJobEmpresaSuscrita $l)
    {
        if ($this->collJobEmpresaSuscritas === null) {
            $this->initJobEmpresaSuscritas();
            $this->collJobEmpresaSuscritasPartial = true;
        }

        if (!$this->collJobEmpresaSuscritas->contains($l)) {
            $this->doAddJobEmpresaSuscrita($l);
        }

        return $this;
    }

    /**
     * @param ChildJobEmpresaSuscrita $jobEmpresaSuscrita The ChildJobEmpresaSuscrita object to add.
     */
    protected function doAddJobEmpresaSuscrita(ChildJobEmpresaSuscrita $jobEmpresaSuscrita)
    {
        $this->collJobEmpresaSuscritas[]= $jobEmpresaSuscrita;
        $jobEmpresaSuscrita->setSysLocation($this);
    }

    /**
     * @param  ChildJobEmpresaSuscrita $jobEmpresaSuscrita The ChildJobEmpresaSuscrita object to remove.
     * @return $this|ChildSysLocation The current object (for fluent API support)
     */
    public function removeJobEmpresaSuscrita(ChildJobEmpresaSuscrita $jobEmpresaSuscrita)
    {
        if ($this->getJobEmpresaSuscritas()->contains($jobEmpresaSuscrita)) {
            $pos = $this->collJobEmpresaSuscritas->search($jobEmpresaSuscrita);
            $this->collJobEmpresaSuscritas->remove($pos);
            if (null === $this->jobEmpresaSuscritasScheduledForDeletion) {
                $this->jobEmpresaSuscritasScheduledForDeletion = clone $this->collJobEmpresaSuscritas;
                $this->jobEmpresaSuscritasScheduledForDeletion->clear();
            }
            $this->jobEmpresaSuscritasScheduledForDeletion[]= $jobEmpresaSuscrita;
            $jobEmpresaSuscrita->setSysLocation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysLocation is new, it will return
     * an empty collection; or if this SysLocation has previously
     * been saved, it will retrieve related JobEmpresaSuscritas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysLocation.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobEmpresaSuscrita[] List of ChildJobEmpresaSuscrita objects
     */
    public function getJobEmpresaSuscritasJoinSysEntityType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobEmpresaSuscritaQuery::create(null, $criteria);
        $query->joinWith('SysEntityType', $joinBehavior);

        return $this->getJobEmpresaSuscritas($query, $con);
    }

    /**
     * Clears out the collSysEntities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysEntities()
     */
    public function clearSysEntities()
    {
        $this->collSysEntities = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysEntities collection loaded partially.
     */
    public function resetPartialSysEntities($v = true)
    {
        $this->collSysEntitiesPartial = $v;
    }

    /**
     * Initializes the collSysEntities collection.
     *
     * By default this just sets the collSysEntities collection to an empty array (like clearcollSysEntities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysEntities($overrideExisting = true)
    {
        if (null !== $this->collSysEntities && !$overrideExisting) {
            return;
        }
        $this->collSysEntities = new ObjectCollection();
        $this->collSysEntities->setModel('\SysEntity');
    }

    /**
     * Gets an array of ChildSysEntity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysLocation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysEntity[] List of ChildSysEntity objects
     * @throws PropelException
     */
    public function getSysEntities(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntitiesPartial && !$this->isNew();
        if (null === $this->collSysEntities || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysEntities) {
                // return empty collection
                $this->initSysEntities();
            } else {
                $collSysEntities = ChildSysEntityQuery::create(null, $criteria)
                    ->filterBySysLocation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysEntitiesPartial && count($collSysEntities)) {
                        $this->initSysEntities(false);

                        foreach ($collSysEntities as $obj) {
                            if (false == $this->collSysEntities->contains($obj)) {
                                $this->collSysEntities->append($obj);
                            }
                        }

                        $this->collSysEntitiesPartial = true;
                    }

                    return $collSysEntities;
                }

                if ($partial && $this->collSysEntities) {
                    foreach ($this->collSysEntities as $obj) {
                        if ($obj->isNew()) {
                            $collSysEntities[] = $obj;
                        }
                    }
                }

                $this->collSysEntities = $collSysEntities;
                $this->collSysEntitiesPartial = false;
            }
        }

        return $this->collSysEntities;
    }

    /**
     * Sets a collection of ChildSysEntity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysEntities A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysLocation The current object (for fluent API support)
     */
    public function setSysEntities(Collection $sysEntities, ConnectionInterface $con = null)
    {
        /** @var ChildSysEntity[] $sysEntitiesToDelete */
        $sysEntitiesToDelete = $this->getSysEntities(new Criteria(), $con)->diff($sysEntities);

        
        $this->sysEntitiesScheduledForDeletion = $sysEntitiesToDelete;

        foreach ($sysEntitiesToDelete as $sysEntityRemoved) {
            $sysEntityRemoved->setSysLocation(null);
        }

        $this->collSysEntities = null;
        foreach ($sysEntities as $sysEntity) {
            $this->addSysEntity($sysEntity);
        }

        $this->collSysEntities = $sysEntities;
        $this->collSysEntitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysEntity objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysEntity objects.
     * @throws PropelException
     */
    public function countSysEntities(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntitiesPartial && !$this->isNew();
        if (null === $this->collSysEntities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysEntities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysEntities());
            }

            $query = ChildSysEntityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysLocation($this)
                ->count($con);
        }

        return count($this->collSysEntities);
    }

    /**
     * Method called to associate a ChildSysEntity object to this object
     * through the ChildSysEntity foreign key attribute.
     *
     * @param  ChildSysEntity $l ChildSysEntity
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function addSysEntity(ChildSysEntity $l)
    {
        if ($this->collSysEntities === null) {
            $this->initSysEntities();
            $this->collSysEntitiesPartial = true;
        }

        if (!$this->collSysEntities->contains($l)) {
            $this->doAddSysEntity($l);
        }

        return $this;
    }

    /**
     * @param ChildSysEntity $sysEntity The ChildSysEntity object to add.
     */
    protected function doAddSysEntity(ChildSysEntity $sysEntity)
    {
        $this->collSysEntities[]= $sysEntity;
        $sysEntity->setSysLocation($this);
    }

    /**
     * @param  ChildSysEntity $sysEntity The ChildSysEntity object to remove.
     * @return $this|ChildSysLocation The current object (for fluent API support)
     */
    public function removeSysEntity(ChildSysEntity $sysEntity)
    {
        if ($this->getSysEntities()->contains($sysEntity)) {
            $pos = $this->collSysEntities->search($sysEntity);
            $this->collSysEntities->remove($pos);
            if (null === $this->sysEntitiesScheduledForDeletion) {
                $this->sysEntitiesScheduledForDeletion = clone $this->collSysEntities;
                $this->sysEntitiesScheduledForDeletion->clear();
            }
            $this->sysEntitiesScheduledForDeletion[]= $sysEntity;
            $sysEntity->setSysLocation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysLocation is new, it will return
     * an empty collection; or if this SysLocation has previously
     * been saved, it will retrieve related SysEntities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysLocation.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEntity[] List of ChildSysEntity objects
     */
    public function getSysEntitiesJoinSysEntityType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEntityQuery::create(null, $criteria);
        $query->joinWith('SysEntityType', $joinBehavior);

        return $this->getSysEntities($query, $con);
    }

    /**
     * Clears out the collSysEntityBranches collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysEntityBranches()
     */
    public function clearSysEntityBranches()
    {
        $this->collSysEntityBranches = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysEntityBranches collection loaded partially.
     */
    public function resetPartialSysEntityBranches($v = true)
    {
        $this->collSysEntityBranchesPartial = $v;
    }

    /**
     * Initializes the collSysEntityBranches collection.
     *
     * By default this just sets the collSysEntityBranches collection to an empty array (like clearcollSysEntityBranches());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysEntityBranches($overrideExisting = true)
    {
        if (null !== $this->collSysEntityBranches && !$overrideExisting) {
            return;
        }
        $this->collSysEntityBranches = new ObjectCollection();
        $this->collSysEntityBranches->setModel('\SysEntityBranch');
    }

    /**
     * Gets an array of ChildSysEntityBranch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysLocation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysEntityBranch[] List of ChildSysEntityBranch objects
     * @throws PropelException
     */
    public function getSysEntityBranches(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntityBranchesPartial && !$this->isNew();
        if (null === $this->collSysEntityBranches || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysEntityBranches) {
                // return empty collection
                $this->initSysEntityBranches();
            } else {
                $collSysEntityBranches = ChildSysEntityBranchQuery::create(null, $criteria)
                    ->filterBySysLocation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysEntityBranchesPartial && count($collSysEntityBranches)) {
                        $this->initSysEntityBranches(false);

                        foreach ($collSysEntityBranches as $obj) {
                            if (false == $this->collSysEntityBranches->contains($obj)) {
                                $this->collSysEntityBranches->append($obj);
                            }
                        }

                        $this->collSysEntityBranchesPartial = true;
                    }

                    return $collSysEntityBranches;
                }

                if ($partial && $this->collSysEntityBranches) {
                    foreach ($this->collSysEntityBranches as $obj) {
                        if ($obj->isNew()) {
                            $collSysEntityBranches[] = $obj;
                        }
                    }
                }

                $this->collSysEntityBranches = $collSysEntityBranches;
                $this->collSysEntityBranchesPartial = false;
            }
        }

        return $this->collSysEntityBranches;
    }

    /**
     * Sets a collection of ChildSysEntityBranch objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysEntityBranches A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysLocation The current object (for fluent API support)
     */
    public function setSysEntityBranches(Collection $sysEntityBranches, ConnectionInterface $con = null)
    {
        /** @var ChildSysEntityBranch[] $sysEntityBranchesToDelete */
        $sysEntityBranchesToDelete = $this->getSysEntityBranches(new Criteria(), $con)->diff($sysEntityBranches);

        
        $this->sysEntityBranchesScheduledForDeletion = $sysEntityBranchesToDelete;

        foreach ($sysEntityBranchesToDelete as $sysEntityBranchRemoved) {
            $sysEntityBranchRemoved->setSysLocation(null);
        }

        $this->collSysEntityBranches = null;
        foreach ($sysEntityBranches as $sysEntityBranch) {
            $this->addSysEntityBranch($sysEntityBranch);
        }

        $this->collSysEntityBranches = $sysEntityBranches;
        $this->collSysEntityBranchesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysEntityBranch objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysEntityBranch objects.
     * @throws PropelException
     */
    public function countSysEntityBranches(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntityBranchesPartial && !$this->isNew();
        if (null === $this->collSysEntityBranches || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysEntityBranches) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysEntityBranches());
            }

            $query = ChildSysEntityBranchQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysLocation($this)
                ->count($con);
        }

        return count($this->collSysEntityBranches);
    }

    /**
     * Method called to associate a ChildSysEntityBranch object to this object
     * through the ChildSysEntityBranch foreign key attribute.
     *
     * @param  ChildSysEntityBranch $l ChildSysEntityBranch
     * @return $this|\SysLocation The current object (for fluent API support)
     */
    public function addSysEntityBranch(ChildSysEntityBranch $l)
    {
        if ($this->collSysEntityBranches === null) {
            $this->initSysEntityBranches();
            $this->collSysEntityBranchesPartial = true;
        }

        if (!$this->collSysEntityBranches->contains($l)) {
            $this->doAddSysEntityBranch($l);
        }

        return $this;
    }

    /**
     * @param ChildSysEntityBranch $sysEntityBranch The ChildSysEntityBranch object to add.
     */
    protected function doAddSysEntityBranch(ChildSysEntityBranch $sysEntityBranch)
    {
        $this->collSysEntityBranches[]= $sysEntityBranch;
        $sysEntityBranch->setSysLocation($this);
    }

    /**
     * @param  ChildSysEntityBranch $sysEntityBranch The ChildSysEntityBranch object to remove.
     * @return $this|ChildSysLocation The current object (for fluent API support)
     */
    public function removeSysEntityBranch(ChildSysEntityBranch $sysEntityBranch)
    {
        if ($this->getSysEntityBranches()->contains($sysEntityBranch)) {
            $pos = $this->collSysEntityBranches->search($sysEntityBranch);
            $this->collSysEntityBranches->remove($pos);
            if (null === $this->sysEntityBranchesScheduledForDeletion) {
                $this->sysEntityBranchesScheduledForDeletion = clone $this->collSysEntityBranches;
                $this->sysEntityBranchesScheduledForDeletion->clear();
            }
            $this->sysEntityBranchesScheduledForDeletion[]= clone $sysEntityBranch;
            $sysEntityBranch->setSysLocation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysLocation is new, it will return
     * an empty collection; or if this SysLocation has previously
     * been saved, it will retrieve related SysEntityBranches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysLocation.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEntityBranch[] List of ChildSysEntityBranch objects
     */
    public function getSysEntityBranchesJoinSysEntity(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEntityBranchQuery::create(null, $criteria);
        $query->joinWith('SysEntity', $joinBehavior);

        return $this->getSysEntityBranches($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->main_id = null;
        $this->code = null;
        $this->status = null;
        $this->name = null;
        $this->type = null;
        $this->level = null;
        $this->lft = null;
        $this->rgt = null;
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
            if ($this->collJobEmpresaSuscritas) {
                foreach ($this->collJobEmpresaSuscritas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysEntities) {
                foreach ($this->collSysEntities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysEntityBranches) {
                foreach ($this->collSysEntityBranches as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collJobEmpresaSuscritas = null;
        $this->collSysEntities = null;
        $this->collSysEntityBranches = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysLocationTableMap::DEFAULT_STRING_FORMAT);
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
