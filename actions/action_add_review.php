<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/review.class.php');


    session_start();

    if(!isset($_SESSION['id'])){
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die;
    }


    $db = getDBConnection(__DIR__ . '/../database/data.db');

    if($_POST['review'] !== ''){
       Review::addReviewWithComment($db, array(intval($_GET['id']), $_SESSION['id'], intval($_POST['rating']), $_POST['review']));
    }
    else{
        Review::addReview($db, array(intval($_GET['id']), $_SESSION['id'], intval($_POST['rating'])));
    }

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>