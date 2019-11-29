<?php

namespace KRG\Bundle\MessengerBundle;

use KRG\Bundle\MessengerBundle\DependencyInjection\Compiler\RegistryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MessengerBundle
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class MessengerBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RegistryCompilerPass());
    }
}
