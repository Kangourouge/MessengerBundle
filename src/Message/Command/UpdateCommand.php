<?php

namespace Kangourouge\MessengerBundle\Message\Command;

use Kangourouge\MessengerBundle\Message\AbstractMessage;

/**
 * Class UpdateCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class UpdateCommand extends AbstractMessage
{
    const TYPE = 'command';
}
