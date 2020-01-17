<?php

namespace Kangourouge\MessengerBundle\Action;

use Kangourouge\MessengerBundle\Message\Command\DeleteCommand;
use Kangourouge\MessengerBundle\Service\MessageLoggerInterface;
use Kangourouge\MessengerBundle\Service\MessageResourceValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class DeleteAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class DeleteAction
{
    /** @var MessageBusInterface */
    private $commandBus;

    /** @var MessageLoggerInterface */
    private $messageLogger;

    /** @var MessageResourceValidatorInterface */
    private $messageResourceValidator;

    /**
     * @param MessageBusInterface               $commandBus
     * @param MessageLoggerInterface            $messageLogger
     * @param MessageResourceValidatorInterface $messageResourceValidator
     */
    public function __construct(MessageBusInterface $commandBus, MessageLoggerInterface $messageLogger, MessageResourceValidatorInterface $messageResourceValidator)
    {
        $this->commandBus = $commandBus;
        $this->messageLogger = $messageLogger;
        $this->messageResourceValidator = $messageResourceValidator;
    }

    /**
     * @param DeleteCommand $command
     *
     * @return Response
     */
    public function __invoke(DeleteCommand $command): Response
    {
        if ($command->isLogged()) {
            $this->messageLogger->log($command);
        }

        $this->messageResourceValidator->validate($command);
        $this->commandBus->dispatch($command);

        return Response::create('', Response::HTTP_NO_CONTENT);
    }
}
