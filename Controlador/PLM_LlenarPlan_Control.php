<?php
session_start();
//$_SESSION["pk_proceso"]=1;
//$_SESSION["pk_usuario"]=9;
jsGeneral();
//se hace la detección del componente h_opcion 
//para asi poder entrar a los casos de uso declarados
    if(isset($_REQUEST['H_opcion'])) {
        switch($_REQUEST['H_opcion']){
            //lo que se quiere es capturar el código de un factor en especifico
            // y buscar sus características 
            case 'ver_factor':{
                global $glo_objViewLlenarPlan, $objPlan;
                mainGeneral();     
                include("../BaseDatos/PLM_AdoDB_Inicio.php");
                $conexion = new PLM_Ado();
                $factor = $objPlan->buscarFactorById($_REQUEST['S_factor'], $conexion);
                $caracteristicas = $objPlan->buscarCaracteristicasFactor($_REQUEST['S_factor'], $conexion);
                
                $glo_objViewLlenarPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
                $glo_objViewLlenarPlan->buscaCaracteristicas($caracteristicas, $factor);
            }break;
            
            //despues de haber seleccionado el factor y la caracteristica se puede ir a la
            //interface para seleccionar los demas campo y poder guardar un plan de mejoramiento
            case 'diligenciar_plan':{
                global $glo_objViewLlenarPlan, $objPlan;
                mainGeneral();
                include("../BaseDatos/PLM_AdoDB_Inicio.php");
                $conexion = new PLM_Ado();
                $_SESSION["plm_carac"]=$_REQUEST['caracteristica'];
                
            
                $caracteristica = $objPlan->buscarCaracteristicaById($_SESSION["plm_carac"], $conexion);
                $consolidado = $objPlan->buscarConsolidadoCaracteristica($_SESSION["plm_carac"], $conexion);                    
                $ambitos = $objPlan->buscarAmbitos($conexion);
                $areas = $objPlan->buscarAreas($conexion);
                $rubros = $objPlan->buscarRubros($conexion);
                $proyectos = $objPlan->buscarProyectos($_SESSION["pk_proceso"]);
				
				
                $glo_objViewLlenarPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                //va a la interface y muestra los parametros para que 
                //el usuario lo seleccione y pueda generar planes de mejoramiento
                $glo_objViewLlenarPlan->cargarDatos($caracteristica, $consolidado, $areas, $rubros, $proyectos);
            }break;
            
            //despues de haber hecho las validaciones pertinentes se puede guardar la actividad
            case 'guardar':{
                global $glo_objViewLlenarPlan, $objPlan;
                mainGeneral();
				jsSelector();
				
				$objPlan->crearActividad($_POST);
                $glo_objViewLlenarPlan->mensaje("la actividad ha sido diligenciada correctamente !!"); 
                
            }break;
            
            
            //busca todoa los factores y los retorna mediante la codificación
            // json
			 case 'busca_factor':{
				global $glo_objViewConsPlan, $objPlan;
				mainGeneral();
                include("../BaseDatos/PLM_AdoDB_Inicio.php");
                $conexion = new PLM_Ado();
				
				$arrPlan = $objPlan->buscarFactores();
				echo json_encode($arrPlan->GetRows());
				unset($conexion);
				 
			 }break;
				
                //busca todas las características y las retorna con codificación json
			case 'busca_caracteristica':{
				  
					global $glo_objViewConsPlan, $objPlan;
					mainGeneral();
					include("../BaseDatos/PLM_AdoDB_Inicio.php");
					$conexion = new PLM_Ado();
					$id_factor=$_POST["factor"];
					$caracteristicas = $objPlan->buscarCaracteristicasFactor($id_factor, $conexion);
					echo json_encode($caracteristicas->GetRows());
			 }break;
            default:{
                global $glo_objViewLlenarPlan, $objPlan;
                mainGeneral();
                jsGeneral();
                $arrPlan = $objPlan->buscarFactores();
                $glo_objViewLlenarPlan->buscaFactores($arrPlan);
            }break;
        }
    } else {
        
        //si el componente h_opcion con se detecta, se muestra 
        //la interface para seleccionar el factor y característica
        mainGeneral();
        jsGeneral();
        jsSelector();
        
        $arrInfo = $objPlan->buscarProceso($_SESSION["pk_proceso"],$_SESSION["pk_usuario"]);
        
        if(isset($arrInfo[0][0]))
        {
            $_SESSION["plm_facultad"]=$arrInfo[0];
            $_SESSION["plm_programa"]=$arrInfo[1];
            $_SESSION["plm_sede"]=$arrInfo[2];
            $_SESSION["plm_director"]=$arrInfo[4];
            $_SESSION["plm_periodo"]=$arrInfo[3];
            
            //muestra la informacióndel proyecto actual
            $glo_objViewLlenarPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            
            //muestra la interface para la selecciónde los factores y características
            $glo_objViewLlenarPlan->buscaFactores();
        }
        else
        {
            $glo_objViewLlenarPlan->mensaje("No hay procesos para hacer plan de mejora!!!");
        }
        
    }
    

    //aqui se hace la referencia a las clases modelo y vista
    //para poder tener acceso a la base de datos y a la interface
    function mainGeneral(){
        global $glo_objViewLlenarPlan, $objPlan;
        include('../Vista/PLM_LlenarPlan_Vista.php');  
        $glo_objViewLlenarPlan = new LlenarPlanView();
        
        include('../Modelo/PLM_Plan_Modelo.php');
        $objPlan = new Plan();
    }
    
    
    //se establece la relación con los conponentes de
    //la interface y las funciones de jquery
    function jsGeneral() {
        ?>
    	<script src="../Js/PLM_Plan.js" type="text/javascript"></script>
    	<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
        
        <?php
    }
    
    //lo que se quiere es hacer el enlace con los jquery 
    //para hacer la selección del factor y característica
    function jsSelector(){
        ?>
    	
    	<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    	<script src="../Js/PLM_Selectores.js" type="text/javascript" > </script>
        
        <?php
    }function jsSelector2(){
        ?>
    	
    	<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    	<script src="../Js/PLM_mensajes.js" type="text/javascript" > </script>
        
        <?php
    }


?>