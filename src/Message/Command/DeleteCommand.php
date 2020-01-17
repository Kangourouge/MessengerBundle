<?php

namespace Kangourouge\MessengerBundle\Message\Command;

use Kangourouge\MessengerBundle\Message\AbstractMessage;

/**
 * Class DeleteCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class DeleteCommand extends AbstractMessage
{
    const TYPE = 'command';
}
