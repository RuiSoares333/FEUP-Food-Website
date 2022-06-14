<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../../utils/session.php');

    $session = new Session();

    require_once(__DIR__ . '/../../database/connection.php');
    require_once(__DIR__ . '/../../database/costumer.class.php');

    $db = getDBConnection(__DIR__ . '/../../database/data.db');

    echo json_encode(Costumer::userExistsEmail($db, $_POST['email']));
?>