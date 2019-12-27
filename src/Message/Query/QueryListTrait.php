<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

/**
 * Trait QueryListTrait
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
trait QueryListTrait
{
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->getQueryParameters()['filters'] ?? [];
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->getQueryParameters()['page'] ?? 1;
    }

    /**
     * @return int
     */
    public function getRowPerPage(): int
    {
        return $this->getQueryParameters()['rowPerPage'] ?? 20;
    }

    /**
     * @return array
     */
    public function getSort(): array
    {
        return $this->getQueryParameters()['sort'] ?? [];
    }
}
