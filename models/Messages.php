<?php

    class Messages {

        private $id;
        private $mensagem;
        private $users_id;
        private $inclusao;

        //getters e setters

        public function set_id($id){
            $this->id = $id;
        }

        public function get_id(){
            return $this->id;
        }

        public function set_mensagem($mensagem){
            $this->mensagem = $mensagem;
        }

        public function get_mensagem(){
            return $this->mensagem;
        }

        public function set_users_id($users_id){
            $this->users_id = $users_id;
        }

        public function get_users_id(){
            return $this->users_id;
        }

        public function set_inclusao($inclusao){
            $this->inclusao = $inclusao;
        }

        public function get_inclusao(){
            return $this->inclusao;
        }
    }

    interface MessagesDAOInterface{

        public function createMessage(Messages $msg, User $user);
        public function getAllMessages();

    }