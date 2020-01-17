<?php

namespace Kangourouge\MessengerBundle\Service;

use Kangourouge\MessengerBundle\Exception\InvalidResourceMessageException;
use Kangourouge\MessengerBundle\Message\MessageInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Interface MessageResourceValidatorInterface
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
interface MessageResourceValidatorInterface
{
    /**
     * @param MessageInterface $message
     *
     * @throws NotFoundHttpException
     * @throws BadRequestHttpException
     * @throws InvalidResourceMessageException
     */
    public function validate(MessageInterface $message): void;
}
