<?php

namespace models;

use core\DataBase;
use Exception;

/**
 * Class Users
 * Take users from db, without ORM
 * @package models
 */
class Users
{

    private const TABLE_NAME = 'users';

    private $db = null;

    private $id;
    private $login;
    private $password;
    private $name;
    private $surname;
    private $create_datetime;
    private $avatar_src;
    private $info;


    public function __construct()
    {
        $this->db = DataBase::connect();
        $this->create_datetime = date("Y-m-d H:i:s", time());
    }

    public function new(array $user_data)
    {
        $this->set_fields($user_data);
        return $this;
    }

    public function set($field, $value = null)
    {
        if (is_null($value)) {
            if (is_array($field)) {
                $this->set_fields($field);
                return $this;
            }
        } else {
            $this->$field = $value;
            return $this;
        }

    }

    public function get($field)
    {
        return $this->$field;

    }

    public function get_by_id(int $id)
    {
        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id= ?";
        $db = DataBase::connect();
        $result = $this->db->query_prepare($sql, ["id" => $id]);
        if (count($result) == 1) {
            $this->set_fields($result[0]);
            $this->id = $result[0]['id'];
            return $this;
        } else {
            return false;
        }

    }

    public function get_by_login(string $login)
    {
        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE login= ?";
        $db = DataBase::connect();
        $result = $this->db->query_prepare($sql, ["login" => $login]);
        if (count($result) == 1) {
            $this->set_fields($result[0]);
            $this->id = $result[0]['id'];
            return $this;
        } else {
            return false;
        }

    }


    public function save()
    {
        if (is_null($this->id)) {
            return $this->insert();

        } else {
            return $this->update();
        }

    }

    private function insert()
    {
        $sql = "INSERT INTO " . self::TABLE_NAME . "(" . $this->get_field_names_for_insert() . ") ";
        $sql .= "VALUES (" . $this->get_fields_values_for_insert() . ");";
        try {
            $result = $this->db->query_prepare($sql, $this->get_fields_assoc());
            if ($result) {
                $this->id = $result;
                return true;
            }
        } catch (Exception $exp) {
            return false;
        }


    }

    private function update()
    {
        $sql = "UPDATE " . self::TABLE_NAME . " SET " . $this->get_fields_values_for_update() . " WHERE id=$this->id";
        try {
            $result = $this->db->query_prepare($sql, $this->get_fields_assoc());
            if ($result == 0) {
                return true;
            }
        } catch (Exception $exp) {
            return false;
        }

    }

    private function set_fields(array $fields)
    {
        $this->login = $fields["login"];
        $this->password = $fields["password"];
        $this->name = $fields["name"];
        $this->surname = $fields["surname"];
        $this->create_datetime = $fields["create_datetime"];
        $this->avatar_src = $fields["avatar_src"];
        $this->info = $fields["info"];
    }

    private function get_field_names_for_insert()
    {
        $fields = get_object_vars($this);
        unset($fields['id']);
        unset($fields['db']);
        $string = "";
        foreach ($fields as $key => $value) {
            $string .= $key . ",";
        }
        $string = trim($string, ",");
        return $string;
    }

    private function get_fields_values_for_insert()
    {
        $fields = get_object_vars($this);
        unset($fields['id']);
        unset($fields['db']);
        $string = "";
        foreach ($fields as $key => $value) {
            $string .= '?,';
        }
        $string = trim($string, ",");
        return $string;
    }

    private function get_fields_assoc()
    {
        $fields = get_object_vars($this);
        unset($fields['id']);
        unset($fields['db']);
        return $fields;
    }

    private function get_fields_values_for_update()
    {
        $fields = get_object_vars($this);
        unset($fields['id']);
        unset($fields['db']);
        $string = "";
        foreach ($fields as $key => $value) {
            $string .= $key . ' = ?,';
        }
        $string = trim($string, ",");
        return $string;
    }

    public static function is_auth()
    {
        if (!empty($_SESSION["user_login"])) {
            return true;
        } else {
            return false;
        }
    }

    public function auth_no_pass()
    {
        $_SESSION['user_login'] = $this->login;
    }


}