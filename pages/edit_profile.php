<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');
    require_once(__DIR__ . '/../templates/headfiles.tpl.php');
    
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        header('Location: ../pages/login.php');
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumer($db, $session->getId());

    outputHead();
    edit_profile_head();
    outputHeader($session);
    outputSideMenu($db);
    outputAds();
    ?> <div id = "mainDiv" class ="edit_profile"> <?php
    outputEditProfileForm($costumer);
    outputChangePasswordForm();
    ?> </div> <?php
    outputFooter();
?>