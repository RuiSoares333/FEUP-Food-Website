<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
        header("Location: /");
        die;
    }

    session_start();

    if(isset(S_SESSION['id'])){
        header('Location: ../pages/index.php');
        die;
    }
    

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if(Costumer::userExists($db, $_POST['username'])){
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die;
    }
        

    Costumer::register($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['phone']);

    header('Location: /../pages/login.php');
?>