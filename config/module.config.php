<?php

/**
 * MNHcC/ExtendedZendRoutes https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/ExtendedZendRoutes for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2015-2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\ExtendedZendRoutes {
    return [
        'route_manager' => [
            'factories' => [
                Router\Http\SeoSegment::class => Router\RouteInvokableFactory::class,
                Router\Http\ExistingControllerSegment::class => Router\RouteInvokableFactory::class,
            ],
            'abstract_factories' => [
                -1 => Router\RouteInvokableFactory::class
            ],
        ]
    ];
}