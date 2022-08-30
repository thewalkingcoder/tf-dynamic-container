<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Post;

class PostApiRepository implements PostRepositoryInterface
{
    public function find(int $id): Post
    {

        //call api

        $post = new Post(
            $id,
            'Real post API'
        );

        return $post;
    }

}