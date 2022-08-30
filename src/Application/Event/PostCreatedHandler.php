<?php

namespace App\Application\Event;

use App\Domain\Interfaces\PostServiceInterface;
use App\Services\PostService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PostCreatedHandler implements MessageHandlerInterface
{
    /**
     * @var PostService
     */
    private $postService;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        PostServiceInterface $postService,
        SerializerInterface $serializer
    ) {
        $this->postService = $postService;
        $this->serializer = $serializer;
    }

    public function __invoke(PostCreated $event)
    {
        $post = $this->postService->doTheStuff($event->id);
        file_put_contents(
            __DIR__.'/../../../var/data.json',
           $this->serializer->serialize($post, 'json')
        );
    }
}
