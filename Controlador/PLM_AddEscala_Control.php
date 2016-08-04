<?php

//inicialmente hacemos esta comparación para 
//asi entrar al switch y hacer la opción deseada
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //en este caso se guarda la escala dada por el usuario
        case 'guardar':{        
            global $glo_objViewAddEscala, $objAddEscala;
            mainGeneral();
			jsGeneral();
            $arrEsa = $objAddEscala->buscarEcalaNombre($_POST["T_escala"]);
            //antes de guaradar se debe consultar si el area existe
            if($arrEsa[0][0])
            {
                $glo_objViewAddEscala->mensaje("La Escala ya Existe!");
            }
            else
            { 
                // una ves hechas la validaciones entramos a guardar
                $objAddEscala->crearEscala($_POST);
                $glo_objViewAddEscala->mensaje("La Escala ha sido agregada!");
            }
        }break;
        default:{
            global $glo_objViewAddEscala;
            mainGeneral();
            jsGeneral();
            
            $glo_objViewAddEscala->guardar();
        }break;
    }
}
else
{
    
    //si el componente h_option no se recibe
    //se va ala interface y se muestra la ventana para guardar
    mainGeneral();
    jsGeneral();
    $glo_objViewAddEscala->guardar();
}

//en esta funcion se declaran los objestos 
//que van al modelo y la vista para poder ejecutar las 
//funciones que hay dentro de las clases
function mainGeneral(){
    global $glo_objViewAddEscala, $objAddEscala;
    
    include('../Modelo/PLM_Escala_Modelo.php');
    include('../Vista/PLM_AddEcala_Vista.php'); 
    $glo_objViewAddEscala = new AddEscalaView();
    $objAddEscala = new Escala();    
    $objAddEscala->conectar();
    
}

//en esta funcion se declaran los archivos de jquery para los enlaces de
// los botones 
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Escala.js" type="text/javascript"></script>  
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>