<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: ../pages/index.php');
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    Costumer::updateUser($db, $_SESSION['id'], $_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone']);

    header('Location: ../pages/profile.php');
?>