<?php

namespace Kangourouge\MessengerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class MessengerExtension
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class KangourougeMessengerExtension extends ConfigurableExtension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function loadInternal(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        $apiRouterDefinition = $container->getDefinition('Kangourouge\MessengerBundle\Routing\ApiRouteLoader');
        $apiRouterDefinition->replaceArgument(0, $configs);
    }
}
