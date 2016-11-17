$(function (e){
	// definicion de las variables que utilizaremos

	var B_guardarInstru = $("#B_guardarInstru");
	var B_modificarInstru = $("#B_modificarInstru");
	var S_tipoRespuesta = $('select[name="S_tipoRespuesta"]');
	var div_emergente = $('#div_emergente');
	var tabla_guardar = $('#tabla_agregar');
	var S_opcionesRespuesta = $('select[name="S_opcionesRespuesta"]');
	
	// funcion encargada de ocultar nuestra ventana emergente
	var ocultar_emergente = function(){
		setTimeout(function(){ div_emergente.fadeOut("slow"); },2000)
	}

	// evento encargado de mostrar o no las opciones de respuesta 6 y 7 en nuestr formulario
	//enviamos las numero de respuestas y obtendremos un select con las opciones y los valores correspondienres
	$('select[name="S_tipoRespuesta"]').on('change' , function(e){
		$('#div_opcional').css('display','block');
		if($(this).val() != 0){
			if ($('select[name="S_tipoRespuesta"]').val() == 6 || $('select[name="S_tipoRespuesta"]').val() == 7 ){
				$('#div_oculto').css('display','block');
				$('#div_opcional').css('display','none');
			}else{
				$.ajax({
					url: '../Controlador/DOC_Selector_Controlador.php',
					method: 'post',
					dataType: 'json',
					async: false,
					data: {
						operacion: 'obtenerOpciones',
						id_respuesta : $(this).val(),
					},
					success: function (data) {
						S_opcionesRespuesta.find('option').remove();
						for(var i = 0; i<data.length; i++){
							S_opcionesRespuesta.append('<option value="'+data[i].id_grupo+'">'+data[i].opciones+'</option>');

						}
					}
				});
			}
			
		}
	});

	/**
	 * [Evento sobre el link modificarintru encargado de modificar un instrumento de evaluacion
	 * como resultado obtendremos un mensaje que nos infroma si se realizo o no nuestra actividad]
	 */
	// B_modificarInstru.on('click', function(e){
	// 	$.ajax({
	//         url: '../Controlador/DOC_InstruEval_Controlador.php',
	//         type:  'post',
	//         dataType:'json',
	//         data:{
	//         	operacion: "modificarInstrumento",
	//         	id_pregunta:$("input[name='id_pregunta']").val(),
	//         	evidencia:$("input[name='evidencia']").val(),
	//         	pregunta: $("#text_pregunta").val(),
	//         	tipoRespuesta: $('select[name="S_tipoRespuesta"]').val(),
	//         	opcionesRespuesta: $('select[name="S_opcionesRespuesta"]').val(),
	//         	grupoInteres : $('input[name="grupoInteres[]"]').serializeArray(),
	//         	proceso : $('input[name="procesos[]"]').serializeArray()
	// 		},
	//         success:  function (data) {
	//         	//cargartablaInstrumentos2(e);
	// 	        $("input[name='factor']").val("");
	// 			$("input[name='caracteristica']").val("");
	// 			$("input[name='aspecto']").val("");
	// 			$("input[name='evidencia']").val("");
	// 			$("input[name='instrumento']").val("");
	//         	switch(data){
	// 			    case 0:
	// 			        $('.errores').html('Error en la consulta');
	// 			    break;
	// 			    case 1:
	// 			    	div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>EL instrumento se modifico satisfactoriamente</p>');
	// 			        ocultar_emergente();
	// 			        //cargartablaInstrumentos2(e);
	// 			        $("input[name='factor']").val("");
	// 					$("input[name='caracteristica']").val("");
	// 					$("input[name='aspecto']").val("");
	// 					$("input[name='evidencia']").val("");
	// 					$("input[name='instrumento']").val("");
	// 					ocultar_emergente();
	// 			    break;
	// 			    case 2:
	// 			    	div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Por favor ingrese todos los campos del formulario</p>');
	// 			       	ocultar_emergente();
	// 			       	//$('.errores').html('Por favor ingrese todos los campos del formulario');
	// 			    break;
	// 			    default:
	// 			    break;				       
	// 			}
	// 		}
 //   		});
 //   		e.preventDefault();
	// });
	
	/**
	 * [Evento de guardar los instrumentos de evaluacion en la tabla dos_instru_evaluacion
	 * como resultado ibtendremos un mensaje con la infromacion de si se relizo o no nuestra actividad]
	 */
	B_guardarInstru.on('click', function(e){
		var sub= "";
		var opcionesRes = "";
		
		if ( $('select[name="S_tipoRespuesta"]').val() == 6  || $('select[name="S_tipoRespuesta"]').val() == 7 ){
			sub = "guardar_con_texto";
			opcionesRes = $('input[name="nuevo_tipo_respuesta"]').val();
		}else{
			sub="guardar_normal";
			opcionesRes = $('select[name="S_opcionesRespuesta"]').val();
		}

		$.ajax({
	        url: '../Controlador/DOC_InstruEval_Controlador.php',
	        type:  'post',
	        dataType:'json',
	        data:{
	        	operacion: "crearInstrumento",
	        	suboperacion : sub,
	        	evidencia:$("input[name='evidencia']").val(),
	        	evidencia_codigo:$("input[name='evidencia_codigo']").val(),
	        	factor:$("input[name='factor']").val(),
	        	factor_codigo:$("input[name='factor_codigo']").val(),
	        	caracteristicas:$("input[name='caracteristica']").val(),
	        	caracteristicas_codigo:$("input[name='caracteristica_codigo']").val(),
	        	aspectos:$("input[name='aspecto']").val(),
	        	aspectos_codigo:$("input[name='aspecto_codigo']").val(),
	        	pregunta: $("#text_pregunta").val(),
	        	tipoRespuesta: $('select[name="S_tipoRespuesta"]').val(),
	        	opcionesRespuesta: opcionesRes,
	        	opc: $("input[name='opc']").val(),
	        	grupoInteres : $('input[name="grupoInteres[]"]').serializeArray()
	        	//proceso : $('input[name="procesos[]"]').serializeArray()
			},
	        success:  function (data) {
	        	$('#mensajes').html("");
	        		switch(data){
				    case 1:
				    	//cargartablaInstrumentos2(e);
				    	//$('#mensajes').html("");
                    	//$('#mensajes').html("<h4 style='color:green'>Datos guardados satisfactoriamente.</h4>");
				    	div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>El instrumento se guardo satisfactoriamente</p>');
				     	div_emergente.css('display','block');
				     	
				     	$("#evidencia").val('');
			        	$("#factor").val('');
			        	$("#caracteristica").val('');
			        	$("#aspecto").val('');
			        	$("#text_pregunta").val('');
			        	$('select[name="S_tipoRespuesta"]').val(0);
			        	$('select[name="S_opcionesRespuesta"]').val(0);
			        	$("#opc").val('');

				    break;
				    case 2:
				    	window.scroll(0,0);
				    	div_emergente.find('.emergente > div[data-role="contenido"]').html('<p style="color:red;">Por favor ingrese todos los campos del formulario</p>');
				     	div_emergente.css('display','block');
                   		// $('#mensajes').html("");
                    	// $('#mensajes').html("<h4 style='color:red'>Por favor ingrese todos los campos del formulario.</h4>");
				    break;
				    default:
				    break;				       
				}
			}
   		});
   		e.preventDefault();
	});
	
	/**
	 * [Delegate sobre los a con data eliminar para eliminar un instrumento de nuestra tabla
	 * como resultado se obtiene un mensaje informando un estado]
	 */
	// div_emergente.delegate('a[data-eliminar]','click', function(e){
	// 	if($(this).data('eliminar') == "si"){
	// 		$.ajax({
	// 	        url: '../Controlador/DOC_InstruEval_Controlador.php',
	// 	        type:  'post',
	// 	        dataType:'json',
	// 	        data:{
	// 	        	operacion: "eliminarInstrumento",
	// 	        	preguntaEliminar: $('input[name="id_pregunta"]').val()
	// 			},
	// 	        success:  function (data) {
	// 	        	if(data == 1){
	// 	        		//cargartablaInstrumentos2(e);
	// 	        		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>El instrumento se elimino satisfactoriamente</p>');
	// 			        ocultar_emergente();
	// 	        	}else if(data == 2){
	// 	        		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>No se pudo eliminar el instrumento</p>');
	// 	        		ocultar_emergente();
	// 	        	}
	// 			}
	//    		});	
	// 	}
	// 	div_emergente.css('display','none');
	// 	e.preventDefault();	
	// });

	/**
	 * [Delegate sobre los a con data-role-modificar para modificar un instrumento de nuestra tabla
	 * como resultado se obtiene un mensaje informando un estado]
	 */
	// tabla_guardar.delegate('a[data-role="modificar"]','click' , function(e){
	// 	var id = $(this).closest('tr').data('id');
	// 	var tipo = $(this).closest('tr').data('tipo');
	// 	var desc = $(this).closest('tr').find('td[data-td="descripcion"]').text();
	// 	var pro = $(this).closest('tr').find('td[data-td="proceso"]').text();
	// 	var evidencia = $(this).closest('tr').data('evidencia');

	// 	$('select[name="S_tipoRespuesta"]').val(tipo).change();
	// 	//$('select[name="S_tipoRespuesta"]').val(tipo);
	// 	$('#text_pregunta').val(desc);
	// 	$('input[name="id_pregunta"]').val(id);
	// 	$('input[name="evidencia"]').val(evidencia);
	// 	$('#B_modificarInstru').removeAttr('disabled');
	// 	$('input[name="procesos[]"][value="'+pro+'"]').prop('checked',true);
	// 	$('input[name="procesos[]"]').prop('checked',false);
	// 	e.preventDefault();
	// });

	/**
	 * [Delegate sobre los a con data eliminar para eliminar un instrumento de nuestra tabla
	 * como resultado se obtiene un mensaje informando un estado]
	 */
	// tabla_guardar.delegate('a[data-role="eliminar"]','click' , function(e){
	// 	var id = $(this).closest('tr').data('id');
	// 	var desc = $(this).closest('tr').find('td[data-td="descripcion"]').text();
	// 	var texto = '<p>Esta seguro que desea eliminar el instrumento "'+desc+'"</p>';
	// 	$('input[name="id_pregunta"]').val(id);
	// 	texto += '<a data-eliminar="si" href="#"> Si </a><a data-eliminar="no" href="#"> No </a>';
	// 	div_emergente.find('.emergente > div[data-role="contenido"]').html(texto);
	// 	div_emergente.css('display','block');
	// 	e.preventDefault();
	// });

	/**
	 * [cargartablaInstrumentos2 Carga en una tabla todos los instrumentos de evaluacion por evidencia]
	 */
	// var cargartablaInstrumentos2 = function(e){
	// 	$.ajax({
	//         url: '../Controlador/DOC_InstruEval_Controlador.php',
	//         type:  'post',
	//         async: false,
	//         dataType:'json',
	//         data:{
	//         	operacion: "cargarInstrumento",
	//         	evidencia: $("input[name='evidencia']").val(),
	// 		},
	//         success:  function (data) {
	//         	if(data == 0){
	// 				tabla_guardar.html("");
	//         	}else{
	// 				var lista ="<tr><th>Instrumento</th><th>Procesos</th><th></th><th></th></tr>";
	// 				for(var i = 0; i < data.length; i++){
	// 					lista += '<tr data-proceso="'+data[i].proceso+'" data-evidencia ="'+data[i].fk_evidencia+'" data-tipo="'+data[i].fk_tipo_respuesta+'" data-id="'+data[i].pk_instru_evaluacion+'"><td data-td="descripcion">'+data[i].descripcion+'</td><td data-td="proceso">'+data[i].proceso+'</td><td><a  data-role="modificar" href="#" >Modificar</a></td><td><a data-role="eliminar" href="#" >Deshabilitar</a></td></tr>';
	// 				}
	// 				tabla_guardar.html(lista);
	// 				tabla_guardar.fadeIn();	 
	//         	}       	
	// 		}
 //   		});
	// }

	/**
	 * [verificarfase verifica en que fase se encuentra un proceso]
	 */
	var verificarfase = function(e){
		$.ajax({
	        url: '../Controlador/DOC_InstruEval_Controlador.php',
	        type:  'post',
	        async: false,
	        dataType:'json',
	        data:{
	        	operacion: "verificarfase"
			},
	        success:  function (data) {
			}
   		});
	}

	/**
	 * [checkprogramas Agrega un checkbox con os procesos que hay actuamente]
	 */
	// var checkprogramasConstruccion = function(e){
	// 	$.ajax({
	//         url: '../Controlador/DOC_InstruEval_Controlador.php',
	//         type:  'post',
	//         async: false,
	//         dataType:'json',
	//         data:{
	//         	operacion: "checkprogramasConstruccion"
	// 		},
	//         success:  function (data) {
	//            if(data == 0){
 //                    $('#lab_pro').html('No hay procesos en fase de contruccion');
 //                    $('#B_guardarInstru').css('display','none'); 
 //                    $('#B_modificarInstru').css('display','none');
 //                    $('#tabla_agregar').css('display','none');
	//            }else{
	//                $('#checkbox_programas').html('');
 //    	        	$('#checkbox_programas').append('<span style="color:green; font-size:10px;">En esta seccion podra visualizar unicamente los procesos en estado de contrucción</span><br /><input type="checkbox" name="todo" value="">&nbsp;&nbsp;&nbsp;Todos<br>');
 //    	        	for(var i=0; i<data.length; i++){
 //    	        		$('#checkbox_programas').append('<input type="checkbox" name="procesos[]" value="'+data[i].pk_proceso+'">&nbsp;&nbsp;&nbsp;'+data[i].nombre+'(   Fase :'+data[i].nombre_fase+')<br>');
 //    	        	// 	if(data[i].fk_fase != 3){
 //    	        	// 		//$('#checkbox_programas').append('<span style="color:#d85b00">'+data[i].nombre+'(Fase : '+data[i].nombre_fase+')</span>&nbsp;&nbsp;&nbsp;&nbsp;');
 //    	        	// 		//$('#checkbox_programas').append('<input type="checkbox" disabled readonly name="procesos[]" value="'+data[i].pk_proceso+'">'+data[i].nombre+'(   Fase :'+data[i].nombre_fase+')<br>');
 //    	        	// 	}else{
 //    	        	// 		$('#checkbox_programas').append('<input type="checkbox" name="procesos[]" value="'+data[i].pk_proceso+'">'+data[i].nombre+'(   Fase :'+data[i].nombre_fase+')');
 //    	        	// 	}
 //    	        	}
	//            }
	        	
	// 		}
 //   		});
	//}

	verificarfase();
	//checkprogramasConstruccion();

	// cuando de click en el input name="todos" selecciona todos lo checkbox de name procesos[]
	
    $('input[name="todo"]').on('click', function(e){
	    if($(this).is(':checked'))
	        $('input[name="procesos[]"]').prop('checked',true);
	    else
	        $('input[name="procesos[]"]').prop('checked',false);
    });

    $('#B_limpiar').on('click', function(e){
    	    $('select[name="S_tipoRespuesta"]').val(0);
			$('input[name="nuevo_tipo_respuesta"]').val("")
			$("input[name='factor']").val("");
			$("input[name='caracteristica']").val("");
			$("input[name='aspecto']").val("");
			$("input[name='evidencia']").val("");
			$("input[name='instrumento']").val("");
		    $("#factor").text("");
			$('#caracteristica').text("");
			$('#aspecto').text("");
			$('#evidencia').text("");
			$('#instrumento').text("");
			$('#text_pregunta').val("");
			$('select[name="S_tipoRespuesta"]').val($('select[name="S_tipoRespuesta"] option:first').val()).change();
			$('select[name="S_opcionesRespuesta"]').val(0);
			$('select[name="grupoInteres[]"]').attr('checked', false);
    });



});