<?php

class Consolidacion {

    public function CNA_Factor() {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT * FROM cna_factor";
        $res = $conDB->conectarAdo($sql);
        return $res;
    }
    public function CNA_Factor_Caracteristica($pk_factor) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        c.pk_caracteristica
                FROM
                        cna_caracteristica c
                JOIN cna_factor f ON f.pk_factor = c.fk_factor
                WHERE
                        f.pk_factor = {$pk_factor}";
        $res = $conDB->conectarAdo($sql);
        return $res;
    }
     public function CNA_Factor_Ponderacion_Proceso($pk_factor, $pk_proceso) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                    ponderacion_porcentual
                FROM
                    cna_proceso_ponderacion
                WHERE
                    fk_proceso = {$pk_proceso} AND
                    fk_factor = {$pk_factor}";
        $res = $conDB->conectarAdo($sql);
        return $res->fields['ponderacion_porcentual'];
    }

    public function Encuestas_Proceso($_idProceso) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT * FROM cna_proceso WHERE pk_proceso=" . $_idProceso;
        $res = $conDB->conectarAdo($sql);
        return $res;
    }

    public function Agregar_ponderacion_proceso($proceso, $factor = null, $caracteristica = null, $aspecto = null, $evidencia = null, $poderacion) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        if ($factor == null) {
            if ($caracteristica == null) {
                if ($aspecto == null) {
                    $sql = "INSERT INTO cna_proceso_ponderacion (fk_proceso,fk_evidencia,ponderacion_porcentual) VALUES ({$proceso},{$evidencia},{$poderacion})";
                } else {
                    $sql = "INSERT INTO cna_proceso_ponderacion (fk_proceso,fk_aspecto,ponderacion_porcentual) VALUES ({$proceso}, {$aspecto},{$poderacion})";
                    //echo $sql.'<br>';
                }
            } else {
                $sql = "INSERT INTO cna_proceso_ponderacion (fk_proceso,fk_caracteristica,ponderacion_porcentual) VALUES ({$proceso}, {$caracteristica},{$poderacion})";
            }
        } else {
            $sql = "INSERT INTO cna_proceso_ponderacion (fk_proceso,fk_factor,ponderacion_porcentual) VALUES ({$proceso}, {$factor},{$poderacion})";
        }
       // echo $sql.'<br>';
        $res = $conDB->conectarAdo($sql);
    }

    public function Cantidad_elementos_faltantes($fk_buscar, $pk_buscar, $pk_referencia = null, $id_referencia = null,$fk_proceso) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        COUNT( DISTINCT $pk_buscar) AS cantidad_faltante
                FROM
                        cna_factor factor
                JOIN cna_caracteristica caracteristica ON caracteristica.fk_factor = factor.pk_factor
                JOIN cna_aspecto aspecto ON aspecto.fk_caracteristica = caracteristica.pk_caracteristica
                JOIN cna_evidencia evidencia ON evidencia.fk_aspecto = aspecto.pk_aspecto
                WHERE ";
        if ($pk_referencia != null) {
            $sql.="$pk_referencia = '{$id_referencia}' AND ";
        }
        $sql.="$pk_buscar NOT IN (
                                SELECT
                                        $fk_buscar
                                FROM
                                        cna_proceso_ponderacion
                                WHERE
                                        fk_proceso = {$fk_proceso} AND $fk_buscar IS NOT NULL
                        )";
        $res = $conDB->conectarAdo($sql);
        return $res->fields[0]['cantidad_faltante'];
    }

    public function Cantidad_Porcentual_Existente($fk_buscar, $pk_buscar, $pk_referencia = null, $id_referencia = null, $fk_proceso) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        SUM(ponderacion_porcentual) AS valores_existente
                FROM
                        cna_proceso_ponderacion
                WHERE
                    fk_proceso = {$fk_proceso} AND
                        $fk_buscar IN (
                                SELECT
                                        $pk_buscar
                                FROM
                                        cna_factor factor
                                JOIN cna_caracteristica caracteristica ON caracteristica.fk_factor = factor.pk_factor
                                JOIN cna_aspecto aspecto ON aspecto.fk_caracteristica = caracteristica.pk_caracteristica
                                JOIN cna_evidencia evidencia ON evidencia.fk_aspecto = aspecto.pk_aspecto";
        if ($pk_referencia != null) {
            $sql.=" WHERE
                                        $pk_referencia = '{$id_referencia}')";
        } else {
            $sql.=")";
        }        
        $res = $conDB->conectarAdo($sql);
        return $res->fields['valores_existente'];
    }

    public function Cantidad_Elementos_CNA($id_elemento, $elemento) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        COUNT({$elemento}) cantidad_elementos
                FROM
                        cna_factor factor
                JOIN cna_caracteristica caracteristica ON caracteristica.fk_factor = factor.pk_factor
                JOIN cna_aspecto aspecto ON aspecto.fk_caracteristica = caracteristica.pk_caracteristica
                JOIN cna_evidencia evidencia ON evidencia.fk_aspecto = aspecto.pk_aspecto
                WHERE
                        {$elemento} = '{$id_elemento}'";
        $res = $conDB->conectarAdo($sql);
        return $res->fields['valor_evidencia'];
    }

    public function Valor_PonderacionEvidencia_Automatica($id_aspecto) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        1 / COUNT(pk_evidencia) as valor_evidencia
                FROM
                        cna_evidencia evidencia
                JOIN cna_aspecto aspecto ON aspecto.pk_aspecto = evidencia.fk_aspecto
                WHERE
                        aspecto.pk_aspecto = '{$id_aspecto}'";
        $res = $conDB->conectarAdo($sql);
        return $res->fields['valor_evidencia'];
    }

    public function Valor_PonderacionAspecto_Automatica($id_caracteristica) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        1 / COUNT(pk_aspecto) AS valor_aspecto
                FROM
                        cna_caracteristica caracteristica
                JOIN cna_aspecto aspecto ON aspecto.fk_caracteristica = caracteristica.pk_caracteristica
                WHERE
                        caracteristica.pk_caracteristica = '{$id_caracteristica}'";
        $res = $conDB->conectarAdo($sql);
        return $res->fields['valor_aspecto'];
    }

    public function Valor_PonderacionCaracteristica_Automatica($id_factor) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        1 / COUNT(pk_caracteristica) AS valor_caracteristica
                FROM
                        cna_caracteristica caracteristica
                JOIN cna_factor factor ON factor.pk_factor = caracteristica.fk_factor
                WHERE
                        factor.pk_factor = '{$id_factor}'";
        $res = $conDB->conectarAdo($sql);
        return $res->fields['valor_caracteristica'];
    }

    public function Valor_PonderacionFactor_Automatica() {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        1 / COUNT(pk_factor) AS valor_factor
                FROM
                        cna_factor";

        $res = $conDB->conectarAdo($sql);
        return $res->fields['valor_factor'];
    }

    public function Obtener_ElementoCNA_Ponderados($elemento,$llave,$fk_proceso) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        factor.pk_factor, caracteristica.pk_caracteristica, aspecto.pk_aspecto, evidencia.pk_evidencia
                FROM
                    cna_factor factor
                JOIN cna_caracteristica caracteristica ON caracteristica.fk_factor = factor.pk_factor
                JOIN cna_aspecto aspecto ON aspecto.fk_caracteristica = caracteristica.pk_caracteristica
                JOIN cna_evidencia evidencia ON evidencia.fk_aspecto = aspecto.pk_aspecto
                WHERE
                    {$elemento} IN (
                            SELECT
                                {$llave}
                            FROM
                                cna_proceso_ponderacion cpp
                            WHERE 
                                fk_proceso = {$fk_proceso}
                    )
                GROUP BY
                         {$elemento}";
                        
        $res = $conDB->conectarAdo($sql);
        return $res;
    }

    public function Obtener_ElementoCNA_Faltantes($elemento, $llave, $fk_proceso, $agrupado = true) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        factor.pk_factor,
                        caracteristica.pk_caracteristica,
                        aspecto.pk_aspecto,
                        evidencia.pk_evidencia
                FROM
                        cna_factor factor
                JOIN cna_caracteristica caracteristica ON caracteristica.fk_factor = factor.pk_factor
                JOIN cna_aspecto aspecto ON aspecto.fk_caracteristica = caracteristica.pk_caracteristica
                JOIN cna_evidencia evidencia ON evidencia.fk_aspecto = aspecto.pk_aspecto
                WHERE
                        {$elemento} NOT IN (
                                SELECT
                                        {$llave}
                                FROM
                                        cna_proceso_ponderacion
                                        WHERE {$llave} IS NOT NULL
                                        AND fk_proceso = {$fk_proceso}                 
                        )";
        if ($agrupado) {
            $sql.=" GROUP BY {$elemento}";
        }
        $res = $conDB->conectarAdo($sql);
        return $res;
    }

    public function Aspectos_Encuesta($id_proceso, $grupo) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                    cna.fk_caracteristica,
                    cna.fk_aspecto,
                    cna.fk_evidencia
                FROM
                        enc_pregunta_cna_evidencia cna
                JOIN enc_pregunta pregunta ON pregunta.pk_pregunta = cna.fk_pregunta
                JOIN view_soluciones_encuestas solucion ON solucion.pk_banco_pregunta = pregunta.pk_pregunta
                WHERE solucion.fk_proceso = '{$id_proceso}' 
                GROUP BY
                        {$grupo}";
        $res = $conDB->conectarAdo($sql);
        return $res;
    }

    public function Preguntas_CNA($id_caracteristica = null, $id_aspecto = null, $id_evidencia = null) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        if ($id_aspecto != null) {
            $where = "cna.fk_aspecto ='{$id_aspecto}'";
        }
        if ($id_caracteristica != null) {
            $where = "cna.fk_caracteristica ='{$id_caracteristica}'";
        }
        if ($id_evidencia != null) {
            $where = "cna.fk_evidencia ='{$id_evidencia}'";
        }
        $sql = "SELECT
                        pregunta.pk_pregunta
                FROM
                        enc_pregunta_cna_evidencia cna
                JOIN enc_pregunta pregunta ON pregunta.pk_pregunta = cna.fk_pregunta
                JOIN view_soluciones_encuestas solucion ON solucion.pk_banco_pregunta = pregunta.pk_pregunta
                WHERE {$where}
                GROUP BY pregunta.pk_pregunta";
        $res = $conDB->conectarAdo($sql);
        return $res;
    }

    public function Promedio_Ponderacion_Pregunta($id_pregunta) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql_2 = "SELECT
                        pk_pregunta,
                        AVG(ponderacion) as promedio_ponderacion
                FROM
                        view_soluciones_encuestas solucion
                WHERE
                        pk_banco_pregunta = '{$id_pregunta}'
                GROUP BY
                        solucion.pk_pregunta";
        // echo $sql_2;die(); 
        $res = $conDB->conectarAdo($sql_2);
        return $res->fields['promedio_ponderacion'];
    }

    public function Maximo_Ponderacion_Pregunta($id_pregunta) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        MAX(ponderacion.ponderacion) as maximo_poderacion
                FROM
                        enc_pregunta pregunta
                JOIN enc_respuesta_pregunta respuesta ON respuesta.fk_pregunta = pregunta.pk_pregunta
                JOIN respuesta_ponderacion ponderacion ON ponderacion.pk_respuesta_ponderacion = respuesta.fk_respuesta_ponderacion
                WHERE pregunta.pk_pregunta = '{$id_pregunta}'";
        //echo $sql;die();
        $res = $conDB->conectarAdo($sql);
        return $res->fields['maximo_poderacion'];
    }

    public function ConsolidarInformacionEstudiantes($_idProceso) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        if ($_idProceso != -1 && $_idProceso != null) {
            $sql = "SELECT fk_proceso_institucional,fk_sede,fk_programa FROM cna_proceso WHERE pk_proceso=" . $_idProceso;
            $res = $conDB->conectarAdo($sql);
            $idProcesoInstitucional = $res->fields[0];
            $idSede = $res->fields[1];
            $idPrograma = $res->fields[2];
            echo "proceso insitucional: ";
            var_dump($idProcesoInstitucional);
            echo "</br>";
            echo "sede: ";
            var_dump($idSede);
            echo "</br>";
            echo "programa : ";
            var_dump($idPrograma);
            echo "</br>";
            $sql = "SELECT fk_facultad FROM sad_programa WHERE pk_programa=" . $idPrograma;
            $idFacultad = $conDB->conectarAdo($sql)->fields[0];
            echo "facultad : ";
            var_dump($idFacultad);
            echo "</br>";
            // Traemos todas las evidencias que estan activas para el modulo de fuentes primarias 
            // sin importar el grupo de interes.
            // traemos el fk de la evidencia, el fk del grupo de interes y el pk de la tabla
            $sql = "SELECT fk_evidencia, fk_grupo_interes,pk_evidencia_grupo_interes FROM cna_evidencia_grupo_interes ";
            $sql.="WHERE fk_modulo=6 AND estado=1";
            $rsEvidencias = $conDB->conectarAdo($sql);
            echo "evidencias modulo : ";
            echo "</br>";
            $countEvidencias = 0;
            foreach ($rsEvidencias as $evidencia) {
                var_dump($rsEvidencias->fields);
                $countEvidencias++;
                echo "</br>";
            }
            echo 'cantidad evidencias:' . $countEvidencias;
            echo "</br>";
            $sql = "SELECT fk_evidencia, fk_grupo_interes,pk_evidencia_grupo_interes FROM cna_evidencia_grupo_interes ";
            $sql.="WHERE fk_modulo=6 AND estado=1";
            $rsEvidencias = $conDB->conectarAdo($sql);
            $control1 = 0;


            // Recorremos las evidencias para traer las preguntas que la evaluan
            foreach ($rsEvidencias as $evidencia) {
                echo "</br>";
                echo "control : " . $control1++ . ' - Evidencia:' . $evidencia['fk_evidencia'] . ' - Grupo:' . $evidencia['fk_grupo_interes'];
                echo "</br>";
                // traemos las preguntas que evaluan esa evidencia en el proceso especifico y 
                // el grupo de interes que ya habiamos traido con la evidencia
                //*** grupos interes por proceso {estudiantes,docentes,graduados}*/
                if ($evidencia['fk_grupo_interes'] == 1 || $evidencia['fk_grupo_interes'] == 2 || $evidencia['fk_grupo_interes'] == 4) {

                    $sql = "SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=" . $evidencia['fk_grupo_interes'] . " AND fk_proceso=" . $_idProceso . " AND publicada=1 AND institucional=0";
                    $idEncuesta = $conDB->conectarAdo($sql)->fields[0];
                    $sql = "SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=" . $idEncuesta . " AND fk_evidencia=" . $evidencia['fk_evidencia'];
                    //$sql="SELECT pre.pk_pregunta FROM enc_pregunta_cna_evidencia as preevi, enc_pregunta_cna_proceso as prepro, enc_pregunta as pre";
                    //$sql.=" WHERE preevi.fk_evidencia=".$evidencia[0]." AND preevi.fk_pregunta=pre.pk_pregunta AND pre.estado=1 AND pre.pk_pregunta=prepro.fk_pregunta ";
                    // $sql.=" AND prepro.fk_grupo_interes=".$evidencia[1]." AND prepro.fk_proceso=".$_idProceso;
                }
                // traemos las preguntas que evaluan esta evidnecia segun el proceso insitucional enlazado al proceso
                // en especifico y el grupo de interes que ya se habia traido con la evidencia
                //** grupos de interes institucionales {directivos,empleadores,funcionarios} */
                if ($evidencia['fk_grupo_interes'] == 3 || $evidencia['fk_grupo_interes'] == 5 || $evidencia['fk_grupo_interes'] == 6) {

                    $sql = "SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=" . $evidencia['fk_grupo_interes'] . " AND publicada=1 AND institucional=1 AND fk_proceso_institucional=" . $idProcesoInstitucional . " AND fk_proceso is null";
                    $idEncuesta = $conDB->conectarAdo($sql)->fields[0];
                    $sql = "SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE fk_encuesta=" . $idEncuesta . ' AND fk_evidencia=' . $evidencia['fk_evidencia'];
                    //$sql="SELECT pre.pk_pregunta FROM enc_pregunta_cna_evidencia as preevi, enc_pregunta_cna_proceso as prepro, enc_pregunta as pre";
                    //$sql.=" WHERE preevi.fk_evidencia=".$evidencia[0]." AND preevi.fk_pregunta=pre.pk_pregunta AND pre.estado=1 AND pre.pk_pregunta=prepro.fk_pregunta ";
                    //$sql.=" AND prepro.fk_grupo_interes=".$evidencia[1]." AND prepro.fk_proceso_institucional=".$idProcesoInstitucional." AND prepro.institucional=1";
                }
                //echo '<br>';
                //echo 'Sql:'.$sql;
                //echo '<br>';
                $rsPreguntas = $conDB->conectarAdo($sql);
                $preguntasAcumulado = 0;
                $contPreguntas = 0;
                //echo "preguntas: ";
                //echo '<br>';
                // foreach($rsPreguntas as $pregunta){
                //var_dump($pregunta);
                //echo "<br>";
                // }
                $rsPreguntas = $conDB->conectarAdo($sql);

                $pkdatosEncuesta = 0;
                $pkdatosEncuestaArray = array();
                // seleccionamos pk de los datos de solucion de la encuesta 
                //*** grupos interes por proceso {estudiantes,docentes,graduados}*/
                if ($evidencia['fk_grupo_interes'] == 1 || $evidencia['fk_grupo_interes'] == 2 || $evidencia['fk_grupo_interes'] == 4) {
                    $sql = "SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta";
                    $sql.=" WHERE fk_grupos_interes=" . $evidencia['fk_grupo_interes'] . " AND fk_proceso=" . $_idProceso . " AND fk_proceso_institucional is null AND fk_sede=" . $idSede;
                    $pkdatosEncuesta = $conDB->conectarAdo($sql)->fields[0];
                }
                // Directivos academicos
                if ($evidencia['fk_grupo_interes'] == 3) {
                    $sql = "SELECT pk_datos_solucion_encuesta,fk_facultad,fk_programa,fk_sede,fk_cargo_directivo FROM enc_datos_solucion_encuesta ";
                    $sql.=" WHERE fk_grupos_interes=" . $evidencia['fk_grupo_interes'] . " AND fk_proceso is null AND fk_proceso_institucional=" . $idProcesoInstitucional . " AND fk_sede=" . $idSede;
                    $datosEncuesta = $conDB->conectarAdo($sql);
                    foreach ($datosEncuesta as $d) {
                        $sql = "SELECT fk_alcance_cargo FROM enc_cargo_directivo WHERE pk_cargo_directivo=" . $d['fk_cargo_directivo'];
                        $idAlcance = $conDB->conectarAdo($sql)->fields[0];
                        if ($idAlcance == 1) {
                            $pkdatosEncuestaArray[] = $d['pk_datos_solucion_encuesta'];
                        }
                        if ($idAlcance == 2) {
                            if ($d['fk_facultad'] == $idFacultad) {
                                $pkdatosEncuestaArray[] = $d['pk_datos_solucion_encuesta'];
                            }
                        }
                        if ($idAlcance == 3) {
                            if ($d['fk_programa'] == $idPrograma) {
                                $pkdatosEncuestaArray[] = $d['pk_datos_solucion_encuesta'];
                            }
                        }
                        if ($idAlcance == 4) {
                            if ($d['fk_sede'] == $idSede) {
                                $pkdatosEncuestaArray[] = $d['pk_datos_solucion_encuesta'];
                            }
                        }
                    }
                }
                // Funcionarios administrativos
                if ($evidencia['fk_grupo_interes'] == 5) {
                    $sql = "SELECT pk_datos_solucion_encuesta,fk_sede,fk_alcance_administrativo FROM enc_datos_solucion_encuesta ";
                    $sql.=" WHERE fk_grupos_interes=" . $evidencia['fk_grupo_interes'] . " AND fk_proceso is null AND fk_proceso_institucional=" . $idProcesoInstitucional . " AND fk_sede=" . $idSede;
                    $datosEncuesta = $conDB->conectarAdo($sql);
                    foreach ($datosEncuesta as $d) {
                        if ($d[2] == 2) {
                            if ($d[1] == $idSede) {
                                $pkdatosEncuestaArray[] = $d[0];
                            }
                        } else {
                            $pkdatosEncuestaArray[] = $d[0];
                        }
                    }
                }
                // empleadores
                if ($evidencia['fk_grupo_interes'] == 6) {
                    $sql = "SELECT pk_datos_solucion_encuesta FROM enc_datos_solucion_encuesta ";
                    $sql.=" WHERE fk_grupos_interes=" . $evidencia['fk_grupo_interes'] . " AND fk_proceso is null AND fk_proceso_institucional=" . $idProcesoInstitucional . " AND fk_sede=" . $idSede . " AND fk_programa=" . $idPrograma;
                    $datosEncuesta = $conDB->conectarAdo($sql);
                    $pkdatosEncuesta = $datosEncuesta->fields[0];
                }

                echo '<br>';
                echo 'datos Encuesta:' .
                var_dump($pkdatosEncuesta);
                echo '<br>';
                echo 'datos Encuesta array:';
                print_r($pkdatosEncuestaArray);
                echo '<br>';
                foreach ($rsPreguntas as $pregunta) {
                    $resultadoAcumulado = 0;
                    if ($pkdatosEncuesta != null) {
                        if ($evidencia['fk_grupo_interes'] == 1 || $evidencia['fk_grupo_interes'] == 2 || $evidencia['fk_grupo_interes'] == 4 || $evidencia['fk_grupo_interes'] == 6) {
                            $sql = "SELECT count(solenc.fk_pregunta) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc WHERE solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=" . $pkdatosEncuesta . " AND solenc.fk_pregunta=" . $pregunta['pk_pregunta'];
                            $cantEncuestas = $conDB->conectarAdo($sql)->fields[0];
                            echo '<br>';
                            echo 'Cantidad de encuestas:' . $cantEncuestas;
                            echo '<br>';
                            $sql = "SELECT solenc.fk_pregunta,solenc.fk_respuesta_pregunta,respre.ponderacion,count(respre.ponderacion) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc,enc_respuesta_pregunta_solucion_encuesta as respre WHERE solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=" . $pkdatosEncuesta . " AND solenc.fk_pregunta=" . $pregunta['pk_pregunta'] . " AND respre.pk_respuesta_pregunta=solenc.fk_respuesta_pregunta group by(respre.ponderacion)";
                            $rsDatosPonderar = $conDB->conectarAdo($sql);
                            //echo '<br>';
                            // echo 'sql:'.$sql;
                            //echo '<br>';
                            if ($rsDatosPonderar != null) {
                                var_dump($rsDatosPonderar->fields);
                                foreach ($rsDatosPonderar as $datos) {
                                    $resultado = (($datos[3] / $cantEncuestas) * $datos[2]);
                                    $resultadoAcumulado+=$resultado;
                                }
                            }
                            $contPreguntas++;
                            $preguntasAcumulado+=$resultadoAcumulado;
                        }
                    }
                    if ($pkdatosEncuestaArray != array()) {
                        if ($evidencia['fk_grupo_interes'] == 5 || $evidencia['fk_grupo_interes'] == 3) {
                            $cantEncuestas = 0;
                            foreach ($pkdatosEncuestaArray as $pkEncuesta) {
                                echo $pkEncuesta . "-" . $pregunta['pk_pregunta'] . "//";
                                $sql = "SELECT count(solenc.fk_pregunta) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc WHERE solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=" . $pkEncuesta . " AND solenc.fk_pregunta=" . $pregunta['pk_pregunta'];
                                $cantEncuestas+=$conDB->conectarAdo($sql)->fields[0];
                            }
                            echo '<br>';
                            echo 'Cantidad de encuestas:' . $cantEncuestas;
                            echo '<br>';
                            $sql = "SELECT solenc.fk_pregunta,solenc.fk_respuesta_pregunta,respre.ponderacion,count(respre.ponderacion) FROM enc_solucion_encuesta as solenc,enc_datos_solucion_solucion_encuesta as datsolenc,enc_respuesta_pregunta_solucion_encuesta as respre";
                            $sql.=" WHERE ";
                            $sql_where = array();
                            $countSql = 0;
                            foreach ($pkdatosEncuestaArray as $pkEncuesta) {
                                $sql_where[] = "( solenc.fk_datos_solucion_solucion_encuesta=datsolenc.pk_datos_solucion_solucion_encuesta AND datsolenc.fk_datos_solucion_encuesta=" . $pkEncuesta . " AND solenc.fk_pregunta=" . $pregunta['pk_pregunta'] . " AND respre.pk_respuesta_pregunta=solenc.fk_respuesta_pregunta ) ";
                                $countSql++;
                            }
                            $countAux = 0;
                            foreach ($sql_where as $s) {
                                $sql.=$s;
                                if ($countAux < $countSql - 1) {
                                    $sql.=" OR ";
                                }
                                $countAux++;
                            }
                            $sql.=" group by(respre.ponderacion)";
                            //echo '<br>';
                            //echo 'sql:'.$sql;
                            //echo '<br>';
                            $rsDatosPonderar = $conDB->conectarAdo($sql);
                            if ($rsDatosPonderar != null) {
                                var_dump($rsDatosPonderar->fields);
                                foreach ($rsDatosPonderar as $datos) {
                                    $resultado = (($datos[3] / $cantEncuestas) * $datos[2]);
                                    $resultadoAcumulado+=$resultado;
                                }
                            }
                            $contPreguntas++;
                            $preguntasAcumulado+=$resultadoAcumulado;
                        }
                    }
                }
                echo "<br> preguntasAcumulado:" . $preguntasAcumulado;
                echo "<br> contPreguntas:" . $contPreguntas;
                if ($contPreguntas != 0)
                    $r = round($preguntasAcumulado / $contPreguntas, 2);
                else
                    $r = 0;
                echo "<br>";
                echo "Resultado para evidencia " . $evidencia['fk_evidencia'] . " y grupo " . $evidencia['fk_grupo_interes'] . " = " . $r;
                echo "<br>";
                echo "<br>";
                //die();   
                $sql = 'SELECT pk_cna_resultados_evidencia FROM cna_resultados_evidencia WHERE fk_evidencia_grupo_interes=' . $evidencia['pk_evidencia_grupo_interes'] . ' AND fk_proceso=' . $_idProceso;
                $res = $conDB->conectarAdo($sql);
                var_dump($res->fields[0]);
                if ($res->fields != null && $res->fields[0] != null) {
                    $sql = 'UPDATE cna_resultados_evidencia SET ';
                    $sql.=' calificacion=' . $r . ',';
                    $sql.=' fk_evidencia_grupo_interes=' . $evidencia['pk_evidencia_grupo_interes'] . ',';
                    $sql.=' fk_proceso=' . $_idProceso;
                    $sql.=' WHERE pk_cna_resultados_evidencia=' . $res->fields[0];
                    $res = $conDB->conectarAdo($sql);
                    var_dump($res);
                } else {
                    $sql = "INSERT INTO cna_resultados_evidencia (calificacion,fk_evidencia_grupo_interes,fk_proceso)";
                    $sql.=" VALUES (" . $r . "," . $evidencia['pk_evidencia_grupo_interes'] . "," . $_idProceso . ")";
                    $res = $conDB->conectarAdo($sql);
                    var_dump($res);
                }
            }
        }
    }

}

?>