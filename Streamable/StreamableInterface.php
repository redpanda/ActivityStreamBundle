<?php
/*
 *
 */

namespace Redpanda\Bundle\ActivityStreamBundle\Streamable;

/**
 *
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
interface StreamableInterface 
{
    /**
     * Return an array for the form
     *
     * array(
     *   'route' => $routeName,
     *   'parameters' => array(key => value, ...)
     * )
     *
     * @return array
     */
    public function getAbsolutePathParams();

    /**
     * @return integer
     */
    public function getId();
}
