<?php

namespace controllers;

use core\BaseController;
use core\Router;

final class Main extends BaseController{

    public static function view(){

        Router::redirect('/auth');


    }
}
