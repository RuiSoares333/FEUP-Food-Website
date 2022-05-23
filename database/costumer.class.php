<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    class Costumer{
        public string $username;
        public string $name;
        public string $email;
        public string $address;
        public string $phoneNumber;
        public bool $is_owner;

        public function __construct(string $username, string $name, string $email, string $address, string $phoneNumber){
            $db = getDBConnection(__DIR__ . '/../database/data.db');

            $this->username = $username;
            $this->name = $name;
            $this->email = $email;
            $this->address = $address;
            $this->phoneNumber = $phoneNumber;
            $this->is_owner = Costumer::checkOwner($db, $username);
        }

        static function getCostumerWithPassword(PDO $db, string $email, string $password) : ?Costumer {
            $query = 'SELECT username, name, email, address, phone FROM User WHERE lower(email) = ? AND password = ?';

            if($costumer = getQueryResults($db, $query, false, array($email, sha1($password)))){
                return new Costumer(
                    $costumer['username'],
                    $costumer['name'],
                    $costumer['email'],
                    $costumer['address'],
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
                $dishes_[] = Dish::getDish($db, $dish['dishId']);
            }
            return $dishes_;
        }

        function getFavoriteRestaurants(PDO $db) : array {
            $query = 'SELECT restaurantId FROM FavoriteRestaurant 
            WHERE userId = ?';

            $restaurants = getQueryResults($db, $query, true, array($this->username));

            $restaurants_ = array();

            foreach($restaurants as $restaurant){
                $restaurants_[] = Restaurant::getRestaurant($db, $restaurant['restaurantId']);
            }

            return $restaurants_;
        }

        static function getCostumer(PDO $db, string $id) : Costumer {
            $query = 'SELECT username, name, email, address, phone
            FROM User WHERE username = ?';

            $user = getQueryResults($db, $query, false, array($id));

            return new Costumer(
                $user['username'],
                $user['name'],
                $user['email'],
                $user['address'],
                $user['phone']
            );
        }

        static function checkOwner(PDO $db, string $id) : bool {
            $query = 'SELECT * FROM Owner WHERE username = ?';

            $owner = getQueryResults($db, $query, false, array($id));

            if($owner)
                return true;

            return false;
        }

        function isOwner() : bool {
            return $this->is_owner;
        }

        function getOwnedRestaurants(PDO $db) : array {
            $query = 'SELECT id FROM Restaurant WHERE ownerId = ?';

            return getQueryResults($db, $query, false, array($this->username));
        }

        static function register(PDO $db, string $id, string $name, string $email, string $password, string $address, string $phone){
            $query = 'INSERT INTO User VALUES (?, ?, ?, ?, ?, ?)';

            return executeQuery($db, $query, array($id, $name, $email, sha1($password), $address, $phone));
        }


        static function userExists(PDO $db, string $id) : bool{
            $query = 'SELECT * FROM User WHERE username = ?';

            return !!getQueryResults($db, $query, false, array($id));
        }

        static function getName(PDO $db, string $username) : string{
            $query = 'SELECT name FROM User WHERE username = ?';

            return getQueryResults($db, $query, false, array($username))['name'];
        }
    }
?>