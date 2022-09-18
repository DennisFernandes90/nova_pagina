<?php
    require_once("templates/header.php");

    $currentPage = "Logar / Cadastrar";
?>

    

        <?php require_once("templates/breadcrumbs.php"); ?>

        <div class="forms-container">

            <div id="form-login">
                <h1>Login</h1>
                <p>Já possui conta? Entre com suas credenciais!</p>
                <form action="<?= $BASE_URL ?>cadastro_process.php" method="post">

                    <input type="hidden" name="type" value="login">
    
                    <div class="input-wrapper">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Informe seu endereço de email." required>
                    </div>
    
                    <div class="input-wrapper">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite uma senha" required>
                    </div>
    
                    <!-- <input type="button" value="Login" id="form-btn"> -->
                    <button id="form-btn">Login</button>
    
                </form>
            </div>
    
            <div id="form-cadastro">
                <h1>Cadastro</h1>
                <p>Faça seu cadastro!</p>
    
                <form action="<?= $BASE_URL ?>cadastro_process.php" id="contact-us" method="POST">

                    <input type="hidden" name="type" value="cadastro">
        
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
                        <input type="password" name="senha" id="senha" placeholder="Digite uma senha" required>
                    </div>
    
                    <div class="input-wrapper">
                        <label for="senha2">Repita a senha:</label>
                        <input type="password" name="senha2" id="senha2" placeholder="Repita a senha" required>
                    </div>
        
                    <div class="input-wrapper">
                        <label for="sexo">Região: </label>
                        <select name="sexo" id="sexo">
        
                            <option value="" selected disabled>Selecione seu sexo</option>
        
                            <option value="masculino">Masculino</option>
        
                            <option value="feminino">Feminino</option>
        
                        </select>
                    </div>
        
                    <div class="input-wrapper">
                        <label for="regiao">Região: </label>
                        <select name="regiao" id="regiao">
        
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
                        <select name="estado" id="estado">
        
                            <option value="" selected disabled>Selecione um Estado</option>
        
                            
                        </select>
                    </div>
    
                    <!-- <input type="button" value="Cadastrar" id="form-btn"> -->
                    <button id="form-btn">Cadastrar</button>
                    
                </form>
            </div>
        </div>


   
    


    <?php
    require_once("templates/footer.php");
    ?>