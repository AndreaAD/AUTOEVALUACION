<?php
//se detecta el componente h_opcion 
//para asi ir a los casos de uso
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //muestra un área en especifico, según el código
        case 'ver':{
            global $glo_objViewModArea, $objArea;
            mainGeneral();     
			jsGeneral();
            $arrUsu = $objArea->buscarArea($_REQUEST['S_area']);
            $glo_objViewModArea->imprime($arrUsu);
        }break;
        
        //modifica un área según la seleccionada
        case 'modificar':{
            global $glo_objViewModArea, $objArea;
            mainGeneral();
			jsGeneral();
			
            //primero se compara si el area existe
          
          
				$objArea->modArea($_POST);
				$glo_objViewModArea->mensaje("El área ha sido modificada!");
			
        }break;
        default:{
            global $glo_objViewModArea, $objArea;
            mainGeneral();
            jsGeneral();
            $arrArea=$objArea->buscarAreas();
            $glo_objViewModArea->buscaAreas($arrArea);
        }break;
    }
}
else
{
    //si no detecta el componente h_opcion
    //entra aqui por defecto y muestra todas las áreas
    
    mainGeneral();
    jsGeneral();
    
    $arrArea=$objArea->buscarAreas();
    $glo_objViewModArea->buscaAreas($arrArea);
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewModArea, $objArea;
    include('../Vista/PLM_ModArea_Vista.php');  
    $glo_objViewModArea = new ModAreaView();
    
    include('../Modelo/PLM_Area_Modelo.php');
    $objArea = new Area();    
    $objArea->conectar();
    
}

//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
	<script src="../Js/PLM_Area.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>