<?php
error_reporting(0);
include '../BaseDatos/AdoDB.php';

class Preguntas{
    
    public function __construct(){
        $this->adoDB = new Ado();
    }

    public function guardarPregunta($_idTipoRes,$_txRespuesta,$_ponRespuesta,$_idProceso){
        $sql2 = "SELECT MAX(grupo_respuesta) + 1 AS id_grupo FROM doc_respuesta_pregunta ";
        $res2 = $this->runSQL($sql2);
        $id_grupo = $res2->GetRows();
        if ($id_grupo[0]['id_grupo'] == null){
            $id_grupo[0]['id_grupo'] = 1;
        }
        /*$sql="INSERT INTO enc_pregunta(texto,fk_tipo_respuesta,estado) VALUES ('".$_txPregunta."',".$_idTipoRes.",1)";
        $res = $conDB->conectarAdo($sql);
        $sql="SELECT pk_pregunta FROM enc_pregunta WHERE texto='".$_txPregunta."' AND estado=1";
        $idPregunta= $conDB->conectarAdo($sql);
        $idPregunta=$idPregunta->GetArray();
        $idPregunta=$idPregunta[0][0];*/
        $res = 1;
        for($i=0; $i<count($_txRespuesta[0]); $i++){
            $sql= 'INSERT INTO doc_respuesta_pregunta(texto,fk_respuesta_ponderacion,tipo_respuesta , grupo_respuesta, estado) VALUES ("'.$_txRespuesta[0][$i].'", "'.$_ponRespuesta[0][$i].'", "'.$_idTipoRes.'", "'.$id_grupo[0]['id_grupo'].'", 1 )';
            if(!$this->runSQL($sql))
                $res = 0;
        }
        return $res;
    }

    private function runSQL($sql){
        $resultado = $this->adoDB->conectarAdo($sql);
        return $resultado;
    }
}
?>
