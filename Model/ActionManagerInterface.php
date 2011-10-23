<?php
namespace Redpanda\Bundle\ActivityStreamBundle\Model;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;
use FOS\UserBundle\Model\UserInterface;

interface ActionManagerInterface
{
    function createAction();
    
    function findStreamBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
    
    function findStreamByActor($actor, array $orderBy = null, $limit = null, $offset = null);
    
    function findStreamByTarget($target, array $orderBy = null, $limit = null, $offset = null);

    function updateAction(ActionInterface $action);
    
    function getClass();
}