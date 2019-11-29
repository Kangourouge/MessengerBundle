<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class AbstractCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
abstract class AbstractCommand extends AbstractMessage implements CommandInterface
{
    /** @var string|null */
    protected $entityClass;

    /**
     * @param string      $messageName
     * @param array       $pathParameters
     * @param array       $content
     * @param null|string $repositoryInterface
     * @param null|string $repositoryMethod
     * @param null|string $validationName
     * @param array|null  $validationGroups
     * @param null|string $entityClass
     */
    public function __construct(string $messageName, array $pathParameters, array $content, ?string $repositoryInterface, ?string $repositoryMethod, ?string $validationName, ?array $validationGroups, ?string $entityClass)
    {
        $this->messageName = $messageName;
        $this->validationName = $validationName ?? 'default';
        $this->entityClass = $entityClass;
        $this->validationGroups = $validationGroups;
        $this->repositoryInterface = $repositoryInterface;
        $this->repositoryMethod = $repositoryMethod;
        $this->payload = [
            $this->validationName => [
                'pathParameters' => $pathParameters,
                'content' => $content,
            ],
        ];
    }

    /** {@inheritdoc} */
    public static function create(string $messageName, array $pathParameters, array $content, ?string $repositoryInterface, ?string $repositoryMethod, ?string $validationName, ?array $validationGroups, ?string $entityClass): CommandInterface
    {
        return new static($messageName, $pathParameters, $content, $repositoryInterface, $repositoryMethod, $validationName, $validationGroups, $entityClass);
    }

    /** {@inheritdoc} */
    public function getContent(): array
    {
        return $this->get('content');
    }

    /** {@inheritdoc} */
    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }
}
