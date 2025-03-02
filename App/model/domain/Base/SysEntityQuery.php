<?php

namespace Base;

use \SysEntity as ChildSysEntity;
use \SysEntityQuery as ChildSysEntityQuery;
use \Exception;
use \PDO;
use Map\SysEntityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_entity` table.
 *
 * @method     ChildSysEntityQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEntityQuery orderByEntityTypeId($order = Criteria::ASC) Order by the ENTITY_TYPE_ID column
 * @method     ChildSysEntityQuery orderByLocationId($order = Criteria::ASC) Order by the LOCATION_ID column
 * @method     ChildSysEntityQuery orderByMainBranchId($order = Criteria::ASC) Order by the MAIN_BRANCH_ID column
 * @method     ChildSysEntityQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysEntityQuery orderByComercialName($order = Criteria::ASC) Order by the COMERCIAL_NAME column
 * @method     ChildSysEntityQuery orderByFormalName($order = Criteria::ASC) Order by the FORMAL_NAME column
 * @method     ChildSysEntityQuery orderByNit($order = Criteria::ASC) Order by the NIT column
 * @method     ChildSysEntityQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildSysEntityQuery orderByAddress($order = Criteria::ASC) Order by the ADDRESS column
 * @method     ChildSysEntityQuery orderByPhone($order = Criteria::ASC) Order by the PHONE column
 * @method     ChildSysEntityQuery orderByCellphone($order = Criteria::ASC) Order by the CELLPHONE column
 * @method     ChildSysEntityQuery orderByActivities($order = Criteria::ASC) Order by the ACTIVITIES column
 * @method     ChildSysEntityQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysEntityQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysEntityQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysEntityQuery orderByModificacionDate($order = Criteria::ASC) Order by the MODIFICACION_DATE column
 *
 * @method     ChildSysEntityQuery groupById() Group by the ID column
 * @method     ChildSysEntityQuery groupByEntityTypeId() Group by the ENTITY_TYPE_ID column
 * @method     ChildSysEntityQuery groupByLocationId() Group by the LOCATION_ID column
 * @method     ChildSysEntityQuery groupByMainBranchId() Group by the MAIN_BRANCH_ID column
 * @method     ChildSysEntityQuery groupByCode() Group by the CODE column
 * @method     ChildSysEntityQuery groupByComercialName() Group by the COMERCIAL_NAME column
 * @method     ChildSysEntityQuery groupByFormalName() Group by the FORMAL_NAME column
 * @method     ChildSysEntityQuery groupByNit() Group by the NIT column
 * @method     ChildSysEntityQuery groupByEmail() Group by the EMAIL column
 * @method     ChildSysEntityQuery groupByAddress() Group by the ADDRESS column
 * @method     ChildSysEntityQuery groupByPhone() Group by the PHONE column
 * @method     ChildSysEntityQuery groupByCellphone() Group by the CELLPHONE column
 * @method     ChildSysEntityQuery groupByActivities() Group by the ACTIVITIES column
 * @method     ChildSysEntityQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysEntityQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysEntityQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysEntityQuery groupByModificacionDate() Group by the MODIFICACION_DATE column
 *
 * @method     ChildSysEntityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEntityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEntityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEntityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEntityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEntityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery rightJoinSysEntityType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery innerJoinSysEntityType($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityType relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityType relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityType() Adds a LEFT JOIN clause and with to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityType() Adds a RIGHT JOIN clause and with to the query using the SysEntityType relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityType() Adds a INNER JOIN clause and with to the query using the SysEntityType relation
 *
 * @method     ChildSysEntityQuery leftJoinSysLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysLocation relation
 * @method     ChildSysEntityQuery rightJoinSysLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysLocation relation
 * @method     ChildSysEntityQuery innerJoinSysLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the SysLocation relation
 *
 * @method     ChildSysEntityQuery joinWithSysLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysLocation relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysLocation() Adds a LEFT JOIN clause and with to the query using the SysLocation relation
 * @method     ChildSysEntityQuery rightJoinWithSysLocation() Adds a RIGHT JOIN clause and with to the query using the SysLocation relation
 * @method     ChildSysEntityQuery innerJoinWithSysLocation() Adds a INNER JOIN clause and with to the query using the SysLocation relation
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery rightJoinSysEntityBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery innerJoinSysEntityBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityBranch relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityBranch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityBranch relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityBranch() Adds a LEFT JOIN clause and with to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityBranch() Adds a RIGHT JOIN clause and with to the query using the SysEntityBranch relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityBranch() Adds a INNER JOIN clause and with to the query using the SysEntityBranch relation
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityParam($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery rightJoinSysEntityParam($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery innerJoinSysEntityParam($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityParam relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityParam($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityParam relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityParam() Adds a LEFT JOIN clause and with to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityParam() Adds a RIGHT JOIN clause and with to the query using the SysEntityParam relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityParam() Adds a INNER JOIN clause and with to the query using the SysEntityParam relation
 *
 * @method     ChildSysEntityQuery leftJoinSysEntityUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery rightJoinSysEntityUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery innerJoinSysEntityUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEntityUser relation
 *
 * @method     ChildSysEntityQuery joinWithSysEntityUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEntityUser relation
 *
 * @method     ChildSysEntityQuery leftJoinWithSysEntityUser() Adds a LEFT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery rightJoinWithSysEntityUser() Adds a RIGHT JOIN clause and with to the query using the SysEntityUser relation
 * @method     ChildSysEntityQuery innerJoinWithSysEntityUser() Adds a INNER JOIN clause and with to the query using the SysEntityUser relation
 *
 * @method     \SysEntityTypeQuery|\SysLocationQuery|\SysEntityBranchQuery|\SysEntityParamQuery|\SysEntityUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEntity|null findOne(?ConnectionInterface $con = null) Return the first ChildSysEntity matching the query
 * @method     ChildSysEntity findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysEntity matching the query, or a new ChildSysEntity object populated from the query conditions when no match is found
 *
 * @method     ChildSysEntity|null findOneById(int $ID) Return the first ChildSysEntity filtered by the ID column
 * @method     ChildSysEntity|null findOneByEntityTypeId(int $ENTITY_TYPE_ID) Return the first ChildSysEntity filtered by the ENTITY_TYPE_ID column
 * @method     ChildSysEntity|null findOneByLocationId(int $LOCATION_ID) Return the first ChildSysEntity filtered by the LOCATION_ID column
 * @method     ChildSysEntity|null findOneByMainBranchId(int $MAIN_BRANCH_ID) Return the first ChildSysEntity filtered by the MAIN_BRANCH_ID column
 * @method     ChildSysEntity|null findOneByCode(string $CODE) Return the first ChildSysEntity filtered by the CODE column
 * @method     ChildSysEntity|null findOneByComercialName(string $COMERCIAL_NAME) Return the first ChildSysEntity filtered by the COMERCIAL_NAME column
 * @method     ChildSysEntity|null findOneByFormalName(string $FORMAL_NAME) Return the first ChildSysEntity filtered by the FORMAL_NAME column
 * @method     ChildSysEntity|null findOneByNit(string $NIT) Return the first ChildSysEntity filtered by the NIT column
 * @method     ChildSysEntity|null findOneByEmail(string $EMAIL) Return the first ChildSysEntity filtered by the EMAIL column
 * @method     ChildSysEntity|null findOneByAddress(string $ADDRESS) Return the first ChildSysEntity filtered by the ADDRESS column
 * @method     ChildSysEntity|null findOneByPhone(string $PHONE) Return the first ChildSysEntity filtered by the PHONE column
 * @method     ChildSysEntity|null findOneByCellphone(string $CELLPHONE) Return the first ChildSysEntity filtered by the CELLPHONE column
 * @method     ChildSysEntity|null findOneByActivities(string $ACTIVITIES) Return the first ChildSysEntity filtered by the ACTIVITIES column
 * @method     ChildSysEntity|null findOneByDescription(string $DESCRIPTION) Return the first ChildSysEntity filtered by the DESCRIPTION column
 * @method     ChildSysEntity|null findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntity filtered by the LAST_USER_ID column
 * @method     ChildSysEntity|null findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntity filtered by the CREATION_DATE column
 * @method     ChildSysEntity|null findOneByModificacionDate(string $MODIFICACION_DATE) Return the first ChildSysEntity filtered by the MODIFICACION_DATE column
 *
 * @method     ChildSysEntity requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysEntity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOne(?ConnectionInterface $con = null) Return the first ChildSysEntity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntity requireOneById(int $ID) Return the first ChildSysEntity filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByEntityTypeId(int $ENTITY_TYPE_ID) Return the first ChildSysEntity filtered by the ENTITY_TYPE_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByLocationId(int $LOCATION_ID) Return the first ChildSysEntity filtered by the LOCATION_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByMainBranchId(int $MAIN_BRANCH_ID) Return the first ChildSysEntity filtered by the MAIN_BRANCH_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByCode(string $CODE) Return the first ChildSysEntity filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByComercialName(string $COMERCIAL_NAME) Return the first ChildSysEntity filtered by the COMERCIAL_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByFormalName(string $FORMAL_NAME) Return the first ChildSysEntity filtered by the FORMAL_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByNit(string $NIT) Return the first ChildSysEntity filtered by the NIT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByEmail(string $EMAIL) Return the first ChildSysEntity filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByAddress(string $ADDRESS) Return the first ChildSysEntity filtered by the ADDRESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByPhone(string $PHONE) Return the first ChildSysEntity filtered by the PHONE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByCellphone(string $CELLPHONE) Return the first ChildSysEntity filtered by the CELLPHONE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByActivities(string $ACTIVITIES) Return the first ChildSysEntity filtered by the ACTIVITIES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEntity filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEntity filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEntity filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEntity requireOneByModificacionDate(string $MODIFICACION_DATE) Return the first ChildSysEntity filtered by the MODIFICACION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEntity[]|Collection find(?ConnectionInterface $con = null) Return ChildSysEntity objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysEntity> find(?ConnectionInterface $con = null) Return ChildSysEntity objects based on current ModelCriteria
 *
 * @method     ChildSysEntity[]|Collection findById(int|array<int> $ID) Return ChildSysEntity objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findById(int|array<int> $ID) Return ChildSysEntity objects filtered by the ID column
 * @method     ChildSysEntity[]|Collection findByEntityTypeId(int|array<int> $ENTITY_TYPE_ID) Return ChildSysEntity objects filtered by the ENTITY_TYPE_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByEntityTypeId(int|array<int> $ENTITY_TYPE_ID) Return ChildSysEntity objects filtered by the ENTITY_TYPE_ID column
 * @method     ChildSysEntity[]|Collection findByLocationId(int|array<int> $LOCATION_ID) Return ChildSysEntity objects filtered by the LOCATION_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByLocationId(int|array<int> $LOCATION_ID) Return ChildSysEntity objects filtered by the LOCATION_ID column
 * @method     ChildSysEntity[]|Collection findByMainBranchId(int|array<int> $MAIN_BRANCH_ID) Return ChildSysEntity objects filtered by the MAIN_BRANCH_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByMainBranchId(int|array<int> $MAIN_BRANCH_ID) Return ChildSysEntity objects filtered by the MAIN_BRANCH_ID column
 * @method     ChildSysEntity[]|Collection findByCode(string|array<string> $CODE) Return ChildSysEntity objects filtered by the CODE column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByCode(string|array<string> $CODE) Return ChildSysEntity objects filtered by the CODE column
 * @method     ChildSysEntity[]|Collection findByComercialName(string|array<string> $COMERCIAL_NAME) Return ChildSysEntity objects filtered by the COMERCIAL_NAME column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByComercialName(string|array<string> $COMERCIAL_NAME) Return ChildSysEntity objects filtered by the COMERCIAL_NAME column
 * @method     ChildSysEntity[]|Collection findByFormalName(string|array<string> $FORMAL_NAME) Return ChildSysEntity objects filtered by the FORMAL_NAME column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByFormalName(string|array<string> $FORMAL_NAME) Return ChildSysEntity objects filtered by the FORMAL_NAME column
 * @method     ChildSysEntity[]|Collection findByNit(string|array<string> $NIT) Return ChildSysEntity objects filtered by the NIT column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByNit(string|array<string> $NIT) Return ChildSysEntity objects filtered by the NIT column
 * @method     ChildSysEntity[]|Collection findByEmail(string|array<string> $EMAIL) Return ChildSysEntity objects filtered by the EMAIL column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByEmail(string|array<string> $EMAIL) Return ChildSysEntity objects filtered by the EMAIL column
 * @method     ChildSysEntity[]|Collection findByAddress(string|array<string> $ADDRESS) Return ChildSysEntity objects filtered by the ADDRESS column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByAddress(string|array<string> $ADDRESS) Return ChildSysEntity objects filtered by the ADDRESS column
 * @method     ChildSysEntity[]|Collection findByPhone(string|array<string> $PHONE) Return ChildSysEntity objects filtered by the PHONE column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByPhone(string|array<string> $PHONE) Return ChildSysEntity objects filtered by the PHONE column
 * @method     ChildSysEntity[]|Collection findByCellphone(string|array<string> $CELLPHONE) Return ChildSysEntity objects filtered by the CELLPHONE column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByCellphone(string|array<string> $CELLPHONE) Return ChildSysEntity objects filtered by the CELLPHONE column
 * @method     ChildSysEntity[]|Collection findByActivities(string|array<string> $ACTIVITIES) Return ChildSysEntity objects filtered by the ACTIVITIES column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByActivities(string|array<string> $ACTIVITIES) Return ChildSysEntity objects filtered by the ACTIVITIES column
 * @method     ChildSysEntity[]|Collection findByDescription(string|array<string> $DESCRIPTION) Return ChildSysEntity objects filtered by the DESCRIPTION column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByDescription(string|array<string> $DESCRIPTION) Return ChildSysEntity objects filtered by the DESCRIPTION column
 * @method     ChildSysEntity[]|Collection findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysEntity objects filtered by the LAST_USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysEntity objects filtered by the LAST_USER_ID column
 * @method     ChildSysEntity[]|Collection findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysEntity objects filtered by the CREATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysEntity objects filtered by the CREATION_DATE column
 * @method     ChildSysEntity[]|Collection findByModificacionDate(string|array<string> $MODIFICACION_DATE) Return ChildSysEntity objects filtered by the MODIFICACION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysEntity> findByModificacionDate(string|array<string> $MODIFICACION_DATE) Return ChildSysEntity objects filtered by the MODIFICACION_DATE column
 *
 * @method     ChildSysEntity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysEntity> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysEntityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysEntityQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysEntity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEntityQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEntityQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSysEntityQuery) {
            return $criteria;
        }
        $query = new ChildSysEntityQuery();
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
     * @return ChildSysEntity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEntityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEntityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEntity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ENTITY_TYPE_ID, LOCATION_ID, MAIN_BRANCH_ID, CODE, COMERCIAL_NAME, FORMAL_NAME, NIT, EMAIL, ADDRESS, PHONE, CELLPHONE, ACTIVITIES, DESCRIPTION, LAST_USER_ID, CREATION_DATE, MODIFICACION_DATE FROM sys_entity WHERE ID = :p0';
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
            /** @var ChildSysEntity $obj */
            $obj = new ChildSysEntity();
            $obj->hydrate($row);
            SysEntityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEntity|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SysEntityTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysEntityTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SysEntityTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ENTITY_TYPE_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityTypeId(1234); // WHERE ENTITY_TYPE_ID = 1234
     * $query->filterByEntityTypeId(array(12, 34)); // WHERE ENTITY_TYPE_ID IN (12, 34)
     * $query->filterByEntityTypeId(array('min' => 12)); // WHERE ENTITY_TYPE_ID > 12
     * </code>
     *
     * @see       filterBySysEntityType()
     *
     * @param mixed $entityTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEntityTypeId($entityTypeId = null, ?string $comparison = null)
    {
        if (is_array($entityTypeId)) {
            $useMinMax = false;
            if (isset($entityTypeId['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $entityTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityTypeId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $entityTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $entityTypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the LOCATION_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationId(1234); // WHERE LOCATION_ID = 1234
     * $query->filterByLocationId(array(12, 34)); // WHERE LOCATION_ID IN (12, 34)
     * $query->filterByLocationId(array('min' => 12)); // WHERE LOCATION_ID > 12
     * </code>
     *
     * @see       filterBySysLocation()
     *
     * @param mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, ?string $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $locationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the MAIN_BRANCH_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByMainBranchId(1234); // WHERE MAIN_BRANCH_ID = 1234
     * $query->filterByMainBranchId(array(12, 34)); // WHERE MAIN_BRANCH_ID IN (12, 34)
     * $query->filterByMainBranchId(array('min' => 12)); // WHERE MAIN_BRANCH_ID > 12
     * </code>
     *
     * @param mixed $mainBranchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMainBranchId($mainBranchId = null, ?string $comparison = null)
    {
        if (is_array($mainBranchId)) {
            $useMinMax = false;
            if (isset($mainBranchId['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MAIN_BRANCH_ID, $mainBranchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mainBranchId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MAIN_BRANCH_ID, $mainBranchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_MAIN_BRANCH_ID, $mainBranchId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE CODE = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE CODE LIKE '%fooValue%'
     * $query->filterByCode(['foo', 'bar']); // WHERE CODE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $code The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode($code = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_CODE, $code, $comparison);

        return $this;
    }

    /**
     * Filter the query on the COMERCIAL_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByComercialName('fooValue');   // WHERE COMERCIAL_NAME = 'fooValue'
     * $query->filterByComercialName('%fooValue%', Criteria::LIKE); // WHERE COMERCIAL_NAME LIKE '%fooValue%'
     * $query->filterByComercialName(['foo', 'bar']); // WHERE COMERCIAL_NAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $comercialName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComercialName($comercialName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comercialName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_COMERCIAL_NAME, $comercialName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the FORMAL_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByFormalName('fooValue');   // WHERE FORMAL_NAME = 'fooValue'
     * $query->filterByFormalName('%fooValue%', Criteria::LIKE); // WHERE FORMAL_NAME LIKE '%fooValue%'
     * $query->filterByFormalName(['foo', 'bar']); // WHERE FORMAL_NAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $formalName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFormalName($formalName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formalName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_FORMAL_NAME, $formalName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the NIT column
     *
     * Example usage:
     * <code>
     * $query->filterByNit('fooValue');   // WHERE NIT = 'fooValue'
     * $query->filterByNit('%fooValue%', Criteria::LIKE); // WHERE NIT LIKE '%fooValue%'
     * $query->filterByNit(['foo', 'bar']); // WHERE NIT IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nit The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNit($nit = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nit)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_NIT, $nit, $comparison);

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

        $this->addUsingAlias(SysEntityTableMap::COL_EMAIL, $email, $comparison);

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

        $this->addUsingAlias(SysEntityTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PHONE column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE PHONE = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE PHONE LIKE '%fooValue%'
     * $query->filterByPhone(['foo', 'bar']); // WHERE PHONE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone($phone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_PHONE, $phone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the CELLPHONE column
     *
     * Example usage:
     * <code>
     * $query->filterByCellphone('fooValue');   // WHERE CELLPHONE = 'fooValue'
     * $query->filterByCellphone('%fooValue%', Criteria::LIKE); // WHERE CELLPHONE LIKE '%fooValue%'
     * $query->filterByCellphone(['foo', 'bar']); // WHERE CELLPHONE IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cellphone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCellphone($cellphone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cellphone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_CELLPHONE, $cellphone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ACTIVITIES column
     *
     * Example usage:
     * <code>
     * $query->filterByActivities('fooValue');   // WHERE ACTIVITIES = 'fooValue'
     * $query->filterByActivities('%fooValue%', Criteria::LIKE); // WHERE ACTIVITIES LIKE '%fooValue%'
     * $query->filterByActivities(['foo', 'bar']); // WHERE ACTIVITIES IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $activities The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActivities($activities = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($activities)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_ACTIVITIES, $activities, $comparison);

        return $this;
    }

    /**
     * Filter the query on the DESCRIPTION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE DESCRIPTION = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE DESCRIPTION LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE DESCRIPTION IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_DESCRIPTION, $description, $comparison);

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
                $this->addUsingAlias(SysEntityTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);

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
                $this->addUsingAlias(SysEntityTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_CREATION_DATE, $creationDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the MODIFICACION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByModificacionDate('2011-03-14'); // WHERE MODIFICACION_DATE = '2011-03-14'
     * $query->filterByModificacionDate('now'); // WHERE MODIFICACION_DATE = '2011-03-14'
     * $query->filterByModificacionDate(array('max' => 'yesterday')); // WHERE MODIFICACION_DATE > '2011-03-13'
     * </code>
     *
     * @param mixed $modificacionDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModificacionDate($modificacionDate = null, ?string $comparison = null)
    {
        if (is_array($modificacionDate)) {
            $useMinMax = false;
            if (isset($modificacionDate['min'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MODIFICACION_DATE, $modificacionDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificacionDate['max'])) {
                $this->addUsingAlias(SysEntityTableMap::COL_MODIFICACION_DATE, $modificacionDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysEntityTableMap::COL_MODIFICACION_DATE, $modificacionDate, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysEntityType object
     *
     * @param \SysEntityType|ObjectCollection $sysEntityType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEntityType($sysEntityType, ?string $comparison = null)
    {
        if ($sysEntityType instanceof \SysEntityType) {
            return $this
                ->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $sysEntityType->getId(), $comparison);
        } elseif ($sysEntityType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEntityTableMap::COL_ENTITY_TYPE_ID, $sysEntityType->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysEntityType() only accepts arguments of type \SysEntityType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEntityType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityType');

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
            $this->addJoinObject($join, 'SysEntityType');
        }

        return $this;
    }

    /**
     * Use the SysEntityType relation SysEntityType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityTypeQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityType', '\SysEntityTypeQuery');
    }

    /**
     * Use the SysEntityType relation SysEntityType object
     *
     * @param callable(\SysEntityTypeQuery):\SysEntityTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEntityTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEntityTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEntityType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEntityTypeQuery The inner query object of the EXISTS statement
     */
    public function useSysEntityTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEntityTypeQuery */
        $q = $this->useExistsQuery('SysEntityType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEntityType table for a NOT EXISTS query.
     *
     * @see useSysEntityTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEntityTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEntityTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityTypeQuery */
        $q = $this->useExistsQuery('SysEntityType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEntityType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEntityTypeQuery The inner query object of the IN statement
     */
    public function useInSysEntityTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEntityTypeQuery */
        $q = $this->useInQuery('SysEntityType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEntityType table for a NOT IN query.
     *
     * @see useSysEntityTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEntityTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEntityTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityTypeQuery */
        $q = $this->useInQuery('SysEntityType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysLocation object
     *
     * @param \SysLocation|ObjectCollection $sysLocation The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysLocation($sysLocation, ?string $comparison = null)
    {
        if ($sysLocation instanceof \SysLocation) {
            return $this
                ->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $sysLocation->getId(), $comparison);
        } elseif ($sysLocation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysEntityTableMap::COL_LOCATION_ID, $sysLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysLocation() only accepts arguments of type \SysLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysLocation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysLocation(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysLocation');

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
            $this->addJoinObject($join, 'SysLocation');
        }

        return $this;
    }

    /**
     * Use the SysLocation relation SysLocation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysLocationQuery A secondary query class using the current class as primary query
     */
    public function useSysLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSysLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysLocation', '\SysLocationQuery');
    }

    /**
     * Use the SysLocation relation SysLocation object
     *
     * @param callable(\SysLocationQuery):\SysLocationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysLocationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSysLocationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysLocation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysLocationQuery The inner query object of the EXISTS statement
     */
    public function useSysLocationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysLocationQuery */
        $q = $this->useExistsQuery('SysLocation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysLocation table for a NOT EXISTS query.
     *
     * @see useSysLocationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysLocationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysLocationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysLocationQuery */
        $q = $this->useExistsQuery('SysLocation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysLocation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysLocationQuery The inner query object of the IN statement
     */
    public function useInSysLocationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysLocationQuery */
        $q = $this->useInQuery('SysLocation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysLocation table for a NOT IN query.
     *
     * @see useSysLocationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysLocationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysLocationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysLocationQuery */
        $q = $this->useInQuery('SysLocation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysEntityBranch object
     *
     * @param \SysEntityBranch|ObjectCollection $sysEntityBranch the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEntityBranch($sysEntityBranch, ?string $comparison = null)
    {
        if ($sysEntityBranch instanceof \SysEntityBranch) {
            $this
                ->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntityBranch->getEntityId(), $comparison);

            return $this;
        } elseif ($sysEntityBranch instanceof ObjectCollection) {
            $this
                ->useSysEntityBranchQuery()
                ->filterByPrimaryKeys($sysEntityBranch->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysEntityBranch() only accepts arguments of type \SysEntityBranch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityBranch relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEntityBranch(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityBranch');

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
            $this->addJoinObject($join, 'SysEntityBranch');
        }

        return $this;
    }

    /**
     * Use the SysEntityBranch relation SysEntityBranch object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityBranchQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityBranchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityBranch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityBranch', '\SysEntityBranchQuery');
    }

    /**
     * Use the SysEntityBranch relation SysEntityBranch object
     *
     * @param callable(\SysEntityBranchQuery):\SysEntityBranchQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEntityBranchQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEntityBranchQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEntityBranch table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEntityBranchQuery The inner query object of the EXISTS statement
     */
    public function useSysEntityBranchExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEntityBranchQuery */
        $q = $this->useExistsQuery('SysEntityBranch', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEntityBranch table for a NOT EXISTS query.
     *
     * @see useSysEntityBranchExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEntityBranchQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEntityBranchNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityBranchQuery */
        $q = $this->useExistsQuery('SysEntityBranch', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEntityBranch table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEntityBranchQuery The inner query object of the IN statement
     */
    public function useInSysEntityBranchQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEntityBranchQuery */
        $q = $this->useInQuery('SysEntityBranch', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEntityBranch table for a NOT IN query.
     *
     * @see useSysEntityBranchInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEntityBranchQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEntityBranchQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityBranchQuery */
        $q = $this->useInQuery('SysEntityBranch', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \SysEntityParam object
     *
     * @param \SysEntityParam|ObjectCollection $sysEntityParam the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysEntityParam($sysEntityParam, ?string $comparison = null)
    {
        if ($sysEntityParam instanceof \SysEntityParam) {
            $this
                ->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntityParam->getEntityId(), $comparison);

            return $this;
        } elseif ($sysEntityParam instanceof ObjectCollection) {
            $this
                ->useSysEntityParamQuery()
                ->filterByPrimaryKeys($sysEntityParam->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySysEntityParam() only accepts arguments of type \SysEntityParam or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysEntityParam relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysEntityParam(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SysEntityParam');

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
            $this->addJoinObject($join, 'SysEntityParam');
        }

        return $this;
    }

    /**
     * Use the SysEntityParam relation SysEntityParam object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SysEntityParamQuery A secondary query class using the current class as primary query
     */
    public function useSysEntityParamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEntityParam($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEntityParam', '\SysEntityParamQuery');
    }

    /**
     * Use the SysEntityParam relation SysEntityParam object
     *
     * @param callable(\SysEntityParamQuery):\SysEntityParamQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysEntityParamQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysEntityParamQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysEntityParam table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysEntityParamQuery The inner query object of the EXISTS statement
     */
    public function useSysEntityParamExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysEntityParamQuery */
        $q = $this->useExistsQuery('SysEntityParam', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysEntityParam table for a NOT EXISTS query.
     *
     * @see useSysEntityParamExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysEntityParamQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysEntityParamNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityParamQuery */
        $q = $this->useExistsQuery('SysEntityParam', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysEntityParam table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysEntityParamQuery The inner query object of the IN statement
     */
    public function useInSysEntityParamQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysEntityParamQuery */
        $q = $this->useInQuery('SysEntityParam', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysEntityParam table for a NOT IN query.
     *
     * @see useSysEntityParamInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysEntityParamQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysEntityParamQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysEntityParamQuery */
        $q = $this->useInQuery('SysEntityParam', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntityUser->getEntityId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildSysEntity $sysEntity Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sysEntity = null)
    {
        if ($sysEntity) {
            $this->addUsingAlias(SysEntityTableMap::COL_ID, $sysEntity->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_entity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEntityTableMap::clearInstancePool();
            SysEntityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEntityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEntityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEntityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEntityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
