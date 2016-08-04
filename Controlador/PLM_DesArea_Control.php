<?php

if (!(empty($_POST)))
{ 
    //se hace un switch con el componente h_opcion
    switch($_REQUEST['H_opcion']){
        //esta opcion deja ver las areas para
        //luego seleccionarlas 
        case 'ver':{
            global $glo_objViewEliArea, $objArea;
            mainGeneral();
			jsGeneral();
            $arrUsu = $objArea->buscarArea($_REQUEST['S_area']);
            $glo_objViewEliArea->imprime($arrUsu);
        }break; 
        //esta función recibe el código de un área para
        //luego eliminarlo
        case 'eliminar':{
            global $glo_objViewEliArea, $objArea;
            mainGeneral();
			
			jsGeneral();
            $objArea->desArea($_POST);
            $glo_objViewEliArea->mensaje("El área ha sido deshabilitada!");
        }break;
        default:{
            global $glo_objViewEliArea;
            mainGeneral();
            jsGeneral();
            
            $arrArea=$objArea->buscarRubros();
            $glo_objViewEliArea->buscaAreas($arrArea);
        }break;
    }
}
else
{
    //si no esta declarado el component h_opcion
    //se va a la interface y muestra las áreas
    mainGeneral();
    jsGeneral();
    $arrArea=$objArea->buscarAreas();
    $glo_objViewEliArea->buscaAreas($arrArea);
}

//esta función me permite hacer referencia
//a las clases modelo y vista, para asi poder 
//usar sus metodos
function mainGeneral(){
    global $glo_objViewEliArea, $objArea;
    include('../Modelo/PLM_Area_Modelo.php');
    include('../Vista/PLM_DesArea_Vista.php'); 
    $objArea = new Area(); 
    $glo_objViewEliArea = new EliAreaView();    
    $objArea->conectar();
    
}

//se establece el enlace para los botones de la interface
//usando código en jquery 
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Area.js" type="text/javascript"></script> 
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/> 
    <?php
}
?>
