<?php

namespace MNHcC\ExtendedZendRoutes;

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
