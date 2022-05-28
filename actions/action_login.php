<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    if(strcmp($_SERVER['REQUEST_METHOD'], "POST") !== 0){
        header("Location: /");
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumerWithPassword($db, $_POST['email'], $_POST['password']);

    $session = new Session();

    if($session->isLoggedin()){
        header('Location: ../pages/index.php');
    }

    if($costumer){
        if($costumer->isOwner()){
            $session->setOwnedRestaurants($costumer->getOwnedRestaurants($db));
        }
        $session->setId($costumer->username);
        $session->setName($costumer->name);
    }
    else{
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die;
    }

   header('Location:' . $_POST['referer']);
?>