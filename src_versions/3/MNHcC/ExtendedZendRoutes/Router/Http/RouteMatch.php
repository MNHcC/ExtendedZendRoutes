<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\ExtendedZendRoutes\Router\Http {

    use \Zend\Router\Http\RouteMatch as ZendRouteMatch;

    /**
     * Description of RouteMatch
     *
     * @author carschrotter
     */
    class RouteMatch extends ZendRouteMatch {

        const parentc = ZendRouteMatch::class;

        static $parentc = self::parentc;

    }

}