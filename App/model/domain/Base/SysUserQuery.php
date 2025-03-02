<?php

namespace Base;

use \SysUser as ChildSysUser;
use \SysUserQuery as ChildSysUserQuery;
use \Exception;
use \PDO;
use Map\SysUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_user` table.
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
 * @method     \SysAuthQuery|\SysEmailSentQuery|\SysEntityUserQuery|\SysEventUserQuery|\SysImageQuery|\SysPasswordQuery|\SysPasswordRequestQuery|\SysPersonQuery|\SysUserParamQuery|\SysUserXRolQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysUser|null findOne(?ConnectionInterface $con = null) Return the first ChildSysUser matching the query
 * @method     ChildSysUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysUser matching the query, or a new ChildSysUser object populated from the query conditions when no match is found
 *
 * @method     ChildSysUser|null findOneById(int $ID) Return the first ChildSysUser filtered by the ID column
 * @method     ChildSysUser|null findOneByEmail(string $EMAIL) Return the first ChildSysUser filtered by the EMAIL column
 * @method     ChildSysUser|null findOneByUsername(string $USERNAME) Return the first ChildSysUser filtered by the USERNAME column
 * @method     ChildSysUser|null findOneByPassword(string $PASSWORD) Return the first ChildSysUser filtered by the PASSWORD column
 * @method     ChildSysUser|null findOneByStatus(string $STATUS) Return the first ChildSysUser filtered by the STATUS column
 * @method     ChildSysUser|null findOneByLocation(string $LOCATION) Return the first ChildSysUser filtered by the LOCATION column
 * @method     ChildSysUser|null findOneByAddress(string $ADDRESS) Return the first ChildSysUser filtered by the ADDRESS column
 * @method     ChildSysUser|null findOneByImageMime(string $IMAGE_MIME) Return the first ChildSysUser filtered by the IMAGE_MIME column
 * @method     ChildSysUser|null findOneByActualAccess(string $ACTUAL_ACCESS) Return the first ChildSysUser filtered by the ACTUAL_ACCESS column
 * @method     ChildSysUser|null findOneByLastAccess(string $LAST_ACCESS) Return the first ChildSysUser filtered by the LAST_ACCESS column
 * @method     ChildSysUser|null findOneByAccessFailures(int $ACCESS_FAILURES) Return the first ChildSysUser filtered by the ACCESS_FAILURES column
 * @method     ChildSysUser|null findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysUser filtered by the LAST_USER_ID column
 * @method     ChildSysUser|null findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysUser filtered by the CREATION_DATE column
 * @method     ChildSysUser|null findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysUser filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysUser requireOne(?ConnectionInterface $con = null) Return the first ChildSysUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
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
 * @method     ChildSysUser[]|Collection find(?ConnectionInterface $con = null) Return ChildSysUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysUser> find(?ConnectionInterface $con = null) Return ChildSysUser objects based on current ModelCriteria
 *
 * @method     ChildSysUser[]|Collection findById(int|array<int> $ID) Return ChildSysUser objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysUser> findById(int|array<int> $ID) Return ChildSysUser objects filtered by the ID column
 * @method     ChildSysUser[]|Collection findByEmail(string|array<string> $EMAIL) Return ChildSysUser objects filtered by the EMAIL column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByEmail(string|array<string> $EMAIL) Return ChildSysUser objects filtered by the EMAIL column
 * @method     ChildSysUser[]|Collection findByUsername(string|array<string> $USERNAME) Return ChildSysUser objects filtered by the USERNAME column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByUsername(string|array<string> $USERNAME) Return ChildSysUser objects filtered by the USERNAME column
 * @method     ChildSysUser[]|Collection findByPassword(string|array<string> $PASSWORD) Return ChildSysUser objects filtered by the PASSWORD column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByPassword(string|array<string> $PASSWORD) Return ChildSysUser objects filtered by the PASSWORD column
 * @method     ChildSysUser[]|Collection findByStatus(string|array<string> $STATUS) Return ChildSysUser objects filtered by the STATUS column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByStatus(string|array<string> $STATUS) Return ChildSysUser objects filtered by the STATUS column
 * @method     ChildSysUser[]|Collection findByLocation(string|array<string> $LOCATION) Return ChildSysUser objects filtered by the LOCATION column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByLocation(string|array<string> $LOCATION) Return ChildSysUser objects filtered by the LOCATION column
 * @method     ChildSysUser[]|Collection findByAddress(string|array<string> $ADDRESS) Return ChildSysUser objects filtered by the ADDRESS column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByAddress(string|array<string> $ADDRESS) Return ChildSysUser objects filtered by the ADDRESS column
 * @method     ChildSysUser[]|Collection findByImageMime(string|array<string> $IMAGE_MIME) Return ChildSysUser objects filtered by the IMAGE_MIME column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByImageMime(string|array<string> $IMAGE_MIME) Return ChildSysUser objects filtered by the IMAGE_MIME column
 * @method     ChildSysUser[]|Collection findByActualAccess(string|array<string> $ACTUAL_ACCESS) Return ChildSysUser objects filtered by the ACTUAL_ACCESS column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByActualAccess(string|array<string> $ACTUAL_ACCESS) Return ChildSysUser objects filtered by the ACTUAL_ACCESS column
 * @method     ChildSysUser[]|Collection findByLastAccess(string|array<string> $LAST_ACCESS) Return ChildSysUser objects filtered by the LAST_ACCESS column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByLastAccess(string|array<string> $LAST_ACCESS) Return ChildSysUser objects filtered by the LAST_ACCESS column
 * @method     ChildSysUser[]|Collection findByAccessFailures(int|array<int> $ACCESS_FAILURES) Return ChildSysUser objects filtered by the ACCESS_FAILURES column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByAccessFailures(int|array<int> $ACCESS_FAILURES) Return ChildSysUser objects filtered by the ACCESS_FAILURES column
 * @method     ChildSysUser[]|Collection findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysUser objects filtered by the LAST_USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysUser objects filtered by the LAST_USER_ID column
 * @method     ChildSysUser[]|Collection findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysUser objects filtered by the CREATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysUser objects filtered by the CREATION_DATE column
 * @method     ChildSysUser[]|Collection findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysUser objects filtered by the MODIFICATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysUser> findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysUser objects filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
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
    public function findPk($key, ?ConnectionInterface $con = null)
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
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
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
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
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
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
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
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SysUserTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SysUserTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
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
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysUserTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE EMAIL LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE EMAIL IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the USERNAME column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE USERNAME = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE USERNAME LIKE '%fooValue%'
     * $query->filterByUsername(['foo', 'bar']); // WHERE USERNAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $username The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsername($username = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserTableMap::COL_USERNAME, $username, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PASSWORD column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE PASSWORD = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE PASSWORD LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE PASSWORD IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserTableMap::COL_PASSWORD, $password, $comparison);

        return $this;
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE STATUS LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE STATUS IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the LOCATION column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE LOCATION = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE LOCATION LIKE '%fooValue%'
     * $query->filterByLocation(['foo', 'bar']); // WHERE LOCATION IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $location The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocation($location = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserTableMap::COL_LOCATION, $location, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ADDRESS column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE ADDRESS = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE ADDRESS LIKE '%fooValue%'
     * $query->filterByAddress(['foo', 'bar']); // WHERE ADDRESS IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $address The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress($address = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the IMAGE_MIME column
     *
     * Example usage:
     * <code>
     * $query->filterByImageMime('fooValue');   // WHERE IMAGE_MIME = 'fooValue'
     * $query->filterByImageMime('%fooValue%', Criteria::LIKE); // WHERE IMAGE_MIME LIKE '%fooValue%'
     * $query->filterByImageMime(['foo', 'bar']); // WHERE IMAGE_MIME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $imageMime The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImageMime($imageMime = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageMime)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysUserTableMap::COL_IMAGE_MIME, $imageMime, $comparison);

        return $this;
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
     * @param mixed $actualAccess The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActualAccess($actualAccess = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysUserTableMap::COL_ACTUAL_ACCESS, $actualAccess, $comparison);

        return $this;
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
     * @param mixed $lastAccess The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastAccess($lastAccess = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysUserTableMap::COL_LAST_ACCESS, $lastAccess, $comparison);

        return $this;
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
     * @param mixed $accessFailures The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccessFailures($accessFailures = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysUserTableMap::COL_ACCESS_FAILURES, $accessFailures, $comparison);

        return $this;
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
     * @param mixed $lastUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysUserTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);

        return $this;
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
     * @param mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysUserTableMap::COL_CREATION_DATE, $creationDate, $comparison);

        return $this;
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
     * @param mixed $modificationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysUserTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysAuth object
     *
     * @param \SysAuth|ObjectCollection $sysAuth the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysAuth($sysAuth, ?string $comparison = null)
    {
        if ($sysAuth instanceof \SysAuth) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysAuth->getUserId(), $comparison);

            return $this;
        } elseif ($sysAuth instanceof ObjectCollection) {
            $this
                ->useSysAuthQuery()
                ->filterByPrimaryKeys($sysAuth->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysAuth() only accepts arguments of type \SysAuth or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysAuth relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysAuth(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysAuthQuery A secondary query class using the current class as primary query
     */
    public function useSysAuthQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysAuth($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysAuth', '\SysAuthQuery');
    }

    /**
     * Use the SysAuth relation SysAuth object
     *
     * @param callable(\SysAuthQuery):\SysAuthQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysAuthQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysAuthQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysAuth table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysAuthQuery The inner query object of the EXISTS statement
     */
    public function useSysAuthExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysAuthQuery */
        $q = $this->useExistsQuery('SysAuth', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysAuth table for a NOT EXISTS query.
     *
     * @see useSysAuthExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysAuthQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysAuthNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysAuthQuery */
        $q = $this->useExistsQuery('SysAuth', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysAuth table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysAuthQuery The inner query object of the IN statement
     */
    public function useInSysAuthQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysAuthQuery */
        $q = $this->useInQuery('SysAuth', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysAuth table for a NOT IN query.
     *
     * @see useSysAuthInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysAuthQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysAuthQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysAuthQuery */
        $q = $this->useInQuery('SysAuth', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysEmailSent object
     *
     * @param \SysEmailSent|ObjectCollection $sysEmailSent the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEmailSent($sysEmailSent, ?string $comparison = null)
    {
        if ($sysEmailSent instanceof \SysEmailSent) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysEmailSent->getUserId(), $comparison);

            return $this;
        } elseif ($sysEmailSent instanceof ObjectCollection) {
            $this
                ->useSysEmailSentQuery()
                ->filterByPrimaryKeys($sysEmailSent->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysEmailSent() only accepts arguments of type \SysEmailSent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEmailSent relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEmailSent(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEmailSentQuery A secondary query class using the current class as primary query
     */
    public function useSysEmailSentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysEmailSent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEmailSent', '\SysEmailSentQuery');
    }

    /**
     * Use the SysEmailSent relation SysEmailSent object
     *
     * @param callable(\SysEmailSentQuery):\SysEmailSentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEmailSentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSysEmailSentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEmailSent table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEmailSentQuery The inner query object of the EXISTS statement
     */
    public function useSysEmailSentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEmailSentQuery */
        $q = $this->useExistsQuery('SysEmailSent', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEmailSent table for a NOT EXISTS query.
     *
     * @see useSysEmailSentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEmailSentQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEmailSentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEmailSentQuery */
        $q = $this->useExistsQuery('SysEmailSent', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEmailSent table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEmailSentQuery The inner query object of the IN statement
     */
    public function useInSysEmailSentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEmailSentQuery */
        $q = $this->useInQuery('SysEmailSent', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEmailSent table for a NOT IN query.
     *
     * @see useSysEmailSentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEmailSentQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEmailSentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEmailSentQuery */
        $q = $this->useInQuery('SysEmailSent', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysEntityUser object
     *
     * @param \SysEntityUser|ObjectCollection $sysEntityUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEntityUser($sysEntityUser, ?string $comparison = null)
    {
        if ($sysEntityUser instanceof \SysEntityUser) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysEntityUser->getUserId(), $comparison);

            return $this;
        } elseif ($sysEntityUser instanceof ObjectCollection) {
            $this
                ->useSysEntityUserQuery()
                ->filterByPrimaryKeys($sysEntityUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysEntityUser() only accepts arguments of type \SysEntityUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEntityUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityUserQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityUser', '\SysEntityUserQuery');
    }

    /**
     * Use the SysEntityUser relation SysEntityUser object
     *
     * @param callable(\SysEntityUserQuery):\SysEntityUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEntityUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEntityUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEntityUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEntityUserQuery The inner query object of the EXISTS statement
     */
    public function useSysEntityUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useExistsQuery('SysEntityUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEntityUser table for a NOT EXISTS query.
     *
     * @see useSysEntityUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEntityUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEntityUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useExistsQuery('SysEntityUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEntityUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEntityUserQuery The inner query object of the IN statement
     */
    public function useInSysEntityUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useInQuery('SysEntityUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEntityUser table for a NOT IN query.
     *
     * @see useSysEntityUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEntityUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEntityUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityUserQuery */
        $q = $this->useInQuery('SysEntityUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysEventUser object
     *
     * @param \SysEventUser|ObjectCollection $sysEventUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEventUser($sysEventUser, ?string $comparison = null)
    {
        if ($sysEventUser instanceof \SysEventUser) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysEventUser->getUserId(), $comparison);

            return $this;
        } elseif ($sysEventUser instanceof ObjectCollection) {
            $this
                ->useSysEventUserQuery()
                ->filterByPrimaryKeys($sysEventUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysEventUser() only accepts arguments of type \SysEventUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEventUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEventUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEventUserQuery A secondary query class using the current class as primary query
     */
    public function useSysEventUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEventUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEventUser', '\SysEventUserQuery');
    }

    /**
     * Use the SysEventUser relation SysEventUser object
     *
     * @param callable(\SysEventUserQuery):\SysEventUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEventUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEventUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEventUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEventUserQuery The inner query object of the EXISTS statement
     */
    public function useSysEventUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEventUserQuery */
        $q = $this->useExistsQuery('SysEventUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEventUser table for a NOT EXISTS query.
     *
     * @see useSysEventUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEventUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEventUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEventUserQuery */
        $q = $this->useExistsQuery('SysEventUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEventUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEventUserQuery The inner query object of the IN statement
     */
    public function useInSysEventUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEventUserQuery */
        $q = $this->useInQuery('SysEventUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEventUser table for a NOT IN query.
     *
     * @see useSysEventUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEventUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEventUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEventUserQuery */
        $q = $this->useInQuery('SysEventUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysImage object
     *
     * @param \SysImage|ObjectCollection $sysImage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysImage($sysImage, ?string $comparison = null)
    {
        if ($sysImage instanceof \SysImage) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysImage->getUserId(), $comparison);

            return $this;
        } elseif ($sysImage instanceof ObjectCollection) {
            $this
                ->useSysImageQuery()
                ->filterByPrimaryKeys($sysImage->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysImage() only accepts arguments of type \SysImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysImage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysImage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysImageQuery A secondary query class using the current class as primary query
     */
    public function useSysImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysImage', '\SysImageQuery');
    }

    /**
     * Use the SysImage relation SysImage object
     *
     * @param callable(\SysImageQuery):\SysImageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysImageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysImageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysImage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysImageQuery The inner query object of the EXISTS statement
     */
    public function useSysImageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysImageQuery */
        $q = $this->useExistsQuery('SysImage', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysImage table for a NOT EXISTS query.
     *
     * @see useSysImageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysImageQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysImageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysImageQuery */
        $q = $this->useExistsQuery('SysImage', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysImage table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysImageQuery The inner query object of the IN statement
     */
    public function useInSysImageQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysImageQuery */
        $q = $this->useInQuery('SysImage', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysImage table for a NOT IN query.
     *
     * @see useSysImageInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysImageQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysImageQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysImageQuery */
        $q = $this->useInQuery('SysImage', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysPassword object
     *
     * @param \SysPassword|ObjectCollection $sysPassword the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysPassword($sysPassword, ?string $comparison = null)
    {
        if ($sysPassword instanceof \SysPassword) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysPassword->getUserId(), $comparison);

            return $this;
        } elseif ($sysPassword instanceof ObjectCollection) {
            $this
                ->useSysPasswordQuery()
                ->filterByPrimaryKeys($sysPassword->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysPassword() only accepts arguments of type \SysPassword or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPassword relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysPassword(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysPasswordQuery A secondary query class using the current class as primary query
     */
    public function useSysPasswordQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysPassword($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPassword', '\SysPasswordQuery');
    }

    /**
     * Use the SysPassword relation SysPassword object
     *
     * @param callable(\SysPasswordQuery):\SysPasswordQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysPasswordQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysPasswordQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysPassword table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysPasswordQuery The inner query object of the EXISTS statement
     */
    public function useSysPasswordExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysPasswordQuery */
        $q = $this->useExistsQuery('SysPassword', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysPassword table for a NOT EXISTS query.
     *
     * @see useSysPasswordExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysPasswordQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysPasswordNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysPasswordQuery */
        $q = $this->useExistsQuery('SysPassword', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysPassword table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysPasswordQuery The inner query object of the IN statement
     */
    public function useInSysPasswordQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysPasswordQuery */
        $q = $this->useInQuery('SysPassword', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysPassword table for a NOT IN query.
     *
     * @see useSysPasswordInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysPasswordQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysPasswordQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysPasswordQuery */
        $q = $this->useInQuery('SysPassword', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysPasswordRequest object
     *
     * @param \SysPasswordRequest|ObjectCollection $sysPasswordRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysPasswordRequest($sysPasswordRequest, ?string $comparison = null)
    {
        if ($sysPasswordRequest instanceof \SysPasswordRequest) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysPasswordRequest->getUserId(), $comparison);

            return $this;
        } elseif ($sysPasswordRequest instanceof ObjectCollection) {
            $this
                ->useSysPasswordRequestQuery()
                ->filterByPrimaryKeys($sysPasswordRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysPasswordRequest() only accepts arguments of type \SysPasswordRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPasswordRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysPasswordRequest(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysPasswordRequestQuery A secondary query class using the current class as primary query
     */
    public function useSysPasswordRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysPasswordRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPasswordRequest', '\SysPasswordRequestQuery');
    }

    /**
     * Use the SysPasswordRequest relation SysPasswordRequest object
     *
     * @param callable(\SysPasswordRequestQuery):\SysPasswordRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysPasswordRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysPasswordRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysPasswordRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysPasswordRequestQuery The inner query object of the EXISTS statement
     */
    public function useSysPasswordRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysPasswordRequestQuery */
        $q = $this->useExistsQuery('SysPasswordRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysPasswordRequest table for a NOT EXISTS query.
     *
     * @see useSysPasswordRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysPasswordRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysPasswordRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysPasswordRequestQuery */
        $q = $this->useExistsQuery('SysPasswordRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysPasswordRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysPasswordRequestQuery The inner query object of the IN statement
     */
    public function useInSysPasswordRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysPasswordRequestQuery */
        $q = $this->useInQuery('SysPasswordRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysPasswordRequest table for a NOT IN query.
     *
     * @see useSysPasswordRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysPasswordRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysPasswordRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysPasswordRequestQuery */
        $q = $this->useInQuery('SysPasswordRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysPerson object
     *
     * @param \SysPerson|ObjectCollection $sysPerson the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysPerson($sysPerson, ?string $comparison = null)
    {
        if ($sysPerson instanceof \SysPerson) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysPerson->getUserId(), $comparison);

            return $this;
        } elseif ($sysPerson instanceof ObjectCollection) {
            $this
                ->useSysPersonQuery()
                ->filterByPrimaryKeys($sysPerson->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysPerson() only accepts arguments of type \SysPerson or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysPerson relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysPerson(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysPersonQuery A secondary query class using the current class as primary query
     */
    public function useSysPersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysPerson', '\SysPersonQuery');
    }

    /**
     * Use the SysPerson relation SysPerson object
     *
     * @param callable(\SysPersonQuery):\SysPersonQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysPersonQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysPersonQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysPerson table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysPersonQuery The inner query object of the EXISTS statement
     */
    public function useSysPersonExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysPersonQuery */
        $q = $this->useExistsQuery('SysPerson', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysPerson table for a NOT EXISTS query.
     *
     * @see useSysPersonExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysPersonQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysPersonNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysPersonQuery */
        $q = $this->useExistsQuery('SysPerson', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysPerson table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysPersonQuery The inner query object of the IN statement
     */
    public function useInSysPersonQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysPersonQuery */
        $q = $this->useInQuery('SysPerson', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysPerson table for a NOT IN query.
     *
     * @see useSysPersonInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysPersonQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysPersonQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysPersonQuery */
        $q = $this->useInQuery('SysPerson', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysUserParam object
     *
     * @param \SysUserParam|ObjectCollection $sysUserParam the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysUserParam($sysUserParam, ?string $comparison = null)
    {
        if ($sysUserParam instanceof \SysUserParam) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysUserParam->getUserId(), $comparison);

            return $this;
        } elseif ($sysUserParam instanceof ObjectCollection) {
            $this
                ->useSysUserParamQuery()
                ->filterByPrimaryKeys($sysUserParam->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysUserParam() only accepts arguments of type \SysUserParam or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUserParam relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysUserParam(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysUserParamQuery A secondary query class using the current class as primary query
     */
    public function useSysUserParamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUserParam($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUserParam', '\SysUserParamQuery');
    }

    /**
     * Use the SysUserParam relation SysUserParam object
     *
     * @param callable(\SysUserParamQuery):\SysUserParamQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysUserParamQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysUserParamQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysUserParam table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysUserParamQuery The inner query object of the EXISTS statement
     */
    public function useSysUserParamExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysUserParamQuery */
        $q = $this->useExistsQuery('SysUserParam', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysUserParam table for a NOT EXISTS query.
     *
     * @see useSysUserParamExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysUserParamQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysUserParamNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserParamQuery */
        $q = $this->useExistsQuery('SysUserParam', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysUserParam table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysUserParamQuery The inner query object of the IN statement
     */
    public function useInSysUserParamQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysUserParamQuery */
        $q = $this->useInQuery('SysUserParam', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysUserParam table for a NOT IN query.
     *
     * @see useSysUserParamInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysUserParamQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysUserParamQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserParamQuery */
        $q = $this->useInQuery('SysUserParam', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysUserXRol object
     *
     * @param \SysUserXRol|ObjectCollection $sysUserXRol the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysUserXRol($sysUserXRol, ?string $comparison = null)
    {
        if ($sysUserXRol instanceof \SysUserXRol) {
            $this
                ->addUsingAlias(SysUserTableMap::COL_ID, $sysUserXRol->getUserId(), $comparison);

            return $this;
        } elseif ($sysUserXRol instanceof ObjectCollection) {
            $this
                ->useSysUserXRolQuery()
                ->filterByPrimaryKeys($sysUserXRol->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysUserXRol() only accepts arguments of type \SysUserXRol or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUserXRol relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysUserXRol(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysUserXRolQuery A secondary query class using the current class as primary query
     */
    public function useSysUserXRolQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysUserXRol($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysUserXRol', '\SysUserXRolQuery');
    }

    /**
     * Use the SysUserXRol relation SysUserXRol object
     *
     * @param callable(\SysUserXRolQuery):\SysUserXRolQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysUserXRolQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysUserXRolQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysUserXRol table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysUserXRolQuery The inner query object of the EXISTS statement
     */
    public function useSysUserXRolExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useExistsQuery('SysUserXRol', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysUserXRol table for a NOT EXISTS query.
     *
     * @see useSysUserXRolExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysUserXRolQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysUserXRolNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useExistsQuery('SysUserXRol', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysUserXRol table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysUserXRolQuery The inner query object of the IN statement
     */
    public function useInSysUserXRolQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useInQuery('SysUserXRol', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysUserXRol table for a NOT IN query.
     *
     * @see useSysUserXRolInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysUserXRolQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysUserXRolQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserXRolQuery */
        $q = $this->useInQuery('SysUserXRol', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSysUser $sysUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
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
    public function doDeleteAll(?ConnectionInterface $con = null): int
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
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
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

}
