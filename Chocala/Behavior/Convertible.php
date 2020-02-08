<?php

/**
 *
 * @author ypra
 * Date: 2/25/2016
 * Time: 10:53 p.m.
 */
trait Convertible
{

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson()
    {
        return json_encode($this);
    }

}