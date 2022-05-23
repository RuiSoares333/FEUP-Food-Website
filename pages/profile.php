<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');
    require_once(__DIR__ . '/../templates/dish.tpl.php');
    require_once(__DIR__ . '/../templates/profile.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    session_start();

    if(!isset($_SESSION['id']))
        header('Location: /../pages/login.php');

    $costumer = Costumer::getCostumer($db, $_SESSION['id']);

    $restaurants = $costumer->getFavoriteRestaurants($db);
    $dishes = $costumer->getFavoriteDishes($db);

    outputHead();
    outputHeader();
    outputSideMenu();
    outputAds();
?>

    <div id="mainDiv" class="profile">
        <?php 
        outputProfileInfo($costumer);
        outputFavoriteRestaurants($restaurants);
        outputFavoriteDishes($dishes);
        ?>
    </div>
    <?php
        outputFooter();
    ?>

