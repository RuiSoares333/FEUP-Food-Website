<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    $costumer = Costumer::getCostumerWithPassword($db, $_POST['email'], $_POST['password']);

    if($costumer){
        $_SESSION['id'] = $costumer->username;
        $_SESSION['name'] = $costumer->name;
    }

    header('Location:' . $_POST['referer']);
?>