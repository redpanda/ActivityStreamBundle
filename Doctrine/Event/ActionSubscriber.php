<?php
namespace Redpanda\Bundle\ActivityStreamBundle\Doctrine\Event;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionManagerInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ActionSubscriber
{
    public function postLoad(LifecycleEventArgs $eventArgs)
    {
        $action = $eventArgs->getEntity();
        $className = get_class($action);
        $em = $eventArgs->getEntityManager();
        $metadata = $em->getClassMetadata($className);

        if ($metadata->reflClass->implementsInterface('Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface')) {
            $targetReflProp = $metadata->reflClass->getProperty('target');
            $targetReflProp->setAccessible(true);
            $targetReflProp->setValue(
                $action, $em->getReference($action->getTargetType(), $action->getTargetId())
            );

            $actorReflProp = $metadata->reflClass->getProperty('actor');
            $actorReflProp->setAccessible(true);
            $actorReflProp->setValue(
                $action, $em->getReference($action->getActorType(), $action->getActorId())
            );

            if (null !== $action->getActionObjectType()) {
                $actionObjReflProp = $metadata->reflClass->getProperty('actionObject');
                $actionObjReflProp->setAccessible(true);
                $actionObjReflProp->setValue(
                    $action, $em->getReference($action->getActionObjectType(), $action->getActionObjectId())
                );
            }
        }
    }
}
