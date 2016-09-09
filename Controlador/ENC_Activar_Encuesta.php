<?php

session_start();

$idProceso = $_SESSION["pk_proceso"];
$caracteristicas_sistema = array();
$aspectos_sistema = array();
$evidencias_sistema = array();
$caracteristicas_proceso = array();
$aspectos_proceso = array();
$evidencias_proceso = array();

require_once("../BaseDatos/AdoDB.php");
require_once("../Modelo/CNA_Proceso_Modelo.php");
require_once("../Modelo/CNA_Aspecto_Modelo.php");
require_once("../Modelo/CNA_Caracteristica_Modelo.php");
require_once("../Modelo/CNA_Evidencia_Modelo.php");

$objProceso = new Proceso();
$objCaracteristica = new Caracteristica();
$objAspecto = new Aspecto();
$objEvidencia = new Evidencia();


$listado_caracteristicas = $objCaracteristica->Ver();
$listado_aspectos = $objAspecto->get_aspectos();
$listado_evidencias = $objEvidencia->Ver();

foreach ($listado_caracteristicas as $key => $value) {
    array_push($caracteristicas_sistema, $value['pk_caracteristica']);
}
foreach ($listado_aspectos as $key => $value) {
    array_push($aspectos_sistema, $value['pk_aspecto']);
}
foreach ($listado_evidencias as $key => $value) {
    array_push($evidencias_sistema, $value['pk_evidencia']);
}

$listado_caracteristicas = $objCaracteristica->get_Caracteristica_Proceso($idProceso);
$listado_aspectos = $objAspecto->get_Aspecto_Proceso($idProceso);
$listado_evidencias = $objEvidencia->get_Evidencia_Proceso($idProceso);

foreach ($listado_caracteristicas as $key => $value) {
    array_push($caracteristicas_proceso, $value['fk_caracteristica']);
}
foreach ($listado_aspectos as $key => $value) {
    array_push($aspectos_proceso, $value['fk_aspecto']);
}
foreach ($listado_evidencias as $key => $value) {
    array_push($evidencias_proceso, $value['fk_evidencia']);
}

$comparacion_caracteristicas = array_diff($caracteristicas_sistema, $caracteristicas_proceso);
$comparacion_aspectos = array_diff($aspectos_sistema, $aspectos_proceso);
$comparacion_evidencias = array_diff($evidencias_sistema, $evidencias_proceso);


if (sizeof($comparacion_caracteristicas) != 0) {
    if (sizeof($comparacion_aspectos) != 0) {
        if (sizeof($comparacion_evidencias) != 0) {
            echo '<div class="aletra-fase">
                    <p>No se puede activar la encuesta hasta que todos los elementos del CNA sean asignados al menos a una pregunta</p>
                  </div>';
            die();
        }
    }
}
$listado_procesos_disponibles = $objProceso->Ver_Proceso_Unico($idProceso);
$faseProceso = $_SESSION['pk_fase'];
require_once("../Vista/ENC_Listado_Procesos_Vista.php");
?>