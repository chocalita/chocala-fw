<?php

namespace Base;

use \SysEmail as ChildSysEmail;
use \SysEmailQuery as ChildSysEmailQuery;
use \SysEmailSentQuery as ChildSysEmailSentQuery;
use \SysUser as ChildSysUser;
use \SysUserQuery as ChildSysUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\SysEmailSentTableMap;
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
 * Base class that represents a row from the 'sys_email_sent' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class SysEmailSent implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SysEmailSentTableMap';


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
     * The value for the email_id field.
     *
     * @var        int
     */
    protected $email_id;

    /**
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the sender_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $sender_id;

    /**
     * The value for the hash_string field.
     *
     * @var        string
     */
    protected $hash_string;

    /**
     * The value for the from_name field.
     *
     * @var        string
     */
    protected $from_name;

    /**
     * The value for the from_email field.
     *
     * @var        string
     */
    protected $from_email;

    /**
     * The value for the to_email field.
     *
     * @var        string
     */
    protected $to_email;

    /**
     * The value for the cc field.
     *
     * @var        string
     */
    protected $cc;

    /**
     * The value for the bcc field.
     *
     * @var        string
     */
    protected $bcc;

    /**
     * The value for the subject field.
     *
     * @var        string
     */
    protected $subject;

    /**
     * The value for the content field.
     *
     * @var        string
     */
    protected $content;

    /**
     * The value for the is_success field.
     *
     * @var        boolean
     */
    protected $is_success;

    /**
     * The value for the shipping_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        \DateTime
     */
    protected $shipping_date;

    /**
     * The value for the opening_date field.
     *
     * @var        \DateTime
     */
    protected $opening_date;

    /**
     * @var        ChildSysEmail
     */
    protected $aSysEmail;

    /**
     * @var        ChildSysUser
     */
    protected $aSysUser;

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
        $this->sender_id = 0;
    }

    /**
     * Initializes internal state of Base\SysEmailSent object.
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
     * Compares this with another <code>SysEmailSent</code> instance.  If
     * <code>obj</code> is an instance of <code>SysEmailSent</code>, delegates to
     * <code>equals(SysEmailSent)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SysEmailSent The current object, for fluid interface
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
     * Get the [email_id] column value.
     *
     * @return int
     */
    public function getEmailId()
    {
        return $this->email_id;
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
     * Get the [sender_id] column value.
     *
     * @return int
     */
    public function getSenderId()
    {
        return $this->sender_id;
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
     * Get the [from_name] column value.
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->from_name;
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
     * Get the [to_email] column value.
     *
     * @return string
     */
    public function getToEmail()
    {
        return $this->to_email;
    }

    /**
     * Get the [cc] column value.
     *
     * @return string
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Get the [bcc] column value.
     *
     * @return string
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
     * Get the [content] column value.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the [is_success] column value.
     *
     * @return boolean
     */
    public function getIsSuccess()
    {
        return $this->is_success;
    }

    /**
     * Get the [is_success] column value.
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->getIsSuccess();
    }

    /**
     * Get the [optionally formatted] temporal [shipping_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getShippingDate($format = NULL)
    {
        if ($format === null) {
            return $this->shipping_date;
        } else {
            return $this->shipping_date instanceof \DateTime ? $this->shipping_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [opening_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getOpeningDate($format = NULL)
    {
        if ($format === null) {
            return $this->opening_date;
        } else {
            return $this->opening_date instanceof \DateTime ? $this->opening_date->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [email_id] column.
     *
     * @param int $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setEmailId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->email_id !== $v) {
            $this->email_id = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_EMAIL_ID] = true;
        }

        if ($this->aSysEmail !== null && $this->aSysEmail->getId() !== $v) {
            $this->aSysEmail = null;
        }

        return $this;
    } // setEmailId()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_USER_ID] = true;
        }

        if ($this->aSysUser !== null && $this->aSysUser->getId() !== $v) {
            $this->aSysUser = null;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [sender_id] column.
     *
     * @param int $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setSenderId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sender_id !== $v) {
            $this->sender_id = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_SENDER_ID] = true;
        }

        return $this;
    } // setSenderId()

    /**
     * Set the value of [hash_string] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setHashString($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hash_string !== $v) {
            $this->hash_string = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_HASH_STRING] = true;
        }

        return $this;
    } // setHashString()

    /**
     * Set the value of [from_name] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setFromName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_name !== $v) {
            $this->from_name = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_FROM_NAME] = true;
        }

        return $this;
    } // setFromName()

    /**
     * Set the value of [from_email] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setFromEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_email !== $v) {
            $this->from_email = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_FROM_EMAIL] = true;
        }

        return $this;
    } // setFromEmail()

    /**
     * Set the value of [to_email] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setToEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->to_email !== $v) {
            $this->to_email = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_TO_EMAIL] = true;
        }

        return $this;
    } // setToEmail()

    /**
     * Set the value of [cc] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setCc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cc !== $v) {
            $this->cc = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_CC] = true;
        }

        return $this;
    } // setCc()

    /**
     * Set the value of [bcc] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setBcc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bcc !== $v) {
            $this->bcc = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_BCC] = true;
        }

        return $this;
    } // setBcc()

    /**
     * Set the value of [subject] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setSubject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subject !== $v) {
            $this->subject = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_SUBJECT] = true;
        }

        return $this;
    } // setSubject()

    /**
     * Set the value of [content] column.
     *
     * @param string $v new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->content !== $v) {
            $this->content = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_CONTENT] = true;
        }

        return $this;
    } // setContent()

    /**
     * Sets the value of the [is_success] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setIsSuccess($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_success !== $v) {
            $this->is_success = $v;
            $this->modifiedColumns[SysEmailSentTableMap::COL_IS_SUCCESS] = true;
        }

        return $this;
    } // setIsSuccess()

    /**
     * Sets the value of [shipping_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setShippingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->shipping_date !== null || $dt !== null) {
            if ($this->shipping_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->shipping_date->format("Y-m-d H:i:s")) {
                $this->shipping_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysEmailSentTableMap::COL_SHIPPING_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setShippingDate()

    /**
     * Sets the value of [opening_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\SysEmailSent The current object (for fluent API support)
     */
    public function setOpeningDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->opening_date !== null || $dt !== null) {
            if ($this->opening_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->opening_date->format("Y-m-d H:i:s")) {
                $this->opening_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SysEmailSentTableMap::COL_OPENING_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setOpeningDate()

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
            if ($this->sender_id !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysEmailSentTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysEmailSentTableMap::translateFieldName('EmailId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysEmailSentTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysEmailSentTableMap::translateFieldName('SenderId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sender_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysEmailSentTableMap::translateFieldName('HashString', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hash_string = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysEmailSentTableMap::translateFieldName('FromName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysEmailSentTableMap::translateFieldName('FromEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysEmailSentTableMap::translateFieldName('ToEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysEmailSentTableMap::translateFieldName('Cc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysEmailSentTableMap::translateFieldName('Bcc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bcc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysEmailSentTableMap::translateFieldName('Subject', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subject = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SysEmailSentTableMap::translateFieldName('Content', TableMap::TYPE_PHPNAME, $indexType)];
            $this->content = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SysEmailSentTableMap::translateFieldName('IsSuccess', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_success = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SysEmailSentTableMap::translateFieldName('ShippingDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->shipping_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SysEmailSentTableMap::translateFieldName('OpeningDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->opening_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = SysEmailSentTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysEmailSent'), 0, $e);
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
        if ($this->aSysEmail !== null && $this->email_id !== $this->aSysEmail->getId()) {
            $this->aSysEmail = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(SysEmailSentTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysEmailSentQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSysEmail = null;
            $this->aSysUser = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SysEmailSent::setDeleted()
     * @see SysEmailSent::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailSentTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysEmailSentQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailSentTableMap::DATABASE_NAME);
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
                SysEmailSentTableMap::addInstanceToPool($this);
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

            if ($this->aSysEmail !== null) {
                if ($this->aSysEmail->isModified() || $this->aSysEmail->isNew()) {
                    $affectedRows += $this->aSysEmail->save($con);
                }
                $this->setSysEmail($this->aSysEmail);
            }

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

        $this->modifiedColumns[SysEmailSentTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysEmailSentTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysEmailSentTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_EMAIL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL_ID';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'USER_ID';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_SENDER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'SENDER_ID';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_HASH_STRING)) {
            $modifiedColumns[':p' . $index++]  = 'HASH_STRING';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_FROM_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'FROM_NAME';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_FROM_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'FROM_EMAIL';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_TO_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'TO_EMAIL';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_CC)) {
            $modifiedColumns[':p' . $index++]  = 'CC';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_BCC)) {
            $modifiedColumns[':p' . $index++]  = 'BCC';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = 'SUBJECT';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_CONTENT)) {
            $modifiedColumns[':p' . $index++]  = 'CONTENT';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_IS_SUCCESS)) {
            $modifiedColumns[':p' . $index++]  = 'IS_SUCCESS';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_SHIPPING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'SHIPPING_DATE';
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_OPENING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'OPENING_DATE';
        }

        $sql = sprintf(
            'INSERT INTO sys_email_sent (%s) VALUES (%s)',
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
                    case 'EMAIL_ID':
                        $stmt->bindValue($identifier, $this->email_id, PDO::PARAM_INT);
                        break;
                    case 'USER_ID':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'SENDER_ID':
                        $stmt->bindValue($identifier, $this->sender_id, PDO::PARAM_INT);
                        break;
                    case 'HASH_STRING':
                        $stmt->bindValue($identifier, $this->hash_string, PDO::PARAM_STR);
                        break;
                    case 'FROM_NAME':
                        $stmt->bindValue($identifier, $this->from_name, PDO::PARAM_STR);
                        break;
                    case 'FROM_EMAIL':
                        $stmt->bindValue($identifier, $this->from_email, PDO::PARAM_STR);
                        break;
                    case 'TO_EMAIL':
                        $stmt->bindValue($identifier, $this->to_email, PDO::PARAM_STR);
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
                    case 'CONTENT':
                        $stmt->bindValue($identifier, $this->content, PDO::PARAM_STR);
                        break;
                    case 'IS_SUCCESS':
                        $stmt->bindValue($identifier, (int) $this->is_success, PDO::PARAM_INT);
                        break;
                    case 'SHIPPING_DATE':
                        $stmt->bindValue($identifier, $this->shipping_date ? $this->shipping_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'OPENING_DATE':
                        $stmt->bindValue($identifier, $this->opening_date ? $this->opening_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = SysEmailSentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmailId();
                break;
            case 2:
                return $this->getUserId();
                break;
            case 3:
                return $this->getSenderId();
                break;
            case 4:
                return $this->getHashString();
                break;
            case 5:
                return $this->getFromName();
                break;
            case 6:
                return $this->getFromEmail();
                break;
            case 7:
                return $this->getToEmail();
                break;
            case 8:
                return $this->getCc();
                break;
            case 9:
                return $this->getBcc();
                break;
            case 10:
                return $this->getSubject();
                break;
            case 11:
                return $this->getContent();
                break;
            case 12:
                return $this->getIsSuccess();
                break;
            case 13:
                return $this->getShippingDate();
                break;
            case 14:
                return $this->getOpeningDate();
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

        if (isset($alreadyDumpedObjects['SysEmailSent'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SysEmailSent'][$this->hashCode()] = true;
        $keys = SysEmailSentTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmailId(),
            $keys[2] => $this->getUserId(),
            $keys[3] => $this->getSenderId(),
            $keys[4] => $this->getHashString(),
            $keys[5] => $this->getFromName(),
            $keys[6] => $this->getFromEmail(),
            $keys[7] => $this->getToEmail(),
            $keys[8] => $this->getCc(),
            $keys[9] => $this->getBcc(),
            $keys[10] => $this->getSubject(),
            $keys[11] => $this->getContent(),
            $keys[12] => $this->getIsSuccess(),
            $keys[13] => $this->getShippingDate(),
            $keys[14] => $this->getOpeningDate(),
        );
        if ($result[$keys[13]] instanceof \DateTime) {
            $result[$keys[13]] = $result[$keys[13]]->format('c');
        }

        if ($result[$keys[14]] instanceof \DateTime) {
            $result[$keys[14]] = $result[$keys[14]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSysEmail) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysEmail';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_email';
                        break;
                    default:
                        $key = 'SysEmail';
                }

                $result[$key] = $this->aSysEmail->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\SysEmailSent
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysEmailSentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SysEmailSent
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setEmailId($value);
                break;
            case 2:
                $this->setUserId($value);
                break;
            case 3:
                $this->setSenderId($value);
                break;
            case 4:
                $this->setHashString($value);
                break;
            case 5:
                $this->setFromName($value);
                break;
            case 6:
                $this->setFromEmail($value);
                break;
            case 7:
                $this->setToEmail($value);
                break;
            case 8:
                $this->setCc($value);
                break;
            case 9:
                $this->setBcc($value);
                break;
            case 10:
                $this->setSubject($value);
                break;
            case 11:
                $this->setContent($value);
                break;
            case 12:
                $this->setIsSuccess($value);
                break;
            case 13:
                $this->setShippingDate($value);
                break;
            case 14:
                $this->setOpeningDate($value);
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
        $keys = SysEmailSentTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmailId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUserId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSenderId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setHashString($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFromName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFromEmail($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setToEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCc($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setBcc($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setSubject($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setContent($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsSuccess($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setShippingDate($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setOpeningDate($arr[$keys[14]]);
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
     * @return $this|\SysEmailSent The current object, for fluid interface
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
        $criteria = new Criteria(SysEmailSentTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysEmailSentTableMap::COL_ID)) {
            $criteria->add(SysEmailSentTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_EMAIL_ID)) {
            $criteria->add(SysEmailSentTableMap::COL_EMAIL_ID, $this->email_id);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_USER_ID)) {
            $criteria->add(SysEmailSentTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_SENDER_ID)) {
            $criteria->add(SysEmailSentTableMap::COL_SENDER_ID, $this->sender_id);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_HASH_STRING)) {
            $criteria->add(SysEmailSentTableMap::COL_HASH_STRING, $this->hash_string);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_FROM_NAME)) {
            $criteria->add(SysEmailSentTableMap::COL_FROM_NAME, $this->from_name);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_FROM_EMAIL)) {
            $criteria->add(SysEmailSentTableMap::COL_FROM_EMAIL, $this->from_email);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_TO_EMAIL)) {
            $criteria->add(SysEmailSentTableMap::COL_TO_EMAIL, $this->to_email);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_CC)) {
            $criteria->add(SysEmailSentTableMap::COL_CC, $this->cc);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_BCC)) {
            $criteria->add(SysEmailSentTableMap::COL_BCC, $this->bcc);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_SUBJECT)) {
            $criteria->add(SysEmailSentTableMap::COL_SUBJECT, $this->subject);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_CONTENT)) {
            $criteria->add(SysEmailSentTableMap::COL_CONTENT, $this->content);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_IS_SUCCESS)) {
            $criteria->add(SysEmailSentTableMap::COL_IS_SUCCESS, $this->is_success);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_SHIPPING_DATE)) {
            $criteria->add(SysEmailSentTableMap::COL_SHIPPING_DATE, $this->shipping_date);
        }
        if ($this->isColumnModified(SysEmailSentTableMap::COL_OPENING_DATE)) {
            $criteria->add(SysEmailSentTableMap::COL_OPENING_DATE, $this->opening_date);
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
        $criteria = ChildSysEmailSentQuery::create();
        $criteria->add(SysEmailSentTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \SysEmailSent (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmailId($this->getEmailId());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setSenderId($this->getSenderId());
        $copyObj->setHashString($this->getHashString());
        $copyObj->setFromName($this->getFromName());
        $copyObj->setFromEmail($this->getFromEmail());
        $copyObj->setToEmail($this->getToEmail());
        $copyObj->setCc($this->getCc());
        $copyObj->setBcc($this->getBcc());
        $copyObj->setSubject($this->getSubject());
        $copyObj->setContent($this->getContent());
        $copyObj->setIsSuccess($this->getIsSuccess());
        $copyObj->setShippingDate($this->getShippingDate());
        $copyObj->setOpeningDate($this->getOpeningDate());
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
     * @return \SysEmailSent Clone of current object.
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
     * Declares an association between this object and a ChildSysEmail object.
     *
     * @param  ChildSysEmail $v
     * @return $this|\SysEmailSent The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSysEmail(ChildSysEmail $v = null)
    {
        if ($v === null) {
            $this->setEmailId(NULL);
        } else {
            $this->setEmailId($v->getId());
        }

        $this->aSysEmail = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSysEmail object, it will not be re-added.
        if ($v !== null) {
            $v->addSysEmailSent($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSysEmail object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSysEmail The associated ChildSysEmail object.
     * @throws PropelException
     */
    public function getSysEmail(ConnectionInterface $con = null)
    {
        if ($this->aSysEmail === null && ($this->email_id !== null)) {
            $this->aSysEmail = ChildSysEmailQuery::create()->findPk($this->email_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSysEmail->addSysEmailSents($this);
             */
        }

        return $this->aSysEmail;
    }

    /**
     * Declares an association between this object and a ChildSysUser object.
     *
     * @param  ChildSysUser $v
     * @return $this|\SysEmailSent The current object (for fluent API support)
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
            $v->addSysEmailSent($this);
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
                $this->aSysUser->addSysEmailSents($this);
             */
        }

        return $this->aSysUser;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSysEmail) {
            $this->aSysEmail->removeSysEmailSent($this);
        }
        if (null !== $this->aSysUser) {
            $this->aSysUser->removeSysEmailSent($this);
        }
        $this->id = null;
        $this->email_id = null;
        $this->user_id = null;
        $this->sender_id = null;
        $this->hash_string = null;
        $this->from_name = null;
        $this->from_email = null;
        $this->to_email = null;
        $this->cc = null;
        $this->bcc = null;
        $this->subject = null;
        $this->content = null;
        $this->is_success = null;
        $this->shipping_date = null;
        $this->opening_date = null;
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

        $this->aSysEmail = null;
        $this->aSysUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysEmailSentTableMap::DEFAULT_STRING_FORMAT);
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
