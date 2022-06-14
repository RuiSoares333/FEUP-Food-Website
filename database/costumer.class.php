<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    class Costumer{
        public int $id;
        public string $username;
        public string $name;
        public string $email;
        public string $address;
        public string $phoneNumber;
        public bool $is_owner;

        public function __construct(int $id, string $username, string $name, string $email, string $address, string $phoneNumber, int $owner){
            $this->id = $id;
            $this->username = $username;
            $this->name = $name;
            $this->email = $email;
            $this->address = $address;
            $this->phoneNumber = $phoneNumber;
            $this->is_owner = $owner === 1;
        }

        static function login(PDO $db, string $username, string $password) : ?Costumer {
            $query = 'SELECT password FROM User WHERE username = ?';

            $password_ = getQueryResults($db, $query, false, array(strtolower($username)))['password'];

            if($password_ && password_verify($password, $password_)){
                $query = 'SELECT username, name, email, address, phone, owner, id FROM User WHERE username = ?';
                $costumer = getQueryResults($db, $query, false, array(strtolower($username)));
                return new Costumer(
                    $costumer['id'],
                    $costumer['username'],
                    $costumer['name'],
                    $costumer['email'],
                    $costumer['address'],
                    $costumer['phone'],
                    $costumer['owner']
                );
            }
            return null;
        }

        function getFavoriteDishes(PDO $db) : array {
            $dishes = $this->getFavoriteDishesIds($db);
            
            $dishes_ = array();

            foreach($dishes as $dish){
                $dishes_[] = Dish::getDish($db, $dish);
            }
            return $dishes_;
        }

        function getFavoriteDishesIds(PDO $db) : array {
            $query = 'SELECT dishId FROM FavoriteDish 
            WHERE userId = ?';

            $dishes = getQueryResults($db, $query, true, array($this->id));

            $dishes_ = array();

            foreach($dishes as $dish){
                $dishes_[] = $dish['dishId'];
            }
            return $dishes_;
        }

        function getFavoriteRestaurants(PDO $db) : array {
            $restaurants = $this->getFavoriteRestaurantsIds($db);

            $restaurants_ = array();

            foreach($restaurants as $restaurant){
                $restaurants_[] = Restaurant::getFavoriteRestaurant($db, $restaurant);
            }

            return $restaurants_;
        }

        function getFavoriteRestaurantsIds(PDO $db) : array {
            $query = 'SELECT restaurantId FROM FavoriteRestaurant 
            WHERE userId = ?';

            $restaurants = getQueryResults($db, $query, true, array($this->id));

            $restaurants_ = array();

            foreach($restaurants as $restaurant){
                $restaurants_[] = $restaurant['restaurantId'];
            }
            
            return $restaurants_;
        }

        static function getCostumer(PDO $db, string $id) : Costumer {
            $query = 'SELECT id, username, name, email, address, phone, owner
            FROM User WHERE username = ?';

            $user = getQueryResults($db, $query, false, array($id));

            return new Costumer(
                $user['id'],
                $user['username'],
                $user['name'],
                $user['email'],
                $user['address'],
                $user['phone'],
                $user['owner']
            );
        }

        function isOwner() : bool {
            return $this->is_owner;
        }

        function getOwnedRestaurants(PDO $db) : array {
            $query = 'SELECT id FROM Restaurant WHERE ownerId = ?';

            return getQueryResults($db, $query, true, array($this->id));
        }

        function register(PDO $db, string $password){
            $query = 'INSERT INTO User VALUES (NULL, ?, ?, ?, ?, ?, ?, false)';

            $options = ['cost' => 10];

            return executeQuery($db, $query, array(strtolower($this->username), $this->name, strtolower($this->email), password_hash($password, PASSWORD_BCRYPT, $options), $this->address, $this->phoneNumber));
        }


        static function userExistsUsername(PDO $db, string $id) : bool{
            $query = 'SELECT name FROM User WHERE username = ?';

            return !!getQueryResults($db, $query, false, array(strtolower($id)));
        }

        static function userExistsEmail(PDO $db, string $email) : bool {
            $query = 'SELECT * FROM User WHERE email = ?';

            return !!getQueryResults($db, $query, false, array(strtolower($email)));
        }

        static function userExistsPhone(PDO $db, string $phone) : bool{
            $query = 'SELECT * FROM USER WHERE phone = ?';
            
            return !!getQueryResults($db, $query, false, array($phone));
        }

        static function getName(PDO $db, string $username) : string{
            $query = 'SELECT name FROM User WHERE username = ?';

            return getQueryResults($db, $query, false, array($username))['name'];
        }


        function save(PDO $db){
            $query = 'UPDATE User SET name = ?, email = ?, address = ?, phone = ? WHERE username = ?';

            executeQuery($db, $query, array($this->name, tolower($this->email), $this->address, $this->phoneNumber, $this->username));
        }

        function updatePassword(PDO $db, string $newPassword){
            $query = 'UPDATE User SET password = ? WHERE username = ?';

            executeQuery($db, $query, array($newPassword, $this->username));
        }

        function checkOldPassword(PDO $db, string $oldPassword): bool{
            $query = 'SELECT password FROM User WHERE username = ?';

            $password = getQueryResults($db, $query, false, array($this->username))['password'];

            
            return password_verify($oldPassword, $password);
        }

        function noLongerOwner(PDO $db){
            $this->is_owner = false;

            $query = 'UPDATE User set owner = FALSE WHERE username = ?';

            executeQuery($db, $query, array($this->username));
        }

        function becomeOwner(PDO $db){
            $this->is_owner = true;

            $query = 'UPDATE User set owner = TRUE WHERE username = ?';

            executeQuery($db, $query, array($this->username));
        }

        static function getUserId(PDO $db, string $username) : int {
            $query = 'SELECT id FROM User WHERE username = ?';

            $id = getQueryResults($db, $query, false, array($username));

            return $id['id'];
        }

        static function getUserWithId($db, int $id) {
            $query = 'SELECT * FROM User WHERE id = ?';

            $user = getQueryResults($db, $query, false, array($id));

            return new Costumer(
                $user['id'],
                $user['username'],
                $user['name'],
                $user['email'],
                $user['address'],
                $user['phone'],
                $user['owner']
            );
        }
    }
?>