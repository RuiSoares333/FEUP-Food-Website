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

    $owner = Costumer::getCostumer($db, $_SESSION['id']);

    $notOwner = true;

    if($owner->isOwner()){
        foreach($_SESSION['restaurants'] as $restaurant){
            if($restaurant['id'] === intval($_GET['id']))
                $notOwner = false;
        }
    }
    
    if($notOwner){
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die;
    }

    $restaurant = Restaurant::getRestaurant($db, $_GET['id']);

    outputHead();
    outputHeader();
    outputSideMenu();
    outputAds();
    outputEditRestaurantForm($restaurant);
    outputFooter();
    
?>