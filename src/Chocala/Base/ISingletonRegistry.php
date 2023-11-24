<?php

namespace Chocala\Base;

/**
 * Singleton Registry Interface as variation of Singleton pattern
 * SINGLETON Pattern (SINGLETON REFACTORIZED)
 *
 * @author ypra
 */
interface ISingletonRegistry extends Singleton
{

    public static function updateRegistry($var, $object);

}