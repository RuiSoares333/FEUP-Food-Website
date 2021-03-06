<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $id = trim(preg_replace("/[\D]/", '', $_GET['id']));

    if(!$id){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $restaurant = Restaurant::getRestaurant($db, intval($id));

    if(Costumer::getUserId($db, $session->getId()) !== $restaurant->owner){
        $session->addMessage('error', 'You don\'t own that restaurant');
        die(header('Location: /'));
    }

    $restaurant->delete($db);
    Dish::deleteRestaurantDishes($db, $restaurant->id);

    $costumer = Costumer::getCostumer($db, $session->getId());

    $restaurants = $costumer->getOwnedRestaurants($db);

    $session->setOwnedRestaurants($restaurants);

    if($session->getOwnedRestaurants() === array()){
        $costumer->noLongerOwner($db);
    }

    unlink('../assets/restaurants/main_page/' . $restaurant->id . '.webp');
    unlink('../assets/restaurants/minPreview/' . $restaurant->id . '.webp');

   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>