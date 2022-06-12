<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');
    require_once(__DIR__ . '/../templates/dish.tpl.php');
    require_once(__DIR__ . '/../templates/profile.tpl.php');
    require_once(__DIR__ . '/../templates/headfiles.tpl.php');
    
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $session = new Session();

    if(!$session->isLoggedin())
        header('Location: /../pages/login.php');

    $costumer = Costumer::getCostumer($db, $session->getId());

    $myRestaurants = array();

    if($costumer->isOwner()){
        foreach($costumer->getOwnedRestaurants($db) as $restaurant){
            $myRestaurants[] = Restaurant::getRestaurant($db, $restaurant['id']);
        }
    }

    $categories = Restaurant::getAllCategories($db);

    $restaurants = $costumer->getFavoriteRestaurants($db);
    $dishes = $costumer->getFavoriteDishes($db);

    outputHead();
    profile_head();
    outputHeader($session, $categories, $costumer);
    outputSideMenu($categories);
    outputAds();
    outputProfileInfo($costumer);
    if($costumer->isOwner())
        outputOwnedRestaurants($myRestaurants);
    outputFavoriteRestaurants($restaurants, $session);
    outputFavoriteDishes($dishes);
    outputFooter();
?>

