

var rad = $('input[name="radio"]');
_rad=0;
rad.on('click', function(e){
    
	_rad=1;
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
function js_buscar_factor() {
     $.ajax({
        url:   '../Controlador/PLM_LlenarPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar_factor').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function js_diligenciar_plan() {
     $.ajax({
        url:   '../Controlador/PLM_LlenarPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar_caracteristica').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
   
}


function js_buscar_plan() {
     $.ajax({
        url:   '../Controlador/PLM_ModPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar_plan').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function js_guardar_plan2() {
     $.ajax({
        url:   '../Controlador/PLM_ModPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardar_plan').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function busca2(){
     $.ajax({
        url:   '../Controlador/PLM_ModPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar_plan').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function modplan(){
     $.ajax({
        url:   '../Controlador/PLM_ModPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardar').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }        
   });
    
}

function busca2c(){
     $('#H_opcion').val("ver_actividades");
     $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
            $('.principal-panel-sub-contenido').html('');
        } 		
   });  
}

function atrasc(){
     $('#H_opcion').val("ver_factor");
     $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardar').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}
function atrasc2(){
     $('#H_opcion').val("ver_procesos");
     $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardar').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function atrasc3(){
     $('#H_opcion').remove();
     $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#guardar').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}
function js_atras_plan() {
     $.ajax({
        url:   '../Vista/PLM_PrincipalPlan.php',
         type:  'post',
        dataType:'html',
        data: $('#atras_plan').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function buscar_Activi_fac() {
     $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar_factor').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function buscar_Activi_Carac() {
     $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#buscar_caracteristica').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}

function buscar_Activi_proceso() {
     $.ajax({
        url:   '../Controlador/PLM_ConsPlan_Control.php',
         type:  'post',
        dataType:'html',
        data: $('#mostrarProcesos').serialize(),
        success:  function (data) {
            $('.principal-panel-contenido').html(data);
        }   
   });   
}
function busca_acti_proce() {
    
    if(_rad==0)
    {
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar un proceso!!! </h1></p>');
		div_emergente.css('display','block');
    }
    else
    {
     $.ajax({
            url:   '../Controlador/PLM_ConsPlan_Control.php',
             type:  'post',
            dataType:'html',
            data: $('#buscarActivi').serialize(),
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }   
       });
   }   
}

function busca_acti_historicos() {
    if(_rad==0)
    {
        div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h1>Debe seleccionar un proceso!!! </h1></p>');
        div_emergente.css('display','block');
    }
    else
    {
     $.ajax({
            url:   '../Controlador/PLM_ConsPlan_Control.php',
             type:  'post',
            dataType:'html',
            data: $('#busca_acti_historicos').serialize(),
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }   
       });
   }   
}



    
   _temp=0;
 
function fecha_Inv()
{
    
	var link_anio1 = $('#T_valor1');
	var link_anio2 = $('#T_valor2');
	var link_anio3 = $('#T_valor3');
    if(_temp==0)
    {
        link_anio1
		link_anio1.css('display','none');
		link_anio2.css('display','none');
		link_anio3.css('display','none');
        _temp=1;
    }
    else if(_temp==1)
    {
		link_anio1.css('display','inline');
		link_anio2.css('display','inline');
		link_anio3.css('display','inline');
        _temp=0;
    }
    
    
    
}

$(function(e){

    // $('#boton_objetivo').on('click', function(e){
    //     if( $('.div_oculto_objetivo').is(":visible") ){
    //         $('.div_oculto_objetivo').css('display', 'none');
    //     }else{
    //         $('.div_oculto_objetivo').css('display', 'block');
    //     }
    // });

    cargarTablaFactorPlam();

    $('#tabla_factor_plm tbody').delegate('a', 'click'  ,function(e){
        var id = $(this).closest('tr').data('rel');
        $('#lista_factores').val(id).trigger('change');
        $('#guardar_plm').val('Modificar');
    });


    function cargarTablaFactorPlam()
    {
        $.ajax({
            url: '../Controlador/PLM_planes_Controlador_2.php',
            type:  'post',
            async: false,
            dataType:'json',
            data:{
                proceso: $('#proceso').val(),
                operacion : "cargar_tabla_plan"
            },
            success:  function (data) {
                if(data.length > 0){
                    var tabla = $('#tabla_factor_plm tbody');
                    tabla.html('');
                    var lista = '';
                    for(var i=0; i<data.length; i++){
                        lista += '<tr data-rel="'+data[i]['fk_factor']+'">';
                            lista += '<td>'+data[i]['fk_factor']+'</td>';
                            lista += '<td>'+data[i]['nombre']+'</td>';
                            lista += '<td>'+data[i]['fecha_inicio']+'</td>';
                            lista += '<td>'+data[i]['fecha_fin']+'</td>';
                            lista += '<td><a href="#">Modificar</a></td>';
                        lista += '</tr>';
                    }
                    tabla.html(lista);
                }
            }    
        });
    }

    $('#guardar_plm').on('click', function(e){

        if( $('#nombre').val() != "" || $('#lista_factores option:selected').val() != 0   ||  $('#fecha_inicio').val() != "" || $('#fecha_fin').val() != ""  || $('#peso').val() != ""  || $('#indicador').val() != ""  || $('#responsable').val() != ""  || $('#cargo').val() != ""  || $('#descripcion').val() != "" ||   $('#recursos').val() != "" ||  $('#evidencias').val() != "" ){
            $.ajax({
                url: '../Controlador/PLM_planes_Controlador_2.php',
                type:  'post',
                async: false,
                dataType:'json',
                data:{
                    nombre: $('#nombre').val(),
                    proceso: $('#proceso').val(),
                    factor: $('#lista_factores option:selected').val(),
                    fecha_inicio: $('#fecha_inicio').val(),
                    fecha_fin: $('#fecha_fin').val(),
                    peso: $('#peso').val(),
                    indicador: $('#indicador').val(),
                    responsable: $('#responsable').val(),
                    cargo: $('#cargo').val(),
                    meta: $('#meta').val(),
                    descripcion: $('#descripcion').val(),
                    recursos: $('#recursos').val(),
                    evidencias: $('#evidencias').val(),
                    operacion : "guardar_objetivo"
                },
                success:  function (data) {
                    $('#nombre').val('');
                    $('#fecha_inicio').val('');
                    $('#fecha_fin').val('');
                    $('#peso').val('');
                    $('#indicador').val('');
                    $('#responsable').val('');
                    $('#cargo').val('');
                    $('#meta').val('');
                    $('#descripcion').val('');
                    $('#recursos').val('');
                    $('#evidencias').val('');

                    if(data){
                        $('#nombre').val(data[0]['nombre']);
                        $('#fecha_inicio').val(data[0]['fecha_inicio']);
                        $('#fecha_fin').val(data[0]['fecha_fin']);
                        $('#peso').val(data[0]['peso']);
                        $('#indicador').val(data[0]['indicador']);
                        $('#responsable').val(data[0]['responsable']);
                        $('#cargo').val(data[0]['cargo']);
                        $('#meta').val(data[0]['meta']);
                        $('#descripcion').val(data[0]['descripcion']);
                        $('#recursos').val(data[0]['recursos']);
                        $('#evidencias').val(data[0]['evidencias']);
                        cargarTablaFactorPlam();
                    }
                }
            });
        }else{
            alert('Debe ingresar todos los campos.');
        }

    });


    $('select#lista_factores').on('change', function(e){
        if($('#lista_factores option:selected').val() != 0){
            $('#guardar_plm').val('Guardar');
            $.ajax({
                url: '../Controlador/PLM_planes_Controlador_2.php',
                type:  'post',
                async: false,
                dataType:'json',
                data:{
                    proceso: $('#proceso').val(),
                    factor: $('#lista_factores option:selected').val(),
                    operacion : "consultar_plan"
                },
                success:  function (data) {
                    $('#nombre').val('');
                    $('#fecha_inicio').val('');
                    $('#fecha_fin').val('');
                    $('#peso').val('');
                    $('#indicador').val('');
                    $('#responsable').val('');
                    $('#cargo').val('');
                    $('#meta').val('');
                    $('#descripcion').val('');
                    $('#recursos').val('');
                    $('#evidencias').val('');

                    if(data.length > 0){
                        $('#nombre').val(data[0]['nombre']);
                        $('#fecha_inicio').val(data[0]['fecha_inicio']);
                        $('#fecha_fin').val(data[0]['fecha_fin']);
                        $('#peso').val(data[0]['peso']);
                        $('#indicador').val(data[0]['indicador']);
                        $('#responsable').val(data[0]['responsable']);
                        $('#cargo').val(data[0]['cargo']);
                        $('#meta').val(data[0]['meta']);
                        $('#descripcion').val(data[0]['descripcion']);
                        $('#recursos').val(data[0]['recursos']);
                        $('#evidencias').val(data[0]['evidencias']);
                    }
                }
            });
        }
    });

    $('#sede_plm').on('change', function(e){
        $('#facultad_plm').val(0);
        $('#programa_plm').val(0);
    });

    $('#facultad_plm').on('change', function(e){
        var sede = $('#sede_plm').val();
        var facultad = $('#facultad_plm').val();
        $('#programa_plm').val(0);

        if(sede != 0){
            $.ajax({
                url: '../Controlador/PLM_planes_Controlador_2.php',
                type:  'post',
                async: false,
                dataType:'json',
                data:{
                    sede : sede,
                    facultad : facultad,
                    operacion : "lista_programas"
                },
                success: function (data){
                    if(data.length > 0){
                        $opciones = '';                        
                        $.each( data, function( i, obj ) {
                            $opciones += '<option value="'+obj.pk_programa+'">'+obj.nombre+'</option>'; 
                        });

                        $("#programa_plm").append($opciones);

                    }else{
                    }
                }   
            });
        }else{
            alert('Debe seleccionar una sede');
        }
    });

    $('#buscar_plm_historico').on('click', function(e){
        if( $('#sede_plm').val() != 0 || $('#facultad_plm').val() != 0  ||  $('#programa_plm').val() != 0 ){

            var sede = $('#sede_plm').val();
            var facultad = $('#facultad_plm').val();
            var programa = $('#programa_plm').val();

            $.ajax({
                url: '../Controlador/PLM_planes_Controlador_2.php',
                type:  'post',
                async: false,
                dataType:'json',
                data:{
                    sede : sede,
                    facultad : facultad,
                    programa : programa,
                    operacion : "historico_plm"
                },
                success: function (data){

                    if(typeof data[0] !== 'undefined'){
                        $('.lista_plm').html('');
                        var planes = '';
                        planes += '<table>';
                        planes += '<tr>';
                        planes += '<th>Proceso</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Descargar</th>';
                        planes += '</tr>';
                        $.each(data, function( i, obj ){
                            planes += '<tr>';
                            planes += '<td>'+obj.nombre+'</td>';
                            planes += '<td>'+obj.fecha_inicio+'</td>';
                            planes += '<td>'+obj.fecha_fin+'</td>';
                            planes += '<td><button><a style="color:#fff;" target="_blank" href="../Vista/PLM_PlanesPdf_Vista.php?proceso='+obj.pk_proceso+'">Descargar</a></button></td>';
                            planes += '</tr>';
                        });
                        planes += '</table>';
                        $('.lista_plm').append(planes);
                    }else{
                        $('.lista_plm').html('No existen historicos de plan de mejoramiento de este programa');
                    }
                }   
            });
        }else{
            alert('Debe seleccionar todos los campos del formulario');
        }
    });

});
