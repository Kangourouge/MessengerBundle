<?php

namespace Kangourouge\MessengerBundle\Message\QueryHandler;

use Kangourouge\MessengerBundle\Message\MessageRepositoryTrait;
use Kangourouge\MessengerBundle\Message\Query\RetrieveQuery;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class RetrieveQueryHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class RetrieveQueryHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /**
     * @param RetrieveQuery $query
     *
     * @return array
     */
    public function __invoke(RetrieveQuery $query): array
    {
        return $this
            ->generateRepository($query)
            ->addParameter($query->getPathParameters()['id'])
            ->getResult()
        ;
    }
}
