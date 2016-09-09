<?php

class Consultas {

    public function getDatosInformeConsolidacionEvidencia($_idEvidencia, $_idProceso) {
        if ($_idEvidencia != null && $_idProceso != null) {
            require_once("../BaseDatos/AdoDB.php");
            $conDB = new Ado();
            $sql = "select rese.pk_cna_resultados_evidencia,rese.calificacion,evg.fk_grupo_interes,gi.nombre,evg.fk_evidencia from cna_resultados_evidencia as rese,cna_evidencia_grupo_interes as evg, cna_grupo_interes as gi where rese.fk_evidencia_grupo_interes=evg.pk_evidencia_grupo_interes AND gi.pk_grupo_interes=evg.fk_grupo_interes AND evg.fk_evidencia=" . $_idEvidencia . " AND rese.fk_proceso=" . $_idProceso;
            echo $sql;
            die();
            $rsDatos = $conDB->conectarAdo($sql);
            return $rsDatos;
        } else {
            return -1;
        }
    }
    public function cantidad_preguntas_encuesta($_idProceso, $_idGrupo){
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $sql = "SELECT
                        pregunta.pk_pregunta
                FROM
                        enc_solucion_encuesta solucion
                JOIN enc_respuesta_pregunta_solucion_encuesta respuesta ON respuesta.pk_respuesta_pregunta = solucion.fk_respuesta_pregunta
                JOIN enc_pregunta_solucion_encuesta pregunta ON pregunta.pk_pregunta = solucion.fk_pregunta
                JOIN enc_encuesta encuesta ON encuesta.pk_encuesta = pregunta.fk_encuesta
                WHERE
                        encuesta.fk_grupo_interes = '{$_idGrupo}'
                AND encuesta.fk_proceso = '{$_idProceso}'
                GROUP BY
                        (pregunta.pk_pregunta)
                UNION
                        (
                                SELECT
                                        pregunta.pk_pregunta
                                FROM
                                        enc_solucion_encuesta solucion
                                JOIN enc_respuesta_pregunta_solucion_encuesta respuesta ON respuesta.pk_respuesta_pregunta = solucion.fk_respuesta_pregunta
                                JOIN enc_pregunta_solucion_encuesta pregunta ON pregunta.pk_pregunta = solucion.fk_pregunta
                                JOIN enc_encuesta encuesta ON encuesta.pk_encuesta = pregunta.fk_encuesta
                                WHERE
                                        encuesta.fk_grupo_interes = '{$_idGrupo}'
                                AND encuesta.fk_proceso_institucional IN (SELECT pk_proceso_institucional FROM cna_proceso JOIN cna_proceso_institucional ON pk_proceso_institucional = fk_proceso_institucional WHERE pk_proceso = '{$_idProceso}')
                                GROUP BY
                                        (pregunta.pk_pregunta)
                        )";
        $rsDatos = $conDB->conectarAdo($sql);
        return $rsDatos->_numOfRows;
    }
    public function numeroVecesPregunta($_idProceso, $_idGrupo, $_idPregunta = null, $id_respuesta = null) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        $where = '';
        if ($_idPregunta != null) {
            $where.=" AND pregunta.pk_pregunta = '{$_idPregunta}'";
        }
        if ($id_respuesta != null) {
            $where.=" AND respuesta.pk_respuesta_pregunta= '{$id_respuesta}'";
        }
        $sql = "SELECT
                        COUNT(pk_solucion_encuesta) AS cantidad_respuestas
                FROM
                        enc_solucion_encuesta solucion
                JOIN enc_respuesta_pregunta_solucion_encuesta respuesta ON respuesta.pk_respuesta_pregunta = solucion.fk_respuesta_pregunta
                JOIN enc_pregunta_solucion_encuesta pregunta ON pregunta.pk_pregunta = solucion.fk_pregunta
                JOIN enc_encuesta encuesta ON encuesta.pk_encuesta = pregunta.fk_encuesta
                WHERE
                        encuesta.fk_grupo_interes = '{$_idGrupo}'
                AND encuesta.fk_proceso = '{$_idProceso}'
                $where";
        $rsDatos = $conDB->conectarAdo($sql);
        if ($rsDatos->fields['cantidad_respuestas'] == 0) {
            $sql = "SELECT
                    COUNT(pk_solucion_encuesta) AS cantidad_respuestas
                FROM
                    enc_solucion_encuesta solucion
                JOIN enc_respuesta_pregunta_solucion_encuesta respuesta ON respuesta.pk_respuesta_pregunta = solucion.fk_respuesta_pregunta
                JOIN enc_pregunta_solucion_encuesta pregunta ON pregunta.pk_pregunta = solucion.fk_pregunta
                JOIN enc_encuesta encuesta ON encuesta.pk_encuesta = pregunta.fk_encuesta
                WHERE
                    encuesta.fk_grupo_interes = '{$_idGrupo}'
                AND encuesta.fk_proceso_institucional IN (SELECT pk_proceso_institucional FROM cna_proceso JOIN cna_proceso_institucional ON pk_proceso_institucional = fk_proceso_institucional WHERE pk_proceso = '{$_idProceso}')
                $where";
            $rsDatos = $conDB->conectarAdo($sql);
        }
        return $rsDatos->fields['cantidad_respuestas'];
    }

    public function numeroVecesRespuesta($_idProceso, $_idGrupo, $_idPregunta, $_idRespuesa) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        if ($_idGrupo == 1 || $_idGrupo == 2 || $_idGrupo == 4) {
            $sql = 'select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_solucion_encuesta as datsol,enc_solucion_encuesta as solenc, enc_datos_solucion_encuesta as dat where dat.fk_grupos_interes=' . $_idGrupo . ' and dat.fk_proceso=' . $_idProceso . ' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta and solenc.fk_pregunta=' . $_idPregunta . ' and solenc.fk_respuesta_pregunta=' . $_idRespuesa . ' and datsol.pk_datos_solucion_solucion_encuesta=solenc.fk_datos_solucion_solucion_encuesta';
        }
        if ($_idGrupo == 3 || $_idGrupo == 5 || $_idGrupo == 6) {
            $sql = "SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=" . $_idProceso;
            $idProcesoInstitucional = $conDB->conectarAdo($sql)->fields[0];
            $sql = 'select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_solucion_encuesta as datsol,enc_solucion_encuesta as solenc, enc_datos_solucion_encuesta as dat where dat.fk_grupos_interes=' . $_idGrupo . ' and dat.fk_proceso_institucional=' . $idProcesoInstitucional . ' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta and solenc.fk_pregunta=' . $_idPregunta . ' and solenc.fk_respuesta_pregunta=' . $_idRespuesa . ' and datsol.pk_datos_solucion_solucion_encuesta=solenc.fk_datos_solucion_solucion_encuesta';
        }
        echo $sql;
        $rsDatos = $conDB->conectarAdo($sql);
        return $rsDatos;
    }

    public function getEncuestasGrupoInteres($_idProceso, $_idGrupo) {
        require_once("../BaseDatos/AdoDB.php");
        $conDB = new Ado();
        if ($_idGrupo == 1 || $_idGrupo == 2 || $_idGrupo == 4) {
            $sql = 'select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_encuesta as dat, enc_datos_solucion_solucion_encuesta as datsol where dat.fk_grupos_interes=' . $_idGrupo . ' and dat.fk_proceso=' . $_idProceso . ' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta;';
        }
        if ($_idGrupo == 3 || $_idGrupo == 5 || $_idGrupo == 6) {
            $sql = "SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=" . $_idProceso;
            $idProcesoInstitucional = $conDB->conectarAdo($sql)->fields[0];
            $sql = 'select count(datsol.pk_datos_solucion_solucion_encuesta) from enc_datos_solucion_encuesta as dat, enc_datos_solucion_solucion_encuesta as datsol where dat.fk_grupos_interes=' . $_idGrupo . ' and dat.fk_proceso_institucional=' . $idProcesoInstitucional . ' and datsol.fk_datos_solucion_encuesta=dat.pk_datos_solucion_encuesta;';
        }
        $rsDatos = $conDB->conectarAdo($sql);
        return $rsDatos;
    }

}

?>