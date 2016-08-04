<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'cambiar_estado':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
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
    
    require_once('../Modelo/SAD_Usuario_Modelo.php');
    
    require_once("../Modelo/SAD_Rol_Modelo.php");
    require_once("../Modelo/SAD_Sede_Modelo.php");
    require_once("../Modelo/SAD_Facultad_Modelo.php");
    require_once("../Modelo/SAD_Programa_Modelo.php");
    require_once("../Modelo/SAD_Tipo_Usuario_Modelo.php");
    
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
    
    $strNombreBuscador = 'Cambiar Estado Usuario';
    
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
            
    $strNombreBoton = 'Cambiar Estado';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Estado_Usuario_Controlador.php', 'cambiar_estado');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
