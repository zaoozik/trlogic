<?php

namespace core;

final class Viewer
{

    public static function render(string $view_path, array $parameters)
    {
        $name = 'templates/' . $name;
        $result = '';

        if (!is_readable($name)) {
            return $result;
        }

        ob_start();
        extract($data);
        require $name;

        $result = ob_get_clean();

        return $result;
    }
}