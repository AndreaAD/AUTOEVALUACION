$(function(e){
	var rel = 0;

	/**
	 * [mostrarProceso Muestra la carga de un archivo , pinta la barra de carga ]
	 * @param  {[type]} e
	 * @return {[void] Pinta el porcentaje}
	 */
	var mostrarProceso = function(e){
	    if(e.lengthComputable){
	    	var progreso = (e.loaded * 100) / e.total;
	        $('.file-uploader[data-rel="'+rel+'"]').find('.progreso').css('width',progreso+'%');
	        if (e.loaded == e.total){
	        	$('.file-uploader[data-rel="'+rel+'"] input[type="file"]').val('');
	        	$('.file-uploader[data-rel="'+rel+'"]').find('.progreso').css('width','0%');
	        }
	    }
	   
	}

	/**
     * [mostrarProcesoinfo Muestra la carga de un archivo de informacion adicional , pinta la barra de carga]
     * @return [void] [pinta la barra de carga]
     */
	var mostrarProcesoinfo = function(e){
	    if(e.lengthComputable){
	    	var progreso = (e.loaded * 100) / e.total;
	        $('.file-uploader[data-rel="'+rel+'"]').find('.progresoinfo').css('width',progreso+'%');
	        if (e.loaded == e.total){
	        	$('.file-uploader[data-rel="'+rel+'"] input[type="file"]').val('');
	        	$('.file-uploader[data-rel="'+rel+'"]').find('.progresoinfo').css('width','0%');
	        }
	    }
	   
	}

	/**
	 * [Se realiza un delegate para cada etiqqueta a con clase subir para que suba los archivos correspondientes por cada instrumento]
	 * Se envia los valores de los porcentajes a mostrarProceso para que piente la barra de proceso de la carga de el archivo
	 * finalmente no devuelve como resultado agregar un tr a la tabla de archivos con la infromacion del nuevo archivo
	 */
	$('#div_contenido_completo').delegate('a.subir', 'click', function(e){
		var contenedor = $(this).closest('.file-uploader');
		var operacion;
		opc = $(this).data('op');

		if(opc == "cargar_doc_todos"){
			operacion = "CargarVariosArchivos";
		}

		if (opc == "cargar_info" ){
			operacion = "cargarInfo";
		}else{
			operacion = "cargarArchivo";
		}
		rel = $(this).data('rel');

		var formData = new FormData();
		var file = contenedor.find('input[type="file"]')[0];
		var seccion = $('input[name="grupoI"]').val();
		formData.append('archivo', file.files[0]);
		formData.append('seccion', seccion);
		formData.append('operacion',operacion);
		formData.append('pk_instru_evaluacion', $(this).data('rel'));
		formData.append('id_proceso', $(this).data('proceso'));
		$.ajax({
		    url: '../Controlador/DOC_InfoAdicional_Controlador.php',
		    type: 'POST',
		    dataType:'json',
		    xhr: function() {
		        myXhr = $.ajaxSettings.xhr();
		        if(myXhr.upload){
		        	if(operacion == "cargarInfo")
		            	myXhr.upload.addEventListener('progress', mostrarProcesoinfo, false); 
		            if(operacion == "cargarArchivo")
		            	myXhr.upload.addEventListener('progress', mostrarProceso, false); 
		        }
		        return myXhr;
		    },
		    success: function(data)
		    {
		    	if (opc == "cargar_info" ){
					if(data.estado == 1){
		    		var archivo = '<tr data-id="'+data.id+'"><td><a  href="'+data.url+'" target="_blank">'+data.nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
		    		$('.file-uploader[data-rel="'+rel+'"] table.info').append(archivo);
			    	}else{
			    		
			    	}
				}else{
					if(data.estado == 1){
		    		var archivo = '<tr data-id="'+data.id+'"><td><a  href="'+data.url+'" target="_blank">'+data.nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
		    		$('.file-uploader[data-rel="'+rel+'"] table.archivos').append(archivo);
			    	}else{
			    		
			    	}
				}


		    	/*if(data.estado == 1){
		    		var archivo = '<tr data-id="'+data.id+'"><td><a  href="'+data.url+'" target="_blank">'+data.nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
		    		$('.file-uploader[data-rel="'+rel+'"] table.archivos').append(archivo);
		    	}else{
		    		
		    	}*/
		    },
		    data: formData,
		    cache: false,
		    contentType: false,
		    processData: false
		});
		e.preventDefault();
	});
});