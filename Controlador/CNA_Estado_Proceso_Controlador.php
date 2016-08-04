<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'cambiar_estado':{
            
            LinesBasicas();
            
            $modelo = new Proceso();
            
            $mensaje = $modelo->CambiarEstado($_POST);            
                        
            vista();            
                 
        }break;
        
        default:{
            
            vista();
            
        }break;
    
    }
}
else{
    vista();
}

function LinesBasicas(){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once('../Vista/VIS_Elementos_Vista.php');
    
    require_once("../Modelo/SAD_Programa_Modelo.php");
    require_once('../Modelo/SAD_Sede_Modelo.php');
    require_once('../Modelo/SAD_Facultad_Modelo.php'); 
    require_once('../Modelo/SAD_Usuario_Modelo.php');
    
    require_once('../Modelo/CNA_Fase_Modelo.php');
    require_once('../Modelo/CNA_Proceso_Modelo.php');
    
}

function vista(){
    
    LinesBasicas();
    
    global $mensaje;
    /*es la aprte pertienen de creacionde un select en la tabala si se es necesario para dar mas 
    infomacion al momento de genrar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = 'fase';
    $labelSelect = 'Fase : ';
    $pkSelect = 'pk_fase';
    $nombreSelectBD = 'nombre';
        
    $estadoSelect = "on";
    $datosFiltroCheck  = array();
        
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = '';
    $strValorHiddenTer = ''; 
    
    $encabezadoTabla = array();    
    /*************************************************************************************************/
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/

    $encabezadoTabla[] = array(
                            "linea"=>"Seleccionar la fase que quiere cambiarle a los procesos o proceso que seleccione"
                            );
    /*************************************************************************************************/
    
    $modelo = new Fase();
    
    $datosSelect = $modelo->Ver();
    
        
    $datosFiltro = array();
    
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes de la sede y la facultad */
    
    $modelo = new Sede();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_sede",
                            "pk"=>$resSql->fields['pk_sede'],
                            "nombre"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    $modelo = new Programa();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_programa",
                            "pk"=>$resSql->fields['pk_programa'],
                            "nombre"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    $modelo = new Fase();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_fase",
                            "pk"=>$resSql->fields['pk_fase'],
                            "nombre"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    /*************************************************************************************/
    
    $modelo = new Proceso();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Cambiar Fase del Proceso';
    
    $strNombreHidden = 'pk_proceso';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Fecha Inicio",
                        "col4"=>"Fecha Finalizaci&oacute;n",
                        "col5"=>"Sede",
                        "col6"=>"Programa",
                        "col7"=>"Fase"
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_proceso",
                        "contenido_1"=>"nombre",
                        "contenido_2"=>"fecha_inicio",
                        "contenido_3"=>"fecha_fin",
                        "filtro_1"=>"fk_sede",
                        "filtro_2"=>"fk_programa",
                        "filtro_3"=>"fk_fase"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Cambiar Estado';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Estado_Proceso_Controlador.php', 'cambiar_estado');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}
?>
