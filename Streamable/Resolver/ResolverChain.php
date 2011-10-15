<?php
/*
 * 
 */

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable\Resolver;

use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Builds a chain of known resolvers
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */ 
class ResolverChain implements ResolverInterface
{
    /**
     * @var ResolverInterface[]
     */
    protected $resolvers;

    /**
     * @param array $resolvers
     */
    public function setResolvers($resolvers)
    {
        $this->resolvers = $resolvers;
    }

    /**
     * @param ResolverInterface $resolver
     */
    public function addResolver(ResolverInterface $resolver)
    {
        $this->resolvers[] = $resolver;
    }

    /**
     * @return ResolverInterface[]
     */
    public function getResolvers()
    {
        return $this->resolvers;
    }

    /**
     * @{inheritdoc}
     */
    public function supports(LifecycleEventArgs $eventArgs, $type)
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->supports($eventArgs, $type)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @{inheritdoc}
     */
    public function resolve(LifecycleEventArgs $eventArgs, $type, $id)
    {
        foreach ($this->resolvers as $resolver) {
            if ($this->supports($eventArgs, $type)) {
                return $resolver->resolve($eventArgs, $type, $id);
            }
        }

        return null;
    }
}
