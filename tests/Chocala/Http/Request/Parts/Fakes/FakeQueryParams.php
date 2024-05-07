<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\QueryParams;
use Chocala\Http\Request\Parts\QueryParamsInterface;

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
