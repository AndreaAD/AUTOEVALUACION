<?php
class Procesos{
    
    /* Verficicacion si un programa en una sede tiene un proceso creado sin importar la fase.
       retorno: -1 , idproceso */
    public function existeProceso($_idPrograma,$_idSede){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT pk_proceso FROM cna_proceso WHERE fk_programa=".$_idPrograma." AND fk_sede=".$_idSede." AND fk_fase=4";
        $rsDatos=$conDB->conectarAdo($sql);
        if(!$rsDatos || $rsDatos->RecordCount()==0){
            return -1;
        }else{
            return $rsDatos->fields[0];
        }
    }
    
    /* Devolvemos el id del proceso institucional que esta enlazado al proceso que se envia
       retorno: idProceso */
    public function getPkProcesoInstitucional($_idProceso){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();     
        $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idProceso;
        $rsResultado=$conDB->conectarAdo($sql);
        return $rsResultado->fields['fk_proceso_institucional'];
    }
    
    /* Devolvemos el id y nomrbe de los programas  para una sede.
       retorno: recordSet */
    public function getDatosProgramasSede($_idSede){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT spro.pk_programa,spro.nombre FROM cna_proceso as pro, sad_programa as spro WHERE  pro.fk_programa=spro.pk_programa AND spro.estado=1 AND pro.fk_sede=".$_idSede;
        $rsResultado=$conDB->conectarAdo($sql);
        return $rsResultado;
    }
    
    /*  */
    public function copiarEnlacePreguntasProceos($_idReferencia,$_idCopiado){
        require_once("../BaseDatos/AdoDB.php");
        $conDB=new Ado();
        $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idCopiado;
        $pkInstitucionalReferencia=$conDB->conectarAdo($sql)->fields['fk_proceso_institucional'];
        $sql="SELECT fk_pregunta,fk_grupo_interes,fk_proceso,fk_proceso_institucional,institucional FROM enc_pregunta_cna_proceso where fk_proceso=".$_idReferencia." or fk_proceso_institucional=".$pkInstitucionalReferencia;
        echo $sql;
        $rsDatosReferencia=$conDB->conectarAdo($sql);
        $sql="SELECT fk_proceso_institucional FROM cna_proceso WHERE pk_proceso=".$_idCopiado;
        $pkInstitucional=$conDB->conectarAdo($sql)->fields['fk_proceso_institucional'];
        echo '<br>';
        echo $sql;
        echo $pkInstitucional;
        foreach($rsDatosReferencia as $dato){
            $sql="INSERT INTO enc_pregunta_cna_proceso";
            $sql.=" (fk_pregunta,
                     fk_grupo_interes,
                     fk_proceso,
                     fk_proceso_institucional,
                     institucional) ";
            $sql.="VALUES ";
            if($dato['fk_proceso']!=null && $dato['fk_proceso']!=0){
                $sql.=" (".$dato['fk_pregunta'].",".$dato['fk_grupo_interes'].",".$_idCopiado.",null,0);";
            }elseif($dato['fk_proceso_institucional']!=null && $dato['fk_proceso_institucional']!=0){
                if($dato['fk_proceso_institucional']!=$pkInstitucional){
                    $sql.=" (".$dato['fk_pregunta'].",".$dato['fk_grupo_interes'].",".$dato['fk_proceso'].",".$pkInstitucional.",1);";
                }
            }
            echo '<br>';
            echo $sql;
            $res=$conDB->conectarAdo($sql);
        }
        return $res;
    }
}
?>