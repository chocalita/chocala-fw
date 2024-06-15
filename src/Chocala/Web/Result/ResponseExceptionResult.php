<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Exceptions\HttpResponseException;
use Chocala\Http\Response\Parts\ResponseBody;
use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\Http\Response\Parts\ResponseHeadersInterface;
use Chocala\Http\Response\Parts\StatusCodeEnum;
use Chocala\System\ContentType;

class ResponseExceptionResult implements ActionResultInterface
{
    private ActionResultInterface $actionResult;

    public function __construct(HttpResponseException  $responseException,
                                ResultHeadersInterface $resultHeaders,
                                string                 $contentType)
    {
        $actionBody = $contentType == ContentType::APPLICATION_JSON ? new JsonActionBody() :
            ($contentType == ContentType::TEXT_HTML ? new PrintActionBody() : new DefaultActionBody());

        $textActionData = new TextActionData($responseException->message());
        $body = new ResponseBody($contentType, $actionBody->result($textActionData));
        $this->actionResult = new ActionResult(
            $responseException->statusCode(),
            $resultHeaders,
            $body
        );
    }

    public function status(): StatusCodeEnum
    {
        return $this->actionResult->status();
    }

    public function headers(): ResponseHeadersInterface
    {
        return $this->actionResult->headers();
    }

    public function body(): ResponseBodyInterface
    {
        return $this->actionResult->body();
    }
}
