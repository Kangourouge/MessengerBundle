<?php

namespace Kangourouge\MessengerBundle\DependencyInjection\Compiler;

use Kangourouge\MessengerBundle\Registry\RepositoryRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class RegistryCompilerPass
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class RegistryCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        $this->processRepositoryRegistry($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function processRepositoryRegistry(ContainerBuilder $container): void
    {
        $repositories = [];
        if (!$container->has(RepositoryRegistry::class)) {
            return;
        }

        $taggedServices = array_keys($container->findTaggedServiceIds('messenger_bundle.repository'));

        foreach ($taggedServices as $className) {
            foreach (class_implements($className) as $interface) {
                if (!isset($repositories[$interface])) {
                    $repositories[$interface] = $className;
                }
            }
        }

        $definition = $container->findDefinition(RepositoryRegistry::class);
        $definition->setArgument(1, $repositories);
    }
}
