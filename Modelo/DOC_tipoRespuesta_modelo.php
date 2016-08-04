<?php
class TiposRespuesta{
    public function getTiposRespuesta($cantidad=-1){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT * FROM tipo_respuesta WHERE estado=1";
        $rsDatos = $conDB->conectarAdo($sql);
        $array_tipo=array();
        while(!$rsDatos->EOF) //Mientras no estemos al final de RecordSet
        {
            if($rsDatos->fields[2]==$cantidad){
                $array_tipo[$rsDatos->fields[1]]=$rsDatos->fields[0];
            }
           $rsDatos->MoveNext();
        }
        // aquiiiiiiiiiiii preguntarle a camilo
        return $array_tipo;
    }
    
    public function getValoresRespuesta($idTipoRes=-1){
        if($idTipoRes!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="SELECT pk_respuesta_ponderacion,ponderacion FROM respuesta_ponderacion WHERE fk_tipo_respuesta=".$idTipoRes;
            $rsDatos = $conDB->conectarAdo($sql);
            return $rsDatos;
        }
    }
    
    public function getCantidadRespuestas(){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="SELECT cantidad_respuestas FROM tipo_respuesta WHERE estado=1 group by cantidad_respuestas";
            $rsDatos = $conDB->conectarAdo($sql);
            $datos_cantidad_Respuestas=array();
            while(!$rsDatos->EOF) //Mientras no estemos al final de RecordSet
            {
               $datos_cantidad_Respuestas[$rsDatos->fields[0]]=$rsDatos->fields[0];
               $rsDatos->MoveNext();
            }
            return $datos_cantidad_Respuestas;
    }
}
?>