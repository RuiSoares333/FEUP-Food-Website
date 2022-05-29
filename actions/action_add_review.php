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

    if(trim($_POST['rating']) === ''){
        $session->addMessage('error', 'please enter a rating');
    }

    $review = new Review(
        1,
        $session->getId(),
        intval($_POST['rating']),
        trim($_POST['review']) !== '' ? trim($_POST['review']) : null
    );

    $review->add($db, intval($_GET['id']));

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>