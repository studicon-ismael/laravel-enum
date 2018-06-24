<?php

namespace MadWeb\Enum\Test;

use MadWeb\Enum\EnumCastable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use EnumCastable;

    public $timestamps = false;

    protected $fillable = ['title', 'status'];

    protected $casts = [
        'status' => PostStatusEnum::class,
    ];
}
