<?php

namespace Base;

use \SysEntity as ChildSysEntity;
use \SysEntityBranch as ChildSysEntityBranch;
use \SysEntityBranchQuery as ChildSysEntityBranchQuery;
use \SysEntityParam as ChildSysEntityParam;
use \SysEntityParamQuery as ChildSysEntityParamQuery;
use \SysEntityQuery as ChildSysEntityQuery;
use \SysEntityType as ChildSysEntityType;
use \SysEntityTypeQuery as ChildSysEntityTypeQuery;
use \SysEntityUser as ChildSysEntityUser;
use \SysEntityUserQuery as ChildSysEntityUserQuery;
use \SysLocation as ChildSysLocation;
use \SysLocationQuery as ChildSysLocationQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\SysEntityBranchTableMap;
use Map\SysEntityParamTableMap;
use Map\SysEntityTableMap;
use Map\SysEntityUserTableMap;
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
 * Base class that represents a row from the 'sys_entity' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class SysEntity implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SysEntityTableMap';


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
     * The value for the entity_type_id field.
     *
     * @var        int
     */
    protected $entity_type_id;

    /**
     * The value for the location_id field.
     *
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the main_branch_id field.
     *
     * @var        int
     */
    protected $main_branch_id;

    /**
     * The value for the code field.
     *
     * @var        string
     */
    protected $code;

    /**
     * The value for the comercial_name field.
     *
     * @var        string
     */
    protected $comercial_name;

    /**
     * The value for the formal_name field.
     *
     * @var        string
     */
    protected $formal_name;

    /**
     * The value for the nit field.
     *
     * @var        string
     */
    protected $nit;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the phone field.
     *
     * @var        string
     */
    protected $phone;

    /**
     * The value for the cellphone field.
     *
     * @var        string
     */
    protected $cellphone;

    /**
     * The value for the activities field.
     *
     * @var        string
     */
    protected $activities;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the last_user_id field.
     *
     * @var        int
     */
    protected $last_user_id;

    /**
     * The value for the creation_date field.
     *
     * @var        \DateTime
     */
    protected $creation_date;

    /**
     * The value for the modificacion_date field.
     *
     * @var        \DateTime
     */
    protected $modificacion_date;

    /**
     * @var        ChildSysEntityType
     */
    protected $aSysEntityType;

    /**
     * @var        ChildSysLocation
     */
    protected $aSysLocation;

    /**
     * @var        ObjectCollection|ChildSysEntityBranch[] Collection to store aggregation of ChildSysEntityBranch objects.
     */
    protected $collSysEntityBranches;
    protected $collSysEntityBranchesPartial;

    /**
     * @var        ObjectCollection|ChildSysEntityParam[] Collection to store aggregation of ChildSysEntityParam objects.
     */
    protected $collSysEntityParams;
    protected $collSysEntityParamsPartial;

    /**
     * @var        ObjectCollection|ChildSysEntityUser[] Collection to store aggregation of ChildSysEntityUser objects.
     */
    protected $collSysEntityUsers;
    protected $collSysEntityUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEntityBranch[]
     */
    protected $sysEntityBranchesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEntityParam[]
     */
    protected $sysEntityParamsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEntityUser[]
     */
    protected $sysEntityUsersScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\SysEntity object.
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
     * Compares this with another <code>SysEntity</code> instance.  If
     * <code>obj</code> is an instance of <code>SysEntity</code>, delegates to
     * <code>equals(SysEntity)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SysEntity The current object, for fluid interface
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
     * Get the [entity_type_id] column value.
     *
     * @return int
     */
    public function getEntityTypeId()
    {
        return $this->entity_type_id;
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
     * Get the [main_branch_id] column value.
     *
     * @return int
     */
    public function getMainBranchId()
    {
        return $this->main_branch_id;
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
     * Get the [comercial_name] column value.
     *
     * @return string
     */
    public function getComercialName()
    {
        return $this->comercial_name;
    }

    /**
     * Get the [formal_name] column value.
     *
     * @return string
     */
    public function getFormalName()
    {
        return $this->formal_name;
    }

    /**
     * Get the [nit] column value.
     *
     * @return string
     */
    public function getNit()
    {
        return $this->nit;
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
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [cellphone] column value.
     *
     * @return string
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Get the [activities] column value.
     *
     * @return string
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Get the [optionally formatted] temporal [modificacion_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getModificacionDate($format = NULL)
    {
        if ($format === null) {
            return $this->modificacion_date;
        } else {
            return $this->modificacion_date instanceof \DateTime ? $this->modificacion_date->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [entity_type_id] column.
     *
     * @param int $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setEntityTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entity_type_id !== $v) {
            $this->entity_type_id = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_ENTITY_TYPE_ID] = true;
        }

        if ($this->aSysEntityType !== null && $this->aSysEntityType->getId() !== $v) {
            $this->aSysEntityType = null;
        }

        return $this;
    } // setEntityTypeId()

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_LOCATION_ID] = true;
        }

        if ($this->aSysLocation !== null && $this->aSysLocation->getId() !== $v) {
            $this->aSysLocation = null;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [main_branch_id] column.
     *
     * @param int $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setMainBranchId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->main_branch_id !== $v) {
            $this->main_branch_id = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_MAIN_BRANCH_ID] = true;
        }

        return $this;
    } // setMainBranchId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_CODE] = true;
        }

        return $this;
    } // setCode()

    /**
     * Set the value of [comercial_name] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setComercialName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comercial_name !== $v) {
            $this->comercial_name = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_COMERCIAL_NAME] = true;
        }

        return $this;
    } // setComercialName()

    /**
     * Set the value of [formal_name] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setFormalName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->formal_name !== $v) {
            $this->formal_name = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_FORMAL_NAME] = true;
        }

        return $this;
    } // setFormalName()

    /**
     * Set the value of [nit] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setNit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nit !== $v) {
            $this->nit = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_NIT] = true;
        }

        return $this;
    } // setNit()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [cellphone] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setCellphone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cellphone !== $v) {
            $this->cellphone = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_CELLPHONE] = true;
        }

        return $this;
    } // setCellphone()

    /**
     * Set the value of [activities] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setActivities($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->activities !== $v) {
            $this->activities = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_ACTIVITIES] = true;
        }

        return $this;
    } // setActivities()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [last_user_id] column.
     *
     * @param int $v new value
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[SysEntityTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysEntityTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modificacion_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function setModificacionDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modificacion_date !== null || $dt !== null) {
            if ($this->modificacion_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->modificacion_date->format("Y-m-d H:i:s")) {
                $this->modificacion_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysEntityTableMap::COL_MODIFICACION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setModificacionDate()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysEntityTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysEntityTableMap::translateFieldName('EntityTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entity_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysEntityTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysEntityTableMap::translateFieldName('MainBranchId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->main_branch_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysEntityTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysEntityTableMap::translateFieldName('ComercialName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comercial_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysEntityTableMap::translateFieldName('FormalName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->formal_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysEntityTableMap::translateFieldName('Nit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysEntityTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysEntityTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysEntityTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SysEntityTableMap::translateFieldName('Cellphone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cellphone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SysEntityTableMap::translateFieldName('Activities', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activities = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SysEntityTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SysEntityTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SysEntityTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SysEntityTableMap::translateFieldName('ModificacionDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modificacion_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = SysEntityTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysEntity'), 0, $e);
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
        if ($this->aSysEntityType !== null && $this->entity_type_id !== $this->aSysEntityType->getId()) {
            $this->aSysEntityType = null;
        }
        if ($this->aSysLocation !== null && $this->location_id !== $this->aSysLocation->getId()) {
            $this->aSysLocation = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysEntityQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSysEntityType = null;
            $this->aSysLocation = null;
            $this->collSysEntityBranches = null;

            $this->collSysEntityParams = null;

            $this->collSysEntityUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SysEntity::setDeleted()
     * @see SysEntity::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysEntityQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
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
                SysEntityTableMap::addInstanceToPool($this);
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

            if ($this->aSysEntityType !== null) {
                if ($this->aSysEntityType->isModified() || $this->aSysEntityType->isNew()) {
                    $affectedRows += $this->aSysEntityType->save($con);
                }
                $this->setSysEntityType($this->aSysEntityType);
            }

            if ($this->aSysLocation !== null) {
                if ($this->aSysLocation->isModified() || $this->aSysLocation->isNew()) {
                    $affectedRows += $this->aSysLocation->save($con);
                }
                $this->setSysLocation($this->aSysLocation);
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

            if ($this->sysEntityParamsScheduledForDeletion !== null) {
                if (!$this->sysEntityParamsScheduledForDeletion->isEmpty()) {
                    \SysEntityParamQuery::create()
                        ->filterByPrimaryKeys($this->sysEntityParamsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysEntityParamsScheduledForDeletion = null;
                }
            }

            if ($this->collSysEntityParams !== null) {
                foreach ($this->collSysEntityParams as $referrerFK) {
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

        $this->modifiedColumns[SysEntityTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysEntityTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysEntityTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_ENTITY_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ENTITY_TYPE_ID';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LOCATION_ID';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_MAIN_BRANCH_ID)) {
            $modifiedColumns[':p' . $index++]  = 'MAIN_BRANCH_ID';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'CODE';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_COMERCIAL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'COMERCIAL_NAME';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_FORMAL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'FORMAL_NAME';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_NIT)) {
            $modifiedColumns[':p' . $index++]  = 'NIT';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'ADDRESS';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'PHONE';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_CELLPHONE)) {
            $modifiedColumns[':p' . $index++]  = 'CELLPHONE';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_ACTIVITIES)) {
            $modifiedColumns[':p' . $index++]  = 'ACTIVITIES';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPTION';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_MODIFICACION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICACION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO sys_entity (%s) VALUES (%s)',
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
                    case 'ENTITY_TYPE_ID':
                        $stmt->bindValue($identifier, $this->entity_type_id, PDO::PARAM_INT);
                        break;
                    case 'LOCATION_ID':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case 'MAIN_BRANCH_ID':
                        $stmt->bindValue($identifier, $this->main_branch_id, PDO::PARAM_INT);
                        break;
                    case 'CODE':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
                        break;
                    case 'COMERCIAL_NAME':
                        $stmt->bindValue($identifier, $this->comercial_name, PDO::PARAM_STR);
                        break;
                    case 'FORMAL_NAME':
                        $stmt->bindValue($identifier, $this->formal_name, PDO::PARAM_STR);
                        break;
                    case 'NIT':
                        $stmt->bindValue($identifier, $this->nit, PDO::PARAM_STR);
                        break;
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'ADDRESS':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'PHONE':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'CELLPHONE':
                        $stmt->bindValue($identifier, $this->cellphone, PDO::PARAM_STR);
                        break;
                    case 'ACTIVITIES':
                        $stmt->bindValue($identifier, $this->activities, PDO::PARAM_STR);
                        break;
                    case 'DESCRIPTION':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'LAST_USER_ID':
                        $stmt->bindValue($identifier, $this->last_user_id, PDO::PARAM_INT);
                        break;
                    case 'CREATION_DATE':
                        $stmt->bindValue($identifier, $this->creation_date ? $this->creation_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'MODIFICACION_DATE':
                        $stmt->bindValue($identifier, $this->modificacion_date ? $this->modificacion_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = SysEntityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEntityTypeId();
                break;
            case 2:
                return $this->getLocationId();
                break;
            case 3:
                return $this->getMainBranchId();
                break;
            case 4:
                return $this->getCode();
                break;
            case 5:
                return $this->getComercialName();
                break;
            case 6:
                return $this->getFormalName();
                break;
            case 7:
                return $this->getNit();
                break;
            case 8:
                return $this->getEmail();
                break;
            case 9:
                return $this->getAddress();
                break;
            case 10:
                return $this->getPhone();
                break;
            case 11:
                return $this->getCellphone();
                break;
            case 12:
                return $this->getActivities();
                break;
            case 13:
                return $this->getDescription();
                break;
            case 14:
                return $this->getLastUserId();
                break;
            case 15:
                return $this->getCreationDate();
                break;
            case 16:
                return $this->getModificacionDate();
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

        if (isset($alreadyDumpedObjects['SysEntity'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SysEntity'][$this->hashCode()] = true;
        $keys = SysEntityTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEntityTypeId(),
            $keys[2] => $this->getLocationId(),
            $keys[3] => $this->getMainBranchId(),
            $keys[4] => $this->getCode(),
            $keys[5] => $this->getComercialName(),
            $keys[6] => $this->getFormalName(),
            $keys[7] => $this->getNit(),
            $keys[8] => $this->getEmail(),
            $keys[9] => $this->getAddress(),
            $keys[10] => $this->getPhone(),
            $keys[11] => $this->getCellphone(),
            $keys[12] => $this->getActivities(),
            $keys[13] => $this->getDescription(),
            $keys[14] => $this->getLastUserId(),
            $keys[15] => $this->getCreationDate(),
            $keys[16] => $this->getModificacionDate(),
        );
        if ($result[$keys[15]] instanceof \DateTime) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }

        if ($result[$keys[16]] instanceof \DateTime) {
            $result[$keys[16]] = $result[$keys[16]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSysEntityType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysEntityType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_entity_type';
                        break;
                    default:
                        $key = 'SysEntityType';
                }

                $result[$key] = $this->aSysEntityType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSysLocation) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysLocation';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_location';
                        break;
                    default:
                        $key = 'SysLocation';
                }

                $result[$key] = $this->aSysLocation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collSysEntityParams) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysEntityParams';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_entity_params';
                        break;
                    default:
                        $key = 'SysEntityParams';
                }

                $result[$key] = $this->collSysEntityParams->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\SysEntity
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysEntityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SysEntity
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setEntityTypeId($value);
                break;
            case 2:
                $this->setLocationId($value);
                break;
            case 3:
                $this->setMainBranchId($value);
                break;
            case 4:
                $this->setCode($value);
                break;
            case 5:
                $this->setComercialName($value);
                break;
            case 6:
                $this->setFormalName($value);
                break;
            case 7:
                $this->setNit($value);
                break;
            case 8:
                $this->setEmail($value);
                break;
            case 9:
                $this->setAddress($value);
                break;
            case 10:
                $this->setPhone($value);
                break;
            case 11:
                $this->setCellphone($value);
                break;
            case 12:
                $this->setActivities($value);
                break;
            case 13:
                $this->setDescription($value);
                break;
            case 14:
                $this->setLastUserId($value);
                break;
            case 15:
                $this->setCreationDate($value);
                break;
            case 16:
                $this->setModificacionDate($value);
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
        $keys = SysEntityTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEntityTypeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLocationId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMainBranchId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCode($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setComercialName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFormalName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNit($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEmail($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAddress($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPhone($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCellphone($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setActivities($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDescription($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setLastUserId($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCreationDate($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setModificacionDate($arr[$keys[16]]);
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
     * @return $this|\SysEntity The current object, for fluid interface
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
        $criteria = new Criteria(SysEntityTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysEntityTableMap::COL_ID)) {
            $criteria->add(SysEntityTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_ENTITY_TYPE_ID)) {
            $criteria->add(SysEntityTableMap::COL_ENTITY_TYPE_ID, $this->entity_type_id);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_LOCATION_ID)) {
            $criteria->add(SysEntityTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_MAIN_BRANCH_ID)) {
            $criteria->add(SysEntityTableMap::COL_MAIN_BRANCH_ID, $this->main_branch_id);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_CODE)) {
            $criteria->add(SysEntityTableMap::COL_CODE, $this->code);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_COMERCIAL_NAME)) {
            $criteria->add(SysEntityTableMap::COL_COMERCIAL_NAME, $this->comercial_name);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_FORMAL_NAME)) {
            $criteria->add(SysEntityTableMap::COL_FORMAL_NAME, $this->formal_name);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_NIT)) {
            $criteria->add(SysEntityTableMap::COL_NIT, $this->nit);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_EMAIL)) {
            $criteria->add(SysEntityTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_ADDRESS)) {
            $criteria->add(SysEntityTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_PHONE)) {
            $criteria->add(SysEntityTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_CELLPHONE)) {
            $criteria->add(SysEntityTableMap::COL_CELLPHONE, $this->cellphone);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_ACTIVITIES)) {
            $criteria->add(SysEntityTableMap::COL_ACTIVITIES, $this->activities);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_DESCRIPTION)) {
            $criteria->add(SysEntityTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_LAST_USER_ID)) {
            $criteria->add(SysEntityTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_CREATION_DATE)) {
            $criteria->add(SysEntityTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(SysEntityTableMap::COL_MODIFICACION_DATE)) {
            $criteria->add(SysEntityTableMap::COL_MODIFICACION_DATE, $this->modificacion_date);
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
        $criteria = ChildSysEntityQuery::create();
        $criteria->add(SysEntityTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \SysEntity (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEntityTypeId($this->getEntityTypeId());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setMainBranchId($this->getMainBranchId());
        $copyObj->setCode($this->getCode());
        $copyObj->setComercialName($this->getComercialName());
        $copyObj->setFormalName($this->getFormalName());
        $copyObj->setNit($this->getNit());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setCellphone($this->getCellphone());
        $copyObj->setActivities($this->getActivities());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificacionDate($this->getModificacionDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSysEntityBranches() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEntityBranch($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysEntityParams() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEntityParam($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysEntityUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEntityUser($relObj->copy($deepCopy));
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
     * @return \SysEntity Clone of current object.
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
     * Declares an association between this object and a ChildSysEntityType object.
     *
     * @param  ChildSysEntityType $v
     * @return $this|\SysEntity The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSysEntityType(ChildSysEntityType $v = null)
    {
        if ($v === null) {
            $this->setEntityTypeId(NULL);
        } else {
            $this->setEntityTypeId($v->getId());
        }

        $this->aSysEntityType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSysEntityType object, it will not be re-added.
        if ($v !== null) {
            $v->addSysEntity($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSysEntityType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSysEntityType The associated ChildSysEntityType object.
     * @throws PropelException
     */
    public function getSysEntityType(ConnectionInterface $con = null)
    {
        if ($this->aSysEntityType === null && ($this->entity_type_id !== null)) {
            $this->aSysEntityType = ChildSysEntityTypeQuery::create()->findPk($this->entity_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSysEntityType->addSysEntities($this);
             */
        }

        return $this->aSysEntityType;
    }

    /**
     * Declares an association between this object and a ChildSysLocation object.
     *
     * @param  ChildSysLocation $v
     * @return $this|\SysEntity The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSysLocation(ChildSysLocation $v = null)
    {
        if ($v === null) {
            $this->setLocationId(NULL);
        } else {
            $this->setLocationId($v->getId());
        }

        $this->aSysLocation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSysLocation object, it will not be re-added.
        if ($v !== null) {
            $v->addSysEntity($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSysLocation object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSysLocation The associated ChildSysLocation object.
     * @throws PropelException
     */
    public function getSysLocation(ConnectionInterface $con = null)
    {
        if ($this->aSysLocation === null && ($this->location_id !== null)) {
            $this->aSysLocation = ChildSysLocationQuery::create()->findPk($this->location_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSysLocation->addSysEntities($this);
             */
        }

        return $this->aSysLocation;
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
        if ('SysEntityBranch' == $relationName) {
            return $this->initSysEntityBranches();
        }
        if ('SysEntityParam' == $relationName) {
            return $this->initSysEntityParams();
        }
        if ('SysEntityUser' == $relationName) {
            return $this->initSysEntityUsers();
        }
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

        $collectionClassName = SysEntityBranchTableMap::getTableMap()->getCollectionClassName();

        $this->collSysEntityBranches = new $collectionClassName;
        $this->collSysEntityBranches->setModel('\SysEntityBranch');
    }

    /**
     * Gets an array of ChildSysEntityBranch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysEntity is new, it will return
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
                    ->filterBySysEntity($this)
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
     * @return $this|ChildSysEntity The current object (for fluent API support)
     */
    public function setSysEntityBranches(Collection $sysEntityBranches, ConnectionInterface $con = null)
    {
        /** @var ChildSysEntityBranch[] $sysEntityBranchesToDelete */
        $sysEntityBranchesToDelete = $this->getSysEntityBranches(new Criteria(), $con)->diff($sysEntityBranches);


        $this->sysEntityBranchesScheduledForDeletion = $sysEntityBranchesToDelete;

        foreach ($sysEntityBranchesToDelete as $sysEntityBranchRemoved) {
            $sysEntityBranchRemoved->setSysEntity(null);
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
                ->filterBySysEntity($this)
                ->count($con);
        }

        return count($this->collSysEntityBranches);
    }

    /**
     * Method called to associate a ChildSysEntityBranch object to this object
     * through the ChildSysEntityBranch foreign key attribute.
     *
     * @param  ChildSysEntityBranch $l ChildSysEntityBranch
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function addSysEntityBranch(ChildSysEntityBranch $l)
    {
        if ($this->collSysEntityBranches === null) {
            $this->initSysEntityBranches();
            $this->collSysEntityBranchesPartial = true;
        }

        if (!$this->collSysEntityBranches->contains($l)) {
            $this->doAddSysEntityBranch($l);

            if ($this->sysEntityBranchesScheduledForDeletion and $this->sysEntityBranchesScheduledForDeletion->contains($l)) {
                $this->sysEntityBranchesScheduledForDeletion->remove($this->sysEntityBranchesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysEntityBranch $sysEntityBranch The ChildSysEntityBranch object to add.
     */
    protected function doAddSysEntityBranch(ChildSysEntityBranch $sysEntityBranch)
    {
        $this->collSysEntityBranches[]= $sysEntityBranch;
        $sysEntityBranch->setSysEntity($this);
    }

    /**
     * @param  ChildSysEntityBranch $sysEntityBranch The ChildSysEntityBranch object to remove.
     * @return $this|ChildSysEntity The current object (for fluent API support)
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
            $sysEntityBranch->setSysEntity(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysEntity is new, it will return
     * an empty collection; or if this SysEntity has previously
     * been saved, it will retrieve related SysEntityBranches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysEntity.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEntityBranch[] List of ChildSysEntityBranch objects
     */
    public function getSysEntityBranchesJoinSysLocation(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEntityBranchQuery::create(null, $criteria);
        $query->joinWith('SysLocation', $joinBehavior);

        return $this->getSysEntityBranches($query, $con);
    }

    /**
     * Clears out the collSysEntityParams collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysEntityParams()
     */
    public function clearSysEntityParams()
    {
        $this->collSysEntityParams = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysEntityParams collection loaded partially.
     */
    public function resetPartialSysEntityParams($v = true)
    {
        $this->collSysEntityParamsPartial = $v;
    }

    /**
     * Initializes the collSysEntityParams collection.
     *
     * By default this just sets the collSysEntityParams collection to an empty array (like clearcollSysEntityParams());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysEntityParams($overrideExisting = true)
    {
        if (null !== $this->collSysEntityParams && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysEntityParamTableMap::getTableMap()->getCollectionClassName();

        $this->collSysEntityParams = new $collectionClassName;
        $this->collSysEntityParams->setModel('\SysEntityParam');
    }

    /**
     * Gets an array of ChildSysEntityParam objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysEntity is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysEntityParam[] List of ChildSysEntityParam objects
     * @throws PropelException
     */
    public function getSysEntityParams(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntityParamsPartial && !$this->isNew();
        if (null === $this->collSysEntityParams || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysEntityParams) {
                // return empty collection
                $this->initSysEntityParams();
            } else {
                $collSysEntityParams = ChildSysEntityParamQuery::create(null, $criteria)
                    ->filterBySysEntity($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysEntityParamsPartial && count($collSysEntityParams)) {
                        $this->initSysEntityParams(false);

                        foreach ($collSysEntityParams as $obj) {
                            if (false == $this->collSysEntityParams->contains($obj)) {
                                $this->collSysEntityParams->append($obj);
                            }
                        }

                        $this->collSysEntityParamsPartial = true;
                    }

                    return $collSysEntityParams;
                }

                if ($partial && $this->collSysEntityParams) {
                    foreach ($this->collSysEntityParams as $obj) {
                        if ($obj->isNew()) {
                            $collSysEntityParams[] = $obj;
                        }
                    }
                }

                $this->collSysEntityParams = $collSysEntityParams;
                $this->collSysEntityParamsPartial = false;
            }
        }

        return $this->collSysEntityParams;
    }

    /**
     * Sets a collection of ChildSysEntityParam objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysEntityParams A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysEntity The current object (for fluent API support)
     */
    public function setSysEntityParams(Collection $sysEntityParams, ConnectionInterface $con = null)
    {
        /** @var ChildSysEntityParam[] $sysEntityParamsToDelete */
        $sysEntityParamsToDelete = $this->getSysEntityParams(new Criteria(), $con)->diff($sysEntityParams);


        $this->sysEntityParamsScheduledForDeletion = $sysEntityParamsToDelete;

        foreach ($sysEntityParamsToDelete as $sysEntityParamRemoved) {
            $sysEntityParamRemoved->setSysEntity(null);
        }

        $this->collSysEntityParams = null;
        foreach ($sysEntityParams as $sysEntityParam) {
            $this->addSysEntityParam($sysEntityParam);
        }

        $this->collSysEntityParams = $sysEntityParams;
        $this->collSysEntityParamsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysEntityParam objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysEntityParam objects.
     * @throws PropelException
     */
    public function countSysEntityParams(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysEntityParamsPartial && !$this->isNew();
        if (null === $this->collSysEntityParams || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysEntityParams) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysEntityParams());
            }

            $query = ChildSysEntityParamQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysEntity($this)
                ->count($con);
        }

        return count($this->collSysEntityParams);
    }

    /**
     * Method called to associate a ChildSysEntityParam object to this object
     * through the ChildSysEntityParam foreign key attribute.
     *
     * @param  ChildSysEntityParam $l ChildSysEntityParam
     * @return $this|\SysEntity The current object (for fluent API support)
     */
    public function addSysEntityParam(ChildSysEntityParam $l)
    {
        if ($this->collSysEntityParams === null) {
            $this->initSysEntityParams();
            $this->collSysEntityParamsPartial = true;
        }

        if (!$this->collSysEntityParams->contains($l)) {
            $this->doAddSysEntityParam($l);

            if ($this->sysEntityParamsScheduledForDeletion and $this->sysEntityParamsScheduledForDeletion->contains($l)) {
                $this->sysEntityParamsScheduledForDeletion->remove($this->sysEntityParamsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysEntityParam $sysEntityParam The ChildSysEntityParam object to add.
     */
    protected function doAddSysEntityParam(ChildSysEntityParam $sysEntityParam)
    {
        $this->collSysEntityParams[]= $sysEntityParam;
        $sysEntityParam->setSysEntity($this);
    }

    /**
     * @param  ChildSysEntityParam $sysEntityParam The ChildSysEntityParam object to remove.
     * @return $this|ChildSysEntity The current object (for fluent API support)
     */
    public function removeSysEntityParam(ChildSysEntityParam $sysEntityParam)
    {
        if ($this->getSysEntityParams()->contains($sysEntityParam)) {
            $pos = $this->collSysEntityParams->search($sysEntityParam);
            $this->collSysEntityParams->remove($pos);
            if (null === $this->sysEntityParamsScheduledForDeletion) {
                $this->sysEntityParamsScheduledForDeletion = clone $this->collSysEntityParams;
                $this->sysEntityParamsScheduledForDeletion->clear();
            }
            $this->sysEntityParamsScheduledForDeletion[]= clone $sysEntityParam;
            $sysEntityParam->setSysEntity(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysEntity is new, it will return
     * an empty collection; or if this SysEntity has previously
     * been saved, it will retrieve related SysEntityParams from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysEntity.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEntityParam[] List of ChildSysEntityParam objects
     */
    public function getSysEntityParamsJoinSysParam(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEntityParamQuery::create(null, $criteria);
        $query->joinWith('SysParam', $joinBehavior);

        return $this->getSysEntityParams($query, $con);
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
     * If this ChildSysEntity is new, it will return
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
                    ->filterBySysEntity($this)
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
     * @return $this|ChildSysEntity The current object (for fluent API support)
     */
    public function setSysEntityUsers(Collection $sysEntityUsers, ConnectionInterface $con = null)
    {
        /** @var ChildSysEntityUser[] $sysEntityUsersToDelete */
        $sysEntityUsersToDelete = $this->getSysEntityUsers(new Criteria(), $con)->diff($sysEntityUsers);


        $this->sysEntityUsersScheduledForDeletion = $sysEntityUsersToDelete;

        foreach ($sysEntityUsersToDelete as $sysEntityUserRemoved) {
            $sysEntityUserRemoved->setSysEntity(null);
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
                ->filterBySysEntity($this)
                ->count($con);
        }

        return count($this->collSysEntityUsers);
    }

    /**
     * Method called to associate a ChildSysEntityUser object to this object
     * through the ChildSysEntityUser foreign key attribute.
     *
     * @param  ChildSysEntityUser $l ChildSysEntityUser
     * @return $this|\SysEntity The current object (for fluent API support)
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
        $sysEntityUser->setSysEntity($this);
    }

    /**
     * @param  ChildSysEntityUser $sysEntityUser The ChildSysEntityUser object to remove.
     * @return $this|ChildSysEntity The current object (for fluent API support)
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
            $sysEntityUser->setSysEntity(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysEntity is new, it will return
     * an empty collection; or if this SysEntity has previously
     * been saved, it will retrieve related SysEntityUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysEntity.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysEntity is new, it will return
     * an empty collection; or if this SysEntity has previously
     * been saved, it will retrieve related SysEntityUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysEntity.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEntityUser[] List of ChildSysEntityUser objects
     */
    public function getSysEntityUsersJoinSysUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEntityUserQuery::create(null, $criteria);
        $query->joinWith('SysUser', $joinBehavior);

        return $this->getSysEntityUsers($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSysEntityType) {
            $this->aSysEntityType->removeSysEntity($this);
        }
        if (null !== $this->aSysLocation) {
            $this->aSysLocation->removeSysEntity($this);
        }
        $this->id = null;
        $this->entity_type_id = null;
        $this->location_id = null;
        $this->main_branch_id = null;
        $this->code = null;
        $this->comercial_name = null;
        $this->formal_name = null;
        $this->nit = null;
        $this->email = null;
        $this->address = null;
        $this->phone = null;
        $this->cellphone = null;
        $this->activities = null;
        $this->description = null;
        $this->last_user_id = null;
        $this->creation_date = null;
        $this->modificacion_date = null;
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
            if ($this->collSysEntityBranches) {
                foreach ($this->collSysEntityBranches as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysEntityParams) {
                foreach ($this->collSysEntityParams as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysEntityUsers) {
                foreach ($this->collSysEntityUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSysEntityBranches = null;
        $this->collSysEntityParams = null;
        $this->collSysEntityUsers = null;
        $this->aSysEntityType = null;
        $this->aSysLocation = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysEntityTableMap::DEFAULT_STRING_FORMAT);
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
