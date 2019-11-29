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
     * @param ListByEntityQuery $listByEntityQuery
     *
     * @return array
     */
    public function __invoke(ListByEntityQuery $listByEntityQuery): array
    {
        return $this
            ->generateRepository($listByEntityQuery)
            ->addParameter($listByEntityQuery->getId())
            ->addParameter($listByEntityQuery->getFilters())
            ->addParameter($listByEntityQuery->getPage())
            ->addParameter($listByEntityQuery->getRowPerPage())
            ->addParameter($listByEntityQuery->getSort())
            ->getResult()
        ;
    }
}
