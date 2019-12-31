<?php

namespace KRG\Bundle\MessengerBundle\Message;

/**
 * Class AbstractMessage
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
abstract class AbstractMessage implements MessageInterface
{
    use PayloadTrait;

    const TYPE = 'message';

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
    protected $userId;

    /** @var null|string */
    protected $entityClass;

    /** @var null|string */
    protected $entityId;

    /** @var bool */
    protected $logged;

    /** @var bool */
    protected $denormalized;

    /**
     * @param string $messageName
     */
    public function __construct(string $messageName)
    {
        $this->messageName = $messageName;
    }

    /** {@inheritdoc} */
    public function getPayload(): array
    {
        return $this->payload[$this->validationName] ?? $this->payload;
    }

    /** {@inheritdoc} */
    public function getPathParameters(): ?array
    {
        return $this->get('pathParameters') ?? null;
    }

    /** {@inheritdoc} */
    public function getQueryParameters(): ?array
    {
        return $this->get('queryParameters') ?? null;
    }

    /** {@inheritdoc} */
    public function getContent(): ?array
    {
        return $this->get('content') ?? null;
    }

    /** {@inheritdoc} */
    public function getMessageName(): string
    {
        return $this->messageName;
    }

    /** {@inheritdoc} */
    public function getMessageType(): string
    {
        return self::TYPE;
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
    public function getValidationGroups(): array
    {
        return $this->validationGroups;
    }

    /** {@inheritdoc} */
    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }

    /** {@inheritdoc} */
    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    /** {@inheritdoc} */
    public function isDenormalized(): bool
    {
        return $this->denormalized;
    }

    /** {@inheritdoc} */
    public function isLogged(): bool
    {
        return $this->logged;
    }

    /** {@inheritdoc} */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * Abstract validationName payload.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->payload[$this->validationName][$key] ?? $this->payload[$key];
    }

    /** {@inheritdoc} */
    public function setValidationName(?string $validationName): MessageInterface
    {
        $this->validationName = $validationName;

        return $this;
    }

    /** {@inheritdoc} */
    public function setValidationGroups(array $validationGroups): MessageInterface
    {
        $this->validationGroups = $validationGroups;

        return $this;
    }

    /** {@inheritdoc} */
    public function setRepositoryInterface(?string $repositoryInterface): MessageInterface
    {
        $this->repositoryInterface = $repositoryInterface;

        return $this;
    }

    /** {@inheritdoc} */
    public function setRepositoryMethod(?string $repositoryMethod): MessageInterface
    {
        $this->repositoryMethod = $repositoryMethod;

        return $this;
    }

    /** {@inheritdoc} */
    public function setEntityClass(?string $entityClass): MessageInterface
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    /** {@inheritdoc} */
    public function setLogged(bool $logged): MessageInterface
    {
        $this->logged = $logged;

        return $this;
    }

    /** {@inheritdoc} */
    public function setDenormalized(bool $denormalized): MessageInterface
    {
        $this->denormalized = $denormalized;

        return $this;
    }

    /** {@inheritdoc} */
    public function setUserId(?string $userId): MessageInterface
    {
        $this->userId = $userId;

        return $this;
    }

    /** {@inheritdoc} */
    public function setEntityId(string $entityId): MessageInterface
    {
        $this->entityId = $entityId;

        return $this;
    }
}
