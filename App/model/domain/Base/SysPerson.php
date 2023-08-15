<?php

namespace Base;

use \SysPersonQuery as ChildSysPersonQuery;
use \SysUser as ChildSysUser;
use \SysUserQuery as ChildSysUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\SysPersonTableMap;
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
 * Base class that represents a row from the 'sys_person' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class SysPerson implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Map\\SysPersonTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

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
     * @var        int|null
     */
    protected $location_id;

    /**
     * The value for the first_name field.
     *
     * @var        string
     */
    protected $first_name;

    /**
     * The value for the middle_name field.
     *
     * @var        string|null
     */
    protected $middle_name;

    /**
     * The value for the last_name field.
     *
     * @var        string
     */
    protected $last_name;

    /**
     * The value for the second_last_name field.
     *
     * @var        string|null
     */
    protected $second_last_name;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the id_number field.
     *
     * @var        string|null
     */
    protected $id_number;

    /**
     * The value for the id_extension field.
     *
     * @var        string|null
     */
    protected $id_extension;

    /**
     * The value for the gender field.
     *
     * @var        string|null
     */
    protected $gender;

    /**
     * The value for the date_of_birth field.
     *
     * @var        DateTime|null
     */
    protected $date_of_birth;

    /**
     * The value for the place_of_birth field.
     *
     * @var        string|null
     */
    protected $place_of_birth;

    /**
     * The value for the address field.
     *
     * @var        string|null
     */
    protected $address;

    /**
     * The value for the city field.
     *
     * @var        string|null
     */
    protected $city;

    /**
     * The value for the pob field.
     *
     * @var        string|null
     */
    protected $pob;

    /**
     * The value for the phone_home field.
     *
     * @var        string|null
     */
    protected $phone_home;

    /**
     * The value for the phone_work field.
     *
     * @var        string|null
     */
    protected $phone_work;

    /**
     * The value for the cellphone_1 field.
     *
     * @var        string|null
     */
    protected $cellphone_1;

    /**
     * The value for the cellphone_2 field.
     *
     * @var        string|null
     */
    protected $cellphone_2;

    /**
     * The value for the photo_mime field.
     *
     * @var        string|null
     */
    protected $photo_mime;

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
     * @var        DateTime|null
     */
    protected $modification_date;

    /**
     * @var        ChildSysUser
     */
    protected $aSysUser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->last_user_id = 0;
        $this->modification_date = PropelDateTime::newInstance(NULL, null, 'DateTime');
    }

    /**
     * Initializes internal state of Base\SysPerson object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>SysPerson</code> instance.  If
     * <code>obj</code> is an instance of <code>SysPerson</code>, delegates to
     * <code>equals(SysPerson)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
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
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
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
     * @return int|null
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [middle_name] column value.
     *
     * @return string|null
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [second_last_name] column value.
     *
     * @return string|null
     */
    public function getSecondLastName()
    {
        return $this->second_last_name;
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
     * Get the [id_number] column value.
     *
     * @return string|null
     */
    public function getIdNumber()
    {
        return $this->id_number;
    }

    /**
     * Get the [id_extension] column value.
     *
     * @return string|null
     */
    public function getIdExtension()
    {
        return $this->id_extension;
    }

    /**
     * Get the [gender] column value.
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the [optionally formatted] temporal [date_of_birth] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getDateOfBirth($format = null)
    {
        if ($format === null) {
            return $this->date_of_birth;
        } else {
            return $this->date_of_birth instanceof \DateTimeInterface ? $this->date_of_birth->format($format) : null;
        }
    }

    /**
     * Get the [place_of_birth] column value.
     *
     * @return string|null
     */
    public function getPlaceOfBirth()
    {
        return $this->place_of_birth;
    }

    /**
     * Get the [address] column value.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [city] column value.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [pob] column value.
     *
     * @return string|null
     */
    public function getPob()
    {
        return $this->pob;
    }

    /**
     * Get the [phone_home] column value.
     *
     * @return string|null
     */
    public function getPhoneHome()
    {
        return $this->phone_home;
    }

    /**
     * Get the [phone_work] column value.
     *
     * @return string|null
     */
    public function getPhoneWork()
    {
        return $this->phone_work;
    }

    /**
     * Get the [cellphone_1] column value.
     *
     * @return string|null
     */
    public function getCellphone1()
    {
        return $this->cellphone_1;
    }

    /**
     * Get the [cellphone_2] column value.
     *
     * @return string|null
     */
    public function getCellphone2()
    {
        return $this->cellphone_2;
    }

    /**
     * Get the [photo_mime] column value.
     *
     * @return string|null
     */
    public function getPhotoMime()
    {
        return $this->photo_mime;
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
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getCreationDate($format = null)
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
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getModificationDate($format = null)
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
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_USER_ID] = true;
        }

        if ($this->aSysUser !== null && $this->aSysUser->getId() !== $v) {
            $this->aSysUser = null;
        }

        return $this;
    }

    /**
     * Set the value of [location_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_LOCATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [middle_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMiddleName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->middle_name !== $v) {
            $this->middle_name = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_MIDDLE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [second_last_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSecondLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->second_last_name !== $v) {
            $this->second_last_name = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_SECOND_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [id_number] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id_number !== $v) {
            $this->id_number = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_ID_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [id_extension] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdExtension($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id_extension !== $v) {
            $this->id_extension = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_ID_EXTENSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gender] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_GENDER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [date_of_birth] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDateOfBirth($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_of_birth !== null || $dt !== null) {
            if ($this->date_of_birth === null || $dt === null || $dt->format("Y-m-d") !== $this->date_of_birth->format("Y-m-d")) {
                $this->date_of_birth = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysPersonTableMap::COL_DATE_OF_BIRTH] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [place_of_birth] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPlaceOfBirth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->place_of_birth !== $v) {
            $this->place_of_birth = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_PLACE_OF_BIRTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [city] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_CITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pob] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPob($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pob !== $v) {
            $this->pob = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_POB] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone_home] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhoneHome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_home !== $v) {
            $this->phone_home = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_PHONE_HOME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone_work] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhoneWork($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_work !== $v) {
            $this->phone_work = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_PHONE_WORK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cellphone_1] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCellphone1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cellphone_1 !== $v) {
            $this->cellphone_1 = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_CELLPHONE_1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cellphone_2] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCellphone2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cellphone_2 !== $v) {
            $this->cellphone_2 = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_CELLPHONE_2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [photo_mime] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhotoMime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->photo_mime !== $v) {
            $this->photo_mime = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_PHOTO_MIME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[SysPersonTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->creation_date->format("Y-m-d H:i:s.u")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysPersonTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ( ($dt != $this->modification_date) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s.u') === NULL) // or the entered value matches the default
                 ) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysPersonTableMap::COL_MODIFICATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->last_user_id !== 0) {
                return false;
            }

            if ($this->modification_date && $this->modification_date->format('Y-m-d H:i:s.u') !== NULL) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysPersonTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysPersonTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysPersonTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysPersonTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysPersonTableMap::translateFieldName('MiddleName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->middle_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysPersonTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysPersonTableMap::translateFieldName('SecondLastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->second_last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysPersonTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysPersonTableMap::translateFieldName('IdNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysPersonTableMap::translateFieldName('IdExtension', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_extension = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysPersonTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SysPersonTableMap::translateFieldName('DateOfBirth', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_of_birth = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SysPersonTableMap::translateFieldName('PlaceOfBirth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->place_of_birth = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SysPersonTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SysPersonTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SysPersonTableMap::translateFieldName('Pob', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pob = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SysPersonTableMap::translateFieldName('PhoneHome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone_home = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SysPersonTableMap::translateFieldName('PhoneWork', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone_work = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SysPersonTableMap::translateFieldName('Cellphone1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cellphone_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SysPersonTableMap::translateFieldName('Cellphone2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cellphone_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SysPersonTableMap::translateFieldName('PhotoMime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->photo_mime = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SysPersonTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SysPersonTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : SysPersonTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = SysPersonTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysPerson'), 0, $e);
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
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aSysUser !== null && $this->user_id !== $this->aSysUser->getId()) {
            $this->aSysUser = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysPersonTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysPersonQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSysUser = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SysPerson::setDeleted()
     * @see SysPerson::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPersonTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysPersonQuery::create()
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
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPersonTableMap::DATABASE_NAME);
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
                SysPersonTableMap::addInstanceToPool($this);
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
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
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

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[SysPersonTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysPersonTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysPersonTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'USER_ID';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LOCATION_ID';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'FIRST_NAME';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_MIDDLE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'MIDDLE_NAME';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_NAME';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_SECOND_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'SECOND_LAST_NAME';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_ID_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'ID_NUMBER';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_ID_EXTENSION)) {
            $modifiedColumns[':p' . $index++]  = 'ID_EXTENSION';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'GENDER';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_DATE_OF_BIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'DATE_OF_BIRTH';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PLACE_OF_BIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'PLACE_OF_BIRTH';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'ADDRESS';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'CITY';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_POB)) {
            $modifiedColumns[':p' . $index++]  = 'POB';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PHONE_HOME)) {
            $modifiedColumns[':p' . $index++]  = 'PHONE_HOME';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PHONE_WORK)) {
            $modifiedColumns[':p' . $index++]  = 'PHONE_WORK';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CELLPHONE_1)) {
            $modifiedColumns[':p' . $index++]  = 'CELLPHONE_1';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CELLPHONE_2)) {
            $modifiedColumns[':p' . $index++]  = 'CELLPHONE_2';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PHOTO_MIME)) {
            $modifiedColumns[':p' . $index++]  = 'PHOTO_MIME';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO sys_person (%s) VALUES (%s)',
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
                    case 'FIRST_NAME':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);

                        break;
                    case 'MIDDLE_NAME':
                        $stmt->bindValue($identifier, $this->middle_name, PDO::PARAM_STR);

                        break;
                    case 'LAST_NAME':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);

                        break;
                    case 'SECOND_LAST_NAME':
                        $stmt->bindValue($identifier, $this->second_last_name, PDO::PARAM_STR);

                        break;
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case 'ID_NUMBER':
                        $stmt->bindValue($identifier, $this->id_number, PDO::PARAM_STR);

                        break;
                    case 'ID_EXTENSION':
                        $stmt->bindValue($identifier, $this->id_extension, PDO::PARAM_STR);

                        break;
                    case 'GENDER':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);

                        break;
                    case 'DATE_OF_BIRTH':
                        $stmt->bindValue($identifier, $this->date_of_birth ? $this->date_of_birth->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'PLACE_OF_BIRTH':
                        $stmt->bindValue($identifier, $this->place_of_birth, PDO::PARAM_STR);

                        break;
                    case 'ADDRESS':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);

                        break;
                    case 'CITY':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);

                        break;
                    case 'POB':
                        $stmt->bindValue($identifier, $this->pob, PDO::PARAM_STR);

                        break;
                    case 'PHONE_HOME':
                        $stmt->bindValue($identifier, $this->phone_home, PDO::PARAM_STR);

                        break;
                    case 'PHONE_WORK':
                        $stmt->bindValue($identifier, $this->phone_work, PDO::PARAM_STR);

                        break;
                    case 'CELLPHONE_1':
                        $stmt->bindValue($identifier, $this->cellphone_1, PDO::PARAM_STR);

                        break;
                    case 'CELLPHONE_2':
                        $stmt->bindValue($identifier, $this->cellphone_2, PDO::PARAM_STR);

                        break;
                    case 'PHOTO_MIME':
                        $stmt->bindValue($identifier, $this->photo_mime, PDO::PARAM_STR);

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
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysPersonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();

            case 1:
                return $this->getUserId();

            case 2:
                return $this->getLocationId();

            case 3:
                return $this->getFirstName();

            case 4:
                return $this->getMiddleName();

            case 5:
                return $this->getLastName();

            case 6:
                return $this->getSecondLastName();

            case 7:
                return $this->getEmail();

            case 8:
                return $this->getIdNumber();

            case 9:
                return $this->getIdExtension();

            case 10:
                return $this->getGender();

            case 11:
                return $this->getDateOfBirth();

            case 12:
                return $this->getPlaceOfBirth();

            case 13:
                return $this->getAddress();

            case 14:
                return $this->getCity();

            case 15:
                return $this->getPob();

            case 16:
                return $this->getPhoneHome();

            case 17:
                return $this->getPhoneWork();

            case 18:
                return $this->getCellphone1();

            case 19:
                return $this->getCellphone2();

            case 20:
                return $this->getPhotoMime();

            case 21:
                return $this->getLastUserId();

            case 22:
                return $this->getCreationDate();

            case 23:
                return $this->getModificationDate();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['SysPerson'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SysPerson'][$this->hashCode()] = true;
        $keys = SysPersonTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getLocationId(),
            $keys[3] => $this->getFirstName(),
            $keys[4] => $this->getMiddleName(),
            $keys[5] => $this->getLastName(),
            $keys[6] => $this->getSecondLastName(),
            $keys[7] => $this->getEmail(),
            $keys[8] => $this->getIdNumber(),
            $keys[9] => $this->getIdExtension(),
            $keys[10] => $this->getGender(),
            $keys[11] => $this->getDateOfBirth(),
            $keys[12] => $this->getPlaceOfBirth(),
            $keys[13] => $this->getAddress(),
            $keys[14] => $this->getCity(),
            $keys[15] => $this->getPob(),
            $keys[16] => $this->getPhoneHome(),
            $keys[17] => $this->getPhoneWork(),
            $keys[18] => $this->getCellphone1(),
            $keys[19] => $this->getCellphone2(),
            $keys[20] => $this->getPhotoMime(),
            $keys[21] => $this->getLastUserId(),
            $keys[22] => $this->getCreationDate(),
            $keys[23] => $this->getModificationDate(),
        ];
        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d');
        }

        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('Y-m-d H:i:s.u');
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
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysPersonTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
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
                $this->setFirstName($value);
                break;
            case 4:
                $this->setMiddleName($value);
                break;
            case 5:
                $this->setLastName($value);
                break;
            case 6:
                $this->setSecondLastName($value);
                break;
            case 7:
                $this->setEmail($value);
                break;
            case 8:
                $this->setIdNumber($value);
                break;
            case 9:
                $this->setIdExtension($value);
                break;
            case 10:
                $this->setGender($value);
                break;
            case 11:
                $this->setDateOfBirth($value);
                break;
            case 12:
                $this->setPlaceOfBirth($value);
                break;
            case 13:
                $this->setAddress($value);
                break;
            case 14:
                $this->setCity($value);
                break;
            case 15:
                $this->setPob($value);
                break;
            case 16:
                $this->setPhoneHome($value);
                break;
            case 17:
                $this->setPhoneWork($value);
                break;
            case 18:
                $this->setCellphone1($value);
                break;
            case 19:
                $this->setCellphone2($value);
                break;
            case 20:
                $this->setPhotoMime($value);
                break;
            case 21:
                $this->setLastUserId($value);
                break;
            case 22:
                $this->setCreationDate($value);
                break;
            case 23:
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
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = SysPersonTableMap::getFieldNames($keyType);

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
            $this->setFirstName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setMiddleName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLastName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSecondLastName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIdNumber($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setIdExtension($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setGender($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setDateOfBirth($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPlaceOfBirth($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setAddress($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCity($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPob($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPhoneHome($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setPhoneWork($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCellphone1($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCellphone2($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setPhotoMime($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setLastUserId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCreationDate($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setModificationDate($arr[$keys[23]]);
        }

        return $this;
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
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
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
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(SysPersonTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysPersonTableMap::COL_ID)) {
            $criteria->add(SysPersonTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_USER_ID)) {
            $criteria->add(SysPersonTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_LOCATION_ID)) {
            $criteria->add(SysPersonTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_FIRST_NAME)) {
            $criteria->add(SysPersonTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_MIDDLE_NAME)) {
            $criteria->add(SysPersonTableMap::COL_MIDDLE_NAME, $this->middle_name);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_LAST_NAME)) {
            $criteria->add(SysPersonTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_SECOND_LAST_NAME)) {
            $criteria->add(SysPersonTableMap::COL_SECOND_LAST_NAME, $this->second_last_name);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_EMAIL)) {
            $criteria->add(SysPersonTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_ID_NUMBER)) {
            $criteria->add(SysPersonTableMap::COL_ID_NUMBER, $this->id_number);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_ID_EXTENSION)) {
            $criteria->add(SysPersonTableMap::COL_ID_EXTENSION, $this->id_extension);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_GENDER)) {
            $criteria->add(SysPersonTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_DATE_OF_BIRTH)) {
            $criteria->add(SysPersonTableMap::COL_DATE_OF_BIRTH, $this->date_of_birth);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PLACE_OF_BIRTH)) {
            $criteria->add(SysPersonTableMap::COL_PLACE_OF_BIRTH, $this->place_of_birth);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_ADDRESS)) {
            $criteria->add(SysPersonTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CITY)) {
            $criteria->add(SysPersonTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_POB)) {
            $criteria->add(SysPersonTableMap::COL_POB, $this->pob);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PHONE_HOME)) {
            $criteria->add(SysPersonTableMap::COL_PHONE_HOME, $this->phone_home);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PHONE_WORK)) {
            $criteria->add(SysPersonTableMap::COL_PHONE_WORK, $this->phone_work);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CELLPHONE_1)) {
            $criteria->add(SysPersonTableMap::COL_CELLPHONE_1, $this->cellphone_1);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CELLPHONE_2)) {
            $criteria->add(SysPersonTableMap::COL_CELLPHONE_2, $this->cellphone_2);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_PHOTO_MIME)) {
            $criteria->add(SysPersonTableMap::COL_PHOTO_MIME, $this->photo_mime);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_LAST_USER_ID)) {
            $criteria->add(SysPersonTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_CREATION_DATE)) {
            $criteria->add(SysPersonTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(SysPersonTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(SysPersonTableMap::COL_MODIFICATION_DATE, $this->modification_date);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildSysPersonQuery::create();
        $criteria->add(SysPersonTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
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
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \SysPerson (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUserId($this->getUserId());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setMiddleName($this->getMiddleName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setSecondLastName($this->getSecondLastName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setIdNumber($this->getIdNumber());
        $copyObj->setIdExtension($this->getIdExtension());
        $copyObj->setGender($this->getGender());
        $copyObj->setDateOfBirth($this->getDateOfBirth());
        $copyObj->setPlaceOfBirth($this->getPlaceOfBirth());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setCity($this->getCity());
        $copyObj->setPob($this->getPob());
        $copyObj->setPhoneHome($this->getPhoneHome());
        $copyObj->setPhoneWork($this->getPhoneWork());
        $copyObj->setCellphone1($this->getCellphone1());
        $copyObj->setCellphone2($this->getCellphone2());
        $copyObj->setPhotoMime($this->getPhotoMime());
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
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \SysPerson Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
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
     * @param ChildSysUser $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
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
            $v->addSysPerson($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSysUser object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSysUser The associated ChildSysUser object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSysUser(?ConnectionInterface $con = null)
    {
        if ($this->aSysUser === null && ($this->user_id != 0)) {
            $this->aSysUser = ChildSysUserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSysUser->addSyspeople($this);
             */
        }

        return $this->aSysUser;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aSysUser) {
            $this->aSysUser->removeSysPerson($this);
        }
        $this->id = null;
        $this->user_id = null;
        $this->location_id = null;
        $this->first_name = null;
        $this->middle_name = null;
        $this->last_name = null;
        $this->second_last_name = null;
        $this->email = null;
        $this->id_number = null;
        $this->id_extension = null;
        $this->gender = null;
        $this->date_of_birth = null;
        $this->place_of_birth = null;
        $this->address = null;
        $this->city = null;
        $this->pob = null;
        $this->phone_home = null;
        $this->phone_work = null;
        $this->cellphone_1 = null;
        $this->cellphone_2 = null;
        $this->photo_mime = null;
        $this->last_user_id = null;
        $this->creation_date = null;
        $this->modification_date = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aSysUser = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysPersonTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
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
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
