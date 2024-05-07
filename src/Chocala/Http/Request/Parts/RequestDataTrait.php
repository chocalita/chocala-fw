<?php

namespace Chocala\Http\Request\Parts;

trait RequestDataTrait
{
    /**
     * @var QueryParamsInterface
     */
    protected QueryParamsInterface $queryParams;

    /**
     * @var MessageBodyInterface
     */
    private MessageBodyInterface $messageBody;

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
    public function body(): MessageBodyInterface
    {
        return $this->messageBody;
    }
}
