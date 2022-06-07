<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');

    require_once(__DIR__ . '/../utils/session.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $session = new Session();

    outputHead();
    outputHeader($session);
    outputAds();
    outputSortSideMenu($db);
    ?> <div id = "mainDiv" class = "search"></div> <?php
    outputFooter();
?>