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
});