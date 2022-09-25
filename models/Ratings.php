<?php

    class Ratings {

        private $id;
        private $likes;
        private $dislikes;
        private $messages_id;
        private $users_id;

        //getters e setters

        public function set_id($id){
            $this->id = $id;
        }

        public function get_id(){
            return $this->id;
        }

        public function set_likes($likes){
            $this->likes = $likes;
        }

        public function get_likes(){
            return $this->likes;
        }

        public function set_dislikes($dislikes){
            $this->dislikes = $dislikes;
        }

        public function get_dislikes(){
            return $this->dislikes;
        }

        public function set_messages_id($messages_id){
            $this->messages_id = $messages_id;
        }

        public function get_messages_id(){
            return $this->messages_id;
        }

        public function set_users_id($users_id){
            $this->users_id = $users_id;
        }

        public function get_users_id(){
            return $this->users_id;
        }

    }

    interface RatingsDAOInterface {
        public function create_rating(Ratings $rate);
        public function buildRating($data);
        public function verifyUserRating($messages_id, $users_id);
        public function sumLikes($messages_id);
        public function sumDislikes($messages_id);
        public function updateRatings(Ratings $rate);
        public function deleteRating(Ratings $rate);
        public function deleteRatingById($messages_id);
    }