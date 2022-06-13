<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        header('Location: ../pages/login.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/order.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/headfiles.tpl.php');
    require_once(__DIR__ . '/../templates/order.tpl.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $user = Costumer::getCostumer($db, $session->getId());

    if(!$user->isOwner()){
        header('Location: ' . $_SERVER['HTTP_REFERER']); 
    }

    $restaurants = $user->getOwnedRestaurants($db);

    $orders_ = array();

    foreach($restaurants as $restaurant){
        $orders_[] = Order::getRestaurantOrders($db, $restaurant['id']);
    }

    $categories = Restaurant::getAllCategories($db);

    outputHead();
    restaurant_orders_head();
    outputHeader($session, $categories, $user);
    outputSideMenu($categories);
    echo '<div>';
    outputAds();
    outputOwnerOrders($orders_);
    echo '</div>';
    outputFooter();
?>