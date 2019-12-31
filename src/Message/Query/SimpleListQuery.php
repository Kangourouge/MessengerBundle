<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class SimpleListQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class SimpleListQuery extends AbstractMessage
{
    const TYPE = 'query';
}
