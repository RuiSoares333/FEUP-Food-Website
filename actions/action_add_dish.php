<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if($_SESSION['crsf'] !== $_POST['crsf']){
        $session->addMessage('error', 'Ilegitimate request');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    if(!$session->isLoggedin())
        die(header('Location: /'));

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $restaurantId = trim(preg_replace("/[\D]/", '', $_GET['id']));

    if(!$restaurantId){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    $restaurant = Restaurant::getRestaurant($db, intval($restaurantId));

    if($restaurant->owner !== Costumer::getUserId($db, $session->getId()))
        die(header('Location: /'));

    $name = trim(preg_replace("/[^\w()]/", '', $_POST['name']));

    if(!$name){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $price = trim(preg_replace("/[\D]/", '', $_POST['price']));

    if(!$price){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $categories = array("appetizer", "drink", "soup", "main_course", "dessert");

    if(!array_search($_POST['category'], $categories)){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $dish = new Dish(
        1,
        $name,
        intval($price),
        intval($restaurantId)
    );

    $dish->add($db, $_POST['category']);

    $session->addMessage('success', 'DISH ADDED');

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>