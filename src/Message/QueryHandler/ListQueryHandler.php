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
     * @param ListQuery $query
     *
     * @return array
     */
    public function __invoke(ListQuery $query): array
    {
        return $this
            ->generateRepository($query)
            ->addParameter($query->getFilters())
            ->addParameter($query->getPage())
            ->addParameter($query->getRowPerPage())
            ->addParameter($query->getSort())
            ->getResult()
        ;
    }
}
