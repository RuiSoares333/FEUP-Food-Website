<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if($session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }
    
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');
    require_once(__DIR__ . '/../templates/headfiles.tpl.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $categories = Restaurant::getAllCategories($db);

    outputHead();
    register_head();
    outputHeader($session, $categories, $costumer);
    outputSideMenu($categories);
    outputAds();
    outputRegisterForm();
    outputFooter()
?>


