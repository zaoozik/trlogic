<?php

namespace controllers;

use core\BaseController;
use core\Languages;
use core\Router;
use core\Viewer;

final class Account extends BaseController
{

    public static function view()
    {

        $content = Viewer::render('account');
        $response = Viewer::render('layout', [
            "strings" => Languages::get_language_strings(),
            "content" => $content
        ]);
        print $response;


    }
}