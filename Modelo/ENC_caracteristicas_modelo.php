<?php
class Caracteristicas{
    public function getCaracteristicas($idFactor=-1){
        if($idFactor!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="Select pk_caracteristica,nombre,codigo from cna_caracteristica where pk_caracteristica in (select fk_caracteristica from cna_aspecto where pk_aspecto in (select fk_aspecto from cna_evidencia where pk_evidencia in (select fk_evidencia from cna_evidencia_grupo_interes where fk_modulo=6 AND estado=1))) AND fk_factor=".$idFactor;
            
            //$sql="SELECT  FROM cna_caracteristica where fk_factor=".$idFactor;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
        }else{
            return null;
        }
    } 
    public function getCaracteristicasAll(){
         require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="SELECT car.*, fac.nombre as nombre_factor FROM cna_caracteristica car
                    JOIN cna_factor fac on fac.pk_factor = car.fk_factor";
            
            //$sql="SELECT  FROM cna_caracteristica where fk_factor=".$idFactor;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
    }
}
?>