<?php
		
session_start();
//$_SESSION["pk_proceso"]=1;
mainGeneral();
jsGeneral();

//lo que se pretende hacer es recorrer todas las actividades de un proceso y 
//calcular el valor total para ser invertido
    $arrInfo = $objPlan->buscarProceso($_SESSION["pk_proceso"],$_SESSION["pk_usuario"]);
    
    if(isset($arrInfo[0][0]))
    {
        $_SESSION["plm_facultad"]=$arrInfo[0];
        $_SESSION["plm_programa"]=$arrInfo[1];
        $_SESSION["plm_sede"]=$arrInfo[2];
        $_SESSION["plm_director"]=$arrInfo[4];
        $_SESSION["plm_periodo"]=$arrInfo[3];
        
        //se muestra la información del proceso actual
        $glo_objViewProyectoI->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                
        $proyectoi = $objPlan->buscarproyectoi();
        $glo_objViewProyectoI->Imprimevalor($proyectoi);


    }
    else
    {
        $glo_objViewProyectoI->mensaje("No hay procesos para hacer plan de mejora!!!");
    }
        
    //aqui se hace la referencia a las clases modelo y vista
    //para poder tener acceso a la base de datos y a la interface
    function mainGeneral(){
        global $glo_objViewProyectoI, $objPlan;
        include('../Vista/PLM_ProyectoI_Vista.php');  
        $glo_objViewProyectoI = new ProyectoIView();
        
        include('../Modelo/PLM_Plan_Modelo.php');
        $objPlan = new Plan();
    }
    
    //se establece la relación con los conponentes de
    //la interface y las funciones de jquery
    function jsGeneral() {
        ?>
    	<script src="../Js/backgroundControl.js" type="text/javascript"></script>
        
        <?php
    }

?>