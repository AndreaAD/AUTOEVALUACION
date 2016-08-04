<?php
class Evidencias{
    public function getEvidencias($idAspecto=-1){
        if($idAspecto!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="select pk_evidencia,nombre,codigo from cna_evidencia where pk_evidencia in (select fk_evidencia from cna_evidencia_grupo_interes where fk_modulo=6 AND estado=1) AND fk_aspecto=".$idAspecto;
            //$sql="SELECT pk_evidencia,nombre FROM cna_evidencia WHERE fk_aspecto=".$idAspecto;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
        }else{
            return null;
        }
    }
    
    public function getEvidenciaUnaPregunta($_idPregunta){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT fk_evidencia FROM omzsiste_sia_server.enc_pregunta_cna_evidencia where fk_pregunta=".$_idPregunta;
        $idEvidenia=$conDB->conectarAdo($sql)->fields['fk_evidencia'];
        return $idEvidenia;
    }
}
?>