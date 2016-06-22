<?php
namespace MNHcC\Router\Http;
use \Zend\Router\RouteMatch;

class Segment extends  \Zend\Router\Http\Segment{  
    const FOR_ZEND = 3;
    protected $isInit = false;
    
    /**
     * check is init  or when not throw Exception
     * 
     * @return boolean
     * @throws \Zend\Router\Exception\RuntimeException
     */
    public function checkIsInit(){
        if($this->isInit){
            return true;
        } else {
            throw new \Zend\Router\Exception\RuntimeException(static::class.' is not init! Before you use initialise this.' );
        }
    }
                    
    public function isInstanceofRouteMatch($a){
        return ($a instanceof RouteMatch);
    }
}