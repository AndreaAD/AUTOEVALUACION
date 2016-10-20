

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


function buscaCarac(){

    if(_sel==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar un factor!!! </h1></p>');
		div_emergente.css('display','block');
    }
    else
    {
		 $.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#buscarCaract').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
   }
}

function buscaAspec(){

    if(_sel==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar una caracteristica!!! </h1></p>');
		div_emergente.css('display','block');
    }
    else
    {
		 $.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#buscarAspec').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
   }
}

function buscaEvi(){
    if(_sel==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar una aspecto!!! </h1></p>');
		div_emergente.css('display','block');
    }
    else
    {
     $.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#buscarEvi').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
   }
}

function verGrupoInt()
{ 
	if(_sel==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar una evidencia!!! </h1></p>');
		div_emergente.css('display','block');
    }
    else
    {
     $.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#graficaGrupoInt').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
   }
}

function guardarAnalisis()
{
	var fortaleza = $("#TA_fortaleza").val();
	var debilidad = $("#TA_debilidad").val();
	var analisis = $("#TA_analisis").val();

	if(fortaleza==false)
	{
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>El campo fortaleza se debe agregar!!! </h1></p>');
		div_emergente.css('display','block');
	}
	else if(debilidad==false)
	{
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>El campo debilidad se debe agregar!!! </h1></p>');
		div_emergente.css('display','block');
	}
	else if(analisis==false)
	{
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>El campo análisis se debe agregar!!! </h1></p>');
		div_emergente.css('display','block');
	}
	else
	{
     $.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#guardarAnalisis').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
   }
}


function AtrasCarac()
{
       $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
}

function AtrasAspec()
{
     $('#H_opcion').val("buscarCaract");
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarEvi').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 


function AtrasAnalisis()
{
     $('#H_opcion').val("buscarCaract");
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardarAnalisis').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 

function AtrasEvi()
{
     $('#H_opcion').val("buscarAspec");
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#graficaGrupoInt').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 


function AtrasGrupo()
{
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#graficaGrupoInt').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 

function reportePdf()
{
     $('#H_opcion').val("reporteAnalisis");
     $.ajax({
        url:   '../Vista/PLM_ReportePdf_Vista.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarCaract').serialize()
   });
} 

function verGrafiFac()
{
     $('#H_opcion').val("verGraficaFac");
    
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarCaract').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 

function verGrafiCarac()
{
     $('#H_opcion').val("verGraficaCarac");
    
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarAspec').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 

function verGrafiAspec()
{
     $('#H_opcion').val("verGraficaAspec");
    
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarEvi').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 


function AtrasGrafAspec()
{
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarAspec').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 
function AtrasGrafCarac()
{
     $('#H_opcion').val("buscarCaract");
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarAspec').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 

function AddAnalisis()
{
	if(_sel==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar una caracteristica!!! </h1></p>');
		div_emergente.css('display','block');
    }
    else
    {
     $('#H_opcion').val("AddAnalisis");
     $.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#buscarAspec').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
   }
} 

function verEscaFac()
{
     $('#H_opcion').val("VerAnalisisFac");
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarCaract').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
}
function verEscaCarac()
{
     $('#H_opcion').val("VerAnalisisCarac");
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarAspec').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });
}

function verEscaAspec()
{ 
    $('#H_opcion').val("VerAnalisisAspec");
     $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarEvi').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
		}       
   });    
}

function mostrarObserva()
{
	if(_sel==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar un aspecto!!! </h1></p>');
		div_emergente.css('display','block');
    }
    else
    {
    $('#H_opcion').val("mostrarObserva");
     $.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#buscarEvi').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });    
   }
} 

function pagAtrasAspec()
{
    $('#H_opcion').val("buscarCaract");
    $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarEvi').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
}       
   });
} 
 

function pagAtrasCarac()
{
    $('#H_opcion').val("buscarCaract");
    $('#H_pag').val("atr");
    $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscarAspec').serialize(),
		success:  function (data) {
			$('.principal-panel-sub-contenido').html(data);
}       
   });
} 

function verObserCarac()
{
    $('#H_opcion').val("obserCarac");
    $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardarAnalisis').serialize(),
		success:  function (data) {
		$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 

function atrasObserCarac()
{
    $.ajax({
        url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#observaciones').serialize(),
		success:  function (data) {
		$('.principal-panel-sub-contenido').html(data);
		}       
   });
} 

$(function(e){

    $( "#tabla_analisis_factor" ).delegate("input[name='seleccionar_factor']", "change", function() {
        var factor =$(this).closest('tr').data('rel');
        $('#id_fact').val(factor);

    });

    $("#buscar_caracteristicas").on('click', function(e){
        if($('#id_fact').val() != 0){
            var id = $('#id_fact').val();
            $.ajax({
                url: '../Controlador/PLM_PrincipalAnalisis_Control.php',
                dataType:'html',
                data:{
                    id_factor : id,
                    H_opcion : 'buscarCaract',
                },
                success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
                    
                }
               
            }); 
        }

    });

    // $('#atras_').on('click', function(e){
    //      window.history.back();
    // });    

    $( "#tabla_analisis_caracteristicas" ).delegate("input[name='seleccionar_caracteristica']", "change", function() {
        var caracteristica =$(this).closest('tr').data('rel');
        $('#id_carac').val(caracteristica);

    });

    $('#agregar_analisis').on('click', function(e){
        if($('#id_carac').val() != 0){
            var id = $('#id_carac').val();
            $.ajax({
                url: '../Controlador/PLM_PrincipalAnalisis_Control.php',
                dataType:'html',
                data:{
                    id_carac : id,
                    H_opcion : 'AddAnalisis',
                },
                success:  function (data) {
                    $('.principal-panel-sub-contenido').html(data);
                    
                }
            });
        }
    });

});