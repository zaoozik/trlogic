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
        "url" => "/auth",
        "controller" => "Auth::auth",
        "method" => "POST"
    ],
    [
        "url" => "/logout",
        "controller" => "Auth::logout",
        "method" => "GET"
    ],
    [
        "url" => "/registration",
        "controller" => "Registration::view",
        "method" => "GET"
    ],
    [
        "url" => "/registration",
        "controller" => "Registration::registration",
        "method" => "POST"
    ],
    [
        "url" => "/account",
        "controller" => "Account::view",
        "method" => "GET"
    ],
    [
        "url" => "/account",
        "controller" => "Account::save",
        "method" => "POST"
    ],
    [
        "url" => "/upload_avatar",
        "controller" => "Account::upload_avatar",
        "method" => "POST"
    ],
    [
        "url" => "/change_language",
        "controller" => "Main::change_language",
        "method" => "POST"
    ]
];