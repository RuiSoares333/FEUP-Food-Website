<?php
    declare(strict_types = 1);

    function outputRestaurant(Restaurant $restaurant) { ?>
        <article>
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>"></a>
        <p><?=$restaurant->category?></p>
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><span><?=$restaurant->name?></span></a>
        <p><?=$restaurant->avgRating?>/10</p>
        <p><?=$restaurant->address?></p>
        <p>Preço médio:<?=$restaurant->avgPrice?>€</p>
        </article>
    <?php }

    function outputRestaurants(array $restaurants) { ?>
        <section id = "bestRestaurants">
            <?php
        foreach ($restaurants as $restaurant)
            outputRestaurant($restaurant);
            ?>
        </section>
    <?php }


    function outputSingleRestaurant(Restaurant $restaurant){ ?>
        <section id = "restaurant">
        <article>
        <img src="https://picsum.photos/200?'<?=$restaurant->id?>">
        <p><?=$restaurant->name?> </p>
        <p><?=$restaurant->category?> </p>
        <p><?=$restaurant->address?></p>
        <p><?=$restaurant->avgRating?>/10</p>
        </article>
        </section>
    <?php }

    function outputRestaurantSideMenu(array $categories){ ?>
        <nav id = "side-menu" class = "restaurant">
            <ul>
            <?php
        foreach($categories as $category){
        ?> <li><a href="#<?=$category['category']?>"><?=$category['category']?></a></li> <?php
        }?>
            </ul>
        </nav>
    <?php }  

?>