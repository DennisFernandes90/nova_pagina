<?php

    require_once("DAO/UserDAO.php");
    require_once("models/Messages.php");
    require_once("models/Validations.php");
    require_once("models/User.php");

    class MessagesDAO implements MessagesDAOInterface{

        private $conn;
        private $url;
        private $validation;

        public function __construct($conn, $url){

            $this->conn = $conn;
            $this->url = $url;
            $this->validation = new Validations($url);

        }

        //Recebe os dados do POST e retorna um objeto do tipo Message
        public function buildMessage($data){

            $message = new Messages();

            $message->set_id($data["id"]);
            $message->set_mensagem($data["mensagem"]);
            $message->set_users_id($data["users_id"]);
            $message->set_inclusao($data["inclusao"]);

            return $message;

        }

        //Recebe como argumento dois objetos: mensagem e usuário, salva a mensagem e o id em variáveis e insere a mensagem no banco de dados
        public function createMessage(Messages $msg, User $user){

            $mensagem = $msg->get_mensagem();
            $users_id = $user->get_id();

            $stmt = $this->conn->prepare("INSERT INTO messages (mensagem, users_id)
            VALUES (:mensagem, :users_id)
            ");

            $stmt->bindParam(":mensagem", $mensagem);
            $stmt->bindParam(":users_id", $users_id);

            $stmt->execute();
        }


        //Resgata todas as postagens da tabela, caso existam, e salva em um vetor
        public function getAllMessages(){

            $rows = [];

            $stmt = $this->conn->query("SELECT u.nome, m.id, m.mensagem, m.users_id, m.inclusao FROM users  AS u INNER JOIN messages AS m ON  u.id = m.users_id");

            $stmt->execute();

            if($stmt->rowCount() > 0){

                $data = $stmt->fetchAll();
                
                foreach($data as $row){
                    array_push($rows, $row);
                }

                return $rows;
            }else{
                return false;
            }

        }

        public function searchMessageById($id){

            $stmt = $this->conn->prepare("SELECT * FROM messages WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                
                $data = $stmt->fetch();

                $message = $this->buildMessage($data);

                return $message;

            }else{
                return false;
            }

        }

        public function updateMessage(Messages $msg){

            $id = $msg->get_id();
            $mensagem = $msg->get_mensagem();

            $stmt = $this->conn->prepare("UPDATE messages SET mensagem = :mensagem WHERE id = :id");

            $stmt->bindParam(":mensagem", $mensagem);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        }

        public function deleteMessage(Messages $msg){

            $id = $msg->get_id();

            $stmt = $this->conn->prepare("DELETE FROM messages WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();
        }

    }