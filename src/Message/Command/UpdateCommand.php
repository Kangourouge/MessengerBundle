<?php

namespace KRG\Bundle\MessengerBundle\Message\Command;

use KRG\Bundle\MessengerBundle\Message\AbstractMessage;

/**
 * Class UpdateCommand
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class UpdateCommand extends AbstractMessage
{
    const TYPE = 'command';
}
