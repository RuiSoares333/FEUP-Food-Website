<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

    class Review{
        public int $id;
        public string $username;
        public int $rating;
        public string $comment;

        public function __construct(int $id, string $username, int $rating, string $comment){
            $this->id = $id;
            $this->username = $username;
            $this->rating = $rating;
            $this->comment = $comment;
        }

        static function getReviews(PDO $db, int $restaurant) : array{
            $query = 'SELECT id, username, rating, comment FROM Review WHERE restaurantId = ?';

            $reviews = getQueryResults($db, $query, true, array($restaurant));

            $reviews_ = array();
            foreach ($reviews as $review){
                $reviews_[] = new Review(
                    $review['id'], 
                    $review['username'],
                    $review['rating'],
                    $review['comment']
                );
            }
            return $reviews_;
        }
    }
?>