<?php include_once 'template/header.php';

if (isset($_SESSION['username'])){
    ?>


    <div id="chat">
        <div>
            <form action="message.php" method="post">
                <input id="message" placeholder="Сообщение" name="message">
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>

    <?php
    $db = getDB();
    $messages = $db->selectAll(new \Classes\Message())->fetchAll();
    krsort($messages); ?>

    <p>

    <?php
    foreach ($messages as $key => $message){
        echo '['.date("H:i:s",strtotime($message['datetime'])).'] ';
        $result = $db->selectBy(new \Classes\Users(),array('id'=>$message['userId']))->fetch();
        echo $message['username'] = $result['username'];
        echo ': '.htmlspecialchars($message['message']);
        ?>

    </p>

    <?php }

} else { echo 'Залогиньтесь, пожалуйста';} ?>

<?php include_once 'template/footer.php'; ?>