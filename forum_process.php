<?php


    require_once("globals.php");
    require_once("db.php");
    require_once("models/Validations.php");
    require_once("models/Ratings.php");
    require_once("DAO/UserDAO.php");
    require_once("DAO/MessagesDAO.php");
    require_once("DAO/RatingsDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $messagesDao = new MessagesDAO($conn, $BASE_URL);
    $ratingsDao = new RatingsDAO($conn, $BASE_URL);
    $validations = new Validations($BASE_URL);

    //print_r($_POST); exit;

    $user_id = filter_input(INPUT_POST, "id");

    $type = filter_input(INPUT_POST, "type");

    
    if($type === "post_msg"){
        
        
        $mensagem = filter_input(INPUT_POST, "mensagem");

        if(!empty($mensagem)){
    
            $user = $userDao->searchId($user_id);
    
            if($user){
    
                $message = new Messages();
        
                $message->set_mensagem($mensagem);
                $message->set_users_id($user_id);
                $messagesDao->createMessage($message, $user);
        
                $validations->setMessage("Postagem criada com sucesso!", "sucesso", "back");
    
            }else{
    
                $validations->setMessage("Usuário não encontrado, favor cadastre-se.", "erro");
    
            }   
    
        }else{
            $validations->setMessage("Escreva sua mensagem.", "erro", "back");
        }
    }else if($type === "update"){

        $id = filter_input(INPUT_POST, "id");
        $mensagem = filter_input(INPUT_POST, "mensagem");

        //print_r($_POST); exit;

        if(!empty($mensagem)){

            $messageData = $messagesDao->searchMessageById($id);

            //print_r($messageData); exit;

            if($messageData){
                
                $messageData->set_mensagem($mensagem);

                //print_r($messageData); exit;

                $messagesDao->updateMessage($messageData);

                $validations->setMessage("Post atualizado com sucesso!", "sucesso", "back");

            }else{
                $validations->setMessage("Post não encontrado.", "erro", "back");
            }


        }else{

            $validations->setMessage("Escreva sua mensagem.", "erro", "back");

        }

    }else if($type === "delete"){

        $id = filter_input(INPUT_POST, "id");

        if(!empty($id)){

            $messageData = $messagesDao->searchMessageById($id);

            if($messageData){
                
                $messagesDao->deleteMessage($messageData);

                $validations->setMessage("Post deletado com sucesso!", "sucesso", "back");

            }else{
                $validations->setMessage("Post não encontrado.", "erro", "back");
            }

        }


    }else if($type === "like"){

        //print_r($_POST); exit;

        $like = filter_input(INPUT_POST, "like");
        $dislike = filter_input(INPUT_POST, "dislike");
        $messages_id = filter_input(INPUT_POST, "messages_id");
        $users_id = filter_input(INPUT_POST, "users_id");

        $rating = new Ratings();

        $rating->set_likes($like);
        $rating->set_dislikes($dislike);
        $rating->set_messages_id($messages_id);

        $user = $userDao->searchId($users_id);

        $rating->set_users_id($user->get_id());

        //print_r($rating); exit;

        $ratingsDao->create_rating($rating);

        $validations->setMessage("Avaliação contabilizada", "sucesso", "back");


    }else if($type === "dislike"){

        //print_r($_POST); exit;

        $like = filter_input(INPUT_POST, "like");
        $dislike = filter_input(INPUT_POST, "dislike");
        $messages_id = filter_input(INPUT_POST, "messages_id");
        $users_id = filter_input(INPUT_POST, "users_id");

        $rating = new Ratings();

        $rating->set_likes($like);
        $rating->set_dislikes($dislike);
        $rating->set_messages_id($messages_id);
        
        $user = $userDao->searchId($users_id);

        $rating->set_users_id($user->get_id());

        $ratingsDao->create_rating($rating);

        $validations->setMessage("Avaliação contabilizada", "sucesso", "back");

    }else if($type === "update-like"){

        

    }else if($type === "update-dislike"){

    }


