<?php

//se detecta el componente h_opcion 
//para asi ir a los casos de uso
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //muestra la interface de una escala seleccionada
        // para despues guardarla
        case 'guardar':{        
            global $glo_objViewModEscala, $objModEscala;
            mainGeneral();
			jsGeneral();
                        
            $arrEsa = $objModEscala->buscarEcalaId($_REQUEST['S_escala']);
            $glo_objViewModEscala->guardar($arrEsa);
        }break;
        
        //despues de haber modificado la escala vamos a guardar 
        //la escala en especifico
        case 'guardar2':{        
            global $glo_objViewModEscala, $objModEscala;
            mainGeneral();
			jsGeneral();
			
            
                $objModEscala->modEscala($_POST);
                $glo_objViewModEscala->mensaje("La Escala se ha modificado correctamente!");
            
        }break;
        default:{
            global $glo_objViewModEscala;
            mainGeneral();
            jsGeneral();
            
            $arrEsa = $objModEscala->buscarEcala();
            $glo_objViewModEscala->mostrar($arrEsa);
        }break;
    }
}
else
{
    //si no detecta el componente h_opcion
    //entra aqui y muestra todas las escalas
    mainGeneral();
    jsGeneral();
    $arrEsa = $objModEscala->buscarEcala();
    if($arrEsa[0][0])
    {
        $glo_objViewModEscala->mostrar($arrEsa);       
    }
    else
    {
        $glo_objViewModEscala->mensaje("No hay escalas habilitadas!");      
    }
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewModEscala, $objModEscala;
    
    include('../Modelo/PLM_Escala_Modelo.php');
    include('../Vista/PLM_modEcala_Vista.php'); 
    $glo_objViewModEscala = new ModEscalaView();
    $objModEscala = new Escala();    
    $objModEscala->conectar();
    
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