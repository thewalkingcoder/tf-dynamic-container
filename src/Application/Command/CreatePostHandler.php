<?php

namespace App\Application\Command;

use App\Application\Event\PostCreated;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class CreatePostHandler implements MessageHandlerInterface
{
    /**
     * @var MessageBusInterface
     */
    private $eventBus;

    public function __construct(
        MessageBusInterface $eventBus
    ) {
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreatePost $command)
    {
        $event = new PostCreated();
        $event->id = $command->id;

        $this->eventBus->dispatch($event);
    }
}
