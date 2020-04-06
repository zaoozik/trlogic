<?php

namespace core;

use models\Users;

abstract class BaseController{

    public static function login_required()
    {
        if (!Users::is_auth()) {
            Router::redirect('/auth');
        }
    }

}