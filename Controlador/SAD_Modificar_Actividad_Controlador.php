<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'modificar':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $sqlRol = $modelo->Ver_X_Actividad($_POST);
            
            $modelo = new Sub_Grupo();
            
            $sqlSubGrupo = $modelo->Ver_Sub_Grupo_X_Actividad($_POST);
            
            modificar();            
    
        }break;
        
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Actividad();
            
            $mensaje = $modelo->Modificar($_POST);            
            
            vista();
                        
        }break;
        
        case 'filtrar':{
            
            filtrar();            
                 
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
    
    require_once("../Modelo/SAD_Actividad_Modelo.php");
    require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");
    require_once("../Modelo/SAD_Sub_Grupo_Modelo.php");
    
}

function filtrar(){
    
    LinesBasicas();
    
    $mensaje = "";    
    
    $claMod = new Sub_Grupo();
    $sqlSubGrupo = $claMod->Ver_X_Grupo($_POST);
    
    ?>
    <option value="0">sin seleccionar</option>
    <?php
    
    while(!$sqlSubGrupo->EOF){
        
        ?>
        <option value="<?php echo $sqlSubGrupo->fields['pk_sub_grupo_actividades'];?>"><?php echo $sqlSubGrupo->fields['nombre'];?></option>
        <?php
        
        $sqlSubGrupo->MoveNext();
    }   
    
}

function modificar(){
    
    LinesBasicas();
    
    global $sqlRol;
    global $sqlSubGrupo;
    
    $mensaje = "";
    
    $claMod = new Grupo_Modulos();
    $resSqlRol = $claMod->Ver();
    
    require_once('../Vista/SAD_Modificar_Actividad_Vista.php');
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
    
    $modelo = new Actividad();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Modificar Actividad';
    
    $strNombreHidden = 'pk_actividad';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado",
                        "col4"=>"Modulo"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_actividades",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado",
                        "contenido_2"=>"nombre_modulo"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Modificar';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Modificar_Actividad_Controlador.php', 'modificar');";
    
    $strTipoColumna = "una-columna-centro";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
