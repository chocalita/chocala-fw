<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\QueryParams;
use Chocala\Http\Parts\QueryParamsInterface;

class FakeQueryParams extends QueryParams implements QueryParamsInterface
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
        $this->data = self::ARRAY_DATA;
    }

}