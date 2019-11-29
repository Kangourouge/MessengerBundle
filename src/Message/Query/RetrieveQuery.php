<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class RetrieveQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class RetrieveQuery extends AbstractQuery
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->getPathParameters()['id']);
    }
}
