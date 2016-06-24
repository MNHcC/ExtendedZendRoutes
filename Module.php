<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC {

    use \Zend\EventManager\EventInterface,
        \Zend\ModuleManager\Feature,
        \Zend\Mvc\MvcEvent,
        \Zend\ServiceManager\ServiceLocatorInterface,
        \Zend\Loader\StandardAutoloader,
        \Zend\Loader\ClassMapAutoloader,
        \MNHcC\ModuleManager\Feature\AutoloaderProviderTrait;

    /**
     * Module
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class Module implements
    Feature\ConfigProviderInterface, Feature\AutoloaderProviderInterface, Feature\BootstrapListenerInterface {

        use AutoloaderProviderTrait {
            getAutoloaderConfig as trait_getAutoloaderConfig;
        }

        /**
         *
         * @var \Zend\Mvc\ApplicationInterface 
         */
        protected $application = null;

        /**
         * @var ServiceLocatorInterface
         */
        protected $serviceLocator = null;

        /**
         *
         * @var \Zend\ServiceManager\AbstractPluginManager 
         */
        protected $abstractPluginManager;

        public function getAutoloaderConfig() {

            $config = $this->trait_getAutoloaderConfig();

            //Workaround for the MVC component version 3. 
            //Where the Http route was moved from the namespace \Zend\Mvc\Router\Http to \Zend\Router\Http
            if (class_exists(\Zend\Mvc\Router\Http\Segment::class)) {//|| !(defined('\Application\Module::VERSION') && version_compare(\Application\Module::VERSION, '3.0.0dev', '>=') ) ) { //check is namespace \Zend\Mvc\Router\...
                $config[ClassMapAutoloader::class][] = [Router\Http\Segment::class =>
                    $config[StandardAutoloader::class]['namespaces'][__NAMESPACE__] .
                    '/Router/Http/_versions/Segment_2.php'
                ];
            } else { // newer version of zend is used
                $config[ClassMapAutoloader::class][] = [Router\Http\Segment::class =>
                    $config[StandardAutoloader::class]['namespaces'][__NAMESPACE__] .
                    '/Router/Http/_versions/Segment_3.php'
                ];
            }

            return $config;
        }

        public function getConfig() {
            return include __DIR__ . '/config/module.config.php';
        }

        /**
         * 
         * @param MvcEvent $e
         */
        public function onBootstrap(EventInterface $e) {

            $this->setApplication($e->getApplication())
                ->setServiceLocator($this->getApplication()
                        ->getServiceManager())
                    ->setAbstractPluginManager($this->getServiceLocator()
                            ->get('RoutePluginManager'));
            
            $modul = $this;
            $this->getAbstractPluginManager()->addInitializer(
                    function($route, $cl) use($modul) {
                var_fump($route);
                if ($route instanceof Router\Http\ExistingControllerSegment) {
                    $route->init($modul->getServiceLocator()->get('ControllerLoader'));
                }
            }, 500);
        }

        /**
         * 
         * @return \Zend\Mvc\ApplicationInterface
         */
        public function getApplication() {
            return $this->application;
        }

        /**
         * 
         * @param \Zend\Mvc\ApplicationInterface $application
         * @return $this
         */
        public function setApplication(\Zend\Mvc\ApplicationInterface $application) {
            $this->application = $application;
            return $this;
        }

        /**
         * Set service locator
         *
         * @param ServiceLocatorInterface $serviceLocator
         * @return mixed
         */
        public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
            $this->serviceLocator = $serviceLocator;
            return $this;
        }

        /**
         * Get service locator
         *
         * @return ServiceLocatorInterface
         */
        public function getServiceLocator() {
            return $this->serviceLocator;
        }

        public function getAbstractPluginManager() {
            return $this->abstractPluginManager;
        }

        public function setAbstractPluginManager(\Zend\ServiceManager\AbstractPluginManager $abstractPluginManager) {
            $this->abstractPluginManager = $abstractPluginManager;
            return $this;
        }

    }

}
