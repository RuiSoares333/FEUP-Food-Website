<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/order.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $user = Costumer::getUserId($db, $session->getId());

    $dishes_ = array();

    $total = 0;

    $restaurant = $_POST['restaurant'];

    $dishes = json_decode($_POST['dishes'], true);

    foreach ($dishes as $dish => $quantity) {
        $dishes_[] = array('id' => $dish, 'quantity' => $quantity); 
        $total += Dish::getDish($db, intval($dish))->price * intval($quantity);
    }


    $order = new Order(
        1,
        $user,
        intval($_POST['restaurant']),
        $dishes_,
        $total,
        orderState::received
    );

    $order->save($db);
?>

