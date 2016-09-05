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

    use Zend\Router\RouteInvokableFactory as ZendRouteInvokableFactory;
    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;
    
    /**
     * Description of RouteInvokableFactory
     *
     * @author carschrotter
     */
    class BaseRouteInvokableFactory extends ZendRouteInvokableFactory implements Zend3bcHelperInterface {
        
    }

}