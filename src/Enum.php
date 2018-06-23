<?php

namespace MadWeb\Enum;

use MyCLabs\Enum\Enum as MyCLabsEnum;

abstract class Enum extends MyCLabsEnum
{
    /**
     * Default enum value.
     */
    const __default = null;

    public function __construct($value = null)
    {
        if (is_null($value)) {
            $value = static::__default;
        }

        parent::__construct($value);
    }

    public static function randomKey(): string
    {
        $keys = self::keys();

        return $keys[array_rand($keys)];
    }

    public static function randomValue(): string
    {
        $values = self::values();

        return $values[array_rand($values)];
    }

    public static function toArray(bool $include_default = false): array
    {
        $result = parent::toArray();

        if (isset($result['__default']) and ! $include_default) {
            unset($result['__default']);
        }

        return $result;
    }

    public function getConstList(bool $include_default = false): array
    {
        return static::toArray($include_default);
    }
}
