<?php
    require_once("templates/header.php");
?>

    <div class="container">

        <div class="breadcrumbs">
            <a href="index.html">Home</a>
            <span>></span>
            <span>Logar / Cadastrar</span>
        </div>


        <div id="form-cadastro">

            <form action="" id="contact-us" method="POST">
                <h1>Cadastro</h1>
    
                <div class="input-wrapper">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Informe seu endereço de email." required>
                </div>
    
                <div class="input-wrapper">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" placeholder="Informe seu nome." required>
                </div>
    
                <div class="input-wrapper">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Informe seu sobrenome." required>
                </div>
    
                <div class="input-wrapper">
                    <label for="senha">Senha:</label>
                    <input type="senha" name="senha" id="senha" placeholder="Digite uma senha" required>
                </div>
    
                <div class="input-wrapper">
                    <label for="sexo">Região: </label>
                    <select name="sexo" id="sexo" required>
    
                        <option value="" selected disabled>Selecione seu sexo</option>
    
                        <option value="masculino">Masculino</option>
    
                        <option value="feminino">Feminino</option>
    
                    </select>
                </div>
    
                <div class="input-wrapper">
                    <label for="regiao">Região: </label>
                    <select name="regiao" id="regiao" required>
    
                        <option value="" selected disabled>Selecione uma Região</option>
    
                        <option value="norte">Norte</option>
    
                        <option value="nordeste">Nordeste</option>
    
                        <option value="centro_oeste">Centro-Oeste</option>
    
                        <option value="sudeste">Sudeste</option>
    
                        <option value="sul">Sul</option>
    
                    </select>
                </div>
    
                <div class="input-wrapper">
                    <label for="estado">Estado: </label>
                    <select name="estado" id="estado" required>
    
                        <option value="" selected disabled>Selecione um Estado</option>
    
                        
                    </select>
                </div>
    
                <div class="input-wrapper">
                    
                </div>
    
                <div class="input-wrapper">
                    <label for="mensagem">Mensagem:</label>
                    <textarea name="mensagem" id="mensagem" cols="30" rows="5" placeholder="Deixe aqui suas perguntas, críticas e sugestões" required></textarea>
                </div>
    
                <!-- <input type="button" value="Enviar" id="form-btn"> -->
                <button id="form-btn">Enviar</button>
                
            </form>
        </div>

   
    </div>


    <?php
    require_once("templates/footer.php");
    ?>