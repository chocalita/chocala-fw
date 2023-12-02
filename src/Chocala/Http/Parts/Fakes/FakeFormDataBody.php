<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\FormDataBody;
use Chocala\Http\Parts\MessageBodyInterface;

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
        parent::__construct();
        $this->data = self::ARRAY_DATA;
    }

}