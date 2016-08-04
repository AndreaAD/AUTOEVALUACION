<?php
//var_dump($_REQUEST);
$grupoInteres=$_REQUEST["grupo"];
//$cantidad=$_REQUEST['cantidad'];
require_once("../Modelo/ENC_procesos_modelo.php");
require_once("../Modelo/ENC_encuesta_modelo.php");
require_once("../Modelo/ENC_preguntas_modelo.php");
require_once("../Modelo/ENC_respuestas_modelo.php");
$objProcesos=new Procesos();
$objEncuestas=new Encuesta();
$objPreguntas=new Preguntas();
$objRespuestas=new Respuestas();
//================ Estudiantes, Profesores, Graduados ==============================================//
if($grupoInteres==1 || $grupoInteres==2 || $grupoInteres==4){
    $idPrograma=$_REQUEST["programa"];
    $idSede=$_REQUEST["sede"];
    $idProceso=$objProcesos->existeProceso($idPrograma,$idSede);
    $idEncuesta=$objEncuestas->existeEncuesta($idProceso,$grupoInteres);
    $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaGeneral($idProceso,$grupoInteres,$idEncuesta)->GetArray();
}
 //================ Funcionarios Administrativos ==============================================//
if($grupoInteres==5){
    $alcandeAdmin=$_REQUEST["alcance"];
    $idSede=$_REQUEST["sede"];
    $idProceso=0;
    $idEncuesta=$objEncuestas->existeEncuestaInstitucional($grupoInteres);
    $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($grupoInteres,$idEncuesta)->GetArray();
}
//================ Directivos Academicos ==============================================//
if($grupoInteres==3){
    $idSede=$_REQUEST["sede"];
    $idCargo=$_REQUEST["cargo"];
    $idProgramaFacultad=$_REQUEST["programaFacultad"];
    $tipo=$_REQUEST['tipo'];
    $idProceso=0;
    $idEncuesta=$objEncuestas->existeEncuestaInstitucional($grupoInteres);
    $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($grupoInteres,$idEncuesta)->GetArray();
  }
//=============== Empleadores y demas =================================================//
if($grupoInteres==6){
    $idSede=$_REQUEST["sede"];
    $listaProgramas=$_REQUEST['programas'];
    $idProceso=0;
    //$rsProgramas=$objProcesos->getDatosProgramasSede($idSede);
    $idEncuesta=$objEncuestas->existeEncuestaInstitucional($grupoInteres);
    $rsDatosPreguntas=$objPreguntas->getPreguntasEncuestaInsitucional($grupoInteres,$idEncuesta)->GetArray();
}

$idPregunta=array();
$idRespuestas=array();

if((isset($idProceso) && $idEncuesta!=-1) || ($idProceso!=-1 && $idEncuesta!=-1)){
    if(count($rsDatosPreguntas)!=0){
            //echo "<hr>";
            //echo "encuesta #:".$i;
            foreach($rsDatosPreguntas as $pregunta){
                $idPregunta[]=$pregunta[0];
                $rsDatosRespuestas=$objRespuestas->getDatosRespuestasSolucionEncuesta($pregunta[0])->GetArray();
                $countRes=count($rsDatosRespuestas);
                $resSelect=mt_rand(0,($countRes-1));
                $idRespuestas[$pregunta[0]]=$rsDatosRespuestas[$resSelect][0];
                /*echo '<hr>';
                echo 'id pregunta:'.$pregunta[0];
                echo '<br>';
                echo 'Pregunta :'.$pregunta[1];
                echo '<br>';
                echo 'cantidad respuestas: '.$countRes;
                echo '<br>';
                echo 'respuesta Seleccionada :'.$rsDatosRespuestas[$resSelect][0];
                echo '<br>';
                echo 'respuesta :'.$rsDatosRespuestas[$resSelect][1];
                echo '<br>';*/
            }
            if($grupoInteres==1 || $grupoInteres==2 || $grupoInteres==4){
                $resultado=$objEncuestas->guardarRespuestasEncuesta($idProceso,$grupoInteres,$idProgramaFacultad='',$idPrograma,$idSede,$alcandeAdmin='',$cargoDirectivo='',$idPregunta,$idRespuestas,$tipo=-1,$listaProgramas=array());
            }
            if($grupoInteres==5){
                $resultado=$objEncuestas->guardarRespuestasEncuesta($idProceso,$grupoInteres,$idProgramaFacultad='',$idPrograma='',$idSede,$alcandeAdmin,$cargoDirectivo='',$idPregunta,$idRespuestas,$tipo=-1,$listaProgramas=array());
            }
            if($grupoInteres==6){
                $resultado=$objEncuestas->guardarRespuestasEncuesta($idProceso,$grupoInteres,$idProgramaFacultad='',$idPrograma='',$idSede,$alcandeAdmin='',$cargoDirectivo='',$idPregunta,$idRespuestas,$tipo=-1,$listaProgramas);
            }
            if($resultado==true){
                echo 'Encuestas generada correctamente ';
            }else{
                echo 'error en la encuesta ';
            }
            //var_dump($resultado);
    }else{
        echo "NO HAY ENCUESTA ACTIVA EN ESTE MOMENTO"; 
        exit();
    }
}else{
    echo "NO HAY ENCUESTA ACTIVA EN ESTE MOMENTO";  
    exit();
}

/*
if(isset($_REQUEST["sede"])){
    $idSede=$_REQUEST["sede"];
}else{
    $idSede="";
}
if(isset($_REQUEST["programa"])){
    $idPrograma=$_REQUEST["programa"];
}else{
    $idPrograma="''";
}
if(isset($_REQUEST["grupoInteres"])){
    $idGrupoInteres=$_REQUEST["grupoInteres"];
}else{
    $idGrupoInteres="''";
}
if(isset($_REQUEST["idPregunta"])){
    $idPreguntas=$_REQUEST["idPregunta"];
}else{
    $idPreguntas=array();
}
if(isset($_REQUEST["alcance"])){
    $alcandeAdmin=$_REQUEST["alcance"];
}else{
    $alcandeAdmin="''";
}
if(isset($_REQUEST["cargo"])){
    $cargoDirectivo=$_REQUEST["cargo"];
}else{
    $cargoDirectivo="''";
}
if(isset($_REQUEST["idProceso"])){
    $idProceso=$_REQUEST["idProceso"];
}else{
    $idProceso="''";
}
$idRespuestas=array();
foreach($idPreguntas as $id){
    $idRespuestas[$id]=$_REQUEST["respuesta".$id];
}
if(isset($_REQUEST['tipo'])){
    $tipo=$_REQUEST['tipo'];
}else{
    $tipo=-1;
}
if(isset($_REQUEST['programaFacultad'])){
    $idProgramaFacultad=$_REQUEST['programaFacultad'];
}else{
    $idProgramaFacultad="''";
}
if(isset($_REQUEST['programas'])){
    $listaProgramas=$_REQUEST['programas'];
}else{
    $listaProgramas=array();
}
require_once("../Modelo/ENC_encuesta_modelo.php");
$objEncuestas=new Encuesta();
$resultado=$objEncuestas->guardarRespuestasEncuesta($idProceso,$idGrupoInteres,$idProgramaFacultad,$idPrograma,$idSede,$alcandeAdmin,$cargoDirectivo,$idPreguntas,$idRespuestas,$tipo,$listaProgramas);
require_once("../Vista/elementos_vista.php");
$objComp=new Elementos();
require_once("../Vista/ENC_enviarEncuestaRespuestas_vista.php");
*/
?>