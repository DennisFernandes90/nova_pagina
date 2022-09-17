<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Validations.php");
    require_once("DAO/UserDAO.php");


    $validations = new Validations($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

    $type = filter_input(INPUT_POST, "type");

    if($type === "cadastro"){

        $email = filter_input(INPUT_POST, "email");
        $nome = filter_input(INPUT_POST, "nome");
        $sobrenome = filter_input(INPUT_POST, "sobrenome");
        $senha = filter_input(INPUT_POST, "senha");
        $senha2 = filter_input(INPUT_POST, "senha2");
        $sexo = filter_input(INPUT_POST, "sexo");
        $regiao = filter_input(INPUT_POST, "regiao");
        $estado = filter_input(INPUT_POST, "estado");

        if(!empty($email) && !empty($nome) && !empty($sobrenome) && !empty($senha) && !empty($senha2)){
            //checar se o email ja existe no sistema

            $verificaEmail = $userDao->searchEmail($email);

            if($verificaEmail){
                // Aqui fazer uma classe que exiba mensagens de erro/ sucesso e redirecione o usuário para uma página
                $validations->setMessage("Usuário já cadastrado, favor tente outro usuário!" , "erro", "back");
                
            }else{

                if(strlen($senha) < 6){
                    $validations->setMessage("A senha deve ter pelo menos 6 caracteres!" , "erro", "back");
                }else{

                    if($senha === $senha2){
                        //verificar se as senhas batem, incluir uma restrição de tamanho de caracteres na 
        
                        $user = new User();
        
                        $user->set_email($email);
                        $user->set_nome($nome);
                        $user->set_sobrenome($sobrenome);
        
                        $senhaFinal = $user->generatePassword($senha);
                        $user->set_senha($senhaFinal);
        
                        $user->set_sexo($sexo);
                        $user->set_regiao($regiao);
                        $user->set_estado($estado);
        
                        $userDao->createUser($user);
    
                        $userDao->setUserToSession($user);
    
                        $validations->setMessage("Cadastro efetuado com sucesso!", "sucesso");
        
                    }else{
                        $validations->setMessage("Senha de confirmação diferente!" , "erro", "back");
                    }
                }

            }

        }
        

    }else if($type === "login"){

        $email = filter_input(INPUT_POST, "email");
        $senha = filter_input(INPUT_POST, "senha");

        $user = $userDao->authenticateUser($email, $senha);

        if($user){
            $userDao->setUserToSession($user);
            $validations->setMessage("Login efetuado com sucesso!", "sucesso");
        }

    }