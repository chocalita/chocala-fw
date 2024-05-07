<?php

namespace Chocala\Http;

use Chocala\Base\IllegalArgumentException;
use Chocala\Base\NotFoundException;

class Headers implements HeadersInterface
{
    public const TYPE_GENERAL = 'General';
    public const TYPE_ENTITY = 'Entity';
    public const TYPE_REQUEST = 'Request';
    public const TYPE_RESPONSE = 'Response';
    public const TYPE_CUSTOM = 'Custom';

    public const TYPES = [
        self::TYPE_GENERAL,
        self::TYPE_ENTITY,
        self::TYPE_REQUEST,
        self::TYPE_RESPONSE,
        self::TYPE_CUSTOM
    ];

    public const CACHE_CONTROL_KEY = 'Cache-Control';
    public const CONNECTION_KEY = 'Connection';
    public const DATE_KEY = 'Date';
    public const PRAGMA_KEY = 'Pragma';
    public const TRAILER_KEY = 'Trailer';
    public const TRANSFER_ENCODING_KEY = 'Transfer-Encoding';
    public const UPGRADE_KEY = 'Upgrade';
    public const VIA_KEY = 'Via';
    public const WARNING_KEY = 'Warning';

    public const GENERAL_KEYS = [
        self::CACHE_CONTROL_KEY,
        self::CONNECTION_KEY,
        self::DATE_KEY,
        self::PRAGMA_KEY,
        self::TRAILER_KEY,
        self::TRANSFER_ENCODING_KEY,
        self::UPGRADE_KEY,
        self::VIA_KEY,
        self::WARNING_KEY
    ];

    public const ALLOW_KEY = 'Allow';
    public const CONTENT_ENCODING_KEY = 'Content-Encoding';
    public const CONTENT_LANGUAGE_KEY = 'Content-Language';
    public const CONTENT_LENGTH_KEY = 'Content-Length';
    public const CONTENT_LOCATION_KEY = 'Content-Location';
    public const CONTENT_MD5_KEY = 'Content-MD5';
    public const CONTENT_RANGE_KEY = 'Content-Range';
    public const CONTENT_TYPE_KEY = 'Content-Type';
    public const EXPIRES_KEY = 'Expires';
    public const EXTENSION_HEADER_KEY = 'Extension-Header';
    public const LAST_MODIFIED_KEY = 'Last-Modified';

    public const ENTITY_KEYS = [
        self::ALLOW_KEY,
        self::CONTENT_ENCODING_KEY,
        self::CONTENT_LANGUAGE_KEY,
        self::CONTENT_LENGTH_KEY,
        self::CONTENT_LOCATION_KEY,
        self::CONTENT_MD5_KEY,
        self::CONTENT_RANGE_KEY,
        self::CONTENT_TYPE_KEY,
        self::EXPIRES_KEY,
        self::EXTENSION_HEADER_KEY,
        self::LAST_MODIFIED_KEY
    ];

    public const ACCEPT_KEY = 'Accept';
    public const ACCEPT_CHARSET_KEY = 'Accept-Charset';
    public const ACCEPT_ENCODING_KEY = 'Accept-Encoding';
    public const ACCEPT_LANGUAGE_KEY = 'Accept-Language';
    public const AUTHORIZATION_KEY = 'Authorization';
    public const EXPECT_KEY = 'Expect';
    public const FROM_KEY = 'From';
    public const HOST_KEY = 'Host';
    public const IF_MATCH_KEY = 'If-Match';
    public const IF_MODIFIED_SINCE_KEY = 'If-Modified-Since';
    public const IF_NONE_MATCH_KEY = 'If-None-Match';
    public const IF_RANGE_KEY = 'If-Range';
    public const IF_UNMODIFIED_SINCE_KEY = 'If-Unmodified-Since';
    public const MAX_FORWARDS_KEY = 'Max Forwards';
    public const PROXY_AUTHORIZATION_KEY = 'Proxy-Authorization';
    public const RANGE_KEY = 'Range';
    public const REFERER_KEY = 'Referer';
    public const TE_KEY = 'TE';
    public const USER_AGENT_KEY = 'User-Agent';

    public const REQUEST_KEYS = [
        self::ACCEPT_KEY,
        self::ACCEPT_CHARSET_KEY,
        self::ACCEPT_ENCODING_KEY,
        self::ACCEPT_LANGUAGE_KEY,
        self::AUTHORIZATION_KEY,
        self::EXPECT_KEY,
        self::FROM_KEY,
        self::HOST_KEY,
        self::IF_MATCH_KEY,
        self::IF_MODIFIED_SINCE_KEY,
        self::IF_NONE_MATCH_KEY,
        self::IF_RANGE_KEY,
        self::IF_UNMODIFIED_SINCE_KEY,
        self::MAX_FORWARDS_KEY,
        self::PROXY_AUTHORIZATION_KEY,
        self::RANGE_KEY,
        self::REFERER_KEY,
        self::TE_KEY,
        self::USER_AGENT_KEY
    ];

    public const ACCEPT_RANGES_KEY = 'Accept-Ranges';
    public const AGE_KEY = 'Age';
    public const ETAG_KEY = 'ETag';
    public const LOCATION_KEY = 'Location';
    public const PROXY_AUTHENTICATE_KEY = 'Proxy-Authenticate';
    public const RETRY_AFTER_KEY = 'Retry-After';
    public const SERVER_KEY = 'Server';
    public const VARY_KEY = 'Vary ';
    public const WWW_AUTHENTICATE_KEY = 'WWW-Authenticate';

    public const RESPONSE_KEYS = [
        self::ACCEPT_RANGES_KEY,
        self::AGE_KEY,
        self::ETAG_KEY,
        self::LOCATION_KEY,
        self::PROXY_AUTHENTICATE_KEY,
        self::RETRY_AFTER_KEY,
        self::SERVER_KEY,
        self::VARY_KEY,
        self::WWW_AUTHENTICATE_KEY
    ];

    /**
     * @var array All headers list
     */
    protected array $headers;

    /**
     * @var array
     */
    protected array $officialKeyList;

    /**
     * @var array Map of headers by types
     */
    protected array $headerTypes;

    /**
     * @var array
     */
    protected array $upperHeaders;

    /**
     * Headers constructor.
     * @param array $headersList
     * @param array|null $officialKeyList [OPTIONAL]
     */
    public function __construct(array $headersList, array $officialKeyList = null)
    {
        $this->headers = $headersList;
        $this->officialKeyList = is_array($officialKeyList) ? $officialKeyList :
            array_merge(
                array_merge(self::GENERAL_KEYS, self::ENTITY_KEYS),
                array_merge(self::REQUEST_KEYS, self::RESPONSE_KEYS)
            );
        $this->headerTypes = [];
        $this->upperHeaders = [];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function header(string $name)
    {
        $upperKey = strtoupper($name);
        if (!array_key_exists($upperKey, $this->upperHeaders())) {
            throw new NotFoundException(sprintf('Header key \'%s\' is not found', $name));
        }
        return $this->upperHeaders()[$upperKey];
    }

    /**
     * @return array
     */
    public function headerList(): array
    {
        return $this->headers;
    }

    public function headersType(string $type): array
    {
        if (!array_key_exists($type, $this->headerTypes)) {
            $keyList = [];
            switch ($type) {
                case self::TYPE_GENERAL:
                    $keyList = self::GENERAL_KEYS;
                    break;
                case self::TYPE_ENTITY:
                    $keyList = self::ENTITY_KEYS;
                    break;
                case self::TYPE_REQUEST:
                    $keyList = self::REQUEST_KEYS;
                    break;
                case self::TYPE_RESPONSE:
                    $keyList = self::RESPONSE_KEYS;
                    break;
                case self::TYPE_CUSTOM:
                    $toExcludeKeys = array_map(
                        function ($v) {
                            return strtoupper($v);
                        },
                        $this->officialKeyList
                    );
                    $this->headerTypes[$type] = array_filter(
                        $this->headers,
                        function ($k) use ($toExcludeKeys) {
                            return !in_array(strtoupper($k), $toExcludeKeys);
                        },
                        ARRAY_FILTER_USE_KEY
                    );
                    return $this->headerTypes[$type];
                default:
                    throw new IllegalArgumentException(sprintf('Illegal header type \'%s\'', $type));
            }
            $keyList = array_map(
                function ($v) {
                    return strtoupper($v);
                },
                $keyList
            );
            $this->headerTypes[$type] = array_filter(
                $this->headers,
                function ($k) use ($keyList) {
                    return in_array(strtoupper($k), $keyList);
                },
                ARRAY_FILTER_USE_KEY
            );
        }
        return $this->headerTypes[$type];
    }

    /**
     * @return array
     */
    protected function upperHeaders(): array
    {
        if (empty($this->upperHeaders)) {
            foreach ($this->headerList() as $k => $v) {
                $this->upperHeaders[strtoupper($k)] = $v;
            }
        }
        return $this->upperHeaders;
    }
}
