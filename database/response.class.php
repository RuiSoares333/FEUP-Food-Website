<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.php');

    class Response {
        public int $id;
        public int $reviewId;
        public string $user;
        public int $date;
        public string $comment;

        public function __construct(int $id, int $reviewId, string $user, int $date, string $comment){
            $this->id = $id;
            $this->reviewId = $reviewId;
            $this->user = $user;
            $this->date = $date;
            $this->comment = $comment;
        }

        static function getResponse(PDO $db, int $reviewId) : ?Response{
            $query = 'SELECT Response.id, Response.reviewId, Response.published, Response.comment, User.name
            FROM Response LEFT JOIN User ON User.id = Response.userId 
            WHERE reviewId = ?';

            $response = getQueryResults($db, $query, false, array($reviewId));

            return $response ? new Response($response['id'], $reviewId, $response['name'], $response['published'], $response['comment']) : null;
        }

        function add(PDO $db, $user){
            $query = 'INSERT INTO Response VALUES(NULL, ?, ?, ?, ?)';

            executeQuery($db, $query, array($this->reviewId, $user, $this->date, $this->comment));
        }
    }
?>