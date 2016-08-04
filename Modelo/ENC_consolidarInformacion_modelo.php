<?php   
class Consolidacion{
    public function ConsolidarInformacionEstudiantes($_idProceso){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        if($_idProceso!=-1 && $_idProceso!=null){
            $sql="SELECT fk_proceso_institucional,fk_sede,fk_programa FROM cna_proceso WHERE pk_proceso=".$_idProceso;
            $res=$conDB->conectarAdo($sql);
            $idProcesoInstitucional=$res->fields[0];
            $idSede=$res->fields[1];
            $idPrograma=$res->fields[2];
            echo "proceso insitucional: ";
            var_dump($idProcesoInstitucional);
            echo "</br>";
            echo "sede: ";
            var_dump($idSede);
            echo "</br>";
            echo "programa : ";
            var_dump($idPrograma);
            echo "</br>";
            $sql="SELECT fk_facultad FROM sad_programa WHERE pk_programa=".$idPrograma;
            $idFacultad=$conDB->conectarAdo($sql)->fields[0];
            echo "facultad : ";
            var_dump($idFacultad);
            echo "</br>";
            // Traemos todas las evidencias que estan activas para el modulo de fuentes primarias 
            // sin importar el grupo de interes.
            // traemos el fk de la evidencia, el fk del grupo de interes y el pk de la tabla
            $sql="SELECT fk_evidencia, fk_grupo_interes,pk_evidencia_grupo_interes FROM cna_evidencia_grupo_interes ";
            $sql.="WHERE fk_modulo=6 AND estado=1";
            $rsEvidencias=$conDB->conectarAdo($sql);   
            echo "evidencias modulo : ";
            echo "</br>";
            $countEvidencias=0;
            foreach($rsEvidencias as $evidencia){
                var_dump($rsEvidencias->fields);
                $countEvidencias++;
                echo "</br>";
            }
            echo 'cantidad evidencias:'.$countEvidencias;
            echo "</br>";
            $sql="SELECT fk_evidencia, fk_grupo_interes,pk_evidencia_grupo_interes FROM cna_evidencia_grupo_interes ";
            $sql.="WHERE fk_modulo=6 AND estado=1";
            $rsEvidencias=$conDB->conectarAdo($sql);   
            $control1=0;
            
            
            // Recorremos las evidencias para traer las preguntas que la evaluan
            foreach($rsEvidencias as $evidencia){
                echo "</br>";
                echo "control : ".$control1++.' - Evidencia:'.$evidencia['fk_evidencia'].' - Grupo:'.$evidencia['fk_grupo_interes'];
                echo "</br>";
                // traemos las preguntas que evaluan esa evidencia en el proceso especifico y 
                // el grupo de interes que ya habiamos traido con la evidencia
                //*** grupos interes por proceso {estudiantes,docentes,graduados}*/
                if($evidencia['fk_grupo_interes']==1 || $evidencia['fk_grupo_interes']==2 || $evidencia['fk_grupo_interes']==4){
                    
                    $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$evidencia['fk_grupo_interes']." AND fk_proceso=".$_idProceso." AND publicada=1 AND institucional=0";
                    $idEncuesta=$conDB->conectarAdo($sql)->fields[0];
                    $sql="SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=".$idEncuesta." AND fk_evidencia=".$evidencia['fk_evidencia'];
                    //$sql="SELECT pre.pk_pregunta FROM enc_pregunta_cna_evidencia as preevi, enc_pregunta_cna_proceso as prepro, enc_pregunta as pre";
                    //$sql.=" WHERE preevi.fk_evidencia=".$evidencia[0]." AND preevi.fk_pregunta=pre.pk_pregunta AND pre.estado=1 AND pre.pk_pregunta=prepro.fk_pregunta ";
                   // $sql.=" AND prepro.fk_grupo_interes=".$evidencia[1]." AND prepro.fk_proceso=".$_idProceso;
                }
                // traemos las preguntas que evaluan esta evidnecia segun el proceso insitucional enlazado al proceso
                // en especifico y el grupo de interes que ya se habia traido con la evidencia
                //** grupos de interes institucionales {directivos,empleadores,funcionarios} */
                if($evidencia['fk_grupo_interes']==3 || $evidencia['fk_grupo_interes']==5 || $evidencia['fk_grupo_interes']==6){
                    
                    $sql="SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=".$evidencia['fk_grupo_interes']." AND publicada=1 AND institucional=1 AND fk_proceso_institucional=".$idProcesoInstitucional." AND fk_proceso is null";
                    $idEncuesta=$conDB->conectarAdo($sql)->fields[0];
                    $sql="SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=".$idEncuesta.' AND fk_evidencia='.$evidencia['fk_evidencia'];
                    //$sql="SELECT pre.pk_pregunta FROM enc_pregunta_cna_evidencia as preevi, enc_pregunta_cna_proceso as prepro, enc_pregunta as pre";
                    //$sql.=" WHERE preevi.fk_evidencia=".$evidencia[0]." AND preevi.fk_pregunta=pre.pk_pregunta AND pre.estado=1 AND pre.pk_pregunta=prepro.fk_pregunta ";
                    //$sql.=" AND prepro.fk_grupo_interes=".$evidencia[1]." AND prepro.fk_proceso_institucional=".$idProcesoInstitucional." AND prepro.institucional=1";
                }
                //echo '<br>';
                //echo 'Sql:'.$sql;
                //echo '<br>';
                $rsPreguntas=$conDB->conectarAdo($sql); 
                $preguntasAcumulado=0;
                $contPreguntas=0;
                //echo "preguntas: ";
                //echo '<br>';
               // foreach($rsPreguntas as $pregunta){
                    //var_dump($pregunta);
                    //echo "<br>";
               // }
                $rsPreguntas=$conDB->conectarAdo($sql); 
                
                $pkdatosEncuesta=0;
                $pkdatosEncuestaArray=array();
                // seleccionamos pk de los datos de solucion de la encuesta 
                //*** grupos interes por proceso {estudiantes,docentes,graduados}*/
                if($evidencia['fk_grupo_interes']==1 || $evidencia['fk_grupo_interes']==2 || $evidencia['fk_grupo_interes']==4){
                    $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta";
                    $sql.=" WHERE fk_grupos_interes=".$evidencia['fk_grupo_interes']." AND fk_proceso=".$_idProceso." AND fk_proceso_institucional is null AND fk_sede=".$idSede;
                    $pkdatosEncuesta=$conDB->conectarAdo($sql)->fields[0]; 
                }
                // Directivos academicos
                if($evidencia['fk_grupo_interes']==3){
                    $sql="SELECT pk_datos_solucion_encuesta,fk_facultad,fk_programa,fk_sede,fk_cargo_directivo FROM enc_datos_solucion_encuesta ";
                    $sql.=" WHERE fk_grupos_interes=".$evidencia['fk_grupo_interes']." AND fk_proceso is null AND fk_proceso_institucional=".$idProcesoInstitucional." AND fk_sede=".$idSede;
                    $datosEncuesta=$conDB->conectarAdo($sql);
                    foreach($datosEncuesta as $d){
                        $sql="SELECT fk_alcance_cargo FROM enc_cargo_directivo WHERE pk_cargo_directivo=".$d['fk_cargo_directivo'];
                        $idAlcance=$conDB->conectarAdo($sql)->fields[0];
                        if($idAlcance==1){
                            $pkdatosEncuestaArray[]=$d['pk_datos_solucion_encuesta'];
                        }
                        if($idAlcance==2){
                            if($d['fk_facultad']==$idFacultad){
                                $pkdatosEncuestaArray[]=$d['pk_datos_solucion_encuesta'];
                            }
                        }
                        if($idAlcance==3){
                            if($d['fk_programa']==$idPrograma){
                                $pkdatosEncuestaArray[]=$d['pk_datos_solucion_encuesta'];
                            }
                        }
                        if($idAlcance==4){
                            if($d['fk_sede']==$idSede){
                                $pkdatosEncuestaArray[]=$d['pk_datos_solucion_encuesta'];
                            }
                        }
                    }
                }
                // Funcionarios administrativos
                if($evidencia['fk_grupo_interes']==5){
                    $sql="SELECT pk_datos_solucion_encuesta,fk_sede,fk_alcance_administrativo FROM enc_datos_solucion_encuesta ";
                    $sql.=" WHERE fk_grupos_interes=".$evidencia['fk_grupo_interes']." AND fk_proceso is null AND fk_proceso_institucional=".$idProcesoInstitucional." AND fk_sede=".$idSede;
                    $datosEncuesta=$conDB->conectarAdo($sql);
                    foreach($datosEncuesta as $d){
                        if($d[2]==2){
                            if($d[1]==$idSede){
                                $pkdatosEncuestaArray[]=$d[0];
                            }
                        }else{
                           $pkdatosEncuestaArray[]=$d[0]; 
                        }
                    }
                }
                // empleadores
                if($evidencia['fk_grupo_interes']==6){
                    $sql="SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta ";
                    $sql.=" WHERE fk_grupos_interes=".$evidencia['fk_grupo_interes']." AND fk_proceso is null AND fk_proceso_institucional=".$idProcesoInstitucional." AND fk_sede=".$idSede." AND fk_programa=".$idPrograma;
                    $datosEncuesta=$conDB->conectarAdo($sql);
                    $pkdatosEncuesta=$datosEncuesta->fields[0];
                }
                
                echo '<br>';
                echo 'datos Encuesta:'.
                var_dump($pkdatosEncuesta);
                echo '<br>';
                echo 'datos Encuesta array:';
                print_r($pkdatosEncuestaArray);
                echo '<br>';
                foreach($rsPreguntas as $pregunta){
                    $resultadoAcumulado=0;
                    if($pkdatosEncuesta!=null){
                        if($evidencia['fk_grupo_interes']==1 || $evidencia['fk_grupo_interes']==2 || $evidencia['fk_grupo_interes']==4 || $evidencia['fk_grupo_interes']==6){
                            $sql="SELECT count(solenc.fk_pregunta) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc WHERE solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=".$pkdatosEncuesta." AND solenc.fk_pregunta=".$pregunta['pk_pregunta'];
                            $cantEncuestas=$conDB->conectarAdo($sql)->fields[0];
                            echo '<br>';
                            echo 'Cantidad de encuestas:'.$cantEncuestas;
                            echo '<br>';
                            $sql="SELECT solenc.fk_pregunta,solenc.fk_respuesta_pregunta,respre.ponderacion,count(respre.ponderacion) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc,enc_respuesta_pregunta_solucion_encuesta as respre";
                            $sql.=" WHERE solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=".$pkdatosEncuesta." AND solenc.fk_pregunta=".$pregunta['pk_pregunta']." AND respre.pk_respuesta_pregunta=solenc.fk_respuesta_pregunta group by(respre.ponderacion)";
                            $rsDatosPonderar=$conDB->conectarAdo($sql);
                            //echo '<br>';
                           // echo 'sql:'.$sql;
                            //echo '<br>';
                            if($rsDatosPonderar!=null){
                                var_dump($rsDatosPonderar->fields);
                                foreach($rsDatosPonderar as $datos){
                                    $resultado=(($datos[3]/$cantEncuestas)*$datos[2]);
                                    $resultadoAcumulado+=$resultado;
                                }
                            }
                            $contPreguntas++;
                            $preguntasAcumulado+=$resultadoAcumulado;
                        }
                    }
                    if($pkdatosEncuestaArray!=array()){
                        if($evidencia['fk_grupo_interes']==5 || $evidencia['fk_grupo_interes']==3){
                            $cantEncuestas=0;
                            foreach($pkdatosEncuestaArray as $pkEncuesta){
                                echo $pkEncuesta."-".$pregunta['pk_pregunta']."//";
                                $sql="SELECT count(solenc.fk_pregunta) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc WHERE solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=".$pkEncuesta." AND solenc.fk_pregunta=".$pregunta['pk_pregunta'];
                                $cantEncuestas+=$conDB->conectarAdo($sql)->fields[0];
                            }
                            echo '<br>';
                            echo 'Cantidad de encuestas:'.$cantEncuestas;
                            echo '<br>';
                            $sql="SELECT solenc.fk_pregunta,solenc.fk_respuesta_pregunta,respre.ponderacion,count(respre.ponderacion) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc,enc_respuesta_pregunta_solucion_encuesta as respre";
                            $sql.=" WHERE ";
                            $sql_where=array();
                            $countSql=0;
                            foreach($pkdatosEncuestaArray as $pkEncuesta){
                                $sql_where[]="( solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=".$pkEncuesta." AND solenc.fk_pregunta=".$pregunta['pk_pregunta']." AND respre.pk_respuesta_pregunta=solenc.fk_respuesta_pregunta ) ";
                                $countSql++;
                            }
                            $countAux=0;
                            foreach($sql_where as $s){
                                $sql.=$s;
                                if($countAux<$countSql-1){
                                    $sql.=" OR ";
                                }
                                $countAux++;
                            }
                            $sql.=" group by(respre.ponderacion)";
                            //echo '<br>';
                            //echo 'sql:'.$sql;
                            //echo '<br>';
                            $rsDatosPonderar=$conDB->conectarAdo($sql);
                            if($rsDatosPonderar!=null){
                                var_dump($rsDatosPonderar->fields);
                                foreach($rsDatosPonderar as $datos){
                                    $resultado=(($datos[3]/$cantEncuestas)*$datos[2]);
                                    $resultadoAcumulado+=$resultado;
                                }
                            }
                            $contPreguntas++;
                            $preguntasAcumulado+=$resultadoAcumulado;
                        }
                    }
                    
                }
                echo "<br> preguntasAcumulado:".$preguntasAcumulado;
                echo "<br> contPreguntas:".$contPreguntas;
                if($contPreguntas!=0)
                    $r=round($preguntasAcumulado/$contPreguntas,2);
                else
                    $r=0;
                echo "<br>";
                echo "Resultado para evidencia ".$evidencia['fk_evidencia']." y grupo ".$evidencia['fk_grupo_interes']." = ".$r;
                echo "<br>";
                echo "<br>";
                //die();   
                $sql='SELECT pk_cna_resultados_evidencia FROM cna_resultados_evidencia WHERE fk_evidencia_grupo_interes='.$evidencia['pk_evidencia_grupo_interes'].' AND fk_proceso='.$_idProceso;
                $res=$conDB->conectarAdo($sql);
                var_dump($res->fields[0]);
                if($res->fields!=null && $res->fields[0]!=null){
                    $sql='UPDATE cna_resultados_evidencia SET ';
                    $sql.=' calificacion='.$r.',';
                    $sql.=' fk_evidencia_grupo_interes='.$evidencia['pk_evidencia_grupo_interes'].',';
                    $sql.=' fk_proceso='.$_idProceso;
                    $sql.=' WHERE pk_cna_resultados_evidencia='.$res->fields[0];
                    $res=$conDB->conectarAdo($sql);
                    var_dump($res);
                }else{
                    $sql="INSERT INTO cna_resultados_evidencia (calificacion,fk_evidencia_grupo_interes,fk_proceso)";
                    $sql.=" VALUES (".$r.",".$evidencia['pk_evidencia_grupo_interes'].",".$_idProceso.")";
                    $res=$conDB->conectarAdo($sql);
                    var_dump($res);
                }
                
            }
        }
    }
}
?>