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

    use Zend\Router\RouteMatch;
    use Zend\Router\Exception\RuntimeException;
    use Zend\Router\Http\Segment as ZendSegment;
    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;

    class Segment extends ZendSegment implements Zend3bcHelperInterface {

        const FOR_ZEND = 3;
        
    }

}