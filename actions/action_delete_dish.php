<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin())
        die(header('Location: ../pages/login.php'));

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $id = trim(preg_replace("/[\D]/", '', $_GET['id']));

    $dish = Dish::getDish($db, intval($id));

    $restaurant = Restaurant::getRestaurant($db, $dish->restaurantId);

    if($restaurant->owner !== Costumer::getUserId($db, $session->getId()))
        die(header('Location: /'));

    $dish->delete($db);

    unlink('../assets/dishes/' . $dish->id . '.webp');

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>