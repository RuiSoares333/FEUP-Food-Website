<?php
    declare(strict_types = 1);

    function outputFavoriteDishes(array $dishes) {?>
        <section id="favDishes">
            <h1>Your Favorite Dishes</h1>
        <?php if($dishes){
            ?>
            <section id="listDishes">
                <?php
                foreach($dishes as $dish){
                    outputFavoriteDish($dish);
                }
                ?>
            </section>
            <?php
        }
        else{
            ?> <h3>You don't have any favorite dishes</h3> <?php
        }
        ?>
        </section>
    </div>
    <?php }

    function outputFavoriteDish(Dish $dish){ 
        $dishImage = '../assets/dishes/' . $dish->id . '.webp';
        $defaultImage = '../assets/dishes/0.webp';
        $image = (file_exists($dishImage)) ? $dishImage : $defaultImage;
        ?>
        <article data-id = <?= $dish->id?> class ="dish">
        <a href="../pages/restaurant.php?id=<?=$dish->restaurantId?>">
        <img src = "<?=$image?>">
        <p><?= $dish->name?></p>
        <p><?= $dish->price?>€</p>
        </a>
        <button type="button" class="checked">star</button>
        </article>
    <?php }

    function outputDish(Dish $dish, bool $is_favorite, Session $session){
        $dishImage = '../assets/dishes/' . $dish->id . '.webp';
        $defaultImage = '../assets/dishes/0.webp ';
        $image = (file_exists($dishImage)) ? $dishImage : $defaultImage;
        ?>
        <article data-id = <?= $dish->id?> class ="dish">
            <img src = "<?=$image?>">
            <p><?= $dish->name?></p>
            <p><?= $dish->price?>€</p>
            <?php
                if($session->isLoggedin()){
                    ?> <button type="button" <?php if($is_favorite) echo 'class="checked"';?>>star</button><?php
                }
            ?>
        </article>
    <?php }

    function outputCategoryDishes(array $category, array $dishes, array $favorites, Session $session){ 
        ?>
        <section id = <?= $category['category']?>>
            <h1><?= str_replace('_',' ', $category['category'])?></h1>
            <?php
                foreach ($dishes as $dish)
                    outputDish($dish, array_search($dish->id, $favorites) !== false, $session);
            ?>
        </section>

    <?php }

    function outputMenuDish(Dish $dish){ 
        $dishImage = '../assets/dishes/' . $dish->id . '.webp';
        $defaultImage = '../assets/dishes/0.webp';
        $image = (file_exists($dishImage)) ? $dishImage : $defaultImage;
        ?>
        <article data-id = <?= $dish->id?>>
            <form method = "POST" action = "../actions/action_upload_dish.php?id=<?=$dish->id?>" enctype = "multipart/form-data" id ="upload">
                <input type ="file" id ="imgupload" name ="image" style="display:none"/>
                <button type ="button"><img src="<?=$image?>"></button>
            </form> 
            <p><?= $dish->name?></p>
            <p><?= $dish->price?>€</p>
            <a href = "../actions/action_delete_dish.php?id=<?= $dish->id?>">Delete</a>
        </article>
    <?php }

    function outputDishMenu(array $dishes){ ?>
        <div id ="mainDiv" class ="editRestaurant">
        <section id ="manageDishes">
            <h1>manage dishes</h1>
            <?php
            if(!$dishes){
                ?>
                echo '<h3>Your restaurant currently has no dishes</h3>';
                <?php
            }
            else{
                ?>
                <section id="listDishes">
                <?php
                    foreach ($dishes as $dish){
                        outputMenuDish($dish);
                    }
                ?>
                </section>
                <?php
            } ?>
        </section>
        </div>
    <?php }
?>