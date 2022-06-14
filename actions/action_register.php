<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if($session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $username = trim(preg_replace("/[<>\"')(;\/#&]/", '', $_POST['username']));

    if(!$username){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $name = trim(preg_replace("/[<>\"')(;\/#&]/", '', $_POST['name']));

    if(!$name){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $email_pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

    if(!preg_match($email_pattern, trim($_POST['email']))){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }    

    $password1 = trim($_POST['password1']);

    if(strlen($password1) < 9){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }    

    $password2 = trim($_POST['password2']);

    $address = trim(preg_replace("/[<>\"')(;\/#&]/", '', $_POST['address']));

    if(!$address){
        $session->addMessage('error', 'home address, NOW!');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $phone_pattern = '/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/';

    if(!preg_match($phone_pattern, trim($_POST['phone']))){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    if(Costumer::userExistsUsername($db, $username)){
        $session->addMessage('error', 'username taken');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(Costumer::userExistsEmail($db, trim($_POST['email']))){
        $session->addMessage('error', 'email taken');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(Costumer::userExistsPhone($db, trim($_POST['phone']))){
        $session->addMessage('error', 'phone number taken');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if($password1 !== $password2){
        $session->addMessage('error', 'passwords don\'t match');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $costumer = new Costumer(
        1,
        $username,
        $name, 
        trim($_POST['email']), 
        $address, trim($_POST['phone']), 
        0
    );

    $costumer->register($db,$password1);

    header('Location: /../pages/login.php');
?>