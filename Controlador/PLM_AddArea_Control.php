<?php
//inicialmente hacemos esta comparación para 
//asi entrar al switch y hacer la opción deseada
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        //en este caso se guarda la area agregada por el usuario
        case 'guardar':{        
            global $glo_objViewAddArea, $objAddArea;
            mainGeneral();
			jsGeneral();
            //primero se compara si el area existe
            $arrArea = $objAddArea->buscarAreaNombre($_POST["T_nombre"]);
            if($arrArea[0][0])
            {
                $glo_objViewAddArea->mensaje("El área ya Existe!");
            }
            else
            { 
                //si el area no existe, se puede guardar
                $objAddArea->crearArea($_POST);
                $glo_objViewAddArea->mensaje("El área ha sido agregada!");
            }
        }break;
        default:{
            global $glo_objViewAddArea;
            mainGeneral();
            jsGeneral();
            
            $glo_objViewAddArea->guardar();
        }break;
    }
}
else
{
    //si el componente h_option no se recibe
    //se va ala interface y se muestra la ventana para guardar
    mainGeneral();
    jsGeneral();
    $glo_objViewAddArea->guardar();
}

//en esta funcion se declaran los objetos 
//que van al modelo y la vista para poder ejecutar las 
//funciones que hay dentro de las clases
function mainGeneral(){
    global $glo_objViewAddArea, $objAddArea;
    
    include('../Modelo/PLM_Area_Modelo.php');
    include('../Vista/PLM_AddArea_Vista.php'); 
    $glo_objViewAddArea = new AddAreaView();
    $objAddArea = new Area();    
    $objAddArea->conectar();
    
}

//en esta funcion se declaran los archivos de jquery para los enlaces de
// los botones 
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Area.js" type="text/javascript"></script>  
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>