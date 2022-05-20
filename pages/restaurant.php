<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');
    require_once(__DIR__ . '/../templates/dish.tpl.php');
    require_once(__DIR__ . '/../templates/review.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
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
            outputRestaurantSideMenu($restaurant->dishCategories);
            ?><div id ="mainDiv" class="restaurant"> <?php
            outputSingleRestaurant($restaurant);   
            foreach($restaurant->dishCategories as $category){
                $dishes = Dish::getCategoryDishes($db, $restaurant->id, $category['category']);
                outputCategoryDishes($category, $dishes);
            }
            outputReviews($restaurant->reviews);
            ?></div><?php
            outputFooter();
        ?>
    </body>
</html>