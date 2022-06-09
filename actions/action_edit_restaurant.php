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


    foreach($_POST['categories'] as $category){
        if(trim($category) === ''){
            session->addMessage('error', 'your restaurant needs at least one category');
            die(header('Location:' . $_SERVER['HTTP_REFERER']));
        }
    }

    if(trim($_POST['phone']) === ''){
        $session->addMessage('error', 'what\' your restaurant\s phone number?');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $restaurant->name = trim($_POST['name']);
    $restaurant->address = trim($_POST['address']);
    $restaurant->categories = $_POST['categories'];
    $restaurant->phone = trim($_POST['phone']);

    $restaurant->save($db);

    $session->addMessage('success', 'Your restaurant has been updated!');

    header('Location: ../pages/restaurant.php?id=' . $restaurant->id);
?>