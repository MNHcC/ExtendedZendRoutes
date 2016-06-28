<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Router\Http {

    use \Closure;
    use \InvalidArgumentException;
    
    /**
     * SeoRouteMatch
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class SeoRouteMatch extends RouteMatch {
        
        /**
         * Create a part RouteMatch with given parameters and length.
         *
         * @param  array   $params
         * @param  int $length
         */
        public function __construct(array $params, $length = 0) {
            parent::__construct($params, $length);
            $this->setParam('matched_aliases', []);
        }

        public function addMatchedAlias($key, array $option_name) {
            $this->params['matched_aliases'][$key] = $option_name;
        }
        
        public function setMatchedAliases($matched_aliases) {
            $this->setParam('matched_aliases', $matched_aliases);
        }
        
        public function getMatchedAliases() {
            $this->getParam('matched_aliases', []);
        }
        
        
        /**
         * 
         * @param \Zend\Mvc\Router\Http\RouteMatch|\Zend\Router\Http\RouteMatch $match
         * @return static
         * @throws InvalidArgumentException
         */
	public static function factory($match) {
            $parentc = static::parentc;
            if(!($match instanceof $parentc)){
                throw new InvalidArgumentException('Parent muss a Instance of '. static::parentc);
            }
//	    $refl = new \ReflectionClass($parent);
//	    $refl_parms = $refl->getProperty('params');
//	    $refl_parms->setAccessible(true);
//	    $params = $refl_parms->getValue($parent);
//            
//            
//	    $refl_length = $refl->getProperty('length');
//	    $refl_length->setAccessible(true);
//	    $length = $refl_length->getValue($parent);
            
            /* g for get */
            $g = Closure::bind(function($roperty){ return $this->$roperty;}, $match, self::parentc);
            return (new static( $g('params'), $g('length')))
                ->setMatchedRouteName($g('matchedRouteName'));
	}
    }

}
