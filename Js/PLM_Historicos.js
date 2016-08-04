

var div_emergente = $('#div_emergente');

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
   

function geneConsilidado()
{
   
        $.ajax({
        url:   '../Controlador/PLM_Historicos_Control.php',
        type:  'post',
        dataType:'html',
        data: $('#generaConsolidado').serialize(),
    	success:  function (data) {
    		$('.principal-panel-sub-contenido').html(data);
    	}       
       });
   
}

function atras_process()
{
    $.ajax({
    url:   '../Controlador/PLM_Historicos_Control.php',
    type:  'post',
    dataType:'html',
	success:  function (data) {
		$('.principal-panel-sub-contenido').html(data);
	}       
   });
}