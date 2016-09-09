<?php
class Preguntas{
    public function getAllPreguntasNormales($idEvidencia=-1){
        if($idEvidencia!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            
            $arrayPreguntas=array();
            $sql="SELECT pe.fk_pregunta from enc_pregunta_cna_evidencia as pe, enc_pregunta as p WHERE pe.fk_evidencia=".$idEvidencia." AND p.pk_pregunta=pe.fk_pregunta AND p.institucional=0";
            $rsDatos=$conDB->conectarAdo($sql);
            if(count($rsDatos)>0){
                foreach($rsDatos as $row){
                    $sql="SELECT p.* FROM enc_pregunta as p WHERE p.pk_pregunta=".$row[0]." AND p.estado=1 AND p.institucional=0";
                    $rsDatos=$conDB->conectarAdo($sql);
                    $arrayPreguntas[]=$rsDatos->GetArray();
                }
            }
            return $arrayPreguntas;
        }else{
            return null;
        }
    }
    
    public function getAllPreguntasInstitucionales($idEvidencia=-1){
        if($idEvidencia!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            
            $arrayPreguntas=array();
            $sql="SELECT pe.fk_pregunta from enc_pregunta_cna_evidencia as pe, enc_pregunta as p WHERE pe.fk_evidencia=".$idEvidencia." AND p.pk_pregunta=pe.fk_pregunta AND p.institucional=1";
            $rsDatos=$conDB->conectarAdo($sql);
            if(count($rsDatos)>0){
                foreach($rsDatos as $row){
                    $sql="SELECT p.* FROM enc_pregunta as p WHERE p.pk_pregunta=".$row[0]." AND p.estado=1 AND p.institucional=1";
                    $rsDatos=$conDB->conectarAdo($sql);
                    $arrayPreguntas[]=$rsDatos->GetArray();
                }
            }
            return $arrayPreguntas;
        }else{
            return null;
        }
    }
    
    public function getAllPreguntas($idEvidencia=-1){
        if($idEvidencia!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $arrayPreguntas=array();
            $sql="SELECT pe.fk_pregunta from enc_pregunta_cna_evidencia as pe, enc_pregunta as p WHERE pe.fk_evidencia=".$idEvidencia." AND p.pk_pregunta=pe.fk_pregunta";
            $rsDatos=$conDB->conectarAdo($sql);
            if(count($rsDatos)>0){
                foreach($rsDatos as $row){
                    $sql="SELECT p.* FROM enc_pregunta as p WHERE p.pk_pregunta=".$row[0];
                    $rsDatos=$conDB->conectarAdo($sql);
                    $arrayPreguntas[]=$rsDatos->GetArray();
                }
            }
            return $arrayPreguntas;
        }else{
            return null;
        }
    }
    
    public function guardarPregunta($_txPregunta,$_idTipoRes,$_txRespuesta,$_ponRespuesta,$_idEvidencia,$_idProceso,$institucional,$_idGruposInt){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="INSERT INTO enc_pregunta(texto,fk_tipo_respuesta,estado,institucional)";
        if($institucional==0){
            $sql.="VALUES ('".$_txPregunta."',".$_idTipoRes.",1,0)";   
        }else{
            $sql.="VALUES ('".$_txPregunta."',".$_idTipoRes.",1,1)";
        }
        $res=$conDB->conectarAdo($sql);
        if($institucional==0){
            $sql="SELECT pk_pregunta FROM enc_pregunta WHERE texto='".$_txPregunta."' AND estado=1 AND institucional=0";
        }else{
            $sql="SELECT pk_pregunta FROM enc_pregunta WHERE texto='".$_txPregunta."' AND estado=1 AND institucional=1";
        } 
        $idPregunta=$conDB->conectarAdo($sql);
        $idPregunta=$idPregunta->GetArray();
        $idPregunta=$idPregunta[0][0];
        foreach($_txRespuesta[0] as $clave=>$texto){
            $sql="INSERT INTO enc_respuesta_pregunta(texto,fk_respuesta_ponderacion,fk_pregunta) VALUES ('".$texto."',".$_ponRespuesta[0][$clave].",".$idPregunta.")";
            $res=$conDB->conectarAdo($sql);
        }
        $sql="INSERT INTO enc_pregunta_cna_evidencia(fk_evidencia,fk_pregunta) VALUES (".$_idEvidencia.",".$idPregunta.")";
        $res=$conDB->conectarAdo($sql);
        if($institucional==1){
            $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
            $pkProcesoInstitucional=$conDB->conectarAdo($sql);
            $sql="DELETE FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$idPregunta." AND institucional=1 AND fk_proceso_institucional=".$pkProcesoInstitucional->fields[0]." AND fk_proceso is null";
            $res=$conDB->conectarAdo($sql);
            foreach($_idGruposInt[0] as $idGrupo){
            $res=$conDB->conectarAdo($sql);
                $sql="INSERT INTO enc_pregunta_cna_proceso(fk_pregunta,fk_grupo_interes,fk_proceso_institucional,institucional) VALUES (".$idPregunta.",".$idGrupo.",".$pkProcesoInstitucional->fields[0].",1)";
                $res=$conDB->conectarAdo($sql);
            }
        }
        return $res;
    }
    
    public function getUnaPregunta($_idPRegunta){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT p.pk_pregunta,p.texto,tr.pk_tipo_respuesta,tr.cantidad_respuestas,p.estado,p.institucional FROM enc_pregunta as p, tipo_respuesta as tr WHERE p.pk_pregunta=".$_idPRegunta." AND tr.pk_tipo_respuesta=p.fk_tipo_respuesta";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    public function guardarModificaciones($_idPregunta,$_txPregunta,$_idTipoRes,$_txRespuesta,$_ponRespuesta,$_idEvidencia,$_idProceso,$institucional,$_idGruposInt){ 
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="UPDATE enc_pregunta SET texto='".$_txPregunta."',fk_tipo_respuesta=".$_idTipoRes." WHERE pk_pregunta=".$_idPregunta;
        $res=$conDB->conectarAdo($sql);
        $sql="DELETE FROM enc_respuesta_pregunta WHERE fk_pregunta=".$_idPregunta;
        $res=$conDB->conectarAdo($sql);
        //var_dump($res);
        foreach($_txRespuesta[0] as $clave=>$texto){
            $sql="INSERT INTO enc_respuesta_pregunta(texto,fk_respuesta_ponderacion,fk_pregunta) VALUES ('".$texto."',".$_ponRespuesta[0][$clave].",".$_idPregunta.")";
            $res=$conDB->conectarAdo($sql);
        }
        if($institucional==1){
            $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
            $pkProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
            $sql="DELETE FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$_idPregunta." AND fk_proceso is null  AND institucional=1 AND fk_proceso_institucional=".$pkProcesoInstitucional;
            $res=$conDB->conectarAdo($sql);
            foreach($_idGruposInt[0] as $idGrupo){
                $sql="INSERT INTO enc_pregunta_cna_proceso(fk_pregunta,fk_grupo_interes,fk_proceso_institucional,institucional) VALUES (".$_idPregunta.",".$idGrupo.",".$pkProcesoInstitucional.",1)";
                $res=$conDB->conectarAdo($sql);
            }
        }
        return $res;
    }
    
    public function contarPreguntasGrupoInteres($_idProceso,$_idGrupo){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT count(fk_pregunta) as 'cantidad' FROM enc_pregunta_cna_proceso WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso;
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    public function getPreguntasGrupoInteres($_idProceso,$_idGrupo){
        if($_idProceso!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            if($_idGrupo==1 || $_idGrupo==2 || $_idGrupo==4 ){
                $sql="SELECT pre.* FROM enc_pregunta_cna_proceso as prepro, enc_pregunta as pre WHERE prepro.fk_proceso=".$_idProceso." AND prepro.fk_grupo_interes=".$_idGrupo." AND pre.pk_pregunta=prepro.fk_pregunta AND pre.estado=1";
            }else if($_idGrupo==3 || $_idGrupo==5 || $_idGrupo==6){
                $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
                $idProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
                $sql="SELECT pre.* FROM enc_pregunta_cna_proceso as prepro, enc_pregunta as pre WHERE prepro.fk_proceso_institucional=".$idProcesoInstitucional." AND prepro.fk_grupo_interes=".$_idGrupo." AND prepro.institucional=1 AND pre.pk_pregunta=prepro.fk_pregunta AND pre.estado=1 AND pre.institucional=1";    
            }
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
        }else{
            return -1;
        }
    }
    
    public function guardarEnlaceUnaPregunta($_idPregunta,$_idGruposInteres,$_idEvidencia,$_idProceso){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="DELETE FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$_idPregunta." AND fk_proceso=".$_idProceso." AND fk_proceso_institucional is null AND institucional=0";
        $res=$conDB->conectarAdo($sql);
        foreach($_idGruposInteres[0] as $idGrupo){
            $sql="INSERT INTO enc_pregunta_cna_proceso(fk_pregunta,fk_grupo_interes,fk_proceso,institucional) VALUES (".$_idPregunta.",".$idGrupo.",".$_idProceso.",0)";
            $res=$conDB->conectarAdo($sql);
        }
        return $res;
    }
    
    function getPreguntasEncuestaGeneral($_idProceso,$_idGrupo,$_idEncuesta){
        if($_idProceso!=-1){
            if($_idEncuesta!=-1){
                require_once("../BaseDatos/AdoDB.php");
                $conDB=new Ado();
               // $sql="SELECT pre.* FROM enc_pregunta_cna_proceso as prepro, enc_pregunta as pre WHERE prepro.fk_proceso=".$_idProceso." AND prepro.fk_grupo_interes=".$_idGrupo." AND pre.pk_pregunta=prepro.fk_pregunta AND pre.estado=1 AND prepro.institucional=0";
                $sql="SELECT pk_pregunta,texto FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=".$_idEncuesta;
                $rsDatos=$conDB->conectarAdo($sql);
                return $rsDatos;
            }else{
                return -1;   
            }
        }else{
            return -1;
        }
    }
    
    function getPreguntasEncuestaInsitucional($_idGrupo,$_idEncuesta){
        if($_idEncuesta!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            
            /*$sql="SELECT pk_proceso_institucional FROM cna_proceso_institucional WHERE estado=1 LIMIT 1";
            $pkProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
            $sql="SELECT pre.* FROM enc_pregunta_cna_proceso as prepro, enc_pregunta as pre WHERE pre.estado=1 AND pre.institucional=1 AND pre.pk_pregunta=prepro.fk_pregunta AND prepro.fk_proceso is null AND prepro.fk_grupo_interes=".$_idGrupo." AND prepro.institucional=1 AND prepro.fk_proceso_institucional=".$pkProcesoInstitucional;*/
            $sql="SELECT pk_pregunta,texto FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=".$_idEncuesta;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
        }else{
            return -1;   
        }
    }
    
    function cambiarEstadoPregunta($_idPregunta,$_estado){
         require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="UPDATE enc_pregunta SET estado=".$_estado." WHERE pk_pregunta=".$_idPregunta;
            $resultado=$conDB->conectarAdo($sql);
            return $resultado;
    }
    
    function eliminarPregunta($_idPregunta){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT count(pk_solucion_encuesta) FROM enc_solucion_encuesta WHERE fk_pregunta=".$_idPregunta;
        $resultado=$conDB->conectarAdo($sql);
        if($resultado->fields[0]>0){
            return 'inhabilitada';
        }
        $sql="DELETE FROM enc_pregunta_cna_evidencia WHERE fk_pregunta=".$_idPregunta;
        $resultado=$conDB->conectarAdo($sql);
        //var_dump($resultado->fields);
        if(!$resultado) { return false;}
        $sql="DELETE FROM enc_respuesta_pregunta WHERE fk_pregunta=".$_idPregunta;
        $resultado=$conDB->conectarAdo($sql);
        //var_dump($resultado->fields);
        if(!$resultado) { return false;}
        $sql="DELETE FROM enc_pregunta_cna_proceso WHERE fk_pregunta=".$_idPregunta;
        $resultado=$conDB->conectarAdo($sql);
        //var_dump($resultado->fields);
        if(!$resultado) { return false;}
        $sql="DELETE FROM enc_pregunta WHERE pk_pregunta=".$_idPregunta;
        $resultado=$conDB->conectarAdo($sql);
        //var_dump($resultado->fields);
        //die();
        return $resultado;
    }
    
    function getPreguntasEvidenciaProceso($_idProceso,$_idGrupo,$_idEvidencia){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        if($_idGrupo==1 || $_idGrupo==2 || $_idGrupo==4){
            //$sql='select pre.pk_pregunta, pre.texto from enc_pregunta as pre,enc_pregunta_cna_evidencia as preevi,enc_pregunta_cna_proceso as prepro where preevi.fk_evidencia='.$_idEvidencia.' and pre.pk_pregunta=preevi.fk_pregunta and prepro.fk_grupo_interes='.$_idGrupo.' and prepro.fk_proceso='.$_idProceso.' and prepro.institucional=0 and pre.pk_pregunta=prepro.fk_pregunta and pre.institucional=0';
            $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso." AND publicada=1 AND institucional=0";
            $idEncuesta=$conDB->conectarAdo($sql)->fields[0];
            $sql="SELECT pk_pregunta,texto FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=".$idEncuesta." AND fk_evidencia=".$_idEvidencia;
        }
        if($_idGrupo==3 || $_idGrupo==5 || $_idGrupo==6){
            $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
            $idProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
            //$sql='select pre.pk_pregunta, pre.texto from enc_pregunta as pre,enc_pregunta_cna_evidencia as preevi,enc_pregunta_cna_proceso as prepro where preevi.fk_evidencia='.$_idEvidencia.' and pre.pk_pregunta=preevi.fk_pregunta and prepro.fk_grupo_interes='.$_idGrupo.' and prepro.fk_proceso_institucional='.$idProcesoInstitucional.' and prepro.institucional=1 and pre.pk_pregunta=prepro.fk_pregunta and pre.institucional=1';
            $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$_idGrupo." AND publicada=1 AND institucional=1 AND fk_proceso_institucional=".$idProcesoInstitucional." AND fk_proceso is null";
            $idEncuesta=$conDB->conectarAdo($sql)->fields[0];
            $sql="SELECT pk_pregunta,texto FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=".$idEncuesta." AND fk_evidencia=".$_idEvidencia;
        }
        $resultado=$conDB->conectarAdo($sql);
        return $resultado;
    }
}
?>
