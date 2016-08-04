

   
   
  $('#T_valorFin').keyup(function (){
	this.value = (this.value + '').replace(/[^0-9.]/g, '');
  });
     
  $('#T_valorIni').keyup(function (){
	this.value = (this.value + '').replace(/[^0-9.]/g, '');
  });
        
        
var div_emergente = $('#div_emergente');

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

function guardar(){

	var nombre= $('#T_escala').val();
	var valor1= $('#T_valorIni');
	var valor2= $('#T_valorFin');
	var concep= $('#T_concepto').val();
	
    if(nombre==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Se debe agregar el campo nombre escala!!!</h2></p>');
		div_emergente.css('display','block');	
    }
	else if(valor1.val().length < 1)
	{
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El valor inicial de la escala se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
	}
	
	else if(valor2.val().length < 1)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El valor final de la escala se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }
	
	else if(concep==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El concepto de la escala se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }
    else
    {
        $.ajax({
            url:   '../Controlador/PLM_AddEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#guardar').serialize(),
            success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
            }
        });
	}
}

function buscar(){
        $.ajax({
            url:   '../Controlador/PLM_modEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#guardar').serialize(),
            success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
            }
        });
}


function guardarFinal(){
var nombre= $('#T_escala').val();
	var valor1= $('#T_valorIni').val();
	var valor2= $('#T_valorFin').val();
	var concep= $('#T_concepto').val();
	
    if(nombre==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El nombre de la escala se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }
	else if(valor1==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El valor inicial de la escala se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }
	else if(valor2==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El valor final de la escala se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }

	else if(concep==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El concepto de la escala se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }
    else
    {
        $.ajax({
            url:   '../Controlador/PLM_modEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#guardar').serialize(),
            success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
            }
        });
	}
}

function buscarHabi(){
        $.ajax({
            url:   '../Controlador/PLM_HabiEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#buscar').serialize(),
            success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
            }
        });
}
function guardarHabi(){
        $.ajax({
            url:   '../Controlador/PLM_HabiEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#guardar').serialize(),
            success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
            }
        });
}
function buscarDes(){
        $.ajax({
            url:   '../Controlador/PLM_DeshabiEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#buscar').serialize(),
            success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
            }
        });
}


function guardarDes(){
        $.ajax({
            url:   '../Controlador/PLM_DeshabiEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#guardar').serialize(),
            success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
            }
        });
}




