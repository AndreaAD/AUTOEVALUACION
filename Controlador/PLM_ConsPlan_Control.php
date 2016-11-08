<?php
session_start();

//$_SESSION["pk_proceso"]=1;
//$_SESSION["pk_usuario"]=9;
// se valida el componente h_opcion

if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        
        //en este caso lo que se quiere hacer es mostrar todas las actividades
        //las actividades de un proyecto   
        case 'ver_actividades':{
            global $glo_objViewConsPlan, $objPlan;
            mainGeneral();  
            include("../BaseDatos/PLM_AdoDB_Inicio.php");
            $conexion = new PLM_Ado();   
            $arrPlan = $objPlan->buscarPlanes($_POST['S_plan'], $conexion);
			
            $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
        		
            $glo_objViewConsPlan->imprimePlanes($arrPlan,"atrasc3();");
            
        }break; 
        
        
        //en este caso lo que se quiere hacer es imprimir una actividad en 
        //especifico es decir completa y detallada
        case 'ver':{
            global $glo_objViewConsPlan, $objPlan;
            mainGeneral();  
            include("../BaseDatos/PLM_AdoDB_Inicio.php");
            $conexion = new PLM_Ado();   
            $arrPlan = $objPlan->buscarPlanes($_POST['S_plan'], $conexion);
			
            $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
        		
            $glo_objViewConsPlan->imprime($arrPlan,"atrasc2();");
        }break;
         
        //en este caso lo que se quiere buscar son las actividades de una característica 
        //y de un proyecto 
		case 'ver_acti_carac':{
            global $glo_objViewConsPlan, $objPlan;
            mainGeneral();  
            include("../BaseDatos/PLM_AdoDB_Inicio.php");
            $conexion = new PLM_Ado();   
            $arrPlan = $objPlan->buscarPlanesCarac($_POST['proyecto'], $_POST['caracteristica'],$conexion);			
            $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
            $glo_objViewConsPlan->imprime($arrPlan, "atrasc();");
        }break; 
		
        
        //en este caso lo que se quiere buscar son los factores 
        //y mostrarlos en la interface
        case 'ver_factor':{
            global $glo_objViewConsPlan, $objPlan;
                    
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
                
                $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                
                $glo_objViewConsPlan->buscaFactores();
             
			
            }
            else
            {
                $glo_objViewConsPlan->mensaje("No hay procesos para hacer plan de mejora!!!");
            }
            
			
             
            }break;
           
            // en este caso lo que se quiere mostrar son los procesos que tiene un usuario asignados
            case 'ver_procesos':{
                global $glo_objViewConsPlan, $objPlan;
                mainGeneral();     
                jsGeneral();
                
                $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                
                $arrProcesos=$objPlan->buscarProcesosTermina($_SESSION["pk_usuario"]);
                
                $glo_objViewConsPlan->mostrarProcesos($arrProcesos);
                
            }break;

            case 'ver_procesos_historico':{
                global $glo_objViewConsPlan, $objPlan;
                mainGeneral();     
                jsGeneral();
                
                $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                
                $arrProcesos=$objPlan->buscarProcesosTermina($_SESSION["pk_usuario"]);
                
                $glo_objViewConsPlan->mostrarProcesosCerrados($arrProcesos);
                
            }break;
            
            //en este caso lo que se quiere buscar son las actividades de un proyecto
            case 'ver_activi_proceso':{
                global $glo_objViewConsPlan, $objPlan;
                mainGeneral();    
                include("../BaseDatos/PLM_AdoDB_Inicio.php");
                $conexion = new PLM_Ado(); 
                $cont=0;
                //si selecciona un proceso
                if(isset($_REQUEST['radio']))
                {
                    $cont=1;
                } 
                    
                if($cont==1)
                {
                    //muestra la información de un proceso
                    $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                    
                    //busca los proyectos creados de un proceso
                    $arrPlan=$objPlan->buscarProyectos($_REQUEST['radio']);
                    $glo_objViewConsPlan->buscaPlan($arrPlan);
                }
                else
                {
                    $glo_objViewConsPlan->mensaje("Debe seleccionar un proceso !!");
                }
            }break;
            case 'ver_historico_plm':{
                global $glo_objViewConsPlan, $objPlan;
                mainGeneral();    
                include("../BaseDatos/PLM_AdoDB_Inicio.php");
                $conexion = new PLM_Ado(); 
                $cont=0;
                //si selecciona un proceso
                if(isset($_REQUEST['radio']))
                {
                    $cont=1;
                } 
                    
                if($cont==1)
                {
                    //muestra la información de un proceso
                    // $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
                    
                    // //busca los proyectos creados de un proceso
                    // $arrPlan=$objPlan->buscarProyectos($_REQUEST['radio']);
                    // $glo_objViewConsPlan->buscaPlan($arrPlan);
                }
                else
                {
                    $glo_objViewConsPlan->mensaje("Debe seleccionar un proceso !!");
                }
            }break;
            
            //obtiene los factores de la base de datos con un return set
			 case 'busca_factor':{
				global $glo_objViewConsPlan, $objPlan;
				mainGeneral();
                include("../BaseDatos/PLM_AdoDB_Inicio.php");
                $conexion = new PLM_Ado();
				//busca los factores en la base de datos y los trae en un 
                //return set 
				$arrPlan = $objPlan->buscarFactores();
                //se imprime en codificación json
				echo json_encode($arrPlan->GetRows());
				 
			 }break;
			//en este caso se buscan las características de un factor 
            //y las retorna en un return set
			case 'busca_caracteristica':{
			 
					global $glo_objViewConsPlan, $objPlan;
					mainGeneral();
					include("../BaseDatos/PLM_AdoDB_Inicio.php");
					$conexion = new PLM_Ado();
                    //se trae el codigo del factor
					$id_factor=$_POST["factor"];
                    //se traen la características en un return set 
					$caracteristicas = $objPlan->buscarCaracteristicasFactor($id_factor, $conexion);
                    //se retornan las características con json 
					echo json_encode($caracteristicas->GetRows());
			 }break;
             //busca los proyectos todos los de un proceso
             //retorna los proyectos en un return set
			 case 'busca_proyecto':{
				  
					global $glo_objViewConsPlan, $objPlan;
					mainGeneral();
					include("../BaseDatos/PLM_AdoDB_Inicio.php");
					$conexion = new PLM_Ado();
                    //trae todos los proyectos de una característica
					$proyectos = $objPlan->buscarProyecto($_SESSION["pk_proceso"]);
                    // retorna los proyectos en un return set
					echo json_encode($proyectos->GetRows());
			 }break;
			 case 'busca_actividad':{
				  // busca las actividades de un proyecto y un característica
					global $glo_objViewConsPlan, $objPlan;
					mainGeneral();
					include("../BaseDatos/PLM_AdoDB_Inicio.php");
					$conexion = new PLM_Ado();
					$id_carac=$_POST["caracteristica"];
					$id_proyec=$_POST["proyecto"];
                    //busca las actividades de uns caracteristica y de un proyecto
					$actividades = $objPlan->buscarActividad($id_carac,$id_proyec,$conexion);
					echo json_encode($actividades->GetRows());
			 }break;
        default:{
            global $glo_objViewConsPlan;
            mainGeneral();
            jsGeneral();
            $arrPlan=$objPlan->buscarPlan();
            $glo_objViewConsPlan->buscaPlan($arrPlan);
        }break;
    }
}
else
{
    //si no se detecta el objeto h_opcion, 
    //entramos a inicializar la interface , haciendo las consultas pertinentes
    //ademas mostrando la ventana para poder usar los selectores
    mainGeneral();
    jsGeneral();
    
    $arrInfo = $objPlan->buscarProceso($_SESSION["pk_proceso"],$_SESSION["pk_usuario"]);
    
    if(isset($arrInfo[0][0]))
    {
        $_SESSION["plm_facultad"]=$arrInfo[0];
        $_SESSION["plm_programa"]=$arrInfo[1];
        $_SESSION["plm_sede"]=$arrInfo[2];
        $_SESSION["plm_director"]=$arrInfo[4];
        $_SESSION["plm_periodo"]=$arrInfo[3];
        
        
        $glo_objViewConsPlan->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"],$_SESSION["plm_sede"],$_SESSION["plm_director"],$_SESSION["plm_periodo"]);
        
        $arrPlan=$objPlan->buscarPlan();
        $glo_objViewConsPlan->buscaPlan($arrPlan);        
    
    }
    else
    {
        $glo_objViewConsPlan->mensaje("No hay procesos para hacer plan de mejora!!!");
    }
}


//en esta funcion se declaran los objestos 
//que van al modelo y la vista para poder ejecutar las 
//funciones que hay dentro de las clases
function mainGeneral(){
    global $glo_objViewConsPlan, $objPlan;
    include('../Vista/PLM_ConsPlan_Vista.php');  
    $glo_objViewConsPlan = new ConsPlanView();
    
    include('../Modelo/PLM_Plan_Modelo.php');
    $objPlan = new Plan(); 
}

//en esta funcion se declaran los archivos de jquery para los enlaces de
// los botones 
function jsGeneral(){
    ?>
	<script src="../Js/PLM_Plan.js" type="text/javascript"></script>
    
	<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}

// se establecen los enlaces para el selector de factores, características, proyectos y actividades
function jsSelector(){
    ?>	
	<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
	<script src="../Js/PLM_Selectores.js" type="text/javascript" > </script>
    
    <?php
}
?>