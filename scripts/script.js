$(document).ready(function(){

    //Mostrar o ano atual no rodapé da página

    var data = new Date();

    var ano = data.getFullYear();

    $("#ano-atual").html(ano);

    //----------------------------------------------------

    //botão hamburguer

    $("#burguer").click(function(){

        if($("nav").hasClass("menujs")){
            $("nav").removeClass("menujs");
            $("#burguer").html("&#9776;");
        }else{
            $("nav").addClass("menujs");
            $("#burguer").html("&Cross;");
        }
  
    });

    //----------------------------------------------------

    //formulário

    var estados = {
        "norte": ["Amazonas", "Acre", "Rondônia", "Roraima", "Amapá", "Pará", "Tocantins"],

        "nordeste": ["Maranhão", "Piauí", "Rio Grande do Norte", "Ceará", "Paraíba", "Bahia", "Pernambuco", "Alagoas", "Sergipe"],

        "centro_oeste": ["Goiânia", "Cuiabá", "Campo Grande", "Distrito Federal"],

        "sudeste": ["Minas Gerais", "Espírito Santo", "Rio de Janeiro", "São Paulo"],

        "sul": ["Santa Catarina", "Paraná", "Rio Grande do Sul"]
    };

    $("#regiao").change(function(){

        $("#estado").html("<option value='' selected disabled>Selecione um Estado</option>");

        var regiao = $("#regiao").val();

        for(var i = 0; i < estados[regiao].length; i++){
            $("#estado").append("<option value='" + estados[regiao][i] + "'>" + estados[regiao][i] + "</option>");
        }

        // $(".logo").html(regiao);
    });

    //----------------------------------------------------

    //Comentários

    $(".btn-edit").on('click', function(){
        if($(this).hasClass("btn-edit")){
            $(this).html("<ion-icon name='close-circle-outline'></ion-icon> Cancelar");
            $(this).removeClass("btn-edit");
            $(this).addClass("btn-cancelar");
            $(this).parent().parent().find(">:first-child").hide();
            $(this).parent().find(">:first-child").show();
        }else{
            $(this).html("<ion-icon name='create-outline'></ion-icon> Editar ");

            $(this).addClass("btn-edit");
            $(this).removeClass("btn-cancelar");

            $(this).parent().parent().find(">:first-child").show();
            $(this).parent().find(">:first-child").hide();
        }

        
    });

    //----------------------------------------------------

    //Ajax do formulário de like

    //Função like

    $(".like-btn").click(function(){
        //alert("botao clicaco");

        if($(this).hasClass("liked")){
            var type = "update-like";
        }else{
            var type = "like";
        }

        //var type = $(this).parent().find(":nth-child(1)").val();
        var like = $(this).parent().find(":nth-child(2)").val();
        var dislike = $(this).parent().find(":nth-child(3)").val();
        var messages_id = $(this).parent().find(":nth-child(4)").val();
        var users_id = $(this).parent().find(":nth-child(5)").val();
        var count_likes = $(this).parent().find(":nth-child(6)").val();
        var count_likes = parseInt(count_likes) + 1;
        var post_id = $(this).parent().find(":nth-child(7)").val();
        var dislike_id = $(this).parent().find(":nth-child(8)").val();
        var formData = {
            type: type, 
            like: like, 
            dislike: dislike, 
            messages_id: messages_id, 
            users_id: users_id, 
            count_likes: count_likes,
            post_id: post_id,
            dislike_id: dislike_id
        };
        // alert(count_likes);

        $.ajax({
            url: "forum_process.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response){

                $("#" + response[2]).html(response[1]);
                $("#" + response[6]).html(response[5]);

                if(response[3] == "vote"){

                    $("#" + response[2]).parent().addClass(response[0]);
                }else{
                    
                    $("#" + response[2]).parent().removeClass(response[0]);
                }
                
                console.log(response);

                
                
            }
        });
    });

    //Função dislike

    $(".dislike-btn").click(function(){
        //alert("botao clicaco");

        if($(this).hasClass("disliked")){
            
            var type = "update-dislike";
        }else{
            var type = "dislike";
        }

        var like = $(this).parent().find(":nth-child(2)").val();
        var dislike = $(this).parent().find(":nth-child(3)").val();
        var messages_id = $(this).parent().find(":nth-child(4)").val();
        var users_id = $(this).parent().find(":nth-child(5)").val();
        var count_dislikes = $(this).parent().find(":nth-child(6)").val();
        var count_dislikes = parseInt(count_dislikes) + 1;
        var post_id = $(this).parent().find(":nth-child(7)").val();
        var like_id = $(this).parent().find(":nth-child(8)").val();
        var formData = {
            type: type,
            like: like,
            dislike: dislike, 
            messages_id: messages_id, 
            users_id: users_id, 
            count_dislikes: count_dislikes,
            post_id: post_id,
            like_id: like_id
        };
        // alert(messages_id);

        $.ajax({
            url: "forum_process.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response){

                $("#" + response[2]).html(response[1]);

                if(response[3] == "vote"){

                    $("#" + response[2]).parent().addClass(response[0]);
                }else{
                    $("#" + response[2]).parent().removeClass(response[0]);
                }
                
                console.log(response);
            }
        });
    });


    

    


});