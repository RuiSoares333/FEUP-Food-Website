<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $categories = Restaurant::getAllCategories($db);

    if($session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }


    outputHead();
    outputHeader($session, $categories);
    outputAds();
    outputSideMenu($db);
    outputRegisterForm();
    outputFooter()
?>


