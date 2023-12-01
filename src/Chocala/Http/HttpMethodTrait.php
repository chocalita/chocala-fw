<?php

namespace Chocala\Http;

use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\QueryParamsInterface;
use Exception;

trait HttpMethodTrait
{

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var QueryParamsInterface
     */
    protected QueryParamsInterface $queryParams;

    /**
     * @var MessageBodyInterface
     */
    private MessageBodyInterface $messageContent;

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
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
    public function content() : MessageBodyInterface
    {
        return $this->messageContent;
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

    /**
     * @return string
     * @throws Exception
     */
    protected function generateId(): string
    {
        return time() . '-' . random_int(100000000, 999999999);
    }

}