<?php

namespace Base;

use \TmpProspecto as ChildTmpProspecto;
use \TmpProspectoQuery as ChildTmpProspectoQuery;
use \Exception;
use \PDO;
use Map\TmpProspectoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tmp_prospecto' table.
 *
 *
 *
 * @method     ChildTmpProspectoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTmpProspectoQuery orderByPrimerApellido($order = Criteria::ASC) Order by the primer_apellido column
 * @method     ChildTmpProspectoQuery orderBySegundoApellido($order = Criteria::ASC) Order by the segundo_apellido column
 * @method     ChildTmpProspectoQuery orderByNombres($order = Criteria::ASC) Order by the nombres column
 * @method     ChildTmpProspectoQuery orderByFechaNacimiento($order = Criteria::ASC) Order by the fecha_nacimiento column
 * @method     ChildTmpProspectoQuery orderByCi($order = Criteria::ASC) Order by the ci column
 * @method     ChildTmpProspectoQuery orderByExtensionCi($order = Criteria::ASC) Order by the extension_ci column
 * @method     ChildTmpProspectoQuery orderBySexo($order = Criteria::ASC) Order by the sexo column
 * @method     ChildTmpProspectoQuery orderByPais($order = Criteria::ASC) Order by the pais column
 * @method     ChildTmpProspectoQuery orderByResidencia($order = Criteria::ASC) Order by the residencia column
 * @method     ChildTmpProspectoQuery orderByDireccion($order = Criteria::ASC) Order by the direccion column
 * @method     ChildTmpProspectoQuery orderByCelular($order = Criteria::ASC) Order by the celular column
 * @method     ChildTmpProspectoQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildTmpProspectoQuery orderBySalario($order = Criteria::ASC) Order by the salario column
 * @method     ChildTmpProspectoQuery orderByAreas($order = Criteria::ASC) Order by the areas column
 * @method     ChildTmpProspectoQuery orderByFormaciones($order = Criteria::ASC) Order by the formaciones column
 *
 * @method     ChildTmpProspectoQuery groupById() Group by the id column
 * @method     ChildTmpProspectoQuery groupByPrimerApellido() Group by the primer_apellido column
 * @method     ChildTmpProspectoQuery groupBySegundoApellido() Group by the segundo_apellido column
 * @method     ChildTmpProspectoQuery groupByNombres() Group by the nombres column
 * @method     ChildTmpProspectoQuery groupByFechaNacimiento() Group by the fecha_nacimiento column
 * @method     ChildTmpProspectoQuery groupByCi() Group by the ci column
 * @method     ChildTmpProspectoQuery groupByExtensionCi() Group by the extension_ci column
 * @method     ChildTmpProspectoQuery groupBySexo() Group by the sexo column
 * @method     ChildTmpProspectoQuery groupByPais() Group by the pais column
 * @method     ChildTmpProspectoQuery groupByResidencia() Group by the residencia column
 * @method     ChildTmpProspectoQuery groupByDireccion() Group by the direccion column
 * @method     ChildTmpProspectoQuery groupByCelular() Group by the celular column
 * @method     ChildTmpProspectoQuery groupByEmail() Group by the email column
 * @method     ChildTmpProspectoQuery groupBySalario() Group by the salario column
 * @method     ChildTmpProspectoQuery groupByAreas() Group by the areas column
 * @method     ChildTmpProspectoQuery groupByFormaciones() Group by the formaciones column
 *
 * @method     ChildTmpProspectoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTmpProspectoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTmpProspectoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTmpProspectoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTmpProspectoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTmpProspectoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTmpProspecto findOne(ConnectionInterface $con = null) Return the first ChildTmpProspecto matching the query
 * @method     ChildTmpProspecto findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTmpProspecto matching the query, or a new ChildTmpProspecto object populated from the query conditions when no match is found
 *
 * @method     ChildTmpProspecto findOneById(int $id) Return the first ChildTmpProspecto filtered by the id column
 * @method     ChildTmpProspecto findOneByPrimerApellido(string $primer_apellido) Return the first ChildTmpProspecto filtered by the primer_apellido column
 * @method     ChildTmpProspecto findOneBySegundoApellido(string $segundo_apellido) Return the first ChildTmpProspecto filtered by the segundo_apellido column
 * @method     ChildTmpProspecto findOneByNombres(string $nombres) Return the first ChildTmpProspecto filtered by the nombres column
 * @method     ChildTmpProspecto findOneByFechaNacimiento(string $fecha_nacimiento) Return the first ChildTmpProspecto filtered by the fecha_nacimiento column
 * @method     ChildTmpProspecto findOneByCi(string $ci) Return the first ChildTmpProspecto filtered by the ci column
 * @method     ChildTmpProspecto findOneByExtensionCi(string $extension_ci) Return the first ChildTmpProspecto filtered by the extension_ci column
 * @method     ChildTmpProspecto findOneBySexo(string $sexo) Return the first ChildTmpProspecto filtered by the sexo column
 * @method     ChildTmpProspecto findOneByPais(string $pais) Return the first ChildTmpProspecto filtered by the pais column
 * @method     ChildTmpProspecto findOneByResidencia(string $residencia) Return the first ChildTmpProspecto filtered by the residencia column
 * @method     ChildTmpProspecto findOneByDireccion(string $direccion) Return the first ChildTmpProspecto filtered by the direccion column
 * @method     ChildTmpProspecto findOneByCelular(string $celular) Return the first ChildTmpProspecto filtered by the celular column
 * @method     ChildTmpProspecto findOneByEmail(string $email) Return the first ChildTmpProspecto filtered by the email column
 * @method     ChildTmpProspecto findOneBySalario(int $salario) Return the first ChildTmpProspecto filtered by the salario column
 * @method     ChildTmpProspecto findOneByAreas(string $areas) Return the first ChildTmpProspecto filtered by the areas column
 * @method     ChildTmpProspecto findOneByFormaciones(string $formaciones) Return the first ChildTmpProspecto filtered by the formaciones column *

 * @method     ChildTmpProspecto requirePk($key, ConnectionInterface $con = null) Return the ChildTmpProspecto by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOne(ConnectionInterface $con = null) Return the first ChildTmpProspecto matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTmpProspecto requireOneById(int $id) Return the first ChildTmpProspecto filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByPrimerApellido(string $primer_apellido) Return the first ChildTmpProspecto filtered by the primer_apellido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneBySegundoApellido(string $segundo_apellido) Return the first ChildTmpProspecto filtered by the segundo_apellido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByNombres(string $nombres) Return the first ChildTmpProspecto filtered by the nombres column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByFechaNacimiento(string $fecha_nacimiento) Return the first ChildTmpProspecto filtered by the fecha_nacimiento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByCi(string $ci) Return the first ChildTmpProspecto filtered by the ci column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByExtensionCi(string $extension_ci) Return the first ChildTmpProspecto filtered by the extension_ci column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneBySexo(string $sexo) Return the first ChildTmpProspecto filtered by the sexo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByPais(string $pais) Return the first ChildTmpProspecto filtered by the pais column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByResidencia(string $residencia) Return the first ChildTmpProspecto filtered by the residencia column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByDireccion(string $direccion) Return the first ChildTmpProspecto filtered by the direccion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByCelular(string $celular) Return the first ChildTmpProspecto filtered by the celular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByEmail(string $email) Return the first ChildTmpProspecto filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneBySalario(int $salario) Return the first ChildTmpProspecto filtered by the salario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByAreas(string $areas) Return the first ChildTmpProspecto filtered by the areas column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpProspecto requireOneByFormaciones(string $formaciones) Return the first ChildTmpProspecto filtered by the formaciones column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTmpProspecto[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTmpProspecto objects based on current ModelCriteria
 * @method     ChildTmpProspecto[]|ObjectCollection findById(int $id) Return ChildTmpProspecto objects filtered by the id column
 * @method     ChildTmpProspecto[]|ObjectCollection findByPrimerApellido(string $primer_apellido) Return ChildTmpProspecto objects filtered by the primer_apellido column
 * @method     ChildTmpProspecto[]|ObjectCollection findBySegundoApellido(string $segundo_apellido) Return ChildTmpProspecto objects filtered by the segundo_apellido column
 * @method     ChildTmpProspecto[]|ObjectCollection findByNombres(string $nombres) Return ChildTmpProspecto objects filtered by the nombres column
 * @method     ChildTmpProspecto[]|ObjectCollection findByFechaNacimiento(string $fecha_nacimiento) Return ChildTmpProspecto objects filtered by the fecha_nacimiento column
 * @method     ChildTmpProspecto[]|ObjectCollection findByCi(string $ci) Return ChildTmpProspecto objects filtered by the ci column
 * @method     ChildTmpProspecto[]|ObjectCollection findByExtensionCi(string $extension_ci) Return ChildTmpProspecto objects filtered by the extension_ci column
 * @method     ChildTmpProspecto[]|ObjectCollection findBySexo(string $sexo) Return ChildTmpProspecto objects filtered by the sexo column
 * @method     ChildTmpProspecto[]|ObjectCollection findByPais(string $pais) Return ChildTmpProspecto objects filtered by the pais column
 * @method     ChildTmpProspecto[]|ObjectCollection findByResidencia(string $residencia) Return ChildTmpProspecto objects filtered by the residencia column
 * @method     ChildTmpProspecto[]|ObjectCollection findByDireccion(string $direccion) Return ChildTmpProspecto objects filtered by the direccion column
 * @method     ChildTmpProspecto[]|ObjectCollection findByCelular(string $celular) Return ChildTmpProspecto objects filtered by the celular column
 * @method     ChildTmpProspecto[]|ObjectCollection findByEmail(string $email) Return ChildTmpProspecto objects filtered by the email column
 * @method     ChildTmpProspecto[]|ObjectCollection findBySalario(int $salario) Return ChildTmpProspecto objects filtered by the salario column
 * @method     ChildTmpProspecto[]|ObjectCollection findByAreas(string $areas) Return ChildTmpProspecto objects filtered by the areas column
 * @method     ChildTmpProspecto[]|ObjectCollection findByFormaciones(string $formaciones) Return ChildTmpProspecto objects filtered by the formaciones column
 * @method     ChildTmpProspecto[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TmpProspectoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TmpProspectoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TmpProspecto', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTmpProspectoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTmpProspectoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTmpProspectoQuery) {
            return $criteria;
        }
        $query = new ChildTmpProspectoQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTmpProspecto|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TmpProspectoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TmpProspectoTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTmpProspecto A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, primer_apellido, segundo_apellido, nombres, fecha_nacimiento, ci, extension_ci, sexo, pais, residencia, direccion, celular, email, salario, areas, formaciones FROM tmp_prospecto WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTmpProspecto $obj */
            $obj = new ChildTmpProspecto();
            $obj->hydrate($row);
            TmpProspectoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTmpProspecto|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TmpProspectoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TmpProspectoTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TmpProspectoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TmpProspectoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the primer_apellido column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimerApellido('fooValue');   // WHERE primer_apellido = 'fooValue'
     * $query->filterByPrimerApellido('%fooValue%'); // WHERE primer_apellido LIKE '%fooValue%'
     * </code>
     *
     * @param     string $primerApellido The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByPrimerApellido($primerApellido = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($primerApellido)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $primerApellido)) {
                $primerApellido = str_replace('*', '%', $primerApellido);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_PRIMER_APELLIDO, $primerApellido, $comparison);
    }

    /**
     * Filter the query on the segundo_apellido column
     *
     * Example usage:
     * <code>
     * $query->filterBySegundoApellido('fooValue');   // WHERE segundo_apellido = 'fooValue'
     * $query->filterBySegundoApellido('%fooValue%'); // WHERE segundo_apellido LIKE '%fooValue%'
     * </code>
     *
     * @param     string $segundoApellido The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterBySegundoApellido($segundoApellido = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($segundoApellido)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $segundoApellido)) {
                $segundoApellido = str_replace('*', '%', $segundoApellido);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_SEGUNDO_APELLIDO, $segundoApellido, $comparison);
    }

    /**
     * Filter the query on the nombres column
     *
     * Example usage:
     * <code>
     * $query->filterByNombres('fooValue');   // WHERE nombres = 'fooValue'
     * $query->filterByNombres('%fooValue%'); // WHERE nombres LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombres The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByNombres($nombres = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombres)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombres)) {
                $nombres = str_replace('*', '%', $nombres);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_NOMBRES, $nombres, $comparison);
    }

    /**
     * Filter the query on the fecha_nacimiento column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaNacimiento('2011-03-14'); // WHERE fecha_nacimiento = '2011-03-14'
     * $query->filterByFechaNacimiento('now'); // WHERE fecha_nacimiento = '2011-03-14'
     * $query->filterByFechaNacimiento(array('max' => 'yesterday')); // WHERE fecha_nacimiento > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaNacimiento The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByFechaNacimiento($fechaNacimiento = null, $comparison = null)
    {
        if (is_array($fechaNacimiento)) {
            $useMinMax = false;
            if (isset($fechaNacimiento['min'])) {
                $this->addUsingAlias(TmpProspectoTableMap::COL_FECHA_NACIMIENTO, $fechaNacimiento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaNacimiento['max'])) {
                $this->addUsingAlias(TmpProspectoTableMap::COL_FECHA_NACIMIENTO, $fechaNacimiento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_FECHA_NACIMIENTO, $fechaNacimiento, $comparison);
    }

    /**
     * Filter the query on the ci column
     *
     * Example usage:
     * <code>
     * $query->filterByCi('fooValue');   // WHERE ci = 'fooValue'
     * $query->filterByCi('%fooValue%'); // WHERE ci LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ci The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByCi($ci = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ci)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ci)) {
                $ci = str_replace('*', '%', $ci);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_CI, $ci, $comparison);
    }

    /**
     * Filter the query on the extension_ci column
     *
     * Example usage:
     * <code>
     * $query->filterByExtensionCi('fooValue');   // WHERE extension_ci = 'fooValue'
     * $query->filterByExtensionCi('%fooValue%'); // WHERE extension_ci LIKE '%fooValue%'
     * </code>
     *
     * @param     string $extensionCi The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByExtensionCi($extensionCi = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($extensionCi)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $extensionCi)) {
                $extensionCi = str_replace('*', '%', $extensionCi);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_EXTENSION_CI, $extensionCi, $comparison);
    }

    /**
     * Filter the query on the sexo column
     *
     * Example usage:
     * <code>
     * $query->filterBySexo('fooValue');   // WHERE sexo = 'fooValue'
     * $query->filterBySexo('%fooValue%'); // WHERE sexo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sexo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterBySexo($sexo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sexo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sexo)) {
                $sexo = str_replace('*', '%', $sexo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_SEXO, $sexo, $comparison);
    }

    /**
     * Filter the query on the pais column
     *
     * Example usage:
     * <code>
     * $query->filterByPais('fooValue');   // WHERE pais = 'fooValue'
     * $query->filterByPais('%fooValue%'); // WHERE pais LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pais The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByPais($pais = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pais)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pais)) {
                $pais = str_replace('*', '%', $pais);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_PAIS, $pais, $comparison);
    }

    /**
     * Filter the query on the residencia column
     *
     * Example usage:
     * <code>
     * $query->filterByResidencia('fooValue');   // WHERE residencia = 'fooValue'
     * $query->filterByResidencia('%fooValue%'); // WHERE residencia LIKE '%fooValue%'
     * </code>
     *
     * @param     string $residencia The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByResidencia($residencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($residencia)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $residencia)) {
                $residencia = str_replace('*', '%', $residencia);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_RESIDENCIA, $residencia, $comparison);
    }

    /**
     * Filter the query on the direccion column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccion('fooValue');   // WHERE direccion = 'fooValue'
     * $query->filterByDireccion('%fooValue%'); // WHERE direccion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByDireccion($direccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $direccion)) {
                $direccion = str_replace('*', '%', $direccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the celular column
     *
     * Example usage:
     * <code>
     * $query->filterByCelular('fooValue');   // WHERE celular = 'fooValue'
     * $query->filterByCelular('%fooValue%'); // WHERE celular LIKE '%fooValue%'
     * </code>
     *
     * @param     string $celular The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByCelular($celular = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($celular)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $celular)) {
                $celular = str_replace('*', '%', $celular);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_CELULAR, $celular, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the salario column
     *
     * Example usage:
     * <code>
     * $query->filterBySalario(1234); // WHERE salario = 1234
     * $query->filterBySalario(array(12, 34)); // WHERE salario IN (12, 34)
     * $query->filterBySalario(array('min' => 12)); // WHERE salario > 12
     * </code>
     *
     * @param     mixed $salario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterBySalario($salario = null, $comparison = null)
    {
        if (is_array($salario)) {
            $useMinMax = false;
            if (isset($salario['min'])) {
                $this->addUsingAlias(TmpProspectoTableMap::COL_SALARIO, $salario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salario['max'])) {
                $this->addUsingAlias(TmpProspectoTableMap::COL_SALARIO, $salario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_SALARIO, $salario, $comparison);
    }

    /**
     * Filter the query on the areas column
     *
     * Example usage:
     * <code>
     * $query->filterByAreas('fooValue');   // WHERE areas = 'fooValue'
     * $query->filterByAreas('%fooValue%'); // WHERE areas LIKE '%fooValue%'
     * </code>
     *
     * @param     string $areas The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByAreas($areas = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($areas)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $areas)) {
                $areas = str_replace('*', '%', $areas);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_AREAS, $areas, $comparison);
    }

    /**
     * Filter the query on the formaciones column
     *
     * Example usage:
     * <code>
     * $query->filterByFormaciones('fooValue');   // WHERE formaciones = 'fooValue'
     * $query->filterByFormaciones('%fooValue%'); // WHERE formaciones LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formaciones The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function filterByFormaciones($formaciones = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formaciones)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $formaciones)) {
                $formaciones = str_replace('*', '%', $formaciones);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpProspectoTableMap::COL_FORMACIONES, $formaciones, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTmpProspecto $tmpProspecto Object to remove from the list of results
     *
     * @return $this|ChildTmpProspectoQuery The current query, for fluid interface
     */
    public function prune($tmpProspecto = null)
    {
        if ($tmpProspecto) {
            $this->addUsingAlias(TmpProspectoTableMap::COL_ID, $tmpProspecto->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tmp_prospecto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpProspectoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TmpProspectoTableMap::clearInstancePool();
            TmpProspectoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpProspectoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TmpProspectoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TmpProspectoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TmpProspectoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TmpProspectoQuery
