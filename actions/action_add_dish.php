<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin())
        die(header('Location: /'));

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    if($restaurant->owner !== $session->getId)
        die(header('Location: /'));

    if(trim($_POST['name']) === ''){
        $session->addMessage('error', 'Dish name cannot be empty');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['price']) === ''){
        $session->addMessage('error', 'Dish needs to have a price');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    if(trim($_POST['category']) === ''){
        $session->addMessage('error', 'Dish needs a category');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    Dish::addDish($db, array($_POST['name'], intval($_POST['price']), $_POST['category'], $_GET['id']));

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>