<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class PatchCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class PatchCommand extends AbstractMessage
{
    const TYPE = 'command';
}
