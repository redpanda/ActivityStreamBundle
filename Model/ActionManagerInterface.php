<?php
namespace Redpanda\Bundle\ActivityStreamBundle\Model;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;
use FOS\UserBundle\Model\UserInterface;

interface ActionManagerInterface
{
    function createAction();
    
    function findStreamBy(array $criteria);
    
    function findStreamByActor($actor);
    
    function findStreamByTarget($target);

    function updateAction(ActionInterface $action);
    
    function getClass();
}