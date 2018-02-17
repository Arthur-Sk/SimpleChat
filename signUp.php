<?php
include_once 'template/header.php';


$data = array(
    'username'=>$_POST['username'],
    'password'=>$_POST['password'],);
$validator = new Classes\Validator();
if (!$validator->isValid($data)){
    echo $validator->errorMessage;
} else {
    $user = new \Classes\Users();
    $user->setUsername($data['username']);
    $user->setPassword($data['password']);
    $db = getDB();
    if ($db->createUser($user)){
        echo 'Вы успешно зарегестрировались';
    } else {
        echo $db->errorMessage;
    }
}


?>