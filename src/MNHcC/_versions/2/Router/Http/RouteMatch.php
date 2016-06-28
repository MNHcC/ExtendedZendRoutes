<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Router\Http;

/**
 * Description of RouteMatch
 *
 * @author carschrotter
 */
class RouteMatch extends \Zend\Mvc\Router\Http\RouteMatch {
    const parentc = \Zend\Mvc\Router\Http\RouteMatch::class;
    static $parentc = self::parentc;
}
