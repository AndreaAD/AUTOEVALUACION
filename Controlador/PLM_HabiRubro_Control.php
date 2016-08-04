<?php

//se establece la recepción del componente
//h_opcion para ir a los casos   
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //se muestra un rubro seleccionado, en especifico
        case 'ver':{
            global $glo_objViewSelRubro, $objRubro;
            mainGeneral();      
            $arrUsu = $objRubro->buscarRubro($_REQUEST['S_rubro']);
            $glo_objViewSelRubro->imprime($arrUsu);
        }break;  
        //se habilita un rubro seleccionado.
        case 'habilitar':{
            mainGeneral();
			jsGeneral();
            $objRubro->habiRubro($_POST);
            $glo_objViewSelRubro->mensaje("El rubro ha sido habilitado!");
        }break;
        default:{
            global $glo_objViewSelRubro, $objRubro;
            mainGeneral();
            jsGeneral();
            $arrRubro=$objRubro->buscarRubrosDes();
            $glo_objViewSelRubro->buscaRubros($arrRubro);
        }break;
    }
}
else
{
    //si el componente h_opcion no se detecta se 
    //muestran todos los rubros
    mainGeneral();
    jsGeneral();
    $arrRubro=$objRubro->buscarRubrosDes();
    $glo_objViewSelRubro->buscaRubros($arrRubro);
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewSelRubro, $objRubro;
    include('../Modelo/PLM_Rubro_Modelo.php');
    include('../Vista/PLM_HabiRubro_Vista.php');  
    $objRubro = new Rubro();
    $glo_objViewSelRubro = new SelRubroView();
    
    $objRubro->conectar();
}

//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
    <script type="text/javascript" src="../Js/PLM_Rubro.js"></script>
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>