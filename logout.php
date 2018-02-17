<?php include_once 'template/header.php';
session_unset();
session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);
include_once 'template/footer.php'; ?>