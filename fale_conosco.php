<?php
    include "header.php";
?>

    <div class="container">

        <div class="breadcrumbs">
            <a href="index.html">Home</a>
            <span>></span>
            <span>Fale Conosco</span>
        </div>

        <form action="" id="contact-us">
            <h1>Fale Conosco</h1>

            <div class="input-wrapper">
                <label for="email">Email:</label>
                <input type="email" name="" id="email" placeholder="Informe seu endereço de email." required>
            </div>

            <div class="input-wrapper">
                <label for="nome">Nome:</label>
                <input type="text" name="" id="nome" placeholder="Informe seu nome." required>
            </div>

            <div class="input-wrapper">
                <label for="regiao">Região: </label>
                <select name="" id="regiao" required>

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
                <select name="" id="estado" required>

                    <option value="" selected disabled>Selecione um Estado</option>

                    
                </select>
            </div>

            <div class="input-wrapper">
                
            </div>

            <div class="input-wrapper">
                <label for="mensagem">Mensagem:</label>
                <textarea name="" id="mensagem" cols="30" rows="5" placeholder="Deixe aqui suas perguntas, críticas e sugestões" required></textarea>
            </div>

            <!-- <input type="button" value="Enviar" id="form-btn"> -->
            <button id="form-btn">Enviar</button>
            
        </form>
   
    </div>


    <?php
    include "footer.php";
    ?>