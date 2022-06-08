<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');


    $restaurants = Restaurant::searchRestaurants($db, trim($_POST['search']), isset($_POST['order']), $_POST['category'], intval($_POST['rating']));

    echo json_encode($restaurants);
?>