<?php

namespace controllers;

use core\BaseController;
use core\Languages;
use core\Router;
use core\Viewer;
use models\Users;


final class Account extends BaseController
{
    /**
     * Renders account page
     * @param array $parameters
     * @throws \Exception
     */
    public static function view(array $parameters = [])
    {
        self::login_required();

        $user = new Users();
        $user->get_authorized();

        //user data for account view
        $user_data = $user->assoc();

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

        //make languages options list
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

        $nav = Viewer::render('navigation',
            [
                "language_select" => $language_select,
                "strings" => $strings
            ]);

        $content = Viewer::render('account',
            array_merge(
                [
                    "strings" => $strings
                ], $user_data, $parameters));

        $response = Viewer::render('layout', [

            "content" => $content,
            "navigation" => $nav
        ]);
        print $response;
        exit();


    }

    /**
     * Saves user data via POST
     */
    public static function save()
    {
        $user = new Users();
        $user->get_authorized();
        $name = htmlspecialchars($_POST['name']);
        $surname = htmlspecialchars($_POST['surname']);
        $email = htmlspecialchars($_POST['mail']);
        $info = htmlspecialchars($_POST['info']);
        $user->set(
            [
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'info' => $info
            ]
        );

        if ($user->save()) {
            $message = Languages::get_language_strings()['SAVED'];
            self::view(["message" => $message]);
        } else {
            $error = Languages::get_language_strings()['ERROR_SERVER_ERROR'];
            self::view(["error" => $error]);
        }
    }


    public static function upload_avatar()
    {
        self::login_required();

        if (empty($_FILES['avatar']['name'])) {
            $error = Languages::get_language_strings()['ERROR_AVATAR_FILE_NOT_SELECT'];
            self::view(["error" => $error]);
        }

        $user = new Users();
        $user->get_authorized();

        $max_size = 10485760; //10 Mb
        $types = ['image/gif', 'image/png', 'image/jpeg'];
        $picture = $_FILES["avatar"];


        if ($picture['error']) {
            {
                $error = Languages::get_language_strings()['ERROR_SERVER_ERROR'];
                self::view(["error" => $error]);
            }
        }

        if ($max_size < $picture['size']) {
            {
                $error = Languages::get_language_strings()['ERROR_UPLOAD_FILE_MAX_SIZE'];
                self::view(["error" => $error]);
            }
        }

        if (!in_array($picture['type'], $types)) {
            $error = Languages::get_language_strings()['ERROR_UPLOAD_FILE_EXT'];
            self::view(["error" => $error]);
        }

        $ext = self::getExtension($picture['type']);

        $dir = "images/user/" . $user->get('id') . "/";

        if (!file_exists(FILESTORE . $dir)) {
            if (!$result = mkdir(FILESTORE . $dir, 0777, true)) {

                $error = Languages::get_language_strings()['ERROR_SERVER_ERROR'];
                self::view(["error" => $error]);
            }

        }

        $file_path = FILESTORE . $dir . 'avatar' . $ext;
        $file_url = 'filestore/' . $dir . 'avatar' . $ext;


        //сохраняем мелкое фото
        self::imgResize($picture, $file_path, 1);
        $user->set('avatar_src', $file_url)->save();
        Router::redirect('/account');


    }

    public static function getExtension(string $mimeType)
    {

        switch ($mimeType) {
            case "image/gif":
                return ".gif";
                break;
            case "image/png":
                return ".png";
                break;
            case "image/jpeg":
                return ".jpg";
                break;
            default:
                return null;
        }
    }

    public static function imgResize(array $picture, string $filename, int $type = 1, int $rotate = null, int $quality = null)
    {
        //global $tmp_path;

        // Ограничение по ширине в пикселях
        $max_thumb_size = 150;
        $max_size = 500;

        // Качество изображения по умолчанию
        if ($quality == null)
            $quality = 100;

        // Cоздаём исходное изображение на основе исходного файла
        if ($picture['type'] == 'image/jpeg')
            $source = imagecreatefromjpeg($picture['tmp_name']);
        elseif ($picture['type'] == 'image/png')
            $source = imagecreatefrompng($picture['tmp_name']);
        elseif ($picture['type'] == 'image/gif')
            $source = imagecreatefromgif($picture['tmp_name']);
        else
            return false;

        // Поворачиваем изображение
        if ($rotate != null)
            $src = imagerotate($source, $rotate, 0);
        else
            $src = $source;

        // Определяем ширину и высоту изображения
        $w_src = imagesx($src);
        $h_src = imagesy($src);

        // В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
        if ($type == 1)
            $w = $max_thumb_size;
        elseif ($type == 2)
            $w = $max_size;

        // Если ширина больше заданной
        if ($w_src > $w) {
            // Вычисление пропорций
            $ratio = $w_src / $w;
            $w_dest = round($w_src / $ratio);
            $h_dest = round($h_src / $ratio);

            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);

            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

            // Вывод картинки и очистка памяти
            imagejpeg($dest, $filename, $quality);
            imagedestroy($dest);
            imagedestroy($src);

            return $filename;
        } else {
            // Вывод картинки и очистка памяти
            imagejpeg($src, $filename, $quality);
            imagedestroy($src);

            return $filename;
        }
    }




}