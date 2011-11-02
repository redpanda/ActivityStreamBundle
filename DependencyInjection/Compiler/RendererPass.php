<?php

namespace Redpanda\Bundle\ActivityStreamBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Registers Renderer implementations.
 *
 * @author Jimmy Leger <jimmy.leger@gmail.com>
 */
class RendererPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('activity_stream.renderer_provider')) {
            return;
        }

        $provider = $container->getDefinition('activity_stream.renderer_provider');
        foreach ($container->findTaggedServiceIds('activity_stream.renderer') as $id => $attr) {
            $provider->addMethodCall('addRenderer', array(new Reference($id)));
        }
    }
}
