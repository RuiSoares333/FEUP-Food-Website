<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');
    require_once(__DIR__ . '/../templates/dish.tpl.php');
    require_once(__DIR__ . '/../templates/review.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $session = new Session();

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

    $categories = Restaurant::getAllCategories($db);

    if($session->isLoggedin())
        $user = Costumer::getCostumer($db, $session->getId());

    outputHead();
    outputHeader($session, $categories);
    outputAds();
    outputRestaurantSideMenu($restaurant->dishCategories);
    ?> <div id="mainDiv" class = "restaurant"> <?php
    outputSingleRestaurant($restaurant, $user);   
    ?> <section id = "dishes"> <?php
    foreach($restaurant->dishCategories as $category){
        $dishes = Dish::getCategoryDishes($db, $restaurant->id, $category['category']);
        outputCategoryDishes($category, $dishes);
    }
    ?></section> <?php
    outputReviews($restaurant->reviews, $db);
    if($session->isLoggedin())
        outputReviewForm();
    ?> </div> <?php   
    outputFooter();
?>
