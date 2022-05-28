<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
        header("Location: /");
        die;
    }

    $session = new Session();

    if($session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }
    

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if(Costumer::userExists($db, $_POST['username'])){
        $session->addMessage('error', 'That username is taken');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(Costumer::userExistsEmail($db, $_POST['email'])){
        $session->addMessage('error', 'That email belongs to another account');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['username']) === ''){
        $session->addMessage('error', 'Please fill all the mandatory fields');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['name']) === ''){
        $session->addMessage('error', 'Please fill all the mandatory fields');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['email']) === ''){
        $session->addMessage('error', 'Please fill all the mandatory fields');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['password']) === ''){
        $session->addMessage('error', 'Please fill all the mandatory fields');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['address']) === ''){
        $session->addMessage('error', 'Please fill all the mandatory fields');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['phone']) === ''){
        $session->addMessage('error', 'Please fill all the mandatory fields');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    Costumer::register($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['phone']);

    header('Location: /../pages/login.php');
?>