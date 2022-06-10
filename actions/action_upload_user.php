<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../utils/image.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $session = new Session();
    
    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }
    
    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $id = Costumer::getUserId($db, $session->getId());

    $file = $_FILES['image'];

    if(!uploadImage($file, 'users/profile', $id, 235, 1)){
        $session->addMessage('error', 'failed to upload image');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    uploadImage($file, 'users/icon', $id, 50, 1);

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>