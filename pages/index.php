<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/restaurants.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if(!($restaurants = getBestRestaurants($db)))
        die("Couldn't get restaurants");
?>

<!DOCTYPE html>
<html lang="en-US">
    <?php
        outputHead();
    ?>
    <body>
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
    </body>
</html>