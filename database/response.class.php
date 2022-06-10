<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

    class Response {
        public int $id;
        public int $reviewId;
        public int $date;
        public string $comment;

        public function __construct(int $id, int $reviewId, int $date, string $comment){
            $this->id = $id;
            $this->reviewId = $reviewId;
            $this->date = $date;
            $this->comment = $comment;
        }

        static function getResponse(PDO $db, int $reviewId){
            $query = 'SELECT * FROM Response WHERE reviewId = ?';

            $response = getQueryResults($db, $query, false, array($reviewId));

            return new Response(
                $response['id'],
                $reviewId,
                $response['date'],
                $response['comment']
            );
        }
    }
?>