<?php

    require_once("models/Ratings.php");
    require_once("models/Validations.php");
    require_once("DAO/UserDAO.php");

    class RatingsDAO implements RatingsDAOInterface{

        private $conn;
        private $url;
        private $validation;

        public function __construct($conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->validation = new Validations($url);
        }

        public function create_rating(Ratings $rate){

            $likes = $rate->get_likes();
            $dislikes = $rate->get_dislikes();
            $messages_id = $rate->get_messages_id();
            $users_id = $rate->get_users_id();

            $stmt = $this->conn->prepare("INSERT INTO ratings (likes, dislikes, messages_id, users_id)
                VALUES (:likes, :dislikes, :messages_id, :users_id)
            ");

            $stmt->bindParam(":likes", $likes);
            $stmt->bindParam(":dislikes", $dislikes);
            $stmt->bindParam(":messages_id", $messages_id);
            $stmt->bindParam(":users_id", $users_id);

            $stmt->execute();

        }

        public function buildRating($data){

            $rating = new Ratings();

            $rating->set_id($data["id"]);
            $rating->set_likes($data["likes"]);
            $rating->set_dislikes($data["dislikes"]);
            $rating->set_messages_id($data["messages_id"]);
            $rating->set_users_id($data["users_id"]);

            return $rating;
            
        }

        //Verifica se um usuário já avaliou um post
        public function verifyUserRating($messages_id, $users_id){

            $stmt = $this->conn->prepare("SELECT * FROM ratings WHERE messages_id = :messages_id AND users_id = :users_id");

            $stmt->bindParam(":messages_id", $messages_id);
            $stmt->bindParam(":users_id", $users_id);

            $stmt->execute();

            if($stmt->rowCount() > 0){

                $data = $stmt->fetch();

                $rating = $this->buildRating($data);

                return $rating;

            }else{
                return false;
            }
        }

        public function sumLikes($messages_id){

            //$sumLikes = 0;

            $stmt = $this->conn->prepare("SELECT SUM(likes) FROM ratings WHERE messages_id = :messages_id");

            $stmt->bindParam(":messages_id", $messages_id);

            $stmt->execute();

            $total = $stmt->fetch(PDO::FETCH_NUM);

            if($total[0] > 0){

                return $total[0];
            }else{
                return 0;
            }

        }

        public function sumDislikes($messages_id){

            $stmt = $this->conn->prepare("SELECT SUM(dislikes) FROM ratings WHERE messages_id = :messages_id");

            $stmt->bindParam(":messages_id", $messages_id);

            $stmt->execute();
   
            $total = $stmt->fetch(PDO::FETCH_NUM);

            if($total[0] > 0){

                return $total[0];
            }else{
                return 0;
            }
    

         
        }

    }