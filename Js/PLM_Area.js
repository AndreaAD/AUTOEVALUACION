
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

	
function add(){
    
    var nombre= $('#T_nombre').val();
    if(nombre==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El nombre del area se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }
    else
    {
        $.ajax({
            url:   '../Controlador/PLM_AddArea_Control.php',
            type:  'post',
            dataType:'html',    
            data: $('#guardar').serialize(),
    		success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
    		}
       });
   }
}

function busca(){
    
     $.ajax({
        url:   '../Controlador/PLM_HabiArea_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar').serialize(),
		success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
		}       
   });
}

function busca2(){
     $.ajax({
        url:   '../Controlador/PLM_ModArea_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar').serialize(),
        success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
        }   
   });   
}

function busca3(){
     $.ajax({
        url:   '../Controlador/PLM_DesArea_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar').serialize(),
        success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
        }   
   });   
}

function mod(){

	var nombre= $('#T_nombre').val();
    if(nombre==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El nombre del area se debe agregar!!!</h2></p>');
		div_emergente.css('display','block');	
    }
    else
    {
     $.ajax({
        url:   '../Controlador/PLM_ModArea_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardar').serialize(),
        success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
        }        
	});
   }
    
}

function eli(){
     $.ajax({
        url:   '../Controlador/PLM_DesArea_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#eliminar').serialize(),
		success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
		}       
   });
    
}
function habi(){
     $.ajax({
        url:   '../Controlador/PLM_HabiArea_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#habilitar').serialize(),
		success:  function (data) {
    			 $('.principal-panel-sub-contenido').html(data);
		}       
   });
    
}
