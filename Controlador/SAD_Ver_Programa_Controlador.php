<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'ver':{
            
            LinesBasicas();
            
            $modelo = new Programa();
            
            $sqlRol = $modelo->Ver_X_Programa($_POST);
            
            Ver();            
    
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
    
}

function ver(){
    
    LinesBasicas();
    
    $mensaje = "";
    
    global $sqlRol;
    
    $modelo = new Sede();

    $resSqlSede = $modelo->Ver($_POST);

    $modelo = new Facultad();

    $resSqlFacultad = $modelo->Ver($_POST);

    require_once('../Vista/SAD_Ver_Programa_Vista.php');
}

function vista(){
    
    LinesBasicas();
    
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
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    global $mensaje;
    
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
    
    $modelo = new Facultad();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_facultad",
                            "pk"=>$resSql->fields['pk_facultad'],
                            "nombre"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    /*************************************************************************************/
    
    $modelo = new Programa();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Ver Programa';
    
    $strNombreHidden = 'pk_programa';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado",
                        "col4"=>"Sede",
                        "col5"=>"Facultad"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_programa",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado",
                        "filtro_1"=>"fk_sede",
                        "filtro_2"=>"fk_facultad"
                        );
    
    $obligatorio_tabla = "obligatorio";
               
    $strNombreBoton = 'Ver';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Ver_Programa_Controlador.php', 'ver');";
    
    $strTipoColumna = "una-columna-centro";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>