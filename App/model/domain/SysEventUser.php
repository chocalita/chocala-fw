<?php

use Base\SysEventUser as BaseSysEventUser;

/**
 *
 * @author: ypra
 */
class SysEventUser extends BaseSysEventUser implements JsonSerializable
{
    use Validatable, Convertible;

    static array $validationRules = [
        'EventId' => [
            'null' => false, 'blank' => false,
        ],
        'UserId' => [
            'null' => false, 'blank' => false,
        ],
        'Date' => [
            'null' => false, 'blank' => false,
        ],
        'Message' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 3, 'max' => 1000],
        ],
        'Details' => [
            'null' => true, 'blank' => true,
        ],
    ];


    public function preSave() : bool
    {
        $this->message = trim($this->message) != '' ? trim($this->message) : null;
        $this->details = trim($this->details) != '' ? trim($this->details) : null;
        return parent::preSave();
    }

    public function preValidate() : bool
    {
        return $this->preSave();
    }

    public function preInsert() : bool
    {
        return $this->preSave();
    }

    public function preUpdate() : bool
    {
        return $this->preSave();
    }


}
