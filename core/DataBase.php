<?php

namespace core;
///Class Database, works with mysql only
final class DataBase {

    private $conn  = null;

    private $host;
    private $user;
    private $password;
    private $database;

    /**
     * DataBase constructor.
     * @param array $settings
     * @throws \Exception
     */
    public function __construct(array $settings)
    {
        $this->host = $settings["host"];
        $this->user = $settings["user"];
        $this->password = $settings["password"];
        $this->database = $settings["database"];


        $this->conn = mysqli_connect('localhost', 'root', 'belomor', 'tr_logic');
        if (! $this->conn){
            throw new \Exception( mysqli_connect_error());
        }
        mysqli_set_charset($this->conn, "utf8");

    }



}