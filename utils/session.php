<?php
    class Session {
        private array $messages;

        public function __construct(){
            session_set_cookie_params(0, '/', 'www.fe.up.pt', true, true);
            session_start();
            $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
            unset($_SESSION['messages']);
        }

        public function isLoggedin() :bool {
            return isset($_SESSION['id']);
        }

        public function logout(){
            session_destroy();
        }

        public function getId() : ?string {
            return isset($_SESSION['id']) ? $_SESSION['id'] : null;
        }

        public function getName() : ?string {
            return isset($_SESSION['name']) ? $_SESSION['name'] : null;
        }

        public function getOwnedRestaurants() : ?array {
            return isset($_SESSION['restaurants']) ? $_SESSION['restaurants'] : null;
        }

        public function setId(string $id) {
            $_SESSION['id'] = $id;
        }

        public function setName(string $name) {
            $_SESSION['name'] = $name;
        }

        public function setOwnedRestaurants(array $restaurants){
            $_SESSION['restaurants'] = $restaurants;
        }

        public function addMessage(string $type, string $text) {
            $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
        }

        public function getMessages() : array {
            return $this->messages;
        }
    }
?>