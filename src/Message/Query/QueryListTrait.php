<?php

namespace Kangourouge\MessengerBundle\Message\Query;

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
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->getQueryParameters()['page'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getRowsPerPage(): ?int
    {
        return $this->getQueryParameters()['rowsPerPage'] ?? null;
    }

    /**
     * @return array
     */
    public function getSort(): array
    {
        return $this->getQueryParameters()['sort'] ?? [];
    }
}
