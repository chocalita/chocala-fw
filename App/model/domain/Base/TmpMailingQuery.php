<?php

namespace Base;

use \TmpMailing as ChildTmpMailing;
use \TmpMailingQuery as ChildTmpMailingQuery;
use \Exception;
use \PDO;
use Map\TmpMailingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tmp_mailing' table.
 *
 *
 *
 * @method     ChildTmpMailingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTmpMailingQuery orderByIdProspecto($order = Criteria::ASC) Order by the id_prospecto column
 * @method     ChildTmpMailingQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildTmpMailingQuery orderByAvisos($order = Criteria::ASC) Order by the avisos column
 * @method     ChildTmpMailingQuery orderByFechaInteres($order = Criteria::ASC) Order by the fecha_interes column
 * @method     ChildTmpMailingQuery orderByFechaHoraEnvio($order = Criteria::ASC) Order by the fecha_hora_envio column
 * @method     ChildTmpMailingQuery orderByEnviado($order = Criteria::ASC) Order by the enviado column
 * @method     ChildTmpMailingQuery orderByAbierto($order = Criteria::ASC) Order by the abierto column
 *
 * @method     ChildTmpMailingQuery groupById() Group by the id column
 * @method     ChildTmpMailingQuery groupByIdProspecto() Group by the id_prospecto column
 * @method     ChildTmpMailingQuery groupByEmail() Group by the email column
 * @method     ChildTmpMailingQuery groupByAvisos() Group by the avisos column
 * @method     ChildTmpMailingQuery groupByFechaInteres() Group by the fecha_interes column
 * @method     ChildTmpMailingQuery groupByFechaHoraEnvio() Group by the fecha_hora_envio column
 * @method     ChildTmpMailingQuery groupByEnviado() Group by the enviado column
 * @method     ChildTmpMailingQuery groupByAbierto() Group by the abierto column
 *
 * @method     ChildTmpMailingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTmpMailingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTmpMailingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTmpMailingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTmpMailingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTmpMailingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTmpMailing findOne(ConnectionInterface $con = null) Return the first ChildTmpMailing matching the query
 * @method     ChildTmpMailing findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTmpMailing matching the query, or a new ChildTmpMailing object populated from the query conditions when no match is found
 *
 * @method     ChildTmpMailing findOneById(int $id) Return the first ChildTmpMailing filtered by the id column
 * @method     ChildTmpMailing findOneByIdProspecto(int $id_prospecto) Return the first ChildTmpMailing filtered by the id_prospecto column
 * @method     ChildTmpMailing findOneByEmail(string $email) Return the first ChildTmpMailing filtered by the email column
 * @method     ChildTmpMailing findOneByAvisos(string $avisos) Return the first ChildTmpMailing filtered by the avisos column
 * @method     ChildTmpMailing findOneByFechaInteres(string $fecha_interes) Return the first ChildTmpMailing filtered by the fecha_interes column
 * @method     ChildTmpMailing findOneByFechaHoraEnvio(string $fecha_hora_envio) Return the first ChildTmpMailing filtered by the fecha_hora_envio column
 * @method     ChildTmpMailing findOneByEnviado(boolean $enviado) Return the first ChildTmpMailing filtered by the enviado column
 * @method     ChildTmpMailing findOneByAbierto(boolean $abierto) Return the first ChildTmpMailing filtered by the abierto column *

 * @method     ChildTmpMailing requirePk($key, ConnectionInterface $con = null) Return the ChildTmpMailing by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOne(ConnectionInterface $con = null) Return the first ChildTmpMailing matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTmpMailing requireOneById(int $id) Return the first ChildTmpMailing filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOneByIdProspecto(int $id_prospecto) Return the first ChildTmpMailing filtered by the id_prospecto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOneByEmail(string $email) Return the first ChildTmpMailing filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOneByAvisos(string $avisos) Return the first ChildTmpMailing filtered by the avisos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOneByFechaInteres(string $fecha_interes) Return the first ChildTmpMailing filtered by the fecha_interes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOneByFechaHoraEnvio(string $fecha_hora_envio) Return the first ChildTmpMailing filtered by the fecha_hora_envio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOneByEnviado(boolean $enviado) Return the first ChildTmpMailing filtered by the enviado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTmpMailing requireOneByAbierto(boolean $abierto) Return the first ChildTmpMailing filtered by the abierto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTmpMailing[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTmpMailing objects based on current ModelCriteria
 * @method     ChildTmpMailing[]|ObjectCollection findById(int $id) Return ChildTmpMailing objects filtered by the id column
 * @method     ChildTmpMailing[]|ObjectCollection findByIdProspecto(int $id_prospecto) Return ChildTmpMailing objects filtered by the id_prospecto column
 * @method     ChildTmpMailing[]|ObjectCollection findByEmail(string $email) Return ChildTmpMailing objects filtered by the email column
 * @method     ChildTmpMailing[]|ObjectCollection findByAvisos(string $avisos) Return ChildTmpMailing objects filtered by the avisos column
 * @method     ChildTmpMailing[]|ObjectCollection findByFechaInteres(string $fecha_interes) Return ChildTmpMailing objects filtered by the fecha_interes column
 * @method     ChildTmpMailing[]|ObjectCollection findByFechaHoraEnvio(string $fecha_hora_envio) Return ChildTmpMailing objects filtered by the fecha_hora_envio column
 * @method     ChildTmpMailing[]|ObjectCollection findByEnviado(boolean $enviado) Return ChildTmpMailing objects filtered by the enviado column
 * @method     ChildTmpMailing[]|ObjectCollection findByAbierto(boolean $abierto) Return ChildTmpMailing objects filtered by the abierto column
 * @method     ChildTmpMailing[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TmpMailingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TmpMailingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TmpMailing', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTmpMailingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTmpMailingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTmpMailingQuery) {
            return $criteria;
        }
        $query = new ChildTmpMailingQuery();
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
     * @return ChildTmpMailing|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TmpMailingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TmpMailingTableMap::DATABASE_NAME);
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
     * @return ChildTmpMailing A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_prospecto, email, avisos, fecha_interes, fecha_hora_envio, enviado, abierto FROM tmp_mailing WHERE id = :p0';
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
            /** @var ChildTmpMailing $obj */
            $obj = new ChildTmpMailing();
            $obj->hydrate($row);
            TmpMailingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTmpMailing|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TmpMailingTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TmpMailingTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpMailingTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_prospecto column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProspecto(1234); // WHERE id_prospecto = 1234
     * $query->filterByIdProspecto(array(12, 34)); // WHERE id_prospecto IN (12, 34)
     * $query->filterByIdProspecto(array('min' => 12)); // WHERE id_prospecto > 12
     * </code>
     *
     * @param     mixed $idProspecto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByIdProspecto($idProspecto = null, $comparison = null)
    {
        if (is_array($idProspecto)) {
            $useMinMax = false;
            if (isset($idProspecto['min'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_ID_PROSPECTO, $idProspecto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProspecto['max'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_ID_PROSPECTO, $idProspecto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpMailingTableMap::COL_ID_PROSPECTO, $idProspecto, $comparison);
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
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TmpMailingTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the avisos column
     *
     * Example usage:
     * <code>
     * $query->filterByAvisos('fooValue');   // WHERE avisos = 'fooValue'
     * $query->filterByAvisos('%fooValue%'); // WHERE avisos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avisos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByAvisos($avisos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avisos)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $avisos)) {
                $avisos = str_replace('*', '%', $avisos);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TmpMailingTableMap::COL_AVISOS, $avisos, $comparison);
    }

    /**
     * Filter the query on the fecha_interes column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaInteres('2011-03-14'); // WHERE fecha_interes = '2011-03-14'
     * $query->filterByFechaInteres('now'); // WHERE fecha_interes = '2011-03-14'
     * $query->filterByFechaInteres(array('max' => 'yesterday')); // WHERE fecha_interes > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaInteres The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByFechaInteres($fechaInteres = null, $comparison = null)
    {
        if (is_array($fechaInteres)) {
            $useMinMax = false;
            if (isset($fechaInteres['min'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_FECHA_INTERES, $fechaInteres['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaInteres['max'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_FECHA_INTERES, $fechaInteres['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpMailingTableMap::COL_FECHA_INTERES, $fechaInteres, $comparison);
    }

    /**
     * Filter the query on the fecha_hora_envio column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaHoraEnvio('2011-03-14'); // WHERE fecha_hora_envio = '2011-03-14'
     * $query->filterByFechaHoraEnvio('now'); // WHERE fecha_hora_envio = '2011-03-14'
     * $query->filterByFechaHoraEnvio(array('max' => 'yesterday')); // WHERE fecha_hora_envio > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaHoraEnvio The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByFechaHoraEnvio($fechaHoraEnvio = null, $comparison = null)
    {
        if (is_array($fechaHoraEnvio)) {
            $useMinMax = false;
            if (isset($fechaHoraEnvio['min'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_FECHA_HORA_ENVIO, $fechaHoraEnvio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaHoraEnvio['max'])) {
                $this->addUsingAlias(TmpMailingTableMap::COL_FECHA_HORA_ENVIO, $fechaHoraEnvio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TmpMailingTableMap::COL_FECHA_HORA_ENVIO, $fechaHoraEnvio, $comparison);
    }

    /**
     * Filter the query on the enviado column
     *
     * Example usage:
     * <code>
     * $query->filterByEnviado(true); // WHERE enviado = true
     * $query->filterByEnviado('yes'); // WHERE enviado = true
     * </code>
     *
     * @param     boolean|string $enviado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByEnviado($enviado = null, $comparison = null)
    {
        if (is_string($enviado)) {
            $enviado = in_array(strtolower($enviado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TmpMailingTableMap::COL_ENVIADO, $enviado, $comparison);
    }

    /**
     * Filter the query on the abierto column
     *
     * Example usage:
     * <code>
     * $query->filterByAbierto(true); // WHERE abierto = true
     * $query->filterByAbierto('yes'); // WHERE abierto = true
     * </code>
     *
     * @param     boolean|string $abierto The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function filterByAbierto($abierto = null, $comparison = null)
    {
        if (is_string($abierto)) {
            $abierto = in_array(strtolower($abierto), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TmpMailingTableMap::COL_ABIERTO, $abierto, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTmpMailing $tmpMailing Object to remove from the list of results
     *
     * @return $this|ChildTmpMailingQuery The current query, for fluid interface
     */
    public function prune($tmpMailing = null)
    {
        if ($tmpMailing) {
            $this->addUsingAlias(TmpMailingTableMap::COL_ID, $tmpMailing->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tmp_mailing table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TmpMailingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TmpMailingTableMap::clearInstancePool();
            TmpMailingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TmpMailingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TmpMailingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TmpMailingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TmpMailingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TmpMailingQuery
