<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $userId = Costumer::getUserId($db, $session->getId());

    if(intval($_POST['add']) === 1)
        $query = 'INSERT INTO FavoriteRestaurant VALUES(?, ?)';
    else
        $query = 'DELETE FROM FavoriteRestaurant WHERE restaurantId = ? AND userId = ?';

    list($result, $stmt) = executeQuery($db, $query, array(intval($_POST['restaurant'])), $userId);

    if($result){
        echo json_encode(array('statusCode'=>200));
    }
    else{
        echo json_encode(array('statusCode'=>201));
    }
?>