<?php
namespace MNHcC\Router\Http;
use \Zend\Mvc\Router\RouteMatch;

class Segment extends \Zend\Mvc\Router\Http\Segment {
    const FOR_ZEND = 2;
    
    public function isInstanceofRouteMatch($a){
        return ($a instanceof RouteMatch);
    }
    
}