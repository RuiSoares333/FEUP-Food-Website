<?php
    declare(strict_types = 1);

    function outputRestaurant(Restaurant $restaurant) { ?>
        <article class="miniPreview">
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
        <h1>most legit restaurants</h1>
            <?php
                echo '<div id="slides">';
                echo '<div id="overflow">';
                echo '<div class="inner">';
                outputSliders();
                for($i=0; $i<3; $i+=5){
                    $k=1;
                    echo '<div class="slide slide_'.$k.'">';
                    echo '<div class="slide-content">';
                    for($j=$i; $j<3; $j++){
                        outputRestaurant($restaurants[$j]);
                    }
                    echo '</div>';
                    echo '</div>';
                    $k++;
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div id="controls">';
                for($i=1; $i<5; $i++){
                    echo '<label for="slide'.$i.'">➤</label>';
                }
                echo '</div>';
            ?>
        </section>
    <?php }

    function outputSliders(){
        for($i=1; $i<=2; $i++){
            if($i==1)
                echo '<input type="radio" name="slider" id="slide"'.$i.'" checked>';
            else
                echo '<input type="radio" name="slider" id="slide"'.$i.'">';
        }
    }


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