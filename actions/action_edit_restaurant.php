<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: /'));
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');
    
    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    if($restaurant->owner !== $session->getid()){
        die(header('Location: /'));
    }

    if(trim($_POST['name']) === ''){
        $session->addMessage('error', 'restaurant needs a name');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['address']) === ''){
        $session->addMessage('error', 'where is your restaurant located?');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['category']) === ''){
        $session->addMessage('error', 'what type of restaurant do you have?');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['phone']) === ''){
        $session->addMessage('error', 'what\' your restaurant\s phone number?');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }


    Restaurant::updateRestaurant($db, array($_POST['name'], $_POST['address'], $_POST['category'], $_POST['phone'], intval($_GET['id'])));

    header('Location: ../pages/restaurant.php?id=' . $_GET['id']);
?>