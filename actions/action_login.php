<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if($session->isLoggedin()){
        header('Location: ../pages/index.php');
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumerWithPassword($db, trim($_POST['username']), trim($_POST['password']));

    if($costumer){
        if($costumer->isOwner()){
            $session->setOwnedRestaurants($costumer->getOwnedRestaurants($db));
        }
        $session->setId($costumer->username);
        $session->setName($costumer->name);
        $session->addMessage('success', 'Login successful');
    }
    else{
        $session->addMessage('error', 'FAILED OPERATION');
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die;
    }

   header('Location:' . $_POST['referer']);
?>