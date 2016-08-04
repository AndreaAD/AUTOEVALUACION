<?php

//se detecta el componente h_opcion 
//para asi ir a los casos de uso
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        
        //se muestra un rubro seleccionado por el usuario 
        case 'ver':{
            global $glo_objViewModRubro, $objRubro;
            mainGeneral();     
            jsGeneral();
            $arrUsu = $objRubro->buscarRubro($_REQUEST['S_rubro']);
            $glo_objViewModRubro->imprime($arrUsu);
        }break;
        
        //modifica un rubro seleccionado por el usuario
        case 'modificar':{
            global $glo_objViewModRubro, $objRubro;
            mainGeneral();
			jsGeneral();
			$arrRubro = $objRubro->buscarRubroNombre($_POST["T_nombre"]);
            //se valida si el rubro ya existe 
            
            	
				$objRubro->modRubro($_POST);
				$glo_objViewModRubro->mensaje("El rubro ha sido modificado!");
			
        }break;
        default:{
            global $glo_objViewModRubro;
            mainGeneral();
            jsGeneral();
            $arrRubro=$objRubro->buscarRubros();
            $glo_objViewModRubro->buscaRubros($arrRubro);
        }break;
    }
}
else
{
    //si no se detecta el componente h_opcion
    //se muestran todos los rubros,
    mainGeneral();
    jsGeneral();
      
    $arrRubro=$objRubro->buscarRubros();
    $glo_objViewModRubro->buscaRubros($arrRubro);
}


//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewModRubro, $objRubro;
    include('../Vista/PLM_ModRubro_Vista.php');  
    $glo_objViewModRubro = new ModRubroView();
    
    include('../Modelo/PLM_Rubro_Modelo.php');
    $objRubro = new Rubro(); 
    
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