<?php

namespace Kangourouge\MessengerBundle\Message;

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
     * @return string
     */
    public function getMessageType(): string;

    /**
     * @return array
     */
    public function getPayload(): array;

    /**
     * @return array
     */
    public function getPathParameters(): ?array;

    /**
     * @return array
     */
    public function getContent(): ?array;

    /**
     * @return array
     */
    public function getQueryParameters(): ?array;

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
     * @return string|null
     */
    public function getUserId(): ?string;

    /**
     * @return string
     */
    public function getEntityClass(): ?string;

    /**
     * @return bool
     */
    public function isLogged(): bool;

    /**
     * @return bool
     */
    public function isDenormalized(): bool;

    /**
     * @return null|string
     */
    public function getEntityId(): ?string;

    /**
     * @param bool $denormalized
     *
     * @return self
     */
    public function setDenormalized(bool $denormalized): self;

    /**
     * @param bool $logged
     *
     * @return self
     */
    public function setLogged(bool $logged): self;

    /**
     * @param string $entityClass
     *
     * @return self
     */
    public function setEntityClass(?string $entityClass): self;

    /**
     * @param string $repositoryMethod
     *
     * @return self
     */
    public function setRepositoryMethod(?string $repositoryMethod): self;

    /**
     * @param string $repositoryInterface
     *
     * @return self
     */
    public function setRepositoryInterface(?string $repositoryInterface): self;

    /**
     * @param array $validationGroups
     *
     * @return self
     */
    public function setValidationGroups(array $validationGroups): self;

    /**
     * @param string $userId
     *
     * @return self
     */
    public function setUserId(?string $userId): self;

    /**
     * @param string $validationName
     *
     * @return self
     */
    public function setValidationName(?string $validationName): self;

    /**
     * @param array $payload
     *
     * @return self
     */
    public function setPayload(array $payload): self;

    /**
     * @param string $entityId
     *
     * @return self
     */
    public function setEntityId(string $entityId): self;
}
