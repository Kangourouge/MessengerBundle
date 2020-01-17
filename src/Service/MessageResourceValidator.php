<?php

namespace Kangourouge\MessengerBundle\Service;

use Doctrine\DBAL\Types\ConversionException;
use Doctrine\ORM\EntityManagerInterface;
use Kangourouge\MessengerBundle\Exception\InvalidResourceMessageException;
use Kangourouge\MessengerBundle\Message\MessageInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MessageResourceValidator
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class MessageResourceValidator implements MessageResourceValidatorInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /** {@inheritdoc} */
    public function validate(MessageInterface $message): void
    {
        $id = $message->getPathParameters()['id'] ?? null;

        if (null === $message->getEntityClass()) {
            throw new InvalidResourceMessageException('Entity FQCN must be set for resource validation.');
        }

        if (null === $id) {
            throw new InvalidResourceMessageException('Entity Id must be present in path for resource validation.');
        }

        try {
            $resource = $this->entityManager->find($message->getEntityClass(), $id);
        } catch (ConversionException $exception) {
            throw new BadRequestHttpException('Id type invalid.');
        }

        if (null === $resource) {
            throw new NotFoundHttpException(sprintf('Resource with id #%s not found.', $id));
        }
    }
}
