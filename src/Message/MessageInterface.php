<?php

namespace KRG\Bundle\MessengerBundle\Message;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface MessageInterface
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
interface MessageInterface
{
    /**
     * @return string
     */
    public function getMessageName(): string;

    /**
     * @return array
     */
    public function getPayload(): array;

    /**
     * @return array
     */
    public function getPathParameters(): array;

    /**
     * @return string|null
     */
    public function getRepositoryInterface(): ?string;

    /**
     * @return string|null
     */
    public function getRepositoryMethod(): ?string;

    /**
     * @return string|null
     */
    public function getValidationName(): ?string;

    /**
     * @return null|string[]
     */
    public function getValidationGroups(): ?array;

    /**
     * @return UuidInterface|null
     */
    public function getUser(): ?UuidInterface;

    /**
     * @param string $user
     */
    public function setUser(string $user): void;
}
