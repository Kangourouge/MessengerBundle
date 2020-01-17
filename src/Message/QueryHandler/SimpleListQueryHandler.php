<?php

namespace Kangourouge\MessengerBundle\Message\QueryHandler;

use Kangourouge\MessengerBundle\Message\MessageRepositoryTrait;
use Kangourouge\MessengerBundle\Message\Query\SimpleListQuery;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class SimpleListQueryHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class SimpleListQueryHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param SimpleListQuery $query
     *
     * @return array
     */
    public function __invoke(SimpleListQuery $query): array
    {
        return $this
            ->generateRepository($query)
            ->getResult()
        ;
    }
}
