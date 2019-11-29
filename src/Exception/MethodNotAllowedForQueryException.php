<?php

namespace KRG\Bundle\MessengerBundle\Exception;

/**
 * Class MethodNotAllowedForQueryException
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class MethodNotAllowedForQueryException extends \RuntimeException
{
    /**
     * @param string $httpMethod
     *
     * @return self
     */
    public static function create(string $httpMethod): self
    {
        return new self(sprintf('Query messages should be call only by GET http request. %s use.', ($httpMethod)));
    }
}
