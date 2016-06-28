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
        \Zend\Mvc\Router\Http\Segment as MvcSegment,
        \Zend\Router\Http\Segment,
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
            $zendMajor = $this->wichZendMvcMajor();
//            
//            $config[StandardAutoloader::class]['namespaces'][] = 
//                    
//                    $__NAMESPACE__ => $__DIR__ .DS. 'src' .DS. $__NAMESPACE__;
	
//            foreach ([Router\Http\RouteInvokableFactory::class, Router\Http\Segment::class] as $class) {
//                $config[ClassMapAutoloader::class][] = [$class =>
//                    $config[StandardAutoloader::class]['namespaces'][__NAMESPACE__]
//                    . DIRECTORY_SEPARATOR
//                    . '_versions'
//                    . DIRECTORY_SEPARATOR
//                    . $zendMajor
//                    . str_replace('\\', DIRECTORY_SEPARATOR, preg_replace('~^' . preg_quote(__NAMESPACE__, '~') . '~', '', $class))
//                    . '.php'
//                ];
//            }

            $config[ClassMapAutoloader::class][] = 
                $config[StandardAutoloader::class]['namespaces'][__NAMESPACE__] //from current autoloader config
                . DIRECTORY_SEPARATOR
                . '_versions'
                . DIRECTORY_SEPARATOR
                . $zendMajor
                . DIRECTORY_SEPARATOR
                . 'autoload_classmap.php' //the classmap file
            ;
            
            
            return $config;
        }
        
        public function wichZendMvcMajor(){
            $version = 2;
            //check is v3 
            switch (true) {
                /**
                 * check is the new sceleton aplication
                 */
                case ( (defined('\Application\Module::VERSION') 
                        && version_compare(\Application\Module::VERSION, '3.0.0dev', '>=')) ) : 
                    $version = 3;
                    break;
                /**
                 * check is not namespace \Zend\Mvc\Router\... because zend removed router from Mvc namspace
                 */
                case !class_exists(MvcSegment::class) && class_exists(Segment::class):
                    $version = 3;    
                    break;
                default :
                  $version = 2 ;
                    break;
            }
            return $version;       
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
