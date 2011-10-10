<?php
namespace Redpanda\Bundle\ActivityStreamBundle\Doctrine\Event;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionManagerInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ActionSubscriber
{
    private $em;
    private $manager;

    public function __construct(EntityManager $em, ActionManagerInterface $manager)
    {
        $this->em = $em;
        $this->manager = $manager;
    }

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
                $action, $this->em->getReference($action->getTargetType(), $action->getTargetId())
            );
        }
    }
}
