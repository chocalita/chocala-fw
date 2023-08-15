<?php

namespace Base;

use \SysEmail as ChildSysEmail;
use \SysEmailQuery as ChildSysEmailQuery;
use \SysEmailSent as ChildSysEmailSent;
use \SysEmailSentQuery as ChildSysEmailSentQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\SysEmailSentTableMap;
use Map\SysEmailTableMap;
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
 * Base class that represents a row from the 'sys_email' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class SysEmail implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Map\\SysEmailTableMap';


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
     * The value for the code field.
     *
     * @var        string
     */
    protected $code;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the from_email field.
     *
     * @var        string
     */
    protected $from_email;

    /**
     * The value for the from_name field.
     *
     * @var        string
     */
    protected $from_name;

    /**
     * The value for the cc field.
     *
     * @var        string|null
     */
    protected $cc;

    /**
     * The value for the bcc field.
     *
     * @var        string|null
     */
    protected $bcc;

    /**
     * The value for the subject field.
     *
     * @var        string
     */
    protected $subject;

    /**
     * The value for the body field.
     *
     * @var        string
     */
    protected $body;

    /**
     * The value for the attachments field.
     *
     * @var        string|null
     */
    protected $attachments;

    /**
     * The value for the template field.
     *
     * @var        string|null
     */
    protected $template;

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
     * @var        DateTime|null
     */
    protected $modification_date;

    /**
     * @var        ObjectCollection|ChildSysEmailSent[] Collection to store aggregation of ChildSysEmailSent objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSysEmailSent> Collection to store aggregation of ChildSysEmailSent objects.
     */
    protected $collSysEmailSents;
    protected $collSysEmailSentsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysEmailSent[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSysEmailSent>
     */
    protected $sysEmailSentsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->last_user_id = 0;
    }

    /**
     * Initializes internal state of Base\SysEmail object.
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
     * Compares this with another <code>SysEmail</code> instance.  If
     * <code>obj</code> is an instance of <code>SysEmail</code>, delegates to
     * <code>equals(SysEmail)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [code] column value.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [from_email] column value.
     *
     * @return string
     */
    public function getFromEmail()
    {
        return $this->from_email;
    }

    /**
     * Get the [from_name] column value.
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->from_name;
    }

    /**
     * Get the [cc] column value.
     *
     * @return string|null
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Get the [bcc] column value.
     *
     * @return string|null
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Get the [subject] column value.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get the [body] column value.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get the [attachments] column value.
     *
     * @return string|null
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Get the [template] column value.
     *
     * @return string|null
     */
    public function getTemplate()
    {
        return $this->template;
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
            $this->modifiedColumns[SysEmailTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [code] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFromEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_email !== $v) {
            $this->from_email = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_FROM_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFromName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_name !== $v) {
            $this->from_name = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_FROM_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cc] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cc !== $v) {
            $this->cc = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_CC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [bcc] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBcc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bcc !== $v) {
            $this->bcc = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_BCC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [subject] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSubject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subject !== $v) {
            $this->subject = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_SUBJECT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [body] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->body !== $v) {
            $this->body = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_BODY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [attachments] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAttachments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->attachments !== $v) {
            $this->attachments = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_ATTACHMENTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [template] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTemplate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->template !== $v) {
            $this->template = $v;
            $this->modifiedColumns[SysEmailTableMap::COL_TEMPLATE] = true;
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
            $this->modifiedColumns[SysEmailTableMap::COL_LAST_USER_ID] = true;
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
                $this->modifiedColumns[SysEmailTableMap::COL_CREATION_DATE] = true;
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
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->modification_date->format("Y-m-d H:i:s.u")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysEmailTableMap::COL_MODIFICATION_DATE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysEmailTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysEmailTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysEmailTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysEmailTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysEmailTableMap::translateFieldName('FromEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysEmailTableMap::translateFieldName('FromName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysEmailTableMap::translateFieldName('Cc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysEmailTableMap::translateFieldName('Bcc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bcc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysEmailTableMap::translateFieldName('Subject', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subject = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysEmailTableMap::translateFieldName('Body', TableMap::TYPE_PHPNAME, $indexType)];
            $this->body = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysEmailTableMap::translateFieldName('Attachments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attachments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SysEmailTableMap::translateFieldName('Template', TableMap::TYPE_PHPNAME, $indexType)];
            $this->template = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SysEmailTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SysEmailTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SysEmailTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = SysEmailTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysEmail'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SysEmailTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysEmailQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSysEmailSents = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SysEmail::setDeleted()
     * @see SysEmail::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysEmailQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailTableMap::DATABASE_NAME);
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
                SysEmailTableMap::addInstanceToPool($this);
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

            if ($this->sysEmailSentsScheduledForDeletion !== null) {
                if (!$this->sysEmailSentsScheduledForDeletion->isEmpty()) {
                    \SysEmailSentQuery::create()
                        ->filterByPrimaryKeys($this->sysEmailSentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

        $this->modifiedColumns[SysEmailTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysEmailTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysEmailTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'CODE';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'NAME';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPTION';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_FROM_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'FROM_EMAIL';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_FROM_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'FROM_NAME';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_CC)) {
            $modifiedColumns[':p' . $index++]  = 'CC';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_BCC)) {
            $modifiedColumns[':p' . $index++]  = 'BCC';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = 'SUBJECT';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_BODY)) {
            $modifiedColumns[':p' . $index++]  = 'BODY';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_ATTACHMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'ATTACHMENTS';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = 'TEMPLATE';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICATION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO sys_email (%s) VALUES (%s)',
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
                    case 'CODE':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);

                        break;
                    case 'NAME':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'DESCRIPTION':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case 'FROM_EMAIL':
                        $stmt->bindValue($identifier, $this->from_email, PDO::PARAM_STR);

                        break;
                    case 'FROM_NAME':
                        $stmt->bindValue($identifier, $this->from_name, PDO::PARAM_STR);

                        break;
                    case 'CC':
                        $stmt->bindValue($identifier, $this->cc, PDO::PARAM_STR);

                        break;
                    case 'BCC':
                        $stmt->bindValue($identifier, $this->bcc, PDO::PARAM_STR);

                        break;
                    case 'SUBJECT':
                        $stmt->bindValue($identifier, $this->subject, PDO::PARAM_STR);

                        break;
                    case 'BODY':
                        $stmt->bindValue($identifier, $this->body, PDO::PARAM_STR);

                        break;
                    case 'ATTACHMENTS':
                        $stmt->bindValue($identifier, $this->attachments, PDO::PARAM_STR);

                        break;
                    case 'TEMPLATE':
                        $stmt->bindValue($identifier, $this->template, PDO::PARAM_STR);

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
        $pos = SysEmailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCode();

            case 2:
                return $this->getName();

            case 3:
                return $this->getDescription();

            case 4:
                return $this->getFromEmail();

            case 5:
                return $this->getFromName();

            case 6:
                return $this->getCc();

            case 7:
                return $this->getBcc();

            case 8:
                return $this->getSubject();

            case 9:
                return $this->getBody();

            case 10:
                return $this->getAttachments();

            case 11:
                return $this->getTemplate();

            case 12:
                return $this->getLastUserId();

            case 13:
                return $this->getCreationDate();

            case 14:
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
        if (isset($alreadyDumpedObjects['SysEmail'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SysEmail'][$this->hashCode()] = true;
        $keys = SysEmailTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getDescription(),
            $keys[4] => $this->getFromEmail(),
            $keys[5] => $this->getFromName(),
            $keys[6] => $this->getCc(),
            $keys[7] => $this->getBcc(),
            $keys[8] => $this->getSubject(),
            $keys[9] => $this->getBody(),
            $keys[10] => $this->getAttachments(),
            $keys[11] => $this->getTemplate(),
            $keys[12] => $this->getLastUserId(),
            $keys[13] => $this->getCreationDate(),
            $keys[14] => $this->getModificationDate(),
        ];
        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
        $pos = SysEmailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setCode($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setDescription($value);
                break;
            case 4:
                $this->setFromEmail($value);
                break;
            case 5:
                $this->setFromName($value);
                break;
            case 6:
                $this->setCc($value);
                break;
            case 7:
                $this->setBcc($value);
                break;
            case 8:
                $this->setSubject($value);
                break;
            case 9:
                $this->setBody($value);
                break;
            case 10:
                $this->setAttachments($value);
                break;
            case 11:
                $this->setTemplate($value);
                break;
            case 12:
                $this->setLastUserId($value);
                break;
            case 13:
                $this->setCreationDate($value);
                break;
            case 14:
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
        $keys = SysEmailTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCode($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFromEmail($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFromName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCc($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setBcc($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setSubject($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setBody($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setAttachments($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTemplate($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setLastUserId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCreationDate($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setModificationDate($arr[$keys[14]]);
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
        $criteria = new Criteria(SysEmailTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysEmailTableMap::COL_ID)) {
            $criteria->add(SysEmailTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_CODE)) {
            $criteria->add(SysEmailTableMap::COL_CODE, $this->code);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_NAME)) {
            $criteria->add(SysEmailTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_DESCRIPTION)) {
            $criteria->add(SysEmailTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_FROM_EMAIL)) {
            $criteria->add(SysEmailTableMap::COL_FROM_EMAIL, $this->from_email);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_FROM_NAME)) {
            $criteria->add(SysEmailTableMap::COL_FROM_NAME, $this->from_name);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_CC)) {
            $criteria->add(SysEmailTableMap::COL_CC, $this->cc);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_BCC)) {
            $criteria->add(SysEmailTableMap::COL_BCC, $this->bcc);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_SUBJECT)) {
            $criteria->add(SysEmailTableMap::COL_SUBJECT, $this->subject);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_BODY)) {
            $criteria->add(SysEmailTableMap::COL_BODY, $this->body);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_ATTACHMENTS)) {
            $criteria->add(SysEmailTableMap::COL_ATTACHMENTS, $this->attachments);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_TEMPLATE)) {
            $criteria->add(SysEmailTableMap::COL_TEMPLATE, $this->template);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_LAST_USER_ID)) {
            $criteria->add(SysEmailTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_CREATION_DATE)) {
            $criteria->add(SysEmailTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(SysEmailTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(SysEmailTableMap::COL_MODIFICATION_DATE, $this->modification_date);
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
        $criteria = ChildSysEmailQuery::create();
        $criteria->add(SysEmailTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \SysEmail (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setFromEmail($this->getFromEmail());
        $copyObj->setFromName($this->getFromName());
        $copyObj->setCc($this->getCc());
        $copyObj->setBcc($this->getBcc());
        $copyObj->setSubject($this->getSubject());
        $copyObj->setBody($this->getBody());
        $copyObj->setAttachments($this->getAttachments());
        $copyObj->setTemplate($this->getTemplate());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSysEmailSents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEmailSent($relObj->copy($deepCopy));
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
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \SysEmail Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('SysEmailSent' === $relationName) {
            $this->initSysEmailSents();
            return;
        }
    }

    /**
     * Clears out the collSysEmailSents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSysEmailSents()
     */
    public function clearSysEmailSents()
    {
        $this->collSysEmailSents = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSysEmailSents collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSysEmailSents($v = true): void
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
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysEmailSents(bool $overrideExisting = true): void
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
     * If this ChildSysEmail is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysEmailSent[] List of ChildSysEmailSent objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSysEmailSent> List of ChildSysEmailSent objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSysEmailSents(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSysEmailSentsPartial && !$this->isNew();
        if (null === $this->collSysEmailSents || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSysEmailSents) {
                    $this->initSysEmailSents();
                } else {
                    $collectionClassName = SysEmailSentTableMap::getTableMap()->getCollectionClassName();

                    $collSysEmailSents = new $collectionClassName;
                    $collSysEmailSents->setModel('\SysEmailSent');

                    return $collSysEmailSents;
                }
            } else {
                $collSysEmailSents = ChildSysEmailSentQuery::create(null, $criteria)
                    ->filterBySysEmail($this)
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
     * @param Collection $sysEmailSents A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSysEmailSents(Collection $sysEmailSents, ?ConnectionInterface $con = null)
    {
        /** @var ChildSysEmailSent[] $sysEmailSentsToDelete */
        $sysEmailSentsToDelete = $this->getSysEmailSents(new Criteria(), $con)->diff($sysEmailSents);


        $this->sysEmailSentsScheduledForDeletion = $sysEmailSentsToDelete;

        foreach ($sysEmailSentsToDelete as $sysEmailSentRemoved) {
            $sysEmailSentRemoved->setSysEmail(null);
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
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SysEmailSent objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSysEmailSents(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
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
                ->filterBySysEmail($this)
                ->count($con);
        }

        return count($this->collSysEmailSents);
    }

    /**
     * Method called to associate a ChildSysEmailSent object to this object
     * through the ChildSysEmailSent foreign key attribute.
     *
     * @param ChildSysEmailSent $l ChildSysEmailSent
     * @return $this The current object (for fluent API support)
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
    protected function doAddSysEmailSent(ChildSysEmailSent $sysEmailSent): void
    {
        $this->collSysEmailSents[]= $sysEmailSent;
        $sysEmailSent->setSysEmail($this);
    }

    /**
     * @param ChildSysEmailSent $sysEmailSent The ChildSysEmailSent object to remove.
     * @return $this The current object (for fluent API support)
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
            $this->sysEmailSentsScheduledForDeletion[]= clone $sysEmailSent;
            $sysEmailSent->setSysEmail(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysEmail is new, it will return
     * an empty collection; or if this SysEmail has previously
     * been saved, it will retrieve related SysEmailSents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysEmail.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysEmailSent[] List of ChildSysEmailSent objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSysEmailSent}> List of ChildSysEmailSent objects
     */
    public function getSysEmailSentsJoinSysUser(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysEmailSentQuery::create(null, $criteria);
        $query->joinWith('SysUser', $joinBehavior);

        return $this->getSysEmailSents($query, $con);
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
        $this->id = null;
        $this->code = null;
        $this->name = null;
        $this->description = null;
        $this->from_email = null;
        $this->from_name = null;
        $this->cc = null;
        $this->bcc = null;
        $this->subject = null;
        $this->body = null;
        $this->attachments = null;
        $this->template = null;
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
            if ($this->collSysEmailSents) {
                foreach ($this->collSysEmailSents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSysEmailSents = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysEmailTableMap::DEFAULT_STRING_FORMAT);
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
