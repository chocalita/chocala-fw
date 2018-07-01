<?php

namespace Base;

use \SysImage as ChildSysImage;
use \SysImageQuery as ChildSysImageQuery;
use \Exception;
use \PDO;
use Map\SysImageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_image' table.
 *
 *
 *
 * @method     ChildSysImageQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysImageQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysImageQuery orderByTitle($order = Criteria::ASC) Order by the TITLE column
 * @method     ChildSysImageQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysImageQuery orderByImgName($order = Criteria::ASC) Order by the IMG_NAME column
 * @method     ChildSysImageQuery orderByImgType($order = Criteria::ASC) Order by the IMG_TYPE column
 * @method     ChildSysImageQuery orderByImgSize($order = Criteria::ASC) Order by the IMG_SIZE column
 * @method     ChildSysImageQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysImageQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysImageQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysImageQuery groupById() Group by the ID column
 * @method     ChildSysImageQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysImageQuery groupByTitle() Group by the TITLE column
 * @method     ChildSysImageQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysImageQuery groupByImgName() Group by the IMG_NAME column
 * @method     ChildSysImageQuery groupByImgType() Group by the IMG_TYPE column
 * @method     ChildSysImageQuery groupByImgSize() Group by the IMG_SIZE column
 * @method     ChildSysImageQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysImageQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysImageQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysImageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysImageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysImageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysImageQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysImageQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysImageQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildSysImageQuery joinWithSysUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUser relation
 *
 * @method     ChildSysImageQuery leftJoinWithSysUser() Adds a LEFT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysImageQuery rightJoinWithSysUser() Adds a RIGHT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysImageQuery innerJoinWithSysUser() Adds a INNER JOIN clause and with to the query using the SysUser relation
 *
 * @method     \SysUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysImage findOne(ConnectionInterface $con = null) Return the first ChildSysImage matching the query
 * @method     ChildSysImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysImage matching the query, or a new ChildSysImage object populated from the query conditions when no match is found
 *
 * @method     ChildSysImage findOneById(int $ID) Return the first ChildSysImage filtered by the ID column
 * @method     ChildSysImage findOneByUserId(int $USER_ID) Return the first ChildSysImage filtered by the USER_ID column
 * @method     ChildSysImage findOneByTitle(string $TITLE) Return the first ChildSysImage filtered by the TITLE column
 * @method     ChildSysImage findOneByDescription(string $DESCRIPTION) Return the first ChildSysImage filtered by the DESCRIPTION column
 * @method     ChildSysImage findOneByImgName(string $IMG_NAME) Return the first ChildSysImage filtered by the IMG_NAME column
 * @method     ChildSysImage findOneByImgType(string $IMG_TYPE) Return the first ChildSysImage filtered by the IMG_TYPE column
 * @method     ChildSysImage findOneByImgSize(int $IMG_SIZE) Return the first ChildSysImage filtered by the IMG_SIZE column
 * @method     ChildSysImage findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysImage filtered by the LAST_USER_ID column
 * @method     ChildSysImage findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysImage filtered by the CREATION_DATE column
 * @method     ChildSysImage findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysImage filtered by the MODIFICATION_DATE column *

 * @method     ChildSysImage requirePk($key, ConnectionInterface $con = null) Return the ChildSysImage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOne(ConnectionInterface $con = null) Return the first ChildSysImage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysImage requireOneById(int $ID) Return the first ChildSysImage filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByUserId(int $USER_ID) Return the first ChildSysImage filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByTitle(string $TITLE) Return the first ChildSysImage filtered by the TITLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByDescription(string $DESCRIPTION) Return the first ChildSysImage filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByImgName(string $IMG_NAME) Return the first ChildSysImage filtered by the IMG_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByImgType(string $IMG_TYPE) Return the first ChildSysImage filtered by the IMG_TYPE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByImgSize(int $IMG_SIZE) Return the first ChildSysImage filtered by the IMG_SIZE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysImage filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysImage filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysImage requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysImage filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysImage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysImage objects based on current ModelCriteria
 * @method     ChildSysImage[]|ObjectCollection findById(int $ID) Return ChildSysImage objects filtered by the ID column
 * @method     ChildSysImage[]|ObjectCollection findByUserId(int $USER_ID) Return ChildSysImage objects filtered by the USER_ID column
 * @method     ChildSysImage[]|ObjectCollection findByTitle(string $TITLE) Return ChildSysImage objects filtered by the TITLE column
 * @method     ChildSysImage[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysImage objects filtered by the DESCRIPTION column
 * @method     ChildSysImage[]|ObjectCollection findByImgName(string $IMG_NAME) Return ChildSysImage objects filtered by the IMG_NAME column
 * @method     ChildSysImage[]|ObjectCollection findByImgType(string $IMG_TYPE) Return ChildSysImage objects filtered by the IMG_TYPE column
 * @method     ChildSysImage[]|ObjectCollection findByImgSize(int $IMG_SIZE) Return ChildSysImage objects filtered by the IMG_SIZE column
 * @method     ChildSysImage[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildSysImage objects filtered by the LAST_USER_ID column
 * @method     ChildSysImage[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildSysImage objects filtered by the CREATION_DATE column
 * @method     ChildSysImage[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildSysImage objects filtered by the MODIFICATION_DATE column
 * @method     ChildSysImage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysImageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysImageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysImageQuery) {
            return $criteria;
        }
        $query = new ChildSysImageQuery();
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
     * @return ChildSysImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SysImageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysImageTableMap::DATABASE_NAME);
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
     * @return ChildSysImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, USER_ID, TITLE, DESCRIPTION, IMG_NAME, IMG_TYPE, IMG_SIZE, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_image WHERE ID = :p0';
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
            /** @var ChildSysImage $obj */
            $obj = new ChildSysImage();
            $obj->hydrate($row);
            SysImageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysImage|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysImageTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysImageTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysImageTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysImageTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the USER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE USER_ID = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE USER_ID IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE USER_ID > 12
     * </code>
     *
     * @see       filterBySysUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(SysImageTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysImageTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildSysImageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SysImageTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildSysImageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SysImageTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the IMG_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByImgName('fooValue');   // WHERE IMG_NAME = 'fooValue'
     * $query->filterByImgName('%fooValue%'); // WHERE IMG_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imgName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByImgName($imgName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imgName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imgName)) {
                $imgName = str_replace('*', '%', $imgName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_IMG_NAME, $imgName, $comparison);
    }

    /**
     * Filter the query on the IMG_TYPE column
     *
     * Example usage:
     * <code>
     * $query->filterByImgType('fooValue');   // WHERE IMG_TYPE = 'fooValue'
     * $query->filterByImgType('%fooValue%'); // WHERE IMG_TYPE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imgType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByImgType($imgType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imgType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imgType)) {
                $imgType = str_replace('*', '%', $imgType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_IMG_TYPE, $imgType, $comparison);
    }

    /**
     * Filter the query on the IMG_SIZE column
     *
     * Example usage:
     * <code>
     * $query->filterByImgSize(1234); // WHERE IMG_SIZE = 1234
     * $query->filterByImgSize(array(12, 34)); // WHERE IMG_SIZE IN (12, 34)
     * $query->filterByImgSize(array('min' => 12)); // WHERE IMG_SIZE > 12
     * </code>
     *
     * @param     mixed $imgSize The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByImgSize($imgSize = null, $comparison = null)
    {
        if (is_array($imgSize)) {
            $useMinMax = false;
            if (isset($imgSize['min'])) {
                $this->addUsingAlias(SysImageTableMap::COL_IMG_SIZE, $imgSize['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imgSize['max'])) {
                $this->addUsingAlias(SysImageTableMap::COL_IMG_SIZE, $imgSize['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_IMG_SIZE, $imgSize, $comparison);
    }

    /**
     * Filter the query on the LAST_USER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUserId(1234); // WHERE LAST_USER_ID = 1234
     * $query->filterByLastUserId(array(12, 34)); // WHERE LAST_USER_ID IN (12, 34)
     * $query->filterByLastUserId(array('min' => 12)); // WHERE LAST_USER_ID > 12
     * </code>
     *
     * @param     mixed $lastUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysImageTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysImageTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
    }

    /**
     * Filter the query on the CREATION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationDate('2011-03-14'); // WHERE CREATION_DATE = '2011-03-14'
     * $query->filterByCreationDate('now'); // WHERE CREATION_DATE = '2011-03-14'
     * $query->filterByCreationDate(array('max' => 'yesterday')); // WHERE CREATION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysImageTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysImageTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the MODIFICATION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByModificationDate('2011-03-14'); // WHERE MODIFICATION_DATE = '2011-03-14'
     * $query->filterByModificationDate('now'); // WHERE MODIFICATION_DATE = '2011-03-14'
     * $query->filterByModificationDate(array('max' => 'yesterday')); // WHERE MODIFICATION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $modificationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(SysImageTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysImageTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysImageTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \SysUser object
     *
     * @param \SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysImageQuery The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, $comparison = null)
    {
        if ($sysUser instanceof \SysUser) {
            return $this
                ->addUsingAlias(SysImageTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysImageTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySysUser() only accepts arguments of type \SysUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function joinSysUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUser');

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
            $this->addJoinObject($join, 'SysUser');
        }

        return $this;
    }

    /**
     * Use the SysUser relation SysUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysUserQuery A secondary query class using the current class as primary query
     */
    public function useSysUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUser', '\SysUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysImage $sysImage Object to remove from the list of results
     *
     * @return $this|ChildSysImageQuery The current query, for fluid interface
     */
    public function prune($sysImage = null)
    {
        if ($sysImage) {
            $this->addUsingAlias(SysImageTableMap::COL_ID, $sysImage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysImageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysImageTableMap::clearInstancePool();
            SysImageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysImageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysImageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysImageQuery
