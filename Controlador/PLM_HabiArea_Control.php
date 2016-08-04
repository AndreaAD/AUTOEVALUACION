<?php

//se establece la recepción del componente
//h_opcion para ir a los casos   
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //en este caso se puede ver la área seleccionada 
        case 'ver':{
			jsGeneral();
            global $glo_objViewSelArea, $objArea;
            mainGeneral();      
            $arrUsu = $objArea->buscarArea($_REQUEST['S_area']);
            $glo_objViewSelArea->imprime($arrUsu);
        }break;  
        //en este punto se recibe el código de un área 
        //para habilitarla
        case 'habilitar':{
			jsGeneral();
            mainGeneral();
            $objArea->habiArea($_POST);
            $glo_objViewSelArea->mensaje("El área ha sido habilitada!");
        }break;
        default:{
            global $glo_objViewSelArea, $objArea;
            mainGeneral();
            jsGeneral();
            $arrAreas=$objArea->buscarAreaDes();
            $glo_objViewSelArea->buscaArea($arrAreas);
        }break;
    }
}
else
{
    //si no se detecta el componente h_opcion 
    //se entra a esta parte donde muestra todas las áreas
    mainGeneral();
    jsGeneral();
    $arrAreas=$objArea->buscarAreaDes();
    $glo_objViewSelArea->buscaArea($arrAreas);
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewSelArea, $objArea;
    include('../Modelo/PLM_Area_Modelo.php');
    include('../Vista/PLM_HabiArea_Vista.php');  
    $objArea = new Area();
    $glo_objViewSelArea = new SelAreaView();    
    $objArea->conectar();
    
}

//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
    <script type="text/javascript" src="../Js/PLM_Area.js"></script>
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/> 	 
    <?php
}
?>