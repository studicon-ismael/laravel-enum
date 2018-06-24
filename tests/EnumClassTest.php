<?php

namespace MadWeb\Enum\Test;


use MadWeb\Enum\Enum;

class EnumClassTest extends TestCase
{
    /** @test */
    public function default_value()
    {
        $Enum = new PostStatusEnum;

        $this->assertEquals($Enum->getValue(), PostStatusEnum::__default);
    }

    /** @test */
    public function is()
    {
        $Enum = new PostStatusEnum;

        $this->assertTrue($Enum->is(PostStatusEnum::PENDING));
    }

    /** @test */
    public function values()
    {
        $this->assertEquals(
            [
                'PUBLISHED' => PostStatusEnum::PUBLISHED(),
                'PENDING' => PostStatusEnum::PENDING(),
                'DRAFT' => PostStatusEnum::DRAFT(),
            ],
            PostStatusEnum::values()
        );
    }

    /** @test */
    public function keys()
    {
        $this->assertSame(
            [
                'PUBLISHED',
                'PENDING',
                'DRAFT',
            ],
            PostStatusEnum::keys()
        );
    }

    /** @test */
    public function random_value()
    {
        $value = PostStatusEnum::randomValue();

        $this->assertContains($value, PostStatusEnum::values());
    }

    /** @test */
    public function random_key()
    {
        $value = PostStatusEnum::randomKey();

        $this->assertContains($value, PostStatusEnum::keys());
    }

    /** @test */
    public function get_constants_list()
    {
        $this->assertSame(
            [
                'PUBLISHED' => 'published',
                'PENDING' => 'pending',
                'DRAFT' => 'draft',
            ],
            (new PostStatusEnum)->getConstList()
        );
    }

    /** @test */
    public function get_constants_list_with_defalut()
    {
        $this->assertSame(
            [
                '__default' => 'pending',
                'PUBLISHED' => 'published',
                'PENDING' => 'pending',
                'DRAFT' => 'draft',
            ],
            (new PostStatusEnum)->getConstList(true)
        );
    }
}
