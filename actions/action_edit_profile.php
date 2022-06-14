<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $name = trim(preg_replace("/[^\s\w]/", '', $_POST['name']));

    if(!$name){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    //regex to validade emails, i don't think this is perfect but it'll do the trick
    $email_pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

    if(!preg_match($email_pattern, trim($_POST['email']))){
        $session->addMessage('error', 'Please enter an email address');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $address = trim(preg_replace("/[^\w\s,\.-]/", '', $_POST['address']));

    if(!$address){
        $session->addMessage('error', 'home address, NOW!');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $phone_pattern = '/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/';

    if(!preg_match($phone_pattern, trim($_POST['phone']))){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    $costumer = Costumer::getCostumer($db, $session->getId());

    $costumer->name = $name;
    $costumer->email = trim($_POST['email']);
    $costumer->address = $address;
    $costumer->phoneNumber = trim($_POST['phone']);

    $costumer->save($db);

    $session->setName($costumer->name);
    $session->addMessage('success', 'Account updated');

    header('Location: ../pages/profile.php');
?>