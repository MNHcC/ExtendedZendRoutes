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

    /**
     * SeoSegment
     * Allows to create an easy-to-configure method Aliases for URI parts.
     * configurable via the option 'seo_mapp' with the following schema:
     * [URL PartName] => [Alias => Match] 
     * Example:
     * <pre>
     * <?php
     * [
     * //...
     * 'type' => 'MNHcC\Router\Http\SeoSegment',
     * 	    'options' => [
     * 		'seo_mapp' => [
     * 		    'controller' => [
     * 			'benutzer' => 'UserArea'
     * 		    ]
     * 		],
     * 		'route' => '[/:controller[/:action]]',
     * 		'constraints' => [
     * 		    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
     * 		    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
     * 		],
     * //...
     * ]
     * </pre>
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class SeoSegment extends Segment {

        /**
         * a list of alliases for matched results.
         *
         * @var array
         */
        protected $seo_mapp;

        /**
         * Create a new regex route.
         *
         * @param  string $route
         * @param  array  $constraints
         * @param  array  $defaults
         */
        public function __construct($route, array $constraints = [], array $defaults = [], array $seo_mapp = []) {
            parent::__construct($route, $constraints, $defaults);
            $this->setSeomapp($seo_mapp);
        }

        /**
         * factory(): defined by RouteInterface interface.
         *
         * @see    \Zend\Mvc\Router\RouteInterface::factory()
         * @param  array|Traversable $options
         * @return Segment
         * @throws Exception\InvalidArgumentException
         */
        public static function factory($options = [], $constructor = []) {
            //check $options type
            if ($options instanceof Traversable) {
                $options = ArrayUtils::iteratorToArray($options);
            } elseif (!is_array($options)) {
                throw new Exception\InvalidArgumentException(__METHOD__ . ' expects an array or Traversable set of options');
            }

            //ceck $constructor type
            if ($constructor instanceof Traversable) {
                $constructor = ArrayUtils::iteratorToArray($constructor);
            } elseif (!is_array($constructor)) {
                throw new Exception\InvalidArgumentException('secont argument from' . __METHOD__ . ' expects an array or Traversable set of constructor arguments');
            }

            if (!isset($options['route'])) {
                throw new Exception\InvalidArgumentException('Missing "route" in options array');
            }

            if (!isset($options['constraints'])) {
                $options['constraints'] = [];
            }

            if (!isset($options['defaults'])) {
                $options['defaults'] = [];
            }

            if (!isset($options['seo_mapp'])) {
                $options['seo_mapp'] = [];
                foreach (\array_keys(array_merge($options['constraints'], $options['defaults'])) as $val) {
                    if ($val == '__NAMESPACE__')
                        continue;
                    $options['seo_mapp'][$val] = [];
                }
            }
            if (isset($options['constructor'])) {
                $constructor = array_merge($options['constructor'], $constructor);
            }

            return new static($options['route'], $options['constraints'], $options['defaults'], $options['seo_mapp'], ...$constructor); //merge parms whit $constructor
        }

        /**
         * match(): defined by RouteInterface interface.
         *
         * @see    \Zend\Mvc\Router\RouteInterface::match()
         * @param  Request     $request
         * @param  string|null $pathOffset
         * @param  array       $options
         * @return RouteMatch|null
         * @throws Exception\RuntimeException
         */
        public function match(\Zend\Stdlib\RequestInterface $request, $pathOffset = null, array $options = []) {

            $alias_set = [];

            $parent = parent::match($request, $pathOffset, $options);

            if (!$this->isInstanceofRouteMatch($parent)) {
                return;
            }
            /* @param  $match SeoRouteMatch */
            $match = SeoRouteMatch::factory($parent);

            foreach ($this->getSeoMapp() as $param_name => $aliases) {
                if ($match->getParam($param_name, null) !== null) {
                    foreach ($aliases as $original => $alias) {
                        if ($match->getParam($param_name, false) == $original) {
                            $match->addMatchedAlias($param_name, $original, $alias);
                            break; //first found 
                        }
                    }
                }
            }

            return $match;
        }

        /**
         * 
         * @return array
         */
        public function getSeoMapp() {
            return $this->seo_mapp;
        }

        /**
         * 
         * @param array $seo_mapp
         * @return \MNHcC\Router\Http\SeoSegment
         */
        public function setSeomapp(array $seo_mapp) {
            $this->seo_mapp = $seo_mapp;
            return $this;
        }

    }

}
