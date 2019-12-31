<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class RetrieveQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class RetrieveQuery extends AbstractMessage
{
    const TYPE = 'query';
}
