<?php

namespace Redpanda\Bundle\ActivityStreamBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class RedpandaActivityStreamExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        // ensure the db_driver is configured
        if (!isset($config['db_driver'])) {
            throw new \InvalidArgumentException('The db_driver parameter must be defined.');
        }

        // Load action target, actor, and actionObject resolvers
        $loader->load('resolver.xml');

        if (isset($config['db_driver'])){
            if (!in_array(strtolower($config['db_driver']), array('orm', 'mongodb'))) {
                throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
            }
            $loader->load(sprintf('%s.xml', $config['db_driver']));
        }

        $loader->load('twig.xml');
    }
}
