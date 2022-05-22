<?php
    declare(strict_types = 1);

    function outputRestaurant(Restaurant $restaurant) { ?>
        <article class="miniPreview">
        <a href = "../pages/restaurant.php?id=<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>"></a>
        <p><?=$restaurant->category?></p>
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

    function outputRestaurants(array $restaurants) { ?>
        <section id = "bestRestaurants">
        <h1>most legit restaurants</h1>
            <?php
                outputSliders();
                echo '<div id="slides">';
                echo '<div id="overflow">';
                echo '<div class="inner">';
                $k=1;
                for($i=0; $i<10; $i+=5){
                    echo '<div class="slide slide_'.$k.'">';
                    echo '<div class="slide-content">';
                    for($j=$i; $j<$i+5; $j++){
                        outputRestaurant($restaurants[$j]);
                        if($j===5){
                            $j+=5;
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    $k+=1;
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div id="controls">';
                for($i=1; $i<=2; $i++){
                    echo '<label for="slide'.$i.'">➤</label>';
                }
                echo '</div>';
            ?>
        </section>
    <?php }

    function outputSliders(){
        for($i=1; $i<=2; $i++){
            if($i==1)
                echo '<input type="radio" name="slider" id="slide'.$i.'" checked>';
            else
                echo '<input type="radio" name="slider" id="slide'.$i.'">';
        }
    }


    function outputSingleRestaurant(Restaurant $restaurant){ ?>
        <section id = "restaurant">
        <article>
        <img src="https://picsum.photos/200?'<?=$restaurant->id?>">
        <p><?=$restaurant->name?> </p>
        <p><?=$restaurant->category?> </p>
        <p><?=$restaurant->address?></p><?php

        if($restaurant->avgRating === -1.0){
            ?> <p>no rating</p> <?php
        } else {?>
        <p><?=$restaurant->avgRating?>/10</p> <?php } ?>
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