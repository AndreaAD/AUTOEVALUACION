<?php

class ProGruposPreguntas{
    
    public function gruposInteresPreguntas($rsPreguntas,$idProceso){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $rsGruposPreguntas=array();
        $count=count($rsPreguntas);
        if($count>0){
            foreach($rsPreguntas as $fila){
                foreach($fila as $col)
                {
                    $idPregunta=$col[0];
                    $sql="SELECT fk_grupo_interes FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$idPregunta." and fk_proceso=".$idProceso." and institucional=0";
                    $rsDatos=$conDB->conectarAdo($sql);
                    $rsDatos=$rsDatos->GetArray();
                    $rsGruposPreguntas[$idPregunta]=$rsDatos;
                }
            }
        }else{
            $rsGruposPreguntas["noData"]=true;
        }
        return $rsGruposPreguntas;
    }
    
     public function gruposInteresPreguntasInstitucionales($_rsPreguntas,$_pkProcesoInstitucional){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $rsGruposPreguntas=array();
        $count=count($_rsPreguntas);
        if($count>0){
            foreach($_rsPreguntas as $fila){
                foreach($fila as $col)
                {
                    $idPregunta=$col[0];
                    $sql="SELECT fk_grupo_interes FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$idPregunta." and institucional=1 AND fk_proceso=".$_pkProcesoInstitucional;
                    $rsDatos=$conDB->conectarAdo($sql);
                    $rsDatos=$rsDatos->GetArray();
                    $rsGruposPreguntas[$idPregunta]=$rsDatos;
                }
            }
        }else{
            $rsGruposPreguntas["noData"]=true;
        }
        return $rsGruposPreguntas;
    }
}
?>