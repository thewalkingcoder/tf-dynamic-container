<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Interfaces\PostServiceInterface;
use App\Domain\Post;

class PostService implements PostServiceInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(
        PostRepositoryInterface $postRepository
    ) {
        $this->postRepository = $postRepository;
    }


    public function doTheStuff(int $id): Post
    {
        return $this->postRepository->find($id);
    }

}