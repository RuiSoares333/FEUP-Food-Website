<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    session_start();

    $restaurants = Restaurant::getBestRestaurants($db);
?>

    <?php
        outputHead();
    ?>
        <?php
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