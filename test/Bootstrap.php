<?php

/**
 * MNHcC/ExtendedZendRoutes https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/ExtendedZendRoutes for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2015-2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\ExtendedZendRoutes\TESTING {

    use Zend\Test\Util\ModuleLoader;
    use Zend\ServiceManager\ServiceManager;

// Decline static file requests back to the PHP built-in webserver
    if (php_sapi_name() === 'cli-server') {
        $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if (__FILE__ !== $path && is_file($path)) {
            return false;
        }
        unset($path);
    }

// Setup autoloading
    require 'init_autoloader.php';

    $configuration = include 'config/application.config.php';
    $moduleLoader = new ModuleLoader($configuration);
    /* @var $serviceManager ServiceManager */
    $serviceManager = $moduleLoader->getServiceManager();
}