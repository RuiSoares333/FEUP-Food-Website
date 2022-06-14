<?php
    declare(strict_types = 1);

    function outputRestaurant(Restaurant $restaurant, bool $is_favorite, Session $session) { 
        $restaurantImage = '../assets/restaurants/miniPreview/' . $restaurant->id . '.webp';
        $defaultImage = '../assets/restaurants/miniPreview/0.webp';
        $image = (file_exists($restaurantImage)) ? $restaurantImage : $defaultImage;
        ?>
        <article class="miniPreview" data-id = <?= $restaurant->id?>>
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><img src="<?=$image?>"></a>
        <div class="categories">
        <?php 
                foreach($restaurant->categories as $category){
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
        <?php if($session->isLoggedin()){ ?>
        <button type="button" <?php if($is_favorite) echo 'class = "checked"'; else echo 'class = "unchecked"' ?>></button>            
       <?php } ?>
        </article>
    <?php }

    function outputOwnedRestaurant(Restaurant $restaurant) { 
        $restaurantImage = '../assets/restaurants/miniPreview/' . $restaurant->id . '.webp';
        $defaultImage = '../assets/restaurants/miniPreview/0.webp';
        $image = (file_exists($restaurantImage)) ? $restaurantImage : $defaultImage;
        ?>
        <article class="miniPreview">
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><img src="<?=$image?>"></a>
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

    function outputFavoriteRestaurants(array $restaurants, Session $session){?>
        <section id="favRestaurants">
            <h1>Your Favorite Restaurants</h1>
       <?php 
        if($restaurants) {
            ?>
            <section id="listRestaurants">
            <?php
            foreach($restaurants as $restaurant){
                outputRestaurant($restaurant, true, $session);
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

    function outputBestRestaurants(array $restaurants, array $favorites, Session $session) { ?>
        <section id = "bestRestaurants">
            <h1>most legit restaurants</h1>
            <div class="container">
                <div class="carousel">
                    <div class="slider">
                        <?php
                            for($i=0; $i<10; $i++){
                                ?><section><?php
                                    outputRestaurant($restaurants[$i], array_search($restaurants[$i]->id, $favorites) !== false, $session);
                                ?></section><?php
                            }
                        ?>
                    </div>
                    <div class="controls">
                        <button class="prev">➤</button>
                        <button class="next">➤</button>
                    </div>
                </div>
            </div>
        </section>
    <?php }


    function outputSingleRestaurant(Restaurant $restaurant, ?Costumer $user) { 
        $restaurantImage = '../assets/restaurants/main_page/' . $restaurant->id . '.webp';
        $defaultImage = '../assets/restaurants/main_page/0.webp';
        $image = (file_exists($restaurantImage)) ? $restaurantImage : $defaultImage;
        ?>
        <section id = "restaurant">
            <?php
            if(isset($user) && $restaurant->owner === $user->id){ ?>
                <form method = "POST" action = "../actions/action_upload_restaurant.php?id=<?=$restaurant->id?>" enctype = "multipart/form-data" id ="upload">
                    <input type ="file" id ="imgupload" name ="image" style="display:none"/>
                    <button type ="button"><img src="<?=$image?>"></button>
                </form>                
            <?php } 
            else {
               ?> <img src="<?=$image?>"> <?php
            }
            ?>
 
        <p><?=$restaurant->name?> </p>
        <section>
        <?php foreach($restaurant->categories as $category){
            ?> <p><?=$category?> </p> <?php
        } ?>
        </section>
        <p><?=$restaurant->address?></p>
        <p><?=$restaurant->phone?></p>
        <?php

        if($restaurant->avgRating === -1.0){
            ?> <p>no rating</p> <?php
        } else {?>
        <p><?=$restaurant->avgRating?>/10</p> <?php } ?>

        <?php if(isset($user) && $restaurant->owner === $user->id){ ?>
            <a href="../pages/edit_restaurant.php?id=<?=$restaurant->id?>">Edit Restaurant</a>
        <?php } ?>
        </section>
    <?php }

    function outputRestaurantSideMenu(array $categories){ 
        ?>
        <div>
        <input type="checkbox" id="responsiveSidebar"> 
        <label class="responsiveSidebar" for="responsiveSidebar"></label>
        <nav id = "side-menu" class = "restaurant">
            <ul>
            <?php
        foreach($categories as $category){
        ?> <li><a href="#<?=$category['category']?>"><?=str_replace('_', ' ', $category['category'])?></a></li> <?php
        }?>
            </ul>
        </nav>
    <?php }  


    function outputSearchResults(array $restaurants, array $favorites, Session $session){ ?>
        <div id = "mainDiv" class = "search">
            <?php 
                if($restaurants){
                    echo '<div id="listRestaurants">';
                    foreach($restaurants as $restaurant){
                        outputRestaurant($restaurant, array_search($restaurant->id, $favorites) !== false, $session);
                    }
                    echo '</div>';
                } else {
                    echo '<h1>No Restaurants Were Found</h1>';
                }
                 ?> 
        </div>
        </div>
    <?php }

?>