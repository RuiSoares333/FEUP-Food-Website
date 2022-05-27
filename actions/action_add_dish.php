<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    session_start();

    if(!isset($_SESSION['id']))
        die(header('Location: /'));

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    if($restaurant->owner !== $_SESSION['id'])
        die(header('Location: /'));

    Dish::addDish($db, array($_POST['name'], $_POST['price'], $_POST['category'], $_GET['id']));

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>