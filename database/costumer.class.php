<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    class Costumer{
        public string $username;
        public string $name;
        public string $email;
        public string $adress;
        public string $phoneNumber;

        public function __construct(string $username, string $name, string $email, string $adress, string $phoneNumber){
            $this->username = $username;
            $this->name = $name;
            $this->email = $email;
            $this->adress = $adress;
            $this->phoneNumber = $phoneNumber;
        }

        static function getCostumerWithPassword(PDO $db, string $email, string $password) : ?Costumer {
            $query = 'SELECT username, name, email, adress, phone FROM User WHERE lower(email) = ? AND password = ?';

            if($costumer = getQueryResults($db, $query, false, array($email, $password))){
                return new Costumer(
                    $costumer['username'],
                    $costumer['name'],
                    $costumer['email'],
                    $costumer['adress'],
                    $costumer['phone']
                );
            }
            return null;
        }

        function getFavoriteDishes(PDO $db) : array {
            $query = 'SELECT dishId FROM FavoriteDish 
            WHERE userId = ?';

            $dishes = getQueryResults($db, $query, true, array($this->username));
            
            $dishes_ = array();

            foreach($dishes as $dish){
                $dishes_[] = getDish($db, $dish);
            }
            return $dishes_;
        }

        function getFavoriteRestaurants(PDO $db) : array {
            $query = 'SELECT restaurantId FROM FavoriteRestaurant 
            WHERE userId = ?';

            $restaurants = getQueryResults($db, $query, true, array($this->username));

            $restaurants_ = array();

            foreach($restaurants as $restaurant){
                $restaurants_[] = $getRestaurant($db, $restaurant);
            }

            return $restaurants_;
        }

    }
?>