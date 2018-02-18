<?php
use Base\JobSuscriptor as BaseJobSuscriptor;

/**
 *
 */
class JobSuscriptor extends BaseJobSuscriptor implements JsonSerializable
{
    use  Validatable, Convertible;

    const EMAIL_SUBSCRIPTION_INITIAL = 'J_EMAIL_SUBSCRIPTION_INITIAL';

    const EMAIL_NOTIFICATION_SUBSCRIBE = 'J_EMAIL_NOTIFICATION_SUBSCRIBE';


    const INICIADO = 'INICIADO', INICIADO_VALUE = 'Iniciado';
    const CONFIRMADO = 'CONFIRMADO', CONFIRMADO_VALUE = 'Confirmado';

    /**
     * @var array Status Map values
     */
    protected static $statusMap = [
        self::INICIADO => self::INICIADO,
        self::CONFIRMADO => self::CONFIRMADO_VALUE,
    ];

    static $validationRules = [
        'IdTmpArea' => [
            'null' => true, 'blank' => false,
        ],
        'IdTmpFormacion' => [
            'null' => false, 'blank' => false,
        ],
        'Email' => [
            'null' => true, 'blank' => false,
            'email' => true, 'unique' => true,
            'size' => ['min' => 10, 'max' => 100],
        ],
        'NombreSimple' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 100],
        ],
        'Nombres' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 50],
        ],
        'Apellidos' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 50],
        ],
        'Ubicacion' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 30],
        ],
        'Ip' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 3, 'max' => 50],
        ],
        'Status' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 3, 'max' => 30],
        ],
        'CreationDate' => [
            'null' => false, 'blank' => false,
        ],
        'Confirmation' => [
            'null' => true, 'blank' => true,
        ],
    ];

    /**
     * @return array
     */
    public static function statusMap()
    {
        return static::$statusMap;
    }

    public function preSave()
    {
        $this->id_tmp_area = $this->id_tmp_area?: null;
        $this->id_tmp_formacion = $this->id_tmp_formacion?: null;
        $this->email = trim(strtolower($this->email))?: null;
        $this->nombre_simple = ucwords(strtolower(trim($this->nombre_simple)))?: null;
        $this->nombres = trim($this->nombres)?: null;
        $this->apellidos = trim($this->apellidos)?: null;
        $this->ubicacion = trim($this->ubicacion)?: null;
        $this->ip = trim($this->ip)?: null;
        $this->status = trim($this->status)?: null;
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



}