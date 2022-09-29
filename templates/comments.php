
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
                            <input type="hidden" name="users_id" value="<?= $userData->get_id() ?>">
    
                            <button class="btn-deletar"><ion-icon name="trash-outline"></ion-icon> Excluir</button>
                    
                        </form>
                    </div>

                    
                </div>
                
                
                
            <?php } ?>

                <div class="ratings-form-box">

                    <?php
                        $ratingExists = $ratingsDao->verifyUserRating($row["id"], $userData->get_id());
                        //print_r($ratingExists);
                    ?>

                    
                        
                        <!-- INSERT -->
                        <div class="like-form-box">

                            <form class="like-form" action="" method="POST">

                                <input type="hidden" name="type" value="<?= ($ratingExists && $ratingExists->get_likes() == 1) ? "update-like" : "like" ?>">
                                <input type="hidden" name="like" value="1">
                                <input type="hidden" name="dislike" value="0">
                                <input type="hidden" name="messages_id" value="<?= $row["id"] ?>">
                                <input type="hidden" name="users_id" value="<?= $userData->get_id() ?>">
                                <input type="hidden" name="count_likes" value="<?= $ratingsDao->sumLikes($row["id"])  ?>">
                                <input type="hidden" name="post_id" value="<?= "like" . $n ?>">
                                <input type="hidden" name="dislike_id" value="<?= "dislike" . $n ?>">

                                <button type="button" class="rate-btn like-btn <?= ($ratingExists && $ratingExists->get_likes() == 1) ? "liked" : "" ?>" name="like-btn"><ion-icon name="thumbs-up-sharp"></ion-icon> <span id="<?= "like" . $n ?>"><?= $ratingsDao->sumLikes($row["id"]) ?></span> </button>

                                
                            </form>
                            
                        </div>

                        <div class="dislike-form-box">

                            <form class="dislike-form" action="" method="POST">

                                <input type="hidden" name="type" value="<?= ($ratingExists && $ratingExists->get_dislikes() == 1) ? "update-dislike" : "dislike" ?>">
                                <input type="hidden" name="like" value="0">
                                <input type="hidden" name="dislike" value="1">
                                <input type="hidden" name="messages_id" value="<?= $row["id"] ?>">
                                <input type="hidden" name="users_id" value="<?= $userData->get_id()  ?>">
                                <input type="hidden" name="count_dislikes" value="<?= $ratingsDao->sumDislikes($row["id"])  ?>">
                                <input type="hidden" name="post_id" value="<?= "dislike" . $n ?>">
                                <input type="hidden" name="like_id" value="<?= "like" . $n ?>">

                                <button type="button" class="rate-btn dislike-btn <?= ($ratingExists && $ratingExists->get_dislikes() == 1) ? "disliked" : "" ?>"><ion-icon name="thumbs-down-sharp"></ion-icon> <span id="<?= "dislike" . $n ?>"><?= $ratingsDao->sumDislikes($row["id"]) ?></span> </button>

                            </form>
                        </div>
                    
                </div>

        <?php } ?>

    </div>

    

    
</div>

