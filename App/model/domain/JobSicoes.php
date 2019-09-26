<?php

use Base\JobSicoes as BaseJobSicoes;

/**
 *
 *
 */
class JobSicoes extends BaseJobSicoes implements JsonSerializable
{
    use  Validatable, Convertible;

    static $validationRules = [
    ];


    public function preValidate()
    {
        return $this->preSave();
    }

    public function preInsert()
    {
        return $this->preSave();
        $this->creation_date = new DateUtil();
        $this->modification_date = new DateUtil();
    }

    public function preUpdate()
    {
        return $this->preSave();
    }

}
