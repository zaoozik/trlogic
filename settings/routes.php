<?php

return [
    [
        "url" => "/",
        "controller" => "Main::view",
        "method" => "GET"
    ],
    [
        "url" => "/auth",
        "controller" => "Auth::view",
        "method" => "GET"
    ],
    [
        "url" => "/register",
        "controller" => "Register::view",
        "method" => "GET"
    ],
    [
        "url" => "/account",
        "controller" => "Account::view",
        "method" => "GET"
    ],
    [
        "url" => "/change_language",
        "controller" => "Main::change_language",
        "method" => "POST"
    ]
];