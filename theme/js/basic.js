var vasos_pedido = [];
contador = 0;

tiempo_x = setTimeout("console.log('inicio')", 1);

$(document).ready(function(){
    /* Vasos */
    $("#vaso_1").click(function(){
        if(!$("#vaso_1 .sabores").is(":visible")){
            $(this).removeClass("no_seleccionado");

            reiniciar_sabores_titulos();

            $("#vaso_2").addClass("no_seleccionado");
            $("#vaso_3").addClass("no_seleccionado");

            $(this).find(".sabores").fadeIn();
            $(this).find(".titulo_vaso").addClass("opacidad");
            $(this).find(".texto_normal").addClass("opacidad");
        }
        recalcular_pantalla();
        $("#tamano #arrastralo").show();

        $("#finalizar").fadeOut();
    })

    $("#vaso_2").click(function(){
        if(!$("#vaso_2 .sabores").is(":visible")){
            $(this).removeClass("no_seleccionado");

            reiniciar_sabores_titulos();

            $("#vaso_1").addClass("no_seleccionado");
            $("#vaso_3").addClass("no_seleccionado");

            $(this).find(".sabores").fadeIn();
            $(this).find(".titulo_vaso").addClass("opacidad");
            $(this).find(".texto_normal").addClass("opacidad");
        }
        recalcular_pantalla();
        $("#tamano #arrastralo").show();

        $("#finalizar").fadeOut();
    })

    $("#vaso_3").click(function(){
        if(!$("#vaso_3 .sabores").is(":visible")){
            $(this).removeClass("no_seleccionado");

            reiniciar_sabores_titulos();

            $("#vaso_2").addClass("no_seleccionado");
            $("#vaso_1").addClass("no_seleccionado");

            $(this).find(".sabores").fadeIn();
            $(this).find(".titulo_vaso").addClass("opacidad");
            $(this).find(".texto_normal").addClass("opacidad");
        }
        recalcular_pantalla();
        $("#tamano #arrastralo").show();

        $("#finalizar").fadeOut();
    })

    /* Sabor */
    $(".vaso_general .sabores .sabor").click(function(){
        if (!$(this).hasClass('gris_desactivado')){
            $(".vaso_general .sabores .sabor").fadeOut();
            var tipo        = $(this).attr("tipo");
            var id_sabor    = $(this).attr("id_sabor");
            var tipo_letras = "";


            switch (tipo) {
                case "1":
                    tipo_letras = "grande";
                    break;
                case "2":
                    tipo_letras = "mediano";
                    break;
                case "3":
                    tipo_letras = "pequeno";
                    break;
                default:

            }

            $("#vaso_" + tipo + " .vaso").attr("src", "/theme/img/vasos/" + tipo_letras + "/" + id_sabor + ".png");
            $("#vaso_" + tipo).attr("sabor", id_sabor);


            //$(".vaso_general .sabores .sabor").parent().find(".sabor_seleccionado").find(".imagen_sabor img").attr("src", $(this).find("img").attr("src"));
            $(".vaso_general .sabores .sabor").parent().find(".sabor_seleccionado").fadeIn();

            id = $(this).parent().parent().parent().attr("id");

            $(".vaso_general").hide();
            $("#" + id).show();

            $("#toppings").fadeIn();
            $("#toppings .c").hide();

            $("#tamano").hide();
            $("#top").show();
            $("#top #arrastralo").show();
        }
    })

    /* Toppings */
    $("#toppings .x").click(function(){
        $(".vaso_general .sabores .sabor").fadeIn();
        $(".vaso_general .sabores .sabor_seleccionado").hide();
        $("#toppings").fadeOut();

        for(i=1; i<=3; i++){
            if(!$("#vaso_" + i).is(":visible")){
                $("#vaso_" + i).fadeIn();
            }
        }
        $("#toppings button").removeClass("button_seleccionado");
        recalcular_pantalla();
    })

    $("#toppings button").click(function(){
        if($(this).hasClass('button_seleccionado')){
            $(this).removeClass("button_seleccionado");
                        console.log($('#toppings .button_seleccionado').length);
            if($('#toppings .button_seleccionado').length == 0){
                $('#toppings .c').fadeOut();
            }else{
                $('#toppings .c').fadeIn();
            }
        }else{
            $(this).addClass("button_seleccionado");
            if($('#toppings .button_seleccionado').length == 0){
                $('#toppings .c').fadeOut();
            }else{
                $('#toppings .c').fadeIn();
            }
        }
    })

    $("#toppings .c").click(function(){
        seleccion = 0;
        for(i=1; i<=3; i++){
            if($("#vaso_" + i).is(":visible")){
                id_vaso = i;
                img = $("#vaso_" + i + " .vaso").attr("src");

                $("#footer #resumen").append("<div class=\"vaso_seleccion\" id_vaso=\"" + contador + "\"><div class=\"x\"><img src=\"/theme/img/x.png\"></div><img src=\"" + img + "\" class=\"vaso_resumen\"></div>");
            }
        }


        vasos_pedido[contador] = {"id_vaso" : id_vaso, "sabor": $("#vaso_" + id_vaso).attr("sabor"), "toppings": null};

        array_toppings = [];

        $("#toppings .button_seleccionado").each(function(){
            array_toppings.push($(this).attr("id_topping"));
        });

        vasos_pedido[contador]["toppings"] = array_toppings;
        contador++;

        $("#content_resumen").fadeIn();

        $(".vaso_general").show().removeClass("no_seleccionado");
        reiniciar_sabores_titulos();
        $("#toppings").hide();
        $("#toppings button").removeClass("button_seleccionado");

        $("#finalizar").fadeIn();

        $("#top").hide();
        $("#tamano").show();

        $("#tamano").html("Agregar otro + <div id=\"arrastralo\" class=\"texto_normal\">Selecciona un sabor</div>");

        $("#vaso_1 .vaso").attr("src", "/theme/img/vasos/1.png");
        $("#vaso_2 .vaso").attr("src", "/theme/img/vasos/2.png");
        $("#vaso_3 .vaso").attr("src", "/theme/img/vasos/3.png");

        $("#vaso_" + id_vaso).attr("tipo_vaso", 0);
    })

    $("#resumen" ).on( "click", ".x", function() {
        vasos_pedido.splice($(this).parent().attr("id_vaso"), 1);
        $(this).parent().remove();
        contador--;

        contador_vasos_resumen = 0;
        $("#resumen .vaso_seleccion").each(function(){
            $(this).attr("id_vaso", contador_vasos_resumen);
            contador_vasos_resumen++;
        });

        if(!$('#resumen .vaso_seleccion').is(":visible") ){
            $("#finalizar").hide();
        }
    })

    $("#finalizar").click(function(){
        $("#registrado").fadeIn(600, function(){
            $("#tamano").html("Escoge la base <div id=\"arrastralo\" style=\"display:none\" class=\"texto_normal\">Selecciona un sabor</div>");
            $("#resumen").html("");
            $("#finalizar").hide();

            vasos_pedido.splice(0, contador);
            contador = 0;
        });
        $.ajax({
                type: "POST",
                url: "/api/prueba/",
                dataType: "json",
                data:
                    {
                        "vasos": vasos_pedido,

                    }, // serializes the form's elements.
                success: function(data){
                    $("#numero_pedido").text(data["pedido"]);
                    $("#valor_pedido").text(money(data["valor"]));

                    $("#iframeoculto").attr("src", "http://localhost/?pedido=" + data["pedido"] + "&valor=" + data["valor"]);



                    setTimeout("funcion_espera()", 5000);
                }
        });
    });


    // lo dejo por si acaso
    /*$("#ok_final").click(function(){
        $("#registrado").fadeOut(2000);
    })*/

    $("#pedido_input").focus().bind('blur', function() {
        $(this).focus();
    });

    $("html").click(function() {
        $("#pedido_input").val($("#pedido_input").val()).focus();
    });

    //disable the tab key
    $(document).keydown(function(objEvent) {
        if (objEvent.keyCode == 9) {  //tab pressed
            objEvent.preventDefault(); // stops its action
       }
    })

    $("#pedido_input").change(function(){
        id_pedido = $("#pedido_input").val();
        $("#pedido_cargar").html("cargando...");
        $('#modal_pedido').modal('toggle');
        $("#pedido_input").val("");
        $.ajax({
                type: "POST",
                url: "/api/info_pedido/" + id_pedido,
                success: function(data){
                    console.log(data);
                    $("#pedido_cargar").html(data);
                }
        });
    })


    $("#fecha_lista_pedidos").change(function(){
        location.href = "/pedidos_todos/por_fecha/" + $("#fecha_lista_pedidos").val();
    })

    $("#fecha_cuadre").change(function(){
        location.href = "/cuadre/por_fecha/" + $("#fecha_cuadre").val();
    })

    $("#fecha_consolidado").change(function(){
        location.href = "/consolidado/por_fecha/" + $("#fecha_consolidado").val();
    })

    $("html").mousemove(function(){
        clearTimeout(tiempo_x);
        tiempo_x = setTimeout("paso_tiempo()", 42000);
    })
});

/*Sabores y toppings lista*/

$(".sabor_check").click(function(){
    id_sabor = $(this).attr("id");

    if($('#' + id_sabor).is(':checked')){
        valor_estado = 1;
    }else{
        valor_estado = 0;
    }

    $.ajax({
        type: "POST",
        url: "/api/sabores/estado/" + id_sabor,
        dataType: "json",
        data:
        {
            "estado": valor_estado,
        }, // serializes the form's elements.
        success: function(data){

        }
    });
});

$("#sortable .topping_check" ).on( "click", function() {
    id_topping = $(this).attr("id");

    if($('#' + id_topping).is(':checked')){
        valor_estado = 1;
    }else{
        valor_estado = 0;
    }

    $.ajax({
        type: "POST",
        url: "/api/toppings/estado/" + id_topping,
        dataType: "json",
        data:
        {
            "estado": valor_estado,
        }, // serializes the form's elements.
        success: function(data){

        }
    });
});

$(".campo_topping_actualizar").keyup(function(){
    id_topping = $(this).attr("id_topping");

    $.ajax({
        type: "POST",
        url: "/api/toppings/actualizar_topping/" + id_topping,
        dataType: "json",
        data:
        {
            "descripcion": $(this).val(),
        }, // serializes the form's elements.
        success: function(data){

        }
    });
});

$("#nuevo_topping_botton").click(function(){
    $.ajax({
        type: "POST",
        url: "/api/toppings/nuevo_topping/",
        dataType: "json",
        data:
        {
            "descripcion": $("#nuevo_topping").val(),
        }, // serializes the form's elements.
        success: function(data){
            $('#nuevo').modal('toggle');
            notie.alert({ time: 10, text: 'Topping agregado' });

            location.reload();

            $("#nuevo_topping").val("")
        }
    });
});

$(".eliminar_topping_botton").click(function(){

    id_topping = $(this).attr("id_topping");

    $("#topping_" + id_topping).remove();

    $.ajax({
        type: "POST",
        url: "/api/toppings/eliminar_topping/" + id_topping,
        dataType: "json",
        success: function(data){
        }
    });
});







$(".campo_sabor_actualizar").keyup(function(){
    id_sabor = $(this).attr("id_sabor");

    $.ajax({
        type: "POST",
        url: "/api/sabores/actualizar_sabor/" + id_sabor,
        dataType: "json",
        data:
        {
            "descripcion": $(this).val(),
        }, // serializes the form's elements.
        success: function(data){

        }
    });
});

$("#nuevo_sabor_botton").click(function(){
    $.ajax({
        type: "POST",
        url: "/api/sabores/nuevo_sabor/",
        dataType: "json",
        data:
        {
            "descripcion": $("#nuevo_sabor").val(),
        }, // serializes the form's elements.
        success: function(data){
            $('#nuevo').modal('toggle');
            notie.alert({ time: 10, text: 'Topping agregado' });

            location.reload();

            $("#nuevo_sabor").val("")
        }
    });
});

$(".eliminar_sabor_botton").click(function(){

    id_sabor = $(this).attr("id_sabor");

    $("#sabor_" + id_sabor).remove();

    $.ajax({
        type: "POST",
        url: "/api/sabores/eliminar_sabor/" + id_sabor,
        dataType: "json",
        success: function(data){
        }
    });
});

$(".campo_configuracion").keyup(function(){
    id_campo = $(this).attr("id");

    $.ajax({
        type: "POST",
        url: "/api/configuracion/actualizar/" + id_campo,
        dataType: "json",
        data:
        {
            "valor": $(this).val(),
        }, // serializes the form's elements.
        success: function(data){

        }
    });
});








/* ad*/

function funcion_espera(){
    $("#registrado").fadeOut(2000, function(){
        $("#numero_pedido").text("...");
        $("#valor_pedido").text("...");
    });
}

function paso_tiempo(){
    location.reload();
}

$("body").on( "click", ".marcar_pedido", function() {
    id_pedido = $(this).attr("id_pedido");
    $.ajax({
            type: "POST",
            url: "/api/marcar_pedido/" + id_pedido,
            dataType: "json",
            success: function(data){
                console.log(data);
                $("#numero_pedido").text(data["pedido"]);
                //$("#valor_pedido").text(money(data["valor"]));
            }
    });
    $(this).parent().html("Entregado");
});

$("body").on( "click", ".generar_factura", function() {
    id_pedido = $(this).attr("id_pedido");
    $("#iframeoculto").attr("src", "http://localhost/?id=" + id_pedido);
});

function reiniciar_sabores_titulos(){
    $(".vaso_general .sabores").hide();
    $(".vaso_general .titulo_vaso").removeClass("opacidad");
    $(".vaso_general .texto_normal").removeClass("opacidad");

    $(".vaso_general .sabores .sabor").show();
    $(".vaso_general .sabores .sabor_seleccionado").hide();
}

function insertCss( code ) {
    var style = document.createElement('style');
    style.type = 'text/css';

    if (style.styleSheet) {
        // IE
        style.styleSheet.cssText = code;
    } else {
        // Other browsers
        style.innerHTML = code;
    }

    document.getElementsByTagName("head")[0].appendChild( style );
}

function recalcular_pantalla(){
    ancho = (($("#vaso_1 .sabores").width() - 80)/2);
    for(i=1; i<= 12; i++){
        deg = (i-1) * 30;
        code = "\
                    .sabor:nth-child(" + i + "){\
                        transform: rotate(" + deg + "deg) translateX(" + ancho + "px);\
                    }\
                    .sabor:nth-child(" + i + ") img{\
                        transform: rotate(-" + deg + "deg);\
                    }\
                    ";


        insertCss(code);

    }
}

function money(num){
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        return "$"+num;
    }else{
        return "error";
    }
}

/* Login */

$("#login_form").submit(function(e) {

    var url = "/login/login_form/"; // the script where you handle the form input.

    $.ajax({
            type: "POST",
            url: url,
            data: $("#login_form").serialize(), // serializes the form's elements.
            success: function(data){
                if(parseInt(data)){
                    window.location.replace("/pedidos/");
                }else{
                    notie.alert({ time: 10, text: ':( parece que hay un error, revise usuario o contraseña' })
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
});
