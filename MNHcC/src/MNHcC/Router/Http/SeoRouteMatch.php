<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Router\Http {

    use \Zend\Mvc\Router\Http\RouteMatch;
    /**
     * SeoRouteMatch
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class SeoRouteMatch extends RouteMatch {
	
	
	public function __construct(array $params, $length = 0) {
	    parent::__construct($params, $length);
	    
	}
	
	public static function factory(RouteMatch $parent) {

	    $refl = new \ReflectionClass($parent);
	    $refl_parms = $refl->getProperty('params');
	    $refl_parms->setAccessible(true);
	    $params = $refl_parms->getValue($parent);
	    $refl_length = $refl->getProperty('length');
	    $refl_length->setAccessible(true);
	    $length = $refl_length->getValue($parent);
	    return new static($params, $length);
	}
    }

}
