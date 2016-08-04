<?php session_start();
require_once("../Vista/elementos_vista.php");
require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
$objTipoRespuesta=new TiposRespuesta();
$objComp=new Elementos();
if(isset($_REQUEST['idTipo'])){
    $idTipo=$_REQUEST['idTipo'];
    $datosTipo=$objTipoRespuesta->getUnTipoRespuesta($idTipo);
    $rsPonderacion=$objTipoRespuesta->getPonderacionesTipoRespuesta($idTipo);
    require_once("../Vista/ENC_modificarTipoPregunta_vista.php");
}else{
    if(isset($_REQUEST['guardar']) && $_REQUEST['guardar']==1){
        $id=$_REQUEST['id'];
        $estado=$_REQUEST['estado'];
        $description=$_REQUEST['descripcion'];
        $ponderacionID=$_REQUEST['ponderacionid'];
        $arrayPonderaciones=array();
        foreach($ponderacionID as $dato){
            $clave='ponderacion'.$dato;
            $arrayPonderaciones[$dato]=$_REQUEST[$clave];
        }
        $resultado=$objTipoRespuesta->guardarModificaciones($id,$description,$estado,$ponderacionID,$arrayPonderaciones);
    }else{
        $arrTiposRespuesta=$objTipoRespuesta->getAllTiposRespuesta()->GetArray();
        require_once("../Vista/ENC_administrarTipoPregunta_vista.php");
    }
}
?>