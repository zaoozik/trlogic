<?php

namespace core;

abstract class BaseController{

    public static function login_required()
    {
        if (! Users::isAuth())
        {
            Route::redirect('/enter');
        }
    }

}