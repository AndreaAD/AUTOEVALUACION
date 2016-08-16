<?php
class Encuesta{
    
     /*public function getEstadoEncuesta($_idProceso,$_idGrupoInteres){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT publicada FROM enc_encuesta WHERE fk_proceso=".$_idProceso." AND fk_grupo_interes=".$_idGrupoInteres;
        $rsDatos=$conDB->conectarAdo($sql);
        if($rsDatos->RecordCount()==0){
            $sql="INSERT INTO enc_encuesta(`fk_grupo_interes`, `fk_proceso`, `publicada`) VALUES (".$_idGrupoInteres.",".$_idProceso.",0)";
            $conDB->conectarAdo($sql);
            $sql="SELECT publicada FROM enc_encuesta WHERE fk_proceso=".$_idProceso." AND fk_grupo_interes=".$_idGrupoInteres;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
        }else{
            return $rsDatos;
        }
     }*/
     
     public function getDatosEncuesta($_idGrupo){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT titulo,descripcion,instrucciones FROM `enc_datos_encuesta` WHERE fk_grupo_interes=".$_idGrupo;
        $res=$conDB->conectarAdo($sql);
        if($res->RecordCount()==0){
            $sql="INSERT INTO `enc_datos_encuesta`(`titulo`, `descripcion`, `instrucciones`,`fk_grupo_interes`)";
            $sql.="VALUES ('','','',".$_idGrupo.")";
            $res=$conDB->conectarAdo($sql);
            $sql="SELECT titulo,descripcion,instrucciones FROM `enc_datos_encuesta` WHERE fk_grupo_interes=".$_idGrupo;
            $res=$conDB->conectarAdo($sql);
        }
        return $res;
     }
     
     public function guardarDatosEncuesta($_idGrupo,$_titulo,$_descipcion,$_instrucciones){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="UPDATE `enc_datos_encuesta` SET `titulo`='".$_titulo."',`descripcion`='".$_descipcion."',`instrucciones`='".$_instrucciones."' WHERE fk_grupo_interes=".$_idGrupo;
        $res=$conDB->conectarAdo($sql);
        return $res;
    }
     
     /*public function publicarEncuesta($_idProceso,$_idGrupo,$_idprocesoInstitucional){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="UPDATE `enc_encuesta` SET publicada=1 WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso;
        $res=$conDB->conectarAdo($sql);
        return $res;
     }*/
     
    /* public function cancelarPublicarEncuesta($_idProceso,$_idGrupo){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="UPDATE `enc_encuesta` SET publicada=0 WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso;
        $res=$conDB->conectarAdo($sql);
        return $res;
     }*/
     
    public function existeEncuesta($_idProceso,$_idGrupoInteres){
        if($_idProceso!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            
            $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$_idGrupoInteres." AND fk_proceso=".$_idProceso." AND publicada=1 AND institucional=0";
           //echo $sql;die();
            $res=$conDB->conectarAdo($sql);
            //var_dump($res);
            //die();
            if(!$res || $res->RecordCount()==0){
                return -1; 
            }else{
                return $res->fields[0];
            }
        }else{
            return -1;   
        }
    }
    
    public function existeEncuestaInstitucional($_idGrupoInteres){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        $sql="SELECT pk_proceso_institucional FROM cna_proceso_institucional WHERE estado=1 LIMIT 1";
        $pkProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
        $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$_idGrupoInteres." AND publicada=1 AND institucional=1 AND fk_proceso_institucional=".$pkProcesoInstitucional." AND fk_proceso is null";
        $res=$conDB->conectarAdo($sql);
        if(!$res || $res->RecordCount()==0){
            return -1;
        }else{
            return $res->fields[0];
        }
    }
    
    
    /** funcion de guardar */
    public function guardarRespuestasEncuesta($_idProceso,$_idGrupo,$_idProgramaFacultad,$_idPrograma,$_idSede,$_alcanceAdmin,$_cargoDirec,$_idPreguntas,$_idRespuestas,$_tipo,$_listaProgramas){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        
        //$resultado=Array();
        switch ($_idGrupo){
            //estudiantes y docentes
            case 1: case 2: case 4:
                //$sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_proceso=".$_idProceso." AND fk_grupos_interes=".$_idGrupo." AND fk_facultad=".$_idfacultad." AND fk_programa=".$_idPrograma." AND fk_sede=".$_idSede." AND fk_alcance_administrativo=".$_alcanceAdmin." AND fk_cargo_directivo=".$_cargoDirec;
                $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_proceso=".$_idProceso." AND fk_grupos_interes=".$_idGrupo." AND fk_programa=".$_idPrograma." AND fk_sede=".$_idSede;
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    //$sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`, `fk_facultad`, `fk_programa`, `fk_sede`, `fk_alcance_administrativo`, `fk_cargo_directivo` , `fk_proceso`) VALUES (".$_idGrupo.",".$_idfacultad.",".$_idPrograma.",".$_idSede.",".$_alcanceAdmin.",".$_cargoDirec.",".$_idProceso.")";
                    $sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`,`fk_programa`, `fk_sede`, `fk_proceso`)"; 
                    $sql.="VALUES (".$_idGrupo.",".$_idPrograma.",".$_idSede.",".$_idProceso.")";
                    $res=$conDB->conectarAdo($sql);
                    //return $res;
                    if($res==false){
                        return false;
                    }else{
                        //$sql="SELECT pk_datos_solucion_encuesta FROM `enc_datos_solucion_encuesta` WHERE fk_proceso=".$_idProceso." AND fk_grupos_interes=".$_idGrupo." AND fk_facultad=".$_idfacultad." AND fk_programa=".$_idPrograma." AND fk_sede=".$_idSede." AND fk_alcance_administrativo=".$_alcanceAdmin." AND fk_cargo_directivo=".$_cargoDirec;
                        $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_proceso=".$_idProceso." AND fk_grupos_interes=".$_idGrupo." AND fk_programa=".$_idPrograma." AND fk_sede=".$_idSede;
                        $res=$conDB->conectarAdo($sql);
                        if($res->RecordCount()==0){
                            return false;
                        }
                    }
                }
                $fecha=date("Y-m-d H:i:s");
                $sql="INSERT INTO enc_datos_solucion_solucion_encuesta (`fecha`,`fk_datos_solucion_encuesta`) VALUES ('".$fecha."',".$res->fields[0].")";
                if($conDB->conectarAdo($sql)===false){
                    return false;
                }
                $sql="SELECT pk_datos_solucion_solucion_encuesta FROM enc_datos_solucion_solucion_encuesta WHERE fecha='".$fecha."' AND fk_datos_solucion_encuesta=".$res->fields[0];
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    return false;
                }
                $fk_datos_solucion=$res->fields[0];
                foreach($_idPreguntas as $pregunta){
                    $sql="INSERT INTO `enc_solucion_encuesta`(`fk_datos_solucion_solucion_encuesta`, `fk_pregunta`, `fk_respuesta_pregunta`)";
                    $sql.="VALUES (".$fk_datos_solucion.",".$pregunta.",".$_idRespuestas[$pregunta].")";
                    if($conDB->conectarAdo($sql)==false){
                        return false;
                    }
                }
                return true;          
                break;
            //directivos academicos
            case 3:
                $sql="SELECT pk_proceso_institucional FROM cna_proceso_institucional WHERE estado=1 LIMIT 1";
                $pkProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
                //tipo 1 es programa
                if($_tipo==1){
                    $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_cargo_directivo=".$_cargoDirec." AND fk_programa=".$_idProgramaFacultad." AND fk_proceso_institucional=".$pkProcesoInstitucional;
                }
                //tipo 2 es facultad
                if($_tipo==2){
                    $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_cargo_directivo=".$_cargoDirec." AND fk_facultad=".$_idProgramaFacultad." AND fk_proceso_institucional=".$pkProcesoInstitucional;
                }
                if($_tipo==-1){
                    $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_cargo_directivo=".$_cargoDirec." AND fk_facultad is null AND fk_programa is null AND fk_proceso_institucional=".$pkProcesoInstitucional;
                }
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    //$sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`, `fk_facultad`, `fk_programa`, `fk_sede`, `fk_alcance_administrativo`, `fk_cargo_directivo` , `fk_proceso`) VALUES (".$_idGrupo.",".$_idfacultad.",".$_idPrograma.",".$_idSede.",".$_alcanceAdmin.",".$_cargoDirec.",".$_idProceso.")";
                    if($_tipo==1){
                        $sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`,`fk_sede`, `fk_cargo_directivo`,`fk_programa`,fk_proceso_institucional)"; 
                        $sql.="VALUES (".$_idGrupo.",".$_idSede.",".$_cargoDirec.",".$_idProgramaFacultad.",".$pkProcesoInstitucional.")";
                    }
                    if($_tipo==2){
                        $sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`,`fk_sede`, `fk_cargo_directivo`,`fk_facultad`,fk_proceso_institucional)"; 
                        $sql.="VALUES (".$_idGrupo.",".$_idSede.",".$_cargoDirec.",".$_idProgramaFacultad.",".$pkProcesoInstitucional.")";
                    }
                    if($_tipo==-1){
                        $sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`,`fk_sede`, `fk_cargo_directivo`,fk_proceso_institucional)"; 
                        $sql.="VALUES (".$_idGrupo.",".$_idSede.",".$_cargoDirec.",".$pkProcesoInstitucional.")";
                    }
                    $res=$conDB->conectarAdo($sql);
                    //return $res;
                    if($res==false){
                        return false;
                    }else{
                        //$sql="SELECT pk_datos_solucion_encuesta FROM `enc_datos_solucion_encuesta` WHERE fk_proceso=".$_idProceso." AND fk_grupos_interes=".$_idGrupo." AND fk_facultad=".$_idfacultad." AND fk_programa=".$_idPrograma." AND fk_sede=".$_idSede." AND fk_alcance_administrativo=".$_alcanceAdmin." AND fk_cargo_directivo=".$_cargoDirec;
                        if($_tipo==1){
                            $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_cargo_directivo=".$_cargoDirec." AND fk_programa=".$_idProgramaFacultad;
                        }
                        //tipo 2 es facultad
                        if($_tipo==2){
                            $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_cargo_directivo=".$_cargoDirec." AND fk_facultad=".$_idProgramaFacultad;
                        }
                        if($_tipo==-1){
                            $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_cargo_directivo=".$_cargoDirec." AND fk_facultad is null AND fk_programa is null AND fk_proceso_institucional=".$pkProcesoInstitucional;
                        }
                        $res=$conDB->conectarAdo($sql);
                        if($res->RecordCount()==0){
                            return false;
                        }
                    }
                }
                $fecha=date("Y-m-d H:i:s");
                $sql="INSERT INTO enc_datos_solucion_solucion_encuesta (`fecha`,`fk_datos_solucion_encuesta`) VALUES ('".$fecha."',".$res->fields[0].")";
                if($conDB->conectarAdo($sql)===false){
                    return false;
                }
                $sql="SELECT pk_datos_solucion_solucion_encuesta FROM enc_datos_solucion_solucion_encuesta WHERE fecha='".$fecha."' AND fk_datos_solucion_encuesta=".$res->fields[0];
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    return false;
                }
                $fk_datos_solucion=$res->fields[0];
                foreach($_idPreguntas as $pregunta){
                    $sql="INSERT INTO `enc_solucion_encuesta`(`fk_datos_solucion_solucion_encuesta`, `fk_pregunta`, `fk_respuesta_pregunta`)";
                    $sql.="VALUES (".$fk_datos_solucion.",".$pregunta.",".$_idRespuestas[$pregunta].")";
                    if($conDB->conectarAdo($sql)==false){
                        return false;
                    }
                }
                return true;
                break;
            //Funcionarios administrativos
            case 5:
                $sql="SELECT pk_proceso_institucional FROM cna_proceso_institucional WHERE estado=1 LIMIT 1";
                $pkProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
                //$sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_proceso=".$_idProceso." AND fk_grupos_interes=".$_idGrupo." AND fk_facultad=".$_idfacultad." AND fk_programa=".$_idPrograma." AND fk_sede=".$_idSede." AND fk_alcance_administrativo=".$_alcanceAdmin." AND fk_cargo_directivo=".$_cargoDirec;
                $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_alcance_administrativo=".$_alcanceAdmin." AND fk_proceso_institucional=".$pkProcesoInstitucional;
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    //$sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`, `fk_facultad`, `fk_programa`, `fk_sede`, `fk_alcance_administrativo`, `fk_cargo_directivo` , `fk_proceso`) VALUES (".$_idGrupo.",".$_idfacultad.",".$_idPrograma.",".$_idSede.",".$_alcanceAdmin.",".$_cargoDirec.",".$_idProceso.")";
                    $sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`,`fk_sede`, `fk_alcance_administrativo`, fk_proceso_institucional)"; 
                    $sql.="VALUES (".$_idGrupo.",".$_idSede.",".$_alcanceAdmin.",".$pkProcesoInstitucional.")";
                    $res=$conDB->conectarAdo($sql);
                    //return $res;
                    if($res==false){
                        return false;
                    }else{
                        //$sql="SELECT pk_datos_solucion_encuesta FROM `enc_datos_solucion_encuesta` WHERE fk_proceso=".$_idProceso." AND fk_grupos_interes=".$_idGrupo." AND fk_facultad=".$_idfacultad." AND fk_programa=".$_idPrograma." AND fk_sede=".$_idSede." AND fk_alcance_administrativo=".$_alcanceAdmin." AND fk_cargo_directivo=".$_cargoDirec;
                        $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE  fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_alcance_administrativo=".$_alcanceAdmin." AND fk_proceso_institucional=".$pkProcesoInstitucional;
                        $res=$conDB->conectarAdo($sql);
                        if($res->RecordCount()==0){
                            return false;
                        }
                    }
                }
                $fecha=date("Y-m-d H:i:s");
                $sql="INSERT INTO enc_datos_solucion_solucion_encuesta (`fecha`,`fk_datos_solucion_encuesta`) VALUES ('".$fecha."',".$res->fields[0].")";
                if($conDB->conectarAdo($sql)===false){
                    return false;
                }
                $sql="SELECT pk_datos_solucion_solucion_encuesta FROM enc_datos_solucion_solucion_encuesta WHERE fecha='".$fecha."' AND fk_datos_solucion_encuesta=".$res->fields[0];
                $res=$conDB->conectarAdo($sql);
                if($res->RecordCount()==0){
                    return false;
                }
                $fk_datos_solucion=$res->fields[0];
                foreach($_idPreguntas as $pregunta){
                    $sql="INSERT INTO `enc_solucion_encuesta`(`fk_datos_solucion_solucion_encuesta`, `fk_pregunta`, `fk_respuesta_pregunta`)";
                    $sql.="VALUES (".$fk_datos_solucion.",".$pregunta.",".$_idRespuestas[$pregunta].")";
                    if($conDB->conectarAdo($sql)==false){
                        return false;
                    }
                }
                return true;          
                break;
            // empleadores, lideres y representantes de instituciones
            case 6:
                foreach($_listaProgramas as $programa){
                    $sql="SELECT pk_proceso_institucional FROM cna_proceso_institucional WHERE estado=1 LIMIT 1";
                    $pkProcesoInstitucional=$conDB->conectarAdo($sql)->fields[0];
                    $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_programa=".$programa." AND fk_proceso_institucional=".$pkProcesoInstitucional;
                    $res=$conDB->conectarAdo($sql); 
                    if($res->RecordCount()==0){
                        $sql="INSERT INTO enc_datos_solucion_encuesta (`fk_grupos_interes`,`fk_sede`, `fk_programa`, fk_proceso_institucional)"; 
                        $sql.="VALUES (".$_idGrupo.",".$_idSede.",".$programa.",".$pkProcesoInstitucional.")";
                        $res=$conDB->conectarAdo($sql);
                        if($res==false){
                            return false;
                        }else{
                            $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta WHERE fk_grupos_interes=".$_idGrupo." AND fk_sede=".$_idSede." AND fk_programa=".$programa." AND fk_proceso_institucional=".$pkProcesoInstitucional;
                            $res=$conDB->conectarAdo($sql);
                            if($res->RecordCount()==0){
                                return false;
                            }
                        }
                    }
                    $fecha=date("Y-m-d H:i:s");
                    $sql="INSERT INTO enc_datos_solucion_solucion_encuesta (`fecha`,`fk_datos_solucion_encuesta`) VALUES ('".$fecha."',".$res->fields[0].")";
                    if($conDB->conectarAdo($sql)===false){
                        return false;
                    }
                    $sql="SELECT pk_datos_solucion_solucion_encuesta FROM enc_datos_solucion_solucion_encuesta WHERE fecha='".$fecha."' AND fk_datos_solucion_encuesta=".$res->fields[0];
                    $res=$conDB->conectarAdo($sql);
                    if($res->RecordCount()==0){
                        return false;
                    }
                    $fk_datos_solucion=$res->fields[0];
                    foreach($_idPreguntas as $pregunta){
                        $sql="INSERT INTO `enc_solucion_encuesta`(`fk_datos_solucion_solucion_encuesta`, `fk_pregunta`, `fk_respuesta_pregunta`)";
                        $sql.="VALUES (".$fk_datos_solucion.",".$pregunta.",".$_idRespuestas[$pregunta].")";
                        if($conDB->conectarAdo($sql)==false){
                            return false;
                        }
                    }
                }
                return true;
                break;
        }
    }
}
?>