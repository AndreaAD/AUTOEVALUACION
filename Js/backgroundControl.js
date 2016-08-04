/* --------------------------

    JavaScrip base de la pagina

    Nombre: backgroundControl.js 

    version 3.0

   -------------------------- */

$(document).ready(function(){
    $( document ).ajaxStart(function() {
        $('#carga').fadeIn();
    });
    $( document ).ajaxStop(function() {
        $('#carga').fadeOut();
    });
    
	function definirTrama(){

		$("a").preventDefault

		var ventana=$(window);

		var ancho=ventana.width();

		var alto=ventana.height();

		$("svg").attr("width",ancho+"px");

		$("svg").attr("height",alto+"px");

		/*$("#tramafondo").css({"width":ancho+"px","height":alto+"px"});*/



		//----- Tamaño de los triangulos del fondo -----//

		//0,0 150,0, 0,650

		$("#poly1").attr("points",0+","+0+" "+((ancho*11)/100)+","+0+", "+0+","+alto);

		//0,0 80,0, 0,650

		$("#poly2").attr("points",0+","+0+" "+((ancho*6)/100)+","+0+", "+0+","+alto);

		//1100,0 1340,0, 1340,600

		$("#poly3").attr("points",((ancho*80)/100)+","+0+" "+ancho+","+0+", "+ancho+","+((alto*90)/100));

		//1100,650 1340,650, 1340,250

		$("#poly4").attr("points",((ancho*88)/100)+","+alto+" "+ancho+","+alto+", "+ancho+","+((alto*40)/100));

		//1100,0 1340,0, 1340,450

		$("#poly5").attr("points",((ancho*80)/100)+","+0+" "+ancho+","+0+", "+ancho+","+((alto*75)/100));

		//1200,0 1340,0, 1340,650

		$("#poly6").attr("points",((ancho*88)/100)+","+0+" "+ancho+","+0+", "+ancho+","+alto);

		//1250,677 1340,677, 1340,150

		$("#poly7").attr("points",((ancho*95)/100)+","+alto+" "+ancho+","+alto+", "+ancho+","+((alto*22)/100));



		//----- Ubicacion y tamaño del escudo udec -----//

		$("#escudoudec").attr("x",((ancho*7)/100));

		$("#escudoudec").attr("y",((alto*6)/100)*(-1));



		$(".modulo-base").each(function(i){

			var altoTitulo=$(this).height();

			var anchoTitulo=$(this).width();

			$(this).removeClass("una-linea-menu");

			$(this).removeClass("doble-linea-menu");

			$(this).removeClass("triple-linea-menu");

			switch(altoTitulo){

				case 20:{

					$(this).addClass("una-linea-menu");

				};break;

				case 40:{

					$(this).addClass("doble-linea-menu");

				};break;

				case 60:{

					$(this).addClass("triple-linea-menu");

				};break;

			}

		});		

	}// definirTrama



	$("#cancelar-flotante").click(function(event){

			//$(".fondo-inicio-sesion-flotante").slideUp();

			$(".inicio-sesion-flotante").fadeOut();

	});

	$("#inicio-flotante").click(function(event){

			//$(".fondo-inicio-sesion-flotante").slideDown()

			$(".inicio-sesion-flotante").fadeIn();

	});

 

     /*********************************************************************************/

     /*********************************************************************************/

     /*********************************************************************************/

     

     $("#cerrar_session").click(function(event){

    			//$(".fondo-inicio-sesion-flotante").slideDown()

    			$(".cerrar-sesion-flotante").fadeIn();

    	});

     

     $("#cancelar_cerrar_session").click(function(event){

    			//$(".fondo-inicio-sesion-flotante").slideUp();

    			$(".cerrar-sesion-flotante").fadeOut();

    	});

        

        

     $("#restaurar_clave").click(function(event){

    			//$(".fondo-inicio-sesion-flotante").slideDown()

    			$(".restaurar-clave-flotante").fadeIn();

    	});

     

     $("#cancelar_restaurar_clave").click(function(event){

    			//$(".fondo-inicio-sesion-flotante").slideUp();

    			$(".restaurar-clave-flotante").fadeOut();

    	});

        

        

     $("#cambiar_clave").click(function(event){

    			//$(".fondo-inicio-sesion-flotante").slideDown()

    			$(".cambiar-clave-flotante").fadeIn();

    	});

     

     $("#cancelar_cambiar_clave").click(function(event){

    			//$(".fondo-inicio-sesion-flotante").slideUp();

    			$(".cambiar-clave-flotante").fadeOut();

    	});

        
     $("#cambiar_proceso").click(function(event){
    			//$(".fondo-inicio-sesion-flotante").slideDown()
    			$(".cambiar-proceso-flotante").fadeIn();
    	});
     
     $("#cancelar_cambiar_proceso").click(function(event){
    			//$(".fondo-inicio-sesion-flotante").slideUp();
    			$(".cambiar-proceso-flotante").fadeOut();
    	});
        
     /********************************************************************************/

     /*********************************************************************************/

     /*********************************************************************************/

     

    $("#BTN_muestra").click(function(event){

        //alert("prueba..");

        event.preventDefault();

        //colorElementos($(this));

        $.ajax({

            url:   $(this).attr("href"),

            type:  'post',

            dataType:'html',

            data: {},

            success:  function (data) {

                $('.principal-panel-contenido').html(data);

            }

        });

    });



    

	$("#BTN_controles,#BTN_controles2,#BTN_controles3,#BTN_controles4,#BTN_encuestaSolucion").click(function(_event){

	   _event.preventDefault();

      // colorElementos($(this));

       $.ajax({

            url:   $(this).attr("href"),

            type:  'post',

            dataType:'html',

            data: {},

            success:  function (data) {

                $('.principal-panel-contenido').html(data);

            }

        });

        

	});

    

    $("#BTN_encuesta,#BTN_procesarDatos,#BTN_responderEncuesta").click(function(_event){

	   _event.preventDefault();

      //colorElementos($(this));

       $.ajax({

            url:   $(this).attr("href"),

            type:  'post',

            dataType:'html',

            data: {},

            success:  function (data) {

                $('.principal-panel-contenido').html(data);

            }

        });

        

	});

    

    $("#BTN_tabla").click(function(_event){

	   _event.preventDefault();

       //colorElementos($(this));

       $.ajax({

            url:   $(this).attr("href"),

            type:  'post',

            dataType:'html',

            data: {},

            success:  function (data) {

                $('.principal-panel-contenido').html(data);

            }

        });

	});

    

    $("#BTN_objetos").click(function(_event){

	   _event.preventDefault();

       //colorElementos($(this));

       $.ajax({

            url:   $(this).attr("href"),

            type:  'post',

            dataType:'html',

            data: {},

            success:  function (data) {

                $('.principal-panel-contenido').html(data);

            }

        });

	});

    

    /*$(".desplegar-menu").each(function(i){

		$(this).click(function(_event){

            _event.preventDefault();

			var subElemento=$(this).parent().parent().find(".sub-menu-modulo");

			subElemento.slideToggle();

            if(subElemento.hasClass("mostrar")){

                if($(this).hasClass("icon-minus")){

                    $(this).removeClass("icon-minus");

                    $(this).addClass("icon-plus");

                }else{

                    if($(this).hasClass("icon-plus")){

                        $(this).removeClass("icon-plus");

                        $(this).addClass("icon-minus");

                    }

                }

            }else{

                 if(subElemento.hasClass("ocultar")){

                    if($(this).hasClass("icon-plus")){

                        $(this).removeClass("icon-plus");

                        $(this).addClass("icon-minus");

                    }else{

                        if($(this).hasClass("icon-minus")){

                            $(this).removeClass("icon-minus");

                            $(this).addClass("icon-plus");

                        }

                    }

                 }

            }

			/*if(subElemento.hasClass("ocultar")){

				subElemento.removeClass("ocultar");

				subElemento.addClass("mostrar");

				subElemento.slideDown();

				event.preventDefault();

			}else{

				subElemento.removeClass("mostrar");

				subElemento.addClass("ocultar");

				subElemento.slideUp();

				event.preventDefault();

			}*/

			

	/*	});

	});*/

	

    //colorModulos();

	/*plm_enlazar_botones();*/

	definirTrama();

    

	$(window).resize(function(){

  		definirTrama();

	});

    

    $(window).scroll(function () {

        if ($(this).scrollTop() > 200) {

            $('.ir-arriba').fadeIn();

        } else {

            $('.ir-arriba').fadeOut();

        }

    });

});



function cerrar_div_flotante(_elemento){

        var padre=$(_elemento).parent().parent();

        $(padre).fadeToggle();

        return false;

    }



function abrir_div_flotante(_elemento){

    $("#emergente1").fadeToggle();

    return false;

}



function cabiar_informacion_usuario(){

    $(".inicio-sesion-boton").fadeToggle();

}



function desplegar_menu_modulos(_this){

	var subElemento=$(_this).parent().parent().find(".sub-menu-modulo");

	subElemento.slideToggle();

    if(subElemento.hasClass("mostrar")){

        if($(_this).find(".desplegar-menu").hasClass("icon-minus")){

            $(_this).find(".desplegar-menu").removeClass("icon-minus");

            $(_this).find(".desplegar-menu").addClass("icon-plus");

        }else{

            if($(_this).find(".desplegar-menu").hasClass("icon-plus")){

                $(_this).find(".desplegar-menu").removeClass("icon-plus");

                $(_this).find(".desplegar-menu").addClass("icon-minus");

            }

        }

    }else{

         if(subElemento.hasClass("ocultar")){

            if($(_this).find(".desplegar-menu").hasClass("icon-plus")){

                $(_this).find(".desplegar-menu").removeClass("icon-plus");

                $(_this).find(".desplegar-menu").addClass("icon-minus");

            }else{

                if($(_this).find(".desplegar-menu").hasClass("icon-minus")){

                    $(_this).find(".desplegar-menu").removeClass("icon-minus");

                    $(_this).find(".desplegar-menu").addClass("icon-plus");

                }

            }

         }

    }

}





function subir() {

    var arriba;

    if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {

        window.scrollBy(0, -45);

        arriba = setTimeout('subir()',5);

    }

    else clearTimeout(arriba);

}