<?php 

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Validations.php");
    require_once("models/User.php");
    require_once("DAO/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);

    $validations = new Validations($BASE_URL);
    
    $resultMessage = $validations->getMessage();

    $validations->clearMessage();

    $userData = $userDao->verifyUser();

    // if($_SESSION["user"] != ""){

    //     $userData = $userDao->searchEmail($_SESSION["user"]);
    // }


    // print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script src="scripts/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu site</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
</head>
<body>

    <div class="header-container">

        <header>
    
            <div class="logo">
                <h2><a href="<?= $BASE_URL ?>">MEU LOGO</a></h2>
            </div>
    
                <?php if($userData){ ?>
                    <nav>
                        <ul class="lista-nav">
                            <li><a href="#">Perfil - <?= $userData->get_nome() ?></a></li>
                            <li><a href="<?= $BASE_URL ?>empresa.php?categoria=missao">Missão</a></li>
                            <li><a href="<?= $BASE_URL ?>empresa.php?categoria=visao">Visão</a></li>
                            <li><a href="<?= $BASE_URL ?>empresa.php?categoria=valores">Valores</a></li>
                            <li><a href="<?= $BASE_URL ?>fale_conosco.php">Fale Conosco</a></li>
                            <li><a href="<?= $BASE_URL ?>logout.php">Sair</a></li>
                            <li id="burguer">&#9776;</li>
                        </ul>
                    </nav>
                    <?php }else{ ?>
                        <nav>
                            <ul class="lista-nav">
                                <li><a href="<?= $BASE_URL ?>cadastro.php">Logar / Cadastrar</a></li>
                                <li><a href="<?= $BASE_URL ?>empresa.php?categoria=missao">Missão</a></li>
                                <li><a href="<?= $BASE_URL ?>empresa.php?categoria=visao">Visão</a></li>
                                <li><a href="<?= $BASE_URL ?>empresa.php?categoria=valores">Valores</a></li>
                                <li><a href="<?= $BASE_URL ?>fale_conosco.php">Fale Conosco</a></li>
                                <li id="burguer">&#9776;</li>
                            </ul>
                        </nav>
                    <?php } ?>            
        </header>
        

    </div>
    
    <div class="container">

        <?php if($resultMessage != ""){ ?>
            <div class="msg-container <?= $resultMessage["type"] ?>"><?= $resultMessage["msg"] ?></div>
        <?php } ?>