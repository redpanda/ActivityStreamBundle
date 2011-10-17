<?php
/*
 * 
 */

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable\Resolver;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;

/**
 * Resolves actor, target, and actionObject references from the ActionInterface
 * which are Doctrine ORM Entities
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */ 
class DoctrineEntityResolver implements ResolverInterface
{
    /**
     * @{inheritdoc}
     */
    public function supports(LifecycleEventArgs $eventArgs, $type)
    {
        try {
            $proxyClass = new \ReflectionClass($type);
            if ($proxyClass->implementsInterface('Doctrine\ORM\Proxy\Proxy')) {
                $type = $proxyClass->getParentClass()->getName();
            }

            $eventArgs->getEntityManager()->getClassMetadata($type);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @{inheritdoc}
     */
    public function resolve(LifecycleEventArgs $eventArgs, $type, $id)
    {
        return $eventArgs->getEntityManager()->getReference($type, $id);
    }

}
