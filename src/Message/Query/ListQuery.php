<?php

namespace KRG\Bundle\MessengerBundle\Message\Query;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class ListQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListQuery extends AbstractMessage
{
    use QueryListTrait;
}
