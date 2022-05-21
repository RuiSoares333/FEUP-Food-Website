<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    session_start();

    if(isset($_SESSION['id']))
        header('Location:' . $_SERVER['HTTP_REFERER']);

    outputHead();
    outputHeader();
    outputAds();
    outputSideMenu();
    ouputLoginForm();
    outputFooter();
?>           
