
<?php
    //Usando as funções strtotime e date para colocar a data no padrão brasileiro
    $data = strtotime($row["inclusao"]);

?>

<div class="comment">
    <div class="comment-header">

        <p class="data-publicacao">Publicado em <span><?= date("d-m-Y h:i:s", $data) ?></span></p>
        <h3><?= $row["nome"] ?></h3>

    </div>
    <div class="user-msg">

        
        <p class="comentario" id="<?= $row["id"] ?>"><?= $row["mensagem"] ?></p>

        <?php if($userData){ ?>
    
            <?php if($userData->get_id() == $row["users_id"]){ ?>
                <div class="user-options-box">

                    <div class="edit-msg-box" id="<?= $row["id"] ?>">
                        
                        <form action="<?= $BASE_URL ?>forum_process.php" method="POST">
                    
                            <input type="hidden" name="type" value="update">
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    
                            <div class="input-wrapper">
                                
                                <textarea name="mensagem" cols="30" rows="2"  required><?= $row["mensagem"] ?></textarea>
                            </div>
                    
                            <button id="form-btn"><ion-icon name="create-outline"></ion-icon> Editar</button>
                            
                        </form>
                    </div>
    
                    <button class="btn-edit" id="<?= $row["id"] ?>">
                        <ion-icon name="create-outline"></ion-icon> Editar  
                    </button>
                    
                    <!-- Form para apagar post -->

                    <div class="delete-form-box">

                        <form action="<?= $BASE_URL ?>forum_process.php" method="POST">
    
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
    
                            <button class="btn-deletar"><ion-icon name="trash-outline"></ion-icon> Excluir</button>
                    
                        </form>
                    </div>
                    
                </div>

                
                
            <?php } ?>
        <?php } ?>

    </div>

    

    
</div>