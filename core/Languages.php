<?php

namespace core;

final class Languages
{
    private static $CURRENT_LANGUAGE = DEFAULT_LANGUAGE;

    /**
     * @return array
     */
    public static function get_language_strings()
    {
        $filename = LANGUAGE_STRINGS_PATH . self::$CURRENT_LANGUAGE . DIRECTORY_SEPARATOR . "strings.php";
        if (is_readable($filename)) {
            return require $filename;
        }

    }

    /**
     * @param string $language_code
     */
    public static function set_current_language(string $language_code)
    {
        self::$CURRENT_LANGUAGE = $language_code;
        $_SESSION['LANGUAGE'] = $language_code;


    }

    public static function get_current_language()
    {
        return self::$CURRENT_LANGUAGE;


    }

}