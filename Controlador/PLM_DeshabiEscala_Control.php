<?php
//se establece la recepción del componente
//h_opcion para ir a los casos   
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //en este caso se recibe el código de la escala 
        //y lo deshabilita
        case 'deshabilitar':{        
			jsGeneral(); 
            global $glo_objViewDesEscala, $objDesEscala;
            mainGeneral();
            $objDesEscala->desHabilitaEscala($_POST["H_idEsca"]);
            
			$glo_objViewDesEscala->mensaje("La escala ha sido deshabilitada!");  
        }break;
        //en este caso muestra por interface todas las escalas 
        //despues de buscarlas
        case 'buscar':{     
            global $glo_objViewDesEscala, $objDesEscala;
            mainGeneral();
            $arrEsa = $objDesEscala->buscarEcalaId($_POST["S_escala"]);   
            
            $glo_objViewDesEscala ->mostrarEscala($arrEsa);
            
        }break;
        default:{
            
        }break;
    }
}
else
{
    //si el componente h_opcion no se reconoce
    //se va a la interface y se muestran todas las escalas
    mainGeneral();
    jsGeneral(); 
    
    $arrEsa = $objDesEscala->buscarEcala();
    if($arrEsa[0][0])
    {
        $glo_objViewDesEscala->mostrar($arrEsa);       
    }
    else
    {
        $glo_objViewDesEscala->mensaje("No hay Escalas Deshabilitadas!");      
    }
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewDesEscala, $objDesEscala;
    
    include('../Modelo/PLM_Escala_Modelo.php');
    include('../Vista/PLM_DeshabiEcala_Vista.php'); 
    $glo_objViewDesEscala = new DeshabiEscalaView();
    $objDesEscala = new Escala();    
    $objDesEscala->conectar();
    
}
//se establece la relación con los conponentes de
//la interface y las funciones de jquery 
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Escala.js" type="text/javascript"></script> 
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/> 
	
    <?php
}
?>