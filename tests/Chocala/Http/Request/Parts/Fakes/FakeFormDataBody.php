<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\FormDataBody;
use Chocala\Http\Request\Parts\MessageBodyInterface;

class FakeFormDataBody extends FormDataBody implements MessageBodyInterface
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
        parent::__construct(
            self::ARRAY_DATA
        );
    }
}
