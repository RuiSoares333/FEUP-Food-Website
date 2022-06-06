<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: pages/login.php'));
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    if(trim($_POST['name']) == ''){
        $session->addMessage('error', 'please fill all mandatory fields with the intended information');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }


    if(trim($_POST['address']) == ''){
        $session->addMessage('error', 'please fill all mandatory fields with the intended information');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }


    if(trim($_POST['category']) == ''){
        $session->addMessage('error', 'please fill all mandatory fields with the intended information');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }


    if(trim($_POST['phone']) == ''){
        $session->addMessage('error', 'please fill all mandatory fields with the intended information');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    $restaurant = new Restaurant(
        1,
        trim($_POST['name']),
        trim($_POST['address']),
        trim($_POST['category']),
        trim($_POST['phone']),
        $session->getId()
    );
    
    $restaurant->add($db);

    $session->addMessage('Success', 'Restaurant added successfully!');

    $costumer = Costumer::getCostumer($db, $session->getId());

    if(!$costumer->isOwner()){
        $costumer->becomeOwner($db);
    }

    $session->setOwnedRestaurants = $costumer->getOwnedRestaurants($db);

    header('Location: ../pages/profile.php');
?>