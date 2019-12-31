<?php

namespace KRG\Bundle\MessengerBundle\Action;

use KRG\Bundle\MessengerBundle\Message\Command\UpdateCommand;
use KRG\Bundle\MessengerBundle\Service\MessageLoggerInterface;
use KRG\Bundle\MessengerBundle\Service\MessageResourceValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class UpdateAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class UpdateAction
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
     * @param UpdateCommand $command
     *
     * @return Response
     */
    public function __invoke(UpdateCommand $command): Response
    {
        if ($command->isLogged()) {
            $this->messageLogger->log($command);
        }

        $this->messageResourceValidator->validate($command);
        $this->commandBus->dispatch($command);

        return Response::create('', Response::HTTP_NO_CONTENT);
    }
}
