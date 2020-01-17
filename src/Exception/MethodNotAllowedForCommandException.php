<?php

namespace Kangourouge\MessengerBundle\Exception;

/**
 * Class MethodNotAllowedForCommandException
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class MethodNotAllowedForCommandException extends \RuntimeException
{
    /**
     * @return self
     */
    public static function create(): self
    {
        return new self(sprintf('Command messages cannot be called by GET http request'));
    }
}
