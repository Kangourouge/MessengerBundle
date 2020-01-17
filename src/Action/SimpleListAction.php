<?php

namespace Kangourouge\MessengerBundle\Action;

use Kangourouge\MessengerBundle\Message\MessageBus\QueryBus;
use Kangourouge\MessengerBundle\Message\Query\SimpleListQuery;
use Kangourouge\MessengerBundle\Service\MessageLoggerInterface;
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
