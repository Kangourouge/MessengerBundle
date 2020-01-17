<?php

namespace Kangourouge\MessengerBundle;

use Kangourouge\MessengerBundle\DependencyInjection\Compiler\RegistryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MessengerBundle
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class KangourougeMessengerBundle extends Bundle
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
