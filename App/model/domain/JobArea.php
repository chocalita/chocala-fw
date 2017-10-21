<?php

use Base\JobArea as BaseJobArea;

/**
 *
 *
 */
class JobArea extends BaseJobArea
{
    use Validatable;

    static $validationRules = [
        'Codigo' => [
            'null' => false, 'blank' => false, 'unique' => true,
            'size' => ['min' => 3, 'max' => 20],
        ],
        'Nombre' => [
            'null' => false, 'blank' => false, 'unique' => false,
            'size' => ['min' => 3, 'max' => 100],
        ],
        'Descripcion' => [
            'null' => false, 'blank' => false,
        ],
    ];

    /**
     * @param string $lang |'default'|'es'
     * @return mixed
     */
    public static function groupsMap($lang = 'default')
    {
        $type = array_key_exists(strtolower($lang), static::$groupsMap)?
            strtolower($lang): 'default';
        return static::$groupsMap[$type];
    }

    /**
     * Return the name title for the language as $lang parameter
     * @param string $status
     * @param string $lang |'default'|'es'
     * @return mixed
     */
    public static function groupFrom($status, $lang = 'es')
    {
        return static::groupsMap($lang)[$status];
    }


}