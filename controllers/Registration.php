<?php

namespace controllers;


use core\BaseController;
use core\Languages;
use core\Router;
use core\Viewer;
use models\Users;

final class Registration extends BaseController
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
        $registration_content = Viewer::render('registration',
            array_merge([
                'strings' => $strings,
                'language_select' => $language_select

            ], $parameters));
        $layout_content = Viewer::render('layout',
            [
                'content' => $registration_content,
                'title' => 'TRLOGIC'
            ]);
        print ($layout_content);
        exit();
    }

    public static function registration()
    {
        if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['password_confirm'])) {
            $error = null;
            //check login for unique
            $user = new Users();
            $login = $_POST['login'];
            $password = $_POST['password'];
            $confirm_password = $_POST['password_confirm'];
            if ($user->get_by_login($login)) {
                $error = Languages::get_language_strings()['ERROR_LOGIN_IS_USED'];
                self::view(["error" => $error]);
            }

            if ($password != $confirm_password) {
                $error = Languages::get_language_strings()['ERROR_CONFIRM_PASSWORD'];
                self::view(["error" => $error]);
            }

            $user->set("login", $login);
            $user->set("password", password_hash($password, PASSWORD_DEFAULT));

            if (!$user->save()) {
                $error = Languages::get_language_strings()['ERROR_SERVER_ERROR'];
                self::view(["error" => $error]);
            }

            $user->auth_no_pass();
            Router::redirect('/account');


        } else {
            $error = Languages::get_language_strings()['ERROR_REQUIRED_FIELDS_EMPTY'];
            self::view(["error" => $error]);
        }
    }
}