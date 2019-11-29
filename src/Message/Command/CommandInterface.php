<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

/**
 * Interface CommandInterface
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
interface CommandInterface
{
    /**
     * @param string      $messageName
     * @param array       $pathParameters
     * @param array       $content
     * @param null|string $repositoryInterface
     * @param null|string $repositoryMethod
     * @param null|string $validationName
     * @param array|null  $validationGroups
     * @param null|string $entityClass
     *
     * @return CommandInterface
     */
    public static function create(string $messageName, array $pathParameters, array $content, ?string $repositoryInterface, ?string $repositoryMethod, ?string $validationName, ?array $validationGroups, ?string $entityClass): CommandInterface;

    /**
     * @return array
     */
    public function getContent(): array;

    /**
     * @return null|string
     */
    public function getEntityClass(): ?string;
}
