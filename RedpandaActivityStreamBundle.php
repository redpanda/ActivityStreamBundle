<?php

namespace Redpanda\Bundle\ActivityStreamBundle;

use Redpanda\Bundle\ActivityStreamBundle\Doctrine\Event\ActionSubscriber;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Redpanda\Bundle\ActivityStreamBundle\DependencyInjection\Compiler\ResolverPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RedpandaActivityStreamBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ResolverPass());
    }
}
