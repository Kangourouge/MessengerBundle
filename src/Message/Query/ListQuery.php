<?php

namespace Kangourouge\MessengerBundle\Message\Query;

use Kangourouge\MessengerBundle\Message\AbstractMessage;

/**
 * Class ListQuery
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ListQuery extends AbstractMessage
{
    use QueryListTrait;
}
