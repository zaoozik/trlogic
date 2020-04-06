<?php

namespace core;

use Exception;

/**
 * Class DataBase
 * @package core
 */
final class DataBase {

    private static $_instance = null;
    private $conn = null;

    private static $host;
    private static $user;
    private static $password;
    private static $database;


    private function __clone()
    {
    }

    private function __wakeup()
    {
    }


    /**
     * DataBase constructor.
     * @param array $settings
     * @throws \Exception
     */
    private function __construct(array $settings = [])
    {
//        $this->host = $settings["host"];
//        $this->user = $settings["user"];
//        $this->password = $settings["password"];
//        $this->database = $settings["database"];


        $this->conn = mysqli_connect(self::$host, self::$user, self::$password, self::$database);
        if (! $this->conn){
            die('DB ERROR. SITE WILL BE ABLE SOON.');
        }
        mysqli_set_charset($this->conn, "utf8");

    }

    public static function load_settings(array $settings)
    {
        self::$host = $settings["host"];
        self::$user = $settings["user"];
        self::$password = $settings["password"];
        self::$database = $settings["database"];

    }

    public static function connect()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function query(string $query)
    {

    }

    public function query_prepare(string $query, array $parameters = [])
    {
        if (!$stmt = $this->conn->prepare($query)) {
            throw new Exception("Can't init mysql prepare statement " . $this->conn->error);
        }

        if ($parameters) {
            $types = '';
            $stmt_data = [];

            foreach ($parameters as $value) {
                $type = 's';

                if (is_int($value)) {
                    $type = 'i';
                } else if (is_string($value)) {
                    $type = 's';
                } else if (is_double($value)) {
                    $type = 'd';
                }

                if ($type) {
                    $types .= $type;
                    $stmt_data[] = $value;
                }
            }

            $values = array_merge([$types], $stmt_data);


            if (!$stmt->bind_param(...$values)) {
                throw new Exception("Can't bind parameters to prepared  mysql statement. " . $stmt->error);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error in executing query. " . $stmt->error);
            }
            if ($res = $stmt->get_result()) {
                $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
                return $rows;
            } else {
                return $stmt->insert_id;
            }

        }

    }



}