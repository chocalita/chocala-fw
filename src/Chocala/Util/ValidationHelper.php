<?php

namespace Chocala\Util;

/**
 * Description of ValidationHelper
 *
 * @author ypra
 */
abstract class ValidationHelper
{

    /**
     * @param string $field
     * @param string $key
     * @param array $messageArgs
     * @param string $className
     * @return ValidationFailed
     */
    public static function createFailure($field, $key, $messageArgs = [], $className = null)
    {
        $messageKey = ($className != null) ? ($className . '.' . $field . "." . $key) : $key;
        $message = __($messageKey, $messageArgs);
        if ($message == $messageKey) {
            $messageKey = ($className != null) ? ($className . '.' . $key) : $key;
            $message = __($messageKey, $messageArgs);
        }
        if ($message == $messageKey) {
            $message = __($key, $messageArgs);
        }
        return new ValidationFailed($message, $field, $className);
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateNotNull($field, $value, $className)
    {
        return is_null($value) ? self::createFailure($field, 'validate.null', [], $className) : null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateNotBlank($field, $value, $className)
    {
        return is_string($value) && trim($value) === '' ?
            self::createFailure($field, 'validate.blank', [], $className) : null;
    }

    /**
     * @param string $field
     * @param double $value
     * @param double $min
     * @param double $max
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateRange($field, $value, $min, $max, $className)
    {
        return ($value < $min || $value > $max) ?
            self::createFailure($field, 'validate.range', ['min' => $min, 'max' => $max], $className) : null;
    }

    /**
     * @param string $field
     * @param double $value
     * @param double $min
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateMinValue($field, $value, $min, $className)
    {
        return $value < $min ?
            self::createFailure($field, 'validate.min', ['min' => $min], $className) : null;
    }

    /**
     * @param string $field
     * @param double $value
     * @param double $max
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateMaxValue($field, $value, $max, $className)
    {
        return $value > $max ?
            self::createFailure($field, 'validate.max', ['max' => $max], $className) : null;
    }

    /**
     * @param string $field
     * @param string $value
     * @param int $min
     * @param int $max
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateSize($field, $value, $min, $max, $className)
    {
        return (mb_strlen($value) < $min || mb_strlen($value) > $max) ?
            self::createFailure($field, 'validate.size', ['min' => $min, 'max' => $max], $className) : null;
    }

    /**
     * @param string $field
     * @param string $value
     * @param int $min
     * @param string $className
     * @return ValidationFailed
     */
    public static function validateSizeMin($field, $value, $min, $className)
    {
        return mb_strlen($value) < $min ?
            self::createFailure($field, 'validate.size.min', ['min' => $min], $className) : null;
    }

    /**
     * @param string $field
     * @param string $value
     * @param int $max
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateSizeMax($field, $value, $max, $className)
    {
        return mb_strlen($value) > $max ?
            self::createFailure($field, 'validate.size.max', ['max' => $max], $className) : null;
    }

    /**
     * @param string $field
     * @param string $value
     * @param int $fix
     * @param string $className
     * @return ValidationFailed
     */
    public static function validateSizeFix($field, $value, $fix, $className)
    {
        return mb_strlen($value) != $fix ?
            self::createFailure($field, 'validate.size.fix', ['fix' => $fix], $className) : null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param mixed $val
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateEqual($field, $value, $val, $className)
    {
        return $value != $val ?
            self::createFailure($field, 'validate.equal', ['val' => $val], $className) : null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param mixed $val
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateNotEqual($field, $value, $val, $className)
    {
        return $value == $val ?
            self::createFailure($field, 'validate.notEqual', ['val' => $val], $className) : null;
    }

    /**
     * @param string $field
     * @param string $value
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateNotEmail($field, $value, $className)
    {
        return !Validation::isEmail($value) ?
            self::createFailure($field, 'validate.email', [], $className) : null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param array $list
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateInList($field, $value, $list, $className)
    {
        return !in_array($value, $list) ?
            self::createFailure($field, 'validate.inList', ['val' => $value], $className) : null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param array $list
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateNotInList($field, $value, $list, $className)
    {
        return in_array($value, $list) ?
            self::createFailure($field, 'validate.notInList', ['val' => $value], $className) : null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $queryClass
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateUnique($field, $value, $queryClass, $className)
    {
        return $queryClass->count() > 0 ?
            self::createFailure($field, 'validate.unique', ['val' => $value], $className) : null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param mixed $obj
     * @param string $validator
     * @param string $className
     * @return null|ValidationFailed
     */
    public static function validateValidator($field, $value, $obj, $validator, $className)
    {
        $validateResult = $obj->$validator($value);
        if ($validateResult == false || trim($validateResult) == '') {
            return self::createFailure($field, 'validate.value', ['val' => $value], $className);
        } else if (is_string($validateResult)) {
            return self::createFailure($field, $validateResult, ['val' => $value], $className);
        } else if (is_array($validateResult) && array_key_exists('msg')) {
            //TODO : custom validation messages with 'args' $validateResult['args']
            return self::createFailure($field, $validateResult['msg'], ['val' => $value], $className);
        }
        return null;
    }

    public static function validateField($obj, $field, $validations)
    {
        $className = get_class($obj);
        $fieldName = ucfirst(trim($field));
        $getter = 'get' . $fieldName;
        $value = $obj->$getter();
        $keys = array_keys($validations);
        $isNull = $validations['null'] ? is_null($value) : false;
        foreach ($validations as $type => $option) {
            $validateResult = null;
            switch (strtolower($type)) {
                case 'null':
                    $validateResult = !$option ?
                        self::validateNotNull($field, $value, $className) : null;
                    break;
                case 'blank':
                    $validateResult = !$option ?
                        self::validateNotBlank($field, $value, $className) : null;
                    break;
                case 'equal':
                    $validateResult = self::validateEqual($field, $value, $option, $className);
                    break;
                case 'notEqual':
                    $validateResult = self::validateNotEqual($field, $value, $option, $className);
                    break;
                case 'range':
                    if (!$isNull) {
                        $min = $option['min'];
                        $max = $option['max'];
                        if (self::isNumeric($min) && self::isNumeric($max)) {
                            $validateResult = self::validateRange($field, $value, $min, $max, $className);
                        } elseif (self::isNumeric($min)) {
                            $validateResult = self::validateMinValue($field, $value, $min, $className);
                        } elseif (self::isNumeric($max)) {
                            $validateResult = self::validateMaxValue($field, $value, $max, $className);
                        } else {
                            throw new ValidationException('INVALID RANGE VALIDATION DATA IN ' . $className);
                        }
                    }
                    break;
                case 'size':
                    if (!$isNull) {
                        $min = $option['min'];
                        $max = $option['max'];
                        $fix = $option['fix'];
                        if (self::isInteger($min) && self::isInteger($max)) {
                            $validateResult = self::validateSize($field, $value, $min, $max, $className);
                        } elseif (is_integer($min)) {
                            $validateResult = self::validateSizeMin($field, $value, $min, $className);
                        } elseif (is_integer($max)) {
                            $validateResult = self::validateSizeMax($field, $value, $max, $className);
                        } elseif (is_integer($fix)) {
                            $validateResult = self::validateSizeFix($field, $value, $fix, $className);
                        } else {
                            throw new ValidationException('INVALID SIZE VALIDATION DATA IN ' . $className);
                        }
                    }
                    break;
                case 'email':
                    if (!$isNull) {
                        $validateResult = $option ? self::validateNotEmail($field, $value, $className) : null;
                    }
                    break;
                case 'inList':
                    if (!$isNull) {
                        if (is_array($option)) {
                            $validateResult = self::validateInList($field, $value, $option, $className);
                        } else {
                            throw new ValidationException('INVALID IN LIST VALIDATION DATA IN ' . $className);
                        }
                    }
                    break;
                case 'notInList':
                    if (!$isNull) {
                        if (is_array($option)) {
                            $validateResult = self::validateNotInList($field, $value, $option, $className);
                        } else {
                            throw new ValidationException('INVALID NOT IN LIST VALIDATION DATA IN ' . $className);
                        }
                    }
                    break;
                case 'unique':
                    $queryClassName = $className . 'Query';
                    $queryClass = $queryClassName::create();
                    if (is_string($option)) {
                        $option = [$option];
                    }
                    if (is_array($option)) {
                        foreach ($option as $uField) {
                            $uFieldName = ucfirst($uField);
                            $uGetter = 'get' . $uFieldName;
                            $uValue = $obj->$uGetter();
                            $uFilter = 'filterBy' . $uFieldName;
                            $queryClass = $queryClass->$uFilter($uValue);
                        }
                    }
                    try {
                        if ($option && $value !== null) {
                            if (!$obj->isNew()) {
                                $queryClass = $queryClass->prune($obj);
                            }
                            $filterField = 'filterBy' . $fieldName;
                            $queryClass = $queryClass->$filterField($value);
                            $validateResult = self::validateUnique($field, $value, $queryClass, $className);
                        }
                    } catch (Exception $e) {
                        throw new ValidationException('INVALID UNIQUE VALIDATION DATA IN ' . $className);
                    }
                    break;
                case 'validator':
                    if (($option != null || $option != '') &&
                        (is_bool($option) || is_numeric($option) || is_string($option))) {
                        $validator = '__validate' . $field;
                        if (is_string($option)) {
                            $validator = $option;
                        }
                        //TODO: validate args size in validator method
                        if (method_exists($obj, $validator)) {
                            $validateResult = self::validateValidator($field, $value, $obj, $validator, $className);
                        } else {
                            throw new ValidationException('VALIDATOR METHOD \'' . $validator . '\' DOES NOT EXISTS IN ' . $className);
                        }
                    }
                    break;
                default:
                    //TODO: remove, is a potential bug (execute scripts)
                    if (is_callable($option)) {
                        $validateResult = $option($value, $obj);
                    }
                    break;
            }
            if (!is_null($validateResult)) {
                return $validateResult;
            }
        }
        return null;
    }

    public static function validateObject($obj, $validations)
    {
        $failures = [];
        foreach ($validations as $kVal => $vVal) {
            $fails = self::validateField($obj, $kVal, $vVal);
            if ($fails != '') {
                $failures[] = $fails;
            }
        }
        return $failures;
    }

    public static function mergeFailures($parentErrors, $validationErrors)
    {
        if (is_array($parentErrors)) {
            if (!empty($validationErrors)) {
                $validationErrors = array_merge($parentErrors,
                    $validationErrors);
            } else {
                $validationErrors = $parentErrors;
            }
            return $validationErrors;
        } elseif ($parentErrors === true) {
            if (empty($validationErrors)) {
                return true;
            } else {
                return $validationErrors;
            }
        } else {
            throw new UnexpectedValueException('Unexpected validation state.');
        }
    }

    /**
     * @param array $failures
     * @return array
     */
    public static function failuresMap($failures)
    {
        return array_map(function ($obj) {
            return ['field' => $obj->getColumn(), 'message' => $obj->getMessage()];
        }, $failures);
    }

    /**
     *
     * @param mixed $var
     * @return boolean
     */
    public static function isInteger($var)
    {
        return is_numeric($var) && is_integer($var * 1);
    }

    /**
     * @param mixed $var
     * @return bool
     */
    public static function isNumeric($var)
    {
        return is_numeric($var);
    }

    /**
     *
     * @param mixed $var
     * @return boolean
     */
    public static function isNotEmpty($var)
    {
        return (trim($var) != '');
    }

    /**
     *
     * @param string $var
     * @param int $min
     * @return bool
     */
    public static function isMinLength($var, $min)
    {
        return (strlen(trim($var)) >= $min);
    }

    /**
     *
     * @param string $var
     * @return bool
     */
    public static function isEmail($var)
    {
        return preg_match('#^(((([a-z\d][\.\-\+_]?)*)[a-z0-9])+)\@' .
            '(((([a-z\d][\.\-_]?){0,62})[a-z\d])+)\.([a-z\d]{2,6})$#i',
            trim($var));
    }

    /**
     *
     * @param string $var
     * @return bool
     */
    public static function isDate($var)
    {
        return preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', trim($var));
    }

    /**
     *
     * @param string $var
     * @return bool
     */
    public static function isIP($var)
    {
        return preg_match('^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)' .
            '(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$', trim($var));
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isFile($key)
    {
        return (isset($_FILES[$key]) && $_FILES[$key]['error'] == 0);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isGet($key)
    {
        return isset($_GET[$key]);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isGetInteger($key)
    {
        return self::isGet($key) && self::isInteger($_GET[$key]);
    }

    /**
     *
     * @param string $key
     * @param int $min
     * @return bool
     */
    public static function isGetMinLength($key, $min)
    {
        return self::isGet($key) && self::isMinLength($_GET[$key], $min);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isGetNotEmpty($key)
    {
        return self::isGet($key) && self::isNotEmpty($_GET[$key]);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isGetEmail($key)
    {
        return self::isGet($key) && self::isEmail($_GET[$key]);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isPost($key)
    {
        return isset($_POST[$key]);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isPostInteger($key)
    {
        return self::isPost($key) && self::isInteger($_POST[$key]);
    }

    /**
     *
     * @param string $key
     * @param int $min
     * @return bool
     */
    public static function isPostMinLength($key, $min)
    {
        return self::isPost($key) && self::isMinLength($_POST[$key], $min);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isPostNotEmpty($key)
    {
        return self::isPost($key) && self::isNotEmpty($_POST[$key]);
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public static function isPostEmail($key)
    {
        return self::isPost($key) && self::isEmail($_POST[$key]);
    }

}