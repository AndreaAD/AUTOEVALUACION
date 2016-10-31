<?php

session_start();
global $glo_objViewHisto, $glo_objModelHisto;
mainGeneral();
jsGeneral();
//$_SESSION["pk_usuario"]=1;
//$_SESSION["pk_proceso"]=3;

//se establece la recepción del componente
//h_opcion para ir a los casos   
if(isset($_REQUEST["H_opcion"]))
{
    switch($_REQUEST["H_opcion"])
    {
        //despues de haber seleccionado los dos procesos 
        //se genera el consolidado de factores
        case'generaConsoli':{

            $arrIdProce[] = array();
            $intP = $_POST['H_contProce'];
            $cont=-1;
            //se pretende capturar el código de los procesos
            for($i=0; $i<$intP; $i++)
            {
                if(isset($_REQUEST['C_select'.$i]))
                {   
                    $cont++;
                    $arrIdProce[$cont] = $_REQUEST['C_select'.$i];
                 
                }
            }
            
            if($cont != -1)
            {
                $arrFator = $glo_objModelHisto->buscaFactor();
                $arrProceCal[]=array();
                for($i=0; $i<count($arrIdProce); $i++)
                {
                    $arrProceCal[$i] = $glo_objModelHisto->buscaProceCal($arrIdProce[$i]);
                }
                
                if(($arrFator[0][0] ))
                {
                    if( ($arrProceCal[0][0]))
                    {
                        //muestra el historico de los factores
                        $glo_objViewHisto->mostrarHistorico($arrFator, $arrProceCal);
                    }
                    else
                    {
                        $glo_objViewHisto->mensaje("No hay factores consolidados!!");
                        
                    }
                }
                else
                {
                    $glo_objViewHisto->mensaje("No hay factores consolidados!!");
                }
            }
            else
            {
                $glo_objViewHisto->mensaje("Debe seleccionar al menos un proceso !!!");
            }
                    
        }break;
        default:{            
        }break;
    }
}
else
{    // //si el componente h_opcion se muestran todos los procesos 
    // //asignados al usuario y que esten cerrados 
    // //para luego compararlos historicamente
    $arrProcesos[][]=array();
    $arrProcesos = $glo_objModelHisto->buscarProcesos($_SESSION["pk_usuario"]);


    if(isset($arrProcesos[0][0]))
    {
        $glo_objViewHisto->historico_procesos($arrProcesos);        
    }
    else
    {
        $glo_objViewHisto->mensaje("NO SE ENCONTRARON PROCESOS ! ");
    }
}


//aqui se hace la referencia a las clases modelo y vista
//para poder tener acceso a la base de datos y a la interface
function mainGeneral(){
    global $glo_objViewHisto, $glo_objModelHisto;
    
    include('../Modelo/PLM_Historicos_Modelo.php');
    include('../Vista/PLM_Historicos_Vista.php'); 
    
    $glo_objViewHisto = new HistoricosFactorVista();
    $glo_objModelHisto = new  HistoricosFactorModel(); 
    $glo_objModelHisto->conectar(); 
}

//se establece la relación con los conponentes de
//la interface y las funciones de jquery
function jsGeneral(){
    ?>
    <script src="../Js/PLM_Historicos.js" type="text/javascript"></script>
    <script src="../Js/PLM_paginador.js" type="text/javascript"></script>
    <script src="../Js/chart.min.js" type="text/javascript"></script>
    <script src="../Js/Chart.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
    <?php
}
?>