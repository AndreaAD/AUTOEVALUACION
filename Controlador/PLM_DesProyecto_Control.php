<?php
 session_start();

//se establece la recepción del componente
//h_opcion para ir a los casos   
if (!(empty($_POST)))
{ 
    switch($_REQUEST['H_opcion']){
        //en este caso se consultan todos los proyectos 
        //y los muestra por la interface
        case 'ver':{
            global $glo_objViewEliProyecto, $objProyecto;
            mainGeneral();
            $arrProyecto = $objProyecto->buscarProyecto($_REQUEST['S_proyecto']);
            $glo_objViewEliProyecto->imprime($arrProyecto);
        }break; 
        //despues de seleccionar un proyecto, se va a la base de datos y lo
        //elimina 
        case 'eliminar':{
            global $glo_objViewEliProyecto, $objProyecto;
            mainGeneral();
			jsGeneral();
            $objProyecto->desProyecto($_POST);
            $glo_objViewEliProyecto->mensaje("El Proyecto ha sido deshabilitado");
        }break;
        default:{
            global $glo_objViewEliProyecto;
            mainGeneral();
            jsGeneral();
            
            $arrProyecto=$objProyecto->buscarProyectos();
            $glo_objViewEliProyecto->buscaProyectos($arrProyecto);
        }break;
    }
}
else
{
    //si so se detecta el componente h_opcion
    //se va ala interface y muestra todos los 
    //proyectos
    mainGeneral();
    jsGeneral();
    $arrProyecto=$objProyecto->buscarProyectos();
    $glo_objViewEliProyecto->buscaProyectos($arrProyecto);
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewEliProyecto, $objProyecto;
    include('../Modelo/PLM_Proyecto_Modelo.php');
    include('../Vista/PLM_DesProyecto_Vista.php'); 
    $objProyecto = new Proyecto(); 
    $glo_objViewEliProyecto = new EliProyectoView();    
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
