<?php

namespace Kangourouge\MessengerBundle\Service;

use Kangourouge\MessengerBundle\Message\MessageInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class MessageLogger
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class MessageLogger implements MessageLoggerInterface
{
    /** @var Security */
    private $security;

    /**
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /** {@inheritdoc} */
    public function log(MessageInterface &$message): void
    {
        $user = $this->security->getUser();

        try {
            $message->setUserId(null === $user ? $user : $user->getId());
        } catch (\Exception $exception) {
            throw new \RuntimeException('User entity must be have getId() method.');
        }
    }
}
