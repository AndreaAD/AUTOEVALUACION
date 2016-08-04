<?php
class ProccesosSeleccionEvidencia{
    
     public function getDatosSeleccionados($_idFactor,$_idCaracteristica,$_idAspecto,$_idEvidencia){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT cf.nombre as 'factor',cf.codigo as 'codigofactor',cc.nombre as 'caracteristica',cc.codigo as 'codigocaracteristica',ca.nombre as 'aspecto',ca.codigo as 'codigoaspecto',ce.nombre as 'evidencia',ce.codigo as 'codigoevidencia' FROM cna_factor as cf,cna_caracteristica as cc,cna_aspecto as ca,cna_evidencia as ce WHERE cf.pk_factor=".$_idFactor." AND cc.pk_caracteristica=".$_idCaracteristica." AND ca.pk_aspecto=".$_idAspecto." AND ce.pk_evidencia=".$_idEvidencia;
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
}
?>