<?php

namespace Kangourouge\MessengerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('Kangourouge_messenger');
        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('repository_domain')->defaultValue('Domain\Repository')->end()
            ->scalarNode('entity_domain')->defaultValue('Domain\Model')->end()
            ->scalarNode('route_prefix')->defaultValue('api/')->end()
            ->variableNode('other_parameters')->end()
            ->arrayNode('entities')
            ->arrayPrototype()
            ->children()
            ->scalarNode('name')->end()
            ->scalarNode('entity_class')->defaultNull()->end()
            ->scalarNode('repository_interface')->defaultNull()->end()
            ->scalarNode('validation_name')->defaultNull()->end()
            ->arrayNode('validation_groups')->end()
            ->booleanNode('is_denormalized')->defaultNull()->end()
            ->booleanNode('is_logged')->defaultNull()->end()
            ->arrayNode('other_parameters')->end()
            ->arrayNode('actions')
            ->arrayPrototype()
            ->children()
            ->scalarNode('name')->end()
            ->scalarNode('method')->defaultNull()->end()
            ->scalarNode('path')->defaultNull()->end()
            ->scalarNode('controller')->defaultNull()->end()
            ->scalarNode('entity_class')->defaultNull()->end()
            ->scalarNode('repository_interface')->defaultNull()->end()
            ->scalarNode('repository_method')->defaultNull()->end()
            ->scalarNode('validation_name')->defaultNull()->end()
            ->arrayNode('validation_groups')->end()
            ->booleanNode('is_denormalized')->defaultNull()->end()
            ->booleanNode('is_logged')->defaultNull()->end()
            ->arrayNode('other_parameters')->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->arrayNode('pagination')
            ->children()
            ->scalarNode('page')
            ->defaultValue('1')
            ->end()
            ->scalarNode('rows_per_page')
            ->defaultValue('10')
            ->end()
            ->end()
            ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
