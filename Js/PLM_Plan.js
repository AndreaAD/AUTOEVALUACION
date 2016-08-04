

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