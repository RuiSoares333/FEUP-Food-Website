<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

    class Dish {
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

        static function deleteDish(PDO $db, int $id){
            $query = 'DELETE FROM dish WHERE id = ?';

            executeQuery($db, $query, array($id));
        }
    }

?>
