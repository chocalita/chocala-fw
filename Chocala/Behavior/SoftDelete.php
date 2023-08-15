<?php

/**
 *
 * User: Yecid
 * Date: 3/4/2016
 * Time: 11:57 p.m.
 */
abstract class SoftDelete
{

    const ACTIVE = 'ACTIVE', ACTIVE_VALUE = 'Activo';
    const INACTIVE = 'INACTIVE', INACTIVE_VALUE = 'Inactivo';
    const DELETED = 'DELETED', DELETED_VALUE = 'Eliminado';

    /**
     * @var array Status Map values
     */
    protected static ?array $statusMap = null;

    public static function statusMap(): ?array
    {
        if(static::$statusMap == null){
            static::$statusMap = array(
                static::ACTIVE => static::ACTIVE_VALUE,
                static::INACTIVE => static::INACTIVE_VALUE,
                static::DELETED => static::DELETED_VALUE,
            );
        }
        return static::$statusMap;
    }

}