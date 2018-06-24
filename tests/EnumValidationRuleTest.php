<?php

namespace MadWeb\Enum\Test;

use InvalidArgumentException;
use MadWeb\Enum\Rules\EnumRule;

class EnumValidationRuleTest extends TestCase
{
    /** @test */
    public function validation_passes()
    {
        $result = (new EnumRule(PostStatusEnum::class))->passes('', 'pending');

        $this->assertTrue($result);
    }

    /** @test */
    public function validation_fails()
    {
        $result = (new EnumRule(PostStatusEnum::class))->passes('', 'invalid');

        $this->assertFalse($result);
    }

    /** @test */
    public function validation_passes_by_method()
    {
        $result = PostStatusEnum::rule()->passes('', 'pending');

        $this->assertTrue($result);
    }

    /** @test */
    public function validation_fails_by_method()
    {
        $result = PostStatusEnum::rule()->passes('', 'invalid');

        $this->assertFalse($result);
    }

    /** @test */
    public function exception_on_invalid_enum_class()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnumRule('InvalidEnumClass');
    }
}
