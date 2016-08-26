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

        /**
         * Add a matched aliases. override the old and add to the MatchedAliases
         * @param string $name
         * @param string $original
         * @param string $alias
         * @return $this
         */
        public function addMatchedAlias($name, $original, $alias) {
            $this->setParam($name, $alias)
                ->params['matched_aliases'][$name] = [$original => $alias];
            
            return $this;
        }
        
        /**
         * Set the matched aliases as complete array
         * 
         * @param array $matched_aliases A array of matched aliases and in scheme of [ 'param name' => ['original' => 'alias'] ]
         * @return $this
         */
        public function setMatchedAliases(array $matched_aliases) {
            return $this->setParam('matched_aliases', $matched_aliases);
        }
        
        /**
         * Get the matched aliases as complete array
         * 
         * @return array A array of matched aliases and in scheme of [ 'param name' => ['original' => 'alias'] ]
         */
        public function getMatchedAliases() {
            return $this->getParam('matched_aliases', []);
        }
        
        
        /**
         * 
         * @param \Zend\Mvc\Router\Http\RouteMatch|\Zend\Router\Http\RouteMatch $match
         * @return static
         * @throws InvalidArgumentException
         */
	public static function factory($match) {
            if(!($match instanceof static::$parentClass)){
                throw new InvalidArgumentException('The match muss a Instance of '. static::PARENT_CLASS);
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
            $g = Closure::bind(function($roperty){ return $this->$roperty;}, $match, static::PARENT_CLASS);
            return (new static( $g('params'), $g('length')))
                ->setMatchedRouteName($g('matchedRouteName'));
	}
    }

}
