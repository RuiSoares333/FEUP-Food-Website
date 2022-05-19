<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

    class Dish {
        public int $id;
        public string $name;
        public float $price;

        public function __construct(int $id, string $name, float $price){
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
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
    }

?>
