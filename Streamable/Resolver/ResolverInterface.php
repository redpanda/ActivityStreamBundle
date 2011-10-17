<?php
/*
 * 
 */

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable\Resolver;

use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Represents a resolver which can resolve an actor, target or actionObject
 * into its real representation from its type and id
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
interface ResolverInterface
{
    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     * @param string $type
     */
    public function supports(LifecycleEventArgs $eventArgs, $type);


    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     * @param string $type
     * @param mixed $id
     */
    public function resolve(LifecycleEventArgs $eventArgs, $type, $id);
}
