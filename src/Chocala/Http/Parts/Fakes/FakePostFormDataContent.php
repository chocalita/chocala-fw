<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\PostFormDataContent;

class FakePostFormDataContent extends PostFormDataContent
{

    public const ARRAY_DATA = [
        'var0' => 'zero',
        'numericKey' => 789,
        'arrayKey' => [],
        'nullKey' => null,
        'toRemoveKey' => 'toRemoveValue',
        'extractedKey' => 'extractedValue',
        'lastKey' => 'last'
    ];

    public function __construct()
    {
        $_POST = self::ARRAY_DATA;
        parent::__construct();
    }

}