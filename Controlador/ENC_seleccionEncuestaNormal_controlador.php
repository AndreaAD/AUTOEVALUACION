<?php session_start();
$urlDestino='../Controlador/ENC_crearEncuesta_controlador.php';
$tituloPagina='Seleccion de evidencia - Construir encuesta';
$idProceso=$_SESSION["pk_proceso"];
$existenDatos=false;
if(isset($_SESSION["enc_idfactor"]) && isset($_SESSION["enc_idcaracteristica"]) && isset($_SESSION["enc_idaspecto"]) && isset($_SESSION["enc_idevidencia"])){
    if($_SESSION["enc_idfactor"]!=null && $_SESSION["enc_idcaracteristica"]!=null && $_SESSION["enc_idaspecto"]!=null && $_SESSION["enc_idevidencia"]!=null){
        $existenDatos=true;
        require_once("../Modelo/ENC_seleccionarEvidencia_modelo.php");
        $objProcesamiento=new ProccesosSeleccionEvidencia();
        $idFactor=$_SESSION["enc_idfactor"];
        $idCaracteristica=$_SESSION["enc_idcaracteristica"];
        $idAspecto=$_SESSION["enc_idaspecto"];
        $idEvidencia=$_SESSION["enc_idevidencia"];
        $rsDatos=$objProcesamiento->getDatosSeleccionados($idFactor,$idCaracteristica,$idAspecto,$idEvidencia);
        $txFactor=$rsDatos->fields['codigofactor'].' '.$rsDatos->fields["factor"];
        $txCaracteristica=$rsDatos->fields['codigocaracteristica'].' '.$rsDatos->fields["caracteristica"];
        $txAspecto=$rsDatos->fields['codigoaspecto'].' '.$rsDatos->fields["aspecto"];
        $txEvidencia=$rsDatos->fields['codigoevidencia'].' '.$rsDatos->fields["evidencia"];
    }
}
require_once("../Vista/ENC_seleccionEvidencia_vista.php");
?>