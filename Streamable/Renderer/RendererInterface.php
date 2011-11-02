<?php

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable\Renderer;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;

/**
 * Provides renderers for the actions
 *
 * @author Jimmy Leger <jimmy.leger@gmail.com>
 */
interface RendererInterface
{
    function getActorUrl();
    function getTargetUrl();
    function getActionObjectUrl();
    function getTemplate();
    function getTemplateParams();
    function setProvider(RendererProvider $provider);
    function getProvider();
    function setAction(ActionInterface $action);
    function getAction();
    function supports(ActionInterface $action);
}