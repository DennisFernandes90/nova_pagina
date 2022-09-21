<?php
    require_once("templates/header.php");

    $currentPage = "Fórum de Perguntas";

    $forumMessages = $messagesDao->getAllMessages();
?>

    
        <?php require_once("templates/breadcrumbs.php"); ?>

        <h1>Fórum de Perguntas</h1>

        <p>Escreva suas dúvidas, críticas e sugestões</p>

        <?php if($userData){ ?>
        
            <form action="<?= $BASE_URL ?>forum_process.php" id="contact-us" method="POST">

                <input type="hidden" name="id" value="<?= $userData->get_id() ?>">

                <div class="input-wrapper">
                    <label for="mensagem">Mensagem:</label>
                    <textarea name="mensagem" id="mensagem" cols="30" rows="2" placeholder="Deixe aqui suas perguntas, críticas e sugestões" required></textarea>
                </div>

                <!-- <input type="button" value="Enviar" id="form-btn"> -->
                <button id="form-btn">Enviar</button>
                
            </form>

        <?php }else{ ?>

            <h2 id="forum-msg-title">Por favor, faça seu login ou cadastre-se para poder postar perguntas, <a href="<?= $BASE_URL ?>cadastro.php">clique aqui</a>.</h2>
        
        <?php } ?>

        <div class="comment-box">

            
            <?php if(empty($forumMessages)){ ?>

                <p>Ainda não existem comentários...</p>
            
            <?php }else{ ?>
                
                <?php foreach($forumMessages as $row){ ?>
                    <?php require("templates/comments.php"); ?>
                <?php  } ?>

            <?php } ?>
            

        </div>
   
    


    <?php
    require_once("templates/footer.php");
    ?>