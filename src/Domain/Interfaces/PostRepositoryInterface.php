<?php

namespace App\Domain\Interfaces;

use App\Domain\Post;

interface PostRepositoryInterface
{
    public function find(int $id): Post;
}