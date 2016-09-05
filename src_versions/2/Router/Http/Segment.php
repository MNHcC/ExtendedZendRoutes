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

    use Zend\Mvc\Router\RouteMatch;
    use Zend\Mvc\Router\Http\Segment as ZendMvcSegment;
    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;

    abstract class Segment extends ZendMvcSegment implements Zend3bcHelperInterface {

        const FOR_ZEND = 2;

        public function isInstanceofRouteMatch($a) {
            return ($a instanceof RouteMatch);
        }

    }

}