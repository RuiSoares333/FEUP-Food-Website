<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');
    require_once(__DIR__ . '/../templates/headfiles.tpl.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $owner = Costumer::getCostumer($db, $session->getId());

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    $categories = Restaurant::getAllCategories($db);

    if($owner->id !== $restaurant->owner){
        die(header('Location: /'));
    }

    outputHead();
    edit_restaurant_head();
    outputHeader($session, $categories, $owner);
    outputEditRestaurantSideMenu();
    outputAds();
    outputEditRestaurantForm($restaurant, $categories);
    outputFooter();
    
?>