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

    if(trim($_POST['review']) !== ''){
       Review::addReviewWithComment($db, array(intval($_GET['id']), $_SESSION['id'], intval($_POST['rating']), trim($_POST['review'])));
    }
    else{
        Review::addReview($db, array(intval($_GET['id']), $_SESSION['id'], intval($_POST['rating'])));
    }

    header('Location:' . $_SERVER['HTTP_REFERER']);
?>