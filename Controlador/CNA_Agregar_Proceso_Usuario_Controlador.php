<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar_usuario':{
            
            LinesBasicas();
            
            $modelo = new Proceso();
            
            $mensaje = $modelo->Agregar_Proceso_Usuario($_POST);            
            
            vista();
                        
        }break;
        
        case 'filtrar':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
            $resSqlActividades = $modelo->Ver_X_Proceso($_POST);            
                        
            filtrar();            
                 
        }break;
        
        case 'filtrar_todo':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
            $resSqlActividades = $modelo->Ver_Pk_Usuario_X_Proceso($_POST);            
                    
            filtrar_check();            
          
        }break;
        
        case 'filtrar_check':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
            $resSqlActividades = $modelo->Ver_Pk_Usuario_X_Proceso($_POST);            
                    
            filtrar_check();            
          
        }break;
        
        case 'filtrar_no_check':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
            $resSqlActividades = $modelo->Ver_Pk_Usuario_X_Proceso($_POST);            
                    
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
    
    require_once("../Modelo/SAD_Programa_Modelo.php");
    require_once('../Modelo/SAD_Sede_Modelo.php');
    require_once('../Modelo/SAD_Facultad_Modelo.php'); 
    require_once('../Modelo/SAD_Usuario_Modelo.php');
    
    require_once('../Modelo/CNA_Fase_Modelo.php');
    require_once('../Modelo/CNA_Proceso_Modelo.php');
    
}

function filtrar(){
    
    LinesBasicas();
    
    global $mensaje;
    global $resSqlActividades;
        
    $filtro_check = 'on';
    $filtro_no_check = 'on';
    $filtro_todo = 'on';
     
    $url_filtro_check = '../Controlador/CNA_Agregar_Proceso_Usuario_Controlador.php';
      
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
    $modelo = new Proceso();
    
    $resSql = $modelo->Ver_X_Proceso($_POST);
    
    while(!$resSql->EOF){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Proceso : ".$resSql->fields['nombre']
                                );
    
        $resSql->MoveNext(); 
    }
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    while(!$resSqlActividades->EOF) {
        
        $datosFiltroCheck[] = $resSqlActividades->fields['fk_usuario'];
        
        $resSqlActividades->MoveNext();
        
        }
    
    $modelo = new Usuario();
    
    $resSql = $modelo->Ver_X_Proceso_Sede($_POST);            
    
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
    
    $strNombreBuscador = 'Seleccionar Usuario';
    
    $strNombreHidden = 'pk_proceso';
    $strValorHidden = $_POST['radio'];
    
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
                        "check"=>"pk_usuario",
                        "contenido_1"=>"nombre",
                        "contenido_2"=>"apellido",
                        "estado"=>"estado",
                        "filtro_1"=>"fk_sede",
                        "filtro_2"=>"fk_facultad",
                        "filtro_3"=>"fk_programa"                         
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Guardar';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Agregar_Proceso_Usuario_Controlador.php', 'guardar_usuario');";
    
    $strTipoColumna = "una-columna-centro";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}

function filtrar_check(){    
    
    LinesBasicas();
    
    global $mensaje;
    global $resSqlActividades;
        
    $filtro_check = 'on';
    $filtro_no_check = 'on';
    $filtro_todo = 'on';
     
    $url_filtro_check = '../Controlador/CNA_Agregar_Proceso_Usuario_Controlador.php';
      
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
    $modelo = new Proceso();
    
    $resSql = $modelo->Ver_X_Pk_Proceso($_POST);
    
    while(!$resSql->EOF){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Proceso : ".$resSql->fields['nombre']
                                );
    
        $resSql->MoveNext(); 
    }
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    while(!$resSqlActividades->EOF) {
        
        $datosFiltroCheck[] = $resSqlActividades->fields['fk_usuario'];
        
        $resSqlActividades->MoveNext();
        
        }
    
    $modelo = new Usuario();
    
    $resSql = $modelo->Ver($_POST);            
    
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
    
    $strNombreBuscador = 'Seleccionar Usuario';
    
    $strNombreHidden = 'pk_proceso';
    $strValorHidden = $_POST['pk_proceso'];
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Apellido",
                        "col4"=>"Estado",
                        "col5"=>"Sede",
                        "col6"=>"Facultad"
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_usuario",
                        "contenido_1"=>"nombre",
                        "contenido_2"=>"apellido",
                        "estado"=>"estado",
                        "filtro_1"=>"fk_sede",
                        "filtro_2"=>"fk_facultad"                        
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Guardar';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Agregar_Proceso_Usuario_Controlador.php', 'guardar_usuario');";
    
    $strTipoColumna = "una-columna-centro";
    
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
    
    $strNombreBuscador = 'Seleccionar Proceso';
    
    $strNombreHidden = 'pk_proceso';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Fecha Inicio",
                        "col4"=>"Fecha Finalizacion",
                        "col5"=>"Sede",
                        "col6"=>"Programa",
                        "col7"=>"Fase"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_proceso",
                        "contenido_1"=>"nombre",
                        "contenido_2"=>"fecha_inicio",
                        "contenido_3"=>"fecha_fin",
                        "filtro_1"=>"fk_sede",
                        "filtro_2"=>"fk_programa",
                        "filtro_3"=>"fk_fase"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Seleccionar Proceso';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Agregar_Proceso_Usuario_Controlador.php', 'filtrar');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}
?>
