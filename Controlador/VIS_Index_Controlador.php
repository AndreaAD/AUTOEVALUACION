<?php

session_start();

require_once("../Vista/VIS_Elementos_Vista.php");

if(isset($_REQUEST['Estado_Session'])){
    switch($_REQUEST['Estado_Session']){
    
        case 'loguearse':{
            
            require_once("../BaseDatos/AdoDB.php");
    
            require_once('../Modelo/SAD_Loggin_Modelo.php');
            
            $modelo = new Loggin();
                        
            $modelo->Ver($_POST);
                        
            require_once("../Vista/VIS_Index_Vista.php");
            
        }break;
        
        case 'modificarClave':  
                    
            require_once("../BaseDatos/AdoDB.php");
    
            require_once('../Modelo/SAD_Usuario_Modelo.php');
            
            $modelo = new Usuario();
    
            $modelo->ModificarClave($_POST);
            
        break;
        
        case 'restaurarClave':{
                    
            require_once("../BaseDatos/AdoDB.php");
    
            require_once('../Modelo/SAD_Usuario_Modelo.php');
            
            $modelo = new Usuario();
    
            $modelo->RestaurarClave($_POST);
            
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

function filtrar(){
    
    
    
    foreach($_SESSION['array_proceso'] as $dato){                        
        if($_POST['pk_proceso'] == $dato['pk_proceso']){
            $_SESSION['pk_proceso'] = $dato['pk_proceso'];
            $_SESSION['pk_fase'] = $dato['pk_fase'];
            $_SESSION['nombre_proceso'] = $dato['nombre_proceso'];
            $_SESSION['nombre_fase'] = $dato['nombre_fase'];
        }
    }
    
    require_once("../Vista/VIS_Index_Vista.php");

   }
   
function vista(){
    if(!isset($_SESSION['pk_usuario'])){            
        $datos_menu = array(
                array(
                        "nombre"=>"Dirección de Autoevaluación y Acreditación",
                        "pk_modulo"=>"0",
                        "color"=>"31B404",
                        "icono"=>"icono-menu",
                        "opciones"=>array(
                            array(
                                "nombre"=>"Quienes Somos?",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_quienes_somos_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Misión y Visión",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Mision_Vision_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Plan de Acción DAYA-2013",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Plan_Daya2013_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Plan de Acción Programas Académicos - 2013",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Plan_Accion_Programas_Academicos_controlador.php",
                                "icono"=>"icon 1")

                       )

                ),
                array(
                        "nombre"=>"Sistema de Autoevaluación",
                        "pk_modulo"=>"0",
                        "color"=>"31B404",
                        "icono"=>"icono-menu",
                        "opciones"=>array(
                            array(
                                "nombre"=>"Marco legal",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Marco_Legal_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Política",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Politica_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Principios",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Principios_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Criterios",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Criterios_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Objetivo",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Objetivo_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Estrategias",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Estrategias_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Referentes Institucionales",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Referentes_Institucionales_controlador.php",
                                "icono"=>"icon 1"),
                            array(
                                "nombre"=>"Modelo Institucional",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Modelo_Procedimiento_Autoevaluacion_controlador.php",
                                "icono"=>"icon 1")
                        )
                ),
                array(
                        "nombre"=>"Renovación del Registro Calificado",
                        "pk_modulo"=>"0",
                        "color"=>"31B404",
                        "icono"=>"icono-menu",
                        "opciones"=>array(
                            array(
                                "nombre"=>"Acerca del Registro Calificado",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Acerca_Registro_Calificado_controlador.php",
                                "icono"=>"icon 1"),
                              array(
                                "nombre"=>"Referentes Legales",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Marco_Legal_2_controlador.php",
                                "icono"=>"icon 1"),
                                array(
                                "nombre"=>"Cronograma Renovación del Registro Calificado",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Renovacion_Registros_Calificados_controlador.php",
                                "icono"=>"icon 1")
                        )
                ),
                array(
                        "nombre"=>"Acreditación de Alta Calidad",
                        "pk_modulo"=>"0",
                        "color"=>"31B404",
                        "icono"=>"icono-menu",
                        "opciones"=>array(
                            array(
                                "nombre"=>"Acerca de la Acreditación",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../controlador/VIS_Acerca_Acreditacion_controlador.php",
                                "icono"=>"icon 1"),
                              array(
                                "nombre"=>"Marco Legal",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Marco_Legal_3_controlador.php",
                                "icono"=>"icon 1"),
                                array(
                                "nombre"=>"Cómo participo",
                                "pk_grupo"=>"0",
                                "id"=>"BTN_controles",
                                "url"=>"../Controlador/VIS_Como_participo_controlador.php",
                                "icono"=>"icon 1")  
                        )
                )
            );
    

        
        $_SESSION['datos_menu'] = $datos_menu;
    }



    require_once("../Vista/VIS_Index_Vista.php");

}
?>