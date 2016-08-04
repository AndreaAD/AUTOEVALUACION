<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Proceso();
            
            $mensaje = $modelo->Modificar($_POST);            
            
            vista();
                        
        }break;
        
        case 'Modificar':{
            
            LinesBasicas();
            
            $modelo = new Proceso();
            
            $resSqlActividades = $modelo->Ver_X_Proceso($_POST);            
                        
            modificar();            
                 
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

function modificar(){
    
    LinesBasicas();
    
    global $mensaje;
    
    global $resSqlActividades;
    
    $claMod = new Fase();
    $resSqlFase = $claMod->Ver();
    
    $claMod = new Sede();
    $resSqlSede = $claMod->Ver();
    
    $claMod = new Facultad();
    $resSqlFacultad = $claMod->Ver();
    
    $claMod = new Programa();
    $resSqlPrograma = $claMod->Ver();
    
    require_once('../Vista/CNA_Modificar_Proceso_Vista.php');
    
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
    
    $strNombreBuscador = 'Modificar Proceso';
    
    $strNombreHidden = 'pk_proceso';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Fecha Inicio",
                        "col4"=>"Fecha FinalizaciGrupo Inter&eacute;sn",
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
            
    $strNombreBoton = 'Modificar';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Modificar_Proceso_Controlador.php', 'Modificar');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}
?>
