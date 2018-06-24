<?php

namespace MadWeb\Enum\Test;


use MadWeb\Enum\Enum;

class EnumCastingTest extends TestCase
{
    /** @test */
    public function retrieve_casting()
    {
        $post = Post::create(['title' => 'Some title', 'status' => 'pending']);

        $post = Post::where('id', $post->id)->first();

        $this->assertInstanceOf(Enum::class, $post->status);
    }

    /** @test */
    public function set_casting()
    {
        $post = Post::make(['title' => 'Some title', 'status' => 'pending']);

        $this->assertInstanceOf(Enum::class, $post->status);
    }

    /** @test */
    public function set_attribute()
    {
        $post = Post::create(['title' => 'Some title', 'status' => 'pending']);

        $post->status = PostStatusEnum::PUBLISHED();

        $this->assertEquals($post->status->getValue(), PostStatusEnum::PUBLISHED()->getValue());
    }

    /** @test */
    public function change_attribute()
    {
        $post = Post::create(['title' => 'Some title', 'status' => 'pending']);

        $post->status = PostStatusEnum::PUBLISHED();

        $post->save();

        $post = Post::where('id', $post->id)->first();

        $this->assertEquals($post->status->getValue(), PostStatusEnum::PUBLISHED()->getValue());
    }
}
