<?php

namespace Chocala\Http\Method;

use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\QueryParamsInterface;

trait HttpMethodTrait
{

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var QueryParamsInterface
     */
    protected QueryParamsInterface $queryParams;

    /**
     * @var MessageBodyInterface
     */
    private MessageBodyInterface $messageBody;

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return QueryParamsInterface
     */
    public function queryParams(): QueryParamsInterface
    {
        return $this->queryParams;
    }

    /**
     * @return MessageBodyInterface
     */
    public function body() : MessageBodyInterface
    {
        return $this->messageBody;
    }

    /**
     * @return mixed
     */
    public function contentsss() : MessageBodyInterface
    {
//        $rawInput = fopen('php://input', 'r');
//        $tempStream = fopen('php://temp', 'r+');
//        stream_copy_to_stream($rawInput, $tempStream);
//        rewind($tempStream);
//        return $tempStream;
//        $entityBody = stream_get_contents(STDIN);
//        return $entityBody;
        //TODO: get body
//        $request = new Request();
//        return $request->getBody();
        return "";
    }

}