<?php

namespace Classes;


class Users
{
    public $tableName = 'users';
    public $username;
    public $password;

    public static function getSalt($bytes = 11){
        $bytes = random_bytes($bytes);
        return bin2hex($bytes);
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



}