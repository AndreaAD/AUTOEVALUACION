<?php

//se establece la recepción del componente
//h_opcion para ir a los casos   

if (!(empty($_POST)))
{
switch($_REQUEST['H_opcion']){
    //en este caso se muestran todos los rubros 
    //que han sido guardados
    case 'ver':{
        global $glo_objViewEliRubro, $objRubro;
        mainGeneral();
        $arrUsu = $objRubro->buscarRubro($_REQUEST['S_rubro']);
        $glo_objViewEliRubro->imprime($arrUsu);
    }break; 
    
    //en este caso se puede eliminar el rubro seleccionado
    case 'eliminar':{
		jsGeneral();
        global $glo_objViewEliRubro, $objRubro;
        mainGeneral();
        $objRubro->desRubro($_POST);
        $glo_objViewEliRubro->mensaje("El rubro ha sido deshabilitado!");
    }break;
    default:{
        global $glo_objViewEliRubro;
        mainGeneral();
        jsGeneral();
        
        $arrRubro=$objRubro->buscarRubros();
    $glo_objViewEliRubro->buscaRubros($arrRubro);
    }break;
}
}
else
{
    //si no se detecta el componente h_opcion 
    //se va ala interface y se muestran todos los rubros
    mainGeneral();
    jsGeneral();
    $arrRubro=$objRubro->buscarRubros();
    $glo_objViewEliRubro->buscaRubros($arrRubro);
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewEliRubro, $objRubro;
    include('../Modelo/PLM_Rubro_Modelo.php');
    include('../Vista/PLM_DesRubro_Vista.php'); 
    $objRubro = new Rubro(); 
    $glo_objViewEliRubro = new EliRubroView();
    
    $objRubro->conectar();
}

//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Rubro.js" type="text/javascript"></script>  
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    
    <?php
}
?>
