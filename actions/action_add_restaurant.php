<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $name = trim(preg_replace("/[^\w\s]/", '', $_POST['name']));

    if(!$name){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    $address = trim(preg_replace("/[^\w\s,\.-]/", '', $_POST['address']));


    if(!$address){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    if(!$_POST['categories']){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $categories = Restaurant::getAllCategories($db);

    foreach($_POST['categories'] as $category){
        if(!array_search($category, $categories)){
            $session->addMessage('error', 'FAILED OPERATION');
            die(header('Location:' . $_SERVER['HTTP_REFERER']));
        }
    }

    //regex engloba todos os numeros de telemovel e todos os numeros fixos validos em portugal
    $phonePattern = '/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/';

    if(!preg_match($phonePattern, trim($_POST['phone']))){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    $costumer = Costumer::getCostumer($db, $session->getId());
   
   
    $restaurant = new Restaurant(
        1,
        $name,
        $address,
        $_POST['categories'],
        trim($_POST['phone']),
        $costumer->id
    );
    
    $restaurant->add($db);

    $session->addMessage('Success', 'Restaurant added');

    if(!$costumer->isOwner()){
        $costumer->becomeOwner($db);
    }

    $session->setOwnedRestaurants($costumer->getOwnedRestaurants($db));

    header('Location: ../pages/profile.php');
?>