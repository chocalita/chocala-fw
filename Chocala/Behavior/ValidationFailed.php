<?php

/**
 * This file was part of the Propel package and is improved to Chocala to validate entities.
 *
 * @license    MIT License
 */

/**
 * Simple class that serves as a container for any information about a failed validation.
 *
 * Currently this class stores the qualified column name (e.g. tablename.COLUMN_NAME) and
 * the message that should be displayed to the user.
 *
 * An array of these objects will be returned by BasePeer::doValidate() if validation
 * failed.
 *
 * @author: ypra
 * Date: 2/8/2016
 * Time: 9:09 p.m.
 */
class ValidationFailed
{

    /** Column name in ENTITY_NAME format */
    private $entityName;

    /** Column name in entity.COLUMN_NAME format */
    private $colname;

    /** Message to display to user. */
    private $message;

    /** Validator object that caused this to fail. */
    private $validator;

    /**
     * Construct a new ValidationFailed object.
     *
     * @param string $message       Message to display to user.
     * @param string $colname       Column name.
     * @param string $entityName    Entity name.
     * @param object $validator     The Validator that caused this column to fail.
     */
    public function __construct(string $message, $colname, $entityName = null, $validator = null)
    {
        $this->message = $message;
        $this->colname = $colname;
        $this->entityName = $entityName;
        $this->validator = $validator;
    }

    /**
     * Set the message for the validation failure.
     *
     * @param string $v
     */
    public function setMessage(string $v)
    {
        $this->message = $v;
    }

    /**
     * Gets the message for the validation failure.
     *
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * Set the column name.
     *
     * @param string $v
     */
    public function setColumn(string $v)
    {
        $this->colname = $v;
    }

    /**
     * Gets the column name.
     *
     * @return string Qualified column name (tablename.COLUMN_NAME)
     */
    public function getColumn() : string
    {
        return $this->colname;
    }

    /**
     * Set the entity name.
     *
     * @param string $v
     */
    public function setEntityName($v)
    {
        $this->entityName = $v;
    }

    /**
     * Gets the entity name.
     *
     * @return string
     */
    public function getEntityName() : string
    {
        return $this->entityName;
    }

    /**
     * Set the validator object that caused this to fail.
     *
     * @param object $v
     */
    public function setValidator($v)
    {
        $this->validator = $v;
    }

    /**
     * Gets the validator object that caused this to fail.
     *
     * @return object
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * "magic" method to get string represenation of object.
     * Maybe someday PHP5 will support the invoking this method automatically
     * on (string) cast.  Until then it's pretty useless.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->getMessage();
    }

}