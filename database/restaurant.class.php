<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/review.class.php');

    class Restaurant {
        public int $id;
        public string $name;
        public string $address;
        public string $category;
        public array $dishCategories;
        public array $reviews;
        public float $avgPrice;
        public float $avgRating;


        public function __construct(int $id, string $name, string $address, string $category, array $dishCategories = array(), array $reviews = array(), float $avgPrice = 0, float $avgRating) {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->category = $category;
            $this->dishCategories = $dishCategories;
            $this->reviews = $reviews;
            $this->avgPrice = $avgPrice;
            $this->avgRating = $avgRating;
        }

        static function getBestRestaurants(PDO $db) : array {
            $query = 'SELECT Restaurant.*, avg(Review.rating) as rating, avg(Dish.price) as price
            FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.restaurantId 
            LEFT JOIN Dish ON Restaurant.id = dish.restaurantId
            GROUP BY Restaurant.id
            ORDER BY rating DESC
            LIMIT 10;';
    
            $restaurants = getQueryResults($db, $query);

            $restaurants_ = array();
            foreach($restaurants as $restaurant){
                $restaurants_[] = new Restaurant(
                    $restaurant['id'],
                    $restaurant['name'],
                    $restaurant['address'],
                    $restaurant['category'],
                    array(), array(),
                    $restaurant['price'],
                    $restaurant['rating']
                );
            }
            
            return $restaurants_;
        }

        static function getRestaurant(PDO $db, int $id) : Restaurant {
            $query = 'SELECT Restaurant.*, avg(Review.rating) as rating
            FROM Restaurant LEFT JOIN Review ON Restaurant.id = Review.restaurantId
            WHERE Restaurant.id = ?';

            $restaurant = getQueryResults($db, $query, false, array($id));

            $reviews = Review::getReviews($db, $id);

            $categories = Restaurant::getDishCategories($db, $id);
            Restaurant::orderCategories($categories);


            return new Restaurant(
                $restaurant['id'],
                $restaurant['name'],
                $restaurant['address'],
                $restaurant['category'],
                $categories,
                $reviews,
                0,
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

    }

    
?>