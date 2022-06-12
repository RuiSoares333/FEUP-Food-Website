<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');


    enum orderState: string {
        case received = 'received';
        case preparing = 'preparing';
        case ready = 'ready';
        case delivered = 'delivered';
    }

    class Order {
        public int $id;
        public Costumer $costumer;
        public Restaurant $restaurant;
        public array $dishes;
        public int $price;
        public orderState $state;

        function __construct(int $id, Costumer $costumer, Restaurant $restaurant, array $dishes, int $price, OrderState $state){
            $this->id = $id;
            $this->costumer = $costumer;
            $this->restaurant = $restaurant;
            $this->dishes = $dishes;
            $this->price = $price;
            $this->state = $state;
        }

        function changeState(orderState $state, PDO $db){
            $this->state = $state;

            $query = 'UPDATE Ord SET state = ? WHERE id = ?';

            executeQuery($db, $query, array($this->state->value, $this->id));
        }

        function save(PDO $db) {
            $query = 'INSERT INTO Ord VALUES (NULL, ?, ?, ?, ?)';

            list($result, $stmt) = executeQuery($db, $query, array($this->costumer->id, $this->restaurant->id, $this->price, $this->state->value));

            $id = $db->lastInsertId();

            foreach($this->dishes as $dish){
                $query = 'INSERT INTO OrderDish VALUES (?, ?, ?)';

                executeQuery($db, $query, array($id, $dish['dish']->id, $dish['quantity']));
            }
        }

        static function getUserDeliveredOrders(PDO $db, int $user) : array{
            $query = 'SELECT * FROM Ord WHERE userId = ? AND state = "delivered"';

            $orders = getQueryResults($db, $query, true, array($user));

            $orders_ = array();

            foreach($orders as $order){
                $query = 'SELECT dishId as dish, quantity FROM OrderDish WHERE orderId = ?';

                $dishes = getQueryResults($db, $query, true, array($order['id']));

                foreach($dishes as &$dish){
                    $dish['dish'] = Dish::getDish($db, $dish['dish']);
                }

                $user = Costumer::getUserwithId($db, $order['id']);

                $restaurant = Restaurant::getRestaurant($db, $order['restaurantId']);

                $orders_[] = new Order(
                    $order['id'],
                    $user,
                    $restaurant,
                    $dishes,
                    $order['price'],
                    orderState::delivered
                );
            }
            return $orders_;
        }

        static function getUserOrders(PDO $db, int $user) : array {
            $query = 'SELECT * FROM Ord WHERE userId = ? AND state != "delivered"';

            $orders = getQueryResults($db, $query, true, array($user));

            $orders_ = array();

            foreach($orders as $order){
                $query = 'SELECT dishId as dish, quantity FROM OrderDish WHERE orderId = ?';

                $dishes = getQueryResults($db, $query, true, array($order['id']));

                foreach($dishes as &$dish){
                    $dish['dish'] = Dish::getDish($db, $dish['dish']);
                }

                $user = Costumer::getUserwithId($db, $order['id']);

                $restaurant = Restaurant::getRestaurant($db, $order['restaurantId']);

                $orders_[] = new Order(
                    $order['id'],
                    $user,
                    $restaurant,
                    $dishes,
                    $order['price'],
                    Order::getState($order['state'])
                );
            }
            return $orders_;
        }


        static function getState(string $state) : orderState{
            switch($state){
                case 'received' : return orderState::received;
                case 'preparign' : return orderState:: preparing;
                case 'ready' : return orderState::ready;
            }
        }

        static function getRestaurantOrders(PDO $db, int $user) : array {
            $query = 'SELECT id, restaurantId, price, state
            FROM Ord WHERE restaurantId = ? AND state != "delivered"';

            $orders = getQueryResults($db, $query, true, array($user));

            $orders_ = array();

            foreach($orders as $order){
                $query = 'SELECT dishId as dish, quantity FROM OrderDish WHERE orderId = ?';

                $dishes = getQueryResults($db, $query, true, array($order['id']));

                foreach($dishes as &$dish){
                    $dish['dish'] = Dish::getDish($db, $dish['dish']);
                }

                $user = Costumer::getUserwithId($db, $order['id']);

                $restaurant = Restaurant::getRestaurant($db, $order['restaurantId']);

                $orders_[] = new Order(
                    $order['id'],
                    $user,
                    $restaurant,
                    $dishes,
                    $order['price'],
                    Order::getState($order['state'])
                );
            }

            return $orders_;
        }

    }
?>  