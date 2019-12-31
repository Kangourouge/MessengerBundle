<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class DeleteCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class DeleteCommand extends AbstractMessage
{
    const TYPE = 'command';
}
