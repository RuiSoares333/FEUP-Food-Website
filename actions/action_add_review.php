<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/review.class.php');

    if(strcmp($_SERVER['REQUEST_METHOD'], 'POST')!== 0){
        header("Location: /");
        die;
    }

    session_start();

    if(!isset($_SESSION['id']))
        header("Location:" . $_SERVER['HTTP_REFERER']);

    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if($_POST['review'] !== ''){
       Review::addReviewWithComment($db, intval($_POST['restaurant']), $_SESSION['id'], intval($_POST['rating']), $_POST['review']);
    }
    else{
        Review::addReview($db, intval($_POST['restaurant']), $_SESSION['id'], intval($_POST['rating']));
    }

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>