<?php

namespace Classes;

class DBAL extends Database
{
    public $errorMessage;

    public function __construct($serverName,$userName,$DBPassword,$dbname,$port){
        parent::__construct($serverName,$userName,$DBPassword,$dbname,$port);
    }

    protected function HandleError($error){
        $this->errorMessage = $error;
    }

    public function selectBy($object,array $parameters)  {
        return $this->buildSelectBy($object,$parameters);
    }

    public function selectAll($object)  {
        $stmt = $this->query($this->buildSelectAll($object));
        return $stmt;
    }

    public function isFieldUnique ($object, array $parameters) {
        $stmt = $this->selectBy($object,$parameters);
        if ($stmt->fetch()){
            return false;
        }
        return true;
    }

    public function save($object, array $parameters)
    {
        if (empty ($parameters['id'])) {
            return $this->buildInsert($object, $parameters);
        }
        return $this->buildEditById($object, $parameters['id'], $parameters);
    }

    public function createUser (Users $user) {
        // Checks for unique username
        if (!$this->isFieldUnique($user, array('username'=>$user->username))){
            $this->HandleError('Аккаунт с таким именем уже существует');
            return false;
        }
        // Hash the password
        $salt = Users::getSalt();
        $hashedPassword = crypt($user->password,'$2y$07$'.$salt);
        // Saves to database
        $parameters = array(
            'username' => $user->username,
            'password' => $hashedPassword);

        try {
            $this->save($user, $parameters);
        } catch (\PDOException $e) {
            echo 'Что-то пошло не так: ', $e->getMessage(), "\n";
            return false;
        }
        return true;
    }

    public function CheckLoginDB($user, array $parameters){
        $result = $this->selectBy($user,['username' => $parameters['username']]);
        if ($acc = $result->fetch()){
            if (hash_equals($acc['password'], crypt($parameters['password'], $acc['password']))) {
                //Starts season
                session_unset();
                session_destroy();
                session_start();

                $_SESSION['username'] = $acc['username'];
                $_SESSION['userId'] = $acc['id'];
                return true;
            }
        }
        return false;
    }

    public function login(Users $user){

        $parameters = array(
            'username'=>$user->username,
            'password'=>$user->password);

        //Checks username and pass in DB
        if (!$this->CheckLoginDB($user, $parameters)){
            $this->HandleError('Неверное имя или пороль');
            return false;
        }
        return true;
    }
}