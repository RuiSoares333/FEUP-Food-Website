<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    if(strcmp($_SERVER['REQUEST_METHOD'], "POST") !== 0){
        header("Location: /");
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumerWithPassword($db, $_POST['email'], $_POST['password']);

    session_start();

    if($costumer){
        if($costumer->isOwner()){
            $_SESSION['restaurants'] = $costumer->getOwnedRestaurants();
        }
        $_SESSION['id'] = $costumer->username;
        $_SESSION['name'] = $costumer->name;
    }
    else{
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

   header('Location:' . $_POST['referer']);
?>