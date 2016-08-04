<?php

//inicialmente hacemos esta comparación para 
//asi entrar al switch y hacer la opción deseada

if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //en este caso se guarda el proyecto dada por el usuario
        case 'guardar':{
            
			jsGeneral();
            global $glo_objViewAddRubro, $objAddRubro;
            mainGeneral();
            $objAddRubro ->conectar();
            $arrRubro = $objAddRubro->buscarRubroNombre($_POST["T_nombre"]);
            //se valida si el rubro ya existe 
            if($arrRubro[0][0])
            {
                $glo_objViewAddRubro->mensaje("El Rubro ya Existe!");
            }
            else
            {
                // se guarda el rubro despues d elas validaciones
                $objAddRubro->crearRubro($_POST);
                $glo_objViewAddRubro->mensaje("El rubro ha sido agregado!");
				
            }
        }break;
        default:{
            global $glo_objViewAddRubro;
            mainGeneral();
            jsGeneral();
            
            $glo_objViewAddRubro->guardar();
        }break;
    }
}
else
{
    mainGeneral();
    jsGeneral();
    //si el componente h_option no se recibe
    //se va ala interface y se muestra la ventana para guardar
    $glo_objViewAddRubro->guardar();
}

//en esta funcion se declaran los objestos 
//que van al modelo y la vista para poder ejecutar las 
//funciones que hay dentro de las clases
function mainGeneral(){
    global $glo_objViewAddRubro, $objAddRubro;
    
    include('../Modelo/PLM_Rubro_Modelo.php');
    include('../Vista/PLM_AddRubro_Vista.php'); 
    $glo_objViewAddRubro = new AddRubroView();
    $objAddRubro = new Rubro();    
    
}

//en esta funcion se declaran los archivos de jquery para los enlaces de
// los botones 
function jsGeneral(){
    ?>
    
    <script src="../Js/PLM_Rubro.js" type="text/javascript"></script>  
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    
    <?php
}
?>