<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

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


    }
?>