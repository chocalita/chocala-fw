<?php

namespace Base;

use \JobUserEmpresaSuscrita as ChildJobUserEmpresaSuscrita;
use \JobUserEmpresaSuscritaQuery as ChildJobUserEmpresaSuscritaQuery;
use \SysAuth as ChildSysAuth;
use \SysAuthQuery as ChildSysAuthQuery;
use \SysEmailSent as ChildSysEmailSent;
use \SysEmailSentQuery as ChildSysEmailSentQuery;
use \SysEntityUser as ChildSysEntityUser;
use \SysEntityUserQuery as ChildSysEntityUserQuery;
use \SysImage as ChildSysImage;
use \SysImageQuery as ChildSysImageQuery;
use \SysPassword as ChildSysPassword;
use \SysPasswordQuery as ChildSysPasswordQuery;
use \SysPasswordRequest as ChildSysPasswordRequest;
use \SysPasswordRequestQuery as ChildSysPasswordRequestQuery;
use \SysPerson as ChildSysPerson;
use \SysPersonQuery as ChildSysPersonQuery;
use \SysUser as ChildSysUser;
use \SysUserParam as ChildSysUserParam;
use \SysUserParamQuery as ChildSysUserParamQuery;
use \SysUserQuery as ChildSysUserQuery;
use \SysUserXRol as ChildSysUserXRol;
use \SysUserXRolQuery as ChildSysUserXRolQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobUserEmpresaSuscritaTableMap;
use Map\SysAuthTableMap;
use Map\SysEmailSentTableMap;
use Map\SysEntityUserTableMap;
use Map\SysImageTableMap;
use Map\SysPasswordRequestTableMap;
use Map\SysPasswordTableMap;
use Map\SysPersonTableMap;
use Map\SysUserParamTableMap;
use Map\SysUserTableMap;
use Map\SysUserXRolTableMap;
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
 * Base class that represents a row from the 'sys_user' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class SysUser implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SysUserTableMap';


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
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the username field.
     *
     * @var        string
     */
    protected $username;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 'CREATED'
     * @var        string
     */
    protected $status;

    /**
     * The value for the location field.
     *
     * @var        string
     */
    protected $location;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the image_mime field.
     *
     * @var        string
     */
    protected $image_mime;

    /**
     * The value for the actual_access field.
     *
     * @var        DateTime
     */
    protected $actual_access;

    /**
     * The value for the last_access field.
     *
     * @var        DateTime
     */
    protected $last_access;

    /**
     * The value for the access_failures field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $access_failures;

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
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $modification_date;

    /**
     * @var        ObjectCollection|ChildJobUserEmpresaSuscrita[] Collection to store aggregation of ChildJobUserEmpresaSuscrita objects.
     */
    protected $collJobUserEmpresaSuscritas;
    protected $collJobUserEmpresaSuscritasPartial;

    /**
     * @var        ObjectCollection|ChildSysAuth[] Collection to store aggregation of ChildSysAuth objects.
     */
    protected $collSysAuths;
    protected $collSysAuthsPartial;

    /**
     * @var        ObjectCollection|ChildSysEmailSent[] Collection to store aggregation of ChildSysEmailSent objects.
     */
    protected $collSysEmailSents;
    protected $collSysEmailSentsPartial;

    /**
     * @var        ObjectCollection|ChildSysEntityUser[] Collection to store aggregation of ChildSysEntityUser objects.
     */
    protected $collSysEntityUsers;
    protected $collSysEntityUsersPartial;

    /**
     * @var        ObjectCollection|ChildSysImage[] Collection to store aggregation of ChildSysImage objects.
     */
    protected $collSysImages;
    protected $collSysImagesPartial;

    /**
     * @var        ObjectCollection|ChildSysPassword[] Collection to store aggregation of ChildSysPassword objects.
     */
    protected $collSysPasswords;
    protected $collSysPasswordsPartial;

    /**
     * @var        ObjectCollection|ChildSysPasswordRequest[] Collection to store aggregation of ChildSysPasswordRequest objects.
     */
    protected $collSysPasswordRequests;
    protected $collSysPasswordRequestsPartial;

    /**
     * @var        ObjectCollection|ChildSysPerson[] Collection to store aggregation of ChildSysPerson objects.
     */
    protected $collSyspeople;
    protected $collSyspeoplePartial;

    /**
     * @var        ObjectCollection|ChildSysUserParam[] Collection to store aggregation of ChildSysUserParam objects.
     */
    protected $collSysUserParams;
    protected $collSysUserParamsPartial;

    /**
     * @var        ObjectCollection|ChildSysUserXRol[] Collection to store aggregation of ChildSysUserXRol objects.
     */
    protected $collSysUserXRols;
    protected $collSysUserXRolsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildJobUserEmpresaSuscrita[]
     */
    protected $jobUserEmpresaSuscritasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysAuth[]
     */
    protected $sysAuthsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEmailSent[]
     */
    protected $sysEmailSentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEntityUser[]
     */
    protected $sysEntityUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysImage[]
     */
    protected $sysImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysPassword[]
     */
    protected $sysPasswordsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysPasswordRequest[]
     */
    protected $sysPasswordRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysPerson[]
     */
    protected $syspeopleScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysUserParam[]
     */
    protected $sysUserParamsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysUserXRol[]
     */
    protected $sysUserXRolsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->status = 'CREATED';
        $this->access_failures = 0;
        $this->last_user_id = 0;
    }

    /**
     * Initializes internal state of Base\SysUser object.
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
     * Compares this with another <code>SysUser</code> instance.  If
     * <code>obj</code> is an instance of <code>SysUser</code>, delegates to
     * <code>equals(SysUser)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SysUser The current object, for fluid interface
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
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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
     * Get the [location] column value.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [image_mime] column value.
     *
     * @return string
     */
    public function getImageMime()
    {
        return $this->image_mime;
    }

    /**
     * Get the [optionally formatted] temporal [actual_access] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getActualAccess($format = NULL)
    {
        if ($format === null) {
            return $this->actual_access;
        } else {
            return $this->actual_access instanceof \DateTimeInterface ? $this->actual_access->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [last_access] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastAccess($format = NULL)
    {
        if ($format === null) {
            return $this->last_access;
        } else {
            return $this->last_access instanceof \DateTimeInterface ? $this->last_access->format($format) : null;
        }
    }

    /**
     * Get the [access_failures] column value.
     *
     * @return int
     */
    public function getAccessFailures()
    {
        return $this->access_failures;
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
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysUserTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[SysUserTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [username] column.
     *
     * @param string $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[SysUserTableMap::COL_USERNAME] = true;
        }

        return $this;
    } // setUsername()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[SysUserTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[SysUserTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [location] column.
     *
     * @param string $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[SysUserTableMap::COL_LOCATION] = true;
        }

        return $this;
    } // setLocation()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[SysUserTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [image_mime] column.
     *
     * @param string $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setImageMime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_mime !== $v) {
            $this->image_mime = $v;
            $this->modifiedColumns[SysUserTableMap::COL_IMAGE_MIME] = true;
        }

        return $this;
    } // setImageMime()

    /**
     * Sets the value of [actual_access] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setActualAccess($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->actual_access !== null || $dt !== null) {
            if ($this->actual_access === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->actual_access->format("Y-m-d H:i:s.u")) {
                $this->actual_access = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysUserTableMap::COL_ACTUAL_ACCESS] = true;
            }
        } // if either are not null

        return $this;
    } // setActualAccess()

    /**
     * Sets the value of [last_access] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setLastAccess($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_access !== null || $dt !== null) {
            if ($this->last_access === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_access->format("Y-m-d H:i:s.u")) {
                $this->last_access = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysUserTableMap::COL_LAST_ACCESS] = true;
            }
        } // if either are not null

        return $this;
    } // setLastAccess()

    /**
     * Set the value of [access_failures] column.
     *
     * @param int $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setAccessFailures($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->access_failures !== $v) {
            $this->access_failures = $v;
            $this->modifiedColumns[SysUserTableMap::COL_ACCESS_FAILURES] = true;
        }

        return $this;
    } // setAccessFailures()

    /**
     * Set the value of [last_user_id] column.
     *
     * @param int $v new value
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[SysUserTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->creation_date->format("Y-m-d H:i:s.u")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysUserTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->modification_date->format("Y-m-d H:i:s.u")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysUserTableMap::COL_MODIFICATION_DATE] = true;
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
            if ($this->status !== 'CREATED') {
                return false;
            }

            if ($this->access_failures !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysUserTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysUserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysUserTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysUserTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysUserTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysUserTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysUserTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysUserTableMap::translateFieldName('ImageMime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->image_mime = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysUserTableMap::translateFieldName('ActualAccess', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->actual_access = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysUserTableMap::translateFieldName('LastAccess', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_access = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysUserTableMap::translateFieldName('AccessFailures', TableMap::TYPE_PHPNAME, $indexType)];
            $this->access_failures = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SysUserTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SysUserTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SysUserTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = SysUserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysUser'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SysUserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJobUserEmpresaSuscritas = null;

            $this->collSysAuths = null;

            $this->collSysEmailSents = null;

            $this->collSysEntityUsers = null;

            $this->collSysImages = null;

            $this->collSysPasswords = null;

            $this->collSysPasswordRequests = null;

            $this->collSyspeople = null;

            $this->collSysUserParams = null;

            $this->collSysUserXRols = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SysUser::setDeleted()
     * @see SysUser::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserTableMap::DATABASE_NAME);
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
                SysUserTableMap::addInstanceToPool($this);
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

            if ($this->jobUserEmpresaSuscritasScheduledForDeletion !== null) {
                if (!$this->jobUserEmpresaSuscritasScheduledForDeletion->isEmpty()) {
                    \JobUserEmpresaSuscritaQuery::create()
                        ->filterByPrimaryKeys($this->jobUserEmpresaSuscritasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jobUserEmpresaSuscritasScheduledForDeletion = null;
                }
            }

            if ($this->collJobUserEmpresaSuscritas !== null) {
                foreach ($this->collJobUserEmpresaSuscritas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysAuthsScheduledForDeletion !== null) {
                if (!$this->sysAuthsScheduledForDeletion->isEmpty()) {
                    \SysAuthQuery::create()
                        ->filterByPrimaryKeys($this->sysAuthsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysAuthsScheduledForDeletion = null;
                }
            }

            if ($this->collSysAuths !== null) {
                foreach ($this->collSysAuths as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysEmailSentsScheduledForDeletion !== null) {
                if (!$this->sysEmailSentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->sysEmailSentsScheduledForDeletion as $sysEmailSent) {
                        // need to save related object because we set the relation to null
                        $sysEmailSent->save($con);
                    }
                    $this->sysEmailSentsScheduledForDeletion = null;
                }
            }

            if ($this->collSysEmailSents !== null) {
                foreach ($this->collSysEmailSents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysEntityUsersScheduledForDeletion !== null) {
                if (!$this->sysEntityUsersScheduledForDeletion->isEmpty()) {
                    \SysEntityUserQuery::create()
                        ->filterByPrimaryKeys($this->sysEntityUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysEntityUsersScheduledForDeletion = null;
                }
            }

            if ($this->collSysEntityUsers !== null) {
                foreach ($this->collSysEntityUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysImagesScheduledForDeletion !== null) {
                if (!$this->sysImagesScheduledForDeletion->isEmpty()) {
                    \SysImageQuery::create()
                        ->filterByPrimaryKeys($this->sysImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysImagesScheduledForDeletion = null;
                }
            }

            if ($this->collSysImages !== null) {
                foreach ($this->collSysImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysPasswordsScheduledForDeletion !== null) {
                if (!$this->sysPasswordsScheduledForDeletion->isEmpty()) {
                    \SysPasswordQuery::create()
                        ->filterByPrimaryKeys($this->sysPasswordsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->sysPasswordRequestsScheduledForDeletion !== null) {
                if (!$this->sysPasswordRequestsScheduledForDeletion->isEmpty()) {
                    \SysPasswordRequestQuery::create()
                        ->filterByPrimaryKeys($this->sysPasswordRequestsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysPasswordRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collSysPasswordRequests !== null) {
                foreach ($this->collSysPasswordRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->syspeopleScheduledForDeletion !== null) {
                if (!$this->syspeopleScheduledForDeletion->isEmpty()) {
                    \SysPersonQuery::create()
                        ->filterByPrimaryKeys($this->syspeopleScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->syspeopleScheduledForDeletion = null;
                }
            }

            if ($this->collSyspeople !== null) {
                foreach ($this->collSyspeople as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysUserParamsScheduledForDeletion !== null) {
                if (!$this->sysUserParamsScheduledForDeletion->isEmpty()) {
                    \SysUserParamQuery::create()
                        ->filterByPrimaryKeys($this->sysUserParamsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysUserParamsScheduledForDeletion = null;
                }
            }

            if ($this->collSysUserParams !== null) {
                foreach ($this->collSysUserParams as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sysUserXRolsScheduledForDeletion !== null) {
                if (!$this->sysUserXRolsScheduledForDeletion->isEmpty()) {
                    \SysUserXRolQuery::create()
                        ->filterByPrimaryKeys($this->sysUserXRolsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysUserXRolsScheduledForDeletion = null;
                }
            }

            if ($this->collSysUserXRols !== null) {
                foreach ($this->collSysUserXRols as $referrerFK) {
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

        $this->modifiedColumns[SysUserTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysUserTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysUserTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'USERNAME';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'PASSWORD';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'STATUS';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'LOCATION';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'ADDRESS';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_IMAGE_MIME)) {
            $modifiedColumns[':p' . $index++]  = 'IMAGE_MIME';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_ACTUAL_ACCESS)) {
            $modifiedColumns[':p' . $index++]  = 'ACTUAL_ACCESS';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_LAST_ACCESS)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_ACCESS';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_ACCESS_FAILURES)) {
            $modifiedColumns[':p' . $index++]  = 'ACCESS_FAILURES';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(SysUserTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO sys_user (%s) VALUES (%s)',
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
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'USERNAME':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'PASSWORD':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'STATUS':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'LOCATION':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
                        break;
                    case 'ADDRESS':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'IMAGE_MIME':
                        $stmt->bindValue($identifier, $this->image_mime, PDO::PARAM_STR);
                        break;
                    case 'ACTUAL_ACCESS':
                        $stmt->bindValue($identifier, $this->actual_access ? $this->actual_access->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'LAST_ACCESS':
                        $stmt->bindValue($identifier, $this->last_access ? $this->last_access->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ACCESS_FAILURES':
                        $stmt->bindValue($identifier, $this->access_failures, PDO::PARAM_INT);
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
        $pos = SysUserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmail();
                break;
            case 2:
                return $this->getUsername();
                break;
            case 3:
                return $this->getPassword();
                break;
            case 4:
                return $this->getStatus();
                break;
            case 5:
                return $this->getLocation();
                break;
            case 6:
                return $this->getAddress();
                break;
            case 7:
                return $this->getImageMime();
                break;
            case 8:
                return $this->getActualAccess();
                break;
            case 9:
                return $this->getLastAccess();
                break;
            case 10:
                return $this->getAccessFailures();
                break;
            case 11:
                return $this->getLastUserId();
                break;
            case 12:
                return $this->getCreationDate();
                break;
            case 13:
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

        if (isset($alreadyDumpedObjects['SysUser'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SysUser'][$this->hashCode()] = true;
        $keys = SysUserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getUsername(),
            $keys[3] => $this->getPassword(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getLocation(),
            $keys[6] => $this->getAddress(),
            $keys[7] => $this->getImageMime(),
            $keys[8] => $this->getActualAccess(),
            $keys[9] => $this->getLastAccess(),
            $keys[10] => $this->getAccessFailures(),
            $keys[11] => $this->getLastUserId(),
            $keys[12] => $this->getCreationDate(),
            $keys[13] => $this->getModificationDate(),
        );
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('c');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collJobUserEmpresaSuscritas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jobUserEmpresaSuscritas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'job_user_empresa_suscritas';
                        break;
                    default:
                        $key = 'JobUserEmpresaSuscritas';
                }

                $result[$key] = $this->collJobUserEmpresaSuscritas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysAuths) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysAuths';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_auths';
                        break;
                    default:
                        $key = 'SysAuths';
                }

                $result[$key] = $this->collSysAuths->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysEmailSents) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysEmailSents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_email_sents';
                        break;
                    default:
                        $key = 'SysEmailSents';
                }

                $result[$key] = $this->collSysEmailSents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysEntityUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysEntityUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_entity_users';
                        break;
                    default:
                        $key = 'SysEntityUsers';
                }

                $result[$key] = $this->collSysEntityUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysImages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysImages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_images';
                        break;
                    default:
                        $key = 'SysImages';
                }

                $result[$key] = $this->collSysImages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSysPasswordRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysPasswordRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_password_requests';
                        break;
                    default:
                        $key = 'SysPasswordRequests';
                }

                $result[$key] = $this->collSysPasswordRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSyspeople) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'syspeople';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_people';
                        break;
                    default:
                        $key = 'Syspeople';
                }

                $result[$key] = $this->collSyspeople->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysUserParams) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysUserParams';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_user_params';
                        break;
                    default:
                        $key = 'SysUserParams';
                }

                $result[$key] = $this->collSysUserParams->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSysUserXRols) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysUserXRols';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_user_x_rols';
                        break;
                    default:
                        $key = 'SysUserXRols';
                }

                $result[$key] = $this->collSysUserXRols->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\SysUser
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysUserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SysUser
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setEmail($value);
                break;
            case 2:
                $this->setUsername($value);
                break;
            case 3:
                $this->setPassword($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setLocation($value);
                break;
            case 6:
                $this->setAddress($value);
                break;
            case 7:
                $this->setImageMime($value);
                break;
            case 8:
                $this->setActualAccess($value);
                break;
            case 9:
                $this->setLastAccess($value);
                break;
            case 10:
                $this->setAccessFailures($value);
                break;
            case 11:
                $this->setLastUserId($value);
                break;
            case 12:
                $this->setCreationDate($value);
                break;
            case 13:
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
        $keys = SysUserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmail($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUsername($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPassword($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLocation($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAddress($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setImageMime($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setActualAccess($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLastAccess($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setAccessFailures($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLastUserId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreationDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setModificationDate($arr[$keys[13]]);
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
     * @return $this|\SysUser The current object, for fluid interface
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
        $criteria = new Criteria(SysUserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysUserTableMap::COL_ID)) {
            $criteria->add(SysUserTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_EMAIL)) {
            $criteria->add(SysUserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_USERNAME)) {
            $criteria->add(SysUserTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_PASSWORD)) {
            $criteria->add(SysUserTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_STATUS)) {
            $criteria->add(SysUserTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_LOCATION)) {
            $criteria->add(SysUserTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_ADDRESS)) {
            $criteria->add(SysUserTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_IMAGE_MIME)) {
            $criteria->add(SysUserTableMap::COL_IMAGE_MIME, $this->image_mime);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_ACTUAL_ACCESS)) {
            $criteria->add(SysUserTableMap::COL_ACTUAL_ACCESS, $this->actual_access);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_LAST_ACCESS)) {
            $criteria->add(SysUserTableMap::COL_LAST_ACCESS, $this->last_access);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_ACCESS_FAILURES)) {
            $criteria->add(SysUserTableMap::COL_ACCESS_FAILURES, $this->access_failures);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_LAST_USER_ID)) {
            $criteria->add(SysUserTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_CREATION_DATE)) {
            $criteria->add(SysUserTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(SysUserTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(SysUserTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildSysUserQuery::create();
        $criteria->add(SysUserTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \SysUser (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setImageMime($this->getImageMime());
        $copyObj->setActualAccess($this->getActualAccess());
        $copyObj->setLastAccess($this->getLastAccess());
        $copyObj->setAccessFailures($this->getAccessFailures());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getJobUserEmpresaSuscritas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobUserEmpresaSuscrita($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysAuths() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysAuth($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysEmailSents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEmailSent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysEntityUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEntityUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysPasswords() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysPassword($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysPasswordRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysPasswordRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSyspeople() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysPerson($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysUserParams() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysUserParam($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysUserXRols() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysUserXRol($relObj->copy($deepCopy));
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
     * @return \SysUser Clone of current object.
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
        if ('JobUserEmpresaSuscrita' == $relationName) {
            $this->initJobUserEmpresaSuscritas();
            return;
        }
        if ('SysAuth' == $relationName) {
            $this->initSysAuths();
            return;
        }
        if ('SysEmailSent' == $relationName) {
            $this->initSysEmailSents();
            return;
        }
        if ('SysEntityUser' == $relationName) {
            $this->initSysEntityUsers();
            return;
        }
        if ('SysImage' == $relationName) {
            $this->initSysImages();
            return;
        }
        if ('SysPassword' == $relationName) {
            $this->initSysPasswords();
            return;
        }
        if ('SysPasswordRequest' == $relationName) {
            $this->initSysPasswordRequests();
            return;
        }
        if ('SysPerson' == $relationName) {
            $this->initSyspeople();
            return;
        }
        if ('SysUserParam' == $relationName) {
            $this->initSysUserParams();
            return;
        }
        if ('SysUserXRol' == $relationName) {
            $this->initSysUserXRols();
            return;
        }
    }

    /**
     * Clears out the collJobUserEmpresaSuscritas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJobUserEmpresaSuscritas()
     */
    public function clearJobUserEmpresaSuscritas()
    {
        $this->collJobUserEmpresaSuscritas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collJobUserEmpresaSuscritas collection loaded partially.
     */
    public function resetPartialJobUserEmpresaSuscritas($v = true)
    {
        $this->collJobUserEmpresaSuscritasPartial = $v;
    }

    /**
     * Initializes the collJobUserEmpresaSuscritas collection.
     *
     * By default this just sets the collJobUserEmpresaSuscritas collection to an empty array (like clearcollJobUserEmpresaSuscritas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJobUserEmpresaSuscritas($overrideExisting = true)
    {
        if (null !== $this->collJobUserEmpresaSuscritas && !$overrideExisting) {
            return;
        }

        $collectionClassName = JobUserEmpresaSuscritaTableMap::getTableMap()->getCollectionClassName();

        $this->collJobUserEmpresaSuscritas = new $collectionClassName;
        $this->collJobUserEmpresaSuscritas->setModel('\JobUserEmpresaSuscrita');
    }

    /**
     * Gets an array of ChildJobUserEmpresaSuscrita objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildJobUserEmpresaSuscrita[] List of ChildJobUserEmpresaSuscrita objects
     * @throws PropelException
     */
    public function getJobUserEmpresaSuscritas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collJobUserEmpresaSuscritasPartial && !$this->isNew();
        if (null === $this->collJobUserEmpresaSuscritas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJobUserEmpresaSuscritas) {
                // return empty collection
                $this->initJobUserEmpresaSuscritas();
            } else {
                $collJobUserEmpresaSuscritas = ChildJobUserEmpresaSuscritaQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collJobUserEmpresaSuscritasPartial && count($collJobUserEmpresaSuscritas)) {
                        $this->initJobUserEmpresaSuscritas(false);

                        foreach ($collJobUserEmpresaSuscritas as $obj) {
                            if (false == $this->collJobUserEmpresaSuscritas->contains($obj)) {
                                $this->collJobUserEmpresaSuscritas->append($obj);
                            }
                        }

                        $this->collJobUserEmpresaSuscritasPartial = true;
                    }

                    return $collJobUserEmpresaSuscritas;
                }

                if ($partial && $this->collJobUserEmpresaSuscritas) {
                    foreach ($this->collJobUserEmpresaSuscritas as $obj) {
                        if ($obj->isNew()) {
                            $collJobUserEmpresaSuscritas[] = $obj;
                        }
                    }
                }

                $this->collJobUserEmpresaSuscritas = $collJobUserEmpresaSuscritas;
                $this->collJobUserEmpresaSuscritasPartial = false;
            }
        }

        return $this->collJobUserEmpresaSuscritas;
    }

    /**
     * Sets a collection of ChildJobUserEmpresaSuscrita objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $jobUserEmpresaSuscritas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setJobUserEmpresaSuscritas(Collection $jobUserEmpresaSuscritas, ConnectionInterface $con = null)
    {
        /** @var ChildJobUserEmpresaSuscrita[] $jobUserEmpresaSuscritasToDelete */
        $jobUserEmpresaSuscritasToDelete = $this->getJobUserEmpresaSuscritas(new Criteria(), $con)->diff($jobUserEmpresaSuscritas);


        $this->jobUserEmpresaSuscritasScheduledForDeletion = $jobUserEmpresaSuscritasToDelete;

        foreach ($jobUserEmpresaSuscritasToDelete as $jobUserEmpresaSuscritaRemoved) {
            $jobUserEmpresaSuscritaRemoved->setSysUser(null);
        }

        $this->collJobUserEmpresaSuscritas = null;
        foreach ($jobUserEmpresaSuscritas as $jobUserEmpresaSuscrita) {
            $this->addJobUserEmpresaSuscrita($jobUserEmpresaSuscrita);
        }

        $this->collJobUserEmpresaSuscritas = $jobUserEmpresaSuscritas;
        $this->collJobUserEmpresaSuscritasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related JobUserEmpresaSuscrita objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related JobUserEmpresaSuscrita objects.
     * @throws PropelException
     */
    public function countJobUserEmpresaSuscritas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collJobUserEmpresaSuscritasPartial && !$this->isNew();
        if (null === $this->collJobUserEmpresaSuscritas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJobUserEmpresaSuscritas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getJobUserEmpresaSuscritas());
            }

            $query = ChildJobUserEmpresaSuscritaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collJobUserEmpresaSuscritas);
    }

    /**
     * Method called to associate a ChildJobUserEmpresaSuscrita object to this object
     * through the ChildJobUserEmpresaSuscrita foreign key attribute.
     *
     * @param  ChildJobUserEmpresaSuscrita $l ChildJobUserEmpresaSuscrita
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addJobUserEmpresaSuscrita(ChildJobUserEmpresaSuscrita $l)
    {
        if ($this->collJobUserEmpresaSuscritas === null) {
            $this->initJobUserEmpresaSuscritas();
            $this->collJobUserEmpresaSuscritasPartial = true;
        }

        if (!$this->collJobUserEmpresaSuscritas->contains($l)) {
            $this->doAddJobUserEmpresaSuscrita($l);

            if ($this->jobUserEmpresaSuscritasScheduledForDeletion and $this->jobUserEmpresaSuscritasScheduledForDeletion->contains($l)) {
                $this->jobUserEmpresaSuscritasScheduledForDeletion->remove($this->jobUserEmpresaSuscritasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildJobUserEmpresaSuscrita $jobUserEmpresaSuscrita The ChildJobUserEmpresaSuscrita object to add.
     */
    protected function doAddJobUserEmpresaSuscrita(ChildJobUserEmpresaSuscrita $jobUserEmpresaSuscrita)
    {
        $this->collJobUserEmpresaSuscritas[]= $jobUserEmpresaSuscrita;
        $jobUserEmpresaSuscrita->setSysUser($this);
    }

    /**
     * @param  ChildJobUserEmpresaSuscrita $jobUserEmpresaSuscrita The ChildJobUserEmpresaSuscrita object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeJobUserEmpresaSuscrita(ChildJobUserEmpresaSuscrita $jobUserEmpresaSuscrita)
    {
        if ($this->getJobUserEmpresaSuscritas()->contains($jobUserEmpresaSuscrita)) {
            $pos = $this->collJobUserEmpresaSuscritas->search($jobUserEmpresaSuscrita);
            $this->collJobUserEmpresaSuscritas->remove($pos);
            if (null === $this->jobUserEmpresaSuscritasScheduledForDeletion) {
                $this->jobUserEmpresaSuscritasScheduledForDeletion = clone $this->collJobUserEmpresaSuscritas;
                $this->jobUserEmpresaSuscritasScheduledForDeletion->clear();
            }
            $this->jobUserEmpresaSuscritasScheduledForDeletion[]= clone $jobUserEmpresaSuscrita;
            $jobUserEmpresaSuscrita->setSysUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related JobUserEmpresaSuscritas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobUserEmpresaSuscrita[] List of ChildJobUserEmpresaSuscrita objects
     */
    public function getJobUserEmpresaSuscritasJoinJobEmpresaSuscrita(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobUserEmpresaSuscritaQuery::create(null, $criteria);
        $query->joinWith('JobEmpresaSuscrita', $joinBehavior);

        return $this->getJobUserEmpresaSuscritas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related JobUserEmpresaSuscritas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobUserEmpresaSuscrita[] List of ChildJobUserEmpresaSuscrita objects
     */
    public function getJobUserEmpresaSuscritasJoinSysRol(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobUserEmpresaSuscritaQuery::create(null, $criteria);
        $query->joinWith('SysRol', $joinBehavior);

        return $this->getJobUserEmpresaSuscritas($query, $con);
    }

    /**
     * Clears out the collSysAuths collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysAuths()
     */
    public function clearSysAuths()
    {
        $this->collSysAuths = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysAuths collection loaded partially.
     */
    public function resetPartialSysAuths($v = true)
    {
        $this->collSysAuthsPartial = $v;
    }

    /**
     * Initializes the collSysAuths collection.
     *
     * By default this just sets the collSysAuths collection to an empty array (like clearcollSysAuths());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysAuths($overrideExisting = true)
    {
        if (null !== $this->collSysAuths && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysAuthTableMap::getTableMap()->getCollectionClassName();

        $this->collSysAuths = new $collectionClassName;
        $this->collSysAuths->setModel('\SysAuth');
    }

    /**
     * Gets an array of ChildSysAuth objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysAuth[] List of ChildSysAuth objects
     * @throws PropelException
     */
    public function getSysAuths(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysAuthsPartial && !$this->isNew();
        if (null === $this->collSysAuths || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysAuths) {
                // return empty collection
                $this->initSysAuths();
            } else {
                $collSysAuths = ChildSysAuthQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysAuthsPartial && count($collSysAuths)) {
                        $this->initSysAuths(false);

                        foreach ($collSysAuths as $obj) {
                            if (false == $this->collSysAuths->contains($obj)) {
                                $this->collSysAuths->append($obj);
                            }
                        }

                        $this->collSysAuthsPartial = true;
                    }

                    return $collSysAuths;
                }

                if ($partial && $this->collSysAuths) {
                    foreach ($this->collSysAuths as $obj) {
                        if ($obj->isNew()) {
                            $collSysAuths[] = $obj;
                        }
                    }
                }

                $this->collSysAuths = $collSysAuths;
                $this->collSysAuthsPartial = false;
            }
        }

        return $this->collSysAuths;
    }

    /**
     * Sets a collection of ChildSysAuth objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysAuths A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysAuths(Collection $sysAuths, ConnectionInterface $con = null)
    {
        /** @var ChildSysAuth[] $sysAuthsToDelete */
        $sysAuthsToDelete = $this->getSysAuths(new Criteria(), $con)->diff($sysAuths);


        $this->sysAuthsScheduledForDeletion = $sysAuthsToDelete;

        foreach ($sysAuthsToDelete as $sysAuthRemoved) {
            $sysAuthRemoved->setSysUser(null);
        }

        $this->collSysAuths = null;
        foreach ($sysAuths as $sysAuth) {
            $this->addSysAuth($sysAuth);
        }

        $this->collSysAuths = $sysAuths;
        $this->collSysAuthsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysAuth objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysAuth objects.
     * @throws PropelException
     */
    public function countSysAuths(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysAuthsPartial && !$this->isNew();
        if (null === $this->collSysAuths || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysAuths) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysAuths());
            }

            $query = ChildSysAuthQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysAuths);
    }

    /**
     * Method called to associate a ChildSysAuth object to this object
     * through the ChildSysAuth foreign key attribute.
     *
     * @param  ChildSysAuth $l ChildSysAuth
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysAuth(ChildSysAuth $l)
    {
        if ($this->collSysAuths === null) {
            $this->initSysAuths();
            $this->collSysAuthsPartial = true;
        }

        if (!$this->collSysAuths->contains($l)) {
            $this->doAddSysAuth($l);

            if ($this->sysAuthsScheduledForDeletion and $this->sysAuthsScheduledForDeletion->contains($l)) {
                $this->sysAuthsScheduledForDeletion->remove($this->sysAuthsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysAuth $sysAuth The ChildSysAuth object to add.
     */
    protected function doAddSysAuth(ChildSysAuth $sysAuth)
    {
        $this->collSysAuths[]= $sysAuth;
        $sysAuth->setSysUser($this);
    }

    /**
     * @param  ChildSysAuth $sysAuth The ChildSysAuth object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysAuth(ChildSysAuth $sysAuth)
    {
        if ($this->getSysAuths()->contains($sysAuth)) {
            $pos = $this->collSysAuths->search($sysAuth);
            $this->collSysAuths->remove($pos);
            if (null === $this->sysAuthsScheduledForDeletion) {
                $this->sysAuthsScheduledForDeletion = clone $this->collSysAuths;
                $this->sysAuthsScheduledForDeletion->clear();
            }
            $this->sysAuthsScheduledForDeletion[]= clone $sysAuth;
            $sysAuth->setSysUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collSysEmailSents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysEmailSents()
     */
    public function clearSysEmailSents()
    {
        $this->collSysEmailSents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysEmailSents collection loaded partially.
     */
    public function resetPartialSysEmailSents($v = true)
    {
        $this->collSysEmailSentsPartial = $v;
    }

    /**
     * Initializes the collSysEmailSents collection.
     *
     * By default this just sets the collSysEmailSents collection to an empty array (like clearcollSysEmailSents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysEmailSents($overrideExisting = true)
    {
        if (null !== $this->collSysEmailSents && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysEmailSentTableMap::getTableMap()->getCollectionClassName();

        $this->collSysEmailSents = new $collectionClassName;
        $this->collSysEmailSents->setModel('\SysEmailSent');
    }

    /**
     * Gets an array of ChildSysEmailSent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysEmailSent[] List of ChildSysEmailSent objects
     * @throws PropelException
     */
    public function getSysEmailSents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEmailSentsPartial && !$this->isNew();
        if (null === $this->collSysEmailSents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysEmailSents) {
                // return empty collection
                $this->initSysEmailSents();
            } else {
                $collSysEmailSents = ChildSysEmailSentQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysEmailSentsPartial && count($collSysEmailSents)) {
                        $this->initSysEmailSents(false);

                        foreach ($collSysEmailSents as $obj) {
                            if (false == $this->collSysEmailSents->contains($obj)) {
                                $this->collSysEmailSents->append($obj);
                            }
                        }

                        $this->collSysEmailSentsPartial = true;
                    }

                    return $collSysEmailSents;
                }

                if ($partial && $this->collSysEmailSents) {
                    foreach ($this->collSysEmailSents as $obj) {
                        if ($obj->isNew()) {
                            $collSysEmailSents[] = $obj;
                        }
                    }
                }

                $this->collSysEmailSents = $collSysEmailSents;
                $this->collSysEmailSentsPartial = false;
            }
        }

        return $this->collSysEmailSents;
    }

    /**
     * Sets a collection of ChildSysEmailSent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysEmailSents A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysEmailSents(Collection $sysEmailSents, ConnectionInterface $con = null)
    {
        /** @var ChildSysEmailSent[] $sysEmailSentsToDelete */
        $sysEmailSentsToDelete = $this->getSysEmailSents(new Criteria(), $con)->diff($sysEmailSents);


        $this->sysEmailSentsScheduledForDeletion = $sysEmailSentsToDelete;

        foreach ($sysEmailSentsToDelete as $sysEmailSentRemoved) {
            $sysEmailSentRemoved->setSysUser(null);
        }

        $this->collSysEmailSents = null;
        foreach ($sysEmailSents as $sysEmailSent) {
            $this->addSysEmailSent($sysEmailSent);
        }

        $this->collSysEmailSents = $sysEmailSents;
        $this->collSysEmailSentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysEmailSent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysEmailSent objects.
     * @throws PropelException
     */
    public function countSysEmailSents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEmailSentsPartial && !$this->isNew();
        if (null === $this->collSysEmailSents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysEmailSents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysEmailSents());
            }

            $query = ChildSysEmailSentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysEmailSents);
    }

    /**
     * Method called to associate a ChildSysEmailSent object to this object
     * through the ChildSysEmailSent foreign key attribute.
     *
     * @param  ChildSysEmailSent $l ChildSysEmailSent
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysEmailSent(ChildSysEmailSent $l)
    {
        if ($this->collSysEmailSents === null) {
            $this->initSysEmailSents();
            $this->collSysEmailSentsPartial = true;
        }

        if (!$this->collSysEmailSents->contains($l)) {
            $this->doAddSysEmailSent($l);

            if ($this->sysEmailSentsScheduledForDeletion and $this->sysEmailSentsScheduledForDeletion->contains($l)) {
                $this->sysEmailSentsScheduledForDeletion->remove($this->sysEmailSentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysEmailSent $sysEmailSent The ChildSysEmailSent object to add.
     */
    protected function doAddSysEmailSent(ChildSysEmailSent $sysEmailSent)
    {
        $this->collSysEmailSents[]= $sysEmailSent;
        $sysEmailSent->setSysUser($this);
    }

    /**
     * @param  ChildSysEmailSent $sysEmailSent The ChildSysEmailSent object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysEmailSent(ChildSysEmailSent $sysEmailSent)
    {
        if ($this->getSysEmailSents()->contains($sysEmailSent)) {
            $pos = $this->collSysEmailSents->search($sysEmailSent);
            $this->collSysEmailSents->remove($pos);
            if (null === $this->sysEmailSentsScheduledForDeletion) {
                $this->sysEmailSentsScheduledForDeletion = clone $this->collSysEmailSents;
                $this->sysEmailSentsScheduledForDeletion->clear();
            }
            $this->sysEmailSentsScheduledForDeletion[]= $sysEmailSent;
            $sysEmailSent->setSysUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related SysEmailSents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEmailSent[] List of ChildSysEmailSent objects
     */
    public function getSysEmailSentsJoinSysEmail(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEmailSentQuery::create(null, $criteria);
        $query->joinWith('SysEmail', $joinBehavior);

        return $this->getSysEmailSents($query, $con);
    }

    /**
     * Clears out the collSysEntityUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysEntityUsers()
     */
    public function clearSysEntityUsers()
    {
        $this->collSysEntityUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysEntityUsers collection loaded partially.
     */
    public function resetPartialSysEntityUsers($v = true)
    {
        $this->collSysEntityUsersPartial = $v;
    }

    /**
     * Initializes the collSysEntityUsers collection.
     *
     * By default this just sets the collSysEntityUsers collection to an empty array (like clearcollSysEntityUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysEntityUsers($overrideExisting = true)
    {
        if (null !== $this->collSysEntityUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysEntityUserTableMap::getTableMap()->getCollectionClassName();

        $this->collSysEntityUsers = new $collectionClassName;
        $this->collSysEntityUsers->setModel('\SysEntityUser');
    }

    /**
     * Gets an array of ChildSysEntityUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysEntityUser[] List of ChildSysEntityUser objects
     * @throws PropelException
     */
    public function getSysEntityUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntityUsersPartial && !$this->isNew();
        if (null === $this->collSysEntityUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysEntityUsers) {
                // return empty collection
                $this->initSysEntityUsers();
            } else {
                $collSysEntityUsers = ChildSysEntityUserQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysEntityUsersPartial && count($collSysEntityUsers)) {
                        $this->initSysEntityUsers(false);

                        foreach ($collSysEntityUsers as $obj) {
                            if (false == $this->collSysEntityUsers->contains($obj)) {
                                $this->collSysEntityUsers->append($obj);
                            }
                        }

                        $this->collSysEntityUsersPartial = true;
                    }

                    return $collSysEntityUsers;
                }

                if ($partial && $this->collSysEntityUsers) {
                    foreach ($this->collSysEntityUsers as $obj) {
                        if ($obj->isNew()) {
                            $collSysEntityUsers[] = $obj;
                        }
                    }
                }

                $this->collSysEntityUsers = $collSysEntityUsers;
                $this->collSysEntityUsersPartial = false;
            }
        }

        return $this->collSysEntityUsers;
    }

    /**
     * Sets a collection of ChildSysEntityUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysEntityUsers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysEntityUsers(Collection $sysEntityUsers, ConnectionInterface $con = null)
    {
        /** @var ChildSysEntityUser[] $sysEntityUsersToDelete */
        $sysEntityUsersToDelete = $this->getSysEntityUsers(new Criteria(), $con)->diff($sysEntityUsers);


        $this->sysEntityUsersScheduledForDeletion = $sysEntityUsersToDelete;

        foreach ($sysEntityUsersToDelete as $sysEntityUserRemoved) {
            $sysEntityUserRemoved->setSysUser(null);
        }

        $this->collSysEntityUsers = null;
        foreach ($sysEntityUsers as $sysEntityUser) {
            $this->addSysEntityUser($sysEntityUser);
        }

        $this->collSysEntityUsers = $sysEntityUsers;
        $this->collSysEntityUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysEntityUser objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysEntityUser objects.
     * @throws PropelException
     */
    public function countSysEntityUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntityUsersPartial && !$this->isNew();
        if (null === $this->collSysEntityUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysEntityUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysEntityUsers());
            }

            $query = ChildSysEntityUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysEntityUsers);
    }

    /**
     * Method called to associate a ChildSysEntityUser object to this object
     * through the ChildSysEntityUser foreign key attribute.
     *
     * @param  ChildSysEntityUser $l ChildSysEntityUser
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysEntityUser(ChildSysEntityUser $l)
    {
        if ($this->collSysEntityUsers === null) {
            $this->initSysEntityUsers();
            $this->collSysEntityUsersPartial = true;
        }

        if (!$this->collSysEntityUsers->contains($l)) {
            $this->doAddSysEntityUser($l);

            if ($this->sysEntityUsersScheduledForDeletion and $this->sysEntityUsersScheduledForDeletion->contains($l)) {
                $this->sysEntityUsersScheduledForDeletion->remove($this->sysEntityUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysEntityUser $sysEntityUser The ChildSysEntityUser object to add.
     */
    protected function doAddSysEntityUser(ChildSysEntityUser $sysEntityUser)
    {
        $this->collSysEntityUsers[]= $sysEntityUser;
        $sysEntityUser->setSysUser($this);
    }

    /**
     * @param  ChildSysEntityUser $sysEntityUser The ChildSysEntityUser object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysEntityUser(ChildSysEntityUser $sysEntityUser)
    {
        if ($this->getSysEntityUsers()->contains($sysEntityUser)) {
            $pos = $this->collSysEntityUsers->search($sysEntityUser);
            $this->collSysEntityUsers->remove($pos);
            if (null === $this->sysEntityUsersScheduledForDeletion) {
                $this->sysEntityUsersScheduledForDeletion = clone $this->collSysEntityUsers;
                $this->sysEntityUsersScheduledForDeletion->clear();
            }
            $this->sysEntityUsersScheduledForDeletion[]= clone $sysEntityUser;
            $sysEntityUser->setSysUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related SysEntityUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEntityUser[] List of ChildSysEntityUser objects
     */
    public function getSysEntityUsersJoinSysEntity(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEntityUserQuery::create(null, $criteria);
        $query->joinWith('SysEntity', $joinBehavior);

        return $this->getSysEntityUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related SysEntityUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEntityUser[] List of ChildSysEntityUser objects
     */
    public function getSysEntityUsersJoinSysRol(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEntityUserQuery::create(null, $criteria);
        $query->joinWith('SysRol', $joinBehavior);

        return $this->getSysEntityUsers($query, $con);
    }

    /**
     * Clears out the collSysImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysImages()
     */
    public function clearSysImages()
    {
        $this->collSysImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysImages collection loaded partially.
     */
    public function resetPartialSysImages($v = true)
    {
        $this->collSysImagesPartial = $v;
    }

    /**
     * Initializes the collSysImages collection.
     *
     * By default this just sets the collSysImages collection to an empty array (like clearcollSysImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysImages($overrideExisting = true)
    {
        if (null !== $this->collSysImages && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysImageTableMap::getTableMap()->getCollectionClassName();

        $this->collSysImages = new $collectionClassName;
        $this->collSysImages->setModel('\SysImage');
    }

    /**
     * Gets an array of ChildSysImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysImage[] List of ChildSysImage objects
     * @throws PropelException
     */
    public function getSysImages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysImagesPartial && !$this->isNew();
        if (null === $this->collSysImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysImages) {
                // return empty collection
                $this->initSysImages();
            } else {
                $collSysImages = ChildSysImageQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysImagesPartial && count($collSysImages)) {
                        $this->initSysImages(false);

                        foreach ($collSysImages as $obj) {
                            if (false == $this->collSysImages->contains($obj)) {
                                $this->collSysImages->append($obj);
                            }
                        }

                        $this->collSysImagesPartial = true;
                    }

                    return $collSysImages;
                }

                if ($partial && $this->collSysImages) {
                    foreach ($this->collSysImages as $obj) {
                        if ($obj->isNew()) {
                            $collSysImages[] = $obj;
                        }
                    }
                }

                $this->collSysImages = $collSysImages;
                $this->collSysImagesPartial = false;
            }
        }

        return $this->collSysImages;
    }

    /**
     * Sets a collection of ChildSysImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysImages(Collection $sysImages, ConnectionInterface $con = null)
    {
        /** @var ChildSysImage[] $sysImagesToDelete */
        $sysImagesToDelete = $this->getSysImages(new Criteria(), $con)->diff($sysImages);


        $this->sysImagesScheduledForDeletion = $sysImagesToDelete;

        foreach ($sysImagesToDelete as $sysImageRemoved) {
            $sysImageRemoved->setSysUser(null);
        }

        $this->collSysImages = null;
        foreach ($sysImages as $sysImage) {
            $this->addSysImage($sysImage);
        }

        $this->collSysImages = $sysImages;
        $this->collSysImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysImage objects.
     * @throws PropelException
     */
    public function countSysImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysImagesPartial && !$this->isNew();
        if (null === $this->collSysImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysImages());
            }

            $query = ChildSysImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysImages);
    }

    /**
     * Method called to associate a ChildSysImage object to this object
     * through the ChildSysImage foreign key attribute.
     *
     * @param  ChildSysImage $l ChildSysImage
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysImage(ChildSysImage $l)
    {
        if ($this->collSysImages === null) {
            $this->initSysImages();
            $this->collSysImagesPartial = true;
        }

        if (!$this->collSysImages->contains($l)) {
            $this->doAddSysImage($l);

            if ($this->sysImagesScheduledForDeletion and $this->sysImagesScheduledForDeletion->contains($l)) {
                $this->sysImagesScheduledForDeletion->remove($this->sysImagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysImage $sysImage The ChildSysImage object to add.
     */
    protected function doAddSysImage(ChildSysImage $sysImage)
    {
        $this->collSysImages[]= $sysImage;
        $sysImage->setSysUser($this);
    }

    /**
     * @param  ChildSysImage $sysImage The ChildSysImage object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysImage(ChildSysImage $sysImage)
    {
        if ($this->getSysImages()->contains($sysImage)) {
            $pos = $this->collSysImages->search($sysImage);
            $this->collSysImages->remove($pos);
            if (null === $this->sysImagesScheduledForDeletion) {
                $this->sysImagesScheduledForDeletion = clone $this->collSysImages;
                $this->sysImagesScheduledForDeletion->clear();
            }
            $this->sysImagesScheduledForDeletion[]= clone $sysImage;
            $sysImage->setSysUser(null);
        }

        return $this;
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

        $collectionClassName = SysPasswordTableMap::getTableMap()->getCollectionClassName();

        $this->collSysPasswords = new $collectionClassName;
        $this->collSysPasswords->setModel('\SysPassword');
    }

    /**
     * Gets an array of ChildSysPassword objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
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
                    ->filterBySysUser($this)
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
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysPasswords(Collection $sysPasswords, ConnectionInterface $con = null)
    {
        /** @var ChildSysPassword[] $sysPasswordsToDelete */
        $sysPasswordsToDelete = $this->getSysPasswords(new Criteria(), $con)->diff($sysPasswords);


        $this->sysPasswordsScheduledForDeletion = $sysPasswordsToDelete;

        foreach ($sysPasswordsToDelete as $sysPasswordRemoved) {
            $sysPasswordRemoved->setSysUser(null);
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
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysPasswords);
    }

    /**
     * Method called to associate a ChildSysPassword object to this object
     * through the ChildSysPassword foreign key attribute.
     *
     * @param  ChildSysPassword $l ChildSysPassword
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysPassword(ChildSysPassword $l)
    {
        if ($this->collSysPasswords === null) {
            $this->initSysPasswords();
            $this->collSysPasswordsPartial = true;
        }

        if (!$this->collSysPasswords->contains($l)) {
            $this->doAddSysPassword($l);

            if ($this->sysPasswordsScheduledForDeletion and $this->sysPasswordsScheduledForDeletion->contains($l)) {
                $this->sysPasswordsScheduledForDeletion->remove($this->sysPasswordsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysPassword $sysPassword The ChildSysPassword object to add.
     */
    protected function doAddSysPassword(ChildSysPassword $sysPassword)
    {
        $this->collSysPasswords[]= $sysPassword;
        $sysPassword->setSysUser($this);
    }

    /**
     * @param  ChildSysPassword $sysPassword The ChildSysPassword object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
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
            $this->sysPasswordsScheduledForDeletion[]= clone $sysPassword;
            $sysPassword->setSysUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related SysPasswords from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysPassword[] List of ChildSysPassword objects
     */
    public function getSysPasswordsJoinSysPasswordRequest(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysPasswordQuery::create(null, $criteria);
        $query->joinWith('SysPasswordRequest', $joinBehavior);

        return $this->getSysPasswords($query, $con);
    }

    /**
     * Clears out the collSysPasswordRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysPasswordRequests()
     */
    public function clearSysPasswordRequests()
    {
        $this->collSysPasswordRequests = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysPasswordRequests collection loaded partially.
     */
    public function resetPartialSysPasswordRequests($v = true)
    {
        $this->collSysPasswordRequestsPartial = $v;
    }

    /**
     * Initializes the collSysPasswordRequests collection.
     *
     * By default this just sets the collSysPasswordRequests collection to an empty array (like clearcollSysPasswordRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysPasswordRequests($overrideExisting = true)
    {
        if (null !== $this->collSysPasswordRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysPasswordRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collSysPasswordRequests = new $collectionClassName;
        $this->collSysPasswordRequests->setModel('\SysPasswordRequest');
    }

    /**
     * Gets an array of ChildSysPasswordRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysPasswordRequest[] List of ChildSysPasswordRequest objects
     * @throws PropelException
     */
    public function getSysPasswordRequests(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysPasswordRequestsPartial && !$this->isNew();
        if (null === $this->collSysPasswordRequests || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysPasswordRequests) {
                // return empty collection
                $this->initSysPasswordRequests();
            } else {
                $collSysPasswordRequests = ChildSysPasswordRequestQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysPasswordRequestsPartial && count($collSysPasswordRequests)) {
                        $this->initSysPasswordRequests(false);

                        foreach ($collSysPasswordRequests as $obj) {
                            if (false == $this->collSysPasswordRequests->contains($obj)) {
                                $this->collSysPasswordRequests->append($obj);
                            }
                        }

                        $this->collSysPasswordRequestsPartial = true;
                    }

                    return $collSysPasswordRequests;
                }

                if ($partial && $this->collSysPasswordRequests) {
                    foreach ($this->collSysPasswordRequests as $obj) {
                        if ($obj->isNew()) {
                            $collSysPasswordRequests[] = $obj;
                        }
                    }
                }

                $this->collSysPasswordRequests = $collSysPasswordRequests;
                $this->collSysPasswordRequestsPartial = false;
            }
        }

        return $this->collSysPasswordRequests;
    }

    /**
     * Sets a collection of ChildSysPasswordRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysPasswordRequests A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysPasswordRequests(Collection $sysPasswordRequests, ConnectionInterface $con = null)
    {
        /** @var ChildSysPasswordRequest[] $sysPasswordRequestsToDelete */
        $sysPasswordRequestsToDelete = $this->getSysPasswordRequests(new Criteria(), $con)->diff($sysPasswordRequests);


        $this->sysPasswordRequestsScheduledForDeletion = $sysPasswordRequestsToDelete;

        foreach ($sysPasswordRequestsToDelete as $sysPasswordRequestRemoved) {
            $sysPasswordRequestRemoved->setSysUser(null);
        }

        $this->collSysPasswordRequests = null;
        foreach ($sysPasswordRequests as $sysPasswordRequest) {
            $this->addSysPasswordRequest($sysPasswordRequest);
        }

        $this->collSysPasswordRequests = $sysPasswordRequests;
        $this->collSysPasswordRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysPasswordRequest objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysPasswordRequest objects.
     * @throws PropelException
     */
    public function countSysPasswordRequests(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysPasswordRequestsPartial && !$this->isNew();
        if (null === $this->collSysPasswordRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysPasswordRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysPasswordRequests());
            }

            $query = ChildSysPasswordRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysPasswordRequests);
    }

    /**
     * Method called to associate a ChildSysPasswordRequest object to this object
     * through the ChildSysPasswordRequest foreign key attribute.
     *
     * @param  ChildSysPasswordRequest $l ChildSysPasswordRequest
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysPasswordRequest(ChildSysPasswordRequest $l)
    {
        if ($this->collSysPasswordRequests === null) {
            $this->initSysPasswordRequests();
            $this->collSysPasswordRequestsPartial = true;
        }

        if (!$this->collSysPasswordRequests->contains($l)) {
            $this->doAddSysPasswordRequest($l);

            if ($this->sysPasswordRequestsScheduledForDeletion and $this->sysPasswordRequestsScheduledForDeletion->contains($l)) {
                $this->sysPasswordRequestsScheduledForDeletion->remove($this->sysPasswordRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysPasswordRequest $sysPasswordRequest The ChildSysPasswordRequest object to add.
     */
    protected function doAddSysPasswordRequest(ChildSysPasswordRequest $sysPasswordRequest)
    {
        $this->collSysPasswordRequests[]= $sysPasswordRequest;
        $sysPasswordRequest->setSysUser($this);
    }

    /**
     * @param  ChildSysPasswordRequest $sysPasswordRequest The ChildSysPasswordRequest object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysPasswordRequest(ChildSysPasswordRequest $sysPasswordRequest)
    {
        if ($this->getSysPasswordRequests()->contains($sysPasswordRequest)) {
            $pos = $this->collSysPasswordRequests->search($sysPasswordRequest);
            $this->collSysPasswordRequests->remove($pos);
            if (null === $this->sysPasswordRequestsScheduledForDeletion) {
                $this->sysPasswordRequestsScheduledForDeletion = clone $this->collSysPasswordRequests;
                $this->sysPasswordRequestsScheduledForDeletion->clear();
            }
            $this->sysPasswordRequestsScheduledForDeletion[]= clone $sysPasswordRequest;
            $sysPasswordRequest->setSysUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collSyspeople collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSyspeople()
     */
    public function clearSyspeople()
    {
        $this->collSyspeople = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSyspeople collection loaded partially.
     */
    public function resetPartialSyspeople($v = true)
    {
        $this->collSyspeoplePartial = $v;
    }

    /**
     * Initializes the collSyspeople collection.
     *
     * By default this just sets the collSyspeople collection to an empty array (like clearcollSyspeople());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSyspeople($overrideExisting = true)
    {
        if (null !== $this->collSyspeople && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysPersonTableMap::getTableMap()->getCollectionClassName();

        $this->collSyspeople = new $collectionClassName;
        $this->collSyspeople->setModel('\SysPerson');
    }

    /**
     * Gets an array of ChildSysPerson objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysPerson[] List of ChildSysPerson objects
     * @throws PropelException
     */
    public function getSyspeople(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSyspeoplePartial && !$this->isNew();
        if (null === $this->collSyspeople || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSyspeople) {
                // return empty collection
                $this->initSyspeople();
            } else {
                $collSyspeople = ChildSysPersonQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSyspeoplePartial && count($collSyspeople)) {
                        $this->initSyspeople(false);

                        foreach ($collSyspeople as $obj) {
                            if (false == $this->collSyspeople->contains($obj)) {
                                $this->collSyspeople->append($obj);
                            }
                        }

                        $this->collSyspeoplePartial = true;
                    }

                    return $collSyspeople;
                }

                if ($partial && $this->collSyspeople) {
                    foreach ($this->collSyspeople as $obj) {
                        if ($obj->isNew()) {
                            $collSyspeople[] = $obj;
                        }
                    }
                }

                $this->collSyspeople = $collSyspeople;
                $this->collSyspeoplePartial = false;
            }
        }

        return $this->collSyspeople;
    }

    /**
     * Sets a collection of ChildSysPerson objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $syspeople A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSyspeople(Collection $syspeople, ConnectionInterface $con = null)
    {
        /** @var ChildSysPerson[] $syspeopleToDelete */
        $syspeopleToDelete = $this->getSyspeople(new Criteria(), $con)->diff($syspeople);


        $this->syspeopleScheduledForDeletion = $syspeopleToDelete;

        foreach ($syspeopleToDelete as $sysPersonRemoved) {
            $sysPersonRemoved->setSysUser(null);
        }

        $this->collSyspeople = null;
        foreach ($syspeople as $sysPerson) {
            $this->addSysPerson($sysPerson);
        }

        $this->collSyspeople = $syspeople;
        $this->collSyspeoplePartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysPerson objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysPerson objects.
     * @throws PropelException
     */
    public function countSyspeople(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSyspeoplePartial && !$this->isNew();
        if (null === $this->collSyspeople || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSyspeople) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSyspeople());
            }

            $query = ChildSysPersonQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSyspeople);
    }

    /**
     * Method called to associate a ChildSysPerson object to this object
     * through the ChildSysPerson foreign key attribute.
     *
     * @param  ChildSysPerson $l ChildSysPerson
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysPerson(ChildSysPerson $l)
    {
        if ($this->collSyspeople === null) {
            $this->initSyspeople();
            $this->collSyspeoplePartial = true;
        }

        if (!$this->collSyspeople->contains($l)) {
            $this->doAddSysPerson($l);

            if ($this->syspeopleScheduledForDeletion and $this->syspeopleScheduledForDeletion->contains($l)) {
                $this->syspeopleScheduledForDeletion->remove($this->syspeopleScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysPerson $sysPerson The ChildSysPerson object to add.
     */
    protected function doAddSysPerson(ChildSysPerson $sysPerson)
    {
        $this->collSyspeople[]= $sysPerson;
        $sysPerson->setSysUser($this);
    }

    /**
     * @param  ChildSysPerson $sysPerson The ChildSysPerson object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysPerson(ChildSysPerson $sysPerson)
    {
        if ($this->getSyspeople()->contains($sysPerson)) {
            $pos = $this->collSyspeople->search($sysPerson);
            $this->collSyspeople->remove($pos);
            if (null === $this->syspeopleScheduledForDeletion) {
                $this->syspeopleScheduledForDeletion = clone $this->collSyspeople;
                $this->syspeopleScheduledForDeletion->clear();
            }
            $this->syspeopleScheduledForDeletion[]= clone $sysPerson;
            $sysPerson->setSysUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collSysUserParams collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysUserParams()
     */
    public function clearSysUserParams()
    {
        $this->collSysUserParams = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysUserParams collection loaded partially.
     */
    public function resetPartialSysUserParams($v = true)
    {
        $this->collSysUserParamsPartial = $v;
    }

    /**
     * Initializes the collSysUserParams collection.
     *
     * By default this just sets the collSysUserParams collection to an empty array (like clearcollSysUserParams());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysUserParams($overrideExisting = true)
    {
        if (null !== $this->collSysUserParams && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysUserParamTableMap::getTableMap()->getCollectionClassName();

        $this->collSysUserParams = new $collectionClassName;
        $this->collSysUserParams->setModel('\SysUserParam');
    }

    /**
     * Gets an array of ChildSysUserParam objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysUserParam[] List of ChildSysUserParam objects
     * @throws PropelException
     */
    public function getSysUserParams(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysUserParamsPartial && !$this->isNew();
        if (null === $this->collSysUserParams || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysUserParams) {
                // return empty collection
                $this->initSysUserParams();
            } else {
                $collSysUserParams = ChildSysUserParamQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysUserParamsPartial && count($collSysUserParams)) {
                        $this->initSysUserParams(false);

                        foreach ($collSysUserParams as $obj) {
                            if (false == $this->collSysUserParams->contains($obj)) {
                                $this->collSysUserParams->append($obj);
                            }
                        }

                        $this->collSysUserParamsPartial = true;
                    }

                    return $collSysUserParams;
                }

                if ($partial && $this->collSysUserParams) {
                    foreach ($this->collSysUserParams as $obj) {
                        if ($obj->isNew()) {
                            $collSysUserParams[] = $obj;
                        }
                    }
                }

                $this->collSysUserParams = $collSysUserParams;
                $this->collSysUserParamsPartial = false;
            }
        }

        return $this->collSysUserParams;
    }

    /**
     * Sets a collection of ChildSysUserParam objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysUserParams A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysUserParams(Collection $sysUserParams, ConnectionInterface $con = null)
    {
        /** @var ChildSysUserParam[] $sysUserParamsToDelete */
        $sysUserParamsToDelete = $this->getSysUserParams(new Criteria(), $con)->diff($sysUserParams);


        $this->sysUserParamsScheduledForDeletion = $sysUserParamsToDelete;

        foreach ($sysUserParamsToDelete as $sysUserParamRemoved) {
            $sysUserParamRemoved->setSysUser(null);
        }

        $this->collSysUserParams = null;
        foreach ($sysUserParams as $sysUserParam) {
            $this->addSysUserParam($sysUserParam);
        }

        $this->collSysUserParams = $sysUserParams;
        $this->collSysUserParamsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysUserParam objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysUserParam objects.
     * @throws PropelException
     */
    public function countSysUserParams(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysUserParamsPartial && !$this->isNew();
        if (null === $this->collSysUserParams || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysUserParams) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysUserParams());
            }

            $query = ChildSysUserParamQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysUserParams);
    }

    /**
     * Method called to associate a ChildSysUserParam object to this object
     * through the ChildSysUserParam foreign key attribute.
     *
     * @param  ChildSysUserParam $l ChildSysUserParam
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysUserParam(ChildSysUserParam $l)
    {
        if ($this->collSysUserParams === null) {
            $this->initSysUserParams();
            $this->collSysUserParamsPartial = true;
        }

        if (!$this->collSysUserParams->contains($l)) {
            $this->doAddSysUserParam($l);

            if ($this->sysUserParamsScheduledForDeletion and $this->sysUserParamsScheduledForDeletion->contains($l)) {
                $this->sysUserParamsScheduledForDeletion->remove($this->sysUserParamsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysUserParam $sysUserParam The ChildSysUserParam object to add.
     */
    protected function doAddSysUserParam(ChildSysUserParam $sysUserParam)
    {
        $this->collSysUserParams[]= $sysUserParam;
        $sysUserParam->setSysUser($this);
    }

    /**
     * @param  ChildSysUserParam $sysUserParam The ChildSysUserParam object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysUserParam(ChildSysUserParam $sysUserParam)
    {
        if ($this->getSysUserParams()->contains($sysUserParam)) {
            $pos = $this->collSysUserParams->search($sysUserParam);
            $this->collSysUserParams->remove($pos);
            if (null === $this->sysUserParamsScheduledForDeletion) {
                $this->sysUserParamsScheduledForDeletion = clone $this->collSysUserParams;
                $this->sysUserParamsScheduledForDeletion->clear();
            }
            $this->sysUserParamsScheduledForDeletion[]= clone $sysUserParam;
            $sysUserParam->setSysUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related SysUserParams from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysUserParam[] List of ChildSysUserParam objects
     */
    public function getSysUserParamsJoinSysParam(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysUserParamQuery::create(null, $criteria);
        $query->joinWith('SysParam', $joinBehavior);

        return $this->getSysUserParams($query, $con);
    }

    /**
     * Clears out the collSysUserXRols collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysUserXRols()
     */
    public function clearSysUserXRols()
    {
        $this->collSysUserXRols = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysUserXRols collection loaded partially.
     */
    public function resetPartialSysUserXRols($v = true)
    {
        $this->collSysUserXRolsPartial = $v;
    }

    /**
     * Initializes the collSysUserXRols collection.
     *
     * By default this just sets the collSysUserXRols collection to an empty array (like clearcollSysUserXRols());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysUserXRols($overrideExisting = true)
    {
        if (null !== $this->collSysUserXRols && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysUserXRolTableMap::getTableMap()->getCollectionClassName();

        $this->collSysUserXRols = new $collectionClassName;
        $this->collSysUserXRols->setModel('\SysUserXRol');
    }

    /**
     * Gets an array of ChildSysUserXRol objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysUserXRol[] List of ChildSysUserXRol objects
     * @throws PropelException
     */
    public function getSysUserXRols(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysUserXRolsPartial && !$this->isNew();
        if (null === $this->collSysUserXRols || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysUserXRols) {
                // return empty collection
                $this->initSysUserXRols();
            } else {
                $collSysUserXRols = ChildSysUserXRolQuery::create(null, $criteria)
                    ->filterBySysUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysUserXRolsPartial && count($collSysUserXRols)) {
                        $this->initSysUserXRols(false);

                        foreach ($collSysUserXRols as $obj) {
                            if (false == $this->collSysUserXRols->contains($obj)) {
                                $this->collSysUserXRols->append($obj);
                            }
                        }

                        $this->collSysUserXRolsPartial = true;
                    }

                    return $collSysUserXRols;
                }

                if ($partial && $this->collSysUserXRols) {
                    foreach ($this->collSysUserXRols as $obj) {
                        if ($obj->isNew()) {
                            $collSysUserXRols[] = $obj;
                        }
                    }
                }

                $this->collSysUserXRols = $collSysUserXRols;
                $this->collSysUserXRolsPartial = false;
            }
        }

        return $this->collSysUserXRols;
    }

    /**
     * Sets a collection of ChildSysUserXRol objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysUserXRols A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function setSysUserXRols(Collection $sysUserXRols, ConnectionInterface $con = null)
    {
        /** @var ChildSysUserXRol[] $sysUserXRolsToDelete */
        $sysUserXRolsToDelete = $this->getSysUserXRols(new Criteria(), $con)->diff($sysUserXRols);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->sysUserXRolsScheduledForDeletion = clone $sysUserXRolsToDelete;

        foreach ($sysUserXRolsToDelete as $sysUserXRolRemoved) {
            $sysUserXRolRemoved->setSysUser(null);
        }

        $this->collSysUserXRols = null;
        foreach ($sysUserXRols as $sysUserXRol) {
            $this->addSysUserXRol($sysUserXRol);
        }

        $this->collSysUserXRols = $sysUserXRols;
        $this->collSysUserXRolsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysUserXRol objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysUserXRol objects.
     * @throws PropelException
     */
    public function countSysUserXRols(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysUserXRolsPartial && !$this->isNew();
        if (null === $this->collSysUserXRols || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysUserXRols) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysUserXRols());
            }

            $query = ChildSysUserXRolQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUser($this)
                ->count($con);
        }

        return count($this->collSysUserXRols);
    }

    /**
     * Method called to associate a ChildSysUserXRol object to this object
     * through the ChildSysUserXRol foreign key attribute.
     *
     * @param  ChildSysUserXRol $l ChildSysUserXRol
     * @return $this|\SysUser The current object (for fluent API support)
     */
    public function addSysUserXRol(ChildSysUserXRol $l)
    {
        if ($this->collSysUserXRols === null) {
            $this->initSysUserXRols();
            $this->collSysUserXRolsPartial = true;
        }

        if (!$this->collSysUserXRols->contains($l)) {
            $this->doAddSysUserXRol($l);

            if ($this->sysUserXRolsScheduledForDeletion and $this->sysUserXRolsScheduledForDeletion->contains($l)) {
                $this->sysUserXRolsScheduledForDeletion->remove($this->sysUserXRolsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysUserXRol $sysUserXRol The ChildSysUserXRol object to add.
     */
    protected function doAddSysUserXRol(ChildSysUserXRol $sysUserXRol)
    {
        $this->collSysUserXRols[]= $sysUserXRol;
        $sysUserXRol->setSysUser($this);
    }

    /**
     * @param  ChildSysUserXRol $sysUserXRol The ChildSysUserXRol object to remove.
     * @return $this|ChildSysUser The current object (for fluent API support)
     */
    public function removeSysUserXRol(ChildSysUserXRol $sysUserXRol)
    {
        if ($this->getSysUserXRols()->contains($sysUserXRol)) {
            $pos = $this->collSysUserXRols->search($sysUserXRol);
            $this->collSysUserXRols->remove($pos);
            if (null === $this->sysUserXRolsScheduledForDeletion) {
                $this->sysUserXRolsScheduledForDeletion = clone $this->collSysUserXRols;
                $this->sysUserXRolsScheduledForDeletion->clear();
            }
            $this->sysUserXRolsScheduledForDeletion[]= clone $sysUserXRol;
            $sysUserXRol->setSysUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUser is new, it will return
     * an empty collection; or if this SysUser has previously
     * been saved, it will retrieve related SysUserXRols from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysUserXRol[] List of ChildSysUserXRol objects
     */
    public function getSysUserXRolsJoinSysRol(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysUserXRolQuery::create(null, $criteria);
        $query->joinWith('SysRol', $joinBehavior);

        return $this->getSysUserXRols($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->email = null;
        $this->username = null;
        $this->password = null;
        $this->status = null;
        $this->location = null;
        $this->address = null;
        $this->image_mime = null;
        $this->actual_access = null;
        $this->last_access = null;
        $this->access_failures = null;
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
            if ($this->collJobUserEmpresaSuscritas) {
                foreach ($this->collJobUserEmpresaSuscritas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysAuths) {
                foreach ($this->collSysAuths as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysEmailSents) {
                foreach ($this->collSysEmailSents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysEntityUsers) {
                foreach ($this->collSysEntityUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysImages) {
                foreach ($this->collSysImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysPasswords) {
                foreach ($this->collSysPasswords as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysPasswordRequests) {
                foreach ($this->collSysPasswordRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSyspeople) {
                foreach ($this->collSyspeople as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysUserParams) {
                foreach ($this->collSysUserParams as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysUserXRols) {
                foreach ($this->collSysUserXRols as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collJobUserEmpresaSuscritas = null;
        $this->collSysAuths = null;
        $this->collSysEmailSents = null;
        $this->collSysEntityUsers = null;
        $this->collSysImages = null;
        $this->collSysPasswords = null;
        $this->collSysPasswordRequests = null;
        $this->collSyspeople = null;
        $this->collSysUserParams = null;
        $this->collSysUserXRols = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysUserTableMap::DEFAULT_STRING_FORMAT);
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
