<?php

namespace Kangourouge\MessengerBundle\Message\CommandHandler;

use Kangourouge\MessengerBundle\Message\Command\DeleteCommand;
use Kangourouge\MessengerBundle\Message\MessageRepositoryTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class DeleteCommandHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class DeleteCommandHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param DeleteCommand $command
     */
    public function __invoke(DeleteCommand $command): void
    {
        $this
            ->generateRepository($command)
            ->addParameter($command->getPathParameters()['id'])
            ->execute()
        ;
    }
}
