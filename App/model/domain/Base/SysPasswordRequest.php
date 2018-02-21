<?php

namespace Base;

use \SysPassword as ChildSysPassword;
use \SysPasswordQuery as ChildSysPasswordQuery;
use \SysPasswordRequest as ChildSysPasswordRequest;
use \SysPasswordRequestQuery as ChildSysPasswordRequestQuery;
use \SysUser as ChildSysUser;
use \SysUserQuery as ChildSysUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\SysPasswordRequestTableMap;
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
 * Base class that represents a row from the 'sys_password_request' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class SysPasswordRequest implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SysPasswordRequestTableMap';


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
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the hash_string field.
     * @var        string
     */
    protected $hash_string;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the life_time field.
     * @var        int
     */
    protected $life_time;

    /**
     * The value for the request_ip field.
     * @var        string
     */
    protected $request_ip;

    /**
     * The value for the restored_ip field.
     * @var        string
     */
    protected $restored_ip;

    /**
     * The value for the acceded_times field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $acceded_times;

    /**
     * The value for the requested_date field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        \DateTime
     */
    protected $requested_date;

    /**
     * The value for the restored_date field.
     * @var        \DateTime
     */
    protected $restored_date;

    /**
     * @var        ChildSysUser
     */
    protected $aSysUser;

    /**
     * @var        ObjectCollection|ChildSysPassword[] Collection to store aggregation of ChildSysPassword objects.
     */
    protected $collSysPasswords;
    protected $collSysPasswordsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysPassword[]
     */
    protected $sysPasswordsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->active = true;
        $this->acceded_times = 0;
    }

    /**
     * Initializes internal state of Base\SysPasswordRequest object.
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
     * Compares this with another <code>SysPasswordRequest</code> instance.  If
     * <code>obj</code> is an instance of <code>SysPasswordRequest</code>, delegates to
     * <code>equals(SysPasswordRequest)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SysPasswordRequest The current object, for fluid interface
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
     * Get the [user_id] column value.
     * 
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
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
     * Get the [hash_string] column value.
     * 
     * @return string
     */
    public function getHashString()
    {
        return $this->hash_string;
    }

    /**
     * Get the [active] column value.
     * 
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [active] column value.
     * 
     * @return boolean
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Get the [life_time] column value.
     * 
     * @return int
     */
    public function getLifeTime()
    {
        return $this->life_time;
    }

    /**
     * Get the [request_ip] column value.
     * 
     * @return string
     */
    public function getRequestIp()
    {
        return $this->request_ip;
    }

    /**
     * Get the [restored_ip] column value.
     * 
     * @return string
     */
    public function getRestoredIp()
    {
        return $this->restored_ip;
    }

    /**
     * Get the [acceded_times] column value.
     * 
     * @return int
     */
    public function getAccededTimes()
    {
        return $this->acceded_times;
    }

    /**
     * Get the [optionally formatted] temporal [requested_date] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRequestedDate($format = NULL)
    {
        if ($format === null) {
            return $this->requested_date;
        } else {
            return $this->requested_date instanceof \DateTime ? $this->requested_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [restored_date] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRestoredDate($format = NULL)
    {
        if ($format === null) {
            return $this->restored_date;
        } else {
            return $this->restored_date instanceof \DateTime ? $this->restored_date->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     * 
     * @param int $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [user_id] column.
     * 
     * @param int $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_USER_ID] = true;
        }

        if ($this->aSysUser !== null && $this->aSysUser->getId() !== $v) {
            $this->aSysUser = null;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [email] column.
     * 
     * @param string $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [hash_string] column.
     * 
     * @param string $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setHashString($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hash_string !== $v) {
            $this->hash_string = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_HASH_STRING] = true;
        }

        return $this;
    } // setHashString()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Set the value of [life_time] column.
     * 
     * @param int $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setLifeTime($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->life_time !== $v) {
            $this->life_time = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_LIFE_TIME] = true;
        }

        return $this;
    } // setLifeTime()

    /**
     * Set the value of [request_ip] column.
     * 
     * @param string $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setRequestIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->request_ip !== $v) {
            $this->request_ip = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_REQUEST_IP] = true;
        }

        return $this;
    } // setRequestIp()

    /**
     * Set the value of [restored_ip] column.
     * 
     * @param string $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setRestoredIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->restored_ip !== $v) {
            $this->restored_ip = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_RESTORED_IP] = true;
        }

        return $this;
    } // setRestoredIp()

    /**
     * Set the value of [acceded_times] column.
     * 
     * @param int $v new value
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setAccededTimes($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->acceded_times !== $v) {
            $this->acceded_times = $v;
            $this->modifiedColumns[SysPasswordRequestTableMap::COL_ACCEDED_TIMES] = true;
        }

        return $this;
    } // setAccededTimes()

    /**
     * Sets the value of [requested_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setRequestedDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->requested_date !== null || $dt !== null) {
            if ($this->requested_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->requested_date->format("Y-m-d H:i:s")) {
                $this->requested_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysPasswordRequestTableMap::COL_REQUESTED_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRequestedDate()

    /**
     * Sets the value of [restored_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function setRestoredDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->restored_date !== null || $dt !== null) {
            if ($this->restored_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->restored_date->format("Y-m-d H:i:s")) {
                $this->restored_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysPasswordRequestTableMap::COL_RESTORED_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRestoredDate()

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
            if ($this->active !== true) {
                return false;
            }

            if ($this->acceded_times !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysPasswordRequestTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysPasswordRequestTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysPasswordRequestTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysPasswordRequestTableMap::translateFieldName('HashString', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hash_string = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysPasswordRequestTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysPasswordRequestTableMap::translateFieldName('LifeTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->life_time = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysPasswordRequestTableMap::translateFieldName('RequestIp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->request_ip = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysPasswordRequestTableMap::translateFieldName('RestoredIp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->restored_ip = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysPasswordRequestTableMap::translateFieldName('AccededTimes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->acceded_times = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysPasswordRequestTableMap::translateFieldName('RequestedDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->requested_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysPasswordRequestTableMap::translateFieldName('RestoredDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->restored_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = SysPasswordRequestTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysPasswordRequest'), 0, $e);
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
        if ($this->aSysUser !== null && $this->user_id !== $this->aSysUser->getId()) {
            $this->aSysUser = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SysPasswordRequestTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysPasswordRequestQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSysUser = null;
            $this->collSysPasswords = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SysPasswordRequest::setDeleted()
     * @see SysPasswordRequest::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordRequestTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysPasswordRequestQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysPasswordRequestTableMap::DATABASE_NAME);
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
                SysPasswordRequestTableMap::addInstanceToPool($this);
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

            if ($this->aSysUser !== null) {
                if ($this->aSysUser->isModified() || $this->aSysUser->isNew()) {
                    $affectedRows += $this->aSysUser->save($con);
                }
                $this->setSysUser($this->aSysUser);
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

            if ($this->sysPasswordsScheduledForDeletion !== null) {
                if (!$this->sysPasswordsScheduledForDeletion->isEmpty()) {
                    foreach ($this->sysPasswordsScheduledForDeletion as $sysPassword) {
                        // need to save related object because we set the relation to null
                        $sysPassword->save($con);
                    }
                    $this->sysPasswordsScheduledForDeletion = null;
                }
            }

            if ($this->collSysPasswords !== null) {
                foreach ($this->collSysPasswords as $referrerFK) {
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

        $this->modifiedColumns[SysPasswordRequestTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysPasswordRequestTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'USER_ID';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_HASH_STRING)) {
            $modifiedColumns[':p' . $index++]  = 'HASH_STRING';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'ACTIVE';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_LIFE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'LIFE_TIME';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_REQUEST_IP)) {
            $modifiedColumns[':p' . $index++]  = 'REQUEST_IP';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_RESTORED_IP)) {
            $modifiedColumns[':p' . $index++]  = 'RESTORED_IP';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_ACCEDED_TIMES)) {
            $modifiedColumns[':p' . $index++]  = 'ACCEDED_TIMES';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_REQUESTED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'REQUESTED_DATE';
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_RESTORED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'RESTORED_DATE';
        }

        $sql = sprintf(
            'INSERT INTO sys_password_request (%s) VALUES (%s)',
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
                    case 'EMAIL':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'HASH_STRING':                        
                        $stmt->bindValue($identifier, $this->hash_string, PDO::PARAM_STR);
                        break;
                    case 'ACTIVE':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case 'LIFE_TIME':                        
                        $stmt->bindValue($identifier, $this->life_time, PDO::PARAM_INT);
                        break;
                    case 'REQUEST_IP':                        
                        $stmt->bindValue($identifier, $this->request_ip, PDO::PARAM_STR);
                        break;
                    case 'RESTORED_IP':                        
                        $stmt->bindValue($identifier, $this->restored_ip, PDO::PARAM_STR);
                        break;
                    case 'ACCEDED_TIMES':                        
                        $stmt->bindValue($identifier, $this->acceded_times, PDO::PARAM_INT);
                        break;
                    case 'REQUESTED_DATE':                        
                        $stmt->bindValue($identifier, $this->requested_date ? $this->requested_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'RESTORED_DATE':                        
                        $stmt->bindValue($identifier, $this->restored_date ? $this->restored_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = SysPasswordRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmail();
                break;
            case 3:
                return $this->getHashString();
                break;
            case 4:
                return $this->getActive();
                break;
            case 5:
                return $this->getLifeTime();
                break;
            case 6:
                return $this->getRequestIp();
                break;
            case 7:
                return $this->getRestoredIp();
                break;
            case 8:
                return $this->getAccededTimes();
                break;
            case 9:
                return $this->getRequestedDate();
                break;
            case 10:
                return $this->getRestoredDate();
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

        if (isset($alreadyDumpedObjects['SysPasswordRequest'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SysPasswordRequest'][$this->hashCode()] = true;
        $keys = SysPasswordRequestTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getHashString(),
            $keys[4] => $this->getActive(),
            $keys[5] => $this->getLifeTime(),
            $keys[6] => $this->getRequestIp(),
            $keys[7] => $this->getRestoredIp(),
            $keys[8] => $this->getAccededTimes(),
            $keys[9] => $this->getRequestedDate(),
            $keys[10] => $this->getRestoredDate(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[9]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[9]];
            $result[$keys[9]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[10]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[10]];
            $result[$keys[10]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aSysUser) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysUser';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_user';
                        break;
                    default:
                        $key = 'SysUser';
                }
        
                $result[$key] = $this->aSysUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSysPasswords) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysPasswords';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_passwords';
                        break;
                    default:
                        $key = 'SysPasswords';
                }
        
                $result[$key] = $this->collSysPasswords->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\SysPasswordRequest
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysPasswordRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SysPasswordRequest
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
                $this->setEmail($value);
                break;
            case 3:
                $this->setHashString($value);
                break;
            case 4:
                $this->setActive($value);
                break;
            case 5:
                $this->setLifeTime($value);
                break;
            case 6:
                $this->setRequestIp($value);
                break;
            case 7:
                $this->setRestoredIp($value);
                break;
            case 8:
                $this->setAccededTimes($value);
                break;
            case 9:
                $this->setRequestedDate($value);
                break;
            case 10:
                $this->setRestoredDate($value);
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
        $keys = SysPasswordRequestTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setHashString($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setActive($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLifeTime($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRequestIp($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setRestoredIp($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAccededTimes($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRequestedDate($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRestoredDate($arr[$keys[10]]);
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
     * @return $this|\SysPasswordRequest The current object, for fluid interface
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
        $criteria = new Criteria(SysPasswordRequestTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_ID)) {
            $criteria->add(SysPasswordRequestTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_USER_ID)) {
            $criteria->add(SysPasswordRequestTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_EMAIL)) {
            $criteria->add(SysPasswordRequestTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_HASH_STRING)) {
            $criteria->add(SysPasswordRequestTableMap::COL_HASH_STRING, $this->hash_string);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_ACTIVE)) {
            $criteria->add(SysPasswordRequestTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_LIFE_TIME)) {
            $criteria->add(SysPasswordRequestTableMap::COL_LIFE_TIME, $this->life_time);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_REQUEST_IP)) {
            $criteria->add(SysPasswordRequestTableMap::COL_REQUEST_IP, $this->request_ip);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_RESTORED_IP)) {
            $criteria->add(SysPasswordRequestTableMap::COL_RESTORED_IP, $this->restored_ip);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_ACCEDED_TIMES)) {
            $criteria->add(SysPasswordRequestTableMap::COL_ACCEDED_TIMES, $this->acceded_times);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_REQUESTED_DATE)) {
            $criteria->add(SysPasswordRequestTableMap::COL_REQUESTED_DATE, $this->requested_date);
        }
        if ($this->isColumnModified(SysPasswordRequestTableMap::COL_RESTORED_DATE)) {
            $criteria->add(SysPasswordRequestTableMap::COL_RESTORED_DATE, $this->restored_date);
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
        $criteria = ChildSysPasswordRequestQuery::create();
        $criteria->add(SysPasswordRequestTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \SysPasswordRequest (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUserId($this->getUserId());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setHashString($this->getHashString());
        $copyObj->setActive($this->getActive());
        $copyObj->setLifeTime($this->getLifeTime());
        $copyObj->setRequestIp($this->getRequestIp());
        $copyObj->setRestoredIp($this->getRestoredIp());
        $copyObj->setAccededTimes($this->getAccededTimes());
        $copyObj->setRequestedDate($this->getRequestedDate());
        $copyObj->setRestoredDate($this->getRestoredDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSysPasswords() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysPassword($relObj->copy($deepCopy));
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
     * @return \SysPasswordRequest Clone of current object.
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
     * Declares an association between this object and a ChildSysUser object.
     *
     * @param  ChildSysUser $v
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSysUser(ChildSysUser $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aSysUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSysUser object, it will not be re-added.
        if ($v !== null) {
            $v->addSysPasswordRequest($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSysUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSysUser The associated ChildSysUser object.
     * @throws PropelException
     */
    public function getSysUser(ConnectionInterface $con = null)
    {
        if ($this->aSysUser === null && ($this->user_id !== null)) {
            $this->aSysUser = ChildSysUserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSysUser->addSysPasswordRequests($this);
             */
        }

        return $this->aSysUser;
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
        if ('SysPassword' == $relationName) {
            return $this->initSysPasswords();
        }
    }

    /**
     * Clears out the collSysPasswords collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysPasswords()
     */
    public function clearSysPasswords()
    {
        $this->collSysPasswords = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysPasswords collection loaded partially.
     */
    public function resetPartialSysPasswords($v = true)
    {
        $this->collSysPasswordsPartial = $v;
    }

    /**
     * Initializes the collSysPasswords collection.
     *
     * By default this just sets the collSysPasswords collection to an empty array (like clearcollSysPasswords());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysPasswords($overrideExisting = true)
    {
        if (null !== $this->collSysPasswords && !$overrideExisting) {
            return;
        }
        $this->collSysPasswords = new ObjectCollection();
        $this->collSysPasswords->setModel('\SysPassword');
    }

    /**
     * Gets an array of ChildSysPassword objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysPasswordRequest is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysPassword[] List of ChildSysPassword objects
     * @throws PropelException
     */
    public function getSysPasswords(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysPasswordsPartial && !$this->isNew();
        if (null === $this->collSysPasswords || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysPasswords) {
                // return empty collection
                $this->initSysPasswords();
            } else {
                $collSysPasswords = ChildSysPasswordQuery::create(null, $criteria)
                    ->filterBySysPasswordRequest($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysPasswordsPartial && count($collSysPasswords)) {
                        $this->initSysPasswords(false);

                        foreach ($collSysPasswords as $obj) {
                            if (false == $this->collSysPasswords->contains($obj)) {
                                $this->collSysPasswords->append($obj);
                            }
                        }

                        $this->collSysPasswordsPartial = true;
                    }

                    return $collSysPasswords;
                }

                if ($partial && $this->collSysPasswords) {
                    foreach ($this->collSysPasswords as $obj) {
                        if ($obj->isNew()) {
                            $collSysPasswords[] = $obj;
                        }
                    }
                }

                $this->collSysPasswords = $collSysPasswords;
                $this->collSysPasswordsPartial = false;
            }
        }

        return $this->collSysPasswords;
    }

    /**
     * Sets a collection of ChildSysPassword objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysPasswords A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysPasswordRequest The current object (for fluent API support)
     */
    public function setSysPasswords(Collection $sysPasswords, ConnectionInterface $con = null)
    {
        /** @var ChildSysPassword[] $sysPasswordsToDelete */
        $sysPasswordsToDelete = $this->getSysPasswords(new Criteria(), $con)->diff($sysPasswords);

        
        $this->sysPasswordsScheduledForDeletion = $sysPasswordsToDelete;

        foreach ($sysPasswordsToDelete as $sysPasswordRemoved) {
            $sysPasswordRemoved->setSysPasswordRequest(null);
        }

        $this->collSysPasswords = null;
        foreach ($sysPasswords as $sysPassword) {
            $this->addSysPassword($sysPassword);
        }

        $this->collSysPasswords = $sysPasswords;
        $this->collSysPasswordsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysPassword objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysPassword objects.
     * @throws PropelException
     */
    public function countSysPasswords(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysPasswordsPartial && !$this->isNew();
        if (null === $this->collSysPasswords || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysPasswords) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysPasswords());
            }

            $query = ChildSysPasswordQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysPasswordRequest($this)
                ->count($con);
        }

        return count($this->collSysPasswords);
    }

    /**
     * Method called to associate a ChildSysPassword object to this object
     * through the ChildSysPassword foreign key attribute.
     *
     * @param  ChildSysPassword $l ChildSysPassword
     * @return $this|\SysPasswordRequest The current object (for fluent API support)
     */
    public function addSysPassword(ChildSysPassword $l)
    {
        if ($this->collSysPasswords === null) {
            $this->initSysPasswords();
            $this->collSysPasswordsPartial = true;
        }

        if (!$this->collSysPasswords->contains($l)) {
            $this->doAddSysPassword($l);
        }

        return $this;
    }

    /**
     * @param ChildSysPassword $sysPassword The ChildSysPassword object to add.
     */
    protected function doAddSysPassword(ChildSysPassword $sysPassword)
    {
        $this->collSysPasswords[]= $sysPassword;
        $sysPassword->setSysPasswordRequest($this);
    }

    /**
     * @param  ChildSysPassword $sysPassword The ChildSysPassword object to remove.
     * @return $this|ChildSysPasswordRequest The current object (for fluent API support)
     */
    public function removeSysPassword(ChildSysPassword $sysPassword)
    {
        if ($this->getSysPasswords()->contains($sysPassword)) {
            $pos = $this->collSysPasswords->search($sysPassword);
            $this->collSysPasswords->remove($pos);
            if (null === $this->sysPasswordsScheduledForDeletion) {
                $this->sysPasswordsScheduledForDeletion = clone $this->collSysPasswords;
                $this->sysPasswordsScheduledForDeletion->clear();
            }
            $this->sysPasswordsScheduledForDeletion[]= $sysPassword;
            $sysPassword->setSysPasswordRequest(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysPasswordRequest is new, it will return
     * an empty collection; or if this SysPasswordRequest has previously
     * been saved, it will retrieve related SysPasswords from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysPasswordRequest.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysPassword[] List of ChildSysPassword objects
     */
    public function getSysPasswordsJoinSysUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysPasswordQuery::create(null, $criteria);
        $query->joinWith('SysUser', $joinBehavior);

        return $this->getSysPasswords($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSysUser) {
            $this->aSysUser->removeSysPasswordRequest($this);
        }
        $this->id = null;
        $this->user_id = null;
        $this->email = null;
        $this->hash_string = null;
        $this->active = null;
        $this->life_time = null;
        $this->request_ip = null;
        $this->restored_ip = null;
        $this->acceded_times = null;
        $this->requested_date = null;
        $this->restored_date = null;
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
            if ($this->collSysPasswords) {
                foreach ($this->collSysPasswords as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSysPasswords = null;
        $this->aSysUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysPasswordRequestTableMap::DEFAULT_STRING_FORMAT);
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
