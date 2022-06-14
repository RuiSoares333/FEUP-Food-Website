<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();
    
    if(!$session->isLoggedin()){
        die(header('Location: ../pages/login.php'));
    }
    
    require_once(__DIR__ . '/../utils/image.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    
    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $id = trim(preg_replace("/[\D]/", '', $id));

    if(!$id){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $restaurant = Restaurant::getRestaurant($db, intval($id));

    if($restaurant->owner !== Costumer::getUserId($db, $session->getId())){
        $session->addMessage('error', 'failed to upload image');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $file = $_FILES['image'];

    if(!uploadImage($file, 'restaurants/main_page', $restaurant->id, 1186, 2.36726546906)){
        $session->addMessage('error', 'failed to upload image');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    uploadImage($file, 'restaurants/miniPreview', $restaurant->id, 146, 1.168);

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>