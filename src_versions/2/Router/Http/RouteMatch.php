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

    use Zend\Mvc\Router\Http\RouteMatch as ZendMvcRouteMatch;
    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;
    /**
     * Description of RouteMatch
     *
     * @author carschrotter
     */
    class RouteMatch extends ZendMvcRouteMatch implements Zend3bcHelperInterface {

        const PARENT_CLASS = ZendMvcRouteMatch::class;

        protected static $parentClass = self::PARENT_CLASS;

    }

}