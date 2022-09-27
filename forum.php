<?php
    require_once("templates/header.php");
    require_once("DAO/RatingsDAO.php");

    $ratingsDao = new RatingsDAO($conn, $BASE_URL);

    $currentPage = "Fórum de Perguntas";

    $forumMessages = $messagesDao->getAllMessages();
?>

    
        <?php require_once("templates/breadcrumbs.php"); ?>

        <h1>Fórum de Perguntas</h1>

        <p>Escreva suas dúvidas, críticas e sugestões</p>

        <?php if($userData){ ?>
        
            <form action="<?= $BASE_URL ?>forum_process.php" id="contact-us" method="POST">

                <input type="hidden" name="id" value="<?= $userData->get_id() ?>">
                <input type="hidden" name="type" value="post_msg">

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
            
            <?php }else{ $n = 0; 
                
                 foreach($forumMessages as $row){ $n++;
                    require("templates/comments.php"); 
                }

             } ?>
            

        </div>
   
    


    <?php
    require_once("templates/footer.php");
    ?>