<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        die(header('Location: pages/login.php'));
    }

    require_once(__DIR__ . '/../database/restaurant.class.php');

?>