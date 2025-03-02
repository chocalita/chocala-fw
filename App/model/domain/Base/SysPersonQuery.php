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
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `sys_person` table.
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
 * @method     \SysUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysPerson|null findOne(?ConnectionInterface $con = null) Return the first ChildSysPerson matching the query
 * @method     ChildSysPerson findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSysPerson matching the query, or a new ChildSysPerson object populated from the query conditions when no match is found
 *
 * @method     ChildSysPerson|null findOneById(int $ID) Return the first ChildSysPerson filtered by the ID column
 * @method     ChildSysPerson|null findOneByUserId(int $USER_ID) Return the first ChildSysPerson filtered by the USER_ID column
 * @method     ChildSysPerson|null findOneByLocationId(int $LOCATION_ID) Return the first ChildSysPerson filtered by the LOCATION_ID column
 * @method     ChildSysPerson|null findOneByFirstName(string $FIRST_NAME) Return the first ChildSysPerson filtered by the FIRST_NAME column
 * @method     ChildSysPerson|null findOneByMiddleName(string $MIDDLE_NAME) Return the first ChildSysPerson filtered by the MIDDLE_NAME column
 * @method     ChildSysPerson|null findOneByLastName(string $LAST_NAME) Return the first ChildSysPerson filtered by the LAST_NAME column
 * @method     ChildSysPerson|null findOneBySecondLastName(string $SECOND_LAST_NAME) Return the first ChildSysPerson filtered by the SECOND_LAST_NAME column
 * @method     ChildSysPerson|null findOneByEmail(string $EMAIL) Return the first ChildSysPerson filtered by the EMAIL column
 * @method     ChildSysPerson|null findOneByIdNumber(string $ID_NUMBER) Return the first ChildSysPerson filtered by the ID_NUMBER column
 * @method     ChildSysPerson|null findOneByIdExtension(string $ID_EXTENSION) Return the first ChildSysPerson filtered by the ID_EXTENSION column
 * @method     ChildSysPerson|null findOneByGender(string $GENDER) Return the first ChildSysPerson filtered by the GENDER column
 * @method     ChildSysPerson|null findOneByDateOfBirth(string $DATE_OF_BIRTH) Return the first ChildSysPerson filtered by the DATE_OF_BIRTH column
 * @method     ChildSysPerson|null findOneByPlaceOfBirth(string $PLACE_OF_BIRTH) Return the first ChildSysPerson filtered by the PLACE_OF_BIRTH column
 * @method     ChildSysPerson|null findOneByAddress(string $ADDRESS) Return the first ChildSysPerson filtered by the ADDRESS column
 * @method     ChildSysPerson|null findOneByCity(string $CITY) Return the first ChildSysPerson filtered by the CITY column
 * @method     ChildSysPerson|null findOneByPob(string $POB) Return the first ChildSysPerson filtered by the POB column
 * @method     ChildSysPerson|null findOneByPhoneHome(string $PHONE_HOME) Return the first ChildSysPerson filtered by the PHONE_HOME column
 * @method     ChildSysPerson|null findOneByPhoneWork(string $PHONE_WORK) Return the first ChildSysPerson filtered by the PHONE_WORK column
 * @method     ChildSysPerson|null findOneByCellphone1(string $CELLPHONE_1) Return the first ChildSysPerson filtered by the CELLPHONE_1 column
 * @method     ChildSysPerson|null findOneByCellphone2(string $CELLPHONE_2) Return the first ChildSysPerson filtered by the CELLPHONE_2 column
 * @method     ChildSysPerson|null findOneByPhotoMime(string $PHOTO_MIME) Return the first ChildSysPerson filtered by the PHOTO_MIME column
 * @method     ChildSysPerson|null findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysPerson filtered by the LAST_USER_ID column
 * @method     ChildSysPerson|null findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysPerson filtered by the CREATION_DATE column
 * @method     ChildSysPerson|null findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysPerson filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysPerson requirePk($key, ?ConnectionInterface $con = null) Return the ChildSysPerson by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysPerson requireOne(?ConnectionInterface $con = null) Return the first ChildSysPerson matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
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
 * @method     ChildSysPerson[]|Collection find(?ConnectionInterface $con = null) Return ChildSysPerson objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSysPerson> find(?ConnectionInterface $con = null) Return ChildSysPerson objects based on current ModelCriteria
 *
 * @method     ChildSysPerson[]|Collection findById(int|array<int> $ID) Return ChildSysPerson objects filtered by the ID column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findById(int|array<int> $ID) Return ChildSysPerson objects filtered by the ID column
 * @method     ChildSysPerson[]|Collection findByUserId(int|array<int> $USER_ID) Return ChildSysPerson objects filtered by the USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByUserId(int|array<int> $USER_ID) Return ChildSysPerson objects filtered by the USER_ID column
 * @method     ChildSysPerson[]|Collection findByLocationId(int|array<int> $LOCATION_ID) Return ChildSysPerson objects filtered by the LOCATION_ID column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByLocationId(int|array<int> $LOCATION_ID) Return ChildSysPerson objects filtered by the LOCATION_ID column
 * @method     ChildSysPerson[]|Collection findByFirstName(string|array<string> $FIRST_NAME) Return ChildSysPerson objects filtered by the FIRST_NAME column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByFirstName(string|array<string> $FIRST_NAME) Return ChildSysPerson objects filtered by the FIRST_NAME column
 * @method     ChildSysPerson[]|Collection findByMiddleName(string|array<string> $MIDDLE_NAME) Return ChildSysPerson objects filtered by the MIDDLE_NAME column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByMiddleName(string|array<string> $MIDDLE_NAME) Return ChildSysPerson objects filtered by the MIDDLE_NAME column
 * @method     ChildSysPerson[]|Collection findByLastName(string|array<string> $LAST_NAME) Return ChildSysPerson objects filtered by the LAST_NAME column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByLastName(string|array<string> $LAST_NAME) Return ChildSysPerson objects filtered by the LAST_NAME column
 * @method     ChildSysPerson[]|Collection findBySecondLastName(string|array<string> $SECOND_LAST_NAME) Return ChildSysPerson objects filtered by the SECOND_LAST_NAME column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findBySecondLastName(string|array<string> $SECOND_LAST_NAME) Return ChildSysPerson objects filtered by the SECOND_LAST_NAME column
 * @method     ChildSysPerson[]|Collection findByEmail(string|array<string> $EMAIL) Return ChildSysPerson objects filtered by the EMAIL column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByEmail(string|array<string> $EMAIL) Return ChildSysPerson objects filtered by the EMAIL column
 * @method     ChildSysPerson[]|Collection findByIdNumber(string|array<string> $ID_NUMBER) Return ChildSysPerson objects filtered by the ID_NUMBER column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByIdNumber(string|array<string> $ID_NUMBER) Return ChildSysPerson objects filtered by the ID_NUMBER column
 * @method     ChildSysPerson[]|Collection findByIdExtension(string|array<string> $ID_EXTENSION) Return ChildSysPerson objects filtered by the ID_EXTENSION column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByIdExtension(string|array<string> $ID_EXTENSION) Return ChildSysPerson objects filtered by the ID_EXTENSION column
 * @method     ChildSysPerson[]|Collection findByGender(string|array<string> $GENDER) Return ChildSysPerson objects filtered by the GENDER column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByGender(string|array<string> $GENDER) Return ChildSysPerson objects filtered by the GENDER column
 * @method     ChildSysPerson[]|Collection findByDateOfBirth(string|array<string> $DATE_OF_BIRTH) Return ChildSysPerson objects filtered by the DATE_OF_BIRTH column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByDateOfBirth(string|array<string> $DATE_OF_BIRTH) Return ChildSysPerson objects filtered by the DATE_OF_BIRTH column
 * @method     ChildSysPerson[]|Collection findByPlaceOfBirth(string|array<string> $PLACE_OF_BIRTH) Return ChildSysPerson objects filtered by the PLACE_OF_BIRTH column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByPlaceOfBirth(string|array<string> $PLACE_OF_BIRTH) Return ChildSysPerson objects filtered by the PLACE_OF_BIRTH column
 * @method     ChildSysPerson[]|Collection findByAddress(string|array<string> $ADDRESS) Return ChildSysPerson objects filtered by the ADDRESS column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByAddress(string|array<string> $ADDRESS) Return ChildSysPerson objects filtered by the ADDRESS column
 * @method     ChildSysPerson[]|Collection findByCity(string|array<string> $CITY) Return ChildSysPerson objects filtered by the CITY column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByCity(string|array<string> $CITY) Return ChildSysPerson objects filtered by the CITY column
 * @method     ChildSysPerson[]|Collection findByPob(string|array<string> $POB) Return ChildSysPerson objects filtered by the POB column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByPob(string|array<string> $POB) Return ChildSysPerson objects filtered by the POB column
 * @method     ChildSysPerson[]|Collection findByPhoneHome(string|array<string> $PHONE_HOME) Return ChildSysPerson objects filtered by the PHONE_HOME column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByPhoneHome(string|array<string> $PHONE_HOME) Return ChildSysPerson objects filtered by the PHONE_HOME column
 * @method     ChildSysPerson[]|Collection findByPhoneWork(string|array<string> $PHONE_WORK) Return ChildSysPerson objects filtered by the PHONE_WORK column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByPhoneWork(string|array<string> $PHONE_WORK) Return ChildSysPerson objects filtered by the PHONE_WORK column
 * @method     ChildSysPerson[]|Collection findByCellphone1(string|array<string> $CELLPHONE_1) Return ChildSysPerson objects filtered by the CELLPHONE_1 column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByCellphone1(string|array<string> $CELLPHONE_1) Return ChildSysPerson objects filtered by the CELLPHONE_1 column
 * @method     ChildSysPerson[]|Collection findByCellphone2(string|array<string> $CELLPHONE_2) Return ChildSysPerson objects filtered by the CELLPHONE_2 column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByCellphone2(string|array<string> $CELLPHONE_2) Return ChildSysPerson objects filtered by the CELLPHONE_2 column
 * @method     ChildSysPerson[]|Collection findByPhotoMime(string|array<string> $PHOTO_MIME) Return ChildSysPerson objects filtered by the PHOTO_MIME column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByPhotoMime(string|array<string> $PHOTO_MIME) Return ChildSysPerson objects filtered by the PHOTO_MIME column
 * @method     ChildSysPerson[]|Collection findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysPerson objects filtered by the LAST_USER_ID column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByLastUserId(int|array<int> $LAST_USER_ID) Return ChildSysPerson objects filtered by the LAST_USER_ID column
 * @method     ChildSysPerson[]|Collection findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysPerson objects filtered by the CREATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByCreationDate(string|array<string> $CREATION_DATE) Return ChildSysPerson objects filtered by the CREATION_DATE column
 * @method     ChildSysPerson[]|Collection findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysPerson objects filtered by the MODIFICATION_DATE column
 * @psalm-method Collection&\Traversable<ChildSysPerson> findByModificationDate(string|array<string> $MODIFICATION_DATE) Return ChildSysPerson objects filtered by the MODIFICATION_DATE column
 *
 * @method     ChildSysPerson[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSysPerson> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SysPersonQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysPersonQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysPerson', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysPersonQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysPersonQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
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
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysPersonTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysPersonTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
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

        $this->addUsingAlias(SysPersonTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SysPersonTableMap::COL_ID, $keys, Criteria::IN);

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

        $this->addUsingAlias(SysPersonTableMap::COL_ID, $id, $comparison);

        return $this;
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
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysPersonTableMap::COL_USER_ID, $userId, $comparison);

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

        $this->addUsingAlias(SysPersonTableMap::COL_LOCATION_ID, $locationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the FIRST_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE FIRST_NAME = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE FIRST_NAME LIKE '%fooValue%'
     * $query->filterByFirstName(['foo', 'bar']); // WHERE FIRST_NAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $firstName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_FIRST_NAME, $firstName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the MIDDLE_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByMiddleName('fooValue');   // WHERE MIDDLE_NAME = 'fooValue'
     * $query->filterByMiddleName('%fooValue%', Criteria::LIKE); // WHERE MIDDLE_NAME LIKE '%fooValue%'
     * $query->filterByMiddleName(['foo', 'bar']); // WHERE MIDDLE_NAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $middleName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMiddleName($middleName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($middleName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_MIDDLE_NAME, $middleName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the LAST_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE LAST_NAME = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE LAST_NAME LIKE '%fooValue%'
     * $query->filterByLastName(['foo', 'bar']); // WHERE LAST_NAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lastName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the SECOND_LAST_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondLastName('fooValue');   // WHERE SECOND_LAST_NAME = 'fooValue'
     * $query->filterBySecondLastName('%fooValue%', Criteria::LIKE); // WHERE SECOND_LAST_NAME LIKE '%fooValue%'
     * $query->filterBySecondLastName(['foo', 'bar']); // WHERE SECOND_LAST_NAME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $secondLastName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySecondLastName($secondLastName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secondLastName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_SECOND_LAST_NAME, $secondLastName, $comparison);

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

        $this->addUsingAlias(SysPersonTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ID_NUMBER column
     *
     * Example usage:
     * <code>
     * $query->filterByIdNumber('fooValue');   // WHERE ID_NUMBER = 'fooValue'
     * $query->filterByIdNumber('%fooValue%', Criteria::LIKE); // WHERE ID_NUMBER LIKE '%fooValue%'
     * $query->filterByIdNumber(['foo', 'bar']); // WHERE ID_NUMBER IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $idNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdNumber($idNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_ID_NUMBER, $idNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ID_EXTENSION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdExtension('fooValue');   // WHERE ID_EXTENSION = 'fooValue'
     * $query->filterByIdExtension('%fooValue%', Criteria::LIKE); // WHERE ID_EXTENSION LIKE '%fooValue%'
     * $query->filterByIdExtension(['foo', 'bar']); // WHERE ID_EXTENSION IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $idExtension The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdExtension($idExtension = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idExtension)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_ID_EXTENSION, $idExtension, $comparison);

        return $this;
    }

    /**
     * Filter the query on the GENDER column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE GENDER = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE GENDER LIKE '%fooValue%'
     * $query->filterByGender(['foo', 'bar']); // WHERE GENDER IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $gender The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGender($gender = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_GENDER, $gender, $comparison);

        return $this;
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
     * @param mixed $dateOfBirth The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDateOfBirth($dateOfBirth = null, ?string $comparison = null)
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

        $this->addUsingAlias(SysPersonTableMap::COL_DATE_OF_BIRTH, $dateOfBirth, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PLACE_OF_BIRTH column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceOfBirth('fooValue');   // WHERE PLACE_OF_BIRTH = 'fooValue'
     * $query->filterByPlaceOfBirth('%fooValue%', Criteria::LIKE); // WHERE PLACE_OF_BIRTH LIKE '%fooValue%'
     * $query->filterByPlaceOfBirth(['foo', 'bar']); // WHERE PLACE_OF_BIRTH IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $placeOfBirth The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaceOfBirth($placeOfBirth = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($placeOfBirth)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_PLACE_OF_BIRTH, $placeOfBirth, $comparison);

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

        $this->addUsingAlias(SysPersonTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the CITY column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE CITY = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE CITY LIKE '%fooValue%'
     * $query->filterByCity(['foo', 'bar']); // WHERE CITY IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $city The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity($city = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_CITY, $city, $comparison);

        return $this;
    }

    /**
     * Filter the query on the POB column
     *
     * Example usage:
     * <code>
     * $query->filterByPob('fooValue');   // WHERE POB = 'fooValue'
     * $query->filterByPob('%fooValue%', Criteria::LIKE); // WHERE POB LIKE '%fooValue%'
     * $query->filterByPob(['foo', 'bar']); // WHERE POB IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pob The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPob($pob = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pob)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_POB, $pob, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PHONE_HOME column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneHome('fooValue');   // WHERE PHONE_HOME = 'fooValue'
     * $query->filterByPhoneHome('%fooValue%', Criteria::LIKE); // WHERE PHONE_HOME LIKE '%fooValue%'
     * $query->filterByPhoneHome(['foo', 'bar']); // WHERE PHONE_HOME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phoneHome The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhoneHome($phoneHome = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneHome)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_PHONE_HOME, $phoneHome, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PHONE_WORK column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneWork('fooValue');   // WHERE PHONE_WORK = 'fooValue'
     * $query->filterByPhoneWork('%fooValue%', Criteria::LIKE); // WHERE PHONE_WORK LIKE '%fooValue%'
     * $query->filterByPhoneWork(['foo', 'bar']); // WHERE PHONE_WORK IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phoneWork The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhoneWork($phoneWork = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneWork)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_PHONE_WORK, $phoneWork, $comparison);

        return $this;
    }

    /**
     * Filter the query on the CELLPHONE_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCellphone1('fooValue');   // WHERE CELLPHONE_1 = 'fooValue'
     * $query->filterByCellphone1('%fooValue%', Criteria::LIKE); // WHERE CELLPHONE_1 LIKE '%fooValue%'
     * $query->filterByCellphone1(['foo', 'bar']); // WHERE CELLPHONE_1 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cellphone1 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCellphone1($cellphone1 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cellphone1)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_CELLPHONE_1, $cellphone1, $comparison);

        return $this;
    }

    /**
     * Filter the query on the CELLPHONE_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCellphone2('fooValue');   // WHERE CELLPHONE_2 = 'fooValue'
     * $query->filterByCellphone2('%fooValue%', Criteria::LIKE); // WHERE CELLPHONE_2 LIKE '%fooValue%'
     * $query->filterByCellphone2(['foo', 'bar']); // WHERE CELLPHONE_2 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cellphone2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCellphone2($cellphone2 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cellphone2)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_CELLPHONE_2, $cellphone2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the PHOTO_MIME column
     *
     * Example usage:
     * <code>
     * $query->filterByPhotoMime('fooValue');   // WHERE PHOTO_MIME = 'fooValue'
     * $query->filterByPhotoMime('%fooValue%', Criteria::LIKE); // WHERE PHOTO_MIME LIKE '%fooValue%'
     * $query->filterByPhotoMime(['foo', 'bar']); // WHERE PHOTO_MIME IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $photoMime The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhotoMime($photoMime = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($photoMime)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SysPersonTableMap::COL_PHOTO_MIME, $photoMime, $comparison);

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

        $this->addUsingAlias(SysPersonTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);

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

        $this->addUsingAlias(SysPersonTableMap::COL_CREATION_DATE, $creationDate, $comparison);

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

        $this->addUsingAlias(SysPersonTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \SysUser object
     *
     * @param \SysUser|ObjectCollection $sysUser The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysUser($sysUser, ?string $comparison = null)
    {
        if ($sysUser instanceof \SysUser) {
            return $this
                ->addUsingAlias(SysPersonTableMap::COL_USER_ID, $sysUser->getId(), $comparison);
        } elseif ($sysUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SysPersonTableMap::COL_USER_ID, $sysUser->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySysUser() only accepts arguments of type \SysUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SysUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSysUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
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
     * Use the SysUser relation SysUser object
     *
     * @param callable(\SysUserQuery):\SysUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSysUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSysUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SysUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \SysUserQuery The inner query object of the EXISTS statement
     */
    public function useSysUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \SysUserQuery */
        $q = $this->useExistsQuery('SysUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SysUser table for a NOT EXISTS query.
     *
     * @see useSysUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \SysUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSysUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserQuery */
        $q = $this->useExistsQuery('SysUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SysUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \SysUserQuery The inner query object of the IN statement
     */
    public function useInSysUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \SysUserQuery */
        $q = $this->useInQuery('SysUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SysUser table for a NOT IN query.
     *
     * @see useSysUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \SysUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSysUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \SysUserQuery */
        $q = $this->useInQuery('SysUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSysPerson $sysPerson Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
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
    public function doDeleteAll(?ConnectionInterface $con = null): int
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
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
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

}
