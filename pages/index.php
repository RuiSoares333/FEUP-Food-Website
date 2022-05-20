<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    session_start();

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $restaurants = Restaurant::getBestRestaurants($db);
?>

    <?php
        outputHead();
    ?>
        <?php
            session_start();
            var_dump($_SESSION);
            outputHeader();
            outputSideMenu();
            outputAds();
        ?>
        <div id="mainDiv" class="index">
            <?php 
            outputSearch();
            outputRestaurants($restaurants);
            ?>
            <section id = "close">
                map api
            </section>
        </div>
        <?php
            outputFooter();
        ?>