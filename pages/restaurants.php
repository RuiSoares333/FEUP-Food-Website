<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    outputHead();
    outputHeader($session);
    outputAds();
    outputSortSideMenu();
    outputFooter();
?>