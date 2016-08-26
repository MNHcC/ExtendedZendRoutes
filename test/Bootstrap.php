<?php

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfiguration;

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
$serviceManager = new ServiceManager(new ServiceManagerConfiguration($configuration));
$serviceManager->setService('ApplicationConfiguration', $configuration);
$moduleManager = $serviceManager->get('ModuleManager');
$moduleManager->loadModules();