<?php

namespace KRG\Bundle\MessengerBundle\Message;

/**
 * Trait PayloadTrait
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
trait PayloadTrait
{
    /** @var array */
    protected $payload;

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->getPayload();
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->payload[$key];
    }
}
