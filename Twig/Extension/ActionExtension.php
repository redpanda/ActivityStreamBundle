<?php
namespace Redpanda\Bundle\ActivityStreamBundle\Twig\Extension;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;
use Redpanda\Bundle\ActivityStreamBundle\Streamable\StreamableInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ActionExtension extends \Twig_Extension
{
    protected $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * Returns a list of global functions to add to the existing list.
     *
     * @return array An array of global functions
     */
    public function getFunctions()
    {
        return array(
            'activity_stream_render' => new \Twig_Function_Method($this, 'render', array(
                'is_safe' => array('html'),
            )),
        );
    }
    
    /**
     * Returns the action html.
     *
     * @return array An array of global functions
     */
    public function render(ActionInterface $action)
    {
        $renderer = $this->container->get('activity_stream.renderer_provider')->resolve($action);
        
        return trim($this->container->get('templating')->render($renderer->getTemplate(), $renderer->getTemplateParams()));
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'activity_stream_action';
    }
}
