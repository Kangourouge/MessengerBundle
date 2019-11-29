<?php

namespace KRG\Bundle\MessengerBundle\Message\CommandHandler;

use KRG\Bundle\MessengerBundle\Message\Command\UpdateCommand;
use KRG\Bundle\MessengerBundle\Message\MessageRepositoryTrait;
use KRG\Bundle\MessengerBundle\Registry\RepositoryRegistry;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class UpdateCommandHandler
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class UpdateCommandHandler implements MessageHandlerInterface
{
    use MessageRepositoryTrait;

    /** @var DenormalizerInterface */
    protected $denormalizer;

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
     * @param UpdateCommand $updateCommand
     */
    public function __invoke(UpdateCommand $updateCommand): void
    {
        $content = $updateCommand->getContent();

        if (null !== $updateCommand->getEntityClass()) {
            $entity = $this->denormalizer->denormalize($content, $updateCommand->getEntityClass());
        }

        $this
            ->generateRepository($updateCommand)
            ->addParameter($updateCommand->getId())
            ->addParameter($entity ?? $content)
            ->execute()
        ;
    }
}
