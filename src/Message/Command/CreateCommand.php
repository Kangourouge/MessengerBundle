<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class CreateCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class CreateCommand extends AbstractMessage
{
    const TYPE = 'command';
}
