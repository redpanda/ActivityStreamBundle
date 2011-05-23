<?php

namespace Bundle\ActivityStreamBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ActivityStreamExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        $config = array();
        foreach($configs as $c) {
            $config = array_merge($config, $c);
        }
        
        // ensure the db_driver is configured
        if (!isset($config['db_driver'])) {
            throw new \InvalidArgumentException('The db_driver parameter must be defined.');
        }

        if (isset($config['db_driver'])){
            if (!in_array(strtolower($config['db_driver']), array('orm', 'mongodb'))) {
                throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
            }
            $loader->load(sprintf('%s.xml', $config['db_driver']));
        }
        
        $loader->load('twig.xml');
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getXsdValidationBasePath()
     *
     * @codeCoverageIgnore
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getNamespace()
     *
     * @codeCoverageIgnore
     */
    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/activity_stream';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getAlias()
     *
     * @codeCoverageIgnore
     */
    public function getAlias()
    {
        return 'activity_stream';
    }
}
