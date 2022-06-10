<?php
    declare(strict_types = 1);

    function outputRestaurant(Restaurant $restaurant) { ?>
        <article class="miniPreview">
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>"></a>
        <div class="categories">
        <?php foreach($restaurant->categories as $category){
                ?> <p><?=$category?></p> <?php
        } ?>
        </div>
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><span><?=$restaurant->name?></span></a>
        <?php if ($restaurant->avgRating === -1.0){ ?>
            <p>no rating</p>
        <?php } else {?>
        <p><?=$restaurant->avgRating?>/10</p>
        <?php } ?>
        <p><?=$restaurant->address?></p>
        <p>Preço médio:<?=$restaurant->avgPrice?>€</p>
        </article>
    <?php }

    function outputOwnedRestaurant(Restaurant $restaurant) { ?>
        <article class="miniPreview">
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>"></a>
        <div class="categories">
        <?php foreach ($restaurant->categories as $category){
                ?> <p><?=$category?></p> <?php
        } ?>
        </div>
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><span><?=$restaurant->name?></span></a>
        <?php if ($restaurant->avgRating === -1.0){ ?>
            <p>no rating</p>
        <?php } else {?>
        <p><?=$restaurant->avgRating?>/10</p>
        <?php } ?>
        <p><?=$restaurant->address?></p>
        <p>Preço médio:<?=$restaurant->avgPrice?>€</p>
        <p><a href ="../actions/action_delete_restaurant.php?id=<?=$restaurant->id?>">Delete</a><p>
        </article>
    <?php }

    function outputFavoriteRestaurants(array $restaurants){?>
        <section id="favRestaurants">
            <h1>Your Favorite Restaurants</h1>
       <?php 
        if($restaurants) {
            ?>
            <section id="listRestaurants">
            <?php
            foreach($restaurants as $restaurant){
                outputRestaurant($restaurant);
            }
            ?>
            </section>
            <?php
        }
        else{
            ?> <h3>You don't have any favorite Restaurants</h3> <?php
        }
        ?>
        </section>
    <?php }

    function outputOwnedRestaurants(array $restaurants){ ?>
        <section id="myRestaurants">
            <h1>Your Restaurants</h1>
            <section id="listRestaurants">
            <?php if($restaurants){
                foreach($restaurants as $restaurant)
                    outputOwnedRestaurant($restaurant);
            }?>
            </section>
        </section>
    <?php }

    function outputBestRestaurants(array $restaurants) { ?>
        <section id = "bestRestaurants">
        <h1>most legit restaurants</h1>    
        <input type="radio" name="slider" id="slide1" checked>
        <input type="radio" name="slider" id="slide2">
        <div id="slides">
        <div id="overflow">
        <div class="inner">
        <?php   
            $k=1;
            for($i=0; $i<10; $i+=5){ ?>
                <div class="slide slide_<?=$k?>">
                    <div class="slide-content">
                    <?php for($j=$i; $j<$i+5; $j++){
                        outputRestaurant($restaurants[$j]);
                        if($j===5){
                            $j+=5;
                        }
                    }
                    ?>
                    </div>
                </div>
                <?php $k+=1;
            } ?>
        </div>
        </div>
        </div>
        <div id="controls">
            <label for="slide1">➤</label>
            <label for="slide2">➤</label>
        </div>    
        </section>
    <?php }


    function outputSingleRestaurant(Restaurant $restaurant, Costumer $user = null) { ?>
        <section id = "restaurant">
        <img src="https://picsum.photos/200?'<?=$restaurant->id?>">
        <p><?=$restaurant->name?> </p>
        <section>
        <?php foreach($restaurant->categories as $category){
            ?> <p><?=$category?> </p> <?php
        } ?>
        </section>
        <p><?=$restaurant->address?></p><?php

        if($restaurant->avgRating === -1.0){
            ?> <p>no rating</p> <?php
        } else {?>
        <p><?=$restaurant->avgRating?>/10</p> <?php } ?>

        <?php if(isset($user) && $restaurant->owner === $user->username){ ?>
            <a href="../pages/edit_restaurant.php?id=<?=$restaurant->id?>">Edit Restaurant</a>
        <?php } ?>
        </section>
    <?php }

    function outputRestaurantSideMenu(array $categories){ 
        ?>
        <nav id = "side-menu" class = "restaurant">
            <ul>
            <?php
        foreach($categories as $category){
        ?> <li><a href="#<?=$category['category']?>"><?=str_replace('_', ' ', $category['category'])?></a></li> <?php
        }?>
            </ul>
        </nav>
    <?php }  


    function outputSearchResults(array $restaurants){ ?>
        <div id = "mainDiv" class = "search">
            <?php foreach($restaurants as $restaurant){
                outputRestaurant($restaurant);
            } ?> 
        </div>
    <?php }

?>