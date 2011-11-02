<?php

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable\Renderer;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;


/**
 * Provides renderers for the actions
 *
 * @author Jimmy Leger <jimmy.leger@gmail.com>
 */
class RendererProvider
{
    protected $renderers;
    protected $defaultRenderer;

    public function __construct(RendererInterface $defaultRenderer)
    {
        $this->renderers = array();
        $this->defaultRenderer = $defaultRenderer;
    }

    public function addRenderer(RendererInterface $renderer)
    {
        $this->renderers[] = $renderer;
        $renderer->setProvider($this);
    }

    public function getRenderers()
    {
        return $this->renderers;
    }

    public function resolve(ActionInterface $action)
    {
        foreach ($this->getRenderers() as $renderer) {
            if ($renderer->supports($action)) {
                $renderer->setAction($action);
                
                return $renderer;
            }
        }
        
        $this->defaultRenderer->setProvider($this);
        $this->defaultRenderer->setAction($action);
        
        return $this->defaultRenderer;
    }
}
