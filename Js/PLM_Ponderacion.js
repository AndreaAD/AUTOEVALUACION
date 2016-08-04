
var div_emergente = $('#div_emergente');
var sel = $('input[name="select"]');
_sel=0;
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

sel.on('click', function(e){
    
	_sel=1;
});    

function buscaCarac()
{    
    if(_sel==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>Debe seleccionar un factor!!! </h2></p>');
		div_emergente.css('display','block');
    }
    else
    {
     $.ajax({
        url:   '../Controlador/PLM_Ponderacion_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarCaract').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
        });
    }
   
}
function guardarValor()
{
    
    var op = $("#S_opcion").val();
    if(op==false)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>No selecciono ninguna opcion!!! </h2></p>');
		div_emergente.css('display','block');
    }
    else
    {
     $.ajax({
        url:   '../Controlador/PLM_Ponderacion_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardar').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
   }
}


function AtrasCarac()
{
       $.ajax({
        url:   '../Controlador/PLM_Ponderacion_Control.php',
         type:  'post',
        dataType:'html',
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
}

function addRazon()
{

     $('#H_opcion').val("addRazon");
       $.ajax({
        url:   '../Controlador/PLM_Ponderacion_Control.php',
        type:  'post',
        dataType:'html',
        data: $('#guardar').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
}


function guardarRazon()
{
	var razon = $("#TA_razon").val();
	
	if(razon ==false)
	{
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2>El campo razon se debe agregar!!! </h2></p>');
		div_emergente.css('display','block');
	}
	else
	{	
       $.ajax({
			url:   '../Controlador/PLM_Ponderacion_Control.php',
			type:  'post',
			dataType:'html',
			data: $('#guardarRazon').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
   }
}

function atrasRazon()
{
     $('#H_opcion').val("buscarCaract");
       $.ajax({
        url:   '../Controlador/PLM_Ponderacion_Control.php',
        type:  'post',
        dataType:'html',
        data: $('#guardarRazon').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
}

function AtrasAnalisis2()
{
     $('#H_opcion').val("buscarCaract");
     $.ajax({
        url:   '../Controlador/PLM_Ponderacion_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#mensaje').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 
function AtrasAnalisis()
{
     $('#H_opcion').remove();
     $.ajax({
        url:   '../Controlador/PLM_Ponderacion_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#mensaje').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 
