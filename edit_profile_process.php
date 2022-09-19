<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/Validations.php");
    require_once("models/User.php");
    require_once("DAO/UserDAO.php");


    $validation = new Validations($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);


    $type = filter_input(INPUT_POST, "type");
    $id = filter_input(INPUT_POST, "id");

    // monta o objeto de usuário a partir do Id
    $userData = $userDao->searchId($id);

    if($type == "update_dados"){
        
        $nome = filter_input(INPUT_POST, "nome");
        $sobrenome = filter_input(INPUT_POST, "sobrenome");
        $sexo = filter_input(INPUT_POST, "sexo");

        if(!empty($nome) && !empty($sobrenome) && !empty($sexo)){

            $userData->set_nome($nome);
            $userData->set_sobrenome($sobrenome);
            $userData->set_sexo($sexo);

            //print_r($userData); exit;

            if($userData){
                $userDao->updateUser($userData);

                $validation->setMessage("Dados alterados com sucesso", "sucesso", "index.php");
            }else{
                $validation->setMessage("Usuário não encontrao", "erro", "back");
            }

        }else{
            $validation->setMessage("Favor, preencher os campos: nome, sobrenome e sexo", "erro", "back");
        }

    }else if($type == "update_senha"){

        $senha = filter_input(INPUT_POST, "senha");
        $senha2 = filter_input(INPUT_POST, "senha2");

        if(!empty($senha) && !empty($senha2)){

            if($senha === $senha2){
                if(strlen($senha) >= 6){
                    
                    $senhaFinal = $userData->generatePassword($senha);

                    $userData->set_senha($senhaFinal);

                    $userDao->updatePassword($userData);

                    $validation->setMessage("Senha alterada com sucesso", "sucesso");

                }else{
                    $validation->setMessage("As senhas devem conter ao menos 6 caracteres!", "erro", "back");
                }

            }else{
                $validation->setMessage("As senhas devem ser iguais nos dois campos!", "erro", "back");
            }

        }else{
            $validation->setMessage("Favor, escolha uma nova senha", "erro", "back");
        }

    }