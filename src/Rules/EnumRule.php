<?php

namespace MadWeb\Enum\Rules;

use MadWeb\Enum\Enum;
use InvalidArgumentException;
use Illuminate\Contracts\Validation\Rule;

class EnumRule implements Rule
{
    private $enumClass = '';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $enumClass)
    {
        if (! is_subclass_of($enumClass, Enum::class)) {
            throw new InvalidArgumentException("Value '$enumClass' is not an enum class");
        }

        $this->enumClass = $enumClass;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return call_user_func([$this->enumClass, 'isValid'], $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans()->has('validation.enum')
                ? __('validation.enum')
                : 'The :attribute value you have entered is invalid.';
    }
}
