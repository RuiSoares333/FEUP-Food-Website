<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');
    require_once(__DIR__ . '/../templates/dish.tpl.php');

    require_once(__DIR__ . '/../utils/session.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }

    $owner = Costumer::getCostumer($db, $session->getId());

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    $dishes = Dish::getDishes($db, intval($_GET['id']));

    if($owner->username !== $restaurant->owner){
        die(header('Location: /'));
    }

    outputHead();
    outputHeader($session);
    outputSideMenu($db);
    outputAds();
    ?> <div id ="mainDiv" class ="editRestaurant"> <?php
    outputEditRestaurantForm($restaurant);
    outputDishMenu($dishes);
    outputAddDishForm();
    ?> </div> <?php
    outputFooter();
    
?>