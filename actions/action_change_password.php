<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if($_SESSION['crsf'] !== $_POST['crsf']){
        $session->addMessage('error', 'Ilegitimate request');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    if(!$session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumer($db, $session->getId());


    if(!$costumer->checkOldPassword($db, $_POST['oldPassword'])){
        $session->addMessage('error', 'Old password doesn\'t match');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(strlen(trim($_POST['newPassword'])) < 9){
        $session->addMessage('error', 'New Password too small');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['newPassword']) === trim($_POST['oldPassword'])){
        $session->addMessage('error', 'new password can\'t be the same as old password');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $options = ['cost' => 10];

    $costumer->updatePassword($db, password_hash(trim($_POST['newPassword']), PASSWORD_BCRYPT, $options));

    include(__DIR__ . '/../actions/action_logout.php');
    header('Location: ../pages/login.php');

?>