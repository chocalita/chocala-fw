<?php

namespace Base;

use \SysUri as ChildSysUri;
use \SysUriQuery as ChildSysUriQuery;
use \Exception;
use \PDO;
use Map\SysUriTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_uri' table.
 *
 * 
 *
 * @method     ChildSysUriQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysUriQuery orderByModuleId($order = Criteria::ASC) Order by the MODULE_ID column
 * @method     ChildSysUriQuery orderByUri($order = Criteria::ASC) Order by the URI column
 * @method     ChildSysUriQuery orderByTitle($order = Criteria::ASC) Order by the TITLE column
 * @method     ChildSysUriQuery orderByAccess($order = Criteria::ASC) Order by the ACCESS column
 * @method     ChildSysUriQuery orderByType($order = Criteria::ASC) Order by the TYPE column
 * @method     ChildSysUriQuery orderByPosition($order = Criteria::ASC) Order by the POSITION column
 * @method     ChildSysUriQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysUriQuery orderByIcon($order = Criteria::ASC) Order by the ICON column
 * @method     ChildSysUriQuery orderByMark($order = Criteria::ASC) Order by the MARK column
 * @method     ChildSysUriQuery orderByAfterDivisor($order = Criteria::ASC) Order by the AFTER_DIVISOR column
 *
 * @method     ChildSysUriQuery groupById() Group by the ID column
 * @method     ChildSysUriQuery groupByModuleId() Group by the MODULE_ID column
 * @method     ChildSysUriQuery groupByUri() Group by the URI column
 * @method     ChildSysUriQuery groupByTitle() Group by the TITLE column
 * @method     ChildSysUriQuery groupByAccess() Group by the ACCESS column
 * @method     ChildSysUriQuery groupByType() Group by the TYPE column
 * @method     ChildSysUriQuery groupByPosition() Group by the POSITION column
 * @method     ChildSysUriQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysUriQuery groupByIcon() Group by the ICON column
 * @method     ChildSysUriQuery groupByMark() Group by the MARK column
 * @method     ChildSysUriQuery groupByAfterDivisor() Group by the AFTER_DIVISOR column
 *
 * @method     ChildSysUriQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysUriQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysUriQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysUriQuery leftJoinSysModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysModule relation
 * @method     ChildSysUriQuery rightJoinSysModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysModule relation
 * @method     ChildSysUriQuery innerJoinSysModule($relationAlias = null) Adds a INNER JOIN clause to the query using the SysModule relation
 *
 * @method     ChildSysUriQuery leftJoinSysRolXUri($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysRolXUri relation
 * @method     ChildSysUriQuery rightJoinSysRolXUri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysRolXUri relation
 * @method     ChildSysUriQuery innerJoinSysRolXUri($relationAlias = null) Adds a INNER JOIN clause to the query using the SysRolXUri relation
 *
 * @method     \SysModuleQuery|\SysRolXUriQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysUri findOne(ConnectionInterface $con = null) Return the first ChildSysUri matching the query
 * @method     ChildSysUri findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysUri matching the query, or a new ChildSysUri object populated from the query conditions when no match is found
 *
 * @method     ChildSysUri findOneById(int $ID) Return the first ChildSysUri filtered by the ID column
 * @method     ChildSysUri findOneByModuleId(int $MODULE_ID) Return the first ChildSysUri filtered by the MODULE_ID column
 * @method     ChildSysUri findOneByUri(string $URI) Return the first ChildSysUri filtered by the URI column
 * @method     ChildSysUri findOneByTitle(string $TITLE) Return the first ChildSysUri filtered by the TITLE column
 * @method     ChildSysUri findOneByAccess(string $ACCESS) Return the first ChildSysUri filtered by the ACCESS column
 * @method     ChildSysUri findOneByType(string $TYPE) Return the first ChildSysUri filtered by the TYPE column
 * @method     ChildSysUri findOneByPosition(int $POSITION) Return the first ChildSysUri filtered by the POSITION column
 * @method     ChildSysUri findOneByDescription(string $DESCRIPTION) Return the first ChildSysUri filtered by the DESCRIPTION column
 * @method     ChildSysUri findOneByIcon(string $ICON) Return the first ChildSysUri filtered by the ICON column
 * @method     ChildSysUri findOneByMark(string $MARK) Return the first ChildSysUri filtered by the MARK column
 * @method     ChildSysUri findOneByAfterDivisor(boolean $AFTER_DIVISOR) Return the first ChildSysUri filtered by the AFTER_DIVISOR column *

 * @method     ChildSysUri requirePk($key, ConnectionInterface $con = null) Return the ChildSysUri by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOne(ConnectionInterface $con = null) Return the first ChildSysUri matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUri requireOneById(int $ID) Return the first ChildSysUri filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByModuleId(int $MODULE_ID) Return the first ChildSysUri filtered by the MODULE_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByUri(string $URI) Return the first ChildSysUri filtered by the URI column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByTitle(string $TITLE) Return the first ChildSysUri filtered by the TITLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByAccess(string $ACCESS) Return the first ChildSysUri filtered by the ACCESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByType(string $TYPE) Return the first ChildSysUri filtered by the TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByPosition(int $POSITION) Return the first ChildSysUri filtered by the POSITION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByDescription(string $DESCRIPTION) Return the first ChildSysUri filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByIcon(string $ICON) Return the first ChildSysUri filtered by the ICON column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByMark(string $MARK) Return the first ChildSysUri filtered by the MARK column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUri requireOneByAfterDivisor(boolean $AFTER_DIVISOR) Return the first ChildSysUri filtered by the AFTER_DIVISOR column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUri[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysUri objects based on current ModelCriteria
 * @method     ChildSysUri[]|ObjectCollection findById(int $ID) Return ChildSysUri objects filtered by the ID column
 * @method     ChildSysUri[]|ObjectCollection findByModuleId(int $MODULE_ID) Return ChildSysUri objects filtered by the MODULE_ID column
 * @method     ChildSysUri[]|ObjectCollection findByUri(string $URI) Return ChildSysUri objects filtered by the URI column
 * @method     ChildSysUri[]|ObjectCollection findByTitle(string $TITLE) Return ChildSysUri objects filtered by the TITLE column
 * @method     ChildSysUri[]|ObjectCollection findByAccess(string $ACCESS) Return ChildSysUri objects filtered by the ACCESS column
 * @method     ChildSysUri[]|ObjectCollection findByType(string $TYPE) Return ChildSysUri objects filtered by the TYPE column
 * @method     ChildSysUri[]|ObjectCollection findByPosition(int $POSITION) Return ChildSysUri objects filtered by the POSITION column
 * @method     ChildSysUri[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysUri objects filtered by the DESCRIPTION column
 * @method     ChildSysUri[]|ObjectCollection findByIcon(string $ICON) Return ChildSysUri objects filtered by the ICON column
 * @method     ChildSysUri[]|ObjectCollection findByMark(string $MARK) Return ChildSysUri objects filtered by the MARK column
 * @method     ChildSysUri[]|ObjectCollection findByAfterDivisor(boolean $AFTER_DIVISOR) Return ChildSysUri objects filtered by the AFTER_DIVISOR column
 * @method     ChildSysUri[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysUriQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysUriQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysUri', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysUriQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysUriQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysUriQuery) {
            return $criteria;
        }
        $query = new ChildSysUriQuery();
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
     * @return ChildSysUri|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SysUriTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysUriTableMap::DATABASE_NAME);
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
     * @return ChildSysUri A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, MODULE_ID, URI, TITLE, ACCESS, TYPE, POSITION, DESCRIPTION, ICON, MARK, AFTER_DIVISOR FROM sys_uri WHERE ID = :p0';
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
            /** @var ChildSysUri $obj */
            $obj = new ChildSysUri();
            $obj->hydrate($row);
            SysUriTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildSysUri|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysUriTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysUriTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysUriTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysUriTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the MODULE_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByModuleId(1234); // WHERE MODULE_ID = 1234
     * $query->filterByModuleId(array(12, 34)); // WHERE MODULE_ID IN (12, 34)
     * $query->filterByModuleId(array('min' => 12)); // WHERE MODULE_ID > 12
     * </code>
     *
     * @see       filterBySysModule()
     *
     * @param     mixed $moduleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByModuleId($moduleId = null, $comparison = null)
    {
        if (is_array($moduleId)) {
            $useMinMax = false;
            if (isset($moduleId['min'])) {
                $this->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $moduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($moduleId['max'])) {
                $this->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $moduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $moduleId, $comparison);
    }

    /**
     * Filter the query on the URI column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE URI = 'fooValue'
     * $query->filterByUri('%fooValue%'); // WHERE URI LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uri The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uri)) {
                $uri = str_replace('*', '%', $uri);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_URI, $uri, $comparison);
    }

    /**
     * Filter the query on the TITLE column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE TITLE = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE TITLE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the ACCESS column
     *
     * Example usage:
     * <code>
     * $query->filterByAccess('fooValue');   // WHERE ACCESS = 'fooValue'
     * $query->filterByAccess('%fooValue%'); // WHERE ACCESS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $access The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByAccess($access = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($access)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $access)) {
                $access = str_replace('*', '%', $access);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_ACCESS, $access, $comparison);
    }

    /**
     * Filter the query on the TYPE column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE TYPE = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE TYPE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the POSITION column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE POSITION = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE POSITION IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE POSITION > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(SysUriTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(SysUriTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_POSITION, $position, $comparison);
    }

    /**
     * Filter the query on the DESCRIPTION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE DESCRIPTION = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE DESCRIPTION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the ICON column
     *
     * Example usage:
     * <code>
     * $query->filterByIcon('fooValue');   // WHERE ICON = 'fooValue'
     * $query->filterByIcon('%fooValue%'); // WHERE ICON LIKE '%fooValue%'
     * </code>
     *
     * @param     string $icon The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByIcon($icon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($icon)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $icon)) {
                $icon = str_replace('*', '%', $icon);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_ICON, $icon, $comparison);
    }

    /**
     * Filter the query on the MARK column
     *
     * Example usage:
     * <code>
     * $query->filterByMark('fooValue');   // WHERE MARK = 'fooValue'
     * $query->filterByMark('%fooValue%'); // WHERE MARK LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mark The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByMark($mark = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mark)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mark)) {
                $mark = str_replace('*', '%', $mark);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysUriTableMap::COL_MARK, $mark, $comparison);
    }

    /**
     * Filter the query on the AFTER_DIVISOR column
     *
     * Example usage:
     * <code>
     * $query->filterByAfterDivisor(true); // WHERE AFTER_DIVISOR = true
     * $query->filterByAfterDivisor('yes'); // WHERE AFTER_DIVISOR = true
     * </code>
     *
     * @param     boolean|string $afterDivisor The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function filterByAfterDivisor($afterDivisor = null, $comparison = null)
    {
        if (is_string($afterDivisor)) {
            $afterDivisor = in_array(strtolower($afterDivisor), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SysUriTableMap::COL_AFTER_DIVISOR, $afterDivisor, $comparison);
    }

    /**
     * Filter the query by a related \SysModule object
     *
     * @param \SysModule|ObjectCollection $sysModule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysUriQuery The current query, for fluid interface
     */
    public function filterBySysModule($sysModule, $comparison = null)
    {
        if ($sysModule instanceof \SysModule) {
            return $this
                ->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $sysModule->getId(), $comparison);
        } elseif ($sysModule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysUriTableMap::COL_MODULE_ID, $sysModule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysModule() only accepts arguments of type \SysModule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysModule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function joinSysModule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysModule');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SysModule');
        }

        return $this;
    }

    /**
     * Use the SysModule relation SysModule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysModuleQuery A secondary query class using the current class as primary query
     */
    public function useSysModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysModule', '\SysModuleQuery');
    }

    /**
     * Filter the query by a related \SysRolXUri object
     *
     * @param \SysRolXUri|ObjectCollection $sysRolXUri the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUriQuery The current query, for fluid interface
     */
    public function filterBySysRolXUri($sysRolXUri, $comparison = null)
    {
        if ($sysRolXUri instanceof \SysRolXUri) {
            return $this
                ->addUsingAlias(SysUriTableMap::COL_ID, $sysRolXUri->getUriId(), $comparison);
        } elseif ($sysRolXUri instanceof ObjectCollection) {
            return $this
                ->useSysRolXUriQuery()
                ->filterByPrimaryKeys($sysRolXUri->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysRolXUri() only accepts arguments of type \SysRolXUri or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysRolXUri relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function joinSysRolXUri($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysRolXUri');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SysRolXUri');
        }

        return $this;
    }

    /**
     * Use the SysRolXUri relation SysRolXUri object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysRolXUriQuery A secondary query class using the current class as primary query
     */
    public function useSysRolXUriQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysRolXUri($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysRolXUri', '\SysRolXUriQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysUri $sysUri Object to remove from the list of results
     *
     * @return $this|ChildSysUriQuery The current query, for fluid interface
     */
    public function prune($sysUri = null)
    {
        if ($sysUri) {
            $this->addUsingAlias(SysUriTableMap::COL_ID, $sysUri->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_uri table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysUriTableMap::clearInstancePool();
            SysUriTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUriTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysUriTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            SysUriTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            SysUriTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysUriQuery
