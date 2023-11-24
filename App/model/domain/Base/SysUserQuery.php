<?php

namespace App\model\domain\Base;

use \Exception;
use \PDO;
use App\model\domain\SysUser as ChildSysUser;
use App\model\domain\SysUserQuery as ChildSysUserQuery;
use App\model\domain\Map\SysUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_user' table.
 *
 *
 *
 * @method     ChildSysUserQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysUserQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildSysUserQuery orderByUsername($order = Criteria::ASC) Order by the USERNAME column
 * @method     ChildSysUserQuery orderByPassword($order = Criteria::ASC) Order by the PASSWORD column
 * @method     ChildSysUserQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildSysUserQuery orderByLocation($order = Criteria::ASC) Order by the LOCATION column
 * @method     ChildSysUserQuery orderByAddress($order = Criteria::ASC) Order by the ADDRESS column
 * @method     ChildSysUserQuery orderByImageMime($order = Criteria::ASC) Order by the IMAGE_MIME column
 * @method     ChildSysUserQuery orderByActualAccess($order = Criteria::ASC) Order by the ACTUAL_ACCESS column
 * @method     ChildSysUserQuery orderByLastAccess($order = Criteria::ASC) Order by the LAST_ACCESS column
 * @method     ChildSysUserQuery orderByAccessFailures($order = Criteria::ASC) Order by the ACCESS_FAILURES column
 * @method     ChildSysUserQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysUserQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysUserQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysUserQuery groupById() Group by the ID column
 * @method     ChildSysUserQuery groupByEmail() Group by the EMAIL column
 * @method     ChildSysUserQuery groupByUsername() Group by the USERNAME column
 * @method     ChildSysUserQuery groupByPassword() Group by the PASSWORD column
 * @method     ChildSysUserQuery groupByStatus() Group by the STATUS column
 * @method     ChildSysUserQuery groupByLocation() Group by the LOCATION column
 * @method     ChildSysUserQuery groupByAddress() Group by the ADDRESS column
 * @method     ChildSysUserQuery groupByImageMime() Group by the IMAGE_MIME column
 * @method     ChildSysUserQuery groupByActualAccess() Group by the ACTUAL_ACCESS column
 * @method     ChildSysUserQuery groupByLastAccess() Group by the LAST_ACCESS column
 * @method     ChildSysUserQuery groupByAccessFailures() Group by the ACCESS_FAILURES column
 * @method     ChildSysUserQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysUserQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysUserQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysUserQuery leftJoinSysAuth($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysAuth relation
 * @method     ChildSysUserQuery rightJoinSysAuth($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysAuth relation
 * @method     ChildSysUserQuery innerJoinSysAuth($relationAlias = null) Adds a INNER JOIN clause to the query using the SysAuth relation
 *
 * @method     ChildSysUserQuery joinWithSysAuth($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysAuth relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysAuth() Adds a LEFT JOIN clause and with to the query using the SysAuth relation
 * @method     ChildSysUserQuery rightJoinWithSysAuth() Adds a RIGHT JOIN clause and with to the query using the SysAuth relation
 * @method     ChildSysUserQuery innerJoinWithSysAuth() Adds a INNER JOIN clause and with to the query using the SysAuth relation
 *
 * @method     ChildSysUserQuery leftJoinSysEmailSent($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEmailSent relation
 * @method     ChildSysUserQuery rightJoinSysEmailSent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEmailSent relation
 * @method     ChildSysUserQuery innerJoinSysEmailSent($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEmailSent relation
 *
 * @method     ChildSysUserQuery joinWithSysEmailSent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEmailSent relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysEmailSent() Adds a LEFT JOIN clause and with to the query using the SysEmailSent relation
 * @method     ChildSysUserQuery rightJoinWithSysEmailSent() Adds a RIGHT JOIN clause and with to the query using the SysEmailSent relation
 * @method     ChildSysUserQuery innerJoinWithSysEmailSent() Adds a INNER JOIN clause and with to the query using the SysEmailSent relation
 *
 * @method     ChildSysUserQuery leftJoinSysEntityUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysUserQuery rightJoinSysEntityUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysUserQuery innerJoinSysEntityUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityUser relation
 *
 * @method     ChildSysUserQuery joinWithSysEntityUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityUser relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysEntityUser() Adds a LEFT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysUserQuery rightJoinWithSysEntityUser() Adds a RIGHT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysUserQuery innerJoinWithSysEntityUser() Adds a INNER JOIN clause and with to the query using the SysEntityUser relation
 *
 * @method     ChildSysUserQuery leftJoinSysEventUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEventUser relation
 * @method     ChildSysUserQuery rightJoinSysEventUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEventUser relation
 * @method     ChildSysUserQuery innerJoinSysEventUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEventUser relation
 *
 * @method     ChildSysUserQuery joinWithSysEventUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEventUser relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysEventUser() Adds a LEFT JOIN clause and with to the query using the SysEventUser relation
 * @method     ChildSysUserQuery rightJoinWithSysEventUser() Adds a RIGHT JOIN clause and with to the query using the SysEventUser relation
 * @method     ChildSysUserQuery innerJoinWithSysEventUser() Adds a INNER JOIN clause and with to the query using the SysEventUser relation
 *
 * @method     ChildSysUserQuery leftJoinSysImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysImage relation
 * @method     ChildSysUserQuery rightJoinSysImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysImage relation
 * @method     ChildSysUserQuery innerJoinSysImage($relationAlias = null) Adds a INNER JOIN clause to the query using the SysImage relation
 *
 * @method     ChildSysUserQuery joinWithSysImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysImage relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysImage() Adds a LEFT JOIN clause and with to the query using the SysImage relation
 * @method     ChildSysUserQuery rightJoinWithSysImage() Adds a RIGHT JOIN clause and with to the query using the SysImage relation
 * @method     ChildSysUserQuery innerJoinWithSysImage() Adds a INNER JOIN clause and with to the query using the SysImage relation
 *
 * @method     ChildSysUserQuery leftJoinSysPassword($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysPassword relation
 * @method     ChildSysUserQuery rightJoinSysPassword($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysPassword relation
 * @method     ChildSysUserQuery innerJoinSysPassword($relationAlias = null) Adds a INNER JOIN clause to the query using the SysPassword relation
 *
 * @method     ChildSysUserQuery joinWithSysPassword($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysPassword relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysPassword() Adds a LEFT JOIN clause and with to the query using the SysPassword relation
 * @method     ChildSysUserQuery rightJoinWithSysPassword() Adds a RIGHT JOIN clause and with to the query using the SysPassword relation
 * @method     ChildSysUserQuery innerJoinWithSysPassword() Adds a INNER JOIN clause and with to the query using the SysPassword relation
 *
 * @method     ChildSysUserQuery leftJoinSysPasswordRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysPasswordRequest relation
 * @method     ChildSysUserQuery rightJoinSysPasswordRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysPasswordRequest relation
 * @method     ChildSysUserQuery innerJoinSysPasswordRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SysPasswordRequest relation
 *
 * @method     ChildSysUserQuery joinWithSysPasswordRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysPasswordRequest relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysPasswordRequest() Adds a LEFT JOIN clause and with to the query using the SysPasswordRequest relation
 * @method     ChildSysUserQuery rightJoinWithSysPasswordRequest() Adds a RIGHT JOIN clause and with to the query using the SysPasswordRequest relation
 * @method     ChildSysUserQuery innerJoinWithSysPasswordRequest() Adds a INNER JOIN clause and with to the query using the SysPasswordRequest relation
 *
 * @method     ChildSysUserQuery leftJoinSysPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysPerson relation
 * @method     ChildSysUserQuery rightJoinSysPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysPerson relation
 * @method     ChildSysUserQuery innerJoinSysPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the SysPerson relation
 *
 * @method     ChildSysUserQuery joinWithSysPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysPerson relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysPerson() Adds a LEFT JOIN clause and with to the query using the SysPerson relation
 * @method     ChildSysUserQuery rightJoinWithSysPerson() Adds a RIGHT JOIN clause and with to the query using the SysPerson relation
 * @method     ChildSysUserQuery innerJoinWithSysPerson() Adds a INNER JOIN clause and with to the query using the SysPerson relation
 *
 * @method     ChildSysUserQuery leftJoinSysUserParam($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUserParam relation
 * @method     ChildSysUserQuery rightJoinSysUserParam($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUserParam relation
 * @method     ChildSysUserQuery innerJoinSysUserParam($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUserParam relation
 *
 * @method     ChildSysUserQuery joinWithSysUserParam($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUserParam relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysUserParam() Adds a LEFT JOIN clause and with to the query using the SysUserParam relation
 * @method     ChildSysUserQuery rightJoinWithSysUserParam() Adds a RIGHT JOIN clause and with to the query using the SysUserParam relation
 * @method     ChildSysUserQuery innerJoinWithSysUserParam() Adds a INNER JOIN clause and with to the query using the SysUserParam relation
 *
 * @method     ChildSysUserQuery leftJoinSysUserXRol($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUserXRol relation
 * @method     ChildSysUserQuery rightJoinSysUserXRol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUserXRol relation
 * @method     ChildSysUserQuery innerJoinSysUserXRol($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUserXRol relation
 *
 * @method     ChildSysUserQuery joinWithSysUserXRol($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUserXRol relation
 *
 * @method     ChildSysUserQuery leftJoinWithSysUserXRol() Adds a LEFT JOIN clause and with to the query using the SysUserXRol relation
 * @method     ChildSysUserQuery rightJoinWithSysUserXRol() Adds a RIGHT JOIN clause and with to the query using the SysUserXRol relation
 * @method     ChildSysUserQuery innerJoinWithSysUserXRol() Adds a INNER JOIN clause and with to the query using the SysUserXRol relation
 *
 * @method     \App\model\domain\SysAuthQuery|\App\model\domain\SysEmailSentQuery|\App\model\domain\SysEntityUserQuery|\App\model\domain\SysEventUserQuery|\App\model\domain\SysImageQuery|\App\model\domain\SysPasswordQuery|\App\model\domain\SysPasswordRequestQuery|\App\model\domain\SysPersonQuery|\App\model\domain\SysUserParamQuery|\App\model\domain\SysUserXRolQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysUser findOne(ConnectionInterface $con = null) Return the first ChildSysUser matching the query
 * @method     ChildSysUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysUser matching the query, or a new ChildSysUser object populated from the query conditions when no match is found
 *
 * @method     ChildSysUser findOneById(int $ID) Return the first ChildSysUser filtered by the ID column
 * @method     ChildSysUser findOneByEmail(string $EMAIL) Return the first ChildSysUser filtered by the EMAIL column
 * @method     ChildSysUser findOneByUsername(string $USERNAME) Return the first ChildSysUser filtered by the USERNAME column
 * @method     ChildSysUser findOneByPassword(string $PASSWORD) Return the first ChildSysUser filtered by the PASSWORD column
 * @method     ChildSysUser findOneByStatus(string $STATUS) Return the first ChildSysUser filtered by the STATUS column
 * @method     ChildSysUser findOneByLocation(string $LOCATION) Return the first ChildSysUser filtered by the LOCATION column
 * @method     ChildSysUser findOneByAddress(string $ADDRESS) Return the first ChildSysUser filtered by the ADDRESS column
 * @method     ChildSysUser findOneByImageMime(string $IMAGE_MIME) Return the first ChildSysUser filtered by the IMAGE_MIME column
 * @method     ChildSysUser findOneByActualAccess(string $ACTUAL_ACCESS) Return the first ChildSysUser filtered by the ACTUAL_ACCESS column
 * @method     ChildSysUser findOneByLastAccess(string $LAST_ACCESS) Return the first ChildSysUser filtered by the LAST_ACCESS column
 * @method     ChildSysUser findOneByAccessFailures(int $ACCESS_FAILURES) Return the first ChildSysUser filtered by the ACCESS_FAILURES column
 * @method     ChildSysUser findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysUser filtered by the LAST_USER_ID column
 * @method     ChildSysUser findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysUser filtered by the CREATION_DATE column
 * @method     ChildSysUser findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysUser filtered by the MODIFICATION_DATE column *

 * @method     ChildSysUser requirePk($key, ConnectionInterface $con = null) Return the ChildSysUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOne(ConnectionInterface $con = null) Return the first ChildSysUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUser requireOneById(int $ID) Return the first ChildSysUser filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByEmail(string $EMAIL) Return the first ChildSysUser filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByUsername(string $USERNAME) Return the first ChildSysUser filtered by the USERNAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByPassword(string $PASSWORD) Return the first ChildSysUser filtered by the PASSWORD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByStatus(string $STATUS) Return the first ChildSysUser filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByLocation(string $LOCATION) Return the first ChildSysUser filtered by the LOCATION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByAddress(string $ADDRESS) Return the first ChildSysUser filtered by the ADDRESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByImageMime(string $IMAGE_MIME) Return the first ChildSysUser filtered by the IMAGE_MIME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByActualAccess(string $ACTUAL_ACCESS) Return the first ChildSysUser filtered by the ACTUAL_ACCESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByLastAccess(string $LAST_ACCESS) Return the first ChildSysUser filtered by the LAST_ACCESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByAccessFailures(int $ACCESS_FAILURES) Return the first ChildSysUser filtered by the ACCESS_FAILURES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysUser filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysUser filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysUser filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysUser objects based on current ModelCriteria
 * @method     ChildSysUser[]|ObjectCollection findById(int $ID) Return ChildSysUser objects filtered by the ID column
 * @method     ChildSysUser[]|ObjectCollection findByEmail(string $EMAIL) Return ChildSysUser objects filtered by the EMAIL column
 * @method     ChildSysUser[]|ObjectCollection findByUsername(string $USERNAME) Return ChildSysUser objects filtered by the USERNAME column
 * @method     ChildSysUser[]|ObjectCollection findByPassword(string $PASSWORD) Return ChildSysUser objects filtered by the PASSWORD column
 * @method     ChildSysUser[]|ObjectCollection findByStatus(string $STATUS) Return ChildSysUser objects filtered by the STATUS column
 * @method     ChildSysUser[]|ObjectCollection findByLocation(string $LOCATION) Return ChildSysUser objects filtered by the LOCATION column
 * @method     ChildSysUser[]|ObjectCollection findByAddress(string $ADDRESS) Return ChildSysUser objects filtered by the ADDRESS column
 * @method     ChildSysUser[]|ObjectCollection findByImageMime(string $IMAGE_MIME) Return ChildSysUser objects filtered by the IMAGE_MIME column
 * @method     ChildSysUser[]|ObjectCollection findByActualAccess(string $ACTUAL_ACCESS) Return ChildSysUser objects filtered by the ACTUAL_ACCESS column
 * @method     ChildSysUser[]|ObjectCollection findByLastAccess(string $LAST_ACCESS) Return ChildSysUser objects filtered by the LAST_ACCESS column
 * @method     ChildSysUser[]|ObjectCollection findByAccessFailures(int $ACCESS_FAILURES) Return ChildSysUser objects filtered by the ACCESS_FAILURES column
 * @method     ChildSysUser[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildSysUser objects filtered by the LAST_USER_ID column
 * @method     ChildSysUser[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildSysUser objects filtered by the CREATION_DATE column
 * @method     ChildSysUser[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildSysUser objects filtered by the MODIFICATION_DATE column
 * @method     ChildSysUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\model\domain\Base\SysUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\model\\domain\\SysUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysUserQuery) {
            return $criteria;
        }
        $query = new ChildSysUserQuery();
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
     * @return ChildSysUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildSysUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, EMAIL, USERNAME, PASSWORD, STATUS, LOCATION, ADDRESS, IMAGE_MIME, ACTUAL_ACCESS, LAST_ACCESS, ACCESS_FAILURES, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_user WHERE ID = :p0';
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
            /** @var ChildSysUser $obj */
            $obj = new ChildSysUser();
            $obj->hydrate($row);
            SysUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysUserTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysUserTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysUserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysUserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the USERNAME column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE USERNAME = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE USERNAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the PASSWORD column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE PASSWORD = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE PASSWORD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE STATUS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the LOCATION column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE LOCATION = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE LOCATION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $location The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_LOCATION, $location, $comparison);
    }

    /**
     * Filter the query on the ADDRESS column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE ADDRESS = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE ADDRESS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the IMAGE_MIME column
     *
     * Example usage:
     * <code>
     * $query->filterByImageMime('fooValue');   // WHERE IMAGE_MIME = 'fooValue'
     * $query->filterByImageMime('%fooValue%', Criteria::LIKE); // WHERE IMAGE_MIME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageMime The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByImageMime($imageMime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageMime)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_IMAGE_MIME, $imageMime, $comparison);
    }

    /**
     * Filter the query on the ACTUAL_ACCESS column
     *
     * Example usage:
     * <code>
     * $query->filterByActualAccess('2011-03-14'); // WHERE ACTUAL_ACCESS = '2011-03-14'
     * $query->filterByActualAccess('now'); // WHERE ACTUAL_ACCESS = '2011-03-14'
     * $query->filterByActualAccess(array('max' => 'yesterday')); // WHERE ACTUAL_ACCESS > '2011-03-13'
     * </code>
     *
     * @param     mixed $actualAccess The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByActualAccess($actualAccess = null, $comparison = null)
    {
        if (is_array($actualAccess)) {
            $useMinMax = false;
            if (isset($actualAccess['min'])) {
                $this->addUsingAlias(SysUserTableMap::COL_ACTUAL_ACCESS, $actualAccess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($actualAccess['max'])) {
                $this->addUsingAlias(SysUserTableMap::COL_ACTUAL_ACCESS, $actualAccess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_ACTUAL_ACCESS, $actualAccess, $comparison);
    }

    /**
     * Filter the query on the LAST_ACCESS column
     *
     * Example usage:
     * <code>
     * $query->filterByLastAccess('2011-03-14'); // WHERE LAST_ACCESS = '2011-03-14'
     * $query->filterByLastAccess('now'); // WHERE LAST_ACCESS = '2011-03-14'
     * $query->filterByLastAccess(array('max' => 'yesterday')); // WHERE LAST_ACCESS > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastAccess The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByLastAccess($lastAccess = null, $comparison = null)
    {
        if (is_array($lastAccess)) {
            $useMinMax = false;
            if (isset($lastAccess['min'])) {
                $this->addUsingAlias(SysUserTableMap::COL_LAST_ACCESS, $lastAccess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastAccess['max'])) {
                $this->addUsingAlias(SysUserTableMap::COL_LAST_ACCESS, $lastAccess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_LAST_ACCESS, $lastAccess, $comparison);
    }

    /**
     * Filter the query on the ACCESS_FAILURES column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessFailures(1234); // WHERE ACCESS_FAILURES = 1234
     * $query->filterByAccessFailures(array(12, 34)); // WHERE ACCESS_FAILURES IN (12, 34)
     * $query->filterByAccessFailures(array('min' => 12)); // WHERE ACCESS_FAILURES > 12
     * </code>
     *
     * @param     mixed $accessFailures The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByAccessFailures($accessFailures = null, $comparison = null)
    {
        if (is_array($accessFailures)) {
            $useMinMax = false;
            if (isset($accessFailures['min'])) {
                $this->addUsingAlias(SysUserTableMap::COL_ACCESS_FAILURES, $accessFailures['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accessFailures['max'])) {
                $this->addUsingAlias(SysUserTableMap::COL_ACCESS_FAILURES, $accessFailures['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_ACCESS_FAILURES, $accessFailures, $comparison);
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
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysUserTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysUserTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysUserTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysUserTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(SysUserTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysUserTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysUserTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \App\model\domain\SysAuth object
     *
     * @param \App\model\domain\SysAuth|ObjectCollection $sysAuth the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysAuth($sysAuth, $comparison = null)
    {
        if ($sysAuth instanceof \App\model\domain\SysAuth) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysAuth->getUserId(), $comparison);
        } elseif ($sysAuth instanceof ObjectCollection) {
            return $this
                ->useSysAuthQuery()
                ->filterByPrimaryKeys($sysAuth->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysAuth() only accepts arguments of type \App\model\domain\SysAuth or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysAuth relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysAuth($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysAuth');

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
            $this->addJoinObject($join, 'SysAuth');
        }

        return $this;
    }

    /**
     * Use the SysAuth relation SysAuth object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysAuthQuery A secondary query class using the current class as primary query
     */
    public function useSysAuthQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysAuth($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysAuth', '\App\model\domain\SysAuthQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysEmailSent object
     *
     * @param \App\model\domain\SysEmailSent|ObjectCollection $sysEmailSent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysEmailSent($sysEmailSent, $comparison = null)
    {
        if ($sysEmailSent instanceof \App\model\domain\SysEmailSent) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysEmailSent->getUserId(), $comparison);
        } elseif ($sysEmailSent instanceof ObjectCollection) {
            return $this
                ->useSysEmailSentQuery()
                ->filterByPrimaryKeys($sysEmailSent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEmailSent() only accepts arguments of type \App\model\domain\SysEmailSent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEmailSent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysEmailSent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEmailSent');

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
            $this->addJoinObject($join, 'SysEmailSent');
        }

        return $this;
    }

    /**
     * Use the SysEmailSent relation SysEmailSent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysEmailSentQuery A secondary query class using the current class as primary query
     */
    public function useSysEmailSentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysEmailSent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEmailSent', '\App\model\domain\SysEmailSentQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysEntityUser object
     *
     * @param \App\model\domain\SysEntityUser|ObjectCollection $sysEntityUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysEntityUser($sysEntityUser, $comparison = null)
    {
        if ($sysEntityUser instanceof \App\model\domain\SysEntityUser) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysEntityUser->getUserId(), $comparison);
        } elseif ($sysEntityUser instanceof ObjectCollection) {
            return $this
                ->useSysEntityUserQuery()
                ->filterByPrimaryKeys($sysEntityUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEntityUser() only accepts arguments of type \App\model\domain\SysEntityUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysEntityUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityUser');

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
            $this->addJoinObject($join, 'SysEntityUser');
        }

        return $this;
    }

    /**
     * Use the SysEntityUser relation SysEntityUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysEntityUserQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityUser', '\App\model\domain\SysEntityUserQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysEventUser object
     *
     * @param \App\model\domain\SysEventUser|ObjectCollection $sysEventUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysEventUser($sysEventUser, $comparison = null)
    {
        if ($sysEventUser instanceof \App\model\domain\SysEventUser) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysEventUser->getUserId(), $comparison);
        } elseif ($sysEventUser instanceof ObjectCollection) {
            return $this
                ->useSysEventUserQuery()
                ->filterByPrimaryKeys($sysEventUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysEventUser() only accepts arguments of type \App\model\domain\SysEventUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEventUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysEventUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEventUser');

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
            $this->addJoinObject($join, 'SysEventUser');
        }

        return $this;
    }

    /**
     * Use the SysEventUser relation SysEventUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysEventUserQuery A secondary query class using the current class as primary query
     */
    public function useSysEventUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEventUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEventUser', '\App\model\domain\SysEventUserQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysImage object
     *
     * @param \App\model\domain\SysImage|ObjectCollection $sysImage the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysImage($sysImage, $comparison = null)
    {
        if ($sysImage instanceof \App\model\domain\SysImage) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysImage->getUserId(), $comparison);
        } elseif ($sysImage instanceof ObjectCollection) {
            return $this
                ->useSysImageQuery()
                ->filterByPrimaryKeys($sysImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysImage() only accepts arguments of type \App\model\domain\SysImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysImage');

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
            $this->addJoinObject($join, 'SysImage');
        }

        return $this;
    }

    /**
     * Use the SysImage relation SysImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysImageQuery A secondary query class using the current class as primary query
     */
    public function useSysImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysImage', '\App\model\domain\SysImageQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysPassword object
     *
     * @param \App\model\domain\SysPassword|ObjectCollection $sysPassword the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysPassword($sysPassword, $comparison = null)
    {
        if ($sysPassword instanceof \App\model\domain\SysPassword) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysPassword->getUserId(), $comparison);
        } elseif ($sysPassword instanceof ObjectCollection) {
            return $this
                ->useSysPasswordQuery()
                ->filterByPrimaryKeys($sysPassword->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysPassword() only accepts arguments of type \App\model\domain\SysPassword or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPassword relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysPassword($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysPassword');

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
            $this->addJoinObject($join, 'SysPassword');
        }

        return $this;
    }

    /**
     * Use the SysPassword relation SysPassword object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysPasswordQuery A secondary query class using the current class as primary query
     */
    public function useSysPasswordQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysPassword($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPassword', '\App\model\domain\SysPasswordQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysPasswordRequest object
     *
     * @param \App\model\domain\SysPasswordRequest|ObjectCollection $sysPasswordRequest the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysPasswordRequest($sysPasswordRequest, $comparison = null)
    {
        if ($sysPasswordRequest instanceof \App\model\domain\SysPasswordRequest) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysPasswordRequest->getUserId(), $comparison);
        } elseif ($sysPasswordRequest instanceof ObjectCollection) {
            return $this
                ->useSysPasswordRequestQuery()
                ->filterByPrimaryKeys($sysPasswordRequest->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysPasswordRequest() only accepts arguments of type \App\model\domain\SysPasswordRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPasswordRequest relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysPasswordRequest($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysPasswordRequest');

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
            $this->addJoinObject($join, 'SysPasswordRequest');
        }

        return $this;
    }

    /**
     * Use the SysPasswordRequest relation SysPasswordRequest object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysPasswordRequestQuery A secondary query class using the current class as primary query
     */
    public function useSysPasswordRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysPasswordRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPasswordRequest', '\App\model\domain\SysPasswordRequestQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysPerson object
     *
     * @param \App\model\domain\SysPerson|ObjectCollection $sysPerson the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysPerson($sysPerson, $comparison = null)
    {
        if ($sysPerson instanceof \App\model\domain\SysPerson) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysPerson->getUserId(), $comparison);
        } elseif ($sysPerson instanceof ObjectCollection) {
            return $this
                ->useSysPersonQuery()
                ->filterByPrimaryKeys($sysPerson->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysPerson() only accepts arguments of type \App\model\domain\SysPerson or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPerson relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysPerson');

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
            $this->addJoinObject($join, 'SysPerson');
        }

        return $this;
    }

    /**
     * Use the SysPerson relation SysPerson object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysPersonQuery A secondary query class using the current class as primary query
     */
    public function useSysPersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPerson', '\App\model\domain\SysPersonQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysUserParam object
     *
     * @param \App\model\domain\SysUserParam|ObjectCollection $sysUserParam the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysUserParam($sysUserParam, $comparison = null)
    {
        if ($sysUserParam instanceof \App\model\domain\SysUserParam) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysUserParam->getUserId(), $comparison);
        } elseif ($sysUserParam instanceof ObjectCollection) {
            return $this
                ->useSysUserParamQuery()
                ->filterByPrimaryKeys($sysUserParam->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysUserParam() only accepts arguments of type \App\model\domain\SysUserParam or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUserParam relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysUserParam($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUserParam');

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
            $this->addJoinObject($join, 'SysUserParam');
        }

        return $this;
    }

    /**
     * Use the SysUserParam relation SysUserParam object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysUserParamQuery A secondary query class using the current class as primary query
     */
    public function useSysUserParamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUserParam($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUserParam', '\App\model\domain\SysUserParamQuery');
    }

    /**
     * Filter the query by a related \App\model\domain\SysUserXRol object
     *
     * @param \App\model\domain\SysUserXRol|ObjectCollection $sysUserXRol the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysUserQuery The current query, for fluid interface
     */
    public function filterBySysUserXRol($sysUserXRol, $comparison = null)
    {
        if ($sysUserXRol instanceof \App\model\domain\SysUserXRol) {
            return $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysUserXRol->getUserId(), $comparison);
        } elseif ($sysUserXRol instanceof ObjectCollection) {
            return $this
                ->useSysUserXRolQuery()
                ->filterByPrimaryKeys($sysUserXRol->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySysUserXRol() only accepts arguments of type \App\model\domain\SysUserXRol or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUserXRol relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function joinSysUserXRol($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysUserXRol');

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
            $this->addJoinObject($join, 'SysUserXRol');
        }

        return $this;
    }

    /**
     * Use the SysUserXRol relation SysUserXRol object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\model\domain\SysUserXRolQuery A secondary query class using the current class as primary query
     */
    public function useSysUserXRolQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUserXRol($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUserXRol', '\App\model\domain\SysUserXRolQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysUser $sysUser Object to remove from the list of results
     *
     * @return $this|ChildSysUserQuery The current query, for fluid interface
     */
    public function prune($sysUser = null)
    {
        if ($sysUser) {
            $this->addUsingAlias(SysUserTableMap::COL_ID, $sysUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysUserTableMap::clearInstancePool();
            SysUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysUserQuery
