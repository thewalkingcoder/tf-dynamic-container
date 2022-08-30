<?php

namespace App\Tests\Fonctionnal;

use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Post;

class FakePostApiRepository implements PostRepositoryInterface
{
    /**
     * @var array
     */
    private $fakeDataResponse;

    public function __construct(array $fakeDataResponse = [])
    {
        $this->fakeDataResponse = $fakeDataResponse;
    }

    public function find(int $id): Post
    {

        return new Post(
            $this->fakeDataResponse[0]['id'],
            $this->fakeDataResponse[0]['name']
        );
    }

}