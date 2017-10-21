<?php

use Base\SysEntityUser as BaseSysEntityUser;

/**
 *
 */
class SysEntityUser extends BaseSysEntityUser implements JsonSerializable
{
    use Validatable, Convertible;

    static $validationRules = [
        'EntityId' => [
            'null' => false, 'blank' => false,
        ],
        'UserId' => [
            'null' => false, 'blank' => false,
        ],
        'RolId' => [
            'null' => false, 'blank' => false,
        ],
    ];

    public function preSave()
    {
        $this->entity_id = $this->entity_id?: null;
        $this->user_id = $this->user_id?: null;
        $this->rol_id = $this->rol_id?: null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

    public function preInsert()
    {
        return $this->preSave();
    }

    public function preUpdate()
    {
        return $this->preSave();
    }

    public function postInsert()
    {
        $this->updateUserRol();
    }

    public function postUpdate()
    {
        $this->updateUserRol();
    }

    /**
     * @return int
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function updateUserRol()
    {
        if(!is_object($this->userRol())){
            $userRol = new SysUserXRol();
            $userRol->setUserId($this->user_id);
            $userRol->setRolId($this->rol_id);
            return $userRol->save();
        }
        return 1;
    }

    /**
     * @return array|mixed|SysUserXRol
     */
    public function userRol()
    {
        return SysUserXRolQuery::create()->findPk([$this->user_id, $this->rol_id]);
    }

}