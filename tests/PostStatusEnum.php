<?php

namespace MadWeb\Enum\Test;

use MadWeb\Enum\Enum;

final class PostStatusEnum extends Enum
{
    const __default = self::PENDING;

    const PUBLISHED = 'published';
    const PENDING = 'pending';
    const DRAFT = 'draft';
}
