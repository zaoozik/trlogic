<?php

use core\DataBase;
use core\Languages;
use core\Router;


//SITES CONSTS

define('SITE_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define("CORE", SITE_ROOT . 'core' . DIRECTORY_SEPARATOR);
define("CONTROLLERS", SITE_ROOT . 'controllers' . DIRECTORY_SEPARATOR);
define("VIEWS", SITE_ROOT . 'views' . DIRECTORY_SEPARATOR);
define("LANGUAGE_STRINGS_PATH", SITE_ROOT . 'assets' . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR);
define("DEFAULT_LANGUAGE", "ru");


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

session_start();
if (!isset($_SESSION['LANGUAGE'])) {
    $_SESSION['LANGUAGE'] = DEFAULT_LANGUAGE;
}
Languages::set_current_language($_SESSION['LANGUAGE']);

$db_settings = require "settings/database.php";
DataBase::load_settings($db_settings);


$routes = require "settings/routes.php";
Router::init($routes);

