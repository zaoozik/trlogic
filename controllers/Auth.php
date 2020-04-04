<?php

namespace controllers;

use core\BaseController;
use core\Viewer;

final class Auth extends BaseController
{

    public static function view()
    {

        $auth_content = Viewer::render('auth');
        $layout_content = Viewer::render('layout', ['content' => $auth_content, 'title' => 'TR_LOGIC']);
        print ($layout_content);
    }
}

