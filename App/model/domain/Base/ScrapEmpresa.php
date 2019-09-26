<?php

namespace Base;

use \ScrapActividad as ChildScrapActividad;
use \ScrapActividadQuery as ChildScrapActividadQuery;
use \ScrapEmpresaQuery as ChildScrapEmpresaQuery;
use \ScrapPagina as ChildScrapPagina;
use \ScrapPaginaQuery as ChildScrapPaginaQuery;
use \ScrapTipoEmpresa as ChildScrapTipoEmpresa;
use \ScrapTipoEmpresaQuery as ChildScrapTipoEmpresaQuery;
use \Exception;
use \PDO;
use Map\ScrapEmpresaTableMap;
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

/**
 * Base class that represents a row from the 'scrap_empresa' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class ScrapEmpresa implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ScrapEmpresaTableMap';


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
     * The value for the id_pagina field.
     *
     * @var        int
     */
    protected $id_pagina;

    /**
     * The value for the id_actividad field.
     *
     * @var        int
     */
    protected $id_actividad;

    /**
     * The value for the id_tipo_empresa field.
     *
     * @var        int
     */
    protected $id_tipo_empresa;

    /**
     * The value for the id_empresa field.
     *
     * @var        string
     */
    protected $id_empresa;

    /**
     * The value for the nit field.
     *
     * @var        string
     */
    protected $nit;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the actividad field.
     *
     * @var        string
     */
    protected $actividad;

    /**
     * The value for the leido field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $leido;

    /**
     * The value for the matricula field.
     *
     * @var        string
     */
    protected $matricula;

    /**
     * The value for the licencia field.
     *
     * @var        string
     */
    protected $licencia;

    /**
     * The value for the municipio field.
     *
     * @var        string
     */
    protected $municipio;

    /**
     * The value for the direccion field.
     *
     * @var        string
     */
    protected $direccion;

    /**
     * The value for the telefono field.
     *
     * @var        string
     */
    protected $telefono;

    /**
     * The value for the fax field.
     *
     * @var        string
     */
    protected $fax;

    /**
     * @var        ChildScrapActividad
     */
    protected $aScrapActividad;

    /**
     * @var        ChildScrapTipoEmpresa
     */
    protected $aScrapTipoEmpresa;

    /**
     * @var        ChildScrapPagina
     */
    protected $aScrapPagina;

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
        $this->leido = false;
    }

    /**
     * Initializes internal state of Base\ScrapEmpresa object.
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
     * Compares this with another <code>ScrapEmpresa</code> instance.  If
     * <code>obj</code> is an instance of <code>ScrapEmpresa</code>, delegates to
     * <code>equals(ScrapEmpresa)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|ScrapEmpresa The current object, for fluid interface
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
     * Get the [id_pagina] column value.
     *
     * @return int
     */
    public function getIdPagina()
    {
        return $this->id_pagina;
    }

    /**
     * Get the [id_actividad] column value.
     *
     * @return int
     */
    public function getIdActividad()
    {
        return $this->id_actividad;
    }

    /**
     * Get the [id_tipo_empresa] column value.
     *
     * @return int
     */
    public function getIdTipoEmpresa()
    {
        return $this->id_tipo_empresa;
    }

    /**
     * Get the [id_empresa] column value.
     *
     * @return string
     */
    public function getIdEmpresa()
    {
        return $this->id_empresa;
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
     * Get the [nombre] column value.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
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
     * Get the [actividad] column value.
     *
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Get the [leido] column value.
     *
     * @return boolean
     */
    public function getLeido()
    {
        return $this->leido;
    }

    /**
     * Get the [leido] column value.
     *
     * @return boolean
     */
    public function isLeido()
    {
        return $this->getLeido();
    }

    /**
     * Get the [matricula] column value.
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Get the [licencia] column value.
     *
     * @return string
     */
    public function getLicencia()
    {
        return $this->licencia;
    }

    /**
     * Get the [municipio] column value.
     *
     * @return string
     */
    public function getMunicipio()
    {
        return $this->municipio;
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
     * Get the [telefono] column value.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Get the [fax] column value.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_pagina] column.
     *
     * @param int $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setIdPagina($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_pagina !== $v) {
            $this->id_pagina = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_ID_PAGINA] = true;
        }

        if ($this->aScrapPagina !== null && $this->aScrapPagina->getId() !== $v) {
            $this->aScrapPagina = null;
        }

        return $this;
    } // setIdPagina()

    /**
     * Set the value of [id_actividad] column.
     *
     * @param int $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setIdActividad($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_actividad !== $v) {
            $this->id_actividad = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_ID_ACTIVIDAD] = true;
        }

        if ($this->aScrapActividad !== null && $this->aScrapActividad->getId() !== $v) {
            $this->aScrapActividad = null;
        }

        return $this;
    } // setIdActividad()

    /**
     * Set the value of [id_tipo_empresa] column.
     *
     * @param int $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setIdTipoEmpresa($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_tipo_empresa !== $v) {
            $this->id_tipo_empresa = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA] = true;
        }

        if ($this->aScrapTipoEmpresa !== null && $this->aScrapTipoEmpresa->getId() !== $v) {
            $this->aScrapTipoEmpresa = null;
        }

        return $this;
    } // setIdTipoEmpresa()

    /**
     * Set the value of [id_empresa] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setIdEmpresa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id_empresa !== $v) {
            $this->id_empresa = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_ID_EMPRESA] = true;
        }

        return $this;
    } // setIdEmpresa()

    /**
     * Set the value of [nit] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setNit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nit !== $v) {
            $this->nit = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_NIT] = true;
        }

        return $this;
    } // setNit()

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [actividad] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setActividad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->actividad !== $v) {
            $this->actividad = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_ACTIVIDAD] = true;
        }

        return $this;
    } // setActividad()

    /**
     * Sets the value of the [leido] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setLeido($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->leido !== $v) {
            $this->leido = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_LEIDO] = true;
        }

        return $this;
    } // setLeido()

    /**
     * Set the value of [matricula] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setMatricula($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->matricula !== $v) {
            $this->matricula = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_MATRICULA] = true;
        }

        return $this;
    } // setMatricula()

    /**
     * Set the value of [licencia] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setLicencia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->licencia !== $v) {
            $this->licencia = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_LICENCIA] = true;
        }

        return $this;
    } // setLicencia()

    /**
     * Set the value of [municipio] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setMunicipio($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->municipio !== $v) {
            $this->municipio = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_MUNICIPIO] = true;
        }

        return $this;
    } // setMunicipio()

    /**
     * Set the value of [direccion] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->direccion !== $v) {
            $this->direccion = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_DIRECCION] = true;
        }

        return $this;
    } // setDireccion()

    /**
     * Set the value of [telefono] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setTelefono($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefono !== $v) {
            $this->telefono = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_TELEFONO] = true;
        }

        return $this;
    } // setTelefono()

    /**
     * Set the value of [fax] column.
     *
     * @param string $v new value
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[ScrapEmpresaTableMap::COL_FAX] = true;
        }

        return $this;
    } // setFax()

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
            if ($this->leido !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ScrapEmpresaTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ScrapEmpresaTableMap::translateFieldName('IdPagina', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_pagina = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ScrapEmpresaTableMap::translateFieldName('IdActividad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_actividad = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ScrapEmpresaTableMap::translateFieldName('IdTipoEmpresa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_tipo_empresa = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ScrapEmpresaTableMap::translateFieldName('IdEmpresa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_empresa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ScrapEmpresaTableMap::translateFieldName('Nit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ScrapEmpresaTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ScrapEmpresaTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ScrapEmpresaTableMap::translateFieldName('Actividad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->actividad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ScrapEmpresaTableMap::translateFieldName('Leido', TableMap::TYPE_PHPNAME, $indexType)];
            $this->leido = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ScrapEmpresaTableMap::translateFieldName('Matricula', TableMap::TYPE_PHPNAME, $indexType)];
            $this->matricula = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ScrapEmpresaTableMap::translateFieldName('Licencia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->licencia = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ScrapEmpresaTableMap::translateFieldName('Municipio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->municipio = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ScrapEmpresaTableMap::translateFieldName('Direccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->direccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ScrapEmpresaTableMap::translateFieldName('Telefono', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ScrapEmpresaTableMap::translateFieldName('Fax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fax = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = ScrapEmpresaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\ScrapEmpresa'), 0, $e);
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
        if ($this->aScrapPagina !== null && $this->id_pagina !== $this->aScrapPagina->getId()) {
            $this->aScrapPagina = null;
        }
        if ($this->aScrapActividad !== null && $this->id_actividad !== $this->aScrapActividad->getId()) {
            $this->aScrapActividad = null;
        }
        if ($this->aScrapTipoEmpresa !== null && $this->id_tipo_empresa !== $this->aScrapTipoEmpresa->getId()) {
            $this->aScrapTipoEmpresa = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ScrapEmpresaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildScrapEmpresaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aScrapActividad = null;
            $this->aScrapTipoEmpresa = null;
            $this->aScrapPagina = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ScrapEmpresa::setDeleted()
     * @see ScrapEmpresa::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapEmpresaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildScrapEmpresaQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ScrapEmpresaTableMap::DATABASE_NAME);
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
                ScrapEmpresaTableMap::addInstanceToPool($this);
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

            if ($this->aScrapActividad !== null) {
                if ($this->aScrapActividad->isModified() || $this->aScrapActividad->isNew()) {
                    $affectedRows += $this->aScrapActividad->save($con);
                }
                $this->setScrapActividad($this->aScrapActividad);
            }

            if ($this->aScrapTipoEmpresa !== null) {
                if ($this->aScrapTipoEmpresa->isModified() || $this->aScrapTipoEmpresa->isNew()) {
                    $affectedRows += $this->aScrapTipoEmpresa->save($con);
                }
                $this->setScrapTipoEmpresa($this->aScrapTipoEmpresa);
            }

            if ($this->aScrapPagina !== null) {
                if ($this->aScrapPagina->isModified() || $this->aScrapPagina->isNew()) {
                    $affectedRows += $this->aScrapPagina->save($con);
                }
                $this->setScrapPagina($this->aScrapPagina);
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

        $this->modifiedColumns[ScrapEmpresaTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ScrapEmpresaTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_PAGINA)) {
            $modifiedColumns[':p' . $index++]  = 'ID_PAGINA';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD)) {
            $modifiedColumns[':p' . $index++]  = 'ID_ACTIVIDAD';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA)) {
            $modifiedColumns[':p' . $index++]  = 'ID_TIPO_EMPRESA';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_EMPRESA)) {
            $modifiedColumns[':p' . $index++]  = 'ID_EMPRESA';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_NIT)) {
            $modifiedColumns[':p' . $index++]  = 'NIT';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'NOMBRE';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ACTIVIDAD)) {
            $modifiedColumns[':p' . $index++]  = 'ACTIVIDAD';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_LEIDO)) {
            $modifiedColumns[':p' . $index++]  = 'LEIDO';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_MATRICULA)) {
            $modifiedColumns[':p' . $index++]  = 'MATRICULA';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_LICENCIA)) {
            $modifiedColumns[':p' . $index++]  = 'LICENCIA';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_MUNICIPIO)) {
            $modifiedColumns[':p' . $index++]  = 'MUNICIPIO';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = 'DIRECCION';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_TELEFONO)) {
            $modifiedColumns[':p' . $index++]  = 'TELEFONO';
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_FAX)) {
            $modifiedColumns[':p' . $index++]  = 'FAX';
        }

        $sql = sprintf(
            'INSERT INTO scrap_empresa (%s) VALUES (%s)',
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
                    case 'ID_PAGINA':
                        $stmt->bindValue($identifier, $this->id_pagina, PDO::PARAM_INT);
                        break;
                    case 'ID_ACTIVIDAD':
                        $stmt->bindValue($identifier, $this->id_actividad, PDO::PARAM_INT);
                        break;
                    case 'ID_TIPO_EMPRESA':
                        $stmt->bindValue($identifier, $this->id_tipo_empresa, PDO::PARAM_INT);
                        break;
                    case 'ID_EMPRESA':
                        $stmt->bindValue($identifier, $this->id_empresa, PDO::PARAM_STR);
                        break;
                    case 'NIT':
                        $stmt->bindValue($identifier, $this->nit, PDO::PARAM_STR);
                        break;
                    case 'NOMBRE':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'ACTIVIDAD':
                        $stmt->bindValue($identifier, $this->actividad, PDO::PARAM_STR);
                        break;
                    case 'LEIDO':
                        $stmt->bindValue($identifier, (int) $this->leido, PDO::PARAM_INT);
                        break;
                    case 'MATRICULA':
                        $stmt->bindValue($identifier, $this->matricula, PDO::PARAM_STR);
                        break;
                    case 'LICENCIA':
                        $stmt->bindValue($identifier, $this->licencia, PDO::PARAM_STR);
                        break;
                    case 'MUNICIPIO':
                        $stmt->bindValue($identifier, $this->municipio, PDO::PARAM_STR);
                        break;
                    case 'DIRECCION':
                        $stmt->bindValue($identifier, $this->direccion, PDO::PARAM_STR);
                        break;
                    case 'TELEFONO':
                        $stmt->bindValue($identifier, $this->telefono, PDO::PARAM_STR);
                        break;
                    case 'FAX':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_STR);
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
        $pos = ScrapEmpresaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdPagina();
                break;
            case 2:
                return $this->getIdActividad();
                break;
            case 3:
                return $this->getIdTipoEmpresa();
                break;
            case 4:
                return $this->getIdEmpresa();
                break;
            case 5:
                return $this->getNit();
                break;
            case 6:
                return $this->getNombre();
                break;
            case 7:
                return $this->getEmail();
                break;
            case 8:
                return $this->getActividad();
                break;
            case 9:
                return $this->getLeido();
                break;
            case 10:
                return $this->getMatricula();
                break;
            case 11:
                return $this->getLicencia();
                break;
            case 12:
                return $this->getMunicipio();
                break;
            case 13:
                return $this->getDireccion();
                break;
            case 14:
                return $this->getTelefono();
                break;
            case 15:
                return $this->getFax();
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

        if (isset($alreadyDumpedObjects['ScrapEmpresa'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ScrapEmpresa'][$this->hashCode()] = true;
        $keys = ScrapEmpresaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdPagina(),
            $keys[2] => $this->getIdActividad(),
            $keys[3] => $this->getIdTipoEmpresa(),
            $keys[4] => $this->getIdEmpresa(),
            $keys[5] => $this->getNit(),
            $keys[6] => $this->getNombre(),
            $keys[7] => $this->getEmail(),
            $keys[8] => $this->getActividad(),
            $keys[9] => $this->getLeido(),
            $keys[10] => $this->getMatricula(),
            $keys[11] => $this->getLicencia(),
            $keys[12] => $this->getMunicipio(),
            $keys[13] => $this->getDireccion(),
            $keys[14] => $this->getTelefono(),
            $keys[15] => $this->getFax(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aScrapActividad) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'scrapActividad';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'scrap_actividad';
                        break;
                    default:
                        $key = 'ScrapActividad';
                }

                $result[$key] = $this->aScrapActividad->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aScrapTipoEmpresa) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'scrapTipoEmpresa';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'scrap_tipo_empresa';
                        break;
                    default:
                        $key = 'ScrapTipoEmpresa';
                }

                $result[$key] = $this->aScrapTipoEmpresa->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aScrapPagina) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'scrapPagina';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'scrap_pagina';
                        break;
                    default:
                        $key = 'ScrapPagina';
                }

                $result[$key] = $this->aScrapPagina->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\ScrapEmpresa
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ScrapEmpresaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\ScrapEmpresa
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdPagina($value);
                break;
            case 2:
                $this->setIdActividad($value);
                break;
            case 3:
                $this->setIdTipoEmpresa($value);
                break;
            case 4:
                $this->setIdEmpresa($value);
                break;
            case 5:
                $this->setNit($value);
                break;
            case 6:
                $this->setNombre($value);
                break;
            case 7:
                $this->setEmail($value);
                break;
            case 8:
                $this->setActividad($value);
                break;
            case 9:
                $this->setLeido($value);
                break;
            case 10:
                $this->setMatricula($value);
                break;
            case 11:
                $this->setLicencia($value);
                break;
            case 12:
                $this->setMunicipio($value);
                break;
            case 13:
                $this->setDireccion($value);
                break;
            case 14:
                $this->setTelefono($value);
                break;
            case 15:
                $this->setFax($value);
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
        $keys = ScrapEmpresaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdPagina($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdActividad($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIdTipoEmpresa($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIdEmpresa($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNit($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNombre($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setActividad($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLeido($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMatricula($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLicencia($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setMunicipio($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDireccion($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setTelefono($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setFax($arr[$keys[15]]);
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
     * @return $this|\ScrapEmpresa The current object, for fluid interface
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
        $criteria = new Criteria(ScrapEmpresaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID)) {
            $criteria->add(ScrapEmpresaTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_PAGINA)) {
            $criteria->add(ScrapEmpresaTableMap::COL_ID_PAGINA, $this->id_pagina);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD)) {
            $criteria->add(ScrapEmpresaTableMap::COL_ID_ACTIVIDAD, $this->id_actividad);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA)) {
            $criteria->add(ScrapEmpresaTableMap::COL_ID_TIPO_EMPRESA, $this->id_tipo_empresa);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ID_EMPRESA)) {
            $criteria->add(ScrapEmpresaTableMap::COL_ID_EMPRESA, $this->id_empresa);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_NIT)) {
            $criteria->add(ScrapEmpresaTableMap::COL_NIT, $this->nit);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_NOMBRE)) {
            $criteria->add(ScrapEmpresaTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_EMAIL)) {
            $criteria->add(ScrapEmpresaTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_ACTIVIDAD)) {
            $criteria->add(ScrapEmpresaTableMap::COL_ACTIVIDAD, $this->actividad);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_LEIDO)) {
            $criteria->add(ScrapEmpresaTableMap::COL_LEIDO, $this->leido);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_MATRICULA)) {
            $criteria->add(ScrapEmpresaTableMap::COL_MATRICULA, $this->matricula);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_LICENCIA)) {
            $criteria->add(ScrapEmpresaTableMap::COL_LICENCIA, $this->licencia);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_MUNICIPIO)) {
            $criteria->add(ScrapEmpresaTableMap::COL_MUNICIPIO, $this->municipio);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_DIRECCION)) {
            $criteria->add(ScrapEmpresaTableMap::COL_DIRECCION, $this->direccion);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_TELEFONO)) {
            $criteria->add(ScrapEmpresaTableMap::COL_TELEFONO, $this->telefono);
        }
        if ($this->isColumnModified(ScrapEmpresaTableMap::COL_FAX)) {
            $criteria->add(ScrapEmpresaTableMap::COL_FAX, $this->fax);
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
        $criteria = ChildScrapEmpresaQuery::create();
        $criteria->add(ScrapEmpresaTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \ScrapEmpresa (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdPagina($this->getIdPagina());
        $copyObj->setIdActividad($this->getIdActividad());
        $copyObj->setIdTipoEmpresa($this->getIdTipoEmpresa());
        $copyObj->setIdEmpresa($this->getIdEmpresa());
        $copyObj->setNit($this->getNit());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setActividad($this->getActividad());
        $copyObj->setLeido($this->getLeido());
        $copyObj->setMatricula($this->getMatricula());
        $copyObj->setLicencia($this->getLicencia());
        $copyObj->setMunicipio($this->getMunicipio());
        $copyObj->setDireccion($this->getDireccion());
        $copyObj->setTelefono($this->getTelefono());
        $copyObj->setFax($this->getFax());
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
     * @return \ScrapEmpresa Clone of current object.
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
     * Declares an association between this object and a ChildScrapActividad object.
     *
     * @param  ChildScrapActividad $v
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     * @throws PropelException
     */
    public function setScrapActividad(ChildScrapActividad $v = null)
    {
        if ($v === null) {
            $this->setIdActividad(NULL);
        } else {
            $this->setIdActividad($v->getId());
        }

        $this->aScrapActividad = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildScrapActividad object, it will not be re-added.
        if ($v !== null) {
            $v->addScrapEmpresa($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildScrapActividad object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildScrapActividad The associated ChildScrapActividad object.
     * @throws PropelException
     */
    public function getScrapActividad(ConnectionInterface $con = null)
    {
        if ($this->aScrapActividad === null && ($this->id_actividad != 0)) {
            $this->aScrapActividad = ChildScrapActividadQuery::create()->findPk($this->id_actividad, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aScrapActividad->addScrapEmpresas($this);
             */
        }

        return $this->aScrapActividad;
    }

    /**
     * Declares an association between this object and a ChildScrapTipoEmpresa object.
     *
     * @param  ChildScrapTipoEmpresa $v
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     * @throws PropelException
     */
    public function setScrapTipoEmpresa(ChildScrapTipoEmpresa $v = null)
    {
        if ($v === null) {
            $this->setIdTipoEmpresa(NULL);
        } else {
            $this->setIdTipoEmpresa($v->getId());
        }

        $this->aScrapTipoEmpresa = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildScrapTipoEmpresa object, it will not be re-added.
        if ($v !== null) {
            $v->addScrapEmpresa($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildScrapTipoEmpresa object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildScrapTipoEmpresa The associated ChildScrapTipoEmpresa object.
     * @throws PropelException
     */
    public function getScrapTipoEmpresa(ConnectionInterface $con = null)
    {
        if ($this->aScrapTipoEmpresa === null && ($this->id_tipo_empresa != 0)) {
            $this->aScrapTipoEmpresa = ChildScrapTipoEmpresaQuery::create()->findPk($this->id_tipo_empresa, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aScrapTipoEmpresa->addScrapEmpresas($this);
             */
        }

        return $this->aScrapTipoEmpresa;
    }

    /**
     * Declares an association between this object and a ChildScrapPagina object.
     *
     * @param  ChildScrapPagina $v
     * @return $this|\ScrapEmpresa The current object (for fluent API support)
     * @throws PropelException
     */
    public function setScrapPagina(ChildScrapPagina $v = null)
    {
        if ($v === null) {
            $this->setIdPagina(NULL);
        } else {
            $this->setIdPagina($v->getId());
        }

        $this->aScrapPagina = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildScrapPagina object, it will not be re-added.
        if ($v !== null) {
            $v->addScrapEmpresa($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildScrapPagina object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildScrapPagina The associated ChildScrapPagina object.
     * @throws PropelException
     */
    public function getScrapPagina(ConnectionInterface $con = null)
    {
        if ($this->aScrapPagina === null && ($this->id_pagina != 0)) {
            $this->aScrapPagina = ChildScrapPaginaQuery::create()->findPk($this->id_pagina, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aScrapPagina->addScrapEmpresas($this);
             */
        }

        return $this->aScrapPagina;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aScrapActividad) {
            $this->aScrapActividad->removeScrapEmpresa($this);
        }
        if (null !== $this->aScrapTipoEmpresa) {
            $this->aScrapTipoEmpresa->removeScrapEmpresa($this);
        }
        if (null !== $this->aScrapPagina) {
            $this->aScrapPagina->removeScrapEmpresa($this);
        }
        $this->id = null;
        $this->id_pagina = null;
        $this->id_actividad = null;
        $this->id_tipo_empresa = null;
        $this->id_empresa = null;
        $this->nit = null;
        $this->nombre = null;
        $this->email = null;
        $this->actividad = null;
        $this->leido = null;
        $this->matricula = null;
        $this->licencia = null;
        $this->municipio = null;
        $this->direccion = null;
        $this->telefono = null;
        $this->fax = null;
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

        $this->aScrapActividad = null;
        $this->aScrapTipoEmpresa = null;
        $this->aScrapPagina = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ScrapEmpresaTableMap::DEFAULT_STRING_FORMAT);
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
