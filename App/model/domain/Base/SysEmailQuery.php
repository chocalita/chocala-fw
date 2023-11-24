<?php

namespace App\model\domain\Base;

use \Exception;
use \PDO;
use App\model\domain\SysEmail as ChildSysEmail;
use App\model\domain\SysEmailQuery as ChildSysEmailQuery;
use App\model\domain\Map\SysEmailTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_email' table.
 *
 *
 *
 * @method     ChildSysEmailQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildSysEmailQuery orderByCode($order = Criteria::ASC) Order by the CODE column
 * @method     ChildSysEmailQuery orderByName($order = Criteria::ASC) Order by the NAME column
 * @method     ChildSysEmailQuery orderByDescription($order = Criteria::ASC) Order by the DESCRIPTION column
 * @method     ChildSysEmailQuery orderByFromEmail($order = Criteria::ASC) Order by the FROM_EMAIL column
 * @method     ChildSysEmailQuery orderByFromName($order = Criteria::ASC) Order by the FROM_NAME column
 * @method     ChildSysEmailQuery orderByCc($order = Criteria::ASC) Order by the CC column
 * @method     ChildSysEmailQuery orderByBcc($order = Criteria::ASC) Order by the BCC column
 * @method     ChildSysEmailQuery orderBySubject($order = Criteria::ASC) Order by the SUBJECT column
 * @method     ChildSysEmailQuery orderByBody($order = Criteria::ASC) Order by the BODY column
 * @method     ChildSysEmailQuery orderByAttachments($order = Criteria::ASC) Order by the ATTACHMENTS column
 * @method     ChildSysEmailQuery orderByTemplate($order = Criteria::ASC) Order by the TEMPLATE column
 * @method     ChildSysEmailQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildSysEmailQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildSysEmailQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildSysEmailQuery groupById() Group by the ID column
 * @method     ChildSysEmailQuery groupByCode() Group by the CODE column
 * @method     ChildSysEmailQuery groupByName() Group by the NAME column
 * @method     ChildSysEmailQuery groupByDescription() Group by the DESCRIPTION column
 * @method     ChildSysEmailQuery groupByFromEmail() Group by the FROM_EMAIL column
 * @method     ChildSysEmailQuery groupByFromName() Group by the FROM_NAME column
 * @method     ChildSysEmailQuery groupByCc() Group by the CC column
 * @method     ChildSysEmailQuery groupByBcc() Group by the BCC column
 * @method     ChildSysEmailQuery groupBySubject() Group by the SUBJECT column
 * @method     ChildSysEmailQuery groupByBody() Group by the BODY column
 * @method     ChildSysEmailQuery groupByAttachments() Group by the ATTACHMENTS column
 * @method     ChildSysEmailQuery groupByTemplate() Group by the TEMPLATE column
 * @method     ChildSysEmailQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildSysEmailQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildSysEmailQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildSysEmailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysEmailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysEmailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysEmailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysEmailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysEmailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysEmailQuery leftJoinSysEmailSent($relationAlias = null) Adds a LEFT JOIN clause to the query using the SysEmailSent relation
 * @method     ChildSysEmailQuery rightJoinSysEmailSent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SysEmailSent relation
 * @method     ChildSysEmailQuery innerJoinSysEmailSent($relationAlias = null) Adds a INNER JOIN clause to the query using the SysEmailSent relation
 *
 * @method     ChildSysEmailQuery joinWithSysEmailSent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SysEmailSent relation
 *
 * @method     ChildSysEmailQuery leftJoinWithSysEmailSent() Adds a LEFT JOIN clause and with to the query using the SysEmailSent relation
 * @method     ChildSysEmailQuery rightJoinWithSysEmailSent() Adds a RIGHT JOIN clause and with to the query using the SysEmailSent relation
 * @method     ChildSysEmailQuery innerJoinWithSysEmailSent() Adds a INNER JOIN clause and with to the query using the SysEmailSent relation
 *
 * @method     \App\model\domain\SysEmailSentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSysEmail findOne(ConnectionInterface $con = null) Return the first ChildSysEmail matching the query
 * @method     ChildSysEmail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysEmail matching the query, or a new ChildSysEmail object populated from the query conditions when no match is found
 *
 * @method     ChildSysEmail findOneById(int $ID) Return the first ChildSysEmail filtered by the ID column
 * @method     ChildSysEmail findOneByCode(string $CODE) Return the first ChildSysEmail filtered by the CODE column
 * @method     ChildSysEmail findOneByName(string $NAME) Return the first ChildSysEmail filtered by the NAME column
 * @method     ChildSysEmail findOneByDescription(string $DESCRIPTION) Return the first ChildSysEmail filtered by the DESCRIPTION column
 * @method     ChildSysEmail findOneByFromEmail(string $FROM_EMAIL) Return the first ChildSysEmail filtered by the FROM_EMAIL column
 * @method     ChildSysEmail findOneByFromName(string $FROM_NAME) Return the first ChildSysEmail filtered by the FROM_NAME column
 * @method     ChildSysEmail findOneByCc(string $CC) Return the first ChildSysEmail filtered by the CC column
 * @method     ChildSysEmail findOneByBcc(string $BCC) Return the first ChildSysEmail filtered by the BCC column
 * @method     ChildSysEmail findOneBySubject(string $SUBJECT) Return the first ChildSysEmail filtered by the SUBJECT column
 * @method     ChildSysEmail findOneByBody(string $BODY) Return the first ChildSysEmail filtered by the BODY column
 * @method     ChildSysEmail findOneByAttachments(string $ATTACHMENTS) Return the first ChildSysEmail filtered by the ATTACHMENTS column
 * @method     ChildSysEmail findOneByTemplate(string $TEMPLATE) Return the first ChildSysEmail filtered by the TEMPLATE column
 * @method     ChildSysEmail findOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEmail filtered by the LAST_USER_ID column
 * @method     ChildSysEmail findOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEmail filtered by the CREATION_DATE column
 * @method     ChildSysEmail findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysEmail filtered by the MODIFICATION_DATE column *

 * @method     ChildSysEmail requirePk($key, ConnectionInterface $con = null) Return the ChildSysEmail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOne(ConnectionInterface $con = null) Return the first ChildSysEmail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEmail requireOneById(int $ID) Return the first ChildSysEmail filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByCode(string $CODE) Return the first ChildSysEmail filtered by the CODE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByName(string $NAME) Return the first ChildSysEmail filtered by the NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByDescription(string $DESCRIPTION) Return the first ChildSysEmail filtered by the DESCRIPTION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByFromEmail(string $FROM_EMAIL) Return the first ChildSysEmail filtered by the FROM_EMAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByFromName(string $FROM_NAME) Return the first ChildSysEmail filtered by the FROM_NAME column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByCc(string $CC) Return the first ChildSysEmail filtered by the CC column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByBcc(string $BCC) Return the first ChildSysEmail filtered by the BCC column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneBySubject(string $SUBJECT) Return the first ChildSysEmail filtered by the SUBJECT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByBody(string $BODY) Return the first ChildSysEmail filtered by the BODY column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByAttachments(string $ATTACHMENTS) Return the first ChildSysEmail filtered by the ATTACHMENTS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByTemplate(string $TEMPLATE) Return the first ChildSysEmail filtered by the TEMPLATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildSysEmail filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByCreationDate(string $CREATION_DATE) Return the first ChildSysEmail filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysEmail requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildSysEmail filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysEmail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysEmail objects based on current ModelCriteria
 * @method     ChildSysEmail[]|ObjectCollection findById(int $ID) Return ChildSysEmail objects filtered by the ID column
 * @method     ChildSysEmail[]|ObjectCollection findByCode(string $CODE) Return ChildSysEmail objects filtered by the CODE column
 * @method     ChildSysEmail[]|ObjectCollection findByName(string $NAME) Return ChildSysEmail objects filtered by the NAME column
 * @method     ChildSysEmail[]|ObjectCollection findByDescription(string $DESCRIPTION) Return ChildSysEmail objects filtered by the DESCRIPTION column
 * @method     ChildSysEmail[]|ObjectCollection findByFromEmail(string $FROM_EMAIL) Return ChildSysEmail objects filtered by the FROM_EMAIL column
 * @method     ChildSysEmail[]|ObjectCollection findByFromName(string $FROM_NAME) Return ChildSysEmail objects filtered by the FROM_NAME column
 * @method     ChildSysEmail[]|ObjectCollection findByCc(string $CC) Return ChildSysEmail objects filtered by the CC column
 * @method     ChildSysEmail[]|ObjectCollection findByBcc(string $BCC) Return ChildSysEmail objects filtered by the BCC column
 * @method     ChildSysEmail[]|ObjectCollection findBySubject(string $SUBJECT) Return ChildSysEmail objects filtered by the SUBJECT column
 * @method     ChildSysEmail[]|ObjectCollection findByBody(string $BODY) Return ChildSysEmail objects filtered by the BODY column
 * @method     ChildSysEmail[]|ObjectCollection findByAttachments(string $ATTACHMENTS) Return ChildSysEmail objects filtered by the ATTACHMENTS column
 * @method     ChildSysEmail[]|ObjectCollection findByTemplate(string $TEMPLATE) Return ChildSysEmail objects filtered by the TEMPLATE column
 * @method     ChildSysEmail[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildSysEmail objects filtered by the LAST_USER_ID column
 * @method     ChildSysEmail[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildSysEmail objects filtered by the CREATION_DATE column
 * @method     ChildSysEmail[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildSysEmail objects filtered by the MODIFICATION_DATE column
 * @method     ChildSysEmail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysEmailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\model\domain\Base\SysEmailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\model\\domain\\SysEmail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysEmailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysEmailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysEmailQuery) {
            return $criteria;
        }
        $query = new ChildSysEmailQuery();
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
     * @return ChildSysEmail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysEmailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysEmailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysEmail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, CODE, NAME, DESCRIPTION, FROM_EMAIL, FROM_NAME, CC, BCC, SUBJECT, BODY, ATTACHMENTS, TEMPLATE, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM sys_email WHERE ID = :p0';
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
            /** @var ChildSysEmail $obj */
            $obj = new ChildSysEmail();
            $obj->hydrate($row);
            SysEmailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysEmail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysEmailTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysEmailTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the CODE column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE CODE = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE CODE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE NAME = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the DESCRIPTION column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE DESCRIPTION = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE DESCRIPTION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the FROM_EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByFromEmail('fooValue');   // WHERE FROM_EMAIL = 'fooValue'
     * $query->filterByFromEmail('%fooValue%', Criteria::LIKE); // WHERE FROM_EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fromEmail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByFromEmail($fromEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromEmail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_FROM_EMAIL, $fromEmail, $comparison);
    }

    /**
     * Filter the query on the FROM_NAME column
     *
     * Example usage:
     * <code>
     * $query->filterByFromName('fooValue');   // WHERE FROM_NAME = 'fooValue'
     * $query->filterByFromName('%fooValue%', Criteria::LIKE); // WHERE FROM_NAME LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fromName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByFromName($fromName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_FROM_NAME, $fromName, $comparison);
    }

    /**
     * Filter the query on the CC column
     *
     * Example usage:
     * <code>
     * $query->filterByCc('fooValue');   // WHERE CC = 'fooValue'
     * $query->filterByCc('%fooValue%', Criteria::LIKE); // WHERE CC LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByCc($cc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_CC, $cc, $comparison);
    }

    /**
     * Filter the query on the BCC column
     *
     * Example usage:
     * <code>
     * $query->filterByBcc('fooValue');   // WHERE BCC = 'fooValue'
     * $query->filterByBcc('%fooValue%', Criteria::LIKE); // WHERE BCC LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bcc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByBcc($bcc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bcc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_BCC, $bcc, $comparison);
    }

    /**
     * Filter the query on the SUBJECT column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE SUBJECT = 'fooValue'
     * $query->filterBySubject('%fooValue%', Criteria::LIKE); // WHERE SUBJECT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_SUBJECT, $subject, $comparison);
    }

    /**
     * Filter the query on the BODY column
     *
     * Example usage:
     * <code>
     * $query->filterByBody('fooValue');   // WHERE BODY = 'fooValue'
     * $query->filterByBody('%fooValue%', Criteria::LIKE); // WHERE BODY LIKE '%fooValue%'
     * </code>
     *
     * @param     string $body The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByBody($body = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($body)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_BODY, $body, $comparison);
    }

    /**
     * Filter the query on the ATTACHMENTS column
     *
     * Example usage:
     * <code>
     * $query->filterByAttachments('fooValue');   // WHERE ATTACHMENTS = 'fooValue'
     * $query->filterByAttachments('%fooValue%', Criteria::LIKE); // WHERE ATTACHMENTS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $attachments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByAttachments($attachments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($attachments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_ATTACHMENTS, $attachments, $comparison);
    }

    /**
     * Filter the query on the TEMPLATE column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplate('fooValue');   // WHERE TEMPLATE = 'fooValue'
     * $query->filterByTemplate('%fooValue%', Criteria::LIKE); // WHERE TEMPLATE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $template The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByTemplate($template = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($template)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_TEMPLATE, $template, $comparison);
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
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
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
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(SysEmailTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysEmailTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \App\model\domain\SysEmailSent object
     *
     * @param \App\model\domain\SysEmailSent|ObjectCollection $sysEmailSent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSysEmailQuery The current query, for fluid interface
     */
    public function filterBySysEmailSent($sysEmailSent, $comparison = null)
    {
        if ($sysEmailSent instanceof \App\model\domain\SysEmailSent) {
            return $this
                ->addUsingAlias(SysEmailTableMap::COL_ID, $sysEmailSent->getEmailId(), $comparison);
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
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function joinSysEmailSent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useSysEmailSentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSysEmailSent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SysEmailSent', '\App\model\domain\SysEmailSentQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysEmail $sysEmail Object to remove from the list of results
     *
     * @return $this|ChildSysEmailQuery The current query, for fluid interface
     */
    public function prune($sysEmail = null)
    {
        if ($sysEmail) {
            $this->addUsingAlias(SysEmailTableMap::COL_ID, $sysEmail->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_email table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysEmailTableMap::clearInstancePool();
            SysEmailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysEmailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysEmailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysEmailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysEmailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysEmailQuery
