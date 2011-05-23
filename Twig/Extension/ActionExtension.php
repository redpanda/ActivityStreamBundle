<?php
namespace Bundle\ActivityStreamBundle\Twig\Extension;

use Bundle\ActivityStreamBundle\Model\ActionInterface;

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
            'activity_stream_get_action' => new \Twig_Function_Method($this, 'renderAction', array(
                'is_safe' => array('html'),
            )),
            'activity_stream_get_absolute_url' => new \Twig_Function_Method($this, 'renderUrl', array(
                'is_safe' => array('html'),
            )),
        );
    }
    
    public function renderAction(ActionInterface $action, $template = null)
    {
        if (null === $template) {
            $template = 'ActivityStream:Action:action.html.twig';
        }
        
        return trim($this->container->get('templating')->render($template, array('action' => $action)));
    }
    
    public function renderUrl($obj)
    {
        $routeParams = $obj->getAbsolutePathParams();

        if(!is_array($routeParams)) {
            throw new \LogicException('The method %s must return an array');
        }

        if(isset($routeParams['route']) && isset($routeParams['parameters'])) {
            return $this->container->get('router')->generate($routeParams['route'], $routeParams['parameters']);
        }
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
