<?php

namespace controllers;

use core\BaseController;
use core\Languages;
use core\Router;
use models\Users;

final class Main extends BaseController{

    public static function view(){

        if (Users::is_auth()) {
            Router::redirect('/account');
        } else {
            Router::redirect('/auth');
        }



    }

    public static function change_language()
    {
        $new_language = $_POST['language'];
        if (!empty($new_language)) {
            Languages::set_current_language($new_language);
        }
        Router::redirect($_SERVER['HTTP_REFERER']);


    }
}
