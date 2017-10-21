<?php

use Base\SysPerson as BaseSysPerson;

/**
 *
 *
 */
class SysPerson extends BaseSysPerson implements JsonSerializable
{
    use Validatable, Convertible;

    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';

    public static $genderList = [self::GENDER_MALE, self::GENDER_FEMALE];

    protected static $validationRules = array(
        'UserId' => [
            'null' => true, 'blank' => false,
            'unique' => true,
        ],
        'LocationId' => [
            'null' => true, 'blank' => false,
        ],
        'FirstName' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 30],
        ],
        'MiddleName' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 30],
        ],
        'LastName' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 30],
        ],
        'SecondLastName' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 30],
        ],
        'Email' => [
            'null' => false, 'blank' => false,
            'email' => true,
        ],
        'IdNumber' => [
            'null' => false, 'blank' => false, 'unique' => true,
            'size' => ['min' => 5, 'max' => 20],
        ],
        'IdExtension' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 20],
        ],
        'Gender' => [
            'null' => false, 'blank' => false,
            'inlist' => [self::GENDER_MALE, self:: GENDER_FEMALE],
        ],
        'DateOfBirth' => [
            'null' => true, 'blank' => false,
        ],
        'PlaceOfBirth' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 3, 'max' => 100],
        ],
        'Address' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'City' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 50],
        ],
        'Pob' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 20],
        ],
        'PhoneHome' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 30],
        ],
        'PhoneWork' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 30],
        ],
        'Cellphone1' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 30],
        ],
        'Cellphone2' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 30],
        ],
        'PhotoMime' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 20],
        ],
    );

    public function preSave()
    {
        $this->first_name = trim($this->first_name)!=''? strtoupper(trim($this->first_name)): null;
        $this->middle_name = trim($this->middle_name)!=''? strtoupper(trim($this->middle_name)): null;
        $this->last_name = trim($this->last_name)!=''? strtoupper(trim($this->last_name)): null;
        $this->second_last_name = trim($this->second_last_name)!=''? strtoupper(trim($this->second_last_name)): null;
        $this->email = trim($this->email)?: null;
        $this->id_number = trim($this->id_number)?: null;
        $this->id_extension = trim($this->id_extension)?: null;
        $this->place_of_birth = trim($this->place_of_birth)?: null;
        $this->address = trim($this->address)?: null;
        $this->city = strtoupper(trim($this->city))?: null;
        $this->pob = strtoupper(trim($this->pob))?: null;
        $this->phone_home = trim($this->phone_home)?: null;
        $this->phone_work = trim($this->phone_work)?: null;
        $this->cellphone_1 = trim($this->cellphone_1)?: null;
        $this->cellphone_2 = trim($this->cellphone_2)?: null;
        $this->photo_mime = trim($this->photo_mime)?: null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

    /**
     * Return the complete normal name of this User
     * @param boolean $long
     * @return string
     */
    public function completeName($long = true)
    {
        return $this->getFirstName()
        .($long? ' '.$this->getMiddleName(): '')
        .' '.$this->getLastName()
        .($long? ' '.$this->getSecondLastName(): '');
    }

    /**
     * Return the complete formal name of this User
     * @param boolean $long
     * @return string
     */
    public function formalName($long = true)
    {
        return $this->getLastName()
        .($long? ' '.$this->getSecondLastName(): '')
        .' '.$this->getFirstName()
        .($long? ' '.$this->getMiddleName(): '');
    }

}