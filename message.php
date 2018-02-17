<?php include_once 'template/header.php';

if (isset($_SESSION['username'])){
    $db =  getDB();

    $data = array(
        'message' => $_POST['message'],
        'userId' => $_SESSION['userId'],
        'datetime' => date('Y/m/d h:i:s', time())
    );

    $message = new \Classes\Message();
    $validator = new \Classes\Validator();
    if ($validator->isValid($data)){
        $db->save($message,$data);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo $validator->errorMessage;
    }
}

include_once 'template/footer.php'; ?>