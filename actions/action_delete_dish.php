<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    session_start();

    if(!isset($_SESSION['id']))
        die(header('Location: /'));

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $dish = Dish::getDish($db, intval($_GET['id']));
    $restaurant = Restaurant::getRestaurant($db, $dish->restaurantId);

    if($restaurant->owner !== $_SESSION['id'])
        die(header('Location: /'));

    Dish::deleteDish($db, $dish->id);

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>