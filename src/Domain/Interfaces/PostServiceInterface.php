<?php

declare(strict_types=1);

namespace App\Domain\Interfaces;

use App\Domain\Post;

interface PostServiceInterface
{
    public function doTheStuff(int $id): Post;
}