<?php

namespace MadWeb\Enum;

use MyCLabs\Enum\Enum as MyCLabsEnum;

abstract class Enum extends MyCLabsEnum
{
    /**
     * Default enum value.
     */
    const __default = null;

    /**
     * {@inheritdoc}
     */
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

    public function label(): string
    {
        return self::getLabel($this->getValue());
    }

    public static function labels(): array
    {
        $result = [];

        foreach (static::toArray() as $value) {
            $result[$value] = static::getLabel($value);
        }

        return $result;
    }

    private static function getLabel(string $value): string
    {
        $lang_key = sprintf(
            '%s.%s.%s',
            config('enum.lang_file_path'),
            static::class,
            $value
        );

        return trans()->has($lang_key) ? __($lang_key) : $value;
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
