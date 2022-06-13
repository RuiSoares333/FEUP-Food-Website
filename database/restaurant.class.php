<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/review.class.php');

    class Restaurant {
        public int $id;
        public string $name;
        public string $address;
        public array $categories;
        public string $phone;
        public int $owner;
        public array $dishCategories;
        public array $reviews;
        public float $avgPrice;
        public float $avgRating;


        public function __construct(int $id, string $name, string $address, array $categories, string $phone, int $owner, array $dishCategories = array(), array $reviews = array(), float $avgPrice = 0, float $avgRating = -1) {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->categories = $categories;
            $this->phone = $phone;
            $this->owner = $owner;
            $this->dishCategories = $dishCategories;
            $this->reviews = $reviews;
            $this->avgPrice = $avgPrice;
            $this->avgRating = $avgRating;
        }

        static function getBestRestaurants(PDO $db) : array {
            $query = 'SELECT Restaurant.*, IFNULL(round(avg(Review.rating),1), -1) as rating, IFNULL(round(avg(Dish.price),2), 0) as price
            FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.restaurantId 
            LEFT JOIN Dish ON Restaurant.id = dish.restaurantId
            GROUP BY Restaurant.id
            ORDER BY rating DESC
            LIMIT 10;';
    
            $restaurants = getQueryResults($db, $query);

            $restaurants_ = array();
            foreach($restaurants as $restaurant){
                $query = 'SELECT category FROM RestaurantCategory WHERE restaurant = ?';

                $categories = getQueryResults($db, $query, true, array($restaurant['id']));

                $categories_ = array();
                foreach($categories as $category){
                    $categories_[] = $category['category'];
                }

                $restaurants_[] = new Restaurant(
                    $restaurant['id'],
                    $restaurant['name'],
                    $restaurant['address'],
                    $categories_,
                    $restaurant['phone'],
                    $restaurant['ownerId'],
                    array(), array(),
                    $restaurant['price'],
                    $restaurant['rating']
                );
            }
            
            return $restaurants_;
        }

        static function getRestaurant(PDO $db, int $id) : Restaurant {
            $query = 'SELECT Restaurant.*, IFNULL(round(avg(Review.rating),1), -1) as rating, IFNULL(round(avg(Dish.price),2), 0) as price
            FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.restaurantId
            LEFT JOIN dish ON Restaurant.id = dish.restaurantId
            WHERE Restaurant.id = ?
            GROUP BY Restaurant.id';

            $restaurant = getQueryResults($db, $query, false, array($id));

            $reviews = Review::getReviews($db, $id);

            $categories = Restaurant::getDishCategories($db, $id);
            Restaurant::orderCategories($categories);

            $query = 'SELECT category FROM RestaurantCategory WHERE restaurant = ?';

            $restaurantCategories = getQueryResults($db, $query, true, array($id));

            $categories_ = array();

            foreach($restaurantCategories as $category){
                $categories_[] = $category['category'];
            }


            return new Restaurant(
                $restaurant['id'],
                $restaurant['name'],
                $restaurant['address'],
                $categories_,
                $restaurant['phone'],
                $restaurant['ownerId'],
                $categories,
                $reviews,
                $restaurant['price'],
                $restaurant['rating']
            );
        }

        static function getFavoriteRestaurant(PDO $db, int $id) : Restaurant {
            $query = 'SELECT Restaurant.*, IFNULL(round(avg(Review.rating),1), -1) as rating, round(avg(Dish.price),2) as price
            FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.restaurantId 
            LEFT JOIN Dish ON Restaurant.id = dish.restaurantId WHERE Restaurant.id = ?';

            $restaurant = getQueryResults($db, $query, false, array($id));

            $query = 'SELECT category FROM RestaurantCategory WHERE restaurant = ?';

            $categories = getQueryResults($db, $query, true, array($id));

            $categories_ = array();

            foreach($categories as $category) {
                $categories_[] = $category['category'];
            }

            return new Restaurant(
                $restaurant['id'],
                $restaurant['name'],
                $restaurant['address'],
                $categories_,
                $restaurant['phone'],
                $restaurant['ownerId'],
                array(), array(),
                $restaurant['price'],
                $restaurant['rating']
            );
        }

        static function getDishCategories(PDO $db, int $id) : array {
            $query = 'SELECT DISTINCT category 
            FROM Dish WHERE restaurantId = ?';
            return getQueryResults($db, $query, true,  array($id));
        }

        static function orderCategories(array &$categories){
            foreach($categories as &$category){
                switch($category['category']){
                    case "appetizer":
                        $category['order'] = 0;
                        break;
                    case "soup":
                        $category['order'] = 1;
                        break;
                    case "main course":
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
        
        function save(PDO $db){
            $query = 'UPDATE Restaurant SET name = ?, address = ?, phone = ? WHERE id = ?';

            executeQuery($db, $query, array($this->name, $this->address, $this->phone, $this->id));

            $query = 'DELETE FROM RestaurantCategory WHERE restaurant = ?';

            executeQuery($db, $query, array($this->id));

            foreach($this->categories as $category){
                $query = 'INSERT INTO RestaurantCategory VALUES (?, ?)';

                executeQuery($db, $query, array($this->id, $category));
            }
        }


        function delete(PDO $db){
            $query = 'DELETE FROM Restaurant WHERE id = ?';

            executeQuery($db, $query, array($this->id));

            $query = 'DELETE FROM FavoriteRestaurant WHERE restaurantId = ?';

            executeQuery($db, $query, array($this->id));

            $query = 'DELETE FROM RestaurantCategory WHERE restaurant = ?';

            executeQuery($db, $query, array($this->id));

            $query = 'DELETE FROM Ord WHERE restaurantId = ?';

            executeQuery($db, $query, array($this->id));
        }

        function add(PDO $db){
            $query = 'INSERT INTO Restaurant VALUES (NULL, ?, ?, ?, ?)';

            executeQuery($db, $query, array($this->name, $this-> address, $this->phone, $this->owner));

            $id = $db->lastInsertId();

            foreach($this->categories as $category){
                $query = 'INSERT INTO RestaurantCategory VALUES(?, ?)';

                executeQuery($db, $query, array(intval($id), $category));
            }
        }

        static function searchRestaurants(PDO $db, string $search, bool $order, string $category, int $minRating) : array{
            if($order){
                $query = 'SELECT Restaurant.*, IFNULL(round(avg(Review.rating),1), -1) as rating, round(avg(Dish.price),2) as price 
                    FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.RestaurantId LEFT JOIN Dish ON Restaurant.id = Dish.RestaurantId LEFT JOIN RestaurantCategory ON Restaurant.id = RestaurantCategory.restaurant
                    WHERE (Restaurant.name LIKE ? OR Dish.name LIKE ?) AND RestaurantCategory.category LIKE ? AND rating >= ?
                    GROUP BY Restaurant.id
                    ORDER BY price DESC';
            }else {
                $query = 'SELECT Restaurant.*, IFNULL(round(avg(Review.rating),1), -1) as rating, round(avg(Dish.price),2) as price 
                    FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.RestaurantId LEFT JOIN Dish ON Restaurant.id = Dish.RestaurantId LEFT JOIN RestaurantCategory ON Restaurant.id = RestaurantCategory.restaurant
                    WHERE (Restaurant.name LIKE ? OR Dish.name LIKE ?) AND RestaurantCategory.category LIKE ? AND rating >= ?
                    GROUP BY Restaurant.id
                    ORDER BY price ASC';
            }


            $restaurants = getQueryResults($db, $query, true, array($search . '%', $search . '%', $category . '%', $minRating));

            $restaurants_ = array();

            foreach($restaurants as $restaurant){
                $query = 'SELECT category FROM RestaurantCategory WHERE restaurant = ?';

                $categories = getQueryResults($db, $query, true, array($restaurant['id']));

                $categories_ = array();
                foreach($categories as $category){
                    $categories_[] = $category['category'];
                }

                $restaurants_[] = new Restaurant(
                    $restaurant['id'],
                    $restaurant['name'],
                    $restaurant['address'],
                    $categories_,
                    $restaurant['phone'],
                    $restaurant['ownerId'],
                    array(), array(),
                    $restaurant['price'],
                    $restaurant['rating'],
                );
            }

            return $restaurants_;
        }


        static function getAllCategories(PDO $db) : array {
            $query = 'SELECT name FROM Category';
            return getQueryResults($db, $query, true);
        }
    }
?>