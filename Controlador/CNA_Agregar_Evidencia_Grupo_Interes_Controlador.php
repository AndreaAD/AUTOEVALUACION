<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'filtrar':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Interes();
            
            $resSqlActividades = $modelo->Ver_Evidencia_X_Grupo_Interes($_POST);
            
            filtrar();            
    
        }break;
        
        case 'guardar_actividad':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Interes();
            
            $mensaje = $modelo->Agregar_Evidencia_X_Grupo_Interes($_POST);            
            
            vista();
                        
        }break;
        
        case 'filtrar_todo':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Interes();
            
            $resSqlActividades = $modelo->Ver_Solo_Evidencia_X_Grupo_Interes($_POST);
            
            filtrar_check();            
          
        }break;
        
        case 'filtrar_check':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Interes();
            
            $resSqlActividades = $modelo->Ver_Solo_Evidencia_X_Grupo_Interes($_POST);
            
            filtrar_check();            
          
        }break;
        
        case 'filtrar_no_check':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Interes();
            
            $resSqlActividades = $modelo->Ver_Solo_Evidencia_X_Grupo_Interes($_POST);
            
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
    
    require_once("../Modelo/CNA_Grupo_Interes_Modelo.php");
    require_once("../Modelo/CNA_Aspecto_Modelo.php");    
    
    require_once("../Modelo/CNA_Evidencia_Modelo.php");
    require_once("../Modelo/CNA_Aspecto_Modelo.php");
    require_once("../Modelo/CNA_Caracteristica_Modelo.php");
    require_once("../Modelo/CNA_Factor_Modelo.php");
    
    require_once("../Modelo/SAD_Modulo_Modelo.php");
    
}

function filtrar(){
        
    LinesBasicas();
    
    global $mensaje;    
    global $resSqlActividades;    

    $filtro_check = 'on';    
    $filtro_no_check = 'on';    
    $filtro_todo = 'on';
    
    $url_filtro_check = '../Controlador/CNA_Agregar_Evidencia_Grupo_Interes_Controlador.php';
      
    /*es la parte pertienen de creacion de un select en la tabala si se necesario para dar mas 
    infomacion al momento de generar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = '';
    $labelSelect = '';
    $pkSelect = '';
    $nombreSelectBD = '';
        
    $estadoSelect = "off";
    $datosSelect = array();
    
    $strNombreHiddenSec = 'modulo';
    $strValorHiddenSec = $_POST['modulo']; 
    
    $strNombreHiddenTer = 'estado';
    $strValorHiddenTer = $_POST['T_Estado']; 
    
    $encabezadoTabla = array();
    
    $datosFiltroCheck  = array();    
    $datosFiltro = array();
    /*************************************************************************************************/
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/
    $modelo = new Grupo_Interes();
    
    $resSql = $modelo->Ver_X_Grupo_Interes($_POST);
    
    while(!$resSql->EOF){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Grupo de Interes : ".$resSql->fields['nombre']
                                );
    
        $resSql->MoveNext(); 
    }
    
    $modelo = new Modulo();
    
    $resSql = $modelo->Ver_Modulo_X_Pk($_POST);
    
    while(!$resSql->EOF){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Modulo : ".$resSql->fields['nombre']
                                );
    
        $resSql->MoveNext(); 
    }
    /*************************************************************************************************/
    
    /*se crea el array pertienen con el contenido que sera chuleado en los check para decirle al usuario 
    que elmento contiene o qeu elmento esta agregado a la seleccion*/
    while(!$resSqlActividades->EOF) {
        
        $datosFiltroCheck[] = $resSqlActividades->fields['fk_evidencia'];
        
        $resSqlActividades->MoveNext();
        
    }
    /*************************************************************************************************/
    
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes del factor,
    caractersitica, aspecto. Estos datos seran de ayuda al usuario para entender un poco mejor lo que
    esta viendo actualmente */
    
    $modelo = new Aspecto();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_aspecto",
                            "pk"=>$resSql->fields['pk_aspecto'],
                            "nombre"=>$resSql->fields['codigo'],
                            "texto_flotante"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    $modelo = new Caracteristica();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_caracteristica",
                            "pk"=>$resSql->fields['pk_caracteristica'],
                            "nombre"=>$resSql->fields['codigo'],
                            "texto_flotante"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    $modelo = new Factor();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_factor",
                            "pk"=>$resSql->fields['pk_factor'],
                            "nombre"=>$resSql->fields['codigo'],
                            "texto_flotante"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    /*************************************************************************************************/
    
    $modelo = new Evidencia();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Agregar Evidencia Grupo Interes';
    
    $strNombreHidden = 'pk_grupo_interes';
    $strValorHidden = $_POST['radio'];
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Codigo",
                        "col3"=>"Evidencia",
                        "col4"=>"Estado Evidencia",
                        "col5"=>" Aspecto ",
                        "col6"=>" Caracter&iacute;stica ",
                        "col7"=>" Factor "
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_evidencia",
                        "contenido_1"=>"codigo",
                        "contenido_2"=>"nombre",
                        "estado"=>"estado",
                        "filtro_1_texto_flotante"=>"fk_aspecto",
                        "filtro_2_texto_flotante"=>"fk_caracteristica",
                        "filtro_3_texto_flotante"=>"fk_factor"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Guardar Evidencias';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Agregar_Evidencia_Grupo_Interes_Controlador.php', 'guardar_actividad');";
    
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
     
    $url_filtro_check = '../Controlador/CNA_Agregar_Evidencia_Grupo_Interes_Controlador.php';
      
    /*es la parte pertienen de creacion de un select en la tabala si se necesario para dar mas 
    infomacion al momento de generar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = '';
    $labelSelect = '';
    $pkSelect = '';
    $nombreSelectBD = '';
        
    $estadoSelect = "off";
    $datosSelect = array();
    
    $strNombreHiddenSec = 'modulo';
    $strValorHiddenSec = $_POST['modulo']; 
    
    $strNombreHiddenTer = 'estado';
    $strValorHiddenTer = $_POST['T_Estado']; 
    
    $encabezadoTabla = array();
    
    $datosFiltroCheck  = array();    
    $datosFiltro = array();
    /*************************************************************************************************/
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/
    $modelo = new Grupo_Interes();
    
    $resSql = $modelo->Ver_Solo_X_Grupo_Interes($_POST);
    
    while(!$resSql->EOF){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Grupo de Interes : ".$resSql->fields['nombre']
                                );
    
        $resSql->MoveNext(); 
    }
    
    $modelo = new Modulo();
    
    $resSql = $modelo->Ver_Modulo_X_Pk($_POST);
    
    while(!$resSql->EOF){
        
        $encabezadoTabla[] = array(
                                "Linea"=>"Modulo : ".$resSql->fields['nombre']
                                );
    
        $resSql->MoveNext(); 
    }
    /*************************************************************************************************/
    
    /*se crea el array pertienen con el contenido que sera chuleado en los check para decirle al usuario 
    que elmento contiene o qeu elmento esta agregado a la seleccion*/
    while(!$resSqlActividades->EOF) {
        
        $datosFiltroCheck[] = $resSqlActividades->fields['fk_evidencia'];
        
        $resSqlActividades->MoveNext();
        
    }
    /*************************************************************************************************/
    
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes del factor,
    caractersitica, aspecto. Estos datos seran de ayuda al usuario para entender un poco mejor lo que
    esta viendo actualmente */
    
    $modelo = new Aspecto();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_aspecto",
                            "pk"=>$resSql->fields['pk_aspecto'],
                            "nombre"=>$resSql->fields['codigo'],
                            "texto_flotante"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    $modelo = new Caracteristica();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_caracteristica",
                            "pk"=>$resSql->fields['pk_caracteristica'],
                            "nombre"=>$resSql->fields['codigo'],
                            "texto_flotante"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    
    $modelo = new Factor();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_factor",
                            "pk"=>$resSql->fields['pk_factor'],
                            "nombre"=>$resSql->fields['codigo'],
                            "texto_flotante"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    /*************************************************************************************************/
    
    $modelo = new Evidencia();
    
    $resSql = $modelo->Ver($_POST);
    
    $strNombreBuscador = 'Agregar Evidencia Grupo Interes';
    
    $strNombreHidden = 'pk_grupo_interes';
    $strValorHidden = $_POST['pk_grupo_interes'];
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Codigo",
                        "col3"=>"Evidencia",
                        "col4"=>"Estado Evidencia",
                        "col5"=>" Aspecto ",
                        "col6"=>" Caracter&iacute;stica ",
                        "col7"=>" Factor "
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_evidencia",
                        "contenido_1"=>"codigo",
                        "contenido_2"=>"nombre",
                        "estado"=>"estado",
                        "filtro_1_texto_flotante"=>"fk_aspecto",
                        "filtro_2_texto_flotante"=>"fk_caracteristica",
                        "filtro_3_texto_flotante"=>"fk_factor"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Guardar Evidencias';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Agregar_Evidencia_Grupo_Interes_Controlador.php', 'guardar_actividad');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}

function vista(){
    
    LinesBasicas();
    
    global $mensaje;
    
    /*es la aprte pertienen de creacionde un select en la tabala si se es necesario para dar mas 
    infomacion al momento de genrar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = 'modulo';
    $labelSelect = 'Modulo : ';
    $pkSelect = 'pk_modulo';
    $nombreSelectBD = 'nombre';
        
    $estadoSelect = "on";
    $datosSelect = array();    
    $datosFiltroCheck  = array();
        
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = '';
    $strValorHiddenTer = ''; 
    
    $encabezadoTabla = array();    
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/

    $encabezadoTabla[] = array(
                            "linea"=>"Seleccionar el modulo correspondiente para cada grupo de interes"
                            );
    /*************************************************************************************************/
    
    /*se llena el elmento con los datos correspondientes de la consulta que se esta efectuando*/
    $modelo = new Modulo();
    
    $datosSelect = $modelo->Ver();
    
    /*************************************************************************************************/
    
    $modelo = new Grupo_Interes();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Agregar Evidencia Grupo Interes';
    
    $strNombreHidden = 'pk_grupo_interes';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_grupo_interes",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Agregar Evidencias';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Agregar_Evidencia_Grupo_Interes_Controlador.php', 'filtrar');";
    
    $strTipoColumna = "una-columna-centro-medio";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
