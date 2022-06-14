<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../utils/image.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');

    $session = new Session();
    
    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }
    
    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $id = trim(preg_replace("/[\D]/", '', $_GET['id']));

    if(!$id){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $dish = Dish::getDish($db, intval($id));
    $restaurant = Restaurant::getRestaurant($db, $dish->restaurantId);

    if($restaurant->owner !== Costumer::getUserId($db, $session->getId()))
        die(header('Location: /'));

    $file = $_FILES['image'];

    if(!uploadImage($file, 'dishes', $dish->id, 158, 0.98726114649)){
        $session->addMessage('error', 'failed to upload image');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>