<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    
    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/response.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    $response = trim(preg_replace("/[^\w\s.,]/", '', $_POST['response']));

    if(!$response){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $user = Costumer::getCostumer($db, $session->getId());

    $restaurantId = trim(preg_replace("/[\D]/", '', $_POST['restaurant']));

    if(!$restaurantId){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    $restaurant = Restaurant::getRestaurant($db, intval($restaurantId));

    if($restaurant->owner !== $user->id){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $reviewId = trim(preg_replace("/[\D]/", '', $_POST['review']));

    if(!$reviewId){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    $date = trim(preg_replace("/[\D]/", '', $_POST['date']));

    if(!$date){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    $response = new Response(
        1,
        intval($reviewId),
        $user->name,
        intval($date),
        $response
    );

    $response->add($db, $user->id);

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>