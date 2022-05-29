<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if($session->isLoggedin()){
        header('Location: ../pages/index.php');
        die;
    }


    outputHead();
    outputHeader($session);
    outputAds();
    outputSideMenu();
    outputRegisterForm();
    outputFooter()
?>


