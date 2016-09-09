<?php

class Ado {

    public function conectarAdo($cadena) {
        $line = mysql_connect("localhost", "sia_admin", "S1A_dbUser") or die("Erro en la Conexion");
        mysql_select_db("omzsiste_sia", $line)or die("Error base de datos");
        if (strpos($cadena, 'DELETE') === false) {
            $resultado = mysql_query($cadena, $line) or die("Error en sql=" . mysql_error($line) . ' sql=' . $cadena);
            $rsDatos = array();
            while ($rowEmp = mysql_fetch_assoc($resultado)) {
                $rsDatos[] = $rowEmp;
            }
            mysql_close($line);
            return $rsDatos;
        } else {
            mysql_query($cadena, $line);
            mysql_close($line);
            return -1;
        }
    }

}

class ProcesamientoTemporal {

    public function publicarEncuesta($_idProceso, $_idGrupo, $_idUnico) {
        $conDB = new Ado();
        $fecha = date("Y-m-d H:i:s");
        $pkEncuesta = -1;
        switch ($_idGrupo) {
            case 1: case 2: case 4:
                $sql = "SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=" . $_idGrupo . " AND fk_proceso=" . $_idProceso . " AND institucional=0";
                $res = $conDB->conectarAdo($sql);
                if (count($res) == 0) {
                    $sql = "INSERT INTO enc_encuesta(`fk_grupo_interes`,`fk_proceso`,`institucional`,`publicada`,`fecha_publicacion`,`id_aleatorio`)";
                    $sql.=" VALUES (" . $_idGrupo . "," . $_idProceso . ",0,1,'" . $fecha . "','" . $_idUnico . "')";
                    $res = $conDB->conectarAdo($sql);
                    //echo 'encuesta=' . $sql . ' \n';
                    if ($res === false) {
                        return -1;
                    } else {
                        $sql = "SELECT pk_encuesta FROM enc_encuesta where id_aleatorio='" . $_idUnico . "'";
                        $res = $conDB->conectarAdo($sql);
                        $pkEncuesta = $res[0]['pk_encuesta'];
                    }
                } else {
                    return false;
                }
                break;
            case 3: case 5: case 6:
                $sql = "SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=" . $_idProceso;
                $res = $conDB->conectarAdo($sql);
                $pkProcesoInstitucional = $res[0]['fk_proceso_institucional'];
                $sql = "UPDATE cna_proceso_institucional SET estado = '0'";
                $res = $conDB->conectarAdo($sql);
                $sql = "UPDATE cna_proceso_institucional SET estado = '1' WHERE pk_proceso_institucional = '{$pkProcesoInstitucional}'";
                $res = $conDB->conectarAdo($sql);
                 
                $sql = "SELECT pk_encuesta FROM enc_encuesta WHERE fk_grupo_interes=" . $_idGrupo . " AND fk_proceso_institucional=" . $pkProcesoInstitucional . " AND institucional=1";
                $res = $conDB->conectarAdo($sql);
                if (count($res) == 0) {
                    $sql = "INSERT INTO enc_encuesta(`fk_grupo_interes`,`fk_proceso_institucional`,`institucional`,`publicada`,`fecha_publicacion`,`id_aleatorio`)";
                    $sql.=" VALUES (" . $_idGrupo . "," . $pkProcesoInstitucional . ",1,1,'" . $fecha . "','" . $_idUnico . "')";
                    $res = $conDB->conectarAdo($sql);
                    // echo 'encuesta=' . $sql . ' \n';
                    // echo 'resultado=';
                    //print_r($res);
                    if ($res === false) {
                        return -1;
                    } else {
                        $sql = "SELECT pk_encuesta FROM enc_encuesta where id_aleatorio='" . $_idUnico . "'";
                        $res = $conDB->conectarAdo($sql);
                        $pkEncuesta = $res[0]['pk_encuesta'];
                    }
                } else {
                    $pkEncuesta = $res[0]['pk_encuesta'];
                    $sql = "UPDATE enc_encuesta SET fecha_publicacion ='" . $fecha . "' WHERE pk_encuesta=" . $pkEncuesta;
                    $conDB->conectarAdo($sql);
                }
                break;
        }
        return $pkEncuesta;
    }

    /* public function cancelarPublicarEncuesta($_idProceso,$_idGrupo){
      require_once("../BaseDatos/AdoDB.php");
      $conDB=new Ado();
      $sql="UPDATE `enc_encuesta` SET publicada=0 WHERE fk_grupo_interes=".$_idGrupo." AND fk_proceso=".$_idProceso;
      $res=$conDB->conectarAdo($sql);
      return $res;
      } */

    public function copiarDatosEncuesta($_pregunta, $_respuestas, $_pkEvidencia, $_pkEncuesta) {
        $conDB = new Ado();
        //$idAleatorio=Util::getCodigoAleatorio();
//        $sql = "SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE pk_banco_pregunta=" . $_pregunta['pk_pregunta'] . " AND id_aleatorio='" . $_pregunta['id_aleatorio'] . "' AND fk_encuesta=" . $_pkEncuesta . " AND fk_evidencia=" . $_pkEvidencia;
//        $res = $conDB->conectarAdo($sql);
//        if (count($res) != 0) {
//            $pkPregunta = $res[0]['pk_pregunta'];
//            $sql = "DELETE FROM enc_respuesta_pregunta_solucion_encuesta WHERE fk_pregunta_solucion=" . $pkPregunta;
//            $res = $conDB->conectarAdo($sql);
//            $sql = "DELETE FROM enc_pregunta_solucion_encuesta WHERE id_aleatorio='" . $_pregunta['id_aleatorio'] . "' AND pk_banco_pregunta=" . $_pregunta['pk_pregunta'] . " AND pk_pregunta=" . $pkPregunta;
//            $res = $conDB->conectarAdo($sql);
//        }
        $ideal = 'Null';
        if ($_pregunta['ideal'] == '' || $_pregunta['ideal'] == null) {
            $ideal = 'Null';
        } else {
            $ideal = $_pregunta['ideal'];
        }
        $sql = "INSERT INTO enc_pregunta_solucion_encuesta (pk_banco_pregunta,texto,fk_encuesta,ideal,id_aleatorio,institucional) ";
        $sql.="VALUES (" . $_pregunta['pk_pregunta'] . ",'" . $_pregunta['texto'] . "'," . $_pkEncuesta . "," . $ideal . ",'" . $_pregunta['id_aleatorio'] . "'," . $_pregunta['institucional'] . ");";
        $res = $conDB->conectarAdo($sql);
        $sql = "SELECT pk_pregunta FROM enc_pregunta_solucion_encuesta WHERE pk_banco_pregunta=" . $_pregunta['pk_pregunta'] . " AND id_aleatorio='" . $_pregunta['id_aleatorio'] . "' AND fk_encuesta=" . $_pkEncuesta;
        $res = $conDB->conectarAdo($sql);
        $pkPregunta = $res[0]['pk_pregunta'];
        foreach ($_respuestas as $respuesta) {
            $sql = "INSERT INTO enc_respuesta_pregunta_solucion_encuesta (texto,fk_pregunta_solucion,ponderacion) ";
            $sql.="VALUES ('" . $respuesta['texto'] . "'," . $pkPregunta . "," . $respuesta['ponderacion'] . ")";
            //echo $sql . '<br>';
            $res = $conDB->conectarAdo($sql);
        }
    }

}

class Preguntas {

    public function getPreguntasGrupoInteres($_idProceso, $_idGrupo) {
        if ($_idProceso != -1) {
            $conDB = new Ado();
            if ($_idGrupo == 1 || $_idGrupo == 2 || $_idGrupo == 4) {
                $sql = "SELECT pre.* FROM enc_pregunta_cna_proceso as prepro, enc_pregunta as pre WHERE prepro.fk_proceso=" . $_idProceso . " AND prepro.fk_grupo_interes=" . $_idGrupo . " AND pre.pk_pregunta=prepro.fk_pregunta AND pre.estado=1";
                //echo $sql;die();
            } else if ($_idGrupo == 3 || $_idGrupo == 5 || $_idGrupo == 6) {
                $sql = "SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=" . $_idProceso;
                $res = $conDB->conectarAdo($sql);
                $idProcesoInstitucional = $res[0]['fk_proceso_institucional'];
                $sql = "SELECT pre.* FROM enc_pregunta_cna_proceso as prepro, enc_pregunta as pre WHERE prepro.fk_proceso_institucional=" . $idProcesoInstitucional . " AND prepro.fk_grupo_interes=" . $_idGrupo . " AND prepro.institucional=1 AND pre.pk_pregunta=prepro.fk_pregunta AND pre.estado=1";
            //echo $sql;die();
                
            }
            $rsDatos = $conDB->conectarAdo($sql);
            return $rsDatos;
        } else {
            return -1;
        }
    }

}

class GruposInteres {

    public function getAllGrupos() {
        $conDB = new Ado();
        $sql = "SELECT * FROM cna_grupo_interes WHERE  pk_grupo_interes=1 OR pk_grupo_interes=2 OR pk_grupo_interes=4 OR pk_grupo_interes=3 OR pk_grupo_interes=5 OR pk_grupo_interes=6 AND estado=1";
        $rsDatos = $conDB->conectarAdo($sql);
        return $rsDatos;
    }

}

class Respuestas {

    public function getDatosRespuestas($_idPregunta = -1) {
        if ($_idPregunta != -1) {
            $conDB = new Ado();
            $sql = "SELECT rp.pk_respuesta_pregunta,rp.texto,po.pk_respuesta_ponderacion,po.ponderacion FROM enc_respuesta_pregunta as rp, respuesta_ponderacion as po WHERE fk_pregunta=" . $_idPregunta . " AND po.pk_respuesta_ponderacion=rp.fk_respuesta_ponderacion";

            // echo $sql;die();
            $rsDatos = $conDB->conectarAdo($sql);
            return $rsDatos;
        } else {
            return null;
        }
    }

}

class Evidencias {

    public function getEvidenciaUnaPregunta($_idPregunta) {
        $conDB = new Ado();
        $sql = "SELECT fk_evidencia,fk_caracteristica,fk_aspecto FROM enc_pregunta_cna_evidencia where fk_pregunta=" . $_idPregunta;
        $res = $conDB->conectarAdo($sql);
        return $res;
    }

}

class Util {

    public static function getCodigoAleatorio() {
        $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $su = strlen($an) - 1;
        return substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1) .
                substr($an, mt_rand(0, $su), 1);
    }

}

session_start();
$faseProceso = $_SESSION['pk_fase'];
$idProceso = $_POST['id_proceso'];
$objTemporal = new ProcesamientoTemporal();
$objPreguntas = new Preguntas();
$objGrupos = new GruposInteres();
$objRespuestas = new Respuestas();
$objEvidencias = new Evidencias();
$rsGrupos = $objGrupos->getAllGrupos();
$i = 0;
foreach ($rsGrupos as $grupo) {
    $idUnico = Util::getCodigoAleatorio();
    $pkEncuesta = $objTemporal->publicarEncuesta($idProceso, $grupo['pk_grupo_interes'], $idUnico);
    if ($pkEncuesta == false) {
        echo '<b>Encuesta ya realizada</b>';
    } else {
        $j = 0;
        $rsDatosPreguntas = $objPreguntas->getPreguntasGrupoInteres($idProceso, $grupo['pk_grupo_interes']);
        foreach ($rsDatosPreguntas as $pregunta) {
            $pkEvidencia = $objEvidencias->getEvidenciaUnaPregunta($pregunta['pk_pregunta']);

            $j++;
            $rsDatosRespuestas = $objRespuestas->getDatosRespuestas($pregunta['pk_pregunta']);
            $res = $objTemporal->copiarDatosEncuesta($pregunta, $rsDatosRespuestas, $pkEvidencia, $pkEncuesta);
        }
        $i+=$j;
    }
}
?>