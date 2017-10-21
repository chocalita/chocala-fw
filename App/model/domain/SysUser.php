<?php

use Base\SysUser as BaseSysUser;

/**
 *
 * @author: ypra
 */
class SysUser extends BaseSysUser implements JsonSerializable
{
    use Validatable, Convertible;

    const PROFILE_DIR = 'profile';

    const EMAIL_ACCOUNT_CREATION = 'X_EMAIL_ACCOUNT_CREATION';

    const IMG_THUMBNAIL = 'thumb';
    const IMG_THUMBNAIL_SIZE = 80;
    const IMG_SMALL = 'small';
    const IMG_SMALL_SIZE = 150;
    const IMG_MEDIUM = 'medium';
    const IMG_MEDIUM_SIZE = 300;
    const IMG_BIG = 'medium';
    const IMG_BIG_SIZE = 600;

    static $imageSizes = [
        self::IMG_THUMBNAIL => self::IMG_THUMBNAIL_SIZE,
        self::IMG_SMALL => self::IMG_SMALL_SIZE,
        self::IMG_MEDIUM => self::IMG_MEDIUM_SIZE,
        self::IMG_BIG => self::IMG_BIG_SIZE,
    ];

    static $u = [self::PROFILE_DIR=>self::PROFILE_DIR];

    /** User with actived account */
    const STATUS_ACTIVE = 'ACTIVE';

    /** User with blocked account */
    const STATUS_BLOCKED = 'BLOQUED';

    /** User with closed account */
    const STATUS_CLOSED = 'CLOSED';

    /** User with created account */
    const STATUS_CREATED = 'CREATED';

    /**
     * @var array Status Map values
     */
    protected static $statusMap = [
        'default'   => [
            self::STATUS_CREATED    => self::STATUS_CREATED,
            self::STATUS_ACTIVE     => self::STATUS_ACTIVE,
            self::STATUS_BLOCKED    => self::STATUS_BLOCKED,
            self::STATUS_CLOSED     => self::STATUS_CLOSED
        ],
        'es'        => [
            self::STATUS_CREATED    => 'CREADO',
            self::STATUS_ACTIVE     => 'ACTIVO',
            self::STATUS_BLOCKED    => 'BLOQUEADO',
            self::STATUS_CLOSED     => 'CERRADO'
        ],
    ];

    static $validationRules = [
        'Username' => [
            'null' => false, 'blank' => false, 'unique' => true,
            'size'=> ['min' => 3, 'max' => 50],
        ],
        'Email' => [
            'null' => false, 'blank' => false,
            'email' => true, 'unique' => true,
            'size'=> ['min' => 3, 'max' => 50],
        ],
        'Password' => [
            'null' => false, 'blank' => false,
            'size'=> ['min' => 3, 'max' => 500],
        ],
        'Status' => [
            'null' => false, 'blank' => false,
            'inlist' => [self::STATUS_CREATED, self::STATUS_ACTIVE,
                self::STATUS_BLOCKED, self::STATUS_CLOSED]
        ],
        'Location' => [
            'null' => true, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 100],
        ],
        'Address' => [
            'null' => true, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 500],
        ],
    ];

    /**
     * @param string $lang |'default'|'es'
     * @return mixed
     */
    public static function statusMap($lang = 'default')
    {
        $type = array_key_exists(strtolower($lang), static::$statusMap)?
            strtolower($lang): 'default';
        return static::$statusMap[$type];
    }

    /**
     * Return the name title for the language as $lang parameter
     * @param string $status
     * @param string $lang |'default'|'es'
     * @return mixed
     */
    public static function statusFrom($status, $lang = 'es')
    {
        return static::statusMap($lang)[$status];
    }

    /**
     * @return array
     */
    public static function inactives()
    {
        return [static::STATUS_BLOCKED, static::STATUS_CLOSED];
    }

    public function preSave()
    {
        $this->username = strtolower(trim($this->username))?: null;
        $this->password = trim($this->password)?: null;
        $this->location = strtoupper(trim($this->location))?: null;
        $this->address = trim($this->address)?: null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

    /**
     * @return SysPerson
     */
    public function person()
    {
        return SysPersonQuery::findByUser($this);
    }

    /**
     * Crypt a string by a encryption method
     * @param string $string
     * @return string
     */
    public static function crypt($string)
    {
        /* TODO implements a encryption method*/
        $hash = $string;
        return $hash;
    }

    /**
     * Decrypt a string by a reverse encryption method
     * @param string $hash
     * @return string
     */
    public static function decrypt($hash)
    {
        /* TODO implements a decryption method*/
        $string = $hash;
        return $string;
    }

    /**
     * Change the password of this user
     * @param string $oldPassword
     * @param string $newPassword
     * @return bool
     */
    public function changePassword($oldPassword, $newPassword)
    {
        if(self::crypt($oldPassword) != $this->getPassword()){
            $this->setPassword(self::crypt($newPassword));
            $this->save();
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    public function hasCreatedStatus()
    {
        return $this->status == self::STATUS_CREATED;
    }

    /**
     * Return the complete normal name of this User
     * @param boolean $long
     * @return string
     */
    public function completeName($long = true)
    {
        return $this->person()->completeName($long);
    }

    /**
     * Return the complete formal name of this User
     * @param boolean $long
     * @return string
     */
    public function formalName($long = true)
    {
        return $this->person()->formalName($long);
    }

    /**
     * Return the roles for the user
     * @param bool|true $noDeletes
     * @return \Propel\Runtime\Collection\ObjectCollection|SysRol[]
     */
    public function inOrderRols($noDeletes=true)
    {
        return SysRolQuery::findByUser($this, $noDeletes);
    }

    public function imageName($size='')
    {
        return $this->id.($size != ''? '_'.$size: '').'.'.ImageMimeTypes::mimeExtensionFrom($this->image_mime);
    }

    public function imageDir($size='')
    {
        return FilesHelper::dirPath(self::PROFILE_DIR).$this->imageName($size);
    }

    public function imageWeb($size='')
    {
        return FilesHelper::webPath(self::PROFILE_DIR).$this->imageName($size);
    }

}