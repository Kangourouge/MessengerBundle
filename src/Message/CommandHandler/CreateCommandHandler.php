<?php

namespace KRG\Bundle\MessengerBundle\Message\CommandHandler;

use KRG\Bundle\MessengerBundle\Message\Command\CreateCommand;
use KRG\Bundle\MessengerBundle\Message\MessageRepositoryTrait;
use KRG\Bundle\MessengerBundle\Registry\RepositoryRegistry;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class CreateCommandHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class CreateCommandHandler implements MessageHandlerInterface
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
     * @param CreateCommand $createCommand
     */
    public function __invoke(CreateCommand $createCommand): void
    {
        $content = $createCommand->getContent();

        if (null !== $createCommand->getEntityClass()) {
            $entity = $this->denormalizer->denormalize($content, $createCommand->getEntityClass());
        }

        $this
            ->generateRepository($createCommand)
            ->addParameter($createCommand->getId())
            ->addParameter($entity ?? $content)
            ->execute()
        ;
    }
}
