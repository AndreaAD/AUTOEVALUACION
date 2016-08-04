<?php

 global $glo_objViewPonde, $glo_objModelPonde;
 session_start();
 //$_SESSION["pk_proceso"]=1;
 //$_SESSION["pk_usuario"]=9;
 mainGeneral();
    jsGeneral();
if(isset($_REQUEST['H_opcion']))
{
    switch($_REQUEST['H_opcion']){
        
        //guarda una razón según el factor seleccionado
        case 'guardarRazon':{
                        
            $strRazon =$_POST['TA_razon'];
            $arrRazFac = $glo_objModelPonde->buscarRazFac($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"]);
           
           
            if(($arrRazFac[0][0]))
            {
                $glo_objModelPonde->modificarRazFac($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"],$strRazon);
                
            }
            else
            {
                $glo_objModelPonde ->guardarRazFac($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"], $strRazon);
                                  
            }
                        
            $glo_objViewPonde->mensaje("Proceso Exitoso!!!");
            $glo_objViewPonde->botonAtras("AtrasAnalisis2();","mensaje");
            
                
        }break;
        //muestra la interface para guardar una razón 
        case 'addRazon':{
            
            $glo_objViewPonde->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"], $_SESSION["plm_sede"], $_SESSION["plm_director"], $_SESSION["plm_periodo"]);
            
            $arrFactor=$glo_objModelPonde->buscaFactorCod( $_SESSION["PLM_IdFactor"]);
            $glo_objViewPonde->mostrarTablaDinamic($arrFactor,"Factor");
            
            $strRazon = $glo_objModelPonde ->traerRazon($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"]);
            
            $glo_objViewPonde->addRazon($strRazon);
                
        }break;
        
        //busca y muestra las características de un factor 
        case 'buscarCaract':{     
            
            if(isset($_SESSION["PLM_IdFactor"]))
            {
                $cont=0;
            }
            else
            {
                $arrIdFac[] = array();
                $intF = $_POST['H_contFac'];
                $cont=-1;
                
                if(isset($_REQUEST['select']))
                {
                    $arrIdFac[0] = $_REQUEST['select'];
                    $_SESSION["PLM_IdFactor"]=$arrIdFac[0];
                    $cont=0;
                }
            }
             
            if($cont==-1)
            {
                $glo_objViewPonde->mensaje("No seleccionó ningún factor!!!");
            }
            else
            {    
                $glo_objViewPonde->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"], $_SESSION["plm_sede"], $_SESSION["plm_director"], $_SESSION["plm_periodo"]);
 
                $arrCarac = $glo_objModelPonde->buscarCarac($_SESSION["PLM_IdFactor"], $_SESSION["pk_proceso"]);
                $arrPonde = $glo_objModelPonde->buscarCaracPonde($_SESSION["PLM_IdFactor"], $_SESSION["pk_proceso"]);
                
                $strRazon = $glo_objModelPonde ->traerRazon($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"]);
                
                $arrFactor=$glo_objModelPonde->buscaFactorCod( $_SESSION["PLM_IdFactor"]);
                $glo_objViewPonde->mostrarTablaDinamic($arrFactor,"Factor");
                
                $glo_objViewPonde->mostrarCaract($arrCarac,$arrPonde, $strRazon);
            }
        }break;               
        
        //cuando se le da en el boton guardar ponderación 
        //y calcula el valor de la ponderación de cada característica 
        //según la opción escogida 
        case 'calcularValor':{
            
            $intC= $_POST['H_contCarac'];
            $intOp= $_POST['S_opcion'];
            $arrCarac[][]=array();
            $strRazon="";
            $temp=0;
            
            if($intOp==1)
            {
                $intCal=100/$intC;
                
                for($i=0; $i<$intC; $i++)
                {
                    if(($_REQUEST['H_idCar'.$i]))
                    {
                        $arrCarac[$i][0] = $_REQUEST['H_idCar'.$i]; 
                        $arrCarac[$i][1] = $intCal;
                    }
                }
            }
            else if($intOp==2)
            {
                for($i=0; $i<$intC; $i++)
                {
                    if(($_REQUEST['T_pondera'.$i]))
                    {
                        $arrCarac[$i][0] = $_REQUEST['H_idCar'.$i]; 
                        $arrCarac[$i][1] = $_REQUEST['T_pondera'.$i];
                    }
                    else 
                    {
                        $temp=1;
                        break;
                    }
                }
                if($temp==1)
                {
                    $glo_objViewPonde->mensaje("Se deben llenar todos los campos de texto !");
                    $glo_objViewPonde->botonAtras("AtrasAnalisis2();","mensaje");
                    
                }
                else
                {
                
                    $intCal=0;
                    for($i=0; $i<count($arrCarac); $i++)
                    {
                        $intCal = $intCal+ $arrCarac[$i][1];
                    }
                    if($intCal!=100)
                    {
                        $temp=1;
                        $glo_objViewPonde->mensaje("Error las ponderaciones deben sumar 100% !"); 
                        $glo_objViewPonde->botonAtras("AtrasAnalisis2();","mensaje");
                    }
                }
            }
            else
            {
                $temp=1;
                $glo_objViewPonde->mensaje("No selecciono ninguna opción !");
                $glo_objViewPonde->botonAtras("AtrasAnalisis2();","mensaje");
            }
                      
            if($temp==0)
            {                 
                $glo_objViewPonde->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"], $_SESSION["plm_sede"], $_SESSION["plm_director"], $_SESSION["plm_periodo"]);
                                
                $strRazon = $glo_objModelPonde->buscarRazon($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"]);
                if($strRazon == "")
                {
                    $glo_objViewPonde->advierteRazon();
                }
                else
                {
                    for($l=0; $l<count($arrCarac); $l++)
                    {
                        $arrCaracTemp = $glo_objModelPonde->buscarCalCarac($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"],$arrCarac[$l][0]);
                        
                        for($n=0; $n<count($arrCaracTemp); $n++)
                        {
                            if(($arrCaracTemp[$n][0]))
                            {
                                $glo_objModelPonde->modificarCalCarac($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"],$arrCarac[$l][0],$arrCarac[$l][1]);
                                
                            }
                            else
                            {            
                                 $glo_objModelPonde->guardarCalCarac($_SESSION["pk_proceso"],$_SESSION["PLM_IdFactor"],$arrCarac[$l][0],$arrCarac[$l][1]);
                                
                            }
                        }
                    }
                    
                    $glo_objViewPonde->mensaje("Proceso Exitoso!");
                    $glo_objViewPonde->botonAtras("AtrasAnalisis();","mensaje");
                }
             
            }
        }break;                
        default:{
        }break;
    }
}
else
{ 
    //si no entra a alguna opcion del componente 
    //h_opcion entra aqui y muestra todos los factores para
    //depues ser seleccionados
    unset($_SESSION["PLM_IdFactor"]);
    jsGeneral();
    global $glo_objViewPonde, $glo_objModelPonde, $arrFactor;
                
    $arrInfo = $glo_objModelPonde->buscarProceso($_SESSION["pk_proceso"],$_SESSION["pk_usuario"]);
    
    if(isset($arrInfo[0][0]))
    {
        
        $_SESSION["plm_facultad"]=$arrInfo[0];
        $_SESSION["plm_programa"]=$arrInfo[1];
        $_SESSION["plm_sede"]=$arrInfo[2];
        $_SESSION["plm_director"]=$arrInfo[4];
        $_SESSION["plm_periodo"]=$arrInfo[3];
        
        //muestra la información del proceso, seleccionado 
        $glo_objViewPonde->mostrarInfo($_SESSION["plm_facultad"], $_SESSION["plm_programa"], $_SESSION["plm_sede"], $_SESSION["plm_director"], $_SESSION["plm_periodo"]);
     
     
        
        $arrFactor = $glo_objModelPonde ->buscaFactor();
        $glo_objViewPonde ->mostrarFac($arrFactor);
    }
    else
    {
        $glo_objViewPonde->mensaje("NO HAY PROCESOS PARA CONSOLIDAR!");
    }
}

//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewPonde, $glo_objModelPonde;
    
    include('../Modelo/PLM_Ponderacion_Modelo.php');
    include('../Vista/PLM_Ponderacion_Vista.php'); 
    
    $glo_objViewPonde = new PonderacionVista();
    $glo_objModelPonde = new  PonderaModelo(); 
    $glo_objModelPonde->conectar();
}


//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Ponderacion.js" type="text/javascript"></script>  
   	<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>