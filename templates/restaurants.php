<?php
    function outputRestaurant(array $restaurant) {
        echo '<article>';
        echo '<a href = "restaurant.php?id='.$restaurant['id'].'"><img src="https://picsum.photos/200?1"></a>';
        echo '<p>'.$restaurant['category'].'</p>';
        echo '<a href = "restaurant.php?id='.$restaurant['id'].'"><span>'.$restaurant['name'].'</span></a>';
        echo '<p>'.$restaurant['rating'].'/10</p>';
        echo '<p>'.$restaurant['adress'].'</p>';
        echo '<p>Preço médio: '.$restaurant['price'].'€</p>';
        echo '</article>';
    }

    function outputRestaurants(array $restaurants) { 
        echo '<section id = "bestRestaurants">';
        foreach ($restaurants as $restaurant)
            outputRestaurant($restaurant);
        echo '</section>';
    }
?>