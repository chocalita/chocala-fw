<?php

namespace Chocala\Http\Mapping;

use InvalidArgumentException;

class PatternMap implements PatternMapInterface
{

    public const MODULE = 'module';

    public const CONTROLLER = 'controller';

    public const ACTION = 'action';

    public const ID = 'id';

    public const URI_STANDARD_PARTS = [self::MODULE, self::CONTROLLER, self::ACTION, self::ID];

    /**
     * @var string
     */
    private string $pattern;

    /**
     * @var array|null
     */
    private ?array $map = null;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        } else {
            throw new InvalidArgumentException('Invalid number of arguments to create object ' . __CLASS__);
        }
    }

    public function __construct1($pattern)
    {
        $this->pattern = $pattern;
    }

    public function pattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return array
     */
    public function map(): array
    {
        if ($this->map === null) {
            foreach (self::URI_STANDARD_PARTS as $uriPart) {
                $parts[strpos($this->pattern, "{" . $uriPart . "}")] = $uriPart;
            }
            ksort($parts);
            $this->map = [];
            $i = 0;
            foreach ($parts as $kPart => $vPart) {
                if ($kPart !== false && $kPart > 0) {
                    $this->map[$i++] = $vPart;
                }
            }
        }
        return $this->map;
    }

}