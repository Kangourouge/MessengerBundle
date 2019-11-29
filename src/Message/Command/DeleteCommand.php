<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class DeleteCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class DeleteCommand extends AbstractCommand
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->getPathParameters()['id']);
    }
}
