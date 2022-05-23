<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');
    require_once(__DIR__ . '/../templates/dish.tpl.php');

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    session_start();

    $costumer = Costumer::getCostumer($db, $_SESSION['id']);

    $restaurants = $costumer->getFavoriteRestaurants($db);
    $dishes = $costumer->getFavoriteDishes($db);

    outputHead();
    outputHeader();
?>

    <div id="mainDiv" class="faveRest">
        <?php 
        outputUserProfileForm($costumer);
        outputRestaurants($restaurants);
        outputDishes($dishes);
        ?>
    </div>
    <?php
        outputFooter();
    ?>

<?php
    function outputUserProfileForm(Costumer $costumer) { ?>
        <div id="mainDiv" class="userProfile">
            <img src="https://picsum.photos/300/200?a" alt="A beautiful random image">
            <p id="squareProfile"></p>
            <p><?=$costumer->username?> / User</p>
            
            <a class = "LoginLink" href="../pages/login.php"><h5>User Settings</h5></a>
        </div>
    <?php } 
?>

