<?php

 session_start();
//inicialmente hacemos esta comparación para 
//asi entrar al switch y hacer la opción deseada
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //en este caso se guarda el proyecto dada por el usuario
        case 'guardar':{        
			jsGeneral();
            global $glo_objViewAddProyecto, $objAddProyecto;
            mainGeneral();
            
            $arrProyecto = $objAddProyecto->buscarProyectoNombre($_POST["T_nombre"]);
            //se valida si el proyecto ya ha sido guardado
            if($arrProyecto[0][0])
            {
                $glo_objViewAddProyecto->mensaje("El Proyecto ya Existe!");
            }
            else
            { 
                //despues de las validaciones se guarda el proyecto
                $objAddProyecto->crearProyecto($_POST);
                $glo_objViewAddProyecto->mensaje("El Proyecto se guardo satisfactoriamente!");  
            }
        }break;
        default:{
            global $glo_objViewAddProyecto;
            mainGeneral();
            jsGeneral();
            
            $glo_objViewAddProyecto->guardar();
        }break;
    }
}
else
{
    
    //si el componente h_option no se recibe
    //se va ala interface y se muestra la ventana para guardar
    mainGeneral();
    jsGeneral();
    $glo_objViewAddProyecto->guardar();
}

//en esta funcion se declaran los objestos 
//que van al modelo y la vista para poder ejecutar las 
//funciones que hay dentro de las clases
function mainGeneral(){
    global $glo_objViewAddProyecto, $objAddProyecto;
    
    include('../Modelo/PLM_Proyecto_Modelo.php');
    include('../Vista/PLM_AddProyecto_Vista.php'); 
    $glo_objViewAddProyecto = new AddProyectoView();
    $objAddProyecto = new Proyecto();    
    $objAddProyecto->conectar();
    
}
//en esta funcion se declaran los archivos de jquery para los enlaces de
// los botones 
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Proyecto.js" type="text/javascript"></script>  
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>