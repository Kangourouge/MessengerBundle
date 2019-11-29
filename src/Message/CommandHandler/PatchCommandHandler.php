<?php

namespace KRG\Bundle\MessengerBundle\Message\CommandHandler;

use KRG\Bundle\MessengerBundle\Message\Command\PatchCommand;
use KRG\Bundle\MessengerBundle\Message\MessageRepositoryTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class PatchCommandHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class PatchCommandHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param PatchCommand $patchCommand
     */
    public function __invoke(PatchCommand $patchCommand): void
    {
        $this
            ->generateRepository($patchCommand)
            ->addParameter($patchCommand->getId())
            ->addParameter($patchCommand->getContent())
            ->execute()
        ;
    }
}
