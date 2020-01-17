<?php

namespace Kangourouge\MessengerBundle\Service;

use Kangourouge\MessengerBundle\Message\MessageInterface;

/**
 * Interface MessageLoggerInterface
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
interface MessageLoggerInterface
{
    /**
     * Set Message userId with logged user.
     *
     * @param MessageInterface $message
     */
    public function log(MessageInterface &$message): void;
}
