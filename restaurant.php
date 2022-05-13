<?php
    require_once('templates/common.php');
    require_once('templates/restaurants.php');

    require_once('database/connection.php');
    require_once('database/restaurant.php');

    $db = getDBConnection('database/data.db');

    $restaurant = getSingleRestaurant($db, $_GET['id']);
?>


<!DOCTYPE html>
<html lang="en-US">
    <?php
        outputHead();
    ?>
    <body>
        <?php
            outputHeader();
            outputAds();
            
            outputRestaurant($restaurant);
            outputSideMenu();
            outputFooter();
        ?>
    </body>
</html>