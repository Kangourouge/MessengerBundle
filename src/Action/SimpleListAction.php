<?php

namespace KRG\Bundle\MessengerBundle\Action;

use KRG\Bundle\MessengerBundle\Message\MessageBus\QueryBus;
use KRG\Bundle\MessengerBundle\Message\Query\SimpleListQuery;
use KRG\Bundle\MessengerBundle\Service\MessageLoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class SimpleListAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class SimpleListAction
{
    /** @var QueryBus */
    private $queryBus;

    /** @var MessageLoggerInterface */
    private $messageLogger;

    /**
     * @param QueryBus               $queryBus
     * @param MessageLoggerInterface $messageLogger
     */
    public function __construct(QueryBus $queryBus, MessageLoggerInterface $messageLogger)
    {
        $this->queryBus = $queryBus;
        $this->messageLogger = $messageLogger;
    }

    /**
     * @param SimpleListQuery $query
     *
     * @return JsonResponse
     */
    public function __invoke(SimpleListQuery $query): JsonResponse
    {
        if ($query->isLogged()) {
            $this->messageLogger->log($query);
        }

        return JsonResponse::create($this->queryBus->dispatch($query));
    }
}
