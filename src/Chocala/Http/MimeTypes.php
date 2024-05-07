<?php

namespace Chocala\Http;

class MimeTypes
{
    public const APPLICATION_JAVASCRIPT = 'application/javascript';
    public const APPLICATION_JSON = 'application/json';
    public const APPLICATION_OCTET_STREAM = 'application/octet-stream';
    public const APPLICATION_PDF = 'application/pdf';
    public const APPLICATION_XML = 'application/xml';

    public const MULTIPART_FORM_DATA = 'multipart/form-data';

    public const APPLICATION_ZIP = 'application/zip';
    public const IMAGE_BMP = 'image/bmp';
    public const IMAGE_GIF = 'image/gif';
    public const IMAGE_JPEG = 'image/jpeg';
    public const IMAGE_PNG = 'image/png';
    public const IMAGE_SVG = 'image/svg+xml';
    public const IMAGE_TIFF = 'image/tiff';

    public const TEXT_CSS = 'text/css';
    public const TEXT_ENRICHED = 'text/enriched';
    public const TEXT_HTML = 'text/html';
    public const TEXT_PLAIN = 'text/plain';

    public const CONTENT_TYPE_LIST = [
        self::TEXT_PLAIN,
        self::APPLICATION_JAVASCRIPT,
        self::APPLICATION_JSON,
        self::TEXT_HTML,
        self::APPLICATION_XML
    ];
}
