<?php

use Base\SysEntityType as BaseSysEntityType;

/**
 *
 *
 * @author ypra
 */
class SysEntityType extends BaseSysEntityType implements JsonSerializable
{
    use Validatable, Convertible;

    /** Entity as a company with a natural person stablishment */
    const GROUP_SMALL_COMPANY = 'SMALL_COMPANY';

    /** Entity as a company with a juridic person stablishment */
    const GROUP_FORMAL_COMPANY = 'FORMAL_COMPANY';

    /** Entity that is a public or governmental entity */
    const GROUP_PUBLIC_ENTITY = 'PUBLIC_ENTITY';

    /** Entity as a business without formal stablishment */
    const GROUP_BUSINESS = 'BUSINESS';

    /** Entity that haven´t a bussiness */
    const GROUP_NO_BUSINESS = 'NO_BUSINESS';

    /**
     * @var array Group Types Map values
     */
    protected static array $groupsMap = [
        'default' => [
            self::GROUP_SMALL_COMPANY => self::GROUP_SMALL_COMPANY,
            self::GROUP_FORMAL_COMPANY => self::GROUP_FORMAL_COMPANY,
            self::GROUP_PUBLIC_ENTITY => self::GROUP_PUBLIC_ENTITY,
            self::GROUP_BUSINESS => self::GROUP_BUSINESS,
            self::GROUP_NO_BUSINESS => self::GROUP_NO_BUSINESS,
        ],
        'es' => [
            self::GROUP_SMALL_COMPANY => 'PERSONA NATURAL',
            self::GROUP_FORMAL_COMPANY => 'PERSONA JURIDICA',
            self::GROUP_PUBLIC_ENTITY => 'ENTIDAD PUBLICA',
            self::GROUP_BUSINESS => 'NEGOCIO PERSONAL',
            self::GROUP_NO_BUSINESS => 'PERSONAL',
        ],
    ];

    static array $validationRules = [
        'GroupCode' => [
            'null' => false, 'blank' => false,
            'inList' => [self::GROUP_SMALL_COMPANY, self::GROUP_FORMAL_COMPANY,
                self::GROUP_PUBLIC_ENTITY, self::GROUP_BUSINESS,
                self::GROUP_NO_BUSINESS
            ]
        ],
        'Code' => [
            'null' => false, 'blank' => false, 'unique' => true,
            'size' => ['min' => 3, 'max' => 20],
        ],
        'Name' => [
            'null' => false, 'blank' => false, 'unique' => 'GroupCode',
            'size' => ['min' => 3, 'max' => 200],
        ],
        'Description' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 3, 'max' => 2000],
        ],
    ];

    /**
     * @param string $lang |'default'|'es'
     * @return mixed
     */
    public static function groupsMap($lang = 'default')
    {
        $type = array_key_exists(strtolower($lang), static::$groupsMap) ?
            strtolower($lang) : 'default';
        return static::$groupsMap[$type];
    }

    /**
     * Return the name title for the language as $lang parameter
     * @param string $status
     * @param string $lang |'default'|'es'
     * @return mixed
     */
    public static function groupFrom(string $status, string $lang = 'es')
    {
        return static::groupsMap($lang)[$status];
    }


    public function preSave() : bool
    {
        $this->code = strtoupper(trim($this->code)) ?: null;
        $this->name = trim($this->name) ?: null;
        $this->description = trim($this->description) ?: null;
        return parent::preSave();
    }

    public function preValidate(): bool
    {
        return $this->preSave();
    }

    public function esEmpresaFormal(): bool
    {
        return $this->group_code == self::GROUP_FORMAL_COMPANY;
    }

    public function tipoEntidadFormal(): string
    {
        return $this->esEmpresaFormal() ? 'Empresa' : 'Negocio';
    }

}