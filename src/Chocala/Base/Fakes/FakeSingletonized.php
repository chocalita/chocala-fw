<?php

namespace Chocala\Base\Fakes;

use Chocala\Base\Singletonized;

class FakeSingletonized
{
    use Singletonized;

    public $name;

    public $time;

    private function __construct()
    {
        $this->name = 'FakeSingletonized-' . microtime(true);
        $this->time = microtime();
    }

}