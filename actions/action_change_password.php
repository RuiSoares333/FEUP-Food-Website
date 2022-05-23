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


    if(!Costumer::checkOldPassword($db, $_SESSION['id'], $_POST['oldPassword'])){
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die;
    }

    Costumer::updatePassword($db, $_SESSION['id'], $_POST['newPassword']);

   include(__DIR__ . '/../actions/action_logout.php');
   header('Location: ../pages/login.php');

?>