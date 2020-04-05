<?php
namespace core;

use Exception;

/**
 * Class Router
 * Simpliest one-level router. second-level urls and more lead to 404
 * @package core
 */
final  class Router{
    private static $routes = [];

    /**
     * Router constructor.
     * @param array $routes
     * @throws \Exception
     */
    public static function init(array $routes)
    {
        if (empty($routes)) {
            throw new Exception("Routes list is empty.");
        }
        foreach ($routes as $route){
            if (isset($route['url']) and isset($route['controller']) and  isset($route['method'])) {
                array_push(self::$routes,
                    [
                        "url" => $route['url'],
                        "controller" => $route['controller'],
                        "method" => $route['method']
                    ]);
            } else {
                throw new Exception("Routes list has incorrect format.");
            }
        }
        self::dispatch();
    }


    private static function dispatch()
    {


        $requested_url = self::get_server_url();
        $method = $_SERVER["REQUEST_METHOD"];

        if (! self::check_url_levels($requested_url)) {
            self::not_found();
        }

        $controller = null;

        foreach (self::$routes as $route) {
            if ($route['url'] == $requested_url and $route['method'] == $method) {
                $controller = $route['controller'];
                break;
            }
        }

        if (! $controller) {
            self::not_found();
        }

        $controller = "controllers\\" . $controller;

        if (is_callable($controller)) {

            $controller();

        } else {
            {
                throw new Exception("Controller is not a function. Name: '" . $controller . "'");
            }

        }

    }

    public static function redirect (string $url){
        header("Location: " . $url, true, 302);
        die;

    }

    public static function rawPOST()
    {
        $post = file_get_contents("php://input");
        return $post;

    }


    private static function not_found() {
        http_response_code(404);
        die;
    }


    private static function check_url_levels (string $url){
        $levels = mb_split("/", $url);
        return count($levels) <= 2;

    }

    private static function get_server_url (){
        $url = $_SERVER['REQUEST_URI'];
        //normalizing
        $url = '/' . trim($url, '/');
        return $url;
    }


}