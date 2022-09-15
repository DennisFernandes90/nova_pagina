<?php
    require_once("templates/header.php");
?>

    <div class="container">

        <div class="breadcrumbs">
            <a href="index.html">Home</a>
            <span>></span>
            <span>Fale Conosco</span>
        </div>

        <form action="<?= $BASE_URL ?>process_fale_conosco.php" id="contact-us" method="POST">
            <h1>Fale Conosco</h1>

            <p>Escreva suas dúvidas, críticas e sugestões</p>

            <div class="input-wrapper">
                <label for="mensagem">Mensagem:</label>
                <textarea name="mensagem" id="mensagem" cols="30" rows="5" placeholder="Deixe aqui suas perguntas, críticas e sugestões" required></textarea>
            </div>

            <!-- <input type="button" value="Enviar" id="form-btn"> -->
            <button id="form-btn">Enviar</button>
            
        </form>
   
    </div>


    <?php
    require_once("templates/footer.php");
    ?>