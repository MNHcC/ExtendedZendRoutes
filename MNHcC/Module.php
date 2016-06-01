<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC {

    use \Zend\ModuleManager\Feature,
	\Zend\Mvc\MvcEvent,
	\Zend\EventManager\EventInterface,
	\Zend\ServiceManager\ServiceLocatorAwareInterface,
	\Zend\ServiceManager\ServiceLocatorAwareTrait,
	\Application\ModuleManager\Feature\AutoloaderProviderTrait;

    /**
     * Module
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class Module implements
    Feature\ConfigProviderInterface, Feature\AutoloaderProviderInterface, Feature\BootstrapListenerInterface,
	ServiceLocatorAwareInterface {

	use ServiceLocatorAwareTrait,
	    AutoloaderProviderTrait; 

	/**
	 *
	 * @var \Zend\Mvc\ApplicationInterface 
	 */
	private $application;

	public function getApplication() {
	    return $this->application;
	}

	public function setApplication(\Zend\Mvc\ApplicationInterface $application) {
	    $this->application = $application;
	    return $this;
	}

	public function getConfig() {
	    return include __DIR__ . '/config/module.config.php';
	}

	/**
	 * 
	 * @param MvcEvent $e
	 */
	public function onBootstrap(EventInterface $e) {

	    if (!$this->getServiceLocator()) {
		$this->setApplication($e->getApplication())
			->setServiceLocator($this->getApplication()->getServiceManager());
	    }
	    $modul = $this;

	    $this->getServiceLocator()->get('RoutePluginManager')->addInitializer(function($route, $cl) use($modul) {
		if ($route instanceof Router\Http\ExistingControllerSegment) {
		    $route->init($modul->getServiceLocator()->get('ControllerLoader'));
		}
	    }, 500);
	}

    }

}
