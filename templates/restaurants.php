<?php
    function outputRestaurant(array $restaurant) {
        echo '<article>';
        echo '<a href = "../pages/restaurant.php?id='.$restaurant['id'].'"><img src="https://picsum.photos/200?1"></a>';
        echo '<p>'.$restaurant['category'].'</p>';
        echo '<a href = "../pages/restaurant.php?id='.$restaurant['id'].'"><span>'.$restaurant['name'].'</span></a>';
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


    function outputSingleRestaurant(array $restaurant){
        echo '<section id = "restaurant">';
        echo '<article>';
        echo '<img src="https://picsum.photos/200?' . $restaurant['id'] . '">';
        echo '<p>' . $restaurant['name'] . '</p>';
        echo '<p>' . $restaurant['category'] . '</p>';
        echo '<p>' . $restaurant['adress'] .'</p>';
        echo '<p>' . $restaurant['rating'] . '/10</p>';
        echo '</article>';
        echo '</section>';
    }

    function outputRestaurantSideMenu(array $categories){
        echo '<nav id = "side-menu">';
        echo '<ul>';
        foreach($categories as $category){
            echo '<li><a href="#">' . $category['category'] . '</a></li>';
        }
        echo '</ul>';
        echo '</nav>';
    }


    function orderCategories(array &$categories): bool {
        foreach($categories as &$category){
            switch($category['category']){
                case "appetizer":
                    $category['order'] = 0;
                    break;
                case "soup":
                    $category['order'] = 1;
                    break;
                case "meat dish":
                case "fish dish":
                case "veggie dish":
                case "vegan dish":
                case "pizza":
                case "pasta":
                case "sushi":
                case "hamburger":
                    $category['order'] = 2;
                    break;
                case "drink":
                    $category['order'] = 3;
                    break;
                case "dessert":
                    $category['order'] = 4;
                    break;
                default: break;
            }
        }


        return uasort($categories, function ($item1, $item2) {
            return $item1['order'] <=> $item2['order'];
        });
    }   

    function outputDish(array $dish){
        echo '<article data-id = ' . $dish['id'] . '>';
        echo '<img src="https://picsum.photos/200?' . $dish['id'] . '">';
        echo '<p>' .$dish['name'] . '</p>';
        echo '<p>' .$dish['price'] . '€</p>';
        echo '</article>';
    }

    function outputCategoryDishes(array $category, array $dishes){
        echo '<section id = "' . $category['category'] . '">';
        echo '<h1>' . $category['category'] . '</h1>';
        foreach($dishes as $dish)
            outputDish($dish);
        echo '</section>';
    }
?>