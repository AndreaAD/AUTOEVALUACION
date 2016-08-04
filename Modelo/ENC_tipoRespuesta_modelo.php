<?php
class TiposRespuesta{
    /* Devolvemos todos los datos de los tipos de respuesta que tengan la misma cantidad de respuestas que 
       el valor enviado a la funcion 
       retorno: array */
    public function getTiposRespuesta($cantidad=-1){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT * FROM tipo_respuesta WHERE estado=1";
        $rsDatos=$conDB->conectarAdo($sql);
        $array_tipo=array();
        while(!$rsDatos->EOF) //Mientras no estemos al final de RecordSet
        {
            if($rsDatos->fields[2]==$cantidad){
                $array_tipo[$rsDatos->fields[1]]=$rsDatos->fields[0];
            }
           $rsDatos->MoveNext();
        }
        return $array_tipo;
    }
    
    /* Devolvemos la ponderacion de cada respuesta para el tipo de respuesta que le pasamos a la funcion
       retorno: recordSet */
    public function getValoresRespuesta($idTipoRes=-1){
        if($idTipoRes!=-1){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="SELECT pk_respuesta_ponderacion,ponderacion FROM respuesta_ponderacion WHERE fk_tipo_respuesta=".$idTipoRes;
            $rsDatos=$conDB->conectarAdo($sql);
            return $rsDatos;
        }
    }
    
    /* Devolvemos un array con las posibles cantidades de respuestas deacuerdo con las que estan en base de datos
       retorno: array */
    public function getCantidadRespuestas(){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            
            $sql="SELECT cantidad_respuestas FROM tipo_respuesta WHERE estado=1 group by cantidad_respuestas";
            $rsDatos=$conDB->conectarAdo($sql);
            $datos_cantidad_Respuestas=array();
            while(!$rsDatos->EOF) //Mientras no estemos al final de RecordSet
            {
               $datos_cantidad_Respuestas[$rsDatos->fields[0]]=$rsDatos->fields[0];
               $rsDatos->MoveNext();
            }
            return $datos_cantidad_Respuestas;
    }
    
    /* Verificamos si el tipo de respuesta tiene ideal
        retorno: boolean  */
    public function verificarIdeal($_idTipoRes){
            require_once("../BaseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="SELECT ideal FROM tipo_respuesta WHERE pk_tipo_respuesta=".$_idTipoRes;
            $rsDatos=$conDB->conectarAdo($sql);
            if($rsDatos!=null && $rsDatos->fields[0]==1){
                return true;
            }else{
                return false;
            }
           
    }
    
    /*  Devolvemos todos los tipos de respuesta
        retorno: recordSet*/
    public function getAllTiposRespuesta(){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT * FROM tipo_respuesta";
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    /* Devolvemos la ponderacion de las respuestas */
    public function getPonderacionesTipoRespuesta($_idTipoRespuesta){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT * FROM respuesta_ponderacion WHERE fk_tipo_respuesta=".$_idTipoRespuesta;
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    /* Devolvemos un tipo de respuesta que coincida con el id pasado a la funcion
       retorno: recordSet */
    public function getUnTipoRespuesta($_idTipoRespuesta){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT * FROM tipo_respuesta WHERE pk_tipo_respuesta=".$_idTipoRespuesta;
        $rsDatos=$conDB->conectarAdo($sql);
        return $rsDatos;
    }
    
    /* Guardar las modificaciones de los tipos de respuesta.
       retorno: null, true , false */
    public function guardarModificaciones($_id,$_descripcion,$_estado,$_ponderacionID,$_ponderacionValor){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="UPDATE tipo_respuesta SET descripcion ='".$_descripcion."',";
        $sql.="estado =".$_estado;
        $sql.="  WHERE pk_tipo_respuesta =".$_id;
        $resultado=$conDB->conectarAdo($sql);
        foreach($_ponderacionID as $id){
            $sql="UPDATE respuesta_ponderacion SET ponderacion=".$_ponderacionValor[$id];
            $sql.=" WHERE pk_respuesta_ponderacion=".$id;
            $resultado=$conDB->conectarAdo($sql);
        }
        return $resultado;
    }
}
?>