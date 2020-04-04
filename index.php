<?php

use core\Router;

require_once "core/functions.php";

//SITES CONSTS

define('SITE_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define("CORE", SITE_ROOT . 'core' . DIRECTORY_SEPARATOR);
define("CONTROLLERS", SITE_ROOT . 'controllers' . DIRECTORY_SEPARATOR);
define("VIEWS", SITE_ROOT . 'views' . DIRECTORY_SEPARATOR);

// register autoloader
spl_autoload_register(function ($class)  {
    $class = str_replace('\\',DIRECTORY_SEPARATOR, $class);
    $path = SITE_ROOT . $class . '.php';

    if (file_exists($path)) {
        require_once $path;
        return true;
    } else
        return false;
});

$routes = require "settings/routes.php";

Router::init($routes);

