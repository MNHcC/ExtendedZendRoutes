<?php

/**
 * MNHcC/ExtendedZendRoutes https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/ExtendedZendRoutes for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2015-2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\ExtendedZendRoutes\Router\Http {

    use \Zend\Router\Http\RouteMatch as ZendRouteMatch;

    /**
     * Description of RouteMatch
     *
     * @author carschrotter
     */
    class RouteMatch extends ZendRouteMatch {

        const PARENT_CLASS = ZendRouteMatch::class;

        static $parentClass = self::PARENT_CLASS;

    }

}