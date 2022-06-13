<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        header('Location: ../pages/login.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/order.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/headfiles.tpl.php');
    require_once(__DIR__ . '/../templates/order.tpl.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $user = Costumer::getCostumer($db, $session->getId());

    $completedOrders = Order::getUserDeliveredOrders($db, $user->id);
    $ongoingOrders = Order::getUserOrders($db, $user->id);

    $categories = Restaurant::getAllCategories($db);

    outputHead();
    orders_head();
    outputHeader($session, $categories, $user);
    outputSideMenu($categories);
    outputAds();
    outputOrders($ongoingOrders, $completedOrders);
    outputFooter();
?>