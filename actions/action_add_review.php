<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/review.class.php');

    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if(!$session->isLoggedin()){
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die;
    }

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if(!$_POST['rating'] || !preg_match("/^10|[1-9]$/", trim($_POST['rating']))){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $date = trim(preg_replace("/[\D]/", '', $_POST['date']));

    if(!$date){
        $session->addMessage('error', 'FAILED OPERATION');
        die(header('Location:' . $_SERVER['HTTP_REFERER']));
    }

    $review = trim(preg_replace("/[^\w\s.,]/", '', $_POST['review']));

    $review = new Review(
        1,
        $session->getId(),
        intval(trim($_POST['rating'])),
        intval($date),
        $review ? $review : null,
        null
    );

    $review->add($db, intval($_GET['id']));

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>