<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

    class Dish {
        const DEFAULT_IMG = 0;
        public int $id;
        public string $name;
        public float $price;
        public int $restaurantId;

        public function __construct(int $id, string $name, float $price, int $restaurantId = 0) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->restaurantId = $restaurantId;
        }

        static function getCategoryDishes(PDO $db, int $restaurant, string $category){
            $query = 'SELECT id, name, price FROM Dish 
            WHERE restaurantId = ? AND category = ?';
            
            $dishes = getQueryResults($db, $query, true, array($restaurant, $category));

            $dishes_ = array();
            foreach($dishes as $dish){
                $dishes_[] = new Dish(
                    $dish['id'],
                    $dish['name'],
                    $dish['price']
                );
            }

            return $dishes_;
        }
 
        static function getDish(PDO $db, int $id) : Dish {
            $query = 'SELECT id, name, price, restaurantId
            FROM Dish WHERE id = ?';

            $dish = getQueryResults($db, $query, false, array($id));

            return new Dish(
                $dish['id'],
                $dish['name'],
                $dish['price'],
                $dish['restaurantId']
            );
        }

        static function getDishes(PDO $db, int $id) : array {
            $query = 'SELECT id, name, price FROM Dish
            WHERE restaurantId = ?';

            $dishes = getQueryResults($db, $query, true, array($id));

            $dishes_ = array();

            foreach($dishes as $dish){
                $dishes_[] = new Dish(
                    $dish['id'],
                    $dish['name'],
                    $dish['price']
                );
            }
            return $dishes_;
        }

        function delete(PDO $db){
            $query = 'DELETE FROM dish WHERE id = ?';

            executeQuery($db, $query, array($this->id));

            $query = 'DELETE FROM FavoriteDish WHERE dishId = ?';

            executeQuery($db, $query, array($this->id));
        }

        function add(PDO $db, string $category){
            $query = 'INSERT INTO dish VALUES(NULL, ?, ?, ?, ?)';

            executeQuery($db, $query, array($this->name, $this->price, $category, $this->restaurantId));
        }

        static function deleteRestaurantDishes($db, $restaurant){
            $query = 'SELECT id FROM dish WHERE restaurantId = ?';

            $dishes = getQueryResults($db, $query, true, array($restaurant));

            foreach($dishes as $dish){
                $query = 'DELETE FROM FavoriteDish WHERE dishId = ?';

                executeQuery($db, $query, array($dish['id']));
            }

            $query = 'DELETE FROm dish WHERE restaurantId = ?';

            executeQuery($db, $query, array($restaurant));
        }
    }

?>
