<?php

namespace KRG\Bundle\MessengerBundle\Message\QueryHandler;

use KRG\Bundle\MessengerBundle\Message\MessageRepositoryTrait;
use KRG\Bundle\MessengerBundle\Message\Query\ListByEntityQuery;
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
            ->addParameter($query->getRowPerPage())
            ->addParameter($query->getSort())
            ->getResult()
        ;
    }
}
