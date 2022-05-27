<?php
    declare(strict_types = 1);

    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: ../pages/login.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if(!isset($_SESSION['id'])){
        die(header('Location: /'));
    }

    $owner = Costumer::getCostumer($db, $_SESSION['id']);

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    if($owner->username !== $restaurant->owner){
        die(header('Location: /'));
    }

    outputHead();
    outputHeader();
    outputSideMenu();
    outputAds();
    outputEditRestaurantForm($restaurant);
    outputFooter();
    
?>