<?php

namespace KRG\Bundle\MessengerBundle\Action;

use KRG\Bundle\MessengerBundle\Message\MessageBus\QueryBus;
use KRG\Bundle\MessengerBundle\Message\Query\ListByEntityQuery;
use KRG\Bundle\MessengerBundle\Service\MessageLoggerInterface;
use KRG\Bundle\MessengerBundle\Service\MessageResourceValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ListByEntityAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListByEntityAction
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
     * @param ListByEntityQuery $query
     *
     * @return JsonResponse
     */
    public function __invoke(ListByEntityQuery $query): JsonResponse
    {
        if ($query->isLogged()) {
            $this->messageLogger->log($query);
        }

        $this->messageResourceValidator->validate($query);

        return JsonResponse::create($this->queryBus->dispatch($query));
    }
}
