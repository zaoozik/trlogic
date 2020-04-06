<?php

namespace controllers;

use core\BaseController;
use core\DataBase;
use core\Languages;
use core\Router;
use core\Viewer;
use models\Users;

final class Auth extends BaseController
{

    public static function view(array $parameters = [])
    {
        $options = [
            [
                "value" => "ru",
                "caption" => "Русский",
                "selected" => ""
            ],
            [
                "value" => "en",
                "caption" => "English",
                "selected" => ""
            ]
        ];
        foreach ($options as &$option) {
            if ($option['value'] == Languages::get_current_language()) {
                $option['selected'] = 'selected';
            }
        }
        $strings = Languages::get_language_strings();
        $language_select = Viewer::render('language_select',
            [
                "strings" => $strings,
                "options" => $options
            ]);
        $auth_content = Viewer::render('auth',
            array_merge([
            'strings' => $strings,
                'language_select' => $language_select

            ], $parameters));
        $layout_content = Viewer::render('layout',
            [
                'content' => $auth_content,
                'title' => 'TR_LOGIC']);
        print ($layout_content);
        exit();
    }

    public static function auth()
    {
        if (!empty($_POST['login']) and !empty($_POST['password'])) {
            $user = new Users();
            $login = htmlspecialchars($_POST['login']);
            $password = $_POST['password'];
            if ($user->get_by_login($login)) {
                if (password_verify($password, $user->get('password'))) {
                    $_SESSION['user_login'] = $user->get('login');
                    Router::redirect('/account');
                } else {
                    $error = Languages::get_language_strings()['ERROR_WRONG_PASSWORD'];
                    self::view(["error" => $error]);
                }
            } else {
                $error = Languages::get_language_strings()['ERROR_WRONG_LOGIN'];
                self::view(["error" => $error]);
            }
        } else {
            $error = Languages::get_language_strings()['ERROR_REQUIRED_FIELDS_EMPTY'];
            self::view(["error" => $error]);
        }
    }

    public static function logout()
    {
        unset($_SESSION['user_login']);
        Router::redirect('/');
    }
}

