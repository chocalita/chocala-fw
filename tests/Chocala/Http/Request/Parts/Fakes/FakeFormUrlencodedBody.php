<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\FormUrlencodedBody;
use Chocala\Http\Request\Parts\MessageBodyInterface;

class FakeFormUrlencodedBody extends FormUrlencodedBody implements MessageBodyInterface
{
    public const ARRAY_DATA = FakeFormDataBody::ARRAY_DATA;
    public function __construct()
    {
        parent::__construct(
            $this->arrayToQueryString(self::ARRAY_DATA)
        );
    }

    /**
     * @param array $input
     * @return string
     * Source: https://stackoverflow.com/a/11427592
     */
    protected function arrayToQueryString(array $input): string
    {
        return implode(
            '&',
            array_map(
                function ($v, $k) {
                    if (is_array($v)) {
                        return $k . '[]=' . implode('&' . $k . '[]=', $v);
                    } else {
                        return $k . '=' . $v;
                    }
                },
                $input,
                array_keys($input)
            )
        );
    }
}
