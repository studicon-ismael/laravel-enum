<?php

namespace MadWeb\Enum;

trait EnumCastable
{
    protected function castAttribute($key, $value)
    {
        $castedValue = parent::castAttribute($key, $value);

        if ($castedValue === $value) {
            $cast_type = $this->getCasts()[$key];

            if (class_exists($cast_type) and is_subclass_of($cast_type, Enum::class)) {
                $castedValue = new $cast_type($value);
            }
        }

        return $castedValue;
    }
}
