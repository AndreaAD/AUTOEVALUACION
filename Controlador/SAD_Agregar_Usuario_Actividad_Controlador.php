<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar_actividad':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
            $mensaje = $modelo->AgregarActividadUsuario($_POST);            
            
            vista();
                        
        }break;
        
        case 'filtrar':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Usuario($_POST);            
                        
            filtrar();            
                 
        }break;
        
        case 'filtrar_todo':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Pk_Usuario($_POST);            
                
            filtrar_check();            
          
        }break;
        
        case 'filtrar_check':{
                        
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Pk_Usuario($_POST);            
                        
            filtrar_check();           
          
        }break;
        
        case 'filtrar_no_check':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $resSqlActividades = $modelo->Ver_X_Pk_Usuario($_POST);            
                
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
    require_once('../Modelo/SAD_Usuario_Modelo.php');
    require_once('../Modelo/SAD_Sede_Modelo.php');
    require_once('../Modelo/SAD_Facultad_Modelo.php');
    require_once('../Modelo/SAD_Programa_Modelo.php');
}

function filtrar(){
    
    LinesBasicas();
    
    global $mensaje;    
    global $resSqlActividades;
    
    $filtro_check = 'on';
    $filtro_no_check = 'on';
    $filtro_todo = 'on';
     
    $url_filtro_check = '../Controlador/SAD_Agregar_Usuario_Actividad_Controlador.php';
      
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
    $modelo = new Usuario();
    
    $resSql = $modelo->Ver_X_Usuario($_POST);
    
    foreach($resSql as $datos){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Nombre : ".$datos['nombre']." ".$datos['apellido']
                                );
        $encabezadoTabla[] = array(
                                "Linea"=>"Sede : ".$datos['nombre_sede']
                                );
        $encabezadoTabla[] = array(
                                "Linea"=>"Facultad : ".$datos['nombre_facultad']
                                );
        $encabezadoTabla[] = array(
                                "Linea"=>"Programa : ".$datos['nombre_programa']
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
    $strNombreBuscador = 'Agregar Actividad - Usuario';
    
    $strNombreHidden = 'pk_usuario';
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
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Agregar_Usuario_Actividad_Controlador.php', 'guardar_actividad');";
    
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
     
    $url_filtro_check = '../Controlador/SAD_Agregar_Usuario_Actividad_Controlador.php';
      
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
    $modelo = new Usuario();
    
    $resSql = $modelo->Ver_X_Pk_Usuario($_POST);
    
    foreach($resSql as $datos){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Nombre : ".$datos['nombre']." ".$datos['apellido']
                                );
        $encabezadoTabla[] = array(
                                "Linea"=>"Sede : ".$datos['nombre_sede']
                                );
        $encabezadoTabla[] = array(
                                "Linea"=>"Facultad : ".$datos['nombre_facultad']
                                );
        $encabezadoTabla[] = array(
                                "Linea"=>"Programa : ".$datos['nombre_programa']
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
    $strNombreBuscador = 'Agregar Actividad - Usuario';
    
    $strNombreHidden = 'pk_usuario';
    $strValorHidden = $_POST['pk_usuario'];
    
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
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Agregar_Usuario_Actividad_Controlador.php', 'guardar_actividad');";
    
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
    
    $modelo = new Usuario();
    
    $resSql = $modelo->Ver();
    
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes de la sede y la facultad */
    
    $modelo = new Sede();
    
    $resSqlOtro = $modelo->Ver();
    
    while(!$resSqlOtro->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_sede",
                            "pk"=>$resSqlOtro->fields['pk_sede'],
                            "nombre"=>$resSqlOtro->fields['nombre']
                            );
        
        $resSqlOtro->MoveNext(); 
    }
    
    $modelo = new Programa();
    
    $resSqlOtro = $modelo->Ver();
    
    while(!$resSqlOtro->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_programa",
                            "pk"=>$resSqlOtro->fields['pk_programa'],
                            "nombre"=>$resSqlOtro->fields['nombre']
                            );
        
        $resSqlOtro->MoveNext(); 
    }
    
    $modelo = new Facultad();
    
    $resSqlOtro = $modelo->Ver();
    
    while(!$resSqlOtro->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_facultad",
                            "pk"=>$resSqlOtro->fields['pk_facultad'],
                            "nombre"=>$resSqlOtro->fields['nombre']
                            );
        
        $resSqlOtro->MoveNext(); 
    }
    
    /*************************************************************************************/
    
    $strNombreBuscador = 'Agregar Actividad - Usuario';
    
    $strNombreHidden = 'pk_usuario';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Apellido",
                        "col4"=>"Estado",
                        "col5"=>"Sede",
                        "col6"=>"Facultad",
                        "col7"=>"Programa"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_usuario",
                        "contenido_1"=>"nombre",
                        "contenido_2"=>"apellido",
                        "estado"=>"estado",
                        "filtro_1"=>"fk_sede",
                        "filtro_2"=>"fk_facultad",
                        "filtro_3"=>"fk_programa"                         
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Seleccionar';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Agregar_Usuario_Actividad_Controlador.php', 'filtrar');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}
?>
