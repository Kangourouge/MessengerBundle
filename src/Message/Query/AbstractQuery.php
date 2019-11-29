<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class AbstractQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
abstract class AbstractQuery extends AbstractMessage implements QueryInterface
{
    /**
     * @param string      $messageName
     * @param array       $pathParameters
     * @param array       $queryParameters
     * @param string|null $repositoryInterface
     * @param string|null $repositoryMethod
     * @param string|null $validationName
     * @param array|null  $validationGroups
     */
    public function __construct(string $messageName, array $pathParameters, array $queryParameters, ?string $repositoryInterface, ?string $repositoryMethod, ?string $validationName, ?array $validationGroups)
    {
        $this->messageName = $messageName;
        $this->validationName = $validationName ?? 'default';
        $this->validationGroups = $validationGroups;
        $this->repositoryInterface = $repositoryInterface;
        $this->repositoryMethod = $repositoryMethod;
        $this->payload = [
            $this->validationName => [
                'pathParameters' => $pathParameters,
                'queryParameters' => $queryParameters,
            ],
        ];
    }

    /** {@inheritdoc} */
    public static function create(string $messageName, array $pathParameters, array $queryParameters, ?string $repositoryInterface, ?string $repositoryMethod, ?string $validationName, ?array $validationGroups): QueryInterface
    {
        return new static($messageName, $pathParameters, $queryParameters, $repositoryInterface, $repositoryMethod, $validationName, $validationGroups);
    }

    /** {@inheritdoc} */
    public function getQueryParameters(): array
    {
        return $this->get('queryParameters');
    }
}
