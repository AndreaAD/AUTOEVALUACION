$(function(e){


	var link_factor = $('#A_factor');
	var link_caracteristica = $('#A_caracteristica');
	var link_proyecto = $('#A_proyecto');
	var link_actividad = $('#A_actividad');
	var link_buscar = $('#B_buscar');
	var link_diligencia = $('#B_diligencia');
	
	var div_emergente = $('#div_emergente');
	
    	_id_factor = 0;
		_id_caracteristica = 0;
		_id_proyecto = 0;
        _id_actividad = 0;
                
	var cerrarEmergente = function(e){
	div_emergente.css('display','none');
	e.preventDefault();
	}
	var ocultar_emergente = function(){
		setTimeout(function(){ div_emergente.fadeOut("slow"); },2000)
	}
	
	div_emergente.find('.emergente span[data-rol="cerrar"]').on('click', function(e){
		div_emergente.css('display','none');
		e.preventDefault();
	});
	
	
	link_diligencia.on('click', function(e){
	if(_id_caracteristica == 0){
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Debe seleccionar una caracteristica antes de ir a buscar!!!</p>');
		}else{
		 $('#H_opcion').val("diligenciar_plan");
			
			$.ajax({
				url: '../Controlador/PLM_LlenarPlan_Control.php',
				method: 'post',
				dataType:'html',
				data: $('#buscar_factor').serialize(),
				success:  function (data) { 
					$('.principal-panel-contenido').html(data);
					$('.principal-panel-sub-contenido').html('');
				}
			});	
		}
		//div_emergente.css('display','block');
	});
	
	link_buscar.on('click', function(e){
	if(_id_actividad == 0){
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Debe seleccionar una actividad antes de ir a buscar!!!</p>');
		}else{
		 $('#H_opcion').val("ver_acti_carac");
			
			$.ajax({
				url: '../Controlador/PLM_ConsPlan_Control.php',
				method: 'post',
				dataType:'html',
				data: $('#buscar_factor').serialize(),
				success:  function (data) { 
					$('.principal-panel-contenido').html(data);
					$('.principal-panel-sub-contenido').html('');
				}
			});
		}		
		//div_emergente.css('display','block');
	});
	
	link_factor.on('click', function(e){
     $('#H_opcion').val("busca_factor");
		div_emergente.find('.emergente > div[data-role="contenido"]').html("");
		
		$.ajax({
			url: '../Controlador/PLM_ConsPlan_Control.php',
			method: 'post',
			dataType:'json',
			async: false,
			data: $('#buscar_factor').serialize(),
			success:  function (data) { 
				var lista = '<div class="row"><ul class="selector" data-rel="factor">';
				for(var i = 0; i < data.length; i++){
					lista += '<li><a href="#" data-id="'+data[i].pk_factor+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
				}
				lista += "</ul></div>";
				div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
			}
		});
		
		div_emergente.css('display','block');
	});

	link_caracteristica.on('click', function(e){
     $('#H_opcion').val("busca_caracteristica");
		if(_id_factor == 0){
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione un factor antes de seleccionar una característica</p>');
		}else{
				$.ajax({
					url: '../Controlador/PLM_ConsPlan_Control.php',
					method: 'post',
					dataType: 'json',
					async: false,
					data: $('#buscar_factor').serialize(),
					success: function (data) {
						var lista = '<div class="row"><ul class="selector" data-rel="caracteristica">';
						for(var i = 0; i < data.length; i++){
							
							lista += '<li><a href="#" data-id="'+data[i].pk_caracteristica+'">'+data[i].codigo+'. '+data[i].nombre+'</a></li>';
						}
						lista += "</ul></div>";
						div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
					}
				});
		}
		div_emergente.css('display','block');
	});
	
	
	link_proyecto.on('click', function(e){
     $('#H_opcion').val("busca_proyecto");
		if(_id_caracteristica == 0){
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione una característica antes de seleccionar un proyecto</p>');
		}else{
				$.ajax({
					url: '../Controlador/PLM_ConsPlan_Control.php',
					method: 'post',
					dataType: 'json',
					async: false,
					data: $('#buscar_factor').serialize(),
					success: function (data) {
						var lista = '<div class="row"><ul class="selector" data-rel="proyecto">';
						for(var i = 0; i < data.length; i++){
							
							lista += '<li><a href="#" data-id="'+data[i].pk_proyecto+'">'+data[i].pk_proyecto+'. '+data[i].nombre+'</a></li>';
						}
						lista += "</ul></div>";
						div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
					}
				});
		}
		div_emergente.css('display','block');
	});
	
    
    
	link_actividad.on('click', function(e){
     $('#H_opcion').val("busca_actividad");
		if(_id_proyecto == 0){
			div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>Seleccione un proyecto antes de seleccionar una actividad</p>');
		}else{
				$.ajax({
					url: '../Controlador/PLM_ConsPlan_Control.php',
					method: 'post',
					dataType: 'json',
					async: false,
					data: $('#buscar_factor').serialize(),
					success: function (data) {
						var lista = '<div class="row"><ul class="selector" data-rel="actividad">';
						for(var i = 0; i < data.length; i++){
							
							lista += '<li><a href="#" data-id="'+data[i].pk_actividad+'">'+data[i].pk_actividad+'. '+data[i].objetivo+'</a></li>';
						}
						lista += "</ul></div>";
						div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
					}
				});
		}
		div_emergente.css('display','block');
	});
	
    
    
	div_emergente.delegate('.selector a', 'click', function(e){
		var rel = $(this).closest('.selector').data('rel');
		var id = $(this).data('id');
		var descripcion = $(this).text();
		$('#'+rel).text(descripcion);
		switch(rel){
			case 'factor':
				_id_factor = id;
				
				$("input[name='factor']").val(_id_factor);
				_id_caracteristica = 0;
				$("input[name='caracteristica']").val("");
				
				proyecto = 0;
				$("input[name='proyecto']").val(_id_proyecto);
				
			break;
			case 'caracteristica':
				_id_caracteristica = id;
				$("input[name='caracteristica']").val(_id_caracteristica);
				
				_id_proyecto = 0;
				$("input[name='proyecto']").val(_id_proyecto);
				
			break;	
			case 'proyecto':
				_id_proyecto = id;
				$("input[name='proyecto']").val(_id_proyecto);
                
                _id_actividad =0;
				$("input[name='actividad']").val(_id_actividad);
				
			break;
			case 'actividad':
				_id_actividad = id;
				$("input[name='actividad']").val(_id_actividad);
				
			break;			
		}	
		cerrarEmergente(e);
	});


 });
