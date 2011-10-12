<?php
namespace Redpanda\Bundle\ActivityStreamBundle\Model;

/**
 * Action model describing the actor acting out a verb (on an optional target). 
 * Nomenclature based on http://martin.atkins.me.uk/specs/activitystreams/atomactivity
 *   
 * Generalized Format:
 *   
 *   <actor> <verb> <time>
 *   <actor> <verb> <target> <time>
 *   <actor> <verb> <action_object> <target> <time>
 *   
 * Examples:
 *   
 *   <justquick> <reached level 60> <1 minute ago>
 *   <brosner> <commented on> <pinax/pinax> <2 hours ago>
 *   <washingtontimes> <started follow> <justquick> <8 minutes ago>
 *   <mitsuhiko> <closed> <issue 70> on <mitsuhiko/flask> <about 3 hours ago>
 *       
 * __toString() Representation:
 *   
 *   justquick reached level 60 1 minute ago
 *   mitsuhiko closed issue 70 on mitsuhiko/flask 3 hours ago
 *       
 * HTML Representation::
 *   
 *   <a href="http://oebfare.com/">brosner</a> commented on <a href="http://github.com/pinax/pinax">pinax/pinax</a> 2 hours ago
 */

use DateTime;

abstract class Action implements ActionInterface
{
    protected $id;
    protected $actorId;
    protected $actorType;
    protected $actor;
    protected $verb;
    protected $targetId;
    protected $targetType;
    protected $target;
    protected $actionObjectId;
    protected $actionObjectType;
    protected $actionObject;
    
    /**
     * @var datetime
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getActorId()
    {
        return $this->actorId;
    }

    public function getActorType()
    {
        return $this->actorType;
    }

    public function getActor()
    {
        return $this->actor;
    }

    public function getVerb()
    {
        return $this->verb;
    }

    public function getTargetId()
    {
        return $this->targetId;
    }

    public function getTargetType()
    {
        return $this->targetType;
    }
    
    public function getTarget()
    {
        return $this->target;
    }
    
    public function getActionObjectid()
    {
        return $this->actionObjectId;
    }
    
    public function getActionObjectType()
    {
        return $this->actionObjectType;
    }
    
    public function getActionObject()
    {
        return $this->actionObject;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setActorId($actorId)
    {
        $this->actorId = $actorId;
    }

    public function setActorType($actorType)
    {
        $this->actorType = $actorType;
    }

    public function setActor($actor)
    {
        $this->actorId = $actor->getId();
        $this->actorType = get_class($actor);
        $this->actor = $actor;
    }

    public function setVerb($verb)
    {
        $this->verb = $verb;
    }

    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;
    }

    public function setTargetType($targetType)
    {
        $this->targetType = $targetType;
    }
    
    public function setTarget($target)
    {
        $this->targetId = $target->getId();
        $this->targetType = get_class($target);
        $this->target = $target;
    }
    
    public function setActionObjectId($actionObjectId)
    {
        $this->actionObjectId = $actionObjectId;
    }
    
    public function setActionObjectType($actionObjectType)
    {
        $this->actionObjectType = $actionObjectType;
    }
    
    public function setActionObject($actionObject)
    {
        $this->actionObjectId = $actionObject->getId();
        $this->actionObjectType = get_class($actionObject);
        $this->actionObject = $actionObject;
    }
    
    public function setCreatedAt(\Datetime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
    
    public function hasTarget()
    {
        return (bool) $this->getTarget();
    }

    public function hasActionObject()
    {
        return (bool) $this->getActionObject();
    }
    
    public function __toString()
    {   
        if ($this->hasTarget()) {
            if ($this->hasActionObject()) {
                return sprintf('%s %s %s on %s %s', $this->getActor(), $this->getVerb(), $this->getActionObject(), $this->getTarget(), $this->getCreatedAt());
            }
            else {
                return sprintf('%s %s %s', $this->getActor(), $this->getVerb(), $this->getTarget() , $this->getCreatedAt());
            }
        }
        return sprintf('%s %s %s', $this->getActor(), $this->getVerb(), $this->getCreatedAt());
    }
}
