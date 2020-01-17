<?php

namespace Kangourouge\MessengerBundle\Message\Command;

use Kangourouge\MessengerBundle\Message\AbstractMessage;

/**
 * Class PatchCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class PatchCommand extends AbstractMessage
{
    const TYPE = 'command';
}
