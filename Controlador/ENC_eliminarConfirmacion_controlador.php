<?php
require_once("../Modelo/ENC_preguntas_modelo.php");
require_once("../Vista/elementos_vista.php");
if($_REQUEST['opcion']=='estado'){
    $objPreguntas=new Preguntas();
    $opcion=$_REQUEST['opcion'];
    $idPregunta=$_REQUEST['id'];
    $estado=$_REQUEST['estado'];
    $estado= $estado==1 ? 0:1;
    $resultados=$objPreguntas->cambiarEstadoPregunta($idPregunta,$estado);
    $objComp=new Elementos();
    require_once("../Vista/ENC_eliminarConfirmacion_vista.php");
}else if($_REQUEST['opcion']=='eliminar'){
        require_once("../Modelo/ENC_preguntas_modelo.php");
        require_once("../Vista/elementos_vista.php");
        $objPreguntas=new Preguntas();
        $opcion=$_REQUEST['opcion'];
        $idPregunta=$_REQUEST['id'];
        $resultados=$objPreguntas->eliminarPregunta($idPregunta);
        $objComp=new Elementos();
        require_once("../Vista/ENC_eliminarConfirmacion_vista.php");
    }

?>