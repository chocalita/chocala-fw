<?php

namespace Base;

use \SysPerson as ChildSysPerson;
use \SysPersonQuery as ChildSysPersonQuery;
use \Exception;
use \PDO;
use Map\SysPersonTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_person' table.
 *
 *
 *
 * @method     ChildSysPersonQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysPersonQuery orderByUserId($order = Criteria::ASC) Order by the USER_ID column
 * @method     ChildSysPersonQuery orderByLocationId($order = Criteria::ASC) Order by the LOCATION_ID column
 * @method     ChildSysPersonQuery orderByFirstName($order = Criteria::ASC) Order by the FIRST_NAME column
 * @method     ChildSysPersonQuery orderByMiddleName($order = Criteria::ASC) Order by the MIDDLE_NAME column
 * @method     ChildSysPersonQuery orderByLastName($order = Criteria::ASC) Order by the LAST_NAME column
 * @method     ChildSysPersonQuery orderBySecondLastName($order = Criteria::ASC) Order by the SECOND_LAST_NAME column
 * @method     ChildSysPersonQuery orderByEmail($order = Criteria::ASC) Order by the EMAIL column
 * @method     ChildSysPersonQuery orderByIdNumber($order = Criteria::ASC) Order by the ID_NUMBER column
 * @method     ChildSysPersonQuery orderByIdExtension($order = Criteria::ASC) Order by the ID_EXTENSION column
 * @method     ChildSysPersonQuery orderByGender($order = Criteria::ASC) Order by the GENDER column
 * @method     ChildSysPersonQuery orderByDateOfBirth($order = Criteria::ASC) Order by the DATE_OF_BIRTH column
 * @method     ChildSysPersonQuery orderByPlaceOfBirth($order = Criteria::ASC) Order by the PLACE_OF_BIRTH column
 * @method     ChildSysPersonQuery orderByAddress($order = Criteria::ASC) Order by the ADDRESS column
 * @method     ChildSysPersonQuery orderByCity($order = Criteria::ASC) Order by the CITY column
 * @method     ChildSysPersonQuery orderByPob($order = Criteria::ASC) Order by the POB column
 * @method     ChildSysPersonQuery orderByPhoneHome($order = Criteria::ASC) Order by the PHONE_HOME column
 * @method     ChildSysPersonQuery orderByPhoneWork($order = Criteria::ASC) Order by the PHONE_WORK column
 * @method     ChildSysPersonQuery orderByCellphone1($order = Criteria::ASC) Order by the CELLPHONE_1 column
 * @method     ChildSysPersonQuery orderByCellphone2($order = Criteria::ASC) Order by the CELLPHONE_2 column
 * @method     ChildSysPersonQuery orderByPhotoMime($order = Criteria::ASC) Order by the PHOTO_MIME column
 * @method     ChildSysPersonQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysPersonQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysPersonQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysPersonQuery groupById() Group by the ID column
 * @method     ChildSysPersonQuery groupByUserId() Group by the USER_ID column
 * @method     ChildSysPersonQuery groupByLocationId() Group by the LOCATION_ID column
 * @method     ChildSysPersonQuery groupByFirstName() Group by the FIRST_NAME column
 * @method     ChildSysPersonQuery groupByMiddleName() Group by the MIDDLE_NAME column
 * @method     ChildSysPersonQuery groupByLastName() Group by the LAST_NAME column
 * @method     ChildSysPersonQuery groupBySecondLastName() Group by the SECOND_LAST_NAME column
 * @method     ChildSysPersonQuery groupByEmail() Group by the EMAIL column
 * @method     ChildSysPersonQuery groupByIdNumber() Group by the ID_NUMBER column
 * @method     ChildSysPersonQuery groupByIdExtension() Group by the ID_EXTENSION column
 * @method     ChildSysPersonQuery groupByGender() Group by the GENDER column
 * @method     ChildSysPersonQuery groupByDateOfBirth() Group by the DATE_OF_BIRTH column
 * @method     ChildSysPersonQuery groupByPlaceOfBirth() Group by the PLACE_OF_BIRTH column
 * @method     ChildSysPersonQuery groupByAddress() Group by the ADDRESS column
 * @method     ChildSysPersonQuery groupByCity() Group by the CITY column
 * @method     ChildSysPersonQuery groupByPob() Group by the POB column
 * @method     ChildSysPersonQuery groupByPhoneHome() Group by the PHONE_HOME column
 * @method     ChildSysPersonQuery groupByPhoneWork() Group by the PHONE_WORK column
 * @method     ChildSysPersonQuery groupByCellphone1() Group by the CELLPHONE_1 column
 * @method     ChildSysPersonQuery groupByCellphone2() Group by the CELLPHONE_2 column
 * @method     ChildSysPersonQuery groupByPhotoMime() Group by the PHOTO_MIME column
 * @method     ChildSysPersonQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysPersonQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysPersonQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysPersonQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysPersonQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysPersonQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysPersonQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysPersonQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysPersonQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysPersonQuery leftJoinSysUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysUser relation
 * @method     ChildSysPersonQuery rightJoinSysUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysUser relation
 * @method     ChildSysPersonQuery innerJoinSysUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SysUser relation
 *
 * @method     ChildSysPersonQuery joinWithSysUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysUser relation
 *
 * @method     ChildSysPersonQuery leftJoinWithSysUser() Adds a LEFT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysPersonQuery rightJoinWithSysUser() Adds a RIGHT JOIN clause and with to the query using the SysUser relation
 * @method     ChildSysPersonQuery innerJoinWithSysUser() Adds a INNER JOIN clause and with to the query using the SysUser relation
 *
 * @method     ChildSysPersonQuery leftJoinJobCurriculum($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobCurriculum relation
 * @method     ChildSysPersonQuery rightJoinJobCurriculum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobCurriculum relation
 * @method     ChildSysPersonQuery innerJoinJobCurriculum($relationAlias = null) Adds a INNER JOIN clause to the query using the JobCurriculum relation
 *
 * @method     ChildSysPersonQuery joinWithJobCurriculum($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobCurriculum relation
 *
 * @method     ChildSysPersonQuery leftJoinWithJobCurriculum() Adds a LEFT JOIN clause and with to the query using the JobCurriculum relation
 * @method     ChildSysPersonQuery rightJoinWithJobCurriculum() Adds a RIGHT JOIN clause and with to the query using the JobCurriculum relation
 * @method     ChildSysPersonQuery innerJoinWithJobCurriculum() Adds a INNER JOIN clause and with to the query using the JobCurriculum relation
 *
 * @method     \SysUserQuery|\JobCurriculumQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysPerson findOne(ConnectionInterface $con = null) Return the first ChildSysPerson matching the query
 * @method     ChildSysPerson findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysPerson matching the query, or a new ChildSysPerson object populated from the query conditions when no match is found
 *
 * @method     ChildSysPerson findOneById(int $ID) Return the first ChildSysPerson filtered by the ID column
 * @method     ChildSysPerson findOneByUserId(int $USER_ID) Return the first ChildSysPerson filtered by the USER_ID column
 * @method     ChildSysPerson findOneByLocationId(int $LOCATION_ID) Return the first ChildSysPerson filtered by the LOCATION_ID column
 * @method     ChildSysPerson findOneByFirstName(string $FIRST_NAME) Return the first ChildSysPerson filtered by the FIRST_NAME column
 * @method     ChildSysPerson findOneByMiddleName(string $MIDDLE_NAME) Return the first ChildSysPerson filtered by the MIDDLE_NAME column
 * @method     ChildSysPerson findOneByLastName(string $LAST_NAME) Return the first ChildSysPerson filtered by the LAST_NAME column
 * @method     ChildSysPerson findOneBySecondLastName(string $SECOND_LAST_NAME) Return the first ChildSysPerson filtered by the SECOND_LAST_NAME column
 * @method     ChildSysPerson findOneByEmail(string $EMAIL) Return the first ChildSysPerson filtered by the EMAIL column
 * @method     ChildSysPerson findOneByIdNumber(string $ID_NUMBER) Return the first ChildSysPerson filtered by the ID_NUMBER column
 * @method     ChildSysPerson findOneByIdExtension(string $ID_EXTENSION) Return the first ChildSysPerson filtered by the ID_EXTENSION column
 * @method     ChildSysPerson findOneByGender(string $GENDER) Return the first ChildSysPerson filtered by the GENDER column
 * @method     ChildSysPerson findOneByDateOfBirth(string $DATE_OF_BIRTH) Return the first ChildSysPerson filtered by the DATE_OF_BIRTH column
 * @method     ChildSysPerson findOneByPlaceOfBirth(string $PLACE_OF_BIRTH) Return the first ChildSysPerson filtered by the PLACE_OF_BIRTH column
 * @method     ChildSysPerson findOneByAddress(string $ADDRESS) Return the first ChildSysPerson filtered by the ADDRESS column
 * @method     ChildSysPerson findOneByCity(string $CITY) Return the first ChildSysPerson filtered by the CITY column
 * @method     ChildSysPerson findOneByPob(string $POB) Return the first ChildSysPerson filtered by the POB column
 * @method     ChildSysPerson findOneByPhoneHome(string $PHONE_HOME) Return the first ChildSysPerson filtered by the PHONE_HOME column
 * @method     ChildSysPerson findOneByPhoneWork(string $PHONE_WORK) Return the first ChildSysPerson filtered by the PHONE_WORK column
 * @method     ChildSysPerson findOneByCellphone1(string $CELLPHONE_1) Return the first ChildSysPerson filtered by the CELLPHONE_1 column
 * @method     ChildSysPerson findOneByCellphone2(string $CELLPHONE_2) Return the first ChildSysPerson filtered by the CELLPHONE_2 column
 * @method     ChildSysPerson findOneByPhotoMime(string $PHOTO_MIME) Return the first ChildSysPerson filtered by the PHOTO_MIME column
 * @method     ChildSysPerson findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysPerson filtered by the LAST_USER_ID column
 * @method     ChildSysPerson findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysPerson filtered by the CREATION_DATE column
 * @method     ChildSysPerson findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysPerson filtered by the MODIFICATION_DATE column *

 * @method     ChildSysPerson requirePk($key, ConnectionInterface $con = null) Return the ChildSysPerson by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOne(ConnectionInterface $con = null) Return the first ChildSysPerson matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysPerson requireOneById(int $ID) Return the first ChildSysPerson filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByUserId(int $USER_ID) Return the first ChildSysPerson filtered by the USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByLocationId(int $LOCATION_ID) Return the first ChildSysPerson filtered by the LOCATION_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByFirstName(string $FIRST_NAME) Return the first ChildSysPerson filtered by the FIRST_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByMiddleName(string $MIDDLE_NAME) Return the first ChildSysPerson filtered by the MIDDLE_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByLastName(string $LAST_NAME) Return the first ChildSysPerson filtered by the LAST_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneBySecondLastName(string $SECOND_LAST_NAME) Return the first ChildSysPerson filtered by the SECOND_LAST_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByEmail(string $EMAIL) Return the first ChildSysPerson filtered by the EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByIdNumber(string $ID_NUMBER) Return the first ChildSysPerson filtered by the ID_NUMBER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByIdExtension(string $ID_EXTENSION) Return the first ChildSysPerson filtered by the ID_EXTENSION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByGender(string $GENDER) Return the first ChildSysPerson filtered by the GENDER column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByDateOfBirth(string $DATE_OF_BIRTH) Return the first ChildSysPerson filtered by the DATE_OF_BIRTH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByPlaceOfBirth(string $PLACE_OF_BIRTH) Return the first ChildSysPerson filtered by the PLACE_OF_BIRTH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByAddress(string $ADDRESS) Return the first ChildSysPerson filtered by the ADDRESS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByCity(string $CITY) Return the first ChildSysPerson filtered by the CITY column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByPob(string $POB) Return the first ChildSysPerson filtered by the POB column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByPhoneHome(string $PHONE_HOME) Return the first ChildSysPerson filtered by the PHONE_HOME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByPhoneWork(string $PHONE_WORK) Return the first ChildSysPerson filtered by the PHONE_WORK column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByCellphone1(string $CELLPHONE_1) Return the first ChildSysPerson filtered by the CELLPHONE_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByCellphone2(string $CELLPHONE_2) Return the first ChildSysPerson filtered by the CELLPHONE_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByPhotoMime(string $PHOTO_MIME) Return the first ChildSysPerson filtered by the PHOTO_MIME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysPerson filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysPerson filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysPerson filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysPerson[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysPerson objects based on current ModelCriteria
 * @method     ChildSysPerson[]|ObjectCollection findById(int $ID) Return ChildSysPerson objects filtered by the ID column
 * @method     ChildSysPerson[]|ObjectCollection findByUserId(int $USER_ID) Return ChildSysPerson objects filtered by the USER_ID column
 * @method     ChildSysPerson[]|ObjectCollection findByLocationId(int $LOCATION_ID) Return ChildSysPerson objects filtered by the LOCATION_ID column
 * @method     ChildSysPerson[]|ObjectCollection findByFirstName(string $FIRST_NAME) Return ChildSysPerson objects filtered by the FIRST_NAME column
 * @method     ChildSysPerson[]|ObjectCollection findByMiddleName(string $MIDDLE_NAME) Return ChildSysPerson objects filtered by the MIDDLE_NAME column
 * @method     ChildSysPerson[]|ObjectCollection findByLastName(string $LAST_NAME) Return ChildSysPerson objects filtered by the LAST_NAME column
 * @method     ChildSysPerson[]|ObjectCollection findBySecondLastName(string $SECOND_LAST_NAME) Return ChildSysPerson objects filtered by the SECOND_LAST_NAME column
 * @method     ChildSysPerson[]|ObjectCollection findByEmail(string $EMAIL) Return ChildSysPerson objects filtered by the EMAIL column
 * @method     ChildSysPerson[]|ObjectCollection findByIdNumber(string $ID_NUMBER) Return ChildSysPerson objects filtered by the ID_NUMBER column
 * @method     ChildSysPerson[]|ObjectCollection findByIdExtension(string $ID_EXTENSION) Return ChildSysPerson objects filtered by the ID_EXTENSION column
 * @method     ChildSysPerson[]|ObjectCollection findByGender(string $GENDER) Return ChildSysPerson objects filtered by the GENDER column
 * @method     ChildSysPerson[]|ObjectCollection findByDateOfBirth(string $DATE_OF_BIRTH) Return ChildSysPerson objects filtered by the DATE_OF_BIRTH column
 * @method     ChildSysPerson[]|ObjectCollection findByPlaceOfBirth(string $PLACE_OF_BIRTH) Return ChildSysPerson objects filtered by the PLACE_OF_BIRTH column
 * @method     ChildSysPerson[]|ObjectCollection findByAddress(string $ADDRESS) Return ChildSysPerson objects filtered by the ADDRESS column
 * @method     ChildSysPerson[]|ObjectCollection findByCity(string $CITY) Return ChildSysPerson objects filtered by the CITY column
 * @method     ChildSysPerson[]|ObjectCollection findByPob(string $POB) Return ChildSysPerson objects filtered by the POB column
 * @method     ChildSysPerson[]|ObjectCollection findByPhoneHome(string $PHONE_HOME) Return ChildSysPerson objects filtered by the PHONE_HOME column
 * @method     ChildSysPerson[]|ObjectCollection findByPhoneWork(string $PHONE_WORK) Return ChildSysPerson objects filtered by the PHONE_WORK column
 * @method     ChildSysPerson[]|ObjectCollection findByCellphone1(string $CELLPHONE_1) Return ChildSysPerson objects filtered by the CELLPHONE_1 column
 * @method     ChildSysPerson[]|ObjectCollection findByCellphone2(string $CELLPHONE_2) Return ChildSysPerson objects filtered by the CELLPHONE_2 column
 * @method     ChildSysPerson[]|ObjectCollection findByPhotoMime(string $PHOTO_MIME) Return ChildSysPerson objects filtered by the PHOTO_MIME column
 * @method     ChildSysPerson[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildSysPerson objects filtered by the LAST_USER_ID column
 * @method     ChildSysPerson[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildSysPerson objects filtered by the CREATION_DATE column
 * @method     ChildSysPerson[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildSysPerson objects filtered by the MODIFICATION_DATE column
 * @method     ChildSysPerson[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysPersonQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysPersonQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysPerson', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysPersonQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysPersonQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysPersonQuery) {
            return $criteria;
        }
        $query = new ChildSysPersonQuery();
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
     * @return ChildSysPerson|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SysPersonTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysPersonTableMap::DATABASE_NAME);
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
     * @return ChildSysPerson A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, USER_ID, LOCATION_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SECOND_LAST_NAME, EMAIL, ID_NUMBER, ID_EXTENSION, GENDER, DATE_OF_BIRTH, PLACE_OF_BIRTH, ADDRESS, CITY, POB, PHONE_HOME, PHONE_WORK, CELLPHONE_1, CELLPHONE_2, PHOTO_MIME, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_person WHERE ID = :p0';
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
            /** @var ChildSysPerson $obj */
            $obj = new ChildSysPerson();
            $obj->hydrate($row);
            SysPersonTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysPerson|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysPersonTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysPersonTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_USER_ID, $userId, $comparison);
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
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the FIRST_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE FIRST_NAME = 'fooValue'
     * $query->filterByFirstName('%fooValue%'); // WHERE FIRST_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the MIDDLE_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByMiddleName('fooValue');   // WHERE MIDDLE_NAME = 'fooValue'
     * $query->filterByMiddleName('%fooValue%'); // WHERE MIDDLE_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $middleName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByMiddleName($middleName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($middleName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $middleName)) {
                $middleName = str_replace('*', '%', $middleName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_MIDDLE_NAME, $middleName, $comparison);
    }

    /**
     * Filter the query on the LAST_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE LAST_NAME = 'fooValue'
     * $query->filterByLastName('%fooValue%'); // WHERE LAST_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastName)) {
                $lastName = str_replace('*', '%', $lastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the SECOND_LAST_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondLastName('fooValue');   // WHERE SECOND_LAST_NAME = 'fooValue'
     * $query->filterBySecondLastName('%fooValue%'); // WHERE SECOND_LAST_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $secondLastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterBySecondLastName($secondLastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secondLastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $secondLastName)) {
                $secondLastName = str_replace('*', '%', $secondLastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_SECOND_LAST_NAME, $secondLastName, $comparison);
    }

    /**
     * Filter the query on the EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE EMAIL = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SysPersonTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the ID_NUMBER column
     *
     * Example usage:
     * <code>
     * $query->filterByIdNumber('fooValue');   // WHERE ID_NUMBER = 'fooValue'
     * $query->filterByIdNumber('%fooValue%'); // WHERE ID_NUMBER LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByIdNumber($idNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $idNumber)) {
                $idNumber = str_replace('*', '%', $idNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_ID_NUMBER, $idNumber, $comparison);
    }

    /**
     * Filter the query on the ID_EXTENSION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdExtension('fooValue');   // WHERE ID_EXTENSION = 'fooValue'
     * $query->filterByIdExtension('%fooValue%'); // WHERE ID_EXTENSION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idExtension The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByIdExtension($idExtension = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idExtension)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $idExtension)) {
                $idExtension = str_replace('*', '%', $idExtension);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_ID_EXTENSION, $idExtension, $comparison);
    }

    /**
     * Filter the query on the GENDER column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE GENDER = 'fooValue'
     * $query->filterByGender('%fooValue%'); // WHERE GENDER LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gender)) {
                $gender = str_replace('*', '%', $gender);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the DATE_OF_BIRTH column
     *
     * Example usage:
     * <code>
     * $query->filterByDateOfBirth('2011-03-14'); // WHERE DATE_OF_BIRTH = '2011-03-14'
     * $query->filterByDateOfBirth('now'); // WHERE DATE_OF_BIRTH = '2011-03-14'
     * $query->filterByDateOfBirth(array('max' => 'yesterday')); // WHERE DATE_OF_BIRTH > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateOfBirth The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByDateOfBirth($dateOfBirth = null, $comparison = null)
    {
        if (is_array($dateOfBirth)) {
            $useMinMax = false;
            if (isset($dateOfBirth['min'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_DATE_OF_BIRTH, $dateOfBirth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateOfBirth['max'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_DATE_OF_BIRTH, $dateOfBirth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_DATE_OF_BIRTH, $dateOfBirth, $comparison);
    }

    /**
     * Filter the query on the PLACE_OF_BIRTH column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceOfBirth('fooValue');   // WHERE PLACE_OF_BIRTH = 'fooValue'
     * $query->filterByPlaceOfBirth('%fooValue%'); // WHERE PLACE_OF_BIRTH LIKE '%fooValue%'
     * </code>
     *
     * @param     string $placeOfBirth The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByPlaceOfBirth($placeOfBirth = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($placeOfBirth)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $placeOfBirth)) {
                $placeOfBirth = str_replace('*', '%', $placeOfBirth);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_PLACE_OF_BIRTH, $placeOfBirth, $comparison);
    }

    /**
     * Filter the query on the ADDRESS column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE ADDRESS = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE ADDRESS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the CITY column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE CITY = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE CITY LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query on the POB column
     *
     * Example usage:
     * <code>
     * $query->filterByPob('fooValue');   // WHERE POB = 'fooValue'
     * $query->filterByPob('%fooValue%'); // WHERE POB LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pob The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByPob($pob = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pob)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pob)) {
                $pob = str_replace('*', '%', $pob);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_POB, $pob, $comparison);
    }

    /**
     * Filter the query on the PHONE_HOME column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneHome('fooValue');   // WHERE PHONE_HOME = 'fooValue'
     * $query->filterByPhoneHome('%fooValue%'); // WHERE PHONE_HOME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneHome The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByPhoneHome($phoneHome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneHome)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phoneHome)) {
                $phoneHome = str_replace('*', '%', $phoneHome);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_PHONE_HOME, $phoneHome, $comparison);
    }

    /**
     * Filter the query on the PHONE_WORK column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneWork('fooValue');   // WHERE PHONE_WORK = 'fooValue'
     * $query->filterByPhoneWork('%fooValue%'); // WHERE PHONE_WORK LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneWork The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByPhoneWork($phoneWork = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneWork)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phoneWork)) {
                $phoneWork = str_replace('*', '%', $phoneWork);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_PHONE_WORK, $phoneWork, $comparison);
    }

    /**
     * Filter the query on the CELLPHONE_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCellphone1('fooValue');   // WHERE CELLPHONE_1 = 'fooValue'
     * $query->filterByCellphone1('%fooValue%'); // WHERE CELLPHONE_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cellphone1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByCellphone1($cellphone1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cellphone1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cellphone1)) {
                $cellphone1 = str_replace('*', '%', $cellphone1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_CELLPHONE_1, $cellphone1, $comparison);
    }

    /**
     * Filter the query on the CELLPHONE_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCellphone2('fooValue');   // WHERE CELLPHONE_2 = 'fooValue'
     * $query->filterByCellphone2('%fooValue%'); // WHERE CELLPHONE_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cellphone2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByCellphone2($cellphone2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cellphone2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cellphone2)) {
                $cellphone2 = str_replace('*', '%', $cellphone2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_CELLPHONE_2, $cellphone2, $comparison);
    }

    /**
     * Filter the query on the PHOTO_MIME column
     *
     * Example usage:
     * <code>
     * $query->filterByPhotoMime('fooValue');   // WHERE PHOTO_MIME = 'fooValue'
     * $query->filterByPhotoMime('%fooValue%'); // WHERE PHOTO_MIME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $photoMime The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByPhotoMime($photoMime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($photoMime)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $photoMime)) {
                $photoMime = str_replace('*', '%', $photoMime);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_PHOTO_MIME, $photoMime, $comparison);
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
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysPersonTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysPersonTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \SysUser object
     *
     * @param \SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, $comparison = null)
    {
        if ($sysUser instanceof \SysUser) {
            return $this
                ->addUsingAlias(SysPersonTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SysPersonTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
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
     * Filter the query by a related \JobCurriculum object
     *
     * @param \JobCurriculum|ObjectCollection $jobCurriculum the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysPersonQuery The current query, for fluid interface
     */
    public function filterByJobCurriculum($jobCurriculum, $comparison = null)
    {
        if ($jobCurriculum instanceof \JobCurriculum) {
            return $this
                ->addUsingAlias(SysPersonTableMap::COL_ID, $jobCurriculum->getIdPersona(), $comparison);
        } elseif ($jobCurriculum instanceof ObjectCollection) {
            return $this
                ->useJobCurriculumQuery()
                ->filterByPrimaryKeys($jobCurriculum->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJobCurriculum() only accepts arguments of type \JobCurriculum or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobCurriculum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function joinJobCurriculum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobCurriculum');

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
            $this->addJoinObject($join, 'JobCurriculum');
        }

        return $this;
    }

    /**
     * Use the JobCurriculum relation JobCurriculum object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobCurriculumQuery A secondary query class using the current class as primary query
     */
    public function useJobCurriculumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobCurriculum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobCurriculum', '\JobCurriculumQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysPerson $sysPerson Object to remove from the list of results
     *
     * @return $this|ChildSysPersonQuery The current query, for fluid interface
     */
    public function prune($sysPerson = null)
    {
        if ($sysPerson) {
            $this->addUsingAlias(SysPersonTableMap::COL_ID, $sysPerson->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_person table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysPersonTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysPersonTableMap::clearInstancePool();
            SysPersonTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysPersonTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysPersonTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysPersonTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysPersonTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysPersonQuery
