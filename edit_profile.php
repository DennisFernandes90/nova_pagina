<?php
    require_once("templates/header.php");

    if(!$userData){
        $validations->setMessage("Favor, fazer o login para acessar", "erro");
    }
?>

    <div class="forms-container">
        
        <div id="form-update-dados">
            <h1><?= $userData->getFullname($userData) ?></h1>
            <p>Atualize seus dados!</p>
    
            <form action="<?= $BASE_URL ?>edit_profile_process.php" id="contact-us" method="POST">
    
                <input type="hidden" name="type" value="update_dados">
                <input type="hidden" name="id" value="<?= $userData->get_id() ?>">
    
                <div class="input-wrapper">
                    <label for="email">Email:</label>
                    <input type="email" class="update-email" name="email" id="email" value="<?= $userData->get_email() ?>" readonly>
                </div>
    
                <div class="input-wrapper">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="<?= $userData->get_nome() ?>">
                </div>
    
                <div class="input-wrapper">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" id="sobrenome" value="<?= $userData->get_sobrenome() ?>">
                </div>
    
                <div class="input-wrapper">
                    <label for="sexo">Sexo: </label>
                    <select name="sexo" id="sexo">
    
                        <option value="" selected disabled>Selecione seu sexo</option>
    
                        <option value="masculino" <?php echo ($userData->get_sexo() == "masculino") ? "selected" : "" ?>>Masculino</option>
    
                        <option value="feminino" <?php echo ($userData->get_sexo() == "feminino") ? "selected" : "" ?>>Feminino</option>
    
                    </select>
                </div>
    
                <!-- <input type="button" value="Cadastrar" id="form-btn"> -->
                <button id="form-btn">Atualizar Dados</button>
                
            </form>
     
        </div>

        <div id="form-update-senha">

            <h1>Alterar senha</h1>

            <p>Escolha uma nova senha.</p>

            <form action="<?= $BASE_URL ?>edit_profile_process.php" method="POST">

                <input type="hidden" name="type" value="update_senha">
                <input type="hidden" name="id" value="<?= $userData->get_id() ?>">
                

                <div class="input-wrapper">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Digite uma nova senha" required>
                </div>
    
                <div class="input-wrapper">
                    <label for="senha2">Repita a senha:</label>
                    <input type="password" name="senha2" id="senha2" placeholder="Repita a senha" required>
                </div>

                <button id="form-btn">Atualizar Senha</button>
            </form>
        
        </div>
    </div>








<?php
    require_once("templates/footer.php");
?>