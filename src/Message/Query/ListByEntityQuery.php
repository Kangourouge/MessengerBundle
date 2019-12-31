<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

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
