<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');
    require_once(__DIR__ . '/../templates/headfiles.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $restaurants = Restaurant::getBestRestaurants($db);

    $categories = Restaurant::getAllCategories($db);

    if($session->isLoggedin()){
        $costumer = Costumer::getCostumer($db, $session->getId());        
    }

    $favorites = isset($costumer) ? $costumer->getFavoriteRestaurantsIds($db) : array();

    outputHead();
    index_head();
    outputHeader($session, $categories, $costumer);
    echo '<div>';
    outputSideMenu($categories);
    outputAds();
?>        
    <div id="mainDiv" class="index">
        <?php 
        outputSearch($session);
        outputBestRestaurants($restaurants, $favorites, $session);
        ?>
        <section id = "close">
            map api
        </section>
    </div>
    <?php
        echo '</div>';
        outputFooter();
    ?>