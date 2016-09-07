<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\ExtendedZendRoutes\Router\Bc;

use MNHcC\ExtendedZendRoutes\Router\Http\Segment as BcSegment; //use this vor backward compatibility
use Zend\Mvc\Router\RouteMatch as ZendMvcRouteMatch;
use Zend\Router\Http\RouteMatch as ZendRouteMatch;

/**
 * BaseSegmet is a wrapper for the backward compatibility classes 
 *
 * @author carschrotter
 */
class Segment extends BcSegment {

    protected $isInit = false;

    public function isInstanceofRouteMatch($a) {
        return ((class_exists(ZendRouteMatch::class) && $a instanceof ZendRouteMatch) || class_exists(ZendMvcRouteMatch::class) && $a instanceof ZendMvcRouteMatch);
    }

    /**
     * check is init  or when not throw Exception
     * excluded because throw error
     * @return boolean
     * @throws RuntimeException
     */
    public function checkIsInit() {
        if ($this->isInit) {
            return true;
        } else {
            throw new RuntimeException(sprintf('%s is not init! Before you use runn %s::init().', static::class));
        }
    }

}
