<?php
class GruposInteres{
    public function getAllGrupos(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT * FROM cna_grupo_interes WHERE  pk_grupo_interes=1 OR pk_grupo_interes=2 OR pk_grupo_interes=4 OR pk_grupo_interes=3 OR pk_grupo_interes=5 OR pk_grupo_interes=6 AND estado=1";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    public function getGruposEncuestasNormales(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT * FROM cna_grupo_interes WHERE pk_grupo_interes=1 OR pk_grupo_interes=2 OR pk_grupo_interes=4 AND estado=1";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    public function getGruposEncuestasInstitucionales(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT * FROM cna_grupo_interes WHERE pk_grupo_interes=3 OR pk_grupo_interes=5 OR pk_grupo_interes=6 AND estado=1";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    public function gruposInteresUnaPregunta($_idPregunta,$_idProceso){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT fk_grupo_interes FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$_idPregunta." and fk_proceso=".$_idProceso." and institucional=0";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos->GetArray();
    }
    
    public function gruposInteresUnaPreguntaInstitucional($_idPregunta,$_idProceso){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
        $idProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];   
        $sql="SELECT fk_grupo_interes FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$_idPregunta." and institucional=1 AND fk_proceso_institucional=".$idProcesoInstitucional;
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos->GetArray();
    }
    
    public function getUnGrupoInteres($_id){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT * FROM cna_grupo_interes WHERE pk_grupo_interes=".$_id;
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
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
                    $sql="SELECT fk_grupo_interes FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$idPregunta." and fk_proceso_institucional is null and fk_proceso=".$idProceso." and institucional=0";
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
                    $sql="SELECT fk_grupo_interes FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$idPregunta." AND institucional=1 AND fk_proceso is null AND fk_proceso_institucional=".$_pkProcesoInstitucional;
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