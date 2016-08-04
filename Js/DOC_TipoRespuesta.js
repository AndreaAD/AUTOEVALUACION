//FUNCION QUE GUARDA LAS PREGUNTAS
function doc_guardarPregunta(opcion){
    if(opcion==null){
        opcion="guardar";
    }
   var msjerrores=" Se han encontrado errores:\n\n";
    var error=false;
    var cantRes=$("#crearPregunta #cantidad-respuestas").val();
    if(cantRes==0){
        msjerrores+="- Debe seleccionar una cantidad de respuestas.\n";
        error=true;
    }
    var tipoRes=$("#crearPregunta #tipo-respuesta").val();
    if(tipoRes==0){
        msjerrores+="- Debe seleccionar un tipo de respuesta.\n";
        error=true;
    }
    var txResErr=0;
    $("#crearPregunta #textoRespuesta").each(function(i){
        if($(this).val()==""){
            txResErr++;
        }
    });
    if(txResErr>0){
        msjerrores+="- Los texto de las respuestas no pueden estar vacios.\n";
        error=true;
    }
    if(!error){
        /*var factor=$("#texto-factor").text();
        var caracteristica=$("#texto-caracteristica").text();
        var aspecto=$("#texto-aspecto").text();
        var evidencia=$("#texto-evidencia").text();*/
        var url="";
        if(opcion=="guardar"){
            url='../Controlador/DOC_guardarPregunta_Controlador.php';
        }else{
            if(opcion=="modificar"){
                /*url='../Controlador/ENC_guardarModificacionPregunta_controlador.php';*/
            }
        }
        var datosPregunta=$("#crearPregunta").serialize();
        //alert(datosPregunta);
        $.ajax({
            url:   url,
            type:  'post',
            data: datosPregunta,
            success:  function (data) {
            	if(data == '1'){
            		$('#div_emergente').find('.emergente > div[data-role="contenido"]').html('<p>Se guardo correctamente</p>');
					$('#div_emergente').fadeIn();
					$('select[name="cantidadRespuestas"]').val($('select[name="cantidadRespuestas"] option:first').val()).change();
					//$('select[name="tipoRespuesta"]').val($('select[name="tipoRespuesta"] option:first').val());
            	}   
            }
        });
    }else{
    	$('#div_emergente').find('.emergente > div[data-role="contenido"]').html('<p>Por favor ingrese todos los campos del formulario</p>');
		$('#div_emergente').fadeIn();
    }
}

/**
 * [doc_selectCantidadRespuesta seleccionala cantidad de respuestas de una prgunta]
 */
function doc_selectCantidadRespuesta(_this){
    var cantidad=$(_this).val();
    if(cantidad!=0){
    //alert("Seleccion:"+$(_this).val());
        $.ajax({
            url:   '../Controlador/DOC_tipoRespuesta_Controlador2.php',
            type:  'post',
            dataType:'html',
            data: {"cantidad":cantidad},
            success:  function (data) {
                $('#bloque-respuestas-principal').html(data);
                $('#tabla_tipo_respuestas').fadeOut();	  
            }
       });
   }else{ 
        $("#respuestas-contenido").html("<p style=\"padding-top:0.5em;\">Seleccione primero una cantidad de respuestas, luego seleccione un tipo de respuesta.</p>");
   }
}

/**
 * [doc_selectTipoRespuesta selecciona los tipos de repuesta]
 */
function doc_selectTipoRespuesta(_this){
    var idTipo=$(_this).val();
    if(idTipo!=0){
        $.ajax({
            url:   '../Controlador/DOC_tipoRespuesta_Controlador2.php',
            type:  'post',
            async: false,
            dataType:'html',
            data: {"tipo":idTipo},
            success:  function (data) {
                $('select[name*="ponderacion"]').each(function(i){
                    $(this).html(data);
                });
            }
       	});
    	$.ajax({
			url: '../Controlador/DOC_Selector_Controlador.php',
			method: 'post',
			dataType: 'json',
			async: false,
			data: {
				operacion: 'obtenerOpciones',
				id_respuesta : idTipo
			},
			success: function (data) {
				if(data.length > 0){
					$('#tabla_tipo_respuestas').html("");
					var lista ='<tr><th colspan="3">Tipo de respuesta</th></tr>';
					for(var i = 0; i < data.length; i++){
						lista += '<tr data-rel ="'+data[i].id_grupo+'" ><td data-td="descripcion">'+data[i].opciones+'</td><td><a data-role="modificar-respuestas" href="#" >Modificar</a></td><td><a data-role="eliminar-respuestas" href="#" >Eliminar</a></td></tr>';
					}
					$('#tabla_tipo_respuestas').html(lista);
					$('#tabla_tipo_respuestas').fadeIn();
				}
			}
		});
   	}else{
    	$('select[name*="ponderacion"]').each(function(i){
            $(this).html("<option style=\"display:block;\" value=\"0\">Sin tipo</option>");
        });      
   }
}
