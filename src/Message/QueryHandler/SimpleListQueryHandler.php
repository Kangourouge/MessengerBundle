<?php

namespace KRG\Bundle\MessengerBundle\Message\QueryHandler;

use KRG\Bundle\MessengerBundle\Message\MessageRepositoryTrait;
use KRG\Bundle\MessengerBundle\Message\Query\SimpleListQuery;
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
     * @param SimpleListQuery $simpleListQuery
     *
     * @return array
     */
    public function __invoke(SimpleListQuery $simpleListQuery): array
    {
        return $this
            ->generateRepository($simpleListQuery)
            ->getResult()
        ;
    }
}
