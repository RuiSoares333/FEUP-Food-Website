<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if($_SESSION['crsf'] !== $_POST['crsf']){
        $session->addMessage('error', 'Ilegitimate request');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    if(!$session->isLoggedin()){
        die(header('Location: /'));
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $id = trim(preg_replace("/[\D]/", '', $_GET['id']));

    if(!$id){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }
    
    $restaurant = Restaurant::getRestaurant($db, intval($id));

    if($restaurant->owner !== Costumer::getUserId($db, $session->getId())){
        die(header('Location: /'));
    }

    $name = trim(preg_replace("/[^\w\s]/", '', $_POST['name']));

    if(!$name){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    $address = trim(preg_replace("/[^\w\s,\.-]/", '', $_POST['address']));

    if(!$address){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    if(!$_POST['categories']){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $categories = Restaurant::getAllCategories($db);

    foreach($_POST['categories'] as $category){
        if(!array_search($category, $categories)){
            $session->addMessage('error', 'FAILED OPERATION');
            die(header('Location:' . $_SERVER['HTTP_REFERER']));
        }
    }

    $phone_pattern = '/^(?:9[1-36]\d|2[12]\d|2[35][1-689]|24[1-59]|26[1-35689]|27[1-9]|28[1-69]|29[1256])\d{6}$/';

    if(!preg_match($phone_pattern, trim($_POST['phone']))){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));        
    }

    $restaurant->name = $name;
    $restaurant->address = $address;
    $restaurant->categories = $_POST['categories'];
    $restaurant->phone = trim($_POST['phone']);

    $restaurant->save($db);

    $session->addMessage('success', 'restaurant updated!');

    header('Location: ../pages/restaurant.php?id=' . $restaurant->id);
?>