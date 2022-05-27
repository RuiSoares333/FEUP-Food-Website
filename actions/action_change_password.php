<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: ../pages/index.php');
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');


    if(!Costumer::checkOldPassword($db, array($_SESSION['id'], sha1($_POST['oldPassword'])))){
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die;
    }

    Costumer::updatePassword($db, array(sha1($_POST['newPassword']), $_SESSION['id']));

    include(__DIR__ . '/../actions/action_logout.php');
    header('Location: ../pages/login.php');

?>