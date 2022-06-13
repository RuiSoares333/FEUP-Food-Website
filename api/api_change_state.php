<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/order.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $order = Order::getOrder($db, intval($_POST['id']));

    $state = Order::getState($_POST['state']);

    $order->changeState($state, $db);
?>