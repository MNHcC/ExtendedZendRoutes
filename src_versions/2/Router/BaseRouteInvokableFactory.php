<?php

/**
 * MNHcC/ExtendedZendRoutes https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/ExtendedZendRoutes for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2015-2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\ExtendedZendRoutes\Router {

    use Zend\Mvc\Router\RouteInvokableFactory as ZendRouteMvcInvokableFactory;
    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;
    /**
     * RouteInvokableFactory
     *
     * @author carschrotter
     */
    class BaseRouteInvokableFactory extends ZendRouteMvcInvokableFactory implements Zend3bcHelperInterface {
        
    }

}