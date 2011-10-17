<?php

namespace Redpanda\Bundle\ActivityStreamBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Registers Resolver implementations.
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class ResolverPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('activity_stream.resolver.chain')) {
            return;
        }

        $chain = $container->getDefinition('activity_stream.resolver.chain');
        foreach ($container->findTaggedServiceIds('activity_stream.resolver') as $id => $attr) {
            $chain->addMethodCall('addResolver', array(new Reference($id)));
        }
    }
}
