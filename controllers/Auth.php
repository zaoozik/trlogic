<?php

namespace controllers;

use core\BaseController;
use core\Languages;
use core\Viewer;

final class Auth extends BaseController
{

    public static function view()
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
        $auth_content = Viewer::render('auth', [
            'strings' => $strings,

        ]);
        $layout_content = Viewer::render('layout',
            [
                'content' => $auth_content,
                'language_select' => $language_select,
                'title' => 'TR_LOGIC']);
        print ($layout_content);
    }
}

