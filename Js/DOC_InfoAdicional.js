$(function (e){
	// definciion de variables

	var B_subir = $("#B_agregarInfoAdicional");
	var bt_eliminar = $("#eliminarinfoAd");
	var select_instrumento = $('select[id="buscaInfo"]');
	var select_info = $('select[name="informacion"]');
	var tabla_guardar_info = $('#tabla_agregar_info');
	var div_emergente = $('#div_emergente');

	//funcion encargada de ocukatar el div:emergente que en este caso es la ventana emergente que usamos
	var ocultar_emergente = function(){
		setTimeout(function(){ div_emergente.fadeOut("slow"); },2000)
	}
		/**
		 * [Evento de click sobre el boton subir de informacion adicional]
		 */
		B_subir.on('click', function(e){
			var archivos = document.getElementById("F_archivos");//Damos el valor del input tipo file
			var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
			//obtener el valor del select pero con jquery selector es el id del select que necesitamos
			var pregunta = $("input[name='instrumento']").val();
			var operacion = "guardarInfoAdicional";
			//El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo 
			var data = new FormData();
			//Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al 
			//objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
			//que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
			for(i=0; i<archivo.length; i++){
				data.append('archivo'+i,archivo[i]);	
			}
			data.append('pregunta',pregunta);
			data.append('operacion',operacion);

			$.ajax({
				url:'../Controlador/DOC_InfoAdicional_Controlador.php', //Url a donde la enviaremos
				type:'POST', //Metodo que usaremos
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:data, //Le pasamos el objeto que creamos con los archivos
				processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false,//Para que el formulario no guarde cache
				success:  function (data) {
		        	if(data == 1){
		        		cargarInfoAdicional(e);
		        		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>El archivo se guardo satisfactoriamente</p>');
		        		$('#A_factor').val("");
		        		$('#A_caracteristica').val("");
		        		$('#A_aspecto').val("");
		        		$('#A_evidencia').val("");
		        		$('#A_instrumento').val("");
		        		$('#F_archivos').val("");
		        		ocultar_emergente();
		        		//$('#info')[0].click();
		        	}else if (data == 2){
		        		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Por favor Seleccione un archivo con una de las siguientes extensiones:<br> Word, Pdf, Excel</p>');
		        		div_emergente.fadeIn();
		        		//$('.errores').html('Por favor Seleccione un archivo con la extension correcta documentos Word, Pdf, excel');
		        	}else if (data == 4){
		        		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Por favor ingrese todos los campos del formulario</p>');
		        		div_emergente.fadeIn();
		        		//$('.errores').html('Por favor ingrese todos los campos del formulario');
		        	}else if (data == 3){
		        		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Ocurrio un error al subir el archivo</p>');
		        		div_emergente.fadeIn();
		        		//$('.errores').html('Ocurrio un error a el subir el archivo');
		        	}
				} 
			});
	});
	
	/**
	 * [cargarInfoAdicional Carga la infomacion adicional en una tabla que tenemos definida]
	 */
	var cargarInfoAdicional = function(e){
		$.ajax({
	        url: '../Controlador/DOC_InfoAdicional_Controlador.php',
	        type:  'post',
	        async: false,
	        dataType:'json',
	        data:{
	        	operacion: "cargarInfoAdicional",
	        	pregunta: $("input[name='instrumento']").val()
			},
	        success:  function (data) {
	        	if (data.length > 0){
					tabla_guardar_info.html("");
		        	var lista ="<tr><th>Información</th><th>Deshabilitar</th><th>Descargar</th></tr>";
					for(var i = 0; i < data.length; i++){
						lista += '<tr  data-id="'+data[i].pk_infoAdicional+'"><td data-td="descripcion2">'+data[i].nombre+'</td><td><a  data-evento="eliminar" href="#" >Deshabilitar</a></td><td><a target="_blank" href="'+data[i].url+'"> Descargar </a></td></tr>';
					}
					tabla_guardar_info.html(lista);	     
	        	}else{
	        		tabla_guardar_info.html("");
	        	}
	        	   	
			}
   		});
	}

	/**
	 * [Evento delegate sobre nuestra tabla de informaciion adicional el cual sirve para eliminar correctamente cada archivo de informacion adicional
	 * adicionalmente limpiamos los campos de este formulario]
	 */
	tabla_guardar_info.delegate('a[data-evento="eliminar"]', 'click', function(e){
		var id = $(this).closest('tr').data('id');
		$.ajax({
			url: '../Controlador/DOC_InfoAdicional_Controlador.php',
			method: 'post',
			dataType:'json',
			async: false,
			data: {
				operacion: "eliminarinfoAdicional",
				id: id
			},
			success:  function (data) {
				if (data == 1){
					cargarInfoAdicional(e);
					$('#A_factor').val("");
	        		$('#A_caracteristica').val("");
	        		$('#A_aspecto').val("");
	        		$('#A_evidencia').val("");
	        		$('#A_instrumento').val("");
	        		$('#F_archivos').val("");

					$('#factor').text("");
					$('#caracteristica').text("");
					$('#aspecto').text("");
					$('#evidencia').text("");
					$('#instrumento').text("");
					div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Se elimino el archivo satisfactoriamente</p>');
					ocultar_emergente();
				}else{
					div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Ocurrio un error al eliminar el archivo</p>');
					ocultar_emergente();
				}
			}
		});
		e.preventDefault();
	});


});