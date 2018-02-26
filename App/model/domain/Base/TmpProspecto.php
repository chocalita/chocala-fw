<?php

namespace Base;

use \TmpProspectoQuery as ChildTmpProspectoQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\TmpProspectoTableMap;
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
 * Base class that represents a row from the 'tmp_prospecto' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class TmpProspecto implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\TmpProspectoTableMap';


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
     * The value for the primer_apellido field.
     *
     * @var        string
     */
    protected $primer_apellido;

    /**
     * The value for the segundo_apellido field.
     *
     * @var        string
     */
    protected $segundo_apellido;

    /**
     * The value for the nombres field.
     *
     * @var        string
     */
    protected $nombres;

    /**
     * The value for the fecha_nacimiento field.
     *
     * @var        DateTime
     */
    protected $fecha_nacimiento;

    /**
     * The value for the ci field.
     *
     * @var        string
     */
    protected $ci;

    /**
     * The value for the extension_ci field.
     *
     * @var        string
     */
    protected $extension_ci;

    /**
     * The value for the sexo field.
     *
     * @var        string
     */
    protected $sexo;

    /**
     * The value for the pais field.
     *
     * @var        string
     */
    protected $pais;

    /**
     * The value for the residencia field.
     *
     * @var        string
     */
    protected $residencia;

    /**
     * The value for the direccion field.
     *
     * @var        string
     */
    protected $direccion;

    /**
     * The value for the celular field.
     *
     * @var        string
     */
    protected $celular;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the salario field.
     *
     * @var        int
     */
    protected $salario;

    /**
     * The value for the areas field.
     *
     * @var        string
     */
    protected $areas;

    /**
     * The value for the formaciones field.
     *
     * @var        string
     */
    protected $formaciones;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\TmpProspecto object.
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
     * Compares this with another <code>TmpProspecto</code> instance.  If
     * <code>obj</code> is an instance of <code>TmpProspecto</code>, delegates to
     * <code>equals(TmpProspecto)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|TmpProspecto The current object, for fluid interface
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
     * Get the [primer_apellido] column value.
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primer_apellido;
    }

    /**
     * Get the [segundo_apellido] column value.
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundo_apellido;
    }

    /**
     * Get the [nombres] column value.
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_nacimiento] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaNacimiento($format = NULL)
    {
        if ($format === null) {
            return $this->fecha_nacimiento;
        } else {
            return $this->fecha_nacimiento instanceof \DateTimeInterface ? $this->fecha_nacimiento->format($format) : null;
        }
    }

    /**
     * Get the [ci] column value.
     *
     * @return string
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Get the [extension_ci] column value.
     *
     * @return string
     */
    public function getExtensionCi()
    {
        return $this->extension_ci;
    }

    /**
     * Get the [sexo] column value.
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Get the [pais] column value.
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Get the [residencia] column value.
     *
     * @return string
     */
    public function getResidencia()
    {
        return $this->residencia;
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
     * Get the [celular] column value.
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
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
     * Get the [salario] column value.
     *
     * @return int
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Get the [areas] column value.
     *
     * @return string
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * Get the [formaciones] column value.
     *
     * @return string
     */
    public function getFormaciones()
    {
        return $this->formaciones;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [primer_apellido] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setPrimerApellido($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->primer_apellido !== $v) {
            $this->primer_apellido = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_PRIMER_APELLIDO] = true;
        }

        return $this;
    } // setPrimerApellido()

    /**
     * Set the value of [segundo_apellido] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setSegundoApellido($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->segundo_apellido !== $v) {
            $this->segundo_apellido = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_SEGUNDO_APELLIDO] = true;
        }

        return $this;
    } // setSegundoApellido()

    /**
     * Set the value of [nombres] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setNombres($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombres !== $v) {
            $this->nombres = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_NOMBRES] = true;
        }

        return $this;
    } // setNombres()

    /**
     * Sets the value of [fecha_nacimiento] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setFechaNacimiento($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_nacimiento !== null || $dt !== null) {
            if ($this->fecha_nacimiento === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_nacimiento->format("Y-m-d")) {
                $this->fecha_nacimiento = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TmpProspectoTableMap::COL_FECHA_NACIMIENTO] = true;
            }
        } // if either are not null

        return $this;
    } // setFechaNacimiento()

    /**
     * Set the value of [ci] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setCi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ci !== $v) {
            $this->ci = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_CI] = true;
        }

        return $this;
    } // setCi()

    /**
     * Set the value of [extension_ci] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setExtensionCi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->extension_ci !== $v) {
            $this->extension_ci = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_EXTENSION_CI] = true;
        }

        return $this;
    } // setExtensionCi()

    /**
     * Set the value of [sexo] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setSexo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sexo !== $v) {
            $this->sexo = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_SEXO] = true;
        }

        return $this;
    } // setSexo()

    /**
     * Set the value of [pais] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setPais($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pais !== $v) {
            $this->pais = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_PAIS] = true;
        }

        return $this;
    } // setPais()

    /**
     * Set the value of [residencia] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setResidencia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->residencia !== $v) {
            $this->residencia = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_RESIDENCIA] = true;
        }

        return $this;
    } // setResidencia()

    /**
     * Set the value of [direccion] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->direccion !== $v) {
            $this->direccion = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_DIRECCION] = true;
        }

        return $this;
    } // setDireccion()

    /**
     * Set the value of [celular] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setCelular($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->celular !== $v) {
            $this->celular = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_CELULAR] = true;
        }

        return $this;
    } // setCelular()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [salario] column.
     *
     * @param int $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setSalario($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->salario !== $v) {
            $this->salario = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_SALARIO] = true;
        }

        return $this;
    } // setSalario()

    /**
     * Set the value of [areas] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setAreas($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->areas !== $v) {
            $this->areas = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_AREAS] = true;
        }

        return $this;
    } // setAreas()

    /**
     * Set the value of [formaciones] column.
     *
     * @param string $v new value
     * @return $this|\TmpProspecto The current object (for fluent API support)
     */
    public function setFormaciones($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->formaciones !== $v) {
            $this->formaciones = $v;
            $this->modifiedColumns[TmpProspectoTableMap::COL_FORMACIONES] = true;
        }

        return $this;
    } // setFormaciones()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TmpProspectoTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TmpProspectoTableMap::translateFieldName('PrimerApellido', TableMap::TYPE_PHPNAME, $indexType)];
            $this->primer_apellido = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TmpProspectoTableMap::translateFieldName('SegundoApellido', TableMap::TYPE_PHPNAME, $indexType)];
            $this->segundo_apellido = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TmpProspectoTableMap::translateFieldName('Nombres', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombres = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TmpProspectoTableMap::translateFieldName('FechaNacimiento', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_nacimiento = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : TmpProspectoTableMap::translateFieldName('Ci', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ci = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : TmpProspectoTableMap::translateFieldName('ExtensionCi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->extension_ci = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : TmpProspectoTableMap::translateFieldName('Sexo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sexo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : TmpProspectoTableMap::translateFieldName('Pais', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pais = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : TmpProspectoTableMap::translateFieldName('Residencia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->residencia = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : TmpProspectoTableMap::translateFieldName('Direccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->direccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : TmpProspectoTableMap::translateFieldName('Celular', TableMap::TYPE_PHPNAME, $indexType)];
            $this->celular = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : TmpProspectoTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : TmpProspectoTableMap::translateFieldName('Salario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salario = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : TmpProspectoTableMap::translateFieldName('Areas', TableMap::TYPE_PHPNAME, $indexType)];
            $this->areas = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : TmpProspectoTableMap::translateFieldName('Formaciones', TableMap::TYPE_PHPNAME, $indexType)];
            $this->formaciones = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = TmpProspectoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TmpProspecto'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(TmpProspectoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTmpProspectoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see TmpProspecto::setDeleted()
     * @see TmpProspecto::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpProspectoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTmpProspectoQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TmpProspectoTableMap::DATABASE_NAME);
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
                TmpProspectoTableMap::addInstanceToPool($this);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TmpProspectoTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_PRIMER_APELLIDO)) {
            $modifiedColumns[':p' . $index++]  = 'primer_apellido';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_SEGUNDO_APELLIDO)) {
            $modifiedColumns[':p' . $index++]  = 'segundo_apellido';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_NOMBRES)) {
            $modifiedColumns[':p' . $index++]  = 'nombres';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_FECHA_NACIMIENTO)) {
            $modifiedColumns[':p' . $index++]  = 'fecha_nacimiento';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_CI)) {
            $modifiedColumns[':p' . $index++]  = 'ci';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_EXTENSION_CI)) {
            $modifiedColumns[':p' . $index++]  = 'extension_ci';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_SEXO)) {
            $modifiedColumns[':p' . $index++]  = 'sexo';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_PAIS)) {
            $modifiedColumns[':p' . $index++]  = 'pais';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_RESIDENCIA)) {
            $modifiedColumns[':p' . $index++]  = 'residencia';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = 'direccion';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_CELULAR)) {
            $modifiedColumns[':p' . $index++]  = 'celular';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_SALARIO)) {
            $modifiedColumns[':p' . $index++]  = 'salario';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_AREAS)) {
            $modifiedColumns[':p' . $index++]  = 'areas';
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_FORMACIONES)) {
            $modifiedColumns[':p' . $index++]  = 'formaciones';
        }

        $sql = sprintf(
            'INSERT INTO tmp_prospecto (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'primer_apellido':
                        $stmt->bindValue($identifier, $this->primer_apellido, PDO::PARAM_STR);
                        break;
                    case 'segundo_apellido':
                        $stmt->bindValue($identifier, $this->segundo_apellido, PDO::PARAM_STR);
                        break;
                    case 'nombres':
                        $stmt->bindValue($identifier, $this->nombres, PDO::PARAM_STR);
                        break;
                    case 'fecha_nacimiento':
                        $stmt->bindValue($identifier, $this->fecha_nacimiento ? $this->fecha_nacimiento->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ci':
                        $stmt->bindValue($identifier, $this->ci, PDO::PARAM_STR);
                        break;
                    case 'extension_ci':
                        $stmt->bindValue($identifier, $this->extension_ci, PDO::PARAM_STR);
                        break;
                    case 'sexo':
                        $stmt->bindValue($identifier, $this->sexo, PDO::PARAM_STR);
                        break;
                    case 'pais':
                        $stmt->bindValue($identifier, $this->pais, PDO::PARAM_STR);
                        break;
                    case 'residencia':
                        $stmt->bindValue($identifier, $this->residencia, PDO::PARAM_STR);
                        break;
                    case 'direccion':
                        $stmt->bindValue($identifier, $this->direccion, PDO::PARAM_STR);
                        break;
                    case 'celular':
                        $stmt->bindValue($identifier, $this->celular, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'salario':
                        $stmt->bindValue($identifier, $this->salario, PDO::PARAM_INT);
                        break;
                    case 'areas':
                        $stmt->bindValue($identifier, $this->areas, PDO::PARAM_STR);
                        break;
                    case 'formaciones':
                        $stmt->bindValue($identifier, $this->formaciones, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = TmpProspectoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPrimerApellido();
                break;
            case 2:
                return $this->getSegundoApellido();
                break;
            case 3:
                return $this->getNombres();
                break;
            case 4:
                return $this->getFechaNacimiento();
                break;
            case 5:
                return $this->getCi();
                break;
            case 6:
                return $this->getExtensionCi();
                break;
            case 7:
                return $this->getSexo();
                break;
            case 8:
                return $this->getPais();
                break;
            case 9:
                return $this->getResidencia();
                break;
            case 10:
                return $this->getDireccion();
                break;
            case 11:
                return $this->getCelular();
                break;
            case 12:
                return $this->getEmail();
                break;
            case 13:
                return $this->getSalario();
                break;
            case 14:
                return $this->getAreas();
                break;
            case 15:
                return $this->getFormaciones();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['TmpProspecto'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TmpProspecto'][$this->hashCode()] = true;
        $keys = TmpProspectoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPrimerApellido(),
            $keys[2] => $this->getSegundoApellido(),
            $keys[3] => $this->getNombres(),
            $keys[4] => $this->getFechaNacimiento(),
            $keys[5] => $this->getCi(),
            $keys[6] => $this->getExtensionCi(),
            $keys[7] => $this->getSexo(),
            $keys[8] => $this->getPais(),
            $keys[9] => $this->getResidencia(),
            $keys[10] => $this->getDireccion(),
            $keys[11] => $this->getCelular(),
            $keys[12] => $this->getEmail(),
            $keys[13] => $this->getSalario(),
            $keys[14] => $this->getAreas(),
            $keys[15] => $this->getFormaciones(),
        );
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
     * @return $this|\TmpProspecto
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = TmpProspectoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TmpProspecto
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPrimerApellido($value);
                break;
            case 2:
                $this->setSegundoApellido($value);
                break;
            case 3:
                $this->setNombres($value);
                break;
            case 4:
                $this->setFechaNacimiento($value);
                break;
            case 5:
                $this->setCi($value);
                break;
            case 6:
                $this->setExtensionCi($value);
                break;
            case 7:
                $this->setSexo($value);
                break;
            case 8:
                $this->setPais($value);
                break;
            case 9:
                $this->setResidencia($value);
                break;
            case 10:
                $this->setDireccion($value);
                break;
            case 11:
                $this->setCelular($value);
                break;
            case 12:
                $this->setEmail($value);
                break;
            case 13:
                $this->setSalario($value);
                break;
            case 14:
                $this->setAreas($value);
                break;
            case 15:
                $this->setFormaciones($value);
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
        $keys = TmpProspectoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPrimerApellido($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSegundoApellido($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setNombres($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFechaNacimiento($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCi($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setExtensionCi($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSexo($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPais($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setResidencia($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDireccion($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCelular($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setEmail($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setSalario($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setAreas($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setFormaciones($arr[$keys[15]]);
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
     * @return $this|\TmpProspecto The current object, for fluid interface
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
        $criteria = new Criteria(TmpProspectoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TmpProspectoTableMap::COL_ID)) {
            $criteria->add(TmpProspectoTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_PRIMER_APELLIDO)) {
            $criteria->add(TmpProspectoTableMap::COL_PRIMER_APELLIDO, $this->primer_apellido);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_SEGUNDO_APELLIDO)) {
            $criteria->add(TmpProspectoTableMap::COL_SEGUNDO_APELLIDO, $this->segundo_apellido);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_NOMBRES)) {
            $criteria->add(TmpProspectoTableMap::COL_NOMBRES, $this->nombres);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_FECHA_NACIMIENTO)) {
            $criteria->add(TmpProspectoTableMap::COL_FECHA_NACIMIENTO, $this->fecha_nacimiento);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_CI)) {
            $criteria->add(TmpProspectoTableMap::COL_CI, $this->ci);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_EXTENSION_CI)) {
            $criteria->add(TmpProspectoTableMap::COL_EXTENSION_CI, $this->extension_ci);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_SEXO)) {
            $criteria->add(TmpProspectoTableMap::COL_SEXO, $this->sexo);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_PAIS)) {
            $criteria->add(TmpProspectoTableMap::COL_PAIS, $this->pais);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_RESIDENCIA)) {
            $criteria->add(TmpProspectoTableMap::COL_RESIDENCIA, $this->residencia);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_DIRECCION)) {
            $criteria->add(TmpProspectoTableMap::COL_DIRECCION, $this->direccion);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_CELULAR)) {
            $criteria->add(TmpProspectoTableMap::COL_CELULAR, $this->celular);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_EMAIL)) {
            $criteria->add(TmpProspectoTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_SALARIO)) {
            $criteria->add(TmpProspectoTableMap::COL_SALARIO, $this->salario);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_AREAS)) {
            $criteria->add(TmpProspectoTableMap::COL_AREAS, $this->areas);
        }
        if ($this->isColumnModified(TmpProspectoTableMap::COL_FORMACIONES)) {
            $criteria->add(TmpProspectoTableMap::COL_FORMACIONES, $this->formaciones);
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
        $criteria = ChildTmpProspectoQuery::create();
        $criteria->add(TmpProspectoTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \TmpProspecto (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setPrimerApellido($this->getPrimerApellido());
        $copyObj->setSegundoApellido($this->getSegundoApellido());
        $copyObj->setNombres($this->getNombres());
        $copyObj->setFechaNacimiento($this->getFechaNacimiento());
        $copyObj->setCi($this->getCi());
        $copyObj->setExtensionCi($this->getExtensionCi());
        $copyObj->setSexo($this->getSexo());
        $copyObj->setPais($this->getPais());
        $copyObj->setResidencia($this->getResidencia());
        $copyObj->setDireccion($this->getDireccion());
        $copyObj->setCelular($this->getCelular());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setSalario($this->getSalario());
        $copyObj->setAreas($this->getAreas());
        $copyObj->setFormaciones($this->getFormaciones());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \TmpProspecto Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->primer_apellido = null;
        $this->segundo_apellido = null;
        $this->nombres = null;
        $this->fecha_nacimiento = null;
        $this->ci = null;
        $this->extension_ci = null;
        $this->sexo = null;
        $this->pais = null;
        $this->residencia = null;
        $this->direccion = null;
        $this->celular = null;
        $this->email = null;
        $this->salario = null;
        $this->areas = null;
        $this->formaciones = null;
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

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TmpProspectoTableMap::DEFAULT_STRING_FORMAT);
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
