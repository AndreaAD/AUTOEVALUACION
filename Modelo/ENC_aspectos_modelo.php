<?php
class Aspectos{
     public function getAspectos($idCaracteristica=-1){
        if($idCaracteristica!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="select pk_aspecto,nombre,codigo from cna_aspecto where pk_aspecto in (select fk_aspecto from cna_evidencia where pk_evidencia in (select fk_evidencia from cna_evidencia_grupo_interes where fk_modulo=6 AND estado=1)) AND fk_caracteristica=".$idCaracteristica;
            //$sql="SELECT pk_aspecto,nombre FROM cna_aspecto WHERE fk_caracteristica=".$idCaracteristica;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
        }else{
            return null;
        }
     }
     public function getAspectosAll(){
         require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="SELECT
                            asp.*, fac.nombre AS nombre_factor, car.nombre AS nombre_caracteristica
                    FROM
                            cna_caracteristica car
                    JOIN cna_factor fac ON fac.pk_factor = car.fk_factor
                    JOIN cna_aspecto asp ON asp.fk_caracteristica = car.pk_caracteristica";
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
    }
}
?>