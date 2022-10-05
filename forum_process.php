<?php


    require_once("globals.php");
    header("Content-Type: application/json");
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

                $ratingsDao->deleteRatingById($id);
                
                $messagesDao->deleteMessage($messageData);

                $validations->setMessage("Post deletado com sucesso!", "sucesso", "back");

            }else{
                $validations->setMessage("Post não encontrado.", "erro", "back");
            }

        }

    // ----------------------------------- Avaliações de comentários -----------------------------------
    }else if($type === "like"){

        //print_r($_POST); exit;

        $like = filter_input(INPUT_POST, "like");
        $dislike = filter_input(INPUT_POST, "dislike");
        $messages_id = filter_input(INPUT_POST, "messages_id");
        $users_id = filter_input(INPUT_POST, "users_id");
        $post_id = filter_input(INPUT_POST, "post_id");
        $dislike_id = filter_input(INPUT_POST, "dislike_id");

        $type = filter_input(INPUT_POST, "type");

        $rating = new Ratings();

        $rating->set_likes($like);
        $rating->set_dislikes($dislike);
        $rating->set_messages_id($messages_id);

        $user = $userDao->searchId($users_id);

        $rating->set_users_id($user->get_id());

        $ratingsDao->create_rating($rating);

        $somaLikes = $ratingsDao->sumLikes($messages_id);
        $somaDislikes = $ratingsDao->sumDislikes($messages_id);

        echo json_encode([
            "liked", $somaLikes, $post_id, "vote", "disliked", $somaDislikes, $dislike_id
        ]);

        // $validations->setMessage("Avaliação contabilizada", "sucesso", "back");
        

    }else if($type === "dislike"){

        //print_r($_POST); exit;

        $like = filter_input(INPUT_POST, "like");
        $dislike = filter_input(INPUT_POST, "dislike");
        $messages_id = filter_input(INPUT_POST, "messages_id");
        $users_id = filter_input(INPUT_POST, "users_id");
        $post_id = filter_input(INPUT_POST, "post_id");
        $like_id = filter_input(INPUT_POST, "like_id");
        

        $type = filter_input(INPUT_POST, "type");

        $rating = new Ratings();

        $rating->set_likes($like);
        $rating->set_dislikes($dislike);
        $rating->set_messages_id($messages_id);
        
        $user = $userDao->searchId($users_id);

        $rating->set_users_id($user->get_id());

        $ratingsDao->create_rating($rating);

        $somaLikes = $ratingsDao->sumLikes($messages_id);
        $somaDislikes = $ratingsDao->sumDislikes($messages_id);

        echo json_encode([
            "disliked", $somaDislikes, $post_id, "vote", "liked", $somaLikes, $like_id
        ]);

        // $validations->setMessage("Avaliação contabilizada", "sucesso", "back");

    }else if($type === "update-like"){

        $messages_id = filter_input(INPUT_POST, "messages_id");
        $users_id = filter_input(INPUT_POST, "users_id");
        $post_id = filter_input(INPUT_POST, "post_id");
        $dislike_id = filter_input(INPUT_POST, "dislike_id");

        $rating = $ratingsDao->verifyUserRating($messages_id, $users_id);

        if($rating){

            if($rating->get_likes() == "1"){
    
                $ratingsDao->deleteRating($rating);
    
            }else{
    
                $like = filter_input(INPUT_POST, "like");
                $dislike = filter_input(INPUT_POST, "dislike");
    
                $rating->set_likes($like);
                $rating->set_dislikes($dislike);
    
                $ratingsDao->updateRatings($rating);
    
            }

            $somaLikes = $ratingsDao->sumLikes($messages_id);
            $somaDislikes = $ratingsDao->sumDislikes($messages_id);

            echo json_encode([
            "liked", $somaLikes, $post_id, "update", "disliked", $somaDislikes, $dislike_id
            ]);
    
            
        }

        

    }else if($type === "update-dislike"){

        $messages_id = filter_input(INPUT_POST, "messages_id");
        $users_id = filter_input(INPUT_POST, "users_id");
        $post_id = filter_input(INPUT_POST, "post_id");
        $like_id = filter_input(INPUT_POST, "like_id");

        $rating = $ratingsDao->verifyUserRating($messages_id, $users_id);

        if($rating){

            if($rating->get_dislikes() == "1"){
    
                $ratingsDao->deleteRating($rating);
    
            }else{
    
                $like = filter_input(INPUT_POST, "like");
                $dislike = filter_input(INPUT_POST, "dislike");
    
                $rating->set_likes($like);
                $rating->set_dislikes($dislike);
    
                $ratingsDao->updateRatings($rating);
    
            }

            $somaLikes = $ratingsDao->sumLikes($messages_id);
            $somaDislikes = $ratingsDao->sumDislikes($messages_id);

            echo json_encode([
            "disliked", $somaDislikes, $post_id, "update", "liked", $somaLikes, $like_id
            ]);
    
            
        }


    }


