<?php

namespace Kangourouge\MessengerBundle\Action;

use Kangourouge\MessengerBundle\Message\Command\PatchCommand;
use Kangourouge\MessengerBundle\Service\MessageLoggerInterface;
use Kangourouge\MessengerBundle\Service\MessageResourceValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class PatchAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class PatchAction
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
     * @param PatchCommand $command
     *
     * @return Response
     */
    public function __invoke(PatchCommand $command): Response
    {
        if ($command->isLogged()) {
            $this->messageLogger->log($command);
        }

        $this->messageResourceValidator->validate($command);
        $this->commandBus->dispatch($command);

        return Response::create('', Response::HTTP_NO_CONTENT);
    }
}
