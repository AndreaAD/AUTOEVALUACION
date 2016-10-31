function plm_enlazar_botones(){
	$("#BTN_rubros").click(function(event){
        event.preventDefault();
       colorElementos($(this));
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    });	
    
	$("#BTN_areas").click(function(event){
        event.preventDefault();
       colorElementos($(this));
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    });	
    $("#BTN_analisis").click(function(event){
        event.preventDefault();
       colorElementos($(this));
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    });	
    $("#BTN_ponderacion").click(function(event){
        event.preventDefault();
       colorElementos($(this));
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    }); 
    $("#BTN_resultado").click(function(event){
        event.preventDefault();
       colorElementos($(this));
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    });   
    
    
    $("#BTN_plan").click(function(event){
	    colorElementos($(this));
        event.preventDefault();
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    });	
    $("#BTN_actividades").click(function(event){
	    colorElementos($(this));
        event.preventDefault();
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    });	
    $("#BTN_proyectoi").click(function(event){
	    colorElementos($(this));
        event.preventDefault();
        $.ajax({
            url:   $(this).attr("href"),
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
    });
    	
}
function enlace_agregar_rubro(){
    
        $.ajax({
            url:   '../Controlador/PLM_AddRubro_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_modificar_rubro(){
        $.ajax({
            url:   '../Controlador/PLM_ModRubro_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_deshabilita_rubro(){
        $.ajax({
            url:   '../Controlador/PLM_DesRubro_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}
function enlace_habilita_rubro(){
        $.ajax({
            url:   '../Controlador/PLM_HabiRubro_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_agregar_area(){
        $.ajax({
            url:   '../Controlador/PLM_AddArea_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_modificar_area(){
        $.ajax({
            url:   '../Controlador/PLM_ModArea_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_deshabilita_area(){
        $.ajax({
            url:   '../Controlador/PLM_DesArea_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}
function enlace_habilita_area(){
        $.ajax({
            url:   '../Controlador/PLM_HabiArea_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function EnviarArea(){
        $.ajax({
            url:   '../Vista/PLM_PrincipalArea.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function EnviarRubro(){
        $.ajax({
            url:   '../Vista/PLM_PrincipalRubro.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function EnviarEscala(){
        $.ajax({
            url:   '../Vista/PLM_PrincipalEscala.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function EnviarProyecto(){
        $.ajax({
            url:   '../Vista/PLM_PrincipalProyecto.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function addEscala(){
        $.ajax({
            url:   '../Controlador/PLM_AddEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}



function modEscala(){
        $.ajax({
            url:   '../Controlador/PLM_modEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}



function habiEscala(){
        $.ajax({
            url:   '../Controlador/PLM_HabiEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}



function desEsca(){
        $.ajax({
            url:   '../Controlador/PLM_DeshabiEscala_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}


function enlace_llenar_plm(){
        $.ajax({
            url:   '../Controlador/PLM_LlenarPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_llenar_plm_factor(){
        $.ajax({
            url:   '../Controlador/PLM_LlenarPlanFactor_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_modificar_plm() {
        $.ajax({
            url:   '../Controlador/PLM_ModPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}
function enlace_consulta_plm(){
        $.ajax({
            url:   '../Vista/PLM_PrincipalPlanCons.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function enlace_buscar_poractividad(){
        $.ajax({
            url:   '../Controlador/PLM_ConsPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function enlace_buscar_porfactor(){
        $.ajax({
            url:   '../Controlador/PLM_ConsPlanF_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}



function enlace_llenar_plm(){
        $.ajax({
            url:   '../Controlador/PLM_LlenarPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}
function enlace_modificar_plm() {
        $.ajax({
            url:   '../Controlador/PLM_ModPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}
function enlace_consulta_plm(){
        $.ajax({
            url:   '../Vista/PLM_PrincipalPlanCons.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function enlace_buscar_poractividad(){
        $.ajax({
            url:   '../Controlador/PLM_ConsPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function enlace_buscar_por_carac(){
    
    $('#H_opcion').val("ver_factor");
        $.ajax({
            url:   '../Controlador/PLM_ConsPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#principal').serialize(),
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function enlace_buscar_por_proceso(){
    $('#H_opcion').val("ver_procesos");
        $.ajax({
            url:   '../Controlador/PLM_ConsPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: $('#principal').serialize(),
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function enlace_buscar_porfactor(){
        $.ajax({
            url:   '../Controlador/PLM_ConsPlanF_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}

function enlace_analisis_procesos(){
        $.ajax({
            url:   '../Controlador/PLM_Procesos_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}


function enlace_modificar_plm(){
        $.ajax({
            url:   '../Controlador/PLM_ModPlan_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}


function enlace_crear_plm()
{        
    $.ajax({
            url:   '../Controlador/PLM_AddPro_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-contenido').html(data);
            }
        });
}



function enlace_agregar_proyecto(){
        $.ajax({
            url:   '../Controlador/PLM_AddProyecto_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_modificar_proyecto(){
        $.ajax({
            url:   '../Controlador/PLM_ModProyecto_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}

function enlace_deshabilita_proyecto(){
        $.ajax({
            url:   '../Controlador/PLM_DesProyecto_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}
function enlace_habilita_proyecto(){
        $.ajax({
            url:   '../Controlador/PLM_HabiProyecto_Control.php',
            type:  'post',
            dataType:'html',
            data: {},
            success:  function (data) {
                $('.principal-panel-sub-contenido').html(data);
            }
        });
}
