<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Router\Http {

    use \Zend\Mvc\Router\RouteMatch,
	\Zend\ServiceManager\ServiceLocatorAwareInterface,
	\Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * ControlerExitis
     *
     * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @copyright 2015, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
     * @license default
     */
    class ExistingControllerSegment extends SeoSegment
	implements ServiceLocatorAwareInterface, \Zend\Stdlib\InitializableInterface {

	use ServiceLocatorAwareTrait;

	/**
	 * the called Controller
	 * @var text 
	 */
	protected $controller = 'Index';
	
	/**
	 *
	 * @var \Zend\Mvc\Controller\ControllerManager 
	 */
	protected $controllerManager;
	
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
	public function match(\Zend\Stdlib\RequestInterface $request,
		$pathOffset = null, array $options = []) {

	    /* @var $parentResult \Zend\Mvc\Router\Http\RouteMatch */
	    $parentResult = parent::match($request, $pathOffset, $options);
	    
            if ($parentResult instanceof RouteMatch == false) {
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
	 * @return \MNHcC\Router\Http\ExistingControllerSegment
	 */
	public function setController($controller) {
	    $this->controller = $controller;
	    return $this;
	}
	
	/**
	 * 
	 * @return \Zend\Mvc\Controller\ControllerManager 
	 */
	public function getControllerManager() {
	    return $this->controllerManager;
	}

	/**
	 * 
	 * @param \Zend\Mvc\Controller\ControllerManager  $controllerManager
	 * @return \MNHcC\Router\Http\ExistingControllerSegment
	 */
	public function setControllerManager($controllerManager) {
	    $this->controllerManager = $controllerManager;
	    return $this;
	}
	
	/**
	 * @param \Zend\Mvc\Controller\ControllerManager  $controllerManager
	 */
	public function init() {
	    /* @var $loader \Zend\Mvc\Controller\ControllerManager */
	    $controllerManager = func_get_arg(0);
	    $this->setControllerManager($controllerManager);
	}
        
    }

}
