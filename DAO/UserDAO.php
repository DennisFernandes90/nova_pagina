<?php

    require_once("models/User.php");

    class UserDAO implements UserDAOInterface {

        private $conn;

        public function __construct(PDO $conn){
            $this->conn = $conn;
        }

        //Constói um objeto user com base em um array
        public function buildUser($data){

            $user = new User();

            $user->set_id($data["id"]);
            $user->set_email($data["email"]);
            $user->set_nome($data["nome"]);
            $user->set_sobrenome($data["sobrenome"]);
            $user->set_senha($data["senha"]);
            $user->set_regiao($data["regiao"]);
            $user->set_estado($data["estado"]);
            $user->set_sexo($data["sexo"]);

            return $user;

        }

        //recebe um objeto user como argumento e insere no banco de dados
        public function createUser(User $user){

            $email = $user->get_email();
            $nome = $user->get_nome();
            $sobrenome = $user->get_sobrenome();
            $senha = $user->get_senha();
            $regiao = $user->get_regiao();
            $estado = $user->get_estado();
            $sexo = $user->get_sexo();

            $stmt = $this->conn->prepare("INSERT INTO users (email, nome, sobrenome, senha, regiao, estado, sexo)
                VALUES (:email, :nome, :sobrenome, :senha, :regiao, :estado, :sexo)
            ");

            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":sobrenome", $sobrenome);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":regiao", $regiao);
            $stmt->bindParam(":estado", $estado);
            $stmt->bindParam(":sexo", $sexo);

            $stmt->execute();
            
        }

        //Recebe como argumento um email e procura no banco de dados por registros que contenham esse email
        public function searchEmail($email){

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

            $stmt->bindParam(":email", $email);

            $stmt->execute();

            if($stmt->rowCount() > 0){

                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            }else{
                return false;
            }

        }
    }