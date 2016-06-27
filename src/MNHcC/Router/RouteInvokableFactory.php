<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Router;
USE Interop\Container\ContainerInterface;
/**
 * Description of RouteInvokableFactory
 *
 * @author carschrotter
 */
class RouteInvokableFactory extends Http\RouteInvokableFactory{
    
     public function __invoke(ContainerInterface $container, $routeName, array $options = null) {
        if(isset($options['constructor'])) unset ($options['constructor']);
            
        if( trim($routeName, '\\') == trim(Http\ExistingControllerSegment::class, '\\')) {
           $options['constructor'][] = $container->get('ControllerManager'); 
        }
        return parent::__invoke($container, $routeName, $options);
    }
}
