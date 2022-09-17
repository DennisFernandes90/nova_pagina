<?php

    require_once("models/User.php");
    require_once("models/Validations.php");

    class UserDAO implements UserDAOInterface {

        private $conn;
        private $url;
        private $validation;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->validation = new Validations($url);
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

        // Cria uma variável de sessão com o email do usuário
        public function setUserToSession(User $user){

           $_SESSION["user"] = $user->get_email();

        }

        //Cria um objeto de usuário com base no email que está na variável de sessão
        public function verifyUser(){
            if(!empty($_SESSION["user"])){
                $email = $_SESSION["user"];

                $user = $this->searchEmail($email);

                if($user){
                    return $user;
                }else{
                    $this->validation->setMessage("Usuário não encontrado", "erro", "back");
                }
            }
        }

        //Recebe como parametro o email e senha, caso a senha informada seja compativel com o hash cadastrado cria um objeto do usuário
        public function authenticateUser($email, $senha){

            $user = $this->searchEmail($email);

            if(password_verify($senha, $user->get_senha())){
                return $user;
            }else{
                $this->validation->setMessage("Usuário ou senha incorretos, por favor tente de novo.", "erro", "back");
            }




        }
    }