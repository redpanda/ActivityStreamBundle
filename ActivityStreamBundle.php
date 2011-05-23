<?php

namespace Bundle\ActivityStreamBundle;

use Bundle\ActivityStreamBundle\Doctrine\Event\ActionSubscriber;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ActivityStreamBundle extends Bundle
{
    public function boot()
    {
       try {
          $em = $this->container->get('doctrine.orm.entity_manager');
	  $em->getEventManager()->addEventListener(
	  	array(\Doctrine\ORM\Events::postLoad), new ActionSubscriber($em, $this->container->get('activity_stream.action_manager'))
	        );
        } catch (\InvalidArgumentException $e){
            throw new \InvalidArgumentException('You must provide a Doctrine ORM Entity Manager');
        }
    }
}
