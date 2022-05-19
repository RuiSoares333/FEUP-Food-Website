<?php
    declare(strict_types = 1);

    function outputRestaurant(Restaurant $restaurant) { ?>
        <article>
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>"></a>
        <p><?=$restaurant->category?></p>
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><span><?=$restaurant->name?></span></a>
        <p><?=$restaurant->avgRating?>/10</p>
        <p><?=$restaurant->adress?></p>
        <p>Preço médio:<?=$restaurant->avgPrice?>€</p>
        </article>
    <?php }

    function outputRestaurants(array $restaurants) { 
        echo '<section id = "bestRestaurants">';
        foreach ($restaurants as $restaurant)
            outputRestaurant($restaurant);
        echo '</section>';
    }


    function outputSingleRestaurant(Restaurant $restaurant){ ?>
        <section id = "restaurant">
        <article>
        <img src="https://picsum.photos/200?'<?=$restaurant->id?>">
        <p><?=$restaurant->name?> </p>
        <p><?=$restaurant->category?> </p>
        <p><?=$restaurant->adress?></p>
        <p><?=$restaurant->avgRating?>/10</p>
        </article>
        </section>
    <?php }

    function outputRestaurantSideMenu(array $categories){
        echo '<nav id = "side-menu">';
        echo '<ul>';
        foreach($categories as $category){
            echo '<li><a href="#">' . $category['category'] . '</a></li>';
        }
        echo '</ul>';
        echo '</nav>';
    }  

?>