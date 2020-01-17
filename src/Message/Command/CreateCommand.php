<?php

namespace Kangourouge\MessengerBundle\Message\Command;

use Kangourouge\MessengerBundle\Message\AbstractMessage;

/**
 * Class CreateCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class CreateCommand extends AbstractMessage
{
    const TYPE = 'command';
}
