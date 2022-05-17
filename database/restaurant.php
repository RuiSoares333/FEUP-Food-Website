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

    function getDishCategories(PDO $db, int $id): array| false{
        $query = 'SELECT DISTINCT category 
        FROM Dish WHERE restaurantId = ?';
        return getQueryResults($db, $query, true,  array($id));
    }

    function getDishes(PDO $db, int $id, string $category): array| false{
        $query = 'SELECT * 
        FROM Dish WHERE restaurantId = ? AND category = ?
        ';
        return getQueryResults($db, $query, true, array($id, $category));
    }
?>