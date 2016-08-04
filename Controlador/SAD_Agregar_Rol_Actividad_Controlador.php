<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar_actividad':{
            
            LinesBasicas();
            
            $modelo = new Rol();
            
            $mensaje = $modelo->Agregar_Actividad_Rol($_POST);            
            
            vista();
                        
        }break;
        
        case 'filtrar':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Rol($_POST);            
                        
            filtrar();            
                 
        }break;
        
        case 'filtrar_todo':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Pk_Rol($_POST);            
                
            filtrar_check();            
          
        }break;
        
        case 'filtrar_check':{
                        
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Pk_Rol($_POST);            
                        
            filtrar_check();           
          
        }break;
        
        case 'filtrar_no_check':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Pk_Rol($_POST);            
                
            filtrar_check();            
          
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
    
    require_once('../Modelo/SAD_Actividad_Modelo.php');
    require_once('../Modelo/SAD_Rol_Modelo.php');
}

function filtrar(){
    
    LinesBasicas();
    
    global $mensaje;    
    global $resSqlActividades;
    
    $filtro_check = 'on';
    $filtro_no_check = 'on';
    $filtro_todo = 'on';
     
    $url_filtro_check = '../Controlador/SAD_Agregar_Rol_Actividad_Controlador.php';
      
    /*es la parte pertienen de creacion de un select en la tabala si se necesario para dar mas 
    infomacion al momento de generar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = '';
    $labelSelect = '';
    $pkSelect = '';
    $nombreSelectBD = '';
        
    $estadoSelect = "off";
    $datosSelect = array();
    
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = 'estado';
    $strValorHiddenTer = $_POST['T_Estado']; 
    
    $encabezadoTabla = array();
    
    $datosFiltroCheck  = array();    
    $datosFiltro = array();
    /*************************************************************************************************/
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/
    $modelo = new Rol();
    
    $resSql = $modelo->Ver_X_Rol($_POST);
    
    foreach($resSql as $datos){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Nombre : ".$datos['nombre']
                                );
    
    }
    
    /*************************************************************************************************/
    
    /*se trae todas las actividades que tenga relacionado el usuario para poder chechearlas 
    en la parte visual y poder msotrar cuales tiene habilitadas y cuales no*/
    
    while(!$resSqlActividades->EOF) {
        
        $datosFiltroCheck[] = $resSqlActividades->fields['fk_actividades'];
        
        $resSqlActividades->MoveNext();
        
    }
    /*********************************************************************************************************/
    
    /*Se trae los datos pertinentes para uqe los muestre en la tabla y el usuario pueda visualizarlos 
    mejor para poder generar una seleccion mejor de los componentes que  puede seleccionar*/
    
    $modelo = new Actividad();
    
    $resSql = $modelo->Ver($_POST);            
    
    /*********************************************************************************************************/
    
    /*Se crea el array pertienen para saber que datos vamos a mostrar en al tabla*/
    $strNombreBuscador = 'Agregar Actividad - Rol';
    
    $strNombreHidden = 'pk_rol';
    $strValorHidden = $_POST['radio'];
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado",
                        "col4"=>"Modulo"
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_actividades",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado",
                        "contenido_2"=>"nombre_modulo"
                        );
    
    /*********************************************************************************************************/
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Enviar';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Agregar_Rol_Actividad_Controlador.php', 'guardar_actividad');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}

function filtrar_check(){
    
    LinesBasicas();
    
    global $mensaje;    
    global $resSqlActividades;
    
    $filtro_check = 'on';
    $filtro_no_check = 'on';
    $filtro_todo = 'on';
     
    $url_filtro_check = '../Controlador/SAD_Agregar_Rol_Actividad_Controlador.php';
      
    /*es la parte pertienen de creacion de un select en la tabala si se necesario para dar mas 
    infomacion al momento de generar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = '';
    $labelSelect = '';
    $pkSelect = '';
    $nombreSelectBD = '';
        
    $estadoSelect = "off";
    $datosSelect = array();
    
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = 'estado';
    $strValorHiddenTer = $_POST['T_Estado']; 
    
    $encabezadoTabla = array();
    
    $datosFiltroCheck  = array();    
    $datosFiltro = array();
    /*************************************************************************************************/
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/
    $modelo = new Rol();
    
    $resSql = $modelo->Ver_X_Pk_Rol($_POST);
    
    foreach($resSql as $datos){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Nombre : ".$datos['nombre']
                                );
    
    }
    
    /*************************************************************************************************/
    
    /*se trae todas las actividades que tenga relacionado el usuario para poder chechearlas 
    en la parte visual y poder msotrar cuales tiene habilitadas y cuales no*/
    
    while(!$resSqlActividades->EOF) {
        
        $datosFiltroCheck[] = $resSqlActividades->fields['fk_actividades'];
        
        $resSqlActividades->MoveNext();
        
    }
    /*********************************************************************************************************/
    
    /*Se trae los datos pertinentes para uqe los muestre en la tabla y el usuario pueda visualizarlos 
    mejor para poder generar una seleccion mejor de los componentes que  puede seleccionar*/
    
    $modelo = new Actividad();
    
    $resSql = $modelo->Ver($_POST);            
    
    /*********************************************************************************************************/
    
    /*Se crea el array pertienen para saber que datos vamos a mostrar en al tabla*/
    $strNombreBuscador = 'Agregar Actividad - Rol';
    
    $strNombreHidden = 'pk_rol';
    $strValorHidden = $_POST['pk_rol'];
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado",
                        "col4"=>"Modulo"
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_actividades",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado",
                        "contenido_2"=>"nombre_modulo"
                        );
    
    /*********************************************************************************************************/
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Enviar';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Agregar_Rol_Actividad_Controlador.php', 'guardar_actividad');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}

function vista(){
    
    LinesBasicas();
    
    global $mensaje;
    
    /*es la parte pertienen de creacion de un select en la tabala si se necesario para dar mas 
    infomacion al momento de generar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = '';
    $labelSelect = '';
    $pkSelect = '';
    $nombreSelectBD = '';
        
    $estadoSelect = "off";
    $datosSelect = array();
    
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = '';
    $strValorHiddenTer = ''; 
    
    $encabezadoTabla = array();
    
    $datosFiltroCheck  = array();    
    $datosFiltro = array();
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    $modelo = new Rol();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Agregar Actividad - Rol';
    
    $strNombreHidden = 'pk_rol';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col4"=>"Estado"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_rol",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado"                      
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Seleccionar';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Agregar_Rol_Actividad_Controlador.php', 'filtrar');";
    
    $strTipoColumna = "una-columna-centro";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}
?>
