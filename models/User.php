<?php

    class User{

        //Propriedades

        private $id;
        private $email;
        private $nome;
        private $sobrenome;
        private $senha;
        private $regiao; 
        private $estado;
        private $sexo;

        //getters e setters
        public function set_id($id){
            $this->id = $id;
        }

        public function get_id(){
            return $this->id;
        }

        public function set_email($email){
            $this->email = $email;
        }

        public function get_email(){
            return $this->email;
        }

        public function set_nome($nome){
            $this->nome = $nome;
        }

        public function get_nome(){
            return $this->nome;
        }

        public function set_sobrenome($sobrenome){
            $this->sobrenome = $sobrenome;
        }

        public function get_sobrenome(){
            return $this->sobrenome;
        }

        public function set_senha($senha){
            $this->senha = $senha;
        }

        public function get_senha(){
            return $this->senha;
        }

        public function set_regiao($regiao){
            $this->regiao = $regiao;
        }

        public function get_regiao(){
            return $this->regiao;
        }

        public function set_estado($estado){
            $this->estado = $estado;
        }

        public function get_estado(){
            return $this->estado;
        }

        public function set_sexo($sexo){
            $this->sexo = $sexo;
        }

        public function get_sexo(){
            return $this->sexo;
        }

        //Métodos

        public function getFullName($user){
            return $user->get_nome() . $user->get_sobrenome();
        }

        public function generatePassword($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }

    }

    interface UserDAOInterface{
        public function buildUser($data);
        public function createUser(User $user);
        public function searchEmail($email);
    }