<?php

namespace Kangourouge\MessengerBundle\Action;

use Kangourouge\MessengerBundle\Message\MessageBus\QueryBus;
use Kangourouge\MessengerBundle\Message\Query\ListByEntityQuery;
use Kangourouge\MessengerBundle\Service\MessageLoggerInterface;
use Kangourouge\MessengerBundle\Service\MessageResourceValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ListByReferenceAction
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListByReferenceAction
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

        $result = $this->queryBus->dispatch($query);
        $results = $result;

        if (!empty($result['results'])) {
            $results = $result['results'];
        }

        return JsonResponse::create($results, 200, ['X-total-result' => $result['totalResult'] ?? null]);
    }
}
