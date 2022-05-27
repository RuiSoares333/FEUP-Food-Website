<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    session_start();

    if(!isset($_SESSION['id'])){
        die(header('Location: /'));
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');
    
    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    if($restaurant->owner !== $_SESSION['id']){
        die(header('Location: /'));
    }

    Restaurant::updateRestaurant($db, array($_POST['name'], $_POST['address'], $_POST['category'], $_POST['phone'], intval($_GET['id'])));

    header('Location: ../pages/restaurant.php?id=' . $_GET['id']);
?>