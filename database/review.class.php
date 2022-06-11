<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/response.class.php');
    require_once(__DIR__ . '/../database/costumer.class.php');

    class Review{
        public int $id;
        public string $username;
        public int $rating;
        public int $date;
        public ?string $comment;
        public ?Response $response;

        public function __construct(int $id, string $username, int $rating, int $date, ?string $comment, ?Response $response) {
            $this->id = $id;
            $this->username = $username;
            $this->rating = $rating;
            $this->date = $date;
            $this->comment = $comment;
            $this->response = $response;
        }

        static function getReviews(PDO $db, int $restaurant) : array{
            $query = 'SELECT Review.id, User.username, Review.rating, Review.published, Review.comment 
            FROM Review LEFT JOIN USER ON Review.userId = User.id
            WHERE Review.restaurantId = ? AND Review.comment IS NOT NULL';

            $reviews = getQueryResults($db, $query, true, array($restaurant));

            $reviews_ = array();
            foreach ($reviews as $review){

                $reviews_[] = new Review(
                    $review['id'], 
                    $review['username'],
                    $review['rating'],
                    $review['published'],
                    $review['comment'],
                    Response::getResponse($db, $review['id'])
                );
            }
            return $reviews_;
        }

        static function getReview(PDO $db, int $id) : Review{
            $query = 'SELECT Review.id, User.username, Review.rating, Review.published, Review.comment 
            FROM Review LEFT JOIN USER ON Review.userId = User.id
            WHERE Review.id = ?';

            $review = getQueryResults($db, $query, false, array($id));

            return new Review(
                $review['id'], 
                $review['username'],
                $review['rating'],
                $review['published'],
                $review['comment'],
                Response::getResponse($db, $review['id'])
            );
        }

        function add(PDO $db, int $restaurant){
            $user = Costumer::getUserId($db, $this->username);

            $query = 'INSERT INTO Review VALUES(NULL, ?, ?, ?, ?, ?)';

            executeQuery($db, $query, array($restaurant, $user, $this->rating, $this->date, $this->comment));
        }
    }
?>