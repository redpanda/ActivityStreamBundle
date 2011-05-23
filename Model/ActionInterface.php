<?php
namespace Bundle\ActivityStreamBundle\Model;

use FOS\UserBundle\Model\UserInterface;

interface ActionInterface
{
    function getId();

    function getActorId();

    function getActorType();

    function getActor();

    function getVerb();

    function getTargetId();

    function getTargetType();
    
    function getTarget();
    
    function getActionObjectid();
    
    function getActionObjectType();
    
    function getActionObject();

    function setActorId($arctorId);

    function setActorType($actorType);

    function setActor($actor);

    function setVerb($verb);

    function setTargetId($targetId);

    function setTargetType($targetType);
    
    function setTarget($target);
    
    function setActionObjectId($actionObjectId);
    
    function setActionObjectType($actionOjectType);
    
    function setActionObject($actionObject);
}