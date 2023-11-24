<?php

namespace App\model\domain\Base;

use \Exception;
use \PDO;
use App\model\domain\SysModule as ChildSysModule;
use App\model\domain\SysModuleQuery as ChildSysModuleQuery;
use App\model\domain\SysRolXUri as ChildSysRolXUri;
use App\model\domain\SysRolXUriQuery as ChildSysRolXUriQuery;
use App\model\domain\SysUri as ChildSysUri;
use App\model\domain\SysUriQuery as ChildSysUriQuery;
use App\model\domain\Map\SysRolXUriTableMap;
use App\model\domain\Map\SysUriTableMap;
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

/**
 * Base class that represents a row from the 'sys_uri' table.
 *
 *
 *
 * @package    propel.generator.App.model.domain.Base
 */
abstract class SysUri implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\model\\domain\\Map\\SysUriTableMap';


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
     * The value for the module_id field.
     *
     * @var        int
     */
    protected $module_id;

    /**
     * The value for the uri field.
     *
     * @var        string
     */
    protected $uri;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the access field.
     *
     * @var        string
     */
    protected $access;

    /**
     * The value for the type field.
     *
     * @var        string
     */
    protected $type;

    /**
     * The value for the position field.
     *
     * @var        int
     */
    protected $position;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the icon field.
     *
     * @var        string
     */
    protected $icon;

    /**
     * The value for the mark field.
     *
     * @var        string
     */
    protected $mark;

    /**
     * The value for the after_divisor field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $after_divisor;

    /**
     * @var        ChildSysModule
     */
    protected $aSysModule;

    /**
     * @var        ObjectCollection|ChildSysRolXUri[] Collection to store aggregation of ChildSysRolXUri objects.
     */
    protected $collSysRolXUris;
    protected $collSysRolXUrisPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysRolXUri[]
     */
    protected $sysRolXUrisScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->after_divisor = false;
    }

    /**
     * Initializes internal state of App\model\domain\Base\SysUri object.
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
     * Compares this with another <code>SysUri</code> instance.  If
     * <code>obj</code> is an instance of <code>SysUri</code>, delegates to
     * <code>equals(SysUri)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SysUri The current object, for fluid interface
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
     * Get the [module_id] column value.
     *
     * @return int
     */
    public function getModuleId()
    {
        return $this->module_id;
    }

    /**
     * Get the [uri] column value.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [access] column value.
     *
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
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
     * Get the [position] column value.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
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
     * Get the [icon] column value.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get the [mark] column value.
     *
     * @return string
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Get the [after_divisor] column value.
     *
     * @return boolean
     */
    public function getAfterDivisor()
    {
        return $this->after_divisor;
    }

    /**
     * Get the [after_divisor] column value.
     *
     * @return boolean
     */
    public function isAfterDivisor()
    {
        return $this->getAfterDivisor();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysUriTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [module_id] column.
     *
     * @param int $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setModuleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->module_id !== $v) {
            $this->module_id = $v;
            $this->modifiedColumns[SysUriTableMap::COL_MODULE_ID] = true;
        }

        if ($this->aSysModule !== null && $this->aSysModule->getId() !== $v) {
            $this->aSysModule = null;
        }

        return $this;
    } // setModuleId()

    /**
     * Set the value of [uri] column.
     *
     * @param string $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setUri($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uri !== $v) {
            $this->uri = $v;
            $this->modifiedColumns[SysUriTableMap::COL_URI] = true;
        }

        return $this;
    } // setUri()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[SysUriTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [access] column.
     *
     * @param string $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setAccess($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->access !== $v) {
            $this->access = $v;
            $this->modifiedColumns[SysUriTableMap::COL_ACCESS] = true;
        }

        return $this;
    } // setAccess()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[SysUriTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [position] column.
     *
     * @param int $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[SysUriTableMap::COL_POSITION] = true;
        }

        return $this;
    } // setPosition()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SysUriTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [icon] column.
     *
     * @param string $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setIcon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->icon !== $v) {
            $this->icon = $v;
            $this->modifiedColumns[SysUriTableMap::COL_ICON] = true;
        }

        return $this;
    } // setIcon()

    /**
     * Set the value of [mark] column.
     *
     * @param string $v new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setMark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mark !== $v) {
            $this->mark = $v;
            $this->modifiedColumns[SysUriTableMap::COL_MARK] = true;
        }

        return $this;
    } // setMark()

    /**
     * Sets the value of the [after_divisor] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function setAfterDivisor($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->after_divisor !== $v) {
            $this->after_divisor = $v;
            $this->modifiedColumns[SysUriTableMap::COL_AFTER_DIVISOR] = true;
        }

        return $this;
    } // setAfterDivisor()

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
            if ($this->after_divisor !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysUriTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysUriTableMap::translateFieldName('ModuleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->module_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysUriTableMap::translateFieldName('Uri', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uri = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysUriTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SysUriTableMap::translateFieldName('Access', TableMap::TYPE_PHPNAME, $indexType)];
            $this->access = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SysUriTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SysUriTableMap::translateFieldName('Position', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SysUriTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SysUriTableMap::translateFieldName('Icon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->icon = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SysUriTableMap::translateFieldName('Mark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SysUriTableMap::translateFieldName('AfterDivisor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->after_divisor = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = SysUriTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\model\\domain\\SysUri'), 0, $e);
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
        if ($this->aSysModule !== null && $this->module_id !== $this->aSysModule->getId()) {
            $this->aSysModule = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SysUriTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysUriQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSysModule = null;
            $this->collSysRolXUris = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SysUri::setDeleted()
     * @see SysUri::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysUriQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
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
                SysUriTableMap::addInstanceToPool($this);
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

            if ($this->aSysModule !== null) {
                if ($this->aSysModule->isModified() || $this->aSysModule->isNew()) {
                    $affectedRows += $this->aSysModule->save($con);
                }
                $this->setSysModule($this->aSysModule);
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

            if ($this->sysRolXUrisScheduledForDeletion !== null) {
                if (!$this->sysRolXUrisScheduledForDeletion->isEmpty()) {
                    \App\model\domain\SysRolXUriQuery::create()
                        ->filterByPrimaryKeys($this->sysRolXUrisScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sysRolXUrisScheduledForDeletion = null;
                }
            }

            if ($this->collSysRolXUris !== null) {
                foreach ($this->collSysRolXUris as $referrerFK) {
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

        $this->modifiedColumns[SysUriTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysUriTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysUriTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_MODULE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'MODULE_ID';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_URI)) {
            $modifiedColumns[':p' . $index++]  = 'URI';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'TITLE';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_ACCESS)) {
            $modifiedColumns[':p' . $index++]  = 'ACCESS';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'TYPE';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'POSITION';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPTION';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_ICON)) {
            $modifiedColumns[':p' . $index++]  = 'ICON';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_MARK)) {
            $modifiedColumns[':p' . $index++]  = 'MARK';
        }
        if ($this->isColumnModified(SysUriTableMap::COL_AFTER_DIVISOR)) {
            $modifiedColumns[':p' . $index++]  = 'AFTER_DIVISOR';
        }

        $sql = sprintf(
            'INSERT INTO sys_uri (%s) VALUES (%s)',
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
                    case 'MODULE_ID':
                        $stmt->bindValue($identifier, $this->module_id, PDO::PARAM_INT);
                        break;
                    case 'URI':
                        $stmt->bindValue($identifier, $this->uri, PDO::PARAM_STR);
                        break;
                    case 'TITLE':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'ACCESS':
                        $stmt->bindValue($identifier, $this->access, PDO::PARAM_STR);
                        break;
                    case 'TYPE':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'POSITION':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_INT);
                        break;
                    case 'DESCRIPTION':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'ICON':
                        $stmt->bindValue($identifier, $this->icon, PDO::PARAM_STR);
                        break;
                    case 'MARK':
                        $stmt->bindValue($identifier, $this->mark, PDO::PARAM_STR);
                        break;
                    case 'AFTER_DIVISOR':
                        $stmt->bindValue($identifier, (int) $this->after_divisor, PDO::PARAM_INT);
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
        $pos = SysUriTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getModuleId();
                break;
            case 2:
                return $this->getUri();
                break;
            case 3:
                return $this->getTitle();
                break;
            case 4:
                return $this->getAccess();
                break;
            case 5:
                return $this->getType();
                break;
            case 6:
                return $this->getPosition();
                break;
            case 7:
                return $this->getDescription();
                break;
            case 8:
                return $this->getIcon();
                break;
            case 9:
                return $this->getMark();
                break;
            case 10:
                return $this->getAfterDivisor();
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

        if (isset($alreadyDumpedObjects['SysUri'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SysUri'][$this->hashCode()] = true;
        $keys = SysUriTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getModuleId(),
            $keys[2] => $this->getUri(),
            $keys[3] => $this->getTitle(),
            $keys[4] => $this->getAccess(),
            $keys[5] => $this->getType(),
            $keys[6] => $this->getPosition(),
            $keys[7] => $this->getDescription(),
            $keys[8] => $this->getIcon(),
            $keys[9] => $this->getMark(),
            $keys[10] => $this->getAfterDivisor(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSysModule) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysModule';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_module';
                        break;
                    default:
                        $key = 'SysModule';
                }

                $result[$key] = $this->aSysModule->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSysRolXUris) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sysRolXUris';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sys_rol_x_uris';
                        break;
                    default:
                        $key = 'SysRolXUris';
                }

                $result[$key] = $this->collSysRolXUris->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\model\domain\SysUri
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysUriTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\model\domain\SysUri
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setModuleId($value);
                break;
            case 2:
                $this->setUri($value);
                break;
            case 3:
                $this->setTitle($value);
                break;
            case 4:
                $this->setAccess($value);
                break;
            case 5:
                $this->setType($value);
                break;
            case 6:
                $this->setPosition($value);
                break;
            case 7:
                $this->setDescription($value);
                break;
            case 8:
                $this->setIcon($value);
                break;
            case 9:
                $this->setMark($value);
                break;
            case 10:
                $this->setAfterDivisor($value);
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
        $keys = SysUriTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setModuleId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUri($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTitle($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAccess($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setType($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPosition($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDescription($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIcon($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setMark($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setAfterDivisor($arr[$keys[10]]);
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
     * @return $this|\App\model\domain\SysUri The current object, for fluid interface
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
        $criteria = new Criteria(SysUriTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysUriTableMap::COL_ID)) {
            $criteria->add(SysUriTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_MODULE_ID)) {
            $criteria->add(SysUriTableMap::COL_MODULE_ID, $this->module_id);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_URI)) {
            $criteria->add(SysUriTableMap::COL_URI, $this->uri);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_TITLE)) {
            $criteria->add(SysUriTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_ACCESS)) {
            $criteria->add(SysUriTableMap::COL_ACCESS, $this->access);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_TYPE)) {
            $criteria->add(SysUriTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_POSITION)) {
            $criteria->add(SysUriTableMap::COL_POSITION, $this->position);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_DESCRIPTION)) {
            $criteria->add(SysUriTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_ICON)) {
            $criteria->add(SysUriTableMap::COL_ICON, $this->icon);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_MARK)) {
            $criteria->add(SysUriTableMap::COL_MARK, $this->mark);
        }
        if ($this->isColumnModified(SysUriTableMap::COL_AFTER_DIVISOR)) {
            $criteria->add(SysUriTableMap::COL_AFTER_DIVISOR, $this->after_divisor);
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
        $criteria = ChildSysUriQuery::create();
        $criteria->add(SysUriTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \App\model\domain\SysUri (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setModuleId($this->getModuleId());
        $copyObj->setUri($this->getUri());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setAccess($this->getAccess());
        $copyObj->setType($this->getType());
        $copyObj->setPosition($this->getPosition());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setIcon($this->getIcon());
        $copyObj->setMark($this->getMark());
        $copyObj->setAfterDivisor($this->getAfterDivisor());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSysRolXUris() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysRolXUri($relObj->copy($deepCopy));
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
     * @return \App\model\domain\SysUri Clone of current object.
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
     * Declares an association between this object and a ChildSysModule object.
     *
     * @param  ChildSysModule $v
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSysModule(ChildSysModule $v = null)
    {
        if ($v === null) {
            $this->setModuleId(NULL);
        } else {
            $this->setModuleId($v->getId());
        }

        $this->aSysModule = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSysModule object, it will not be re-added.
        if ($v !== null) {
            $v->addSysUri($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSysModule object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSysModule The associated ChildSysModule object.
     * @throws PropelException
     */
    public function getSysModule(ConnectionInterface $con = null)
    {
        if ($this->aSysModule === null && ($this->module_id != 0)) {
            $this->aSysModule = ChildSysModuleQuery::create()->findPk($this->module_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSysModule->addSysUris($this);
             */
        }

        return $this->aSysModule;
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
        if ('SysRolXUri' == $relationName) {
            $this->initSysRolXUris();
            return;
        }
    }

    /**
     * Clears out the collSysRolXUris collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSysRolXUris()
     */
    public function clearSysRolXUris()
    {
        $this->collSysRolXUris = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSysRolXUris collection loaded partially.
     */
    public function resetPartialSysRolXUris($v = true)
    {
        $this->collSysRolXUrisPartial = $v;
    }

    /**
     * Initializes the collSysRolXUris collection.
     *
     * By default this just sets the collSysRolXUris collection to an empty array (like clearcollSysRolXUris());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSysRolXUris($overrideExisting = true)
    {
        if (null !== $this->collSysRolXUris && !$overrideExisting) {
            return;
        }

        $collectionClassName = SysRolXUriTableMap::getTableMap()->getCollectionClassName();

        $this->collSysRolXUris = new $collectionClassName;
        $this->collSysRolXUris->setModel('\App\model\domain\SysRolXUri');
    }

    /**
     * Gets an array of ChildSysRolXUri objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysUri is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSysRolXUri[] List of ChildSysRolXUri objects
     * @throws PropelException
     */
    public function getSysRolXUris(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSysRolXUrisPartial && !$this->isNew();
        if (null === $this->collSysRolXUris || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSysRolXUris) {
                // return empty collection
                $this->initSysRolXUris();
            } else {
                $collSysRolXUris = ChildSysRolXUriQuery::create(null, $criteria)
                    ->filterBySysUri($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSysRolXUrisPartial && count($collSysRolXUris)) {
                        $this->initSysRolXUris(false);

                        foreach ($collSysRolXUris as $obj) {
                            if (false == $this->collSysRolXUris->contains($obj)) {
                                $this->collSysRolXUris->append($obj);
                            }
                        }

                        $this->collSysRolXUrisPartial = true;
                    }

                    return $collSysRolXUris;
                }

                if ($partial && $this->collSysRolXUris) {
                    foreach ($this->collSysRolXUris as $obj) {
                        if ($obj->isNew()) {
                            $collSysRolXUris[] = $obj;
                        }
                    }
                }

                $this->collSysRolXUris = $collSysRolXUris;
                $this->collSysRolXUrisPartial = false;
            }
        }

        return $this->collSysRolXUris;
    }

    /**
     * Sets a collection of ChildSysRolXUri objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sysRolXUris A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSysUri The current object (for fluent API support)
     */
    public function setSysRolXUris(Collection $sysRolXUris, ConnectionInterface $con = null)
    {
        /** @var ChildSysRolXUri[] $sysRolXUrisToDelete */
        $sysRolXUrisToDelete = $this->getSysRolXUris(new Criteria(), $con)->diff($sysRolXUris);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->sysRolXUrisScheduledForDeletion = clone $sysRolXUrisToDelete;

        foreach ($sysRolXUrisToDelete as $sysRolXUriRemoved) {
            $sysRolXUriRemoved->setSysUri(null);
        }

        $this->collSysRolXUris = null;
        foreach ($sysRolXUris as $sysRolXUri) {
            $this->addSysRolXUri($sysRolXUri);
        }

        $this->collSysRolXUris = $sysRolXUris;
        $this->collSysRolXUrisPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SysRolXUri objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SysRolXUri objects.
     * @throws PropelException
     */
    public function countSysRolXUris(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSysRolXUrisPartial && !$this->isNew();
        if (null === $this->collSysRolXUris || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSysRolXUris) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSysRolXUris());
            }

            $query = ChildSysRolXUriQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySysUri($this)
                ->count($con);
        }

        return count($this->collSysRolXUris);
    }

    /**
     * Method called to associate a ChildSysRolXUri object to this object
     * through the ChildSysRolXUri foreign key attribute.
     *
     * @param  ChildSysRolXUri $l ChildSysRolXUri
     * @return $this|\App\model\domain\SysUri The current object (for fluent API support)
     */
    public function addSysRolXUri(ChildSysRolXUri $l)
    {
        if ($this->collSysRolXUris === null) {
            $this->initSysRolXUris();
            $this->collSysRolXUrisPartial = true;
        }

        if (!$this->collSysRolXUris->contains($l)) {
            $this->doAddSysRolXUri($l);

            if ($this->sysRolXUrisScheduledForDeletion and $this->sysRolXUrisScheduledForDeletion->contains($l)) {
                $this->sysRolXUrisScheduledForDeletion->remove($this->sysRolXUrisScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSysRolXUri $sysRolXUri The ChildSysRolXUri object to add.
     */
    protected function doAddSysRolXUri(ChildSysRolXUri $sysRolXUri)
    {
        $this->collSysRolXUris[]= $sysRolXUri;
        $sysRolXUri->setSysUri($this);
    }

    /**
     * @param  ChildSysRolXUri $sysRolXUri The ChildSysRolXUri object to remove.
     * @return $this|ChildSysUri The current object (for fluent API support)
     */
    public function removeSysRolXUri(ChildSysRolXUri $sysRolXUri)
    {
        if ($this->getSysRolXUris()->contains($sysRolXUri)) {
            $pos = $this->collSysRolXUris->search($sysRolXUri);
            $this->collSysRolXUris->remove($pos);
            if (null === $this->sysRolXUrisScheduledForDeletion) {
                $this->sysRolXUrisScheduledForDeletion = clone $this->collSysRolXUris;
                $this->sysRolXUrisScheduledForDeletion->clear();
            }
            $this->sysRolXUrisScheduledForDeletion[]= clone $sysRolXUri;
            $sysRolXUri->setSysUri(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysUri is new, it will return
     * an empty collection; or if this SysUri has previously
     * been saved, it will retrieve related SysRolXUris from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysUri.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysRolXUri[] List of ChildSysRolXUri objects
     */
    public function getSysRolXUrisJoinSysRol(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysRolXUriQuery::create(null, $criteria);
        $query->joinWith('SysRol', $joinBehavior);

        return $this->getSysRolXUris($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSysModule) {
            $this->aSysModule->removeSysUri($this);
        }
        $this->id = null;
        $this->module_id = null;
        $this->uri = null;
        $this->title = null;
        $this->access = null;
        $this->type = null;
        $this->position = null;
        $this->description = null;
        $this->icon = null;
        $this->mark = null;
        $this->after_divisor = null;
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
            if ($this->collSysRolXUris) {
                foreach ($this->collSysRolXUris as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSysRolXUris = null;
        $this->aSysModule = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysUriTableMap::DEFAULT_STRING_FORMAT);
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
