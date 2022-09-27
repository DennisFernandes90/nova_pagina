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

        var type = $(this).parent().find(":nth-child(1)").val();
        var like = $(this).parent().find(":nth-child(2)").val();
        var dislike = $(this).parent().find(":nth-child(3)").val();
        var messages_id = $(this).parent().find(":nth-child(4)").val();
        var users_id = $(this).parent().find(":nth-child(5)").val();
        var formData = {type: type, like: like, dislike: dislike, messages_id: messages_id, users_id: users_id};
        // alert(messages_id);

        $.ajax({
            url: "forum_process.php",
            type: "POST",
            data: formData,
            success: function(){
                window.location.reload();
            }
        });
    });

    //Função dislike

    $(".dislike-btn").click(function(){
        //alert("botao clicaco");

        var type = $(this).parent().find(":nth-child(1)").val();
        var like = $(this).parent().find(":nth-child(2)").val();
        var dislike = $(this).parent().find(":nth-child(3)").val();
        var messages_id = $(this).parent().find(":nth-child(4)").val();
        var users_id = $(this).parent().find(":nth-child(5)").val();
        var formData = {type: type, like: like, dislike: dislike, messages_id: messages_id, users_id: users_id};
        // alert(messages_id);

        $.ajax({
            url: "forum_process.php",
            type: "POST",
            data: formData,
            success: function(){
                //$(".teste").val("teste");
                window.location.reload();
            }
        });
    });


    

    


});