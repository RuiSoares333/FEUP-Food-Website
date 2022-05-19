<?php
    declare(strict_types = 1);

    function outputReview(Review $review){ ?>
        <article data-review-id = <?= $review->id?>>
            <span><?=$review->username?></span>
            <h5><?=$review->rating?>/10</h5>
            <p><?=$review->comment?></p>
        </article> 
    <?php }

    function outputReviews(array $reviews){ ?>
        <section id = "reviews">
            <h1>Reviews(<?=count($reviews)?>)</h1>
            <?php
                foreach($reviews as $review)
                    outputReview($review);
            ?>
        </section>
    <?php }
?>