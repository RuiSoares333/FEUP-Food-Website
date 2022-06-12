<?php
    declare(strict_types = 1);

    enum orderState: string {
        case received = 'received';
        case preparing = 'preparing';
        case ready = 'ready';
        case delivered = 'delivered';
    }

    class Order {
        public int $id;
        public int $costumer;
        public int $restaurant;
        public array $dishes;
        public int $price;
        public orderState $state;

        function __construct(int $id, int $costumer, int $restaurant, array $dishes, int $price, OrderState $state){
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

        function save(PDO $db){
            $query = 'INSERT INTO Ord VALUES (NULL, ?, ?, ?, ?)';

            executeQuery($db, $query, array($this->costumer, $this->restaurant, $this->price, $this->state));

            $id = $db->lastInsertId();

            foreach($this->dishes as $dish){
                $query = 'INSERT INTO OrderDish VALUES (?, ?, ?)';

                executeQuery($db, $query, array($id, $dish['id'], $dish['quantity']));
            }
        }

        
    }
?>  