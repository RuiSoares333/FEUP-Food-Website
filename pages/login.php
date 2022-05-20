<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    session_start();

    outputHead();
    outputHeader();
    outputAds();
    outputSideMenu();
    ouputLoginForm();
    outputFooter();
?>           
