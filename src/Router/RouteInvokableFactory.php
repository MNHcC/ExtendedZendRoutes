<?php

/**
 * MNHcC/ExtendedZendRoutes https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/ExtendedZendRoutes for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2015-2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\ExtendedZendRoutes\Router {

    use Interop\Container\ContainerInterface;

    /**
     * Description of RouteInvokableFactory
     *
     * @author carschrotter
     */
    class RouteInvokableFactory extends Http\RouteInvokableFactory {

        public function __invoke(ContainerInterface $container, $routeName, array $options = null) {
            if (isset($options['constructor']))
                unset($options['constructor']);

            if (trim($routeName, '\\') == trim(Http\ExistingControllerSegment::class, '\\')) {
                $options['constructor'][] = $container->get('ControllerManager');
            }
            return parent::__invoke($container, $routeName, $options);
        }

    }

}