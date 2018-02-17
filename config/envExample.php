<?php

date_default_timezone_set('Europe/Riga');

function __autoload($className) {
    $className = str_replace('_', '/', $className);
    require_once("$className.php");
}

function getDB()
{
    $serverAddress = '';
    $userName = '';
    $DBPassword = '';
    $dbName = '';
    $port = 3306;

    $db = new \Classes\DBAL($serverAddress, $userName, $DBPassword, $dbName,$port);
    return $db;
}


