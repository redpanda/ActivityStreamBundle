<?php

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable\Renderer;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;
use Redpanda\Bundle\ActivityStreamBundle\Streamable\Renderer\Renderer;

/**
 * Defaul renderer for the actions
 *
 * @author Jimmy Leger <jimmy.leger@gmail.com>
 */
class DefaultRenderer extends Renderer
{
    public function getActorUrl()
    {
        return null;
    }

    public function getTargetUrl()
    {
        return null;
    }
    
    public function getActionObjectUrl()
    {
        return null;
    }
    
    public function getTemplate()
    {
        return 'RedpandaActivityStreamBundle:Action:action.html.twig';
    }
    
    public function supports(ActionInterface $action)
    {
        return true;
    }
}
