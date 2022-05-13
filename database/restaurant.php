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

    function getSingleRestaurant(PDO $db, int $id): array| false{
        $query = 'SELECT Restaurant.*, avg(Review.rating) as rating
        FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.restaurantId
        WHERE Restaurant.id = ?';
        return getQueryResults($db, $query, false, array($id));
    }
?>