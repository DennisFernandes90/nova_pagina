<?php 

    require_once("globals.php");
    
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
    
        </header>
    </div>


