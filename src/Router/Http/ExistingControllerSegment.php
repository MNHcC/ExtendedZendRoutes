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

    use Zend\Stdlib\RequestInterface;
    use Zend\Mvc\Controller\ControllerManager;
    use Zend\Router\Exception\RuntimeException;

    /**
     * ControlerExitis
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class ExistingControllerSegment extends SeoSegment {

        /**
         * the called Controllername
         * 
         * @var string 
         */
        protected $controller = 'Index';

        /**
         *
         * @var ControllerManager 
         */
        protected $controllerManager;

        public function __construct($route, array $constraints = array(), array $defaults = array(), $seo_mapp = array(), $controllerManager = null) {
            parent::__construct($route, $constraints, $defaults, $seo_mapp);
            $this->init($controllerManager);
        }

        /**
         * match(): defined by RouteInterface interface.
         *
         * @see    \Zend\Mvc\Router\RouteInterface::match()
         * @param  Request     $request
         * @param  string|null $pathOffset
         * @param  array       $options
         * @return RouteMatch|null
         * @throws RuntimeException
         */
        public function match(RequestInterface $request, $pathOffset = null, array $options = []) {

            $this->checkIsInit();

            /* @var $parentResult \Zend\Mvc\Router\Http\RouteMatch */
            $parentResult = parent::match($request, $pathOffset, $options);


            if ($this->isInstanceofRouteMatch($parentResult) == false) {
                return;
            }

            /* @var $workingVersionRm \Zend\Mvc\Router\Http\RouteMatch */
            $workingVersionRm = clone $parentResult;

            // call event to resolv real controller for more info see on \Zend\Mvc\ModuleRouteListener::onRoute()
            (new \Zend\Mvc\ModuleRouteListener())->onRoute((new \Zend\Mvc\MvcEvent())->setRouteMatch($workingVersionRm));

            $this->controller = $workingVersionRm->getParam('controller');


            // return null is Controler not exitis
            return ($this->getControllerManager()->has($this->getController())) ? $parentResult : null;
        }

        /**
         * return the called controller
         * @return string
         */
        public function getController() {
            return $this->controller;
        }

        /**
         * set the called controller
         * @param string $controller
         * @return $this
         */
        public function setController($controller) {
            $this->controller = $controller;
            return $this;
        }

        /**
         * 
         * @return ControllerManager 
         */
        public function getControllerManager() {
            return $this->controllerManager;
        }

        /**
         * 
         * @param ControllerManager  $controllerManager
         * @return $this
         */
        public function setControllerManager($controllerManager) {
            $this->controllerManager = $controllerManager;
            return $this;
        }

        /**
         * @param ControllerManager  $controllerManager
         */
        public function init(ControllerManager $controllerManager) {
            /* @var $controllerManager ControllerManager */
//	    $controllerManager = func_get_arg(0);
            $this->setControllerManager($controllerManager);
            $this->isInit = true;
            return $this->isInit;
        }

    }

}
