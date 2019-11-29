<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ListByEntityQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListByEntityQuery extends AbstractQuery
{
    use QueryListTrait;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->getPathParameters()['id']);
    }
}
