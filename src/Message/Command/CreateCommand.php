<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class CreateCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class CreateCommand extends AbstractCommand
{
    /** @var string */
    private $id;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->id);
    }

    /**
     * @param UuidInterface $id
     */
    public function setId(UuidInterface $id): void
    {
        $this->id = $id->toString();
    }
}
