<?php

namespace Base;

use \JobEmpresaSuscritaQuery as ChildJobEmpresaSuscritaQuery;
use \SysEntityType as ChildSysEntityType;
use \SysEntityTypeQuery as ChildSysEntityTypeQuery;
use \SysLocation as ChildSysLocation;
use \SysLocationQuery as ChildSysLocationQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\JobEmpresaSuscritaTableMap;
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
 * Base class that represents a row from the 'job_empresa_suscrita' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class JobEmpresaSuscrita implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\JobEmpresaSuscritaTableMap';


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
     * The value for the entity_type_id field.
     * @var        int
     */
    protected $entity_type_id;

    /**
     * The value for the location_id field.
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the scrap_empresa_id field.
     * @var        int
     */
    protected $scrap_empresa_id;

    /**
     * The value for the nombre field.
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the nit field.
     * @var        string
     */
    protected $nit;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the direccion field.
     * @var        string
     */
    protected $direccion;

    /**
     * The value for the representante field.
     * @var        string
     */
    protected $representante;

    /**
     * The value for the telefono field.
     * @var        string
     */
    protected $telefono;

    /**
     * The value for the celular field.
     * @var        string
     */
    protected $celular;

    /**
     * The value for the last_user_id field.
     * @var        int
     */
    protected $last_user_id;

    /**
     * The value for the creation_date field.
     * @var        \DateTime
     */
    protected $creation_date;

    /**
     * The value for the modificacion_date field.
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
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\JobEmpresaSuscrita object.
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
     * Compares this with another <code>JobEmpresaSuscrita</code> instance.  If
     * <code>obj</code> is an instance of <code>JobEmpresaSuscrita</code>, delegates to
     * <code>equals(JobEmpresaSuscrita)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|JobEmpresaSuscrita The current object, for fluid interface
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
     * Get the [scrap_empresa_id] column value.
     * 
     * @return int
     */
    public function getScrapEmpresaId()
    {
        return $this->scrap_empresa_id;
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
     * Get the [direccion] column value.
     * 
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Get the [representante] column value.
     * 
     * @return string
     */
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Get the [telefono] column value.
     * 
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Get the [celular] column value.
     * 
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
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
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [entity_type_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setEntityTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entity_type_id !== $v) {
            $this->entity_type_id = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID] = true;
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
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_LOCATION_ID] = true;
        }

        if ($this->aSysLocation !== null && $this->aSysLocation->getId() !== $v) {
            $this->aSysLocation = null;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [scrap_empresa_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setScrapEmpresaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->scrap_empresa_id !== $v) {
            $this->scrap_empresa_id = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID] = true;
        }

        return $this;
    } // setScrapEmpresaId()

    /**
     * Set the value of [nombre] column.
     * 
     * @param string $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [nit] column.
     * 
     * @param string $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setNit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nit !== $v) {
            $this->nit = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_NIT] = true;
        }

        return $this;
    } // setNit()

    /**
     * Set the value of [email] column.
     * 
     * @param string $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [direccion] column.
     * 
     * @param string $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->direccion !== $v) {
            $this->direccion = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_DIRECCION] = true;
        }

        return $this;
    } // setDireccion()

    /**
     * Set the value of [representante] column.
     * 
     * @param string $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setRepresentante($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->representante !== $v) {
            $this->representante = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_REPRESENTANTE] = true;
        }

        return $this;
    } // setRepresentante()

    /**
     * Set the value of [telefono] column.
     * 
     * @param string $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setTelefono($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefono !== $v) {
            $this->telefono = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_TELEFONO] = true;
        }

        return $this;
    } // setTelefono()

    /**
     * Set the value of [celular] column.
     * 
     * @param string $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setCelular($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->celular !== $v) {
            $this->celular = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_CELULAR] = true;
        }

        return $this;
    } // setCelular()

    /**
     * Set the value of [last_user_id] column.
     * 
     * @param int $v new value
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setLastUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_user_id !== $v) {
            $this->last_user_id = $v;
            $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_LAST_USER_ID] = true;
        }

        return $this;
    } // setLastUserId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->creation_date->format("Y-m-d H:i:s")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modificacion_date] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
     */
    public function setModificacionDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modificacion_date !== null || $dt !== null) {
            if ($this->modificacion_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->modificacion_date->format("Y-m-d H:i:s")) {
                $this->modificacion_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('EntityTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entity_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('ScrapEmpresaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->scrap_empresa_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Nit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Direccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->direccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Representante', TableMap::TYPE_PHPNAME, $indexType)];
            $this->representante = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Telefono', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('Celular', TableMap::TYPE_PHPNAME, $indexType)];
            $this->celular = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('LastUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : JobEmpresaSuscritaTableMap::translateFieldName('ModificacionDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modificacion_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = JobEmpresaSuscritaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\JobEmpresaSuscrita'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildJobEmpresaSuscritaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSysEntityType = null;
            $this->aSysLocation = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see JobEmpresaSuscrita::setDeleted()
     * @see JobEmpresaSuscrita::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildJobEmpresaSuscritaQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaSuscritaTableMap::DATABASE_NAME);
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
                JobEmpresaSuscritaTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[JobEmpresaSuscritaTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . JobEmpresaSuscritaTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ENTITY_TYPE_ID';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LOCATION_ID';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'SCRAP_EMPRESA_ID';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_NIT)) {
            $modifiedColumns[':p' . $index++]  = 'NIT';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = 'DIRECCION';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_REPRESENTANTE)) {
            $modifiedColumns[':p' . $index++]  = 'REPRESENTANTE';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_TELEFONO)) {
            $modifiedColumns[':p' . $index++]  = 'TELEFONO';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_CELULAR)) {
            $modifiedColumns[':p' . $index++]  = 'CELULAR';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_LAST_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_USER_ID';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'CREATION_DATE';
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'MODIFICACION_DATE';
        }

        $sql = sprintf(
            'INSERT INTO job_empresa_suscrita (%s) VALUES (%s)',
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
                    case 'SCRAP_EMPRESA_ID':                        
                        $stmt->bindValue($identifier, $this->scrap_empresa_id, PDO::PARAM_INT);
                        break;
                    case 'NOMBRE':                        
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'NIT':                        
                        $stmt->bindValue($identifier, $this->nit, PDO::PARAM_STR);
                        break;
                    case 'EMAIL':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'DIRECCION':                        
                        $stmt->bindValue($identifier, $this->direccion, PDO::PARAM_STR);
                        break;
                    case 'REPRESENTANTE':                        
                        $stmt->bindValue($identifier, $this->representante, PDO::PARAM_STR);
                        break;
                    case 'TELEFONO':                        
                        $stmt->bindValue($identifier, $this->telefono, PDO::PARAM_STR);
                        break;
                    case 'CELULAR':                        
                        $stmt->bindValue($identifier, $this->celular, PDO::PARAM_STR);
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
        $pos = JobEmpresaSuscritaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getScrapEmpresaId();
                break;
            case 4:
                return $this->getNombre();
                break;
            case 5:
                return $this->getNit();
                break;
            case 6:
                return $this->getEmail();
                break;
            case 7:
                return $this->getDireccion();
                break;
            case 8:
                return $this->getRepresentante();
                break;
            case 9:
                return $this->getTelefono();
                break;
            case 10:
                return $this->getCelular();
                break;
            case 11:
                return $this->getLastUserId();
                break;
            case 12:
                return $this->getCreationDate();
                break;
            case 13:
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

        if (isset($alreadyDumpedObjects['JobEmpresaSuscrita'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JobEmpresaSuscrita'][$this->hashCode()] = true;
        $keys = JobEmpresaSuscritaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEntityTypeId(),
            $keys[2] => $this->getLocationId(),
            $keys[3] => $this->getScrapEmpresaId(),
            $keys[4] => $this->getNombre(),
            $keys[5] => $this->getNit(),
            $keys[6] => $this->getEmail(),
            $keys[7] => $this->getDireccion(),
            $keys[8] => $this->getRepresentante(),
            $keys[9] => $this->getTelefono(),
            $keys[10] => $this->getCelular(),
            $keys[11] => $this->getLastUserId(),
            $keys[12] => $this->getCreationDate(),
            $keys[13] => $this->getModificacionDate(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[12]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[12]];
            $result[$keys[12]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[13]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[13]];
            $result[$keys[13]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
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
     * @return $this|\JobEmpresaSuscrita
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = JobEmpresaSuscritaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\JobEmpresaSuscrita
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
                $this->setScrapEmpresaId($value);
                break;
            case 4:
                $this->setNombre($value);
                break;
            case 5:
                $this->setNit($value);
                break;
            case 6:
                $this->setEmail($value);
                break;
            case 7:
                $this->setDireccion($value);
                break;
            case 8:
                $this->setRepresentante($value);
                break;
            case 9:
                $this->setTelefono($value);
                break;
            case 10:
                $this->setCelular($value);
                break;
            case 11:
                $this->setLastUserId($value);
                break;
            case 12:
                $this->setCreationDate($value);
                break;
            case 13:
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
        $keys = JobEmpresaSuscritaTableMap::getFieldNames($keyType);

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
            $this->setScrapEmpresaId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNombre($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNit($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEmail($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDireccion($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setRepresentante($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTelefono($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCelular($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLastUserId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreationDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setModificacionDate($arr[$keys[13]]);
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
     * @return $this|\JobEmpresaSuscrita The current object, for fluid interface
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
        $criteria = new Criteria(JobEmpresaSuscritaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_ID)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_ENTITY_TYPE_ID, $this->entity_type_id);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_LOCATION_ID)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_SCRAP_EMPRESA_ID, $this->scrap_empresa_id);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_NOMBRE)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_NIT)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_NIT, $this->nit);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_EMAIL)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_DIRECCION)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_DIRECCION, $this->direccion);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_REPRESENTANTE)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_REPRESENTANTE, $this->representante);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_TELEFONO)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_TELEFONO, $this->telefono);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_CELULAR)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_CELULAR, $this->celular);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_LAST_USER_ID)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_LAST_USER_ID, $this->last_user_id);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_CREATION_DATE)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE)) {
            $criteria->add(JobEmpresaSuscritaTableMap::COL_MODIFICACION_DATE, $this->modificacion_date);
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
        $criteria = ChildJobEmpresaSuscritaQuery::create();
        $criteria->add(JobEmpresaSuscritaTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \JobEmpresaSuscrita (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEntityTypeId($this->getEntityTypeId());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setScrapEmpresaId($this->getScrapEmpresaId());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setNit($this->getNit());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setDireccion($this->getDireccion());
        $copyObj->setRepresentante($this->getRepresentante());
        $copyObj->setTelefono($this->getTelefono());
        $copyObj->setCelular($this->getCelular());
        $copyObj->setLastUserId($this->getLastUserId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificacionDate($this->getModificacionDate());
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
     * @return \JobEmpresaSuscrita Clone of current object.
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
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
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
            $v->addJobEmpresaSuscrita($this);
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
                $this->aSysEntityType->addJobEmpresaSuscritas($this);
             */
        }

        return $this->aSysEntityType;
    }

    /**
     * Declares an association between this object and a ChildSysLocation object.
     *
     * @param  ChildSysLocation $v
     * @return $this|\JobEmpresaSuscrita The current object (for fluent API support)
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
            $v->addJobEmpresaSuscrita($this);
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
                $this->aSysLocation->addJobEmpresaSuscritas($this);
             */
        }

        return $this->aSysLocation;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSysEntityType) {
            $this->aSysEntityType->removeJobEmpresaSuscrita($this);
        }
        if (null !== $this->aSysLocation) {
            $this->aSysLocation->removeJobEmpresaSuscrita($this);
        }
        $this->id = null;
        $this->entity_type_id = null;
        $this->location_id = null;
        $this->scrap_empresa_id = null;
        $this->nombre = null;
        $this->nit = null;
        $this->email = null;
        $this->direccion = null;
        $this->representante = null;
        $this->telefono = null;
        $this->celular = null;
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
        } // if ($deep)

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
        return (string) $this->exportTo(JobEmpresaSuscritaTableMap::DEFAULT_STRING_FORMAT);
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
