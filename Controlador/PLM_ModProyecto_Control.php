<?php

 session_start();

//se detecta el componente h_opcion 
//para asi ir a los casos de uso
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        
        //muestra un proyecto en especifico seleccionado por el ususario
        case 'ver':{
            global $glo_objViewModProyecto, $objProyecto;
            mainGeneral();     
            $arrProyecto = $objProyecto->buscarProyecto($_REQUEST['S_proyecto']);
            $glo_objViewModProyecto->imprime($arrProyecto);
        }break;
        
        //modifica un proyecto seleccionado por el usuario
        case 'modificar':{
			jsGeneral();
            global $glo_objViewModProyecto, $objProyecto;
            mainGeneral();
			
			
            $arrProyecto = $objProyecto->buscarProyectoNombre($_POST["T_nombre"]);
            //se valida si el proyecto ya ha sido guardado
            if($arrProyecto[0][0])
            {
                $glo_objViewModProyecto->mensaje("El Proyecto ya Existe!");
            }
            else
            { 
			
				$objProyecto->modProyecto($_POST);
				$glo_objViewModProyecto->mensaje("El Proyecto se modifico satisfactoriamente!");  
			}
			
        }break;
        default:{
            global $glo_objViewModProyecto, $objProyecto;
            mainGeneral();
            jsGeneral();
            $arrProyecto=$objProyecto->buscarProyectos();
            $glo_objViewModProyecto->buscaProyectos($arrProyecto);
        }break;
    }
}
else
{
    //si no se detecta el componente h_opcion 
    //se muestran todos los proyectos 
    
    mainGeneral();
    jsGeneral();
    
    $arrProyecto=$objProyecto->buscarProyectos();
    $glo_objViewModProyecto->buscaProyectos($arrProyecto);
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewModProyecto, $objProyecto;
    include('../Vista/PLM_ModProyecto_Vista.php');  
    $glo_objViewModProyecto = new ModProyectoView();
    
    include('../Modelo/PLM_Proyecto_Modelo.php');
    $objProyecto = new Proyecto();    
    $objProyecto->conectar();
    
}


//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
	<script src="../Js/PLM_Proyecto.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>