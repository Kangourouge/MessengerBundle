<?php

namespace Kangourouge\MessengerBundle\Action;

use Kangourouge\MessengerBundle\Message\Command\CreateCommand;
use Kangourouge\MessengerBundle\Service\MessageLoggerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class CreateAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class CreateAction
{
    /** @var MessageBusInterface */
    private $commandBus;

    /** @var MessageLoggerInterface */
    private $messageLogger;

    /**
     * @param MessageBusInterface    $commandBus
     * @param MessageLoggerInterface $messageLogger
     */
    public function __construct(MessageBusInterface $commandBus, MessageLoggerInterface $messageLogger)
    {
        $this->commandBus = $commandBus;
        $this->messageLogger = $messageLogger;
    }

    public function __invoke(CreateCommand $command): Response
    {
        if ($command->isLogged()) {
            $this->messageLogger->log($command);
        }

        $command->setEntityId(Uuid::uuid4()->toString());
        $this->commandBus->dispatch($command);

        return Response::create('', Response::HTTP_CREATED, ['X-location' => $command->getEntityId()]);
    }
}
