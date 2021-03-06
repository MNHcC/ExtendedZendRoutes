<?php

/**
 * MNHcC/ExtendedZendRoutes https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/ExtendedZendRoutes for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2015-2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\ExtendedZendRoutes {

    use Zend\EventManager\EventInterface;
    use Zend\Mvc\MvcEvent;
    use Zend\Mvc\Router\Http\Segment as MvcSegment;
    use Zend\Router\Http\Segment;
    use Zend\ServiceManager\ServiceLocatorInterface;
    use Zend\Loader\StandardAutoloader;
    use Zend\Loader\ClassMapAutoloader;
    use MNHcC\Module\BasicModule;
    use MNHcC\ExtendedZendRoutes\Router\Http\ExistingControllerSegment;
    /**
     * Module
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015 - 2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license see license file
     */
    class Module extends BasicModule {

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
            $config = [
                StandardAutoloader::class => [
                    'namespaces' => [
                        __NAMESPACE__ => __DIR__,
                    ],
                ],
            ];
            if (\file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'autoload_classmap.php')) {
                $config[ClassMapAutoloader::class] = [__DIR__ . DIRECTORY_SEPARATOR . 'autoload_classmap.php'];
            }

            //Workaround for the MVC component version 3. 
            //Where the Http route was moved from the namespace \Zend\Mvc\Router\Http to \Zend\Router\Http
            $config[ClassMapAutoloader::class][] = sprintf('%s/../src_versions/%d/autoload_classmap.php', __DIR__, $this->wichZendMvcMajor()
            ); //the classmap file

            return $config;
        }

        public function wichZendMvcMajor() {
            static $version;
            if ($version)
                return $version;

            $version = 2;

            switch (true) {
                /**
                 * check is the new sceleton aplication (used v3 component
                 */
                case ( (@defined('\Application\Module::VERSION') //check for new sceleton aplication
                && version_compare(\Application\Module::VERSION, '3.0.0dev', '>=')) ) :
                    $version = 3;
                    break;
                /**
                 * check is not namespace \Zend\Mvc\Router\... because zend removed router from Mvc namspace
                 */
                case!class_exists(MvcSegment::class) && class_exists(Segment::class): //check is v3 MVC component
                    $version = 3;
                    break;
                default :
                    $version = 2;
                    break;
            }
            return $version;
        }

        public function getConfig() {
            return include __DIR__ . '/../config/module.config.php';
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
                if ($route instanceof ExistingControllerSegment) {
                    /* @var $modul Module\BasicModuleInterface */
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
