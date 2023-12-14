<?php

namespace Chocala\System;

/**
 * Description of ContentType
 *
 * @author ypra
 */
class ContentType
{

    /* UTF-8 charset encode */
    const CHARSET_UTF8 = 'UTF-8';

    /* ISO-8859-1 charset encode */
    const CHARSET_ISO88591 = 'ISO-8859-1';

    /* Form urlencoded contents */
    const APPLICATION_FORM_URLENCODED = 'application/x-www-form-urlencoded';

    /* Javascript contents */
    const APPLICATION_JAVASCRIPT = 'application/x-javascript';

    /* JSON contents */
    const APPLICATION_JSON = 'application/json';

    /* It's just a non-standard way of restating "octet-stream" */
    const APPLICATION_BINARY = 'application/binary';

    /* Strict type for binary date, include to downloads */
    const APPLICATION_OCTET_STREAM = 'application/octet-stream';

    /* PDF documents */
    const APPLICATION_PDF = 'application/pdf';

    /* Rich Text Format contents */
    const APPLICATION_RTF = 'application/rtf';

    /* Shockwave Flash contents */
    const APPLICATION_SWF = 'application/x-shockwave-flash';

    /* Extensible MarkUp Language contents */
    const APPLICATION_XML = 'application/xml';

    /* ZIP files */
    const APPLICATION_ZIP = 'application/zip';

    /* Alternative files and attachments */
    const MULTIPART_ALTERNATIVE = 'multipart/alternative';

    /* Type for .au and .snd files */
    const TYPE_AUDIO = 'audio/basic';

    /* Microsoft Excel files */
    const TYPE_EXCEL = 'application/x-msexcel';

    /* Form data contents */
    const MULTIPART_FORM_DATA = 'multipart/form-data';

    /* Css content */
    public const TEXT_CSS = 'text/css';

    /* Enriched text */
    public const TEXT_ENRICHED = 'text/enriched';

    /* HiperText Markup Language contents */
    const TEXT_HTML = 'text/html';

    /* Mixed files and attachments */
    const MULTIPART_MIXED = 'multipart/mixed';

    /* Rich Text files */
    const TEXT_RICHTEXT = 'text/richtext';

    /* Normal and plain texts */
    const TEXT_PLAIN = 'text/plain';

    /* Wireless Application Protocol for movil devices apps */
    const TYPE_WAP = 'text/vnd.wap.wml';

    /* Microsoft Word files */
    const TYPE_WORD = 'application/x-msword';

    public const CONTENT_TYPE_LIST = [
        self::TEXT_PLAIN,
        self::APPLICATION_JAVASCRIPT,
        self::APPLICATION_JSON,
        self::TEXT_HTML,
        self::APPLICATION_XML
    ];

}