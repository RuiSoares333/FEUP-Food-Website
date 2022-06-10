<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: pages/login.php'));
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    if(trim($_POST['name']) == ''){
        $session->addMessage('error', 'please fill all mandatory fields with the intended information');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }


    if(trim($_POST['address']) == ''){
        $session->addMessage('error', 'please fill all mandatory fields with the intended information');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }


    foreach($_POST['categories'] as $category){
        if(trim($category) === ''){
            session->addMessage('error', 'your restaurant needs at least one category');
            die(header('Location:' . $_SERVER['HTTP_REFERER']));
        }
    }


    if(trim($_POST['phone']) == ''){
        $session->addMessage('error', 'please fill all mandatory fields with the intended information');
        die(header('Location' . $_SERVER['HTTP_REFERER']));
    }

    $costumer = Costumer::getCostumer($db, $session->getId());
   
   
    $restaurant = new Restaurant(
        1,
        trim($_POST['name']),
        trim($_POST['address']),
        $_POST['categories'],
        trim($_POST['phone']),
        $costumer->id
    );
    
    $restaurant->add($db);

    $session->addMessage('Success', 'Restaurant added successfully!');



    if(!$costumer->isOwner()){
        $costumer->becomeOwner($db);
    }

    $session->setOwnedRestaurants($costumer->getOwnedRestaurants($db));

    header('Location: ../pages/profile.php');
?>