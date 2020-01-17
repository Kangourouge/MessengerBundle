<?php

namespace Kangourouge\MessengerBundle\Message\Query;

use Kangourouge\MessengerBundle\Message\AbstractMessage;

/**
 * Class ListByEntityQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListByEntityQuery extends AbstractMessage
{
    use QueryListTrait;

    const TYPE = 'query';
}
