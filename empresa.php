<?php
    require_once("templates/header.php");


    $categoria = $_GET["categoria"];

    $empresa = array(
        "missao" => array(
            "nome" => "Missão",
            "texto" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate nulla laboriosam architecto quod mollitia vel veniam doloremque, aliquam ad voluptatibus tenetur delectus quos. Alias a temporibus nulla, doloremque ipsa suscipit?<br><br>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, temporibus fugit praesentium sapiente autem dicta quasi ullam quis atque odit eum, facere eos perspiciatis eaque?" 
        ),

        "visao" => array(
            "nome" => "Visão",
            "texto" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam illum dicta nostrum temporibus a. Labore, magnam laborum ullam quibusdam quaerat suscipit vel dignissimos, commodi dolores pariatur maxime temporibus tempora rem odit quia earum eius similique! Commodi incidunt facere similique nulla expedita sed, perspiciatis possimus sapiente ullam nesciunt earum aliquam vitae!" 
        ),

        "valores" => array(
            "nome" => "Valores",
            "texto" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci ea quaerat optio voluptas repellendus vitae eius numquam aliquid? Dolorem vero aliquid dolor earum molestiae soluta odio exercitationem debitis. Accusamus magnam enim nesciunt eveniet omnis dignissimos?"
        )
    );
?>

    <div class="container">

        <div class="breadcrumbs">
            <a href="<?= $BASE_URL ?>">Home</a>
            <span>></span>
            <span><?php echo $empresa[$categoria]["nome"]; ?></span>
        </div>

        <div class="texto">
            <h1><?php echo $empresa[$categoria]["nome"]; ?></h1>

            <p>
                <?php echo $empresa[$categoria]["texto"]; ?>
            </p>

            
        </div>


   
    </div>


    <?php
    require_once("templates/footer.php");
    ?>