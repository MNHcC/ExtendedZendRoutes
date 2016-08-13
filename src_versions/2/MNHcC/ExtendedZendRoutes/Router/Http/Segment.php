<?php

namespace MNHcC\ExtendedZendRoutes\Router\Http {

    use Zend\Mvc\Router\RouteMatch;
    use Zend\Mvc\Router\Http\Segment as ZendMvcSegment;

    abstract class Segment extends ZendMvcSegment {

        const FOR_ZEND = 2;

        public function isInstanceofRouteMatch($a) {
            return ($a instanceof RouteMatch);
        }

    }

}