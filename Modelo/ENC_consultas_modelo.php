<?php
class Consultas{
    
    public function getDatosInformeConsolidacionEvidencia($_idEvidencia,$_idProceso){
        if($_idEvidencia!=null && $_idProceso!=null){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="select rese.pk_cna_resultados_evidencia,rese.calificacion,evg.fk_grupo_interes,gi.nombre,evg.fk_evidencia from cna_resultados_evidencia as rese,cna_evidencia_grupo_interes as evg, cna_grupo_interes as gi where rese.fk_evidencia_grupo_interes=evg.pk_evidencia_grupo_interes AND gi.pk_grupo_interes=evg.fk_grupo_interes AND evg.fk_evidencia=".$_idEvidencia." AND rese.fk_proceso=".$_idProceso;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;   
        }else{
            return -1;
        }
        
    }   
    
    public function numeroVecesPregunta($_idProceso,$_idGrupo,$_idPregunta){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
         if($_idGrupo==1 || $_idGrupo==2 || $_idGrupo==4){
            $sql='select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_solucion_encuesta as datsol,enc_solucion_encuesta as solenc, enc_datos_solucion_encuesta as dat where dat.fk_grupos_interes='.$_idGrupo.' and dat.fk_proceso='.$_idProceso.' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta and solenc.fk_pregunta='.$_idPregunta.' and datsol.pk_datos_solucion_solucion_encuesta=solenc.fk_datos_solucion_solucion_encuesta';
        }
        if($_idGrupo==3 || $_idGrupo==5 || $_idGrupo==6){
            $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
            $idProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
            $sql='select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_solucion_encuesta as datsol,enc_solucion_encuesta as solenc, enc_datos_solucion_encuesta as dat where dat.fk_grupos_interes='.$_idGrupo.' and dat.fk_proceso_institucional='.$idProcesoInstitucional.' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta and solenc.fk_pregunta='.$_idPregunta.' and datsol.pk_datos_solucion_solucion_encuesta=solenc.fk_datos_solucion_solucion_encuesta';
        }
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    public function numeroVecesRespuesta($_idProceso,$_idGrupo,$_idPregunta,$_idRespuesa){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        if($_idGrupo==1 || $_idGrupo==2 || $_idGrupo==4){
        $sql='select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_solucion_encuesta as datsol,enc_solucion_encuesta as solenc, enc_datos_solucion_encuesta as dat where dat.fk_grupos_interes='.$_idGrupo.' and dat.fk_proceso='.$_idProceso.' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta and solenc.fk_pregunta='.$_idPregunta.' and solenc.fk_respuesta_pregunta='.$_idRespuesa.' and datsol.pk_datos_solucion_solucion_encuesta=solenc.fk_datos_solucion_solucion_encuesta';
        }
        if($_idGrupo==3 || $_idGrupo==5 || $_idGrupo==6){
            $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
            $idProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
            $sql='select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_solucion_encuesta as datsol,enc_solucion_encuesta as solenc, enc_datos_solucion_encuesta as dat where dat.fk_grupos_interes='.$_idGrupo.' and dat.fk_proceso_institucional='.$idProcesoInstitucional.' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta and solenc.fk_pregunta='.$_idPregunta.' and solenc.fk_respuesta_pregunta='.$_idRespuesa.' and datsol.pk_datos_solucion_solucion_encuesta=solenc.fk_datos_solucion_solucion_encuesta';
        }
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    public function getEncuestasGrupoInteres($_idProceso,$_idGrupo){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        if($_idGrupo==1 || $_idGrupo==2 || $_idGrupo==4){
            $sql='select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_encuesta as dat, enc_datos_solucion_solucion_encuesta as datsol where dat.fk_grupos_interes='.$_idGrupo.' and dat.fk_proceso='.$_idProceso.' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta;';
        }
        if($_idGrupo==3 || $_idGrupo==5 || $_idGrupo==6){
            $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
            $idProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
            $sql='select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_encuesta as dat, enc_datos_solucion_solucion_encuesta as datsol where dat.fk_grupos_interes='.$_idGrupo.' and dat.fk_proceso_institucional='.$idProcesoInstitucional.' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta;';
        }
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
}
?>