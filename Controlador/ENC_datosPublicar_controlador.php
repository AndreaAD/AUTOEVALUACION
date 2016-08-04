<?php
//session_start();
//obtenemos el grupo de interes que nos eviaron por la peticion http
$idGrupoInt=$_REQUEST["idGrupo"];
// incluimos los modelos necesarios
require_once("../Modelo/ENC_gruposInteres_modelo.php");
require_once("../Modelo/ENC_preguntas_modelo.php");
require_once("../Modelo/ENC_encuesta_modelo.php");
// objeto para manejar los grupos de interes
$objGruposInteres=new GruposInteres();

// objeto para manejar los datos basicos de las encuestas
$objEncuestas=new Encuesta();
// obtenemos un grupo de interes al que le corresponde el id que nos llego
$rsGrupos=$objGruposInteres->getUnGrupoInteres($idGrupoInt);
// obtenemos los datos de la encuesta para el grupo de interes que nos llego
// es decir obtenemos el titulo, descripcion e intrucciones que apareceran 
// en la encuesta de ese grupo de interes
$rsDatosEncuesta=$objEncuestas->getDatosEncuesta($idGrupoInt);
// extraemos los datos del recordset que nos llego
$txTitulo=$rsDatosEncuesta->fields[0];
$txDescripcion=$rsDatosEncuesta->fields[1];
$txInstrucciones=$rsDatosEncuesta->fields[2];
require_once("../Vista/elementos_vista.php");
// objeto para manejar los elementos de la vista
$objComp=new Elementos();
require_once("../Vista/ENC_datosPublicar_vista.php");
?>