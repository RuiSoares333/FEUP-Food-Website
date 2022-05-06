<?php
    require_once('templates/common.php');
    require_once('templates/restaurants.php');

    require_once('database/connection.php');
    require_once('database/restaurant.php');

    $db = getDBConnection('database/data.db');

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
        <div class="mainDiv">
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