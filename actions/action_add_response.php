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

    if(trim($_POST['response']) === ''){
        $session->addMessage('error', 'couldn\'t submit response');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $user = Costumer::getCostumer($db, $_GET['user']);

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['restaurant']));

    if($restaurant->owner !== $user->id){
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $response = new Response(
        1,
        intval($_GET['review']),
        $user->name,
        intval($_POST['date']),
        $_POST['response']
    );

    $response->add($db, $user->id);

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>