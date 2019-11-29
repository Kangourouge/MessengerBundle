<?php

namespace KRG\Bundle\MessengerBundle\Message\CommandHandler;

use KRG\Bundle\MessengerBundle\Message\Command\DeleteCommand;
use KRG\Bundle\MessengerBundle\Message\MessageRepositoryTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class DeleteCommandHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class DeleteCommandHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param DeleteCommand $deleteCommand
     */
    public function __invoke(DeleteCommand $deleteCommand): void
    {
        $this
            ->generateRepository($deleteCommand)
            ->addParameter($deleteCommand->getId())
            ->execute()
        ;
    }
}
