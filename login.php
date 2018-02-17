<?php
include_once 'template/header.php';
$db = getDB();

$user = new \Classes\Users();
$user->setUsername($_POST['username']);
$user->setPassword($_POST['password']);

if ($db->login($user)){
    header('Location:index.php');
} else {
    echo $db->errorMessage;
}

?>