<?php 
    require_once('connection.php');

    function getBestRestaurants(PDO $db): array| false{
        $query = 'SELECT Restaurant.*, avg(Review.rating) as rating, avg(Dish.price) as price
        FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.restaurantId 
        LEFT JOIN Dish ON Restaurant.id = dish.restaurantId
        GROUP BY Restaurant.id
        ORDER BY rating DESC
        LIMIT 10;';

        return getQueryResults($db, $query);
    }
?>