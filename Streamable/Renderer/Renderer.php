<?php

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable\Renderer;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;

/**
 * Renderer is the abstract class used by all built-in renderers.
 *
 * @author Jimmy Leger <jimmy.leger@gmail.com>
 */
abstract class Renderer implements RendererInterface
{
    protected $provider;
    protected $action;
    
    public function setProvider(RendererProvider $provider)
    {
        $this->provider = $provider;
    }
    
    public function getProvider()
    {
        return $this->provider;
    }
    
    function setAction(ActionInterface $action)
    {
        $this->action = $action;
    }
    
    public function getAction()
    {
        return $this->action;
    }
    
    public function getTemplateParams()
    {
        return array(
            'action'            => $this->getAction(),
            'target_url'        => $this->getTargetUrl(),
            'action_object_url' => $this->getActionObjectUrl(),
            'actor_url'         => $this->getActorUrl(),
        );
    }
}
