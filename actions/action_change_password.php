<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumer($db, $session->getId());


    if(!$costumer->checkOldPassword($db, sha1($_POST['oldPassword']))){
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die;
    }

    if(trim($_POST['newPassword']) === ''){
        $session->addMessage('error', 'New Password must not be empty');
    }

    $costumer->updatePassword($db, sha1($_POST['newPassword']));

    include(__DIR__ . '/../actions/action_logout.php');
    header('Location: ../pages/login.php');

?>