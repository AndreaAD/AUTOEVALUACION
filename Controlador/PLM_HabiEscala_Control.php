<?php

//se establece la recepción del componente
//h_opcion para ir a los casos   
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //en este punto se recibe el código de una escala 
        //y se elimina
        case 'habilitar':{   
			jsGeneral();      
            global $glo_objViewHabiEscala, $objHabiEscala;
            mainGeneral();
            $objHabiEscala->habilitaEscala($_POST["H_idEsca"]);
            
			$glo_objViewHabiEscala->mensaje("La escala ha sido habilitada!");     
        }break;
        
        //en este punto se captura el código de una escala y se 
        //muestra en detalle
        case 'buscar':{     
            global $glo_objViewHabiEscala, $objHabiEscala;
            mainGeneral();
            $arrEsa = $objHabiEscala->buscarEcalaIdDes($_POST["S_escala"]);   
            
            $glo_objViewHabiEscala ->mostrarEscala($arrEsa);
            
        }break;
        default:{
            
        }break;
    }
}
else
{
    
    //si el componente h_opcion no se detecta,
    //sebuscan las áreas y se muestran
    mainGeneral();
    jsGeneral(); 
    
    $arrEsa = $objHabiEscala->buscarEcalaDeshabi();
    if($arrEsa[0][0])
    {
        $glo_objViewHabiEscala->mostrar($arrEsa);       
    }
    else
    {
        $glo_objViewHabiEscala->mensaje("No hay Escalas Deshabilitadas!");      
    }
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewHabiEscala, $objHabiEscala;
    
    include('../Modelo/PLM_Escala_Modelo.php');
    include('../Vista/PLM_HabiEcala_Vista.php'); 
    $glo_objViewHabiEscala = new HabiEscalaView();
    $objHabiEscala = new Escala();    
    $objHabiEscala->conectar();
    
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