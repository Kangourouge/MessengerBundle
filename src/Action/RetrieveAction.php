<?php

namespace Kangourouge\MessengerBundle\Action;

use Kangourouge\MessengerBundle\Message\MessageBus\QueryBus;
use Kangourouge\MessengerBundle\Message\Query\RetrieveQuery;
use Kangourouge\MessengerBundle\Service\MessageLoggerInterface;
use Kangourouge\MessengerBundle\Service\MessageResourceValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RetrieveAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class RetrieveAction
{
    /** @var QueryBus */
    private $queryBus;

    /** @var MessageLoggerInterface */
    private $messageLogger;

    /** @var MessageResourceValidatorInterface */
    private $messageResourceValidator;

    /**
     * @param QueryBus                          $queryBus
     * @param MessageLoggerInterface            $messageLogger
     * @param MessageResourceValidatorInterface $messageResourceValidator
     */
    public function __construct(QueryBus $queryBus, MessageLoggerInterface $messageLogger, MessageResourceValidatorInterface $messageResourceValidator)
    {
        $this->queryBus = $queryBus;
        $this->messageLogger = $messageLogger;
        $this->messageResourceValidator = $messageResourceValidator;
    }

    /**
     * @param RetrieveQuery $query
     *
     * @return JsonResponse
     */
    public function __invoke(RetrieveQuery $query): JsonResponse
    {
        if ($query->isLogged()) {
            $this->messageLogger->log($query);
        }

        $this->messageResourceValidator->validate($query);

        return JsonResponse::create($this->queryBus->dispatch($query));
    }
}
