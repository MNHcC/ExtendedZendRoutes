<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\ExtendedZendRoutes\Router\Http {

    use \Zend\Mvc\Router\Http\RouteMatch as ZendMvcRouteMatch;
    
    /**
     * Description of RouteMatch
     *
     * @author carschrotter
     */
    class RouteMatch extends ZendMvcRouteMatch {

        const parentc = ZendMvcRouteMatch::class;

        static $parentc = self::parentc;

    }

}