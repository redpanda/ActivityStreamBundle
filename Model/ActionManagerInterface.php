<?php
namespace Bundle\ActivityStreamBundle\Model;

use FOS\UserBundle\Model\UserInterface;

interface ActionManagerInterface
{
    function createAction();
    
    function findStreamBy(array $criteria);
    
    function findStreamByActor($actor);
    
    function findStreamByTarget($target);
    
    function getClass();
}