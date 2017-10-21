<?php
/**
 *
 * @author: ypra
 * Date: 2/8/2016
 * Time: 9:07 p.m.
 */
trait Validatable
{
    use Relatable;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var boolean
     */
    protected $alreadyInValidation = false;

    /**
     * The array for validation rules
     * @var array
     */
//    protected static $validationRules = array();

    /**
     * Array of ValidationFailed objects.
     * @var array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see   validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Code to be run before validating the object
     * @param mixed $columns Column name or an array of column names.
     * @return boolean
     */
    public function preValidate($columns = null)
    {
        return true;
    }

    /**
     * Code to be run after validating the object
     * @param mixed $columns Column name or an array of column names.
     */
    public function postValidate($columns = null)
    {
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        if($this->preValidate($columns)){
            $res =  $this->doValidate($columns);
        }
        if ($res === true) {
            $this->validationFailures = array();
            $this->postValidate($columns);

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $failureMap = array();
            $relationsManyToOne = $this->relationsManyToOne();
            foreach($relationsManyToOne as $relationMap){
                $relationName = 'a'.$relationMap->getName();
                if($this->$relationName !== null){
                    if (!$this->$relationName->validate($columns)) {
                        $failureMap = array_merge($failureMap, $this->$relationName->getValidationFailures());
                    }
                }
            }
            $relationsOneToMany = $this->relationsOneToMany();
            foreach($relationsOneToMany as $relationMap){
                // TODO: perform to many related FK with a class // name(s)RelatedByAColumn
                $relationName = 'coll'.$relationMap->getName().'s';
                if($this->$relationName !== null){
                    foreach ($this->$relationName as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }
            }
/*
            if ($this->aChoModule !== null) {
                if (!$this->aChoModule->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aChoModule->getValidationFailures());
                }
            }
            if ($this->collChoUris !== null) {
                foreach ($this->collChoUris as $referrerFK) {
                    if (!$referrerFK->validate($columns)) {
                        $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                    }
                }
            }
*/
            if(property_exists(__CLASS__, 'validationRules')){
                $validationErrors = ValidationHelper::validateObject($this, static::$validationRules);
                $failureMap = ValidationHelper::mergeFailures($failureMap, $validationErrors);
            }
            $this->alreadyInValidation = false;
        }
        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Return the validation failures as an array for a easy data management.
     *
     * @return array Array of <code>ValidationFailed</code> objets.
     */
    public function getErrorsMap()
    {
        return ValidationHelper::failuresMap($this->validationFailures);
    }


}