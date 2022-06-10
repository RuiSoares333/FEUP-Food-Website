<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

    class Review{
        public int $id;
        public string $username;
        public int $rating;
        public int $date;
        public ?string $comment;

        public function __construct(int $id, string $username, int $rating, int $date, ?string $comment) {
            $this->id = $id;
            $this->username = $username;
            $this->rating = $rating;
            $this->date = $date;
            $this->comment = $comment;
        }

        static function getReviews(PDO $db, int $restaurant) : array{
            $query = 'SELECT Review.id, User.username, Review.rating, Review.published, Review.comment 
            FROM Review LEFT JOIN USER ON Review.userId = User.id
            WHERE restaurantId = ? AND comment IS NOT NULL';

            $reviews = getQueryResults($db, $query, true, array($restaurant));

            $reviews_ = array();
            foreach ($reviews as $review){
                $reviews_[] = new Review(
                    $review['id'], 
                    $review['username'],
                    $review['rating'],
                    $review['published'],
                    $review['comment']
                );
            }
            return $reviews_;
        }

        function add(PDO $db, int $restaurant){
            $query = 'SELECT id FROM User WHERE username = ?';

            $user = getQueryResults($db, $query, false, array($this->username));

            $query = 'INSERT INTO Review VALUES(NULL, ?, ?, ?, unixepoch(now), ?)';

            executeQuery($db, $query, array($restaurant, $user, $this->rating, $this->comment));
        }
    }
?>