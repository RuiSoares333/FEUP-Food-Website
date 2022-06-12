<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/costumer.class.php');

    function outputReview(Review $review, string $name, bool $owner, Session $session, int $restaurant){ ?>
        <article>
            <div>
                <p><b><?=$name?></b>@<?= $review->username?></p>
                <p><?=date('j/n/Y',$review->date)?></p>
                <h5><?=$review->rating?>/10</h5>
            </div>
            <p><?=$review->comment?></p>
            <?php if($review->response)
                outputResponse($review->response);
                else if($session->isLoggedin() && $owner) {
                    ?> <button type="button" class ="review_response">Respond</button>
                    <form>
                        <textarea id = "response" name ="response" rows="4" cols="50"></textarea>
                        <input type="hidden" name="date" class ="date">
                        <button type="submit" formaction ="../actions/action_add_response.php?review=<?=$review->id?>&user=<?=$session->getId()?>&restaurant=<?=$restaurant?>" formmethod ="post">Respond</button>
                        <button type="reset">Cancel</button>
                    </form>
                    <?php 
                } ?>
        </article> 
    <?php }

    function outputReviews(array $reviews, PDO $db, bool $owner, Session $session, int $restaurant){ ?>
        <section id = "reviews">
            <h1>Reviews(<?=count($reviews)?>)</h1>
            <?php
                foreach($reviews as $review){
                    $name = Costumer::getName($db, $review->username);
                    outputReview($review, $name, $owner, $session, $restaurant);
                }
                    
            ?>
        </section>
    <?php }

    function outputResponse(Response $response){?>
        <div class ="response">
            <div>
                <p><b><?=$response->user?>(owner)</b></p>
                <p><?=date('j/n/Y', $response->date)?></p>
            </div>
            <p><?=$response->comment?></p>
        </div>
    <?php }
?>