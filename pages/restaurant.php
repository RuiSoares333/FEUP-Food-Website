<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/restaurants.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if(!($restaurant = getSingleRestaurant($db, $_GET['id'])))
        die("Couldn't get restaurant");
    if(!($categories = getDishCategories($db, $_GET['id'])))
        die("Couldn't get categories");

    orderCategories($categories);
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
            outputRestaurantSideMenu($categories);
            ?><div id ="mainDiv" class="restaurant"> <?php
            outputSingleRestaurant($restaurant);   
            foreach($categories as $category){
                $dishes = getDishes($db, $_GET['id'], $category['category']);
                outputCategoryDishes($category, $dishes);
            }
            ?></div><?php
            outputFooter();
        ?>
    </body>
</html>