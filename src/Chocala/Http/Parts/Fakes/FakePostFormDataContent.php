<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\PostFormDataContent;

class FakePostFormDataContent extends PostFormDataContent
{

    public const ARRAY_VALUES = [
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
        $_POST = self::ARRAY_VALUES;
        parent::__construct();
    }

}