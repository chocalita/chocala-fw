<?php

namespace Chocala\Base;

trait Singletonized
{
    /**
     * Represents a unique instance for the class in the system
     * @var $this
     */
    private static $INTANCE;

    /**
     * A single object instance from this
     * @return $this
     */
    public static function instance()
    {
        if (!is_object(self::$INTANCE)) {
            self::$INTANCE = new self();
        }
        return self::$INTANCE;
    }
}
