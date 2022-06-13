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


    if(!$costumer->checkOldPassword($db, sha1(trim($_POST['oldPassword'])))){
        $session->addMessage('error', 'Old password doesn\'t match');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(strlen(trim($_POST['newPassword'])) < 9){
        $session->addMessage('error', 'New Password too small');
    }

    $costumer->updatePassword($db, sha1(trim($_POST['newPassword'])));

    include(__DIR__ . '/../actions/action_logout.php');
    header('Location: ../pages/login.php');

?>