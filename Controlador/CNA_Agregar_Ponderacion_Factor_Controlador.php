<?php

session_start();
if (isset($_REQUEST['T_Estado'])) {
    switch ($_REQUEST['T_Estado']) {
        case 'guardar':
            LinesBasicas();
            $modelo = new Factor();
            $listado_factor = $modelo->Ver_Habilitados(); 
            $mensaje = $modelo->Agregar_Ponderacion($_POST, $listado_factor);
            vista();
            break;
        default: {
                vista();
            }break;
    }
} else {
    vista();
}

function LinesBasicas() {
    require_once("../BaseDatos/AdoDB.php");
    require_once('../Vista/VIS_Elementos_Vista.php');
    require_once("../Modelo/CNA_Factor_Modelo.php");
}

function vista() {
    LinesBasicas();
    $datosFiltro = array();
    global $mensaje;
    $modelo = new Factor();
    $resSql = $modelo->Ver_Habilitados();
    if($resSql->_numOfRows==0){
        $resSql = $modelo->Ver();
    }
    foreach ($resSql as $key => $value) {
        $ponderacion[$value['pk_factor']] = $modelo->Ver_ponderacion_factor($value['pk_factor']);
    }
    $tipo_ponderacion = $modelo->Ver_TipoPonderacion();

    $strNombreBoton = 'Agregar Ponderaci&oacute;n Factor';
    $strFuncion = "ValidarPonderacion('../Controlador/CNA_Agregar_Ponderacion_Factor_Controlador.php', 'guardar');";
    $strTipoColumna = "una-columna";
    require_once('../Vista/CNA_Ponderacion_Vista.php');
}

?>
