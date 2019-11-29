<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use KRG\Bundle\MessengerBundle\Message\MessageInterface;

/**
 * Interface QueryInterface
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
interface QueryInterface extends MessageInterface
{
    /**
     * @param string      $messageName
     * @param array       $pathParameters
     * @param array       $queryParameters
     * @param string|null $repositoryInterface
     * @param string|null $repositoryMethod
     * @param string|null $validationName
     * @param array|null  $validationGroups
     *
     * @return QueryInterface
     */
    public static function create(string $messageName, array $pathParameters, array $queryParameters, ?string $repositoryInterface, ?string $repositoryMethod, ?string $validationName, ?array $validationGroups): QueryInterface;

    /**
     * @return array
     */
    public function getQueryParameters(): array;
}
