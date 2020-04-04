<?php

namespace core;

use mysql_xdevapi\Exception;

/**
 * Class Viewer
 * This class has methods to render views as http responses
 * @package core
 */
final class Viewer
{
    /**
     * @param string $view_name
     * @param array $parameters
     * @return false|string
     */
    public static function render(string $view_name, array $parameters = [])
    {
        $filename = VIEWS . $view_name . '.php';

        if (!is_readable($filename)) {
            throw new \Exception("View is not found in views folder. Name: " . $view_name);
        }

        ob_start();
        extract($parameters);
        require $filename;

        $result = ob_get_clean();

        return $result;
    }
}