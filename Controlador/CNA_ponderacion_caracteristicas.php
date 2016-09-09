<?php

session_start();
require_once("../BaseDatos/AdoDB.php");
require_once("../Modelo/CNA_Factor_Modelo.php");
require_once("../Modelo/CNA_Caracteristica_Modelo.php");
$modelo_factor = new Factor();
$modelo_caracteristica = new Caracteristica();
$ponderaciones = array();
if ($_GET['opcion'] == 'ver') {
    $listado_factores = $modelo_factor->Ver();
    foreach ($listado_factores as $key => $value) {
        $listado_caracteristicas[$value['pk_factor']] = $modelo_caracteristica->Ver_X_Factor($value['pk_factor']);
        foreach ($listado_caracteristicas[$value['pk_factor']] as $key2 => $value2) {
            $ponderaciones[$value['pk_factor']][$value2['pk_caracteristica']]=$modelo_caracteristica->Ver_Ponderacion_X_Factor($value2['pk_caracteristica']);
       } 
    }
    require_once('../Vista/CNA_ponderacion_caracteristicas_vista.php');
} else {
    $opcion = $_REQUEST['opcion'];
    $pk_factor = $_REQUEST['id_factor'];
    $caracteristicas = $modelo_caracteristica->Ver_X_Factor($pk_factor);
    $valor_recibido = array();
    foreach ($caracteristicas as $key => $value) {
        array_push($valor_recibido, $_REQUEST['ponderacion_' . $value['pk_caracteristica']]);
    }
    if (array_sum($valor_recibido) < 100) {
        echo 'No se ingresaron los valores, debido a que no alcanzan al 100%';
    }
    if (array_sum($valor_recibido) > 100) {
        echo 'No se ingresaron los valores, debido a que sobrepasan el 100%';
    }
    if (array_sum($valor_recibido) == 100) {
        foreach ($caracteristicas as $key => $value) {
            $modelo_caracteristica->Agregar_Ponderacion($value['pk_caracteristica'], $valor_recibido[$key], $_SESSION['pk_proceso']);
        }
        echo 'Se agrego Correctamenta la ponderacion de las caracteristicas';
    }
}