<?php

namespace Kangourouge\MessengerBundle\Message\CommandHandler;

use Kangourouge\MessengerBundle\Message\Command\PatchCommand;
use Kangourouge\MessengerBundle\Message\MessageRepositoryTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class PatchCommandHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class PatchCommandHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param PatchCommand $command
     */
    public function __invoke(PatchCommand $command): void
    {
        $this
            ->generateRepository($command)
            ->addParameter($command->getPathParameters()['id'])
            ->addParameter($command->getContent())
            ->execute()
        ;
    }
}
