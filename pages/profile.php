<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');
    require_once(__DIR__ . '/../templates/dish.tpl.php');
    require_once(__DIR__ . '/../templates/profile.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $session = new Session();

    if(!$session->isLoggedin())
        header('Location: /../pages/login.php');

    $costumer = Costumer::getCostumer($db, $session->getId());

    $myRestaurants = array();

    if($costumer->isOwner()){
        foreach($session->getOwnedRestaurants() as $restaurant){
            $myRestaurants[] = Restaurant::getRestaurant($db, $restaurant['id']);
        }
    }

    $restaurants = $costumer->getFavoriteRestaurants($db);
    $dishes = $costumer->getFavoriteDishes($db);

    outputHead();
    outputHeader($session);
    outputSideMenu();
    outputAds();
?>

    <div id="mainDiv" class="profile">
        <?php 
        outputProfileInfo($costumer);
        if($costumer->isOwner()){
            outputOwnedRestaurants($myRestaurants);
        }
        outputFavoriteRestaurants($restaurants);
        outputFavoriteDishes($dishes);
        ?>
    </div>
    <?php
        outputFooter();
    ?>

