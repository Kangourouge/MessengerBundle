<?php

namespace Kangourouge\MessengerBundle\Message\CommandHandler;

use Kangourouge\MessengerBundle\Message\Command\UpdateCommand;
use Kangourouge\MessengerBundle\Message\MessageRepositoryTrait;
use Kangourouge\MessengerBundle\Registry\RepositoryRegistry;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class UpdateCommandHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class UpdateCommandHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /** @var DenormalizerInterface */
    private $denormalizer;

    /**
     * @param RepositoryRegistry    $repositoryRegistry
     * @param DenormalizerInterface $denormalizer
     */
    public function __construct(RepositoryRegistry $repositoryRegistry, DenormalizerInterface $denormalizer)
    {
        $this->repositoryRegistry = $repositoryRegistry;
        $this->denormalizer = $denormalizer;
    }

    /**
     * @param UpdateCommand $command
     *
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function __invoke(UpdateCommand $command): void
    {
        $content = $command->getContent();

        if ($command->isDenormalized()) {
            $entity = $this->denormalizer->denormalize($content, $command->getEntityClass());
        }

        $this
            ->generateRepository($command)
            ->addParameter($command->getPathParameters()['id'])
            ->addParameter($entity ?? $content)
            ->execute()
        ;
    }
}
