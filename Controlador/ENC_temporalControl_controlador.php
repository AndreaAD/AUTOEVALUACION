<?php
require_once("../Modelo/ENC_temporal_modelo.php");
$objTemporal=new ProcesamientoTemporal();

require_once("../Modelo/ENC_preguntas_modelo.php");
require_once("../Modelo/ENC_gruposInteres_modelo.php");
require_once("../Modelo/ENC_respuestas_modelo.php");
require_once("../Modelo/ENC_evidencias_modelo.php");
require_once("../Modelo/ENC_util_modelo.php");
$idProceso=1;
$objPreguntas=new Preguntas();
$objGrupos=new GruposInteres();
$objRespuestas=new Respuestas();
$objEvidencias=new Evidencias();
$rsGrupos=$objGrupos->getAllGrupos();
foreach($rsGrupos as $grupo){
    $idUnico=Util::getCodigoAleatorio();
    //$grupo['pk_grupo_interes']
    $pkEncuesta=$objTemporal->publicarEncuesta($idProceso,$grupo['pk_grupo_interes'],$idUnico);
    //echo $grupo['nombre'].'<br>';
    $i=1;
    $rsDatosPreguntas=$objPreguntas->getPreguntasGrupoInteres($idProceso,$grupo['pk_grupo_interes']);
    foreach($rsDatosPreguntas as $pregunta){
        $pkEvidencia=$objEvidencias->getEvidenciaUnaPregunta($pregunta['pk_pregunta']);
        //echo '('.$i.') '.$pregunta['pk_pregunta'].'  '.$pregunta['texto'].'<br>';
        $i++;
        $rsDatosRespuestas=$objRespuestas->getDatosRespuestas($pregunta['pk_pregunta'])->GetArray();
        $res=$objTemporal->copiarDatosEncuesta($pregunta,$rsDatosRespuestas,$pkEvidencia,$pkEncuesta);
    }
    //echo '<br>';
}
echo 'fin';
?>