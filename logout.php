<?php

    require_once("globals.php");
    
    require_once("models/Validations.php");

    $validation = new Validations($BASE_URL);

    $_SESSION["user"] = "";
    //session_destroy();

    $validation->setMessage("Logout efetuado com sucesso!", "sucesso");

