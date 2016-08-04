<?php

 session_start();
//se establece la recepción del componente
//h_opcion para ir a los casos   
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //aqui se muestra un proyecto seleccionado en especifico
        //para despues habilitarlo
        case 'ver':{
            global $glo_objViewSelProyecto, $objProyecto;
            mainGeneral();      
            $arrProyecto = $objProyecto->buscarProyecto($_REQUEST['S_proyecto']);
            $glo_objViewSelProyecto->imprime($arrProyecto);
        }break;  
        
        //si seleccina algún proyecto se habilita, según el código dado
        case 'habilitar':{
			jsGeneral();
            mainGeneral();
            $objProyecto->habiProyecto($_POST);
            $glo_objViewSelProyecto->mensaje("El Proyecto ha sido habilitado");
			
        }break;
        default:{
            global $glo_objViewSelProyecto, $objProyecto;
            mainGeneral();
            jsGeneral();
            $arrProyecto=$objProyecto->buscarProyectoDes();
            $glo_objViewSelProyecto->buscaProyecto($arrProyecto);
        }break;
    }
}
else
{
    //si no se detecta el componente h_opcion 
    //se buscan los proyectos deshabilitados y 
    //se muestran en la interface 
    mainGeneral();
    jsGeneral();
    $arrProyecto=$objProyecto->buscarProyectoDes();
    $glo_objViewSelProyecto->buscaProyecto($arrProyecto);
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewSelProyecto, $objProyecto;
    include('../Modelo/PLM_Proyecto_Modelo.php');
    include('../Vista/PLM_HabiProyecto_Vista.php');  
    $objProyecto = new Proyecto();
    $glo_objViewSelProyecto = new SelProyectoView();    
    $objProyecto->conectar();
    
}
//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
    <script type="text/javascript" src="../Js/PLM_Proyecto.js"></script>
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>