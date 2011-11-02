<?php

namespace Redpanda\Bundle\ActivityStreamBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class defines the configuration information for the bundle
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('redpanda_activity_stream');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('db_driver')->defaultValue('orm')->end()
                ->arrayNode('renderer')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default_class')->defaultValue('Redpanda\Bundle\ActivityStreamBundle\Streamable\Renderer\DefaultRenderer')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
