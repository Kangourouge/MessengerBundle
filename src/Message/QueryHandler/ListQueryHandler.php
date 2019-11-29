<?php

namespace KRG\Bundle\MessengerBundle\Message\QueryHandler;

use KRG\Bundle\MessengerBundle\Message\MessageRepositoryTrait;
use KRG\Bundle\MessengerBundle\Message\Query\ListQuery;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class ListQueryHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListQueryHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param ListQuery $listQuery
     *
     * @return array
     */
    public function __invoke(ListQuery $listQuery): array
    {
        return $this
            ->generateRepository($listQuery)
            ->addParameter($listQuery->getFilters())
            ->addParameter($listQuery->getPage())
            ->addParameter($listQuery->getRowPerPage())
            ->addParameter($listQuery->getSort())
            ->getResult()
        ;
    }
}
