<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\HttpMethod;
use Chocala\Http\HttpMethodEnum;
use Chocala\Http\IO\InputStreamInterface;
use Chocala\System\ContentType;

class MessageBodies
{

    public function __construct()
    {
    }

    /**
     * @param HttpMethodEnum $method
     * @param string $contentType
     * @param InputStreamInterface $inputStream
     * @return MessageBodyInterface
     * @throws InvalidArgumentException
     * @throws IllegalArgumentException
     * @throws UnsupportedOperationException
     */
    public function make(HttpMethodEnum       $method,
                         string               $contentType,
                         InputStreamInterface $inputStream) : MessageBodyInterface
    {
        // TODO: chamge default for application/octet-stream and validate is content-disposition is form-data
        if ( strpos($contentType, ContentType::MULTIPART_FORM_DATA) === 0 ) {
            if ($method->equals(HttpMethod::POST())) {
                return new PostFormDataBody();
            } else {
                // TODO: move InputStream->content inside RawFormDataBody class
                return new RawFormDataBody($contentType, $inputStream->content());
            }
        } elseif ($contentType == ContentType::TEXT_PLAIN) {
            return new MessageBody(ContentType::TEXT_PLAIN, $inputStream->content());
        } elseif ($contentType == ContentType::TEXT_HTML) {
            return new TextHtmlBody($inputStream->content());
        } elseif ($contentType == ContentType::APPLICATION_JSON) {
            return new JsonMessageBody($inputStream->content());
        } elseif ($contentType == ContentType::APPLICATION_XML) {
            throw new UnsupportedOperationException(ContentType::APPLICATION_XML . ' is not supported yet');
        } elseif ($contentType == ContentType::MULTIPART_MIXED) {
            throw new UnsupportedOperationException(ContentType::MULTIPART_MIXED . ' is not supported yet');
        } elseif ($contentType == ContentType::MULTIPART_ALTERNATIVE) {
            throw new UnsupportedOperationException(ContentType::MULTIPART_ALTERNATIVE . ' is not supported yet');
        } elseif ($contentType == ContentType::APPLICATION_BINARY ||
            $contentType == ContentType::APPLICATION_OCTET_STREAM) {
            throw new UnsupportedOperationException(ContentType::APPLICATION_OCTET_STREAM . ' is not supported yet');
        } else {
            // 'application/x-www-form-urlencoded' This is the default content type
            $contentType = ContentType::APPLICATION_FORM_URLENCODED;
            return new FormUrlencodedBody($inputStream->content());
        }
    }

}