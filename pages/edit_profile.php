<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: ../pages/login.php');
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumer($db, $_SESSION['id']);

    outputHead();
    outputHeader();
    outputSideMenu();
    outputAds();
    ?> <div id = "mainDiv" class ="edit_profile"> <?php
    outputEditProfileForm($costumer);
    outputChangePasswordForm();
    ?> </div> <?php
    outputFooter();
?>