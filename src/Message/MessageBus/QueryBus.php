<?php

namespace Kangourouge\MessengerBundle\Message\MessageBus;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class QueryBus
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class QueryBus
{
    use HandleTrait;

    /**
     * @param MessageBusInterface $queryBus
     */
    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    /**
     * @param object|Envelope $query
     *
     * @return array
     */
    public function dispatch($query): array
    {
        return $this->handle($query);
    }
}
