<?php

namespace KRG\Bundle\MessengerBundle\Message;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class AbstractMessage
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
abstract class AbstractMessage implements MessageInterface
{
    use PayloadTrait;

    /** @var string */
    protected $messageName;

    /** @var null|string */
    protected $validationName;

    /** @var null|array */
    protected $validationGroups;

    /** @var null|string */
    protected $repositoryInterface;

    /** @var null|string */
    protected $repositoryMethod;

    /** @var string */
    protected $user;

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload[$this->validationName];
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->payload[$this->validationName][$key];
    }

    /** {@inheritdoc} */
    public function getPathParameters(): array
    {
        return $this->get('pathParameters');
    }

    /** {@inheritdoc} */
    public function getMessageName(): string
    {
        return $this->messageName;
    }

    /** {@inheritdoc} */
    public function getRepositoryInterface(): ?string
    {
        return $this->repositoryInterface;
    }

    /** {@inheritdoc} */
    public function getRepositoryMethod(): ?string
    {
        return $this->repositoryMethod;
    }

    /** {@inheritdoc} */
    public function getValidationName(): ?string
    {
        return $this->validationName;
    }

    /** {@inheritdoc} */
    public function getValidationGroups(): ?array
    {
        return $this->validationGroups;
    }

    /** {@inheritdoc} */
    public function getUser(): ?UuidInterface
    {
        return null === $this->user ? null : Uuid::fromString($this->user);
    }

    /** {@inheritdoc} */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }
}
