<?php

namespace Kangourouge\MessengerBundle\Message\QueryHandler;

use Kangourouge\MessengerBundle\Message\MessageRepositoryTrait;
use Kangourouge\MessengerBundle\Message\Query\ListByEntityQuery;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class ListByEntityQueryHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListByEntityQueryHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param ListByEntityQuery $query
     *
     * @return array
     */
    public function __invoke(ListByEntityQuery $query): array
    {
        return $this
            ->generateRepository($query)
            ->addParameter($query->getPathParameters()['id'])
            ->addParameter($query->getFilters())
            ->addParameter($query->getPage())
            ->addParameter($query->getRowsPerPage())
            ->addParameter($query->getSort())
            ->getResult()
        ;
    }
}
