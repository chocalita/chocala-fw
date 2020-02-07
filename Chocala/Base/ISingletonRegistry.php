<?php
/**
 * Singleton Registry Interface as variation of Singleton pattern
 * SINGLETON Pattern (SINGLETON REFACTORIZED)
 *
 * @author ypra
 */
interface ISingletonRegistry extends ISingleton
{

    public static function updateRegistry($var, $object);

}