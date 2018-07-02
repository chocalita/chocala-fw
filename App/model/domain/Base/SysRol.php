<?php

namespace Base;

use \JobUserEmpresaSuscrita as ChildJobUserEmpresaSuscrita;
use \JobUserEmpresaSuscritaQuery as ChildJobUserEmpresaSuscritaQuery;
use \SysEntityUser as ChildSysEntityUser;
use \SysEntityUserQuery as ChildSysEntityUserQuery;
use \SysRol as ChildSysRol;
use \SysRolQuery as ChildSysRolQuery;
use \SysRolXUri as ChildSysRolXUri;
use \SysRolXUriQuery as ChildSysRolXUriQuery;
use \SysUserXRol as ChildSysUserXRol;
use \SysUserXRolQuery as ChildSysUserXRolQuery;
use \Exception;
use \PDO;
use Map\JobUserEmpresaSuscritaTableMap;
use Map\SysEntityUserTableMap;
use Map\SysRolTableMap;
use Map\SysRolXUriTableMap;
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

/**
 * Base class that represents a row from the 'sys_rol' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class SysRol implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SysRolTableMap';


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
     * @var        ObjectCollection|ChildJobUserEmpresaSuscrita[] Collection to store aggregation of ChildJobUserEmpresaSuscrita objects.
     */
    protected $collJobUserEmpresaSuscritas;
    protected $collJobUserEmpresaSuscritasPartial;

    /**
     * @var        ObjectCollection|ChildSysEntityUser[] Collection to store aggregation of ChildSysEntityUser objects.
     */
    protected $collSysEntityUsers;
    protected $collSysEntityUsersPartial;

    /**
     * @var        ObjectCollection|ChildSysRolXUri[] Collection to store aggregation of ChildSysRolXUri objects.
     */
    protected $collSysRolXUris;
    protected $collSysRolXUrisPartial;

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
     * @var ObjectCollection|ChildSysEntityUser[]
     */
    protected $sysEntityUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysRolXUri[]
     */
    protected $sysRolXUrisScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSysUserXRol[]
     */
    protected $sysUserXRolsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\SysRol object.
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
     * Compares this with another <code>SysRol</code> instance.  If
     * <code>obj</code> is an instance of <code>SysRol</code>, delegates to
     * <code>equals(SysRol)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SysRol The current object, for fluid interface
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\SysRol The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SysRolTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return $this|\SysRol The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[SysRolTableMap::COL_CODE] = true;
        }

        return $this;
    } // setCode()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\SysRol The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SysRolTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\SysRol The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SysRolTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SysRolTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SysRolTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SysRolTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SysRolTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = SysRolTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SysRol'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SysRolTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSysRolQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJobUserEmpresaSuscritas = null;

            $this->collSysEntityUsers = null;

            $this->collSysRolXUris = null;

            $this->collSysUserXRols = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SysRol::setDeleted()
     * @see SysRol::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSysRolQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysRolTableMap::DATABASE_NAME);
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
                SysRolTableMap::addInstanceToPool($this);
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

            if ($this->sysRolXUrisScheduledForDeletion !== null) {
                if (!$this->sysRolXUrisScheduledForDeletion->isEmpty()) {
                    \SysRolXUriQuery::create()
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

        $this->modifiedColumns[SysRolTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SysRolTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SysRolTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(SysRolTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'CODE';
        }
        if ($this->isColumnModified(SysRolTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'NAME';
        }
        if ($this->isColumnModified(SysRolTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPTION';
        }

        $sql = sprintf(
            'INSERT INTO sys_rol (%s) VALUES (%s)',
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
        $pos = SysRolTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCode();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getDescription();
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

        if (isset($alreadyDumpedObjects['SysRol'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SysRol'][$this->hashCode()] = true;
        $keys = SysRolTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getDescription(),
        );
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
     * @return $this|\SysRol
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SysRolTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SysRol
     */
    public function setByPosition($pos, $value)
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
        $keys = SysRolTableMap::getFieldNames($keyType);

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
     * @return $this|\SysRol The current object, for fluid interface
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
        $criteria = new Criteria(SysRolTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SysRolTableMap::COL_ID)) {
            $criteria->add(SysRolTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SysRolTableMap::COL_CODE)) {
            $criteria->add(SysRolTableMap::COL_CODE, $this->code);
        }
        if ($this->isColumnModified(SysRolTableMap::COL_NAME)) {
            $criteria->add(SysRolTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SysRolTableMap::COL_DESCRIPTION)) {
            $criteria->add(SysRolTableMap::COL_DESCRIPTION, $this->description);
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
        $criteria = ChildSysRolQuery::create();
        $criteria->add(SysRolTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \SysRol (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getJobUserEmpresaSuscritas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJobUserEmpresaSuscrita($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysEntityUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysEntityUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSysRolXUris() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSysRolXUri($relObj->copy($deepCopy));
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
     * @return \SysRol Clone of current object.
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
            return $this->initJobUserEmpresaSuscritas();
        }
        if ('SysEntityUser' == $relationName) {
            return $this->initSysEntityUsers();
        }
        if ('SysRolXUri' == $relationName) {
            return $this->initSysRolXUris();
        }
        if ('SysUserXRol' == $relationName) {
            return $this->initSysUserXRols();
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
     * If this ChildSysRol is new, it will return
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
                    ->filterBySysRol($this)
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
     * @return $this|ChildSysRol The current object (for fluent API support)
     */
    public function setJobUserEmpresaSuscritas(Collection $jobUserEmpresaSuscritas, ConnectionInterface $con = null)
    {
        /** @var ChildJobUserEmpresaSuscrita[] $jobUserEmpresaSuscritasToDelete */
        $jobUserEmpresaSuscritasToDelete = $this->getJobUserEmpresaSuscritas(new Criteria(), $con)->diff($jobUserEmpresaSuscritas);


        $this->jobUserEmpresaSuscritasScheduledForDeletion = $jobUserEmpresaSuscritasToDelete;

        foreach ($jobUserEmpresaSuscritasToDelete as $jobUserEmpresaSuscritaRemoved) {
            $jobUserEmpresaSuscritaRemoved->setSysRol(null);
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
                ->filterBySysRol($this)
                ->count($con);
        }

        return count($this->collJobUserEmpresaSuscritas);
    }

    /**
     * Method called to associate a ChildJobUserEmpresaSuscrita object to this object
     * through the ChildJobUserEmpresaSuscrita foreign key attribute.
     *
     * @param  ChildJobUserEmpresaSuscrita $l ChildJobUserEmpresaSuscrita
     * @return $this|\SysRol The current object (for fluent API support)
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
        $jobUserEmpresaSuscrita->setSysRol($this);
    }

    /**
     * @param  ChildJobUserEmpresaSuscrita $jobUserEmpresaSuscrita The ChildJobUserEmpresaSuscrita object to remove.
     * @return $this|ChildSysRol The current object (for fluent API support)
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
            $jobUserEmpresaSuscrita->setSysRol(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysRol is new, it will return
     * an empty collection; or if this SysRol has previously
     * been saved, it will retrieve related JobUserEmpresaSuscritas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysRol.
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
     * Otherwise if this SysRol is new, it will return
     * an empty collection; or if this SysRol has previously
     * been saved, it will retrieve related JobUserEmpresaSuscritas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysRol.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildJobUserEmpresaSuscrita[] List of ChildJobUserEmpresaSuscrita objects
     */
    public function getJobUserEmpresaSuscritasJoinSysUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildJobUserEmpresaSuscritaQuery::create(null, $criteria);
        $query->joinWith('SysUser', $joinBehavior);

        return $this->getJobUserEmpresaSuscritas($query, $con);
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
     * If this ChildSysRol is new, it will return
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
                    ->filterBySysRol($this)
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
     * @return $this|ChildSysRol The current object (for fluent API support)
     */
    public function setSysEntityUsers(Collection $sysEntityUsers, ConnectionInterface $con = null)
    {
        /** @var ChildSysEntityUser[] $sysEntityUsersToDelete */
        $sysEntityUsersToDelete = $this->getSysEntityUsers(new Criteria(), $con)->diff($sysEntityUsers);


        $this->sysEntityUsersScheduledForDeletion = $sysEntityUsersToDelete;

        foreach ($sysEntityUsersToDelete as $sysEntityUserRemoved) {
            $sysEntityUserRemoved->setSysRol(null);
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
                ->filterBySysRol($this)
                ->count($con);
        }

        return count($this->collSysEntityUsers);
    }

    /**
     * Method called to associate a ChildSysEntityUser object to this object
     * through the ChildSysEntityUser foreign key attribute.
     *
     * @param  ChildSysEntityUser $l ChildSysEntityUser
     * @return $this|\SysRol The current object (for fluent API support)
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
        $sysEntityUser->setSysRol($this);
    }

    /**
     * @param  ChildSysEntityUser $sysEntityUser The ChildSysEntityUser object to remove.
     * @return $this|ChildSysRol The current object (for fluent API support)
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
            $sysEntityUser->setSysRol(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysRol is new, it will return
     * an empty collection; or if this SysRol has previously
     * been saved, it will retrieve related SysEntityUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysRol.
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
     * Otherwise if this SysRol is new, it will return
     * an empty collection; or if this SysRol has previously
     * been saved, it will retrieve related SysEntityUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysRol.
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
        $this->collSysRolXUris->setModel('\SysRolXUri');
    }

    /**
     * Gets an array of ChildSysRolXUri objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSysRol is new, it will return
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
                    ->filterBySysRol($this)
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
     * @return $this|ChildSysRol The current object (for fluent API support)
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
            $sysRolXUriRemoved->setSysRol(null);
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
                ->filterBySysRol($this)
                ->count($con);
        }

        return count($this->collSysRolXUris);
    }

    /**
     * Method called to associate a ChildSysRolXUri object to this object
     * through the ChildSysRolXUri foreign key attribute.
     *
     * @param  ChildSysRolXUri $l ChildSysRolXUri
     * @return $this|\SysRol The current object (for fluent API support)
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
        $sysRolXUri->setSysRol($this);
    }

    /**
     * @param  ChildSysRolXUri $sysRolXUri The ChildSysRolXUri object to remove.
     * @return $this|ChildSysRol The current object (for fluent API support)
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
            $sysRolXUri->setSysRol(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysRol is new, it will return
     * an empty collection; or if this SysRol has previously
     * been saved, it will retrieve related SysRolXUris from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysRol.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysRolXUri[] List of ChildSysRolXUri objects
     */
    public function getSysRolXUrisJoinSysUri(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysRolXUriQuery::create(null, $criteria);
        $query->joinWith('SysUri', $joinBehavior);

        return $this->getSysRolXUris($query, $con);
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
     * If this ChildSysRol is new, it will return
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
                    ->filterBySysRol($this)
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
     * @return $this|ChildSysRol The current object (for fluent API support)
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
            $sysUserXRolRemoved->setSysRol(null);
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
                ->filterBySysRol($this)
                ->count($con);
        }

        return count($this->collSysUserXRols);
    }

    /**
     * Method called to associate a ChildSysUserXRol object to this object
     * through the ChildSysUserXRol foreign key attribute.
     *
     * @param  ChildSysUserXRol $l ChildSysUserXRol
     * @return $this|\SysRol The current object (for fluent API support)
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
        $sysUserXRol->setSysRol($this);
    }

    /**
     * @param  ChildSysUserXRol $sysUserXRol The ChildSysUserXRol object to remove.
     * @return $this|ChildSysRol The current object (for fluent API support)
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
            $sysUserXRol->setSysRol(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SysRol is new, it will return
     * an empty collection; or if this SysRol has previously
     * been saved, it will retrieve related SysUserXRols from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SysRol.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSysUserXRol[] List of ChildSysUserXRol objects
     */
    public function getSysUserXRolsJoinSysUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSysUserXRolQuery::create(null, $criteria);
        $query->joinWith('SysUser', $joinBehavior);

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
        $this->code = null;
        $this->name = null;
        $this->description = null;
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
            if ($this->collJobUserEmpresaSuscritas) {
                foreach ($this->collJobUserEmpresaSuscritas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysEntityUsers) {
                foreach ($this->collSysEntityUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSysRolXUris) {
                foreach ($this->collSysRolXUris as $o) {
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
        $this->collSysEntityUsers = null;
        $this->collSysRolXUris = null;
        $this->collSysUserXRols = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SysRolTableMap::DEFAULT_STRING_FORMAT);
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
