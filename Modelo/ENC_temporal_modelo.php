<?php
class ProcesamientoTemporal{

    /*  */
    public function publicarEncuesta($_idProceso,$_idGrupo,$_idUnico){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();     
        $fecha=date("Y-m-d H:i:s");
        $pkEncuesta=-1;
        switch($_idGrupo){
            case 1: case 2: case 4:
                $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso." AND institucional=0";
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    $sql="INSERT INTO enc_encuesta(`fk_grupo_interes`,`fk_proceso`,`institucional`,`publicada`,`fecha_publicacion`,`id_aleatorio`)";
                    $sql.=" VALUES (".$_idGrupo.",".$_idProceso.",0,1,'".$fecha."','".$_idUnico."')";
                    $res=$conDB->conectarAdo($sql) or die("error ".$_idGrupo);
                    if($res==false){
                        return -1;
                    }else{
                        $sql="SELECT pk_encuesta FROM enc_encuesta where id_aleatorio='".$_idUnico."'";
                        $pkEncuesta=$conDB->conectarAdo($sql)->fields[0];
                    }
                }else{
                    $pkEncuesta=$res->fields[0];
                    $sql="UPDATE enc_encuesta SET fecha_publicacion='".$fecha."' WHERE pk_encuesta=".$pkEncuesta;
                    $conDB->conectarAdo($sql);
                }
                break;
            case 3: case 5: case 6:
                $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
                $pkProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
                $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso." AND fk_proceso_institucional=".$pkProcesoInstitucional." AND institucional=1";
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    $sql="INSERT INTO enc_encuesta(`fk_grupo_interes`,`fk_proceso`,`fk_proceso_institucional`,`institucional`,`publicada`,`fecha_publicacion`,`id_aleatorio`)";
                    $sql.=" VALUES (".$_idGrupo.",".$_idProceso.",".$pkProcesoInstitucional.",1,1,'".$fecha."','".$_idUnico."')";
                    $res=$conDB->conectarAdo($sql) or die("error ".$_idGrupo);
                    if($res==false){
                        return -1;
                    }else{
                        $sql="SELECT pk_encuesta FROM enc_encuesta where id_aleatorio='".$_idUnico."'";
                        $pkEncuesta=$conDB->conectarAdo($sql)->fields[0];
                    }
                }else{
                    $pkEncuesta=$res->fields[0];
                    $sql="UPDATE enc_encuesta SET fecha_publicacion ='".$fecha."' WHERE pk_encuesta=".$pkEncuesta;
                    $conDB->conectarAdo($sql);
                }
                break;
        }
        return $pkEncuesta;          
     }
     
      public function cancelarPublicarEncuesta($_idProceso,$_idGrupo){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="UPDATE `enc_encuesta` SET publicada=0 WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso;
        $res=$conDB->conectarAdo($sql);
        return $res;
     }
     
     public function copiarDatosEncuesta($_pregunta,$_respuestas,$_pkEvidencia,$_pkEncuesta){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        //$idAleatorio=Util::getCodigoAleatorio();
        
        $sql="SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE pk_banco_pregunta=".$_pregunta['pk_pregunta']." AND id_aleatorio='".$_pregunta['id_aleatorio']."' AND fk_encuesta=".$_pkEncuesta." AND fk_evidencia=".$_pkEvidencia;
        $pkPregunta=$conDB->conectarAdo($sql)->fields[0];
        $sql="DELETE FROM enc_respuesta_pregunta_solucion_encuesta WHERE fk_pregunta_solucion=".$pkPregunta;
        $res=$conDB->conectarAdo($sql);
        $sql="DELETE FROM enc_pregunta_solucion_encuesta WHERE id_aleatorio='".$_pregunta['id_aleatorio']."' AND pk_banco_pregunta=".$_pregunta['pk_pregunta']." AND pk_pregunta=".$pkPregunta;
        $res=$conDB->conectarAdo($sql);
        
        $ideal='Null';
        if($_pregunta['ideal']=='' || $_pregunta['ideal']==null){
            $ideal='Null';
        }else{
            $ideal=$_pregunta['ideal'];
        }
        $sql="INSERT INTO enc_pregunta_solucion_encuesta (pk_banco_pregunta,texto,fk_encuesta,fk_evidencia,ideal,id_aleatorio,institucional) ";
        $sql.="VALUES (".$_pregunta['pk_pregunta'].",'".$_pregunta['texto']."',".$_pkEncuesta.",".$_pkEvidencia.",".$ideal.",'".$_pregunta['id_aleatorio']."',".$_pregunta['institucional'].");";
        $res=$conDB->conectarAdo($sql);
        $sql="SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE pk_banco_pregunta=".$_pregunta['pk_pregunta']." AND id_aleatorio='".$_pregunta['id_aleatorio']."' AND fk_encuesta=".$_pkEncuesta." AND fk_evidencia=".$_pkEvidencia;
        $pkPregunta=$conDB->conectarAdo($sql)->fields[0];
        foreach($_respuestas as $respuesta){
            $sql="INSERT INTO enc_respuesta_pregunta_solucion_encuesta (texto,fk_pregunta_solucion,ponderacion) ";
            $sql.="VALUES ('".$respuesta['texto']."',".$pkPregunta.",".$respuesta['ponderacion'].")";
            $res=$conDB->conectarAdo($sql);
        }
     }
}

?>